<div class="row m-2 justify-content-center">
	<div class="col-8">
		<table class="table">
			<tr>
				<th>Alumno</th>
				<th>Curso</th>
				<th>Fecha</th>
				<th>Nivel</th>
				<th>Implicados en</th>
			</tr>
			@foreach($partes as $parte)
			<tr>
				<td>{{$parte->alumno->nombre_completo()}}</td>
				<td>{{$parte->alumno->curso}} {{$parte->alumno->grupo}}</td>
				<td>{{$parte->fecha}}</td>
				<td>{{$parte->nivel}}</td>
				<td>{{count($parte->alumno->partes)}}</td>
			</tr>
			@endforeach
			<tr>
				<td colspan=5><h3>Total : {{count($partes)}}</h3></td>
			</tr>
		</table>
	</div>
</div>
<div class="row m-2 justify-content-center">
	<div class="col-md-2">
		<div class="card">
			<div class="card-header text-center">
				<h4>Gravedad</h4>
			</div>
			<div class="card-body" id="chart"	>

			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<div class="card-header text-center">
				<h4>Cursos</h4>
			</div>
			<div class="card-body" id="chart_partes_curso"	>

			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<div class="card-header text-center">
				<h4>Generos</h4>
			</div>
			<div class="card-body" id="chart_casos"	>

			</div>
		</div>
	</div>
		<div class="col-md-3">
		<div class="card">
			<div class="card-header text-center">
				<h4>Tipologias</h4>
			</div>
			<div class="card-body" id="chart_tipologias"	>

			</div>
		</div>
	</div>
</div>
 <script>
	const partes_data = @json(array_values($datos['partes']['nivel']));
    var partes = {
      chart: {type: 'bar',zoom: {enabled : false},height:'200px'},
      series: [{name: 'nivel', data: partes_data}],
       xaxis: {categories: ['Leve','Grave']}
    }
    var chart = new ApexCharts(document.querySelector('#chart'), partes)
    chart.render()
    
    const partes_curso_data = @json(array_values($datos['partes']['curso']));
    var partes_curso = {
      chart: {type: 'bar',zoom: {enabled : false},height:'200px'},
      series: [{name: 'expedientes', data: partes_curso_data}],
      xaxis: {categories: ['1ESO','2ESO','3ESO','4ESO','1BAC','2BAC']}
    }
    var chart_partes_curso = new ApexCharts(document.querySelector('#chart_partes_curso'), partes_curso)
    chart_partes_curso.render()
    
    
    const casos_data = @json(array_values($datos['partes']['genero']));
    var casos = {
      chart: {type: 'bar',zoom: {enabled : false},height:'200px'},
      series: [{name: 'casos', data: casos_data}],
       xaxis: {categories: ['Chico','Chica','']}
    }
     
    var chart_casos = new ApexCharts(document.querySelector('#chart_casos'), casos)
    chart_casos.render()
    
        const tipologias_data = @json(array_values($datos['partes']['tipologia']));
    var  tipologias = {
      chart: {type: 'bar',zoom: {enabled : false},height:'200px'},
      series: [{name: 'tipologia', data: tipologias_data}],
       xaxis: {categories: @json(array_keys($tipologias))}
    }
    var chart_tipologia = new ApexCharts(document.querySelector('#chart_tipologias'),  tipologias)
    chart_tipologia.render()
    
    </script>
