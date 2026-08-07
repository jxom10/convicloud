@extends('layouts.app')


@section('contenido')
	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif
	<div class='row justify-content-center'>
		<div class="col text-center bg-primary text-white">
			<h1>{{$titulo}}</h1>
		</div>
	</div>
	
	<div class='row p-2'>
		
		<div class='col-sm-2'>
			<form method='POST' action='{{route('expediente_grabar')}}'>
			@csrf
			<input type=hidden name='id' value='{{$expediente->id}}'>
 		</div>
		<div class='col-sm-4'>
			<label for='apellidos'>Apellidos</label>
			<input type='hidden'   name='id_alumno' id='id_alumno' value='{{$expediente->id_alumno}}'>
			<input class='form-control'  id='apellidos_alumno' type=text onKeyUp='buscar_alumno(this.value)'   @if($expediente->id)value='{{$expediente->alumno->apellido1 .' ' .$expediente->alumno->apellido2}}'@endif>
			<div id='respuesta_alumno' class='respuesta'></div>
		</div>
		<div class='col-sm-4'>
			<label for='apellido2'>Nombre</label>
			<input class='form-control'  id='nombre_alumno' type=text   @if($expediente->id)value='{{$expediente->alumno->nombre}}'@endif >
		</div>
		<div class='col-sm-2'></div>
	</div>

	<div class='row p-2'>
		<div class='col-sm-2'>
		</div>
		<div class='col-sm-2'>
			<label for='nia'>NIA</label>
			<input class='form-control'  id='nia_alumno' type=text   @if($expediente->id)value='{{$expediente->alumno->nia}}'@endif>
		</div>
		<div class='col-sm-3'>
				<label for='curso'>Curso</label>
				<input class='form-control'  id='curso_alumno' type=text   @if($expediente->id)value='{{$expediente->alumno->curso}}'@endif>
		</div>
		<div class='col-sm-3'>
				<label for='grupo'>Grupo</label>
				<input class='form-control'  id='grupo_alumno' type=text   @if($expediente->id)value='{{$expediente->alumno->grupo}}'@endif>
		</div>
		<div class='col-sm-2'></div>
	</div>
	<div class='row p-2'>
		<div class='col text-center'><h2>Datos del profesor</div>
	</div>
	<div class='row p-2'>
		<div class='col-sm-2'></div>
		<div class='col-sm-4'>
			<label for='apellido1'>Apellidos</label>
			<input class='form-control'  id='apellidos_profesor' type=text   onKeyUp='buscar_profesor(this.value)'   @if($expediente->id)value='{{$expediente->profesor->apellido1 .' '. $expediente->profesor->apellido1}}'@endif>
			<input type='hidden'  name='id_profesor'  id='id_profesor' value='{{$expediente->id_profesor}}' >
			<div id='respuesta_profesor' class='respuesta'></div>
		</div>
		<div class='col-sm-4'>
			<label for='apellido2'>Nombre</label>
			<input class='form-control'  id='nombre_profesor' type=text  @if($expediente->profesor) value='{{$expediente->profesor->nombre}}'@endif>
		</div>
		<div class='col-sm-2'></div>
	</div>
	<div class='row p-2'>
		<div class='col text-center'><h2>Detalle del expediente</div>
	</div>
	<div class='row p-2'>
		<div class='col-sm-2'></div>
		<div class='col-sm-2'>
			<label for='fecha_apertura'>fecha Inicio </label>
			<input name='fecha_apertura' class="form-control"  type=date value='{{date('Y-m-d', strtotime($expediente->fecha_apertura))}}'>
		</div>
		<div class='col-sm-4'>
			<label for='tipologia'>Tipo</label>
			<select  class="form-control" id='id_tipologia' name='id_tipologia'  value='{{$expediente->id_tipologia}}'>
				<option value=''>elegir ... </option>
			@foreach($tipologias as $tipologia)
				<option value='{{$tipologia->id}}' @if($tipologia->id == $expediente->id_tipologia) selected @endif>{{$tipologia->nombre}}</option>
				
			@endforeach
			</select>
		</div>
		<div class='col-sm-2'>
			<label for='fecha_solucion'>fecha Final</label>
			<input name='fecha_solucion' class="form-control" id type=date value='{{date('Y-m-d', strtotime($expediente->fecha_solucion))}}'>
		</div>
	</div>
	<div class='row p-2'>
		<div class='col-sm-2'></div>
		<div class='col-sm-8'>
		<label for='descripcion'>Descripcion</label>
		<textarea id='descripcion' class="form-control textarea" name='descripcion' class='textarea' >{{$expediente->descripcion}}</textarea>
		</div>
		<div class='col-sm-2'></div>
	</div>
	<div class='row p-2'>
		  <div class='col'></div>
	</div>
	<div class='row p-2'>
		<div class='col-sm-2'></div>
		<div class='col-sm-8'>
		<label for='descripcion'>Resolución</label>
		<textarea id='solucion' class="form-control textarea" name='solucion' class='textarea' >{{$expediente->solucion}}</textarea>
		</div>
		<div class='col-sm-2'></div>
	</div>
		<div class='row p-2'>
			<div class='col-sm-2'></div>
			<div class='col-sm-10'>
				<button type="submit" class="btn btn-primary btn-lg">Grabar</button>
				</form>
			</div>
		</div>
	<div class='row p-2'></div>
@endsection
