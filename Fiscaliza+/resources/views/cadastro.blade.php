<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiscaliza+ | Cadastro</title>
    <link rel="stylesheet" href="{{ asset('css/cadastro.css') }}">
    <script src="{{ asset('js/sidebar-loader.js') }}"></script>
    <link rel="icon" href="{{ asset('logo-menor.png')}}" type="image/png">
</head>

<body>

    <!-- <div class="register-container">
        <img src="../assets/freepik__create-a-logo-for-fiscaliza-featuring-a-stylized-m__94104 3.png" alt="">
        <h2>Cadastre-se</h2>
        <input type="text" class="input-field" id="nome" placeholder="Nome">
        <input type="email" class="input-field" id="email" placeholder="E-mail">
        <input type="password" class="input-field" id="senha" placeholder="Senha">
        <input type="password" class="input-field" id="repitaSenha" placeholder="Repita a Senha">
        <input type="date" class="input-field" id="dataNascimento" placeholder="Data de Nascimento">
        <div class="checkbox-container">
            <input type="checkbox" id="terms">
            <label for="terms">Concordo com os Termos da Plataforma</label>
        </div>
        <button class="register-btn" onclick="validarFormulario()">CADASTRAR</button>
    </div> -->


    <div class="register-container">
        <form action="/register" method="POST">
            @csrf
            <!-- CSRF token necessário no Laravel -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <img src="{{ asset('assets/fiscaliza+-name.png') }}" alt="Fiscaliza+ Logo">
            <h2>Cadastre-se</h2>

            <input type="text" class="input-field" name="nome" placeholder="Nome" required>
            <input type="email" class="input-field" name="email" placeholder="E-mail" required>
            <input type="password" class="input-field" name="senha" placeholder="Senha" required>
            <input type="password" class="input-field" name="repitaSenha" placeholder="Repita a Senha" required>
            <input type="date" class="input-field" name="dataNascimento" placeholder="Data de Nascimento" required>

            <div class="checkbox-container">
                <input type="checkbox" name="terms" required>
                <label for="terms">Concordo com os Termos da Plataforma</label>
            </div>

            <button type="submit" class="register-btn">CADASTRAR</button>
        </form>
    </div>


    <script src="../js/cadastro.js"></script>
</body>

</html>