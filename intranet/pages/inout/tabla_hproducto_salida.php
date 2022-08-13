<?	
	include("../../functions/funciones.php");
	conecta_bd();


$producto=$_REQUEST['producto']

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<script>
	
	
	$(document).ready(function() {
		
		
		
		$('[data-toggle="popover"]').popover(); 
		
		
    $('#tabla_hproductos').DataTable( {
		 "language": {
                    "url": "../../js/espa_tabla.json"
                },
		
        dom: 'Bfrtip',
        buttons: [
            {
				text: '<i class="fa fa-clone" aria-hidden="true"></i>',
				titleAttr:"Copiar Tabla",
				
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
				text: '<i class="fa fa-file-excel-o"> </	i>',
				titleAttr:"Exportar a excel",
				
                extend: 'excelHtml5',
				title: 'Historial_salida',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
				text: '<i class="fa fa-file-pdf-o"> </i>',
				titleAttr:"Exportar a PDF",
				title: 'Historial salida de producto Full Servi',
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 5,6,7 ]
                }
            }
			
            //'colvis' botob para filtrar columnas
        ]
    } );
} );	


	
	
	</script>



 
</head>

<body>

<?php
		

	$productos_consulta=mysql_query("select * from historial_productos join productos using(id_producto) where id_producto=$producto and tipo_operacion_hp='salida' order by id_hp asc");
	if(mysql_num_rows($productos_consulta)==0){
		
			
				
?>

	
	<div class="jumbotron alert alert-info">
  <h2> No hay Historial para el producto seleccionado.</h2>
  <br>
 
</div>
<?
	}else{
		
	$nombre_producto=datos_global($producto,"id_producto","productos","*")
?>

	<div class="panel panel-default"> 
	
		<div class="panel-body"> 
		<table class="table table-bordered">
	<tr>
		<td align="center" colspan="10"><H4>Historial de producto:<? echo(" ".$nombre_producto['nombre_producto']); ?></H4> </td>
			</tr>
	
		</table>
		<table class="table table-bordered" id="tabla_hproductos">
			
			<thead>	
		  <tr>
			  <th>Fecha </th>
            <th>Hora</th>
            <th>Factura/Boleta</th>
               <th>N° de Factura/Boleta/Orden</th>
			<th>Cantidad de Entrada</th>
		 	<th>Cantidad de Salida</th>
           
          
            
            
            <th>Valor Venta Unitaria</th>
                 <th>Estado</th>
             <th>Administrar</th>
		</tr>
	</thead>
		
		
	<tbody>
		<?
			while($datos_producto=mysql_fetch_array($productos_consulta))
			{
				
			
		?>
		<tr>
	    <td><? echo formato_fecha("normal",$datos_producto["fecha_hp"]) ?></td>
            
 		    <td><? echo $datos_producto["hora_hp"]  ?></td>	
		    <td><? echo $datos_producto["documento_hp"] ?></td>
		    <td><? echo $datos_producto["num_documento_hp"] ?></td>
			<td><? echo $datos_producto["entrada_hp"] ?></td>
			<td><? echo $datos_producto["salida_hp"] ?></td>
			
 		    
 		    <td><? echo formato_numero(1,$datos_producto["valor_venta_hp"])  ?></td>	
	        <td><?  if($datos_producto['estado_hp']==1){echo("Activo");}if($datos_producto['estado_hp']==0){echo("Anulado"); ?>
	              	<a tabindex="0" style="float:right;" role="button" data-toggle="popover" data-trigger="focus" title="Detalle De Anulacion" data-content="<? echo($datos_producto['manulacion_hp']) ?>"><i title="haga clic para ver detalles" class="fa fa-info-circle  fa-lg" aria-hidden="true"></i></a>
																							   
																							   <?
																								   
																								   
																								   
																								   
																								   
																								   
																								   
																								   }
				
				?>
	              	
	              	</td>	
		              	
			
			<td>
			
            
				
			 		<button <? if($datos_producto['estado_hp']==0 || $datos_producto["documento_hp"]=="orden"  ){echo("disabled");} ?>  type="button" class="btn btn-danger btn-xs" title="Anular"  onClick="anular_salida(this.id)" id="<? echo($datos_producto["id_hp"]."_anular") ?>"><i class="fa fa-minus"> </i></button>
 				 
				 
 				 
		    </td>		
		</tr>
		
		<?
			}
		?>
		
		</tbody>


</table>
		
		
		
		</div>
	
	</div>



<?
	}


 


?>

	<button class="btn btn-warning btn-sm " onClick="formato_formulario(3)" title="Volver al menu"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Volver </button>
	
	
	<script type="text/javascript">
                // For demo to fit into DataTables site builder...
                $('#tabla_hproductos')
                    .removeClass( 'display' )
                    .addClass('table table-striped table-bordered');
		
		
		
              </script>
              
</body>
</html>