<?php

namespace App\Http\Controllers;

use App\Models\CaixaDiario;

class MainController extends Controller
{
    public function index()
    {
        return view('home');
    }

    
}

