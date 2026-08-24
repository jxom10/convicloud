@extends('layouts.app')

@section('contenido')
	<div class="row p-2">
		<div class="col-sm-1"></div>
		<div class="col-sm-3 col-md-3">
			<a href="{{route('expediente_nuevo')}}"><button class="btn btn-success">Nuevo</button></a>
		</div>
		<div class="col-sm-1 col-md-2"></div>
		<div class="col-sm-3 col-md-3">
			<form method="POST" action="{{route('expedientes_buscar')}}">@csrf
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
			<th>Fecha</th>
			<th>desccripcion</th>
			<th></th>
		  </thead>
		  <tbody>
		   @foreach($expedientes as $expediente)
			<tr>
			  <td >{{$expediente->id}}</ts>
			  <td>{{date('Y-m-d', strtotime($expediente->fecha_apertura))}}</td>
			  <td>{{$expediente->descripcion}}</td>

			  <td align='right'>
				  <a href="{{route('expediente_ver',$expediente->id)}}"><i class="fa fa-eye	 fa-2x" aria-hidden="true"></i></a>
				<a href="{{route('expediente_eliminar',$expediente->id)}}"><i class="fa fa-trash	 fa-2x" aria-hidden="true"></i></a>
				</td>
			</tr>
			@endforeach
		  </tbody>
				@if($expedientes->hasPages())
		  		<tr>
					<td colspan=5>
						{{ $expedientes->links('pagination::bootstrap-4')}}
					</td>
				</tr>
				@endif
		</table>
	</div>
</div>
@endsection
