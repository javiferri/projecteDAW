<?php

function LimpiaResultados($objeto){
	foreach ($objeto as $atributo => $valor)
		if(is_string($objeto->$atributo) === true)
			$objeto->$atributo = stripslashes($objeto->$atributo);
}
class ExcepcionEnTransaccion extends Exception{
	public function __construct(){}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<?php
	if (isset($_POST['registro'])===false) {
?>


<?php
} else {
	$user=$_POST['user'];
	$pass=$_POST['passw'];
	$tipo=$_POST['tipousuario'];

try{
	@ $db = new mysqli('localhost', 'root', 'root');
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db('gimnasio');
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
	
	$consulta = "insert into usuarios (user, password, tipo) values ('$user','$pass','$tipo')";
	if ($db->query($consulta) === false)
		throw new ExcepcionEnTransaccion();
	$db->commit();
	
	$consulta = "select * from usuarios where user = '$user'";
	$resultado = $db->query($consulta);
	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);

	if ($resultado->num_rows > 0){

			while ($obj = $resultado->fetch_object()){
				LimpiaResultados($obj);
				
					echo'<p><b>User: </b>'.$obj->user.'</p>';
					echo'<p><b>Password: </b>'.$obj->password.'</p>';
					echo'<p><b>Tipo de Usuario: </b>'.$obj->tipo.'</p>';
					echo'</br>';
					echo'<p><a href="../principal/index.php">VOLER AL LOGIN</a></p>';
			}
		}
	else echo '<p>No hay datos que mostrar</p>';
	?>
	<?php
	$resultado->free(); 
	$db->close(); 
}catch (ExcepcionEnTransaccion $e){
	echo 'No se ha podido realizar al alta';
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
