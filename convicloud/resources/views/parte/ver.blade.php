@extends('layouts.app')


@section('contenido')
<div class='row justify-content-center'>
    <div class="col-6">
        <h3>{{$titulo}} Parte</h3>
    </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif
</div>

<div class='row p-2 justify-content-center'>
		<div class="col-sm-12 col-md-6">
			<form method=POST action='{{route('parte_grabar')}}'>
				@csrf
				<input type=hidden value='{{$parte->id}}' name='id'>
				<div class="form-group">
					<label for="fecha">Fecha</label>
					<input type='date' name='fecha' id='fecha' class="form-control">
				</div>
		</div>
		<div class="col-sm-12 col-md-6">
			 <div class="form-group">
				<label for="nivel">Nivel</label>
				<select name='nivel' id='nivel' class="form-control">
					<option value='leve'>Leve</option>
					<option value='grave'>Grave</option>
				</select>
			</div>
		</div>

<div class='row p-2 justify-content-center'>
		<div class="col-sm-12 col-md-6">
			 <div class="form-group">
				<label for="descripcion">Descripcion</label>
				<textarea name='descripcion' id='descripcion' class="form-control"></textarea>
			</div>
		</div>
		<div class="col-sm-12 col-md-6">
			 <div class="form-group">
				<label for="acciones">Medidas Tomadas</label>
				<textarea name='acciones' id='acciones' class="form-control"></textarea>
			</div>
		</div>
</div>
<div class='row p-2 justify-content-center'>
		<div class="col-sm-12 col-md-6">
			 <div class="form-group">
				<label for="Hora">Hora</label>
				<select name='hora' class='form-control'>
				<option></option>
				@for($i = 1; $i < 8; $i++)
					<option value='{{$i}}'>{{$i}}ª Hora</option>
				@endfor
				</select>
			</div>
		</div>
		<div class="col-sm-12 col-md-6">
			 <div class="form-group">
				<label for="profesor">Responsable</label>
				<input type='text' name='profesor' id='nombre_completo_profesor' class="form-control" placeholder='buscar aquí'  onKeyUp='buscar_profesor(this.value)'>
				<input type=hidden name='id_profesor' id='id_profesor'	>
				<div id='respuesta_profesor' class='respuesta'></div>
			</div>
		</div>
</div>
<div class='row p-2 justify-content-center'>
		<div class="col-sm-12 col-md-6">
		 <div class="form-group">
			<label for="comunicacion">Comunicacion</label>
                
			<select name='comunicacion' id='comunicacion' class="form-control">
                <option >...</option>
				<option value='llamada'>Llamada</option>
				<option value='itaca'>Itaca</option>
			</select>
		</div>
	</div>
		<div class="col-sm-12 col-md-6">
		 <div class="form-group">
			<label for="firma">Firma</label>
			<input type='text' name='firma' id='firma' class="form-control">
		</div>
	</div>
</div>
</div>
<div class='row p-2 justify-content-center'>
		<div class="col-sm-12 col-md-6">
		<label for='tipologia'>Tipo</label>
		<select  class="form-control" id='id_tipologia' name='id_tipologia'  value='{{$parte->id_tipologia}}'>
			<option value=''>elegir ... </option>
		@foreach($tipologias as $tipologia)
			<option value='{{$tipologia->id}}' @if($tipologia->id == $parte->id_tipologia) selected @endif>{{$tipologia->nombre}}</option>
			
		@endforeach
		</select>
	</div>
</div>
    <div class='row p-2 justify-content-center'>
		<div class='col text-center'>
			<h2>Datos del alumno</h2>
		</div>
	</div>
    <div class='row p-2 justify-content-center'>
		<div class='col-sm-4'>
			<label for='apellidos'>Apellidos</label>
			<input type='hidden'   name='id_alumno' id='id_alumno' value='{{$parte->id_alumno}}'>
			<input class='form-control'  id='apellidos_alumno' type=text placeholder='buscar alumno aqui' onKeyUp='buscar_alumno(this.value)'   @if($parte->id)value='{{$parte->alumno->apellido1 .' ' .$parte->alumno->apellido2}}'@endif>
			<div id='respuesta_alumno' class='respuesta'></div>
		</div>
		<div class='col-sm-4'>
			<label for='apellido2'>Nombre</label>
			<input class='form-control'  id='nombre_alumno' type=text   @if($parte->id)value='{{$parte->alumno->nombre}}'@endif >
		</div>

		<div class='col-sm-2'>
			<label for='nia'>NIA</label>
			<input class='form-control'  id='nia_alumno' type=text   @if($parte->id)value='{{$parte->alumno->nia}}'@endif>
		</div>
</div>
<div class='row p-2 justify-content-center'>

	<div class='col-sm-3'>
			<label for='curso'>Curso</label>
			<input class='form-control'  id='curso_alumno' type=text   @if($parte->id)value='{{$parte->alumno->curso}}'@endif>
	</div>
	<div class='col-sm-3'>
			<label for='grupo'>Grupo</label>
			<input class='form-control'  id='grupo_alumno' type=text   @if($parte->id)value='{{$parte->alumno->grupo}}'@endif>
	</div>

</div>
    <div class='row p-2 justify-content-center'>
	<div>			
		<button type="submit" class="btn btn-primary">Grabar</button>
			</form>
	</div>

			@endsection

