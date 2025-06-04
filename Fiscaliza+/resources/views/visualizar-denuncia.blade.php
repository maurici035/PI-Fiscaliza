<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fiscaliza+ | Visualizar Denúncia</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="{{ asset('js/sidebar-loader.js') }}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #ececec;
      color: #222;
      min-height: 100vh;
    }
    .main-content {
      margin-left: 90px;
      padding: 20px;
      min-height: 100vh;
      box-sizing: border-box;
      padding-top: 120px;
    }
    .complaint-card {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 8px #0001;
      padding: 2rem;
      margin: 2rem auto;
      max-width: 600px;
    }
    .complaint-header {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 10px;
    }
    .complaint-avatar img {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      object-fit: cover;
    }
    .complaint-title {
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 0;
    }
    .complaint-user {
      color: #555;
      font-size: 1rem;
      margin-bottom: 0;
    }
    .complaint-location {
      color: #888;
      font-size: 0.95rem;
      margin-bottom: 0;
    }
    .complaint-date {
      color: #888;
      font-size: 0.95rem;
      margin-bottom: 0;
    }
    .complaint-text {
      margin: 1.5rem 0;
      font-size: 1.1rem;
    }
    .complaint-actions {
      display: flex;
      gap: 1rem;
      margin-bottom: 1rem;
    }
    .btn-comentar {
      background: #17e979 !important;
      color: #fff !important;
      border: none !important;
      min-width: 160px;
      min-height: 44px;
      font-weight: 600;
      border-radius: 6px;
      transition: background 0.2s;
    }
    .btn-comentar:hover {
      background: #13c76b !important;
    }
    .btn-compartilhar {
      background: #4fc3f7 !important;
      color: #fff !important;
      border: none !important;
      min-width: 160px;
      min-height: 44px;
      font-weight: 600;
      border-radius: 6px;
      transition: background 0.2s;
    }
    .btn-compartilhar:hover {
      background: #039be5 !important;
    }
    .complaint-image, .complaint-video {
      max-width: 100%;
      border-radius: 8px;
      margin-bottom: 1rem;
      box-shadow: 0 2px 8px #0001;
    }
    .comment-list {
      margin-top: 2rem;
    }
    .comment-item {
      background: #f1f3f6;
      border-radius: 8px;
      padding: 1rem;
      margin-bottom: 1rem;
    }
    .comment-user {
      font-weight: bold;
    }
    .comment-date {
      color: #888;
      font-size: 0.9rem;
    }
    .top-header {
      height: 70px;
      background-color: #ececec;
      color: white;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
      padding-right: 50px;
      position: fixed;
      top: 0;
      z-index: 1000;
    }
    .brand-logo {
      margin-left: 100px;
    }
    .user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      overflow: hidden;
      background-color: #555;
    }
    .user-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .top-right-image {
      position: absolute;
      top: 20px;
      right: 30px;
    }
    .profile-image {
      width: 48px;
      height: 48px;
      border-radius: 50%;
    }
  </style>
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

  <div id="sidebar-container"></div>

  <div class="main-content">
    <div class="complaint-card" data-denuncia-id="{{ $denuncia->id }}">
      <div class="complaint-header">
        <div class="complaint-avatar">
          <img src="{{ asset('assets/foto_usuario.png') }}" alt="User avatar" />
        </div>
        <div>
          <h2 class="complaint-title">{{ $denuncia->titulo }}</h2>
          <p class="complaint-user">{{ $denuncia->usuario->nome ?? $denuncia->nome_usuario ?? 'Usuário desconhecido' }}</p>
          <p class="complaint-location">
            <i class="bi bi-geo-alt"></i>
            {{ $denuncia->localizacao ?? ($denuncia->latitude && $denuncia->longitude ? $denuncia->latitude . ', ' . $denuncia->longitude : '') }}
          </p>
          <p class="complaint-date">
            <i class="bi bi-calendar-event"></i>
            {{ $denuncia->created_at->format('d/m/Y H:i') }}
          </p>
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
            class="complaint-image"
          >
        </div>
      @endif

      @if($denuncia->video_path)
        <div style="text-align:center; margin-bottom: 10px;">
          <video controls class="complaint-video">
            <source src="{{ asset('storage/' . $denuncia->video_path) }}" type="video/mp4">
            Seu navegador não suporta o elemento de vídeo.
          </video>
        </div>
      @endif

      <div class="complaint-actions">
        <button class="btn-comentar" onclick="comentarDenuncia(this, {{ $denuncia->id }})" title="Comentar">
          <i class="bi bi-chat-dots"></i> Comentar
        </button>
        <button class="btn-compartilhar" onclick="compartilharDenuncia(this)" title="Compartilhar">
          <i class="bi bi-share"></i> Compartilhar
        </button>
      </div>
    </div>

    <!-- Lista de comentários -->
    <div class="comment-list">
      <h5>Comentários</h5>
      @forelse($denuncia->comentarios as $comentario)
        <div class="comment-item">
          <div class="comment-user">
            <i class="bi bi-person"></i>
            {{ $comentario->usuario->nome ?? 'Anônimo' }}
            <span class="comment-date float-end">{{ $comentario->created_at->format('d/m/Y H:i') }}</span>
          </div>
          <div>{{ $comentario->conteudo }}</div>
        </div>
      @empty
        <div class="text-muted">Nenhum comentário ainda.</div>
      @endforelse
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
          <button type="submit" class="btn btn-primary">Enviar</button>
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

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script>
    // Funções JS integradas para comentar e compartilhar
    let denunciaIdSelecionada = null;
    let modalComentario = new bootstrap.Modal(document.getElementById('modalComentario'));
    let modalCompartilhar = new bootstrap.Modal(document.getElementById('modalCompartilhar'));

    window.comentarDenuncia = function(button, denunciaId) {
      document.getElementById('inputComentario').value = '';
      denunciaIdSelecionada = denunciaId;
      modalComentario.show();
    };

    document.getElementById('formComentario').addEventListener('submit', function (e) {
      e.preventDefault();
      const texto = document.getElementById('inputComentario').value.trim();
      if (texto.length === 0) {
        alert('Por favor, digite um comentário antes de enviar.');
        return;
      }
      if (!denunciaIdSelecionada) {
        alert('Erro interno: denúncia não selecionada.');
        return;
      }

      fetch('/comentario', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
          denuncia_id: denunciaIdSelecionada,
          texto: texto
        })
      })
      .then(response => response.json())
      .then(data => {
        alert('Comentário enviado com sucesso!');
        document.getElementById('inputComentario').value = '';
        modalComentario.hide();
        window.location.reload(); // Recarrega para mostrar o novo comentário
      })
      .catch(error => {
        alert('Erro ao enviar comentário');
        console.error(error);
      });
    });

    window.compartilharDenuncia = function(button) {
      const card = button.closest('.complaint-card');
      const denunciaId = card.getAttribute('data-denuncia-id');
      const url = `${window.location.origin}/denuncia/${denunciaId}`;

      document.getElementById('modalCompartilharLabel').innerText = `🔗 Compartilhar denúncia`;
      document.getElementById('modalCompartilharBody').innerHTML = `
        <input type="text" class="form-control" value="${url}" readonly style="margin-bottom:10px;">
        <button class="btn btn-success" onclick="navigator.clipboard.writeText('${url}')">Copiar link</button>
        <a href="${url}" target="_blank" class="btn btn-primary" style="margin-left:10px;">Abrir denúncia</a>
      `;

      modalCompartilhar.show();
    };
  </script>
</body>
</html>