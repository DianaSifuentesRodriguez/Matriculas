<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = "alumno";
    protected $primaryKey = "alu_dni";
    public $timestamps = false;
    protected $fillable = ['alu_dni', 'alu_codigomod', 'alu_apellidop', 'alu_apellidom', 'alu_nombres', 'alu_sexo', 
                        'alu_fechanac', 'alu_escala', 'alu_pais', 'department_id', 'province_id', 'district_id', 'alu_anioingreso', 'alu_lenguamat', 'alu_estadocivil', 
                        'alu_religion', 'alu_fechabautizo', 'alu_parroquiab', 'alu_colprocedencia'];
}
