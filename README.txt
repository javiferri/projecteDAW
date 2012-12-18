informació BD

	user: root
	pass: root
	nom BD: gimnasio
		tables:{
			usuarios (autenticació per a l'aplicació)
			clientes, entrenador, actividad
			estaen (activitats per a apuntar als clients)
			}
BD */

Estructura.

	./index.php fitxer principal on es controla totes les accions per a totes les taules.
		ej. (url)index.php?contolador="cliente"&accion="alta"

	./moduloprincipal/utilidades/ , estan les utilitates de tercers com ej jQuery.

	estructura moduls.
		./moduloEJEMPLO/
			VISTA/ vistes dels formularis. "alta, modificació, baixa, busqueda"
			CONTROLADOR/ estan els fitxer per els cuals pasen totes les peticions a realitzar. ejemploControlador.
			MODELOS/ o JS/ accions individuals que els formularis faran gastar per a cridar al controlador.


Estructura */

Detalls.

	Els comentaris JSDoc es troben en el modul client ./modulocliente/js/* . (Les funcions repetides no les torne a comentar. Soles hi han comentaris de
	JSDoc en modulcliente per que els altres moduls fan lo mateix.)

	./moduloPrincipal/conexion.php, esta la configuració per a conectar en la Base de Dades.
	./moduloPrincipal/vistas/css, esta el css aplicat per a tota la aplicació.
	./moduloPrincipal/datatable/ , esta la configuració per a la DataTable. La vista que la aplica es trova en ./modulocliente/vistas/buscar.html
	./moduloprincipal/utilidades/nicEdit.js, es el Editors wysiwyg que es fa servir per a la vista ./moduloactividad/vistas/alta.php
	./moduloprincipal/utilidades/jqueryUI.js, es el DatePicker que gastem en la vista ./modulocliente/vistas/alta.php

	En la vista de login encontrem un mapa de Google Maps. Aquest mapa esta inclos en una capa, que esta rellena per una Javascpript que inclou 
	codi de la API de google, personalisant el nostre mapa com nosaltres vulguem. Aquest Javascript es trova en ./moduloprincipal/js/maps.js .
	Tambe inclogem una api per a poder compratir la aplicació per FACEBOOK o TWITTER en el login.

	En la vista de login hi ha una xicoteta animacio per a una capa oculta, gastant efectes de jQuery. El Javascript de la animacio es 
	trova ./moduloprincipal/js/alta.js
		function addRegistro(){
			$('#registro').load('./moduloprincipal/vistas/html/registro.html');
			$("#registro").fadeIn(1000);
		};
	
	Al entrar a la part funcional de la aplicació, hi ha un altra xicoteta animacio, la cual una capa es mou de esquerra a dreta de la plana web. 
	Aquesta capa conte un desplegable. Aquests efectes tambe son gracies a jQuery.
	
	Per a la validació de formularis, gastem el genValidatorv4 que es trova en ./moduloprincipal/js/gen_validatorv4.js el cual gastem en les altes de tots 
	els elements.
	Algun dells els podem trovar en ./modulocliente/js/validaciones/alta.js per al formulari de altes dels clients ( ./modulocliente/vistas/alta.php)

	Gastem AJAX per a la modificació o eliminació dels elements. Alguns exemples els pots trovar en ./modulocliente/js/modificar_cliente.js el cual realitza 
	coneccions amb el controlador
	per a consultes y fer operacións.