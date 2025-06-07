<div class="fixed top-0 left-0 h-screen w-20 bg-[#0489ca] flex flex-col items-center py-4 z-[1100]">
    <!-- Logo -->
    <div class="mb-2 mt-2">
        <a href="/home" class="flex justify-center items-center w-[64px] h-[60px]">
            <img src="{{ asset('assets/logo-menor.png') }}" alt="Logo" class="w-16 h-[60px]" />
        </a>
    </div>

    <!-- Divider -->
    <div class="w-10 h-px bg-gray-400 my-3"></div>

    <!-- Navigation Icons -->
    <div class="flex flex-col items-center space-y-5">
        <a href="/home" class="text-white text-2xl w-10 h-10 flex justify-center items-center hover:text-[#00ff1e] border-l-2 border-transparent hover:border-[#00ff1e] {{ request()->is('home') ? 'active-icon' : '' }}">
            <i class="bi bi-house"></i>
        </a>
        <a href="/cadastrar-denuncia" class="text-white text-2xl w-10 h-10 flex justify-center items-center hover:text-[#00ff1e] border-l-2 border-transparent hover:border-[#00ff1e] {{ request()->is('cadastrar-denuncia') ? 'active-icon' : '' }}">
            <i class="bi bi-chat"></i>
        </a>

        <a href="/feedback-orgao" class="text-white text-2xl w-10 h-10 flex justify-center items-center hover:text-[#00ff1e] border-l-2 border-transparent hover:border-[#00ff1e] {{ request()->is('feedback-orgao') ? 'active-icon' : '' }}">
            <i class="bi bi-file-earmark-text"></i>
        </a>

        <a href="{{ route('profile.perfil') }}" class="text-white text-2xl w-10 h-10 flex justify-center items-center hover:text-[#00ff1e] border-l-2 border-transparent hover:border-[#00ff1e] {{ request()->is('profile/perfil') ? 'active-icon' : '' }}">
            <i class="bi bi-person"></i>
        </a>
    </div>

    <!-- Logout -->
    <div class="mt-auto mb-7">
        <a href="#" class="text-white text-2xl w-10 h-10 flex justify-center items-center hover:text-[#00ff1e] border-l-2 border-transparent hover:border-[#00ff1e]">
            <i class="bi bi-box-arrow-right"></i>
        </a>
    </div>
</div>
