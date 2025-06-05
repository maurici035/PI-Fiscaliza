<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Fiscaliza+ | Alterar Perfil</title>
  <script src="{{ asset('js/sidebar-loader.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/alterar-perfil-usuario.css') }}">
  <style>
    .message {
      padding: 12px 20px;
      margin-bottom: 20px;
      border-radius: 8px;
      font-weight: 500;
      text-align: center;
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

    /* Estilização dos textos dos botões */
    .btn {
      font-weight: 600;
      font-size: 14px;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      height: 32px;
      width: 120px;
      /* Largura fixa para todos os botões */
      padding: 0 15px;
      box-sizing: border-box;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      color: white;
      text-decoration: none;
    }

    .btn.green {
      font-weight: 700;
      background-color: rgb(0, 192, 89);
    }

    .btn.green:hover {
      background-color: #15d26c;
    }

    .btn.cancel {
      background-color: #6c757d;
      color: white;
    }

    .btn.cancel:hover {
      background-color: #545b62;
    }

    /* Melhor alinhamento dos botões na segunda coluna */
    .form-column:last-child {
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 15px;
    }

    .form-column:last-child .form-group {
      margin-bottom: 0;
      width: 100%;
    }

    /* Botão específico para "Alterar senha" - largura maior para o texto não quebrar */
    #btn-alterar-senha {
      width: 140px !important;
      white-space: nowrap;
    }

    .form-group small {
      display: block;
      margin-top: 5px;
      color: #666;
      font-size: 12px;
    }

    .profile-image {
      cursor: pointer;
      transition: opacity 0.3s ease;
    }

    .profile-image:hover {
      opacity: 0.8;
    }

    .checkbox-container {
      margin-top: 30px;
      padding: 6px 8px;
      background-color: #f9f9f9;
      border-radius: 4px;
      border: 1px solid #ddd;
      max-width: 200px;
      min-width: 100px;
    }

    .checkbox-container label {
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-size: 12px;
      color: #555;
      margin: 0;
    }

    .checkbox-container input[type="checkbox"] {
      margin-right: 0;
      transform: scale(0.8);
      width: 80%;
    }

    /* Estilo para indicar que a foto é clicável */
    .profile-image-container {
      position: relative;
      display: inline-block;
    }

    .profile-image-container::after {
      content: "Clique na imagem para alterar";
      position: absolute;
      bottom: -20px;
      left: 50%;
      transform: translateX(-50%);
      font-size: 11px;
      color: #666;
      white-space: nowrap;
    }

    /* Estilos do Modal */
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .modal-overlay.active {
      display: flex;
    }

    .modal {
      background: white;
      padding: 30px;
      border-radius: 12px;
      min-width: 400px;
      max-width: 500px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .modal h3 {
      margin-top: 0;
      margin-bottom: 20px;
      color: #333;
      text-align: center;
    }

    .modal input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 2px solid #ddd;
      border-radius: 8px;
      font-size: 14px;
      box-sizing: border-box;
    }

    .modal input[type="password"]:focus {
      border-color: #17E979;
      outline: none;
    }

    .modal-buttons {
      display: flex;
      gap: 10px;
      justify-content: flex-end;
      align-items: center;
      margin-top: 20px;
    }

    .modal-buttons .btn {
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      font-weight: 600;
      text-transform: uppercase;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .modal-buttons .btn.confirm {
      background-color: rgb(0, 192, 89);
      color: white;
    }

    .modal-buttons .btn.confirm:hover {
      background-color: #15d26c;
    }
  </style>
</head>

<body>
  <div id="sidebar-container"></div>
  <header class="page-header">
    <img src="{{ asset('assets/fiscaliza-logo.png') }}" alt="Logo Fiscaliza+" class="logo">
  </header>

  <div class="container">
    <div class="form-box">
      <h2>Alterar Perfil do Usuário</h2>
      <hr />

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

      @if($errors->any())
      <div class="message error">
      @foreach ($errors->all() as $error)
      <p>{{ $error }}</p>
    @endforeach
      </div>
    @endif

      <form id="profile-form" method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="profile-section">
          <div class="profile-left">
            <div class="profile-image-container">
              <img src="{{ $usuario->foto_perfil_url }}" alt="Foto do usuário" class="profile-image"
                id="preview-image" />
            </div>

            <!-- Input escondido para seleção de arquivo -->
            <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*" onchange="previewImage(event)"
              style="display: none;" />

            @if($usuario->foto_perfil)
        <div class="checkbox-container">
          <label>
          <input type="checkbox" name="remover_foto" value="1"> Remover foto atual
          </label>
        </div>
      @endif
          </div>

          <div class="profile-right">
            <div class="form-column">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Digite seu email"
                  value="{{ old('email', $usuario->email) }}" required />
              </div>

              <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo"
                  value="{{ old('nome', $usuario->nome) }}" required minlength="3" />
              </div>

              <div class="form-group">
                <button type="button" class="btn green" id="btn-alterar-senha">Alterar senha</button>
              </div>
            </div>

            <div class="form-column">
              <div class="form-group">
                <button type="submit" class="btn green">Salvar</button>
              </div>

              <div class="form-group">
                <a href="{{ route('perfil') }}" class="btn cancel">Voltar</a>
              </div>
            </div>
          </div>
        </div>
        <div class="message" id="form-message"></div>
      </form>
    </div>
  </div>

  <!-- Modal alteração de senha -->
  <div class="modal-overlay" id="modal-overlay">
    <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
      <h3 id="modal-title">Alterar Senha</h3>
      <input type="password" id="nova-senha" placeholder="Digite a nova senha" minlength="6" />
      <input type="password" id="confirma-senha" placeholder="Confirme a nova senha" minlength="6" />
      <div class="message" id="modal-message"></div>
      <div class="modal-buttons">
        <button class="btn cancel" id="cancelar-senha">Cancelar</button>
        <button class="btn confirm" id="confirmar-senha">Confirmar</button>
      </div>
    </div>
  </div>

  <script>
    function previewImage(event) {
      const file = event.target.files[0];
      const previewImg = document.getElementById('preview-image');
      const removerFotoCheckbox = document.querySelector('input[name="remover_foto"]');

      if (file) {
        // Verificar tamanho do arquivo (2MB = 2 * 1024 * 1024 bytes)
        if (file.size > 2 * 1024 * 1024) {
          alert('O arquivo é muito grande. O tamanho máximo é 2MB.');
          event.target.value = '';
          return;
        }

        // Verificar tipo do arquivo
        if (!file.type.match('image.*')) {
          alert('Por favor, selecione apenas arquivos de imagem.');
          event.target.value = '';
          return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
          previewImg.src = e.target.result;
        };
        reader.readAsDataURL(file);

        // Desmarcar checkbox de remover foto se uma nova foto foi selecionada
        if (removerFotoCheckbox) {
          removerFotoCheckbox.checked = false;
        }
      }
    }

    // Permitir clicar na imagem para abrir o seletor de arquivo
    document.getElementById('preview-image').addEventListener('click', function () {
      document.getElementById('foto_perfil').click();
    });

    // Resetar preview quando marcar para remover foto
    document.addEventListener('DOMContentLoaded', function () {
      const removerFotoCheckbox = document.querySelector('input[name="remover_foto"]');
      if (removerFotoCheckbox) {
        removerFotoCheckbox.addEventListener('change', function () {
          if (this.checked) {
            document.getElementById('preview-image').src = "{{ Auth::user()->foto_perfil_url }}";
            document.getElementById('foto_perfil').value = '';
          }
        });
      }

      // Controle do Modal de Alteração de Senha
      const btnAlterarSenha = document.getElementById('btn-alterar-senha');
      const modalOverlay = document.getElementById('modal-overlay');
      const btnCancelar = document.getElementById('cancelar-senha');
      const btnConfirmar = document.getElementById('confirmar-senha');
      const inputNovaSenha = document.getElementById('nova-senha');
      const inputConfirmaSenha = document.getElementById('confirma-senha');
      const modalMessage = document.getElementById('modal-message');

      // Abrir modal
      btnAlterarSenha.addEventListener('click', function () {
        modalOverlay.classList.add('active');
        inputNovaSenha.value = '';
        inputConfirmaSenha.value = '';
        modalMessage.innerHTML = '';
        inputNovaSenha.focus();
      });

      // Fechar modal
      btnCancelar.addEventListener('click', function () {
        modalOverlay.classList.remove('active');
      });

      // Fechar modal clicando no overlay
      modalOverlay.addEventListener('click', function (e) {
        if (e.target === modalOverlay) {
          modalOverlay.classList.remove('active');
        }
      });

      // Confirmar alteração de senha
      btnConfirmar.addEventListener('click', function () {
        const novaSenha = inputNovaSenha.value;
        const confirmaSenha = inputConfirmaSenha.value;

        // Limpar mensagens anteriores
        modalMessage.innerHTML = '';
        modalMessage.className = 'message';

        // Validações
        if (!novaSenha || !confirmaSenha) {
          modalMessage.innerHTML = 'Por favor, preencha todos os campos.';
          modalMessage.classList.add('error');
          return;
        }

        if (novaSenha.length < 6) {
          modalMessage.innerHTML = 'A senha deve ter pelo menos 6 caracteres.';
          modalMessage.classList.add('error');
          return;
        }

        if (novaSenha !== confirmaSenha) {
          modalMessage.innerHTML = 'As senhas não coincidem.';
          modalMessage.classList.add('error');
          return;
        }

        // Enviar requisição para alterar senha
        fetch('{{ route("perfil.alterarSenha") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
          },
          body: JSON.stringify({
            nova_senha: novaSenha,
            confirmar_senha: confirmaSenha
          })
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              modalMessage.innerHTML = 'Senha alterada com sucesso!';
              modalMessage.classList.add('success');
              setTimeout(() => {
                modalOverlay.classList.remove('active');
              }, 2000);
            } else {
              modalMessage.innerHTML = data.message || 'Erro ao alterar senha.';
              modalMessage.classList.add('error');
            }
          })
          .catch(error => {
            console.error('Erro:', error);
            modalMessage.innerHTML = 'Erro interno. Tente novamente.';
            modalMessage.classList.add('error');
          });
      });

      // Permitir fechar modal com ESC
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modalOverlay.classList.contains('active')) {
          modalOverlay.classList.remove('active');
        }
      });
    });
  </script>

  <!-- JavaScript temporariamente desabilitado para debug -->
  <!-- <script src="{{ asset('js/alterar-perfil-usuario.js') }}"></script> -->


</html>