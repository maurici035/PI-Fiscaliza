<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Fiscaliza+ | Detalhes do orgão e avaliações ADM</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-user-select: none;
            user-select: none;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            overflow: hidden;
            position: fixed;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
            display: flex;
            touch-action: none;
            overscroll-behavior: none;
        }

        /* Main Content corrigido */
        .main-content {
            flex: 1;
            padding: 20px 40px;
            margin-left: 89px;
            height: 100vh;
            overflow-y: auto;
            position: relative;
        }

        /* Header reorganizado */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            width: 100%;
        }

        .brand-name {
            height: 40px;
        }

        .brand-name img {
            height: 100%;
        }

        /* Foto de perfil corrigida */
        .profile-pic {
            width: 55px;
            height: 54px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Content Card ajustado */
        .content-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 30px;
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            min-height: 500px;
        }

        /* Seus estilos de conteúdo */
        h2 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        h3 {
            font-size: 16px;
            margin: 15px 0 10px;
            color: #2c3e50;
        }

        hr {
            border: none;
            border-top: 1px solid #eee;
            margin: 20px 0;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s;
            margin-top: 15px;
            width: 100%;
        }

        button:hover {
            background-color: #43a047;
        }

        .orgao-info,
        .avaliacao {
            margin-bottom: 15px;
            line-height: 1.8;
        }

        .avaliacao {
            padding: 12px;
            background-color: #f9f9f9;
            border-radius: 6px;
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

    <div class="main-content">
        <div class="header">
            <div class="brand-name">
                <img src="{{ asset('assets/fiscaliza-logo.png') }}" alt="logo-fiscaliza+">
            </div>
            <div class="profile-pic">
                <img src="{{ asset('assets/foto_usuario.png') }}" alt="Foto de perfil">
            </div>
        </div>

        <div class="content-card">
            <h2>Fiscaliza+</h2>
            <h3>Detalhes do orgão</h3>

            <div class="orgao-info">
                <strong>Secretaria Municipal de Obras e Infraestrutura-RJ</strong><br>
                (4.2)
            </div>

            <div class="orgao-info">
                <strong>Média De Resolução: 3 dias</strong>
            </div>

            <hr>

            <h3>Últimas Avaliações</h3>

            <div class="avaliacao">
                <strong>Kalo Durten :</strong> ✅✅✅✅ <strong>- "Atendeu rápido, mas poderia melhorar."</strong>
            </div>

            <div class="avaliacao">
                <strong>Luis Cesar :</strong> ✅✅✅✅ <strong>- "Demorou mais que o esperado."</strong>
            </div>

            <hr>

            <h3>Sua Avaliação: <span class="rating">✅✅✅✅✅</span></h3>

            <button>Enviar Avaliação</button>
        </div>
    </div>

    <script>
        // Bloqueia rolagem da página (mas permite dentro do content-card)
        document.addEventListener('touchmove', function (e) {
            if (!e.target.closest('.main-content')) {
                e.preventDefault();
            }
        }, { passive: false });

        document.addEventListener('wheel', function (e) {
            if (!e.target.closest('.main-content') && !e.ctrlKey) {
                e.preventDefault();
            }
        }, { passive: false });
    </script>
</body>

</html>