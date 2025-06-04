<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fiscaliza+ | Perfil do Usuário</title>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script src="{{ asset('js/sidebar-loader.js') }}"></script>
  <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
</head>

<body>
  
  <div id="sidebar-container"></div>

  <div class="main">
    <img src="{{ asset('assets/fiscaliza-logo.png') }}" alt="Logo Fiscaliza+" class="title">

    <img src="{{ asset('assets/foto_usuario.png') }}" alt="Foto do Usuário" class="profile-img">
    <div class="profile-name">Perfil Do Usuário</div>

    <div class="profile-box">
      <div class="info">Nome: Maria Rita De Souza</div>
      <div class="info">E-mail: Mariarita123@gmail.com</div>
      <div class="info">Data De Nascimento: 14/09/1984</div>
      <div class="info">Notificações: Ativadas</div>
      <div class="info">Acompanhar denúncias</div>
     <button id="btn-alterar" class="btn-alterar">Alterar</button>
  </div>

  <script>
    document.getElementById('btn-alterar').addEventListener('click', function () {
      // Altere o caminho para usar a função de rota do Laravel
      window.location.href = '{{ route("alterar-perfil-usuario") }}';
    });
  </script>
</body>

</html>