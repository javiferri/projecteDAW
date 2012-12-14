<script type="text/javascript" src="./moduloprincipal/js/utilidades.js"></script>
<h3>Modificar Cliente.</h3>
<form id="form1" name="form1" method="get" action="" onsubmit="return false;">
	<TABLE align="center" cellspacing="10" cellpadding="10">
		<TR>
			<TD>Nombre:</TD>
			<TD><INPUT TYPE="text" NAME="nombreModifi" id="nombreModifi" SIZE="20" MAXLENGTH="60"></TD>
		</TR>
		<TR>
			<TD>Primer Apellido:</TD>
			<TD><INPUT TYPE="text" NAME="pape" id="pape" SIZE="20" MAXLENGTH="60"></TD>
		</TR>
		<TR>
			<TD>Segundo Apellido:</TD>
			<TD><INPUT TYPE="text" NAME="sape" id="sape" SIZE="20" MAXLENGTH="60"></TD>
		</TR>
		<TR>
			<TD>Direccion:</TD>
			<TD><INPUT TYPE="text" NAME="dire" id="dire" SIZE="20" MAXLENGTH="60"></TD>
		</TR>
		<TR>
			<TD>Telefono:</TD>
			<TD><INPUT TYPE="text" NAME="tele" id="tele" SIZE="20" MAXLENGTH="60"></TD>
		</TR>
		<TR>
			<TD>Fecha Nacimiento:</TD>
			<TD><INPUT TYPE="text" NAME="fecha" class="datepicker"></TD>
		</TR>
		<TR>
			<TD colspan="2"><INPUT TYPE="submit" NAME="actualizar" VALUE="Actualizar" onclick="modificar()"/></TD>
		</TR>
	</TABLE>
</form>
