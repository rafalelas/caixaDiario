<?php

namespace App\Http\Controllers;

use App\Models\CaixaDiario;
use App\Models\CaixaItem;
use App\Models\Produto;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CaixaDiarioController extends Controller
{
    public function create()
    {
        $produtos = Produto::all();
        $data = Carbon::today()->format('d/m/Y');

        return view('caixa.form', [
            'caixa' => null,
            'produtos' => Produto::all(),
            'data' => Carbon::today()->format('Y-m-d'),
            'itens' => []
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required|date',
        ]);

        $data = Carbon::parse($request->input('data'));

        $caixa = CaixaDiario::create([
            'data' => $data,
            'maquina1' => $request->maquina1 ?? 0,
            'maquina2' => $request->maquina2 ?? 0,
            'maquina3' => $request->maquina3 ?? 0,
            'maquina4' => $request->maquina4 ?? 0,
            'dinheiro' => $request->dinheiro ?? 0,
            'total_taxas' => $request->total_taxas ?? 0,
        ]);

        if ($request->has('produtos')) {
            foreach ($request->produtos as $produtoId => $quantidade) {
                if ($quantidade > 0) {
                    CaixaItem::create([
                        'caixa_diario_id' => $caixa->id,
                        'produto_id' => $produtoId,
                        'quantidade' => $quantidade
                    ]);
                }
            }
        }

        return redirect()->route('dashboard');
    }

    public function edit(CaixaDiario $caixa)
    {
        $produtos = Produto::all();
        $itens = $caixa->itens->pluck('quantidade', 'produto_id')->toArray();
        $data = Carbon::parse($caixa->data)->format('Y-m-d');

        return view('caixa.form', [
            'caixa' => $caixa,
            'produtos' => $produtos,
            'itens' => $itens,
            'data' => $data,
        ]);
    }

    public function update(Request $request, CaixaDiario $caixa)
    {
        $request->validate([
            'data' => 'required|date',
        ]);

        $caixa->update($request->only([
            'data',
            'maquina1','maquina2','maquina3','maquina4','dinheiro','total_taxas'
        ]));

        CaixaItem::where('caixa_diario_id', $caixa->id)->delete();

        if ($request->has('produtos')) {
            foreach ($request->produtos as $produtoId => $quantidade) {
                if ($quantidade > 0) {
                    CaixaItem::create([
                        'caixa_diario_id' => $caixa->id,
                        'produto_id' => $produtoId,
                        'quantidade' => $quantidade
                    ]);
                }
            }
        }

        return redirect()->route('dashboard');
    }

    public function show(CaixaDiario $caixa)
    {
        $produtos = Produto::all();
        $itens = $caixa->itens->pluck('quantidade', 'produto_id')->toArray();

        return view('caixa.show', [
            'caixa' => $caixa,
            'produtos' => $produtos,
            'itens' => $itens,
        ]);
    }

    public function destroy(CaixaDiario $caixa)
    {
        $caixa->delete();
        return redirect()->route('dashboard')->with('success', 'Caixa deletada com sucesso.');
    }
}
