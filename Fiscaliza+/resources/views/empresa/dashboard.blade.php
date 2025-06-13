@extends('layouts.app')

@section('title', 'Página Inicial')

@section('head')

@section('content')

<div class="max-w-3xl mx-auto px-4 space-y-8 py-8">
    @foreach ($denuncias as $denuncia)
        {{-- conteúdo como no exemplo acima --}}
        {{-- Cada denúncia é um componente Alpine para controlar seus próprios comentários --}}
        <div x-data="{ commentsOpen: false }" class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 space-y-4 transition-shadow duration-300 hover:shadow-xl">
            
            {{-- CABEÇALHO DA DENÚNCIA --}}
            <div class="flex items-center gap-4">
                <a href="{{ route('profile.showPerfil', $denuncia->user_id )}}">
                    <img src="{{ asset('imgs/profile/' . $denuncia->user->imagem) }}" alt="User" class="w-12 h-12 rounded-full object-cover border-2 border-slate-100">
                </a>
                <div>
                    <a href="{{ route('profile.showPerfil', $denuncia->user_id) }}">
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
            <a href="{{ route('denuncias.show-denuncia', $denuncia->id) }}"
                class="flex items-center gap-2 text-slate-600 hover:text-yellow-600 transition-colors duration-300 group">
                <i class="bi bi-eye text-xl group-hover:scale-110 transition-transform"></i>
                <span class="font-semibold">Ver mais</span>
            </a>
            {{-- botão de concluido --}}
            @if (!$denuncia->concluida)
                <form action="{{ route('denuncias.concluir', $denuncia->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Marcar como Concluída
                    </button>
                </form>
            @else
                <form action="{{ route('denuncias.desconcluir', $denuncia->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">
                        Desmarcar Conclusão
                    </button>
                </form>
            @endif

    @endforeach
</div>

@endsection