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
        Schema::create('events_users', function (Blueprint $table) {
            $table->bigInteger('idEvento')->unsigned();
            $table->bigInteger('idUser')->unsigned();
            $table->string('registration_date',45);


            $table->foreign('idEvento')->references('idEvento')->on('events');
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
        Schema::dropIfExists('events_users');
    }
};
