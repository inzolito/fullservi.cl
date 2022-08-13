<?
include('../funciones/conexiones.php');
conecta_bd();
 

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Menu</title>

<!-- http://code.jquery.com/jquery-1.9.0.js


   -->
 
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.0.js"></script>
<script type="text/javascript" src="../js/apprise-1.5.full.js"></script>
<script type="text/javascript" src="../js/validador.js"></script>

    
     
 
 <LINK REL="Shortcut Icon" HREF="../imagenes/iconos/fadeicon.ico">
 
<script src="../js/jquery.paginate.js" type="text/javascript"></script>
<!-- <link href="style_pdf.css" rel="stylesheet" type="text/css" /> -->
 

<script>
 
$(document).ready(function() {
	
			
 });



</script>

<style>
 
 
 
 
  











</style>


</head>

<body>


<?
 $cursos_consulta=mysql_query("select * from curso_alumno group by Id_curso order by Id_curso asc");

while($cursos_datos=mysql_fetch_array($cursos_consulta))
{

	$id_curso=$cursos_datos["Id_curso"]; 
	
	echo "<br>";
	
	$el_curso_consulta=mysql_query("select Id_alumno, concat(apellido_paterno_alumno,' ',apellido_materno_alumno,' ',nombre_alumno) as alumno, rut_alumno,Id_padre,Id_padre2 fecha_nacimiento_alumno from curso_alumno as ca join alumnos as al using(Id_alumno) where ca.Id_curso='".$id_curso."' order by alumno asc ");
 	
	
	
  
	
	
	
	
	
	
	?>
    
      <table border="1">
      <tr> <td colspan="5">Curso <? echo nombre_curso($id_curso); ?></td></tr>
        	<tr>
            	<th>n°</th>
                <th>Alumno</th>
                <th>Run</th>
                <th>Teléfonos</th>
 
            </tr>
            
      <?
	$contador=0;
	// inicio
	while($el_curso_dato=mysql_fetch_array($el_curso_consulta))
	{
		
		//****
				$datos_matricula=mysql_fetch_array(mysql_query("select *  from matricula_oficial where Id_alumno='".$el_curso_dato['Id_alumno']."' "));
			
				$id_padre=0;
				$id_padre2=0;
				$id_apoderado=0;
				$id_apoderado2=0;
				
				if($el_curso_dato['Id_padre']){
					$id_padre=$el_curso_dato['Id_padre'];
				}
				if($el_curso_dato['Id_padre2']){
					$id_padre2=$el_curso_dato['Id_padre2'];
				}
				if($datos_matricula['Id_apoderado']){
					$id_apoderado=$datos_matricula['Id_apoderado'];
				}
				if($datos_matricula['Id_apoderado2']){
					$id_apoderado2=$datos_matricula['Id_apoderado2'];
				}
				
	
				$telefonos_consulta=mysql_query("select distinct(telefono) telefono from telefonos where Id_alumno='".$el_curso_dato['Id_alumno']."' or Id_padre='".$id_padre."' or Id_padre='".$id_padre2."' or Id_apoderado='".$id_apoderado."' or Id_apoderado='".$id_apoderado2."'");
				$lista_telefonos="<ul>";
				while($telefonos_datos=mysql_fetch_array($telefonos_consulta))
				{
					$lista_telefonos.="<li>".$telefonos_datos['telefono']."</li>";
				
				}
				
				$lista_telefonos.="</ul>";
	
		
		//***
		
		
		$contador++;
 		
		?>
      
        	<tr>
            	<td><? echo $contador ?></td>
                <td><? echo $el_curso_dato["alumno"] ?></td>
                <td><? echo $el_curso_dato["rut_alumno"] ?></td>
                <td><? echo $lista_telefonos ?></td>
        
            </tr>
        
      
        
        
        <?
	}// end if
	
	
	?>
      </table>
    <?
	
}

?>

   
</body>


</html>