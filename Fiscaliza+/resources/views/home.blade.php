<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fiscaliza+ | Home</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
    rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">

</head>

<body>

  <!-- Top Header Bar -->
  <header class="top-header">
    <img src="{{ asset('assets/fiscaliza-logo.png') }}" alt="Fiscaliza+" class="brand-logo" />
    <div class="header-right">
      <button class="notification-btn">
        <i class="bi bi-bell"></i>
      </button>
      <div class="user-avatar">
        <img src="{{ asset('assets/foto_usuario.png') }}" alt="User profile" />
      </div>
    </div>
  </header>

  <!-- Sidebar -->
  <div id="sidebar-container"></div>

  <!-- Main Content Area -->
  <div class="main-content">
    <form action="{{ route('denuncia.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <!-- Create Report Card -->
      <div class="report-card">
        <div class="report-input">
          <div class="input-avatar">
            <img src="{{ asset('assets/foto_usuario.png') }}" alt="User avatar" />
          </div>
          <input type="text" class="input-field" placeholder="Comece uma denúncia" />
        </div>

        <div class="report-options">
          <button class="option-btn video">
            <i class="bi bi-play-circle-fill"></i>
            Vídeo
          </button>
          <button class="option-btn photo">
            <i class="bi bi-image"></i>
            Foto
          </button>
          <button class="option-btn location">
            <i class="bi bi-geo-alt-fill"></i>
            Localização
          </button>
          <!-- seus inputs -->
          <button type="submit" class="option-btn">Enviar</button>
    </form>

  </div>

  <input type="file" id="videoInput" accept="video/*" style="display: none;" />
  <input type="file" id="photoInput" accept="image/*" style="display: none;" />
  <input type="hidden" id="locationInput" />
  </div>

  <!-- Denúncias Dinâmicas -->
  @foreach ($denuncias as $denuncia)
    <div class="complaint-card">
    <div class="complaint-header">
      <div class="complaint-avatar">
      <img src="{{ asset('assets/foto_usuario.png') }}" alt="User avatar" />
      </div>
      <div>
      <h2 class="complaint-title">{{ $denuncia->titulo }}</h2>
      <p class="complaint-user">{{ $denuncia->usuario->nome ?? 'Usuário desconhecido' }}</p>
      <p class="complaint-location">{{ $denuncia->localizacao }}</p>
      </div>
    </div>

    <p class="complaint-text">
      {{ $denuncia->descricao }}
    </p>

    @if($denuncia->foto_path)
      <div style="text-align:center; margin-bottom: 10px;">
        <img 
          src="{{ asset('storage/' . $denuncia->foto_path) }}" 
          alt="Imagem da denúncia" 
          style="max-width: 100%; border-radius: 8px; box-shadow: 0 2px 8px #0001;"
        >
      </div>
    @endif

    @if($denuncia->video_path)
      <div style="text-align:center; margin-bottom: 10px;">
        <video controls style="max-width: 100%; border-radius: 8px; box-shadow: 0 2px 8px #0001;">
          <source src="{{ asset('storage/' . $denuncia->video_path) }}" type="video/mp4">
          Seu navegador não suporta o elemento de vídeo.
        </video>
      </div>
    @endif

    <div class="complaint-actions">
      <button class="action-btn primary-btn" onclick="abrirConteudo(this)">Abrir conteúdo</button>
      <button class="reaction-btn like" onclick="curtirDenuncia(this)">
        <i class="bi bi-hand-thumbs-up"></i> <span class="like-count">{{ $denuncia->likes }}</span>
      </button>
      <button class="reaction-btn comment" onclick="comentarDenuncia(this)">
        <i class="bi bi-chat-dots"></i>
      </button>
      <button class="reaction-btn share" onclick="compartilharDenuncia(this)">
        <i class="bi bi-share"></i>
      </button>
    </div>
    </div>
  @endforeach

  <!-- Modal Conteúdo -->
  <div class="modal fade" id="modalConteudo" tabindex="-1" aria-labelledby="modalConteudoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalConteudoLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body" id="modalConteudoBody"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Comentário -->
  <div class="modal fade" id="modalComentario" tabindex="-1" aria-labelledby="modalComentarioLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="formComentario" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalComentarioLabel">Adicionar Comentário</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <textarea class="form-control" id="inputComentario" rows="4"
            placeholder="Digite seu comentário aqui..."></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Enviar</button>
          <button>enviar</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Compartilhar -->
  <div class="modal fade" id="modalCompartilhar" tabindex="-1" aria-labelledby="modalCompartilharLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCompartilharLabel">Compartilhar Denúncia</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body" id="modalCompartilharBody"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  </div> <!-- Fim da div.main-content -->

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/sidebar-loader.js') }}"></script>
  <script src="{{ asset('js/home.js') }}"></script>

</body>

</html>