@extends('layouts.app')

@section('title', 'Fiscaliza+ | Perfil')

@section('head')
<script>
// Mostrar alerta de sucesso dinâmico com fade out
  window.addEventListener('DOMContentLoaded', () => {
    const alertSuccess = document.getElementById('alertSuccess');
    if (alertSuccess.textContent.trim() !== '') {
      alertSuccess.classList.remove('hidden');
      alertSuccess.classList.add('opacity-100');

      // Apaga o alerta após 3 segundos com fade out
      setTimeout(() => {
        alertSuccess.classList.add('opacity-0');
        setTimeout(() => alertSuccess.classList.add('hidden'), 500);
      }, 3000);
    }
  });
</script>
@endsection

@section('content')
<div class="max-w-5xl mx-auto px-4 py-6">

    {{-- ALERTA DINÂMICO --}}
    <div 
        id="alertSuccess" 
        class="hidden fixed top-0 left-0 w-full bg-green-500 text-white text-center py-3 shadow-md transition-opacity duration-500"
    >
        {{ session('success') }}
    </div>
    <!-- Cabeçalho do perfil -->
    <div class="flex justify-between items-center mb-8">
        <div class="flex items-center gap-4">
            <img src="{{ asset('imgs/profile/' . $user->imagem) }}" alt="Foto de Perfil" class="w-20 h-20 rounded-full object-cover border-2 border-slate-300">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">{{ $user->nome }}</h1>
                <p class="text-gray-500">Total de denúncias: <span class="font-semibold">{{ $user->denuncias->count() }}</span></p>
            </div>
        </div>

        <a href="{{ route('profile.perfil') }}" class="bg-[#0489ca] text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Editar Perfil
        </a>
    </div>

    <!-- Lista de denúncias -->
    <div class="space-y-6">
        @forelse ($user->denuncias as $denuncia)
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 space-y-4 transition-shadow duration-300 hover:shadow-xl">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('imgs/profile/' . $user->imagem) }}" alt="User" class="w-12 h-12 rounded-full object-cover border-2 border-slate-100">
                    <div>
                        <h2 class="font-bold text-gray-800">{{ $user->nome }}</h2>
                        <p class="text-xs text-gray-500 flex items-center gap-1">
                            <i class="bi bi-geo-alt"></i> 
                            <span>
                                @if ($denuncia->endereco)
                                    {{ $denuncia->endereco }}
                                @elseif ($denuncia->localizacao_texto)
                                    {{ $denuncia->localizacao_texto }} <span class="italic text-gray-400">(informado pelo usuário)</span>
                                @else
                                    Localização não informada
                                @endif
                            </span>
                            <span class="mx-1">&middot;</span>
                            <span>{{ $denuncia->created_at->diffForHumans() }}</span>
                        </p>
                        <a href="{{ route('denuncias.editar-denuncias', $denuncia->id) }}" class="text-blue-600 hover:text-blue-800 text-sm flex items-center gap-1">
                            <i class="bi bi-pencil"></i>
                            Editar
                        </a>
                    </div>
                </div>

                <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $denuncia->descricao }}</p>

                @if ($denuncia->foto_path)
                    <img src="{{ asset($denuncia->foto_path) }}" alt="Foto da denúncia" class="w-full max-h-[500px] object-cover rounded-lg border border-slate-200">
                @endif

                @if ($denuncia->video_path)
                    <video controls class="w-full rounded-lg border border-slate-200">
                        <source src="{{ asset($denuncia->video_path) }}" type="video/mp4">
                        Seu navegador não suporta o formato do vídeo.
                    </video>
                @endif

                <div class="border-t border-slate-200 pt-3 flex justify-between items-center text-sm text-gray-600">
                    <div class="flex gap-5">
                        <button onclick="curtirDenuncia(this)" class="flex items-center gap-2 text-slate-600 hover:text-blue-600 transition-colors group">
                            <i class="bi bi-hand-thumbs-up text-xl group-hover:scale-110 transition-transform"></i> 
                            <span class="like-count font-semibold">{{ $denuncia->likes_count ?? 0 }}</span>
                        </button>
                        <button onclick="abrirModal('modalComentario')" class="flex items-center gap-2 text-slate-600 hover:text-green-600 transition-colors group">
                            <i class="bi bi-chat-dots text-xl group-hover:scale-110 transition-transform"></i> 
                            <span class="font-semibold">Comentar</span>
                        </button>
                        <button onclick="abrirModal('modalCompartilhar')" class="flex items-center gap-2 text-slate-600 hover:text-purple-600 transition-colors group">
                            <i class="bi bi-share text-xl group-hover:scale-110 transition-transform"></i>
                            <span class="font-semibold">Compartilhar</span>
                        </button>
                    </div>
                    <button onclick="abrirConteudo(this)" class="flex items-center gap-2 text-slate-500 hover:text-slate-800 transition">
                        <i class="bi bi-arrows-fullscreen"></i> Ver mais
                    </button>
                </div>
            </div>
        @empty
            <p class="text-gray-600">Nenhuma denúncia registrada ainda.</p>
        @endforelse
    </div>
</div>
@endsection
