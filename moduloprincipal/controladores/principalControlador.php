<?php
session_start();
ComprobarAdministrador();
echo '<div id = "sesionstart"><H4 align="right"> '.$_SESSION['userId'].' ('. $_SESSION['userType'].') <a href="./index.php?controlador=principal&accion=logout">Logout</a></H4></div>';
if(isset($_POST['usuari'])){
$usu = $_POST['usuari'];
$passw = $_POST['contra'];
    require '../conexion.php';
	require '../modelo.php';
	$resultado = buscar($usu, $passw);
	
	if ($resultado === "error")
		header("Location: ../../index.php?error=true");
	else{
		header("Location: ../../index.php?controlador=principal&accion=mostrar");
		}
}
function mostrar(){
//logout
	echo '<section></section>';
}
function ComprobarAdministrador(){
	if (!isset($_SESSION['userId']))
		header("Location: index.php?error=noadmin");
	if ($_SESSION['userType'] !== 'admin')
		header("Location: index.php?error=noadmin");
}
function logout(){
	if (isset ($_SESSION['userId'])){
		$_SESSION = array();
		session_destroy();
	}
	header("Location: index.php");
}

?>