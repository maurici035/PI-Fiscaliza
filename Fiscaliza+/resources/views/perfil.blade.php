<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fiscaliza+ | Perfil do Usuário</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Segoe UI", sans-serif;
      background-color: #ececec;
      color: black;
      display: flex;
      height: 100vh;
    }

    /* Main content */
    .main {
      flex: 1;
      padding: 30px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .title {
      font-size: 26px;
      color: #00ccff;
      font-weight: bold;
      margin-bottom: 30px;
    }

    .title span {
      color: #6fff7d;
    }

    .profile-img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 10px;
      border: 3px solid #444;
    }

    .profile-name {
      font-weight: bold;
      font-size: 18px;
      margin-bottom: 25px;
    }

    .profile-box {
      background-color: white;
      padding: 40px;
      border-radius: 20px;
      width: 100%;
      max-width: 900px;
      /* 👈 mais largo */
      min-height: 500px;
      /* 👈 altura mínima como na imagem */
      display: flex;
      flex-direction: column;
      gap: 20px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    }

    .info {
      background-color: #D9D9D9;
      padding: 16px 22px;
      border-radius: 10px;
      font-weight: 600;
      font-size: 16px;
    }

    .btn-alterar {
      margin-top: 15px;
      padding: 14px 24px;
      background-color:rgb(3, 192, 91);
      border: none;
      color: #fff;
      font-weight: bold;
      border-radius: 10px;
      cursor: pointer;
      transition: background 0.3s ease;
      font-size: 16px;
      align-self: flex-start;
    }

    .btn-alterar:hover {
      background-color: #0b7dda;
    }

    .message {
      padding: 12px 20px;
      margin-bottom: 20px;
      border-radius: 8px;
      font-weight: 500;
      text-align: center;
      max-width: 900px;
      width: 100%;
    }

    .message.success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

    .message.error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
  </style>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script src="{{ asset('js/sidebar-loader.js') }}"></script>
  <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
</head>

<body>
  <div id="sidebar-container"></div>

  <div class="main">
    <img src="{{ asset('assets/fiscaliza-logo.png') }}" alt="Logo Fiscaliza+" class="title">

    <img src="{{ $usuario->foto_perfil_url }}" alt="Foto do Usuário" class="profile-img">
    <div class="profile-name">Perfil Do Usuário</div>

    @if(session('success'))
    <div class="message success">
      {{ session('success') }}
    </div>
  @endif

    @if(session('error'))
    <div class="message error">
      {{ session('error') }}
    </div>
  @endif

    @auth
    <div class="profile-box">
      <div class="info">Nome: {{ $usuario->nome ?? 'Não informado' }}</div>
      <div class="info">E-mail: {{ $usuario->email ?? 'Não informado' }}</div>
      <div class="info">Data De Nascimento:
      @if($usuario->data_nascimento)
      {{ \Carbon\Carbon::parse($usuario->data_nascimento)->format('d/m/Y') }}
    @else
      Não informada
    @endif
      </div>
      <div class="info">Notificações: Ativadas</div>
      <div class="info">Acompanhar denúncias</div>
      <a href="{{ route('alterar-perfil-usuario') }}" class="btn-alterar">Alterar</a>
    </div>
  @else
    <div class="profile-box">
      <div class="info">Você precisa estar logado para ver seu perfil</div>
      <a href="{{ route('login') }}" class="btn-alterar">Fazer Login</a>
    </div>
  @endauth
  </div>
</body>

</html>