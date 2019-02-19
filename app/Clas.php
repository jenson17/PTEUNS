<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clas extends Model
{
	protected $table = "class";

    protected $fillable = ['id','name','descripction','contend_id'];

    public function contenido(){

    	return $this->hasMany('App\Contend');
    }

     public function evaluaciones(){

    	return $this->belongsTo('App\Evaluacion');
    }

    public function images(){

    	return $this->belongsTo('App\Image');
    }

    public function practicas(){

        return $this->belongsTo('App\Practica');
    }
}
