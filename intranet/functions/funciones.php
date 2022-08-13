<?


//-------- Option Conection ---------//

function conecta_bd($codificacion="utf") 
{ 

	 if (!($link=mysql_connect("localhost","thefinis_mecanic","FULLfinis99"))) 
	   { 
		  echo "Error conectando a la base de datos."; 
		  exit(); 
	   } 
	   if (!mysql_select_db("thefinis_fullservi",$link)) 
	   {  
		  echo "Error seleccionando la base de datos.";  
		  exit(); 
	   } 

		// Para windows
		$loc_de = setlocale(LC_ALL, 'es_CL', 'es_ES', 'esp_esp');
		//echo "El localismo preferido para el alemán en este sistema es '$loc_de'";

	   //Para linux
		//setlocale(LC_TIME, 'es_ES.UTF-8');
		date_default_timezone_set("America/Santiago");

	   if($codificacion=="ISO")
	   {

			mysql_query("SET NAMES 'ISO-8859-1'");
	   }else{

			mysql_query("SET NAMES 'utf8'");

	   }
	   return $link; 
   
} 
function conecta_bd2($codificacion="utf") 
{ 

 if (!($link=mysql_connect("localhost","thefinis_mecanic","FULLfinis99"))) 
	   { 
		  echo "Error conectando a la base de datos."; 
		  exit(); 
	   } 
	   if (!mysql_select_db("thefinis_webpage_fullservi",$link)) 
	   {  
		  echo "Error seleccionando la base de datos.";  
		  exit(); 
	   } 

		// Para windows
		$loc_de = setlocale(LC_ALL, 'es_CL', 'es_ES', 'esp_esp');
		//echo "El localismo preferido para el alemán en este sistema es '$loc_de'";

	   //Para linux
		//setlocale(LC_TIME, 'es_ES.UTF-8');
		date_default_timezone_set("America/Santiago");

	   if($codificacion=="ISO")
	   {

			mysql_query("SET NAMES 'ISO-8859-1'");
	   }else{

			mysql_query("SET NAMES 'utf8'");

	   }
	   return $link; 
   
} 

//------- Options System ----------//
function validar_sesion()
{
 	 if(!isset($_SESSION['id']))
	 {
		echo "<script>window.location='".index_sistema()."pages/login/login.php';</script>";
	 } 
	 
}
function valida_sesion()
{
 	  
		 @session_start(); //@ previene warning contra sesiones automáticas (no recomendado)
		if(! isset($_SESSION["nombre"])){ 
		   Header("Location:../login/login.php"); 
			exit;
		} 
			 
}

function index_sistema()
{
	
	  	// return "http://fs.thefinis.com/";	
	     return "http://localhost/FULL_SERVI/";
}


//-------- DataTime -----------//

function formato_fecha($normal_bd_lectura,$fecha)
{
	$tipo=$normal_bd_lectura;
	if($tipo=="normal" || $tipo==1)
	{
		$ano=substr($fecha,0,4);
		$mes=substr($fecha,5,2);
		$dia=substr($fecha,8,2);
		$fecha="$dia-$mes-$ano";
		return($fecha);
		 
	}
	
	if($tipo=="bd" || $tipo=="db" || $tipo==2)
	{
			$ano=substr($fecha,6,4);
			$mes=substr($fecha,3,2);
			$dia=substr($fecha,0,2);
			$fecha="$ano-$mes-$dia";
			return($fecha);
	}
	
	if($tipo=="lectura" || $tipo==3)
	{
 
		
	 	return strftime("%d de %B del %G",strtotime($fecha));
	}
}
function fecha_actual($normal_bd_lectura="")
{
 	$fecha = date('d-m-Y');
	
	if($normal_bd_lectura=="normal" || $normal_bd_lectura=="")
	{
		return $fecha;
	}else{
		return formato_fecha($normal_bd_lectura,$fecha);
	}

}


function formato_hora($hms,$hora)
{
	if(count($hora)==7)$hora="0".$hora;
	//12:23:42
	if($hms=="h") return substr($hora,0,2);
	if($hms=="m") return substr($hora,3,5);
	if($hms=="s") return substr($hora,6,8);
	if($hms=="hm") return substr($hora,0,5);
	if($hms=="hms") return $hora;
	
}
function hora_actual($hms=0)
{
	$hora = date('H:i:s');
	
	if($hms==0)
	{
		return $hora;	
	}else{
		formato_hora($hms,$hora);
	}
	
}
 
 
//----- Functions WebSystem ----//

 
function datos_global($valor_condicion,$nombre_campo,$nombre_tabla,$datos_retornar)
{
	$dato=$datos_retornar;	
	$sql=" select * from ".$nombre_tabla." where ".$nombre_campo." = '".$valor_condicion."'";	
 
	 
	
 	if(strtoupper($dato)=="EXISTE")
	{
		$datos_global_consulta=mysql_query($sql);

		if(mysql_num_rows($datos_global_consulta)==1)
		{
				
			return 1;
			
		}else{
			
			return 0;	
		}
			
		
			
	}else{
		
		 
		$datos_global_consulta=mysql_query($sql);
	
	
		 
		// preguntar mas campos
					
		if(mysql_num_rows($datos_global_consulta)==1)
		{
				$datos_array=explode(",",$dato);		
				$datos_global_datos=mysql_fetch_array($datos_global_consulta);	
				
				if($dato=="*")
				{
					return $datos_global_datos;
						
				}else{
					if(count($datos_array)==1)
					{
						return $datos_global_datos[$dato];					
					}else{
						$datos_global_return=$datos_global_datos[$datos_array[0]];	
	
						for($x=1; $x<count($datos_array); $x++)
						{
	
							$datos_global_return.="-separate-";	
							$datos_global_return.=$datos_global_datos[$datos_array[$x]];
						
							 
							 
									
						}//end for
						
						return $datos_global_return;
					}// END IF	
				}
				
				
 
		}else{
			
			return 0;	
		}
		
		
		
		
	}	
	
	
}

//---- Function utilidad ---//

function formato_rut($rut,$formato)
{
	if($formato==0)
	{
		$rut1=str_replace('.','',$rut);
		$rut1=str_replace(" ","",$rut1);
		$rut1=str_replace("-","",$rut1);
			
		return $rut1;
	
	}else{
		$rut1=formato_rut($rut,0);
		
		return number_format( substr($rut1, 0, -1), 0, "", ".") . '-' . substr($rut1, -1);
	}
	
	
} 
 
function formato_numero($formato,$dato)
{
	// 1 formato moneda - 2 formato  solo numero
 	if($formato==1)
	{
		$numero=number_format($dato, 0, '', '.');
		return "$".$numero;
	}
	
	if($formato==0)
	{
 
		$numero=str_replace("$","",$dato);
		$numero=str_replace(".","",$numero);
		
		return $numero;
		
	}
	
}

