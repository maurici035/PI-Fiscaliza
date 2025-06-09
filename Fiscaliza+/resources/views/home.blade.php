@extends('layouts.app')

@section('title', 'Página Inicial')

@section('head')
    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">

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

<div class="bg-slate-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 space-y-8 py-8"> {{-- Adicionado py-8 para espaçamento vertical --}}

        {{-- Alerta de sucesso --}}
        @if (session('success'))
            <div id="success-alert" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md flex justify-between items-center" role="alert">
                <div class="flex items-center">
                    <i class="bi bi-check-circle-fill text-xl mr-3"></i>
                    <p class="font-bold">{{ session('success') }}</p>
                </div>
                <button onclick="document.getElementById('success-alert').style.display='none'" class="text-green-700 hover:text-green-900">
                    <i class="bi bi-x text-2xl"></i>
                </button>
            </div>
        @endif
        
        {{-- Notificação de Localização --}}
        <div id="location-feedback" class="hidden p-4 rounded-lg shadow-md text-sm" role="alert"></div>

        {{-- Formulário de denúncia --}}
        <form action="{{ route('denuncia.store') }}" method="POST" enctype="multipart/form-data" 
              class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 space-y-6 transform transition-all hover:shadow-xl">
            @csrf
            <div class="flex gap-4 items-start">
                <img src="{{ asset('imgs/profile/' . $usuario->imagem) }}" alt="Foto do Perfil" class="w-14 h-14 rounded-full object-cover border-2 border-slate-200">
                <textarea 
                    name="descricao" rows="3" required
                    class="flex-1 p-3 bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none resize-none transition-colors duration-300 placeholder-slate-400"
                    placeholder="O que você viu, {{ $usuario->nome }}?"
                ></textarea>
            </div>
            <div class="flex flex-wrap gap-4 items-center justify-between text-slate-600">
                <div class="flex flex-wrap gap-4 items-center" x-data="{ photoName: null, videoName: null }">
                    <label class="flex items-center gap-2 cursor-pointer hover:text-green-600 transition-colors duration-300">
                        <i class="bi bi-image text-xl"></i>
                        <span x-text="photoName ? 'Foto: ' + photoName.substring(0,15) + '...' : 'Adicionar Foto'"></span>
                        <input type="file" name="foto" accept="image/*" class="hidden" @change="photoName = $event.target.files[0] ? $event.target.files[0].name : null">
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer hover:text-red-600 transition-colors duration-300">
                        <i class="bi bi-play-circle-fill text-xl"></i>
                        <span x-text="videoName ? 'Vídeo: ' + videoName.substring(0,15) + '...' : 'Adicionar Vídeo'"></span>
                        <input type="file" name="video" accept="video/*" class="hidden" @change="videoName = $event.target.files[0] ? $event.target.files[0].name : null">
                    </label>
                </div>
                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <i class="bi bi-geo-alt-fill text-slate-400 text-xl"></i> 
                    <input type="text" name="localizacao_texto" placeholder="Endereço (opcional)" class="border-b-2 border-slate-200 focus:border-green-500 focus:outline-none p-2 w-full sm:w-64 text-sm transition-colors duration-300">
                </div>
            </div>
            <div class="border-t border-slate-200 pt-4 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button type="button" onclick="getLocation()" class="bg-slate-100 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-200 transition-all duration-300 flex items-center gap-2 text-sm font-semibold">
                        <i class="bi bi-compass"></i> Usar minha localização
                    </button>
                    <p id="location-display" class="text-sm hidden"></p>
                </div>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-3 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2">
                    <i class="bi bi-send-fill"></i> Publicar
                </button>
            </div>
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
        </form>

        {{-- Feed de denúncias --}}
        @foreach ($denuncias as $denuncia)
            {{-- Cada denúncia é um componente Alpine para controlar seus próprios comentários --}}
            <div x-data="{ commentsOpen: false }" class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 space-y-4 transition-shadow duration-300 hover:shadow-xl">
                
                {{-- CABEÇALHO DA DENÚNCIA --}}
                <div class="flex items-center gap-4">
                    <img src="{{ asset('imgs/profile/' . $denuncia->user->imagem) }}" alt="User" class="w-12 h-12 rounded-full object-cover border-2 border-slate-100">
                    <div>
                        <h2 class="font-bold text-gray-800">{{ $denuncia->user->nome }}</h2>
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
                        @if ($denuncia->user_id == $usuario->id)
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
                            <span class="font-semibold">Comentar</span>
                        </button>
                        <button onclick="abrirModal('modalCompartilhar')" class="flex items-center gap-2 text-slate-600 hover:text-purple-600 transition-colors duration-300 group">
                            <i class="bi bi-share text-xl group-hover:scale-110 transition-transform"></i>
                            <span class="font-semibold">Compartilhar</span>
                        </button>
                    </div>
                </div>
                
                {{-- ======================================================= --}}
                {{-- NOVA ÁREA DE COMENTÁRIOS DINÂMICA (Estilo Facebook)      --}}
                {{-- ======================================================= --}}
                <div x-show="commentsOpen" x-cloak x-transition.opacity.duration.300ms class="pt-4 mt-4 border-t border-slate-200 space-y-5">
                    
                    {{-- Lista de Comentários Existentes --}}
                    {{-- ATENÇÃO: Assumindo que você tem a relação 'comentarios' no seu model Denuncia --}}
                    <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                        @forelse ($denuncia->comentarios as $comentario)
                            <div class="flex items-start gap-3">
                                <img src="{{ asset('imgs/profile/' . ($comentario->user->imagem ?? 'default.jpg')) }}"
                                    class="w-9 h-9 rounded-full object-cover border border-slate-200"
                                    alt="Foto">

                                <div class="flex-1">
                                    <div class="bg-slate-100 rounded-xl p-3">
                                        <p class="font-semibold text-sm text-slate-800">
                                            {{ $comentario->user->nome ?? 'Usuário removido' }}
                                        </p>
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
        @endforeach
    </div>
