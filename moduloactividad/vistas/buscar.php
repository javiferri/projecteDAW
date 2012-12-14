    <head>	
		<script language="javascript" src="./moduloactividad/js/buscar_actividad.js" type="text/javascript"></script>
    </head>
<section>
<form id="form1" name="form1" method="get" action="" onsubmit="return false;">
<fieldset>
		  <legend>Buscar Actividad:</legend>
	<table width="92%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="4" align="center" valign="middle"><label>
			Activitat: <input name="buscar" type="text" id="nombre" autocomplete="off"/></label></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td colspan="4" align="center"><table width="300" border="0" cellspacing="0" cellpadding="0" style="font-size:14px">
				<tr>
				  <td align="center"><label><input type="radio" name="radio" id="radio1" value="radio1"/>Desc</label></td>
				  <td align="center"><label><input type="radio" name="radio" id="radio2" value="radio2"/>Asc</label></td>
				  <td align="center"><label>
					<select name="criterio_ord" id="criterio_ord" >
						<option value="idActividad" >Actividad</option>	
						<option value="actividad" >Nombre</option>			
					</select>
				  </label></td>
				  <td align="center"><label>
					<select name="mas" id="mas" >
					  <option value="10">10</option>
					  <option value="20">20</option>
					  <option value="all">Todos</option>
					</select>
				  </label></td>
				</tr>
			</td>
			<td>&nbsp;</td>
			<td colspan="4" align="center"><div id="resultados"></div><br></td>
		</tr>
	</table>
	</fieldset>
</form>
</section>
