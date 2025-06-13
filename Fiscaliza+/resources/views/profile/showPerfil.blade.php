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
        <style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9; /* slate-100 */
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #94a3b8; /* slate-400 */
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #64748b; /* slate-500 */
    }
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
            <a href="{{ route('profile.perfil'), $usuario->id}}" class="bg-[#0489ca] text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Editar Perfil
            </a>
        @endif

    </div>

    <!-- Lista de denúncias -->
    <div class="space-y-6">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-700">Denúncias em aberto</h2>
            <p class="text-sm text-slate-500">Histórico de denúncias que não foram resolvidas.</p>
        </div>
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
                        <meta name="csrf-token" content="{{ csrf_token() }}">

                        <button onclick="curtirDenuncia(this, {{ $denuncia->id }})"
                            class="flex items-center gap-2 text-slate-600 {{ $denuncia->curtidas->contains('user_id', auth()->id()) ? 'text-blue-600' : '' }} hover:text-blue-600 transition-colors duration-300 group">
                            <i class="bi bi-hand-thumbs-up text-xl group-hover:scale-110 transition-transform"></i> 
                            <span class="like-count font-semibold">{{ $denuncia->curtidas->count() }}</span>
                        </button>
                        {{-- O botão de comentar agora usa Alpine.js --}}
                        <button @click="commentsOpen = !commentsOpen" class="flex items-center gap-2 text-slate-600 hover:text-green-600 transition-colors duration-300 group">
                            <i class="bi bi-chat-dots text-xl group-hover:scale-110 transition-transform"></i> 
                            <span class="font-semibold">Comentarios {{ $denuncia->comentarios_count }}</span>
                        </button>
                        <button onclick="abrirModal('modalCompartilhar-{{ $denuncia->id }}')" class="flex items-center gap-2 text-slate-600 hover:text-purple-600 transition-colors duration-300 group">
                            <i class="bi bi-share text-xl group-hover:scale-110 transition-transform"></i>
                            <span class="font-semibold">Compartilhar</span>
                        </button>

                        <a href="{{ route('denuncias.show-denuncia', $denuncia->id) }}"
                        class="flex items-center gap-2 text-slate-600 hover:text-yellow-600 transition-colors duration-300 group">
                            <i class="bi bi-eye text-xl group-hover:scale-110 transition-transform"></i>
                            <span class="font-semibold">Ver mais</span>
                        </a>

                    </div>
                </div>

                {{-- Modal de Compartilhamento --}}
                <div id="modalCompartilhar-{{ $denuncia->id }}" class="modal hidden fixed inset-0 bg-black/60 items-center justify-center z-50 p-4">
                    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-md space-y-4 text-center">
                        <div class="p-6 flex justify-between items-center border-b border-slate-200">
                            <h2 class="text-xl font-bold text-slate-800">Compartilhar Denúncia</h2>
                            <button onclick="fecharModal('modalCompartilhar-{{ $denuncia->id }}')" class="text-slate-400 hover:text-slate-600 text-3xl">&times;</button>
                        </div>
                        <div id="modalCompartilharBody" class="p-8 flex flex-col items-center gap-4">
                            <p class="text-slate-600">Copie o link para compartilhar esta denúncia:</p>
                            <div class="w-full bg-slate-100 border rounded-lg p-2 flex items-center">
                                <input type="text" id="share-link-{{ $denuncia->id }}" value="{{ route('denuncias.show-denuncia', $denuncia->id) }}" readonly class="bg-transparent flex-1 text-sm text-slate-700 focus:outline-none">
                                <button onclick="copiarLink({{ $denuncia->id }})" class="bg-green-500 text-white px-3 py-1 rounded text-sm font-semibold hover:bg-green-600">Copiar</button>
                            </div>
                        </div>
                        <div class="p-4 bg-slate-50 text-right rounded-b-xl">
                            <button onclick="fecharModal('modalCompartilhar-{{ $denuncia->id }}')" class="bg-slate-500 text-white px-5 py-2 rounded-lg hover:bg-slate-600 transition-colors duration-300 font-semibold">Fechar</button>
                        </div>
                    </div>
                </div>

                <div x-show="commentsOpen" x-cloak x-transition.opacity.duration.300ms class="pt-4 mt-4 border-t border-slate-200 space-y-5">
                    
                {{-- Lista de Comentários Existentes --}}
                <div class="space-y-5 max-h-[450px] overflow-y-auto pr-3 custom-scrollbar">
                    @forelse ($denuncia->comentarios as $comentario)
                        <div class="flex items-start gap-4 group">
                            <a href="{{ route('profile.showPerfil', $comentario->user->id ?? $denuncia->user_id ) }}">
                                <img
                                    src="{{ asset('imgs/profile/' . ($comentario->user->imagem ?? 'default.jpg')) }}"
                                    alt="Foto de perfil"
                                    class="w-10 h-10 rounded-full object-cover ring-2 ring-white shadow"
                                >
                            </a>

                            <div class="flex-1">
                                <div class="bg-white rounded-xl rounded-tl-none p-4 ring-1 ring-gray-100 shadow-sm relative">

                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('profile.showPerfil', $comentario->user->id ?? '') }}" class="font-semibold text-sm text-gray-800 hover:underline">
                                                {{ $comentario->user->nome ?? 'Usuário removido' }}
                                            </a>
                                            <span class="text-xs text-gray-400">&bull;</span>
                                            <span class="text-xs text-gray-500">{{ $comentario->created_at->diffForHumans() }}</span>
                                        </div>

                                        @if (Auth::id() === $comentario->user_id)
                                            <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <button onclick="toggleEdit({{ $comentario->id }})" class="p-1.5 rounded-full hover:bg-gray-100 text-gray-500 hover:text-blue-600" title="Editar comentário">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.536L16.732 3.732z" /></svg>
                                                </button>
                                                <form action="{{ route('comentarios.destroy', $comentario->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja apagar este comentário? A ação não pode ser desfeita.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-1.5 rounded-full hover:bg-gray-100 text-gray-500 hover:text-red-600" title="Excluir comentário">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>

                                    <div id="comentario-view-{{ $comentario->id }}" class="text-sm text-gray-700 whitespace-pre-line transition-opacity duration-300">
                                        {{ $comentario->conteudo }}
                                    </div>

                                    @if (Auth::id() === $comentario->user_id)
                                        <form id="comentario-edit-form-{{ $comentario->id }}" action="{{ route('comentarios.update', $comentario->id) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('PUT')
                                            <textarea
                                                name="conteudo"
                                                rows="3"
                                                class="w-full bg-gray-50 border border-gray-200 rounded-md p-2 text-sm text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                            >{{ $comentario->conteudo }}</textarea>
                                            <div class="flex items-center justify-end gap-3 mt-2">
                                                <button type="button" onclick="toggleEdit({{ $comentario->id }})" class="text-sm font-medium text-gray-600 hover:text-gray-900">Cancelar</button>
                                                <button type="submit" class="px-4 py-1.5 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Salvar</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 5.523-4.477 10-10 10S1 17.523 1 12 5.477 2 11 2s10 4.477 10 10z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-800">Seja o primeiro a comentar!</h3>
                            <p class="mt-1 text-sm text-gray-500">Ainda não há comentários nesta publicação.</p>
                        </div>
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
            <div class="text-center py-10 bg-slate-50 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-slate-800">Nenhuma denúncia encontrada</h3>
            <p class="mt-1 text-sm text-slate-500">Este usuário ainda não possui um histórico de denúncias em aberto.</p>
            </div>
        @endforelse
    </div>
    
    {{-- Divisor visual entre as seções --}}
    <hr class="my-10 border-t-2 border-slate-200">
    
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-700">Denúncias Concluídas</h2>
        <p class="text-sm text-slate-500">Histórico de denúncias que já foram resolvidas.</p>
    </div>
    
    <div class="space-y-6">
        @forelse ($denunciasConcluidas as $denuncia)
            {{-- 
              Card da denúncia concluída. 
              Adicionamos 'opacity-75 hover:opacity-100' para dar um aspecto de "arquivada".
            --}}
            <div x-data="{ commentsOpen: false }" class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 space-y-4 transition-all duration-300 hover:shadow-xl opacity-75 hover:opacity-100">
                
                {{-- CABEÇALHO DA DENÚNCIA --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('profile.showPerfil', $denuncia->user->id )}}">
                        <img src="{{ asset('imgs/profile/' . $denuncia->user->imagem) }}" alt="User" class="w-12 h-12 rounded-full object-cover border-2 border-slate-100">
                    </a>
                    <div>
                        <a href="{{ route('profile.showPerfil', $denuncia->user->id )}}">
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
    
                            {{-- BADGE DE "CONCLUÍDA" --}}
                            <span class="mx-1">&middot;</span>
                            <span class="inline-flex items-center gap-1.5 py-0.5 px-2 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                <i class="bi bi-check-circle-fill"></i>
                                Concluída
                            </span>
                        </p>
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
    
                {{-- BOTÕES DE AÇÃO (geralmente desabilitados ou com menos destaque para concluídas) --}}
                 <div class="border-t border-slate-200 pt-3 flex justify-between items-center text-sm text-gray-600">
                    <div class="flex gap-5">
                        {{-- Ações como curtir, comentar e compartilhar podem ser mantidas se desejado --}}
                        <span class="flex items-center gap-2 text-slate-500">
                            <i class="bi bi-hand-thumbs-up-fill text-xl"></i> 
                            <span class="font-semibold">{{ $denuncia->curtidas->count() }}</span>
                        </span>
                        <button @click="commentsOpen = !commentsOpen" class="flex items-center gap-2 text-slate-600 hover:text-green-600 transition-colors duration-300 group">
                            <i class="bi bi-chat-dots text-xl group-hover:scale-110 transition-transform"></i> 
                            <span class="font-semibold">Comentarios {{ $denuncia->comentarios_count }}</span>
                        </button>
                        <a href="{{ route('denuncias.show-denuncia', $denuncia->id) }}"
                        class="flex items-center gap-2 text-slate-600 hover:text-yellow-600 transition-colors duration-300 group">
                            <i class="bi bi-eye text-xl group-hover:scale-110 transition-transform"></i>
                            <span class="font-semibold">Ver detalhes</span>
                        </a>
                    </div>
                </div>
    
                {{-- Seção de Comentários (idêntica à anterior, pois a lógica é a mesma) --}}
                <div x-show="commentsOpen" x-cloak x-transition.opacity.duration.300ms class="pt-4 mt-4 border-t border-slate-200 space-y-5">
                {{-- Lista de Comentários Existentes --}}
                <div class="space-y-5 max-h-[450px] overflow-y-auto pr-3 custom-scrollbar">
                    @forelse ($denuncia->comentarios as $comentario)
                        <div class="flex items-start gap-4 group">
                            <a href="{{ route('profile.showPerfil', $comentario->user->id ?? $denuncia->user_id ) }}">
                                <img
                                    src="{{ asset('imgs/profile/' . ($comentario->user->imagem ?? 'default.jpg')) }}"
                                    alt="Foto de perfil"
                                    class="w-10 h-10 rounded-full object-cover ring-2 ring-white shadow"
                                >
                            </a>

                            <div class="flex-1">
                                <div class="bg-white rounded-xl rounded-tl-none p-4 ring-1 ring-gray-100 shadow-sm relative">

                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('profile.showPerfil', $comentario->user->id ?? '') }}" class="font-semibold text-sm text-gray-800 hover:underline">
                                                {{ $comentario->user->nome ?? 'Usuário removido' }}
                                            </a>
                                            <span class="text-xs text-gray-400">&bull;</span>
                                            <span class="text-xs text-gray-500">{{ $comentario->created_at->diffForHumans() }}</span>
                                        </div>

                                        @if (Auth::id() === $comentario->user_id)
                                            <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <button onclick="toggleEdit({{ $comentario->id }})" class="p-1.5 rounded-full hover:bg-gray-100 text-gray-500 hover:text-blue-600" title="Editar comentário">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.536L16.732 3.732z" /></svg>
                                                </button>
                                                <form action="{{ route('comentarios.destroy', $comentario->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja apagar este comentário? A ação não pode ser desfeita.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-1.5 rounded-full hover:bg-gray-100 text-gray-500 hover:text-red-600" title="Excluir comentário">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>

                                    <div id="comentario-view-{{ $comentario->id }}" class="text-sm text-gray-700 whitespace-pre-line transition-opacity duration-300">
                                        {{ $comentario->conteudo }}
                                    </div>

                                    @if (Auth::id() === $comentario->user_id)
                                        <form id="comentario-edit-form-{{ $comentario->id }}" action="{{ route('comentarios.update', $comentario->id) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('PUT')
                                            <textarea
                                                name="conteudo"
                                                rows="3"
                                                class="w-full bg-gray-50 border border-gray-200 rounded-md p-2 text-sm text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                            >{{ $comentario->conteudo }}</textarea>
                                            <div class="flex items-center justify-end gap-3 mt-2">
                                                <button type="button" onclick="toggleEdit({{ $comentario->id }})" class="text-sm font-medium text-gray-600 hover:text-gray-900">Cancelar</button>
                                                <button type="submit" class="px-4 py-1.5 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Salvar</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 5.523-4.477 10-10 10S1 17.523 1 12 5.477 2 11 2s10 4.477 10 10z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-800">Seja o primeiro a comentar!</h3>
                            <p class="mt-1 text-sm text-gray-500">Ainda não há comentários nesta publicação.</p>
                        </div>
                    @endforelse
                </div>
    
            </div>
        @empty
            <div class="text-center py-10 bg-slate-50 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-slate-800">Nenhuma denúncia concluída</h3>
                <p class="mt-1 text-sm text-slate-500">Este usuário ainda não possui um histórico de denúncias concluídas.</p>
            </div>
        @endforelse
    </div>
