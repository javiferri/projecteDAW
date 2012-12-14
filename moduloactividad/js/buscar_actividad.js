addEvent(window,'load',inicializarEventos,false);
function inicializarEventos(){
  var ob=document.getElementById('nombre');
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
  conexion1.open('GET','./moduloactividad/modelos/buscar_actividad_ajax.php?nombre='+document.getElementById('nombre').value+"&radio1="+document.getElementById('radio1').checked+
	"&radio2="+document.getElementById('radio2').checked+"&criterio_ord="+document.getElementById('criterio_ord').value+"&mas="+document.getElementById('mas').value, true);
  conexion1.send(null);
}
function procesarEventos(){
  var resultados = document.getElementById("resultados");
  if(conexion1.readyState == 4){
    if (conexion1.status==200)
	  resultados.innerHTML = conexion1.responseText;
    else
      alert(conexion1.statusText);
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