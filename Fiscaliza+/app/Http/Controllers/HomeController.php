<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denuncia;

class HomeController extends Controller
{
    public function index()
    {
        // Buscar denúncias do banco (exemplo)
        $denuncias = Denuncia::all();

        // Passar para a view
        return view('home', compact('denuncias'));
    }

    
}
