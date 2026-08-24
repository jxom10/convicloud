@extends('layouts.app')


@section('contenido')
<div class='row justify-content-center'>

	<form method=POST>
		@csrf
		@foreach($configs as $config)
        <tr>

			<td>{{$config->nombre }}</td>
			<td>

				<input type=text name="{{$config->id }}" value="{{$config->valor}}">

			</td>
		</tr>
	@endforeach
		<tr>
			<td><input type=text name='nombre'></td>
			<td><input type=text name='valor'></td>
		</tr>
		<tr>
			<td><input type=submit value='Grabar'></form></td>
		</tr>
	</table>

</div>


@endsection
