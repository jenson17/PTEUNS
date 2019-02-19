<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( \Auth::user()->admin() )
        {
            return view('admin.dashboard.index');

        }elseif( \Auth::user()->student() ){

          return view('student.dashboard.index');
        }
    }
}
