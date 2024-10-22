<?php
namespace App\Http\Controllers;

            use App\Models\Cart;
            use App\Models\Product;
            use App\Models\CartItem;
            use Illuminate\Http\Request;
            use Illuminate\Support\Facades\DB;
            use Illuminate\Support\Facades\Auth;

            class CartController extends Controller
{
            public function index()
        {
            $cart = Cart::where('user_id', auth()->id())->first();

            if (!$cart) {
                return view('cart.index', ['cartItems' => [], 'totalPrice' => 0, 'totalQuantity' => 0]);
            }

            $cartItems = CartItem::with('product')->where('cart_id', $cart->id)->get();

            $totalPrice = $cartItems->sum(function ($cartItem) {
                return $cartItem->product->price * $cartItem->quantity;
            });

            $totalQuantity = $cartItems->sum('quantity');

            return view('cart.index', compact('cartItems', 'totalPrice', 'totalQuantity'));
        }

                
                

            public function remove($cartItemId)
            {
                $cartItem = CartItem::findOrFail($cartItemId);
                $cartItem->delete();

                return redirect()->back()->with('success', 'Product removed from cart!');
            }



            public function add($productId)
            {
                $product = Product::findOrFail($productId);
            
                $cart = Cart::firstOrCreate([
                    'user_id' => auth()->id(),
                ]);
            
                $cartItem = CartItem::where('cart_id', $cart->id)
                    ->where('product_id', $product->id)
                    ->first();
            
                if ($cartItem) {
                    $cartItem->quantity += 1;
                    $cartItem->save();
                } else {
                    CartItem::create([
                        'cart_id' => $cart->id,
                        'product_id' => $product->id,
                        'quantity' => 1,
                    ]);
                }
            
                // dd($cart);
                // dd($cartItem);

                return redirect()->back()->with('success', 'Product added to cart!');
            }
            
            public function updateQuantity(Request $request, $cartItemId)
            {
                $cartItem = CartItem::findOrFail($cartItemId);
                $newQuantity = $request->input('quantity');
            
                if ($newQuantity < 1) {
                    return response()->json(['error' => 'Quantity must be at least 1'], 400);
                }
            
                $cartItem->quantity = $newQuantity;
                $cartItem->save();
            
                return response()->json(['success' => 'Quantity updated successfully']);
            }
            
}
