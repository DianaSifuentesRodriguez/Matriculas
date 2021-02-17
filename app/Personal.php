<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table = "personal";
    protected $primaryKey = "per_dni";
    public $timestamps = false;
    protected $fillable = ['per_dni', 'per_apellidos', 'per_nombres', 'per_direccion', 'per_estadocivil', 'per_telefono', 'per_segurosocial', 'per_ingreso','per_estado', 'niv_cod'];
}
