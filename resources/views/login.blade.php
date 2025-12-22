<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welora - Sign In</title>

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

    <section class="login-page">
      <div class="login-split">
        <div class="login-left">
          <h1>Sign in to</h1>
          <h2>WELORA</h2>
          <p>
            If you dont have an account register <br />
            you can
            <a href="{{ route('register') }}" style="color: blue"> register here !</a>
          </p>
        </div>

        <div class="login-right">
          <h3>Sign in</h3>

          @if ($errors->any())
              <div style="color: red; background: #ffe6e6; padding: 10px; margin-bottom: 15px; border-radius: 5px; text-align: center;">
                  {{ $errors->first('login_error') }}
              </div>
          @endif
          
          @if (session('success'))
              <div style="color: green; background: #e6fffa; padding: 10px; margin-bottom: 15px; border-radius: 5px; text-align: center;">
                  {{ session('success') }}
              </div>
          @endif

          <form class="login-form" action="{{ route('login') }}" method="POST">
            @csrf
            <input type="text" name="username" placeholder="Enter Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit" class="btn-black">Login</button>
          </form>
       </div>
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