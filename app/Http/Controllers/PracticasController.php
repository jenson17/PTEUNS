<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Practica;
use App\Clas;

class PracticasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
      if ($request->ajax()) {

         $practicas = Practica::all();

         return response()->json($practicas);

      }else{

         $clases =  Clas::all();

         return view('admin.practicas.index', compact('clases'));
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
        $mensajes = [
            'titulo.required' => 'El campo titulo es requerido',
        ];
       $data = [
            'titulo' => 'required',
            'clase_id' => 'required'
        ];

        if ($request->file('file_upload')) {
            
            $mensajes['file_upload.required'] = 'La imagen es requerida';
            $mensajes['file_upload.max'] = 'El archivo debe pesar :max kilobytes como máximo.';
            $data['file_upload'] =  'required|image|max:1024';
        }

        if ($request->file('video_upload')) {
            
            $mensajes['video_upload.required'] = 'El video es requerido';
            $mensajes['video_upload.max'] = 'El archivo debe pesar :max kilobytes como máximo.';
            $data['video_upload'] =  'required|mimes:mp4,mov,ogg|max:100000';
        }

        $this->validate($request, $data, $mensajes);

        try {

            if ($request->hasFile('file_upload') || $request->hasFile('video_upload')  ) {

                if ($request->hasFile('file_upload')) {

                    $imagen = $request->file('file_upload');
                    $url = '/storage/' . $imagen->store('img/practicas/images', 'public');

                    $image = New Practica();
                    $image->titulo= $request->titulo;
                    $image->type= "image";
                    $image->name= $url;
                    $image->clase_id = $request->clase_id;
                    $image->save();  
                }   

                if ($request->hasFile('video_upload')) {

                    $videos = $request->file('video_upload');
                    $url = '/storage/' . $videos->store('img/practicas/videos', 'public');

                    $video = New Practica();
                    $video->titulo= $request->titulo;
                    $video->type = "video";
                    $video->name= $url;
                    $video->clase_id = $request->clase_id;
                    $video->save();
                }

                return response()->json([
                    'success' => true,
                    'mensaje' => "La imagen o video ha sido guardada con éxito!"
                ]);

            }

            return response()->json([
                'error' => "El campo imagen o video es requerido"
            ]);
            

            return response()->json([
                'success' => true,
                'mensaje' => "La imagen o video ha sido guardada con éxito!"
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
        try {
            $practica = Practica::findOrFail($id);
            $practica->estado= 1;
            $practica->save();

            return response()->json([
                'success' => true,
                 'mensaje' => 'Practica activada con éxito'
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
            $practica = Practica::findOrFail($id);
            $practica->estado= 0;
            $practica->save();

            return response()->json([
                'success' => true,
                 'mensaje' => 'Practica desactivada con éxito'
            ]);
        } catch (Exception $e) {

            return response()->json([
                'error' => $e.getMessage()
             ]);
        }
    }
}
