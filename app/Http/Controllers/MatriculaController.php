<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Matricula;
use App\Curso;
use App\Nota;

class MatriculaController extends Controller
{
    
    public function index()
    {
        $matricula = DB::table('matricula as m')->join('alumno as a', 'a.alu_dni', '=', 'm.alu_dni')->join('nivel as n', 'n.niv_cod', '=', 'm.niv_cod')
        ->join('grado as g', 'g.gra_cod', '=', 'm.gra_cod')->join('seccion as s', 's.sec_cod', '=', 'm.sec_cod')
        ->select('m.mat_num', 'm.alu_dni', 'a.alu_apellidop', 'a.alu_apellidom', 'a.alu_nombres','m.mat_anio', 'm.mat_fechar', 'm.niv_cod', 'n.niv_descripcion', 'm.gra_cod', 'g.gra_descripcion', 'm.sec_cod','s.sec_letra')->get();
        return response()->json($matricula);
    }

       
    public function store(Request $request)
    {
        try{
            $matricula = new Matricula();
            $matricula->mat_num = $request->mat_num;
            $matricula->alu_dni = $request->alu_dni;
            $matricula->mat_anio = $request->mat_anio;
            $matricula->mat_fechar = $request->mat_fechar;
            $matricula->niv_cod = $request->niv_cod;
            $matricula->gra_cod = $request->gra_cod;
            $matricula->sec_cod = $request->sec_cod;
            $matricula->save();
            $cursos = Curso::where('gra_cod', '=', $request->gra_cod)->get();
            if(isset($cursos)){
                foreach($cursos as $curso){
                    for($i = 1; $i <= 3; $i++){
                        $nota = new Nota();
                        $nota->cur_cod = $curso->cur_cod;
                        $nota->mat_num = $request->mat_num;
                        $nota->no_calificacion = 0;
                        $nota->no_periodo = $i;
                        $nota->save();
                    }
                }
            }
            $result = ['mat_num' => $matricula->mat_num,
                    'created' => true];
        }catch(Throwable $e){
            return "Error - " . $e->getMessage();
        }
    }

    public function show($id)
    {
        return Matricula::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $matricula = Matricula::findOrFail($id);
        $matricula->Update($request->all());
        return $matricula;
    }

    public function destroy($id)
    {
        $matricula = Matricula::findOrFail($id);
        $matricula->delete();
        return 204;
    }
}