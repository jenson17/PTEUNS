<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestasMensajeUser extends Model
{
    protected $table = "respuestas_mensaje_users";

    protected $fillable = ['id','respuesta','mensaje_id','user_id'];

    public function mensaje(){

    	return $this->hasMany('App\MensajeUser');
    }
}
