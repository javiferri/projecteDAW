<?php
require './moduloprincipal/conexion.php';
?>
<?php
$accionPredefinida = "mostrar";
	if(empty($_GET['controlador'])){
		require_once './moduloprincipal/vistas/html/headlogin.html';
		require_once './moduloprincipal/vistas/principal.php';
		if(!empty($_GET['error'])){
			if ($_GET['error'] === "true"){
				?>
				<script type='text/javascript'>
					var add = document.getElementById("resultados1");
					add.innerHTML = 'El user/password no son correctos';
				</script>
				<?php
			}else if ($_GET['error'] === "noadmin"){
				?>
				<script type='text/javascript'>
					var add = document.getElementById("resultados1");
					add.innerHTML = 'Necesitas ser ADMINISTRADOR';
				</script>
				<?php
			}
			
		}
		
	}else if(!empty($_GET['controlador'])){
			require_once './moduloprincipal/vistas/html/head.html';
			$controlador = $_GET['controlador'];
			if(! empty($_GET['accion']))
				  $accion = $_GET['accion'];
			else
				  $accion = $accionPredefinida;

			//Ya tenemos el controlador y la accion
			//La carpeta donde buscaremos los controladores
			$carpetaControladores = "./modulo".$controlador."/controladores/";
			//Formamos el nombre del fichero que contiene nuestro controlador
			$controlador = $carpetaControladores . $controlador . 'Controlador.php';

			//Incluimos el controlador o detenemos todo si no existe
			if(is_file($controlador)){
				  require_once $controlador;
				 
			}
			else
				  die('El controlador no existe - 404 not found');

			//Llamamos la accion o detenemos todo si no existe
			if(is_callable($accion))
				  $accion();
			else
				  die('La accion no existe - 404 not found');

	}

	?>
