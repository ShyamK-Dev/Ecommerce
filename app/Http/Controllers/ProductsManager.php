<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductsManager extends Controller
{
    function index()
    {
        $products = Product::paginate(8);
        return view('products', compact('products')); 
    }

    function details($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('details', compact('product'));
    }

    function addToCart($id)
    {
        $cart = new Cart();
        $cart->user_id = Auth::user()->id;
        $cart->product_id = $id;
        if ($cart->save()) {
            return redirect()->back()->with('success', 'Product added to cart successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to add product to cart');
        }

        
    }

    function showCart()
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

        return view('cart', compact('cartItems', 'subtotal'));
    }

    public function updateCart(Request $request, $productId)
    {
        $action = $request->input('action');

        $cartItem = DB::table('carts')
            ->where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($action === 'increase') {
            DB::table('carts')->insert([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } elseif ($action === 'decrease' && $cartItem) {
            DB::table('carts')
                ->where('id', $cartItem->id)
                ->delete();
        }

        return redirect()->route('cart.show');
    }

    public function removeFromCart($productId)
    {
        DB::table('carts')
            ->where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->delete();

        return redirect()->route('cart.show');
    }
}
