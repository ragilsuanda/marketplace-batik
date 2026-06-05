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
                  <li class="nav-item"><a class="nav-link active" href="#hero">Home</a></li>
                  <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                  <li class="nav-item"><a class="nav-link" href="#menu">Menu</a></li>
                  <li class="nav-item"><a class="nav-link" href="#chefs">Chefs</a></li>
                  <li class="nav-item"><a class="nav-link" href="#reservation">Reservation</a></li>
                  <li class="nav-item"><a class="nav-link" href="#testimonials">Reviews</a></li>
                  <li class="nav-item"><a class="nav-link" href="#contact-section">Contact</a></li>
               </ul>
               <div class="d-flex align-items-center gap-1">
                  <!-- FIX 1: Search button -->
                  <button id="navSearchBtn" title="Search"><i class="fas fa-search"></i></button>
                  <a href="#menu" class="nav-link nav-cta"><i class="fas fa-shopping-bag me-1"></i>Order Now</a>
               </div>
            </div>
         </div>
      </nav>

<div id="searchOv">
         <button class="sovclose" id="searchClose"><i class="fas fa-times"></i></button>
         <div class="sovbox">
            <h4>Batik apa yang sedang Anda cari?</h4>
            <div class="sovinput">
               <input type="text" id="searchInput" placeholder="Cari batik tulis, kemeja, dress..." autocomplete="off"/>
               <button><i class="fas fa-search"></i></button>
            </div>
            <!-- Categories inside search box -->
            <div class="sovcats">
               <div class="sovcat active" data-cat="all">
                  <img src="img/menu/1.jpg" alt="Semua Koleksi"/>Semua Produk
               </div>
               <div class="sovcat" data-cat="tulis">
                  <img src="img/menu/1.jpg" alt="Batik Tulis"/>Batik Tulis
               </div>
               <div class="sovcat" data-cat="cap">
                  <img src="img/menu/2.jpg" alt="Batik Cap"/>Batik Cap
               </div>
               <div class="sovcat" data-cat="kemeja">
                  <img src="img/menu/3.jpg" alt="Kemeja Pria"/>Kemeja Pria
               </div>
               <div class="sovcat" data-cat="dress">
                  <img src="img/menu/4.jpg" alt="Dress Wanita"/>Dress Wanita
               </div>
               <div class="sovcat" data-cat="blouse">
                  <img src="img/menu/5.jpg" alt="Blouse"/>Blouse &amp; Atasan
               </div>
               <div class="sovcat" data-cat="aksesori">
                  <img src="img/menu/6.jpg" alt="Aksesori"/>Aksesori Etnik
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