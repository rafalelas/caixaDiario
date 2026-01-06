@extends('layouts.app')
@section('conteudo')
<div class="p-6 max-w-4xl mx-auto">
    <p class="text-left text-sm text-[#22162B] mt-6">
        <a href="{{ route('dashboard') }}" class="font-semibold underline">Voltar</a>
    </p>

    <h1 class="text-2xl font-bold mb-4">Caixa — {{ $caixa->data ? $caixa->data->format('d/m/Y') : '—' }}</h1>

    <div class="bg-white shadow rounded p-6 mb-4">
        <h2 class="text-lg font-semibold mb-2">Resumo de Pagamentos</h2>

        <div class="grid grid-cols-2 gap-2">
           <div>Maquininhas:</div>
            <div>R$ {{ number_format($caixa->totalMaquinas(), 2, ',', '.') }}</div>

            <div>Dinheiro em papel:</div>
            <div>R$ {{ number_format($caixa->dinheiro, 2, ',', '.') }}</div>

            <hr class="col-span-2 my-2">

            <div class="font-semibold">Subtotal:</div>
            <div class="font-semibold">
                R$ {{ number_format($caixa->subtotalPagamentos(), 2, ',', '.') }}
            </div>

            <div>Taxas:</div>
            <div>- R$ {{ number_format($caixa->total_taxas, 2, ',', '.') }}</div>

            <div class="font-bold">Valor total de pagamentos:</div>
            <div class="font-bold">
                R$ {{ number_format($caixa->totalGeral(), 2, ',', '.') }}
            </div>

        </div>

    </div>


    <div class="bg-white shadow rounded p-6">
        <h2 class="text-lg font-semibold mb-2">Produtos vendidos</h2>
        <table class="w-full">
            <thead>
                <tr class="text-left">
                    <th class="text-center">Produto</th>
                    <th class="text-center">Preço</th>
                    <th class="text-center">Quantidade</th>
                    <th class="text-center">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($caixa->produtoBreakdown() as $row)
                    <tr>
                        <td class="text-center">{{ $row['nome'] }}</td>
                        <td class="text-center">R$ {{ number_format($row['preco'], 2, ',', '.') }}</td>
                        <td class="text-center">{{ $row['quantidade'] }}</td>
                        <td class="text-center">R$ {{ number_format($row['subtotal'], 2, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr class="font-bold text-center">
                    <td class="text-center">Total</td>
                    <td class="text-center"></td>
                    <td class="text-center">{{ $caixa->totalProdutosQuantidade() }}</td>
                    <td class="text-center">R$ {{ number_format($caixa->totalProdutos(), 2, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        @php
        $byPrice = $caixa->produtoBreakdown()->groupBy('preco')->map(function($group){
            return [
                'quantidade' => $group->sum('quantidade'),
                'subtotal' => $group->sum('subtotal'),
            ];
        });
        @endphp
    </div>

    <div class="mt-4 text-center font-bold">
        Total Geral: R$ {{ number_format($caixa->totalGeral(), 2, ',', '.') }}
    </div>

    <div class="mt-2 text-center font-bold">
        Outros Recebimentos:
        R$ {{ number_format($caixa->outrosRecebimentos(), 2, ',', '.') }}
    </div>


</div>
@endsection

<!-- Produtos vendidos = origem do dinheiro

Pagamentos = dinheiro real

Total geral = dinheiro que entrou (após taxas)

Outros recebimentos = diferença entre pagamento e produtos -->
