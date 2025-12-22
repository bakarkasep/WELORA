<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welora - Fashion Store</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500&display=swap"
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
          <a href="#home">Home</a>
          <a href="#collection">Collection</a>
          <a href="#about">About</a>
          <a href="#contact">Contact</a>

          @if(Auth::check())
             <div style="display: inline-flex; align-items: center; margin-left: 15px; gap: 10px;">
                 <span style="font-weight: 600; color: #333; font-family: 'Poppins', sans-serif;">
                    Hi, {{ Auth::user()->name }}
                 </span>
                 
                 <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                     @csrf
                     <button type="submit" style="background:none; border:none; cursor:pointer; color: #cc0000; font-size: 0.8rem; font-weight: 600;">(LOGOUT)</button>
                 </form>
             </div>
          @else
             <a href="{{ route('login') }}" style="font-weight: 600;">Sign in</a>
          @endif
        </nav>

        <div class="nav-icons">
          <a href="{{ route('cart') }}" style="font-weight: 600;" >
            Cart
          </a>
        </div>
      </div>
    </header>

    <section id="home" class="hero">
      <div class="container">
        <div class="hero-wrapper">
          <img
            src="{{ asset('image/image 4.png') }}"
            alt="Welora Store Interior"
            class="hero-img"
          />
        </div>
      </div>
    </section>

    <section id="collection" class="category-summary">
      <div class="container text-center">
        <h2 class="section-title">Collection</h2>
        <div class="cat-grid">
          <div class="cat-card">
            <h3>Women</h3>
            <p>Temukan gaya feminin dan elegan.</p>
            <a href="#women" class="btn-black">Lihat Produk</a>
          </div>
          <div class="cat-card">
            <h3>Men</h3>
            <p>Busana pria modern dan kasual.</p>
            <a href="#men" class="btn-black">Lihat Produk</a>
          </div>
          <div class="cat-card">
            <h3>Unisex</h3>
            <p>Gaya nyaman untuk semua.</p>
            <a href="#unisex" class="btn-black">Lihat Produk</a>
          </div>
        </div>
      </div>
    </section>

    <section id="women" class="product-section">
      <div class="container section-box">
        <h2 class="category-title">Women</h2>
        <div class="product-grid">
          @foreach($women as $product)
          <div class="product-card">
            <div class="p-image">
              <img src="{{ asset('image/gambarproduk/' . $product->image) }}" alt="{{ $product->name }}" />
            </div>
            <div class="p-info">
              <h4>{{ $product->name }}</h4>
              <div class="rating">★★★★★</div>
              <p class="price">Rp {{ number_format($product->price) }}</p>
              <a href="{{ route('add.cart', $product->id) }}">
                  <button class="btn-shop">Add to Cart</button>
              </a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    <section id="men" class="product-section">
      <div class="container section-box">
        <h2 class="category-title">Men</h2>
        <div class="product-grid">
          @foreach($men as $product)
          <div class="product-card">
            <div class="p-image">
              <img src="{{ asset('image/gambarproduk/' . $product->image) }}" alt="{{ $product->name }}" />
            </div>
            <div class="p-info">
              <h4>{{ $product->name }}</h4>
              <div class="rating">★★★★★</div>
              <p class="price">Rp {{ number_format($product->price) }}</p>
              <a href="{{ route('add.cart', $product->id) }}">
                  <button class="btn-shop">Add to Cart</button>
              </a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    <section id="unisex" class="product-section">
      <div class="container section-box">
        <h2 class="category-title">Unisex</h2>
        <div class="product-grid">
          @foreach($unisex as $product)
          <div class="product-card">
            <div class="p-image">
              <img src="{{ asset('image/gambarproduk/' . $product->image) }}" alt="{{ $product->name }}" />
            </div>
            <div class="p-info">
              <h4>{{ $product->name }}</h4>
              <div class="rating">★★★★★</div>
              <p class="price">Rp {{ number_format($product->price) }}</p>
              <a href="{{ route('add.cart', $product->id) }}">
                  <button class="btn-shop">Add to Cart</button>
              </a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    <section id="about" class="about-section">
      <div class="container section-box about-box">
        <div class="about-logo">
          <h1>W</h1>
          <span>Welora Group</span>
        </div>
        <div class="about-text">
          <h3>ABOUT WELORA</h3>
          <p>
            WELORA menyuguhkan website resmi yang dirancang untuk menghadirkan
            pengalaman berbelanja yang lebih mudah, nyaman, dan informatif.
          </p>
          <p>
            Kami mengutamakan kualitas desain, pemilihan material, serta detail
            pada setiap produk.
          </p>
        </div>
      </div>
    </section>

    <footer id="contact" class="footer">
      <div class="container footer-grid">
        <div class="footer-col">
          <h4>Contact</h4>
          <p>hello@welora.com</p>
          <p>+62 82372183217</p>
        </div>
        <div class="footer-col">
          <h4>Menu</h4>
          <a href="{{ route('home') }}">Home</a>
          <a href="#collection">Collection</a>
          <a href="#about">About</a>
        </div>
        <div class="footer-col">
          <h4>Social Media</h4>
          <a href="https://www.instagram.com/">Instagram</a>
          <a href="https://x.com/?lang=en-id">Twitter</a>
          <a href="https://www.facebook.com/">Facebook</a>
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