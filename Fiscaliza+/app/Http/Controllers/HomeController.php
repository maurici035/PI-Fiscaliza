<?php

namespace App\Http\Controllers;

use App\Helpers\GeolocationHelper;
use Illuminate\Http\Request;
use App\Models\Denuncia;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class HomeController extends Controller
{
    public function index()
    {
        // Buscar denúncias do banco (exemplo)
        $denuncias = Denuncia::all();
        $denuncias = Denuncia::with('comentarios.user')
                     ->withCount('comentarios')
                     ->latest()
                     ->get();
        $usuario = FacadesAuth::user();

        // Passar para a view
        return view('home', compact('denuncias', 'usuario'));
    }

    
}
