<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MensajeUser;
use App\RespuestasMensajeUser;

class RespuestasMensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            
            $res_mensaje             = new RespuestasMensajeUser();
            $res_mensaje->respuesta    =$request->respuesta;
            $res_mensaje->mensaje_id = $request->mensaje_id;
            $res_mensaje->user_id    = \Auth::user()->id;
            $res_mensaje->save();

            return response()->json([
                'success' => true,
                'mensaje' => 'Mensaje enviado con éxito'
            ]);

        } catch (Exception $e) {
             return response()->json([
                'error' => $e.getMessage()
             ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
