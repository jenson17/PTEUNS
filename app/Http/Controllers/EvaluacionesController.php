<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EvaluacionFormRequest;
use App\Clas;
use App\Evaluacion;
use App\PreguntasEvaluacion;
use App\RespuestasEvaluacion;
use App\Clases\Respuestas;

class EvaluacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

       if ($request->ajax()) {
        
            $evaluaciones = Evaluacion::all();

            return response()->json($evaluaciones);

       }else{
         $clases = Clas::orderBy('name', 'ASD')->get();

         return view('admin.evaluaciones.index', compact('clases'));
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
    public function store(EvaluacionFormRequest $request)
    {
        
        try {

            $evaluacion = new Evaluacion();

            $evaluacion->titulo     = $request->titulo;
            $evaluacion->clase_id = $request->clase_id;

            $evaluacion->save();

            $pregunta1 = $request->pregunta1;
            $input1    = $request->res1;
            $radio1    =$request->radio1;
        
            $pregunta2 = $request->pregunta2;
            $input2    = $request->res2;
            $radio2    =$request->radio2;
        
            $pregunta3 = $request->pregunta3;
            $input3    = $request->res3;
            $radio3    =$request->radio3;
        
            $pregunta4 = $request->pregunta4;
            $input4    = $request->res4;
            $radio4    =$request->radio4;
        
            $pregunta5 = $request->pregunta5;
            $input5    = $request->res5;
            $radio5    =$request->radio5;

            $pregunta6 = $request->pregunta6;
            $input6    = $request->res6;
            $radio6    =$request->radio6;
        
            $pregunta7 = $request->pregunta7;
            $input7    = $request->res7;
            $radio7    =$request->radio7;
        
            $pregunta8 = $request->pregunta8;
            $input8    = $request->res8;
            $radio8    =$request->radio8;
        
            $pregunta9 = $request->pregunta9;
            $input9    = $request->res9;
            $radio9    =$request->radio9;

            $cliente = new Respuestas($evaluacion->id);

            $cliente->insertarRespuestas($pregunta1,$input1,$radio1);
            $cliente->insertarRespuestas($pregunta2,$input2,$radio2);
            $cliente->insertarRespuestas($pregunta3,$input3,$radio3);
            $cliente->insertarRespuestas($pregunta4,$input4,$radio4);
            $cliente->insertarRespuestas($pregunta5,$input5,$radio5);
            $cliente->insertarRespuestas($pregunta6,$input6,$radio6);
            $cliente->insertarRespuestas($pregunta7,$input7,$radio7);
            $cliente->insertarRespuestas($pregunta8,$input8,$radio8);
            $cliente->insertarRespuestas($pregunta9,$input9,$radio9);

            return response()->json([
                'success' => true,
                 'mensaje' => 'Evaluacion creada con éxito'
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

           $evaluacion = Evaluacion::findOrFail($id);
           $preguntas1 = PreguntasEvaluacion::select('id')->where('evaluacion_id','=',$evaluacion->id)->get();

          foreach ($preguntas1 as $pregunta) {
              
              $datos [] = RespuestasEvaluacion::select('id','estado','respuesta','puntos')->where('preguntas_evaluacion_id',$pregunta->id)->get();
          }

          $obtener = RespuestasEvaluacion::select('id')->where('preguntas_evaluacion_id',2)->get();

           return response()->json([
                'success'      => true,
                'titulo'         => $evaluacion->titulo,
                'clase_id'   => Clas::select('name', 'id')->where('id','=',$evaluacion->clase_id)->first(),
                'status' => $evaluacion->estado,
                'preguntas' => PreguntasEvaluacion::select('titulo', 'id')->where('evaluacion_id','=',$evaluacion->id)->get(),
                'id' => $datos,
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
            $evaluacion = Evaluacion::findOrFail($id);
            $evaluacion->estado= 1;
            $evaluacion->save();

            return response()->json([
                'success' => true,
                 'mensaje' => 'Evaluacion activada con éxito'
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
            $evaluacion = Evaluacion::findOrFail($id);
            $evaluacion->estado= 0;
            $evaluacion->save();

            return response()->json([
                'success' => true,
                 'mensaje' => 'Evaluacion desactivada con éxito'
            ]);
        } catch (Exception $e) {

            return response()->json([
                'error' => $e.getMessage()
             ]);
        }
    }
}
