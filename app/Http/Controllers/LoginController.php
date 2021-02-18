<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Throwable;
use  App\Login;
use Illuminate\Http\Request;

class LoginController extends Controller
{
   
    public function UsuLogin($log, $pass)
    {
        $login = DB::table('usuario as u')-> where('u.usu_login','=',$log)->where('u.usu_contra','=',$pass)->get();
        return response()->json($login);
    }
}
