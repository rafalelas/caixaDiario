<?php

namespace App\Http\Controllers;

use App\Models\CaixaDiario;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $caixas = CaixaDiario::orderBy('data', 'desc')->get();

        return view('dashboard', compact('caixas'));
    }
}

