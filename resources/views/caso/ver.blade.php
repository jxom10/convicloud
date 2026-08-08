@extends('layouts.app')


@section('contenido')
	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif


    <div class='row p-2'>
      <div class='col-sm-3'></div>
      <div class='col-sm-1'>
        <form method='POST' action='{{route('caso_grabar')}}'>
          @csrf
          <label for="id">Nº</label>
          <input type='text' class='form-control' size=4 name='id' @if($caso->id) value="{{$caso->id}}" @endif readonly="readonly">
      </div>
      <div class='col-sm-1'>
            <label for="estado">Estado</label>
            <select name='id_estado' id='estado' class='form-control' >
            <option value=''>...</option>
            @foreach($estados as $estado)
              <option value='{{$estado->id}}' @if($estado->id == $caso->id_estado) selected @endif > {{$estado->nombre}} </option>
            @endforeach
          </select>
      </div>
      <div class='col-sm-2'>
           <label for="triaje">Triaje</label>
          <select name='id_triaje' id='triaje' class='form-control'>
            <option value=''>...</option>
            @foreach($triajes as $triaje)
              <option value='{{$triaje->id}}' @if($triaje->id == $caso->id_estado) selected @endif > {{$triaje->nombre}} </option>
            @endforeach
          </select>
        </div>
        <div class='col-sm-2'>
           <label for="tipologia">Tipologia</label>
          <select name='id_tipologia' id='tipologia' class='form-control'>
            <option value=''>...</option>
            @foreach($tipologias as $tipologia)
              <option value='{{$tipologia->id}}' @if($tipologia->id == $caso->id_estado) selected @endif > {{$tipologia->nombre}} </option>
            @endforeach
          </select>
        </div>
      <div class='col-sm-3'></div>
    </div>
      
    <div class='row p-2'>
      <div class='col-sm-3'></div>
      <div class='col-sm-6'>
        <label for="descripcion">Descripcion</label>
          <textarea id='descripcion' name='descripcion' class='textarea'>{{$caso->descripcion}}</textarea>
      </div>
      <div class='col-sm-3'></div>
    </div>
    <div class='row p-2'>
      <div class='col-sm-3'></div>
      <div class='col-sm-3'>
        <label for="implicados">implicados</label>
          <select class='form-control'  id='implicados' name='id_implicados[]' multiple='multiple'>
            @if(is_array($id_implicados))
              @foreach($id_implicados as $id)
                <option value='{{$id}}' selected>{{$id}}</option>
              @endforeach
            @endif
           </select> 
      </div>
      <div class='col-sm-3'>
        <label for="buscador">Buscador de alumnos</label>
        <input class='form-control' id='buscador' type=text onKeyUp='buscar_alumno(this.value,"1")' >
        <div id='respuesta_alumno' class='respuesta'></div>
      </div>
      <div class='col-sm-3'></div>
    </div>
    <div class='row p-2'>
        <div class='col-sm-3'></div>
        <div class='col-sm-6'>
          <button type="submit" class="btn btn-primary btn-lg">Grabar</button>
          </form>
        </div>
        <div class='col-sm-3'></div>
    </div>
    
    <div class='row p-2'></div>
@endsection
