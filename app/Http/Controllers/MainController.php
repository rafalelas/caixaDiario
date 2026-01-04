<?php

namespace App\Http\Controllers;

use App\Models\CaixaDiario;

class MainController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        $caixas = CaixaDiario::orderBy('data', 'desc')->get();

        return view('dashboard', compact('caixas'));
    }
}

