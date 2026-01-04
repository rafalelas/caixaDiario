<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaixaItem extends Model{

    protected $table = 'caixa_itens';

    protected $fillable = [
        'caixa_diario_id',
        'produto_id',
        'quantidade',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function caixa()
    {
        return $this->belongsTo(CaixaDiario::class, 'caixa_diario_id');
    }
}
