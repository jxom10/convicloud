<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Convicloud	</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
         <li class="nav-item">
          <a class="nav-link {{ Route::is('usuarios') ? 'active' : '' }}" href="{{route('usuarios')}}">Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('profes_lista') ? 'active' : '' }}" href="{{route('profesores')}}">Profesores</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('alumnos_lista') ? 'active' : '' }}" href="{{route('alumnos','nia')}}">Alumnos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('casos_lista') ? 'active' : '' }}" href="{{route('casos')}}">Casos</a>
        </li>
                <li class="nav-item">
          <a class="nav-link {{ Route::is('config') ? 'active' : '' }}" href="{{route('config')}}">Maestros</a>
        </li>
        <!--li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">nada</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
          </div>
        </li-->
      </ul>
      <!--form class="d-flex">
        <input class="form-control me-sm-2" type="search" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form -->
        <a href='/logout'><i class='fa fa-sign-out fa-2x' title='cerrar sesion'></i></a>
    </div>
  </div>
</nav>
