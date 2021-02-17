<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class NotaController extends Controller
{
    public function ListarNotasporCurso($cur_cod,$gra_cod,$sec_cod){
        $notas = DB::table('nota as n')->join('matricula as m', 'm.mat_num', '=', 'n.mat_num')
        ->join('alumno as a', 'a.alu_dni', '=', 'm.alu_dni')->where('n.cur_cod', '=', $cur_cod)
        ->where('m.gra_cod', '=', $gra_cod)->where('m.sec_cod', '=', $sec_cod)
        ->select(DB::raw('a.alu_dni, CONCAT(a.alu_apellidop, \' \',a.alu_apellidop,\' \',a.alu_nombres) as Alumno,
            (select no_calificacion as "Periodo 1" from nota where no_periodo=1),
		    (select no_calificacion as "Periodo 2" from nota where no_periodo=2),
		    (select no_calificacion as "Periodo 3" from nota where no_periodo=3),
		    (select no_calificacion as "Promedio" from nota where no_periodo=4), m.mat_num'))
        ->groupBy('a.alu_dni', 'm.mat_num')->get();
        return response()->json($notas);
    }

}
