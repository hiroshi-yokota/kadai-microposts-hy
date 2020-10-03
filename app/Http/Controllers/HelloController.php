<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Mailファサードをインポート.
use Illuminate\Support\Facades\Mail;

class HelloController extends Controller
{
    public function index()
    {
        $data = 'hello';
        return view('hello' , compact('data'));
    }

}
