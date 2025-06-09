<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denuncia;
use Illuminate\Support\Facades\File;
use App\Helpers\GeolocationHelper;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class DenunciaController extends Controller
{
    public function show($id)
    {
        $usuario = FacadesAuth::user();
        $denuncia = Denuncia::with(['user', 'comentarios.user', 'curtidas'])
        ->withCount('comentarios')
        ->findOrFail($id);

        return view('denuncias.show-denuncia', compact('denuncia', 'usuario'));
    }

    public function edit($id)
    {
        $denuncia = Denuncia::findOrFail($id);

        // Garante que o usuário só edite suas denúncias
        if ($denuncia->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Acesso não autorizado.');
        }

        return view('denuncias.editar-denuncias', compact('denuncia'));
    }

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

    public function update(Request $request, $id)
    {
        $denuncia = Denuncia::findOrFail($id);

        if ($denuncia->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Acesso não autorizado.');
        }

        $request->validate([
            'descricao' => 'required|string',
            'foto' => 'nullable|image|max:5120',
            'video' => 'nullable|mimes:mp4,mov,avi|max:102400',
        ]);

        $denuncia->descricao = $request->descricao;
        $denuncia->localizacao_texto = $request->localizacao_texto;
        $denuncia->latitude = $request->latitude;
        $denuncia->longitude = $request->longitude;

        // Atualização de foto
        if ($request->hasFile('foto')) {
            if ($denuncia->foto_path && File::exists(public_path($denuncia->foto_path))) {
                File::delete(public_path($denuncia->foto_path));
            }

            $foto = $request->file('foto');
            $nomeFoto = uniqid() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('assets/denuncias/pictures'), $nomeFoto);
            $denuncia->foto_path = 'assets/denuncias/pictures/' . $nomeFoto;
        }

        // Atualização de vídeo
        if ($request->hasFile('video')) {
            if ($denuncia->video_path && File::exists(public_path($denuncia->video_path))) {
                File::delete(public_path($denuncia->video_path));
            }

            $video = $request->file('video');
            $nomeVideo = uniqid() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('assets/denuncias/videos'), $nomeVideo);
            $denuncia->video_path = 'assets/denuncias/videos/' . $nomeVideo;
        }

        if (!empty($denuncia->latitude) && !empty($denuncia->longitude)) {
            $denuncia->endereco = GeolocationHelper::obterEnderecoPorCoordenadas(
                $denuncia->latitude,
                $denuncia->longitude
            );
        }

        $denuncia->save();

        return redirect()->route('profile.showPerfil', $denuncia->user_id)->with('success', 'Denúncia atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $denuncia = Denuncia::findOrFail($id);

        if ($denuncia->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Acesso não autorizado.');
        }

        // Apaga arquivos
        if ($denuncia->foto_path && File::exists(public_path($denuncia->foto_path))) {
            File::delete(public_path($denuncia->foto_path));
        }

        if ($denuncia->video_path && File::exists(public_path($denuncia->video_path))) {
            File::delete(public_path($denuncia->video_path));
        }

        $denuncia->delete();

        return redirect()->route('profile.showPerfil', $denuncia->user_id)->with('success', 'Denúncia excluída com sucesso!');
    }

}
