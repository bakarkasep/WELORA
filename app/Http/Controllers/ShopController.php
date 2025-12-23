<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    public function index() {
        $women = Product::where('category', 'women')->get();
        $men = Product::where('category', 'men')->get();
        $unisex = Product::where('category', 'unisex')->get();
    
        return view('index', compact('women', 'men', 'unisex'));
    }

    public function addToCart($id) {
        if (!Auth::check()) return redirect()->route('login');
        
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->where('product_id', $id)->first();
        
        if ($cart) {
            $cart->increment('qty');
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $id,
                'qty' => 1
            ]);
        }
        return redirect()->route('cart');
    }

    public function cart() {
        if (!Auth::check()) return redirect()->route('login');
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('cart', compact('cartItems'));
    }

    public function updateCart(Request $request, $id) {
        $cart = Cart::find($id);
        if($request->action == 'plus') {
            $cart->increment('qty');
        } elseif($request->action == 'minus' && $cart->qty > 1) {
            $cart->decrement('qty');
        }
        return back();
    }

    public function deleteCart($id) {
        Cart::destroy($id);
        return back();
    }

   
    public function payment() {
        if (!Auth::check()) return redirect()->route('login');
        $cartItems = Cart::where('user_id', Auth::id())->get();
        
        if($cartItems->isEmpty()) return redirect()->route('home');

        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->qty;
        });

        return view('payment', compact('cartItems', 'total'));
    }

    public function processPayment(Request $request) {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();
        $total = $request->total_price;

        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'customer_name' => $request->name,
            'address' => $request->address . ', ' . $request->city . ', ' . $request->zip,
            'courier' => $request->courier,
            'payment_method' => $request->payment_method,
            'total_price' => $total,
            'status' => 'Paid'
        ]);

        foreach($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' => $item->qty,
                'price' => $item->product->price
            ]);
        }

        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('nota', $order->id);
    }

    public function nota($id) {
        if (!Auth::check()) return redirect()->route('login');
        $order = Order::with('items.product')->where('user_id', Auth::id())->findOrFail($id);
        return view('nota', compact('order'));
    }
}