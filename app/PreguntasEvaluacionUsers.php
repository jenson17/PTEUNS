<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreguntasEvaluacionUsers extends Model
{
    protected $table = "preguntas_evaluacion_users";

    protected $fillable = ['id','preguntas_evaluacion_id','evaluacions_users_id'];

    public function evaluacion_users(){

    	return $this->hasMany('App\EvaluacionUser');
    }

     public function respuestas_users(){

    	return $this->belongsTo('App\RespuestasEvaluacionUsers','id');
    }
}
