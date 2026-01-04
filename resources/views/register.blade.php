@extends('layouts.padrao')
@section('conteudo')
<div class="bg-[#22162B] min-h-screen flex items-center justify-center p-6">

    <div class="bg-[#C6EBBE] p-10 rounded-2xl shadow-xl w-full max-w-md">
        <h2 class="text-2xl font-bold text-[#22162B] mb-6 text-center">
            Criar conta
        </h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <input type="text" name="name" placeholder="Nome"
                class="w-full px-4 py-3 rounded-lg border border-[#50723C]" required>

            <input type="email" name="email" placeholder="Email"
                class="w-full px-4 py-3 rounded-lg border border-[#50723C]" required>

            <input type="password" name="password" placeholder="Senha"
                class="w-full px-4 py-3 rounded-lg border border-[#50723C]" required>

            <input type="password" name="password_confirmation" placeholder="Confirmar senha"
                class="w-full px-4 py-3 rounded-lg border border-[#50723C]" required>

            <button
                class="w-full bg-[#50723C] hover:bg-[#3d582d] text-white py-3 rounded-lg font-semibold transition">
                Criar conta
            </button>
        </form>

        <p class="text-center text-sm text-[#22162B] mt-6">
            Já tem conta?
            <a href="{{ route('login') }}" class="font-semibold underline">
                Entrar
            </a>
        </p>
        <p class="text-center text-sm text-[#22162B] mt-6">
            <a href="{{ route('home') }}" class="font-semibold underline">
                Voltar
            </a>
        </p>
    </div>

</div>
@endsection