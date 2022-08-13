<?
include("../../functions/funciones.php");
	conecta_bd2();
valida_sesion();
	
?>
<!doctype html>
<html>
<head>
<script>
 $(document).ready(function(){
		   
		   $("#frm_publicar").submit(function(event){
			   	
			   		event.preventDefault()
				
					publicar_vehiculo()					
		   });
		   
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
	
		   
 });
		  
		  
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
  
  <style>
  .div_agregar_foto{
	      width: 100px;
    height: 100px;
    font-size: 30px;
    border: 1px solid;
    border-color: rgba(255, 0, 0, 0.45);
    border-radius: 5px;
    padding-top: 28px;
    color: #337ab7;
    -moz-box-shadow: -2px 2px 5px #000000;
    -webkit-box-shadow: -2px 2px 5px #000000;
    box-shadow: -2px 2px 5px #000000;
	    display: inline-block;
    margin: 5px;
	
	-webkit-transition: all 0.2s linear;
-moz-transition: all 0.2s linear;
-ms-transition: all 0.2s linear;
-o-transition: all 0.2s linear;
transition: all 0.2s linear;
  }
  
   .div_agregar_foto:hover{
	   cursor:pointer;
  }
  
  .div_marco_foto{
	      /* width: 100px; */
    /* height: 100px; */
    font-size: 30px;
    border: 2px solid;
    border-color: rgba(255, 0, 0, 0.45);
    border-radius: 5px;
    /* padding-top: 28px; */
    color: #c75c5c;
    -moz-box-shadow: -2px 2px 5px #000000;
    -webkit-box-shadow: -2px 2px 5px #000000;
    box-shadow: -2px 2px 5px #000000;
    display: inline-block;
    margin: 5px;
    padding: 2px;
	
	-webkit-transition: all 0.2s linear;
-moz-transition: all 0.2s linear;
-ms-transition: all 0.2s linear;
-o-transition: all 0.2s linear;
transition: all 0.2s linear;
  }
  
  </style>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>


<div class="panel panel-default"> 
<div class="panel-body">

<form id="frm_publicar" enctype="multipart/form-data"  method="post" >
<div class="row">
 <div class="col-xs-12"> 
	<fieldset><legend> Publicar Venta</legend> </fieldset>
	</div>
	 <div class="col-md-4">
		  <label for="cmb_marca"> Marca</label>
		  <input class="form-control" type="text" id="cmb_marca" name="cmb_marca" onKeyUp="javascript:this.value=this.value.toUpperCase();" required>
	
	 </div>
	
	 <div class="col-md-4">
	    <label for="cmb_modelo"> Modelo </label>
	 	  
	 	  		<input type="text" id="cmb_modelo" name="cmb_modelo" class="form-control" onKeyUp="javascript:this.value=this.value.toUpperCase();" required>
	 	  		
	 	  		
	</div>
	
	 <div class="col-md-2">
	  <label for="txt_ano"> Año</label>
	 <input  type="number" min="1800" max="<? echo date("Y")+1 ?>" name="txt_ano" required="required" value="<? echo date("Y") ?>" class="form-control" id="txt_ano"> 
	 
		
	</div>
	
	 <div class="col-md-2">
	  <label for="txt_kilometraje"> Kilometraje</label>
	 <input name="txt_kilometraje" type="text"   value="0" required="required"  onKeyUp="formato_numero(this)"  class="form-control" id="txt_kilometraje"> 
	 
		 
	</div>

	</div>

	