function datos_trabajo( $dato=0,$id_trabajo=0,$accion=0)
{
	
	// accion = 0 - Muestra si existe el trabajo
	// accion = 1 - Muestra la fila del trabajo activo con el id enviado
	// accion = 2 - Muestra si existe algun trabajo con ese nombre, si es asi manda los datos del trabajo (validado con espacios mayusculas etc.)
	// accion = 3 - Muestra si existe otro trabajo con el mismo nombre  ( al querer modificar el nombre)
	
	
	
	//---------------
	if($accion==0)
	{
		//echo "select * from trabajos left join precios_trabajos using(id_trabajo) where  id_trabajo='".$id_trabajo."' "
		$trabajo_consulta=mysql_query("select * from trabajos left join precios_trabajos using(id_trabajo) where  id_trabajo='".$id_trabajo."' and estado_precio_trabajo='Activo' ");
 		if(mysql_num_rows($trabajo_consulta)==1)
		{
			$trabajo_datos=mysql_fetch_array($trabajo_consulta);
			return $trabajo_datos;
			
		}else{
			return 0; 
		}
		
	}
	
	//---------------
	if($accion==1)
	{
		$trabajo_consulta=mysql_query("select max(id_trabajo) id from trabajos left join precios_trabajos using (id_trabajo) where id_trabajo='".$id_trabajo."' and estado_precio_trabajo='activo'  ");
		if(mysql_num_rows($trabajo_consulta)==1)
		{
			$trabajo_datos=mysql_fetch_array($trabajo_consulta);
			return $trabajo_datos["id"];
			
		}else{
			return 0;
		}
		
	}
	
	// -------------
	if($accion==2)
	{
		$nombre_trabajo=$dato;
		
		$nombre_trabajo=str_replace(" ","",$nombre_trabajo);
		$nombre_trabajo=strtoupper($nombre_trabajo);

		$trabajo_existe_consulta=mysql_query("select *
												from trabajos left join precios_trabajos using(id_trabajo)
												where replace(upper(nombre_trabajo),' ','') ='".$nombre_trabajo."' and estado_precio_trabajo='activo' ");

		
		if(mysql_num_rows($trabajo_existe_consulta)==0){
			return 0;
		}else{
			$trabajo_datos=mysql_num_rows($trabajo_existe_consulta);
			
			return $trabajo_datos["id_trabajo"]."-separate-".$trabajo_datos["nombre_trabajo"]."-separate-".$trabajo_datos["precio_trabajo"]."-separate-".$trabajo_datos["fecha_precio_trabajo"];	
		}
		
	}
	
	//---------------
	if($accion==3){
		
		$nombre_trabajo=$dato;
		
		$nombre_trabajo=str_replace(" ","",$nombre_trabajo);
		$nombre_trabajo=strtoupper($nombre_trabajo);

		$trabajo_existe_consulta=mysql_query("select *
												from trabajos
												where replace(upper(nombre_trabajo),' ','') ='".$nombre_trabajo."'  and id_trabajo<>'".$id_trabajo."'  and estado_precio_trabajo='activo' ");
	
	
		if(mysql_num_rows($trabajo_existe_consulta)==0){
			return 0;
		}else{
			$trabajo_datos=mysql_num_rows($trabajo_existe_consulta);
			
			return $trabajo_datos["id_trabajo"]."-separate-".$trabajo_datos["nombre_trabajo"]."-separate-".$trabajo_datos["precio_trabajo"]."-separate-".$trabajo_datos["fecha_precio_trabajo"];	
		}
	}
	
	//-----------
	
	
}

function datos_producto($id_producto=0)
{
	$productos_consulta=mysql_query(" select *
									  from productos as p join precios_productos as pp using(id_producto) 
									   where 
									  estado_precio_producto='1' and id_producto='".$id_producto."'
						
											");
	
	$historial_consulta=mysql_query("
										
										select id_hp, entrada_hp, salida_hp, costo_hp, valor_venta_hp, fecha_hp, hora_hp
										from historial_productos 
										where id_producto='".$id_producto."' and  costo_hp>0
                   						 order by id_hp desc limit 0,1
										
										
									");
									
								 
	
	if(mysql_num_rows($productos_consulta)==1)
	{									
		$productos_datos=mysql_fetch_array($productos_consulta);
		$historial_datos=mysql_fetch_array($historial_consulta);
		$array_producto=array(
					"id_producto"=>$productos_datos["id_producto"],
					"nombre_producto"=>$productos_datos["nombre_producto"],
					"stock_minimo_producto"=>$productos_datos["stock_minimo_producto"],
					"stock_maximo_producto"=>$productos_datos["stock_maximo_producto"],
					"stock_real_producto"=>$productos_datos["stock_real_producto"],
					"precio_producto"=>$productos_datos["precio_producto"],
					"fecha_precio_producto"=>$productos_datos["fecha_precio_producto"],
					"entrada_hp"=>$historial_datos["entrada_hp"],
					"salida_hp"=>$historial_datos["salida_hp"],
					"costo_hp"=>$historial_datos["costo_hp"],
					"valor_venta_hp"=>$historial_datos["valor_venta_hp"],
					"fecha_hp"=>$historial_datos["fecha_hp"],
					"hora_hp"=>$historial_datos["hora_hp"],
					"marca_producto"=>$productos_datos["marca_producto"]


		);
			
 
		return $array_producto;
	}else{
		return 0;	
	}
	
}
//---------
function valor_venta_producto($valor)
{

	return formato_numero(1,round(($valor-($valor*0.19))*1.6));
	
}

function agregar_salida_producto($id_producto, $salida)
{
		
  	$salida=formato_numero(0,$salida);
	 

					 
														
	$datos_producto=datos_producto($id_producto);
	
 
	if($datos_producto!=0)
	{
	$valor_venta_producto=$datos_producto["precio_producto"];
				mysql_query("
							
										insert into historial_productos
										set
										id_producto='".$id_producto."',
										entrada_hp='0',
										valor_venta_hp='".$valor_venta_producto."',
										salida_hp='".$salida."',
										fecha_hp='".$fecha_actual."',
										hora_hp='".$hora_actual."'
										
										");
			
			
			$stock_new=(int)$datos_producto["stock_real_producto"] -(int)$salida;						
		
			 mysql_query("update productos
										 set 
										 stock_real_producto='".$stock_new."'
										 where id_producto='".$id_producto."'
										 
										  ");
										  
										  echo 1;
	
		/**/
	}else{
	
		echo 0;
		
	}
}


function agregar_entrada_producto($id_producto,$entrada,$costo)
{
	
	$entrada=formato_numero(0,$entrada);
	$costo=formato_numero(0,$costo);	
	
	$datos_producto=datos_producto($id_producto);

	if($datos_producto!=1)
	{
 
		$valor_venta_producto=$datos_producto["precio_producto"];
	
	// el agregar stock tiene costo y no valor venta ya que se sabe a cuantos e compro pero no a cuanto se vendera
				mysql_query("
							
										insert into historial_productos
										set
										id_producto='".$id_producto."',
										entrada_hp='".$entrada."',
										costo_hp='".$costo."',
 
 										salida_hp='0',
										fecha_hp='".fecha_actual("bd")."',
										hora_hp='".hora_actual("hms")."'
										
										");
			
			
			$stock_new=(int)$datos_producto["stock_real_producto"] +(int) $entrada;						
		
			 mysql_query("update productos
										 set 
										 stock_real_producto='".$stock_new."'
										 where id_producto='".$id_producto."'
										 
										  ");
										  
										  
										  echo 1;
	
		/**/
	}else{
	
		echo 0;
		
	}
	
	
}




function consulta_vehiculo($patente,$id_vehiculo=0,$accion=0)
{
	
	
	
	if($patente==0)
	{
		$where=" id_vehiculo=$id_vehiculo ";
	}else{
		
		$where=" patente_vehiculo='".$patente."'";
	}
	
	
	 



	
	if($accion==0)
	{
		$consulta_vehiculo_existe=mysql_query("select * from vehiculos where ".$where);
		return (mysql_num_rows($consulta_vehiculo_existe));
	}
	
	if($accion==1)
	{
		$consulta_vehiculo_existe=mysql_query("select * from vehiculos where ".$where);

		 
		if(   (mysql_num_rows($consulta_vehiculo_existe))  ==0)
		{
			return 0;	
			
		}else{
			
			$consulta_vehiculo_existe=mysql_query("select * from vehiculos where where ".$where);
			return $consulta_vehiculo_existe;
		}
		
		
	}	
		
}

//----------- Fotos ------------------------------
function nombre_unico(){
	
	$fecha_hoy=fecha_actual();
	$hora_hoy=hora_actual("hms");

	$fecha_hoy=str_replace("-","_",$fecha_hoy);
	$fecha_hoy=str_replace("/","_",$fecha_hoy);
	$hora_hoy=str_replace(":","_",$hora_hoy);
	
	return $fecha_hoy."-".$hora_hoy;
	
	
}
function tmb_creation($ancho_deseado, $origen_imagen, $file_name,$ruta_sin_nombre) {
	
		
			
		$destino_imagen=$ruta_sin_nombre."/".$file_name; // asignamos el lugar donde se va a guardar
		$dimensiones_imagen_original = getimagesize($origen_imagen);// obtenemos los datos de la imagen original
		// Verificamos al extension
		if($dimensiones_imagen_original[2]==1){$imagen_original = imagecreatefromgif($origen_imagen);} 
		if($dimensiones_imagen_original[2]==2){$imagen_original = imagecreatefromjpeg($origen_imagen);} 
		if($dimensiones_imagen_original[2]==3){$imagen_original = imagecreatefrompng($origen_imagen);} 
		// extraemos el ancho de la imagen
			
		$ancho_imagen_original=$dimensiones_imagen_original[0];
		$alto_imagen_original=$dimensiones_imagen_original[1];
		// Encontramos el nuevo alto para la imagen partiendo del ancho q enviamos
		$relacion = $ancho_imagen_original/$ancho_deseado;
		$alto_deseado = ceil($alto_imagen_original/$relacion);
		$nueva_imagen = imagecreatetruecolor($ancho_deseado,$alto_deseado);
		
		
		if($dimensiones_imagen_original[2]==3)
		{
			//prueba transparencia png
			$red = imagecolorallocate($nueva_imagen, 255, 0, 0);
			$black = imagecolorallocate($nueva_imagen, 0, 0, 0);
			
			// Make the background transparent
			imagecolortransparent($nueva_imagen, $black);
		}
		 
		 
		 
		// creamos nuestra imagen
		imagecopyresampled($nueva_imagen, $imagen_original, 0, 0, 0, 0, $ancho_deseado, $alto_deseado, $ancho_imagen_original, $alto_imagen_original);
		imagejpeg($nueva_imagen, $destino_imagen, 100);
		imagegif($nueva_imagen, $destino_imagen, 100);    
}
				





//--------------------------------------------------------------------------------
//------------------ reportes -------------------------------------------------//

{
	
	
function cabecera_reporte($titulo_reporte,$id=0)
{
	if($id==0)
	{
	
		$id="";	
		
	}else{
		
		$id="N° ".$id;
	}
	
	
	$cabecera="
				<div style=width:130%;position:relative;background-color:#e00814;margin-top:-75px;height:30px;margin-left:-50px;>
	
				</div>
	
	
				<table  class='tabla_cabecera'>
				  <tr>
				  
				  
					<td width=160 style=vertical-align:bottom>
						<center >
					    
						<img width=128 src=../../imagenes/images/logo.png />
						 
						
						</center>	
					</td>
					
					<td width=240 style=vertical-align:bottom>
						 
						<center>
						    <h1 style=color:#e00814 >FullServi</h1> 
							 <i  style=color:#676767>
								Taller y Venta de Vehiculos<br>
								Avenida la feria n°86<br>
								Coquimbo ovalle, chile
								
							
							</i>
							<h2><center>".$titulo_reporte."</center></h2>
						</center>
					</td>
				   
				   
					<td width=101 align=right style=vertical-align:bottom><br><br>
					 <center>
					 <i>".$id."</i><br>
						 Fecha de emisión <br>
						 ".date('d-m-Y')."
					 </center>
					</td>
				   
				   
				   
				   </tr>
			</table><BR><BR>
			
			 ";	
			 
			 return $cabecera;
	
}

function reporte_orden_trabajo($id_orden)
{
	
					//$id_orden=219;
					$total_trabajos=0;
					$total_repuestos=0;
					$orden_datos=datos_global($id_orden,"id_orden","ordenes_trabajo","*");
					$cliente_datos=datos_global($orden_datos["id_cliente"],"id_cliente","clientes","*");
					$trabajos_y_productos=0;
					
					$vehiculos_datos=datos_global($orden_datos["id_vehiculo"],"id_vehiculo","vehiculos","*");
					//$dato_marca=datos_global($vehiculos_datos["id_marca"],"id_marca","marcas_vehiculos","*");
					//$dato_modelo=datos_global($vehiculos_datos["id_modelo"],"id_modelo","modelos_vehiculos","*");	
	
					$datos_articulos=datos_global($id_orden,"id_orden","articulos_orden","*");

					$query_trabajos=mysql_query("select * 
												 from trabajos join precios_trabajos using(id_trabajo) join detalles_ordenes_trabajos using(id_trabajo) 
												 where id_orden='".$id_orden."' and estado_precio_trabajo='activo'");
				 
				 	$query_productos=mysql_query("select * 
													from productos join precios_productos using(id_producto) join detalles_orden_producto using(id_producto) 
													where id_orden='".$id_orden."' and estado_precio_producto=1");
																	
              
  
   
				// echo $fichapdf;
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//


					
 			
			
if($id_orden==0)
	{
	
		$id_orden="";	
		
	}else{
		
		$id_orden="N° ".$id_orden;
	}
	
	
	$ficha_dos="
				<div style=width:130%;position:relative;background-color:#e00814;margin-top:-75px;height:30px;margin-left:-50px;>
	
				</div>
	
	
				<table  class='tabla_cabecera'>
				  <tr>
				  
				  
					<td width=160 style=vertical-align:bottom>
						<center >
					    
						MODESTO FREDES CASTILLO<br>
						RUT : 7.901.495-8<br>
						MECANICA EN GENERAL<br>
						DESABOLLADURA Y PINTURA<br>
						FULL SERVI . OVALLE<br>

						AV. LA FERIA Nº 86 <br>
						 
						
						</center>	
					</td>
					
					<td width=240 style=vertical-align:bottom>
						 
						<center>
						    <img src=../../imagenes/images/car.jpg width=60% />
						</center>
					</td>
				   
				   
					<td width=101 align=right style=vertical-align:bottom><br><br>
					 <center>
					 ORDEN DE TRABAJO<br>
					 NRO. : <strong><span style=color:red>".$id_orden."</span></strong><br>		
					 Fono consulta  :  53-2-473931<br>
					 CEL. : 9-71671169 /9-77416275 <br>
					 fullservi.ovalle@gmail.com<br>
	  				FECHA ".formato_fecha("normal", $orden_datos['fecha_orden']	)."x
					
					<strong> N°PAG :</strong>
					 </center>
					 
					
				
					</td>
				   
				   
				   
				   </tr>
			</table><BR>
			
			 ";	
					
	
	
	
	




 
if($cliente_datos==0)
{ 
		$ficha_dos.="<fieldset>  <legend>Datos Cliente</legend> No hay datos   </fieldset>";
}else{
$ficha_dos.="
    <fieldset>
        <legend style=font-size:9px>DATOS CLIENTE</legend>
      <table width=87% style=font-size:9px>
            <tbody><tr  >
               
                <td class=label>NOMBRE</td>
              <td class=contenido >".$cliente_datos["nombre_cliente"]."</td>
                <td class=label width=13%>&nbsp;&nbsp;RUT</td>
             <td class=contenido>". $cliente_datos["rut_cliente"]."</td>
            </tr>
            <tr>
                <td class=label width=20%>FONO 1:</td>
              <td class=contenido width=30%>". $cliente_datos["fono_cliente"]."</td>
                 <td class=label>&nbsp;&nbsp;FONO 2</td>
              <td class=contenido>". $cliente_datos["fono2_cliente"]."</td>
            </tr>
            <tr>
                
                <td class=label width=20%>MAIL &nbsp;</td>
              <td class=contenido width=30%>". $cliente_datos["correo_cliente"]."</td>
                <td class=label width=13%>&nbsp;&nbsp;TIPO&nbsp;</td>
              <td class=contenido width=37%>". $cliente_datos["tipo_cliente"]."</td>
            </tr>
             
             <tr>
                <td class=label width=20%>DIRECCIÓN:&nbsp;</td>
               <td class=contenido colspan=3>". $cliente_datos["direccion_cliente"]."</td>
                
            </tr>
           
            
        </tbody></table>
</fieldset>";
}


//---------- datos vehiculo -----
if($vehiculos_datos==0)
{
		$ficha_dos.="<fieldset> <legend>DATOS VEHICULO</legend> No hay datos   </fieldset>";
}else{
	
		$ficha_dos.="<fieldset style=font-size:9px>
		  <legend>DATOS VEHÍCULO</legend>
		  <table style=font-size:9px>
					<tbody><tr>
					   
						<td class=label>PATENTE</td>
						<td class=contenido>". $vehiculos_datos["patente_vehiculo"]."</td>
						<td class=label width=13%>&nbsp;&nbsp;MARCA</td>
						<td class=contenido width=37%>". $vehiculos_datos["marca_vehiculo"]."</td>
					</tr>
					<tr>
						<td class=label width=19%>N° DE MOTOR</td>
						<td class=contenido width=31%>". $vehiculos_datos["numero_motor_vehiculo"]."</td>
						 <td class=label>&nbsp;&nbsp;MODELO</td>
						<td class=contenido>".$vehiculos_datos["modelo_vehiculo"]."</td>
					</tr>
					<tr>
						
						<td class=label width=19%>Nº DE CHASIS&nbsp;</td>
						<td class=contenido width=31%>". $vehiculos_datos["numero_chasis_vehiculo"]."</td>
						<td class=label width=13%>&nbsp;&nbsp;COLOR&nbsp;</td>
						<td class=contenido width=37%>". $vehiculos_datos["color_vehiculo"]."</td>
						
					</tr>
					 
					 <tr>
						<td class=label width=19%>KILOMETRAJE&nbsp;</td>
						<td class=contenido>". $vehiculos_datos["kilometraje_vehiculo"]."</td>
						<td class=label width=13%>&nbsp;AÑO</td>
						<td class=contenido>". $vehiculos_datos["ano_vehiculo"]."</td>
						
					</tr>
					
					 <tr>
						<td class=label width=19%>&nbsp;</td>
						<td class=contenido></td>
						<td class=label width=13%>&nbsp;CILINDRADA</td>
						<td class=contenido>". $vehiculos_datos["motor_vehiculo"]."</td>
						
					</tr>
				   
					
				</tbody></table>
		</fieldset>";

}

//------- datos articulo -----
if($datos_articulos==0)
{
	$ficha_dos.="<fieldset> No hay datos   </fieldset>";
	
}else{

	 $ficha_dos.=" <fieldset style=font-size:9px>
	<table width=87% style=font-size:9px>
				<tr >
					<th width=9% align=left >PADRON </th>
					<td width=4% class=contenido2 style=text-align:center>". $datos_articulos['padron']." </td>
					<th width=11% align=right >ESPEJO INT.</th>
					<td width=4% class=contenido2 style=text-align:center>". $datos_articulos['espejo_int']." </td>
					<th width=12% align=right>PLUMILLAS</th>
					<td width=4% class=contenido2 style=text-align:center>".  $datos_articulos['plumillas']." </td>
					<th width=13% align=right>LLANTAS</th>
					<td width=4% class=contenido2 style=text-align:center>". $datos_articulos['llantas']." </td>
					<th width=13% align=right>LLAVE RUEDA</th>
					<td width=5% class=contenido2 style=text-align:center> ". $datos_articulos['herramienta']."</td>
					<th width=13% align=right> TRIANGULOS</th>
					<td width=5% class=contenido2 style=text-align:center>". $datos_articulos['triangulos']."</td>
					
					
					
				
	   </tr>
					<tr>
					<th align=left> ENCENDEDOR</th>
					<td class=contenido2 style=text-align:center>". $datos_articulos['encendedor']." </td>
					<tH align=right>ESPEJO EXT.</th>
					<td class=contenido2 style=text-align:center>". $datos_articulos['espejo_ext']." </td>
					<tH align=right>PISOS</th>
					<td class=contenido2 style=text-align:center>". $datos_articulos['pisos']." </td>
					<tH align=right>RUEDA REP.</th>
					<td class=contenido2 style=text-align:center>". $datos_articulos['rueda_repuesto']."</td>
					<tH align=right>EXTINTOR</th>
					<td class=contenido2 style=text-align:center>". $datos_articulos['extintor']." </td>
					  
				
					
					
				
					</tr>
					<tr>
					<th align=left>BENCINA</th>
					<td class=contenido2 style=text-align:center>". $datos_articulos['bencina']." </td>
					<th align=right>TAPA BENCINA</th>
					<td class=contenido2 style=text-align:center>".  $datos_articulos['tapa_bencina']." </td>
					<th align=right>TAPA RUEDAS</th>
					<td class=contenido2 style=text-align:center>".  $datos_articulos['tapa_rueda']." </td>
					<th align=right>GATA</th>
					<td class=contenido2 style=text-align:center>".  $datos_articulos['gata']."</td>
					<th align=right>BOTIQUIN </th>
					<td class=contenido2 style=text-align:center>". $datos_articulos['botiquin']." </td>
					  
				
					
			  </table>
	
	</fieldset>";
}




$ficha_dos.="

<fieldset style=font-size:9px>
	<legend>MANO DE OBRA</legend>
		<table width=87% style=font-size:9px>
		
				<tr>
					<th style=background-color:#e0e0e0>Trabajo A Realizar</th>
					
					<th style=background-color:#e0e0e0>Total</th>
			   </tr>
				";
				
				$trabajos_y_productos=mysql_num_rows($query_trabajos);
				 if(mysql_num_rows($query_trabajos)>0){
					 
                      while($datos_trabajo=mysql_fetch_array($query_trabajos))
					  {
                          
						  
						  $total_trabajos=$total_trabajos + (int) $datos_trabajo['precio_trabajo'];
						   $ficha_dos.="
                                    <tr> 
                                        
                                        <td  >".($datos_trabajo['nombre_trabajo'])."</td>
                                         
                                        <td  style=text-align:right; > ".(formato_numero(1,$datos_trabajo['precio_trabajo']))."</td>
                                   
                                    
                                    </tr>";
                        	
                       }
					 
					 $ficha_dos.="<tr>
								  <td ></td>
									<td style=text-align:right; ><strong>".formato_numero(1,$total_trabajos)."</strong></td>
								</tr>";
					 
                   }else{
                                
                         
                       			$ficha_dos.=" <tr><th colspan=2> La Orden No tiene Trabajos</th></tr>";
                        
                       
                  }

$ficha_dos.="	 
				 
		</table>
</fieldset>";



$ficha_dos.="
			<fieldset style=font-size:9px> 
				<legend> REPUESTOS</legend>
					<table width=87% style=font-size:9px>
					
							<tr>
							  <th style=background-color:#e0e0e0>Repuesto o Producto   </th>
								<th style=background-color:#e0e0e0>Precio Unitaro </th>
								<th style=background-color:#e0e0e0>Cantidad    </th>
								<th style=background-color:#e0e0e0>Total</td>
							</tr>
		";					
							
					
					
				$trabajos_y_productos=$trabajos_y_productos + mysql_num_rows($query_productos);
			    if(mysql_num_rows($query_productos)>0){
					 
                      while($datos_productos=mysql_fetch_array($query_productos))
					  {
                          
						  
						  $total_productos=$total_productos + (int) $datos_productos['total_detalle_orden_producto'];
						  $ficha_dos.="
										<tr> 
											<td>".$datos_productos['nombre_producto']."</td>
											<td style=text-align:right; >".formato_numero(1,$datos_productos['precio_producto'])."</td>
											<td align=center>".$datos_productos['cantidad_producto_orden_producto']."</td>
											<td align=right>".formato_numero(1,$datos_productos['total_detalle_orden_producto'])."</td>
										
										</tr>
										";
                        	
                     }
					 
					 
					 	$ficha_dos.="<tr>
									  <td ></td>
									  <td ></td>
									  <td align=center></td>
									  <td align=right><strong>".formato_numero(1,$total_productos)."</strong></td>
									</tr>
									";
					 
                 }else{
                                
                         
                       			$ficha_dos.=" <tr><th colspan=4> La Orden No tiene productos</th></tr> ";
                        
                       
                 }
$ficha_dos.="	 
				 
		</table>
</fieldset>";
	
 
	  
 $ficha_dos.=" 
							 
							
							
			<fieldset style=font-size:9pxt>
				<legend> FECHA DE ENTREGA</legend>
				<table width=87% style=font-size:9px>
							
							<tr>
								<td>".$orden_datos["fecha_entrega_orden"]."</td>
							</tr>
					
					
				</table>
			</fieldset>
			
			<fieldset style=font-size:9pxt>
				<legend> TECNICO</legend>
				<table width=87% style=font-size:9px>
							<tr>
								<td>".$orden_datos["operario_orden"]."</td>
							</tr>
					
				</table>
			</fieldset>
							
			
			";
		
		
		
 

$orden_i= htmlspecialchars($orden_datos["observacion_orden"]);
$total_orden=$orden_datos["neto_orden"]+$orden_datos["iva_orden"];

	    $ficha_dos.="
			<fieldset style=font-size:9px>
							<legend> OBSERVACION</legend>
							<table width=87% style=font-size:9px>
							
							<tr>
								<td>".$orden_i."</td>
							</tr>
					
					
				</table>
			</fieldset>
"; 
					/**/
		if($trabajos_y_productos>=10)
		{
					$ficha_dos.="<table style=page-break-after:always;></br></table>";	

		}
		
		

			$ficha_dos.="  
				<table style=font-size:9px>
		
				<tr> 

					
					<td style=width:60%; >
											<b>Nota:</b> Autorizo a <b>Modesto Fredes Castillo</b> efectuar los trabajos indicados en esta orden empleando 														
						 los repuestos y materiales necesarios.   También autorizo a usted y sus empleados para que operen														
						por las calles y carretera y otros sitios a fin de efectuar las pruebas e inspecciones pertinentes.														
						Modesto Fredes Castillo no se responsabiliza por accidente o incendios o por fuerza mayor  a nuestro 														
						control.  Así como objetos no declarados.<br>														
						<b>OBS.:</b> Este presupuesto puede sufrir  variaciones en sus valores en el momento de desmontar  las 														
						piezas  lo cual sera informado al cliente.														

					</td>
				 

					<td>						
							<fieldset style=font-size:9px  >
								<table width=20% style=font-size:9px>
									<tr>
										<td  >TOTAL MANO </td>
									  <td   style=text-align:right; class=contenido>".formato_numero(1,$orden_datos["total_mano_obra_orden"])."</td>
									</tr>
									<tr>
										<td  >TOTAL REPUESTOS </td>
									  <td    style=text-align:right; class=contenido>".formato_numero(1,$orden_datos["total_repuestos_orden"])."</td>
									</tr>
									<tr>
										<td >TOTAL NETO </td>
									  <td   style=text-align:right; class=contenido>".formato_numero(1,$orden_datos["neto_orden"])."</td>
									</tr>
									<tr>
										<td >IVA</td>
									  <td    style=text-align:right;  class=contenido>".formato_numero(1,$orden_datos["iva_orden"])."</td>
									
									</tr>
									<tr>
									  <td  >TOTAL</td>
									  <td   style=text-align:right; class=contenido>".formato_numero(1,$total_orden)."</td>
									</tr>
									<tr>
									  <td  >DESCUENTO</td>
									  <td   style=text-align:right; class=contenido>".formato_numero(1,$orden_datos["descuento_orden"])."</td>
									</tr>
									<tr>
									  <td  >TOTAL A PAGAR</td>
									  <td    style=text-align:right; class=contenido>".formato_numero(1,$orden_datos["total_pagar_orden"])."</td>
									</tr>
								</table>
							</fieldset>
					
					
					</td>
									
				
				</tr>
				
			
			</table>
			
						
			<table width=100%>
				<tr>
					<td width=30%><CENTER>________________________<br>FIRMA CLIENTE</CENTER></td>
					<td width=40%></td>
					<td width=30%><CENTER>________________________<BR>FIRMA RECEPCIÓN</CENTER></td>
				</tr>
			
			</table>
			 
			";
			
			return $ficha_dos;


}

function reporte_cotizacion($id_cotizacion)
{
	
					//$id_cotizacion=219; 
					$total_trabajos=0;
					$total_repuestos=0;
					$cotizacion_datos=datos_global($id_cotizacion,"id_cotizacion","cotizaciones","*");
					$cliente_datos=datos_global($cotizacion_datos["id_cliente"],"id_cliente","clientes","*");
					$vehiculos_datos=datos_global($cotizacion_datos["id_vehiculo"],"id_vehiculo","vehiculos","*");
					
					//$datos_articulos=datos_global($id_cotizacion,"id_cotizacion","articulos_orden","*");

					$query_trabajos=mysql_query("select * 
												 from trabajos join precios_trabajos using(id_trabajo) join detalles_cotizacion_trabajo using(id_trabajo) 
												 where id_cotizacion='".$id_cotizacion."' and estado_precio_trabajo='activo'");
				 
				 	$query_productos=mysql_query("select * 
													from productos join precios_productos using(id_producto) join detalle_cotizacion_producto using(id_producto) 
													where id_cotizacion='".$id_cotizacion."' and estado_precio_producto=1");
																	
          
 
  	 		 
				 
				 
				// echo $fichapdf;
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//


					
$ficha_dos=cabecera_reporte("COTIZACIÓN ",$id); 
			
if($cliente_datos==0)
{ 
		$ficha_dos.="<fieldset>  <legend>Datos Cliente</legend> No hay datos   </fieldset>";
}else{
$ficha_dos.="
    <fieldset>
        <legend>Datos Cliente</legend>
      <table width=87% >
            <tbody><tr>
               
                <td class=label>Nombre</td>
              <td class=contenido>".$cliente_datos["nombre_cliente"]."</td>
                <td class=label width=13%>&nbsp;&nbsp;Rut</td>
             <td class=contenido>". $cliente_datos["rut_cliente"]."</td>
            </tr>
            <tr>
                <td class=label width=20%>Fono 1:</td>
              <td class=contenido width=30%>". $cliente_datos["fono_cliente"]."</td>
                 <td class=label>&nbsp;&nbsp;Fono 2</td>
              <td class=contenido>". $cliente_datos["fono2_cliente"]."</td>
            </tr>
            <tr>
                
                <td class=label width=20%>Mail &nbsp;</td>
              <td class=contenido width=30%>". $cliente_datos["correo_cliente"]."</td>
                <td class=label width=13%>&nbsp;&nbsp;Tipo&nbsp;</td>
              <td class=contenido width=37%>". $cliente_datos["tipo_cliente"]."</td>
            </tr>
             
             <tr>
                <td class=label width=20%>Dirección:&nbsp;</td>
               <td class=contenido colspan=3>". $cliente_datos["direccion_cliente"]."</td>
                
            </tr>
           
            
        </tbody></table>
</fieldset>";
}


//---------- datos vehiculo -----
if($vehiculos_datos==0)
{
		$ficha_dos.="<fieldset> <legend>Datos Vehiculo</legend> No hay datos   </fieldset>";
}else{
	
		$ficha_dos.="<fieldset>
		  <legend>Datos Vehiculo</legend>
		  <table>
					<tbody><tr>
					   
						<td class=label>Patente</td>
						<td class=contenido>". $vehiculos_datos["patente_vehiculo"]."</td>
						<td class=label width=13%>&nbsp;&nbsp;Marca</td>
						<td class=contenido width=37%>". $vehiculos_datos["marca_vehiculo"]."</td>
					</tr>
					<tr>
						<td class=label width=19%>N° De Motor</td>
						<td class=contenido width=31%>". $vehiculos_datos["numero_motor_vehiculo"]."</td>
						 <td class=label>&nbsp;&nbsp;Modelo</td>
						<td class=contenido>". $vehiculos_datos["modelo_vehiculo"]."</td>
					</tr>
					<tr>
						
						<td class=label width=19%>N De Chasis&nbsp;</td>
						<td class=contenido width=31%>". $vehiculos_datos["numero_chasis_vehiculo"]."</td>
						<td class=label width=13%>&nbsp;&nbsp;Color&nbsp;</td>
						<td class=contenido width=37%>". $vehiculos_datos["color_vehiculo"]."</td>
						
					</tr>
					 
					 <tr>
						<td class=label width=19%>Kilometraje&nbsp;</td>
						<td class=contenido>". $vehiculos_datos["kilometraje_vehiculo"]."</td>
						<td class=label width=13%>&nbsp;Año</td>
						<td class=contenido>". $vehiculos_datos["ano_vehiculo"]."</td>
						
					</tr>
				   
					
				</tbody></table>
		</fieldset>";

}

  
$ficha_dos.="<fieldset>
	<legend> Mano De Obra</legend>
		<table width=87%>
		
				<tr>
					<th style=background-color:#e0e0e0>Trabajo A Realizar</td>
					
					<th style=background-color:#e0e0e0>Total</td>
			   </tr> 
				";
				

				 if(mysql_num_rows($query_trabajos)>0){
					 
                      while($datos_trabajo=mysql_fetch_array($query_trabajos))
					  {
                          
						  
						  $total_trabajos=$total_trabajos + (int) $datos_trabajo['precio_trabajo'];
						   $ficha_dos.="
                                    <tr> 
                                        
                                        <td  >".($datos_trabajo['nombre_trabajo'])."</td>
                                         
                                        <td  style=text-align:right; > ".(formato_numero(1,$datos_trabajo['precio_trabajo']))."</td>
                                   
                                    
                                    </tr>";
                        	
                     }
					 
					$ficha_dos.= "<tr>
				  			<td ></td>
							<td style=text-align:right; ><strong>".formato_numero(1,$total_trabajos)."</strong></td>
					 </tr>";
                   }else{
                                
                         
                       			$ficha_dos.=" <tr><th colspan=2> La cotizacion No tiene Trabajos</th></tr>";
                        
                       
                  }
				  

$ficha_dos.="	 
				
				
			  
				
		
		</table>
</fieldset>";
 
 
$ficha_dos.="
			<fieldset>
				<legend> Repuestos</legend>
					<table width=87%>
					
							<tr>
							  <th style=background-color:#e0e0e0>Repuesto o Producto  
								<th style=background-color:#e0e0e0>Precio Unitaro
								<th style=background-color:#e0e0e0>Cantidad    
								<th style=background-color:#e0e0e0>Total</td>
							</tr>
		";					
							
					
					
					
			    if(mysql_num_rows($query_productos)>0){
					 
                      while($datos_productos=mysql_fetch_array($query_productos))
					  {
                          
						  
						  $total_productos=$total_productos + (int) $datos_productos['total_detalle_cotizacion_producto'];
						  $ficha_dos.="
										<tr> 
											<td>".$datos_productos['nombre_producto']."</td>
											<td style=text-align:right; >".formato_numero(1,$datos_productos['precio_producto'])."</td>
											<td align=center>".$datos_productos['cantidad_producto_cotizacion_producto']."</td>
											<td align=right>".formato_numero(1,$datos_productos['total_detalle_cotizacion_producto'])."</td>
										
										</tr>
										";
                        	
                     }
					 
					 
					 	$ficha_dos.="<tr>
									  <td ></td>
									  <td ></td>
									  <td align=center></td>
									  <td align=right><strong>".formato_numero(1,$total_productos)."</strong></td>
									</tr>
									";
					 
                 }else{
                                
                         
                       			$ficha_dos.=" <tr><th colspan=4> La cotizacion No tiene productos</th></tr>";
                        
                       
                 }
				 
				 
 				  
 $ficha_dos.=" 
							 
							</table>
							</fieldset>
							
							
							<fieldset>
							<legend> OBSERVACION</legend>
							<table width=87%>
							
							<tr>
								<th>".$cotizacion_datos["observacion_cotizacion"]."</th>
							</tr>
					
					
				</table>
			</fieldset>
			
			
					<table style=font-size:9px>
				<tr> 
					
					
					
					
					
					
					
					
					<td style=width:60%; >
					<b>Nota:</b> las cotizaciones tienen una vigencia de 30 días													
<b>OBS.:</b> Este presupuesto puede sufrir  variaciones en sus valores en el momento de desmontar  las 	piezas  lo cual sera informado al cliente.														

					</td>
				

					<td  >						
							<fieldset style=font-size:9px  >
								<table width=20% style=font-size:9px>
								<tr>
					
					
						<td  >Total Mano </td>
					  <td   style=text-align:right; class=contenido>".formato_numero(1,$cotizacion_datos["total_mano_cotizacion"])."</td>
					</tr>
					<tr>
						<td  >Total Repuestos </td>
					  <td    style=text-align:right; class=contenido>".formato_numero(1,$cotizacion_datos["total_repuestos_cotizacion"])."</td>
					</tr>
					<tr>
						<td >Total Neto </td>
					  <td   style=text-align:right; class=contenido>".formato_numero(1,$cotizacion_datos["neto_cotizacion"])."</td>
					</tr>
					<tr>
						<td >IVA</td>
					  <td    style=text-align:right;  class=contenido>".formato_numero(1,$cotizacion_datos["iva_cotizacion"])."</td>
					
					</tr>
					<tr>
					  <td  >Descuento</td>
					  <td   style=text-align:right; class=contenido>".formato_numero(1,$cotizacion_datos["descuento_cotizacion"])."</td>
					</tr>
					<tr>
					  <td  >Total A Pagar</td>
					  <td    style=text-align:right; class=contenido>".formato_numero(1,$cotizacion_datos["total_cotizacion"])."</td>
					</tr>
								</table>
							</fieldset>
					
					
					</td>
									
				
				</tr>
				
			
			</table>";
 		
			return $ficha_dos;
	
}


function reporte_salida($inout, $accion_r, $fecha_inicio, $fecha_salida, $fecha_unica,$fecha_mes,$fecha_año )
{
	$pdf_return="";
	
	// 1 =entrada , 2 = salida , 3 =entradas y salidas
	 
	 
	
	
	$variable_inout=0;
	$where_tipo="";
	
	if($inout==1)
	{
		$where_tipo="  and tipo_operacion_hp='entrada' ";
		$pdf_return.= "<br><br><br>".cabecera_reporte("Reporte de entradas");
		$variable_inout="Entradas";
	}

	if($inout==2)
	{
		$where_tipo="  and tipo_operacion_hp='salida' ";
		$pdf_return.= "<br><br><br>".cabecera_reporte("Reporte de salidas");
		$variable_inout="Salidas";
	}
	if($inout==3)
	{
		$where_tipo="    ";
		$pdf_return.= "<br><br><br>".cabecera_reporte("Reporte de entradas y salidas");
		$variable_inout="Cant.";
	}	
								$tipo_reporte=$accion_r;
							
								//$id_producto=14;
								$fecha_inicio_producto=$fecha_inicio;
								$fecha_fin_producto=$fecha_salida;
								//$fecha_unica=$fecha_unica; //--
								//$fecha_mes=$fecha_mes; //--
								$fecha_mes_array=explode("-",$fecha_mes); //--
								$mes=$fecha_mes_array[1];
								$año=$fecha_mes_array[0];
								
								$fecha_registro=$fecha_unica;
								//--- variables de cabecera --
								$titulo_tiempo_cantidad="Cantidad de ventas en el mes";
								$titulo_total_salida="Total salidas";
								$titulo_fecha_datos="Fecha de datos";
								
  								
								//---
								$total_egresos=0;
								$total_ingresos=0;
								
								$total_entradas=0;
								$total_salidas=0;
								
							 
							// Mes										
 							 if($tipo_reporte==1)
							 {
								 
								 $historial_consulta=mysql_query("
																select * 
															  	from historial_productos left join productos using (id_producto)
															  	where 
															  	month(fecha_hp)=$mes and year(fecha_hp)=$año  and estado_hp=1  ".$where_tipo."
																");
								 
								 $historial_consulta2=mysql_query("
																select * 
															  	from historial_productos left join productos using (id_producto)
															  	where 
															  	month(fecha_hp)=$mes and year(fecha_hp)=$año and estado_hp=1   ".$where_tipo."
																");
								 $titulo_fecha_datos=$mes." del $mes del ".$año;
							 }
							 
							 // Dia
							 if($tipo_reporte==2)
							 {
								 $historial_consulta=mysql_query("
																select * 
															  	from historial_productos left join productos using (id_producto)
															  	where 
															  	fecha_hp='".$fecha_unica."' and estado_hp=1  ".$where_tipo."
																");
								 
								 $historial_consulta2=mysql_query("
																select * 
															  	from historial_productos left join productos using (id_producto)
															  	where 
															  	fecha_hp='".$fecha_unica."' and estado_hp=1  ".$where_tipo."
																");
								 
								 $titulo_fecha_datos="del dia ".formato_fecha("lectura",$fecha_unica);
								 
								 
							 }
							 //año
							 if($tipo_reporte==3)
							 {
								  
								 $historial_consulta=mysql_query("
																select * 
															  	from historial_productos left join productos using (id_producto)
															  	where 
															  	year(fecha_hp)='".$fecha_año."'  and estado_hp=1  ".$where_tipo."
																");
								 
								 $historial_consulta2=mysql_query("
																select * 
															  	from historial_productos left join productos using (id_producto)
															  	where 
															  	year(fecha_hp)='".$fecha_año."' and estado_hp=1  ".$where_tipo."
																");
								 
								 $titulo_fecha_datos=" del año ".$fecha_año;
								 
							 }
							 //rango
							 if($tipo_reporte==4)
							 {
								 
								 $historial_consulta=mysql_query("
																select * 
															  	from historial_productos left join productos using (id_producto)
															  	where 
															  	fecha_hp between '".$fecha_inicio_producto."' and '".$fecha_fin_producto."' 
																	 and estado_hp=1  ".$where_tipo."
																");
								 
								 $historial_consulta2=mysql_query("
																select * 
															  	from historial_productos left join productos using (id_producto)
															  	where 
															  	fecha_hp between '".$fecha_inicio_producto."' and '".$fecha_fin_producto."'  
																	and estado_hp=1  ".$where_tipo."
																");
								$titulo_fecha_datos="al periodo conformado entre ".formato_fecha("normal",$fecha_inicio_producto)." y ".formato_fecha("normal",$fecha_fin_producto);
							 }
		  
							 
							 /*	*/
							 	
							
							 
							
							// Comienza la creacion
							 
 					
								// se recorre para calcular el total y mostrar el resumen
                            	$total_entradas_resumen=0;
								$total_salidas_resumen=0;
								$total_filas_entradas_resumen=0;
								$total_filas_salidas_resumen=0;
								$total_valor_entradas_resumen=0;
								$total_valor_salidas_resumen=0;
									
 								if(mysql_num_rows($historial_consulta)>0)
								{
									
 									
									
									while($historial_aux_datos=mysql_fetch_array($historial_consulta))
									{
										 if($historial_aux_datos["tipo_operacion_hp"]=="entrada")
										 {
											 $total_filas_entradas_resumen++;
											 $total_entradas_resumen=$total_entradas_resumen+$historial_aux_datos["entrada_hp"];
											 $total_valor_entradas_resumen=$total_valor_entradas_resumen+ ($historial_aux_datos["entrada_hp"]*$historial_aux_datos["costo_hp"]);
										 }else{
											 $total_filas_salidas_resumen++;

											 $total_salidas_resumen=$total_salidas_resumen+$historial_aux_datos["salida_hp"];
											 $total_valor_salidas_resumen=$total_valor_salidas_resumen+ ($historial_aux_datos["salida_hp"]*$historial_aux_datos["valor_venta_hp"]);
										 }
										 
									
									
									
									}
									
							 
                               // Si hay se calcula el total y se imprime
                               	
								
								 
									if($inout==1)
									{
										$pdf_return.="<br>   
														
															El presente informe corresponde a las entradas $titulo_fecha_datos. En dicho tiempo se realizaron <b> ".$total_entradas_resumen." </b> entradas de  productos los que suman un valor de <b>".formato_numero(1, $total_valor_entradas_resumen)." </b> <br>
														
													   ";	
										
									}
									
									
									if($inout==2)
									{
										$pdf_return.="<p>  
														
															El presente informe corresponde a las salidas $titulo_fecha_datos. En dicho tiempo se realizaron <b> $total_salidas_resumen </b> salidas de productos los que suman un valor de <b>".formato_numero(1, $total_valor_salidas_resumen)." </b>
														
													  </p>";	
										
									}
									
                             
							 
							 		if($inout==3)
									{
										$pdf_return.="<p>  
														
															El presente informe corresponde a las entradas y salidas $titulo_fecha_datos. En dicho tiempo se realizaron <b> $total_salidas_resumen </b> salidas de productos los que suman un valor de <b>".formato_numero(1, $total_valor_salidas_resumen)." </b>, y un total de <b> $total_entradas_resumen </b> entradas de  productos los que suman un valor de <b>".formato_numero(1, $total_valor_entradas_resumen)." </b>
														
													  </p>";	
										
									}
						 		
								}else{// si no hay datos
									$pdf_return.="No hay datos para  el periodo seleccionado.";
								}
							
							
							
 							
							 // Se recorre de nuevo para mostrar la tabla
								if(mysql_num_rows($historial_consulta2)>0)
								{
									
									 
                          
                               
								  $pdf_return.="<table class=tabla_fea >		
												<tr >
													<th>Cod. P.</th>
													<th>Producto </th>
													<th>$variable_inout </th>
													";
								// add
								if($inout==3)
								{
									$pdf_return.="
												<th>Entradas</th>
												<th>Salidas</th>
												";
										
								}else{
									
									$pdf_return.="
												<th>Precio unit.</th>
												";
								}
													
													
								$pdf_return.=	"
													<th>Fecha </th>
													<th>Documento </th>
													<th>Total </th>
													
												</tr>
												";
                                
							 $total_salidas_fin=0;
										$total_entradas_fin=0;
									$sw=0;
									$estilo=0;
									$total_entradas_unitarias=0;
									$total_salidas_unitarias=0;
									while($historial_datos=mysql_fetch_array($historial_consulta2))
									{
										$signo="";
										$inout_cantidad="";
										$inout_monto="";
										$inout_unitario="";
									 	$entrada_inout3=0;
										$salida_inout3=0;
										
										
										
										 if($historial_datos["tipo_operacion_hp"]=="salida")
										 {
											 //$signo="-";
											 $inout_cantidad=$historial_datos["salida_hp"];
										     $inout_monto=formato_numero(1,$historial_datos["salida_hp"]*$historial_datos["valor_venta_hp"]);
											 $inout_unitario=formato_numero(1,$historial_datos["valor_venta_hp"]);
											 $total_salidas_unitarias=$total_salidas_unitarias+$historial_datos["salida_hp"];
											 $entrada_inout3=$inout_unitario;
											 
											 $total_salidas_fin= $total_salidas_fin + ($historial_datos["salida_hp"]*$historial_datos["valor_venta_hp"]);
										 }else{
											// $signo="";
											 $inout_cantidad=$historial_datos["entrada_hp"];
									  		 $inout_monto=formato_numero(1,$historial_datos["entrada_hp"]*$historial_datos["costo_hp"]);
											 $inout_unitario=formato_numero(1,$historial_datos["costo_hp"]);
											 $total_entradas_unitarias=$total_entradas_unitarias+$historial_datos["entrada_hp"];
											$salida_inout3=$inout_unitario;
											$total_entradas_fin=$total_entradas_fin+($historial_datos["entrada_hp"]*$historial_datos["costo_hp"]);
										 }
									
                                         
                                     $pdf_return.="<tr >
													<td>". $historial_datos["id_producto"] ."</td>
													<td>". $historial_datos["nombre_producto"] ."</td>
													<td>".$signo. $inout_cantidad." </td>";
													
										// add
								if($inout==3)
								{
									$pdf_return.="
												<td>".$entrada_inout3."</td>
												<td>".$salida_inout3."</td>
												";
										
								}else{
									
									$pdf_return.="
												<td>".$inout_unitario."</td>
												";
								}			
													
									  $pdf_return.="
													<td>". formato_fecha("normal",$historial_datos["fecha_hp"]) ." </td>
													<td>". $historial_datos["documento_hp"]." n° ".$historial_datos["num_documento_hp"] ."</td>
													<td>".$signo. $inout_monto." </td>
 												</tr>";
											
											
										
										
 										$total_ingresos= $total_ingresos+$historial_datos["valor_venta_hp"];
										
									
									
									
									}
									
								 
                        
							if($inout==1)
							{
								
								// fecha filtro $titulo_fecha_datos
								// total entradas $e
								//
								
								$pdf_return.= " 
  													<tr  class=fila_fin_tabla_fea>
														<th align=left >Total : </th>
														<th> </th>
														<th> </th>
														<th> </th>
														
														<th></th>
														<th> </th>
 														<th  align=left > ".formato_numero(1,$total_entradas_fin)."</th>
													</tr>
												  
 											 ";

								
							}elseif($inout==2){
								/*
								$titulo_fecha_datos
								$s
								formato_numero(1,$total_salidas)
								*/
									$pdf_return.= " 
  													<tr  class=fila_fin_tabla_fea>
														<th >Total : </th>
														<th> </th>
														<th> </th> 
														<th> </th>
														
														<th> </th>
														<th> </th>
 														<th  align=left > ".formato_numero(1,$total_salidas_fin)."</th>
													</tr> 
												  
 											 ";
							
								}else{
									$pdf_return.= " 
  													<tr  class=fila_fin_tabla_fea>
														<th >Total : </th>
														<th> </th>
														<th> </th> 
														<th></th>
														<th></th>
														<th> </th>
														<th> </th>
 														<th  align=left > ".formato_numero(1,$total_entradas_fin+$total_salidas_fin)."</th>
													</tr>
												  
 											 ";
									
								}    
						 		
								}else{
									
								}
								
								        
                           $pdf_return.=" </table>";

                           
							
	
	return $pdf_return;
	
}

function reporte_mano_obra()
{
	 			
    	 $mano_de_obra_consulta=mysql_query("select *  
	  									  from  trabajos  join  precios_trabajos using(id_trabajo) where estado_precio_trabajo='Activo' ");
	  
	  
 
 
					
$ficha_dos=cabecera_reporte("Mano de Obra ",$id); 




	$ficha_dos.="
 				<legend>Lista de trabajos</legend>
			 		<table class=tabla_ficha>
					<tbody>
						<tr>
					   		<th> Cod. </th>
							<th> Trabajo </th>
							<th> Precio Trabajo </th>
							 
						</tr>		
				 ";


if(mysql_num_rows($mano_de_obra_consulta)==0)
{
	
		$ficha_dos.="<tr><td colspan=3> No hay datos  </td></tr>";
		 
	
}else{
	
	
	
	
	
	while($mano_de_obra_datos=mysql_fetch_array($mano_de_obra_consulta) )
	{
			  
	
		$ficha_dos.="
			 <tr>
				<td>".$mano_de_obra_datos["id_trabajo"]."</td>
				<td>".$mano_de_obra_datos["nombre_trabajo"]."</td>
				<td>".formato_numero(1,$mano_de_obra_datos["precio_trabajo"])."</td>		   
			</tr>
			
			";

	}


}

$ficha_dos.="</tbody></table>";
 
 		
return $ficha_dos;
	
}

function reporte_lista_orden($accion_r, $fecha_inicio, $fecha_salida, $fecha_unica,$fecha_mes,$fecha_año )
{
	$pdf_return="";
	
	// 1 =entrada , 2 = salida , 3 =entradas y salidas
	 
	 
	
	 
								$tipo_reporte=$accion_r;
							
								//$id_producto=14;
								$fecha_inicio_producto=$fecha_inicio;
								$fecha_fin_producto=$fecha_salida;
								//$fecha_unica=$fecha_unica; //--
								//$fecha_mes=$fecha_mes; //--
								$fecha_mes_array=explode("-",$fecha_mes); //--
								$mes=$fecha_mes_array[1];
								$año=$fecha_mes_array[0];
								
								$fecha_registro=$fecha_unica;
								//--- variables de cabecera --
								$titulo_tiempo_cantidad="Cantidad de ventas en el mes";
								$titulo_total_salida="Total salidas";
								$titulo_fecha_datos="Fecha de datos";
								
 								
								//---
								$total_egresos=0;
								$total_ingresos=0;
								
								$total_entradas=0;
								$total_salidas=0;
								
				 				
				
							 
							// Mes										
 							 if($tipo_reporte==1)
							 {
								 
								 $historial_consulta=mysql_query("
																  select *
																  from ordenes_trabajo  join estados_cuenta using(id_orden)
																  where estado_orden='completa' 
																  		and estado_cuenta='pagada' 
																		and  month(fecha_orden)='$mes'
																		and  year(fecha_orden)='$año'
																  order by fecha_orden
																  ");
								 
								 $historial_consulta2=mysql_query("
																  select *
																  from ordenes_trabajo  join estados_cuenta using(id_orden)
																  where estado_orden='completa' 
																  		and estado_cuenta='pagada' 
																		and  month(fecha_orden)='$mes'
																		and  year(fecha_orden)='$año'
																  order by fecha_orden
																  ");
								 $titulo_fecha_datos=$mes." del $mes del ".$año;
							 }
							 
							 // Dia
							 if($tipo_reporte==2)
							 {
								 $historial_consulta=mysql_query("select * 
																from ordenes_trabajo  join estados_cuenta using(id_orden) 
																where estado_orden='completa' and 
																	  estado_cuenta='pagada' and 
																	  fecha_orden='".$fecha_unica."' 
																order by fecha_orden 
																");
								 
								 $historial_consulta2=mysql_query("
																
																select * 
																from ordenes_trabajo  join estados_cuenta using(id_orden) 
																where estado_orden='completa' and 
																	  estado_cuenta='pagada' and 
																	  fecha_orden='".$fecha_unica."' 
																order by fecha_orden
																
																
																");
								 
								 $titulo_fecha_datos="del dia ".formato_fecha("lectura",$fecha_unica);
							 }
							 //año
							 if($tipo_reporte==3)
							 {
								  
								 $historial_consulta=mysql_query("
																select * 
															  	from historial_productos left join productos using (id_producto)
															  	where 
															  	year(fecha_orden)='".$fecha_año."'  and estado_hp=1  ".$where_tipo."
																");
								 
								 $historial_consulta2=mysql_query("
																  select * 
																  from ordenes_trabajo  join estados_cuenta using(id_orden) 
																  where estado_orden='completa' and 
																  estado_cuenta='pagada' and  
																  year(fecha_orden)='$año' 
																  order by fecha_orden;");								 
								 $titulo_fecha_datos=" del año ".$fecha_año;
							 }
							 //rango
							 if($tipo_reporte==4)
							 {
								 
								 $historial_consulta=mysql_query("
																select * 
																from ordenes_trabajo  join estados_cuenta using(id_orden) 
																where estado_orden='completa' and 
																	estado_cuenta='pagada' and  
																	fecha_orden between '".$fecha_inicio_producto."'  and '".$fecha_fin_producto."'  
																order by fecha_orden
																");
								 
								 $historial_consulta2=mysql_query("
																select * 
																from ordenes_trabajo  join estados_cuenta using(id_orden) 
																where estado_orden='completa' and 
																	estado_cuenta='pagada' and  
																	fecha_orden between '".$fecha_inicio_producto."'  and '".$fecha_fin_producto."'  
																order by fecha_orden
																");
								$titulo_fecha_datos="al periodo conformado entre ".formato_fecha("normal",$fecha_inicio_producto)." y ".formato_fecha("normal",$fecha_fin_producto);
							 }
		  
							 
							 /*	*/
							 $hc=mysql_num_rows($historial_consulta2);
							
							 

							// Comienza la creacion
							$pdf_return.= "<br><br><br>".cabecera_reporte("Lista de ordenes de trabajo");
					
							 
							 $pdf_return.="<br> El presente informe corresponde a las ordenes de trabajo emitidas $titulo_fecha_datos ";
							
							 // Se recorre de nuevo para mostrar la tabla
								if(mysql_num_rows($historial_consulta2)>0)
								{
									
									 
                          
                               
								  $pdf_return.="<table class=tabla_fea>		
												<tr>
													<th>Cod. O.</th>
													<th>fecha orden </th>
													<th>Observacion.</th>
													<th>Mano de obra </th>
													<th>Repuestos </th>
													<th>Neto </th>
													<th>IVA </th>
													<th>Total</th>
												</tr>
												";
                                
							 		$total_mano=0;
									$total_repuesto=0;
									$total_neto=0;
									$total_iva=0;
									$total_total=0;
									
									while($historial_datos=mysql_fetch_array($historial_consulta2))
									{
										 
                                     $pdf_return.="<tr>
													<td>". $historial_datos["id_orden"] ."</td>
													<td>". $historial_datos["fecha_orden"] ."</td>
													<td>". $historial_datos["observacion_orden"] ."</td>
													<td>".formato_numero(1,$historial_datos["total_mano_obra_orden"]) ."</td>
													<td>".formato_numero(1,$historial_datos["total_repuestos_orden"])." </td>
													<td>". formato_numero(1,$historial_datos["neto_orden"]) ." </td>
													<td>". formato_numero(1,$historial_datos["iva_orden"]) ."</td>
													<td>".formato_numero(1,$historial_datos["total_pagar_orden"])." </td>
													 
												</tr>";
											
												$total_mano=$total_mano+$historial_datos["total_mano_obra_orden"];
												$total_repuesto=$total_repuesto+$historial_datos["total_repuesto_orden"];
												$total_neto=$total_neto+$historial_datos["neto_orden"];
												$total_iva=$total_iva+$historial_datos["iva_orden"];
												$total_total=$total_total+$historial_datos["total_pagar_orden"];
										 
									}
									
									$pdf_return.="<tr class=fila_fin_tabla_fea>
													<th>Totales</th>
													<th></th>
													<th></th>
													<th>".formato_numero(1,$total_mano) ."</th>
													<th>".formato_numero(1,$total_repuesto) ."</th>
													<th>".formato_numero(1,$total_neto) ."</th>
													<th>".formato_numero(1,$total_iva) ."</th>
													<th>".formato_numero(1,$total_total) ."</th>
												</tr>
												";
								 
                               
                           $pdf_return.=" </table>";

                               
						 		
								}else{
									
								}
								
							
	
	return $pdf_return;
	
}

}


function cargar_modelo($id_marca){
	
	 $modelo_consulta=mysql_query("SELECT * FROM MODELOS_VEHICULOS WHERE ID_MARCA='".$id_marca."' ORDER BY NOMBRE_MODELO  ");
	 $options="<option value selected>Seleccione</option>";
	
	 while($modelo_datos=mysql_fetch_array($modelo_consulta))
		 
	 {
		 $options.="<option value='".$modelo_datos['id_modelo']."'>".$modelo_datos['nombre_modelo']."</option>";
		 
		 
		 
	 }
	 
	 echo $options;	
	
}










?>