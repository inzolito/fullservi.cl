<?
include("../../../functions/funciones.php");
conecta_bd();



$accion=$_REQUEST['accion'];
$fecha=fecha_actual();
$hora=hora_actual();
$empleado="1";




if($accion=="crear_cotizacion"){
	
	if($_REQUEST['identificador']==0){
		
		
		
		//---------------------------------
		 if(consulta_vehiculo($_REQUEST['patente'],0,0)==0)
		 {
			$inserta_vehiculo=mysql_query("INSERT INTO vehiculos SET 
			 patente_vehiculo='".$_REQUEST['patente']."'");	
			$sql_id=mysql_query("select max(id_vehiculo) from vehiculos");
			$id=mysql_fetch_array($sql_id);
	
		 }else{
			 
			 $datos_vehiculo=mysql_fetch_array(consulta_vehiculo($_REQUEST['patente'],1));
			 $id=$datos_vehiculo["id_vehiculo"];
			 
		 }
		//---------------------------------



		$crear_cotizacion=mysql_query("INSERT INTO cotizaciones SET 
		id_cliente=0,
		id_vehiculo='".$id[0]."',
		fecha_cotizacion='".formato_fecha("bd",$fecha)."',
		observacion_cotizacion='',
		total_mano_cotizacion=0,
		total_repuestos_cotizacion=0,
		neto_cotizacion=0,
		iva_cotizacion=0,
		total_cotizacion=0,
		hora_cotizacion='".$hora."',
		estado_cotizacion=1,
		id_empleado='".$empleado."'");
		
		$sql_idc=mysql_query("select max(id_cotizacion) from cotizaciones");
		$idc=mysql_fetch_array($sql_idc);
		
		
		echo("2_".$idc[0]);
		die;
		
	}else{
		$crear_cotizacion=mysql_query("INSERT INTO cotizaciones SET 
		id_cliente=0,
		id_vehiculo='".$_REQUEST['identificador']."',
		fecha_cotizacion='".formato_fecha("bd",$fecha)."',
		observacion_cotizacion='',
		total_mano_cotizacion=0,
		total_repuestos_cotizacion=0,
		neto_cotizacion=0,
		iva_cotizacion=0,
		total_cotizacion=0,
		hora_cotizacion='".$hora."',
		estado_cotizacion=1,
		id_empleado='".$empleado."'");
		
	$sql_idc=mysql_query("select max(id_cotizacion) from cotizaciones");
	$idc=mysql_fetch_array($sql_idc);
		
		
		echo("1_".$idc[0]);
		die;
		
	
	}
	
	
	
	
}
if($accion=="buscar_cliente")
{
		$rut=$_REQUEST['rut'];
        $rut=formato_rut($rut,0);
		$empelado_datos=datos_global($rut,"rut_cliente","clientes","id_cliente,nombre_cliente,rut_cliente,correo_cliente,fono_cliente,fono2_cliente,direccion_cliente,tipo_cliente");
	
		echo $empelado_datos;
		die;
	
}



if($accion=='ingresar_detalle_trabajo'){
	
	if($_REQUEST['id_trabajo']==0){
		
		echo(1);
		die;
		
	}
	
	$consulta_existe=mysql_query(" select * from detalles_cotizacion_trabajo  where id_cotizacion='".$_REQUEST['id_cotizacion']."' and id_trabajo='".$_REQUEST['id_trabajo']."'");
	
		
	if(mysql_num_rows($consulta_existe)==0){
		
		
		$insert_detalle_trabajo=mysql_query("INSERT INTO detalles_cotizacion_trabajo SET id_cotizacion='".$_REQUEST['id_cotizacion']."',id_trabajo='".$_REQUEST['id_trabajo']."',id_precio_trabajo='".$_REQUEST['id_precio']."'");
		
		echo(3);
			die;
		//echo(" select * from detalles_ordenes_trabajos  where id_orden='".$_REQUEST['id_orden']."' and id_trabajo='".$_REQUEST['id_trabajo']."'");
	}else{
		//echo(" select * from detalles_ordenes_trabajos  where id_orden='".$_REQUEST['id_orden']."' and id_trabajo='".$_REQUEST['id_trabajo']."'");
	echo(2);
		die;
	}
	
	
}


if($accion=='eliminar_detalle_trabajo'){
	
	
	$eliminar_detalle_trabajo=mysql_query("delete from detalles_cotizacion_trabajo where id_cotizacion='".$_REQUEST['id_cotizacion']."' and id_trabajo='".$_REQUEST['id_trabajo']."'");
	
		echo(1);
	die;
	
}

if($accion=='crear_ingresar_trabajo'){

if($_REQUEST['trabajo']=="" || $_REQUEST['precio']==""){
	
	echo(3);
	die;
	
}else{
	
	$sql_existe_trabajo=mysql_query("SELECT * FROM trabajos WHERE nombre_trabajo LIKE '".$_REQUEST['trabajo']."'");
	
	if(mysql_num_rows($sql_existe_trabajo)==1){
		
		echo(2);
		die;
	}else{
		
		$sql_insert_trabajo=mysql_query("INSERT INTO trabajos SET nombre_trabajo='".$_REQUEST['trabajo']."'");
		$sql_id=mysql_query("select max(id_trabajo) from trabajos");
		$max_id=mysql_fetch_array($sql_id);
		$sql_precio_trabajo=mysql_query("INSERT INTO precios_trabajos SET precio_trabajo='".formato_numero(0,$_REQUEST['precio'])."',id_trabajo='".$max_id['max(id_trabajo)']."',estado_precio_trabajo='activo'");
	
		echo(1);
		die;
	}
	
}
	
	
	
	
	
}
if($accion=='ingresa_detalles_repuesto'){
	
	
	if($_REQUEST["cantidad"]=="" || $_REQUEST["producto"]=""){
		
		echo(2);
		die;
		
	}else{
		
		$sql_existe_producto=mysql_query("select * from detalle_cotizacion_producto where id_cotizacion='".$_REQUEST["cotizacion"]."' and id_producto='".$_REQUEST["repuesto"]."'");
		
		if(mysql_num_rows($sql_existe_producto)==0){
			
			$total=$_REQUEST['precio_unitario']*$_REQUEST['cantidad'];
			
			
			$stock_real=datos_global($_REQUEST['repuesto'],"id_producto","productos","stock_real_producto");
			
			
			$sql_insert=mysql_query("INSERT INTO detalle_cotizacion_producto SET id_cotizacion='".$_REQUEST['cotizacion']."',
			id_producto='".$_REQUEST['repuesto']."',
			id_precio_producto='".$_REQUEST['precio']."',
			cantidad_cotizacion_producto='".$_REQUEST['cantidad']."',total_detalle_cotizacion_producto='".$total."'");
				
				echo(1);
				die;
			
			
					
			
			
			
		}else{
			
			echo(3);
			die;
		}
		
	}
	
	
		
}


if($accion=='eliminar_detalle_repuesto'){
	
	
	
	$eliminar_detalle_trabajo=mysql_query("DELETE FROM detalle_cotizacion_producto WHERE id_cotizacion='".$_REQUEST['cotizacion']."' and id_producto='".$_REQUEST['repuesto']."'");
	
	//echo("DELETE FROM detalles_orden_producto WHERE id_orden='".$_REQUEST['orden']."' and id_producto='".$_REQUEST['producto']."'");
	
	//$sql_update=mysql_query("UPDATE productos SET stock_real_producto=(stock_real_producto +'".$_REQUEST['cantidad']."') WHERE id_producto='".$_REQUEST['repuesto']."'");
	echo(1);
	die;
	
}


if($accion=="guardar_cotizacion" || $accion=="guardar_editar_cotizacion"){
	
	$cliente_existe=datos_global($_REQUEST['cliente'],"id_cliente","clientes","existe");
	
	if($cliente_existe==1){
		
		$rut=$_REQUEST["txt_rut"];
		$rut=formato_rut($rut,0);
		
		
		$update_cliente=mysql_query("UPDATE clientes SET rut_cliente='".$rut."',
		nombre_cliente='".$_REQUEST['txt_nombre']."',
		correo_cliente='".$_REQUEST['txt_correo']."',
		fono_cliente='".$_REQUEST['txt_fono']."',
		fono2_cliente='".$_REQUEST['txt_fono2']."',
		direccion_cliente='".$_REQUEST['txt_direccion']."',
		tipo_cliente='".$_REQUEST['cmb_tipo_cliente']."'
		WHERE id_cliente='".$_REQUEST['cliente']."'");
		
		$id_cliente=$_REQUEST['cliente'];
		
		
	}else{
		$rut=$_REQUEST["txt_rut"];
		$rut=formato_rut($rut,0);
		
		$insert_cliente=mysql_query("insert into clientes SET rut_cliente='".$rut."',
		nombre_cliente='".$_REQUEST['txt_nombre']."',
		correo_cliente='".$_REQUEST['txt_correo']."',
		fono_cliente='".$_REQUEST['txt_fono']."',
		fono2_cliente='".$_REQUEST['txt_fono2']."',
		direccion_cliente='".$_REQUEST['txt_direccion']."',
		tipo_cliente='".$_REQUEST['cmb_tipo_cliente']."'");
		
		$sql_cliente=mysql_query("select max(id_cliente) from clientes");
		$datos_cliente=mysql_fetch_array($sql_cliente);
		
		$id_cliente=$datos_cliente[0];
		
	}
	
	
	
		//$vehiculo_existe=datos_global($_REQUEST['txt_patente'],"patente_vehiculo","vehiculos","existe");

		//---------------------------------
		 if(consulta_vehiculo(0,$_REQUEST['txt_codigo'],0)==0)
		 {
			$vehiculo_existe=0;
		 }else{
			$vehiculo_existe=1;
			
		 }
		//---------------------------------


	if($vehiculo_existe==1){
		
		$update_vehiculo=mysql_query("UPDATE vehiculos SET patente_vehiculo='".$_REQUEST['txt_patente']."',
		numero_motor_vehiculo='".$_REQUEST['txt_nmotor']."',
		numero_chasis_vehiculo='".$_REQUEST['txt_nchasis']."',
		kilometraje_vehiculo='".$_REQUEST['txt_kilometraje']."',
		marca_vehiculo='".$_REQUEST['cmb_marca']."',
		modelo_vehiculo='".$_REQUEST['cmb_modelo']."',
		color_vehiculo='".$_REQUEST['txt_color']."',
		motor_vehiculo='".$_REQUEST['cmb_motor']."',
		tipo_motor_vehiculo='".$_REQUEST['cmb_tipo_motor']."' 
		WHERE id_vehiculo='".$_REQUEST['txt_codigo']."'");
		
		
		
		$id_vehiculo=$_REQUEST['vehiculo'];

	}else{
		
		
		$insert_vehiculo=mysql_query("insert into vehiculos SET patente_vehiculo='".$_REQUEST['txt_patente']."',
		numero_motor_vehiculo='".$_REQUEST['txt_nmotor']."',
		numero_chasis_vehiculo='".$_REQUEST['txt_nchasis']."',
		kilometraje_vehiculo='".$_REQUEST['txt_kilometraje']."',
		marca_vehiculo='".$_REQUEST['cmb_marca']."',
		modelo_vehiculo='".$_REQUEST['cmb_modelo']."',
		color_vehiculo='".$_REQUEST['txt_color']."',
		motor_vehiculo='".$_REQUEST['cmb_motor']."',
		tipo_motor_vehiculo='".$_REQUEST['cmb_tipo_motor']."'"); 
		
		$sql_vehiculo=mysql_query("select max(id_vehiculo) from vehiculos");
		$datos_vehiculo=mysql_fetch_array($sql_vehiculo);
		
		$id_vehiculo=$datos_vehiculo[0];
		

	}
	
	
	
	$update_cotizacion=mysql_query("UPDATE cotizaciones SET 
	id_cliente='".$id_cliente."',
	observacion_cotizacion='".$_REQUEST['txt_observacion']."',
	total_mano_cotizacion='".$_REQUEST['txt_mano_obra']."',
	total_repuestos_cotizacion='".$_REQUEST['txt_repuestos']."',
	neto_cotizacion='".$_REQUEST['txt_neto']."',
	iva_cotizacion='".$_REQUEST['txt_iva']."',
	total_cotizacion='".$_REQUEST['txt_total_bruto']."',
	hora_cotizacion='18:00:00',
	id_empleado='".$empleado."'
	WHERE id_cotizacion='".$_REQUEST['txt_cotizacion']."'");
	
	echo(1);
	die;
	
}




if($accion=="cancelar_cotizacion"){
	
	
	/*$eliminar_detalle_producto=mysql_query("DELETE FROM detalle_cotizacion_producto WHERE id_cotizacion='".$_REQUEST['cotizacion']."'");
	$eliminar_detalle_trabajo=mysql_query("delete from detalles_cotizacion_trabajo WHERE id_cotizacion='".$_REQUEST['cotizacion']."'");*/
		
	echo(1);
	die;
}

if($accion=="anular_cotizacion"){
	
	$anula_cotizacion=mysql_query("update cotizaciones set estado_cotizacion='0' where id_cotizacion='".$_REQUEST['cotizacion']."'");
	
	echo(1);
	die;
}
