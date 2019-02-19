<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasEvaluacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas_evaluacions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('respuesta');
            $table->integer('puntos')->default(0);
            $table->integer('estado')->default(0);
            $table->integer('preguntas_evaluacion_id')->unsigned();
            $table->foreign('preguntas_evaluacion_id')->references('id')->on('preguntas_evaluacions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::dropIfExists('respuestas_evaluacions');
    }
}
