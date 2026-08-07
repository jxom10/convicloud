@extends('layouts.app')


@section('contenido')
<div class='row justify-content-center'>
  <div class="col-10"><h3>{{$titulo}}</h3>
  
    @if (session()->has('message'))
      <div class="alert alert-danger">
                  {{ session('message') }}
              </div>
    @endif	
  </div>
  <div>
  <div class='row'>
  
      <label for="id" class="col-sm-2 col-form-label">Caso Nº</label>
      <div class="col-sm-1">
        <input type="text" readonly="" class="form-control-plaintext" id="id" value="1">
      </div>
      
      <label for="estado" class="col-sm-2 col-form-label">Estados</label> 
      <div class="col-sm-2">
        <select name='estado_id' id ='estado'>
            @foreach($estados as $estado)
              <option value='{{$estdo->id}}'>{{$estado->nombre}}</option>
            @endforeach          
        </select>
      </div>
        
        
      <label for="triaje" class="col-sm-2 col-form-label">Triaje</label>
      <div class="col-ms-2">
        <select name='triaje_id' id ='triaje'>
          @foreach($triaje as $triaje)
            <option value='{{$triaje->id}}'>{{$triaje->nombre}}</option>
          @endforeach          
        </select>
      </div>
      
  </div>
   
    
    
    
  </div>
@endsection
