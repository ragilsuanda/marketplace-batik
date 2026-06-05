@extends('frontend.layout.app')
@section('title', 'web bulliying')

@section('content')
    <!-- Hero Section -->
    <section id="hero">
        <div class="hs hs1"></div>
        <div class="hs hs2"></div>
        <div class="hbgtxt">BATIK</div>
        <div class="container">
            <div class="row align-items-center g-5" style="min-height:88vh;">
                <div class="col-lg-6">
                    <div class="hbadge">

                    </div>
                    <h1 class="htitle">Pesona <span class="hl">Batik Nusantara</h1>
                    <p class="hdesc">Rasakan keindahan mahakarya autentik yang dipadukan dengan bahan premium berkualitas
                        tinggi. Dari motif klasik hingga desain modern - setiap helai kain adalah warisan budaya yang
                        berharga.</p>
                    <div class="d-flex flex-wrap gap-3 mb-2">
                        <a href="#menu" class="btn-red"><i class="fas fa-utensils"></i>Explore Menu</a>
                        <!-- FIX 2: Magnific popup video trigger -->
                        <a href="https://www.youtube.com/watch?v=RXv_uIN6e-Y" class="magnific_popup btn-play popup-youtube">
                            <div class="pico"><i class="fas fa-play"></i></div>
                            <span>Watch Our Story</span>
                        </a>
                    </div>
                    <div class="hstats d-flex gap-3 flex-wrap mt-4">
                        <div class="hstat"><span class="snum">850<em>+</em></span><small>Happy Customers</small></div>
                        <div class="sdiv"></div>
                        <div class="hstat"><span class="snum">120<em>+</em></span><small>Menu Items</small></div>
                        <div class="sdiv"></div>
                        <div class="hstat"><span class="snum">15<em>+</em></span><small>Expert Chefs</small></div>
                        <div class="sdiv"></div>
                        <div class="hstat"><span class="snum">12<em>yr</em></span><small>Experience</small></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div style="position:relative;text-align:center;">
                        <div class="hcircle">
                            <img src="{{ asset('template/sarab') }}/img/banner.png" alt="banner" />
                        </div>
                        <div class="fcard fc1">
                            <div class="fcoi r"><i class="fas fa-ribbon"></i></div>
                            <div><span class="fcnum">100% Autentik</span><span class="fcsm">Batik asli berkualitas</span>
                            </div>
                        </div>
                        <div class="fcard fc2">
                            <div class="fcoi y"><i class="fas fa-star"></i></div>
                            <div><span class="fcnum">4.9/5</span><span class="fcsm">2k+ ulasan pelanggan</span></div>
                        </div>
                        <div class="fcard fc3">
                            <div class="fcoi g"><i class="fas fa-thumbs-up"></i></div>
                            <div><span class="fcnum">Bahan Premium</span><span class="fcsm">Nyaman &amp; tidak
                                    luntur</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- MARQUEE -->
    <div class="mqsec">
        <div class="mqtrack">
            <div class="mqitem"><i class="fas fa-circle"></i>Batik Tulis Premium</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Kain Batik Cap</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Kemeja Batik Elegan</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Dress Batik Modern</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Blouse Batik Cantik</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Kain Songket &amp; Tenun</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Aksesori Etnik</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Batik Tulis Premium</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Kain Batik Cap</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Kemeja Batik Elegan</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Dress Batik Modern</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Blouse Batik Cantik</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Kain Songket &amp; Tenun</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Aksesori Etnik</div>
        </div>
    </div>
    <!-- CATEGORY -->
    <section id="category">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">Layanan Kami</span>
                <h2 class="stitle">Telusuri berdasarkan <span>Kategori</span></h2>
                <div class="sline"></div>
                <p class="sdesc mx-auto" style="max-width:480px;">Dari mahakarya batik tulis klasik hingga kombinasi modern
                    yang elegan – temukan motif favorit untuk setiap momen berhargamu.</p>
            </div>
            <div class="row g-3 justify-content-center">
                <div class="col-6 col-sm-4 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="0">
                    <div class="catcard active" data-filter="all">
                        <img class="catimg" src="{{ asset('template/sarab') }}/img/category/1.jpg" alt="" />
                        <div class="catnm">Batik Tumbuhan</div>
                        <div class="catct">99 items</div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="70">
                    <div class="catcard" data-filter="burgers">
                        <img class="catimg" src="{{ asset('template/sarab') }}/img/category/2.jpg" alt="" />
                        <div class="catnm">Burgers</div>
                        <div class="catct">24 items</div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="140">
                    <div class="catcard" data-filter="pizza">
                        <img class="catimg" src="{{ asset('template/sarab') }}/img/category/3.jpg" alt="" />
                        <div class="catnm">Pizza</div>
                        <div class="catct">18 items</div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="210">
                    <div class="catcard" data-filter="chicken">
                        <img class="catimg" src="img/category/4.jpg" alt="" />
                        <div class="catnm">Fried Chicken</div>
                        <div class="catct">15 items</div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="280">
                    <div class="catcard" data-filter="wraps">
                        <img class="catimg" src="{{ asset('template/sarab') }}/img/category/5.jpg" alt="" />
                        <div class="catnm">Wraps</div>
                        <div class="catct">12 items</div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="350">
                    <div class="catcard" data-filter="desserts">
                        <img class="catimg" src="img/category/6.jpg" alt="" />
                        <div class="catnm">Desserts</div>
                        <div class="catct">20 items</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ABOUT -->
    <section id="about">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="astack">
                        <div class="aexp"><span class="anum">14+</span><small>Tahun<br />Berkarya</small></div>
                        <div class="amain"><img src="{{ asset('template/sarab') }}/img/blog/1.png"
                                alt="Koleksi Rumah Batik Serunai" /></div>
                        <div class="asm"><img src="{{ asset('template/sarab') }}/img/blog/2.png"
                                alt="Detail Kain Batik" /></div>
                    </div>
                </div>
                <div class="col-lg-7" data-aos="fade-left">
                    <span class="slbl">Tentang Kami</span>
                    <h2 class="stitle text-start">Mari Jelajahi Keindahan<br /><span>Rumah Batik Serunai</span></h2>
                    <div class="sline lft"></div>
                    <p class="sdesc mb-4"style="text-align: justify;">Berdiri sejak tahun 2012, Rumah Batik Serunai berawal
                        dari sebuah galeri kecil dengan mimpi besar — melestarikan warisan budaya nusantara ke dalam gaya
                        hidup modern. Hari ini, kami bangga dapat menghadirkan karya-karya terbaik bagi para pencinta batik
                        yang menghargai detail keindahan dan kualitas autentik.</p>
                    <div class="mb-4">
                        <div class="fti">
                            <div class="ftico r"><i class="fas fa-palette"></i></div>
                            <div>
                                <h6>100% Kain &amp; Pewarna Premium</h6>
                                <p>Kami menggunakan material katun dan sutra terbaik. Setiap motif diproses dengan teknik
                                    tradisional untuk menghasilkan warna yang tajam dan tahan lama.</p>
                            </div>
                        </div>
                        <div class="fti">
                            <div class="ftico y"><i class="fas fa-cut"></i></div>
                            <div>
                                <h6>Jahitan Rapi &amp; Pola Presisi</h6>
                                <p>Setiap pakaian dirancang oleh penjahit ahli dengan potongan yang pas di badan, memastikan
                                    motif batik tersambung dengan rapi (simetris).</p>
                            </div>
                        </div>
                        <div class="fti">
                            <div class="ftico g"><i class="fas fa-heart"></i></div>
                            <div>
                                <h6>Desain Eksklusif &amp; Nyaman</h6>
                                <p>Memadukan unsur etnik klasik dan tren modern. Menghasilkan pakaian yang tidak hanya
                                    elegan untuk acara formal, tapi juga nyaman dipakai harian.</p>
                            </div>
                        </div>
                    </div>
                    <a href="#menu" class="btn-red"><i class="fas fa-th-large"></i>Lihat Koleksi Lengkap</a>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================
                                                                                     MENU � FIX 3 (filter works) + FIX 4 (plus opens popup)
                                                                                     ============================================================ -->


    <!-- ============================================================
                                                                                     FIX 4 � MENU DETAIL POPUP MODAL
                                                                                     ============================================================ -->
    <div id="menuPop">
        <div class="mpbox">
            <button class="mpclose" id="mpClose"><i class="fas fa-times"></i></button>
            <div class="mpimg"><img id="mpImg" src="" alt="" /></div>
            <div class="mpbody">
                <div id="mpCat"></div>
                <div id="mpTitle"></div>
                <div id="mpStars"></div>
                <div id="mpDesc"></div>
                <div id="mpPrice"></div>
                <div class="mpmeta" id="mpMeta"></div>
                <div class="mpqty">
                    <button class="mpqbtn" id="mpMinus">-</button>
                    <span class="mpqnum" id="mpQnum">1</span>
                    <button class="mpqbtn" id="mpPlus">+</button>
                    <span style="font-size:.82rem;color:#aaa;margin-left:9px;">portion</span>
                </div>
                <div class="mptags" id="mpTags"></div>
                <button class="mpaddcart" id="mpAddCart"><i class="fas fa-shopping-cart"></i>Add to Cart</button>
            </div>
        </div>
    </div>
    <!-- SPECIAL OFFER -->


    <!-- ============================================================
                                                                                     GALLERY � FIX 7 (click opens detail popup)
                                                                                     ============================================================ -->

    <!-- FIX 7 � GALLERY POPUP -->
    <div id="galPop">
        <div class="gpbox">
            <button class="gpclose" id="gpClose"><i class="fas fa-times"></i></button>
            <img id="gpImg" src="" alt="" />
            <div class="gpcap">
                <h5 id="gpTitle"></h5>
                <p id="gpDesc"></p>
            </div>
            <div class="gpnav">
                <button id="gpPrev"><i class="fas fa-chevron-left me-1"></i>Prev</button>
                <button id="gpNext">Next <i class="fas fa-chevron-right ms-1"></i></button>
            </div>
        </div>
    </div>


    <!-- ============================================================
                                                                                     HISTORY � FIX 8 (alternating left/right text)
                                                                                     ============================================================ -->
    <section id="history">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">Perjalanan Kami</span>
                <h2 class="stitle">Sejarah <span>Rumah Batik Serunai</span></h2>
                <div class="sline"></div>
                <p class="sdesc mx-auto" style="max-width:480px;">Dari kecintaan pada budaya lokal hingga menjadi galeri
                    batik pilihan — setiap lembar kain menyimpan cerita dedikasi kami.</p>
            </div>
            <div class="timeline" data-aos="fade-up">
                <!-- ODD — teks di KIRI -->
                <div class="tli">
                    <div class="tl-left">
                        <div class="tlyear">2012</div>
                        <h5>Awal Mula Langkah</h5>
                        <p>Rumah Batik Serunai memulai perjalanan dari sebuah galeri rumahan kecil. Fokus pada produksi
                            batik tulis tradisional dengan mempertahankan keaslian teknik canting manual.</p>
                    </div>
                    <div class="tl-center">
                        <div class="tldot"></div>
                    </div>
                    <div class="tl-right">
                        <div class="tlyear">2012</div>
                        <h5>Awal Mula Langkah</h5>
                        <p>Rumah Batik Serunai memulai perjalanan dari sebuah galeri rumahan kecil. Fokus pada produksi
                            batik tulis tradisional dengan mempertahankan keaslian teknik canting manual.</p>
                    </div>
                </div>
                <!-- EVEN — teks di KANAN -->
                <div class="tli">
                    <div class="tl-left">
                        <div class="tlyear">2016</div>
                        <h5>Inovasi Motif &amp; Desain</h5>
                        <p>Mulai memadukan motif klasik dengan sentuhan modern. Kami memperkenalkan lini pakaian siap pakai
                            (ready-to-wear) yang nyaman untuk anak muda dan pekerja kantoran.</p>
                    </div>
                    <div class="tl-center">
                        <div class="tldot"></div>
                    </div>
                    <div class="tl-right">
                        <div class="tlyear">2016</div>
                        <h5>Inovasi Motif &amp; Desain</h5>
                        <p>Mulai memadukan motif klasik dengan sentuhan modern. Kami memperkenalkan lini pakaian siap pakai
                            (ready-to-wear) yang nyaman untuk anak muda dan pekerja kantoran.</p>
                    </div>
                </div>
                <!-- ODD — teks di KIRI -->
                <div class="tli">
                    <div class="tl-left">
                        <div class="tlyear">2021</div>
                        <h5>Apresiasi &amp; Pameran Budaya</h5>
                        <p>Produk kami mulai dikenal di berbagai ajang pameran kebudayaan tingkat nasional, memperkuat
                            posisi kami sebagai salah satu pelestari keindahan batik nusantara.</p>
                    </div>
                    <div class="tl-center">
                        <div class="tldot"></div>
                    </div>
                    <div class="tl-right">
                        <div class="tlyear">2021</div>
                        <h5>Apresiasi &amp; Pameran Budaya</h5>
                        <p>Produk kami mulai dikenal di berbagai ajang pameran kebudayaan tingkat nasional, memperkuat
                            posisi kami sebagai salah satu pelestari keindahan batik nusantara.</p>
                    </div>
                </div>
                <!-- EVEN — teks di KANAN -->
                <div class="tli">
                    <div class="tl-left">
                        <div class="tlyear">2026</div>
                        <h5>Ekspansi ke Pasar Digital</h5>
                        <p>Kini hadir dengan layanan online yang menjangkau seluruh Indonesia. Kami berkomitmen untuk terus
                            menghadirkan batik premium yang membawa kebanggaan di setiap momen Anda.</p>
                    </div>
                    <div class="tl-center">
                        <div class="tldot"></div>
                    </div>
                    <div class="tl-right">
                        <div class="tlyear">2026</div>
                        <h5>Ekspansi ke Pasar Digital</h5>
                        <p>Kini hadir dengan layanan online yang menjangkau seluruh Indonesia. Kami berkomitmen untuk terus
                            menghadirkan batik premium yang membawa kebanggaan di setiap momen Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- BLOG -->
    <section id="blog">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">Wawasan &amp; Artikel</span>
                <h2 class="stitle">Blog <span>Terbaru</span> Kami</h2>
                <div class="sline"></div>
            </div>
            <div class="row g-4">
                <!-- Artikel 1 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="blcard">
                        <div class="blimg">
                            <img src="{{ asset('template/sarab') }}/img/blog/1.png" alt="Mengenal Batik Tulis" />
                            <div class="bldatebdg"><span class="bd">14</span><span class="bm">Mar</span></div>
                        </div>
                        <div class="blbody">
                            <div class="bltag">Edukasi Budaya</div>
                            <div class="bltit"><a href="#">Menilik Proses Pembuatan Batik Tulis Autentik yang
                                    Bernilai Tinggi</a></div>
                            <div class="blmeta"><span><i class="fas fa-user"></i>Admin Serunai</span><span><i
                                        class="fas fa-comment"></i>24 Komentar</span></div>
                            <a href="#" class="blmore">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Artikel 2 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="80">
                    <div class="blcard">
                        <div class="blimg">
                            <img src="{{ asset('template/sarab') }}/img/blog/2.png" alt="Tips Fashion Batik" />
                            <div class="bldatebdg"><span class="bd">28</span><span class="bm">Feb</span></div>
                        </div>
                        <div class="blbody">
                            <div class="bltag">Tren Fashion</div>
                            <div class="bltit"><a href="#">Tips Padupadan Kain Batik Modern untuk Tampilan Kasual
                                    Sehari-hari</a>
                            </div>
                            <div class="blmeta"><span><i class="fas fa-user"></i>Siti Lestari</span><span><i
                                        class="fas fa-comment"></i>18 Komentar</span></div>
                            <a href="#" class="blmore">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Artikel 3 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="160">
                    <div class="blcard">
                        <div class="blimg">
                            <img src="{{ asset('template/sarab') }}/img/blog/3.png" alt="Sejarah Motif Batik" />
                            <div class="bldatebdg"><span class="bd">05</span><span class="bm">Jan</span></div>
                        </div>
                        <div class="blbody">
                            <div class="bltag">Filosofi Motif</div>
                            <div class="bltit"><a href="#">Makna Mendalam di Balik Keindahan Ragam Motif Batik
                                    Nusantara</a></div>
                            <div class="blmeta"><span><i class="fas fa-user"></i>Rian Budaya</span><span><i
                                        class="fas fa-comment"></i>32 Komentar</span></div>
                            <a href="#" class="blmore">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NEWSLETTER -->
    {{-- <section id="newsletter">
         <div class="nlbg"></div>
         <div class="container">
            <div class="nlw text-center" data-aos="zoom-in">
               <span class="slbl" style="color:rgba(255,255,255,.7);">Stay Connected</span>
               <h2 class="mb-3" style="color:#fff;">Subscribe &amp; Get Exclusive <span style="color:var(--secondary);">Deals</span></h2>
               <p class="mb-4" style="color:rgba(255,255,255,.78);">Get 15% off your first order plus early access to new menu items</p>
               <div class="nl-form-wrap">
                  <input class="nlinput" type="email" id="nlEmail" placeholder="Enter your email address..."/>
                  <button class="nlbtn" id="nlBtn"><i class="fas fa-paper-plane me-1"></i>Subscribe</button>
               </div>
               <p style="color:rgba(255,255,255,.45);font-size:.76rem;margin-top:11px;"><i class="fas fa-lock me-1"></i>No spam, unsubscribe anytime.</p>
            </div>
         </div>
      </section> --}}

    <!-- ============================================================
                                                                                     FIX 6 � CONTACT FORM
                                                                                     ============================================================ -->
    <section id="contact-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">Hubungi Kami</span>
                <h2 class="stitle">Kontak <span>Kami</span></h2>
                <div class="sline"></div>
                <p class="sdesc mx-auto" style="max-width:480px;">Punya pertanyaan mengenai koleksi kami, pesanan khusus
                    kustom batik, atau kerja sama? Kami siap membantu Anda.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-right">
                    <div class="ctdark">
                        <h4>Mari Berdiskusi</h4>
                        <p class="ctsub">Kami biasanya merespons dalam waktu 2 jam selama jam operasional kerja.</p>
                        <div class="ctitem">
                            <div class="cticon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="ctinfo"><strong>Alamat</strong><span>Jl. Flavor Street No. 42,<br />Jakarta Pusat,
                                    DKI Jakarta</span></div>
                        </div>
                        <div class="ctitem">
                            <div class="cticon"><i class="fas fa-phone-alt"></i></div>
                            <div class="ctinfo"><strong>Telepon</strong><span>+1 (800) 123-4567</span></div>
                        </div>
                        <div class="ctitem">
                            <div class="cticon"><i class="fas fa-envelope"></i></div>
                            <div class="ctinfo"><strong>Email</strong><span>hello@sarabfood.com</span></div>
                        </div>
                        <div class="ctitem">
                            <div class="cticon"><i class="fas fa-clock"></i></div>
                            <div class="ctinfo"><strong>Jam Operasional</strong><span>Rabu - Minggu: 09:00 - 23:00</span>
                            </div>
                        </div>
                        <div class="ctsocrow">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8" data-aos="fade-left">
                    <div class="fcard">
                        <div class="row g-3">
                            <div class="col-sm-6"><label class="flbl">Nama Lengkap *</label><input type="text"
                                    class="fctrl" placeholder="Budi Santoso" /></div>
                            <div class="col-sm-6"><label class="flbl">Alamat Email *</label><input type="email"
                                    class="fctrl" placeholder="budi@email.com" /></div>
                            <div class="col-sm-6"><label class="flbl">Nomor Telepon / WA</label><input type="tel"
                                    class="fctrl" placeholder="081234567890" /></div>
                            <div class="col-sm-6">
                                <label class="flbl">Subjek *</label>
                                <select class="fctrl">
                                    <option>Pertanyaan Umum</option>
                                    <option>Pesanan Khusus / Seragam Batik</option>
                                    <option>Kemitraan & Reseller</option>
                                    <option>Kritik & Saran</option>
                                    <option>Media & Kerja Sama Kreatif</option>
                                </select>
                            </div>
                            <div class="col-12"><label class="flbl">Pesan Anda *</label>
                                <textarea class="fctrl" rows="5" placeholder="Tuliskan pesan Anda di sini..."></textarea>
                            </div>
                            <div class="col-12"><button class="btn-red" id="ctcBtn"><i
                                        class="fas fa-paper-plane"></i>Kirim Pesan</button></div>
                        </div>
                        <div class="sucmsg" id="ctcOk">
                            <i class="fas fa-check-circle"></i>
                            <p>Pesan berhasil dikirim! Kami akan segera membalas dalam waktu 2 jam.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
