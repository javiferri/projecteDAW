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
if (isset($_POST['busca'])===false) {
?>
<section>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
		<p>Buscar Por:</p>
			<select name="criterio_ord">
				<option value="nombre" >Nombre Entrenador</option>
				<option value="apellido1" >Primer Apellido</option>
				<option value="jornadaCompleta" >Jornada</option>	
			</select>
			<INPUT TYPE="text" NAME="busqueda" SIZE="20" MAXLENGTH="30">
		<INPUT TYPE="submit" NAME="busca" VALUE="Buscar">
	</FORM>
</section>
<?php
} else {
$criterio=$_POST['criterio_ord'];
$dato=$_POST['busqueda'];

try{
	@ $db = new mysqli('localhost', 'root', 'root');
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db('gimnasio');
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
	
	if ($criterio === "nombre") {
	$consulta = "select * from entrenador
				where nombre = '".$dato."'";
	}else if ($criterio === "apellido1"){
	$consulta = "select * from entrenador
				where apellido1 = '".$dato."'";
	}else{
	$consulta = "select * from entrenador
				where jornadaCompleta = '".$dato."'";
	}
	$resultado = $db->query($consulta);
	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
	assert($resultado !== false);

	if ($resultado->num_rows > 0){
			echo '<table border="1">';
			echo'<tr>';
				echo'<th>Nombre</th>';
				echo'<th>Primer Apellido</th>';
				echo'<th>Segundo Apellido</th>';
				echo'<th>Jornada</th>';
			echo'</tr>';
			while ($obj = $resultado->fetch_object()){
				LimpiaResultados($obj);
				echo'<tr>';
					echo'<td align="center">'.$obj->nombre.'</td>';
					echo'<td align="center">'.$obj->apellido1.'</td>';
					echo'<td align="center">'.$obj->apellido2.'</td>';
					echo'<td align="center">'.$obj->jornadaCompleta.'</td>';
				echo'</tr>';
			}
			echo'</table>';
		}
	else
			echo '<p>No hay datos que mostrar</p>';
	?>
	<p>[<a href="<?php echo $_SERVER['PHP_SELF'] ?>">Nueva busqueda</a>]</p>
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
	<?php 
		include('../estilo/pie.html');
	?>
</body>
</html>