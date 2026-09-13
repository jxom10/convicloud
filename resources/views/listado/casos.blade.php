<div class="row m-2 justify-content-center">
	<div class="col-md-2">
		<div class="card">
			<div class="card-header text-center">
				<h4>Total estudiantes</h4>
			</div>
			<div class="card-body" id="chart_estudiantes"	>

			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<div class="card-header text-center">
				<h4>Conciliados por cursos </h4>
			</div>
			<div class="card-body" id="chart_casos_cursos"	>

			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<div class="card-header text-center">
				<h4>Expedientes por cursos</h4>
			</div>
			<div class="card-body" id="chart_expedientes_cursos"	>

			</div>
		</div>
	</div>
</div>
<script>
	const casos_data = @json(array_values($datos['casos']['estudiantes']));
    var casos_estudiantes = {
      chart: {type: 'bar',zoom: {enabled : false},height:'200px'},
      series: [{name: 'estudiantes', data: casos_data	}],
       xaxis: {categories: ['Total','O','A','N']}
    }
    var chart_estudiantes = new ApexCharts(document.querySelector('#chart_estudiantes'), casos_estudiantes)
    chart_estudiantes.render()
    
	const caso_cursos_data = @json(array_values($datos['casos']['curso']));
    var caso_cursos = {
      chart: {type: 'bar',zoom: {enabled : false},height:'200px'},
      series: [{name: 'exp_conciliados', data: caso_cursos_data}],
      xaxis: {categories: ['1ESO','2ESO','3ESO','4ESO','1BAC','2BAC']}
    }
    var chart_casos_cursos = new ApexCharts(document.querySelector('#chart_casos_cursos'), caso_cursos		)
    chart_casos_cursos.render()
    
	const exp_curso_data2 = @json(array_values($datos['expedientes']['curso_exp']));
    var exp_exp_curso = {
      chart: {type: 'bar',zoom: {enabled : false},height:'200px'},
      series: [{name: 'exp_expedientes', data: exp_curso_data2	}],
      xaxis: {categories: ['1ESO','2ESO','3ESO','4ESO','1BAC','2BAC']}
    }
    var chart_exp_clase = new ApexCharts(document.querySelector('#chart_expedientes_cursos'), exp_exp_curso)
    chart_exp_clase.render()
</script>
