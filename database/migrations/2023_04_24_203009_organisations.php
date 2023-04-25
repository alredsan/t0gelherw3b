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
        Schema::create('organisations', function (Blueprint $table) {
            $table->bigIncrements('idONG');
            $table->string('Name',45);
            $table->string('DireccionSede',45);
            $table->text('Descripcion',200);
            $table->string('FechaCreacion',45);
            $table->string('IBANmetodoPago',24);
            $table->binary('FotoLogo');
            $table->string('eMail',45);
            $table->string('Telefono',13);

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('organisations');
    }
};
