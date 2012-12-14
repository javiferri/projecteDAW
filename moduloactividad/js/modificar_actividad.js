addEvent(window,'load',inicializarEventos,false);
var id;
var i2;
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
  conexion1.open('GET','./moduloactividad/modelos/modifica_actividad_ajax.php?text='+document.getElementById('buscar').value+"&radio1="+document.getElementById('radio1').checked+
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
function mostrar(id1){
	id = id1;
	$('#modificar').load('./moduloactividad/modelos/modifica_actividad_ajax1.php?');

}
var conexion2;
function modificar(){
	conexion2=crearXMLHttpRequest();
	conexion2.onreadystatechange = procesarEventos2;
	conexion2.open('GET','./moduloactividad/controladores/actividadControlador.php?idM='+id+"&nombreActividad="+document.getElementById('nombreActividad').value+
	"&precio="+document.getElementById('precio').value+"&numhora="+document.getElementById('numhora').value+"&desc="+document.getElementById('desc').value+
	"&entrenador="+document.getElementById('entrenador').value, true);
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
