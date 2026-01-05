<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CaixaDiario;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function dashboard(){
        $caixas = CaixaDiario::orderBy('data', 'desc')->get();

        return view('dashboard', compact('caixas'));
    }

    public function index(){
        $caixasPorMes = CaixaDiario::orderBy('data', 'desc')
            ->get()
            ->groupBy(function ($caixa) {
                return Carbon::parse($caixa->data)->format('Y-m');
            });

        return view('dashboard', ['caixasPorMes' => $caixasPorMes]);
    }   

}
