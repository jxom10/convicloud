@extends('layouts.app')


@section('contenido')
	<div class='row justify-content-center'>
		<div class="col text-center ">
			<h1>{{$titulo}}</h1>
		</div>
	</div>
		
		
	<div class='row p-2'>
      <div class='col-sm-3'></div>
      <div class='col-sm-6'>
        <form method='POST' action='{{route('triaje_grabar')}}'>
          @csrf
			<input type=hidden name='id' value='{{$triaje->id}}'> 
			<label for="nombre">Nombre</label>
			<input type=text  class="form-control"  id='nombre' name='nombre' placeholder='nombre' value='{{$triaje->nombre}}'>
      </div>
      <div class='col-sm-3'>

	  </div>
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