<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welora - Cart</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}" />
    <link rel="manifest" href="{{ asset('manifest.json') }}" />
  </head>
  <body>
    <header class="navbar">
      <div class="container nav-container">
        <div class="logo">
          <a href="{{ route('home') }}">
            <span class="logo-text">W | WELORA</span>
          </a>
        </div>
        <nav class="nav-menu">
          <a href="{{ route('home') }}">Home</a>
          <a href="{{ route('home') }}#collection">Collection</a>
          <a href="{{ route('home') }}#about">About</a>
          <a href="{{ route('home') }}#contact">Contact</a>
        </nav>
      </div>
    </header>

    <section class="cart-section">
      <div class="cart-container">
        <div class="cart-header">
          <div class="cart-title-group">
            <span class="cart-label">Cart &nbsp;&nbsp; ({{ count($cartItems) }})</span>
            <div class="cart-line"></div>
          </div>
          <a href="{{ route('home') }}" class="btn-back-circle">
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <line x1="19" y1="12" x2="5" y2="12"></line>
              <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
          </a>
        </div>

        <div class="cart-list">
          @forelse($cartItems as $item)
          <div class="cart-item">
            <div class="cart-img-box">
              <img
                src="{{ asset('image/gambarproduk/' . $item->product->image) }}"
                alt="{{ $item->product->name }}"
              />
            </div>
            <div class="cart-info">
              <h4 class="cart-item-name">{{ $item->product->name }}</h4>
              <div class="qty-control">
                <a href="{{ route('cart.update', ['id' => $item->id, 'action' => 'minus']) }}" class="btn-qty">-</a>
                <span class="qty-value">{{ $item->qty }}</span>
                <a href="{{ route('cart.update', ['id' => $item->id, 'action' => 'plus']) }}" class="btn-qty">+</a>
              </div>
            </div>
            <div class="cart-action-right">
              <span class="item-price">Rp {{ number_format($item->product->price * $item->qty) }}</span>
              <a href="{{ route('cart.delete', $item->id) }}" class="btn-trash">
                <svg
                  width="18"
                  height="18"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <polyline points="3 6 5 6 21 6"></polyline>
                  <path
                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                  ></path>
                </svg>
              </a>
            </div>
          </div>
          @empty
            <p style="text-align: center; margin-bottom: 20px;">Keranjang belanja kamu masih kosong.</p>
          @endforelse
        </div>

        @if(count($cartItems) > 0)
        <div class="checkout-bar">
          <span class="checkout-text">Checkout</span>
          <div class="checkout-right">
            <span class="total-price">Rp {{ number_format($cartItems->sum(fn($i) => $i->product->price * $i->qty)) }}</span>
            <a href="{{ route('payment') }}" class="btn-back-circle">
              <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
              </svg>
            </a>
          </div>
        </div>
        @endif
      </div>
    </section>

    <footer class="footer">
      <div class="container footer-grid">
        <div class="footer-col">
          <h4>Contact</h4>
          <p>hello@welora.com</p>
          <p>+62 82372183217</p>
        </div>
        <div class="footer-col">
          <h4>Menu</h4>
          <a href="{{ route('home') }}">Home</a>
          <a href="{{ route('home') }}#collection">Collection</a>
          <a href="{{ route('home') }}#about">About</a>
        </div>
        <div class="footer-col">
          <h4>Customer Services</h4>
          <a href="#">FAQ</a>
          <a href="#">Returns</a>
          <a href="#">Size Guide</a>
        </div>
        <div class="footer-col">
          <h4>Social Media</h4>
          <a href="#">Instagram</a>
          <a href="#">Twitter</a>
          <a href="#">Facebook</a>
        </div>
      </div>
      <div class="footer-bottom">
        <p>© 2025 Welora. All rights reserved.</p>
      </div>
    </footer>

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