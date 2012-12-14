addEvent(window,'load',inicializarEventos,false);

var conexion1;
conexion1=crearXMLHttpRequest();
conexion1.onreadystatechange = procesarEventos;
item=document.getElementById('item').value;
conexion1.open('GET','./moduloitems/modelos/buscar_items_ajax.php?item='+document.form1.item.value+"&radio1="+document.form1.radio1.checked+
	"&radio2="+document.form1.radio2.checked+"&criterio_ord="+document.form1.criterio_ord.value+"&mas="+document.form1.mas.value, true);
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