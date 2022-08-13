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
 
 <script>
	
    $(document).ready(function() {
           $('#tabla_trabajos').dataTable( {
                "language": {
                    "url": "../../js/espa_tabla.json"
                }
            } );
        } );
    </script>


 
</head>

<body onLoad="carga()">


<?php
		

	$trabajos_consulta=mysql_query("select * from trabajos left join precios_trabajos using(id_trabajo) where  estado_precio_trabajo='Activo'  order by nombre_trabajo");
	if(mysql_num_rows($trabajos_consulta)==0){
		
			
				
?>

	
	<div class="jumbotron alert alert-info">
  <h2> No hay trabajos agregados aun.</h2>
  <br>
 
</div>
<?
	}else{
		
	
?>
<div class="panel panel-default">
	<div class="panel-body">
		<table id="tabla_trabajos"  class="dataTable no-footer">
    <thead>
        <tr>
            <th>Trabajo </th>
			<th>Precio </th>  
			<th>Fecha modificación precio</th>
		 	<th>Accion</th>
        </tr>
    </thead>
    <tbody>
       <?
			while($datos_trabajo=mysql_fetch_array($trabajos_consulta))
			{
				
			
		?>
        <tr>
           <td><? echo $datos_trabajo["nombre_trabajo"] ?></td>	
			<td><?  if($datos_trabajo["precio_trabajo"]) echo formato_numero(1,$datos_trabajo["precio_trabajo"]); else echo "No ingresado"; ?></td>	
			<td><? if($datos_trabajo["fecha_precio_trabajo"]) echo formato_fecha("normal",$datos_trabajo["fecha_precio_trabajo"]); else echo "No ingresado";  ?></td>
			
			<td>
			
				<button type="button" class="btn btn-default btn-xs"  onClick="cargar_trabajo('<? echo $datos_trabajo["id_trabajo"] ?>')" id="btn_editar"><i class="fa fa-pencil"> </i></button>
				 
		    </td>		
        </tr>
       <?
			}
			?>
    </tbody>
</table>
	</div> 

	</div>


<?
	}
?>
<script type="text/javascript">
                // For demo to fit into DataTables site builder...
                $('#tabla_trabajos')
                    .removeClass( 'display' )
                    .addClass('table table-striped table-bordered');
              </script>
</body>
</html>