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
	include('../estilo/headlogin.html');
?>
	<section>
		<form name="formulario" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onSubmit="return valida()">
			<div id ="registroU">
				<h1>Registrarse: </h1>
				<div class = "datosLog">
					<p>Nombre de Usuario: </p><INPUT TYPE="text" NAME="usere" SIZE="20" MAXLENGTH="30"><h5 id="info"></h5>
					<p>Contrase&ntildea: </p><INPUT TYPE="password" NAME="passw" SIZE="20" MAXLENGTH="30"><h5 id="infop"></h5>
					<p>Tipo Usuario:
					<select name="tipousuario">
							<option value="normal" selected="selected">Normal</option>
							<option value="entrenador">Entrenador</option>
					</select>
					<h5>Depende de el tipo de usuario tendras unas opciones u otras.</h5>
					</p>
					<INPUT TYPE="submit" NAME="registro" VALUE="Registrar"/>
				</div>
			</div>
		</form>
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
			<div id="login">
			<h1>Login: </h1>
				<div class = "datosLog">
					<p>Usuario: <INPUT TYPE="text" NAME="usuari" SIZE="20" MAXLENGTH="30"></p>
					<p>Password: <INPUT TYPE="password" NAME="contra" SIZE="20" MAXLENGTH="30"></p>
					</br>
					<INPUT TYPE="submit" NAME="aceptar" VALUE="Aceptar"/>
				</div>
			</div>
		</form>
		</section>	
	
<?php
try{
	if(isset($_POST['registro'])===true){
		$user=$_POST['usere'];
		$pass=$_POST['passw'];
		$tipo=$_POST['tipousuario'];
			
				@ $db = new mysqli('localhost', 'root', 'root');
				if (mysqli_connect_errno() != 0)
					throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
				
				$db->select_db('gimnasio');
				if ($db->errno != 0)
					throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
				
				$consulta = "insert into usuarios (user, password, tipo) values ('".$user."','".$pass."','".$tipo."')";
				if ($db->query($consulta) === false)
					throw new ExcepcionEnTransaccion();
				$db->commit();
				
				$consulta = "select * from usuarios where user = '".$user."'";
				$resultado = $db->query($consulta);
				if ($db->errno != 0)
					throw new Exception('Error realizando consulta:'.$db->error, $db->errno);

				if ($resultado->num_rows > 0){
					?>
						<script type='text/javascript'>
							var add = document.getElementById("registroU");
							var para = document.createElement("h3");
							var node = document.createTextNode("Te has registrado de forma correcta");
							para.appendChild(node);
							add.appendChild(para);
						</script>
					<?php
				}
				?>
				<?php
				$resultado->free(); 
				$db->close(); 
			}
}catch (ExcepcionEnTransaccion $e){
				?>
						<script type='text/javascript'>
							var add = document.getElementById("registroU");
							var para = document.createElement("h3");
							var node = document.createTextNode("No se ha podido realizar el alta");
							para.appendChild(node);
							add.appendChild(para);
						</script>
				<?php
				$db->rollback();
				$db->close();
			}catch (Exception $e){
				echo $e->getMessage();
				if (mysqli_connect_errno() == 0)
					$db->close();
				exit();
			}

	
	if(isset($_POST['aceptar'])===true){

		$usuari=$_POST['usuari'];
		$contra=$_POST['contra'];
		
			try{
				@ $db = new mysqli('localhost', 'root', 'root');
				if (mysqli_connect_errno() != 0)
					throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
				
				$db->select_db('gimnasio');
				if ($db->errno != 0)
					throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
				
				$consulta = "select user, password from usuarios where user= '".$usuari."' AND password = '".$contra."'";
				$resultado = $db->query($consulta);
				if ($db->errno != 0)
					throw new Exception('Error realizando consulta:'.$db->error, $db->errno);

				if ($resultado->num_rows > 0){
							header("Location:../principal/indexLoged.php");
				}else {
					?>
						<script type='text/javascript'>
							var add = document.getElementById("login");
							var para = document.createElement("h3");
							var node = document.createTextNode("El usuario/password no son correctos");
							para.appendChild(node);
							add.appendChild(para);
						</script>
					<?php
				}

				$resultado->free(); 
				$db->close(); 
				}catch (ExcepcionEnTransaccion $e){
					echo 'No se ha podido realizar al alta';
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
	<?php 
		include('../estilo/pie.html');
	?>
</body>
</html>