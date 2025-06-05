<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fiscaliza+ | Alterar Senha</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #D1DCE8;
      color: black;
      display: flex;
    }

    aside {
      width: 75px;
      background-color: #0489CA;
      height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding-top: 20px;
    }

    aside img {
      width: 40px;
      margin-bottom: 30px;
    }

    aside nav a {
      display: block;
      margin: 20px 0;
      text-decoration: none;
      color: #ccc;
    }

    .logo {
      font-size: 24px;
      font-weight: bold;
      color: #00b3ff;
      margin-left: 20px;
    }

    .main-container {
      flex: 1;
      padding: 40px;
    }

    .card {
      background-color: white;
      border-radius: 12px;
      padding: 30px;
      max-width: 600px;
      margin: 0 auto;
    }

    .card h1 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      margin-bottom: 20px;
    }

    label {
      margin-bottom: 5px;
      font-weight: 600;
    }

    input[type="password"] {
      padding: 10px;
      border-radius: 8px;
      border: none;
      background-color: #e6e6e6;
      color: #000;
    }

    .button {
      background-color: #17E979;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      margin-top: 10px;
    }
    @media (max-width: 420px) {
            .profile-section {
                flex-direction: column;
                align-items: center;
            }
            
            .message-container-wrapper {
                width: 100%;
                margin-top: 20px;
            }
            
            .profile-info {
                align-items: center;
            }
        }
  </style>
  <script src="{{ asset('js/sidebar-loader.js') }}"></script>
  <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
</head>

<body>
  <div id="sidebar-container"></div>
  <div class="main-container">
    <div class="logo">Fiscaliza<span style="color:#00d4ff">+</span></div>
    <div class="card">
      <h1>Alterar Senha</h1>
      <form onsubmit="alterarSenha(event)">
        <div class="form-group">
          <label for="senha-atual">Senha atual*</label>
          <input type="password" id="senha-atual" required>
        </div>

        <div class="form-group">
          <label for="nova-senha">Nova senha*</label>
          <input type="password" id="nova-senha" required>
        </div>

        <div class="form-group">
          <label for="confirmar-senha">Confirmar nova senha*</label>
          <input type="password" id="confirmar-senha" required>
        </div>

        <button type="submit" class="button">Salvar nova senha</button>
      </form>
    </div>
  </div>

  <script>
    function alterarSenha(event) {
      event.preventDefault();
      const atual = document.getElementById('senha-atual').value;
      const nova = document.getElementById('nova-senha').value;
      const confirmar = document.getElementById('confirmar-senha').value;

      if (nova !== confirmar) {
        alert("As novas senhas não coincidem.");
        return;
      }

      // Simulação de alteração de senha
      alert("Senha alterada com sucesso!");
    }
  </script>
</body>

</html>