@extends('layouts.app')

@section('title', 'Fiscaliza+ | Cadastrar Denúncia')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/cadastrar-denuncia.css') }}">
  <script src="{{ asset('js/cadastrar-denuncia.js') }}"></script>
  <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
  
  <!-- Bootstrap Icons CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <script>
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          position => {
            document.getElementById('latitude').value = position.coords.latitude;
            document.getElementById('longitude').value = position.coords.longitude;

            const display = document.getElementById('location-display');
            display.innerText = `📍 Localização capturada: ${position.coords.latitude.toFixed(5)}, ${position.coords.longitude.toFixed(5)}`;
            display.classList.remove('hidden');
            display.classList.add('text-green-600');
          },
          error => {
            alert('Não foi possível obter sua localização.');
          }
        );
      } else {
        alert('Geolocalização não suportada pelo navegador.');
      }
    }
  </script>
@endsection

@section('content')
<div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-2xl shadow-lg border border-gray-100">
  <h2 class="text-3xl font-bold mb-6 text-gray-800 flex items-center gap-2">
    <i class="bi bi-megaphone-fill text-green-600"></i> Nova Denúncia
  </h2>

  @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
      {{ session('success') }}
    </div>
  @endif

  <form action="{{ route('denuncias.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
    @csrf

    <div>
      <label for="descricao" class="block text-sm font-semibold text-gray-700">
        <i class="bi bi-pencil-square mr-1 text-gray-600"></i>Descrição
      </label>
      <textarea id="descricao" name="descricao" required rows="4"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black focus:ring-green-500 focus:border-green-500 placeholder:text-gray-400"
        placeholder="Descreva aqui sua denúncia..."></textarea>
    </div>

    <div class="flex flex-col md:flex-row gap-6">
      <div class="flex-1">
        <label class="block text-sm font-semibold text-gray-700">
          <i class="bi bi-image-fill mr-1 text-gray-600"></i>Foto (opcional)
        </label>
        <input type="file" name="foto" accept="image/*"
          class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-md shadow-sm file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:bg-green-100 file:text-green-700 hover:file:bg-green-200">
        {{-- msg erro --}}
          @error('foto')
              <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
          @enderror
      </div>

      <div class="flex-1">
        <label class="block text-sm font-semibold text-gray-700">
          <i class="bi bi-camera-video-fill mr-1 text-gray-600"></i>Vídeo (opcional)
        </label>
        <input type="file" name="video" accept="video/*"
          class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-md shadow-sm file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:bg-green-100 file:text-green-700 hover:file:bg-green-200">
        @error('video')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
        </div>
    </div>

    <div>
      <label for="localizacao_texto" class="block text-sm font-semibold text-gray-700">
        <i class="bi bi-geo-alt-fill mr-1 text-gray-600"></i>Local (caso esteja distante)
      </label>
      <input type="text" name="localizacao_texto" id="localizacao_texto"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500"
        placeholder="Ex: BR-232, km 150">
    </div>

    <div>
      <button type="button" onclick="getLocation()"
        class="mt-2 px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition flex items-center gap-2">
        <i class="bi bi-geo-alt"></i> Obter Localização Atual
      </button>
      <p id="location-display" class="mt-2 text-sm hidden"></p>
      <input type="hidden" name="latitude" id="latitude">
      <input type="hidden" name="longitude" id="longitude">
    </div>

    <div>
      <button type="submit"
        class="w-full py-2 px-4 bg-green-600 text-white rounded-md hover:bg-green-700 transition font-semibold text-lg flex items-center justify-center gap-2">
        <i class="bi bi-send-fill"></i> Enviar Denúncia
      </button>
    </div>
  </form>
</div>
@endsection