</div>
<script>
    function toggleEdit(id) {
        const view = document.getElementById('comentario-view-' + id);
        const form = document.getElementById('comentario-edit-form-' + id);
        const actions = view.closest('.group').querySelector('.flex.items-center.gap-1'); // Seleciona o menu de ações

        // Esconde o menu de ações para não atrapalhar a edição
        if (actions) {
            actions.classList.add('opacity-0');
        }

        if (form.classList.contains('hidden')) {
            // Prepara para a transição
            view.style.opacity = '0';
            setTimeout(() => {
                view.classList.add('hidden');
                form.classList.remove('hidden');
                form.style.opacity = '0';
                // Força o navegador a aplicar o estilo antes de mudar a opacidade
                void form.offsetWidth;
                setTimeout(() => {
                    form.style.opacity = '1';
                    form.querySelector('textarea').focus(); // Foca no textarea
                }, 20);
            }, 150); // Tempo para a opacidade de saída
        } else {
            form.style.opacity = '0';
            setTimeout(() => {
                form.classList.add('hidden');
                view.classList.remove('hidden');
                view.style.opacity = '0';
                void view.offsetWidth;
                setTimeout(() => {
                    view.style.opacity = '1';
                    if (actions) {
                       actions.classList.remove('opacity-0'); // Mostra o menu de novo
                    }
                }, 20);
            }, 150);
        }
    }

    // Adiciona transições de opacidade aos elementos
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('[id^="comentario-view-"], [id^="comentario-edit-form-"]').forEach(el => {
            el.style.transition = 'opacity 150ms ease-in-out';
        });
    });
</script>
<script>
    function curtirDenuncia(btn, denunciaId) {
        fetch(`/denuncias/${denunciaId}/curtir`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            const countEl = btn.querySelector('.like-count');
            countEl.innerText = data.likes_count;

            if (data.liked) {
                btn.classList.add('text-blue-600');
            } else {
                btn.classList.remove('text-blue-600');
            }
        })
        .catch(err => console.error('Erro ao curtir:', err));
    }
</script>
<script>
// --- Funções dos Modais ---
    function abrirModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.add('open');
            void modal.offsetWidth; 
        }
    }

    function fecharModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.remove('open');
        }
    }

    function copiarLink() {
        const linkInput = document.getElementById('share-link');
        linkInput.select();
        linkInput.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(linkInput.value);
        alert('Link copiado para a área de transferência!');
    }

    // Fechar modais com a tecla ESC
    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape") {
            document.querySelectorAll('.modal.open').forEach(modal => fecharModal(modal.id));
        }
    });

</script>
@endsection