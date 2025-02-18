@extends('layouts.frontend')

@section('content')
<section class="payment-section">
    <div class="container">
        <div class="payment-card">
            <h1>Pembayaran Paket Hosting</h1>
            <p>Silakan klik tombol di bawah untuk melakukan pembayaran.</p>
            <button id="pay-button">Bayar Sekarang</button>
        </div>
    </div>
</section>

<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert("Pembayaran berhasil!");
                window.location.href = "{{ route('travel_package.show', $travel_package) }}";
            },
            onPending: function(result) {
                alert("Menunggu pembayaran...");
            },
            onError: function(result) {
                alert("Pembayaran gagal!");
            },
            onClose: function() {
                alert("Anda menutup popup pembayaran.");
            }
        });
    });
</script>

<style>
    .payment-section {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 50vh;
        background: #121212;
        padding-top: 80px;
    }
    .payment-card {
        background: #1e1e1e;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(255, 255, 255, 0.1);
        text-align: center;
        max-width: 400px;
        color: white;
    }
    .payment-card h1, .payment-card p {
        margin-bottom: 20px;
    }
    #pay-button {
        background: #4CAF50;
        color: white;
        border: none;
        padding: 12px 25px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }
    #pay-button:hover {
        background: #45a049;
    }
</style>
@endsection
