<?php
if(isset($_GET['usere'])){
$usu = $_GET['usere'];
$passw = $_GET['passw'];
require '../conexion.php';
require '../modelo.php';
$resultado = registrar($usu, $passw);
}
?>