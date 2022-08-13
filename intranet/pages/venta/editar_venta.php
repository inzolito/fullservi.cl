<?
include("../../functions/funciones.php");
	conecta_bd2();
valida_sesion();
	
$dato_vehiculo=datos_global($_REQUEST['vehiculo'],"id_vehiculo","vehiculos","*");
?>
<!doctype html>
<html>
<head>
<script>
 $(document).ready(function(){
		   
		   $("#frm_editar_publicar").submit(function(event){
			   	
			   		event.preventDefault()
				
					guardar_editar_publicacion()
					
					
						
					
		   })
		   
		    $("#div_foto1").click(function(){
				
				$("#file_1").click();	
			})
		 	$("#div_foto2").click(function(){
				
				$("#file_2").click();	
			})
		 	$("#div_foto3").click(function(){
				
				$("#file_3").click();	
			})
		 	$("#div_foto4").click(function(){
				
				$("#file_4").click();	
			})
			$("#div_foto5").click(function(){
				
				$("#file_5").click();	
			})


	  
})
 		  
		  
function showMyImage(fileInput,num) 
{
		  
		  
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
                continue;
            } 
 		 
			
			if($("#img_"+num).is(":visible"))
			{
			/*
				       $("#img_"+num).fadeOut(200,function(){
						$("#div_foto"+num).removeClass("div_marco_foto");
						$("#div_foto"+num).addClass("div_agregar_foto");
						
						$("#div_contenedor_loading_"+num).fadeIn(200);
						
					   });
			*/	
				
						
			}else{
				$("#i_agregar_"+num).fadeOut(200,function(){
					
					$("#div_contenedor_loading_"+num).fadeIn(200);
				})
				
			}
			
			
            var img=document.getElementById("img_"+num);            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
			setTimeout(function(){ 
			
				$("#div_contenedor_loading_"+num).fadeOut(100,function(){
					
					$("#div_foto"+num).addClass("div_marco_foto")
					$("#div_foto"+num).removeClass("div_agregar_foto")
					$("#img_"+num).fadeIn(100);
				});
				
			}, 400);
			 
        }    
}
	function boton_subir()
{
		
	$("#file_principal").click()
		
}
 
	</script>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>


<div class="panel panel-default"> 
<div class="panel-body">

<form id="frm_editar_publicar" name="frm_editar_publicar" enctype="multipart/form-data"  method="post" >
<div class="row">
 
  <div class="col-xs-12"> 
	<fieldset><legend> Editar Publicación de Venta <input name="txt_vehiculo" id="txt_vehiculo" type="hidden" value="<? echo($_REQUEST['vehiculo']) ?>"></legend> </fieldset>
	</div>
	 <div class="col-md-4">
		  <label for="cmb_marca"> Marca</label>
		  <input class="form-control" type="text" id="cmb_marca" name="cmb_marca" value="<? echo($dato_vehiculo['marca_vehiculo'])?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" required>
	 </div>
	
	 <div class="col-md-4">
	    <label for="cmb_modelo"> Modelo </label>
	 	  
	 	  <input type="text" id="cmb_modelo" name="cmb_modelo" class="form-control" value="<? echo($dato_vehiculo['modelo_vehiculo']) ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" required>
	</div>
	
	 <div class="col-md-2">
	  <label for="txt_ano"> Año</label>
	 <input name="txt_ano" required="required"  class="form-control" id="txt_ano" value="<? echo($dato_vehiculo['ano_vehiculo'])?>"> 
	 
		
	</div>
	
	 <div class="col-md-2">
	  <label for="txt_kilometraje"> Kilometraje</label>
	 <input name="txt_kilometraje" required="required"  class="form-control" id="txt_kilometraje" value="<? echo($dato_vehiculo['kilometraje_vehiculo'])?>" onClick="formato_numero(this)"> 
	 <script>$("#txt_kilometraje").click()</script>
		 
	</div>

	</div>

	
