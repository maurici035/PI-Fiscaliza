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
        <img src="{{ asset('assets/fiscaliza-logo.png') }}" alt="">
      </div>
      <h1>Acompanhar Denúncia</h1>
      <div class="header-right">
        <img src="{{ Auth::user()->foto_perfil_url }}" alt="Foto de perfil" class="profile-pic">
      </div>
    </div>

    <div class="complaints-sections">
      <button class="filter-button">
        <img src="{{ asset('assets/seta-filtro.png') }}" alt="filtros">
        <span>Filtros</span>
      </button>
      <h2 class="section-title">Denúncias Pendentes</h2>
      <div class="complaints-grid">
        <div class="complaint-card">
          <img src="{{ asset('assets/buraco_na_faixa.png') }}" alt="Denúncia de rua alagada">
          <button class="view-button">Visualizar</button>
        </div>
        <div class="complaint-card">
          <img src="{{ asset('assets/buraco .png') }}" alt="Denúncia de lixo acumulado">
          <button class="view-button">Visualizar</button>
        </div>
        <div class="complaint-card">
          <img src="{{ asset('assets/caçamba-de-lixo.png') }}" alt="Denúncia de veículo abandonado">
          <button class="view-button">Visualizar</button>
        </div>
        <div class="complaint-card">
          <img src="{{ asset('assets/escombros.png') }}" alt="Denúncia de rua alagada">
          <button class="view-button">Visualizar</button>
        </div>
        <div class="complaint-card highlighted">
          <img src="{{ asset('assets/lixeira.png') }}" alt="Denúncia de esgoto a céu aberto">
          <button class="view-button">Visualizar</button>
        </div>
      </div>

      <h2 class="section-title">Denúncias Concluídas</h2>
      <div class="complaints-grid">
        <div class="complaint-card">
          <img src="{{ asset('assets/buraco_na_rua.png') }}" alt="Denúncia de lixo resolvida">
          <button class="view-button">Visualizar</button>
        </div>
        <div class="complaint-card">
          <img src="{{ asset('assets/buraco_na_rua.jpg') }}" alt="Denúncia de lixo resolvida">
          <button class="view-button">Visualizar</button>
        </div>
        <div class="complaint-card">
          <img src="{{ asset('assets/lixo_no_rio_2.jpg') }}" alt="Denúncia de escavação resolvida">
          <button class="view-button">Visualizar</button>
        </div>
        <div class="complaint-card">
          <img src="{{ asset('assets/monte_de_pneu.jpg') }}" alt="Denúncia de calçada resolvida">
          <button class="view-button">Visualizar</button>
        </div>
        <div class="complaint-card">
          <img src="{{ asset('assets/queimada.jpg') }}" alt="Denúncia de rachadura resolvida">
          <button class="view-button">Visualizar</button>
        </div>
      </div>

      <h2 class="section-title">Denúncias Não Aceitas</h2>
      <div class="complaints-grid">
        <div class="complaint-card">
          <img src="{{ asset('assets/lixao.png') }}" alt="Denúncia não aceita">
          <button class="view-button">Visualizar</button>
        </div>
        <div class="complaint-card">
          <img src="{{ asset('assets/lixo_na_agua.jpg') }}" alt="Denúncia não aceita">
          <button class="view-button">Visualizar</button>
        </div>
        <div class="complaint-card">
          <img src="{{ asset('assets/lixo_na_rua.jpg') }}" alt="Denúncia não aceita">
          <button class="view-button">Visualizar</button>
        </div>
        <div class="complaint-card">
          <img src="{{ asset('assets/lixo_no_rio.jpg') }}" alt="Denúncia não aceita">
          <button class="view-button">Visualizar</button>
        </div>
        <div class="complaint-card">
          <img src="{{ asset('assets/monte_de_lixo.png') }}" alt="Denúncia não aceita">
          <button class="view-button">Visualizar</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>