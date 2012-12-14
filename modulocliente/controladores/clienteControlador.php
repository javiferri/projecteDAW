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
	require './modulocliente/modelos/clienteModelo.php';
	$items = buscarTodosLosItems();
	require './modulocliente/vistas/listar.php';
}
function alta(){
	require './modulocliente/vistas/alta.php';
}
function buscar(){
	require './modulocliente/vistas/buscar.html';
}
function apuntarse(){
	require './modulocliente/modelos/clienteModelo.php';
	$actividades = buscarActividades();
	require './modulocliente/vistas/apuntarseA.php';
}
function eliminar(){
	require './modulocliente/vistas/eliminar.php';
}
function modificar(){
	require './modulocliente/vistas/modificar.php';
}
if( isset($_POST['nombreAlta'])  ){
    require '../../moduloprincipal/conexion.php';
	require '../modelos/clienteModelo.php';
	altaItem($_POST['nombreAlta'],$_POST['pape'],$_POST['sape'],$_POST['dire'],$_POST['tele'],$_POST['fecha']);
	$items = buscarTodosLosItems();
	header("Location: ../../index.php?controlador=cliente&accion=listar");
}
if(isset($_GET['idM'])){
	$id = $_GET['idM'];
	$nombre = $_GET['nombreModifi'];
	$pape = $_GET['pape'];
	$sape = $_GET['sape'];
	$dire = $_GET['dire'];
	$tele = $_GET['tele'];
	$fecha = $_GET['fecha'];
    require '../../moduloprincipal/conexion.php';
	require '../modelos/clienteModelo.php';
	$obj = buscarCliente($_GET['idM']);
	
	if ($_GET['nombreModifi'] == "")
		$nombre = $obj->nombre;
	if ($_GET['pape'] == "")
		$pape = $obj->apellido1;
	if ($_GET['sape'] == "")
		$sape = $obj->apellido2;
	if ($_GET['dire'] == "")
		$dire = $obj->direccion;
	if ($_GET['tele'] == "")
		$tele = $obj->telefono;
	if ($_GET['fecha'] == "")
		$fecha = $obj->fecha;
		
	$resultado = modifica($id,$nombre,$pape,$sape,$dire,$tele,$fecha);
	echo $resultado;
}
if(isset($_GET['idE'])){
	$id = $_GET['idE'];
    require '../../moduloprincipal/conexion.php';
	require '../modelos/clienteModelo.php';
	$resultado = eliminarC($id);
	echo $resultado;
}
if(isset($_GET['idCA'])){
    require '../../moduloprincipal/conexion.php';
	require '../modelos/clienteModelo.php';
	$resultado = altaActividades($_GET['idCA'],$_GET['actividad1'],$_GET['actividad2']);
	echo $resultado;
}

?>