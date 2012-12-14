<?php
function buscarTodosLosItems(){
	global $servidor, $bd, $usuario, $contrasenia;
	try{
		@ $db = new mysqli($servidor, $usuario, $contrasenia);
		if (mysqli_connect_errno() != 0)
			throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
		
		$db->select_db($bd);
		if ($db->errno != 0)
			throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
			
		$resultado = $db->query('SELECT * FROM entrenador');
		if ($db->errno != 0)
			throw new Exception('Error realizando consulta:'.$db->error, $db->errno); 
		$db->close(); 
	}catch (Exception $e){
		echo $e->getMessage();
		if (mysqli_connect_errno() == 0)
			$db->close();
		exit();
	}	
	return $resultado;
}
function buscarEntrenador($id){
	global $servidor, $bd, $usuario, $contrasenia;
	try{
		@ $db = new mysqli($servidor, $usuario, $contrasenia);
		if (mysqli_connect_errno() != 0)
			throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
		
		$db->select_db($bd);
		if ($db->errno != 0)
			throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
			
		$resultado = $db->query('SELECT * FROM entrenador where id_Entrenador = '.$id.'');
		if ($db->errno != 0)
			throw new Exception('Error realizando consulta:'.$db->error, $db->errno); 
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
function altaItem($nom,$pape,$sape,$tele,$tipojornada){
	global $servidor, $bd, $usuario, $contrasenia;
	try{
		@ $db = new mysqli($servidor, $usuario, $contrasenia);
		if (mysqli_connect_errno() != 0)
			throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
			
		$db->select_db($bd);
		if ($db->errno != 0)
			throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
			
		$consulta = "insert into entrenador (nombre, apellido1, apellido2, telefono, jornadaCompleta) 
		values ('".$nom."','".$pape."','".$sape."',".$tele.",'".$tipojornada."')";
		if ($db->query($consulta) === false)
			throw new ExcepcionEnTransaccion();
		echo 'Se ha realizar el alta con exito';
		$db->commit();
		$db->close();
		
	}catch (ExcepcionEnTransaccion $e){
		echo 'No se ha podido realizar el alta';
		$db->rollback();
		$db->close();
	}catch (Exception $e){
		echo $e->getMessage();
		if (mysqli_connect_errno() == 0)
			$db->close();
		exit();
	}
}
function modifica($id,$nom,$pape,$sape,$tele,$tipojornada){
	global $servidor, $bd, $usuario, $contrasenia;
	try{
		@ $db = new mysqli($servidor, $usuario, $contrasenia);
		if (mysqli_connect_errno() != 0)
			throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
			
		$db->select_db($bd);
		if ($db->errno != 0)
			throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
		
		$consulta = "update entrenador set 
		nombre='".$nom."', apellido1='".$pape."',apellido2='".$sape."',telefono=".$tele.",jornadaCompleta='".$tipojornada."'
		where id_Entrenador='".$id."'";
		if ($db->query($consulta) === false)
			throw new ExcepcionEnTransaccion();
		$error = "Usuario modificado correctamente";
		return $error;
		$db->commit();
		$db->close();
		
	}catch (ExcepcionEnTransaccion $e){
		$error = "No se ha podido realizar la Modificacion";
		return $error;
		$db->rollback();
		$db->close();
	}catch (Exception $e){
		echo $e->getMessage();
		if (mysqli_connect_errno() == 0)
			$db->close();
		exit();
	}	
}
function eliminarC($id){
	global $servidor, $bd, $usuario, $contrasenia;
	try{
		@ $db = new mysqli($servidor, $usuario, $contrasenia);
		if (mysqli_connect_errno() != 0)
			throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
			
		$db->select_db($bd);
		if ($db->errno != 0)
			throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
		
		$consulta = "delete from entrenador where id_Entrenador='".$id."'";
		if ($db->query($consulta) === false)
			throw new ExcepcionEnTransaccion();
		$error = "Entrenador eliminado correctamente";
		$error.=eliminarEA($id);
		return $error;
		$db->commit();
		$db->close();
		
	}catch (ExcepcionEnTransaccion $e){
		$error = "No se ha podido eliminar el entrenador";
		return $error;
		$db->rollback();
		$db->close();
	}catch (Exception $e){
		echo $e->getMessage();
		if (mysqli_connect_errno() == 0)
			$db->close();
		exit();
	}	
}
function eliminarEA($id){
	global $servidor, $bd, $usuario, $contrasenia;
	try{
		@ $db = new mysqli($servidor, $usuario, $contrasenia);
		if (mysqli_connect_errno() != 0)
			throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
			
		$db->select_db($bd);
		if ($db->errno != 0)
			throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
		
		$consulta = "update actividad set 
		id_Entrenador=0
		where id_Entrenador='".$id."'";
		if ($db->query($consulta) === false)
			throw new ExcepcionEnTransaccion();
		$error = 'Se ha dado de baja el entrenador '.$id.' de las actividades que impartia';
		return $error;
		$db->commit();
		$db->close();
		
	}catch (ExcepcionEnTransaccion $e){
		$error = "No se ha podido dar de baja a el entrenador" + $id;
		return $error;
		$db->rollback();
		$db->close();
	}catch (Exception $e){
		echo $e->getMessage();
		if (mysqli_connect_errno() == 0)
			$db->close();
		exit();
	}	
}
?>
