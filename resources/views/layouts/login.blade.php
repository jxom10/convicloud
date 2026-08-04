<link rel='stylesheet' type='text/css' href='/assets/css/style.css'>
<link rel='stylesheet' type='text/css' href='/assets/css/loginstyle.css'>
  <div class="login" id="login">
    <h1>Login</h1>

		@if(session('mensaje'))
			<div class='flash {{session("mensaje")[0]}}'>
				<b>{{session('mensaje')[1]}}</b>
			</div>
		@endif
    <form class="form" method="post" action="{{ route('validar_usuarios')}}">
		@csrf
      <p class="field">
        <input type="text" name="email" placeholder="email" required/>
        <i class="fa fa-user"></i>
      </p>

      <p class="field">
        <input type="password" name="password" placeholder="Contraseña" required/>
        <i class="fa fa-lock"></i>
      </p>

      <p class="submit"><input type="submit" name="sent" value="Login"></p>


    </form>
    <div class=texto>
      <button type=button onclick="window.open('/recuperar')">contraseña olvidada</a>
    </div>
  </div>
  
  

