@extends('layouts.app')


@section('contenido')
<div class="row p-2">
	<div class="col-sm-1"></div>
	<div class="col-sm-3 col-md-3">
		<a href="{{route('tipologia_nuevo')}}"><button class="btn btn-success">Nuevo</button></a>
	</div>
	<div class="col-sm-1 col-md-2"></div>
	<div class="col-sm-3 col-md-3">
		<form method="POST" action="{{route('tipologias_buscar')}}">@csrf
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
			<th>#</th>
			<th>Nombre</th>
			<th></th>
		  </thead>
		  <tbody>
		   @foreach($tipologias as $tipologia)
			<tr>
			  <td >{{$tipologia->id}}</ts>
			  <td>{{$tipologia->nombre}}</td>
			  <td align='right'>
					<a href="{{route('tipologia_ver',$tipologia->id)}}"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>
					<a href="{{route('tipologia_eliminar',$tipologia->id)}}"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
			  </td>
			</tr>
			@endforeach
		  </tbody>
		@if($tipologias->hasPages())
			<tr>
				<td colspan=5>
		{{ $tipologias->links('pagination::bootstrap-4') }}
				</td>
			</tr>
	  @endif



		</table>
	</div>
</div>
@endsection
