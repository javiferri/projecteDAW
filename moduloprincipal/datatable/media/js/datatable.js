$(document).ready(function() {
				var oTable = $('#example').dataTable( {
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "moduloprincipal/datatable/php/server_processing2.php"
				} );
} );