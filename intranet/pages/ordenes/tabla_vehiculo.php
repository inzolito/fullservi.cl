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

<?
		

	$datos_vehiculo=datos_global($patente,"patente_vehiculo","vehiculos","*");
    $datos_marca=datos_global($datos_vehiculo['id_marca'],"id_marca","marcas_vehiculos","*");
     $dato_modelo=datos_global($datos_vehiculo['id_modelo'],"id_modelo","modelos_vehiculos","*");
				
	if($datos_vehiculo==0){
		
			
				
?>

	
	<div class="jumbotron alert alert-info">
  <h2> El vehiculo con la patente <strong><? echo($patente)." " ?> </strong> no se encuentra registrado.desea crear una orden?</h2>
  <br>
		<p><button class="btn btn-default btn-block" type="button"role="button" onClick="cargar_orden(0)">REGISTRAR PATENTE </button></p>
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
			<td><button class="btn btn-default btn-sm" title="ingresar orden"  onClick="cargar_orden2(<? echo $datos_vehiculo['id_vehiculo']?>)"> <i class="fa fa-plus-square" aria-hidden="true"></i></button>			  <a href="../menu/Menu.php"  class="btn btn-warning btn-sm"  title="Volver al menu"> <i class="fa fa-arrow-left" aria-hidden="true"></i> </a>
					</td>
		</tr>
		
		</tbody>


</table>
<?
		
		$query_ordenes=mysql_query("select * from ordenes_trabajo  join estados_cuenta using(id_orden) where id_vehiculo='".$datos_vehiculo['id_vehiculo']."' order by id_orden ");

		
?>

<table style=background-color:white; class="table table-bordered table-condensed">
	<tbody>
	
	<tr>
		<td align="center" colspan="12"><h4> Ordenes De Trabajo:<? echo (" ".$datos_vehiculo['marca_vehiculo']."-".$datos_vehiculo['modelo_vehiculo']." / ".$datos_vehiculo['patente_vehiculo'])  ?></h4></td>
		</tr>
		<tr>
			<th>Codigo </th>
			<th>fecha </th>
			<th>Hora </th>
			
			<th>Total Mano De Obra</th>
			<th>Total Repuestos</th>
			<th>Total Orden</th>
			
			<th>Estado Orden</th>
			
			<th>Estado Pago</th>
			<th>&nbsp;</th>
		</tr>

		
		
	<?
		while($datos_orden=mysql_fetch_array($query_ordenes)){
			
		
	?>
			<tr>
			<th><? echo $datos_orden['id_orden']  ?></th>
			
			<td><? echo $datos_orden['fecha_orden']  ?> </td>
			<td><? echo $datos_orden['hora_orden']  ?></td>
		
			<td ><? echo formato_numero(1,$datos_orden['total_mano_obra_orden']) ?></td>
			<td><? echo formato_numero(1,$datos_orden['total_repuestos_orden']) ?></td>
			<td><? echo formato_numero(1,$datos_orden['total_pagar_orden']) ?></td>
			
			<td <? if($datos_orden['estado_orden']=="completa"){?>style="color:blue" <?}else{ ?>style="color:red"<? }?>><? echo $datos_orden['estado_orden'] ?></td>
			<td <? if($datos_orden['estado_cuenta']=="pagada"){?>style="color:green" <?}else{ ?>style="color:red"<? }?>><? echo $datos_orden['estado_cuenta'] ?></td>
			<td>
			
			<button class="btn btn-default btn-xs" onClick="editar_orden(this.id)" title="edit" id="<? echo $datos_orden['id_orden']."_".edit  ?>" <? if($datos_orden['estado_orden']=="anulada" || $datos_orden['estado_cuenta']=="pagada"  ){ echo("disabled");} ?> > 
            		<i class="fa fa-pencil" aria-hidden="true"></i>
           </button> 
			
			
			<button class="btn btn-danger btn-xs" title="anular" id="<? echo($datos_orden['id_orden'] ) ?>" onClick="anular_orden(this.id)" <? if($datos_orden['estado_orden']=="anulada"){ echo("disabled");} ?> > <i class="fa fa-minus"></i></button>  
            
            <button class="btn btn-info btn-xs" title="imprimir" onClick="reporte_orden(<? echo $datos_orden['id_orden'] ?>)" > <i class="fa fa-print"></i></button> </td>
		</tr>
	<?
		}
			
		
	?>
		</tbody>


</table>

	<div class="row">
					<div class="col-md-4" style="margin-top: 15px;">
						<a href="../menu/Menu.php"  class="btn btn-warning btn-sm "  title="Volver al menu"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Volver </a>
					</div>
				</div>
	
<?	
	
	} 


	
				
	
?>

 </body>
</html>