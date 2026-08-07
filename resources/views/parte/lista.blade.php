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
				<th><a href="{{route('parte_nuevo')}}"><button class="btn btn-success">Nuevo</button></a></th>
			</tr>
		  </thead>
		  <tbody>
		   @foreach($partes as $parte)
			<tr>
			  <th scope="row">{{$parte->id}}</th>
			</tr>
			@endforeach
		  </tbody>
			<tr>
				<td colspan=5>
					{{ $partes->links('pagination::bootstrap-4')}}
				</td>
			</tr>
		</table>
	</div>
</div>
@endsection
