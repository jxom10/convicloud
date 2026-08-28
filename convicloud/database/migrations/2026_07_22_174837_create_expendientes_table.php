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
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_apertura');
            $table->unsignedBigInteger('id_alumno');
			$table->unsignedBigInteger('id_profesor');
			
			$table->unsignedBigInteger('id_tipologia');
			$table->mediumText('descripcion');
			$table->date('fecha_solucion')->nullable();
			$table->mediumText('solucion')->nullable();


            $table->timestamps();
            $table->foreign('id_profesor')->references('id')->on('profesores');
            $table->foreign('id_alumno')->references('id')->on('alumnos');
			$table->foreign('id_tipologia')->references('id')->on('tipologias');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expendientes');
    }
};
