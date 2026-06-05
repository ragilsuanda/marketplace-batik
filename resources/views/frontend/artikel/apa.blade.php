@extends('frontend.layout.app')
@section('title', 'Web Bullying')

@section('content')
    <div> <!-- Menambahkan padding atas -->
        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Artikel - Pengertian Bullying</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="home#artikel">Artikel</a></li>
                        <li class="current">Pengertian Bullying</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <!-- Artikel Details Section -->
        <section id="artikel-details" class="artikel-details section">
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
                            <img src="{{ asset('landingpage/assets/img/buli.jpg') }}" alt="Dampak Bullying" class="img-fluid rounded-lg shadow">
                        </div>
                    </div>

                    <!-- Konten Artikel -->
                    <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200">
                        <h3>Apa Itu Bullying?</h3>
                        <p>
                            Bullying merupakan salah satu tindakan tidak terpuji yang merugikan korbannya bahkan hingga mempengaruhi kesehatan psikisnya. 
                            Parahnya, kasus bullying juga kerap ditemukan di sekolah. Salah satu contoh bullying yaitu menjauhi atau mengucilkan teman di sekolah. 
                            Dengan melakukan hal ini, teman yang dijauhi akan merasa sedih, tertekan, dan merasa tidak nyaman bahkan minder.
                        </p>
                        <p>
                            Penting diketahui bahwa anak korban bullying ini mendapat perlindungan Undang-Undang. Kamu bisa terancam pidana jika nekat melakukan bullying. 
                            Simak penjelasan tentang bullying, penyebab, dan cara mengatasinya di bawah ini!
                        </p>

                        <h4>Pengertian Bullying</h4>
                        <p>
                            Bullying merupakan segala bentuk penindasan atau kekerasan yang dilakukan dengan sengaja oleh satu orang atau sekelompok orang yang lebih kuat atau berkuasa terhadap orang lain, 
                            dengan tujuan untuk menyakiti dan dilakukan secara terus menerus.
                        </p>
                        <p>
                            Menurut Unicef, bullying bisa diidentifikasi lewat tiga karakteristik yaitu disengaja (untuk menyakiti), terjadi secara berulang-ulang, dan ada perbedaan kekuasaan. 
                            Bullying bisa terjadi secara langsung atau online.
                        </p>

                        <h4>Jenis-Jenis Bullying</h4>
                        <ul>
                            <li><i class="bi bi-check-circle"></i> <strong>Kontak Fisik Langsung:</strong> Memukul, mendorong, menampar, mencubit, mencakar, meludahi, dsb.</li>
                            <li><i class="bi bi-check-circle"></i> <strong>Kontak Verbal Langsung:</strong> Julukan nama, celaan, fitnah, merendahkan, gosip negatif.</li>
                            <li><i class="bi bi-check-circle"></i> <strong>Perilaku Nonverbal Langsung:</strong> Mengejek, melihat sinis, menampilkan ekspresi merendahkan.</li>
                            <li><i class="bi bi-check-circle"></i> <strong>Perilaku Nonverbal Tidak Langsung:</strong> Mengucilkan, mendiamkan seseorang, menyebarkan gosip.</li>
                            <li><i class="bi bi-check-circle"></i> <strong>Cyber Bullying:</strong> Intimidasi melalui media sosial, pencemaran nama baik.</li>
                            <li><i class="bi bi-check-circle"></i> <strong>Pelecehan Seksual:</strong> Bisa berupa agresi fisik maupun verbal.</li>
                        </ul>

                        <h4>Penyebab Bullying</h4>
                        <p>Menurut penelitian, faktor-faktor penyebab terjadinya bullying antara lain:</p>
                        <ul>
                            <li><i class="bi bi-check-circle"></i> <strong>Keluarga:</strong> Anak yang tumbuh dalam lingkungan keluarga bermasalah lebih rentan menjadi pelaku bullying.</li>
                            <li><i class="bi bi-check-circle"></i> <strong>Sekolah:</strong> Lingkungan sekolah yang tidak peduli terhadap bullying dapat memperburuk situasi.</li>
                            <li><i class="bi bi-check-circle"></i> <strong>Kelompok Sebaya:</strong> Anak-anak sering melakukan bullying untuk membuktikan diri di hadapan teman-temannya.</li>
                            <li><i class="bi bi-check-circle"></i> <strong>Kondisi Sosial:</strong> Faktor kemiskinan atau lingkungan sosial yang keras juga dapat memicu bullying.</li>
                            <li><i class="bi bi-check-circle"></i> <strong>Media:</strong> Tayangan televisi atau konten yang mengandung kekerasan dapat mempengaruhi perilaku anak.</li>
                        </ul>

                    </div>

                </div>
            </div>
        </section><!-- /Artikel Details Section -->
    </div>
@endsection
