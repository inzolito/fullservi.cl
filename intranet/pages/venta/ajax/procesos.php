<?
	include("../../../functions/funciones.php");
	conecta_bd2();

	
$accion=$_REQUEST['accion'];
$accion2=$_REQUEST['accion2'];
$fecha=formato_fecha("bd",date("d-m-Y"));	
$hora=hora_actual();

ini_set('memory_limit', '10000M'); 
	
if($accion=="publicar_vehiculo"){
	
 
	$insert_vehiculo=mysql_query("INSERT INTO vehiculos
	SET marca_vehiculo='".$_REQUEST['cmb_marca']."',
    modelo_vehiculo='".$_REQUEST['cmb_modelo']."',
    kilometraje_vehiculo='".formato_numero(0,$_REQUEST['txt_kilometraje'])."',
	ano_vehiculo='".$_REQUEST['txt_ano']."',
	color_vehiculo='".$_REQUEST['txt_color']."',
	motor_vehiculo='".$_REQUEST['cmb_motor']."',
	combustible_vehiculo='".$_REQUEST['cmb_combustible']."',
	transmision_vehiculo='".$_REQUEST['cmb_transmision']."',
	puertas_vehiculo='".$_REQUEST['cmb_puertas']."',
	airbags_vehiculo='".$_REQUEST['cmb_airbag']."',
	abs_vehiculo='".$_REQUEST['cmb_frenos']."',
	fwd_vehiculo='".$_REQUEST['cmb_fwd']."',
	estado_venta_vehiculo='en venta',
	observacion_vehiculo='".$_REQUEST['txt_observacion']."',
	precio_vehiculo='".formato_numero(0,$_REQUEST['txt_precio'])."',
	aire_vehiculo='".$_REQUEST['cmb_aire']."',
	alza_vidrios_vehiculo='".$_REQUEST['cmb_vidrio']."',
	espejo_electrico_vehiculo='".$_REQUEST['cmb_espejo']."',
	cierre_centralizado_vehiculo='".$_REQUEST['cmb_cierre']."',
	catalitico_vehiculo='".$_REQUEST['cmb_catalitico']."',
	llanta_vehiculo='".$_REQUEST['cmb_llantas']."',
	radio_vehiculo='".$_REQUEST['cmb_radio']."',
	direccion_vehiculo='".$_REQUEST['cmb_direccion']."',
	estado_vehiculo='activo',
	fecha_publicacion='".$fecha."'");

	
	
	
	$consulta_id=mysql_query("select max(id_vehiculo) id  from vehiculos ");
	$id=0;
	if(mysql_num_rows($consulta_id)==0)
	{
		$id=0;
		echo 0;
		die;
	}else{
		$dato_id=mysql_fetch_array($consulta_id);
		$id=$dato_id["id"];
		
  	
			
			for ($x=1; $x<=5; $x++)
			{	 
					 
				 $fecha=formato_fecha("bd",date("d-m-Y"));	
				 $hora=hora_actual();
					if ($_FILES["file_".$x]) {
			
						$nombre_temporal = $_FILES["file_".$x]["tmp_name"];
						$nombre_foto = $_FILES["file_".$x]["name"];
						$nombre_array=explode(".",$nombre_foto);
						$extencion=$nombre_array[count($nombre_array)-1];
					
						$nombre_foto=nombre_unico().".".$extencion;
						$nombre_foto_grande=nombre_unico()."_large_$x.".$extencion;
						$nombre_foto_mediana=nombre_unico()."_medium_$x.".$extencion;
						$nombre_foto_chica=nombre_unico()."_small_$x.".$extencion;
						$nombre_foto_tool=nombre_unico()."_tool_$x.".$extencion;
						
						
					 
						move_uploaded_file($nombre_temporal, "../../../../webpage/img/".$nombre_foto);
						
						$dimensiones_imagen_original = getimagesize("../../../../webpage/img/".$nombre_foto);
						$ancho_imagen_original=$dimensiones_imagen_original[0];
						$alto_imagen_original=$dimensiones_imagen_original[1];
						
						$origen_imagen= "../../../../webpage/img/".$nombre_foto;
						$origen_imagen_grande= "../../../../webpage/img/".$nombre_foto_grande;// la imagen original yaen el servidor
						$origen_imagen_mediana= "../../../../webpage/img/".$nombre_foto_mediana;// la imagen original yaen el servidor
						$origen_imagen_chica= "../../../../webpage/img/".$nombre_foto_chica;// la imagen original yaen el servidor
						$origen_imagen_tool= "../../../../webpage/img/".$nombre_foto_tool;// la imagen original yaen el servidor


						// Imagen Grande
						tmb_creation(800,$origen_imagen,$nombre_foto_grande,"../../../../webpage/img");
						//mediana
						tmb_creation(400,$origen_imagen,$nombre_foto_mediana,"../../../../webpage/img");
						// crear miniatura
						tmb_creation(200,$origen_imagen,$nombre_foto_chica,"../../../../webpage/img");
						//Foto tool
						tmb_creation(64,$origen_imagen,$nombre_foto_tool,"../../../../webpage/img");
						
						unlink("../../../../webpage/img/".$nombre_foto);
						$portada=0;
						if($x==5) $portada=1;
						
						mysql_query("insert into fotos set  nombre_foto='".$nombre_foto_grande."' , tamano_foto='large', orden_foto=$x, id_vehiculo=$id, foto_portada='".$portada."'");
						mysql_query("insert into fotos set  nombre_foto='".$nombre_foto_mediana."' , tamano_foto='medium',orden_foto=$x, id_vehiculo=$id, foto_portada='".$portada."'");
						mysql_query("insert into fotos set  nombre_foto='".$nombre_foto_chica."' , tamano_foto='small', orden_foto=$x, id_vehiculo=$id, foto_portada='".$portada."'");
						
					} 	 	
				
			}
			
			echo 1;
	}
	
}
	
//print_r($_REQUEST);	
	
	
if($accion2=="guardar_editar"){
	
 
	$update_vehiculo=mysql_query("UPDATE vehiculos
	SET marca_vehiculo='".$_REQUEST['cmb_marca']."',
    modelo_vehiculo='".$_REQUEST['cmb_modelo']."',
    kilometraje_vehiculo='".formato_numero(0,$_REQUEST['txt_kilometraje'])."',
	ano_vehiculo='".$_REQUEST['txt_ano']."',
	color_vehiculo='".$_REQUEST['txt_color']."',
	motor_vehiculo='".$_REQUEST['cmb_motor']."',
	combustible_vehiculo='".$_REQUEST['cmb_combustible']."',
	transmision_vehiculo='".$_REQUEST['cmb_transmision']."',
	puertas_vehiculo='".$_REQUEST['cmb_puertas']."',
	airbags_vehiculo='".$_REQUEST['cmb_airbag']."',
	abs_vehiculo='".$_REQUEST['cmb_frenos']."',
	fwd_vehiculo='".$_REQUEST['cmb_fwd']."',
	estado_venta_vehiculo='en venta',
	observacion_vehiculo='".$_REQUEST['txt_observacion']."',
	precio_vehiculo='".formato_numero(0,$_REQUEST['txt_precio'])."',
	aire_vehiculo='".$_REQUEST['cmb_aire']."',
	alza_vidrios_vehiculo='".$_REQUEST['cmb_vidrio']."',
	espejo_electrico_vehiculo='".$_REQUEST['cmb_espejo']."',
	cierre_centralizado_vehiculo='".$_REQUEST['cmb_cierre']."',
	catalitico_vehiculo='".$_REQUEST['cmb_catalitico']."',
	llanta_vehiculo='".$_REQUEST['cmb_llantas']."',
	radio_vehiculo='".$_REQUEST['cmb_radio']."',
	direccion_vehiculo='".$_REQUEST['cmb_direccion']."',
	estado_vehiculo='activo'
	where id_vehiculo='".$_REQUEST['txt_vehiculo']."'");

	

	$id=$_REQUEST["txt_vehiculo"];
	
	 
	 
	for ($x=1; $x<=5; $x++)
	{					
		//$x=$fotos_datos["orden_foto"];
		$fecha=formato_fecha("bd",date("d-m-Y"));	
		$hora=hora_actual();
		 
		if ($_FILES["file_".$x]) {
 
 
 			$foto_consulta=mysql_query("select * from fotos where id_vehiculo='".$id."' and tamano_foto='large' and orden_foto='".$x."' ");
 			if(mysql_num_rows($foto_consulta)>0)
			{
				$foto_datos=mysql_fetch_array($foto_consulta);	
				$foto_large=$foto_datos["nombre_foto"];
				$foto_medium=str_replace("large","medium",$foto_large);
				$foto_small=str_replace("large","small",$foto_large);				
				$foto_tool=str_replace("large","tool",$foto_large);
				
				
				unlink("../../../../webpage/img/".$foto_large);
				unlink("../../../../webpage/img/".$foto_medium);
				unlink("../../../../webpage/img/".$foto_small);
				unlink("../../../../webpage/img/".$foto_tool);
								
				mysql_query("delete  from fotos where nombre_foto='".$foto_large."' ");
				mysql_query("delete from fotos where nombre_foto='".$foto_medium."' ");
				mysql_query("delete from fotos where nombre_foto='".$foto_small."'  ");
			}
								
			$nombre_temporal = $_FILES["file_".$x]["tmp_name"];
			$nombre_foto = $_FILES["file_".$x]["name"];
			$nombre_array=explode(".",$nombre_foto);
			$extencion=$nombre_array[count($nombre_array)-1];
			/*	*/		
			$nombre_foto=nombre_unico().".".$extencion;
			$nombre_foto_grande=nombre_unico()."_large_$x.".$extencion;
			$nombre_foto_mediana=nombre_unico()."_medium_$x.".$extencion;
			$nombre_foto_chica=nombre_unico()."_small_$x.".$extencion;
			$nombre_foto_tool=nombre_unico()."_tool_$x.".$extencion;
			
			move_uploaded_file($nombre_temporal, "../../../../webpage/img/".$nombre_foto);
							
			$dimensiones_imagen_original = getimagesize("../../../../webpage/img/".$nombre_foto);
			$ancho_imagen_original=$dimensiones_imagen_original[0];
			$alto_imagen_original=$dimensiones_imagen_original[1];
			
			$origen_imagen= "../../../../webpage/img/".$nombre_foto;
			$origen_imagen_grande= "../../../../webpage/img/".$nombre_foto_grande;// la imagen original yaen el servidor
			$origen_imagen_mediana= "../../../../webpage/img/".$nombre_foto_mediana;// la imagen original yaen el servidor
			$origen_imagen_chica= "../../../../webpage/img/".$nombre_foto_chica;// la imagen original yaen el servidor
			$origen_imagen_tool= "../../../../webpage/img/".$nombre_foto_tool;// la imagen original yaen el servidor
				
							
			// Imagen Grande
			tmb_creation(800,$origen_imagen,$nombre_foto_grande,"../../../../webpage/img");
			//mediana
			tmb_creation(400,$origen_imagen,$nombre_foto_mediana,"../../../../webpage/img");
			// crear miniatura
			tmb_creation(200,$origen_imagen,$nombre_foto_chica,"../../../../webpage/img");

			//Tool
			tmb_creation(64,$origen_imagen,$nombre_foto_tool,"../../../../webpage/img");

							
			unlink("../../../../webpage/img/".$nombre_foto);
			$portada=0; 
	
			if($x==5) $portada=1;
							
				mysql_query("insert into fotos set  nombre_foto='".$nombre_foto_grande."' , tamano_foto='large', orden_foto=$x, id_vehiculo=$id, foto_portada='".$portada."'");
				mysql_query("insert into fotos set  nombre_foto='".$nombre_foto_mediana."' , tamano_foto='medium',orden_foto=$x, id_vehiculo=$id, foto_portada='".$portada."'");
				mysql_query("insert into fotos set  nombre_foto='".$nombre_foto_chica."' , tamano_foto='small', orden_foto=$x, id_vehiculo=$id, foto_portada='".$portada."'");
			}
	
	}
	
	echo(1);
	die;
} 

if($accion=="delete_venta"){
	
	$delete=mysql_query("UPDATE vehiculos SET estado_vehiculo='eliminado' WHERE id_vehiculo='".$_REQUEST['vehiculo']."'");
	echo(1);
	die;
}


//----------------------------  Se ejecuta siempre ----------------------------//
 ?>
 
 