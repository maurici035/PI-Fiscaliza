<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Meu App')</title>
    <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Tailwind CSS & App Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap JS (se necessário) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    @yield('head')
</head>
<body>
@auth('web')
    <x-header />
    <x-sidebar />
@endauth

@auth('empresa')
    <x-headerEmpresa />
    <x-sidebarEmpresa />
@endauth


    <main>
        @yield('content')
    </main>
</body>
</html>
