<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denuncia;

class DenunciaController extends Controller
{
    public function store(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'descricao' => 'required|string',
            'foto' => 'nullable|image|max:5120',
            'video' => 'nullable|mimes:mp4,mov,avi|max:102400',
        ]);

        // Coleta os dados do request
        $data = $request->only([
            'descricao',
            'localizacao_texto',
            'latitude',
            'longitude',
        ]);

        // ID do usuário autenticado
        $data['user_id'] = auth()->id();

        // Armazenar foto se existir
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        // Armazenar vídeo se existir
        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('videos', 'public');
        }

        // Tenta criar a denúncia
        try {
            Denuncia::create($data);
            return redirect()->back()->with('success', 'Denúncia enviada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao salvar: ' . $e->getMessage());
        }
    }
}
