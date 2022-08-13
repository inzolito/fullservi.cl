<?	
	include("../../functions/funciones.php");
	conecta_bd();

valida_sesion();
$id_vehiculo=$_REQUEST['identificador'];

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>

<?
		

	$query_ordenes=mysql_query("select * from ordenes_trabajo join empleados using(id_empleado) join clientes using (id_cliente) where id_vehiculo='".$id_vehiculo."'");
	
	$datos_vehiculo=datos_global($id_vehiculo,"id_vehiculo","vehiculos","*");
				
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
	
	

<?
	}
?>
</body>
</html>