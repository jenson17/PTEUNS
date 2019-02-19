<?php 

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Contend;
use App\Clas;

class ContenidoComposer
{
    
    public function compose(View $view)
    {

    	$contenidos = Contend::all();
    	$clases = 	Clas::all();

 		$view->with('contenidos', $contenidos)->with('clases', $clases);
    }
}

