<?
include("../../../functions/funciones.php");
conecta_bd();
	
$accion=$_REQUEST["accion"];

if($accion=="ingresar_sistema")
{
		$user=mysql_real_escape_string($_REQUEST['txt_usuario']) ;
		$password=mysql_real_escape_string($_REQUEST['txt_password']);
		$empleados_consulta=mysql_query("select * from empleados where usuario_empleado='".$user."' and password_empleado='".$password."'");		

		if(mysql_num_rows($empleados_consulta)==1){
			session_start();
			$datos_empleado=mysql_fetch_array($empleados_consulta);
			$_SESSION['id']=$datos_empleado['id_empleado'];
			$_SESSION['nombre']=$datos_empleado['nombre_empleado'];
			$_SESSION['rut']=$datos_empleado['rut_empleado'];
			$_SESSION['permisos']=$datos_empleado['permiso_empleado'];
			
			echo 1;
		}else{
			
			echo 0;	
		
		}
		 
}
	
if($accion =='guardar_contrasena'){
		
		$pass_antigua=mysql_real_escape_string($_REQUEST['txt_contrasena_actual']) ;
		$pass_nueva=mysql_real_escape_string($_REQUEST['txt_contrasena_nueva']);
		$pass_nueva2=mysql_real_escape_string($_REQUEST['txt_contrasena_nueva2']);
		
		
	  if($pass_nueva!=$pass_nueva2){
			
			echo(2);
			
		}else{
			
				
				//$contrasena=datos_global('23','ID_USUARIO','USUARIOS','PASSWORD_USUARIO');
				$sql=mysql_query("select * from empleados where id_empleado='".$_SESSION['id']."'");
				$datos=mysql_fetch_array($sql);
				
				if($pass_nueva2==$datos['password_empleado']){
							
							
							
							echo(4);
							die;
						
				}
					if(strlen($pass_nueva2)<6){
							
							echo(5);
							die;
							
							
				}
				
				if($_REQUEST['txt_contrasena_actual']==$datos['password_empleado']){
					
						
					$update=mysql_query('UPDATE empleados SET password_empleado="'.$_REQUEST['txt_contrasena_nueva'].'" WHERE id_empleado="'.$_SESSION['id'].'"');
					
					echo(1);
				
				}else{
				
					echo(3);	
					
						
				}
			
			
		}
		
	
}


if($accion=='cerrar_sesion'){
	@session_start();
	session_destroy();
	echo(1);

	
}
		
		


	
?>