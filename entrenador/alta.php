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
	
				<p>Nombre: </br><INPUT TYPE="text" NAME="nombre" SIZE="20" MAXLENGTH="30"></p>
				<p>Primer Apellido: </br><INPUT TYPE="text" NAME="papellido" SIZE="20" MAXLENGTH="30"></p>
				<p>Segundo Apellido: </br><INPUT TYPE="text" NAME="sapellido" SIZE="20" MAXLENGTH="30"></p>
				<p>Telefono: </br><INPUT TYPE="text" NAME="tele" SIZE="20" MAXLENGTH="30"></p>
				<p>
				Tipo Jornada:
				<select name="tipojornada">
						<option value="media" selected>Media</option>
						<option value="completa">Completa</option>
				</select>
				</p>

		<INPUT TYPE="submit" NAME="alta" VALUE="Alta">
	</form>

<?php
} else {
	$nombre=$_POST['nombre'];
	$pape=$_POST['papellido'];
	$sape=$_POST['sapellido'];
	$tele=$_POST['tele'];
	$tipojornada=$_POST['tipojornada'];

try{
	@ $db = new mysqli('localhost', 'root', 'root');
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db('gimnasio');
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
	
	$consulta = "insert into entrenador (nombre, apellido1, apellido2, telefono, jornadaCompleta) 
	values ('".$nombre."','".$pape."','".$sape."',".$tele.",'".$tipojornada."')";
	if ($db->query($consulta) === false)
		throw new ExcepcionEnTransaccion();
	$db->commit();
	
	$consulta = "select nombre, apellido1 from entrenador";
	$resultado = $db->query($consulta);
	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);

	if ($resultado->num_rows > 0){
			echo '<table border="1">';
			echo'<tr>';
				echo'<th>Nombre</th>';
				echo'<th>Primer Apellido</th>';
			echo'</tr>';
			while ($obj = $resultado->fetch_object()){
				LimpiaResultados($obj);
				echo'<tr>';
					echo'<td align="center">'.$obj->nombre.'</td>';
					echo'<td align="center">'.$obj->apellido1.'</td>';
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
