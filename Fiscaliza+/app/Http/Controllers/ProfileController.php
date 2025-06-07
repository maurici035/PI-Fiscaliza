<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function page(){

        $usuario = Auth::user();

        return view('profile.perfil', compact('usuario'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->data_nascimento = $request->data_nascimento;

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nomeImagem = uniqid() . '.' . $imagem->getClientOriginalExtension();
            $imagem->move(public_path('imgs/profile'), $nomeImagem);
            $usuario->imagem = $nomeImagem;
        }

        $usuario->save();

        return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
