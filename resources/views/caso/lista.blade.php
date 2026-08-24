@extends('layouts.app')


@section('contenido')
		<div class="row p-2">
		<div class="col-sm-1"></div>
		<div class="col-sm-3 col-md-3">
			<a href="{{route('caso_nuevo')}}"><button class="btn btn-success">Nuevo</button></a>
		</div>
		<div class="col-sm-1 col-md-2"></div>
		<div class="col-xs-3 col-md-3">
			<form method="POST" action="{{route('casos_buscar')}}">@csrf
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
			  <th scope="col">Tipologia</th>
			  <th scope="col">Origen</th>
			  <th scope="col">Email</th>
				<th></th>
			</tr>
		  </thead>
		  <tbody>
		   @foreach($casos as $caso)
			<tr>
			  <th scope="row">{{$caso->id}}</th>
			  <td>{{$caso->tipologia->nombre}}</td>
			  <td>{{$caso->origen->nombre}}</td>
			  <td></td>
			  <td align='right'>
                <a href="{{route('caso_ver',$caso->id)}}"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>
                <a href="{{route('caso_eliminar',$caso->id)}}"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
              </td>
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
