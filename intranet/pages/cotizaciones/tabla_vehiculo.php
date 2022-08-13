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
</head>

<body>



<?
		

	$datos_vehiculo=datos_global($patente,"patente_vehiculo","vehiculos","*");
   
	if($datos_vehiculo==0){
		
			
				
?>

	
	<div class="jumbotron alert alert-info">
  <h2> El vehiculo con la patente <strong><? echo($patente)." " ?> </strong> no se encuentra registrado.desea crear una Cotización?</h2>
  <br>
		<p><button class="btn btn-default btn-block" type="button"role="button" onClick=" crear_cotizacion(0)">CREAR COTIZACION</button></p>
</div>
<?
	}else{
		
	
?>
<table style=background-color:white; class="table table-bordered">
	<tbody>
		<tr>
			<th>Codigo </th>
			<th>Patente </th>
			<th>Marca</th>
			<th>Modelo</th>
			<th>Año</th>
			<th>Color</th>
			<th>Numero Motor</th>
			<th>Numero Chasis</th>
			<th>Opciones</th>
		</tr>

		
		
		
		
			<tr>
			<th><? echo $datos_vehiculo['id_vehiculo']  ?></th>
			
			<td><? echo $datos_vehiculo['patente_vehiculo']  ?> </td>
			<td><? echo $datos_vehiculo['marca_vehiculo']  ?></td>
			<td><? echo $datos_vehiculo['modelo_vehiculo'] ?></td>
			<td><? echo $datos_vehiculo['ano_vehiculo'] ?></td>
			<td><? echo $datos_vehiculo['color_vehiculo'] ?></td>
			<td><? echo $datos_vehiculo['numero_motor_vehiculo'] ?></td>
			<td><? echo $datos_vehiculo['numero_chasis_vehiculo'] ?></td>
			<td><button class="btn btn-primary btn-sm" title="Crear Cotizacion"  onClick="crear_cotizacion(<? echo $datos_vehiculo['id_vehiculo']?>)"> <i class="fa fa-plus-square" aria-hidden="true"></i></button> </td>
		</tr>
		 
		</tbody>


</table>
<?
		
		$query_cotizaciones=mysql_query("select * from cotizaciones where id_vehiculo='".$datos_vehiculo['id_vehiculo']."' order by id_cotizacion ");

		
?>

<table style=background-color:white; class="table table-bordered table-condensed">
	<tbody>
	
	<tr>
		<td align="center" colspan="12"><h4> Cotizaciones:<? echo (" ".$datos_vehiculo['marca_vehiculo']."-".$datos_vehiculo['modelo_vehiculo']." / ".$datos_vehiculo['patente_vehiculo'])  ?></h4></td>
		</tr>
		<tr>
			<th>Codigo </th>
			<th>fecha </th>
			<th>Hora </th>
			
			<th>Total Mano De Obra</th>
			<th>Total Repuestos</th>
			<th>Iva</th>
			<th>Total Cotizacion</th>
			
			
			<th>&nbsp;</th>
		</tr>

		
		
	<? 
			
			
		
		while($datos_cotizacion=mysql_fetch_array($query_cotizaciones)){
			
			$sql_precios=mysql_query("select sum(precio_trabajo) from precios_trabajos join detalles_cotizacion_trabajo using(id_trabajo) where id_cotizacion='".$datos_cotizacion['id_cotizacion']."'  and estado_precio_trabajo='Activo'");
			$sql_precio_producto=mysql_query("select total_detalle_cotizacion_producto  from detalle_cotizacion_producto  where id_cotizacion='".$datos_cotizacion['id_cotizacion']."'");
			$dato_precio_producto=mysql_fetch_array($sql_precio_producto);
			
			$dato_total=mysql_fetch_array($sql_precios);
			
	?>
			<tr <? if( $datos_cotizacion['estado_cotizacion']==0){ echo("style=text-decoration:line-through;");} ?>>
			<th  ><? echo $datos_cotizacion['id_cotizacion']  ?></th>
			
			<td><? echo $datos_cotizacion['fecha_cotizacion']  ?> </td>
			<td><? echo $datos_cotizacion['hora_cotizacion']  ?></td>
		
			<td ><? if($datos_cotizacion['total_mano_cotizacion']==0){ echo(formato_numero(1,$dato_total['sum(precio_trabajo)']));}else{echo formato_numero(1,$datos_cotizacion['total_mano_cotizacion']);}  ?></td>
			<td><? if($datos_cotizacion['total_repuestos_cotizacion']==0){ echo(formato_numero(1,$dato_precio_producto['total_detalle_cotizacion_producto']));}else{echo formato_numero(1,$datos_cotizacion['total_repuestos_cotizacion']) ;} ?></td>
			<td><? echo formato_numero(1,$datos_cotizacion['iva_cotizacion']) ?></td>
			<td><? echo formato_numero(1,$datos_cotizacion['total_cotizacion']) ?></td>
			
			
			<td>
			
			<button class="btn btn-default btn-xs" onClick="editar_orden(this.id)" title="edit" id="<? echo $datos_cotizacion['id_cotizacion']."_".edit  ?>" <? if( $datos_cotizacion['estado_cotizacion']==0){ echo("disabled");} ?> > <i class="fa fa-pencil" aria-hidden="true"></i></button> 
			
			
			<button class="btn btn-danger btn-xs" title="anular" id="<? echo($datos_cotizacion['id_cotizacion'] ) ?>" onClick="anular_cotizacion(this.id)" <? if( $datos_cotizacion['estado_cotizacion']==0){ echo("disabled");} ?>  > <i class="fa fa-minus"></i></button> </button> <button onClick="reporte_cotizacion(<? echo($datos_cotizacion['id_cotizacion']) ?>)" class="btn btn-info btn-xs" title="imprimir" > <i class="fa fa-print"></i></button> </td>
		</tr>
	<?
		
	}
		
	?>
		</tbody>


</table>
	
<?	
	
	}


	
				
	
?>

<div class="row">
					<div class="col-md-4" style="margin-top: 15px;">
						<a href="../menu/Menu.php"  class="btn btn-warning btn-sm "  title="Volver al menu"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
					</div>
				</div>
</body>
</html>