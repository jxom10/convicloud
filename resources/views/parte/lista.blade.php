@extends('layouts.app')


@section('contenido')
<div class="row p-2">
	<div class="col-sm-1"></div>
	<div class="col-sm-3 col-md-3">
		<a href="{{route('parte_nuevo')}}"><button class="btn btn-success">Nuevo</button></a>
	</div>
	<div class="col-sm-1 col-md-2"></div>
	<div class="col-sm-3 col-md-3">
		<form method="POST" action="{{route('partes_buscar')}}">@csrf
		<input type=text class="form-control" name="buscar" value='{{$buscar}}'>
	</div>
	<div class="col-sm-3 col-md-2 text-left">			
		<button class="btn btn-success">
			<i class="fa fa-search" ></i>
		</button>
		
		<button name="clean" value="clean" class="btn btn-success">
			<i class="fa fa-trash" ></i>
		</button>
		
		</form>
	</div>
</div>
<div class='row justify-content-center'>
	<div class="col-md-10 col-sm-12">
		<table class="table">
		  <thead>
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Alumno</th>
			  <th scope="col">nivel</th>
			  <th scope="col">Fecha</th>
				<th></th>
			</tr>
		  </thead>
		  <tbody>
		   @foreach($partes as $parte)
			<tr>
                <td >{{$parte->id}}</td>
                <td>{{$parte->alumno->nombre_completo()}}</td>
                <td>{{$parte->nivel}}</td>
                <td>{{$parte->fecha}}</td>
				  <td align='right'>
						<a href="{{route('parte_ver',$parte->id)}}"><i class="fa fa-eye	 fa-2x" aria-hidden="true"></i></a>
						<a href="{{route('parte_eliminar',$parte->id)}}"><i class="fa fa-trash	 fa-2x" aria-hidden="true"></i></a>
				  </td>
                    
            
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
