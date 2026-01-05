@extends('layouts.app')

@section('conteudo')
<p class="text-left text-sm text-[#22162B] mt-6">
    <a href="{{ route('dashboard') }}" class="font-semibold underline">
        Voltar
    </a>
</p>
<div class="p-6 max-w-4xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">
        @isset($caixa)
            Editar Caixa – {{ $caixa->data ? $caixa->data->format('d/m/Y') : '—' }}
        @else
            Criar Caixa
        @endisset
    </h1>

    <form
        method="POST"
        action="{{ (isset($caixa) && $caixa->id) ? route('caixa.update', $caixa->id) : route('caixa.store') }}"
        class="space-y-8"
    >
        @csrf
        @if($caixa)
            @method('PUT')
        @endif

        {{-- DATA --}}
        <div>
            <label class="block text-sm font-medium mb-2">Data</label>
            <input
                type="date"
                name="data"
                class="border p-2 rounded w-40"
                value="{{ old('data', isset($caixa) && $caixa->data ? $caixa->data->format('Y-m-d') : $data) }}"
                max="{{ \Carbon\Carbon::today()->format('Y-m-d') }}"
            >
        </div>

        {{-- PRODUTOS --}}
        <div>
            <h2 class="text-xl font-bold mb-4">Produtos vendidos</h2>

            <div class="grid grid-cols-2 gap-4">
                @foreach($produtos as $produto)
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            {{ $produto->nome }}
                            (R$ {{ number_format($produto->preco, 2, ',', '.') }})
                        </label>

                        <input
                            type="number"
                            min="0"
                            step="1"
                            inputmode="numeric"
                            name="produtos[{{ $produto->id }}]"
                            class="border p-2 rounded w-full"
                            value="{{ old('produtos.' . $produto->id, $itens[$produto->id] ?? 0) }}"
                        >
                    </div>
                @endforeach
            </div>
        </div>

        {{-- FORMAS DE PAGAMENTO --}}
        <div>
            <h2 class="text-xl font-bold mb-4">Formas de pagamento</h2>

            <div class="grid grid-cols-2 gap-4">
                @foreach(['Stone1'=>'Stone 1','Stone2'=>'Stone 2','Cielo1'=>'Cielo 1','Cielo2'=>'Cielo 2','MercadoPago'=>'Mercado Pago','dinheiro'=>'Dinheiro','total_taxas'=>'Total de taxas'] as $field => $label)
                    <div>
                        <label class="block text-sm font-medium">{{ $label }}</label>
                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="{{ $field }}"
                            class="border p-2 rounded w-full"
                            value="{{ old($field, $caixa->$field ?? 0) }}"
                        >
                    </div>
                @endforeach
            </div>
        </div>

        <button class="bg-blue-600 text-white px-6 py-2 rounded">
            Salvar Caixa
        </button>
    </form>
</div>
@endsection
