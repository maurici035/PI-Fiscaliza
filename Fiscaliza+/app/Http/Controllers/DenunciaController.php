<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denuncia; // sua model Denuncia

class DenunciaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|string|max:1000',
            'video' => 'nullable|file|mimes:mp4,mov,avi|max:10240', // 10MB max
            'foto' => 'nullable|image|max:5120', // 5MB max
            'localizacao' => 'nullable|string|max:255',
        ]);

        $denuncia = new Denuncia();
        $denuncia->descricao = $request->descricao;
        $denuncia->localizacao = $request->localizacao;

        // Salvar vídeo, se enviado
        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('videos', 'public');
            $denuncia->video_path = $path;
        }

        // Salvar foto, se enviada
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('fotos', 'public');
            $denuncia->foto_path = $path;
        }

        $denuncia->save();

        return redirect()->back()->with('success', 'Denúncia enviada com sucesso!');
    }
}
