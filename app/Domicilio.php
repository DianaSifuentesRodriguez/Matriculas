<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    protected $table = "alumno_domicilio";
    protected $primaryKey = "alu_dni";
    public $timestamps = false;
    protected $filliable = ['ald_direccion','ald_telefono','department_id','province_id','district_id'];
}
