<?php 
function LimpiaResultados($objeto){
	foreach ($objeto as $atributo => $valor)
		if(is_string($objeto->$atributo) === true)
			$objeto->$atributo = stripslashes($objeto->$atributo);
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Ordenar encuestas</title>
</head>
<body>
<?php 
		include('../estilo/head.html');
?>
<section>
<?php

?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
	<p>Ordena por: </br>
	<select name="criterio_ord">
			<option value="idActividad" >idActividad</option>	
			<option value="actividad" >Nombre Actividad</option>
			<option value="precio" >Precio</option>
			<option value="numHoras" >Numero Horas</option>		
	</select>
	</p>
	</br>
	<INPUT TYPE="submit" NAME="ordena" VALUE="Ordena">
</FORM>
<?php
if (isset($_POST['ordena'])===true) {
$criterio_ord=$_POST['criterio_ord']; 
try{
	@ $db = new mysqli('localhost', 'root', 'root');
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db('gimnasio');
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
		
	$consulta = "select * from actividad order by ".$criterio_ord;
	$resultado = $db->query($consulta);
	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
	assert($resultado !== false);

	if ($resultado->num_rows > 0){
			echo '<table border="1">';
			echo'<tr>';
				echo'<th>ID Actividad</th>';
				echo'<th>Nombre Actividad</th>';
				echo'<th>Precio</th>';
				echo'<th>Numero Horas</th>';
			echo'</tr>';
			while ($obj = $resultado->fetch_object()){
				LimpiaResultados($obj);
				echo'<tr>';
					echo'<td align="center">'.$obj->idActividad.'</td>';
					echo'<td align="center">'.$obj->actividad.'</td>';
					echo'<td align="center">'.$obj->precio.'</td>';
					echo'<td align="center">'.$obj->numHoras.'</td>';
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
