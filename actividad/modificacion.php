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
		
	$consulta = "select actividad.idActividad,actividad.actividad,entrenador.id_Entrenador ,entrenador.nombre
				from actividad left join entrenador 
				ON actividad.id_Entrenador = entrenador.id_Entrenador";
	$resultado = $db->query($consulta);
	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
	assert($resultado !== false);
	
	if ($resultado->num_rows > 0){
			echo '<table border="1">';
			echo'<tr>';
				echo'<th>ID</th>';
				echo'<th>Actividad</th>';
				echo'<th>Entrenador</th>';
			echo'</tr>';
			while ($obj = $resultado->fetch_object()){
				LimpiaResultados($obj);
				echo'<tr>';
					echo'<td align="center">'.$obj->idActividad.'</td>';
					echo'<td align="center">'.$obj->actividad.'</td>';
					echo'<td align="center">'.$obj->nombre.'</td>';
					echo'<td id = "modificar" align="center">'.'<a href="'. $_SERVER['PHP_SELF']."?id=".$obj->idActividad.'">Modificar</a>'.'</td>';
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
				<p>ID Actividad: <INPUT TYPE="text" NAME="id" SIZE="1" value="<?php echo $id ?>" readonly ></p>
				<p>Nombre: <INPUT TYPE="text" NAME="actividad" SIZE="20" MAXLENGTH="30"></p>
				<p>Precio: <INPUT TYPE="text" NAME="precio" SIZE="20" MAXLENGTH="30"></p>
				<p>Nomero Horas: <INPUT TYPE="text" NAME="horas" SIZE="20" MAXLENGTH="30"></p>
				<p>
				Entrenador:
				<select name="entrenador">
					<option value="ninguno" selected>Sin entrenador</option>
				<?php
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

					if ($resultado->num_rows > 0){
					while ($obj = $resultado->fetch_object()){
						LimpiaResultados($obj);
						echo '<option value="'.$obj->id_Entrenador.'">'.$obj->nombre.'</option>';
						}
					}
				?>			
				</select>
				</p>
		</br>
	<INPUT TYPE="submit" NAME="modifica" VALUE="Modifica">
</FORM>
<?php
} else { 
	$id=$_POST['id'];
	$actividad=$_POST['actividad'];
	$precio=$_POST['precio'];
	$horas=$_POST['horas'];
	$entrenador=$_POST['entrenador'];

try{
	@ $db = new mysqli('localhost', 'root', 'root');
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db('gimnasio');
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
	
	$consulta = "update actividad set 
	actividad='".$actividad."', precio='".$precio."',numHoras='".$horas."',id_Entrenador='".$entrenador."'
	where idActividad=".$id."";
	if ($db->query($consulta) === false)
		throw new ExcepcionEnTransaccion();
	$db->commit();
	
	$consulta = "select actividad.idActividad,actividad.actividad,entrenador.id_Entrenador ,entrenador.nombre
				from actividad left join entrenador 
				ON actividad.id_Entrenador = entrenador.id_Entrenador";
	$resultado = $db->query($consulta);
	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
	assert($resultado !== false);

	if ($resultado->num_rows > 0){
			echo '<table border="1">';
			echo'<tr>';
				echo'<th>ID</th>';
				echo'<th>Actividad</th>';
				echo'<th>Entrenador</th>';
			echo'</tr>';
			while ($obj = $resultado->fetch_object()){
				LimpiaResultados($obj);
				echo'<tr>';
					echo'<td align="center">'.$obj->idActividad.'</td>';
					echo'<td align="center">'.$obj->actividad.'</td>';
					echo'<td align="center">'.$obj->nombre.'</td>';
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