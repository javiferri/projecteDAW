<?php
$servidor = 'localhost';
$bd = 'gimnasio';
$usuario = 'root';
$contrasenia = 'root';

function LimpiaResultados($objeto){
	foreach ($objeto as $atributo => $valor)
		if(is_string($objeto->$atributo) === true)
			$objeto->$atributo = stripslashes($objeto->$atributo);
}
class ExcepcionEnTransaccion extends Exception{
	public function __construct(){}
}
?>