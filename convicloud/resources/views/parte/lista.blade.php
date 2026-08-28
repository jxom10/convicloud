@extends('layouts.app')

@section('contenido')

@if (session()->has('message'))
<div class="alert alert-danger">
	{{ session('message') }}
</div>
@endif	
 
<div class="row justify-content-center p-3">
	<div class='col-11'>
		<div class="row p-2">
			<table border='0'>
				<tr>
					<td>		
						<form method="POST" action="{{route('partes_buscar')}}">@csrf
						<div class="row">

							<div class="col-xs-12 col-md-2">	
								<label for="tipologia">Tipología</label>
								<select  class="form-control" id='tipologia' name='id_tipologia'>
									<option value=''>...</option>
								@foreach($tipologias as $tipologia)
									<option value='{{$tipologia->id}}' @if($tipologia->id == $busqueda['id_tipologia']) selected @endif> {{$tipologia->nombre}}</option>
								@endforeach
								</select>
							</div>
							<div class="col-xs-12 col-md-2">	
								<label for="tipologia">Tipología</label>
								<select  class="form-control" id='tipologia' name='id_tipologia'>
									<option value=''>...</option>
								@foreach($tipologias as $tipologia)
									<option value='{{$tipologia->id}}' @if($tipologia->id == $busqueda['id_tipologia']) selected @endif> {{$tipologia->nombre}}</option>
								@endforeach
								</select>
							</div>
							<div class="col-xs-12 col-md-2">	
								<label for="tipologia">Tipología</label>
								<select  class="form-control" id='tipologia' name='id_tipologia'>
									<option value=''>...</option>
								@foreach($tipologias as $tipologia)
									<option value='{{$tipologia->id}}' @if($tipologia->id == $busqueda['id_tipologia']) selected @endif> {{$tipologia->nombre}}</option>
								@endforeach
								</select>
							</div>
							<div class="col-xs-12 col-md-2">	
								<label for="alumno">alumno</label>
								<input type=hidden  name='id_alumno' id='id_alumno'>
								<input type='text'class='form-control' id='nombre_completo_alumno' onkeyup='buscar_alumno(this.value)'>
								<div id='respuesta_alumno' class='respuesta'></div>
							</div>
							<div class="col-xs-12 col-md-2">	
								<label for="profesor">profesor</label>
								<input type=hidden  name='id_profesor' id='id_profesor'>
								<input type='text'class='form-control' id='nombre_completo_profesor' onkeyup='buscar_profesor(this.value)'>
								<div id='respuesta_profesor' class='respuesta'></div>
							</div>
							<div class="col-xs-12 col-md-2 text-md-end">
								<br>	
								<button class="btn btn-primary"><i class='fa fa-search'></i></button></a>
								<button name='clean' class="btn btn-primary" value='clean'><i class='fa fa-trash'></i></button></a>
								</form>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div class="row">

			 <table class="table table-striped">
				<thead class="bg-light">
					<tr>
						<th>#</th>
						<th>Fecha</th>
						<th>desccripcion</th>
						<td align='right'><a href="{{route('parte_nuevo')}}">
							<button class="btn btn-primary">Nuevo</button></a>
						</td>
					</tr>
				</thead>
				<tbody>
			   @foreach($partes as $parte)
				<tr>
				  <td >{{$parte->id}}</ts>
				  <td>{{date('Y-m-d', strtotime($parte->fecha_apertura))}}</td>
				  <td>{{$parte->descripcion}}</td>

				  <td align='right'>
					  <a href="{{route('expediente_ver',$parte->id)}}"><i class="fa fa-eye	 fa-2x" aria-hidden="true"></i></a>
					<a href="{{route('expediente_eliminar',$parte->id)}}"><i class="fa fa-trash	 fa-2x" aria-hidden="true"></i></a>
					</td>
				</tr>
				@endforeach
				</tbody>
				@if($partes->hasPages())
				<tr>
					<td colspan=6>
						{{ $partes->links('pagination::bootstrap-4')}}
					</td>
					</tr>
				@endif
			</table>
		</div>
	</div>
</div>
@endsection
