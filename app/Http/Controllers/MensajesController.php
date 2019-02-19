<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MensajeFormRequest;
use App\MensajeUser;
use App\RespuestasMensajeUser;
use App\User;
use DB;

class MensajesController extends Controller
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
    public function store(MensajeFormRequest $request)
    {
        try {
            
            $mensaje = new MensajeUser();
            $mensaje->mensaje=$request->mensaje;
            $mensaje->user_id= \Auth::user()->id;
            $mensaje->save();

            return response()->json([
                'success' => true,
                'mensaje' => 'Mensaje enviado al administrador con éxito'
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
         try {
            
            $mensaje = MensajeUser::findOrFail($id);
            $mensaje->estado= 1;
            $mensaje->save();

             return response()->json([
                'success' => true,
                'id' => $mensaje->id,
                'mensaje' => DB::table('mensajes_users as m')->join('users as user','m.user_id','=','user.id')->where('m.id','=',$mensaje->id)->select('m.mensaje','user.name')->first(),
                'respuestas' => DB::table('respuestas_mensaje_users as r')->select('r.respuesta','m.mensaje','user.name')->join('mensajes_users as m','r.mensaje_id','=','m.id')->join('users as user','r.user_id','=','user.id')->where('m.id','=',$mensaje->id)->orderBy('r.created_at','ASD')->get(),
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
