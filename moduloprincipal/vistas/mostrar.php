<section>
	<div id="new1">
		<H1>NOVEDADES</H1>
		<div class="flip" onclick="mostrar(panel);"><b><a href="#">ACTIVIDAD NUEVA</a></b></div>
		<div id="panel" style="display:none;">
			<p><b>ID: </b><?php echo $actividad->idActividad ?></p>
			<p><b>Actividad: </b><?php echo $actividad->actividad ?></p>
			<p><b>Precio: </b><?php echo $actividad->precio ?>
			<p><b>Horas: </b><?php echo $actividad->numHoras ?>
		</div>
		<div class="flip" onclick="mostrar(panel2);"><b><a href="#">CLIENTE NUEVO</a></b></div>
		<div id="panel2" style="display:none;">
			<p><b>ID: </b><?php echo $cliente->id_Cliente ?></p>
			<p><b>Nombre: </b><?php echo $cliente->nombre ?></p>
			<p><b>Apellidos: </b><?php echo $cliente->apellido1 ?>
			<?php echo $cliente->apellido2 ?></p>
		</div>
		<div class="flip" onclick="mostrar(panel3);"><b><a href="#">ENTRENADOR NUEVO</a></b></div>
		<div id="panel3" style="display:none;">
			<p><b>ID: </b><?php echo $entrenador->id_Entrenador ?></p>
			<p><b>Nombre: </b><?php echo $entrenador->nombre ?></p>
			<p><b>Apellidos: </b><?php echo $entrenador->apellido1 ?>
			<?php echo $entrenador->apellido2 ?></p>
		</div>
	</div>
</section>