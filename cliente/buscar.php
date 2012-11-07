<?php 
include('../estilo/head.html');
function LimpiaResultados($objeto){
	foreach ($objeto as $atributo => $valor)
		if(is_string($objeto->$atributo) === true)
			$objeto->$atributo = stripslashes($objeto->$atributo);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<section>
<form action="#">
	ID Cliente:<br>
	<INPUT TYPE="text" id="idcliente" autocomplete="off"><br>
	<div id="resultados"></div><br>
</form>
</section>
<?php
include('../estilo/pie.html');
?>
</body>
</html>
