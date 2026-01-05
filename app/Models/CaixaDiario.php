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
        'maquina5',
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
        $m1 = $this->getAttribute('Stone1') ?? $this->getAttribute('stone1') ?? 0;
        $m2 = $this->getAttribute('Stone2') ?? $this->getAttribute('stone2') ?? 0;
        $m3 = $this->getAttribute('Cielo1') ?? $this->getAttribute('cielo1') ?? 0;
        $m4 = $this->getAttribute('Cielo2') ?? $this->getAttribute('cielo2') ?? 0;
        $m5 = $this->getAttribute('MercadoPago') ?? $this->getAttribute('mercadopago') ?? 0;

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

    // read virtual attributes from the renamed DB columns (and keep a fallback)
    public function getMaquina1Attribute()
    {
        return $this->attributes['Stone1'] ?? $this->attributes['maquina1'] ?? 0;
    }
    public function setMaquina1Attribute($value)
    {
        $this->attributes['Stone1'] = $value;
    }

    public function getMaquina2Attribute()
    {
        return $this->attributes['Stone2'] ?? $this->attributes['maquina2'] ?? 0;
    }
    public function setMaquina2Attribute($value)
    {
        $this->attributes['Stone2'] = $value;
    }

    public function getMaquina3Attribute()
    {
        return $this->attributes['Cielo1'] ?? $this->attributes['maquina3'] ?? 0;
    }
    public function setMaquina3Attribute($value)
    {
        $this->attributes['Cielo1'] = $value;
    }

    public function getMaquina4Attribute()
    {
        return $this->attributes['Cielo2'] ?? $this->attributes['maquina4'] ?? 0;
    }
    public function setMaquina4Attribute($value)
    {
        $this->attributes['Cielo2'] = $value;
    }

    public function getMaquina5Attribute()
    {
        return $this->attributes['MercadoPago'] ?? $this->attributes['maquina5'] ?? 0;
    }
    public function setMaquina5Attribute($value)
    {
        $this->attributes['MercadoPago'] = $value;
    }
}