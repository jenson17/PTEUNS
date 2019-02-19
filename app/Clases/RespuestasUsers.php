<?php

namespace App\Clases;

use App\PreguntasEvaluacionUsers;
use App\RespuestasEvaluacion;
use App\RespuestasEvaluacionUsers;

class RespuestasUsers
{
	public function __construct($id){

		$this->id_evaluacion = $id;
	}

	 function insertarRespuestas($pregunta, $respuestas ,$radio){

	 		$crear_pregunta = new PreguntasEvaluacionUsers();
	 		$crear_pregunta->preguntas_evaluacion_id = $pregunta;
	 		$crear_pregunta->evaluacions_users_id = $this->id_evaluacion;
	 		$crear_pregunta->save();

	        foreach ($respuestas as $key => $value) {
	            
	            $crear_respuesta = new RespuestasEvaluacionUsers();
	            $crear_respuesta->preguntas_evaluacion_users_id = $crear_pregunta->id;

	            $estado = RespuestasEvaluacion::select('estado')->where('id','=',$value)->get();

	            if ($key == $radio) { 

	            	$estado = RespuestasEvaluacion::select('estado')->where('id','=',$value)->first();

	            	if ($estado->estado == 1) {
	            		$crear_respuesta->puntos = 4;
		            	$crear_respuesta->estado = 1;
		            	$crear_respuesta->respuestas_evaluacions_id = $value;
	            	}else{
	            		$crear_respuesta->respuestas_evaluacions_id = $value;
	            		$crear_respuesta->estado = 2;
	            	}
	            	
	            }else{
	            	$crear_respuesta->respuestas_evaluacions_id = $value;
	            }

	            $crear_respuesta->save();
	        }
	    }
}