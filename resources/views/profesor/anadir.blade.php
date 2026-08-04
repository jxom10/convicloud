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
			<form method=POST action='/profesores/grabar'>
				@csrf
				<input type=hidden value='{{$profesor->id}}' name='id'>
				<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" class="form-control" id="nombre" name="nombre"  placeholder="nombre" value='{{$profesor->nombre}}'>

			  </div>
			  <div class="form-group">
				<label for="appelido1">Primer Apellido</label>
				<input type="text" class="form-control" id="apellido1"  name="apellido1"  placeholder="primer apellido" value='{{$profesor->apellido1}}'>
			  </div>
			   <div class="form-group">
				<label for="appelido2">Segundo Apellido</label>
				<input type="text" class="form-control" id="apellido2" name="apellido2"   placeholder="segundo apellido(opcional)" value='{{$profesor->apellido2}}'>
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1">Email</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="email" value='{{$profesor->email}}'>
			  </div>
        @if(!$profesor->id)
			  <div class="form-group">
				<label for="exampleInputPassword1">Contraseña</label>
				<input type="password" class="form-control" name="password" placeholder="Al introducir password se creará el usuario">
			  @endif
        </div>
			  <button type="submit" class="btn btn-primary">Grabar</button>
			</form>
		</div>
	</div>

@endsection
