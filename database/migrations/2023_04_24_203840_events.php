<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('idEvento');
            $table->bigInteger('id_ONG')->unsigned();
            $table->string('Nombre',45);
            $table->text('Descripcion',200);
            $table->string('FechaEvento',45);
            $table->integer('numMaxVoluntarios');
            $table->string('Direccion',45);
            $table->decimal('Latitud',8,6);
            $table->decimal('Longitud',8,6);
            $table->decimal('Aportaciones',8,2);
            $table->binary('Foto');
            //Clave foreign
            $table->foreign('id_ONG')->references('idONG')->on('organisations');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('events');
    }
};
