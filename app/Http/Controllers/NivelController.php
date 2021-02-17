<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nivel;

class NivelController extends Controller
{
    public function ListarNiveles(){
        $nivel = Nivel::get();
        return response()->json($nivel);
    }
}
