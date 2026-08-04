@extends('layouts.app')


@section('contenido')
<div class='row justify-content-center'>
	<div class="col-10">
		<table class="table">
		  <thead>
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Nombre</th>
			  <th scope="col">Email</th>
				<th><a href="{{route('usuario_nuevo')}}"><button class="btn btn-success">Nuevo</button></a></th>
			</tr>
		  </thead>
		  <tbody>
		   @foreach($usuarios as $usuario)
			<tr>
			  <th scope="row">{{$usuario->id}}</th>
			  <td>{{$usuario->nombre}}</td>
			  <td>{{$usuario->email}}</td>
			  <td>
					<a href="{{route('usuario_ver',$usuario->id)}}"><i class="fa fa-eye	 fa-2x" aria-hidden="true"></i></a>
					<a href="{{route('usuario_delete',$usuario->id)}}"><i class="fa fa-trash	 fa-2x" aria-hidden="true"></i></a></td>
			</tr>
			@endforeach
		  </tbody>
			<tr>
				<td colspan=5>
					{{ $usuarios->links('pagination::bootstrap-4')}}
				</td>
			</tr>
		</table>
	</div>
</div>
@endsection
