@extends('layouts.app')

@section('conteudo')

<p class="text-left text-sm text-[#22162B] mt-6"> <a href="{{ (url()->previous() && url()->previous() !== url()->current()) ? url()->previous() : route('dashboard') }}" class="font-semibold underline"> Voltar </a> </p> <div class="p-6 max-w-4xl mx-auto"> <h1 class="text-2xl font-bold mb-6">Configurações do Sistema</h1> <div class="bg-white shadow rounded p-6"> <form method="POST" action="{{ route('settings.update') }}" class="space-y-4"> @csrf

        @php $prefs = auth()->user()->preferences ?? []; @endphp

        <div>
            <label class="block text-sm font-medium mb-2">Tema</label>
            <select name="theme" class="border p-2 rounded w-full">
                <option value="light" {{ old('theme', $prefs['theme'] ?? 'light') === 'light' ? 'selected' : '' }}>Claro
                </option>
                <option value="dark" {{ old('theme', $prefs['theme'] ?? '') === 'dark' ? 'selected' : '' }}>Escuro
                </option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Timezone</label>
            <select name="timezone" class="border p-2 rounded w-full">
                <option value="UTC" {{ old('timezone', $prefs['timezone'] ?? 'UTC') === 'UTC' ? 'selected' : '' }}>UTC
                </option>
                <option value="America/Sao_Paulo" {{ old('timezone', $prefs['timezone'] ?? '') === 'America/Sao_Paulo' ? 'selected' : '' }}>America/Sao_Paulo
                </option>
                <option value="Europe/Lisbon" {{ old('timezone', $prefs['timezone'] ?? '') === 'Europe/Lisbon' ? 'selected' : '' }}>Europe/Lisbon
                </option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Formato de data</label>
            <select name="date_format" class="border p-2 rounded w-full">
                <option value="d/m/Y" {{ old('date_format', $prefs['date_format'] ?? 'd/m/Y') === 'd/m/Y' ? 'selected' : '' }}>d/m/Y
                </option>
                <option value="Y-m-d" {{ old('date_format', $prefs['date_format'] ?? '') === 'Y-m-d' ? 'selected' : '' }}>Y-m-d
                </option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Itens por página</label>
            <input type="number" name="items_per_page" min="1" class="border p-2 rounded w-full"
                   value="{{ old('items_per_page', $prefs['items_per_page'] ?? 10) }}">
        </div>

        <div class="flex justify-end">
            <button class="bg-blue-600 text-white px-6 py-2 rounded">Salvar</button>
        </div>
    </form>
</div>
@endsection