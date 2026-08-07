@extends('layouts.app')


@section('contenido')
	<div class='row justify-content-center'>
		<div class="col text-center bg-primary text-white">
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
        <form method='POST' action='{{route('alumno_grabar')}}'>
          @csrf
          <input type=hidden name='id' value='{{$alumno->id}}'>
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="nombre" value='{{$alumno->nombre}}'>
      </div>
      <div class='col-sm-3'></div>
    </div>
      
    <div class='row p-2'>
      <div class='col-sm-3'></div>
      <div class='col-sm-6'>
        <label for="apellido1">Primer apellido</label>
        <input type="text" class="form-control" id="apellido1" name="apellido1"  placeholder="apellido1" value='{{$alumno->apellido1}}'>
      </div>
      <div class='col-sm-3'></div>
    </div>
    
    <div class='row p-2'>
      <div class='col-sm-3'></div>
      <div class='col-sm-6'>
        <label for="apellido2">Segundo apellido</label>
        <input type="text" class="form-control" id="apellido2" name="apellido2"  placeholder="apellido2" value='{{$alumno->apellido2}}'>
      </div>
      <div class='col-sm-3'></div>
    </div>

    <div class='row p-2'>
      <div class='col-sm-3'></div>
      <div class='col-sm-2'>
        <label for="nia">NIA</label>
        <input type="text" class="form-control" id="apellido2" name="nia"  placeholder="nia" value='{{$alumno->nia}}'>
      </div>
      <div class='col-sm-2'>
        <label for="nia">fecha Nacimiento</label>
        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"   value='{{date('Y-m-d',strtotime($alumno->fecha_nacimiento))}}'>
      </div>
      <div class='col-sm-2'>
        <label for="genero">Genero</label>
        <input type="text" class="form-control" id="text" name="text"   value='{{$alumno->text}}'>
      </div>
      <div class='col-sm-3'></div>
    </div>
      
    <div class='row p-2'>
      <div class='col-sm-3'></div>
      <div class='col-sm-3'>
        <label for="curso">Curso</label>
        <input type="text" class="form-control" id="curso" name="curso"  placeholder="curso" value='{{$alumno->curso}}'>
      </div>
      <div class='col-sm-3'>
        <label for="grupo">Grupo</label>
        <input type="text" class="form-control" id="grupo" name="grupo"   value='{{$alumno->grupo}}'>
      </div>
      <div class='col-sm-3'></div>
    </div>
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
