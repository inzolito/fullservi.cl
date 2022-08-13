<?
    include("../../functions/funciones.php");
	conecta_bd();
	$id_orden=$_REQUEST['orden'];

valida_sesion();
	
$query_productos=mysql_query("select * from productos join precios_productos using(id_producto) join detalles_orden_producto using(id_producto) where id_orden='".$id_orden."' and estado_precio_producto='1'");



?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	
<script>
	
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
	
	</script>	
	
</head>

<body>


<div id="div_select_productos">
		 
			<form class="form-inline" role="form">
			
			 <select class="form-control mb-4 mr-sm-4 mb-sm-0 js-example-basic-single" id="cmb_productos" onChange="select_otro_producto()">
				 <option value="0">-----seleccione----- </option>
				<?
				 $sql_productos=mysql_query("select * from productos join precios_productos using(id_producto) where estado_precio_producto='1'");
					if(mysql_num_rows($sql_productos)!=0){
							
						while($datos=mysql_fetch_array($sql_productos)){


				?>
				 <option value="<? echo($datos['id_producto']."_".$id_orden."_".$datos['id_precio_producto']."_".$datos['precio_producto']) ?>"><? echo($datos['nombre_producto'])."-".formato_numero(1,$datos['precio_producto'])?> </option>

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
		<td><? echo($datos_productos['cantidad_producto_orden_producto']) ?></td>
		<td><? echo(formato_numero(1,$datos_productos['total_detalle_orden_producto'])) ?> </td>
		<td align="center"><button type="button" class="btn btn-danger btn-xs" id="<? echo($datos_productos['id_producto'])."_".$id_orden."_".$datos_productos['cantidad_producto_orden_producto'] ?>" onClick="eliminar_detalle_repuesto(this.id)"><i class="fa fa-trash"> </i> </button> </td>
	</tr>
	<?
		  }
		}else{
			
	?>
	  <th colspan="4">No Se Registran Productos o repuestos</th>
	
	<?	
		}
	
	$query_total=mysql_query("select sum(total_detalle_orden_producto) from detalles_orden_producto where id_orden='".$_REQUEST['orden']."'");
	
	
	
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