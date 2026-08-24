@extends('layouts.app')


@section('contenido')
<div class="row p-2">
	<div class="col-sm-1"></div>
	<div class="col-sm-3 col-md-3">
		<a href="{{route('profes_nuevo')}}"><button class="btn btn-success">Nuevo</button></a>
	</div>
	<div class="col-sm-1 col-md-2"></div>
	<div class="col-sm-3 col-md-3">
		<form method="POST" action="{{route('profesores_buscar')}}">@csrf
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
<div class='row justify-content-center'>
	<div class="col-md-10 col-sm-12">
		<table class="table">
		  <thead>
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Nombre</th>
			  <th scope="col">Apellidos</th>
			  <th scope="col">Email</th>
				<th></th>
			</tr>
		  </thead>
		  <tbody>
		   @foreach($profesores as $profesor)
			<tr>
			  <th scope="row">{{$profesor->id}}</th>
			  <td>{{$profesor->nombre}}</td>
			  <td>{{$profesor->apellido1}} {{$profesor->apelido2}}</td>
			  <td>{{$profesor->email}}</td>
			  <td align='right'>
				  <a href="{{route('profe_ver',$profesor->id)}}"><i class="fa fa-eye	 fa-2x" aria-hidden="true"></i></a>
				<a href="{{route('profe_eliminar',$profesor->id)}}"><i class="fa fa-trash	 fa-2x" aria-hidden="true"></i></a>
			  </td>
			</tr>
			@endforeach
		  </tbody>
			@if($profesores->hasPages())
				<tr>
					<td colspan=5>
						{{ $profesores->links('pagination::bootstrap-4') }}
					</td>
				</tr>
			@endif
		</table>
	</div>
</div>
@endsection
