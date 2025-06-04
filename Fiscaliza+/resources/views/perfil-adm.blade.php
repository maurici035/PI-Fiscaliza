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
      width: 200px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 10px;
      border: 3px solid white;
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
      min-height: 500px;
      display: flex;
      flex-direction: column;
      gap: 20px;
      box-shadow: 0 0 15px #000000(0, 0, 0, 0.5);
    }

    .info {
      background-color: #D9D9D9;
      padding: 16px 22px;
      border-radius: 10px;
      font-weight: 600;
      font-size: 16px;
    }

    .btn-info {
      background-color: #D9D9D9;
      padding: 16px 22px;
      padding-right: 600px;
      border-radius: 10px;
      font-weight: 600;
      font-size: 16px;
      color: black;
    }

    .btn-info2 {
      background-color: #D9D9D9;
      padding: 16px 22px;
      padding-right: 660px;
      border-radius: 10px;
      font-weight: 600;
      font-size: 16px;
      color: black;
    }


    .btn-alterar {
      margin-top: 15px;
      padding: 14px 24px;
      background-color: #17E979;
      border: none;
      color: #fff;
      font-weight: bold;
      border-radius: 10px;
      cursor: pointer;
      transition: background 0.3s ease;
      font-size: 16px;
      width: 130px;
      align-self: flex-start;
    }

    .btn-alterar:hover {
      background-color: #17E979;
    }
    @media (max-width: 900px) {
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
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script src="{{ asset('js/sidebar-loader.js') }}"></script>
  <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
</head>

<body>
  <div id="sidebar-container"></div>

  <div class="main">
    <h1 class="title">Fiscaliza<span>+</span></h1>

    <img src="{{ asset('assets/foto_usuario.png') }}" alt="Foto do Administrador" class="profile-img">
    <div class="profile-name">Perfil Do Administrador</div>

    <div class="profile-box">
      <div class="info">Perfil: Administrador</div>
      <div class="info">E-mail: administrador@gmail.com</div>
      <div class="info">Data De Nascimento: 22/06/1998</div>
      <button class="btn-info">Gerenciador de Usuários</button>
      <button class="btn-info2">Gerar relatórios</button>
      <button class="btn-alterar">Alterar</button>
    </div>
  </div>
</body>

</html>