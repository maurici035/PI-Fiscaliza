{{-- resources/views/layouts/sidebar.blade.php --}}
@php
    use Illuminate\Support\Facades\Auth;
    $empresa = Auth::guard('empresa')->user();
@endphp


<div class="fixed top-0 left-0 h-screen w-20 bg-[#0489ca] flex flex-col items-center py-4 z-[1100]">
    <!-- Logo -->
    <div class="mb-2 mt-2">
        @can('acesso-usuario')
            <a href="/home" class="flex justify-center items-center w-[64px] h-[60px]">
        @endcan

        @if($empresa)
            <a href="{{ route('empresa.dashboard')}}" class="flex justify-center items-center w-[64px] h-[60px]">
        @endif
            <img src="{{ asset('assets/logo-menor.png') }}" alt="Logo" class="w-16 h-[60px]" />
        </a>
    </div>

    <!-- Divider -->
    <div class="w-10 h-px bg-gray-400 my-3"></div>

    <!-- Ícones de navegação -->
    <div class="flex flex-col items-center space-y-5">
        @can('acesso-usuario')
            <a href="/home" class="text-white text-2xl w-10 h-10 flex justify-center items-center hover:text-[#00ff1e] border-l-2 hover:border-[#00ff1e] {{ request()->is('home') ? 'active-icon' : '' }}">
                <i class="bi bi-house"></i>
            </a>
            <a href="/cadastrar-denuncia" class="text-white text-2xl w-10 h-10 flex justify-center items-center hover:text-[#00ff1e] border-l-2 hover:border-[#00ff1e] {{ request()->is('cadastrar-denuncia') ? 'active-icon' : '' }}">
                <i class="bi bi-chat"></i>
            </a>
            {{-- <a href="/feedback-orgao" class="text-white text-2xl w-10 h-10 flex justify-center items-center hover:text-[#00ff1e] border-l-2 hover:border-[#00ff1e] {{ request()->is('feedback-orgao') ? 'active-icon' : '' }}">
                <i class="bi bi-file-earmark-text"></i>
            </a> --}}
            <a href="{{ route('profile.showPerfil', auth()->user()->id) }}" class="text-white text-2xl w-10 h-10 flex justify-center items-center hover:text-[#00ff1e] border-l-2 hover:border-[#00ff1e] {{ request()->is('profile/perfil') ? 'active-icon' : '' }}">
                <i class="bi bi-person"></i>
            </a>
        @endcan

        @if($empresa)
            <a href="{{ route('empresa.dashboard') }}" class="text-white text-2xl w-10 h-10 flex justify-center items-center hover:text-[#00ff1e] border-l-2 hover:border-[#00ff1e] {{ request()->is('empresa/dashboard') ? 'active-icon' : '' }}">
                <i class="bi bi-house"></i>
            </a>
        @endif
    </div>

    <!-- Logout -->
    <div class="mt-auto mb-7">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-white text-2xl w-10 h-10 flex justify-center items-center hover:text-[#00ff1e] border-l-2 hover:border-[#00ff1e]">
                <i class="bi bi-box-arrow-right"></i>
            </button>
        </form>
    </div>
</div>
