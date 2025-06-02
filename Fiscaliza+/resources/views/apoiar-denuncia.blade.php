<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fiscaliza+ | Apoiar Denúncia</title>
  <link rel="stylesheet" href="{{ asset('css/apoiar-denuncia.css') }}" />
  <script src="{{ asset('js/sidebar-loader.js') }}"></script>
  <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
</head>

<body>
  <!-- Sidebar com ícones -->
  apoiar-denuncia <div id="sidebar-container"></div>

  <!-- Topbar com a logo do nome Fiscaliza+ -->
  <div class="topbar">
    <img src="{{ asset('assets/fiscaliza-logo.png') }}" alt="Logo Fiscaliza+">
  </div>

  <!-- Perfil canto superior direito -->
  <div class="profile-top-right">
    <img src="{{ asset('assets/foto_usuario.png') }}" alt="Perfil">
  </div>

  <!-- Conteúdo principal - quadro branco incluindo logos e ícones -->
  <div class="post-container">
    <div class="post-header">
      <img src="{{ asset('assets/foto_usuario.png') }}" alt="Foto de perfil" class="profile-pic"
        style="border: 2px solid white; box-shadow: 0 0 0 2px #e4e6eb;">
    </div>
    <div class="post-content">
      <img src="{{ asset('assets/buraco_na_faixa_de_pedestre.png') }}" alt="Imagem de um buraco na rua">
    </div>

    <textarea id="postTexto" class="post-input" placeholder="O que você quer falar?"></textarea>

    <!-- Inputs ocultos -->
    <input type="file" id="inputImagem" accept="image/*" style="display:none;">
    <input type="file" id="inputVideo" accept="video/*" style="display:none;">
    <input type="text" id="inputLocalizacao" placeholder="Informe a localização" readonly style="display:none;">

    <div class="post-actions">
      <div class="action-buttons">
        <!-- Botão para imagem -->
        <button class="action-button" onclick="document.getElementById('inputImagem').click()" type="button">
          <div class="icon">
            <img src="{{ asset('assets/icone-foto.png') }}" alt="Ícone de foto">
          </div>
        </button>

        <!-- Botão para vídeo -->
        <button class="action-button" onclick="document.getElementById('inputVideo').click()" type="button">
          <div class="icon">
            <img src="{{ asset('assets/icone-video.png') }}" alt="Ícone de vídeo">
          </div>
        </button>

        <!-- Botão para localização -->
        <button class="action-button" onclick="pegarLocalizacao()" type="button">
          <div class="icon">
            <img src="{{ asset('assets/icone-localizacao.png') }}" alt="Ícone de localização">
          </div>
        </button>
      </div>

      <!-- Botão comentar -->
      <button class="comment-button" onclick="enviarPostagem()" type="button">Comentar</button>
    </div>
  </div>
  <script src="{{ asset('js/apoiarDenuncia.js') }}"></script>
</body>

</html>