@extends('layouts.app')


@section('contenido')
<div class='row justify-content-center'>
<div class="col-6"><h3>{{$titulo}}</h3>

  @if (session()->has('message'))
		<div class="alert alert-danger">
                {{ session('message') }}
            </div>
  @endif	
</div>
</div>

	<div class='row justify-content-center'>
		 <div class="col-6">
			<form method=POST action='/caso/grabar'>
				@csrf
				<input type=hidden value='{{$caso->id}}' name='id'>
				<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" class="form-control" id="nombre" name="nombre"  placeholder="nombre" value='{{$caso->nombre}}'>

			  </div>
			  <div class="form-group">
				<label for="appelido1">Primer Apellido</label>
				<input type="text" class="form-control" id="apellido1"  name="apellido1"  placeholder="primer apellido" value='{{$caso->apellido1}}'>
			  </div>
			   <div class="form-group">
				<label for="appelido2">Segundo Apellido</label>
				<input type="text" class="form-control" id="apellido2" name="apellido2"   placeholder="segundo apellido(opcional)" value='{{$caso->apellido2}}'>
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1">Email</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="email" value='{{$caso->email}}'>
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1">Contraseña</label>
				<input type="password" class="form-control" id="exampleInputPassword1" name="contrasena" placeholder="Password (dejar vacío para no modificar)">
			  </div>
			  <button type="submit" class="btn btn-primary">Grabar</button>
			</form>
		</div>
	</div>

@endsection
