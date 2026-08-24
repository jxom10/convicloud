@extends('layouts.app')


@section('contenido')
<div class='row justify-content-center'>
	<div class="col-10">
		<table class="table">
		  <thead>
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Alumno</th>
			  <th scope="col">nivel</th>
			  <th scope="col"><Email>Fecha</th>
				<th><a href="{{route('parte_nuevo')}}"><button class="btn btn-success">Nuevo</button></a></th>
			</tr>
		  </thead>
		  <tbody>
		   @foreach($partes as $parte)
			<tr>
                <td >{{$parte->id}}</td>
                <td>{{$parte->alumno->nombre_completo()}}</td>
                <td>{{$parte->nivel}}</td>
                <td>{{$parte->fecha}}</td>
					<td></td>
                    
            
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