<div class="row">
 <div class="col-md-2">
	  <label for="txt_color"> Color</label>
	 <input  class="form-control" id="txt_color" name="txt_color" required> 
	 
		 
	</div>
	<div class="col-md-2">
	  <label for="txt_color"> Motor</label>
	   <select class="form-control" id="cmb_motor" name="cmb_motor" required> 
			  
				  <option value>----seleccione---- </option>
				  
				  <? for($x=1 ;$x<=9; $x++){
	   					for($i=0 ;$i<=9; $i++){
	   						
				  ?>
				  			
				  <option value="<? echo($x.".".$i); ?>" <? if($datos_vehiculo['motor_vehiculo']==($x.".".$i)){ echo("selected"); } ?>><? echo($x.".".$i); ?> </option>
	   
	  				 <?
	   
   						}	
				  	
	   
	   
   						}	 
				  
				  ?>
			  
			  
	    </select>
	 
		 
	</div>
	
	<div class="col-md-2">
		<label for="cmb_transmision">  Transmision</label>
	 <select class="form-control" id="cmb_transmision" name="cmb_transmision">
	   <option value="manual">Manual</option>
	   <option value="automatico">Automático</option> 
		</select>
	</div>
	<div class="col-md-2">
		<label for="cmb_combustible">  Combustible</label>
	 <select class="form-control" id="cmb_combustible" name="cmb_combustible">
	   <option value="bencina">Bencina</option>
	   <option value="diesel">Diesel</option>
	   <option value="gas">Gas</option>
	   <option value="electrico">Eléctrico</option> 
		</select>
	</div>
	<div class="col-md-2">
		<label for="cmb_puertas"> numero De Puertas</label>
	 <select class="form-control" id="cmb_puertas" name="cmb_puertas">
	   <option value="2">2</option>
	   <option value="3">3</option>
	   <option value="4">4</option>
	   <option value="5">5</option> 
		</select>
	</div>
	<div class="col-md-2"><label for="cmb_airbag">Numero De Airbags</label>
	  <select class="form-control" id="cmb_airbag" name="cmb_airbag">
	    <option value="0">0</option>
	    <option value="1">1</option>
	    <option value="2">2</option>
	    <option value="3">3</option>
	    <option value="4">4</option>
	    <option value="5">5</option>
	    <option value="6">6</option>
	    <option value="7">7</option>
	    <option value="8">8</option> 
	    </select>
	</div>
	</div>
	
<div class="row">
	<div class="col-md-2">
		<label for="cmb_aire">Aire Acondicionado </label>
		<select name="cmb_aire" class="form-control" id="cmb_aire">
		  <option value="si">si</option>
		  <option value="no">no</option>
        </select>
	</div>
	<div class="col-md-2">
		<label for="cmb_aire">AlzaVidrios Electrico </label>
		<select name="cmb_vidrio" class="form-control" id="cmb_vidrio">
		  <option value="si">si</option>
		  <option value="no">no</option>
        </select>
	</div>
<div class="col-md-2">
		<label for="cmb_aire">Frenos ABS</label>
		<select name="cmb_frenos" class="form-control" id="cmb_frenos">
		  <option value="si">si</option>
		  <option value="no">no</option>
        </select>
	</div>
<div class="col-md-2">
		<label for="cmb_aire">Cierre centralizado</label>
		<select name="cmb_cierre" class="form-control" id="cmb_cierre">
		  <option value="si">si</option>
		  <option value="no">no</option>
        </select>
	</div>
	<div class="col-md-2">
		<label for="cmb_aire">Catalitico </label>
		<select name="cmb_catalitico" class="form-control" id="cmb_catalitico">
		  <option value="si">si</option>
		  <option value="no">no</option>
        </select>
	</div>
	<div class="col-md-2">
		<label for="cmb_aire">Llantas </label>
		<select name="cmb_llantas" class="form-control" id="cmb_llantas">
		  <option value="si">si</option>
		  <option value="no">no</option>
        </select>
	</div>



	</div>
	
<div class="row">
<div class="col-md-2">
		<label for="cmb_radio">Radio </label>
			
	    <select name="cmb_radio" id="cmb_radio" class="form-control">
	      <option value="si">si</option>
	      <option value="no">no</option>
	      </select>
</div>
<div class="col-md-2">
		<label for="cmb_fwd">FWD </label>
			
	    <select name="cmb_fwd" id="cmb_fwd" class="form-control">
	      <option value="4X2">4X2</option>
	      <option value="4X4">4X4</option>
	      </select>
</div>

<div class="col-md-2">
		<label for="cmb_direccion">Direccion </label>
			
	    <select name="cmb_direccion" id="cmb_direccion" class="form-control">
	      <option value="asistida">Asistida</option>
	      <option value="hidraulica">Hidraulica</option>
	       <option value="mecanica">Mecanica</option>
	      </select>
</div>


<div class="col-md-2">
		<label for="cmb_espejo">Espejo Electrico </label>
			
	    <select name="cmb_espejo" id="cmb_espejo" class="form-control">
	     <option value="si">si</option>
	      <option value="no">no</option>
	      </select>
</div>

<div class="col-md-4">
		<label for="txt_precio">Precio De Venta </label>
			
	    <input type="text" onKeyUp="formato_moneda(this)" name="txt_precio" id="txt_precio"  class="form-control" required>
	     
</div>
 
	</div>
	
<div class="row">
<div class="col-md-12">
		<label for="cmb_aire">Descripción </label>
		<textarea name="txt_observacion" class="form-control"></textarea>
	</div>
	
	
	
	</div>
	
