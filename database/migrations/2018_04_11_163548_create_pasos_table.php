<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tramite_id')->unsigned();
            $table->foreign('tramite_id')
                  ->references('id')
                  ->on('tramites')
                  ->onDelete('cascade');
            $table->string('titulo');
            $table->string('descripcion');
            $table->string('url')->nullable();
            $table->integer('ubicacion_id')->unsigned()->nullable();
            $table->string('documento')->nullable();
            $table->string('imagen')->nullable();
            $table->integer('posicion')->unsigned();
            $table->softDeletes();
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
        Schema::dropIfExists('pasos');
    }
}
