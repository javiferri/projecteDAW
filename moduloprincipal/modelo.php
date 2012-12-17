<?php
function buscar($usuari, $pass){
	global $servidor, $bd, $usuario, $contrasenia;
	try{
		$valida = "error";
		@ $db = new mysqli($servidor, $usuario, $contrasenia);
		if (mysqli_connect_errno() != 0)
			throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
		
		$db->select_db($bd);
		if ($db->errno != 0)
			throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
			
		$sql = "select * from usuarios where user= '".$usuari."' AND password = '".$pass."'";
		$resultado = $db->query($sql);
		if ($db->errno != 0)
			throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
		if ($resultado->num_rows > 0)
			$valida ="ok";
		$db->close(); 
	}catch (Exception $e){
		echo $e->getMessage();
		if (mysqli_connect_errno() == 0)
			$db->close();
		exit();
	}
		$obj = $resultado->fetch_object();
		$_SESSION['userId'] = $obj->user;
		$_SESSION['userType'] = $obj->tipo;
	return $valida;
}
function registrar($usere, $passw){
global $servidor, $bd, $usuario, $contrasenia;
$sql="insert into usuarios(user, password) values ('$usere', '$passw')";
$cadena="error";
try{
	@ $db = new mysqli($servidor, $usuario, $contrasenia);
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db($bd);
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
		
	$resultado = $db->query($sql);
	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
	$cadena="Usuario insertado con exito";
	$db->close(); 
}catch (Exception $e){
	echo "No se ha podido realizar el registro";
	if (mysqli_connect_errno() == 0)
		$db->close();
	exit();
}
echo $cadena;
}
function buscarUltimo($tabla, $campo){
	global $servidor, $bd, $usuario, $contrasenia;
	try{
		$valida = "error";
		@ $db = new mysqli($servidor, $usuario, $contrasenia);
		if (mysqli_connect_errno() != 0)
			throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
		
		$db->select_db($bd);
		if ($db->errno != 0)
			throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
			
		$sql = "SELECT * from $tabla where $campo = (SELECT max($campo) from $tabla)";
		$resultado = $db->query($sql);
		if ($db->errno != 0)
			throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
		if ($resultado->num_rows > 0)
			$valida ="ok";
		$db->close(); 
	}catch (Exception $e){
		echo $e->getMessage();
		if (mysqli_connect_errno() == 0)
			$db->close();
		exit();
	}
		$obj = $resultado->fetch_object();
		return $obj;
}
?>
