<section>
<div class="action">
	<form action="./modulocliente/controladores/clienteControlador.php" method="POST" name="myform" id="myform">
	<fieldset>
		  <legend>Alta Cliente:</legend>
		<TABLE>
			<TR>
				<TD>Nombre:</TD>
				<TD><INPUT TYPE="text" NAME="nombreAlta" id="nombre"></TD>
				<TD><div id='myform_nombreAlta_errorloc' class="error_strings"></div></TD>
			</TR>
			<TR>
				<TD>Primer Apellido:</TD>
				<TD><INPUT TYPE="text" NAME="pape" id="apellido1"></TD>
				<TD><div id='myform_pape_errorloc' class="error_strings"></div></TD>
			</TR>
			<TR>
				<TD>Segundo Apellido:</TD>
				<TD><INPUT TYPE="text" NAME="sape" id="apellido2"></TD>
				<TD><div id='myform_sape_errorloc' class="error_strings"></div></TD>
			</TR>
			<TR>
				<TD>Direccion:</TD>
				<TD><INPUT TYPE="text" NAME="dire" id="dire"></TD>
				<TD><div id='myform_dire_errorloc' class="error_strings"></div></TD>
			</TR>
			<TR>
				<TD>Telefono:</TD>
				<TD><INPUT TYPE="text" NAME="tele" id="tele"></TD>
				<TD><div id='myform_tele_errorloc' class="error_strings"></div></TD>
			</TR>
			<TR>
				<TD>Fecha Nacimiento:</TD>
				<TD><INPUT TYPE="text" NAME="fecha" class="datepicker" id="fecha"></TD>
				<TD><div id='myform_fecha_errorloc' class="error_strings"></div></TD>
				
			</TR>
			<TR>
				<TD></TD>
				<TD><INPUT TYPE="submit" NAME="alta" VALUE="Alta"></TD>
			</TR>
			
		</TABLE>
		</fieldset>
	</form>
	<script language="javascript" src="./modulocliente/js/validaciones/alta.js" type="text/javascript"></script>
</div>
</section>