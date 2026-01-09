<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = [
        'caixa_diario_id',
        'user_id',
        'conteudo',
    ];

    public function caixa()
    {
        return $this->belongsTo(CaixaDiario::class, 'caixa_diario_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
