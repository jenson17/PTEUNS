<?php

namespace App\Http\Middleware;

use Closure;

class Student
{
    public function __construct(){

        $this->user = \Auth::user();
    }

    public function handle($request, Closure $next)
    {
       if ( $this->user->student() ) {
           
           return $next($request);
           
        }else{

            abort(401);
        }
    }
}
