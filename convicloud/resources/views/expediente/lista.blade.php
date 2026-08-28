@extends('layouts.app')

@section('contenido')

@if (session()->has('message'))
<div class="alert alert-danger">
	{{ session('message') }}
</div>
@endif	
 
<div class="row justify-content-center p-3">
	<div class='col-11'>
		<div class="row p-2">
			<table border='0'>
				<tr>
					<td>		
						<form method="POST" action="{{route('expedientes_buscar')}}">@csrf
						<div class="row">

							<div class="col-xs-12 col-md-2">	
								<label for="tipologia">Tipología</label>
								<select  class="form-control" id='tipologia' name='id_tipologia'>
									<option value=''>...</option>
								@foreach($tipologias as $tipologia)
									<option value='{{$tipologia->id}}' @if($tipologia->id == $busqueda['id_tipologia']) selected @endif> {{$tipologia->nombre}}</option>
								@endforeach
								</select>
							</div>

							<div class="col-xs-12 col-md-4 text-end">
								<br>	
								<button class="btn btn-primary"><i class='fa fa-search'></i></button></a>
								<button name='clean' class="btn btn-primary" value='clean'><i class='fa fa-trash'></i></button></a>
								</form>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div class="row">

			 <table class="table table-striped">
				<thead class="bg-light">
					<tr>
						<th>#</th>
						<th>Fecha</th>
						<th>desccripcion</th>
						<td align='right'><a href="{{route('expediente_nuevo')}}">
							<button class="btn btn-primary">Nuevo</button></a>
						</td>
					</tr>
				</thead>
				<tbody>
			   @foreach($expedientes as $expediente)
				<tr>
				  <td >{{$expediente->id}}</ts>
				  <td>{{date('Y-m-d', strtotime($expediente->fecha_apertura))}}</td>
				  <td>{{$expediente->descripcion}}</td>

				  <td align='right'>
					  <a href="{{route('expediente_ver',$expediente->id)}}"><i class="fa fa-eye	 fa-2x" aria-hidden="true"></i></a>
					<a href="{{route('expediente_eliminar',$expediente->id)}}"><i class="fa fa-trash	 fa-2x" aria-hidden="true"></i></a>
					</td>
				</tr>
				@endforeach
				</tbody>
				@if($expedientes->hasPages())
				<tr>
					<td colspan=6>
						{{ $expedientes->links('pagination::bootstrap-4')}}
					</td>
					</tr>
				@endif
			</table>
		</div>
	</div>
</div>
@endsection
