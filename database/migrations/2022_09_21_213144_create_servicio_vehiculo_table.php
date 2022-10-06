<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicioVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio_vehiculo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_servicio');
            $table->unsignedBigInteger('id_vehiculo')->nullable();
            $table->string("nombre_vehiculo");
            $table->string("funcion_vehiculo");
            $table->string("matricula_vehiculo");
            $table->date("fecha_inicio");
            $table->date("fecha_fin");
            $table->integer("horas_trabajo");
            $table->integer("mantenimiento_h");
            $table->integer("no_mantenimientos");
            $table->text("observaciones")->nullable();
            $table->foreign("id_servicio")->references("id")->on("servicios")->onDelete("cascade");
            $table->foreign("id_vehiculo")->references("id")->on("vehiculos")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicio_vehiculo');
    }
}
