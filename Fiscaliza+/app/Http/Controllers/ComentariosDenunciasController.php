<?php

namespace App\Http\Controllers;

use App\Models\ComentariosDenuncias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentariosDenunciasController extends Controller
{
        // Listar comentários de uma denúncia
    public function index($denunciaId)
    {
        $comentarios = ComentariosDenuncias::where('denuncia_id', $denunciaId)
            ->with('user')
            ->latest()
            ->get();

        return view('home', compact('comentarios'));
    }

    // Salvar novo comentário
    public function store(Request $request)
    {
        $request->validate([
            'denuncia_id' => 'required|exists:denuncias,id',
            'conteudo' => 'required|string|max:1000',
        ]);

        ComentariosDenuncias::create([
            'denuncia_id' => $request->denuncia_id,
            'user_id' => Auth::id(),
            'conteudo' => $request->conteudo,
        ]);

        return redirect()->back()->with('success', 'Comentário enviado com sucesso!');
    }
}