<div class="row">
 <div class="col-md-2">
	  <label for="txt_color"> Color</label>
	 <input  class="form-control" id="txt_color" name="txt_color" value="<? echo($dato_vehiculo['color_vehiculo'])?>"> 
	 
		 
	</div>
	<div class="col-md-2">
	  <label for="txt_color"> Motor</label>
	   <select class="form-control" id="cmb_motor" name="cmb_motor" required> 
			  
				  <option value>----seleccione---- </option>
				  
				  <? for($x=1 ;$x<=9; $x++){
	   					for($i=0 ;$i<=9; $i++){
	   						
				  ?>
				  			
				  <option <? if($dato_vehiculo['motor_vehiculo']==($x.".".$i)){echo('selected');} ?> value="<? echo($x.".".$i); ?>" <? if($datos_vehiculo['motor_vehiculo']==($x.".".$i)){ echo("selected"); } ?>><? echo($x.".".$i); ?> </option>
	   
	  				 <?
	   
   						}	
				  	
	   
	   
   						}	 
				  
				  ?>
			  
			  
	    </select>
	 
		 
	</div>
	
	<div class="col-md-2">
		<label for="cmb_transmision">  Transmision</label>
	 <select class="form-control" id="cmb_transmision" name="cmb_transmision">
	   <option value="manual" <? if($dato_vehiculo['transmision_vehiculo']=="manual"){ echo("selected");} ?>>Manual</option>
	   <option value="automatico" <? if($dato_vehiculo['transmision_vehiculo']=="automatico"){ echo("selected");} ?>>Automático</option> 
		</select>
	</div>
	<div class="col-md-2">
		<label for="cmb_combustible">  Combustible</label>
	 <select class="form-control" id="cmb_combustible" name="cmb_combustible">
	   <option value="bencina" <? if($dato_vehiculo['combustible_vehiculo']=="bencina"){ echo("selected");} ?>>Bencina</option>
	   <option value="diesel"  <? if($dato_vehiculo['combustible_vehiculo']=="diesel"){ echo("selected");} ?> >Diesel</option>
	   <option value="gas"  <? if($dato_vehiculo['combustible_vehiculo']=="gas"){ echo("selected");} ?>>Gas</option>
	   <option value="electrico"  <? if($dato_vehiculo['combustible_vehiculo']=="electrico"){ echo("selected");} ?>>Eléctrico</option> 
		</select>
	</div>
	<div class="col-md-2">
		<label for="cmb_puertas"> numero De Puertas</label>
	 <select class="form-control" id="cmb_puertas" name="cmb_puertas">
	   <option value="2"  <? if($dato_vehiculo['puertas_vehiculo']=="2"){ echo("selected");} ?>>2</option>
	   <option value="3"  <? if($dato_vehiculo['puertas_vehiculo']=="3"){ echo("selected");} ?>>3</option>
	   <option value="4" <? if($dato_vehiculo['puertas_vehiculo']=="4"){ echo("selected");} ?>>4</option>
	   <option value="5" <? if($dato_vehiculo['puertas_vehiculo']=="5"){ echo("selected");} ?>>5</option> 
		</select>
	</div>
	<div class="col-md-2"><label for="cmb_airbag">Numero De Airbags</label>
	  <select class="form-control" id="cmb_airbag" name="cmb_airbag">
	    <option value="0" <? if($dato_vehiculo['airbags_vehiculo']=="0"){ echo("selected");} ?>>0</option>
	    <option value="1" <? if($dato_vehiculo['airbags_vehiculo']=="1"){ echo("selected");} ?>>1</option>
	    <option value="2" <? if($dato_vehiculo['airbags_vehiculo']=="2"){ echo("selected");} ?>>2</option>
	    <option value="3" <? if($dato_vehiculo['airbags_vehiculo']=="3"){ echo("selected");} ?>>3</option>
	    <option value="4" <? if($dato_vehiculo['airbags_vehiculo']=="4"){ echo("selected");} ?>>4</option>
	    <option value="5" <? if($dato_vehiculo['airbags_vehiculo']=="5"){ echo("selected");} ?>>5</option>
	    <option value="6" <? if($dato_vehiculo['airbags_vehiculo']=="6"){ echo("selected");} ?>>6</option>
	    <option value="7" <? if($dato_vehiculo['airbags_vehiculo']=="7"){ echo("selected");} ?>>7</option>
	    <option value="8" <? if($dato_vehiculo['airbags_vehiculo']=="8"){ echo("selected");} ?>>8</option> 
	    </select>
	</div>
	</div>
	
