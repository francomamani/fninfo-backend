<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenNotificacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagen_notificaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notificacion_id')->unsigned();
            $table->foreign('notificacion_id')
                  ->references('id')
                  ->on('notificaciones')
                  ->onDelete('cascade');
            $table->string('imagen');
            $table->text('descripcion');
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
        Schema::dropIfExists('imagen_notificaciones');
    }
}
