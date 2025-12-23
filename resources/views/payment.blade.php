<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welora - Payment</title>

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

 <section class="checkout-page">
      <form action="{{ route('payment.process') }}" method="POST">
        @csrf
        <input type="hidden" name="total_price" value="{{ $total }}">
        <input type="hidden" name="email" value="{{ Auth::user()->email }}">

        <div class="checkout-layout">
          
          <div class="col-left">
            
            <div class="form-group">
              <h3>Data Pribadi</h3>
              <div class="form-content">
                <input type="text" name="name" placeholder="Your Name" value="{{ Auth::user()->name }}" required />
                <div class="row-2">
                    <input type="email" value="{{ Auth::user()->email }}" disabled style="background: #ccc;" />
                    <input type="tel" name="phone" placeholder="Phone Number" required />
                </div>
              </div>
            </div>

            <div class="form-group">
              <h3>Alamat Pengiriman</h3>
              <div class="form-content">
                <div class="row-2">
                    <input type="text" name="city" placeholder="Kota" required />
                    <input type="text" name="zip" placeholder="Kode Pos" required />
                </div>
                <input type="text" name="address" placeholder="Alamat Lengkap (Jalan, No Rumah, RT/RW)" required style="margin-top: 15px;" />
              </div>
            </div>

            <div class="form-group">
              <h3>Pengiriman</h3>
              <div class="form-content">
                <select name="courier" required>
                    <option value="">Pilih Kurir</option>
                    <option value="JNE">JNE</option>
                    <option value="JNT">J&T</option>
                    <option value="SiCepat">SiCepat</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <h3>Metode Pembayaran</h3>
              <div class="form-content">
                <select name="payment_method" id="payment_method" required onchange="showRekening()">
                    <option value="">Pilih Metode</option>
                    <option value="BCA">BCA</option>
                    <option value="BNI">BNI</option>
                    <option value="Mandiri">Mandiri</option>
                    <option value="OVO">OVO</option>
                    <option value="QRIS">QRIS</option>
                </select>
                <div id="rek-box" style="display:none; margin-top:15px; background:#fff; padding:15px; border-radius:8px; text-align: center; border: 1px solid #ddd;">
                <small style="display:block; margin-bottom:5px;">Silakan scan/transfer ke:</small>
                 <div id="rek-text-wrapper">
                  <h4 id="rek-bank" style="margin:0; color:#555;">BCA</h4>
                 <h3 id="rek-number" style="margin:5px 0 0; color:#000;">123-456-789</h3>
                </div>
                 <img id="qris-image" src="{{ asset('image/qris.jpeg') }}" alt="QRIS Code" style="display:none; max-width: 200px; width: 100%; margin: 10px auto; border-radius: 8px;">
                </div>
              </div>
            </div>

          </div> 
          <div class="col-right">
            <div class="summary-card">
              <h3>Item</h3>
              <hr style="border: 0; border-top: 1px solid #999; margin-bottom: 20px;">
              
              <div class="summary-list">
                @foreach($cartItems as $item)
                <div class="summary-item">
                    <img src="{{ asset('image/gambarproduk/' . $item->product->image) }}">
                    <div class="s-info">
                        <h4>{{ $item->product->name }}</h4>
                        <div class="s-detail">
                            <span>Qty: {{ $item->qty }}</span>
                            <span class="s-price">Rp{{ number_format($item->product->price, 0, ',', ' ') }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
              </div>

              <div class="summary-total">
                <span>Total</span>
                <span>Rp{{ number_format($total) }}</span>
              </div>

              <button type="submit" class="btn-black-block">Buat Pesanan</button>
            </div>
          </div>
          </div>
      </form>
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
    function showRekening() {
    var select = document.getElementById("payment_method");
    var box = document.getElementById("rek-box");
   
    var textWrapper = document.getElementById("rek-text-wrapper");
    var labelBank = document.getElementById("rek-bank");
    var labelNumber = document.getElementById("rek-number");
   
    var imgQris = document.getElementById("qris-image");
    
    var selectedValue = select.value;

    var accounts = {
        'BCA': '8210-9981-2234',
        'BNI': '0981-2345-6789',
        'Mandiri': '133-00-9876543-1',
        'OVO': '0812-3456-7890'
    };

    if (selectedValue === 'QRIS') {
        box.style.display = "block";
        
        textWrapper.style.display = "none";
        
        imgQris.style.display = "block";
        
    } else if (selectedValue && accounts[selectedValue]) {
        box.style.display = "block";
       
        textWrapper.style.display = "block";
        labelBank.innerText = "Bank " + selectedValue;
        labelNumber.innerText = accounts[selectedValue];
       
        imgQris.style.display = "none";
        
    } else {
        box.style.display = "none";
    }
}
    </script>
  </body>
</html>