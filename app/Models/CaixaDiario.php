<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaixaDiario extends Model
{
    protected $table = 'caixa_diario';

    protected $fillable = [
        'data',
        'Stone1',
        'Stone2',
        'Cielo1',
        'Cielo2',
        'MercadoPago',
        'dinheiro',
        'total_taxas'
    ];

    protected $casts = [
        'data' => 'date',
    ];

    public function itens()
    {
        return $this->hasMany(CaixaItem::class);
    }

    public function totalProdutos(){
        return $this->itens->sum(function ($item){
            return $item->quantidade * $item->produto->preco;
        });
    }

    public function totalMaquinas(){
        $m1 = $this->Stone1 ?? 0;
        $m2 = $this->Stone2 ?? 0;
        $m3 = $this->Cielo1 ?? 0;
        $m4 = $this->Cielo2 ?? 0;
        $m5 = $this->MercadoPago ?? 0;

        return (float)$m1 + (float)$m2 + (float)$m3 + (float)$m4 + (float)$m5;
    }

    public function totalGeral(){
        return $this->totalProdutos()
            + $this->totalMaquinas()
            + $this->dinheiro
            - $this->total_taxas;
    }

    public function produtoBreakdown()
    {
        return $this->itens->map(function ($item) {
            $preco = $item->produto->preco ?? 0;
            return [
                'produto_id' => $item->produto->id ?? null,
                'nome' => $item->produto->nome ?? '—',
                'preco' => $preco,
                'quantidade' => (int) $item->quantidade,
                'subtotal' => $preco * $item->quantidade,
            ];
        });
    }

    public function totalProdutosQuantidade()
    {
        return $this->itens->sum('quantidade');
    }

    public function totalPagamentos()
    {
        return $this->totalMaquinas() + $this->dinheiro - $this->total_taxas;
    }
}