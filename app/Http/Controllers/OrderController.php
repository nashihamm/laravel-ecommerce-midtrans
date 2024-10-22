<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function sellerIndex()
    {
        $sellerId = Auth::id();
    
        $orders = Order::whereHas('orderItems.product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->with('orderItems.product')->get();
    
        return view('seller.orders.index', compact('orders'));
    }
    
    
    
    
    public function customerIndex()
        {
            $orders = Order::where('user_id', Auth::id())->get();

            return view('orders.index', compact('orders'));
        }

        public function store(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'address' => 'required|string|max:255',
        'message' => 'nullable|string|max:500',
    ]);

    $cart = Cart::where('user_id', $user->id)->first();

    if (!$cart || $cart->cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Keranjang belanja kosong.');
    }

    $totalAmount = 0;
    foreach ($cart->cartItems as $cartItem) {
        $price = $cartItem->product->price;
        
        if ($cartItem->product->discount) {
            $price -= ($price * $cartItem->product->discount / 100);
        }

        $totalAmount += $price * $cartItem->quantity;
    }

    $shippingCost = 10000;
    $totalAmount += $shippingCost;

    $order = Order::create([
        'user_id' => $user->id,
        'status' => 'pending',
        'total_amount' => $totalAmount,
        'shipping_address' => $request->address,
        'message' => $request->message,
    ]);

    foreach ($cart->cartItems as $cartItem) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $cartItem->product_id,
            'quantity' => $cartItem->quantity,
            'price' => $cartItem->product->price,
        ]);
    }

    $cart->cartItems()->delete();

    return redirect()->route('customer.payment.process', ['order_id' => $order->id]);
}

}