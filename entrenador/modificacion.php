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
					echo'<td id = "modificar" align="center">'.'<a href="'. $_SERVER['PHP_SELF']."?id=".$obj->id_Entrenador.'">Modifica</a>'.'</td>';
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
} else if( (isset($_GET['id'])===true )&&(isset($_POST['modifica'])===false ) ) {
$id=$_GET['id'];
?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
				<p>ID Entrenador: <INPUT TYPE="text" NAME="id" SIZE="1" value="<?php echo $id ?>" readonly ></p>
				<p>Nombre: <INPUT TYPE="text" NAME="nombre" SIZE="20" MAXLENGTH="30"></p>
				<p>Primer Apellido: <INPUT TYPE="text" NAME="papellido" SIZE="20" MAXLENGTH="30"></p>
				<p>Segundo Apellido: <INPUT TYPE="text" NAME="sapellido" SIZE="20" MAXLENGTH="30"></p>
				<p>Telefono: <INPUT TYPE="text" NAME="tele" SIZE="20" MAXLENGTH="30"></p>
				<p>
				Jornada:
				<select name="moda">
					<option value="media" selected>Media</option>
					<option value="completa" selected>Completa</option>
				</select>
				</p>
				<p>
				Tipo Cliente:
				<select name="tipocliente">
						<option value="normal" selected="selected">Normal</option>
						<option value="VIP">VIP</option>
				</select>
				</p>
		</br>
	<INPUT TYPE="submit" NAME="modifica" VALUE="Modifica">
</FORM>
<?php
} else { 
	$id=$_POST['id'];
	$nombre=$_POST['nombre'];
	$pape=$_POST['papellido'];
	$sape=$_POST['sapellido'];
	$tele=$_POST['tele'];
	$moda=$_POST['moda'];

try{
	@ $db = new mysqli('localhost', 'root', 'root');
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db('gimnasio');
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
	
	$consulta = "update entrenador set 
	nombre='".$nombre."', apellido1='".$pape."',apellido2='".$sape."',telefono=".$tele.",jornadaCompleta='".$moda."' 
	where id_Cliente=".$id."";
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
	<p>[<a href="<?php echo $_SERVER['PHP_SELF'] ?>">Nueva modificacion</a>]</p>
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
</section>
<?php 
		include('../estilo/pie.html');
?>
</body>
</html>