<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<section>
<div class="action">
<fieldset>
		  <legend>Listar Actividad:</legend>
	<table>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Horas Semana</th>
			<th>Entrenador</th>
		</tr>
		<?php while ($obj = $items->fetch_object()){		
				LimpiaResultados($obj);
		?>
			<tr>
				<td><?php echo $obj->idActividad?></td>
				<td><?php echo $obj->actividad?></td>
				<td><?php echo $obj->precio?></td>
				<td><?php echo $obj->numHoras?></td>
				<td><?php echo $obj->nombre?></td>
			</tr>
		<?php } ?>
	</table>
	</fieldset>
</div>
</section>


