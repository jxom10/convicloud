@extends('layouts.app')


@section('contenido')
	<div class='row justify-content-center'>
		<div class="col text-center">
			<h1>{{$titulo}}</h1>
		</div>
	</div>
	
  
  @if (session()->has('message'))
		<div class="alert alert-danger">
                {{ session('message') }}
    </div>
  @endif

    <div class='row p-2'>
      <div class='col-sm-3'></div>
      <div class='col-sm-6'>
        <form method='POST' action='{{route('profesor_grabar')}}'>
          @csrf
          <input type=hidden name='id' value='{{$profesor->id}}'>
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="nombre" value='{{$profesor->nombre}}'>
      </div>
      <div class='col-sm-3'></div>
    </div>
      
    <div class='row p-2'>
      <div class='col-sm-3'></div>
      <div class='col-sm-6'>
        <label for="apellido1">Primer apellido</label>
        <input type="text" class="form-control" id="apellido1" name="apellido1"  placeholder="apellido1" value='{{$profesor->apellido1}}'>
      </div>
      <div class='col-sm-3'></div>
    </div>
    
    <div class='row p-2'>
      <div class='col-sm-3'></div>
      <div class='col-sm-6'>
        <label for="apellido2">Segundo apellido</label>
        <input type="text" class="form-control" id="apellido2" name="apellido2"  placeholder="apellido2" value='{{$profesor->apellido2}}'>
      </div>
      <div class='col-sm-3'></div>
    </div>

        @if(!$profesor->id)
    <div class='row p-2'>
        <div class='col-sm-3'></div>
        <div class='col-sm-6'>
          <label for="apellido2">Contraseña</label>
          <input type="password" class="form-control" id="password" name="password"  placeholder="Al introducir password se creará el usuario" >
        </div>
        <div class='col-sm-3'></div>
    </div>

        @endif
		<div class='row p-2'>
        <div class='col-sm-3'></div>
        <div class='col-sm-6'>
          <button type="submit" class="btn btn-primary btn-lg">Grabar</button>
          </form>
        </div>
        <div class='col-sm-3'></div>
    </div>
    <div class='row p-2'></div>

@endsection
