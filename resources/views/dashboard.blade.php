@extends('layouts.app')

@section('conteudo')
<div class="max-w-4xl mx-auto p-6">

    <div class="flex justify-between mb-6">
        <h1 class="text-2xl font-bold">Dashboard</h1>

        <a href="{{ route('caixa.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded">
            Criar caixa do dia
        </a>
    </div>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">Data</th>
                <th class="p-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($caixas as $caixa)
                <tr class="border-t">
                    <td class="p-2 text-center">{{ \Carbon\Carbon::parse($caixa->data)->format('d/m/Y') }}</td>
                    <td class="p-2 text-center">
                        <div class="flex items-center justify-center gap-4">
                            <a href="{{ route('caixa.show', $caixa) }}" class="text-gray-800">Ver</a>

                            @if(in_array(auth()->user()->role ?? 'user', ['admin','dono']))
                                <a href="{{ route('caixa.edit', $caixa) }}" class="text-blue-600">Editar</a>

                                <form action="{{ route('caixa.destroy', $caixa) }}" method="POST" onsubmit="return confirm('Tem certeza?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">Deletar</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="p-6 text-center text-gray-600">
                        Nenhum caixa criado ainda.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
