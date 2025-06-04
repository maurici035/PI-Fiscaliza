<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;

class ComentarioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'denuncia_id' => 'required|exists:denuncias,id',
            'texto' => 'required|string|max:1000',
        ]);

        $comentario = new Comentario();
        $comentario->denuncia_id = $request->denuncia_id;
        $comentario->usuario_id = auth()->id();
        $comentario->conteudo = $request->texto; // ou $request->conteudo, conforme o nome do campo no frontend
        $comentario->save();

        return response()->json(['success' => true, 'comentario' => $comentario]);
    }
}
