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
        Schema::create('actor_casos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_caso');
            $table->unsignedBigInteger('id_alumno');
            $table->string('rol');
            $table->timestamps();
			$table->foreign('id_caso')->references('id')->on('casos');
			$table->foreign('id_alumno')->references('id')->on('alumnos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actor_casos');
    }
};
