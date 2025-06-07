
<style>
    /* Estilos da Sidebar */
    .sidebar {
        width: 80px;
        height: 100vh;
        background-color: #0489ca;
        position: fixed;
        left: 0;
        top: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1rem 0;
        z-index: 1100;
    }

    .nav-item {
        width: 100%;
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .nav-link {
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        font-size: 1.5rem !important;
        width: 42px;
        height: 42px;
        border-radius: 0;
        transition: all 0.3s;
        text-decoration: none;
    }

    .nav-link:nth-child(1) {
        margin-bottom: 10px;
        margin-top: 10px;
    }

    .nav-link.active {
        color: #00ff1e;
        border-left: 2px solid #00ff1e;
    }

    .nav-link:hover {
        color: #00ff1e;
    }

    .nav-link.active.highlight {
        color: #10b981;
    }

    .divider {
        width: 40px;
        height: 1px;
        background-color: #bebebe;
        margin: 0.5rem 0 1rem 0;
    }

    .logout {
        margin-top: auto !important;
        margin-bottom: 30px;
    }

    /* Estilos para os ícones */
    .sidebar-icon {
        height: 40px;
        width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<div class="sidebar">
    <div class="nav-item">
        <a href="/home" class="nav-link active highlight">
            <img src="{{ asset('assets/logo-menor.png') }}" alt="Logo" style="width: 64px; height: 60px" />
        </a>
    </div>

    <div class="divider"></div>

    <div class="nav-item">
        <a href="/home" class="nav-link">
            <i class="bi bi-house sidebar-icon"></i>
        </a>
    </div>

    <div class="nav-item">
        <a href="/cadastrar-denuncia" class="nav-link">
            <i class="bi bi-chat sidebar-icon"></i>
        </a>
    </div>

    <div class="nav-item">
        <a href="/feedback-orgao" class="nav-link">
            <i class="bi bi-file-earmark-text sidebar-icon"></i>
        </a>
    </div>

    <div class="nav-item">
        <a href="{{ route('profile.perfil') }}" class="nav-link">
            <i class="bi bi-person sidebar-icon"></i>
        </a>
    </div>

    <div class="nav-item logout">
        <a href="#" class="nav-link">
            <i class="bi bi-box-arrow-right sidebar-icon"></i>
        </a>
    </div>
</div>
