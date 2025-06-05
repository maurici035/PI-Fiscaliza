<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    /**
     * Exibe o perfil do usuário autenticado
     */
    public function index()
    {
        $usuario = Auth::user();

        if (!$usuario) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para acessar seu perfil.');
        }

        return view('perfil', compact('usuario'));
    }

    /**
     * Exibe o formulário para editar o perfil
     */
    public function edit()
    {
        $usuario = Auth::user();

        if (!$usuario) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para editar seu perfil.');
        }

        return view('alterar-perfil-usuario', compact('usuario'));
    }    /**
         * Atualiza o perfil do usuário
         */
    public function update(Request $request)
    {
        $usuario = Auth::user();

        if (!$usuario) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para atualizar seu perfil.');
        }        // Debug: verificar dados recebidos
        \Log::info('Dados recebidos no update:', $request->all());
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $dadosAtualizacao = [
            'nome' => $request->nome,
            'email' => $request->email,
        ];// Processar remoção da foto se solicitado
        if ($request->has('remover_foto') && $request->remover_foto == '1') {
            if ($usuario->foto_perfil && Storage::disk('public')->exists($usuario->foto_perfil)) {
                Storage::disk('public')->delete($usuario->foto_perfil);
            }
            $dadosAtualizacao['foto_perfil'] = null;
        }
        // Processar upload da foto de perfil (só se não estiver removendo)
        elseif ($request->hasFile('foto_perfil')) {
            try {
                // Deletar foto anterior se existir
                if ($usuario->foto_perfil && Storage::disk('public')->exists($usuario->foto_perfil)) {
                    Storage::disk('public')->delete($usuario->foto_perfil);
                }

                // Salvar nova foto
                $path = $request->file('foto_perfil')->store('fotos_perfil', 'public');
                $dadosAtualizacao['foto_perfil'] = $path;

                \Log::info('Foto de perfil salva em: ' . $path);
            } catch (\Exception $e) {
                \Log::error('Erro ao salvar foto de perfil: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Erro ao salvar a foto de perfil. Tente novamente.');
            }
        }

        \Log::info('Dados para atualização:', $dadosAtualizacao);

        $usuario->update($dadosAtualizacao);

        \Log::info('Usuário após atualização:', $usuario->toArray());

        return redirect()->route('perfil')->with('success', 'Perfil atualizado com sucesso!');
    }

    /**
     * Altera a senha do usuário
     */
    public function alterarSenha(Request $request)
    {
        try {
            $usuario = Auth::user();

            if (!$usuario) {
                return response()->json(['success' => false, 'message' => 'Usuário não autenticado.'], 401);
            }

            $request->validate([
                'nova_senha' => 'required|string|min:6',
                'confirmar_senha' => 'required|string|same:nova_senha',
            ]);            // Atualizar a senha
            $usuario->update([
                'senha' => Hash::make($request->nova_senha)
            ]);

            \Log::info('Senha alterada para usuário: ' . $usuario->id);

            return response()->json(['success' => true, 'message' => 'Senha alterada com sucesso!']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dados inválidos: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Erro ao alterar senha: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Erro interno do servidor.'], 500);
        }
    }
}
