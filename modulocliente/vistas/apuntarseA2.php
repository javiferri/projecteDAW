<?php require '../../moduloprincipal/conexion.php'; require '../modelos/clienteModelo.php'; ?>

<script language="javascript" src="./modulocliente/js/apuntar_cliente.js" type="text/javascript"></script>
<form id="form1" name="form1" method="get" action="" onsubmit="return false;">
<table>
	<th>
	<?php
	$actividades = buscarActividades();
	while ($obj = $actividades->fetch_object()){
			LimpiaResultados($obj);
	
	?>
		<tr>
			<td><input type="checkbox" onclick="guardar(<?php echo $obj->idActividad ?>)"><?php echo $obj->actividad?></td>
		</tr>
	<?php } ?>
		<tr>

			<td><input type="submit" onclick="apuntarse()" value="Apuntarse"></input></td>
		</tr>
			
	</th>
</form>
</table>