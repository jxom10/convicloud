<ul id="horiznav">
	<li>  
		<a class="brand" href="/">Convicloud</a>
	</li>
	<li> 
		<a class="{{ Route::is('profesores') ? 'active' : '' }}" href="{{route('profesores')}}">Profesores</a>
	</li>
	<li>
		<a class="{{ Route::is('alumnos') ? 'active' : '' }}" href="{{route('alumnos','nia')}}">Alumnos</a>
	</li>
	<li>
		<a class="{{ Route::is('casos') ? 'active' : '' }}" href="{{route('casos')}}">Casos</a>
	</li>
	<li>
		<a class="{{ Route::is('expedientes') ? 'active' : '' }}" href="{{route('expedientes')}}">Expedientes</a>
	</li>
	<li>
		<a class="{{ Route::is('partes') ? 'active' : '' }}" href="{{route('partes')}}">Partes</a>
	</li>
	<li>
		<a href="#">Maestros</a>
		 <ul>
			 <li>
				<a href="{{route('estados')}}">Estados</a>
			<a href="{{route('origenes')}}">Origenes</a>
			<a href="{{route('triajes')}}">Triaje</a>
			<a href="{{route('usuarios')}}">Usuarios</a>
			<a href="{{route('tipologias')}}">Tipologias</a>
		</ul>
	</li>
</ul>
