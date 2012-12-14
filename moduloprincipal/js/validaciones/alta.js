function altaC(){
var resultado = true;
erNombre=/^[a-zA-Z]{4,25}$/;
erApellido=/^[a-zA-Z]{4,25}$/;
erDireccion=/^[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?(( |\/)[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?)* (((#|[nN][oO]\.?) ?)?\d{1,4}(( ?[a-zA-Z0-9\-]+)+)?)$/;
erTele=/^0{0,2}([\+]?[\d]{1,3} ?)?([\(]([\d]{2,3})[)] ?)?[0-9][0-9 \-]{6,}( ?([xX]|([eE]xt[\.]?)) ?([\d]{1,5}))?$/;

	if(erNombre.test(document.getElementById("nombre").value)==false){
		document.getElementById("rnombre").innerHTML="El Nombre no es correcto";
		resultado = false;
	}else{ document.getElementById("rnombre").innerHTML=""; }
	if(erApellido.test(document.getElementById("apellido1").value)==false){
		document.getElementById("rapellido1").innerHTML="El Apellido no es correcto";
		resultado = false;
	}else{ document.getElementById("rapellido1").innerHTML=""; }
	if(erApellido.test(document.getElementById("apellido2").value)==false){
		document.getElementById("rapellido2").innerHTML="El Apellido no es correcto";
		resultado = false;
	}else{ document.getElementById("rapellido2").innerHTML=""; }
	if(erDireccion.test(document.getElementById("dire").value)==false){
		document.getElementById("rdireccion").innerHTML="La direccion no es correcta";
		resultado = false;
	}else{ document.getElementById("rdireccion").innerHTML=""; }
	if(erTele.test(document.getElementById("tele").value)==false){
		document.getElementById("rtelefono").innerHTML="El Telefono no es correcto";
		resultado = false;
	}else{ document.getElementById("rtelefono").innerHTML=""; }
	if(document.getElementById("fecha").value==""){
		document.getElementById("rfecha").innerHTML="Se necesita una fecha";
		resultado = false;
	}else{ document.getElementById("rfecha").innerHTML=""; }
	return resultado;
}
function altaE(){
var resultado = true;
erNombre=/^[a-zA-Z]{4,25}$/;
erApellido=/^[a-zA-Z]{4,25}$/;
erTele=/^0{0,2}([\+]?[\d]{1,3} ?)?([\(]([\d]{2,3})[)] ?)?[0-9][0-9 \-]{6,}( ?([xX]|([eE]xt[\.]?)) ?([\d]{1,5}))?$/;

	if(erNombre.test(document.getElementById("nombre").value)==false){
		document.getElementById("rnombre").innerHTML="El Nombre no es correcto";
		resultado = false;
	}else{ document.getElementById("rnombre").innerHTML=""; }
	if(erApellido.test(document.getElementById("apellido1").value)==false){
		document.getElementById("rapellido1").innerHTML="El Apellido no es correcto";
		resultado = false;
	}else{ document.getElementById("rapellido1").innerHTML=""; }
	if(erApellido.test(document.getElementById("apellido2").value)==false){
		document.getElementById("rapellido2").innerHTML="El Apellido no es correcto";
		resultado = false;
	}else{ document.getElementById("rapellido2").innerHTML=""; }

	if(erTele.test(document.getElementById("tele").value)==false){
		document.getElementById("rtelefono").innerHTML="El Telefono no es correcto";
		resultado = false;
	}else{ document.getElementById("rtelefono").innerHTML=""; }
	
	return resultado;
}
function altaA(){
var resultado = true;
erNombre=/^[a-zA-Z]{4,25}$/;
erEntero=/^(?:\+|-)?\d+$/;
erEnteroLimit=/^(?:\+|-)?\{3}d+$/;

	if(erNombre.test(document.getElementById("nombre").value)==false){
		document.getElementById("rnombre").innerHTML="El Nombre no es correcto";
		resultado = false;
	}else{ document.getElementById("rnombre").innerHTML=""; }
	if(erEntero.test(document.getElementById("precio").value)==false){
		document.getElementById("rprecio").innerHTML="El Nombre no es correcto";
		resultado = false;
	}else{ document.getElementById("rprecio").innerHTML=""; }
	if(erEnteroLimit.test(document.getElementById("hora").value)==false){
		document.getElementById("rhora").innerHTML="El numero de horas no son correctas";
		resultado = false;
	}else{ document.getElementById("rhora").innerHTML=""; }
	if(document.getElementById("desc").value==""){
		document.getElementById("rdescripcion").innerHTML="Escriba una descripcion breve";
		resultado = false;
	}else{ document.getElementById("rdescripcion").innerHTML=""; }
	return resultado;
}