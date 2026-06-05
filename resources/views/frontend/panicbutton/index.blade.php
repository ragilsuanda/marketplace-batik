@extends('frontend.layout.app')
@section('title', 'Panic Button')

@section('content')

<!-- Panic Button Section -->
<section id="panic-section" class="panic section light-background">

    <!-- Section Title -->
    <div class="container section-title text-center" data-aos="fade-up">
        <h2>🚨 Panic Button</h2>
        <p>Jika Anda dalam keadaan darurat atau membutuhkan bantuan segera, silakan pilih salah satu opsi berikut.</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 justify-content-center">
            
            <!-- Card: Lapor ke Polisi -->
            <div class="col-lg-4 col-md-6">
                <div class="panic-card shadow p-4 text-center">
                    <div class="panic-icon text-danger">
                        <i class="bi bi-shield-exclamation" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="mt-3">Lapor ke Polisi</h4>
                    <p>Jika dalam kondisi darurat, segera hubungi pihak berwajib untuk mendapatkan bantuan.</p>
                    <a href="tel:0761-21110" class="btn btn-danger w-100 mt-2">🚔 Hubungi 0761-21110</a>
                </div>
            </div>

            <!-- Card: Hubungi BK via WhatsApp -->
            <div class="col-lg-4 col-md-6">
                <div class="panic-card shadow p-4 text-center">
                    <div class="panic-icon text-success">
                        <i class="bi bi-whatsapp" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="mt-3">Konsultasi dengan BK</h4>
                    <p>Jika Anda butuh bimbingan dan dukungan, hubungi guru BK melalui WhatsApp.</p>
                    <a href="https://wa.me/085265827324" target="_blank" class="btn btn-success w-100 mt-2">📞 Chat BK Sekolah</a>
                </div>
            </div>

            <!-- Card: Lapor ke Admin -->
            <div class="col-lg-4 col-md-6">
                <div class="panic-card shadow p-4 text-center">
                    <div class="panic-icon text-primary">
                        <i class="bi bi-clipboard-check" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="mt-3">Lapor ke Admin</h4>
                    <p>Laporkan kejadian bullying agar dapat ditindaklanjuti oleh pihak sekolah.</p>
                    <a href="{{ route('reports.create') }}" class="btn btn-primary w-100 mt-2">📝 Buat Laporan</a>
                </div>
            </div>

        </div>

    </div>

</section>

<!-- Styling -->
<style>
    .panic-card {
        background: #fff;
        border-radius: 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .panic-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
    }

    .panic-icon {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 80px;
    }

    .light-background {
        background-color: #f8f9fa;
        padding: 60px 0;
    }
</style>

@endsection
