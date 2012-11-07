<?php
function LimpiaResultados($objeto){
	foreach ($objeto as $atributo => $valor)
		if(is_string($objeto->$atributo) === true)
			$objeto->$atributo = stripslashes($objeto->$atributo);
}

$idcliente=$_GET['idcliente'];
if($idcliente==="")//el us no introduce nada en el input
	$consulta = "select * from clientes where id_Cliente not LIKE '%'";
	//si el us no introduce nada en el input -> la consulta sería 
	//select id, textoPregunta from encuesta where id  LIKE '%' que muestra todos los registros de la tabla
	//queremos que si el us no introduce nada en el input, no mostraremos nada en ajax ->
	//select id, textoPregunta from encuesta where id not LIKE '%'
else
	$consulta = "select * from clientes where id_Cliente LIKE '".$idcliente."%'";
	$cadena="";
try{
	@ $db = new mysqli('localhost', 'root', 'root');
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db('gimnasio');
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
		
	$resultado = $db->query($consulta);
	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);

	if ($resultado->num_rows > 0){
		$cadena.= '<table border="0">';
			$cadena.='<tr>';
				$cadena.='<th style="color:#00afff";>IDENCUESTA</th>';
				$cadena.='<th style="color:#00afff";>TEXTOPREGUNTA</th>';
			$cadena.='</tr>';
			while ($obj = $resultado->fetch_object()){
				LimpiaResultados($obj);
				$cadena.='<tr>';
					$cadena.='<td align="center">'.$obj->id_Cliente.'</td>';
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
