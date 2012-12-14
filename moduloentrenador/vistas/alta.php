<section>
<div class="action">
<fieldset>
		  <legend>Alta Entrenador:</legend>
	<form action="./moduloentrenador/controladores/entrenadorControlador.php" method="POST" name="myform" id="myform">
		<TABLE>
			<TR>
				<TD>Nombre:</TD>
				<TD><INPUT TYPE="text" NAME="nombreAlta" id="nombre"><b id="rnombre"></br></TD>
				<TD><div id='myform_nombreAlta_errorloc' class="error_strings"></div></TD>
			</TR>
			<TR>
				<TD>Primer Apellido:</TD>
				<TD><INPUT TYPE="text" NAME="pape" id="apellido1"><b id="rapellido1"></br></TD>
				<TD><div id='myform_pape_errorloc' class="error_strings"></div></TD>
			</TR>
			<TR>
				<TD>Segundo Apellido:</TD>
				<TD><INPUT TYPE="text" NAME="sape" id="apellido2"><b id="rapellido2"></br></TD>
				<TD><div id='myform_sape_errorloc' class="error_strings"></div></TD>
			</TR>
			<TR>
				<TD>Telefono:</TD>
				<TD><INPUT TYPE="text" NAME="tele" id="tele"><b id="rtelefono"></br></TD>
				<TD><div id='myform_tele_errorloc' class="error_strings"></div></TD>
			</TR>
			<TR>
				<TD>Tipo Jornada:</TD>
				<TD>
				<select name="tipojornada">
					<option value="media" selected>Media</option>
					<option value="completa">Completa</option>
				</select>
				</TD>
			</TR>
			<TR>
				<TD></TD>
				<TD><INPUT TYPE="submit" NAME="alta" VALUE="Alta"></TD>
			</TR>
			
		</TABLE>
	</form>
	</fieldset>
	</div>
</section>
<script language="javascript" src="./moduloentrenador/js/validaciones/alta.js" type="text/javascript"></script>