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
	
	 $(document).ready(function(){
		   
		
		
						
				$('#tabla_proveedores').dataTable( {
                "language": {
                    "url": "../../js/espa_tabla.json"
                }
            } );	
					
		   
			
		})
	</script>



 
</head>

<body>

<?php
		

	$productos_consulta=mysql_query("select * from proveedores order by nombre_proveedor");
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
		<td align="center" colspan="10"><H4>Proveedores</H4> </td>
			</tr>
	
		</table>
		<table class="table table-bordered" id="tabla_proveedores">
			
			<thead>	
		  <tr>
			  <th>Codigo </th>
            <th>Rut</th>
            <th>Nombre</th>
               <th>Persona De Contacto</th>
			<th>Fono</th>
		 	<th>Mail</th>
           
            <th>Direccion</th>
            
                    
             <th>Administrar</th>
		</tr>
	</thead>
		
		
	<tbody>
		<?
			while($datos_producto=mysql_fetch_array($productos_consulta))
			{
				
			
		?>
		<tr>
	  
      
      	   <td><? echo $datos_producto["id_proveedor"] ?></td> 
 		    <td><? echo formato_rut($datos_producto["rut_proveedor"],1) ?></td>	
		    <td><? echo $datos_producto["nombre_proveedor"] ?></td>
		    <td><? echo $datos_producto["contacto_proveedor"] ?></td>
			<td><? echo ($datos_producto["fono_proveedor"]." - ". $datos_producto["fono2_proveedor"]) ?></td>
			<td><? echo $datos_producto["mail_proveedor"] ?></td>
			<td><? echo $datos_producto["direccion_proveedor"] ?></td>
			
 		 
		              	
			
			<td>
			
            
				
			 		<button type="button" class="btn btn-default btn-xs" title="Editar"  onClick="cargar_proveedor(this.id)" id="<? echo($datos_producto["id_proveedor"]) ?>"><i class="fa fa-pencil"> </i></button>
 				 
				 
 				 
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
                $('#tabla_proveedores')
                    .removeClass( 'display' )
                    .addClass('table table-striped table-bordered');
              </script>
</body>
</html>