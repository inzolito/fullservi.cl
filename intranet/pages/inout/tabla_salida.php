<?	
	include("../../functions/funciones.php");
	conecta_bd();


$patente=$_REQUEST['patente']

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>

<script>
	
	 $(document).ready(function(){
		   
		
		$('[data-toggle="popover"]').popover(); 
						
				$('#tabla_productos').dataTable( {
					
                "language": {
                    "url": "../../js/espa_tabla.json"
                }
            } );	
					
		   
			
		})
	</script>



 
</head>

<body>

<?php
		

	$productos_consulta=mysql_query("select * from productos join precios_productos using(id_producto) where estado_precio_producto=1 order by nombre_producto");
	if(mysql_num_rows($productos_consulta)==0){
		
			
				
?>

	
	<div class="jumbotron alert alert-info">
  <h2> No hay productos agregados aun.</h2>
  <br>
 
</div>
<?
	}else{
		
	
?>
<div class="panel panel-default">
	<div class="panel-body"> 
	
<table style=background-color:white; class="table table-bordered">
<tr>
		<td colspan="8" align="center"> <h4>Listado De Productos </h4></td>
	
		</tr>
	</table>
	<table class=" display responsive  table table-striped table-bordered" id="tabla_productos">
	
	
		
		<thead>
		<tr>
		
			<th>Codigo </th>
			<th>producto </th>
			<th>marca </th>  
            
			<th>Stock min</th>
		 	<th>Stock max</th>
             <th>Valor venta </th>
            <th>Stock</th>
            <th>Adminstrar</th>
		</tr>
	</thead>
		<tbody>
		
		
		<?
			while($datos_producto=mysql_fetch_array($productos_consulta))
			{
				
			
		?>
		<tr><td><? echo $datos_producto["id_producto"] ?></td>	
			<td><? echo $datos_producto["nombre_producto"] ?></td>	
			<td><? echo $datos_producto["marca_producto"] ?></td>
			<td><? echo $datos_producto["stock_minimo_producto"] ?></td>
			<td><? echo $datos_producto["stock_maximo_producto"] ?></td>
            
 		    <td><?  if($datos_producto["precio_producto"]) echo formato_numero(1,$datos_producto["precio_producto"]); else echo "No ingresado"; ?></td>	
		
        
        	<td><?  if($datos_producto["stock_real_producto"]==""){echo(0);}else{ echo $datos_producto["stock_real_producto"];}; ?></td>
			
			<td>
			
            
				<button type="button" class="btn btn-warning btn-xs" title="Registrar Salida"  onClick="modificar_stock(0,'<? echo $datos_producto["id_producto"] ?>')" id="btn_agregar_stock"><i class="fa fa-minus"> </i></button>
				 	<button type="button" class="btn btn-info btn-xs" title="Cargar Historial de producto" id="<? echo $datos_producto["id_producto"] ?>"  onClick="carga_historial(this.id)" ><i class="fa fa-search"> </i></button>
 				 
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
<a href="../menu/Menu.php" class="btn btn-warning btn-sm " title="Volver al menu"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Volver </a>
</body>
</html>