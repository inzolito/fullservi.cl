	<?	
	include("../../functions/funciones.php");
	conecta_bd();
valida_sesion();

$patente=$_REQUEST['patente']

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>




 
</head>

<body>

<?php
		

	$empleados_consulta=mysql_query("select * from empleados  where estado_empleado=1 order by nombre_empleado");
	if(mysql_num_rows($empleados_consulta)==0){
		
			
				
?>

	
	<div class="jumbotron alert alert-info">
  <h2> No hay empleados agregados aun.</h2>
  <br>
 
</div>
<?
	}else{
		
	
?>
<table style=background-color:white; class="table table-bordered">
	<tbody>
	
	<tr>
		<td style="background-color: #f9f9f9" align="center" colspan="5"><h4>Listado De Empleados</h4></td>
				
		</tr>
		<tr style="background-color: #f9f9f9">
			<th>Nombre </th>
			<th>Rut </th>
			<th>Fono</th>
			<th>Permisos De Sistema</th>
			<th>Administrar</th>
		</tr>

		
		
		
		<?
			while($datos_empleado=mysql_fetch_array($empleados_consulta))
			{
				
			
		?>
		<tr>
			<td><? echo $datos_empleado["nombre_empleado"] ?></td>	
			<td><? echo $datos_empleado["rut_empleado"] ?></td>	
			<td><? echo $datos_empleado["fono_empleado"] ?></td>
			<td><? echo $datos_empleado["permisos_empleado"] ?></td>
			
			<td>
			
				<button type="button" class="btn btn-default btn-xs" title="editar"  onClick="cargar_empleado('<? echo $datos_empleado["id_empleado"] ?>')" id="btn_editar"><i class="fa fa-pencil"> </i></button>
				<button type="button" class="btn btn-danger btn-xs"  title="eliminar" onClick="eliminar_empleado('<? echo $datos_empleado["id_empleado"] ?>')" id="btn_eliminar"><i class="fa fa-trash"> </i></button>
	    
		    </td>		
		</tr>
		
		<?
			}
		?>
		
		</tbody>


</table>
<?
	}
?>
</body>
</html>