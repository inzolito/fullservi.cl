<?
include("../../../functions/funciones.php");
conecta_bd();

$fecha_actual=fecha_actual("bd");
$hora_actual=hora_actual();
$accion=$_REQUEST["accion"];

 
if($accion=="guardar_producto")
{ 

	 
	$nombre_producto=str_replace(" ","",$_REQUEST["nombre_producto"]);
	$nombre_producto=strtoupper($nombre_producto);
	$producto_existe_consulta=mysql_query("select *
											from productos
											where replace(upper(nombre_producto),' ','') ='".$nombre_producto."' ");

	$precio_producto=formato_numero(0,$_REQUEST["valor_venta"]);			
	$costo=formato_numero(0,$_REQUEST["precio_producto"]);										
	$min_stock=formato_numero(0,$_REQUEST["min_producto"]);
	$max_stock=formato_numero(0,$_REQUEST["max_producto"]);		
	$stock_real=formato_numero(0,$_REQUEST["stock_real_producto"]);

 
 	if(count($nombre_producto)>0 && count($precio_producto)>0 && $min_stock>0 && $max_stock>0 && $stock_real>0 && $costo>0)
	{
		
		 
			// Si no existe se guarda
			if(mysql_num_rows($producto_existe_consulta)==0)
			{
				
				$nombre_producto=$_REQUEST["nombre_producto"];
				$nombre_producto=strtoupper(substr($nombre_producto,0,1)).strtolower(substr($nombre_producto,1));
				mysql_query("insert into productos
							 set
							 nombre_producto='".$nombre_producto."',
							 stock_minimo_producto='".$min_stock."',
							 stock_maximo_producto='".$max_stock."',
							 stock_real_producto='".$stock_real."',
							 marca_producto='".$_REQUEST["marca_producto"]."' 
							  ");
				$datos_producto=datos_global($nombre_producto,"nombre_producto","productos","*");  
				mysql_query("
				
							insert into historial_productos
							set
							id_producto='".$datos_producto["id_producto"]."',
							entrada_hp='".$stock_real."',
							salida_hp='0',
							costo_hp='".$costo."',
							fecha_hp='".$fecha_actual."',
							hora_hp='".$hora_actual."'
							
							");
				mysql_query("
							insert into precios_productos
							set
							id_producto='".$datos_producto["id_producto"]."',
							precio_producto='".$precio_producto."',
							fecha_precio_producto='".$fecha_actual."',
							estado_precio_producto='1'
							");

				echo 1;
			}else{
				echo 2;

			}
	}else{
		
		echo 0;
	}
	
}


if($accion=="editar_producto")
{
	 $id_producto=$_REQUEST["id_producto"];
	 $nombre_producto=$_REQUEST["nombre_producto"];
	 
	
	 $datos_producto=datos_global($id_producto,"ID_PRODUCTO","PRODUCTOS","*"); 
	// Pregunta si existe el id del producto
	
	  
	$producto_existe_consulta=mysql_query("select *
											from productos
											where replace(upper(nombre_producto),' ','') ='".$nombre_producto."' and 
											id_producto<>'".$id_producto."' ");

	$precio_producto=formato_numero(0,$_REQUEST["valor_venta"]);											
	$costo=formato_numero(0,$_REQUEST["precio_producto"]);										
	$min_stock=formato_numero(0,$_REQUEST["min_producto"]);
	$max_stock=formato_numero(0,$_REQUEST["max_producto"]);		
	$stock_real=formato_numero(0,$_REQUEST["stock_real_producto"]);
 
	
 
 	if(count($nombre_producto)>0 && count($precio_producto)>0 && $min_stock>0 && $max_stock>0 && $costo>0)
	{
		
		 
			// Si no existe se guarda
			if(mysql_num_rows($producto_existe_consulta)==0)
			{
				$producto_existe_consulta=mysql_query(" select *
														from productos as p join precios_productos as pp using(id_producto) right join historial_productos as hp using (id_producto)
														where 
														estado_precio_producto='1' and
														id_hp=( select max(id_hp) idhp
															   from historial_productos
															   where id_producto='".$_REQUEST["id_producto"]."')
														");
		 
											
				$producto_datos=mysql_fetch_array($producto_existe_consulta);
				$nombre_producto=$_REQUEST["nombre_producto"];
				$nombre_producto=strtoupper(substr($nombre_producto,0,1)).strtolower(substr($nombre_producto,1));
				
 
		 
			//------------------------------------------Modificacion de stock-----------------------------------------------//		  
			$stock_nuevo=0;
			$stock_entrada=0;
			$stock_salida=0;
			 
			// paso 1 crear stock antiguo
			// paso 2 determinar si se estaba poniendo o sacando anteriormente
			// paso 3  ver si la diferencia del stock de ahora es mayor o menor a la antigua para ponerlo en entrada o salida
			
			//paso 1
			if($producto_datos["salida_hp"]==0)
			{
				$stock_antiguo=$producto_datos["stock_real_producto"]-$producto_datos["entrada_hp"];
				
 			}else{
				    // cuando habia una salida antes 
				$stock_antiguo=$producto_datos["stock_real_producto"]+$producto_datos["salida_hp"];
			}
			
			if($stock_real>$stock_antiguo)
			{
				$stock_entrada=$stock_real-$stock_antiguo;
				$stock_salida=0;
			}else if($stock_real<$stock_antiguo){
				$stock_entrada=0;
				$stock_salida=$stock_antiguo-$stock_real;
				
			}else{
				
				
			}
			/*
			
			if($stock_real> $producto_datos["stock_real_producto"] )
			{
				
				// Agregar
				 $stock_nuevo=$stock_real;
			
				if($producto_datos["salida_hp"]==0)
				{
					$stock_antiguo=$producto_datos["stock_real_producto"]-$producto_datos["entrada_hp"];
					$stock_entrada=($stock_real-$stock_antiguo);
					 
				}else{
				    // cuando habia una salida antes 
					$stock_antiguo=$producto_datos["stock_real_producto"]+$producto_datos["salida_hp"];
					$stock_entrada=($stock_real-$stock_antiguo);
				
				
				}	
			
				
			}else if($stock_real< $producto_datos["stock_real_producto"]){
				// Quitar
		
		
				if($producto_datos["salida_hp"]==0)
				{
					$stock_antiguo=$producto_datos["stock_real_producto"]-$producto_datos["entrada_hp"];
					$stock_salida=($stock_antiguo-$stock_real);				
				
				}else{
				    // cuando habia una salida antes 
					$stock_antiguo=$producto_datos["stock_real_producto"]+$producto_datos["salida_hp"];
					$stock_salida=($stock_antiguo-$stock_real);				
				}	
	
			}else{
				// Igual
				
			}
			
			*/
				mysql_query("
				
							update historial_productos
							set
							id_producto='".$producto_datos["id_producto"]."',
							entrada_hp='".$stock_entrada."',
							salida_hp='".$stock_salida."',
							costo_hp='".$costo."',
							fecha_hp='".$fecha_actual."',
							hora_hp='".$hora_actual."'
							where id_hp='".$producto_datos["id_hp"]."'							
							");
				
			$stock_nuevo=$stock_real;	
			//--------------------------------------------------------------------------------------------------------//
			
			//----------------------------------- Modificacion del precio -------------------------//
			
			
			if($precio_producto==$producto_datos["precio_producto"])
			{
				
			}else{
				
				mysql_query("update precios_productos
							 set
							 estado_precio_producto='0'
							 where id_precio_producto='".$producto_datos["id_precio_producto"]."'
							 ");
				
				mysql_query("
							insert into precios_productos
							set
							id_producto='".$producto_datos["id_producto"]."',
							precio_producto='".$precio_producto."',
							fecha_precio_producto='".$fecha_actual."',
							estado_precio_producto='1'
							");	
			}
							  
				mysql_query("update productos
							 set 
							 nombre_producto='".$nombre_producto."',
							 stock_minimo_producto='".$min_stock."',
							 stock_maximo_producto='".$max_stock."',
							 stock_real_producto='".$stock_nuevo."',
							 marca_producto='".$_REQUEST["marca_producto"]."' 
							 where id_producto='".$id_producto."'
							 
							  ");
							  
					
								  
				
				echo 1;
			}else{
				echo 2;

			}
	}else{
		
		echo 0;
	}
	
	 
	
	
}

if($accion=="cargar_producto")
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


if($accion=="quitar_stock")
{
	
  	$stock_quitar=formato_numero(0,$_REQUEST["cantidad_quitar_stock"]);
	 $id_producto=$_REQUEST["id_producto"];

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
		$datos_producto=mysql_fetch_array($producto_existe_consulta);
	
	
	
				mysql_query("
							
										insert into historial_productos
										set
										id_producto='".$id_producto."',
										entrada_hp='0',
										costo_hp='".$datos_producto["costo_hp"]."',
										salida_hp='".$stock_quitar."',
										fecha_hp='".$fecha_actual."',
										hora_hp='".$hora_actual."'
										
										");
			
			
			$stock_new=(int)$datos_producto["stock_real_producto"] -(int)$stock_quitar;						
		
			 mysql_query("update productos
										 set 
										 stock_real_producto='".$stock_new."'
										 where id_producto='".$id_producto."'
										 
										  ");
	
		/**/
	}else{
	
		echo 0;
		
	}
}

 


 


if($accion=="agregar_stock")
{
	
  	$stock_agregar=formato_numero(0,$_REQUEST["cantidad_quitar_stock"]);
	$id_producto=$_REQUEST["id_producto"];
	$costo=formato_numero(0,$_REQUEST["precio_producto"]);										




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
		$datos_producto=mysql_fetch_array($producto_existe_consulta);
	
	
	
				mysql_query("
							
										insert into historial_productos
										set
										id_producto='".$id_producto."',
										entrada_hp='".$stock_agregar."',
										costo_hp='".$costo."',
										salida_hp='0',
										fecha_hp='".$fecha_actual."',
										hora_hp='".$hora_actual."'
										
										");
			
			
			$stock_new=(int)$datos_producto["stock_real_producto"] +(int) $stock_agregar;						
		
			 mysql_query("update productos
										 set 
										 stock_real_producto='".$stock_new."'
										 where id_producto='".$id_producto."'
										 
										  ");
										  
										  
										  echo 1;
	
		/**/
	}else{
	
		echo 0;
		
	}
}

 








