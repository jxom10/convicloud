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
        Schema::create('partes', function (Blueprint $table) {
            $table->id();
            $table->string('nivel');
            $table->mediumText('descripcion');
			$table->mediumText('acciones');
			$table->date('fecha')->nullable();
			$table->string('hora');
			$table->unsignedBigInteger('id_profesor');
			$table->string('comunicacion');
			$table->datetime('firmado')->nullable(true);
			$table->unsignedBigInteger('id_tipologia');
			$table->unsignedBigInteger('id_alumno');
            $table->timestamps();
            
            $table->foreign('id_alumno')->references('id')->on('alumnos');
            $table->foreign('id_tipologia')->references('id')->on('tipologias');
            $table->foreign('id_profesor')->references('id')->on('profesores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partes');
    }
};
/*
 * 
	Leve/Grave
	Explicación
	Medidas tomadas (si se le ha hecho hacer algo, por ejemplo, pagar una cosa que ha roto)
	Fecha
	Hora (1ª, 2ª....7ª)
	Responsable (el profesor que lo ha puesto)
	Comunicación (llamada/ITACA)
	Firma (y se pone la fecha)
	Tipología (como antes, si es acoso/disruptivo... ya nos los inventaremos)
	Nombre
	NIA
	Curso+grupo
	A/O (chica o chico)
*/
