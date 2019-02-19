<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = "comentarios";

    protected $fillable = ['id','comentario','publicacion_id','user_id'];

    public function publicacion(){

    	return $this->hasMany('App\Publicacion');
    }
}
