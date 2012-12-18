addEvent(window,'load',inicializarEventos,false);
/** @global */
var id;
/** @global */
var a;
/** @global */
var actividad1;
/** @global */
var actividad2;
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
var conexion1;
function presionTecla(e){
  conexion1=crearXMLHttpRequest();
  conexion1.onreadystatechange = procesarEventos;
  conexion1.open('GET','./modulocliente/modelos/apuntar_cliente_ajax.php?text='+document.getElementById('buscar').value+"&radio1="+document.getElementById('radio1').checked+
	"&radio2="+document.getElementById('radio1').checked+"&criterio_ord="+document.getElementById('criterio_ord').value+"&mas="+document.getElementById('mas').value, true);
  conexion1.send(null);
}
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
/**
*@method mostrar()
*@description Añade una vista en la capa indicada.
*@param {Integer } di1
*/
function mostrar(id1){
	id = id1;
	$('#modificar').load('./modulocliente/vistas/apuntarseA2.php');
}
/**
*@method guardar()
*@description Guarda en variables globales las actividades elegidas.
*@param {String } actividad
*/
function guardar(actividad){
	if (a===1){
		actividad1=actividad;
		a=2;
	}else{
		actividad2=actividad;
		a=1;
	}
}
var conexion2;
function apuntarse(){
alert("e");
	conexion2=crearXMLHttpRequest();
	conexion2.onreadystatechange = procesarEventos2;
	conexion2.open('GET','./modulocliente/controladores/clienteControlador.php?idCA='+id+"&actividad1="+actividad1+
	"&actividad2="+actividad2, true);
	conexion2.send(null);
}
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
