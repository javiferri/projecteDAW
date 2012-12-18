/**
*@author Javier Ferri
*@version 17122012
*/
/**
*@method addEvent()
*@description Añade la funcion inicializarEventos() al cuerpo de la pagina.
*/
addEvent(window,'load',inicializarEventos,false);
/**
*@method inicializarEventos()
*@description Añade eventos a los elementos de la pagina.
*/
function inicializarEventos(){
  var ob=document.getElementById('buscar');
  addEvent(ob,'keyup',presionTecla,false);
  var ob1=document.getElementById('radio1');
  addEvent(ob1,'click',presionTecla,false);
  var ob2=document.getElementById('radio2');
  addEvent(ob2,'click',presionTecla,false);
  var ob3=document.getElementById('criterio_ord');
  addEvent(ob3,'change',presionTecla,false);
  var ob4=document.getElementById('mas');
  addEvent(ob4,'change',presionTecla,false);
}
/** @global */
var conexion1;
/**
*@method presionTecla()
*@description Conexion con buscar_cliente_ajax.php para busqueda de clientes.
*@param {ElementBody} e
*@returns {Cadena}
*/
function presionTecla(e){
  conexion1=crearXMLHttpRequest();
  conexion1.onreadystatechange = procesarEventos;
  conexion1.open('GET','./modulocliente/modelos/modifica_cliente_ajax.php?text='+document.getElementById('buscar').value+"&radio1="+document.getElementById('radio1').checked+
	"&radio2="+document.getElementById('radio1').checked+"&criterio_ord="+document.getElementById('criterio_ord').value+"&mas="+document.getElementById('mas').value, true);
  conexion1.send(null);
}
/**
*@method procesarEventos()
*@returns {cadena} Retorna el valor de buscar_cliente_ajax.php.
*@description Añadira a la capa #resultados el valor que de la conexion.
*/
function procesarEventos(){
  var resultados = document.getElementById("resultado3");
  if(conexion1.readyState == 4){
    if (conexion1.status==200)
	  resultados.innerHTML = conexion1.responseText;
    else
      alert(conexion1.statusText);
  } 
  else 
    resultados.innerHTML = '';
}
/** @global */
var id;
/**
*@method mostrar()
*@param {number} id1
*@description Añadira a la capa #modificar 'modifica_cliente_ajax1.php'.
*/
function mostrar(id1){
	id = id1;
	$('#modificar').load('./modulocliente/modelos/modifica_cliente_ajax1.php');
}
/** @global */
var conexion2;
/**
*@method modificar()
*@class
*@description Conexion con clienteControlador.php para modificar.
*@returns {String}
*/
function modificar(){
	conexion2=crearXMLHttpRequest();
	conexion2.onreadystatechange = procesarEventos2;
	conexion2.open('GET','./modulocliente/controladores/clienteControlador.php?idM='+id+"&nombreModifi="+document.getElementById('nombreModifi').value+
	"&pape="+document.getElementById('pape').value+"&sape="+document.getElementById('sape').value+"&dire="+document.getElementById('dire').value+
	"&tele="+document.getElementById('tele').value+"&fecha="+document.getElementById('fecha').value, true);
	conexion2.send(null);
}
/**
*@method procesarEventos2()
*@returns {String} Retorna el valor de la conexion.
*@classdesc Añadira a la capa #resultados el valor que de la conexion.
*/
function procesarEventos2(){
  var resultados = document.getElementById("modificar");
  if(conexion2.readyState == 4){
    if (conexion1.status==200)
	  resultados.innerHTML = conexion2.responseText;
    else
      alert(conexion2.statusText);
  } 
  else 
    resultados.innerHTML = '';
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
