<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<section>
<div class="action">
<fieldset>
		  <legend>Listar Entrenador:</legend>
	<table>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>1r Apellido</th>
			<th>2n Apellido</th>
		</tr>
		<?php while ($obj = $items->fetch_object()){		
				LimpiaResultados($obj);
		?>
			<tr>
				<td><?php echo $obj->id_Entrenador?></td>
				<td><?php echo $obj->nombre?></td>
				<td><?php echo $obj->apellido1?></td>
				<td><?php echo $obj->apellido2?></td>
			</tr>
		<?php } ?>
	</table>
	</fieldset>
</div>
</section>


