@extends('layouts.app')


@section('contenido')

	<div class='row justify-content-center'>
		<div class="col text-center">
			<h1>{{$titulo}} Caso</h1>
		</div>
	</div>
    
      @if (session()->has('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
      @endif	
  </div>

	<div class='row p-4 justify-content-center'>
    <div class="col-sm-12 col-md-1">
        <form method=POST action="{{route('caso_grabar')}}">
        @csrf
        <label for="id">Caso</label>
        <input type="text" readonly="" class="form-control" id="id" name="id" value="{{$caso->id}}">
    </div>
      
    <div class="col-sm-12 col-md-2">
        <label for="estado" >Estados</label> {{old('id_estado')}}
        <select name='id_estado' id ='estado' class='form-control'>
            <option value=''>...</option>
        @foreach($estados as $estado)
            <option value='{{$estado->id}}'  
				@if($caso->id_estado == $estado->id) selected @endif
				@if(old('id_estado') == $estado->id) selected @endif
				
				>
				{{$estado->nombre}}
				</option>
        @endforeach          
        </select>
    </div>
    
    <div class="col-sm-12 col-md-2">
        <label for="triaje">Triaje</label>
        <select name='id_triaje' id ='triaje' class='form-control'>
            <option value=''>...</option>
        @foreach($triajes as $triaje)
            <option value='{{$triaje->id}}'  
            @if($caso->id_triaje == $triaje->id) selected @endif
            @if(old('id_triaje') == $triaje->id) selected @endif
            >{{$triaje->nombre}}</option>
        @endforeach          
        </select>
    </div>
    
    <div class="col-sm-12 col-md-2">
        <label for="tipologia">Tipologia</label>
        <select name='id_tipologia' id ='tipologia' class='form-control'>
            <option value=''>...</option>
        @foreach($tipologias as $tipologia)
            <option value='{{$tipologia->id}}' 
            @if($caso->id_tipologia == $tipologia->id) selected @endif
            @if(old('id_tipologia') == $tipologia->id) selected @endif
            >{{$tipologia->nombre}}</option>
        @endforeach          
        </select>
    </div>
    
    <div class="col-sm-12 col-md-2">
        <label for="origen">Origen</label>
        <select name='id_origen' id ='origen' class='form-control'>
            <option value=''>...</option>
        @foreach($origenes as $origen)
            <option value='{{$origen->id}}' 
            @if($caso->id_origen == $origen->id) selected @endif
             @if(old('id_origen') == $origen->id) selected @endif
            >{{$origen->nombre}}</option>
        @endforeach          
        </select>
    </div>
  </div>
	<div class='row p-4 justify-content-center'>
     <div >
        <label for="descripcion">Descripcion</label>
        <textarea name='descripcion' id='descripcion' style="width:100%;height:20vh;">{{$caso->descripcion}}{{old('descripcion')}}</textarea>
    </div>
</div>
<div class='row p-4'  id='implicados'>

	@foreach($caso->lista_implicados as $actor)
	<div class='card col-md-2' id='alu_{{$actor->id_alumno}}'>
		<h5 class="card-title" id='rol_{{$actor->id_alumno}}'>{{$actor->rol}}</h5>
		<div class='btn_eliminar' onclick="eliminar({{$actor->id_alumno}})">X</div>
		<h5 class="card-subtitle mb-2 text-body-secondary">{{$actor->alumno->nombre_completo()}}</h5>
		 <div class="card-body">
			NIA:{{$actor->alumno->nia}}
		</div>
   </div>
	@endforeach
</div>
<div class='row p-4 align-items-end justify-content-center'>
		<div class='col-sm-12 col-md-3'>
      <input type=hidden id='id_alumno'>
			<label for='apellidos'>Apellidos</label>
			<input class='form-control'  id='apellidos_alumno' type=text placeholder='buscar alumno aqui' onKeyUp='buscar_alumno(this.value)'   >
			<div id='respuesta_alumno' class='respuesta'></div>
		</div>
		<div class='col-sm-12 col-md-3'>
			<label for='apellido2'>Nombre</label>
			<input class='form-control'  id='nombre_alumno' type=text >
		</div>

		<div class='col-sm-12 col-md-2'>
			<label for='nia'>NIA</label>
			<input class='form-control'  id='nia_alumno' type=text >
		</div>
		<div class='col-sm-12 col-md-2'>
			<label for='papel'>Papel</label>
			<select class='form-control'  id='papel' onchange='active_btn()'>
                <option value=''>...</option>
                <option value='parte'> Parte </option>
                <option value='testigo'> Testigo </option>
                <option value='afectado'> Afectado </option>
            </select>
           
		</div>
	<div class='col-sm-12 col-md-2'>
			<button id='btn_add' type='button' disabled class='btn btn-primary btn-lg' onclick='add()' >Añadir</button>
		</div>
</div>
<div class='row p-2 justify-content-center'>
    <div class="col-4" >
		<input type='hidden' id='lista_implicados' value='{{$caso->implicados}}' name='implicados'>
        <button type="submit" class="btn btn-primary btn-lg" style='width:100%'>Grabar</button>
        </form>
    </div>
</div>
    
<script>
    function active_btn(){
         document.getElementById('btn_add').disabled = false
    }
    function eliminar(id){

		var ids_ori = document.getElementById('lista_implicados').value ;
		var rol = document.getElementById('rol_'+id).innerHTML ;
		var salida = ids_ori.replace(id+":"+rol+ ";","");
		document.getElementById('lista_implicados').value = salida;
		document.getElementById('alu_'+id).remove();
		var id_caso = document.getElementById('id').value ;
		$.ajax({
			type: "DELETE",
			url: '/actorcaso/delete',
			data : {'id_alumno' : id ,'id_caso':id_caso,	'_token': '{{ csrf_token() }}'  },
			dataType: "JSON",
			success: function(respuesta){
				
				console.log(respuesta);
				//respuesta.forEach(function (alumno){
					//drop += "<div  onclick='select_alumno("+ alumno.id+")'>"+ alumno.nombre+" "+ alumno.apellido1+" "+ alumno.apellido2+"</div>";
				//});
				//document.getElementById('respuesta_alumno').innerHTML = drop;
			}
		});
		
	}
    function add(){
		
		var ids_ori = document.getElementById('lista_implicados').value;
		var id = document.getElementById('id_alumno').value;
        var nia = document.getElementById('nia_alumno').value;
        var nombre = document.getElementById('nombre_alumno').value;
        var apellidos = document.getElementById('apellidos_alumno').value;
        
        var e = document.getElementById("papel");
        var value = e.value;
        var rol = e.options[e.selectedIndex].text;
        var implicados = document.getElementById('implicados').innerHTML.trim();
                
		html = "<div class='card col-md-2' id='alu_" + id + "'>";
		html +="<h5 class='card-title' id='rol_" +id + "'>"+ rol +"</h5>";
		html +="<div class='btn_eliminar' onclick='eliminar("+id+")'>X</div>";
		html +="<h5 class='card-subtitle mb-2 text-body-secondary'>" + nombre + " " + apellidos+ "</h5>";
		html +=" <div class='card-body'>";
		html +="	NIA:"+ nia ;
		html +="</div>";
		html +="</div>";
        //document.getElementById('implicados').innerHTML = implicados + '\n'+rol+"(NIA:"+nia + ") " + nombre + " " + apellidos+ '\n';
        document.getElementById('implicados').innerHTML = implicados + html;
        document.getElementById('lista_implicados').value = ids_ori +id+":"+rol+ ";";
        document.getElementById('nia_alumno').value ="";
        document.getElementById('nombre_alumno').value="";
        document.getElementById('apellidos_alumno').value="";
        document.getElementById('implicados').focus();
        document.getElementById('btn_add').disabled = true;
        e.options.selectedIndex=null 

         
    }

</script>
@endsection
