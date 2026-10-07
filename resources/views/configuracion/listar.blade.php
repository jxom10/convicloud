@extends('layouts.app')

@section('contenido')


<div class="row m-2 justify-content-center">
	<div class="col-12 text-center">
		<h3>Configuraciones</h3>
	</div>
</div>
<form method="POST" action="">
	@csrf
	@foreach($config as $nombre=>$valor)
	<div class="row m-1 p-1 justify-content-center">
		<div class="col-2 text-end">
			{{$claves[$nombre]}}
		</div>
		<div class="col-3">
			<input class="form-control"
			@if($nombre=='email_pass') type="password" @elseif(substr($nombre,0,5)=='fecha') type="date" @else type="text" @endif
			name="{{$nombre}}" value="{{$valor}}">	
		</div>
	</div>
	@endforeach
	<div class="row m-4 justify-content-center">
		<div class="col-12 text-center">
			<input type="submit" class="btn btn-primary" value="GRABAR">
		</div>
	</div>
	
	</form>

@endsection
