@extends('layouts.app')


@section('contenido')
<div class='row justify-content-center'>
	<div class="col-10">
		<table class="table">
		  <thead>
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Nombre</th>

				<th><a href="{{route('triaje_nuevo')}}"><button class="btn btn-success">Nuevo</button></a></th>
			</tr>
		  </thead>
		  <tbody>
		   @foreach($triajes as $triaje)
			<tr>
                <td >{{$triaje->id}}</td>
                <td>{{$triaje->nombre}}</>
                <td>
                    <a href="{{route('triaje_ver',$triaje->id)}}"><i class="fa fa-eye	 fa-2x" aria-hidden="true"></i></a>
                    <a href="{{route('triaje_eliminar',$triaje->id)}}"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
                </td>
			
			</tr>
			@endforeach
		  </tbody>
			<tr>
				<td colspan=5>
					{{ $triajes->links('pagination::bootstrap-4')}}
				</td>
			</tr>
		</table>
	</div>
</div>
@endsection
