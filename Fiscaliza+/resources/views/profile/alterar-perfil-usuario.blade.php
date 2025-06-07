<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fiscaliza+ | Alterar Perfil</title>
  <script src="../../public/js/sidebar-loader.js"></script>
  <link rel="stylesheet" href="../../public/css/alterar-perfil-usuario.css">
</head>

<body>
  <div id="sidebar-container"></div>
  <header class="page-header">
    <img src="../assets/fiscaliza+-name.png" alt="Logo Fiscaliza+" class="logo">
  </header>

  <div class="container">
    <div class="form-box">
      <h2>Cadastro do Usuário</h2>
      <hr />

      <form id="profile-form" novalidate>
        <div class="profile-section">
          <div class="profile-left">
            <img src="../assets/foto_usuario.png" alt="Foto do usuário" class="profile-image" />
          </div>

          <div class="profile-right">
            <div class="form-column">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Digite seu email" required />
              </div>

              <div class="form-group">
                <label for="nascimento">Data de Nascimento</label>
                <input type="text" id="nascimento" name="nascimento" placeholder="dd/mm/aaaa" required
                  pattern="^(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/\d{4}$" />
              </div>

              <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required
                  minlength="3" />
              </div>

              <div class="form-group">
                <button type="button" class="btn green" id="btn-alterar-senha">Alterar senha</button>
              </div>
            </div>

            <div class="form-column">
              <div class="form-group">
                <label for="telefone1">Telefone 1</label>
                <input type="tel" id="telefone1" name="telefone1" placeholder="(00) 00000-0000"
                  pattern="^\(\d{2}\) \d{4,5}-\d{4}$" />
              </div>

              <div class="form-group">
                <label for="telefone2">Telefone 2</label>
                <input type="tel" id="telefone2" name="telefone2" placeholder="(00) 00000-0000"
                  pattern="^\(\d{2}\) \d{4,5}-\d{4}$" />
              </div>

              <div class="form-group">
                <button type="submit" class="btn green">Salvar</button>
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

  <script src="../../public/js/alterar-perfil-usuario.js"></script>


</html>