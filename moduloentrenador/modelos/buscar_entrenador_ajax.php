<?php
require '../../moduloprincipal/conexion.php';

if($_GET["mas"]!=""){
	if($_GET["mas"]!="all")
		$mas="limit 0,".$_GET["mas"];
	else
		$mas="limit 0,100";
}else
	$mas="limit 0,10";

if($_GET["radio1"]=="true")
	$orden="desc";
else if($_GET["radio2"]=="true")
	$orden="asc";
else
	$orden="asc";
	
if($_GET["criterio_ord"]!="")
	$criterio_ord=$_GET['criterio_ord']; 
else
	$criterio_ord="id_Entrenador"; 
	
$sql="SELECT * FROM entrenador order by $criterio_ord ".$orden." ".$mas;
if($_GET["entrenador"]!=""){
	$text="%".$_GET["entrenador"]."%";
	$sql="SELECT * FROM entrenador where (id_Entrenador like '$text') or (nombre like '$text') order by $criterio_ord ".$orden." ".$mas;
}
else if($_GET["entrenador"]=="")//el us no introduce nada en el input text
	$sql = "select * from entrenador where id_Entrenador not LIKE '%'";

$cadena="";
try{
	@ $db = new mysqli($servidor, $usuario, $contrasenia);
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db($bd);
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
		
	$resultado= $db->query($sql);
	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);

	if ($resultado->num_rows > 0){
		$cadena.= '<br>';
			$cadena.= '<table border="1">';
			$cadena.='<tr>';
				$cadena.='<th>Entrenador</th>';
				$cadena.='<th>Nombre</th>';
				$cadena.='<th>Apellido</th>';
			$cadena.='</tr>';
			while ($obj = $resultado->fetch_object()){
				$cadena.='<tr class = "e">';
					$cadena.='<td align="left">'.$obj->id_Entrenador.'</td>';
					$cadena.='<td align="center">'.$obj->nombre.'</td>';
					$cadena.='<td align="center">'.$obj->apellido1.'</td>';
				$cadena.='</tr>';
			} 
			$cadena.='</table>';	
	}
	$resultado->free(); 
	$db->close(); 
}catch (Exception $e){
	echo $e->getMessage();
	if (mysqli_connect_errno() == 0)
		$db->close();
	exit();
}
echo utf8_encode($cadena);
?>
