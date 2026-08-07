<html>
<head>
	    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>CONVICLOUD @isset($titulo) - {{$titulo}} @endisset</title>


	<link rel="stylesheet" href="/assets/font-awesome-4.7.0/css/font-awesome.min.css">
	
	
	<link rel="stylesheet" href="https://bootswatch.com/5/cerulean/bootstrap.css">
	<link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700">
	<script src="/assets/js/jquery.min.js"></script>
	<script src="/assets/js/scripts.js"></script>
	<!--<script src="/assets/js/bootstrap.min.js"></script>-->

</head>
<body>
	
@include('layouts.menu')

@yield('contenido')

</body>
</html>
