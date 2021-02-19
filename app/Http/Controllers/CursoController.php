<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Curso;
use App\Grado;
class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curso = DB::table('curso as c')->join('grado as g', 'c.gra_cod', '=', 'g.gra_cod')->join('nivel as n', 'n.niv_cod', '=', 'g.niv_cod')
            ->select('c.cur_cod', 'c.cur_descripcion', 'c.cur_abreviatura', 'n.niv_descripcion','c.gra_cod', 'g.gra_descripcion')->get();
        return response()->json($curso);
    }

    public function store(Request $request)
    {
        try{
            $grados = Grado::where('niv_cod', '=', $request->niv_cod)->get();
            foreach ($grados as $grado) {
                $curso = new Curso();
                $curso->cur_descripcion = $request->cur_descripcion;
                $curso->cur_abreviatura = $request->cur_abreviatura;
                $curso->gra_cod = $grado->gra_cod;
                $curso->save();
            }
        }catch(Throwable $e){
            return "Error - " . $e->getMessage();
        }
    }

    public function GetCursoByGrado($id){
        $curso = DB::table('curso')->where('gra_cod','=',$id)->get();
        return response()->json($curso);
    }
    public function show($id)
    {
        return Curso::findOrFail($id);
    }

    
    public function update(Request $request, $id)
    {
        $curso = Curso::findOrFail($id);
        $curso->Update($request->all());
        return $curso;
    }

    
    public function destroy($id)
    {
        $curso=Curso::findOrFail($id);
        $curso->delete();
        return 204;
    }
}