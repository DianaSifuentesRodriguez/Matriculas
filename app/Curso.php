<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = "curso";
    protected $primaryKey = "cur_cod";
    public $timestamps = false;
    protected $fillable = ['cur_descripcion', 'cur_abreviatura', 'gra_cod'];
}