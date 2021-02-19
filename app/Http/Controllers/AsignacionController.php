<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Asignacion;


class AsignacionController extends Controller
{
    public function ListarAsignacion($id){
        $asignacion = DB::table('asignacion as a')->join('personal as p', 'p.per_dni', '=', 'a.per_dni')
        ->join('curso as c', 'c.cur_cod', '=', 'a.cur_cod')->join('seccion as s', 's.sec_cod', '=', 'a.sec_cod')
        ->join('grado as g', 'g.gra_cod', '=', 's.gra_cod')
        ->select('a.per_dni', 'a.cur_cod', 'c.cur_descripcion', 'a.sec_cod', 's.sec_letra', 's.gra_cod', 'g.gra_descripcion')
        ->where('p.per_dni','=',$id)->get();
        return response()->json($asignacion);
    }

    public function InsertarAsignacion(Request $request){
        
        $array = $request->json()->all();
        foreach ($array as $item) {
            $asignacion = new Asignacion();
            $asignacion->per_dni = $item['per_dni'];
            $asignacion->cur_cod = $item['cur_cod'];
            $asignacion->sec_cod = $item['sec_cod'];
            $asignacion->save();
        }
    }

    public function EliminarAsignacion($id){
        $asignacion = Asignacion::findOrFail($id);
        $asignacion->delete();
    }
}