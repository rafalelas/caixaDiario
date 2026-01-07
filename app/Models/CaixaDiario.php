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

    /* =======================
     * RELAÇÕES
     * ======================= */
    public function itens()
    {
        return $this->hasMany(CaixaItem::class);
    }

    /* =======================
     * PRODUTOS
     * ======================= */
    public function totalProdutos()
    {
        return $this->itens->sum(function ($item) {
            return $item->quantidade * ($item->produto->preco ?? 0);
        });
    }

    public function totalProdutosQuantidade()
    {
        return $this->itens->sum('quantidade');
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

    /* =======================
     * PAGAMENTOS
     * ======================= */

    // soma de todas as maquininhas
    public function totalMaquinas()
    {
        return
            (float) ($this->Stone1 ?? 0) +
            (float) ($this->Stone2 ?? 0) +
            (float) ($this->Cielo1 ?? 0) +
            (float) ($this->Cielo2 ?? 0) +
            (float) ($this->MercadoPago ?? 0);
    }

    // total bruto recebido (antes das taxas)
    public function subtotalPagamentos()
    {
        return $this->totalMaquinas() + ($this->dinheiro ?? 0);
    }

    // total líquido recebido (dinheiro real)
    public function totalPagamentos()
    {
        return $this->subtotalPagamentos() - ($this->total_taxas ?? 0);
    }

    /* =======================
     * RESULTADOS FINAIS
     * ======================= */

    // Total geral = dinheiro real que entrou (líquido)
    public function totalGeral()
    {
        return $this->totalPagamentos();
    }

    // Diferença entre dinheiro recebido e produtos vendidos
    public function outrosRecebimentos()
    {
        return $this->totalGeral() - $this->totalProdutos();
    }
}
