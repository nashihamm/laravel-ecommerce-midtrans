<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->first();
    
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang belanja Anda kosong.');
        }
    
        $cartItems = $cart->cartItems;
    
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    
        $totalQuantity = $cartItems->sum('quantity');
    
        return view('checkout.index', compact('cartItems', 'totalPrice', 'totalQuantity'));
    }

    public function storeOrder(Request $request)
{
    $cartItems = Cart::where('user_id', auth()->id())->get();
    $totalAmount = 0;

    foreach ($cartItems as $cartItem) {
        $totalAmount += $cartItem->product->price * $cartItem->quantity;
    }

    $order = Order::create([
        'user_id' => auth()->id(),
        'total_amount' => $totalAmount,
        'address' => $request->input('address'),
        'message' => $request->input('message'),
    ]);

    return redirect()->route('payment.process', ['order_id' => $order->id]);
}

}
