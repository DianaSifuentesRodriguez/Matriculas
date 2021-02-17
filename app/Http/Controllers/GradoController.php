<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Grado;

class GradoController extends Controller
{
    public function ListarGrado($niv_cod){
        $grado = DB::table('grado as g')->join('nivel as n', 'n.niv_cod', '=', 'g.niv_cod')
                ->select('g.gra_cod', 'g.niv_cod', 'g.gra_descripcion')->where('g.niv_cod', '=', $niv_cod)->get();
        return response()->json($grado);
    }
}