</div>

{{-- ===== MODAIS (O modal de comentário não é mais necessário aqui) ===== --}}

{{-- Modal Genérico para Conteúdo (Mantido para "Ver mais" ou outras funções) --}}
<div id="modalConteudo" class="modal hidden fixed inset-0 bg-black/60 items-center justify-center z-50 p-4">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-2xl space-y-4 max-h-[90vh] flex flex-col">
        <div class="p-6 flex justify-between items-center border-b border-slate-200">
            <h2 class="text-xl font-bold text-slate-800" id="modalConteudoLabel">Detalhes da Denúncia</h2>
            <button onclick="fecharModal('modalConteudo')" class="text-slate-400 hover:text-slate-600 text-3xl">&times;</button>
        </div>
        <div id="modalConteudoBody" class="p-6 overflow-y-auto text-slate-700 leading-relaxed"></div>
        <div class="p-4 bg-slate-50 text-right rounded-b-xl">
            <button onclick="fecharModal('modalConteudo')" class="bg-slate-500 text-white px-5 py-2 rounded-lg hover:bg-slate-600 transition-colors duration-300 font-semibold">Fechar</button>
        </div>
    </div>
</div>

{{-- Modal de Compartilhamento (Mantido) --}}
<div id="modalCompartilhar" class="modal hidden fixed inset-0 bg-black/60 items-center justify-center z-50 p-4">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-md space-y-4 text-center">
        <div class="p-6 flex justify-between items-center border-b border-slate-200">
            <h2 class="text-xl font-bold text-slate-800">Compartilhar Denúncia</h2>
            <button onclick="fecharModal('modalCompartilhar')" class="text-slate-400 hover:text-slate-600 text-3xl">&times;</button>
        </div>
        <div id="modalCompartilharBody" class="p-8 flex flex-col items-center gap-4">
            <p class="text-slate-600">Copie o link para compartilhar esta denúncia:</p>
            <div class="w-full bg-slate-100 border rounded-lg p-2 flex items-center">
                <input type="text" value="{{ url()->current() }}" id="share-link" readonly class="bg-transparent flex-1 text-sm text-slate-700 focus:outline-none">
                <button onclick="copiarLink()" class="bg-green-500 text-white px-3 py-1 rounded text-sm font-semibold hover:bg-green-600">Copiar</button>
            </div>
        </div>
        <div class="p-4 bg-slate-50 text-right rounded-b-xl">
            <button onclick="fecharModal('modalCompartilhar')" class="bg-slate-500 text-white px-5 py-2 rounded-lg hover:bg-slate-600 transition-colors duration-300 font-semibold">Fechar</button>
        </div>
    </div>
