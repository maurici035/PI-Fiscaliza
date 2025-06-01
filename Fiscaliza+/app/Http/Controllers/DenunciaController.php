<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denuncia;

class DenunciaController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'descricao' => 'required|string|max:1000',
                'titulo' => 'nullable|string|max:255',
                'video' => 'nullable|file|mimes:mp4,mov,avi|max:10240',
                'foto' => 'nullable|image|max:5120',
                'localizacao' => 'nullable|string|max:255',
            ]);

            $denuncia = new \App\Models\Denuncia();
            $denuncia->titulo = $request->titulo ?? substr($request->descricao, 0, 50);
            $denuncia->descricao = $request->descricao;

            if ($request->filled('localizacao')) {
                [$lat, $lng] = explode(',', $request->localizacao);
                $denuncia->latitude = floatval($lat);
                $denuncia->longitude = floatval($lng);
            }

            // Sempre pega do usuário autenticado
            $denuncia->usuario_id = auth()->id();
            $denuncia->nome_usuario = auth()->user()->nome;

            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('fotos', 'public');
                $denuncia->foto_path = $path;
            }
            if ($request->hasFile('video')) {
                $path = $request->file('video')->store('videos', 'public');
                $denuncia->video_path = $path;
            }

            \Log::info('Debug denuncia', [
                'usuario_id' => $denuncia->usuario_id,
                'nome_usuario' => $denuncia->nome_usuario,
                'auth_user' => auth()->user()
            ]);

            $denuncia->save();

            return response()->json(['success' => true, 'message' => 'Denúncia enviada com sucesso!']);
        } catch (\Exception $e) {
            \Log::error('Erro ao salvar denúncia: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Erro ao enviar denúncia: ' . $e->getMessage()], 500);
        }
    }
}
