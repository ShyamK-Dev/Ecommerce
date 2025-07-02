<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class OrdersManager extends Controller
{
    function showCheckout(){
        return view('checkout');
    }

    function checkoutPost(Request $req){
        $req->validate([
            'address' => 'required',
            'pincode' => 'required',
            'phone' => 'required',
        ]);
        $cartItems = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('product_id', DB::raw('count(*) as  quantity'), 'products.price')
            ->where('carts.user_id', Auth::user()->id)
            ->groupBy('carts.product_id', 'products.price')->get();
        
        if($cartItems->isEmpty()){
            return redirect(route('cart.show'))->with('error', 'No items in cart');
        }

        $productIds = [];
        $quantities = [];
        $totalPrice = 0;

        foreach($cartItems as $cartItem){
            $productIds[] = $cartItem->product_id;
            $quantities[] = $cartItem->quantity;
            $totalPrice += $cartItem->price * $cartItem->quantity;
        }

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->address = $req->address;
        $order->pincode = $req->pincode;
        $order->phone = $req->phone;
        $order->product_id = json_encode($productIds);
        $order->quantity = json_encode($quantities);
        $order->total_price = $totalPrice;

        if($order->save()){
             
            return redirect(route('payment.show'))
                ->with('success', 'Order placed successfully');
        }
        return redirect(route('cart.show'))
            ->with('error', 'Failed to place order');
     }

     
}