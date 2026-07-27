@extends('layouts.app')


@section('contenido')
<div class='row justify-content-center'>
	<div class="col-10">
		<table class="table">
		  <thead>
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Nombre</th>
			  <th scope="col">Apellidos</th>
			  <th scope="col">Email</th>
				<th><a href="{{route('profes_nuevo')}}"><button class="btn btn-success">Nuevo</button></a></th>
			</tr>
		  </thead>
		  <tbody>
		   @foreach($profesores as $profesor)
			<tr>
			  <th scope="row">{{$profesor->id}}</th>
			  <td>{{$profesor->nombre}}</td>
			  <td>{{$profesor->apellido1}} {{$profesor->apelido2}}</td>
			  <td>{{$profesor->email}}</td>
			  <td><a href="{{route('profes_ver',$profesor->id)}}">E</a></td>
			</tr>
			@endforeach
		  </tbody>
		</table>
	</div>
</div>
@endsection
