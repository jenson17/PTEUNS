<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestasEvaluacionUsers extends Model
{
    protected $table = "respuestas_evaluacion_users";

    protected $fillable = ['id','preguntas_evaluacion_users_id','puntos','estado','respuestas_evaluacions_id'];

    public function pregunta_users(){

    	return $this->hasMany('App\PreguntasEvaluacionUsers','id');
    }
}
