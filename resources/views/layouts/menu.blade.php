<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark" id="nav_normal" >
  <div class="container-fluid"  >
    <a class="navbar-brand" href="/">Convicloud	</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      
       
      <ul class="navbar-nav me-auto">
          <li class="nav-item dropdown">
          <a class=" nav-link dropbtn"><span class="navbar-toggler-icon"></span></a>
          <div class="dropdown-content" style="left:0;">
            <a href="{{route('estados')}}">Estados<a>
            <a href="{{route('tipologias')}}">Tipologias</a>
            <a href="{{route('usuarios')}}">Usuarios</a>
          </div>
        </li>
      </ul>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <!-- <li class="nav-item">-->
        <!--  <a class="nav-link {{ Route::is('usuarios') ? 'active' : '' }}" href="{{route('usuarios')}}">Usuarios</a>-->
        <!--</li>-->
        <li class="nav-item">
          <a class="nav-link {{ Route::is('profes_lista') ? 'active' : '' }}" href="{{route('profesores')}}">Profesores</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('alumnos_lista') ? 'active' : '' }}" href="{{route('alumnos','nia')}}">Alumnos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('casos_lista') ? 'active' : '' }}" href="{{route('casos')}}">Casos</a>
        </li>

        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('config') ? 'active' : '' }}" href="{{route('expedientes')}}">Expedientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('config') ? 'active' : '' }}" href="{{route('partes')}}">Partes</a>
        </li>
        <li class="nav-item">
          <li class="nav-item dropdown">
          <a class=" nav-link dropbtn">Maestros</a>
           <div class="dropdown-content" style="left:0;">
             <a href="{{route('estados')}}">Estados<a>
             <a href="{{route('tipologias')}}">Tipologias</a>
               <a href="{{route('origenes')}}">Origenes</a>
             <a href="{{route('usuarios')}}">Usuarios</a>
           </div>
        </li>
        
</div>
        
      </ul>
      <!--form class="d-flex">
        <input class="form-control me-sm-2" type="search" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form -->
        <a href='/logout'><i style='color:#FFFFFF;' class='fa fa-sign-out fa-2x' title='cerrar sesion'></i></a>
    </div>
  </div>
</nav>
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark" id="nav_resp" >
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
   <ul>
     <li>1</li>
     <li>2</li>
    
   </ul>
</nav>
  