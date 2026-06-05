@extends('frontend.layout.app')
@section('title', 'Dampak Bullying')

@section('content')
    <div> 
        <div class="page-title" data-aos="fade">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Artikel - Dampak Bullying</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="home#artikel">Artikel</a></li>
                        <li class="current">Dampak Bullying</li>
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
                            <h4>Kategori Artikel</h4>
                            <div class="services-list">
                                <a href="{{ route('frontend.artikel.apa') }}">Pengertian Bullying</a>
                                <a href="{{ route('frontend.artikel.dampak') }}" class="active">Dampak Bullying</a>
                                <a href="{{ route('frontend.artikel.cara') }}">Cara Mencegah Bullying</a>
                            </div>
                        </div><!-- End Sidebar -->

                        <!-- Gambar di bawah Sidebar -->
                        <div class="mt-4">
                            <img src="{{ asset('landingpage/assets/img/dampak.jpg') }}" alt="Dampak Bullying" class="img-fluid rounded-lg shadow">
                        </div>
                    </div>

                    <!-- Konten Artikel -->
                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                        
                        <h3 class="text">Dampak Bullying</h3>
                        <p>
                            Menurut Suyatno (2003), berikut beberapa dampak negatif yang dialami anak-anak korban bullying.
                        </p>

                        <!-- Dampak terhadap kehidupan individu -->
                        <h4 class="mt-4 text-secondary">1. Dampak terhadap Kehidupan Individu</h4>
                        <ul>
                            <li>Kehilangan motivasi atau harga diri.</li>
                            <li>Problem kesehatan mental seperti kecemasan, gangguan makan, dan susah tidur.</li>
                            <li>Sakit serius dan luka parah seperti patah tulang, lebam, dan sakit kepala berkepanjangan.</li>
                            <li>Gangguan kesehatan seksual seperti risiko penyakit menular seksual dan kehamilan tidak diinginkan.</li>
                            <li>Perubahan perilaku menjadi agresif, pemarah, atau justru pendiam.</li>
                            <li>Kematian akibat kekerasan atau bunuh diri.</li>
                        </ul>

                        <!-- Dampak terhadap kehidupan sosial -->
                        <h4 class="mt-4 text-secondary">2. Dampak terhadap Kehidupan Sosial</h4>
                        <ul>
                            <li>Pewarisan kekerasan lintas generasi di mana korban bullying berisiko menjadi pelaku kekerasan di masa depan.</li>
                            <li>Normalisasi kekerasan karena orang tua menganggap kekerasan terhadap anak sebagai hal wajar.</li>
                            <li>Penurunan kualitas hidup karena korban bullying cenderung menarik diri dari kehidupan sosial.</li>
                        </ul>

                        <!-- Dampak terhadap kehidupan akademik -->
                        <h4 class="mt-4 text-secondary">3. Dampak terhadap Kehidupan Akademik</h4>
                        <ul>
                            <li>Depresi dan agresi, di mana korban mengalami kecemasan berlebihan, ketakutan, atau ledakan emosi di sekolah.</li>
                            <li>Penurunan prestasi akademik karena korban bullying sering mengalami kesulitan belajar dan kehilangan motivasi.</li>
                            <li>Risiko putus sekolah karena korban merasa tidak nyaman dan akhirnya berhenti belajar.</li>
                        </ul>

                    </div>
                </div>
            </div>
        </section><!-- /Artikel Details Section -->
    </div>
@endsection
