<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welora - Nota Pembayaran</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}" />
    <link rel="manifest" href="{{ asset('manifest.json') }}" />
  </head>
  <body class="nota-body">
    <div class="nota-wrapper">
      <div class="page-title">Nota Pembayaran</div>

      <div class="nota-card">
        <div class="success-icon">
          <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="3"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </div>

        <h2>Pesanan Berhasil</h2>
        <p class="order-id">No. Pesanan: {{ $order->order_number }}</p>

        <div class="customer-info-bar">
          <div class="info-col">
            <h5>Name</h5>
            <p>{{ $order->customer_name }}</p>
          </div>
          <div class="info-col">
            <h5>Metode Pembayaran</h5>
            <p>{{ $order->payment_method }}</p>
          </div>
          <div class="info-col">
            <h5>Pengiriman</h5>
            <p>{{ $order->courier }}</p>
          </div>
          <div class="info-col">
            <h5>Alamat</h5>
            <p>{{ $order->address }}</p>
          </div>
        </div>

        <div class="item-list">
          @foreach($order->items as $item)
          <div class="nota-item">
            <div class="item-img">
              <img
                src="{{ asset('image/gambarproduk/' . $item->product->image) }}"
                alt="{{ $item->product->name }}"
              />
            </div>
            <div class="item-details">
              <div class="item-name">{{ $item->product->name }}</div>
              <div class="item-qty">Qty: {{ $item->qty }}</div>
            </div>
            <div class="item-price">Rp {{ number_format($item->price * $item->qty) }}</div>
          </div>
          @endforeach
        </div>

        <div class="total-section">
          <span class="total-label">Total</span>
          <span class="total-amount">Rp {{ number_format($order->total_price) }}</span>
        </div>

        <a href="{{ route('home') }}" class="btn-home">Kembali Ke Halaman Utama</a>

        <div class="copyright-text">© 2025 WELORA - All Rights Reserved</div>
      </div>
    </div>

    <script>
if ("serviceWorker" in navigator) {
        window.addEventListener("load", function() {
          navigator.serviceWorker
            .register("{{ asset('sw.js') }}")
            .then(function(registration) {
              console.log("ServiceWorker registration successful");
            })
            .catch(function(err) {
              console.log("ServiceWorker registration failed: ", err);
            });
        });
      }
    </script>
  </body>
</html>