@extends('frontend.layout.app')
@section('title', 'Kuesioner Bullying')

@section('content')

<!-- Kuesioner Bullying -->
<section id="quiz" class="features section">
    <div class="container section-title text-center" data-aos="fade-up">
        <h2>Kuesioner Bullying</h2>
        <p>Jawablah pertanyaan berikut untuk mengetahui tingkat bullying yang Anda alami.</p>
    </div>

    <div class="container">
        @if(session('message'))
        <!-- Hasil Kuesioner -->
        <div class="container mt-5">
            <div class="alert alert-info text-center">
                <h5>Hasil Kuesioner</h5>
                <p>{{ session('message') }}</p>
            </div>
            <div class="text-center">
                @if(session('category') === 'tidak terkena bully')
                @elseif(session('category') === 'ringan')
                    <a href="/home#artikel" class="btn btn-primary">Baca Artikel atau Konsultasi dengan BK</a>
                @elseif(session('category') === 'menengah')
                    <a href="/reports/create" class="btn btn-warning">Laporkan ke Admin</a>
                    @else
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <a href="tel:110" class="btn btn-danger">Laporkan ke Polisi</a>
                        <a href="/reports/create" class="btn btn-info">Laporkan ke Admin atau BK</a>
                    </div>
                @endif
            </div>
        </div>
        @else
        <!-- Form Kuesioner -->
        <form id="quizForm" action="{{ route('quiz.process') }}" method="POST">
            @csrf

            @php
                $questions = [
                    [
                        "question" => "Seberapa sering Anda mengalami ejekan atau hinaan dari orang lain?",
                        "options" => ["Tidak Pernah", "Jarang", "Kadang-kadang", "Sering", "Setiap Hari"]
                    ],
                    [
                        "question" => "Bagaimana perasaan Anda setelah menerima perlakuan negatif dari orang lain?",
                        "options" => ["Tidak pernah mengalami", "Biasa saja", "Sedikit terganggu", "Sangat sedih", "Trauma dan ketakutan"]
                    ],
                    [
                        "question" => "Apakah Anda pernah mendapatkan ancaman secara verbal atau fisik?",
                        "options" => ["Tidak pernah", "Sekali", "Beberapa kali", "Sering", "Sangat sering"]
                    ],
                    [
                        "question" => "Apakah Anda pernah mengalami pelecehan secara fisik (dipukul, didorong, dll)?",
                        "options" => ["Tidak pernah", "Sekali", "Beberapa kali", "Sering", "Sangat sering"]
                    ],
                    [
                        "question" => "Apakah ada seseorang yang menyebarkan rumor buruk tentang Anda?",
                        "options" => ["Tidak pernah", "Jarang", "Kadang-kadang", "Sering", "Selalu"]
                    ],
                    [
                        "question" => "Bagaimana teman-teman Anda bereaksi saat Anda mengalami situasi tidak menyenangkan?",
                        "options" => ["Tidak pernah terjadi", "Membantu saya", "Tidak peduli", "Malah ikut mengejek", "Menghindari saya"]
                    ],
                    [
                        "question" => "Apakah pengalaman ini berdampak pada prestasi akademik atau pekerjaan Anda?",
                        "options" => ["Tidak pernah", "Sedikit terganggu", "Prestasi menurun", "Sangat terpengaruh", "Terpaksa berhenti"]
                    ],
                    [
                        "question" => "Seberapa sering Anda mengalami bullying di media sosial?",
                        "options" => ["Tidak pernah", "Jarang", "Kadang-kadang", "Sering", "Setiap hari"]
                    ],
                    [
                        "question" => "Apakah Anda merasa aman di lingkungan sekolah atau tempat kerja?",
                        "options" => ["Sangat aman", "Cukup aman", "Kadang merasa takut", "Sering merasa tidak aman", "Selalu merasa terancam"]
                    ],
                    [
                        "question" => "Apakah Anda pernah melaporkan kejadian bullying yang Anda alami?",
                        "options" => ["Tidak pernah terjadi", "Sekali", "Beberapa kali", "Sering melaporkan", "Tidak berani melapor"]
                    ]
                ];
            @endphp

            <!-- Progress Bar -->
            <div class="progress mb-4">
                <div id="progressBar" class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <!-- Pertanyaan -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    @foreach($questions as $index => $data)
                    <div class="quiz-question" id="question-{{ $index }}" style="{{ $index == 0 ? 'display: block;' : 'display: none;' }}">
                        <h6 class="fw-bold">{{ ($index + 1) . '. ' . $data["question"] }}</h6>

                        @foreach($data["options"] as $key => $option)
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="answers[{{ $index }}]" value="{{ $key + 1 }}" required>
                            <label class="form-check-label">{{ $option }}</label>
                        </div>
                        @endforeach

                        <div class="text-center mt-3">
                            @if ($index < count($questions) - 1)
                                <button type="button" class="btn btn-primary next-btn" data-next="{{ $index + 1 }}">Selanjutnya</button>
                            @else
                                <button type="submit" id="submitBtn" class="btn btn-success w-100 mt-4">Selesai</button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </form>
        @endif
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let currentQuestion = 0;
        const questions = document.querySelectorAll(".quiz-question");
        const totalQuestions = questions.length;
        const progressBar = document.getElementById("progressBar");

        document.querySelectorAll(".next-btn").forEach(button => {
            button.addEventListener("click", function () {
                const nextIndex = parseInt(this.dataset.next);

                // Pastikan jawaban sudah dipilih sebelum lanjut
                const radioButtons = questions[currentQuestion].querySelectorAll("input[type='radio']");
                let answered = false;
                radioButtons.forEach(radio => {
                    if (radio.checked) answered = true;
                });

                if (!answered) {
                    alert("Pilih jawaban terlebih dahulu!");
                    return;
                }

                // Sembunyikan pertanyaan saat ini
                questions[currentQuestion].style.display = "none";

                // Jika masih ada pertanyaan berikutnya, tampilkan
                if (nextIndex < totalQuestions) {
                    questions[nextIndex].style.display = "block";
                    currentQuestion = nextIndex;
                }

                // Perbarui progress bar
                let progressPercentage = ((currentQuestion + 1) / totalQuestions) * 100;
                progressBar.style.width = progressPercentage + "%";
            });
        });
    });
</script>

@endsection
