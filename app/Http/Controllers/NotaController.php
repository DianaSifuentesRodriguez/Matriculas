<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requests\SearchRequest;
use Illuminate\Support\Facades\DB;
use App\Nota;
use App\Alumno;

class NotaController extends Controller
{
    public function ListarNotasporCurso($cur_cod,$gra_cod,$sec_cod){
        $notas = DB::table('nota as n')->join('matricula as m', 'm.mat_num', '=', 'n.mat_num')
        ->join('alumno as a', 'a.alu_dni', '=', 'm.alu_dni')->where('n.cur_cod', '=', $cur_cod)
        ->where('m.gra_cod', '=', $gra_cod)->where('m.sec_cod', '=', $sec_cod)
        ->select(DB::raw('a.alu_dni, CONCAT(a.alu_apellidop, \' \',a.alu_apellidop,\' \',a.alu_nombres) as Alumno, m.mat_num,
            (select no.no_calificacion as "Periodo 1" from nota no inner join matricula ma on no.mat_num = ma.mat_num inner join curso cu on no.cur_cod = cu.cur_cod where no.no_periodo=1 and ma.mat_num = m.mat_num and no.cur_cod = '.$cur_cod.' ),
            (select no.no_id as "ID Nota 1" from nota no inner join matricula ma on no.mat_num = ma.mat_num inner join curso cu on no.cur_cod = cu.cur_cod where no.no_periodo=1 and ma.mat_num = m.mat_num and no.cur_cod = '.$cur_cod.' ),
		    (select no.no_calificacion as "Periodo 2" from nota no inner join matricula ma on no.mat_num = ma.mat_num inner join curso cu on no.cur_cod = cu.cur_cod where no.no_periodo=2 and ma.mat_num = m.mat_num and no.cur_cod = '.$cur_cod.' ),
            (select no.no_id as "ID Nota 2" from nota no inner join matricula ma on no.mat_num = ma.mat_num inner join curso cu on no.cur_cod = cu.cur_cod where no.no_periodo=2 and ma.mat_num = m.mat_num and no.cur_cod = '.$cur_cod.' ),
		    (select no.no_calificacion as "Periodo 3" from nota no inner join matricula ma on no.mat_num = ma.mat_num inner join curso cu on no.cur_cod = cu.cur_cod where no.no_periodo=3 and ma.mat_num = m.mat_num and no.cur_cod = '.$cur_cod.' ),
            (select no.no_id as "ID Nota 3" from nota no inner join matricula ma on no.mat_num = ma.mat_num inner join curso cu on no.cur_cod = cu.cur_cod where no.no_periodo=3 and ma.mat_num = m.mat_num and no.cur_cod = '.$cur_cod.' )
            ')) 
        ->groupBy('a.alu_dni', 'm.mat_num')->orderBy('a.alu_apellidop')
        ->get();
        return response()->json($notas);
    }

    public function InsertarNotas(Request $request){
        $array = $request->json()->all();
        // settype($array, 'string');
        // $data = json_decode($array, true);
        // return $array;
        foreach($array as $item){
            // echo $item['id_nota'].'<br>';
            
            $nota = Nota::findOrFail($item['id_nota']);
            $nota->no_calificacion =$item['nota'];
            $nota->update();
            // return $nota;    
        }



        // $notas = Notas::get();
        // foreach($notas as $nota){
        //     $json[0]['id_nota'];

        // }
        // $array = json_decode($json,true);
        // foreach($array as $item){
        // echo $item['cur_cod'].'<br>';
        
    }



}