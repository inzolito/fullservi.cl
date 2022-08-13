<?
include("../../../functions/funciones.php");
conecta_bd();

$fecha_actual=fecha_actual("bd");
$hora_actual=hora_actual();
$accion=$_REQUEST["accion"];

 

 
if($accion=="cargar_producto")
{
	//$id_producto=$_REQUEST['id_producto'];
	
		
	$producto_existe_consulta=mysql_query(" select *
											from productos  join precios_productos  using(id_producto) 
												   where id_producto='".$_REQUEST["id_producto"]."' and estado_precio_producto=1
											");
	 
 	if(mysql_num_rows($producto_existe_consulta)==1)
	{
		
		$producto_datos=mysql_fetch_array($producto_existe_consulta);
		
 
		
		
		
		
		
		$producto_devolver="";
		$producto_devolver.=$producto_datos["id_producto"]."-separate-";
		$producto_devolver.=$producto_datos["nombre_producto"]."-separate-";
		$producto_devolver.=$producto_datos["marca_producto"]."-separate-";
		$producto_devolver.=$producto_datos["stock_minimo_producto"]."-separate-";
		$producto_devolver.=$producto_datos["stock_maximo_producto"]."-separate-";
		$producto_devolver.=$producto_datos["costo_producto"]."-separate-"; 
		$producto_devolver.=$producto_datos["stock_real_producto"]."-separate-";
		$producto_devolver.=$producto_datos["precio_producto"];
		echo $producto_devolver;
	}else{
		echo 0;;
	}
	
	
	
		//echo $empelado_datos;
	
	
	//echo datos_global($id_producto,"id_producto","productos","id_producto,nombre_producto,stock_minimo_producto,stock_maximo_producto,stock_real_producto,costo_producto");
	die;
}

 
  
if($accion=="cargar_producto_venta")
{
	 
		
	$producto_existe_consulta=mysql_query(" select *
											from productos as p join precios_productos as pp using(id_producto) right join historial_productos as hp using (id_producto)
											where 
										    estado_precio_producto='1' and
										    id_hp=( select max(id_hp) idhp
												   from historial_productos
												   where id_producto='".$_REQUEST["id_producto"]."')
											");
	 
 	if(mysql_num_rows($producto_existe_consulta)==1)
	{
		
		$producto_datos=mysql_fetch_array($producto_existe_consulta);
		
 
		
		
		
		
		
		$producto_devolver="";
		$producto_devolver.=$producto_datos["id_producto"]."-separate-";
		$producto_devolver.=$producto_datos["nombre_producto"]."-separate-";
		$producto_devolver.=$producto_datos["marca_producto"]."-separate-";
		$producto_devolver.=$producto_datos["stock_minimo_producto"]."-separate-";
		$producto_devolver.=$producto_datos["stock_maximo_producto"]."-separate-";
		$producto_devolver.=$producto_datos["costo_hp"]."-separate-"; 
		$producto_devolver.=$producto_datos["stock_real_producto"]."-separate-";
		$producto_devolver.=$producto_datos["precio_producto"];
		echo $producto_devolver;
	}else{
		echo 0;;
	}
	
	
	
		//echo $empelado_datos;
	
}


 


if($accion=="agregar_stock")
{
  	$stock_agregar=formato_numero(0,$_REQUEST["cantidad_quitar_stock"]);
	$id_producto=$_REQUEST["id_producto"];
	$costo=formato_numero(0,$_REQUEST["costo_producto"]);										
	$documento=$_REQUEST['documento'];
	$num_documento=$_REQUEST['cod_documento'];									
	$valor_venta=formato_numero(0,$_REQUEST['valor_venta_producto']);
	$id_proveedor=$_REQUEST['cmb_proveedor'];	


    $fecha_insertar=$_REQUEST["txt_fecha"];



					 $producto_existe_consulta=mysql_query("select *
											from productos join precios_productos using(id_producto)
											where 
										    estado_precio_producto='1' and id_producto='".$_REQUEST["id_producto"]."'");
	if(mysql_num_rows($producto_existe_consulta)==1)
	{
		$datos_producto=mysql_fetch_array($producto_existe_consulta);
		
		
	
	// el agregar stock tiene costo y no valor venta ya que se sabe a cuantos e compro pero no a cuanto se vendera
				mysql_query("
							
										insert into historial_productos
										set
										id_producto='".$id_producto."',
										entrada_hp='".$stock_agregar."',
										costo_hp='".$costo."',
										documento_hp='".$documento."',
										num_documento_hp='".$num_documento."',
										salida_hp='0',
										fecha_hp='".$fecha_insertar."',
										hora_hp='".$hora_actual."',
										estado_hp='1',
										tipo_operacion_hp='entrada',
										valor_venta_hp='".$valor_venta."',
										id_proveedor='".$id_proveedor."'
										
										");
			
			
			$stock_new=(int)$datos_producto["stock_real_producto"] +(int) $stock_agregar;						
		
			 mysql_query("update productos
										 set 
										 stock_real_producto='".$stock_new."'
										 where id_producto='".$id_producto."'
										 
										  ");
										  
										  
										  echo 1;
		die;
	
		/**/
	}else{
	
		echo 0;
		
	}
}

 





if($accion=="quitar_stock")
{
	
  	$stock_quitar=$_REQUEST["cantidad_quitar_stock"];
	 $id_producto=$_REQUEST["id_producto"];
     $valor_venta=formato_numero(0,$_REQUEST['valor_venta_producto']);
	
	$documento=$_REQUEST['documento'];
	$num_documento=$_REQUEST['cod_documento'];
	
    $fecha_insertar=$_REQUEST["txt_fecha"];
	
	
					$producto_existe_consulta=mysql_query("select *
											from productos join precios_productos using(id_producto)
											where 
										    estado_precio_producto='1' and id_producto='".$_REQUEST["id_producto"]."'");
	
	if(mysql_num_rows($producto_existe_consulta)==1)
	{
		$datos_producto=mysql_fetch_array($producto_existe_consulta);
	
				
				mysql_query("
							
										insert into historial_productos
										set
										id_producto='".$id_producto."',
										entrada_hp='0',
										documento_hp='".$documento."',
										num_documento_hp='".$num_documento."',
										salida_hp='".$stock_quitar."',
										fecha_hp='".$fecha_insertar."',
										hora_hp='".$hora_actual."',
										estado_hp='1',
										tipo_operacion_hp='salida',
										valor_venta_hp='".$valor_venta."'
										
										");
		
		
		
			
			
			$stock_new=(int)$datos_producto["stock_real_producto"] -(int)$stock_quitar;						
		
			 mysql_query("update productos
										 set 
										 stock_real_producto='".$stock_new."'
										 where id_producto='".$id_producto."'
										 
										  ");
										  
										  echo 1;
		die;
	
		/**/
	}else{
	
		echo 0;
		
	}
}

if($accion="anular_hp"){
	
	$dato_historial=datos_global($_REQUEST['historial'],"id_hp","historial_productos","*");
	
	$datos_producto=datos_global($dato_historial['id_producto'],"id_producto","productos","*");
	
	$stock_quitar=$dato_historial['entrada_hp'];
	$sql_anular=mysql_query("UPDATE historial_productos SET estado_hp=0,manulacion_hp='".$_REQUEST['motivo']."' WHERE id_hp='".$_REQUEST['historial']."'");
	
		
	$stock_new=(int)$datos_producto["stock_real_producto"] -(int)$stock_quitar;		
	
	$edita_producto= mysql_query("update productos
										 set 
										 stock_real_producto='".$stock_new."'
										 where id_producto='".$datos_producto['id_producto']."'
										 
										  ");
	echo(1);
	die;
}


if($accion="anular_salida"){
	
	$dato_historial=datos_global($_REQUEST['historial'],"id_hp","historial_productos","*");
	
	$datos_producto=datos_global($dato_historial['id_producto'],"id_producto","productos","*");
	
	$stock_quitar=$dato_historial['salida_hp'];
	$sql_anular=mysql_query("UPDATE historial_productos SET estado_hp=0,manulacion_hp='".$_REQUEST['motivo']."' WHERE id_hp='".$_REQUEST['historial']."'");
	
		
	$stock_new=(int)$datos_producto["stock_real_producto"]+(int)$stock_quitar;		
	
	$edita_producto= mysql_query("update productos
										 set 
										 stock_real_producto='".$stock_new."'
										 where id_producto='".$datos_producto['id_producto']."'
										 
										  ");
	
	echo(1);
	die;
}



