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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('DNI', 45)->unique();

            $table->string('name');
            $table->string('Apellidos', 45);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('Direccion', 45);
            $table->string('ProvinciaLocalidad', 45);
            $table->string('Telefono', 13);
            $table->bigInteger('id_ONG')->unsigned();
            $table->binary('Foto');
            $table->rememberToken();
            $table->timestamps();

            // $table->string('Role', 13);


            //Clave foreign
            $table->foreign('id_ONG')->references('idONG')->on('organisations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
