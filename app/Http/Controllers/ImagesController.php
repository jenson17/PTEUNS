<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Clas;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $clas_id)
    {
      $clas_id = intval($clas_id);

      if ($request->ajax()) {

         $images = Image::where("clas_id",$clas_id)->get();

         return response()->json($images);

      }else{

        return view('admin.images.index', compact('clas_id'));

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
    public function store(Request $request, $clas_id)
    {   
        $mensajes = [
            'file_upload.required' => 'La foto es requerida',
            'file_upload.max' => 'El archivo debe pesar :max kilobytes como máximo.',
            'titulo.required' => 'El campo titulo es requerido',
        ];
        $this->validate($request, [
            'file_upload' => 'required|max:1024',
            'titulo' => 'required',
        ], $mensajes);

        try {

            $imagen = $request->file('file_upload');
            if ($imagen) {
                $url = '/storage/' . $imagen->store('img/clases', 'public');

                $image = New Image();
                $image->titulo= $request->titulo;
                $image->name= $url;
                $image->clas_id = $clas_id;
                $image->save();

                return response()->json([
                    'success' => true,
                    'mensaje' => "La imagen ha sido guardada con éxito!"
                ]);
            }else{
                return response()->json([
                    'error' => "El campo imagen es requerido"
                ]);
            }

            return response()->json([
                'success' => true,
                'mensaje' => 'Foto creada con éxito'
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
    public function show($clas_id, $id)
    {
        try {

            $image  = Image::findOrFail($id);

             return response()->json([
                'success' => true,
                'image' => $image,
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
    public function destroy($clas_id, $id)
    {
        $idfoto = Image::FindOrFail($id);
        try {
            $result = $idfoto->delete();
            if ($result == 1) {
                $this->borrarImagenEquipo($idfoto); 
                return response()->json([
                    'success' => 'true',
                    'mensaje' => "Se ha eliminado correctamente la imagen"
                ]);
            } else {
                return response()->json([
                    'error' => "Error al eliminar la imagen"
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => "No es posible eliminar la imagen ya que se encuentra relacionada con otros."
            ]);
        }
    }

    private function borrarImagenEquipo($idfoto){
      $fotoU = $idfoto->name;
      $fotoU = str_replace("storage","public",$fotoU);
      Storage::delete($fotoU);  
    }
}
