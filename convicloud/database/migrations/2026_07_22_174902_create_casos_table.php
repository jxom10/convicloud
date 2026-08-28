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
        Schema::create('casos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_estado');
            $table->unsignedBigInteger('id_triaje');
            $table->unsignedBigInteger('id_tipologia');
            $table->unsignedBigInteger('id_origen');
            $table->mediumText('descripcion');
            $table->mediumText('implicados');
            $table->timestamps();
			$table->foreign('id_estado')->references('id')->on('estados');
			$table->foreign('id_triaje')->references('id')->on('triajes');
            $table->foreign('id_tipologia')->references('id')->on('tipologias');
            $table->foreign('id_origen')->references('id')->on('origenes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casos');
    }
};
