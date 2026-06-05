@extends('frontend.layout.app')
@section('title', 'Cara Mengatasi dan Menangani Bullying')

@section('content')
    <div> 
        <div class="page-title" data-aos="fade">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Artikel - Cara Mengatasi dan Menangani Bullying</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="home#artikel">Artikel</a></li>
                        <li class="current">Cara Mengatasi Bullying</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Artikel Details Section -->
        <section class="artikel-details section py-5">
            <div class="container">
                <div class="row gy-5">
                    
                    <!-- Sidebar -->
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-box">
                            <h6>Kategori Artikel</h6>
                            <div class="services-list">
                                <a href="{{ route('frontend.artikel.apa') }}">Pengertian Bullying</a>
                                <a href="{{ route('frontend.artikel.dampak') }}" class="active">Dampak Bullying</a>
                                <a href="{{ route('frontend.artikel.cara') }}">Cara Mencegah Bullying</a>
                            </div>
                        </div><!-- End Sidebar -->

                        <!-- Gambar di bawah Sidebar -->
                        <div class="mt-4">
                            <img src="{{ asset('landingpage/assets/img/stop.jpg') }}" alt="Cara Mengatasi Bullying" class="img-fluid ">
                        </div>
                    </div>

                    <!-- Konten Artikel -->
                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                        
                        <h4 class="text">Cara Mengatasi Bullying</h4>
                        <p>
                            Menurut Maryam B Gainau dalam buku *Perkembangan Remaja dan Problematikanya*, berikut beberapa cara mengatasi bullying bagi remaja.
                        </p>

                        <!-- Cara Mengatasi Bullying -->
                        <h6 class="mt-4 text-secondary">1. Menciptakan Lingkungan Sekolah yang Aman</h6>
                        <p>Sekolah perlu menciptakan lingkungan yang aman, nyaman, dan sehat bagi siswa. Sekolah juga harus memberikan sanksi tegas kepada pelaku bullying agar tidak terulang kembali.</p>

                        <h6 class="mt-4 text-secondary">2. Penyelesaian Masalah Tanpa Kekerasan</h6>
                        <p>Guru dan orang tua harus mengajarkan anak untuk menyelesaikan masalah melalui musyawarah, bukan dengan kekerasan atau main hakim sendiri.</p>

                        <h6 class="mt-4 text-secondary">3. Menanamkan Nilai Agama dan Moral</h6>
                        <p>Guru harus menanamkan nilai-nilai agama dan moral agar anak bisa saling menghormati dan menghargai teman-temannya.</p>

                        <h6 class="mt-4 text-secondary">4. Konseling untuk Korban</h6>
                        <p>Korban bullying perlu mendapatkan pendekatan konseling agar tidak mengalami trauma berkepanjangan serta tetap percaya diri dalam bersosialisasi.</p>

                        <h6 class="mt-4 text-secondary">5. Kerja Sama antara Guru dan Orang Tua</h6>
                        <p>Guru dan orang tua perlu berkolaborasi dalam menangani kasus bullying dengan pendekatan musyawarah untuk mendapatkan solusi terbaik.</p>

                        <!-- Cara Menangani Jika Menjadi Korban Bullying -->
                        <h4 class="text mt-5">Cara Menangani Jika Menjadi Korban Bullying</h4>
                        <p>
                            Jika Anda mengalami bullying, berikut beberapa langkah yang bisa dilakukan untuk melindungi diri dan mendapatkan bantuan.
                        </p>

                        <h6 class="mt-4 text-secondary">1. Jangan Membalas dengan Kekerasan</h6>
                        <p>Jangan terpancing untuk membalas perbuatan bullying dengan kekerasan. Hal ini hanya akan memperburuk situasi dan membuat Anda berisiko terkena masalah hukum.</p>

                        <h6 class="mt-4 text-secondary">2. Laporkan kepada Orang yang Dapat Dipercaya</h6>
                        <p>Ceritakan kejadian yang Anda alami kepada guru, orang tua, atau teman dekat yang bisa membantu Anda mendapatkan perlindungan dan solusi.</p>

                        <h6 class="mt-4 text-secondary">3. Hindari Situasi yang Berisiko</h6>
                        <p>Jika memungkinkan, hindari tempat atau situasi di mana Anda sering menjadi target bullying. Bersama dengan teman bisa membantu mengurangi risiko diintimidasi.</p>

                        <h6 class="mt-4 text-secondary">4. Simpan Bukti</h6>
                        <p>Jika bullying terjadi secara online atau melalui pesan teks, simpan semua bukti seperti screenshot untuk digunakan sebagai bukti saat melapor.</p>

                        <h6 class="mt-4 text-secondary">5. Tingkatkan Rasa Percaya Diri</h6>
                        <p>Bullying sering menargetkan orang yang tampak lemah atau minder. Membangun rasa percaya diri dan berani berbicara dapat mengurangi kemungkinan menjadi target bullying.</p>

                        <h6 class="mt-4 text-secondary">6. Cari Dukungan</h6>
                        <p>Bergabunglah dengan komunitas atau kelompok pendukung yang dapat memberikan bantuan dan semangat dalam menghadapi bullying.</p>

                        <!-- Hukuman Untuk Perilaku Bullying -->
                        <h6 class="text mt-5">Hukuman untuk Perilaku Bullying</h6>
                        <p>
                            Mengutip BPHN, berikut adalah beberapa ancaman pidana bagi pelaku bullying berdasarkan hukum yang berlaku.
                        </p>

                        <h6 class="mt-4 text-secondary">1. Undang-Undang Perlindungan Anak</h6>
                        <p>Berdasarkan Undang-Undang Nomor 23 Tahun 2022 Pasal 80:</p>
                        <ul>
                            <li>Pelaku kekerasan terhadap anak dapat dipidana penjara paling lama 3 tahun 6 bulan dan/atau denda hingga Rp 72.000.000.</li>
                            <li>Jika korban mengalami luka berat, hukuman meningkat menjadi 5 tahun penjara dan/atau denda Rp 100.000.000.</li>
                            <li>Jika korban meninggal dunia, pelaku dapat dihukum hingga 10 tahun penjara dan/atau denda Rp 200.000.000.</li>
                        </ul>

                        <h6 class="mt-4 text-secondary">2. KUHP Pasal 368 tentang Pemerasan dan Pengancaman</h6>
                        <p>
                            Seseorang yang memaksa orang lain dengan kekerasan atau ancaman untuk memberikan barang atau menghapus utang dapat dihukum hingga 9 tahun penjara.
                        </p>

                        <p class="mt-4">
                            Hukuman bagi pelaku bullying bisa ditambah sepertiganya jika pelaku adalah orang tua korban. Selain itu, kasus bullying bukan termasuk delik aduan, sehingga proses hukum tetap berjalan meskipun tanpa laporan dari korban.
                        </p>

                    </div>
                </div>
            </div>
        </section><!-- /Artikel Details Section -->
    </div>
@endsection
