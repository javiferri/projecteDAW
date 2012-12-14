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
	require './moduloentrenador/modelos/entrenadorModelo.php';
	$items = buscarTodosLosItems();
	require './moduloentrenador/vistas/listar.php';
}
function alta(){
	require './moduloentrenador/vistas/alta.php';
}
function buscar(){
	require './moduloentrenador/vistas/buscar.php';
}
function eliminar(){
	require './moduloentrenador/vistas/eliminar.php';
}
function modificar(){
	require './moduloentrenador/vistas/modificar.php';
}
if( isset($_POST['nombreAlta'])){
    require '../../moduloprincipal/conexion.php';
	require '../modelos/entrenadorModelo.php';
	altaItem($_POST['nombreAlta'],$_POST['pape'],$_POST['sape'],$_POST['tele'],$_POST['tipojornada']);
	header("Location: ../../index.php?controlador=entrenador&accion=listar");
}
if(isset($_GET['idM'])){
	$id = $_GET['idM'];
	$nombre = $_GET['nombreModifi'];
	$pape = $_GET['pape'];
	$sape = $_GET['sape'];
	$tele = $_GET['tele'];
	$tipojornada = $_GET['tipojornada'];
    require '../../moduloprincipal/conexion.php';
	require '../modelos/entrenadorModelo.php';
	$obj = buscarEntrenador($_GET['idM']);
	
	if ($_GET['nombreModifi'] == "")
		$nombre = $obj->nombre;
	if ($_GET['pape'] == "")
		$pape = $obj->apellido1;
	if ($_GET['sape'] == "")
		$sape = $obj->apellido2;
	if ($_GET['tele'] == "")
		$tele = $obj->telefono;
		
	$resultado = modifica($id,$nombre,$pape,$sape,$tele,$tipojornada);
	echo $resultado;
}
if(isset($_GET['idE'])){
	$id = $_GET['idE'];
    require '../../moduloprincipal/conexion.php';
	require '../modelos/entrenadorModelo.php';
	$resultado = eliminarC($id);
	echo $resultado;
}

?>