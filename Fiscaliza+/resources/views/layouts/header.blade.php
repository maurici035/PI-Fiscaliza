{{-- resources/views/layouts/header.blade.php --}}
@php
    use Illuminate\Support\Facades\Auth;
    $usuario = Auth::user();
    $empresa = Auth::guard('empresa')->user();
@endphp

<div class="w-full bg-white shadow-md py-4 flex justify-between items-center">
    <div class="ml-[100px] flex items-center">
        <img src="{{ asset('assets/fiscaliza-logo.png') }}" alt="Fiscaliza+" class="h-10">
    </div>

    <div class="flex items-center space-x-6 mr-8">
        @can('acesso-usuario')
            <p class="text-gray-700 font-medium">Usuário: {{ $usuario->nome }}</p>
            <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-gray-400">
                <img src="{{ asset('imgs/profile/' . $usuario->imagem) }}" alt="Foto do Usuário" class="w-full h-full object-cover">
            </div>
        @endcan

        @if($empresa)
            <p class="text-gray-700 font-medium">Empresa: {{ $empresa->nome }}</p>
            <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-gray-400">
                <img src="{{ asset('imgs/EmpresaProfile/' . $empresa->imagem) }}" alt="Foto do Usuário" class="w-full h-full object-cover">
            </div>
        @endif

        {{-- <button class="relative text-gray-600 hover:text-indigo-600 focus:outline-none">
            <i class="bi bi-bell text-2xl"></i>
        </button> --}}
    </div>
</div>
