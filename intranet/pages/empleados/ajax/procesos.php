<?
include("../../../functions/funciones.php");
conecta_bd();

$fecha_actual=fecha_actual();
$hora_actual=hora_actual();
$accion=$_REQUEST["accion"];


echo $accion;
if($accion=="guardar_empleado")
{
	$rut=$_REQUEST["rut_empleado"];
	$rut=formato_rut($rut,0);
	
	$empelado_existe_consulta=mysql_query("select * from empleados where rut_empleado='".$rut."' ");
	
 	
	if(mysql_num_rows($empelado_existe_consulta)==0)
	{
		mysql_query("insert into empleados
					set
					nombre_empleado='".$_REQUEST["nombre_empleado"]."',
					rut_empleado='".$rut."',
					fono_empleado='".$_REQUEST["fono_empleado"]."',
					password_empleado='".$_REQUEST["pass_empleado"]."',
					permisos_empleado='".$_REQUEST["permiso_empleado"]."',
					estado_empleado=1
					");
 
	}
	
	
}


if($accion=="editar_empleado")
{
	
	$rut=$_REQUEST["rut_empleado"];
	$rut=formato_rut($rut,0);
	
	$empelado_existe_consulta=mysql_query("select * from empleados where rut_empleado='".$rut."' ");
	
 	
	if(mysql_num_rows($empelado_existe_consulta)==0)
	{
		echo 0;
		
	}else{
		mysql_query("update  empleados
					set
					nombre_empleado='".$_REQUEST["nombre_empleado"]."',
				
					fono_empleado='".$_REQUEST["fono_empleado"]."',
					password_empleado='".$_REQUEST["pass_empleado"]."',
					permisos_empleado='".$_REQUEST["permiso_empleado"]."',
					estado_empleado=1
					where	rut_empleado='".$rut."'
					");
 
	}
	
	
}

if($accion=="cargar_empleado")
{
		$empelado_datos=datos_global($_REQUEST["id_empleado"],"id_empleado","empleados","id_empleado,nombre_empleado,rut_empleado,fono_empleado,password_empleado,permisos_empleado,estado_empleado");
	
		echo $empelado_datos;
	
}
if($accion=="cargar_rut_empleado")
{

		$rut=$_REQUEST["rut_empleado"];
	$rut=formato_rut($rut,0);
	$empelado_datos=datos_global($rut,"rut_empleado","empleados","id_empleado,nombre_empleado,rut_empleado,fono_empleado,password_empleado,permisos_empleado,estado_empleado");
	
		echo $empelado_datos;
	
}


if($accion=="dar_baja_empleado")
{
	$id=$_REQUEST["id_empleado"];
 	
	$empelado_existe_consulta=mysql_query("select * from empleados where id_empleado='".$id."' ");
	
 	
	if(mysql_num_rows($empelado_existe_consulta)==0)
	{
		echo 0;
		
	}else{
		mysql_query("update  empleados
					set
					estado_empleado=0
					where id_empleado='".$id."'
					");
 
	}	
	
}


if($accion=="dar_alta_empleado")
{
	$rut=$_REQUEST["rut_empleado"];
	$rut=formato_rut($rut,0);
	$empelado_existe_consulta=mysql_query("select * from empleados where rut_empleado='".$rut."' ");
	
  
	if(mysql_num_rows($empelado_existe_consulta)==0)
	{
		echo 0;
		
	}else{
		mysql_query("update  empleados
					set
					nombre_empleado='".$_REQUEST["nombre_empleado"]."',
				
					fono_empleado='".$_REQUEST["fono_empleado"]."',
					password_empleado='".$_REQUEST["pass_empleado"]."',
					permisos_empleado='".$_REQUEST["permiso_empleado"]."',
					estado_empleado='1'
					where	rut_empleado='".$rut."'
					");
 
	}	
	
}










