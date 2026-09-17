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
						<form method="POST" action="{{route('casos_buscar')}}">@csrf
						<div class="row">
							<div class="col-xs-12 col-md-1">	
								<label for="estado">Estado</label>
								<select  class="form-control" id='estado' name='id_estado'>
									<option value=''>...</option>
								@foreach($estados as $estado)
									<option value='{{$estado->id}}' @if($estado->id == $busqueda['id_estado']) selected @endif > {{$estado->nombre}}</option>
								@endforeach
								</select>
							</div>
							<div class="col-xs-12 col-md-1">	
								<label for="tipologia">Tipología</label>
								<select  class="form-control" id='tipologia' name='id_tipologia'>
									<option value=''>...</option>
								@foreach($tipologias as $tipologia)
									<option value='{{$tipologia->id}}' @if($tipologia->id == $busqueda['id_tipologia']) selected @endif> {{$tipologia->nombre}}</option>
								@endforeach
								</select>
							</div>
							<div class="col-xs-12 col-md-1">	
								<label for="origen">Origen</label>
								<select  class="form-control" id='origen' name='id_origen'>
									<option value=''>...</option>
								@foreach($origenes as $origen)
									<option value='{{$origen->id}}'  @if($origen->id == $busqueda['id_origen']) selected @endif> {{$origen->nombre}}</option>
								@endforeach
								</select>
							</div>
							<div class="col-xs-12 col-md-1">	
								<label for="triaje">Triaje</label>
								<select  class="form-control" id='triaje' name='id_triaje'>
									<option value=''>...</option>
								@foreach($triajes as $triaje)
									<option value='{{$triaje->id}}' @if($triaje->id == $busqueda['id_triaje']) selected @endif> {{$triaje->nombre}}</option>
								@endforeach
								</select>
							</div>
							<div class="col-xs-12 col-md-2">	
								<label for="alumno">alumno</label>
								<input type=hidden  name='id_alumno' id='id_alumno' value="{{ $busqueda['id_alumno']}}">
								<input type='text'class='form-control' id='nombre_completo_alumno' onkeyup='buscar_alumno(this.value)' value='{{$nombre_alu}}'>
								<div id='respuesta_alumno' class='respuesta'></div>
							</div>


							<div class="col-xs-12 col-md-2 text-end"">
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
						<th>Tipologia</th>
						<th>Origen</th>
						<th>Estado</th>
						<th>Triaje</th>
						<td align='right'>
							<a href="{{route('caso_nuevo')}}">
								<button class="btn btn-primary">Nuevo</button>
							</a>
						</td>
					</tr>
				</thead>
				<tbody>
			   @foreach($casos as $caso)
					<tr  style="border-bottom:solid 2px {{$caso->estado->color}};border-left:solid 2px {{$caso->estado->color}};">
						<td >{{$caso->id}}</td>
						<td>{{$caso->tipologia->nombre}}</td>
						<td>{{$caso->origen->nombre}}</td>
						<td>{{$caso->estado->nombre}}</td>
						<td>{{$caso->triaje->nombre}}</td>
						<td align='right'>
							<a href="{{route('caso_ver',$caso->id)}}"><i class="fa fa-eye	 fa-2x" aria-hidden="true"></i></a>
							<a onclick="return confirm('Va a eliminar un registro.\nEsta seguro?')"  href="{{route('caso_eliminar',$caso->id)}}"><i class="fa fa-trash	 fa-2x" aria-hidden="true"></i></a>
						</td>
					</tr>
				@endforeach
				</tbody>
				@if($casos->hasPages())
				<tr>
					<td colspan=6>
						{{ $casos->links('pagination::bootstrap-4')}}
					</td>
					</tr>
				@endif
			</table>
		</div>
	</div>
</div>
@endsection