</div>


<script>
    // --- Funções do Formulário de Denúncia ---
    function getLocation() {
        const feedbackDiv = document.getElementById('location-feedback');
        const display = document.getElementById('location-display');
        
        feedbackDiv.classList.remove('hidden', 'bg-red-100', 'border-red-500', 'text-red-700', 'bg-green-100', 'border-green-500', 'text-green-700');
        feedbackDiv.classList.add('bg-yellow-100', 'border-yellow-500', 'text-yellow-700');
        feedbackDiv.innerHTML = '<div class="flex items-center"><i class="bi bi-hourglass-split mr-3"></i><span>Obtendo sua localização, por favor aguarde...</span></div>';

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                position => {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                    
                    feedbackDiv.classList.remove('bg-yellow-100', 'border-yellow-500', 'text-yellow-700');
                    feedbackDiv.classList.add('bg-green-100', 'border-green-500', 'text-green-700');
                    feedbackDiv.innerHTML = '<div class="flex items-center"><i class="bi bi-check-circle-fill mr-3"></i><span>Localização obtida com sucesso!</span></div>';
                    
                    display.innerText = `📍 Coordenadas prontas!`;
                    display.classList.remove('hidden');
                    display.classList.add('text-green-600', 'font-semibold');
                    
                    setTimeout(() => feedbackDiv.classList.add('hidden'), 3000);
                },
                () => {
                    feedbackDiv.classList.remove('bg-yellow-100', 'border-yellow-500', 'text-yellow-700');
                    feedbackDiv.classList.add('bg-red-100', 'border-red-500', 'text-red-700');
                    feedbackDiv.innerHTML = '<div class="flex items-center"><i class="bi bi-exclamation-triangle-fill mr-3"></i><span>Não foi possível obter sua localização. Verifique as permissões no seu navegador.</span></div>';
                }
            );
        } else {
            feedbackDiv.classList.add('bg-red-100', 'border-red-500', 'text-red-700');
            feedbackDiv.innerText = 'Geolocalização não é suportada por este navegador.';
        }
    }

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

    // --- Funções de Interação do Card ---
    function abrirConteudo(btn) {
        const card = btn.closest('.bg-white');
        const description = card.querySelector('p.leading-relaxed').innerHTML;
        const user = card.querySelector('h2.font-bold').innerText;
        const location = card.querySelector('p.text-xs span:not([class*="mx-1"])').innerText;
        
        document.getElementById('modalConteudoLabel').innerText = `Denúncia de ${user} em ${location}`;
        document.getElementById('modalConteudoBody').innerHTML = description;
        
        const image = card.querySelector('img[alt="Foto da denúncia"]');
        const video = card.querySelector('video');
        if (image) {
            const clonedImage = image.cloneNode();
            clonedImage.className = 'w-full h-auto rounded-lg mt-4';
            document.getElementById('modalConteudoBody').appendChild(clonedImage);
        }
        if (video) {
            const clonedVideo = video.cloneNode(true);
            clonedVideo.className = 'w-full h-auto rounded-lg mt-4';
            document.getElementById('modalConteudoBody').appendChild(clonedVideo);
        }

        abrirModal('modalConteudo');
    }

    function curtirDenuncia(btn) {
        const countEl = btn.querySelector('.like-count');
        let count = parseInt(countEl.innerText);
        if (btn.classList.contains('text-blue-600')) {
             countEl.innerText = --count;
             btn.classList.remove('text-blue-600');
        } else {
             countEl.innerText = ++count;
             btn.classList.add('text-blue-600');
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