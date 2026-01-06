@php
    $theme = auth()->user()->preferences['theme'] ?? 'light';
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caixa Diário</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
</head>
<body class="{{ $theme === 'dark' ? 'dark' : '' }}">

    {{-- HEADER --}}
    <header class="bg-white shadow px-6 py-3 flex justify-between items-center">
        <span class="font-bold text-lg">Caixa Diário</span>

        <div class="relative">
            <button id="userMenuBtn">
                @auth
                    <img
                        src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('assets/images/default-avatar.png') }}"
                        class="w-10 h-10 rounded-full object-cover"
                        alt="Avatar"
                    >
                @else
                    <img
                        src="{{ asset('assets/images/default-avatar.png') }}"
                        class="w-10 h-10 rounded-full object-cover"
                        alt="Avatar"
                    >
                @endauth
            </button>

            <div
                id="userMenu"
                class="hidden absolute right-0 mt-2 w-48 bg-white rounded shadow"
            >
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Editar perfil</a>
                <a href="{{ route('settings') }}" class="block px-4 py-2 hover:bg-gray-100">Configurações</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left px-4 py-2 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="p-6">
        @yield('conteudo')
    </main>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        const btn = document.getElementById('userMenuBtn');
        const menu = document.getElementById('userMenu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!btn.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>

</body>
</html>