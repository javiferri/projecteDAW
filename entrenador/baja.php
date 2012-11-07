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
	include('../estilo/head.html');
?>
<section>
<?php
if( (isset($_GET['id'])===false )&&(isset($_POST['modifica'])===false ) ) {
try{
	@ $db = new mysqli('localhost', 'root', 'root');
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db('gimnasio');
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
		
	$consulta = "select * from entrenador";
	$resultado = $db->query($consulta);
	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
	assert($resultado !== false);
	
	if ($resultado->num_rows > 0){
			echo '<table border="1">';
			echo'<tr>';
				echo'<th>ID</th>';
				echo'<th>Nombre</th>';
				echo'<th>Apellidos</th>';
			echo'</tr>';
			while ($obj = $resultado->fetch_object()){
				LimpiaResultados($obj);
				echo'<tr>';
					echo'<td align="center">'.$obj->id_Entrenador.'</td>';
					echo'<td align="center">'.$obj->nombre.'</td>';
					echo'<td align="center">'.$obj->apellido1.' '.$obj->apellido2.'</td>';
					echo'<td id = "modificar" align="center">'.'<a href="'. $_SERVER['PHP_SELF']."?id=".$obj->id_Entrenador .'">Eliminar</a>'.'</td>';
				echo'</tr>';
			}
			echo'</table>';
		}
	else echo '<p>No hay datos que mostrar</p>';
	$resultado->free(); 
	$db->close(); 
}catch (Exception $e){
	echo $e->getMessage();
	if (mysqli_connect_errno() == 0)
		$db->close();
	exit();
}
} else { 
	$id=$_GET['id'];

try{
	@ $db = new mysqli('localhost', 'root', 'root');
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db('gimnasio');
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);

	$consultaEntrenador = "select id_Entrenador from actividad where id_Entrenador=".$id."";
	$resultadoEntrenador = $db->query($consultaEntrenador);
	if ($resultadoEntrenador->num_rows > 0){
		echo "<p color = red;>El entrenador esta asociado a una o más actividades,</br> debes dar de baja al entrenador en la actividad/es.</p>";
		?>
			<p>[<a href="<?php echo $_SERVER['PHP_SELF'] ?>">Volver a Intentar</a>]</p>
		<?php
	}else{
	
	$consulta = "delete from entrenador where id_Entrenador=".$id."";
	if ($db->query($consulta) === false)
		throw new ExcepcionEnTransaccion();
	$db->commit();
	
	$consulta = "select * from entrenador";
	$resultado = $db->query($consulta);
	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
	assert($resultado !== false);

	if ($resultado->num_rows > 0){
			echo '<table border="1">';
			echo'<tr>';
				echo'<th>ID</th>';
				echo'<th>Nombre</th>';
				echo'<th>Apellidos</th>';
			echo'</tr>';
			while ($obj = $resultado->fetch_object()){
				LimpiaResultados($obj);
				echo'<tr>';
					echo'<td align="center">'.$obj->id_Entrenador.'</td>';
					echo'<td align="center">'.$obj->nombre.'</td>';
					echo'<td align="center">'.$obj->apellido1.' '.$obj->apellido2.'</td>';
				echo'</tr>';
			}
			echo'</table>';
		}
	else echo '<p>No hay datos que mostrar</p>';
	?>
	<p>[<a href="<?php echo $_SERVER['PHP_SELF'] ?>">Nueva Baja</a>]</p>
	<?php
	$resultado->free(); 
	$db->close(); 
	}
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
</section>
<?php 
		include('../estilo/pie.html');
?>
</body>
</html>