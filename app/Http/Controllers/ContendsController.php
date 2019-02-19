<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContendFormRequest;
use App\Contend;

class ContendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            
            $contends = Contend::all();

            return response()->json($contends);

        }else{
             return view('admin.contenidos.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contenidos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContendFormRequest $request)
    {
        try { 

            $contend = new Contend($request->all());
            $contend->save();

            return response()->json([
                'success' => true,
                'mensaje' => 'Contenido creado con éxito'
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
            
            $contend = Contend::findOrFail($id);
             return response()->json([
                'success' => true,
                'id' => $contend->id,
                'name' => $contend->name
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContendFormRequest $request, $id)
    {
       try {

           $contend = Contend::findOrFail($id);
           $contend->name = $request->name;
           $contend->save();

            return response()->json([
                'success' => true,
                'mensaje' => 'Contenido editado correctamente'
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

            $contend = Contend::findOrFail($id);
            $contend->delete();

            return response()->json([
                'success' => true,
                'mensaje' => 'Contenido eliminado'
             ]);

        } catch (Exception $e) {
            
            return response()->json([
                'error' => $e.getMessage()
            ]);
        }
    }
}
