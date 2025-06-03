<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiscaliza+ | Enviar Mensagem</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
            color: white;
        }

        .logo-item {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .logo-item img {
            width: 60px;
            height: auto;
            object-fit: contain;
        }

        .menu-item {
            width: 100%;
            height: 50px;
            margin: 15px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .menu-item img {
            width: 26px;
            height: 26px;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        .bottom-icon {
            position: absolute;
            bottom: 20px;
            width: 100%;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .bottom-icon img {
            width: 26px;
            height: 26px;
            filter: brightness(0) invert(1);
        }

        .main-content {
            margin-left: 89px;
            width: calc(100% - 89px);
            min-height: 100vh;
            background-color: #e8f4fc;
            padding: 20px;
            position: relative;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-image {
            width: 150px;
            height: auto;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #ddd;
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-section {
            display: flex;
            align-items: flex-start;
            gap: 30px;
            margin-bottom: 30px;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .status-dropdown,
        .department-dropdown {
            background-color: #00e676;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 35px 10px 20px;
            font-size: 14px;
            margin-bottom: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            width: fit-content;
        }

        .dropdown-icon {
            margin-left: 10px;
        }

        /* Corrigido: Remoção da duplicação e definição correta */
        .message-container-wrapper {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            /* Alinhado à esquerda */
            width: 800px;
            margin-left: 0;
            margin-right: auto;
        }

        /* Adicionado: Definição para o card branco */
        .message-container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            width: 100%;
            flex-shrink: 0;
        }

        .message-area {
            background-color: white;
            border-radius: 10px;
            width: 100%;
            height: 120px;
            resize: none;
            border: 1px solid #ddd;
            color: #333;
            font-size: 16px;
            padding: 10px;
        }

        /* Modificado: Posicionamento do botão fora do card */
        .send-button-container {
            width: 100%;
            display: flex;
            justify-content: flex-start;
            /* Alterado para alinhar à esquerda */
            margin-top: 15px;
            /* Espaço entre o card e o botão */
        }


        .send-button {
            background-color: #00e676;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 12px 30px;
            font-size: 16px;
            cursor: pointer;
            width: 118px;
            height: 48px;
        }

        .reports-title {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .reports-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .report-card {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            height: 180px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .report-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .view-button {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #00e676;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 20px;
            font-size: 14px;
            cursor: pointer;
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
    <script src="{{ asset('js/sidebar-loader.js') }}"></script>
    <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
</head>

<body>
    <div id="sidebar-container"></div>

    <div class="main-content">
        <div class="header">
            <div class="logo-container">
                <img class="logo-image" src="{{ asset('assets/fiscaliza-logo.png') }}" alt="Logo Fiscaliza+">
            </div>
            <div class="user-avatar">
                <img src="{{ asset('assets/foto_usuario.png') }}" alt="Admin avatar">
            </div>
        </div>

        <div class="profile-section">
            <div class="profile-pic">
                <img src="{{ asset('assets/foto_usuario.png') }}" alt="User profile picture">
            </div>

            <div class="profile-info">
                <div class="status-dropdown">
                    Status
                    <svg class="dropdown-icon" width="12" height="12" viewBox="0 0 24 24">
                        <path d="M7 10l5 5 5-5z" fill="white"></path>
                    </svg>
                </div>
                <div class="department-dropdown">
                    Órgão destinatário
                    <svg class="dropdown-icon" width="12" height="12" viewBox="0 0 24 24">
                        <path d="M7 10l5 5 5-5z" fill="white"></path>
                    </svg>
                </div>
            </div>

            <div class="message-container-wrapper">
                <!-- Card branco com textarea -->
                <div class="message-container">
                    <textarea class="message-area" placeholder="Mande sua mensagem"></textarea>
                </div>
                <!-- Botão "Enviar" fora do card branco -->
                <div class="send-button-container">
                    <button class="send-button">Enviar</button>
                </div>
            </div>
        </div>

        <div class="reports-section">
            <div class="reports-title">Denúncias do Usuário</div>
            <div class="reports-grid">
                <div class="report-card">
                    <img src="{{ asset('assets/lixeira.png') }}" alt="Road collapse">
                    <button class="view-button">Visualizar</button>
                </div>
                <div class="report-card">
                    <img src="{{ asset('assets/lixeira.png') }}" alt="Car in pothole">
                    <button class="view-button">Visualizar</button>
                </div>
                <div class="report-card">
                    <img src="{{ asset('assets/lixeira.png') }}" alt="Garbage pile">
                    <button class="view-button">Visualizar</button>
                </div>
                <div class="report-card">
                    <img src="{{ asset('assets/lixeira.png') }}" alt="Open manhole">
                    <button class="view-button">Visualizar</button>
                </div>
                <div class="report-card">
                    <img src="{{ asset('assets/lixeira.png') }}" alt="Blue tarp">
                    <button class="view-button">Visualizar</button>
                </div>
                <div class="report-card">
                    <img src="{{ asset('assets/lixeira.png') }}" alt="Overflowing bin">
                    <button class="view-button">Visualizar</button>
                </div>
                <div class="report-card">
                    <img src="{{ asset('assets/lixeira.png') }}" alt="Police tape">
                    <button class="view-button">Visualizar</button>
                </div>
                <div class="report-card">
                    <img src="{{ asset('assets/lixeira.png') }}" alt="Trash bags">
                    <button class="view-button">Visualizar</button>
                </div>
                <div class="report-card">
                    <img src="{{ asset('assets/lixeira.png') }}" alt="Illegal dumping">
                    <button class="view-button">Visualizar</button>
                </div>
                <div class="report-card">
                    <img src="{{ asset('assets/lixeira.png') }}" alt="Waste pile">
                    <button class="view-button">Visualizar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>