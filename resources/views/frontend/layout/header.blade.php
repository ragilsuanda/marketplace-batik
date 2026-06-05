<div id="topbar">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="top-contact d-flex flex-wrap">
                <span><i class="fas fa-phone-alt"></i>+1 (800) 123-4567</span>
                <span><i class="fas fa-envelope"></i>hello@sarabfood.com</span>
                <span><i class="fas fa-map-marker-alt"></i>42 Flavor Street, NY</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="ttag"><i class="fas fa-fire me-1"></i>Free Delivery Today!</span>
                <div class="tsoc">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================
         NAVBAR
         ============================================================ -->
<nav class="navbar navbar-expand-lg" id="nav">
    <div class="container">
        <a class="navbar-brand" href="#">
            <div class="blogo">
                <div class="bico">
                    <img src="{{ asset('template/sarab/img/logo.jpg') }}" alt="Logo Batik Serunai">
                </div>
                <div class="bname">Ser<span>unai</span></div>
                <div class="bsub">Rumah Batik</div>
            </div>
    </div>
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
        <i class="fas fa-bars" style="color:var(--primary);font-size:1.35rem;"></i>
    </button>
    <div class="collapse navbar-collapse" id="navmenu">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('shop.index') }}">Koleksi</a></li>
            <li class="nav-item"><a class="nav-link" href="/#about">Tentang</a></li>
            <li class="nav-item"><a class="nav-link" href="/#history">Sejarah</a></li>
            <li class="nav-item"><a class="nav-link" href="/#contact-section">Kontak</a></li>
            @auth
              <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}"><i class="fas fa-history me-1"></i>Pesanan Saya</a></li>
            @endauth
        </ul>
        <div class="d-flex align-items-center gap-2">
            @auth
              {{-- Keranjang --}}
              <a href="{{ route('cart.index') }}" class="nav-link position-relative" style="padding:6px 10px;">
                <i class="fas fa-shopping-cart" style="font-size:1.1rem;"></i>
                @php $cartCount = collect(session('cart', []))->sum('qty'); @endphp
                @if($cartCount > 0)
                  <span style="position:absolute;top:0;right:0;background:var(--primary);color:#fff;border-radius:50%;width:18px;height:18px;font-size:.65rem;display:flex;align-items:center;justify-content:center;font-weight:700;">{{ $cartCount }}</span>
                @endif
              </a>
              {{-- User --}}
              <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                  <i class="fas fa-user me-1"></i>{{ Str::limit(auth()->user()->name, 12) }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="{{ route('orders.index') }}"><i class="fas fa-history me-2"></i>Pesanan Saya</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li>
                    <form action="{{ route('logout') }}" method="POST">
                      @csrf
                      <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                    </form>
                  </li>
                </ul>
              </div>
            @else
              <a href="{{ route('login') }}" class="nav-link nav-cta"><i class="fas fa-sign-in-alt me-1"></i>Login</a>
            @endauth
        </div>
    </div>
    </div>
</nav>

<div id="searchOv">
    <button class="sovclose" id="searchClose"><i class="fas fa-times"></i></button>
    <div class="sovbox">
        <h4>Batik apa yang sedang Anda cari?</h4>
        <div class="sovinput">
            <input type="text" id="searchInput" placeholder="Cari batik tulis, kemeja, dress..."
                autocomplete="off" />
            <button><i class="fas fa-search"></i></button>
        </div>
        <!-- Categories inside search box -->
        <div class="sovcats">
            <div class="sovcat active" data-cat="all">
                <img src="img/menu/1.jpg" alt="Semua Koleksi" />Semua Produk
            </div>
            <div class="sovcat" data-cat="tulis">
                <img src="img/menu/1.jpg" alt="Batik Tulis" />Batik Tulis
            </div>
            <div class="sovcat" data-cat="cap">
                <img src="img/menu/2.jpg" alt="Batik Cap" />Batik Cap
            </div>
            <div class="sovcat" data-cat="kemeja">
                <img src="img/menu/3.jpg" alt="Kemeja Pria" />Kemeja Pria
            </div>
            <div class="sovcat" data-cat="dress">
                <img src="img/menu/4.jpg" alt="Dress Wanita" />Dress Wanita
            </div>
            <div class="sovcat" data-cat="blouse">
                <img src="img/menu/5.jpg" alt="Blouse" />Blouse &amp; Atasan
            </div>
            <div class="sovcat" data-cat="aksesori">
                <img src="img/menu/6.jpg" alt="Aksesori" />Aksesori Etnik
            </div>
        </div>
        <div class="sovtrend">
            <p><i class="fas fa-fire me-1" style="color:var(--secondary);"></i>Pencarian Populer</p>
            <span class="ttag">Batik Tulis Premium</span>
            <span class="ttag">Kemeja Slim Fit</span>
            <span class="ttag">Dress Kondangan</span>
            <span class="ttag">Kain Katun Primis</span>
            <span class="ttag">Batik Kombinasi</span>
            <span class="ttag">Outer Etnik</span>
        </div>
