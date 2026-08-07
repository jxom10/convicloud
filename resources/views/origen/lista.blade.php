@extends('layouts.app')


@section('contenido')
<div class='row justify-content-center'>
	<div class="col-10">
		<table class="table">
		  <thead>
			<th>#</th>
			<th>Nombre</th>

			<th><a href="{{route('origen_nuevo')}}"><button class="btn btn-success">Nuevo</button></a></th>
		  </thead>
		  <tbody>
		   @foreach($origenes as $origen)
			<tr>
			  <td >{{$origen->id}}</ts>
			  <td>{{$origen->nombre}}</td>


			  <td><a href="{{route('origen_ver',$origen->id)}}"><i class="fa fa-eye	 fa-2x" aria-hidden="true"></i></a></td>
			</tr>
			@endforeach
		  </tbody>
		@if($origenes->hasPages())
			<tr>
				<td colspan=5>
		{{ $origenes->links('pagination::bootstrap-4') }}
				</td>
			</tr>
	  @endif



		</table>
	</div>
</div>
@endsection