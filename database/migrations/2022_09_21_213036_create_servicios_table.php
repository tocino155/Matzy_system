<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string("nombre")->nullable();
            $table->integer("cp")->nullable();
            $table->string("estado")->nullable();
            $table->string("colonia")->nullable();
            $table->text("domicilio")->nullable();
            $table->string("telefono")->nullable();
            $table->string("correo")->nullable();
            $table->text("observaciones")->nullable();
            $table->string("estatus")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
}
