<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Exibe a página de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Exibe a página de cadastro
    public function showRegister()
    {
        return view('auth.cadastro');
    }

    public function register(Request $request)
    {

        $mensagens = [
            // Validação do nome
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O nome deve ser um texto.',
            'nome.min' => 'O nome deve ter no mínimo :min caracteres.',
            'nome.max' => 'O nome deve ter no máximo :max caracteres.',
            
            // Validação do email
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Digite um email válido.',
            'email.unique' => 'Este email já está cadastrado.',
            
            // Validação da senha
            'senha.required' => 'O campo senha é obrigatório.',
            'senha.string' => 'A senha deve ser um texto.',
            'senha.min' => 'A senha deve ter no mínimo :min caracteres.',
            
            // Validação da confirmação de senha
            'repitaSenha.required' => 'Confirme sua senha.',
            'repitaSenha.string' => 'A confirmação de senha deve ser um texto.',
            'repitaSenha.same' => 'As senhas não coincidem.',
            
            // Validação da data de nascimento
            'dataNascimento.required' => 'O campo data de nascimento é obrigatório.',
            'dataNascimento.date' => 'Digite uma data válida.',
        ];
        
        $request->validate([
            'nome' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|string|min:6',
            'repitaSenha' => 'required|string|same:senha',
            'dataNascimento' => 'required|date',
        ], $mensagens);

        // Cálculo da idade
        $dataNascimento = \Carbon\Carbon::parse($request->dataNascimento);
        $idade = $dataNascimento->age;

        if ($idade < 16) {
            return back()->withErrors(['idade' => 'Você deve ter pelo menos 16 anos para se cadastrar.'])->withInput();
        }

        if ($idade > 90) {
            return back()->withErrors(['idade' => 'Idade superior ao permitido (90 anos).'])->withInput();
        }

        if ($dataNascimento->isFuture()) {
            return back()->withErrors(['idade' => 'Data de nascimento inválida.'])->withInput();
        }

        // Criação do usuário
        $usuario = Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
            'data_nascimento' => $dataNascimento,
        ]);

        Auth::login($usuario);

        // Redireciona para a home
        return redirect()->route('home')->with('success', 'Cadastro realizado com sucesso!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario) {
            return back()->withErrors([
                'credenciais' => 'Apenas usuários podem acessar por aqui.',
            ])->withInput();
        }

        if (Hash::check($request->senha, $usuario->senha)) {
            Auth::guard('web')->login($usuario);
            return redirect()->route('home')->with('success', 'Login de usuário realizado com sucesso!');
        }

        return back()->withErrors([
            'credenciais' => 'Email ou senha incorretos.',
        ])->withInput();
    }

    public function logout()
    {
        if (Auth::guard('empresa')->check()) {
            Auth::guard('empresa')->logout();
        } elseif (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        return redirect()->route('index')->with('success', 'Logout realizado com sucesso!');
    }
}
