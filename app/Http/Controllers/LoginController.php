<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Throwable;
use  App\Login;
use Illuminate\Http\Request;

class LoginController extends Controller
{
   
    public function index()
    {
        $login = DB::table('usuario as u')-> select('u.per_dni','u.usu_fech_reg','u.usu_contra','u.usu_login','u.usu_rol','u.usu_estado')->get();
        return response()->json($login);
    }
    public function UsuLogin($log, $pass)
    {
        $login = DB::table('usuario as u')-> where('u.usu_login','=',$log)->where('u.usu_contra','=',$pass)->get();
        return response()->json($login);
    }
    public function verifySession($id){
        $login = DB::table('usuario as u')-> where('u.per_dni','=',$id)->get();
        return response()->json($login);
    }
    public function store(Request $request)
    {
        try{
            $usuario = new Login();
            $usuario->per_dni = $request->per_dni;
            $usuario->usu_fech_reg = $request->usu_fech_reg;
            $usuario->usu_contra = $request->per_dni;
            $usuario->usu_login = $request->usu_login;
            $usuario->usu_rol = $request->usu_rol;
            $usuario->usu_estado = $request->usu_estado;
            $usuario->save();
            $result = ['alu_dni' => $usuario->per_dni,
                    'created' => true];
        }catch(Throwable $e){
            return "Error - " . $e->getMessage();
        }
    }

    
    public function show($id)
    {
        return Login::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $usuario = Login::findOrFail($id);
        $usuario->usu_fech_reg = $request->usu_fech_reg;
        $usuario->usu_contra = $request->usu_contra;
        $usuario->usu_login = $request->usu_login;
        $usuario->usu_rol = $request->usu_rol;
        $usuario->usu_estado = $request->usu_estado;
        $usuario->update();
        return $usuario;
    }

    
    public function destroy($id)
    {
        $usuario=Login::findOrFail($id);
        $usuario->delete();
        return 204;
    }
}