<?
include("../../../functions/funciones.php");
conecta_bd();

$fecha_actual=fecha_actual();
$hora_actual=hora_actual();
$accion=$_REQUEST["accion"];



if($accion=="guardar_proveedor")
{
	
	

	if($_REQUEST['rut_proveedor']==""||$_REQUEST['nombre_proveedor']==""||$_REQUEST['nombre_proveedor']==""||$_REQUEST['contacto']==""||$_REQUEST['direccion_proveedor']==""){
		
		echo(4);
		die;
		
	}

	
	$rut=$_REQUEST["rut_proveedor"];
	$rut=formato_rut($rut,0);
	
	
	
	$empelado_existe_consulta=mysql_query("select * from proveedores where rut_proveedor='".$rut."' ");
	
 	
	if(mysql_num_rows($empelado_existe_consulta)==0)
	{
		mysql_query("insert into proveedores
					set
					nombre_proveedor='".$_REQUEST["nombre_proveedor"]."',
					rut_proveedor='".$rut."',
					mail_proveedor='".$_REQUEST["mail_proveedor"]."',
					fono_proveedor='".$_REQUEST["fono_proveedor"]."',
					fono2_proveedor='".$_REQUEST["fono2_proveedor"]."',
					direccion_proveedor='".$_REQUEST["direccion_proveedor"]."',
					contacto_proveedor='".$_REQUEST["contacto"]."'

					");
		
		echo 1;
	}else{
		
		echo 0;
		
	}
	
	
}


if($accion=="editar_proveedor")
{
	 
	$rut=$_REQUEST["rut_proveedor"];
	$rut=formato_rut($rut,0);
	
 	$empelado_existe_consulta=mysql_query("select * from proveedores where rut_proveedor='".$rut."' ");
	
 	
	if(mysql_num_rows($empelado_existe_consulta)==0)
	{
		echo 0;
		
	}else{
		mysql_query("update  proveedores
					set
					nombre_proveedor='".$_REQUEST["nombre_proveedor"]."',
					rut_proveedor='".$rut."',
					mail_proveedor='".$_REQUEST["mail_proveedor"]."',
					fono_proveedor='".$_REQUEST["fono_proveedor"]."',
					fono2_proveedor='".$_REQUEST["fono2_proveedor"]."',
					direccion_proveedor='".$_REQUEST["direccion_proveedor"]."',
					contacto_proveedor='".$_REQUEST["contacto"]."'

					where	rut_proveedor='".$rut."'
					");
		 
 

		echo 1;
	}
	
	
}

if($accion=="cargar_proveedor")
{

	$empelado_datos=datos_global($_REQUEST["id_proveedor"],"id_proveedor","proveedores","id_proveedor,nombre_proveedor,rut_proveedor,mail_proveedor,fono_proveedor,fono2_proveedor,direccion_proveedor,contacto_proveedor");
	
		echo $empelado_datos;
	
}
if($accion=="cargar_rut_proveedor")
{

		$rut=$_REQUEST["rut_proveedor"];
	$rut=formato_rut($rut,0);
	$proveedor_datos=datos_global($rut,"rut_proveedor","proveedores", "id_proveedor,nombre_proveedor,mail_proveedor,direccion_proveedor,contacto_proveedor,fono_proveedor,fono2_proveedor");
	
		echo $proveedor_datos;
	
}





 