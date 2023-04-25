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
        Schema::create('users_roles', function (Blueprint $table) {
            $table->bigInteger('idUser')->unsigned();
            $table->bigInteger('idRol')->unsigned();

            $table->foreign('idRol')->references('idRol')->on('roles');
            $table->foreign('idUser')->references('id')->on('users');

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('users_roles');
    }
};
