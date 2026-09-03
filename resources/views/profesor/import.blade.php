@extends('layouts.app')


@section('contenido')
	<div class='row justify-content-center p-2'>
		<div class='col-md-12 text-center'>
			<h3>Importacion de csv profesores</h3>
		</div>
		<div class="col-md-6 col-12 text-center">
			<form action="{{ route('profesores_import') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="input-group mb-3">
							
							<input type="file" class="form-control" id="import_csv" name="import_csv" accept=".csv">
							<label class="input-group-text" for="import_csv">Upload</label>
						</div>	<div class='col-4'>
							<button type="submit" class="btn btn-success">Import CSV</button>	
						</div></form>
		</div>
	</div>

<br>
<h3>formato del fichero csv:</h3>
<p>Tiene que tener en la cabecera los siguientes campos:</p>
Nombre;Primer apellido;Segundo apellido;Email;Curso;Grupo;







@endsection
