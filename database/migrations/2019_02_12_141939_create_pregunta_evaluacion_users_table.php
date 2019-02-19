<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntaEvaluacionUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas_evaluacion_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('preguntas_evaluacion_id')->unsigned();
            $table->foreign('preguntas_evaluacion_id')->references('id')->on('preguntas_evaluacions')->onDelete('cascade');
            $table->integer('evaluacions_users_id')->unsigned();
            $table->foreign('evaluacions_users_id')->references('id')->on('evaluacions_users')->onDelete('cascade');
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
        Schema::dropIfExists('preguntas_evaluacion_users');
    }
}
