<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="../css/login.css"/>
  <script src="../js/login.js"></script>
  <link rel="icon" href="../assets/logo-menor.png" type="image/png">
</head>
<body>
  <div class="background"></div>
  <div class="overlay"></div>
  <div class="login-container">
    <div class="login-box">
      <img src="../assets/Captura_de_tela_2025-04-09_151332-removebg-preview.png" alt="Ícone de login" class="icon" />
      <h2>Faça seu login</h2>
      <form method="POST" action="{{ route('login') }}">
        @csrf

        @if(session('success'))
        <div class="message success">
          {{ session('success') }}
        </div>
      @endif

      @if($errors->any())
        <div class="message error">
          @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
          @endforeach
        </div>
      @endif

      <input type="email" name="email" placeholder="Email" id="email" required />
      <input type="password" name="senha" placeholder="Senha" id="senha" required />

        <a href="telaRecuperarSenha.html" class="forgot-password">Esqueci minha senha </a>
        <button type="submit"><span>&rarr;</span></button>
      </form>
    </div>
  </div>
  <script src="../js/login.js"></script>
</body>
</html>