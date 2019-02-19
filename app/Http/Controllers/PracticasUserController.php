<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Practica;
use App\Clas;

class PracticasUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

             $practicas = Practica::where('estado','=',1)->get();

             return response()->json($practicas);

          }else{

             return view('student.practicas.index');
          }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        try {

            $practica  = Practica::findOrFail($id);

             return response()->json([
                'success' => true,
                'practica' => $practica,
                'status'   => $practica->estado,
                'clase_id'   => Clas::select('name', 'id')->where('id','=',$practica->clase_id)->first()
            ]);

        } catch (Exception $e) {

             return response()->json([
                'error' => $e.getMessage()
             ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
