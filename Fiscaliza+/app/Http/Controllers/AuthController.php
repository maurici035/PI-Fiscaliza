<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Exibe a página de login
    public function showLogin()
    {
        return view('login');
    }

    // Exibe a página de cadastro
    public function showRegister()
    {
        return view('cadastro');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|string|min:6',
            'repitaSenha' => 'required|string|same:senha',
            'dataNascimento' => 'required|date',
        ]);

        $usuario = Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
            'data_nascimento' => $request->dataNascimento,
        ]);

        return redirect('/login')->with('success', 'Cadastro realizado com sucesso!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->senha, $usuario->senha)) {
            return back()->withErrors(['login' => 'Usuário ou senha incorretos'])->withInput();
        }

        // Login OK: autentica e redireciona
        Auth::login($usuario);
        return redirect()->route('home')->with('success', 'Login realizado com sucesso!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logout realizado com sucesso!');
    }
    public function destroy($id)
    {
        $usuario = \App\Models\Usuario::findOrFail($id);

        // Opcional: impede que o admin delete a si mesmo
        if (auth()->id() == $usuario->id) {
            return redirect()->back()->withErrors(['error' => 'Você não pode apagar seu próprio usuário!']);
        }

        $usuario->delete();
        return redirect()->back()->with('success', 'Usuário apagado com sucesso!');
    }
}
