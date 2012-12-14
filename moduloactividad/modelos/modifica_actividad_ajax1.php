<h3>Solo se modificaran los campos que rellenes.</h3>
<form id="form1" name="form1" method="get" action="" onsubmit="return false;">
	<TABLE align="center" cellspacing="10" cellpadding="10">
		<TR>
				<TD>Nombre Actividad:</TD>
				<TD><INPUT TYPE="text" NAME="nombreActividad" id="nombreActividad"></TD>
			</TR>
			<TR>
				<TD>Precio Mensual:</TD>
				<TD><INPUT TYPE="text" NAME="precio" id="precio"></TD>
			</TR>
			<TR>
				<TD>Horas Semanales:</TD>
				<TD><INPUT TYPE="text" NAME="numhora" id="numhora"></TD>
			</TR>
			<TR>
				<TD>Descripcion:</TD>
				<TD>
					  <textarea  name="desc" id="desc"></textarea>
				</TD>
			</TR>
			<TR>
				<TD>Entrenador:</TD>
				<TD>
				<select name="entrenador" id="entrenador">
					<option value=0 selected>Sin entrenador</option>
						<!-- option ajax -->
						<?php 
						require '../../moduloprincipal/conexion.php';
						require '../modelos/actividadModelo.php';
						$entrenadores = buscarEntrenadores();
						while ($obj = $entrenadores->fetch_object()){		
							LimpiaResultados($obj);
							echo("<option value='$obj->id_Entrenador'>$obj->nombre</option>");
						 } ?>
				</select>
				</TD>
			</TR>			
		<TR>
			<TD colspan="2"><INPUT TYPE="submit" NAME="actualizar" VALUE="Actualizar" onclick="modificar()"/></TD>
		</TR>
	</TABLE>
</form>
