<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Meu App')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('head')
</head>
<body>
    <!-- To Header Bar -->
    <x-header />

    <!-- Sidebar -->
    <x-sidebar />

    <main>
        @yield('content')
    </main>
</body>
</html>
