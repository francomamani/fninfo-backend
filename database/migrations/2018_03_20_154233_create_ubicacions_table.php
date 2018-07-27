<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUbicacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubicaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categoria_ubicacion_id')->unsigned();
            $table->foreign('categoria_ubicacion_id')
                  ->references('id')
                  ->on('categoria_ubicaciones')
                  ->onDelete('cascade');
            $table->string('nombre');
            $table->string('descripcion');
            $table->double('lat');
            $table->double('lng');
            $table->integer('planta')->unsigned();
            $table->string('imagen');
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
        Schema::dropIfExists('ubicaciones');
    }
}
