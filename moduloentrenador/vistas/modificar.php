    <head>
		<script language="javascript" src="./moduloentrenador/js/modificar_entrenador.js" type="text/javascript"></script>
		<script type="text/javascript" src="jquery-1.8.2.js"></script>
    </head>

<section>
<div class="action">
<div class ="modificar">
<form id="form3" name="form3" method="get" action="" onsubmit="return false;">
<fieldset>
		  <legend>Modificar Entrenador:</legend>
<table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="4" valign="middle"><label>
	  Cliente: <input name="buscar" type="text" id="buscar" autocomplete="off"/></label></td>
    </tr>

    <tr>
      <td colspan="4"><table width="300" border="0" cellspacing="0" cellpadding="0" style="font-size:14px">
        <tr>
          <td><label><input type="radio" name="radio" id="radio1" value="radio1"/>Desc</label></td>
          <td><label><input type="radio" name="radio" id="radio2" value="radio2"/>Asc</label></td>
		  <td><label>
			<select name="criterio_ord" id="criterio_ord" >
				<option value="id_Entrenador" >Entrenador</option>	
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
    </tr>
</table>
</fieldset>
</form>
</div>
<div id="resultado3"></div>
<div id="modificar"></div>
</div>
</section>