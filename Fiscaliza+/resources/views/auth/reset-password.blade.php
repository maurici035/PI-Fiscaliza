<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiscaliza+ | Redefinir Senha</title>
    <link rel="stylesheet" href="{{ asset('css/recuperar-senha.css') }}">
    <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
</head>

<body>
    <div class="container">
        <h2>Redefinir Senha</h2>
        <p>Digite sua nova senha abaixo.</p>

        @if ($errors->any())
            <div class="alert alert-danger"
                style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin: 10px 0;">
                @foreach ($errors->all() as $error)
                    <p style="margin: 0;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="email" name="email" placeholder="Digite seu e-mail"
                value="{{ old('email', request()->email) }}" required>
            <input type="password" name="password" placeholder="Nova senha (mín. 8 caracteres)" required>
            <input type="password" name="password_confirmation" placeholder="Confirme a nova senha" required>
            <br>
            <button type="submit" class="btn">Redefinir Senha</button>
        </form>

        <a href="{{ route('login') }}"
            style="display: block; margin-top: 20px; text-align: center; color: #007bff; text-decoration: none;">Voltar
            ao Login</a>
    </div>
</body>

</html>