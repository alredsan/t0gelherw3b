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
        Schema::create('events_types', function (Blueprint $table) {
            $table->bigInteger('idEvento')->unsigned();
            $table->bigInteger('idType')->unsigned();

            $table->foreign('idEvento')->references('idEvento')->on('events');
            $table->foreign('idType')->references('idtypeONG')->on('types');

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('events_types');
    }
};
