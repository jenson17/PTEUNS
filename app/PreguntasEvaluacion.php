<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreguntasEvaluacion extends Model
{
    protected $table = "preguntas_evaluacions";

    protected $fillable = ['id','titulo','evaluacion_id'];

    public function evaluacion(){

    	return $this->hasMany('App\Evaluacion');
    }

     public function respuestas(){

    	return $this->belongsTo('App\RespuestasEvaluacion','id');
    }
}
