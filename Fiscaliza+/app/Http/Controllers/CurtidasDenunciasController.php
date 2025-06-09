<?php

namespace App\Http\Controllers;

use App\Models\CurtidasDenuncias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurtidasDenunciasController extends Controller
{
    public function toggleCurtir($id)
    {
        $userId = Auth::id();

        $curtida = CurtidasDenuncias::where('denuncia_id', $id)
                    ->where('user_id', $userId)
                    ->first();

        if ($curtida) {
            // Remover curtida
            $curtida->delete();
            $liked = false;
        } else {
            // Criar curtida
            CurtidasDenuncias::create([
                'denuncia_id' => $id,
                'user_id' => $userId,
            ]);
            $liked = true;
        }

        // Contar curtidas atualizadas
        $count = CurtidasDenuncias::where('denuncia_id', $id)->count();

        return response()->json([
            'liked' => $liked,
            'likes_count' => $count,
        ]);
    }
}
