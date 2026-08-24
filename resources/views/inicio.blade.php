@extends('layouts.app')
@section('contenido')
<div class='container-fluid '>
<div class='row p-4  justify-content-center'>
		<div class="col-sm-12 col-md-6">	
			<a href="{{route('partes')}}">
				<div class='box derecha' style='background-color: #00BFA7'>
				Partes
				</div>
			</a>
		</div>
		<div class="col-sm-12 col-md-6">	
			<a href="{{route('casos')}}">
				<div class='box izquierda' style='background-color: #FFB314'>
				casos
				</div>
			</a>
		</div>
		<div class="col-sm-12 col-md-6">	
			<a href="{{route('expedientes')}}">
				<div class='box derecha' style='background-color: #1861DF'>
				Expedientes
				</div>
			</a>
		</div>
		<div class="col-sm-12 col-md-6">	
			<a href="{{route('alumnos')}}">
				<div class='box izquierda' style='background-color: #D576D0'>
					Alumnos
				</div>
			</a>
		</div>
</div>

</a>
@endsection
