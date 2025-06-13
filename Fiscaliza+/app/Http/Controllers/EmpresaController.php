<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmpresaController extends Controller
{
 public function create()
    {
        return view('auth.EmpresaCadastro');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:empresas',
            'senha' => 'required|string|min:6|confirmed',
            'tipo_servico' => 'required|string',
            'cidade' => 'required|string',
        ]);

        $empresa = Empresa::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
            'tipo_servico' => $request->tipo_servico,
            'cidade' => $request->cidade,
        ]);

        Auth::guard('empresa')->login($empresa);

        return redirect()->route('empresa.dashboard')->with('success', 'Cadastro realizado com sucesso!');
    }


    public function page() {
        $empresa = auth()->guard('empresa')->user();

        if (!$empresa) {
            return redirect()->route('empresa.login')->with('error', 'Você precisa estar logado como empresa.');
        }

        $denuncias = Denuncia::where('categoria', $empresa->tipo_servico)
            ->where(function ($query) use ($empresa) {
                $cidade = strtolower($empresa->cidade);
                $query->whereRaw('LOWER(localizacao_texto) LIKE ?', ["%$cidade%"])
                    ->orWhereRaw('LOWER(endereco) LIKE ?', ["%$cidade%"]);
            })
        ->get();

        return view('empresa.dashboard', compact('denuncias', 'empresa'));
    }


}
