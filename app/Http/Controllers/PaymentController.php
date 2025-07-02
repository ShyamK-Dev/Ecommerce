<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        $cartItems = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('product_id', DB::raw('count(*) as  quantity'), 'products.title', 'products.price', 'products.image', 'products.slug')
            ->where('carts.user_id', Auth::user()->id)
            ->groupBy('carts.product_id', 'products.title', 'products.price', 'products.image', 'products.slug')->paginate(5);

        // Calculate total from ALL items
        $allCartItems = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('product_id', 'products.price')
            ->where('carts.user_id', Auth::user()->id)
            ->get();

        $subtotal = $allCartItems->sum(function ($item) {
            return $item->price * DB::table('carts')
                ->where('user_id', Auth::user()->id)
                ->where('product_id', $item->product_id)
                ->count();
        });

        return view('payment', compact('cartItems', 'subtotal'));
    }

    public function createOrder()
    {
        $allCartItems = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('product_id', 'products.price')
            ->where('carts.user_id', Auth::user()->id)
            ->get();

        $subtotal = $allCartItems->sum(function ($item) {
            return $item->price * DB::table('carts')
                ->where('user_id', Auth::user()->id)
                ->where('product_id', $item->product_id)
                ->count();
        });

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'amount'   => intval($subtotal * 100), // ₹100 (in paise)
            'currency' => 'INR',
            'receipt'  => 'order_' . time(),
        ]);

        return view('pay-now', [
            'order_id' => $order['id'],
            'amount'  => $order['amount'],
            'key'     => env('RAZORPAY_KEY')
        ]);
    }

    public function verify(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $request->order_id,
                'razorpay_payment_id' => $request->payment_id,
                'razorpay_signature'  => $request->signature
            ]);



            DB::table('carts')->where('user_id', Auth::user()->id)->delete();


            // return "Payment Successful! (Test Mode)";
            return redirect()->route('cart.show')->with('success', 'Payment Successful!');
        } catch (\Exception $e) {
            return "Payment Failed: " . $e->getMessage();
        }
    }

}