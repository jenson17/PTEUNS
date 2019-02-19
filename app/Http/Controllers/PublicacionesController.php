<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PublicacionFormRequest;
use App\Publicacion;
use App\Comentario;

class PublicacionesController extends Controller
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
    public function store(PublicacionFormRequest $request)
    {
        try {
            $publi = new Publicacion();
            $publi->publicacion= $request->publicacion;

            if ($request->hasFile('foto_video')) {

                $archivo = $request->file('foto_video');
                $url = '/storage/' . $archivo->store('img/publicaciones', 'public');
                $publi->archivo= $url;
            }else{
            	$publi->archivo= "";
            }

            $publi->user_id= \Auth::user()->id;
            $publi->save();

            return response()->json([
                'success' => true,
                'mensaje' => 'Publicacion creada con éxito'
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

        	$publi = Publicacion::findOrFail($id);

        	 return response()->json([
				'success' => true,
				'publi'   => $publi
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

        	$publi = Publicacion::findOrFail($id);
        	$publi->publicacion = $request->publicacion;
        	$publi->save();

        	return response()->json([
				'success' => true,
				'mensaje'   => 'Publicación editada con exito'
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
        	
        	$publi = Publicacion::findOrFail($id);
        	$publi->delete();

        	return response()->json([
				'success' => true,
				'mensaje'   => 'Publicación eliminada con exito'
            ]);

        } catch (Exception $e) {
        	
        	 return response()->json([
                'error' => $e.getMessage()
             ]);
        }
    }
}