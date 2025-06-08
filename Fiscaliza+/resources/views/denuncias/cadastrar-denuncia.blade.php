@extends('layouts.app')

@section('title', 'Fiscaliza+ | Nova Denúncia')

@section('head')
    <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection

@section('content')
<div class="bg-gray-100 min-h-screen font-sans">
    <div class="container mx-auto px-4 py-12">

        {{-- Cabeçalho --}}
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-gray-800 mb-2">Nova Denúncia</h1>
            <p class="text-lg text-gray-600">Preencha os campos abaixo para relatar uma ocorrência.</p>
        </div>

        {{-- Card do Formulário --}}
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg">
            
            {{-- Alerta de Sucesso --}}
            @if(session('success'))
                <div class="flex items-center bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                    <i class="bi bi-check-circle-fill text-xl mr-3"></i>
                    <div>
                        <p class="font-bold">Sucesso!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('denuncias.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-8">
                    {{-- Descrição --}}
                    <div>
                        <label for="descricao" class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                        <textarea name="descricao" id="descricao" rows="5" required class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition">{{ old('descricao') }}</textarea>
                    </div>

                    {{-- Mídias --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Foto --}}
                        <div x-data="{ imagePreview: null }">
                            <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Foto (opcional)</label>
                            <input 
                                type="file" 
                                name="foto" 
                                id="foto" 
                                accept="image/*"
                                @change="const file = $event.target.files[0]; if(file) imagePreview = URL.createObjectURL(file)"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                            
                            <template x-if="imagePreview">
                                <img :src="imagePreview" alt="Preview da imagem" class="mt-4 w-full h-64 object-cover rounded-lg shadow-md border">
                            </template>
                        </div>

                        {{-- Vídeo --}}
                        <div x-data="{ videoPreview: null }">
                            <label for="video" class="block text-sm font-medium text-gray-700 mb-2">Vídeo (opcional)</label>
                            <input 
                                type="file" 
                                name="video" 
                                id="video" 
                                accept="video/*"
                                @change="const file = $event.target.files[0]; if(file) videoPreview = URL.createObjectURL(file)"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                            
                            <template x-if="videoPreview">
                                <video :src="videoPreview" controls class="mt-4 w-full h-64 rounded-lg shadow-md border"></video>
                            </template>
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

                            {{-- ⚠️ Adicionado para exibir o status da geolocalização --}}
                            <div id="location-feedback" class="hidden"></div>

                            <p id="location-display" class="mt-2 text-sm hidden"></p>
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                        </div>
                    </div>

                    {{-- Ações --}}
                    <div class="mt-10 flex items-center justify-end space-x-4">
                        <a href="{{ route('profile.showPerfil') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-lg transition">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition hover:shadow-lg">
                            Enviar Denúncia
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function getLocation() {
        const feedbackDiv = document.getElementById('location-feedback');
        const display = document.getElementById('location-display');
        
        // Mostra estado "carregando"
        feedbackDiv.className = 'p-4 rounded-lg shadow-md text-sm mb-6 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700';
        feedbackDiv.innerHTML = `<div class="flex items-center"><i class="bi bi-hourglass-split animate-spin mr-3"></i><span>Obtendo sua localização, por favor aguarde...</span></div>`;
        feedbackDiv.classList.remove('hidden');

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                position => {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;

                    feedbackDiv.className = 'p-4 rounded-lg shadow-md text-sm mb-6 bg-green-100 border-l-4 border-green-500 text-green-700';
                    feedbackDiv.innerHTML = `<div class="flex items-center"><i class="bi bi-check-circle-fill mr-3"></i><span>Localização obtida com sucesso!</span></div>`;
                    
                    display.innerText = `📍 Coordenadas capturadas: ${position.coords.latitude.toFixed(4)}, ${position.coords.longitude.toFixed(4)}`;
                    display.className = 'mt-2 text-sm text-green-600 font-semibold';

                    setTimeout(() => {
                        feedbackDiv.classList.add('hidden');
                    }, 5000);
                },
                () => {
                    feedbackDiv.className = 'p-4 rounded-lg shadow-md text-sm mb-6 bg-red-100 border-l-4 border-red-500 text-red-700';
                    feedbackDiv.innerHTML = `<div class="flex items-center"><i class="bi bi-exclamation-triangle-fill mr-3"></i><span>Não foi possível obter sua localização. Verifique as permissões no navegador.</span></div>`;
                }
            );
        } else {
            feedbackDiv.className = 'p-4 rounded-lg shadow-md text-sm mb-6 bg-red-100 border-l-4 border-red-500 text-red-700';
            feedbackDiv.innerHTML = '<div class="flex items-center"><i class="bi bi-x-circle-fill mr-3"></i><span>Geolocalização não suportada neste navegador.</span></div>';
        }
    }
</script>
@endsection