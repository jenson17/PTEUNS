<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clas;
use App\Evaluacion;
use App\EvaluacionUser;
use App\PreguntasEvaluacion;
use App\RespuestasEvaluacion;
use App\Resultado;
use App\Clases\RespuestasUsers;
use DB;

class EvaluacionesUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            
            $user_id = \Auth::user()->id;

            $evaluaciones_user = EvaluacionUser::where('estado','=',1)->where('user_id','=',$user_id)->get();

            $users = EvaluacionUser::select('evaluacion_id')->where('estado','=',1)->where('user_id','=',$user_id)->get()->toArray();

            $count = count($evaluaciones_user);

            if ($count > 0 ) {
                  
                $evaluaciones = Evaluacion::whereNotIn('id', $users )->get();
                
            }else{

                $evaluaciones = Evaluacion::where('estado','=',1)->get();
            }

            return response()->json($evaluaciones);

       }else{

         return view('student.evaluaciones.index');

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
        $evaluacion = new EvaluacionUser();
        $evaluacion->estado = 1;
        $evaluacion->user_id = \Auth::user()->id;
        $evaluacion->evaluacion_id = $request->evaluacion_id;
        $evaluacion->save();

            $pregunta0 = $request->pregunta0;
            $input0    = $request->res0;
            $radio0   =$request->radio0;
        
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

            $cliente = new RespuestasUsers($evaluacion->id);

            $cliente->insertarRespuestas($pregunta0,$input0,$radio0);
            $cliente->insertarRespuestas($pregunta1,$input1,$radio1);
            $cliente->insertarRespuestas($pregunta2,$input2,$radio2);
            $cliente->insertarRespuestas($pregunta3,$input3,$radio3);
            $cliente->insertarRespuestas($pregunta4,$input4,$radio4);

            $resultado = DB::table('evaluacions_users as eva')->join('preguntas_evaluacion_users as preg','eva.id','=','preg.evaluacions_users_id')->join('respuestas_evaluacion_users as res','preg.id','=','res.preguntas_evaluacion_users_id')->where('eva.id','=',$evaluacion->id)->where('eva.user_id','=',$evaluacion->user_id)->where('res.estado','=',1)->sum('res.puntos');

            $valor = intval($resultado);

            $result = new Resultado();

            if ($resultado >= 12) {
                
                $result->acumulado = $valor;
                $result->estado    = 1;
                $result->user_id   = $evaluacion->user_id;
                $result->evaluacions_users_id = $evaluacion->id;

                $result->save();

                return response()->json([
                    'success' => true,
                    'mensaje' => 'Prueba aprobada con éxito tu calificacion es: '.$resultado
                ]);



            }elseif($resultado >= 4 && $resultado <=8 ){

                $result->acumulado = $valor;
                $result->user_id   = $evaluacion->user_id;
                $result->evaluacions_users_id = $evaluacion->id;

                $result->save();

                return response()->json([
                    'error' => true,
                    'mensaje' => 'Prueba reprobada tu calificacion es: '.$resultado
                ]);

            }else{

                $result->acumulado = 1;
                $result->user_id   = $evaluacion->user_id;
                $result->evaluacions_users_id = $evaluacion->id;

                $result->save();

                return response()->json([
                    'error' => true,
                    'mensaje' => 'Prueba reprobada tu calificacion es: 01'
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
           $preguntas1 = PreguntasEvaluacion::select('id','titulo')->where('evaluacion_id','=',$evaluacion->id)->get()->random(5);

          foreach ($preguntas1 as $pregunta) {
              
              $datos [] = RespuestasEvaluacion::select('id','estado','respuesta','puntos')->where('preguntas_evaluacion_id',$pregunta->id)->get();
          }

          $obtener = RespuestasEvaluacion::select('id')->where('preguntas_evaluacion_id',2)->get();

           return response()->json([
                'success'      => true,
                'titulo'         => $evaluacion->titulo,
                'evaluacion'     => $evaluacion->id,
                'clase_id'   => Clas::select('name', 'id')->where('id','=',$evaluacion->clase_id)->first(),
                'status' => $evaluacion->estado,
                'preguntas' => $preguntas1,
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
