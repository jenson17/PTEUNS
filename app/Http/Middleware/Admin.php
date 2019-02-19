<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
     
    public function __construct(){

        $this->user = \Auth::user();
    }
     
    public function handle($request, Closure $next)
    {

        if ( $this->user->admin() ) {
           
           return $next($request);
           
        }else{

            abort(401);
        }  
    }
}
