<?php

namespace App\Http\Controllers;

use Midtrans;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function process($order_id)
    {
        $order = Order::findOrFail($order_id);
        $user = Auth::user();

        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->total_amount,
            ),
            'customer_details' => array(
                'first_name' => $user->name,
                'email' => $user->email,
            ),
        );

        try {
            $snapToken = Snap::getSnapToken($params);

            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->order_id = $order->id;
            $transaction->snap_token = $snapToken;
            $transaction->gross_amount = $order->total_amount;
            $transaction->save();

            return view('payment.process', compact('order', 'snapToken'));

        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memproses pembayaran.');
        }
    }

    public function paymentSuccess(Request $request)
{
    try {
        $order = Order::findOrFail($request->order_id);
        $transaction = Transaction::where('order_id', $order->id)->firstOrFail();

        if ($request->transaction_status === 'success') {
            $transaction->transaction_id = $request->transaction_id;
            $transaction->payment_type = $request->payment_type;
            $transaction->transaction_status = 'success';
            $transaction->gross_amount = $request->gross_amount;
            $transaction->fraud_status = $request->fraud_status;
            $transaction->transaction_time = $request->transaction_time;
            $transaction->save();

            foreach ($order->orderItems as $item) {
                $product = $item->product;
                if ($product->stock >= $item->quantity) {
                    $product->stock -= $item->quantity;
                    $product->save();
                } else {
                    Log::error('Stok tidak mencukupi untuk produk: ' . $product->name);
                    return response()->json(['error' => 'Stok tidak mencukupi'], 400);
                }
            }

            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['error' => 'Status transaksi tidak valid.'], 400);
        }

    } catch (\Exception $e) {
        Log::error('Payment Success Error: ' . $e->getMessage());
        return response()->json(['error' => 'Gagal memproses pembayaran.'], 500);
    }


}



}
