<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $table = "evaluacions";

    protected $fillable = ['id','titulo','contend_id'];

    public function clase(){

    	return $this->hasMany('App\Class');
    }

    public function preguntas(){

    	return $this->belongsTo('App\PreguntasEvaluacion');
    }

    public function evaluaciones_users(){

    	return $this->belongsTo('App\EvaluacionUser');
    }
}
