<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Carga de Archivos') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite(['resources/js/app.js'])

    <script src="{{ mix('js/app.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Validacion de formularion --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form'); // Obtén el formulario
            const submitButton = form.querySelector('button[type="submit"]');

            form.addEventListener('submit', function (event) {
                let isValid = true;

                // Validación para el campo "Organismo"
                const organismoField = document.getElementById('organismo_id');
                if (!organismoField.value) {
                    isValid = false;
                    organismoField.classList.add('is-invalid'); // Agrega clase de error
                    alert('Por favor, selecciona un organismo');
                } else {
                    organismoField.classList.remove('is-invalid'); // Quita clase de error si es válido
                }

                // Validación para el campo "Descripción"
                const descripcionField = document.getElementById('descripcion');
                if (!descripcionField.value.trim()) {
                    isValid = false;
                    descripcionField.classList.add('is-invalid');
                    alert('Por favor, ingresa una descripción');
                } else {
                    descripcionField.classList.remove('is-invalid');
                }

                // Validación para el campo "Archivo"
                const archivoField = document.getElementById('archivo');
                if (!archivoField.files.length) {
                    isValid = false;
                    archivoField.classList.add('is-invalid');
                    alert('Por favor, adjunta un archivo');
                } else {
                    archivoField.classList.remove('is-invalid');
                }

                // Si alguno de los campos no es válido, evita el envío del formulario
                if (!isValid) {
                    event.preventDefault(); // Prevenir el envío del formulario
                }
            });
        });
    </script>


</head>
<body>
    <div id="app">
        <nav class="bg-white shadow-sm navbar navbar-expand-md navbar-light">
            <div class="container">
                {{-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
