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
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Alta de clientes</title>
</head>
<body>
<?php 
		include('../estilo/head.html');
?>
<section>
<?php
	if (isset($_POST['alta'])===false) {
?>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
	
				<p>Nombre Actividad: </br><INPUT TYPE="text" NAME="actividad" SIZE="20" MAXLENGTH="30"></p>
				<p>Precio: </br><INPUT TYPE="text" NAME="precio" SIZE="20" MAXLENGTH="30"></p>
				<p>Numero de Horas: </br><INPUT TYPE="text" NAME="numhoras" SIZE="20" MAXLENGTH="30"></p>
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

		<INPUT TYPE="submit" NAME="alta" VALUE="Alta">
	</form>

<?php
} else {
	$actividad=$_POST['actividad'];
	$precio=$_POST['precio'];
	$horas=$_POST['numhoras'];
	$entrenador=$_POST['entrenador'];

try{
	@ $db = new mysqli('localhost', 'root', 'root');
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db('gimnasio');
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
	
	if($entrenador != 'ninguno'){
	$consulta = "insert into actividad (actividad, precio, numHoras, id_Entrenador) 
	values ('".$actividad."',".$precio.",".$horas.",'".$entrenador."')";
	}else{
	$consulta = "insert into actividad (actividad, precio, numHoras) 
	values ('".$actividad."',".$precio.",".$horas.")";
	}
	if ($db->query($consulta) === false)
		throw new ExcepcionEnTransaccion();
	$db->commit();
	
	$consulta = "select actividad.idActividad,actividad.actividad,entrenador.id_Entrenador ,entrenador.nombre
				from actividad left join entrenador 
				ON actividad.id_Entrenador = entrenador.id_Entrenador";
	$resultado = $db->query($consulta);

	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);

	if ($resultado->num_rows > 0){
			echo '<table border="1">';
			echo'<tr>';
				echo'<th>ID Actividad</th>';
				echo'<th>Nombre Actividad</th>';
				echo'<th>ID Entrenador</th>';
				echo'<th>Nombre Entrenador</th>';
			echo'</tr>';
			while ($obj = $resultado->fetch_object()){
				LimpiaResultados($obj);
				echo'<tr>';
					echo'<td align="center">'.$obj->idActividad.'</td>';
					echo'<td align="center">'.$obj->actividad.'</td>';
					echo'<td align="center">'.$obj->id_Entrenador.'</td>';
					echo'<td align="center">'.$obj->nombre.'</td>';
				echo'</tr>';
			}
			echo'</table>';
		}
	else echo '<p>No hay datos que mostrar</p>';
	?>
	<p>[<a href="<?php echo $_SERVER['PHP_SELF'] ?>">Nueva alta</a>]
	[<a href="../principal/indexLoged.php">Ir a Principal</a>]</p>
	<?php
	$resultado->free(); 
	$db->close(); 
}catch (ExcepcionEnTransaccion $e){
	echo 'No se ha podido realizar al alta';
	?>
	<p>[<a href="<?php echo $_SERVER['PHP_SELF'] ?>">Volver a intentar</a>]</p>
	<?php
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
