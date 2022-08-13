<?
include("../../../functions/funciones.php");
conecta_bd();

$fecha_actual=fecha_actual();
$hora_actual=hora_actual();
$accion=$_REQUEST["accion"];



if($accion=="guardar_cliente")
{
	$rut=$_REQUEST["rut_cliente"];
	$rut=formato_rut($rut,0);
	

	if($_REQUEST["nombre_cliente"]=="" || $rut=="" || $_REQUEST['fono_cliente']=="" || $_REQUEST['direccion_cliente']=="" || $_REQUEST['tipo_cliente']=0){
		
		echo(2);
			die;
	}
	
	$empelado_existe_consulta=mysql_query("select * from clientes where rut_cliente='".$rut."' ");
	
	// 	echo "select * from clientes where rut_cliente='".$rut."' ";
	if(mysql_num_rows($empelado_existe_consulta)==0)
	{
		mysql_query("insert into clientes
					set
					nombre_cliente='".$_REQUEST["nombre_cliente"]."',
					rut_cliente='".$rut."',
					correo_cliente='".$_REQUEST["mail_cliente"]."',
					fono_cliente='".$_REQUEST["fono_cliente"]."',
					fono2_cliente='".$_REQUEST["fono2_cliente"]."',
					direccion_cliente='".$_REQUEST["direccion_cliente"]."',
					tipo_cliente='".$_REQUEST["tipo_cliente"]."'

					");
 
		echo 1;
	}else{
		echo 0;
		
	}
	
	
}


if($accion=="editar_cliente")
{

	$id_cliente=$_REQUEST["id_cliente"];
	$rut=$_REQUEST["rut_cliente"];
	$rut=formato_rut($rut,0);
	
 	$empelado_existe_consulta=mysql_query("select * from clientes where id_cliente='".$id_cliente."' ");
	
 	
	if(mysql_num_rows($empelado_existe_consulta)==0)
	{
		echo 0;
		
	}else{
		mysql_query("update  clientes
					set
					rut_cliente='".$rut."' ,
					nombre_cliente='".$_REQUEST["nombre_cliente"]."',
 					correo_cliente='".$_REQUEST["mail_cliente"]."',
					fono_cliente='".$_REQUEST["fono_cliente"]."',
					fono2_cliente='".$_REQUEST["fono2_cliente"]."',
					direccion_cliente='".$_REQUEST["direccion_cliente"]."',
					tipo_cliente='".$_REQUEST["tipo_cliente"]."'

					where	id_cliente='".$id_cliente."'
					");
		 
 

		echo 1;
	}
	
	
}

if($accion=="cargar_cliente")
{
		$empelado_datos=datos_global($_REQUEST["id_cliente"],"id_cliente","clientes","id_cliente,nombre_cliente,rut_cliente,correo_cliente,fono_cliente,fono2_cliente,direccion_cliente,tipo_cliente");
	
		echo $empelado_datos;
	
}
if($accion=="cargar_rut_cliente")
{

	$rut=$_REQUEST["rut_cliente"];
	$rut=formato_rut($rut,0);
	$empelado_datos=datos_global($rut,"rut_cliente","clientes","id_cliente,nombre_cliente,rut_cliente,correo_cliente,fono_cliente,fono2_cliente,direccion_cliente,tipo_cliente");
	
		echo $empelado_datos;
	
}





 









