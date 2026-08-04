	<title></title>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
		<link rel='stylesheet' type='text/css' href='/assets/css/style.css'>
		<link rel='stylesheet' type='text/css' href='/assets/css/loginstyle.css'>
	</head>
	<body>
	<div class="login" >
		<h1>Acceso vía codigo</h1>

			@if(session('mensaje'))
				<div class='flash {{session("mensaje")[0]}}'>
					<b>{{session('mensaje')[1]}}</b>
				</div>
			@endif
			<form class="form" method="post" action="{{ route('recuperar_password')}}">
				@csrf
				<p class="field">
					<input type="text" name="email" placeholder="email" required/>
					<i class="fa fa-envelope"></i>
				</p>
				@if(isset($codigo))
				<p class="field" id='codigo'>
					<input type="text" name="codigo" placeholder="codigo"/>
					<i class="fa fa-th"></i>
				</p>
				@endif
				<p class="submit">
					<input type="submit" name="sent" value=@if(isset($codigo)) "Entrar"  @else "Solicitar codigo " @endif>
				 </p>

			</form>
				<p class='texto'><a href='/recuperar/1'>Ya tengo un código</a><br>
				<a href='/login'>Iniciar session</a></p>
		</div>
	</body>
</html>

 
