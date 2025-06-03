<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fiscaliza+ | Mapa da Denúncia</title>
  <script src="{{ asset('js/sidebar-loader.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/visualizar-denuncia.css') }}">
  <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
</head>

<body>

  <div id="sidebar-container"></div>

  <div class="main-content">
    <div class="brand-name">
      <img src="{{ asset('assets/fiscaliza-logo.png') }}" alt="Brand Name">
    </div>
  </div>

  <!-- Nova div para a imagem centralizada -->
  <div id="mapa" class="centered-image-container"></div>

  <div class="top-right-image">
    <img src="{{ asset('assets/foto_usuario.png') }}" alt="Perfil" class="profile-image" />
  </div>