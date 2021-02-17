<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Seccion;


class SeccionController extends Controller
{
    public function ListarSeccion($gra_cod){
        $seccion = DB::table('seccion as s')->join('grado as g', 'g.gra_cod', '=', 's.gra_cod')
                ->join('nivel as n', 'n.niv_cod', '=', 's.niv_cod')
                ->select('s.sec_cod', 's.niv_cod','s.gra_cod', 's.sec_letra')->where('s.gra_cod', '=', $gra_cod)->get();
        return response()->json($seccion);
    }
}
