function valida(){
	
	erNombre=/^[a-zA-Z_0-9]{5,20}$/;
	
 	if(erNombre.test(document.formulario.usere.value)==false){
 	 	document.getElementById("info").innerHTML="El usuario no es valido";
 	 	return false;
 	}
	
 	if(document.formulario.passw.value== ""){
 	 	document.getElementById("infop").innerHTML="El password es obligatorio";
 	 	return false;
 	}
	
}