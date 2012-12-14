<?php
session_start();
//echo '<div id = "sesionstart"><H4 align="right"> '.$_SESSION['userId'].' ('. $_SESSION['userType'].') <a href="./index.php?controlador=principal&accion=logout">Logout</a></H4></div>';
ComprobarAdministrador();
function ComprobarAdministrador(){
	if (!isset($_SESSION['userId']))
		header("Location: index.php?error=noadmin");
	if ($_SESSION['userType'] !== 'admin')
		header("Location: index.php?error=noadmin");
}
function listar(){
	require './moduloactividad/modelos/actividadModelo.php';
	$items = buscarTodosLosItems();
	require './moduloactividad/vistas/listar.php';
}
function alta(){
	require './moduloactividad/modelos/actividadModelo.php';
	$entrenadores = buscarEntrenadores();
	require './moduloactividad/vistas/alta.php';
}
function buscar(){
	require './moduloactividad/vistas/buscar.php';
}
function eliminar(){
	require './moduloactividad/vistas/eliminar.php';
}
function modificar(){
	require './moduloactividad/modelos/actividadModelo.php';
	$entrenadores = buscarEntrenadores();
	require './moduloactividad/vistas/modificar.php';
}
if( isset($_POST['nombreActividad'])){
    require '../../moduloprincipal/conexion.php';
	require '../modelos/actividadModelo.php';
	altaItem($_POST['nombreActividad'],$_POST['precio'],$_POST['numhora'],$_POST['desc'],$_POST['entrenador']);
	header("Location: ../../index.php?controlador=actividad&accion=listar");
}
if(isset($_GET['idM'])){
	$id = $_GET['idM'];
	$nombre = $_GET['nombreActividad'];
	$precio = $_GET['precio'];
	$numhora = $_GET['numhora'];
	$desc = $_GET['desc'];
	$entrenador = $_GET['entrenador'];
    require '../../moduloprincipal/conexion.php';
	require '../modelos/actividadModelo.php';
	$obj = buscarActividad($_GET['idM']);
	
	if ($_GET['nombreActividad'] == "")
		$nombre = $obj->actividad;
	if ($_GET['precio'] == "")
		$precio = $obj->precio;
	if ($_GET['numhora'] == "")
		$numhora = $obj->numHoras;
	if ($_GET['desc'] == "")
		$desc = $obj->descripcion;
	if ($_GET['entrenador'] == 0)
		$entrenador = $obj->id_Entrenador;
	
	$resultado = modifica($id,$nombre,$precio,$numhora,$desc,$entrenador);
	echo $resultado;
}
if(isset($_GET['idE'])){
	$id = $_GET['idE'];
    require '../../moduloprincipal/conexion.php';
	require '../modelos/actividadModelo.php';
	$resultado = eliminarA($id);
	echo $resultado;
}
?>