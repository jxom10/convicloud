@extends('layouts.app')


@section('contenido')
<div class='row justify-content-center'>
	<div class="col-10">
		<table class="table">
		  <thead>
			<th>#</th>
			<th>Nombre</th>

			<th><a href="{{route('triaje_nuevo')}}"><button class="btn btn-success">Nuevo</button></a></th>
		  </thead>
		  <tbody>
		   @foreach($triajes as $triaje)
			<tr>
			  <td >{{$triaje->id}}</ts>
			  <td>{{$triaje->nombre}}</td>


			  <td><a href="{{route('triaje_ver',$triaje->id)}}"><i class="fa fa-eye	 fa-2x" aria-hidden="true"></i></a></td>
			</tr>
			@endforeach
		  </tbody>
		@if($triajes->hasPages())
			<tr>
				<td colspan=5>
		{{ $triajes->links('pagination::bootstrap-4') }}
				</td>
			</tr>
	  @endif



		</table>
	</div>
</div>
@endsection