<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        return view('frontend.quiz.index');
    }

    public function process(Request $request)
    {
        // Validasi input agar tidak ada jawaban yang kosong
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|integer|min:1|max:5',
        ]);

        // Menghitung total skor dari jawaban pengguna
        $totalScore = array_sum($request->input('answers'));

        // Menentukan kategori berdasarkan total skor
        if ($totalScore <= 10) {
            $category = 'tidak terkena bully';
            $message = 'Anda berada di lingkungan yang positif. Tetaplah menjaga sikap baik dan bantu teman-teman yang mengalami kesulitan.';
        } elseif ($totalScore <= 20) {
            $category = 'ringan';
            $message = 'Anda mungkin mengalami situasi yang kurang nyaman. Jangan biarkan hal kecil merusak kepercayaan diri Anda. 
                        Baca artikel kami dan konsultasikan dengan BK untuk menjaga kesehatan mental Anda.';
        } elseif ($totalScore <= 30) {
            $category = 'menengah';
            $message = 'Situasi Anda cukup serius. Jangan ragu untuk mencari dukungan dari teman, keluarga, atau pihak sekolah. 
                        Laporkan kejadian ini agar bisa segera ditindaklanjuti.';
        } else {
            $category = 'berat';
            $message = 'Anda mengalami situasi yang berbahaya dan memerlukan bantuan segera. Jangan ragu untuk mencari pertolongan dari guru, konselor, atau pihak kepolisian. 
                        Anda tidak sendiri, dan ada banyak orang yang siap membantu.';
        }

        // Redirect ke halaman quiz dengan hasil
        return redirect()->route('quiz.index')->with([
            'message' => $message,
            'category' => $category
        ]);
    }
}
