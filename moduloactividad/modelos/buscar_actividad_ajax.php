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
	$criterio_ord="idActividad"; 
	
$sql="SELECT * FROM actividad order by $criterio_ord ".$orden." ".$mas;
if($_GET["nombre"]!=""){
	$nombre="%".$_GET["nombre"]."%";
	$sql="select actividad.idActividad, actividad.actividad, actividad.precio, actividad.numHoras, entrenador.nombre
	from actividad left join entrenador 
	ON actividad.id_Entrenador = entrenador.id_Entrenador
	where actividad.actividad like '".$nombre."' order by $criterio_ord ".$orden." ".$mas;
}
else if($_GET["nombre"]=="")//el us no introduce nada en el input text
	$sql = "select * from actividad where idActividad not LIKE '%'";
	
$cadena="";
try{
	@ $db = new mysqli($servidor, $usuario, $contrasenia);
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db($bd);
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
		
	$resultado = $db->query($sql);
	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);

	if ($resultado->num_rows > 0){
		$cadena.= '<table border="0">';
			$cadena.='<tr>';
				$cadena.='<th style="color:#00afff";>ID Actividad</th>';
				$cadena.='<th style="color:#00afff";>Actividad</th>';
				$cadena.='<th style="color:#00afff";>Entrenador</th>';
			$cadena.='</tr>';
			while ($obj = $resultado->fetch_object()){
				LimpiaResultados($obj);
				$cadena.='<tr>';
					$cadena.='<td align="center">'.$obj->idActividad.'</td>';
					$cadena.='<td align="center">'.$obj->actividad.'</td>';
					$cadena.='<td align="center">'.$obj->nombre.'</td>';
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
