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
        <label for="estado" >Estados</label> 
        <select name='estado_id' id ='estado' class='form-control'>
            <option>...</option>
        @foreach($estados as $estado)
            <option value='{{$estado->id}}'  @if($caso->id_estado == $estado->id) selected @endif>{{$estado->nombre}}</option>
        @endforeach          
        </select>
    </div>
    
    <div class="col-sm-12 col-md-2">
        <label for="triaje">Triaje</label>
        <select name='triaje_id' id ='triaje' class='form-control'>
            <option>...</option>
        @foreach($triajes as $triaje)
            <option value='{{$triaje->id}}'  @if($caso->id_triaje == $triaje->id) selected @endif>{{$triaje->nombre}}</option>
        @endforeach          
        </select>
    </div>
    
    <div class="col-sm-12 col-md-2">
        <label for="tipologia">Tipologia</label>
        <select name='tipologia_id' id ='tipologia' class='form-control'>
            <option>...</option>
        @foreach($tipologias as $tipologia)
            <option value='{{$tipologia->id}}' @if($caso->id_tipologia == $tipologia->id) selected @endif>{{$tipologia->nombre}}</option>
        @endforeach          
        </select>
    </div>
    
    <div class="col-sm-12 col-md-2">
        <label for="tipologia">Origen</label>
        <select name='origen_id' id ='origen' class='form-control'>
            <option>...</option>
        @foreach($origenes as $origen)
            <option value='{{$origen->id}}' @if($caso->id_origen == $origen->id) selected @endif>{{$origen->nombre}}</option>
        @endforeach          
        </select>
    </div>
  </div>
	<div class='row p-4 justify-content-center'>
     <div >
        <label for="descripcion">Descripcion</label>
        <textarea name='descripcion' id='descripcion' style="width:100%;height:20vh;">{{$caso->descripcion}}</textarea>
    </div>
</div>
	<div class='row p-4 justify-content-center'>
     <div >
        <label for="implicados">Implicados</label>
        <textarea name='implicados' id='implicados' style="width:100%;height:20vh;">{{$caso->implicados}}</textarea>
    </div>
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
                <option>...</option>
                <option value='parte'> Parte </option>
                <option value='testigo'> testigo </option>
                <option value='afectado'> Afectado </option>
            </select>
		</div>
	<div class='col-sm-12 col-md-2'>
			<button id='btn_add' type='button' disabled class='btn btn-primary btn-lg' onclick='add()' >Añadir</button>
		</div>
</div>
<div class='row p-2 justify-content-center'>
    <div class="col-4" >
        <button type="submit" class="btn btn-primary btn-lg" style='width:100%'>Grabar</button>
        </form>
    </div>
</div>
    
<script>
    function active_btn(){
         document.getElementById('btn_add').disabled = false
    }
    function add(){
        var nia = document.getElementById('nia_alumno').value;
        var nombre = document.getElementById('nombre_alumno').value;
        var apellidos = document.getElementById('apellidos_alumno').value;
        
        var e = document.getElementById("papel");
        var value = e.value;
        var papel = e.options[e.selectedIndex].text;
        var implicados = document.getElementById('implicados').innerHTML.trim();

        document.getElementById('implicados').innerHTML = implicados + '\n'+papel+"(NIA:"+nia + ") " + nombre + " " + apellidos+ '\n';
        document.getElementById('nia_alumno').value ="";
        document.getElementById('nombre_alumno').value="";
        document.getElementById('apellidos_alumno').value="";
        document.getElementById('implicados').focus();
        document.getElementById('btn_add').disabled = true;
        e.options.selectedIndex=null 

         
    }
    
</script>
@endsection
