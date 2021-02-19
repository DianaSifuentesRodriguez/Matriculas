<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    protected $table = "asignacion";
    protected $primaryKey = "per_dni";
    public $timestamps = false;
    protected $fillable = ['per_dni', 'cur_cod', 'sec_cod'];
}