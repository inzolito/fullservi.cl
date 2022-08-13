<?	
	include("../../functions/funciones.php");
	conecta_bd();

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>

 <script>
	 
    $(document).ready(function() {
           $('#tabla_cotizaciones').dataTable( {
                "language": {
                    "url": "../../js/espa_tabla.json"
                }
            } );
		
			$('[data-toggle="popover"]').popover(); 
        } );
    </script>

</head>

<body>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Listado De Cotizaciones</h4>
</div>
<div class="modal-body">

<?
		
		$query_cotizaciones=mysql_query("select * from cotizaciones order by id_cotizacion ");

		
?>

<table width="100%" class=" display responsive  table table-striped table-bordered" id="tabla_cotizaciones">
	
	<thead>
	
		<tr>
			<th>Codigo </th>
			<th>fecha </th>
			<th>Hora </th>
			
			<th>Total Mano De Obra</th>
			<th>Total Repuestos</th>
			<th>Iva</th>
			<th>Total Cotizacion</th>
			
			
			<th>&nbsp;</th>
		</tr>
	</thead>
		<tbody>
		
	<? 
			
			
		
		while($datos_cotizacion=mysql_fetch_array($query_cotizaciones)){
			
		
	?>
			<tr>
			<td><? echo $datos_cotizacion['id_cotizacion']  ?></td>
			
			<td><? echo $datos_cotizacion['fecha_cotizacion']  ?> </td>
			<td><? echo $datos_cotizacion['hora_cotizacion']  ?></td>
		
			<td ><? echo formato_numero(1,$datos_cotizacion['total_mano_cotizacion']) ?></td>
			<td><? echo formato_numero(1,$datos_cotizacion['total_repuestos_cotizacion']) ?></td>
			<td><? echo formato_numero(1,$datos_cotizacion['iva_cotizacion']) ?></td>
			<td><? echo formato_numero(1,$datos_cotizacion['total_cotizacion']) ?></td>
			
			
			<td>
			   
            <button class="btn btn-info btn-xs" title="imprimir" onClick="reporte_cotizacion(<? echo $datos_cotizacion['id_cotizacion'] ?>)" > <i class="fa fa-print"></i></button> </td>
			</td>
		</tr>
	<?
		
	}
		
	?>
  </tbody>


</table>
	</div>

	




<script type="text/javascript">
                // For demo to fit into DataTables site builder...
                $('#tabla_cotizaciones')
                    .removeClass( 'display' )
                    .addClass('table table-striped table-bordered');
              </script>
</body>
</html>