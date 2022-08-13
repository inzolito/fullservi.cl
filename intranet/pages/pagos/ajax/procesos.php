<?
	include("../../../functions/funciones.php");
	conecta_bd();
 
$accion=$_REQUEST['accion'];
$fecha=formato_fecha("bd",date("d-m-Y"));	
$hora=hora_actual();



if($accion=="guardar_pago"){
	
	
	
	$id_estado_cuenta=datos_global($_REQUEST['txt_orden'],"id_orden","estados_cuenta","id_estado_cuenta");
	
	
	if($_REQUEST['txt_tipo_pago']=='efectivo' || $_REQUEST['txt_tipo_pago']=='cheque_dia'){
		
		
		if(formato_numero(0,$_REQUEST['txt_pago_total'])){
			   
			$insert_pagos_cuenta=mysql_query("insert into pagos_cuenta SET 
			fecha_pago='$fecha',
			monto_pago='".formato_numero(0,$_REQUEST['txt_pago_total'])."',
			tipo_pago='efectivo',
			id_estado_cuenta=$id_estado_cuenta,
			tipo_pago_2='total',
			estado_pago=1,
			hora_pago='$hora'");
			
		   
			
		
			 $estado_cuenta='pagada';

			  $update_cuenta=mysql_query("Update estados_cuenta SET 
			  estado_cuenta='".$estado_cuenta."'
			  where id_orden='".$_REQUEST['txt_orden']."'");
			echo(1);
			
		}
		
		
		if(formato_numero(0,$_REQUEST['txt_abono'])>0){
			
			
			
			$sql_pagos=mysql_query("select sum(monto_pago) from pagos_cuenta where id_estado_cuenta=$id_estado_cuenta and estado_pago=1");
			$dato_pago=mysql_fetch_array($sql_pagos);
			
			if($dato_pago[0]==""){
				
				$insert_pagos_cuenta=mysql_query("insert into pagos_cuenta SET 
				fecha_pago='$fecha', 
				monto_pago='".formato_numero(0,$_REQUEST['txt_abono'])."',
				
				tipo_pago='".$_REQUEST['txt_tipo_pago']."',
				id_estado_cuenta=$id_estado_cuenta,
				tipo_pago_2='abono',
				estado_pago=1,
				hora_pago='$hora'");
				
				echo(1);
			}else{
				
								
				$datos_orden=datos_global($_REQUEST['txt_orden'],"id_orden","ordenes_trabajo","*");
				
				if(formato_numero(0,$_REQUEST['txt_abono'])+$dato_pago[0]>=$datos_orden['total_pagar_orden']){
				
						echo(2);
						die;
				
			    }else{
					
					$insert_pagos_cuenta=mysql_query("insert into pagos_cuenta SET 
					fecha_pago='$fecha',
					monto_pago='".formato_numero(0,$_REQUEST['txt_abono'])."',
					
					tipo_pago='".$_REQUEST['txt_tipo_pago']."',
					id_estado_cuenta=$id_estado_cuenta,
					tipo_pago_2='abono',
					estado_pago=1,
					hora_pago='$hora'");
					
					echo(1);
				
					
				}
			
			
			
			}
			 			
			
		}
		
		
		
	}else{
		
		if($_REQUEST['txt_tipo_pago']=='cheque_fecha'){
			
			
		   if($_REQUEST['txt_fecha_2']==""){
			
			if($_REQUEST['txt_monto1']=="" || formato_numero(0,$_REQUEST['txt_monto1'])==0 ){
				
				echo(3);
				die;
				
			}else{
			
			$insert_pagos_cuenta=mysql_query("insert into pagos_cuenta SET 
			fecha_pago='',
			monto_pago='".formato_numero(0,$_REQUEST['txt_monto1'])."',
			fecha_programacion_pago='".$_REQUEST['txt_fecha_1']."',
			tipo_pago='cheque_fecha',
			id_estado_cuenta=$id_estado_cuenta,
			tipo_pago_2='pago_programado',
			estado_pago=2,
			hora_pago=''");
				echo(1);
				
			}
			
			   
			   
		}else{
			   
			   if($_REQUEST['txt_monto1']=="" || formato_numero(0,$_REQUEST['txt_monto1'])==0 || $_REQUEST['txt_monto2']=="" || formato_numero(0,$_REQUEST['txt_monto2'])==0 ){
				
				echo(3);
				die;
				
			}
			
			$insert_pagos_cuenta=mysql_query("insert into pagos_cuenta SET 
			fecha_pago='',
			monto_pago='".formato_numero(0,$_REQUEST['txt_monto1'])."',
			fecha_programacion_pago='".$_REQUEST['txt_fecha_1']."',
			tipo_pago='cheque_fecha',
			id_estado_cuenta=$id_estado_cuenta ,
			tipo_pago_2='pago_programado',
			estado_pago=2,
			hora_pago=''");
			 
			   

			$insert_pagos_cuenta2=mysql_query("insert into pagos_cuenta SET 
			fecha_pago='',
			monto_pago='".formato_numero(0,$_REQUEST['txt_monto2'])."',
			fecha_programacion_pago='".$_REQUEST['txt_fecha_2']."',
			tipo_pago='cheque_fecha',
			id_estado_cuenta=$id_estado_cuenta,
			tipo_pago_2='pago_programado',
			estado_pago=2,
			hora_pago=''");
		
		   echo(1);
		   
		   
		   }
			
			
			
		}
		
		
		
		
		
	}
       
	
}

if($accion=='anular_pago'){
	
	
	
	$id_estado_cuenta=datos_global($_REQUEST['orden'],"id_orden","estados_cuenta","id_estado_cuenta");
	
	$update_pago=mysql_query("update pagos_cuenta set estado_pago=0, motivo_anulacion_pago='".$_REQUEST['motivo']."' where id_pago='".$_REQUEST['pago']."'");

	$sql_pago=mysql_query("select count(*) from pagos_cuenta where id_estado_cuenta=$id_estado_cuenta and estado_pago=1");
	
	$dato_pago=mysql_fetch_array($sql_pago);
		
	
		      $update_cuenta=mysql_query("Update estados_cuenta SET 
			  estado_cuenta='por pagar'
			  where id_orden='".$_REQUEST['orden']."'");
	
			
	
	echo(1)
;}


if($accion=="validar_pago"){
	
	$id_estado_cuenta=datos_global($_REQUEST['orden'],"id_orden","estados_cuenta","id_estado_cuenta");
	
	$sq_update=mysql_query("UPDATE pagos_cuenta SET 
	estado_pago=1,
	fecha_pago='".$fecha."'
	WHERE id_pago='".$_REQUEST['pago']."'");
	
	$datos_orden=datos_global($_REQUEST['orden'],"id_orden","ordenes_trabajo","*");
	
	$sql_pagos=mysql_query("select sum(monto_pago) from pagos_cuenta where id_estado_cuenta=$id_estado_cuenta and estado_pago=1");
	
	$dato_pago=mysql_fetch_array($sql_pagos);
	
	
	
	if($dato_pago[0]==$datos_orden['total_pagar_orden']){
		
		 $update_cuenta=mysql_query("Update estados_cuenta SET 
			  estado_cuenta='pagada'
			  where id_orden='".$_REQUEST['orden']."'");
	
	
	}
	
	echo(1);
	
}
?>