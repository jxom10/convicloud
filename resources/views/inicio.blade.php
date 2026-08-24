@extends('layouts.app')
@section('contenido')
<!--<div class='container-fluid '>-->
<!--	<div class='row fila'>-->
<!--		<div class="col-sm-12 col-lg-6">-->
<!--			<div class='box derecha' style='background-color: #00BFA7'>-->
<!--			1-->
<!--			</div>-->
<!---->
<!--		</div>-->
<!--		<div  class="col-sm-12 col-lg-6"  >-->
<!--			<div class='box' style='background-color: #0077BF'>-->
<!--			2-->
<!--			</div>-->
<!---->
<!--		</div>-->
<!--		<div class="col-sm-12 col-lg-6" >-->
<!--			<div class='box derecha' style='background-color: #02A700'>-->
<!--			3-->
<!--			</div>-->
<!---->
<!--		</div>-->
<!--		<div class="col-sm-12 col-lg-6">-->
<!--			<div class='box'  style='background-color: #DC8D38'>-->
<!--			4-->
<!--			</div>-->
<!--		</div>-->
<!---->
<!--	</div>-->
<!--	-->
<!---->
<!--</div>-->

<a href='{{route('partes')}}'>Partes</a>
	<a href='{{route('casos')}}'>Casos</a>
<a href='{{route('expedientes')}}'>Expedientes</a>
@endsection
