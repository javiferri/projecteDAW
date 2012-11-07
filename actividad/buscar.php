<?php 
function LimpiaResultados($objeto){
	foreach ($objeto as $atributo => $valor)
		if(is_string($objeto->$atributo) === true)
			$objeto->$atributo = stripslashes($objeto->$atributo);
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<?php
	include('../estilo/head.html');
?>
<?php

?>
<section>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
		<p>Buscar Por:</p>
			<select name="criterio_ord">
				<option value="actividad" >Nombre Actividad</option>
				<option value="id_Entrenador" >Nombre Entrenador</option>		
			</select>
			<INPUT TYPE="text" NAME="busqueda" SIZE="20" MAXLENGTH="30">
		<INPUT TYPE="submit" NAME="busca" VALUE="Buscar">
	</form>
<?php
if (isset($_POST['busca'])===true) {
$criterio=$_POST['criterio_ord'];
$dato=$_POST['busqueda'];

try{
	@ $db = new mysqli('localhost', 'root', 'root');
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db('gimnasio');
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
	
	if ($criterio === "actividad") {
	$consulta = "select actividad.actividad, actividad.precio, actividad.numHoras, entrenador.nombre
				from actividad left join entrenador 
				ON actividad.id_Entrenador = entrenador.id_Entrenador
				where actividad.actividad = '".$dato."'";
	}else{
	$consulta = "select actividad.actividad, actividad.precio, actividad.numHoras, entrenador.nombre
				from actividad left join entrenador 
				ON actividad.id_Entrenador = entrenador.id_Entrenador
				where entrenador.nombre = '".$dato."'";
	}
	$resultado = $db->query($consulta);
	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
	assert($resultado !== false);

	if ($resultado->num_rows > 0){
			echo '<table border="1">';
			echo'<tr>';
				echo'<th>Actividad</th>';
				echo'<th>Precio</th>';
				echo'<th>Horas Por Semana</th>';
				echo'<th>Entrenador</th>';
			echo'</tr>';
			while ($obj = $resultado->fetch_object()){
				LimpiaResultados($obj);
				echo'<tr>';
					echo'<td align="center">'.$obj->actividad.'</td>';
					echo'<td align="center">'.$obj->precio.'</td>';
					echo'<td align="center">'.$obj->numHoras.'</td>';
					echo'<td align="center">'.$obj->nombre.'</td>';
				echo'</tr>';
			}
			echo'</table>';
		}
	else
			echo '<p>No hay datos que mostrar</p>';
	?>
	<?php
	$resultado->free(); 
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