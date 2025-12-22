<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welora - Register</title>

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
          <h1>Register to</h1>
          <h2>WELORA</h2>
          <p>
            If you already have an account <br />
            you can
            <a href="{{ route('login') }}" style="color: blue"> Login here !</a>
          </p>
        </div>

        <div class="login-right">
          <h3>Sign up</h3>

          <form class="login-form" action="{{ route('register') }}" method="POST">
            @csrf
            <input type="text" name="username" placeholder="Enter username" required />
            <input type="text" name="email" placeholder="Enter Email" required />
            <input type="password" name="password" placeholder="Enter Password" required />
            <button type="submit" class="btn-black">Register</button>
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