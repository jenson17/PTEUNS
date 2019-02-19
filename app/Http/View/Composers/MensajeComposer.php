<?php 

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\MensajeUser;
use App\RespuestasMensajeUser;
use DB;

class MensajeComposer
{
    
    public function compose(View $view)
    {

    	$user_id = \Auth::user()->id;

 		$mensajes = DB::table('mensajes_users as m')->join('users as user','m.user_id','=','user.id')->select('m.id','m.mensaje','user.name')->get();

 		$mensajes2 = DB::table('mensajes_users as m')->join('users as user','m.user_id','=','user.id')->select('m.id','m.mensaje','user.name')->where('m.user_id','=',$user_id)->get();


 		$view->with('mensajes', $mensajes)->with('count',count($mensajes))->with('mensajes2',$mensajes2);
    }
}




 ?>