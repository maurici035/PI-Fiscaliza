<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function showPerfil($id)
    {
        $usuario = Usuario::findOrFail($id);

        // Pega as denúncias NÃO CONCLUÍDAS (em aberto)
        $denuncias = Denuncia::where('user_id', $usuario->id)
                            ->where('concluida', false)
                            ->withCount('comentarios') 
                            ->latest()
                            ->get();

        // Pega as denúncias CONCLUÍDAS
        $denunciasConcluidas = Denuncia::where('user_id', $usuario->id)
                                      ->where('concluida', true) // A condição principal
                                      ->withCount('comentarios')
                                      ->latest()
                                      ->get();

        // Passa AMBAS as coleções para a view
        return view('profile.showPerfil', [ // ou o nome da sua view
            'usuario' => $usuario,
            'denuncias' => $denuncias,
            'denunciasConcluidas' => $denunciasConcluidas,
        ]);
    }


    public function page(){

        $usuario = Auth::user();

        return view('profile.perfil', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        // Validação (se necessário)
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'data_nascimento' => 'nullable|date',
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Atualiza os dados
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->data_nascimento = $request->data_nascimento;

        if ($request->hasFile('imagem')) {
            // Deletar imagem antiga (exceto a padrão)
            if ($usuario->imagem && $usuario->imagem !== 'default.jpg') {
                $caminho = public_path('imgs/profile/' . $usuario->imagem);
                if (file_exists($caminho)) {
                    unlink($caminho);
                }
            }

            $imagem = $request->file('imagem');
            $nomeImagem = time() . '.' . $imagem->getClientOriginalExtension();
            $imagem->move(public_path('imgs/profile'), $nomeImagem);
            $usuario->imagem = $nomeImagem;
        }

        $usuario->save();

        return redirect()->route('profile.showPerfil')->with('success', 'Perfil atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