<div class="row">
	<div class="col-md-2">
		<label for="cmb_aire">Aire Acondicionado </label>
		<select name="cmb_aire" class="form-control" id="cmb_aire">
		  <option value="si" <? if($dato_vehiculo['aire_vehiculo']=="si"){ echo("selected");} ?>>si</option>
		  <option value="no" <? if($dato_vehiculo['aire_vehiculo']=="no"){ echo("selected");} ?>>no</option>
        </select>
	</div>
	<div class="col-md-2">
		<label for="cmb_vidrio">AlzaVidrios Electrico </label>
		<select name="cmb_vidrio" class="form-control" id="cmb_vidrio">
		  <option value="si" <? if($dato_vehiculo['alza_vidrios_vehiculo']=="si"){ echo("selected");} ?>>si</option>
		  <option value="no"  <? if($dato_vehiculo['alza_vidrios_vehiculo']=="no"){ echo("selected");} ?>>no</option>
        </select>
	</div>
<div class="col-md-2">
		<label for="cmb_frenos">Frenos ABS</label>
		<select name="cmb_frenos" class="form-control" id="cmb_frenos">
		  <option value="si"  <? if($dato_vehiculo['abs_vehiculo']=="si"){ echo("selected");} ?>>si</option>
		  <option value="no"  <? if($dato_vehiculo['abs_vehiculo']=="no"){ echo("selected");} ?>>no</option>
        </select>
	</div>
<div class="col-md-2">
		<label for="cmb_cierre">Cierre centralizado</label>
		<select name="cmb_cierre" class="form-control" id="cmb_cierre">
		  <option value="si"  <? if($dato_vehiculo['cierre_centralizado_vehiculo']=="si"){ echo("selected");} ?>>si</option>
		  <option value="no" <? if($dato_vehiculo['cierre_centralizado_vehiculo']=="no"){ echo("selected");} ?>>no</option>
        </select>
	</div>
	<div class="col-md-2">
		<label for="cmb_catalitico">Catalitico </label>
		<select name="cmb_catalitico" class="form-control" id="cmb_catalitico">
		  <option value="si"  <? if($dato_vehiculo['catalitico_vehiculo']=="si"){ echo("selected");} ?>>si</option>
		  <option value="no"  <? if($dato_vehiculo['catalitico_vehiculo']=="no"){ echo("selected");} ?>>no</option>
        </select>
	</div>
	<div class="col-md-2">
		<label for="cmb_llantas">Llantas </label>
		<select name="cmb_llantas" class="form-control" id="cmb_llantas">
		  <option value="si"  <? if($dato_vehiculo['llanta_vehiculo']=="si"){ echo("selected");} ?>>si</option>
		  <option value="no" <? if($dato_vehiculo['llanta_vehiculo']=="no"){ echo("selected");} ?>>no</option>
        </select>
	</div>



	</div>
	
<div class="row">
<div class="col-md-2">
		<label for="cmb_radio">Radio </label>
			
	    <select name="cmb_radio" id="cmb_radio" class="form-control">
	      <option value="si" value="no" <? if($dato_vehiculo['radio_vehiculo']=="si"){ echo("selected");} ?> >si</option>
	      <option value="no"<? if($dato_vehiculo['radio_vehiculo']=="no"){ echo("selected");} ?>>no</option>
	      </select>
