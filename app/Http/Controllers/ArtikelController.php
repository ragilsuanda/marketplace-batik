<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function Apa()
    {
        return view('frontend.artikel.apa');
    }
    public function Dampak()
    {
        return view('frontend.artikel.dampak');
    }
    public function Cara()
    {
        return view('frontend.artikel.cara');
    }
}
