@extends('layouts.app')


@section('contenido')
<div class='row justify-content-center'>
<div class="col-6"><h3>{{$titulo}}</h3>

  @if (session()->has('message'))
		<div class="alert alert-danger">
                {{ session('message') }}
            </div>
  @endif	
</div>
</div>

	<div class='row justify-content-center'>
		 <div class="col-6">
			<form method=POST action='/alumnos/grabar'>
				@csrf
				<input type=hidden value='{{$alumno->id}}' name='id'>
				<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" class="form-control" id="nombre" name="nombre"  placeholder="nombre" value='{{$alumno->nombre}}'>

			  </div>
			  <div class="form-group">
				<label for="appelido1">Primer Apellido</label>
				<input type="text" class="form-control" id="apellido1"  name="apellido1"  placeholder="primer apellido" value='{{$alumno->apellido1}}'>
			  </div>
			   <div class="form-group">
				<label for="appelido2">Segundo Apellido</label>
				<input type="text" class="form-control" id="apellido2" name="apellido2"   placeholder="segundo apellido(opcional)" value='{{$alumno->apellido2}}'>
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1">Email</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="email" value='{{$alumno->email}}'>
			  </div>

			  <button type="submit" class="btn btn-primary">Grabar</button>
			</form>
			<input type=text onkeyUp="get_profes(this.value);" id="busca_profes">CLICK</button>
			<div id=respuesta></div>
		</div>
	</div>
<script type="text/javascript">
function get_profes(busca){
	var drop="";
	$.ajax({
    type: "GET",
    url: '/profesores/lista/'+busca,
    dataType: "JSON",
    success: function(respu){
		respu.forEach(function (profesor){
			drop += "<p onclick='select_prof("+ profesor.id+")'>"+ profesor.nombre+" "+ profesor.apellido1+" "+ profesor.apellido2+"</p>";
		});
		document.getElementById('respuesta').innerHTML = drop;
    }
});
}

</script>
@endsection
