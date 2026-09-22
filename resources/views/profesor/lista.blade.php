
@extends('layouts.app')


@section('contenido')
 
<div class="row justify-content-center p-3">
	<div class='col-12'>
		<div class="row p-2">

			<form method="POST" action="{{route('profesores_buscar')}}">@csrf
			<div class="row">
				<div class="col-12 col-md-3">	
					<label for="profesor">Profesor</label>
					<input type="text" id=profesor class="form-control" name="profesores"  placeholder="Buscar por nombre o apellido" value="@if(isset($buscar['profesores'])) {{$buscar['profesores']}}  @endif">
				</div>
				<div class="col-12 col-md-2">	
					<label for="curso"> &nbsp;</label>
					<select name='active'  class="form-control">
						
						<option value="1" @if(isset($buscar['active']) AND $buscar['active']==1) selected @endif>Profesores activos</option>
						<option value="all"  @if(isset($buscar['active']) AND $buscar['active']=='all') selected @endif>Todos los profesores</option>
					</select>
				</div>
				<div class="col-12 col-md-2">	
					<label for="curso">Curso</label>
					<input type="text" class="form-control" id="curso" name="curso" value="@if(isset($buscar['curso'])) {{$buscar['curso']}}  @endif">
				</div>
				<div class="col-10 col-sm-11  col-md-4">	
					<br>
					<label for="btn_buscar">&nbsp;</label>
					<button class="btn btn-primary" id='btn_buscar'>
						<i class='fa fa-search'></i>
					</button>
					<label for="btn_limpiar">&nbsp;&nbsp;&nbsp;</label>
					<button name="clean" id='btn_limpiar' value="clean"  class="btn btn-primary">
						<i class='fa fa-trash'></i>
					</button></form>
					
				</div>
				<div class="col-1 col-sm-1  col-md-1 ">
					<br>
					<button type="button" class="btn btn-primary" onclick="mostrar_filtro()">
						<i class='fa fa-sort-amount-desc'></i></button>
					<div id="filtro"  class="text-end">
						<ul>
							
							<li>
								<a href="{{route('profesores_lista',['orden'=>'nombre','direccion'=>'DESC'])}}"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>Nombre</a>
							</li>
							<li>
								<a href="{{route('profesores_lista',['orden'=>'nombre','direccion'=>'ASC'])}}"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>Nombre</a>
							</li>
							<li>
								<a href="{{route('profesores_lista',['orden'=>'apellido1','direccion'=>'DESC'])}}"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>apellidos</a>
							</li>
							</li>
							<li>
								<a href="{{route('profesores_lista',['orden'=>'apellido1','direccion'=>'ASC'])}}"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>apellidos</a>
							</li>
							
						</ul>
					</div>
				</div>
		
			</div>

		</div>
		<div class="row">

			 <table class="table table-striped">
				<thead class="bg-light">
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>Email</th>
						<th>Curso</th>
						<th>Grupo</th>
						<td align='right'><a href="{{route('profesor_nuevo')}}">
							<button class="btn btn-primary">Nuevo</button></a>
							<a href="/profesores/importar"><button class="btn btn-primary">importar</button></a>
						</td>
					</tr>
				</thead>
				<tbody>
			   @foreach($profesores as $profesor)
					<tr @if($profesor->active == 0) style='font-style:italic;color:#74AFC9;' @endif>
						<td>{{$profesor->id}}</td>
						<td>{{$profesor->nombre}}</td>
						<td>{{$profesor->apellido1}} {{$profesor->apellido2}}</td>
						<td>{{$profesor->email}}</td>
						<td>{{$profesor->curso}}</td>
						<td>{{$profesor->grupo}}</td>
						<td align='right'>
							<a href="{{route('profesor_ver',$profesor->id)}}"><i class="fa fa-eye	 fa-2x" aria-hidden="true"></i></a>

							<a   onclick="return confirm('Va a eliminar {{$profesor->email}}.\nEsta seguro?')"  href="{{route('profesor_eliminar',$profesor->id)}}"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
						</td>
					</tr>
				@endforeach
				</tbody>
				@if($profesores->hasPages())
				<tr>
					<td colspan=6>
						{{ $profesores->links('pagination::bootstrap-4')}}
					</td>
					</tr>
				@endif
			</table>
		</div>
	</div>
</div>
<script>
function mostrar_filtro(){
	var boton =document.getElementById('filtro').style.display;
	if(boton === 'block'){
		document.getElementById('filtro').style.display='none';
	}
	else{
		document.getElementById('filtro').style.display='block';
	}
	
}
</script>

@endsection
