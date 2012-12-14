function addRegistro(){
	$('#registro').load('./moduloprincipal/vistas/html/registro.html');
	$("#registro").fadeIn(800);
};

var conexion1;
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