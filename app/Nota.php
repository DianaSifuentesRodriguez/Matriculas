<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = "nota";
    protected $primaryKey = "no_id";
    public $timestamps = false;
    protected $fillable = ['cur_cod', 'mat_num', 'no_calificacion', 'no_periodo'];
}