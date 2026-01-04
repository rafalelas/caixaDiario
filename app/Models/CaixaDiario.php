<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaixaDiario extends Model
{
    protected $table = 'caixa_diario';

    protected $fillable = [
        'data',
        'maquina1',
        'maquina2',
        'maquina3',
        'maquina4',
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
        return $this->maquina1
            +  $this->maquina2
            +  $this->maquina3
            +  $this->maquina4;
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