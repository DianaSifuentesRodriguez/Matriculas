<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Curso;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curso = DB::table('curso as c')->join('nivel as n', 'c.niv_cod', '=', 'n.niv_cod')
            ->select('c.cur_cod', 'c.cur_descripcion', 'c.cur_abreviatura', 'c.niv_cod', 'n.niv_descripcion')->get();
        return response()->json($curso);
    }

    public function store(Request $request)
    {
        try{
            $curso = new Curso();
            $curso->cur_descripcion = $request->cur_descripcion;
            $curso->cur_abreviatura = $request->cur_abreviatura;
            $curso->niv_cod = $request->niv_cod;
            $curso->save();
            $result = ['cur_descripcion' => $curso->cur_descripcion,
                        'created' => true];
            return $result;
        }catch(Throwable $e){
            return "Error - " . $e->getMessage();
        }
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
