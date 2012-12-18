<script language="javascript" src="./moduloprincipal/utilidades/nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<section>
<div class="action">
	<form action="./moduloactividad/controladores/actividadControlador.php" method="POST"  name="myform" id="myform">
		 <fieldset>
		  <legend>Alta Actividad:</legend>
		<TABLE>
			<TR>
				<TD>Nombre Actividad:</TD>
				<TD><div id='myform_nombreActividad_errorloc' class="error_strings"></div>
				<INPUT TYPE="text" NAME="nombreActividad" id="nombre"><b id="rnombre"></b></br></TD>
			</TR>
			<TR>
				<TD>Precio Mensual:</TD>
				<TD><div id='myform_precio_errorloc' class="error_strings"></div>
				<INPUT TYPE="text" NAME="precio" id="precio"><b id="rprecio"></b></br></TD>
			</TR>
			<TR>
				<TD>Horas Semana:</TD>
				<TD><div id='myform_numhora_errorloc' class="error_strings"></div>
				<INPUT TYPE="text" NAME="numhora" id="hora"><b id="rhora"></b></br></TD>
			</TR>
			<TR>
				<TD>Descripcion:</TD>
				<TD>
					<textarea cols="50" name="desc"></br></textarea>
				</TD>
			</TR>
			<TR>
				<TD>Entrenador:</TD>
				<TD>
				<select name="entrenador">
					
					<option value="ninguno" selected>Sin entrenador</option>
						<!-- option ajax -->
						<?php while ($obj = $entrenadores->fetch_object()){		
							LimpiaResultados($obj);
							echo("<option value='$obj->id_Entrenador'>$obj->nombre</option>");
						 } ?>
				</select>
				</TD>
			</TR>			
			<TR>
				<TD></TD>
				<TD><INPUT TYPE="submit" NAME="alta" VALUE="Alta"></TD>
			</TR>
		</TABLE>
		</fieldset>
	</form>
	<script language="javascript" src="./moduloactividad/js/validaciones/alta.js" type="text/javascript"></script>
	</div>
</section>