<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Personal;


class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $personal = DB::table('personal as p')->join('nivel as n', 'n.niv_cod', '=', 'p.niv_cod')->where('p.per_estado', '=', '1')
                ->select('p.per_dni', 'p.per_apellidos', 'p.per_nombres', 'p.per_direccion', 
                'p.per_estadocivil', 'p.per_telefono', 'p.per_segurosocial', 'p.per_ingreso', 'p.niv_cod', 'n.niv_descripcion')->get(); 
       return response()->json($personal);
    }

    public function store(Request $request)
    {
        try{
            $personal = new Personal();
            $personal->per_dni=$request->per_dni;
            $personal->per_apellidos=$request->per_apellidos;
            $personal->per_nombres=$request->per_nombres;
            $personal->per_direccion=$request->per_direccion;
            $personal->per_estadocivil=$request->per_estadocivil;
            $personal->per_telefono=$request->per_telefono;
            $personal->per_segurosocial=$request->per_segurosocial;
            $personal->per_ingreso=$request->per_ingreso;
            $personal->per_estado='1';
            $personal->niv_cod=$request->niv_cod;
            $personal->save();
            $result = ['per_dni' => $personal->per_dni,
                    'created' => true];
            return $result;
        }catch(Throwable $e){
            return "Error - " . $e->getMessage();
        }
    }

    public function show($id)
    {
        return Personal::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $personal = Personal::findOrFail($id);
        $personal->Update($request->all());
        return $personal;
    }

    public function destroy($id)
    {
        $personal=Personal::findOrFail($id);
        $personal->delete();
        return 204;
    }
}
