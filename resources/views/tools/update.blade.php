@extends('layouts.app')


@section('contenido')
<div class="row justify-content-center">
	<div class="col-4 m-2 p-2">
		<h3>Actualizar programa</h3>
		</div>
</div>
<div class="row justify-content-center">
	<div class="col-2 p-3">
	<form method=POST action="{{route('update')}}">
	@csrf
	<input type=password name='password' placeholder='contraseña' class="form-control" >
	</div>
	<div class="col-2 m-2">
	<input type=submit value='executar'class="btn btn-primary btn-lg ">
	</form>
	</div>
</div>

@endsection
