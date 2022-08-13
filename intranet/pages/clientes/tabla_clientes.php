<?	
	include("../../functions/funciones.php");
	conecta_bd();

valida_sesion();
$patente=$_REQUEST['patente']

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>


<script>
	
	 $(document).ready(function(){
		   
		
		
						
				$('#tabla_clientes').dataTable( {
					
                "language": {
                    "url": "../../js/espa_tabla.json"
                },
					
					    dom: 'Bfrtip',
        buttons: [
           
            {
				text: '<i class="fa fa-file-excel-o"> </	i>',
				titleAttr:"Exportar a excel",
				
                extend: 'excelHtml5',
				title: 'Historial_salida',
                exportOptions: {
                    columns: ':visible'
                }
            }
           
        ]
					
					
            } );	
					
		   
			
		})
	</script>


 
</head>

<body>

<?php
		

	$clientes_consulta=mysql_query("select * from clientes   order by nombre_cliente");
	if(mysql_num_rows($clientes_consulta)==0){
		
			
				
?>

	
	<div class="jumbotron alert alert-info">
  <h2> No hay clientes agregados aun.</h2>
  <br>
 
</div>
<?
	}else{
		
	
?>

	<div class="panel panel-default"> 
		<div class="panel-body"> 
		
			
<table  class="table table-bordered">
	<tr>
			<td style="background-color:#f9f9f9"  align="center" colspan="5"><h4> Listado De Clientes</h4> </td>
			
		</tr>

	</table>
	
	<table style="background-color:white;" class="table table-bordered table-condensed" id="tabla_clientes">
	
		
		
		<thead>

		<tr>
			<td>Nombre </td>
			<td>Rut </td>  
			<td>Fono</td>
			<td>Correo</td>
			<td>Administrar</td>
		</tr>
	</thead>
		
		<tbody>
		
		<?
			while($datos_cliente=mysql_fetch_array($clientes_consulta))
			{
				
			
		?>
		<tr>
			<td><? echo $datos_cliente["nombre_cliente"] ?></td>	
			<td><? echo formato_rut($datos_cliente["rut_cliente"],1) ?></td>	
			<td><? echo $datos_cliente["fono_cliente"] ?></td>
			<td><? echo $datos_cliente["correo_cliente"] ?></td>
			
			<td >
			
				<button type="button" class="btn btn-default  btn-xs" title="Editar"  onClick="cargar_cliente('<? echo $datos_cliente["id_cliente"] ?>')" id="btn_editar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
				 
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

<script type="text/javascript">
                // For demo to fit into DataTables site builder...
                $('#tabla_clientes')
                    .removeClass( 'display' )
                    .addClass('table table-striped table-bordered');
		
		
		
              </script>
              
</body>
</html>