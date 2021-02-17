<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = "nivel";
    protected $primaryKey = "niv_cod";
    public $timestamps = false;
    protected $filliable = ['niv_descripcion'];
}
