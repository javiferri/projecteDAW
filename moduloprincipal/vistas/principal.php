<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50c1f42128221901"></script>
<section>
		<div id= "registro" style="display:none;"></div>
		<div id="login">
		<form name="formulario" action="./moduloprincipal/controladores/principalControlador.php" method="POST">
			<h1>Login: </h1>
				<div class = "datosLog">
					<p>Usuario: <INPUT TYPE="text" NAME="usuari" SIZE="20" MAXLENGTH="30"></p>
					<p>Password: <INPUT TYPE="password" NAME="contra" SIZE="20" MAXLENGTH="30"></p>

					<h5><div id="resultados1"></div></h5>
					</br>
					<INPUT TYPE="submit" NAME="aceptar" VALUE="Aceptar"/></br>
					<a href="#" onclick="addRegistro();" >Registrarse</a>
				</div>
		</form>
			
		<!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
			<h3>Compartir Esta Aplicación</h3>
			<a class="addthis_button_preferred_1"></a>
			<a class="addthis_button_preferred_2"></a>
			<a class="addthis_counter addthis_bubble_style"></a>
			</div>
		<!-- AddThis Button END -->
		</div>
</section>