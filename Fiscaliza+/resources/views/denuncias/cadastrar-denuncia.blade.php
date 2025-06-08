@extends('layouts.app')

@section('title', 'Fiscaliza+ | Cadastrar Denúncia')

@section('head')
    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
  
    {{-- Bootstrap Icons CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Alpine.js para interatividade dos inputs de arquivo --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection

@section('content')
<div class="bg-slate-50 min-h-screen py-12 px-4">
    <div class="max-w-2xl mx-auto">
        
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 p-8">
            <h2 class="text-3xl font-bold mb-2 text-gray-800 flex items-center gap-3">
                <i class="bi bi-megaphone-fill text-green-600"></i>
                <span>Nova Denúncia</span>
            </h2>
            <p class="text-slate-500 mb-8">Preencha os campos abaixo para registrar o que você presenciou.</p>

            {{-- Alerta de Sucesso --}}
            @if(session('success'))
                <div id="success-alert" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md flex justify-between items-center mb-6" role="alert">
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
            <div id="location-feedback" class="hidden p-4 rounded-lg shadow-md text-sm mb-6" role="alert"></div>

            <form action="{{ route('denuncias.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Descrição --}}
                <div>
                    <label for="descricao" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="bi bi-pencil-square mr-1 text-gray-500"></i>Descrição Detalhada
                    </label>
                    <textarea id="descricao" name="descricao" required rows="5"
                        class="w-full p-3 bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none resize-none transition-colors duration-300 placeholder-slate-400"
                        placeholder="Ex: Descarte irregular de lixo na margem do rio Salgado, próximo à ponte nova..."></textarea>
                </div>

                {{-- Inputs de Mídia --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Input de Foto --}}
                    <div x-data="{ photoName: null }">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            <i class="bi bi-image-fill mr-1 text-gray-500"></i>Foto (opcional)
                        </label>
                        <label class="flex justify-center w-full h-32 px-4 transition bg-slate-50 border-2 border-slate-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-slate-400 focus:outline-none">
                            <span class="flex items-center space-x-2">
                                <i class="bi bi-cloud-upload text-2xl text-slate-500"></i>
                                <span class="font-medium text-slate-600">
                                    <span x-show="!photoName">Clique para enviar</span>
                                    <span x-show="photoName" x-text="photoName" class="text-green-600"></span>
                                </span>
                            </span>
                            <input @change="photoName = $event.target.files[0] ? $event.target.files[0].name : null" type="file" name="foto" accept="image/*" class="hidden">
                        </label>
                        @error('foto')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input de Vídeo --}}
                    <div x-data="{ videoName: null }">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                          <i class="bi bi-camera-video-fill mr-1 text-gray-600"></i>Vídeo (opcional)
                        </label>
                        <label class="flex justify-center w-full h-32 px-4 transition bg-slate-50 border-2 border-slate-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-slate-400 focus:outline-none">
                            <span class="flex items-center space-x-2">
                                <i class="bi bi-cloud-upload text-2xl text-slate-500"></i>
                                <span class="font-medium text-slate-600">
                                    <span x-show="!videoName">Clique para enviar</span>
                                    <span x-show="videoName" x-text="videoName" class="text-green-600"></span>
                                </span>
                            </span>
                            <input @change="videoName = $event.target.files[0] ? $event.target.files[0].name : null" type="file" name="video" accept="video/*" class="hidden">
                        </label>
                        @error('video')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Localização --}}
                <div class="space-y-4 rounded-lg bg-slate-50 border border-slate-200 p-4">
                    <div>
                        <label for="localizacao_texto" class="block text-sm font-semibold text-gray-700">
                            <i class="bi bi-geo-alt-fill mr-1 text-gray-500"></i>Endereço da Ocorrência
                        </label>
                        <p class="text-xs text-slate-500 mb-2">Informe o endereço ou use o botão para obter sua localização atual.</p>
                        <input type="text" name="localizacao_texto" id="localizacao_texto"
                            class="w-full p-3 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none transition-colors duration-300 placeholder-slate-400"
                            placeholder="Ex: Rua Coronel Siqueira, 123, Crato-CE">
                    </div>

                    <div>
                        <button type="button" onclick="getLocation()"
                            class="px-5 py-2 bg-white border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-100 transition-all duration-300 flex items-center gap-2 text-sm font-semibold shadow-sm">
                            <i class="bi bi-compass-fill text-green-600"></i> Usar minha localização atual
                        </button>
                        <p id="location-display" class="mt-2 text-sm hidden"></p>
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                    </div>
                </div>

                {{-- Botão de Envio --}}
                <div class="pt-4 border-t border-slate-200">
                    <button type="submit"
                        class="w-full py-3 px-4 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 font-semibold text-lg flex items-center justify-center gap-2">
                        <i class="bi bi-send-fill"></i> Enviar Denúncia
                    </button>
                </div>
            </form>
        </div>
        <p class="text-center text-slate-500 text-xs mt-4">Fiscaliza+ &copy; {{ date('Y') }}. Sua contribuição é importante.</p>
    </div>
</div>

<script>
    function getLocation() {
        const feedbackDiv = document.getElementById('location-feedback');
        const display = document.getElementById('location-display');
        
        // Limpa classes antigas e mostra o estado de "carregando"
        feedbackDiv.className = 'p-4 rounded-lg shadow-md text-sm mb-6 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700';
        feedbackDiv.innerHTML = `<div class="flex items-center"><i class="bi bi-hourglass-split animate-spin mr-3"></i><span>Obtendo sua localização, por favor aguarde...</span></div>`;

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                position => {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;

                    // Mostra sucesso
                    feedbackDiv.className = 'p-4 rounded-lg shadow-md text-sm mb-6 bg-green-100 border-l-4 border-green-500 text-green-700';
                    feedbackDiv.innerHTML = `<div class="flex items-center"><i class="bi bi-check-circle-fill mr-3"></i><span>Localização obtida com sucesso! As coordenadas foram preenchidas.</span></div>`;
                    
                    display.innerText = `📍 Coordenadas capturadas: ${position.coords.latitude.toFixed(4)}, ${position.coords.longitude.toFixed(4)}`;
                    display.className = 'mt-2 text-sm text-green-600 font-semibold';
                    
                    // Esconde a notificação após alguns segundos
                    setTimeout(() => {
                        feedbackDiv.classList.add('hidden');
                    }, 5000);
                },
                () => {
                    // Mostra erro de permissão
                    feedbackDiv.className = 'p-4 rounded-lg shadow-md text-sm mb-6 bg-red-100 border-l-4 border-red-500 text-red-700';
                    feedbackDiv.innerHTML = `<div class="flex items-center"><i class="bi bi-exclamation-triangle-fill mr-3"></i><span>Não foi possível obter sua localização. Verifique as permissões no seu navegador e tente novamente.</span></div>`;
                }
            );
        } else {
            // Mostra erro de navegador incompatível
            feedbackDiv.className = 'p-4 rounded-lg shadow-md text-sm mb-6 bg-red-100 border-l-4 border-red-500 text-red-700';
            feedbackDiv.innerHTML = '<div class="flex items-center"><i class="bi bi-x-circle-fill mr-3"></i><span>Geolocalização não é suportada por este navegador. Por favor, preencha o endereço manualmente.</span></div>';
        }
    }
</script>
@endsection