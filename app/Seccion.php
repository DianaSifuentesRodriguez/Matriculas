<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    protected $table = "seccion";
    protected $primaryKey = "sec_cod";
    public $timestamps = false;
    protected $fillable = ['niv_cod', 'gra_cod', 'sec_letra'];
}
