<?php

namespace App\Clases;

use App\PreguntasEvaluacion;
use App\RespuestasEvaluacion;

class Respuestas
{
	public function __construct($id){

		$this->id_evaluacion = $id;
	}

	 function insertarRespuestas($pregunta, $respuestas ,$radio){

	 		$crear_pregunta = new PreguntasEvaluacion();
	 		$crear_pregunta->titulo = $pregunta;
	 		$crear_pregunta->evaluacion_id = $this->id_evaluacion;
	 		$crear_pregunta->save();

	         foreach ($respuestas as $key => $value) {
	            
	            $crear_respuesta = new RespuestasEvaluacion();
	            $crear_respuesta->respuesta = $value;

	            if ($key == $radio) { 
	            	$crear_respuesta->puntos = 4;
	            	$crear_respuesta->estado = 1;
	            	$crear_respuesta->preguntas_evaluacion_id= $crear_pregunta->id;
	            }else{
	            	$crear_respuesta->preguntas_evaluacion_id= $crear_pregunta->id;
	            }

	            $crear_respuesta->save();
	        }
	    }
}