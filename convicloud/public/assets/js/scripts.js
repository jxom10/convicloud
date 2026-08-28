let selected_prof;
function buscar_profesor(busca){
	var drop="";
	$.ajax({
		type: "GET",
		url: '/profesores/lista/'+busca,
		dataType: "JSON",
		success: function(respuesta){
			respuesta.forEach(function (profesor){
				var apellidos = profesor.apellido1;
				if(profesor.apellido2){
					apellidos += " "+ profesor.apellido2;
				}
				drop += "<div onclick='select_prof("+ profesor.id +")'>"+ profesor.nombre +" "+ apellidos +"</div>";
			});
			document.getElementById('respuesta_profesor').innerHTML = drop;
		}
	});
}
function buscar_alumno(busca){
	var drop="";
	$.ajax({
		type: "GET",
		url: '/alumnos/lista/'+busca,
		dataType: "JSON",
		success: function(respuesta){
			respuesta.forEach(function (alumno){
				drop += "<div  onclick='select_alumno("+ alumno.id+")'>"+ alumno.nombre+" "+ alumno.apellido1+" "+ alumno.apellido2+"</div>";
			});
			document.getElementById('respuesta_alumno').innerHTML = drop;
		}
	});
}
function select_prof(id){
	$.ajax({
		type: "GET",
		url: '/profesor/get/'+id,
		dataType: "JSON",
		success: function(respuesta){
			var apellido2 ='';
			if(respuesta.apellido2){
				apellido2 = " "+ respuesta.apellido2;
			}
			document.getElementById('id_profesor').value = respuesta.id;
			if(document.getElementById("nombre_profesor")){
				document.getElementById('nombre_profesor').value = respuesta.nombre;
			}
			if(document.getElementById("apellido1_profesor")){
				document.getElementById('apellido1_profesor').value = respuesta.apellido1;
			}
			if(document.getElementById("apellido2_profesor") ){
				document.getElementById('apellido2_profesor').value = apellido2;
			}
			if(document.getElementById("apellidos_profesor")){
				document.getElementById('apellidos_profesor').value = respuesta.apellido1 + " " + apellido2;
			}
			if(document.getElementById("nombre_completo_profesor")){
				document.getElementById('nombre_completo_profesor').value = respuesta.nombre + " "+respuesta.apellido1 + " " + apellido2;
			}
			document.getElementById('respuesta_profesor').innerHTML = "";
		}
	});
	
}
function select_alumno(id){

	$.ajax({
		type: "GET",
		url: '/alumno/get/'+id,
		dataType: "JSON",
		success: function(respuesta){
			document.getElementById('id_alumno').value = respuesta.id;
			if(document.getElementById("nombre_alumno")){
				document.getElementById('nombre_alumno').value = respuesta.nombre;
			}
			if(document.getElementById("apellido1_alumno")){
				document.getElementById('apellido1_alumno').value = respuesta.apellido1;
			}
			if(document.getElementById("apellido2_alumno")){
				document.getElementById('apellido2_alumno').value = respuesta.apellido2;
			}
			if(document.getElementById("apellidos_alumno")){
				document.getElementById('apellidos_alumno').value = respuesta.apellido1 + " " +respuesta.apellido2;
			}
			if(document.getElementById("nia_alumno")){
				document.getElementById('nia_alumno').value = respuesta.nia;
			}
			if(document.getElementById("curso_alumno")){
				document.getElementById('curso_alumno').value = respuesta.curso;
			}
			if(document.getElementById("grupo_alumno")){
				document.getElementById('grupo_alumno').value = respuesta.grupo;
			}
			if(document.getElementById("nombre_completo_alumno")){
				document.getElementById('nombre_completo_alumno').value = respuesta.nombre + " "+ respuesta.apellido1 + " " +respuesta.apellido2;
			}
			document.getElementById('respuesta_alumno').innerHTML = "";
			
		}
	});
	
}
