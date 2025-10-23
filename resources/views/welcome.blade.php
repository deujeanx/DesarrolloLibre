<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AirHub | @yield('title')</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@fluxAppearance
</head>

<body class="bg-gray-50 text-gray-800">

    {{-- NAVBAR --}}
    <header class="flex items-center justify-between px-8 py-4 bg-white shadow-sm">
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/logo-airhub.svg') }}" alt="AirHub Logo" class="h-6">
            <span class="text-2xl font-semibold text-blue-600">AirHub</span>
        </div>

        <nav class="flex items-center gap-6 text-sm font-medium text-gray-700">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Inicio</a>
            <a href="{{ route('flights.indexWelcome') }}" class="hover:text-blue-600">Reservar</a>
            <a href="{{ route('tickets.index') }}" class="hover:text-blue-600">Mis reservas</a>

            <div class="flex items-center gap-3">

                @auth
                    <flux:dropdown position="bottom" align="end">
                        {{-- Avatar y nombre --}}
                        <flux:profile  name="{{ Auth::user()->first_name }}" />

                        {{-- Menú --}}
                        <flux:navmenu>

                            @role('admin')
                                <flux:navmenu.item href="{{ route('dashboard') }}" icon="magnifying-glass-plus">Dashboard
                                </flux:navmenu.item>
                            @endrole

                            {{-- Logout --}}
                            <flux:navmenu.item>
                                <form action="{{ route('logout') }}" method="POST" class="inline">
                                    @csrf
                                    <flux:navmenu.item type="submit" icon="arrow-left-start-on-rectangle">
                                        Logout
                                    </flux:navmenu.item>
                                </form>
                            </flux:navmenu.item>
                        </flux:navmenu>
                    </flux:dropdown>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline mr-4">Iniciar sesión</a>
                    <a href="{{ route('register') }}"
                        class="bg-blue-600 text-white px-4 py-1.5 rounded-md hover:bg-blue-700 transition">
                        Registrarse
                    </a>
                @endguest
            </div>
        </nav>
    </header>

    @section('content')
        @include('home')
    @endsection

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-white border-t py-6 text-center text-gray-500 text-sm">
        © {{ date('Y') }} AirHub — Tu espacio en las alturas.
    </footer>
    <script src="{{ asset('js/select.js') }}"></script>
</body>
@fluxScripts
</html>
