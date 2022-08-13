<?
	include("../../functions/funciones.php");
	conecta_bd2();
valida_sesion();
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<div style="margin-bottom:2%">
<button type="button" class="btn btn-info btn-block" onClick="carga_venta()">Publicar Nuevo Vehiculo </button>	
	</div>
<div class="panel panel-default">


<div class="panel-body">
	
	<? $sql_vehiculos=mysql_query("select * from vehiculos 
 where estado_vehiculo ='activo'");
	
	
	
	?>
	
	<table class="table table-bordered table-condensed ">
	<tr>
		<td align="center" colspan="8"  style="background-color: #f9f9f9"><h4>Vehiculos en venta</h4></td>
		</tr>
	<tr>
		<th>Codigo </th>
		<th> Marca</th>
		<th> Modelo</th>
		<th> Kilometraje</th>
		<th>Año </th>
		<th>Estado </th>
		<th>Fecha de Publicacion </th>
			<th>Administrar</th>
		
	</tr>
	
	<?
	
		if(mysql_num_rows($sql_vehiculos)==0){
			
		
	?>	
		<td colspan="7"><strong>NO HAY AUTOS PUBLICADOS PARA LA VENTA</strong></td>
		<?
		}else{
			
			
		while($datos=mysql_fetch_array($sql_vehiculos)){
	?>
     <tr>
	     <td><? echo($datos['id_vehiculo']) ?> </td>
		<td> <? echo($datos['marca_vehiculo']) ?></td>
		<td> <? echo($datos['modelo_vehiculo']) ?></td>
		<td> <? echo($datos['kilometraje_vehiculo']) ?></td>
		<td><? echo($datos['ano_vehiculo']) ?> </td>
		<td><? echo($datos['estado_venta_vehiculo']) ?> </td>
		<td><? echo(formato_fecha("normal",$datos['fecha_publicacion'])) ?> </td>
			<td>
			
			 <button class="btn btn-default btn-xs" onClick="editar_publicacion(this.id)" title="editar" id="<? echo($datos['id_vehiculo']."_editar") ?>"> <i class="fa fa-pencil" aria-hidden="true"></i></button> 
			
			
			<button class="btn btn-danger btn-xs" title="anular" onClick="eliminar_venta(this.id)" id="<? echo($datos['id_vehiculo']."eliminar") ?>"  >  <i class="fa fa-minus"></i></button> </button>  </td>
			 
			  
			    </td>
		</tr>
	
	<?	}	
		}
	?>
	
	</table>

	</div>
	</div>
	<div class="row">
	<div class="col-md-4" style="margin-top: 15px;">
		<a href="../menu/Menu.php"  class="btn btn-warning btn-sm "  title="Volver al menu"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Volver </a>
	</div>
</div>
</body>
</html>