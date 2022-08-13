<!doctype html>
<html>
<head>

	    <link rel="stylesheet" href="../../libraries/fonts/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="../../libraries/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="../../libraries/bootstrap/css/bootstrap-theme.css">
		<link rel="stylesheet" href="../../libraries/bootstrap/css/bootstrap.css">

         <link rel="stylesheet" href="../../css/datatables.min.css" type="text/css">
           <link rel="stylesheet" href="../../css/dataTables.bootstrap.css" type="text/css">

 	
 		 
        <script type="text/javascript" src="../../js/jquery-1.10.1.min.js"></script>
       
  		<script src="../../libraries/bootstrap/js/bootstrap.min.js"></script>
        
     
	
        <script src="../../js/datatables.min.js"></script>
        <script src="../../js/dataTables.bootstrap.js"></script>
        
<meta charset="utf-8">
<title>Documento sin título</title>

<style type="text/css">
 
    
</style>

<script>
	$(document).ready( function () {
  // formato_moneda()
		  $('#table_id').dataTable( {
                "language": {
                    "url": "../../js/espa_tabla.json"
                }
            } );
} );
	</script>
</head>

<body>
<table id="table_id"  class="dataTable no-footer">
    <thead>
        <tr>
            <th>Column 1</th>
            <th>Column 2</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>
    </tbody>
</table>
</body>
 <script type="text/javascript">
                // For demo to fit into DataTables site builder...
                $('#table_id')
                    .removeClass( 'display' )
                    .addClass('table table-striped table-bordered');
              </script>
</html>