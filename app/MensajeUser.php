<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MensajeUser extends Model
{
    protected $table = "mensajes_users";

    protected $fillable = ['id','mensaje','user_id'];

    public function respuestas(){

    	return $this->belongsTo('App\RespuestasMensajeUser','id');
    }
}
