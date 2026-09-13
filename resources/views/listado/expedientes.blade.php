<div class="row m-2 justify-content-center">
	<div class="col-md-2">
		<div class="card">
			<div class="card-header text-center">
				<h4>Totales</h4>
			</div>
			<div class="card-body" id="chart_expedientes"	>

			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<div class="card-header text-center">
				<h4>Conciliados por cursos </h4>
			</div>
			<div class="card-body" id="chart_conc_clase"	>

			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<div class="card-header text-center">
				<h4>Expedientes por cursos</h4>
			</div>
			<div class="card-body" id="chart_exp_clase"	>

			</div>
		</div>
	</div>
</div>
<script>
const expedientes_data = @json(array_values($datos['expedientes']['tipo']));
    var expedientes = {
      chart: {type: 'bar',zoom: {enabled : false},height:'200px'},
      series: [{name: 'nivel', data: expedientes_data	}],
       xaxis: {categories: ['Conc','Exp']}
    }
    var chart_expedientes = new ApexCharts(document.querySelector('#chart_expedientes'), expedientes)
    chart_expedientes.render()
    
	const exp_curso_data = @json(array_values($datos['expedientes']['curso_conc']));
    var exp_conc_curso = {
      chart: {type: 'bar',zoom: {enabled : false},height:'200px'},
      series: [{name: 'exp_conciliados', data: exp_curso_data}],
      xaxis: {categories: ['1ESO','2ESO','3ESO','4ESO','1BAC','2BAC']}
    }
    var chart_conc_clase = new ApexCharts(document.querySelector('#chart_conc_clase'), exp_conc_curso		)
    chart_conc_clase.render()
    
	const exp_curso_data2 = @json(array_values($datos['expedientes']['curso_exp']));
    var exp_exp_curso = {
      chart: {type: 'bar',zoom: {enabled : false},height:'200px'},
      series: [{name: 'exp_expedientes', data: exp_curso_data2	}],
      xaxis: {categories: ['1ESO','2ESO','3ESO','4ESO','1BAC','2BAC']}
    }
    var chart_exp_clase = new ApexCharts(document.querySelector('#chart_exp_clase'), exp_exp_curso)
    chart_exp_clase.render()
</script>
