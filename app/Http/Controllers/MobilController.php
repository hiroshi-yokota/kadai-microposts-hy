<?php

namespace App\Http\Controllers;

use App\Mobil;

class MobilController extends Controller
{
    public function index()
    {
        // mempersiapkan data untuk jexcel
        $items = Mobil::all(['nama', 'harga']);

        return view('mobil.index', compact('items'));
    }
}