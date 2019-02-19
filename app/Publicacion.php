<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $table = "publicacions";

    protected $fillable = ['id','publicacion','archivo','user_id'];

    public function comentarios(){

    	return $this->belongsTo('App\Comentario','id');
    }
}
