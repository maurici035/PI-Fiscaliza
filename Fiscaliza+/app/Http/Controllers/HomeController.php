<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denuncia;

class HomeController extends Controller
{
    public function index()
    {
        // Buscar denúncias do banco com os dados dos usuários relacionados
        // Usando leftJoin para garantir que todas as denúncias serão carregadas mesmo sem usuário
        $denuncias = Denuncia::with([
            'usuario' => function ($query) {
                $query->withDefault([
                    'nome' => 'Usuário desconhecido'
                ]);
            }
        ])->get();

        // Passar para a view
        return view('home', compact('denuncias'));
    }


}
