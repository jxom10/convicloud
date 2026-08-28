@extends('layouts.app')


@section('contenido')

<div class="row justify-content-center p-3">
	<div class='col-11'>
		<div class="row p-2">
			<table border='0'>
				<tr>
					<td>		
						<form method="POST" action="{{route('tipologias_buscar')}}">@csrf
						<div class="row">
							<div class="col-12 col-md-5">	

								<input type="text" class="form-control" id="buscar" name="buscar"  placeholder="" value="">
							</div>

							<div class="col-10 col-sm-11  col-md-7 text-end">	
								<label for="btn_buscar">&nbsp;&nbsp;&nbsp;</label>
								<button class="btn btn-primary" id='btn_buscar'>
									<i class='fa fa-search'></i>
								</button>
								<label for="btn_limpiar">&nbsp;&nbsp;&nbsp;</label>
								<button name="clean" id='btn_limpiar' value="clean"  class="btn btn-primary">
									<i class='fa fa-trash'></i>
								</button></form>

							</div>
					
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div class="row">				
			<table class="table table-striped">
				<thead class="bg-light">
					<th>#</th>
					<th>Nombre</th>
					<th>color</th>
					<td align='right'><a href="{{route('tipologia_nuevo')}}">
							<button class="btn btn-primary">Nuevo</button></a>
						</td>
				  </thead>
				  <tbody>
				   @foreach($tipologias as $tipologia)
					<tr>
					  <td >{{$tipologia->id}}</td>
					  <td>{{$tipologia->nombre}}</td>
					  <td>
						  <div ></div>
					  </td>
					  <td align='right'>
						  <a href="{{route('tipologia_ver',$tipologia->id)}}"><i class="fa fa-eye	 fa-2x" aria-hidden="true"></i></a>
							<a href="{{route('tipologia_eliminar',$tipologia->id)}}"><i class="fa fa-trash	 fa-2x" aria-hidden="true"></i></a>
						  
					  </td>
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
	</div>
</div>

@endsection