</div>
<div class="col-md-2">
		<label for="cmb_fwd">FWD </label>
			
	    <select name="cmb_fwd" id="cmb_fwd" class="form-control">
	      <option value="4X2" <? if($dato_vehiculo['fwd_vehiculo']=="si"){ echo("selected");} ?>>4X2</option>
	      <option value="4X4" <? if($dato_vehiculo['fwd_vehiculo']=="no"){ echo("selected");} ?>>4X4</option>
	      </select>
</div>

<div class="col-md-2">
		<label for="cmb_direccion">Direccion </label>
			
	    <select name="cmb_direccion" id="cmb_direccion" class="form-control">
	      <option value="asistida" <? if($dato_vehiculo['direccion_vehiculo']=="asistida"){ echo("selected");} ?>>Asistida</option>
	      <option value="hidraulica" <? if($dato_vehiculo['direccion_vehiculo']=="hidraulica"){ echo("selected");} ?>>Hidraulica</option>
	       <option value="mecanica" <? if($dato_vehiculo['direccion_vehiculo']=="mecanica"){ echo("selected");} ?>>Mecanica</option>
	      </select>
</div>


<div class="col-md-2">
		<label for="cmb_espejo">Espejo Electrico </label>
			
	    <select name="cmb_espejo" id="cmb_espejo" class="form-control">
	     <option value="si" <? if($dato_vehiculo['espejo_electrico_vehiculo']=="si"){ echo("selected");} ?>>si</option>
	      <option value="no"<? if($dato_vehiculo['espejo_electrico_vehiculo']=="no"){ echo("selected");} ?>>no</option>
	      </select>
</div>

<div class="col-md-4">
		<label for="txt_precio">Precio De Venta </label>
			
	    <input type="text" onKeyUp="formato_moneda(this)" name="txt_precio" id="txt_precio" value="<? echo(formato_numero(1,$dato_vehiculo['precio_vehiculo'])) ?>"  class="form-control" required>
	     
</div>
 
	</div>
	
<div class="row">
<div class="col-md-12">
		<label for="txt_observacion">Descripción </label>
		<textarea name="txt_observacion" class="form-control"><? echo($dato_vehiculo['observacion_vehiculo']) ?></textarea>
	</div>
	
	
	
	</div>
	
