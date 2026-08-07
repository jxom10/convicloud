@extends('layouts.app')

@section('contenido')
<div class='row justify-content-center'>
	<div class="col-10">
		<table class="table">
		  <thead>
			<th>#</th>
			<th>Fecha</th>
			<th>desccripcion</th>
			<th><a href="{{route('expediente_nuevo')}}"><button class="btn btn-success">Nuevo</button></a></th>
		  </thead>
		  <tbody>
		   @foreach($expedientes as $expediente)
			<tr>
			  <td >{{$expediente->id}}</ts>
			  <td>{{date('Y-m-d', strtotime($expediente->fecha_apertura))}}</td>
			  <td>{{$expediente->descripcion}}</td>

			  <td><a href="{{route('expediente_ver',$expediente->id)}}"><i class="fa fa-eye	 fa-2x" aria-hidden="true"></i></a></td>
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
