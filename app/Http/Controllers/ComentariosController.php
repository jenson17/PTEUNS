<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publicacion;
use App\Comentario;

class ComentariosController extends Controller
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

            $comentario = new Comentario();
            $comentario->comentario = $request->comentario;
            $comentario->publicacion_id = $request->publicacion_id;
            $comentario->user_id = \Auth::user()->id;
            $comentario->save();

            return response()->json([
                'success' => true,
                'mensaje' => 'Comentario creada con éxito'
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
           
           $comentario = Comentario::findOrFail($id);
        
            return response()->json([
                'success' => true,
                'comentario' => $comentario
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
       try {
           
           $comentario = Comentario::findOrFail($id);
           $comentario->comentario=$request->comentario;
           $comentario->save();
        
            return response()->json([
                'success' => true,
                'mensaje' => 'Comentario editado correctamente'
            ]);

               
        } catch (Exception $e) {
             return response()->json([
                'error' => $e.getMessage()
             ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       try {
           
           $comentario = Comentario::findOrFail($id);
           $comentario->delete();
        
            return response()->json([
                'success' => true,
                'mensaje' => 'Comentario eliminado con exito'
            ]);

               
        } catch (Exception $e) {
             return response()->json([
                'error' => $e.getMessage()
             ]);
        }
    }
}
