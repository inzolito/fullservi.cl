<?	
	include("../../functions/funciones.php");
	conecta_bd();
valida_sesion();
	


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>

<?
		
		$query_ordenes=mysql_query("
	select id_estado_cuenta,patente_vehiculo,id_orden,fecha_orden,total_pagar_orden ,estado_cuenta from estados_cuenta join ordenes_trabajo using(id_orden)  join vehiculos using(id_vehiculo) where estado_cuenta='por pagar' and estado_orden='completa' ");

		
?>

<table style=background-color:white; class="table table-bordered table-condensed">
	<tbody>
	
	<tr>
		<td align="center" colspan="12"><h4> Ordenes De Trabajo:<? echo (" ".$datos_marca['nombre_marca']."-".$dato_modelo['nombre_modelo']." / ".$datos_vehiculo['patente_vehiculo'])  ?></h4></td>
		</tr>
		<tr>
			<th>Patente </th>
			<th>Numero De Orden </th>
			<th>Fecha Orden </th>
			
			<th>Total A Pagar</th>
		
			<th>Estado Orden</th>
				
			
		</tr>

		
		
	<?
		while($datos_orden=mysql_fetch_array($query_ordenes)){
			
		
	?>
			<tr>
			<th><? echo $datos_orden['patente_vehiculo']  ?></th>
			
			<td><? echo $datos_orden['id_orden']  ?> </td>
			<td><? echo $datos_orden['fecha_orden']  ?></td>
					
			<td><? echo formato_numero(1,$datos_orden['total_pagar_orden']) ?></td>
					
			<td <? if($datos_orden['estado_cuenta']=="pagada"){?>style="color:green" <?}else{ ?>style="color:red"<? }?>><? echo $datos_orden['estado_cuenta'] ?></td>
			<td>
			
			<button class="btn btn-default btn-xs" onClick="editar_orden(this.id)" title="edit" id="<? echo $datos_orden['id_orden']."_".edit  ?>" <? if($datos_orden['estado_orden']=="anulada" || $datos_orden['estado_cuenta']=="pagada"  ){ echo("disabled");} ?> > <i class="fa fa-pencil" aria-hidden="true"></i></button> 
			
			
			<button class="btn btn-default btn-xs" title="anular" id="<? echo($datos_orden['id_orden'] ) ?>" onClick="anular_orden(this.id)" <? if($datos_orden['estado_orden']=="anulada"){ echo("disabled");} ?> > <i class="fa fa-minus"></i></button> </button> <button class="btn btn-default btn-xs" title="imprimir" > <i class="fa fa-print"></i></button> </td>
		</tr>
	<?
		}
			
		
	?>
		</tbody>


</table>



</body>
</html>