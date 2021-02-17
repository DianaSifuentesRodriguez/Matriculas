<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    protected $table = "grado";
    protected $primaryKey = "gra_cod";
    public $timestamps = false;
    protected $fillable = ['niv_cod', 'gra_descripcion'];
}
