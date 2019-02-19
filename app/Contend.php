<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contend extends Model

{	
	protected $table = "contends";

    protected $fillable = ['id','name'];

    public function clases(){

    	return $this->belongsTo('App\Clas');
    }
}
