@extends('layouts.app')

@section('title', 'Fiscaliza+ | Editar Denúncia')

@section('content')
<div class="bg-gray-100 min-h-screen font-sans">
    <div class="container mx-auto px-4 py-12">

        {{-- Cabeçalho da Página --}}
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-gray-800 mb-2">Editar Denúncia</h1>
            <p class="text-lg text-gray-600">Atualize as informações e mídias da sua denúncia.</p>
        </div>

        {{-- Card Principal do Formulário --}}
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg">

            {{-- Alertas de Sucesso e Erro --}}
            @if(session('success'))
                <div class="flex items-center bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="font-bold">Sucesso!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif
            @if(session('error'))
                 <div class="flex items-center bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="font-bold">Erro!</p>
                        <p>{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('denuncias.update', $denuncia->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-8">
                    {{-- Campo de Descrição --}}
                    <div>
                        <label for="descricao" class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                        <textarea name="descricao" id="descricao" rows="5" class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150" required>{{ old('descricao', $denuncia->descricao) }}</textarea>
                    </div>

                    {{-- Upload de Mídia (Foto e Vídeo) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Campo de Foto --}}
                        <div>
                            <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Foto (opcional)</label>
                            @if($denuncia->foto_path)
                                <div class="mb-4">
                                    <p class="text-xs text-gray-500 mb-2">Foto atual:</p>
                                    <img src="{{ asset($denuncia->foto_path) }}" alt="Foto atual" class="rounded-lg max-w-full h-auto shadow-md">
                                </div>
                            @endif
                            <input type="file" name="foto" id="foto" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                        </div>
                        
                        {{-- Campo de Vídeo --}}
                        <div>
                            <label for="video" class="block text-sm font-medium text-gray-700 mb-2">Vídeo (opcional)</label>
                             @if($denuncia->video_path)
                                <div class="mb-4">
                                     <p class="text-xs text-gray-500 mb-2">Vídeo atual:</p>
                                     <video class="rounded-lg w-full shadow-md" controls>
                                        <source src="{{ asset($denuncia->video_path) }}" type="video/mp4">
                                        Seu navegador não suporta a tag de vídeo.
                                    </video>
                                </div>
                            @endif
                            <input type="file" name="video" id="video" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                        </div>
                    </div>

                    <hr class="border-t border-gray-200">

                    {{-- Campos de Localização --}}
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Localização</h3>
                        <div class="space-y-4">
                             <div>
                                <label for="localizacao_texto" class="block text-sm font-semibold text-gray-700">
                                <i class="bi bi-geo-alt-fill mr-1 text-gray-500"></i>Endereço da Ocorrência
                                </label>
                                <p class="text-xs text-slate-500 mb-2">Informe o endereço ou use o botão para obter sua localização atual.</p>
                                <input type="text" name="localizacao_texto" id="localizacao_texto"
                                    class="w-full p-3 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none transition-colors duration-300 placeholder-slate-400"
                                    placeholder="Ex: Rua Coronel Siqueira, 123, Crato-CE">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <button type="button" onclick="getLocation()"
                                        class="px-5 py-2 bg-white border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-100 transition-all duration-300 flex items-center gap-2 text-sm font-semibold shadow-sm">
                                        <i class="bi bi-compass-fill text-green-600"></i> Usar minha localização atual
                                    </button>

                                    <div id="location-feedback" class="hidden"></div>

                                    <p id="location-display" class="mt-2 text-sm hidden"></p>
                                    <input type="hidden" name="latitude" id="latitude">
                                    <input type="hidden" name="longitude" id="longitude">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Botões de Ação --}}
                <div class="mt-10 flex items-center justify-end space-x-4">
                    <a href="{{ route('profile.showPerfil') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-lg transition duration-300">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 shadow-md hover:shadow-lg">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>

        {{-- Seção de Exclusão --}}
        <div class="max-w-4xl mx-auto mt-8 border-t-2 border-dashed border-red-300 pt-8">
             <div class="bg-red-50 p-6 rounded-2xl shadow-md border border-red-200">
                <h3 class="text-xl font-bold text-red-800">Atenção!</h3>
                <p class="text-red-700 mt-2 mb-4">Esta ação não pode ser desfeita. Ao excluir a denúncia, todos os dados e mídias associados serão permanentemente removidos.</p>
                <form action="{{ route('denuncias.destroy', $denuncia->id) }}" method="POST" onsubmit="return confirm('Tem certeza ABSOLUTA que deseja excluir esta denúncia? Esta ação é irreversível!');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                        Excluir Denúncia Permanentemente
                    </button>
                </form>
             </div>
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