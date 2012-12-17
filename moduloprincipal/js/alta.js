/**
*@author Javier Ferri
*@version 17122012
*/
/**
*@method addRegistro()
*@class
*@description A�ade un efecto de JQuery fadeIn en la capa #registro.
*/
function addRegistro(){
	$('#registro').load('./moduloprincipal/vistas/html/registro.html');
	$("#registro").fadeIn(1000);
};
var conexion1;
/**
*@method alta()
*@returns {String} Retorna el valor de registro.php.
*@example
* // returns "Registro Correcto."
*@classdesc Conexion AJAX por GET a un php que retornara un valor.
*/
function alta(){
var coincide;
	erNombre=/^[a-zA-Z_0-9]{4,20}$/;
	
 	if(erNombre.test(document.getElementById("usere").value)==false){
 	 	document.getElementById("info").innerHTML="El usuario no es valido";
	}else{document.getElementById("info").innerHTML="";}
	
 	if(document.getElementById("passw").value== ""){
			document.getElementById("infop").innerHTML="El password es necesario";
	}else{document.getElementById("passw").innerHTML="";}
	
	if(document.getElementById("passw").value != document.getElementById("passw2").value){
			document.getElementById("infop2").innerHTML="Los passwords no son iguales";
	}else{
	document.getElementById("infop2").innerHTML="";
	coincide = "s";
	}
	
	if( erNombre.test(document.getElementById("usere").value) && document.getElementById("passw").value != "" && coincide ==="s"){
		conexion1=crearXMLHttpRequest();
		conexion1.onreadystatechange = procesarEventos;
		conexion1.open('GET','./moduloprincipal/controladores/registro.php?usere='+document.getElementById('usere').value+"&passw="+document.getElementById('passw').value, true);
		conexion1.send(null);
	}
}
/**
*@method procesarEventos()
*@returns {cadena} Retorna el valor de registro.php.
*@classdesc A�adira a la capa #resultados el valor que de la conexion.
*/
function procesarEventos(){
  var resultados = document.getElementById("resultados");
  if(conexion1.readyState == 4){
	  resultados.innerHTML = conexion1.responseText;
  } 
  else {
    resultados.innerHTML = 'error';
	}
}
//***************************************
//Funciones comunes a todos los problemas
//***************************************
function addEvent(elemento,nomevento,funcion,captura){
  if (elemento.attachEvent){
    elemento.attachEvent('on'+nomevento,funcion);
    return true;
  }
  else  
    if (elemento.addEventListener){
      elemento.addEventListener(nomevento,funcion,captura);
      return true;
    }
    else
      return false;
}
function crearXMLHttpRequest() {
  var xmlHttp=null;
  if (window.ActiveXObject) 
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  else 
    if (window.XMLHttpRequest) 
      xmlHttp = new XMLHttpRequest();
  return xmlHttp;
}