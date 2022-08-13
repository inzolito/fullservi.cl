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
           $('#tabla_ordenes').dataTable( {
                "language": {
                    "url": "../../js/espa_tabla.json"
                }
            } );
		
			$('[data-toggle="popover"]').popover(); 
        } );
    </script>

</head>

<body>



<div class="panel panel-default">
  

<div class="panel-body">
   
 
<?
		
		$query_ordenes=mysql_query("select * from ordenes_trabajo  join clientes using (id_cliente) where estado_orden='completa' order by id_orden ");

		
?>

	<table width="100%" class=" display responsive  table table-striped table-bordered" id="tabla_ordenes">
	
	<thead>
		<tr>
			<th>Codigo </th>
			<th>fecha </th>
			<th>Hora </th>
			
			<th>Total Mano De Obra</th>
			<th>Total Repuestos</th>
			<th>Total Orden</th>
			
			
			<th>&nbsp;</th>
		</tr>
	</thead>
		
		<tbody>
	<?
		while($datos_orden=mysql_fetch_array($query_ordenes)){
			
		
	?>
			<tr>
			<td><? echo $datos_orden['id_orden']  ?></td>
			
			<td><? echo $datos_orden['fecha_orden']  ?> </td>
			<td><? echo $datos_orden['hora_orden']  ?></td>
		
			<td ><? echo formato_numero(1,$datos_orden['total_mano_obra_orden']) ?></td>
			<td><? echo formato_numero(1,$datos_orden['total_repuestos_orden']) ?></td>
			<td><? echo formato_numero(1,$datos_orden['total_pagar_orden']) ?></td>
			
			
			<td>
			
			
            
            <button class="btn btn-info btn-xs" title="Buscar" onClick="cargar_orden2(<? echo $datos_orden['id_orden'] ?>)" > <i class="fa fa-search"></i></button> </td>
		</tr>
	<?
		}
			
		
	?>
  </tbody>


</table>
</div>

</div>

<div class="row">
					<div class="col-md-4" style="margin-top: 15px;">
						<a href="../menu/Menu.php"  class="btn btn-warning btn-sm "  title="Volver al menu"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Volver </a>
					</div>	
        		
		     	</div>


<script type="text/javascript">
                // For demo to fit into DataTables site builder...
                $('#tabla_ordenes')
                    .removeClass( 'display' )
                    .addClass('table table-striped table-bordered');
              </script>

</body>
</html>