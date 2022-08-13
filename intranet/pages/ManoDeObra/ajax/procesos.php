<?
include("../../../functions/funciones.php");
conecta_bd();

$fecha_actual=fecha_actual("bd");
$hora_actual=hora_actual();
$accion=$_REQUEST["accion"];



if($accion=="guardar_trabajo")
{ 
	$nombre_trabajo=str_replace(" ","",$_REQUEST["nombre_trabajo"]);
	$nombre_trabajo=strtoupper($nombre_trabajo);
	
	$trabajo_existe_consulta=mysql_query("select *
											from trabajos
											where replace(upper(nombre_trabajo),' ','') ='".$nombre_trabajo."' ");
	
 	
	// Si no existe se guarda
	if(mysql_num_rows($trabajo_existe_consulta)==0)
	{
		$nombre_trabajo=$_REQUEST["nombre_trabajo"];
		$nombre_trabajo=strtoupper(substr($nombre_trabajo,0,1)).strtolower(substr($nombre_trabajo,1));
		mysql_query("insert into trabajos
					 set 
					 nombre_trabajo='".$nombre_trabajo."'
					
					");
 
		//---- rescato el id para insertar el valor en otra tabla
		$nombre_trabajo=str_replace(" ","",$_REQUEST["nombre_trabajo"]);
		$nombre_trabajo=strtoupper($nombre_trabajo);
		$trabajo_consulta=mysql_query("select *
												from trabajos
												where replace(upper(nombre_trabajo),' ','') ='".$nombre_trabajo."' ");
		$trabajo_datos=mysql_fetch_array($trabajo_consulta);
		
		mysql_query("insert into precios_trabajos set id_trabajo='".$trabajo_datos["id_trabajo"]."', precio_trabajo='".formato_numero(0,$_REQUEST["precio_trabajo"])."', fecha_precio_trabajo='".$fecha_actual."',estado_precio_trabajo='Activo'");
		
	
		echo 1;
	}else{
		echo 0;
		
	}
	
	
}


if($accion=="editar_trabajo")
{
	 $id_trabajo=$_REQUEST["id_trabajo"];
	 $nombre_trabajo=$_REQUEST["nombre_trabajo"];
	 $precio_trabajo=formato_numero(0,$_REQUEST["precio_trabajo"]);
	
	 $datos_trabajo=datos_trabajo( 0,$id_trabajo,0);
	// Pregunta si existe el id del trabajo
	
	  
	
	
	if($datos_trabajo==2)
	{
		echo 0;
	}else{
		//pregunta si existe otro trabajo con ese mismo nombre
		$precios_iguales=datos_trabajo( 3,$id_trabajo,$nombre_trabajo);
		
		 
		if($precios_iguales==0)
		{
			echo 0;
			
		}else{
			// preguntar si el precio es el mismo 
			 
			if($datos_trabajo["precio_trabajo"]==$precio_trabajo)
			{
				
				mysql_query("update trabajos
							 set
							 nombre_trabajo='".$nombre_trabajo."'
							 where id_trabajo='".$id_trabajo."' 
							 ");
				
			echo 1;
				
			}else{
				
				 
				mysql_query("update precios_trabajos 
							set 
							estado_precio_trabajo='Inactivo' 
							where id_precio_trabajo='".$datos_trabajo["id_precio_trabajo"]."'");
			
				
				mysql_query("insert into precios_trabajos
							set
							id_trabajo='".$id_trabajo."',
							precio_trabajo='".$precio_trabajo."',
							fecha_precio_trabajo='".$fecha_actual."',
							estado_precio_trabajo='Activo'
							");
				
			echo 1;
			
			}
			
			

		}
		
	}
	
	
}

if($accion=="cargar_trabajo")
{
	 
		
	$trabajo_existe_consulta=mysql_query("select *
											from trabajos join precios_trabajos using(id_trabajo)
											where id_trabajo='".$_REQUEST["id_trabajo"]."'  and estado_precio_trabajo='Activo' ");
	 
 	if(mysql_num_rows($trabajo_existe_consulta)==1)
	{
		
		$trabajo_datos=mysql_fetch_array($trabajo_existe_consulta);
		
		$trabajo_devolver="";
		$trabajo_devolver.=$trabajo_datos["id_trabajo"]."-separate-";
		$trabajo_devolver.=$trabajo_datos["nombre_trabajo"]."-separate-";
		$trabajo_devolver.=$trabajo_datos["fecha_precio_trabajo"]."-separate-";
		$trabajo_devolver.=$trabajo_datos["precio_trabajo"]."-separate-";
		
		echo $trabajo_devolver;
	}else{
		echo 0;;
	}
	
	
	
		//echo $empelado_datos;
	
}


if($accion=="cargar_rut_cliente")
{

		$rut=$_REQUEST["rut_cliente"];
	$rut=formato_rut($rut,0);
	$empelado_datos=datos_global($rut,"rut_cliente","clientes","id_cliente","clientes","id_cliente,nombre_cliente,rut_cliente,correo_cliente,fono_cliente,fono2_cliente,direccion_cliente,tipo_cliente");
	
		echo $empelado_datos;
	
}





 









