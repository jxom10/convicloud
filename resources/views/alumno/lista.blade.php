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
						<form method="POST" action="{{route('alumnos_buscar')}}">@csrf
						<div class="row">
							<div class="col-12 col-md-3">	

								<input type="text" class="form-control" id="buscar" name="buscar"  placeholder="" value="">
							</div>

							<div class="col-10 col-sm-11  col-md-8">	
								<label for="btn_buscar">&nbsp;&nbsp;&nbsp;</label>
								<button class="btn btn-primary" id='btn_buscar'>
									<i class='fa fa-search'></i>
								</button>
								<label for="btn_limpiar">&nbsp;&nbsp;&nbsp;</label>
								<button name="clean" id='btn_limpiar' value="clean"  class="btn btn-primary">
									<i class='fa fa-trash'></i>
								</button></form>
								
							</div>
							<div class="col-1 col-sm-1  col-md-1 ">
								<button type="button" class="btn btn-primary" onclick="mostrar_filtro()">
									<i class='fa fa-sort-amount-desc'></i></button>
								<div id="filtro"  class="text-end">
									<ul>
										<li>
											<a href="{{route('alumnos_lista',['orden'=>'nia','direccion'=>'DESC'])}}"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>NIA</a>
										</li>
										<li>
											<a href="{{route('alumnos_lista',['orden'=>'nia','direccion'=>'ASC'])}}"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>NIA</a>
										</li>
										<li>
											<a href="{{route('alumnos_lista',['orden'=>'nombre','direccion'=>'DESC'])}}"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>Nombre</a>
										</li>
										<li>
											<a href="{{route('alumnos_lista',['orden'=>'nombre','direccion'=>'ASC'])}}"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>Nombre</a>
										</li>
										<li>
											<a href="{{route('alumnos_lista',['orden'=>'apellido1','direccion'=>'DESC'])}}"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>apellido1</a>
										</li>
										</li>
										<li>
											<a href="{{route('alumnos_lista',['orden'=>'apellido1','direccion'=>'ASC'])}}"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>apellido1</a>
										</li>
										<li>
											<a href="{{route('alumnos_lista',['orden'=>'apellido2','direccion'=>'ASC'])}}"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>apellido2</a>
										</li>
										<li>
											<a href="{{route('alumnos_lista',['orden'=>'apellido2','direccion'=>'DESC'])}}"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>apellido2</a>
										</li>
								
									</ul>
								</div>
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
						<th>Nia</th>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>Curso</th>
						<th>Grupo</th>
						<td align='right'><a href="{{route('alumno_nuevo')}}">
							<button class="btn btn-primary">Nuevo</button></a>
						</td>
					</tr>
				</thead>
				<tbody>
			   @foreach($alumnos as $alumno)
					<tr>
						<td>{{$alumno->nia}}</td>
						<td>{{$alumno->nombre}}</td>
						<td>{{$alumno->apellido1}} {{$alumno->apellido2}}</td>
						<td>{{$alumno->curso}}</td>
						<td>{{$alumno->grupo}}</td>
						<td align='right'>
							<a href="{{route('alumno_ver',$alumno->id)}}"><i class="fa fa-eye	 fa-2x" aria-hidden="true"></i></a>
							<a href="{{route('alumno_eliminar',$alumno->id)}}"><i class="fa fa-trash	 fa-2x" aria-hidden="true"></i></a>
						</td>
					</tr>
				@endforeach
				</tbody>
				@if($alumnos->hasPages())
				<tr>
					<td colspan=6>
						{{ $alumnos->links('pagination::bootstrap-4')}}
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
