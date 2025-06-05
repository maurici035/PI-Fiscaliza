<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiscaliza+ | Gerenciar Denúncias</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            display: flex;
            /* Para alinhar a sidebar e o conteúdo principal */
            min-height: 100vh;
        }

        /* Estilo do conteúdo principal */
        .main-content {
            flex: 1;
            /* Ocupa o restante do espaço disponível */
            padding: 20px;
            margin-left: 10px;
            max-width: calc(100% - 100px);
            margin-right: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo {
            color: #0288d1;
            font-size: 24px;
            font-weight: bold;
        }

        .profile-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }

        .profile-img {
            width: 125px;
            height: 125px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #0288d1;
            /* Borda azul ao redor da imagem de perfil */
        }

        .profile-name {
            background-color: #0288d1;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
        }

        /* Estilo para os títulos das seções "Concluídas" e "Não Aceitas" */
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: white;
            /* Cor do texto branca */
            margin-bottom: 15px;
            padding: 8px 15px;
            background-color: #0288d1;
            /* Fundo azul como no design */
            border-radius: 20px;
            /* Cantos arredondados */
            display: inline-block;
            /* Para que o background e padding envolvam o texto */
            margin-bottom: 20px;
            margin-top: 40px;
        }

        .gallery-container {
            max-width: 1200px;
            /* Largura máxima para a galeria */
            margin: 0 auto;
            /* Centraliza a galeria na página */
            padding: 20px;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 20px;
            /* Espaçamento entre os itens da galeria */
            margin-bottom: 30px;
            margin: 0 auto;
            /* Centraliza a galeria */
        }

        .gallery-item {
            position: relative;
            border-radius: 30px;
            overflow: hidden;
            cursor: pointer;
            max-width: 179px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Sombra para dar efeito de card */
            background-color: white;
            /* Fundo branco para os itens da galeria */
        }

        .gallery-img {
            width: 179px;
            height: 279px;
            object-fit: cover;
            /* Garante que a imagem cubra a área sem distorcer */
            display: block;
        }

        .visualize-btn {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #00e676;
            /* Verde como no design */
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            /* Sombra para o botão */
        }

        .settings-icon {
            cursor: pointer;
            background-color: white;
            /* Fundo branco para o ícone de engrenagem */
            border-radius: 50%;
            padding: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: #0288d1;
            /* Cor azul para a engrenagem */
            font-size: 20px;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <script src="{{ asset('js/sidebar-loader.js') }}"></script>
    <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
</head>

<body>
    <div id="sidebar-container"></div>


    <div class="main-content">
        <div class="header">
            <img src="{{ asset('assets/fiscaliza-logo.png') }}" alt="" class="logo">
            <img src="{{ Auth::user()->foto_perfil_url }}" alt="Foto de perfil" class="profile-pic">
        </div>

        <div class="profile-section">
            <img src="{{ Auth::user()->foto_perfil_url }}" alt="Profile" class="profile-img">
            <div class="profile-name">Maria Rita</div>
        </div>

        <div class="gallery-container">
            <div class="section-title">Concluídas</div>

            <div class="gallery" id="gallery-completed">
            </div>

            <div class="section-title">Não Aceitas</div>

            <div class="gallery" id="gallery-rejected">
            </div>
        </div>
    </div>

    <script>
        const completedReports = [
            { id: 1, imageUrl: "{{ asset('assets/buraco_na_faixa.png') }}" },
            { id: 2, imageUrl: "{{ asset('assets/caçamba-de-lixo.png') }}" },
            { id: 3, imageUrl: "{{ asset('assets/cesta-de-lixo.png') }}" },
            { id: 4, imageUrl: "{{ asset('assets/estrada_de_terra.jpg') }}" },
            { id: 5, imageUrl: "{{ asset('assets/escombros.png') }}" },
            { id: 6, imageUrl: "{{ asset('assets/estrada_de_terra.jpg') }}" }
        ];

        const rejectedReports = [
            { id: 7, imageUrl: "{{ asset('assets/monte_de_lixo.jpg') }}" },
            { id: 8, imageUrl: "{{ asset('assets/monte_de_lixo.jpg') }}" },
            { id: 9, imageUrl: "{{ asset('assets/monte_de_lixo.jpg') }}" },
            { id: 10, imageUrl: "{{ asset('assets/monte_de_lixo.jpg') }}" },
            { id: 11, imageUrl: "{{ asset('assets/monte_de_lixo.jpg') }}" },
            { id: 12, imageUrl: "{{ asset('assets/monte_de_lixo.jpg') }}" }
        ];

        // Função para criar os itens da galeria
        function createGalleryItems(reports, galleryId) {
            const gallery = document.getElementById(galleryId);
            gallery.innerHTML = ''; // Limpa conteúdo existente para evitar duplicação

            reports.forEach(report => {
                const galleryItem = document.createElement('div');
                galleryItem.className = 'gallery-item';

                const img = document.createElement('img');
                img.src = report.imageUrl;
                img.className = 'gallery-img';
                img.alt = 'Report ' + report.id;

                const button = document.createElement('button');
                button.className = 'visualize-btn';
                button.textContent = 'Visualizar';

                galleryItem.appendChild(img);
                galleryItem.appendChild(button);
                gallery.appendChild(galleryItem);
            });
        }

        // Inicializa as galerias quando o DOM estiver carregado
        document.addEventListener('DOMContentLoaded', function () {
            createGalleryItems(completedReports, 'gallery-completed');
            createGalleryItems(rejectedReports, 'gallery-rejected');
        });
    </script>
</body>

</html>