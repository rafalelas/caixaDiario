@extends('layouts.padrao')
@section('conteudo')
<div class="bg-[#22162B] min-h-screen flex items-center justify-center px-6">

    <div class="max-w-6xl w-full grid md:grid-cols-2 gap-10 items-center">

        <div>
            <h1 class="text-4xl font-bold text-[#C6EBBE] mb-6">
                Organize suas entradas.<br>Gerencie suas saídas.
            </h1>

            <p class="text-[#FFD2FC] text-lg mb-8">
                Calcule o caixa, adicione maquininhas e acompanhe todos relatórios em um só lugar.
            </p>

            <div class="flex gap-4">
                <a href="{{ route('register') }}"
                   class="bg-[#C6EBBE] hover:bg-[#50723C] text-[#22162B] hover:text-[white] font-semibold px-6 py-3 rounded-lg shadow transition">
                    Criar conta
                </a>

                <a href="{{ route('login') }}"
                   class="bg-[#C6EBBE] hover:bg-[#50723C] text-[#22162B] hover:text-[white] font-semibold px-6 py-3 rounded-lg shadow transition">
                    Entrar
                </a>
            </div>
        </div>

        <div class="hidden md:block">
            <img src="{{ asset('assets/images/teamwork.png') }}" class="w-full max-w-md mx-auto">
        </div>

    </div>

</div>
@endsection
