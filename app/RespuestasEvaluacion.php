<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestasEvaluacion extends Model
{
    protected $table = "respuestas_evaluacions";

    protected $fillable = ['id','respuesta','puntos','estado','preguntas_evaluacion_id'];

    public function pregunta(){

    	return $this->hasMany('App\PreguntasEvaluacion','id');
    }
}
