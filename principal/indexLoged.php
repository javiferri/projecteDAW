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

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
	<?php
	include('../estilo/head.html');
	?>
	<section>
			<div id ="novedades">
				<h1>Novedades: </h1>
				</br>
				<div class = "datosLog">
				
					<h3>Nuevo Entrenador</h3>
						<?php
						@ $db = new mysqli('localhost', 'root', 'root');
						if (mysqli_connect_errno() != 0)
							throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
					
						$db->select_db('gimnasio');
						if ($db->errno != 0)
							throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
							
							$consulta = "SELECT nombre, apellido1 FROM entrenador WHERE id_Entrenador = (SELECT MAX(id_Entrenador) FROM entrenador)";
							$resultado = $db->query($consulta);
							if ($db->errno != 0){
								throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
							}
							if ($resultado->num_rows > 0){
								while ($obj = $resultado->fetch_object()){
								echo'<b>'.$obj->nombre.' '.$obj->apellido1.'</b>';
								}
							}					
						?>

					<p class = "separador"></p>
					</br>
					<h3>Nueva Actividad</h3>
					<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
						<?php
							@ $db = new mysqli('localhost', 'root', 'root');
							if (mysqli_connect_errno() != 0)
								throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
						
							$db->select_db('gimnasio');
							if ($db->errno != 0)
								throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
								
							$consulta = "SELECT * FROM actividad WHERE idActividad = (SELECT MAX(id_Entrenador) FROM entrenador)";
							$resultado = $db->query($consulta);
							if ($db->errno != 0){
								throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
							}
							if ($resultado->num_rows > 0){
								while ($obj = $resultado->fetch_object()){
								echo'<b>'.$obj->actividad.'</b>';
								echo'<a href="'. $_SERVER['PHP_SELF']."?id=".$obj->idActividad .'" onclick="mostrar()">   [ Ver detalles ]</a>';
								}
							}
						?>
				</div>
			</div>			
			<?php
				if (isset($_GET['id'])===true){
					$id=$_GET['id'];
					@ $db = new mysqli('localhost', 'root', 'root');
						if (mysqli_connect_errno() != 0)
							throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
								
						$db->select_db('gimnasio');
						if ($db->errno != 0)
							throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
										
						$consulta = "SELECT * FROM actividad WHERE idActividad = ".$id."";
						$resultado = $db->query($consulta);
						if ($db->errno != 0){
							throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
						}
						if ($resultado->num_rows > 0){
							echo'<div id = "informacion1">';
								echo'<div class = "datosLog">';
									while ($obj = $resultado->fetch_object()){
									echo'<p><b>Actividad: </b><i>'.$obj->actividad.'</i></p>';
									echo'<p><b>Precio: </b><i>'.$obj->precio.'</i></p>';
									echo'<p><b>Horas por semana: </b><i>'.$obj->numHoras.'</i></p>';
									}
								echo '</div>';
							echo '</div>';
						}
				}
				?>
				
			</div>
		
	</section>
	<?php 
		include('../estilo/pie.html');
	?>
</body>
</html>