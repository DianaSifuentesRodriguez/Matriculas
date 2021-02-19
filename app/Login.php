<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table = "usuario";
    protected $primaryKey = "per_dni";
    public $timestamps = false;
    protected $filliable = ['per_dni','usu_fech_reg','usu_contra','usu_login','usu_rol','usu_estado']; 
}
