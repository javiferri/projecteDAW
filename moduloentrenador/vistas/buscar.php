    <head>	
		<script language="javascript" src="./moduloentrenador/js/buscar_entrenador.js" type="text/javascript"></script>
    </head>
<section>
<div class="action">
<form id="form1" name="form1" method="get" action="" onsubmit="return false;">
<fieldset>
		  <legend>Buscar Entrenador:</legend>
	<table width="92%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="4"><label>
			Nombre: <input name="buscar" type="text" id="entrenador" autocomplete="off"/></label></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td colspan="4"><table width="300" border="0" cellspacing="0" cellpadding="0" style="font-size:14px">
				<tr>
				  <td><label><input type="radio" name="radio" id="radio1" value="radio1"/>Desc</label></td>
				  <td><label><input type="radio" name="radio" id="radio2" value="radio2"/>Asc</label></td>
				  <td><label>
					<select name="criterio_ord" id="criterio_ord" >
						<option value="id_Entrenador" >ID</option>	
						<option value="nombre" >Nombre</option>			
					</select>
				  </label></td>
				  <td><label>
					<select name="mas" id="mas" >
					  <option value="10">10</option>
					  <option value="20">20</option>
					  <option value="all">Todos</option>
					</select>
				  </label></td>
				</tr>
			</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<div id="resultados"></div>
</form>
</fieldset>
</div>
</section>
