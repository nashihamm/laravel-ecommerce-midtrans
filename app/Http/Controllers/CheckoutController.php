<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\OrderItem;
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
    
        // Pastikan ada ID order atau gunakan ID dari $cart
        $order_id = $cart->id;

        // Hapus keranjang setelah proses order selesai
        $cart->cartItems()->delete();
        $cart->delete();
    
        // Passing $cart, $order_id, $cartItems, dan $totalPrice ke view
        return view('checkout.index', compact('cart', 'order_id', 'cartItems', 'totalPrice'));
    }
    


    // public function storeOrder(Request $request)
    // {
    //     // Ambil data keranjang
    //     $cart = Cart::where('user_id', auth()->id())->first();
    //     $cartItems = $cart->cartItems;

    //     // Validasi kuantititi
    //     if ($cartItems->isEmpty()) {
    //         return back()->with('error', 'Tidak ada produk dalam keranjang.');
    //     }

    //     $totalAmount = $cartItems->sum(function ($item) {
    //         return $item->product->price * $item->quantity;
    //     });

    //     $order = Order::create([
    //         'user_id' => auth()->id(),
    //         'total_amount' => $totalAmount,
    //         'address' => $request->input('address'),
    //         'message' => $request->input('message'),
    //     ]);

    //     foreach ($cartItems as $cartItem) {
    //         OrderItem::create([
    //             'order_id' => $order->id,
    //             'product_id' => $cartItem->product_id,
    //             'quantity' => $cartItem->quantity,
    //             'price' => $cartItem->product->price,
    //         ]);
    //     }

    //     $cart->cartItems()->delete();
    //     $cart->delete();

    //     return redirect()->route('customer.payment.process', ['order' => $order->id]);
    // }

    // public function updateCartItem(Request $request, $cartItemId)
    // {
    //     $cartItem = CartItem::findOrFail($cartItemId);
    //     $cartItem->quantity = $request->input('quantity');
    //     $cartItem->save();

    //     return response()->json(['message' => 'Jumlah diperbarui']);
    // }
}
