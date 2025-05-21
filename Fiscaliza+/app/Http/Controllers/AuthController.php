<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|string|min:6',
        ]);

        $usuario = Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
        ]);

        return redirect('/login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'senha' => 'required|string',
    ]);

    $usuario = Usuario::where('email', $request->email)->first();

    if (!$usuario || !Hash::check($request->senha, $usuario->senha)) {
        // Login falhou: volta com mensagem de erro
        return back()->withErrors(['login' => 'Usuário ou senha incorretos'])->withInput();
    }

    // Login OK: autentica e redireciona com mensagem de sucesso
    auth()->login($usuario);

    return redirect()->route('home')->with('success', 'Login realizado com sucesso!');
}

}
