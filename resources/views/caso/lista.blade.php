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
				<th><a href="{{route('caso_nuevo')}}"><button class="btn btn-success">Nuevo</button></a></th>
			</tr>
		  </thead>
		  <tbody>
		   @foreach($casos as $caso)
			<tr>
			  <th scope="row">{{$caso->id}}</th>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td><a href="{{route('casos_ver',$caso->id)}}"><i class="fa fa-eye	 fa-2x" aria-hidden="true"></i></a></td>
			</tr>
			@endforeach
		  </tbody>
			<tr>
				<td colspan=5>
					{{ $casos->links('pagination::bootstrap-4')}}
				</td>
			</tr>
		</table>
	</div>
</div>
@endsection
