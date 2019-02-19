<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestaEvaluacionUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas_evaluacion_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('preguntas_evaluacion_users_id');
            $table->integer('puntos')->default(0);
            $table->integer('estado')->default(0);
            $table->integer('respuestas_evaluacions_id')->unsigned();
            $table->foreign('respuestas_evaluacions_id')->references('id')->on('respuestas_evaluacions')->onDelete('cascade');
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
        Schema::dropIfExists('respuestas_evaluacion_users');
    }
}
