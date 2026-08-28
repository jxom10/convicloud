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
			<form method=POST action='{{route('usuario_grabar')}}'>
				@csrf
				<input type=hidden value='{{$usuario->id}}' name='id'>
				<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" class="form-control" id="nombre" name="nombre"  placeholder="nombre" value='{{$usuario->nombre}}'>

			  </div>
			  <div class="form-group">
          <label for="exampleInputPassword1">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="email" value='{{$usuario->email}}'>
        </div>
			  <div class="form-group">
				<label for="exampleInputPassword1">Contraseña</label>
				<input type="password" class="form-control" name="password"
          @if($titulo=='Crear nuevo usuario')
            placeholder="Password" required 
          @else
            placeholder="Password (dejar vacío para no modificar)"
          @endif>
			  </div>
			  <button type="submit" class="btn btn-primary">Grabar</button>
			</form>
		</div>
	</div>

@endsection
