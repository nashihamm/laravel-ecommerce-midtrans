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
    public function index()
        {
            $orders = Order::with(['orderItems.product'])->get();

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

            //kalkulasi total harga
            $totalAmount = $cart->cartItems->sum(function ($cartItem) {
                $price = $cartItem->product->price;
                if ($cartItem->product->discount) {
                    $price -=($price * $cartItem->product->dicsount / 100);
                }
                return $price * $cartItem->quantity;
            });

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

            return redirect()->route('customer.checkout.index', ['order_id' => $order->id]);
        }

}