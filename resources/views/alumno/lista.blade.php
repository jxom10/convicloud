@extends('layouts.app')


@section('contenido')
<div class='row justify-content-center'>
		<div class="row p-2">
		<div class="col-sm-1"></div>
		<div class="col-sm-3 col-md-3">
			<a href="{{route('alumno_nuevo')}}"><button class="btn btn-success">Nuevo</button></a>
			<a href="{{route('import')}}"><button class="btn btn-success">Importar</button></a>
		</div>
		<div class="col-sm-1 col-md-2"></div>
		<div class="col-sm-3 col-md-3">
			<form method="POST" action="{{route('alumnos_buscar')}}">@csrf
			<input type=text class="form-control" name="buscar" value='{{$buscar}}'>
		</div>
		<div class="col-sm-3 col-md-2 text-left">			
			<button class="btn btn-success">
				<i class="fa fa-search" ></i>
			</button>
			
			<button name="clean" value="clean" class="btn btn-success">
				<i class="fa fa-trash" ></i>
			</button>
			
			</form>
		</div>
	</div>
	<div class="col-md-10 col-sm-12">
		<table class="table">
		  <thead>
			<tr>
				<th scope="col">#</th>
					<th scope="col">
<!--
					<a href="{{route('alumnos_lista',['orden'=>'nombre','direccion'=>'DESC'])}}">
					  <i class="fa fa-arrow-up" aria-hidden="true"></i>
					</a>
-->
					Nombre
<!--
					<a href="{{route('alumnos_lista',['orden'=>'nombre','direccion'=>'ASC'])}}">
						<i class="fa fa-arrow-down" aria-hidden="true"></i>
					</a>
-->
				</th>
				<th scope="col">
<!--
					<a href="{{route('alumnos_lista',['orden'=>'apellido1','direccion'=>'DESC'])}}">
					  <i class="fa fa-arrow-up" aria-hidden="true"></i>
					</a>
-->
					Apellido 1
<!--
					<a href="{{route('alumnos_lista',['orden'=>'apellido1','direccion'=>'ASC'])}}">
						<i class="fa fa-arrow-down" aria-hidden="true"></i>
					</a>
-->
				</th>
					<th scope="col">
<!--
					<a href="{{route('alumnos_lista',['orden'=>'apellido2','direccion'=>'DESC'])}}">
					  <i class="fa fa-arrow-up" aria-hidden="true"></i>
					</a>
-->
					Apellido 2
<!--
					<a href="{{route('alumnos_lista',['orden'=>'apellido2','direccion'=>'ASC'])}}">
						<i class="fa fa-arrow-down" aria-hidden="true"></i>
					</a>
-->
				</th>
				<th>

				</th>
			</tr>
		  </thead>
		  <tbody>
		   @foreach($alumnos as $alumno)
			<tr>
			  <th scope="row">{{$alumno->nia}}</th>
			  <td>{{$alumno->nombre}}</td>
			  <td>{{$alumno->apellido1}}</td>
			  <td> {{$alumno->apellido2}}</td>
			  <td align='right'>
					<a href="{{route('alumnos_ver',$alumno->id)}}"><i class="fa fa-eye	 fa-2x" aria-hidden="true"></i></a>
					<a href="{{route('alumno_eliminar',$alumno->id)}}"><i class="fa fa-trash	 fa-2x" aria-hidden="true"></i></a>
			  </td>
			</tr>
			@endforeach
		  </tbody>
		  			<tr>
			<td colspan=5>
				{{ $alumnos->links('pagination::bootstrap-4')}}
			</td></tr>
		</table>
	</div>
</div>
@endsection
