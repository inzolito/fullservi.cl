<?
    include("../../functions/funciones.php");
valida_sesion();
	conecta_bd();
	$id_orden=$_REQUEST['orden'];

//echo("select * from trabajos join precios_trabajos using(id_trabajo) join detalles_ordenes_trabajos using(id_trabajo) where id_orden='".$id_orden."' and estado_precio_trabajo='activo'");
	
$query_trabajos=mysql_query("select * from trabajos join precios_trabajos using(id_trabajo) join detalles_ordenes_trabajos using(id_trabajo) where id_orden='".$id_orden."' and estado_precio_trabajo='activo'");

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


<div id="div_select_trabajos">

		 <form class="form-inline" role="form">
			 
		
			 <select class="form-control js-example-basic-single" id="cmb_trabajo" onChange="select_otro_trabajo()">
				 <option value="0">-----seleccione----- </option>
				<?
				 $sql_trabajos=mysql_query("select * from trabajos join precios_trabajos using(id_trabajo) where estado_precio_trabajo='activo'");
					if(mysql_num_rows($sql_trabajos)!=0){
							
						while($datos=mysql_fetch_array($sql_trabajos)){


				?>
				 <option value="<? echo($datos['id_trabajo']."_".$id_orden."_".$datos['id_precio_trabajo']) ?>"><? echo($datos['nombre_trabajo'])."-".formato_numero(1,$datos['precio_trabajo'])?> </option>

				<?
						}
					}
				 ?>
					<option value="otro">otro.....</option>

				 </select >
				<!--<input type="text" class="form-control" id="txt_kilometraje" required >-->
				 
				 
				 <button class="btn btn-default" type="button" id="btn_ingresar_trabajo" onClick="ingresar_detalle_trabajo()"> Ingresar Trabajo</button>
				 
		 </form>
					 	 
			
		</div> 
		
		
		 <div id="div_select_trabajos2" >
		 <form class="form-inline" role="form">
	 		
	 		 
			  
				<input type="text" class="form-control " id="txt_trabajo" required placeholder="Nombre trabajo">
			 
			
			  	
				<input type="text" min="1000" max="1000000" class="form-control" id="txt_precio_trabajo" required placeholder="precio trabajo" onKeyUp="formato_moneda(this)"  >
			
			 
			  
				  <button class="btn btn-primary" id="btn_registrar_trabajo" type="button" onClick="crear_ingresar_trabajo()"> Crear Trabajo </button>
				    <button class="btn btn-danger" id="cancelar_trabajo" type="button" onClick="cancelar_otro_trabajo()"> Cancelar </button>
			 
			 
			 </form>
			 </div>
			 
	 <div class="col-xs-12" style="margin-top:15px">
		<fieldset></fieldset>
		</div>

<table class="table table-bordered">
	<tr> 
		
		<th> trabajo</th>
		<th> </th>
		<th> precio mano obra</th>
		<th> Retirar Trabajo <? echo(mysql_num_rows($query_trabajos)) ?></th>
		
	
	</tr>
	
	<? 
		if(mysql_num_rows($query_trabajos)!=0){
			
			while($datos_trabajo=mysql_fetch_array($query_trabajos)){
				
		
	
	?>
	<tr> 
		
		<td><? echo($datos_trabajo['nombre_trabajo'])?></td>
		<td> </td>
		<td> <? echo(formato_numero(1,$datos_trabajo['precio_trabajo'])) ?></td>
		<td><button type="button" class="btn btn-danger btn-xs" id="<? echo($datos_trabajo['id_trabajo']."_".$id_orden)?>" onClick="eliminar_detalle_trabajo(this.id)"> <i class="fa fa-trash"> </i></button></td>
	
	</tr>
	<?
		  }
		}else{
			
	?>
	<th colspan="3"> La Orden No tiene Trabajos</th>
	
	<?	
		}
	
	$query_total=mysql_query("select sum(precio_trabajo) from trabajos join precios_trabajos using(id_trabajo) join detalles_ordenes_trabajos using(id_trabajo) where id_orden='".$_REQUEST['orden']."' and estado_precio_trabajo='activo' group by id_orden");
	
	
	
	?>
	
	<tr> 
		<?
			if(mysql_num_rows($query_total)==1){
				
				$total=mysql_fetch_array($query_total);
				
			
		?>
		
		<td> Total Trabajos</td>
		<td> </td>
		<td> <? echo(formato_numero(1,$total[0])) ?></td>
		
		<?
			}else{
				
		?>
		<th> Total Trabajos</th>
		<th> </th>
		<th> $ 0</th>	
		<th></th>
		<?		
				
			}
		?>
	</tr>
</table>
</body>

<script>
	
	$("#div_select_trabajos2").hide()	
	</script>
</html>