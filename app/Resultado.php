<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    protected $table = "resultados";

    protected $fillable = ['id','acumulado','estado','user_id','evaluacions_users_id' ];

    public function evaluacion_user(){

    	return $this->hasMany('App\EvaluacionUser');
    }
}