<div class="row"> 
		
        
        
        
        		
	<div class="col-md-8" style="margin-top: 15px;">
	  	
	<!---     -->
    
    
  

     <!--   --> 	
       <div class="col-md-3" align="center">
       <h2>Foto principal</h2>
       		 <!-- Foto -->
               <input  type="hidden" name="accion2" id="accion2" > 

               <?
               	$foto_portada_consulta=mysql_query("select *  
													from fotos 
													where id_vehiculo='".$dato_vehiculo["id_vehiculo"]."' and 
														  tamano_foto='small' and 
														  foto_portada=1 
													order by orden_foto asc ");
			   
			   $src="";
			 	   
               ?>
                <div id="div_foto5" class="div_agregar_foto" > 
                	
                    <i id="i_agregar_5" class="fa fa-plus" aria-hidden="true"></i>
                    <div id="div_contenedor_loading_5">  
                         <i   class="fa fa-spinner fa-pulse  fa-fw" style="color:color: #c75c5c;"></i>
                         <span class="sr-only"></span>
                    </div>
                    
                    <?
					if(mysql_num_rows($foto_portada_consulta)==1)
				   {
						$foto_portada_datos=mysql_fetch_array($foto_portada_consulta);
						$src='src="../../../webpage/img/'.$foto_portada_datos["nombre_foto"].'"';	   
						
						?>
                        <script>
						
							$("#div_contenedor_loading_5").hide();
							$("#i_agregar_5").hide();
 							$("#div_foto5").addClass("div_marco_foto")
							$("#div_foto5").removeClass("div_agregar_foto")
						</script>
                        <?
				   }else{
					   ?>
                        <script>
							$("#div_contenedor_loading_5").hide();
							//$("#i_agregar_5").hide();
 							//$("#div_foto5").addClass("div_marco_foto")
							//$("#div_foto5").removeClass("div_agregar_foto")
						</script>
                        <?					   
				   }
					?>
                    
                    <img id="img_5"  style="max-height:100px; max-width:100px;"  <?  echo $src?> >
 
                </div>
   				
        		<input   name="file_5" id="file_5" type="file" onchange="showMyImage(this,5)" />
			 
            	<input  type="hidden" name="accion" id="accion" > 
         
               </div>
       
       			
       
   
    <div class="col-md-8" align="center" >
    		 
            <h2>Galeria</h2>
            <div style="display:table">
               
      			<?
            
			  
			  for($x=1;$x<5;$x++)
			  {
				
				  $fotos_vehiculo_consulta=mysql_query("select *  
													from fotos 
													where id_vehiculo='".$dato_vehiculo["id_vehiculo"]."' and 
														  tamano_foto='small' and 
														  foto_portada=0 and
														  orden_foto=$x
													order by orden_foto asc ");
			   
			   $src="";
			  
               ?> 
               <!-- Foto -->
                <div id="div_foto<? echo $x ?>" class="div_agregar_foto" > 
                	
                    <i id="i_agregar_<? echo $x ?>" class="fa fa-plus" aria-hidden="true"></i>
                    <div id="div_contenedor_loading_<? echo $x ?>">  
                         <i   class="fa fa-spinner fa-pulse  fa-fw" style="color:color: #c75c5c;"></i>
                         <span class="sr-only"></span>
                    </div>
                    
                    <?
					if(mysql_num_rows($fotos_vehiculo_consulta)==1)
				   {
						$fotos_vehiculo_datos=mysql_fetch_array($fotos_vehiculo_consulta);
						$src='src="../../../webpage/img/'.$fotos_vehiculo_datos["nombre_foto"].'"';	   
						
						?>
                        <script>
							$("#div_contenedor_loading_<? echo $x ?>").hide();
							$("#i_agregar_<? echo $x ?>").hide();
 							$("#div_foto<? echo $x ?>").addClass("div_marco_foto")
							$("#div_foto<? echo $x ?>").removeClass("div_agregar_foto")
						</script>
                        <?
				   }else{
					   ?>
                        <script>
							$("#div_contenedor_loading_<? echo $x ?>").hide();
								$("#img_<? echo $x ?>").hide();
					
 							//$("#i_agregar_5").hide();
 							//$("#div_foto5").addClass("div_marco_foto")
							//$("#div_foto5").removeClass("div_agregar_foto")
						</script>
                        <?					   
				   }
					?>
                    <img id="img_<? echo $x ?>"  style="max-height:100px; max-width:100px;" <?  echo $src?>>
 
                </div>
   				<input   name="file_<? echo $x ?>" id="file_<? echo $x ?>" type="file" onchange="showMyImage(this,<? echo $x ?>)" />
				<!-- -->                 
            <?
			  }
			?>  		
 
  
                
            

                <script>
				 
				 $("#file_5").hide()
				$("#file_1").hide();
				$("#file_2").hide();
				$("#file_3").hide();
				$("#file_4").hide();
					
					  

				</script>
                
           </div> 
            
        </div>
    
     
    
     
    
    
    
    </div>
	
    
        
        
        
        
	<div class="col-md-8" style="margin-top: 15px;">
	  	
	</div>
	<div class="col-md-4" style="margin-top: 15px;">
	  	<button type="submit" class="btn btn-primary btn-block" id="edita"> Guardar Cambios </button>
	 
	  	<button type="button" class="btn btn-warning btn-block" onclick="cargar_vehiculos()"> Volver </button>
	</div>
	</div>
 
 </form>	

	</div>
	</div>
</body>
</html>