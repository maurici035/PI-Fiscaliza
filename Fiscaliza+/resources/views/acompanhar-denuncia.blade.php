<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fiscaliza+ | Acompanhar Denúncia</title>
  <link rel="stylesheet" href="{{ asset('css/acompanhar-denuncia.css') }}">
  <script src="{{ asset('js/sidebar-loader.js') }}"></script>
  <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
</head>

<body>
  <div id="sidebar-container"></div>

  <div class="main-content">
  <div class="header">
    <div class="brand-name">
      <img src="../assets/fiscaliza+-name.png" alt="">
    </div>
    <h1>Acompanhar Denúncia</h1>
    <div class="header-right">
      <img src="../assets/girl user.png" alt="Foto de perfil" class="profile-pic">
    </div>
  </div>

  <div class="complaints-sections">
    <button class="filter-button" id="toggleFilterBtn">
      <img src="../assets/seta-filtro.png" alt="filtros">
      <span>Filtros</span>
    </button>

    <!-- Filtros dropdown -->
    <div class="filters-dropdown" id="filtersDropdown" style="display: none;">
      <label for="filterSelect">Filtrar por:</label>
      <select id="filterSelect">
        <option value="all">Todas</option>
        <option value="pendentes">Pendentes</option>
        <option value="concluidas">Concluídas</option>
        <option value="naoaceitas">Não Aceitas</option>
      </select>
    </div>

    <h2 class="section-title" data-section="pendentes">Denúncias Pendentes</h2>
    <div class="complaints-grid" data-grid="pendentes">
      <div class="complaint-card">
        <img src="../assets/buraco_na_faixa.png" alt="Denúncia de rua alagada">
        <button class="view-button" data-id="1">Visualizar</button>
      </div>
      <div class="complaint-card">
        <img src="../assets/buraco .png" alt="Denúncia de lixo acumulado">
        <button class="view-button" data-id="2">Visualizar</button>
      </div>
      <div class="complaint-card">
        <img src="../assets/caçamba-de-lixo.png" alt="Denúncia de veículo abandonado">
        <button class="view-button" data-id="3">Visualizar</button>
      </div>
      <div class="complaint-card">
        <img src="../assets/escombros.png" alt="Denúncia de rua alagada">
        <button class="view-button" data-id="4">Visualizar</button>
      </div>
      <div class="complaint-card highlighted">
        <img src="../assets/lixeira.png" alt="Denúncia de esgoto a céu aberto">
        <button class="view-button" data-id="5">Visualizar</button>
      </div>
    </div>

    <h2 class="section-title" data-section="concluidas">Denúncias Concluídas</h2>
    <div class="complaints-grid" data-grid="concluidas">
      <div class="complaint-card">
        <img src="../assets/buraco_na_rua.png" alt="Denúncia de lixo resolvida">
        <button class="view-button" data-id="6">Visualizar</button>
      </div>
      <div class="complaint-card">
        <img src="../assets/buraco_na_rua.jpg" alt="Denúncia de lixo resolvida">
        <button class="view-button" data-id="7">Visualizar</button>
      </div>
      <div class="complaint-card">
        <img src="../assets/lixo_no_rio_2.jpg" alt="Denúncia de escavação resolvida">
        <button class="view-button" data-id="8">Visualizar</button>
      </div>
      <div class="complaint-card">
        <img src="../assets/monte_de_pneu.jpg" alt="Denúncia de calçada resolvida">
        <button class="view-button" data-id="9">Visualizar</button>
      </div>
      <div class="complaint-card">
        <img src="../assets/queimada.jpg" alt="Denúncia de rachadura resolvida">
        <button class="view-button" data-id="10">Visualizar</button>
      </div>
    </div>

    <h2 class="section-title" data-section="naoaceitas">Denúncias Não Aceitas</h2>
    <div class="complaints-grid" data-grid="naoaceitas">
      <div class="complaint-card">
        <img src="#" alt="Denúncia não aceita">
        <button class="view-button" data-id="11">Visualizar</button>
      </div>
      <div class="complaint-card">
        <img src="#" alt="Denúncia não aceita">
        <button class="view-button" data-id="12">Visualizar</button>
      </div>
      <div class="complaint-card">
        <img src="#" alt="Denúncia não aceita">
        <button class="view-button" data-id="13">Visualizar</button>
      </div>
      <div class="complaint-card">
        <img src="#" alt="Denúncia não aceita">
        <button class="view-button" data-id="14">Visualizar</button>
      </div>
      <div class="complaint-card">
        <img src="#" alt="Denúncia não aceita">
        <button class="view-button" data-id="15">Visualizar</button>
      </div>
    </div>
  </div>
</div>
  <script src="../../public/js/acompanharDenuncia.js"></script>
</body>

</html>