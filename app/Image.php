<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $table = "images";

    protected $fillable = ['name','clas_id'];

    public function clase(){

    	return $this->hasMany('App\Clas');
    }
}
