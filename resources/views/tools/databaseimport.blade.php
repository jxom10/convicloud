@extends('layouts.app')


@section('contenido')
	<div class='row justify-content-center p-2'>
		<div class='col-md-4 text-center'>
			<h3>Importacion base de datos</h3>
		</div>
	</div>
	<div class='row justify-content-center p-2'>
		<div class="col-md-6 col-12 text-center">
			<form action="{{ route('import_database') }}" method="POST" enctype="multipart/form-data">@csrf
			<div class="input-group mb-3">
				
				
				<input type="file" class="form-control" id="import_database" name="file" accept=".sql">
				<label class="input-group-text" for="import_database">Upload</label>
			</div>	
		</div>
	</div>
	<div class='row  p-2'>
		<div class="col-6  text-end ">
			<a href="{{route('export_database')}}"><button type="button" class="btn btn-success">Exportar</button>	</a>
		</div>
		<div class='col-6 text-start'>
			<button type="submit" class="btn btn-success">Importar</button>		</form>
		</div>
	</div>

<div class='row justify-content-center p-2'>
	<div class='col-md-12 text-center'>
		<h3>Cuidado</h3>
		<p>Al importar la copia, los datos seran eliminado y reemplazados por los de la copia.</p>
		<p>por seguridad puede <b>exportar</b> primero (por si acaso)</p>
	</div>
</div>
@endsection
