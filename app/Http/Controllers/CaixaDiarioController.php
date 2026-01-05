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
            'Stone1' => $request->Stone1 ?? 0,
            'Stone2' => $request->Stone2 ?? 0,
            'Cielo1' => $request->Cielo1 ?? 0,
            'Cielo2' => $request->Cielo2 ?? 0,
            'MercadoPago' => $request->MercadoPago ?? 0,
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
            'Stone1',
            'Stone2',
            'Cielo1',
            'Cielo2',
            'MercadoPago',
            'dinheiro',
            'total_taxas',
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
