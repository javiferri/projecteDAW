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
if (isset($_POST['ordena'])===false) {
?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
	<p>Ordena por: 
	<select name="criterio_ord">
			<option value="id_Cliente" >ID Cliente</option>	
			<option value="nombre" >Nombre</option>
			<option value="edad" >Edad</option>		
	</select>
	</p>
	</br>
	<INPUT TYPE="submit" NAME="ordena" VALUE="Ordena">
</FORM>
<?php
} else {
$criterio_ord=$_POST['criterio_ord']; 
try{
	@ $db = new mysqli('localhost', 'root', 'root');
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db('gimnasio');
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
		
	$consulta = "select * from clientes order by ".$criterio_ord;
	$resultado = $db->query($consulta);
	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
	assert($resultado !== false);

	if ($resultado->num_rows > 0){
			echo '<table border="1">';
			echo'<tr>';
				echo'<th>ID Cliente</th>';
				echo'<th>Nombre</th>';
				echo'<th>Edad</th>';
			echo'</tr>';
			while ($obj = $resultado->fetch_object()){
				LimpiaResultados($obj);
				echo'<tr>';
					echo'<td align="center">'.$obj->id_Cliente.'</td>';
					echo'<td align="center">'.$obj->nombre.'</td>';
					echo'<td align="center">'.$obj->edad.'</td>';
				echo'</tr>';
			}
			echo'</table>';
		}
	else
			echo '<p>No hay datos que mostrar</p>';
	?>
	<p>[<a href="<?php echo $_SERVER['PHP_SELF'] ?>">Ordenar de Nuevo</a>]</p>
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
