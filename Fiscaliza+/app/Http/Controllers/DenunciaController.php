<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denuncia;
use Illuminate\Support\Facades\File;
use App\Helpers\GeolocationHelper;

class DenunciaController extends Controller
{
 public function store(Request $request)
    {
        // Validação
        $request->validate([
            'descricao' => 'required|string',
            'foto' => 'nullable|image|max:5120',
            'video' => 'nullable|mimes:mp4,mov,avi|max:102400',
        ]);

        // Dados iniciais
        $data = $request->only([
            'descricao',
            'localizacao_texto',
            'latitude',
            'longitude',
        ]);

        $data['user_id'] = auth()->id();

        // Diretórios de destino
        $fotoDestino = public_path('assets/denuncias/pictures');
        $videoDestino = public_path('assets/denuncias/videos');

        // Cria os diretórios se não existirem
        if (!File::exists($fotoDestino)) {
            File::makeDirectory($fotoDestino, 0755, true);
        }

        if (!File::exists($videoDestino)) {
            File::makeDirectory($videoDestino, 0755, true);
        }

        // Upload da foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nomeFoto = uniqid() . '.' . $foto->getClientOriginalExtension();
            $foto->move($fotoDestino, $nomeFoto);
            $data['foto_path'] = 'assets/denuncias/pictures/' . $nomeFoto;
        }

        // Upload do vídeo
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $nomeVideo = uniqid() . '.' . $video->getClientOriginalExtension();
            $video->move($videoDestino, $nomeVideo);
            $data['video_path'] = 'assets/denuncias/videos/' . $nomeVideo;
        }

        if (!empty($data['latitude']) && !empty($data['longitude'])) {
            $data['endereco'] = GeolocationHelper::obterEnderecoPorCoordenadas(
                $data['latitude'],
                $data['longitude']
            );
        }


        // Salva no banco
        try {
            Denuncia::create($data);
            return redirect()->back()->with('success', 'Denúncia enviada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao salvar: ' . $e->getMessage());
        }
    }
}
