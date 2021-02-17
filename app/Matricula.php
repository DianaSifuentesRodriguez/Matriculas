<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $table = "matricula";
    protected $primaryKey = "mat_num";
    public $timestamps = false;
    protected $fillable = ['mat_num', 'alu_dni','mat_anio', 'mat_fechar', 'niv_cod', 'gra_cod', 'sec_cod'];
}
