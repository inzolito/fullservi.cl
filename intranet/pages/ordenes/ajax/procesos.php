<?
	include("../../../functions/funciones.php");
	conecta_bd();
 
$accion=$_REQUEST['accion'];
$fecha=formato_fecha("bd",date("d-m-Y"));	
$hora=hora_actual();

if($accion=='crear_orden'){
	

	
	
	if($_REQUEST['identificador']==0){
		
		
			//$existe=datos_global($_REQUEST['patente'],"PATENTE_VEHICULO","VEHICULOS", "existe");
			
		$existe=0;
 	

		 if(consulta_vehiculo($_REQUEST['patente'],0,0)==0)
		 {
			$existe=0;
		 }else{
			$existe=1;
			
		 }
	 
		 
	if($existe>=1){
		
		die;
	}else{
		
		$inserta_vehiculo=mysql_query("INSERT INTO vehiculos SET 
		 patente_vehiculo='".$_REQUEST['patente']."'");
		
		$sql_id=mysql_query("select max(id_vehiculo) from vehiculos");
		$id=mysql_fetch_array($sql_id);
		
		$insert_orden=mysql_query("insert into ordenes_trabajo set id_vehiculo='".$id['max(id_vehiculo)']."', 
		id_empleado=1, 
		fecha_orden='".$fecha."',
		hora_orden='".$hora."',
		estado_orden='incompleta',
		total_mano_obra_orden='0',
		total_repuestos_orden='0',
		total_pagar_orden='0'
		total_orden='0'");
	
		$query_orden=mysql_query("select max(id_orden) from ordenes_trabajo");

		$dato_orden=mysql_fetch_array($query_orden);   
	
		$insert_articulo=mysql_query("insert into articulos_orden SET
		llantas='4',
		encendedor='si',
		padron='si',
		id_orden='".$dato_orden[0]."',
		espejo_int='si', 
		espejo_ext='si', 
		bencina='0', 
		plumillas='si', 
		pisos='1', 
		tapa_bencina='si', 
		tapa_rueda='si', 
		extintor='si', 
		botiquin='si', 
		triangulos='si', 
		rueda_repuesto='si', 
		gata='si', 
		herramienta='si'");
		
		$sql_max=mysql_query("select max(id_orden) from ordenes_trabajo");
		$dato_max=mysql_fetch_array($sql_max);

	
		
		echo("2_".$dato_max['max(id_orden)']);
		
		
	}
		
		
		
	}else{
		
		
	$insert_orden=mysql_query("insert into ordenes_trabajo set id_vehiculo='".$_REQUEST['identificador']."', 
	id_empleado=1, 
	fecha_orden='".$fecha."',
	estado_orden='incompleta',
	total_mano_obra_orden='0',
	total_repuestos_orden='0',
	total_orden='0'");
	
	$query_orden=mysql_query("select max(id_orden) from ordenes_trabajo");

	$dato_orden=mysql_fetch_array($query_orden);   
	
		$insert_articulo=mysql_query("insert into articulos_orden SET
		llantas='4',
		encendedor='si',
		padron='si',
		id_orden='".$dato_orden[0]."',
		espejo_int='si', 
		espejo_ext='si', 
		bencina='0', 
		plumillas='si', 
		pisos='1', 
		tapa_bencina='si', 
		tapa_rueda='si', 
		extintor='si', 
		botiquin='si', 
		triangulos='si', 
		rueda_repuesto='si', 
		gata='si', 
		herramienta='si'");
	
	$sql_max=mysql_query("select max(id_orden) from ordenes_trabajo");
	$dato_max=mysql_fetch_array($sql_max);
	
	mysql_query("INSERT INTO estados_cuenta SET
	id_cliente=0,
	estado_cuenta='por pagar',
	id_orden='".$dato_max['max(id_orden)']."'");
		
	echo("1_".$dato_max['max(id_orden)']);
	//echo(1);
	}
	

}






	
if($accion=='buscar_cliente'){	
	
	$rut=$_REQUEST['rut'];
    $rut=formato_rut($rut,0);	
	
	$datos_cliente=datos_global($rut,"rut_cliente","clientes","id_cliente,rut_cliente,nombre_cliente,correo_cliente,fono_cliente,fono2_cliente,direccion_cliente,tipo_cliente");
 
     echo $datos_cliente;
	die;
}


if($accion=='ingresar_detalle_trabajo'){
	
	if($_REQUEST['id_trabajo']==0){
		
		echo(1);
		die;
		
	}
	
	$consulta_existe=mysql_query(" select * from detalles_ordenes_trabajos  where id_orden='".$_REQUEST['id_orden']."' and id_trabajo='".$_REQUEST['id_trabajo']."'");
	
		
	if(mysql_num_rows($consulta_existe)==0){
		
		
		$insert_detalle_trabajo=mysql_query("INSERT INTO detalles_ordenes_trabajos SET id_orden='".$_REQUEST['id_orden']."',id_trabajo='".$_REQUEST['id_trabajo']."',id_precio_trabajo='".$_REQUEST['id_precio']."'");
		
		//echo(" select * from detalles_ordenes_trabajos  where id_orden='".$_REQUEST['id_orden']."' and id_trabajo='".$_REQUEST['id_trabajo']."'");
	}else{
		//echo(" select * from detalles_ordenes_trabajos  where id_orden='".$_REQUEST['id_orden']."' and id_trabajo='".$_REQUEST['id_trabajo']."'");
	echo(2);
		
	}
	
	
	
	die;
	
	
	
}


if($accion=='eliminar_detalle_trabajo'){
	
	
	$eliminar_detalle_trabajo=mysql_query("delete from detalles_ordenes_trabajos where id_orden='".$_REQUEST['id_orden']."' and id_trabajo='".$_REQUEST['id_trabajo']."'");
	
		
	
}

if($accion=='crear_ingresar_trabajo'){

if($_REQUEST['trabajo']=="" || $_REQUEST['precio']==""){
	
	echo(3);
}else{
	
	$sql_existe_trabajo=mysql_query("SELECT * FROM trabajos WHERE nombre_trabajo LIKE '".$_REQUEST['trabajo']."'");
	
	if(mysql_num_rows($sql_existe_trabajo)==1){
		
		echo(2);
	}else{
		
		$sql_insert_trabajo=mysql_query("INSERT INTO trabajos SET nombre_trabajo='".$_REQUEST['trabajo']."'");
		$sql_id=mysql_query("select max(id_trabajo) from trabajos");
		$max_id=mysql_fetch_array($sql_id);
		$sql_precio_trabajo=mysql_query("INSERT INTO precios_trabajos SET precio_trabajo='".formato_numero(0,$_REQUEST['precio'])."',id_trabajo='".$max_id['max(id_trabajo)']."',estado_precio_trabajo='Activo'");
		echo(1);
	}
	
}
	
	
	
	
	
}

if($accion=='ingresa_detalles_repuesto'){
	
	
	if($_REQUEST["cantidad"]==""||$_REQUEST["producto"]=""){
		
		echo(2);
		
	}else{
		
		$sql_existe_producto=mysql_query("select * from detalles_orden_producto where id_orden='".$_REQUEST["orden"]."' and id_producto='".$_REQUEST["repuesto"]."'");
		
		if(mysql_num_rows($sql_existe_producto)==0){
			
			$total=$_REQUEST['precio_unitario']*$_REQUEST['cantidad'];
			
			
			$stock_real=datos_global($_REQUEST['repuesto'],"id_producto","productos","stock_real_producto");
			
			
			if($_REQUEST['cantidad']>$stock_real){
				
				echo(4);
				die;
				
				
			}else{
			
				$sql_precio=mysql_query("select * from precios_productos where id_producto='".$_REQUEST['repuesto']."' and estado_precio_producto=1 ");
				$dato_precio=mysql_fetch_array($sql_precio);
				$datos_producto=datos_producto($_REQUEST['repuesto']);
				 
				$inserta=mysql_query("
							
										insert into historial_productos
										set
										id_producto='".$_REQUEST['repuesto']."',
										entrada_hp='0',
										documento_hp='orden',
										num_documento_hp='".$_REQUEST['orden']."',
										salida_hp='".$_REQUEST['cantidad']."',
										fecha_hp='".$fecha."',
										hora_hp='".$hora."',
										estado_hp='1',
										tipo_operacion_hp='salida',
										valor_venta_hp='".$dato_precio['precio_producto']."'
										
										");
		
									
			
			$stock_new=(int)$datos_producto["stock_real_producto"] -(int)$_REQUEST['cantidad'];						
		
			 mysql_query("update productos
										 set 
										 stock_real_producto='".$stock_new."'
										 where id_producto='".$_REQUEST['repuesto']."'
										 
										  ");
				
				$sql_insert=mysql_query("INSERT INTO detalles_orden_producto SET id_orden='".$_REQUEST['orden']."',
				id_producto='".$_REQUEST['repuesto']."',
				id_precio_producto='".$_REQUEST['precio']."',
				cantidad_producto_orden_producto='".$_REQUEST['cantidad']."',total_detalle_orden_producto='".$total."'");
			
				
				echo(1);
				
			
			
			}
			
					
			
			
			
		}else{
			
			echo(3);
		}
		
	}
	
	
	die;	
}


if($accion=='eliminar_detalle_repuesto'){
	
	
	
	$eliminar_detalle_trabajo=mysql_query("DELETE FROM detalles_orden_producto WHERE id_orden='".$_REQUEST['orden']."' and id_producto='".$_REQUEST['repuesto']."'");
	
	$eliminar_historial_trabajo=mysql_query("DELETE FROM historial_productos WHERE id_producto='".$_REQUEST['repuesto']."' and num_documento_hp='".$_REQUEST['orden']."'");
	
	//echo("DELETE FROM detalles_orden_producto WHERE id_orden='".$_REQUEST['orden']."' and id_producto='".$_REQUEST['producto']."'");
	
	$sql_update=mysql_query("UPDATE productos SET stock_real_producto=(stock_real_producto +'".$_REQUEST['cantidad']."') WHERE id_producto='".$_REQUEST['repuesto']."'");
	
	echo(1);
	
	die;
}




if($accion=='guardar_orden'){
		
     $estado_cuenta="por pagar";
     $id_cliente=''; 
	$id_empleado='';
	$monto=0;
   

	
	
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
	
	
		$vehiculo_existe=datos_global($_REQUEST['txt_patente'],"patente_vehiculo","vehiculos","existe");
		 if(consulta_vehiculo($_REQUEST['txt_patente'],0,0)==0)
		 {
			$existe=0;
		 }else{
			$existe=1;
			
		 }
	if($vehiculo_existe>=1){
		
		$update_vehiculo=mysql_query("UPDATE vehiculos SET patente_vehiculo='".$_REQUEST['txt_patente']."',
		numero_motor_vehiculo='".$_REQUEST['txt_nmotor']."',
		numero_chasis_vehiculo='".$_REQUEST['txt_nchasis']."',
		kilometraje_vehiculo='".$_REQUEST['txt_kilometraje']."',
		marca_vehiculo='".$_REQUEST['cmb_marca']."',
		modelo_vehiculo='".$_REQUEST['cmb_modelo']."',
		ano_vehiculo='".$_REQUEST['txt_ano']."',
		color_vehiculo='".$_REQUEST['txt_color']."',
		motor_vehiculo='".$_REQUEST['cmb_motor']."',
		tipo_motor_vehiculo='".$_REQUEST['cmb_tipo_motor']."' 
		WHERE id_vehiculo='".$_REQUEST['vehiculo']."'");
		
		$id_vehiculo=$_REQUEST['vehiculo'];

	}else{
		
		
		$insert_vehiculo=mysql_query("insert into vehiculos SET patente_vehiculo='".$_REQUEST['txt_patente']."',
		numero_motor_vehiculo='".$_REQUEST['txt_nmotor']."',
		numero_chasis_vehiculo='".$_REQUEST['txt_nchasis']."',
		kilometraje_vehiculo='".$_REQUEST['txt_kilometraje']."',
		marca_vehiculo='".$_REQUEST['cmb_marca']."',
		modelo_vehiculo='".$_REQUEST['cmb_modelo']."',
		ano_vehiculo='".$_REQUEST['txt_ano']."',
		color_vehiculo='".$_REQUEST['txt_color']."',
		motor_vehiculo='".$_REQUEST['cmb_motor']."',
		tipo_motor_vehiculo='".$_REQUEST['cmb_tipo_motor']."'"); 
		
		$sql_vehiculo=mysql_query("select max(id_vehiculo) from vehiculos");
		$datos_vehiculo=mysql_fetch_array($sql_vehiculo);
		
		$id_vehiculo=$datos_vehiculo[0];
		

	}
	

	$sql_trabajos=mysql_query("select * from  detalles_ordenes_trabajos where id_orden='".$_REQUEST['txt_orden']."'");
	
	if(mysql_num_rows($sql_trabajos)>0){
		
		$estado_orden='completa';
	}else{
		$estado_orden='incompleta';
		
	}
	
	$update_orden=mysql_query("UPDATE ordenes_trabajo SET
	 id_cliente='".$id_cliente."',
	 id_empleado='1',
	 id_vehiculo='".$id_vehiculo."',
	 fecha_orden='".$fecha."',
     observacion_orden='".$_REQUEST['txt_observacion']."',
     total_mano_obra_orden='".$_REQUEST['txt_mano_obra']."',
	 total_repuestos_orden='".$_REQUEST['txt_repuestos']."',
	 neto_orden='".$_REQUEST['txt_neto']."',
	 iva_orden='".$_REQUEST['txt_iva']."',
	 total_orden='".$_REQUEST['txt_total_bruto']."',
   	 descuento_orden='".formato_numero(0,$_REQUEST['txt_descuento'])."',
	 total_pagar_orden='".formato_numero(0,$_REQUEST['txt_total_pagar'])."',
	 hora_orden='".$hora."',estado_orden='$estado_orden',
	 kilometraje_orden='".$_REQUEST['txt_kilometraje']."',
	 fecha_entrega_orden='".$_REQUEST['txt_entrega']."',
	 operario_orden='".$_REQUEST['txt_operario']."'
	 WHERE id_orden='".$_REQUEST['txt_orden']."'"); //update okey
	


	
	
	
	$update_articulo=mysql_query("update articulos_orden SET 
	llantas='".$_REQUEST['select_10']."',
	encendedor='".$_REQUEST['select_2']."',
	padron='".$_REQUEST['select_1']."',
	espejo_int='".$_REQUEST['select_4']."',
	espejo_ext='".$_REQUEST['select_5']."',
	bencina='".$_REQUEST['select_3']."',
	plumillas='".$_REQUEST['select_7']."',
	pisos='".$_REQUEST['select_8']."',
	tapa_bencina='".$_REQUEST['select_6']."',
	tapa_rueda='".$_REQUEST['select_9']."',
	extintor='".$_REQUEST['select_14']."',
	botiquin='".$_REQUEST['select_15']."',
	triangulos='".$_REQUEST['select_16']."',
	rueda_repuesto='".$_REQUEST['select_11']."',
	gata='".$_REQUEST['select_12']."',
	herramienta='".$_REQUEST['select_13']."'
	 where id_orden='".$_REQUEST['txt_orden']."'");
	
	
	
	
   $insert_cuenta=mysql_query("Update estados_cuenta SET id_cliente='".$id_cliente."',
		estado_cuenta='".$estado_cuenta."',
		id_orden='".$_REQUEST['txt_orden']."'
		where id_orden='".$_REQUEST['txt_orden']."'");



	
	echo(1);
	die;
	
}

/***********************************************************************************************************************************************************/

if($accion=="guardar_editar_orden"){
	
	$estado_cuenta="por pagar";
	
	
	
		$rut=$_REQUEST["txt_rut"];
		$rut=formato_rut($rut,0);
	
	
	
	$cliente_existe=datos_global($rut,"rut_cliente","clientes","existe");
	
		
	
	if($cliente_existe==1){
		
		$datos_cliente=datos_global($rut,"rut_cliente","clientes","*");
		
		
		$update_cliente=mysql_query("UPDATE clientes SET rut_cliente='".$rut."',
		nombre_cliente='".$_REQUEST['txt_nombre']."',
		correo_cliente='".$_REQUEST['txt_correo']."',
		fono_cliente='".$_REQUEST['txt_fono']."',
		fono2_cliente='".$_REQUEST['txt_fono2']."',
		direccion_cliente='".$_REQUEST['txt_direccion']."',
		tipo_cliente='".$_REQUEST['cmb_tipo_cliente']."'
		WHERE id_cliente='".$_REQUEST['cliente']."'");
		
		$id_cliente=$datos_cliente['id_cliente'];
		
		
	}else{
		//$rut=$_REQUEST["txt_rut"];
		//$rut=formato_rut($rut,0);
		
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
	
	
	

	$query_vehi=mysql_query("SELECT * FROM vehiculos WHERE patente_vehiculo='".$_REQUEST['txt_patente']."'
 	AND id_vehiculo <> '".$_REQUEST['vehiculo']."'");
	
	
	if(mysql_num_rows($query_vehi)>0){
		
		//$vehiculo_existe=datos_global($_REQUEST['txt_patente'],"patente_vehiculo","vehiculos","existe");
		
			echo(3);
			die;

	}else{
		
		
		$update_vehiculo=mysql_query("UPDATE vehiculos SET 
		patente_vehiculo='".$_REQUEST['txt_patente']."',
		numero_motor_vehiculo='".$_REQUEST['txt_nmotor']."',
		numero_chasis_vehiculo='".$_REQUEST['txt_nchasis']."',
		kilometraje_vehiculo='".$_REQUEST['txt_kilometraje']."',
		ano_vehiculo='".$_REQUEST['txt_ano']."',
		marca_vehiculo='".$_REQUEST['cmb_marca']."',
		modelo_vehiculo='".$_REQUEST['cmb_modelo']."',
		color_vehiculo='".$_REQUEST['txt_color']."',
		motor_vehiculo='".$_REQUEST['cmb_motor']."',
		tipo_motor_vehiculo='".$_REQUEST['cmb_tipo_motor']."' 
		WHERE id_vehiculo='".$_REQUEST['vehiculo']."'");
		
		$id_vehiculo=$_REQUEST['vehiculo'];
		

	}
	
	$update_orden=mysql_query("UPDATE ordenes_trabajo SET
	 id_cliente='".$id_cliente."',
	 id_empleado='1',
	 id_vehiculo='".$id_vehiculo."',
	 fecha_orden='".$fecha."',
     observacion_orden='".$_REQUEST['txt_observacion']."',
     total_mano_obra_orden='".$_REQUEST['txt_mano_obra']."',
	 total_repuestos_orden='".$_REQUEST['txt_repuestos']."',
	 neto_orden='".$_REQUEST['txt_neto']."',
	 iva_orden='".$_REQUEST['txt_iva']."',
	 total_orden='".$_REQUEST['txt_total_bruto']."',
     abono_orden='".formato_numero(0,$_REQUEST['txt_abono'])."',
	 descuento_orden='".formato_numero(0,$_REQUEST['txt_descuento'])."',
	 total_pagar_orden='".formato_numero(0,$_REQUEST['txt_total_pagar'])."',
	 hora_orden='".$hora."',
	 estado_orden='completa',
	 kilometraje_orden='".$_REQUEST['txt_kilometraje']."',
	 fecha_entrega_orden='".$_REQUEST['txt_entrega']."',
	 operario_orden='".$_REQUEST['txt_operario']."'
	 WHERE id_orden='".$_REQUEST['txt_orden']."'"); //update okey
	
	
	
	$update_articulo=mysql_query("update articulos_orden SET 
	llantas='".$_REQUEST['select_10']."',
	encendedor='".$_REQUEST['select_2']."',
	padron='".$_REQUEST['select_1']."',
	espejo_int='".$_REQUEST['select_4']."',
	espejo_ext='".$_REQUEST['select_5']."',
	bencina='".$_REQUEST['select_3']."',
	plumillas='".$_REQUEST['select_7']."',
	pisos='".$_REQUEST['select_8']."',
	tapa_bencina='".$_REQUEST['select_6']."',
	tapa_rueda='".$_REQUEST['select_9']."',
	extintor='".$_REQUEST['select_14']."',
	botiquin='".$_REQUEST['select_15']."',
	triangulos='".$_REQUEST['select_16']."',
	rueda_repuesto='".$_REQUEST['select_11']."',
	gata='".$_REQUEST['select_12']."',
	herramienta='".$_REQUEST['select_13']."'
	 where id_orden='".$_REQUEST['txt_orden']."'");
	
	
	
	
	
   $insert_cuenta=mysql_query("Update estados_cuenta SET id_cliente='".$id_cliente."',
		estado_cuenta='".$estado_cuenta."'
		where id_orden='".$_REQUEST['txt_orden']."'");
		

	echo(1);
	
	
}
if($accion=="buscar_vehiculo"){
	
	$query_vehi=mysql_query("SELECT * FROM vehiculos WHERE patente_vehiculo='".$_REQUEST['patente']."'
 	AND id_vehiculo <> '".$_REQUEST['vehiculo']."'");
	
	
	if(mysql_num_rows($query_vehi)>0){
		
		echo(1);
		
	}
}
if($accion=="cargar_datos_vehiculo"){
	$vehiculo_existe=datos_global($_REQUEST['patente'],"patente_vehiculo","vehiculos","id_vehiculo,marca_vehiculo,modelo_vehiculo,color_vehiculo,motor_vehiculo,ano_vehiculo,tipo_motor_vehiculo,numero_motor_vehiculo,numero_chasis_vehiculo");
	
	echo($vehiculo_existe);
}

if($accion=="anular_orden"){
	
	$anula_orden=mysql_query("update ordenes_trabajo set estado_orden='anulada' where id_orden='".$_REQUEST['orden']."'");
	
	$sql_anular=mysql_query("UPDATE historial_productos SET estado_hp=0,manulacion_hp='ORDEN ANULADA' WHERE documento_hp='orden' and num_documento_hp='".$_REQUEST['orden']."'");
	
	
	
	$sql_producto=mysql_query("select * from historial_productos where  documento_hp='orden' and num_documento_hp='".$_REQUEST['orden']."'");
	
	if(mysql_num_rows($sql_producto)==0){
		
	}else{
		
		
		while($dato_producto=mysql_fetch_array($sql_producto)){
			
						
			//$stock_new=(int)$stock_real['stock_real_producto']+(int)$datos_producto['salida_hp'];		
			$sql_update=mysql_query("UPDATE productos SET stock_real_producto=(stock_real_producto +'".$dato_producto['salida_hp']."') 
		WHERE id_producto='".$dato_producto['id_producto']."'");
		
			
			
			
			echo(1);
			die;
			/*$edita_producto= mysql_query("update productos
										 set 
										 stock_real_producto='".$stock_new."'
										 where id_producto='".$datos_producto['id_producto']."'*/
									 
		
		}
		
		
			}
	
	echo(1);
		
	}
		
	
	
	

	
?> 