<?
    include("../../functions/funciones.php");
	conecta_bd();
valida_sesion();
	$id_cotizacion=$_REQUEST['cotizacion'];


	
$query_productos=mysql_query("select * from productos join precios_productos using(id_producto) join detalle_cotizacion_producto using(id_producto) where id_cotizacion='".$id_cotizacion."' and estado_precio_producto='1'");

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>


<div id="div_select_productos">
		 
			<form class="form-inline" role="form">
			
			 <select class="form-control mb-4 mr-sm-4 mb-sm-0" id="cmb_productos" onChange="select_otro_producto()">
				 <option value="0">-----seleccione----- </option>
				<?
				 $sql_productos=mysql_query("select * from productos join precios_productos using(id_producto) where estado_precio_producto='1'");
					if(mysql_num_rows($sql_productos)!=0){
						
						while($datos=mysql_fetch_array($sql_productos)){


				?>
				 <option value="<? echo($datos['id_producto']."_".$id_cotizacion."_".$datos['id_precio_producto']."_".$datos['precio_producto']) ?>"><? echo($datos['nombre_producto'])."-".formato_numero(1,$datos['precio_producto'])?> </option>

				<?
						}
					}
				 ?>
				

				 </select >
				<!--<input type="text" class="form-control" id="txt_kilometraje" required >-->
 			
 			<input type="number" min="0" class="form-control mb-2 mr-sm-4 mb-sm-0" id="txt_cantidad" required placeholder="Cantidad Repuesto">
 			
 			 <button class="btn btn-primary" type="button" id="btn_ingresar_repuesto" onClick="ingresar_repuesto()">Ingresar Repuesto	</button>
	</form>	 
				 
 
			  
				
			   
				 
				
				
				 
		 
					 	 
			
</div> 
		
		
	
			 
<div class="col-xs-12" style="margin-top:15px">
		<fieldset></fieldset>
		</div>

<table class="table table-bordered">
	<tr> 
		
		<th> Repuesto</th>
		
		<th>Precio Unitario</th>
		<th>Cantidad</th>
		<th>Total</th>
		
	
	</tr>
	
	<? 
		if(mysql_num_rows($query_productos)!=0){
			
			while($datos_productos=mysql_fetch_array($query_productos)){
				
		
	
	?>
	<tr> 
		
		<td><? echo($datos_productos['nombre_producto'])?></td>
		
		<td> <? echo(formato_numero(1,$datos_productos['precio_producto'])) ?></td>
		<td><? echo($datos_productos['cantidad_cotizacion_producto']) ?></td>
		<td><? echo(formato_numero(1,$datos_productos['total_detalle_cotizacion_producto'])) ?> </td>
		<td align="center"><button type="button" class="btn btn-danger btn-xs" id="<? echo($datos_productos['id_producto'])."_".$id_cotizacion."_".$datos_productos['cantidad_cotizacion_producto'] ?>" onClick="eliminar_detalle_repuesto(this.id)"><i class="fa fa-trash"> </i> </button> </td>
	</tr>
	<?
		  }
		}else{
			
	?>
	  <th colspan="4">No Se Registran Productos o repuestos</th>
	
	<?	
		}
	
	$query_total=mysql_query("select sum(total_detalle_cotizacion_producto) from detalle_cotizacion_producto where id_cotizacion='".$_REQUEST['cotizacion']."'");
	
	
	
	?>
	
	<tr> 
		<?
			if(mysql_num_rows($query_total)==1){
				
				$total=mysql_fetch_array($query_total);
				
			
		?>
		
		<td>&nbsp;</td>
		<td> </td>
		<td>&nbsp;</td>
		<th><? echo(formato_numero(1,$total[0])) ?></th>
		<?
			}else{
				
		?>
		
		
		<?		
				
			}
		?>
	</tr>
</table>
</body>

<script>
	
	</script>
</html>