@extends('layouts.app')


@section('contenido')
<div class='row justify-content-center'>
	<div class="col-10">
		<table class="table">
		  <thead>
			<tr>
				<th scope="col">#</th>
					<th scope="col">
					<a href="{{route('alumnos_lista',['orden'=>'nombre','direccion'=>'DESC'])}}">
					  <i class="fa fa-arrow-up" aria-hidden="true"></i>
					</a>
					Nombre
					<a href="{{route('alumnos_lista',['orden'=>'nombre','direccion'=>'ASC'])}}">
						<i class="fa fa-arrow-down" aria-hidden="true"></i>
					</a>
				</th>
				<th scope="col">
					<a href="{{route('alumnos_lista',['orden'=>'apellido1','direccion'=>'DESC'])}}">
					  <i class="fa fa-arrow-up" aria-hidden="true"></i>
					</a>
					Apellido 1
					<a href="{{route('alumnos_lista',['orden'=>'apellido1','direccion'=>'ASC'])}}">
						<i class="fa fa-arrow-down" aria-hidden="true"></i>
					</a>
				</th>
					<th scope="col">
					<a href="{{route('alumnos_lista',['orden'=>'apellido2','direccion'=>'DESC'])}}">
					  <i class="fa fa-arrow-up" aria-hidden="true"></i>
					</a>
					Apellido 2
					<a href="{{route('alumnos_lista',['orden'=>'apellido2','direccion'=>'ASC'])}}">
						<i class="fa fa-arrow-down" aria-hidden="true"></i>
					</a>
				</th>
				<th><a href="{{route('alumnos_nuevo')}}"><button class="btn btn-success">Nuevo</button></a></th>
			</tr>
		  </thead>
		  <tbody>
		   @foreach($alumnos as $alumno)
			<tr>
			  <th scope="row">{{$alumno->nia}}</th>
			  <td>{{$alumno->nombre}}</td>
			  <td>{{$alumno->apellido1}}</td>
			  <td> {{$alumno->apellido2}}</td>
			  <td><a href="{{route('alumnos_ver',$alumno->id)}}"><i class="fa fa-eye	 fa-2x" aria-hidden="true"></i></a></td>
			</tr>
			@endforeach
		  </tbody>
		</table>
	</div>
</div>
@endsection
