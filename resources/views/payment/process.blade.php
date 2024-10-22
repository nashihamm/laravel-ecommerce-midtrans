<x-customer-app>
    <main class="container mx-auto py-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-6 text-center">Proses Pembayaran</h1>

            <p class="text-lg mb-4">Total Pembayaran: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>

            <button id="pay-button" class="bg-blue-500 text-white py-3 px-4 rounded hover:bg-blue-600 font-semibold">
                Bayar Sekarang
            </button>
        </div>
    </main>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    <script type="text/javascript">
        var snapToken = '{{ $snapToken }}';
    
        document.getElementById('pay-button').onclick = function() {
    snap.pay(snapToken, {
        onSuccess: function(result) {
            console.log(result.transaction_status);

            alert("Payment successful!");

            $.post("{{ route('customer.payment.success') }}", {
                _token: "{{ csrf_token() }}",
                order_id: "{{ $order->id }}",
                transaction_id: result.transaction_id,
                payment_type: result.payment_type,
                transaction_status: result.transaction_status,
                gross_amount: result.gross_amount,
                fraud_status: result.fraud_status,
                transaction_time: result.transaction_time
            }, function(response) {
                //redirect ke homepage
                window.location.href = "/";
            });
        },
        onPending: function(result) {
            alert("Waiting for your payment!");
            console.log(result);
        },
        onError: function(result) {
            alert("Payment failed!");
            console.log(result);
        },
        onClose: function() {
            alert('You closed the payment window.');
        }
    });
};

    </script>
    
</x-customer-app>
