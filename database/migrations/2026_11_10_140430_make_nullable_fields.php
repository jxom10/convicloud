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
        Schema::table('partes', function (Blueprint $table) {
			$table->string('nivel')->nullable()->change();
            $table->mediumText('descripcion')->nullable()->change();
			$table->mediumText('acciones')->nullable()->change();
			$table->unsignedBigInteger('id_profesor')->nullable()->change();
			$table->string('comunicacion')->nullable()->change();
			$table->unsignedBigInteger('id_tipologia')->nullable()->change();
			$table->string('hora')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partes', function (Blueprint $table) {
            //
        });
    }
};
