@extends('layouts.app')


@section('contenido')
	<div class='row justify-content-center'>
		<div class="col text-center">
			<h1>{{$titulo}} Profesor</h1>
		</div>
	</div>
	


		<div class='row p-2 justify-content-center'>
			<div class='col-sm-12 col-md-6'>
        <form method='POST' action="{{route('profesor_grabar')}}">
          @csrf
          <input type=hidden name='id' value='{{$profesor->id}}'>
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="nombre" value='{{$profesor->nombre}}'>
      </div>

    </div>
      
		<div class='row p-2 justify-content-center'>

			<div class='col-sm-12 col-md-6'>
        <label for="apellido1">Primer apellido</label>
        <input type="text" class="form-control" id="apellido1" name="apellido1"  placeholder="apellido1" value='{{$profesor->apellido1}}'>
      </div>

    </div>
    
		<div class='row p-2 justify-content-center'>

			<div class='col-sm-12 col-md-6'>
        <label for="apellido2">Segundo apellido</label>
        <input type="text" class="form-control" id="apellido2" name="apellido2"  placeholder="apellido2" value='{{$profesor->apellido2}}'>
      </div>
	<div class='row p-2 justify-content-center'>

	<div class='col-sm-12 col-md-2'>
        <label for="apellido2">Curso</label>
        <input type="text" class="form-control" id="curso" name="curso"  placeholder="curso" value='{{$profesor->curso}}'>
      </div>
	<div class='col-sm-12 col-md-2'>
        <label for="apellido2">Grupo</label>
        <input type="text" class="form-control" id="grupo" name="grupo"  placeholder="grupo" value='{{$profesor->grupo}}'>
      </div>
	<div class="form-check form-switch col-2">
		<br>
		<input name="active" class="form-check-input" type="checkbox" value="1" id="flexSwitchCheckChecked" @if($profesor->active==1) checked  @endif >
		<label class="form-check-label text-start" for="flexSwitchCheckChecked">Activo</label>
	</div>
		<div class='row p-2 justify-content-center'>

			<div class='col-sm-12 col-md-6'>
        <label for="apellido2">Email</label>
        <input type="email" class="form-control" id="email" name="email"  placeholder="email" value='{{$profesor->email}}'>
      </div>

    </div>
        @if(!$profesor->id)
		<div class='row p-2 justify-content-center'>

			<div class='col-sm-12 col-md-6'>
          <label for="apellido2">Contraseña</label>
          <input type="password" class="form-control" id="password" name="password"  placeholder="Al introducir password se creará el usuario" >
        </div>

    </div>

        @endif
		<div class='row p-2 justify-content-center'>

			<div class='col-sm-12 col-md-6'>
          <button type="submit" class="btn btn-primary btn-lg">Grabar</button>
          </form>
        </div>

    </div>


@endsection
