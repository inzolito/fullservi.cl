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




 
</head>

<body>

<?php
		

	$productos_consulta=mysql_query("select * from productos order by nombre_producto");
	if(mysql_num_rows($productos_consulta)==0){
		
			
				
?>

	
	<div class="jumbotron alert alert-info">
  <h2> No hay productos agregados aun.</h2>
  <br>
 
</div>
<?
	}else{
		
	
?>
<table style=background-color:white; class="table table-bordered">
	<tbody>
		<tr>
			<th>producto </th>
			<th>marca </th>  
            
			<th>Stock min</th>
		 	<th>Stock max</th>
            <th>Costo</th>
            <th>Valor venta </th>
            <th>Stock</th>
            <th>accion </th>
		</tr>

		
		
		
		<?
			while($datos_producto=mysql_fetch_array($productos_consulta))
			{
				
			
		?>
		<tr>
			<td><? echo $datos_producto["nombre_producto"] ?></td>	
			<td><? echo $datos_producto["marca_producto"] ?></td>
			<td><? echo $datos_producto["stock_minimo_producto"] ?></td>
			<td><? echo $datos_producto["stock_maximo_producto"] ?></td>
            
            <td><?  if($datos_producto["costo_producto"]) echo formato_numero(1,$datos_producto["costo_producto"]); else echo "No ingresado"; ?></td>	
		    <td><?  if($datos_producto["costo_producto"]) echo valor_venta_producto($datos_producto["costo_producto"]); else echo "No ingresado"; ?></td>	
		
        
        	<td><? echo $datos_producto["stock_real_producto"]; ?></td>
			
			<td>
			
            
				 <button type="button" class="btn btn-success"  onClick="modificar_stock(1,'<? echo $datos_producto["id_producto"] ?>')" id="btn_agregar_stock">Agregar stock</button>
				 <button type="button" class="btn btn-warning"  onClick="modificar_stock(0,'<? echo $datos_producto["id_producto"] ?>')" id="btn_quitar_stock">Quitar Stock</button>
				 
		    </td>		
		</tr>
		
		<?
			}
		?>
		
		</tbody>


</table>

<?
	}


 


?>
</body>
</html>