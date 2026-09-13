@extends('layouts.app')

@section('contenido')

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<div class='row justify-content-center'>

	<div class='col-2 '> 	
		<form method=POST action="{{route('listados')}}">
		@csrf
		<label for='tipo'>Tipo de Documento</label>
		<select name='tipo' class="form-control" >
			<option value='Parte' @if($tipo == 'Parte') selected @endif>Partes</option>
			<option value='Expediente' @if($tipo == 'Expediente') selected @endif>Expentiendes</option>
			<option value='Caso' @if($tipo == 'Caso') selected @endif>Casos</option>
		</select>
	</div>
	<div class='col-2'>
		<label for="desde">Desde</label>
		<input type="date" id="desde" name="desde" value="{{$desde}}"  class="form-control" >
	</div>
		<div class='col-2'>
		<label for="hasta">Hasta</label>
		<input type="date" id="hasta" name="hasta" value="{{$hasta}}"   class="form-control" >
	</div>
	<div class="col-1	"><br>
		<input type="submit" value="consultar" class='btn btn-primary align-bottom'>
	</div> 
	</form>
</div>

@if($tipo=='Parte')
	@include('listado.partes')

@elseif($tipo=='Expediente')
		@include('listado.expedientes')

@elseif($tipo=='Caso')
		@include('listado.casos')
@endif
  

    

	
    
</script>
@endsection
