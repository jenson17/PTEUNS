<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Practica extends Model
{
    protected $table = "practicas";

    protected $fillable = ['id','titulo','name','estado','clase_id'];

    public function clase(){

    	return $this->hasMany('App\Clas');
    }
}
