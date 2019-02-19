<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClaseFormRequest;
use App\Clas;
use App\Image;
use App\Contend;
use DB;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            
            $class = Clas::all();

            return response()->json($class);

        }else{
            $contends = Contend::orderBy('name', 'DESC')->get();

            return view('admin.clases.index', compact('contends'));         
        }

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contends = Contend::orderBy('id', 'DESC')->pluck('name', 'id');

        return view('admin.clases.create', compact('contends'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClaseFormRequest $request)
    {   
        try {

            $class = new Clas($request->all());
            $class->save();

            return response()->json([
                'success' => true,
                'mensaje' => 'Clase creada con éxito'
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
           $clas = Clas::FindOrFail($id);

           $id_contend = Contend::select('id')->where('id','=',$clas->contend_id)->first();
           $contend    = Contend::select('id','name')->whereNotIn('id', [$id_contend->id])->get();

            return response()->json([
                'success'      => true,
                'id'           => $clas->id,
                'name'         => $clas->name,
                'contend_id'   => Contend::select('name', 'id')->where('id','=',$clas->contend_id)->first(),
                'descripction' => $clas->descripction,
                'contenidos'   => $contend,
                'fotos'        => Image::select('id','name')->where('clas_id',$clas->id)->get()
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
    public function update(ClaseFormRequest $request, $id)
    {
        try {

           $clas = Clas::FindOrFail($id);
           $clas->name = $request->name;
           $clas->contend_id = $request->contend_id;
           $clas->descripction = $request->descripction;
           $clas->save();

            return response()->json([
                'success' => true,
                'mensaje' => 'Clase editada correctamente'
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
            
            $clas = Clas::findOrFail($id);
            $clas->delete();

            return response()->json([
                'success' => true,
                 'mensaje' => 'Clase eliminada con éxito'
            ]);

        } catch (Exception $e) {
             return response()->json([
                'error' => $e.getMessage()
             ]);
        }
    }
}
