<nav class="navbar navbar-expand-lg bg-primary sticky-top ">
  <a class="navbar-brand" href="/">Convicloud</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse"  data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-expanded="false"  aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
		<li class="nav-item">
          <a class="nav-link {{ Route::is('profesores') ? 'active' : '' }}" href="{{route('profesores')}}">Profesores</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('alumnos') ? 'active' : '' }}" href="{{route('alumnos','nia')}}">Alumnos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('casos') ? 'active' : '' }}" href="{{route('casos')}}">Casos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('expedientes') ? 'active' : '' }}" href="{{route('expedientes')}}">Expedientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('partes') ? 'active' : '' }}" href="{{route('partes')}}">Partes</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Maestros
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{route('estados')}}">Estados</a>
            <a class="dropdown-item" href="{{route('tipologias')}}">Tipologias</a>
            <a class="dropdown-item" href="{{route('origenes')}}">Origenes</a>
            <a class="dropdown-item" href="{{route('triajes')}}">Triaje</a>
            <a class="dropdown-item" href="{{route('usuarios')}}">Usuarios</a>
          </div>
        </li>
		<li >
			<a  class="nav-link" href='/logout'>Salir</a>
		</li>
    </ul>
  </div>

</nav>
  @if ($errors->any())
    <div id='errores' class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
