@extends('layouts.app')


@section('contenido')
<div class='row justify-content-center'>
	<div class="col-10">
		<table class="table">
		  <thead>
			<th>#</th>
			<th>Nombre</th>
			<th>color</th>
			<th><a href="{{route('estado_nuevo')}}"><button class="btn btn-success">Nuevo</button></a></th>
		  </thead>
		  <tbody>
		   @foreach($estados as $estado)
			<tr>
			  <td >{{$estado->id}}</ts>
			  <td>{{$estado->nombre}}</td>
			  <td><div style="background-color:{{$estado->color}};height:25px;width:100px;"></div></td>

			  <td><a href="{{route('estado_ver',$estado->id)}}"><i class="fa fa-eye	 fa-2x" aria-hidden="true"></i></a></td>
			</tr>
			@endforeach
		  </tbody>
			@if($estados->hasPages())
				<tr>
					<td colspan=5>
						{{ $estados->links('pagination::bootstrap-4') }}
					</td>
				</tr>
			@endif
		</table>
	</div>
</div>
@endsection