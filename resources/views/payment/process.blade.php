<x-customer-app>
    <main class="container mx-auto py-10">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-4 text-center">Proses Pembayaran</h1>

            <p class="mb-4">Total Pembayaran: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>

            <button id="pay-button" class="bg-blue-500 text-white px-4 py-2 rounded">Bayar Sekarang</button>
        </div>
    </main>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        var snapToken = '{{ $snapToken }}';

        payButton.addEventListener('click', function() {
            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    alert("Pembayaran berhasil!");
                    window.location.href = "/";
                },
                onError: function(result) {
                    alert("Pembayaran gagal!");
                },
                onClose: function() {
                    alert("Anda menutup pembayaran tanpa menyelesaikannya.");
                }
            });
        });
    </script>
</x-customer-app>
