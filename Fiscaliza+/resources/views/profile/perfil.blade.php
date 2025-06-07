@extends('layouts.app')

@section('title', 'Fiscaliza+ | Perfil do Usuário')

@section('head')
@endsection

@section('content')

<div class="max-w-3xl mx-auto p-6">
  <h1 class="text-4xl font-extrabold mb-8 text-center">
    Fiscaliza<span class="text-indigo-600">+</span>
  </h1>

  <div class="flex flex-col items-center mb-8">
    <img 
      src="{{ asset('imgs/profile/' . $usuario->imagem) }}" 
      alt="Foto do Usuário" 
      class="w-36 h-36 rounded-full object-cover border-4 border-gray-700 mb-4"
    >
    <div class="text-2xl font-semibold">Perfil do Usuário</div>
  </div>

  {{-- ALERTA DINÂMICO --}}
  <div 
    id="alertSuccess" 
    class="hidden fixed top-0 left-0 w-full bg-green-500 text-white text-center py-3 shadow-md transition-opacity duration-500"
  >
    {{ session('success') }}
  </div>


  <div class="bg-white shadow-md rounded-lg p-6">
    <form id="profileForm" method="POST" action="{{ route('usuario.update', $usuario->id) }}" enctype="multipart/form-data" class="space-y-6">
      @csrf
      @method('PUT')

      <div>
        <label for="nome" class="block font-semibold mb-2">Nome:</label>
        <input 
          type="text" 
          id="nome" 
          name="nome" 
          value="{{ $usuario->nome }}" 
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
        >
      </div>

      <div>
        <label for="email" class="block font-semibold mb-2">Email:</label>
        <input 
          type="email" 
          id="email" 
          name="email" 
          value="{{ $usuario->email }}" 
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
        >
      </div>
      <div>
        <label for="data_nascimento" class="block font-semibold mb-2">Data de Nascimento:</label>
        <input 
          type="date" 
          id="data_nascimento" 
          name="data_nascimento" 
          value="{{ $usuario->data_nascimento }}" 
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
        >
      </div>

      <div>
        <label for="imagem" class="block font-semibold mb-2">Foto de Perfil:</label>
        <input 
          type="file" 
          id="imagem" 
          name="imagem" 
          class="w-full text-gray-700"
        >
      </div>

      <div>
        <button 
          type="button" 
          id="btnSave" 
          class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-md hover:bg-indigo-700 transition"
        >
          Salvar
        </button>
      </div>
    </form>
  </div>
</div>

{{-- MODAL DE CONFIRMAÇÃO --}}
<div id="confirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg p-6 max-w-sm w-full text-center">
    <h2 class="text-xl font-semibold mb-4">Confirmar Alteração</h2>
    <p class="mb-6">Você tem certeza que deseja alterar o perfil?</p>
    <div class="flex justify-center gap-4">
      <button id="confirmYes" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">Sim</button>
      <button id="confirmNo" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition">Não</button>
    </div>
  </div>
</div>

<script>
  // Modal e botão salvar
  const btnSave = document.getElementById('btnSave');
  const modal = document.getElementById('confirmModal');
  const form = document.getElementById('profileForm');

  btnSave.addEventListener('click', () => {
    modal.classList.remove('hidden');
  });

  document.getElementById('confirmNo').addEventListener('click', () => {
    modal.classList.add('hidden');
  });

  document.getElementById('confirmYes').addEventListener('click', () => {
    modal.classList.add('hidden');
    form.submit();
  });

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
