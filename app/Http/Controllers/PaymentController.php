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
    \Midtrans\Config::$isProduction = false;
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;

    $params = [
        'transaction_details' => [
            'order_id' => $order->id,
            'gross_amount' => $order->total_amount,
        ],
        'customer_details' => [
            'first_name' => $user->name,
            'email' => $user->email,
        ],
    ];

    try {
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('payment.process', compact('order', 'snapToken'));

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal memproses pembayaran.');
    }
}

public function paymentSuccess(Request $request)
{
    try {
        $order = Order::findOrFail($request->order_id);
        $transaction = Transaction::where('order_id', $order->id)->firstOrFail();

        if ($request->transaction_status === 'settlement') {
            $transaction->update([
                'transaction_id' => $request->transaction_id,
                'payment_type' => $request->payment_type,
                'transaction_status' => 'success',
                'gross_amount' => $request->gross_amount,
                'transaction_time' => $request->transaction_time,
            ]);

            //perbarui status dan riwayat
            $order->status = 'Dibayar';
            $order->addStatusToHistory('Dibayar');
            $order->save();

            foreach ($order->orderItems as $item) {
                $product = $item->product;
                $product->decrement('stock', $item->quantity);
            }

            return response()->json(['success' => true], 200);
        }

        return response()->json(['error' => 'Status transaksi tidak valid.'], 400);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Gagal memproses pembayaran.'], 500);
    }
}

}