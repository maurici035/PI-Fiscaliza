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

    {{-- Alpine.js para interatividade --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Estilos para a animação do modal genérico (ainda em uso) */
        .modal.open {
            display: flex;
        }
        .modal .modal-content {
            transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
        }
        .modal:not(.open) .modal-content {
            opacity: 0;
            transform: scale(0.95);
        }
        /* Melhora a transição do Alpine.js, escondendo o elemento antes de animar */
        [x-cloak] { display: none !important; }
    </style>
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
            <img src="{{ asset('imgs/profile/' . $usuario->imagem) }}" alt="Foto de Perfil" class="w-20 h-20 rounded-full object-cover border-2 border-slate-300">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">{{ $usuario->nome }}</h1>
                <p class="text-gray-500">Total de denúncias: <span class="font-semibold">{{ $usuario->denuncias->count() }}</span></p>
            </div>
        </div>

        @if (auth()->id() == $usuario->id)
            <a href="{{ route('profile.perfil') }}" class="bg-[#0489ca] text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Editar Perfil
            </a>
        @endif

    </div>

    <!-- Lista de denúncias -->
    <div class="space-y-6">
        @forelse ($denuncias as $denuncia)
            {{-- Cada denúncia é um componente Alpine para controlar seus próprios comentários --}}
            <div x-data="{ commentsOpen: false }" class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 space-y-4 transition-shadow duration-300 hover:shadow-xl">
                
                {{-- CABEÇALHO DA DENÚNCIA --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('profile.showPerfil', $usuario->id )}}">
                        <img src="{{ asset('imgs/profile/' . $denuncia->user->imagem) }}" alt="User" class="w-12 h-12 rounded-full object-cover border-2 border-slate-100">
                    </a>
                    <div>
                        <a href="{{ route('profile.showPerfil', $usuario->id )}}">
                            <h2 class="font-bold text-gray-800">{{ $denuncia->user->nome }}</h2>
                        </a>
                        <p class="text-xs text-gray-500 flex items-center gap-1 flex-wrap">
                            <i class="bi bi-geo-alt"></i> 
                            <span>
                                @if ($denuncia->endereco)
                                    {{ $denuncia->endereco }}
                                @elseif ($denuncia->localizacao_texto)
                                    {{ $denuncia->localizacao_texto }} <span class="italic text-gray-400">(informado)</span>
                                @else
                                    Localização não informada
                                @endif
                            </span>
                            <span class="mx-1">&middot;</span>
                            <span>{{ $denuncia->created_at->diffForHumans() }}</span>
                        </p>
                        @if ($denuncia->user_id == auth()->id())
                            <a href="{{ route('denuncias.editar-denuncias', $denuncia->id) }}" class="text-blue-600 hover:text-blue-800 text-sm flex items-center gap-1">
                                <i class="bi bi-pencil"></i>
                                Editar
                            </a>
                        @endif
                    </div>
                </div>

                {{-- CONTEÚDO DA DENÚNCIA --}}
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

                {{-- BOTÕES DE AÇÃO --}}
                <div class="border-t border-slate-200 pt-3 flex justify-between items-center text-sm text-gray-600">
                    <div class="flex gap-5">
                        <button onclick="curtirDenuncia(this)" class="flex items-center gap-2 text-slate-600 hover:text-blue-600 transition-colors duration-300 group">
                            <i class="bi bi-hand-thumbs-up text-xl group-hover:scale-110 transition-transform"></i> 
                            <span class="like-count font-semibold">{{ $denuncia->likes_count ?? 0 }}</span>
                        </button>
                        {{-- O botão de comentar agora usa Alpine.js --}}
                        <button @click="commentsOpen = !commentsOpen" class="flex items-center gap-2 text-slate-600 hover:text-green-600 transition-colors duration-300 group">
                            <i class="bi bi-chat-dots text-xl group-hover:scale-110 transition-transform"></i> 
                            <span class="font-semibold">Comentarios {{ $denuncia->comentarios_count }}</span>
                        </button>
                        <button onclick="abrirModal('modalCompartilhar')" class="flex items-center gap-2 text-slate-600 hover:text-purple-600 transition-colors duration-300 group">
                            <i class="bi bi-share text-xl group-hover:scale-110 transition-transform"></i>
                            <span class="font-semibold">Compartilhar</span>
                        </button>
                    </div>
                </div>

                <div x-show="commentsOpen" x-cloak x-transition.opacity.duration.300ms class="pt-4 mt-4 border-t border-slate-200 space-y-5">
                    
                    {{-- Lista de Comentários Existentes --}}
                    <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                        @forelse ($denuncia->comentarios as $comentario)
                            <div class="flex items-start gap-3">
                                <a href="{{ route('profile.showPerfil', $usuario->id )}}">
                                    <img src="{{ asset('imgs/profile/' . ($comentario->user->imagem ?? 'default.jpg')) }}"
                                        class="w-9 h-9 rounded-full object-cover border border-slate-200"
                                        alt="Foto">
                                </a>

                                <div class="flex-1">
                                    <div class="bg-slate-100 rounded-xl p-3">
                                        <a href="{{ route('profile.showPerfil', $usuario->id )}}" class="font-semibold text-sm text-slate-800">
                                            {{ $comentario->user->nome ?? 'Usuário removido' }}
                                        </a>
                                        <p class="text-sm text-slate-700 whitespace-pre-line">
                                            {{ $comentario->conteudo }}
                                        </p>
                                        <div class="text-xs text-slate-500 mt-1 pl-1">
                                            <span>{{ $comentario->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500 text-center py-4">Nenhum comentário ainda.</p>
                        @endforelse
                    </div>

                    {{-- Formulário para Novo Comentário --}}
                    <div class="flex items-start gap-3 pt-2">
                        <img src="{{ asset('imgs/profile/' . $usuario->imagem) }}" alt="Sua foto de perfil" class="w-9 h-9 rounded-full object-cover border border-slate-200">
                        {{-- ATENÇÃO: A action precisa apontar para a rota de salvar comentários --}}
                        <form action="{{ route('comentarios.store')}}" method="POST" class="flex-1">
                            @csrf
                            <div class="relative">
                                <textarea 
                                    name="conteudo" 
                                    rows="2" 
                                    required
                                    class="w-full bg-slate-100 border border-slate-300 rounded-lg p-3 pr-12 focus:ring-2 focus:ring-green-500 focus:outline-none transition-colors duration-300 placeholder-slate-400 text-sm" 
                                    placeholder="Escreva um comentário..."
                                ></textarea>
                                <input type="hidden" name="denuncia_id" value="{{ $denuncia->id }}">
                                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-green-600 hover:text-green-800 p-2 rounded-full transition-colors duration-300">
                                    <i class="bi bi-send-fill text-xl"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Nenhuma denúncia encontrada.</p>
        @endforelse
    </div>
</div>
@endsection
