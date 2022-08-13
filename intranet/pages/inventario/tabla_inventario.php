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
	 
    $(document).ready(function() {
           $('#tabla_productos').dataTable( {
                "language": {
                    "url": "../../js/espa_tabla.json"
                }
            } );
		
			$('[data-toggle="popover"]').popover(); 
        } );
    </script>


 
</head>

<body>

<?php
		

	$productos_consulta=mysql_query("select * from productos join precios_productos using (id_producto)
 										where estado_precio_producto=1 order by nombre_producto");
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
		<fieldset><legend>Listado de productos</legend> </fieldset>
		
	
	<table id="tabla_productos"  class="dataTable no-footer">
	
	
	<thead>
		<tr>
		<th>Código  </th>
			<th>producto </th>
			<th>marca </th>  
            
			<th>Stock min</th>
		 	<th>Stock max</th>
            <th>Costo</th>
            <th>Valor venta </th>
            <th>Stock en Bodega</th>
            <th>Administrar</th>
		</tr>
		</thead>
		
		<tbody>
		
		<?
			while($datos_producto=mysql_fetch_array($productos_consulta))
			{
				
			
		?>
		<tr>
		<td><? echo $datos_producto["id_producto"] ?></td>
			<td><? echo $datos_producto["nombre_producto"] ?></td>	
			<td><? echo $datos_producto["marca_producto"] ?></td>
			<td><? echo $datos_producto["stock_minimo_producto"] ?></td>
			<td><? echo $datos_producto["stock_maximo_producto"] ?></td>
            
            <td><?  if($datos_producto["costo_producto"]) echo formato_numero(1,$datos_producto["costo_producto"]); else echo "No ingresado"; ?></td>	
		    <td><?  if($datos_producto["costo_producto"]) echo(formato_numero(1,$datos_producto["precio_producto"])); else echo "No ingresado"; ?></td>	
		
        
        	<td><?  if($datos_producto["stock_real_producto"]==""){echo(0);}else{ echo $datos_producto["stock_real_producto"];}; ?></td>
			
			<td>
			
				<button type="button" class="btn btn-default btn-xs" title="Editar " onClick="cargar_producto('<? echo $datos_producto["id_producto"] ?>')" id="btn_editar"><i class="fa fa-pencil"> </i></button>
				
				<a tabindex="0" class="btn btn-xs btn-info" role="button" data-toggle="popover" data-trigger="focus" title="Descripcion Del Producto" data-content="<? echo $datos_producto['descripcion_producto'] ?>"><i class="fa fa-info-circle"> </i></a>
				  <a href="../inout/entrada.php" class="btn btn-default btn-xs" title="registrar entrada"><i class="fa fa-stack-exchange"> </i> </a>
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
                $('#tabla_productos')
                    .removeClass( 'display' )
                    .addClass('table table-striped table-bordered');
              </script>
</body>
</html>