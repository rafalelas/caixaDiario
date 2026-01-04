<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    public function run()
    {
        $produtos = [
            ['nome' => 'Marmita R$15', 'preco' => 15],
            ['nome' => 'Marmita R$18', 'preco' => 18],
            ['nome' => 'Marmita R$20', 'preco' => 20],
            ['nome' => 'Marmita R$25', 'preco' => 25],
            ['nome' => 'Almoço', 'preco' => 25],
        ];

        foreach ($produtos as $produto) {
            Produto::firstOrCreate(
                ['nome' => $produto['nome']],
                ['preco' => $produto['preco']]
            );
        }

    }
}

