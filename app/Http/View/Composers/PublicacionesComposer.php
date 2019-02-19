<?php 

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Publicacion;
use App\Comentario;
use DB;

class PublicacionesComposer
{
	
    public function compose(View $view)
    {

 		$publis = DB::table('publicacions as p')->join('users as user','p.user_id','=','user.id')->select('p.id','p.publicacion','p.archivo','p.created_at','p.user_id','user.name')->get();

 		$comen = DB::table('comentarios as c')->join('users as user','c.user_id','=','user.id')->select('c.id','c.comentario','c.created_at','c.user_id','c.publicacion_id','user.name')->get();

 		$view->with('publis',$publis)->with('comen',$comen);
    }
}