<?	
	include("../../functions/funciones.php");
	conecta_bd();

valida_sesion();
$id_vehiculo=$_REQUEST['identificador']

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>

<?
		

	$query_ordenes=mysql_query("select * from ordenes_trabajo join empleados using(id_empleado) join clientes using (id_cliente) empleados where id_vehiculo='".$id_vehiculo."'");
	
				
	if(mysql_num_rows($query_ordenes)==0){
		
			
				
?>

	
	<div class="jumbotron alert alert-info">
  <h2> El vehiculo con la patente <strong><? echo($patente)." " ?> </strong> no se encuentra registrado.desea crear una orden?</h2>
  <br>
  <p><a class="btn btn-default btn-block" href="#" role="button">CREAR ORDEN</a></p>
</div>
<?
	}else{
		
	
?>
	
	
<table style=background-color:white; class="table table-bordered">
	<tbody>
		<tr>
			<th>Codigo </th>
			<th>fecha </th>
			<th>Hora </th>
			<th>observacion</th>
			<th>Total Mano De Obra</th>
			<th>Total Repuestos</th>
			<th>Total Orden</th>
			<th>Cliente</th>
			<th>Fono 1</th>
			<th>Fono 2</th>
			<th>Responsable</th>
			<th>Opciones</th>
		</tr>

		
		
	<?
		while($datos_orden=mysql_fetch_array($query_ordenes)){
			
		
	?>
			<tr>
			<th><? echo $datos_orden['id_vehiculo']  ?></th>
			
			<td><? echo $datos_orden['patente_vehiculo']  ?> </td>
			<td><? echo $datos_orden['numero_motor_vehiculo']  ?></td>
			<td><? echo $datos_orden['modelo_vehiculo'] ?></td>
			<td><? echo $datos_orden['ano_vehiculo'] ?></td>
			<td><? echo $datos_orden['color_vehiculo'] ?></td>
			<td><? echo $datos_orden['numero_motor_vehiculo'] ?></td>
			<td><? echo $datos_orden['numero_chasis_vehiculo'] ?></td>
			<td><button class="btn btn-default" title="ingresar orden" > <i class="fa fa-plus-square" aria-hidden="true"></i></button> <button class="btn btn-default" title="buscar orden"> <i class="fa fa-search"></i></button> </td>
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