@extends('layouts.app')


@section('contenido')
<div class='row justify-content-center'>
	<div class="col-10">
		<table class="table">
		  <thead>
			<th>#</th>
			<th>Nombre</th>

			<th><a href="{{route('tipologia_nuevo')}}"><button class="btn btn-success">Nuevo</button></a></th>
		  </thead>
		  <tbody>
		   @foreach($tipologias as $tipologia)
			<tr>
			  <td >{{$tipologia->id}}</ts>
			  <td>{{$tipologia->nombre}}</td>


			  <td><a href="{{route('tipologia_ver',$tipologia->id)}}"><i class="fa fa-eye	 fa-2x" aria-hidden="true"></i></a></td>
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