<div class="row"> 
		
	<div class="col-md-8" style="margin-top: 15px;">
	  	
	<!---     -->
    
    
  

     <!--   --> 	
       <div class="col-md-3" align="center">
       <h4>Foto principal</h4>
       		 <!-- Foto -->
             
             
                <div id="div_foto5" class="div_agregar_foto" > 
                	
                    <i id="i_agregar_5" class="fa fa-plus" aria-hidden="true"></i>
                    <div id="div_contenedor_loading_5">  
                         <i   class="fa fa-spinner fa-pulse  fa-fw" style="color:color: #c75c5c;"></i>
                         <span class="sr-only"></span>
                    </div>
                    
                    
                    <img id="img_5"  style="max-height:100px; max-width:100px;" >
 
                </div>
   				<input   name="file_5" id="file_5" type="file" onchange="showMyImage(this,5)" />
			 
            	<input  type="hidden" name="accion" id="accion" > 
         
               </div>
       
       
       
   
    <div class="col-md-8" align="center" >
    		 
            <h4>Galeria</h4>
            <div style="display:table">
               
               <!-- Foto -->
                <div id="div_foto1" class="div_agregar_foto" > 
                	
                    <i id="i_agregar_1" class="fa fa-plus" aria-hidden="true"></i>
                    <div id="div_contenedor_loading_1">  
                         <i   class="fa fa-spinner fa-pulse  fa-fw" style="color:color: #c75c5c;"></i>
                         <span class="sr-only"></span>
                    </div>
                    
                    
                    <img id="img_1"  style="max-height:100px; max-width:100px;" >
 
                </div>
   				<input   name="file_1" id="file_1" type="file" onchange="showMyImage(this,1)" />
				<!-- -->                 
                		
 
 
 				 <!-- Foto -->
                <div id="div_foto2" class="div_agregar_foto" > 
                	
                    <i id="i_agregar_2" class="fa fa-plus" aria-hidden="true"></i>
                    <div id="div_contenedor_loading_2">  
                         <i   class="fa fa-spinner fa-pulse  fa-fw" style="color:color: #c75c5c;"></i>
                         <span class="sr-only"></span>
                    </div>
                    
                    
                    <img id="img_2"  style="max-height:100px; max-width:100px;" >
 
                </div>
   				<input   name="file_2" id="file_2" type="file" onchange="showMyImage(this,2)" />
				<!-- -->

				 <!-- Foto -->
                <div id="div_foto3" class="div_agregar_foto" > 
                	
                    <i id="i_agregar_3" class="fa fa-plus" aria-hidden="true"></i>
                    <div id="div_contenedor_loading_3">  
                         <i   class="fa fa-spinner fa-pulse  fa-fw" style="color:color: #c75c5c;"></i>
                         <span class="sr-only"></span>
                    </div>
                    
                    
                    <img id="img_3"  style="max-height:100px; max-width:100px;" >
 
                </div>
   				<input   name="file_3" id="file_3" type="file" onchange="showMyImage(this,3)" />
				<!-- -->
                
                 <!-- Foto -->
                <div id="div_foto4" class="div_agregar_foto" > 
                	
                    <i id="i_agregar_4" class="fa fa-plus" aria-hidden="true"></i>
                    <div id="div_contenedor_loading_4">  
                         <i   class="fa fa-spinner fa-pulse  fa-fw" style="color:color: #c75c5c;"></i>
                         <span class="sr-only"></span>
                    </div>
                    
                    
                    <img id="img_4"  style="max-height:100px; max-width:100px;" >
 
                </div>
   				<input   name="file_4" id="file_4" type="file" onchange="showMyImage(this,4)" />
				<!-- -->

                <script>
				 
				 $("#file_5").hide()
				$("#file_1").hide();
				$("#file_2").hide();
				$("#file_3").hide();
				$("#file_4").hide();
					$("#img_5").hide()
					$("#img_1").hide();
					$("#img_2").hide();
					$("#img_3").hide();
					$("#img_4").hide();
					
					$("#div_contenedor_loading_5").hide()
					$("#div_contenedor_loading_1").hide();
					$("#div_contenedor_loading_2").hide();
					$("#div_contenedor_loading_3").hide();
					$("#div_contenedor_loading_4").hide();

				</script>
                
           </div> 
            
        </div>
    
     
    
     
    
    
    
    </div>
	
    
    
    <div class="col-md-4" style="margin-top: 15px;"> 
	  	<button type="submit" class="btn btn-primary btn-block" id="edita"> Publicar </button>
       	<button type="button" class="btn btn-warning btn-block" onclick="cargar_vehiculos()"> Volver </button>

	</div>
	<div class="col-md-8" style="margin-top: 15px;">
	  	
	</div>
	 
	</div>
 
 </form>	
 	</div>
	</div>
</body>
<script>
	
	</script>
</html>