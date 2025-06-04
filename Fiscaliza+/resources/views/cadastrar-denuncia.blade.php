<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Fiscaliza+ | Cadastrar Denúncia</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/cadastrar-denuncia.css') }}">
  <script src="{{ asset('js/sidebar-loader.js') }}"></script>
  <script src="{{ asset('js/cadastrar-denuncia.js') }}"></script>
  <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
</head>

<body>
  <div id="sidebar-container"></div>

  <header class="top-header">
    <div>
      <img src="{{ asset('assets/fiscaliza-logo.png') }}" alt="Fiscaliza+" class="brand-logo">
    </div>
    <div class="header-right">
      <div class="user-avatar">
        <img src="{{ asset('assets/foto_usuario.png') }}" alt="User profile">
      </div>
    </div>
  </header>

  <div class="main-content">
    <div class="chat-container">
      <!-- Campo para o título da denúncia -->
      <input type="text" id="tituloInput" class="form-control" placeholder="Título da denúncia"
        style="margin-bottom: 10px;">

      <textarea id="textMessage" class="chat-input" placeholder="Sobre o que você quer falar?"
        style="min-height: 80px; padding: 10px;"></textarea>
      <div id="feedbackMessage" style="color: red; margin-top: 8px; min-height: 20px;"></div>

      <div class="chat-actions"
        style="display: flex; justify-content: space-between; align-items: center; padding: 10px;">
        <div class="action-buttons" style="display: flex; gap: 10px;">
          <!-- Botão Foto -->
          <button class="action-button photo" style="background: none; border: none;">
            <img src="{{ asset('assets/icone-foto.png') }}" alt="Imagem" width="24" height="24" />
          </button>

          <!-- Botão Vídeo -->
          <button class="action-button video" style="background: none; border: none;">
            <img src="{{ asset('assets/icone-video.png') }}" alt="Vídeo" width="24" height="24" />
          </button>

          <!-- Botão Localização -->
          <button class="action-button location" style="background: none; border: none;">
            <img src="{{ asset('assets/icone-localizacao.png') }}" alt="Localização" width="24" height="24" />
          </button>
        </div>

        <button class="send-button"
          style="padding: 10px 20px; background-color: #17e979; color: white; border: none; border-radius: 4px;">
          Enviar
        </button>
      </div>

      <!-- Inputs escondidos para arquivos e localização -->
      <input type="file" id="photoInput" accept="image/*" style="display: none;" />
      <input type="file" id="videoInput" accept="video/*" style="display: none;" />
      <div id="uploadSuccessMessage" style="color: green; margin-top: 10px; min-height: 10px;"></div>
      <input type="hidden" id="locationInput" />
    </div>
  </div>

</body>

</html>