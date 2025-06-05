<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Fiscaliza+ | Detalhes do Órgão</title>
    <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
    <script src="{{ asset('js/sidebar-loader.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/avaliacao-orgao.css') }}">
</head>

<body>
    <div id="sidebar-container"></div>

    <div class="main-content">
        <div class="header">
            <div class="brand-name">
                <img src="{{ asset('assets/fiscaliza-logo.png') }}" alt="logo-fiscaliza+">
            </div>
            <div class="profile-pic">
                <img src="{{ Auth::user()->foto_perfil_url }}" alt="Foto de perfil">
            </div>
        </div>

        <div class="content-card">
            <h3>Detalhes do órgão</h3>

            <div class="orgao-info">
                <strong>Secretaria Municipal de Obras e Infraestrutura-RJ</strong><br>
                (4.2)
            </div>

            <div class="orgao-info">
                <strong>Média de Resolução: 3 dias</strong>
            </div>

            <hr>

            <h3>Últimas Avaliações</h3>

            <div class="avaliacao">
                <strong>Kalo Durten :</strong> ★★★★☆ <strong>- "Atendeu rápido, mas poderia melhorar."</strong>
            </div>

            <div class="avaliacao">
                <strong>Luis Cesar :</strong> ★★★★☆ <strong>- "Demorou mais que o esperado."</strong>
            </div>

            <hr>

            <h3>Sua Avaliação:</h3>
            <div id="avaliacao-estrelas">
                <span class="star" data-value="1">★</span>
                <span class="star" data-value="2">★</span>
                <span class="star" data-value="3">★</span>
                <span class="star" data-value="4">★</span>
                <span class="star" data-value="5">★</span>
            </div>

            <textarea id="comentario" placeholder="Escreva um comentário sobre sua experiência..."></textarea>
            <button onclick="enviarAvaliacao()">Enviar Avaliação</button>
        </div>
    </div>

    <script src="{{ asset('js/avaliacao-orgao.js') }}"></script>

</body>

</html>