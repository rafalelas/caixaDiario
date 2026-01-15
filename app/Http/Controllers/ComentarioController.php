<?php

namespace App\Http\Controllers;

use App\Models\CaixaDiario;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, CaixaDiario $caixa)
    {
        $request->validate([
            'comentario' => 'required|string|max:1000',
        ]);

        Comentario::create([
            'caixa_diario_id' => $caixa->id,
            'user_id' => auth()->id(),
            'comentario' => $request->comentario,
        ]);

        return back();
    }
}
