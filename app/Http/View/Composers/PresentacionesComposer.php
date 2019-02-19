<?php 

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Evaluacion;
use App\EvaluacionUser;
use App\Practica;
use DB;

class PresentacionesComposer
{
    
    public function compose(View $view)
    {
    	$user_id = \Auth::user()->id;

    	$evaluaciones = Evaluacion::select('id')->where('estado','=',1)->get();

    	$evaluaciones_user = EvaluacionUser::where('estado','=',1)->where('user_id','=',$user_id)->get();

    	$count1 = count($evaluaciones);
        $count3 = count($evaluaciones_user);

        $total = $count1 - $count3;

    	$practicas = Practica::select('id')->where('estado','=',1)->get();
    
 		$view->with('count1', $total )->with('count2',count($practicas));
    }
}