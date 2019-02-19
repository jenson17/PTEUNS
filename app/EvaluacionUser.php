<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluacionUser extends Model
{
    protected $table = "evaluacions_users";

    protected $fillable = ['id','estado','user_id','evaluacion_id'];

    public function evaluacion(){

    	return $this->hasMany('App\Evaluacion');
    }

    public function preguntas_users(){

    	return $this->belongsTo('App\PreguntasEvaluacionUsers');
    }

    public function resultado(){

    	return $this->hasMany('App\Resultado');
    }
}
