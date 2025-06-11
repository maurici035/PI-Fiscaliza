<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmpresaAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-empresa');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);

        $empresa = Empresa::where('email', $request->email)->first();

        if ($empresa && Hash::check($request->senha, $empresa->senha)) {
            Auth::guard('empresa')->login($empresa);
            return redirect()->route('empresa.dashboard')->with('success', 'Login da empresa realizado com sucesso!');
        }

        return back()->withErrors([
            'credenciais' => 'Credenciais inválidas para empresa.',
        ])->withInput();
    }
}
