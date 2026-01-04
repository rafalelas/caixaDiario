@extends('layouts.app')

@section('conteudo')
<div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Editar Perfil</h1>

    <div class="bg-white shadow rounded p-6">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="flex items-center gap-6">
                <img
                    src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('assets/images/default-avatar.png') }}"
                    alt="Avatar"
                    class="w-20 h-20 rounded-full object-cover"
                >

                <div class="flex-1">
                    <label class="block text-sm font-medium mb-2">Alterar avatar</label>
                    <input type="file" name="avatar" accept="image/*" class="border p-2 rounded w-full">
                </div>
            </div>

            <input type="hidden" name="return_to" value="{{ (url()->previous() && url()->previous() !== url()->current()) ? url()->previous() : route('dashboard') }}">

            <div class="flex justify-end">
                <button class="bg-blue-600 text-white px-6 py-2 rounded">
                    Salvar
                </button>
            </div>
        </form>
    </div>

    <p class="text-left text-sm text-[#22162B] mt-6">
        <a href="{{ (url()->previous() && url()->previous() !== url()->current()) ? url()->previous() : route('dashboard') }}" class="font-semibold underline">
            Voltar
        </a>
    </p>
</div>
@endsection