<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fiscaliza+ | Índice de Assiduidade por Órgão</title>
  <link rel="stylesheet" href="{{ asset('css/feedback-orgao.css') }}">
  <script src="{{ asset('js/sidebar-loader.js') }}"></script>
  <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
</head>

<body>
  <div id="sidebar-container"></div>

  <header class="top-header">
    <div>
      <img src="{{ asset('assets/fiscaliza-logo.png') }}" alt="Fiscaliza+" class="brand-logo">
    </div>
    <div class="header-right">
      <div class="user-avatar">
        <img src="{{ asset('assets/foto_usuario.png') }}" alt="User profile">
      </div>
    </div>
  </header>

  <div class="main-content">
    <div class="assiduidade-container">
      <h1 class="page-title">Índice de assiduidade por orgão</h1>

      <div class="filter-section">
        <div class="dropdown">
          <button class="filter-button" id="filterBtn">Filtro: Categoria</button>
          <div class="dropdown-content" id="filterDropdown">
            <a onclick="filterByCategory('todos')">Todos</a>
            <a onclick="filterByCategory('obras')">Obras e Infraestrutura</a>
            <a onclick="filterByCategory('meio-ambiente')">Meio Ambiente</a>
            <a onclick="filterByCategory('transito')">Trânsito e Transportes</a>
            <a onclick="filterByCategory('saneamento')">Saneamento</a>
          </div>
        </div>

        <div class="dropdown">
          <button class="order-button" id="orderBtn">Ordenar por: Nota/Mais Avaliados</button>
          <div class="dropdown-content" id="orderDropdown">
            <a onclick="sortBy('rating-desc')">Maior Nota</a>
            <a onclick="sortBy('rating-asc')">Menor Nota</a>
            <a onclick="sortBy('response-asc')">Resposta Mais Rápida</a>
            <a onclick="sortBy('response-desc')">Resposta Mais Lenta</a>
            <a onclick="sortBy('name-asc')">Nome A-Z</a>
            <a onclick="sortBy('name-desc')">Nome Z-A</a>
          </div>
        </div>
      </div>

      <div class="orgao-list" id="orgaoList">
        <div class="orgao-item" data-category="obras" data-rating="4.2" data-response="3"
          data-name="Secretaria Municipal de Obras e Infraestrutura-RJ">
          <div class="orgao-info">
            <h3>Secretaria Municipal de Obras e Infraestrutura-RJ</h3>
            <button class="btn-details" onclick="showDetails('Secretaria Municipal de Obras e Infraestrutura-RJ')">Ver
              Detalhes</button>
          </div>
          <div class="orgao-metrics">
            <div class="rating">
              <span class="star filled">★</span>
              <span class="star filled">★</span>
              <span class="star filled">★</span>
              <span class="star filled">★</span>
              <span class="star empty">★</span>
              <span class="rating-value">(4.2)</span>
            </div>
            <button class="btn-avaliar"
              onclick="openRatingModal('Secretaria Municipal de Obras e Infraestrutura-RJ')">Avaliar</button>
          </div>
          <div class="orgao-response">
            <p class="response-time">Tempo médio de resposta: 3 dias</p>
          </div>
        </div>

        <div class="orgao-item" data-category="meio-ambiente" data-rating="3.5" data-response="5"
          data-name="Secretaria Municipal do Meio Ambiente-RS">
          <div class="orgao-info">
            <h3>Secretaria Municipal do Meio Ambiente-RS</h3>
            <button class="btn-details" onclick="showDetails('Secretaria Municipal do Meio Ambiente-RS')">Ver
              Detalhes</button>
          </div>
          <div class="orgao-metrics">
            <div class="rating">
              <span class="star filled">★</span>
              <span class="star filled">★</span>
              <span class="star filled">★</span>
              <span class="star empty">★</span>
              <span class="star empty">★</span>
              <span class="rating-value">(3.5)</span>
            </div>
            <button class="btn-avaliar"
              onclick="openRatingModal('Secretaria Municipal do Meio Ambiente-RS')">Avaliar</button>
          </div>
          <div class="orgao-response">
            <p class="response-time">Tempo médio de resposta: 5 dias</p>
          </div>
        </div>

        <div class="orgao-item" data-category="transito" data-rating="3.2" data-response="7"
          data-name="Secretaria Municipal de Trânsito e Transportes-BA">
          <div class="orgao-info">
            <h3>Secretaria Municipal de Trânsito e Transportes-BA</h3>
            <button class="btn-details" onclick="showDetails('Secretaria Municipal de Trânsito e Transportes-BA')">Ver
              Detalhes</button>
          </div>
          <div class="orgao-metrics">
            <div class="rating">
              <span class="star filled">★</span>
              <span class="star filled">★</span>
              <span class="star filled">★</span>
              <span class="star empty">★</span>
              <span class="star empty">★</span>
              <span class="rating-value">(3.2)</span>
            </div>
            <button class="btn-avaliar"
              onclick="openRatingModal('Secretaria Municipal de Trânsito e Transportes-BA')">Avaliar</button>
          </div>
          <div class="orgao-response">
            <p class="response-time">Tempo médio de resposta: 7 dias</p>
          </div>
        </div>

        <div class="orgao-item" data-category="saneamento" data-rating="3.2" data-response="11" data-name="Cagece-Ce">
          <div class="orgao-info">
            <h3>Cagece-Ce</h3>
            <button class="btn-details" onclick="showDetails('Cagece-Ce')">Ver Detalhes</button>
          </div>
          <div class="orgao-metrics">
            <div class="rating">
              <span class="star filled">★</span>
              <span class="star filled">★</span>
              <span class="star filled">★</span>
              <span class="star empty">★</span>
              <span class="star empty">★</span>
              <span class="rating-value">(3.2)</span>
            </div>
            <button class="btn-avaliar" onclick="openRatingModal('Cagece-Ce')">Avaliar</button>
          </div>
          <div class="orgao-response">
            <p class="response-time">Tempo médio de resposta: 11 dias</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de Avaliação -->
  <div id="ratingModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeRatingModal()">&times;</span>
      <h2>Avaliar Órgão</h2>
      <p id="orgaoName"></p>
      <div class="modal-stars" id="modalStars">
        <span class="modal-star" data-rating="1">★</span>
        <span class="modal-star" data-rating="2">★</span>
        <span class="modal-star" data-rating="3">★</span>
        <span class="modal-star" data-rating="4">★</span>
        <span class="modal-star" data-rating="5">★</span>
      </div>
      <div class="modal-buttons">
        <button class="modal-btn confirm" onclick="submitRating()">Confirmar</button>
        <button class="modal-btn cancel" onclick="closeRatingModal()">Cancelar</button>
      </div>
    </div>
  </div>
  <script src="{{ asset('js/feedback-orgao.js') }}"></script>
</body>

</html>