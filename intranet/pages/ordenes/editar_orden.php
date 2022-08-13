<?
include("../../functions/funciones.php");
	conecta_bd();

	valida_sesion();
$datos_orden=datos_global($_REQUEST['orden'],"id_orden","ordenes_trabajo","*");

$datos_cliente=datos_global($datos_orden['id_cliente'],"id_cliente","clientes","*");
$datos_vehiculo=datos_global($datos_orden['id_vehiculo'],"id_vehiculo","vehiculos","*");
$datos_articulos=datos_global($datos_orden['id_orden'],"id_orden","articulos_orden","*");

$datos_cuenta=datos_global($datos_orden['id_orden'],"id_orden","estados_cuenta","*");

	
 
?>


<!doctype html>
<html>
<head>
 
<meta charset="utf-8">
<title>Documento sin título</title>


<script>

	orden=<? echo($_REQUEST['orden']) ?>
	
		
	 $(document).ready(function(){
		   
		   $("#frm_editar_orden").submit(function(event){
			   	
			   		event.preventDefault()
					
					//alert(1)
					guardar_editar_orden()
					
					
					
		   
		   })
		   
		   
		   /* $("#frm_orden").submit(function(event){
			   	
			   		event.preventDefault()
					editar_orden()
					
					
					
		   
		   })
		   
		 */
		  
		   
	   });
	
	</script>
</head>

<body>
<form id="frm_editar_orden" name="frm_editar_orden">

<div class="panel">

<div class="panel-body">
	
	<div class="row"> 
	
	<div  style="float: right"class="col-xs-2">
		<h4><strong>Numero De Orden:</strong> <? echo(" ".$datos_orden['id_orden'] ) ?> <input id="txt_orden" name="txt_orden" type="hidden" value="<? echo($datos_orden['id_orden']) ?>">  </h4>
	
	   </div>
	   
	  </div>
	   
	   <div class="row"> 
	   <div  style="float: right"class="col-xs-2">
		<h4><strong>Fec. Emisión:</strong> <? echo formato_fecha("normal",$datos_orden['fecha_orden'])?> </h4>
		   </div>
	   </div>
	   
	<div class="row">
	
	<div class="col-xs-12"> 
	<fieldset><legend> Datos Cliente</legend> </fieldset>
	</div>
	
   
    <div class="col-md-2">

     <label for="icon_rut_cliente"> Run  Cliente (*)</label>

     <div id="div_txt_rut" class="has-feedback"  >
      <input type="text" class="form-control" id="txt_rut" name="txt_rut" aria-describedby="inputSuccess4Status" onKeyUp="validar_rut_cliente()" value="<? echo(formato_rut($datos_cliente['rut_cliente'],1)) ?>"  required  >
      <span class="glyphicon  form-control-feedback" id="icon_txt_rut" name="icon_txt_rut" aria-hidden="true"></span>

     </div>
      </div>




     <div class="col-md-4">
     <label for="txt_nombre">  Nombre Cliente (*)</label>
     <input type="text" class="form-control" id="txt_nombre" name="txt_nombre" required value="<? echo($datos_cliente['nombre_cliente']) ?>" >
     </div>

     <div class="col-md-2">
      <label for="txt_fono"> Fono </label>
     <input type="text" class="form-control" id="txt_fono" name="txt_fono"  value="<? echo($datos_cliente['fono_cliente']) ?>" >
     </div>
      <div class="col-md-2">
      <label for="txt_fono2"> Fono 2 </label>
     <input type="text" class="form-control" id="txt_fono2" name="txt_fono2"  value="<? echo($datos_cliente['fono2_cliente']) ?>" >
     </div>
      <div class="col-md-2">
      <label for="cmb_tipo_cliente"> Tipo Cliente (*)</label>
    
      <select class="form-control" id="cmb_tipo_cliente" name="cmb_tipo_cliente" required>
      <option value="seleccione" >Seleccione </option>
      <option value="Particular" <? if($datos_cliente['tipo_cliente']=="Particular"){ echo("selected");} ?>>Particular</option>
      <option value="Empresa" <? if($datos_cliente['tipo_cliente']=="Empresa"){ echo("selected");} ?>>Empresa </option>
       </select>
     </div>

      <div class="col-md-4">
      <label for="txt_nombre">  Correo Cliente</label>
     <input type="text" class="form-control" id="txt_correo" name="txt_correo" value="<? echo($datos_cliente['correo_cliente']) ?>" >
     </div>
     <div class="col-md-8">
      <label for="txt_direccion">Direccion (*)</label>
      
<input type="text" class="form-control" id="txt_direccion" name="txt_direccion"  required value="<? echo($datos_cliente['direccion_cliente']) ?>" >
     </div>

	
	</div>

	
	 
		
   
	
	



<div class="row">
<div class="col-xs-12" style="margin-top:15px"> 
	<fieldet><legend> Datos Vehiculo</legend> </fieldet> 
	</div>
	<div class="col-xs-1">
			 <label for="txt_codigo"> Codigo </label>
			<input type="text" class="form-control" id="txt_codigo" name="txt_codigo" value="<? echo $datos_vehiculo['id_vehiculo'] ?>" readonly  >
	
	   </div>
	   
	<div class="col-xs-1">
			 <label for="txt_patente"> Patente (*)</label>
			<input type="text" onKeyUp="javascript:this.value=this.value.toUpperCase();" class="form-control" id="txt_patente" name="txt_patente" value="<? echo $datos_vehiculo['patente_vehiculo'] ?>" onBlur="buscar_vehiculo(this.value)"  >
	
	   </div>
	  <div class="col-xs-2">
		  <label for="cmb_marca"> Marca (*)</label>
		 <input type="text" class="form-control" id="cmb_marca" name="cmb_marca" value="<? echo $datos_vehiculo['marca_vehiculo'] ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();">
		 </div>
	
    <script>
		//$("#cmb_marca").change();
	</script>
	 	 <div class="col-xs-2">
         
         <? 
 		 ?>
	 	  <label for="cmb_modelo"> Modelo (*)</label>
	 	  
	 	  	 <input id="cmb_modelo" name="cmb_modelo" class="form-control" value="<? echo $datos_vehiculo['modelo_vehiculo'] ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();">
	 	 </div>
		  <div class="col-xs-2">
	 	  <label for="txt_color"> Color (*)</label>
			
<input type="text" class="form-control" id="txt_color"  name="txt_color"  value="<? echo $datos_vehiculo['color_vehiculo'] ?>" >
		 </div>
		  <div class="col-xs-1">
		  <label for="cmb_motor" > Motor (*)</label>
	 		
			  <select class="form-control" id="cmb_motor" name="cmb_motor"> 
			  
				  <option value="seleccion">----seleccione---- </option>
				  
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
		   <div class="col-xs-1">
		  <label for="txt_ano"   > Año (*)</label>
	 		 <input type="text" class="form-control" id="txt_ano" name="txt_ano" value="<? echo $datos_vehiculo['ano_vehiculo'] ?>"  >
		 </div>
		  <div class="col-xs-2">
		  <label for="cmb_tipo_motor"> Tipo De Motor (*)</label>
			 
			  <select class="form-control" id="cmb_tipo_motor" name="cmb_tipo_motor">
				  <option value="seleccione">----selecccione----> </option>
				  <option value="bencinero" <? if($datos_vehiculo['tipo_motor_vehiculo']=="bencinero"){ echo("selected");} ?>> Bencinero </option>
			  		<option value="petrolero" <? if($datos_vehiculo['tipo_motor_vehiculo']=="petrolero"){ echo("selected");} ?>> Petrolero </option>
			  		<option value="electrico" <? if($datos_vehiculo['tipo_motor_vehiculo']=="electrico"){ echo("selected");} ?>> Electrico </option>
			  		<option value="gas" <? if($datos_vehiculo['tipo_motor_vehiculo']=="gas"){ echo("selected");} ?>> Gas </option>
			  </select>
		 </div>
		 
		 
		  <div class="col-xs-4">
		  <label for="txt_nmotor"> Numero De Motor (*) </label>
			<input type="text" class="form-control" id="txt_nmotor" name="txt_nmotor"  value="<? echo $datos_vehiculo['numero_motor_vehiculo'] ?>" >
		 </div>
		 <div class="col-xs-4">
		  <label for="txt_nchasis">Numero De chasis (*)</label>
			<input type="text" class="form-control" id="txt_nchasis" name="txt_nchasis" value="<? echo $datos_vehiculo['numero_chasis_vehiculo'] ?>"  >
		 </div>
		 
			  
		  <div class="col-xs-2">
		  <label for="txt_kilometraje">Kilometraje Actual (*)</label>
			<input type="text" class="form-control" id="txt_kilometraje" name="txt_kilometraje" required  value="<? echo $datos_orden['kilometraje_orden'] ?>" >
		 </div>
	
	 <div class="col-xs-2">
		  <label for="txt_entrega">Fecha de entrega</label>
			<input type="date" class="form-control" id="txt_entrega" name="txt_entrega" value="<? echo $datos_orden['fecha_entrega_orden'] ?>"  >
		 </div>
		
	</div>
		<p>
		<div class="panel panel-default">
	<div class="panel-body">
		
		<div class="table-responsive">
			<table class="table table-bordered table-condensed ">
			<tr>
				<td>Padron </td>
				<td></label>
                  <select name="select_1"  id="select_1" class="form-control">
					  <option value="si" <? if($datos_articulos['padron']=="si"){ echo("selected");}?> > si </option>
               			<option value="no"  <? if($datos_articulos['padron']=="no"){ echo("selected");}?>> no </option>
                </select></td>
				<td>espejo interior</td>
				<td><select name="select_4" id="select_4" class="form-control">
				  <option value="si" <? if($datos_articulos['espejo_int']=="si"){ echo("selected");}?>> si </option>
				  <option value="no" <? if($datos_articulos['espejo_int']=="no"){ echo("selected");}?>> no </option>
			    </select></td>
				<td>plumillas</td>
				<td><select name="select_7" id="select_7" class="form-control">
				  <option value="si" <? if($datos_articulos['plumillas']=="si"){ echo("selected");}?>> si </option>
				  <option value="no" <? if($datos_articulos['plumillas']=="no"){ echo("selected");}?>> no </option>
			    </select></td>
				<td>Llantas</td>
				<td><select name="select_10" id="select_10" class="form-control">
					 <option value="0" <? if($datos_articulos['llantas']=="0"){ echo("selected");}?> > 0 </option>
				   <option value="1" <? if($datos_articulos['llantas']=="1"){ echo("selected");}?> > 1 </option>
				  <option value="2" <? if($datos_articulos['llantas']=="2"){ echo("selected");}?>> 2 </option>
				  <option value="3" <? if($datos_articulos['llantas']=="3"){ echo("selected");}?>> 3 </option>
				  <option value="4" <? if($datos_articulos['llantas']=="4"){ echo("selected");}?>> 4 </option>
			    </select></td>
				<td>Llave Rueda</td>
				<td><select name="select_13" id="select_13" class="form-control">
				  <option value="si" <? if($datos_articulos['herramienta']=="si"){ echo("selected");}?>> si </option>
				  <option value="no" <? if($datos_articulos['herramienta']=="no"){ echo("selected");}?>> no </option>
			    </select></td>
		        <td> Triangulos</td>
			       <td><select name="select_16" id="select_16" class="form-control">
			         <option value="si" <? if($datos_articulos['triangulos']=="si"){ echo("selected");}?>> si </option>
				  <option value="no" <? if($datos_articulos['triangulos']=="no"){ echo("selected");}?>> no </option>
		           </select></td>
				
				
				
			
				</tr>
				<tr>
				<td> Encendedor</td>
				<td><select name="select_2" id="select_2" class="form-control">
				  <option value="si" <? if($datos_articulos['encendedor']=="si"){ echo("selected");} ?>> si </option>
               			<option value="no" <? if($datos_articulos['encendedor']=="no"){ echo("selected");} ?>>  no </option>
				  </select></td>
				<td>espejo exterior</td>
				<td><select name="select_5" id="select_5" class="form-control">
				  <option value="si" <? if($datos_articulos['espejo_ext']=="no"){ echo("selected");}?>> si </option>
				  <option value="no" <? if($datos_articulos['espejo_ext']=="no"){ echo("selected");}?>> no </option>
				  </select></td>
				<td>pisos</td>
				<td><select name="select_8" id="select_8" class="form-control">
				 <option value=""0 <? if($datos_articulos['pisos']=="0"){ echo("selected");}?> > 0 </option>
				  <option value="1" <? if($datos_articulos['pisos']=="1"){ echo("selected");}?> > 1 </option>
				  <option value="2" <? if($datos_articulos['pisos']=="2"){ echo("selected");}?>> 2 </option>
				  <option value="3" <? if($datos_articulos['pisos']=="3"){ echo("selected");}?>> 3 </option>
				  <option value="4" <? if($datos_articulos['pisos']=="4"){ echo("selected");}?>> 4 </option>
				  </select></td>
				<td>Rueda Repuesto.</td>
				<td><select name="select_11" id="select_11" class="form-control">
				 <option value="si" <? if($datos_articulos['rueda_repuesto']=="si"){ echo("selected");}?>> si </option>
				  <option value="no" <? if($datos_articulos['rueda_repuesto']=="no"){ echo("selected");}?>> no </option>
				  </select></td>
				<td>Exitntor</td>
				<td><select name="select_14" id="select_14" class="form-control">
				  <option value="si" <? if($datos_articulos['extintor']=="si"){ echo("selected");}?>> si </option>
				  <option value="no" <? if($datos_articulos['extintor']=="no"){ echo("selected");}?>> no </option>
				  </select></td>
				  
			
				
				
			
				</tr>
				<tr>
				<td>bencina</td>
				<td><select name="select_3" id="select_3" class="form-control">
				  <option value="0" <? if($datos_articulos['bencina']=="0"){ echo("selected");}?> > 0 </option>
				  <option value="1/8" <? if($datos_articulos['bencina']=="1/8"){ echo("selected");}?>> 1/8 </option>
				  <option value="1/4" <? if($datos_articulos['bencina']=="1/2"){ echo("selected");}?>> 1/4 </option>
					 <option value="3/4" <? if($datos_articulos['bencina']=="3/4"){ echo("selected");}?>> 3/4 </option>
				  <option value="3/8" <? if($datos_articulos['bencina']=="3/8"){ echo("selected");}?>> 3/8 </option>
				  <option value="1/2" <? if($datos_articulos['bencina']=="1/2"){ echo("selected");}?>> 1/2</option>
				  <option value="5/8" <? if($datos_articulos['bencina']=="5/8"){ echo("selected");}?>> 5/8 </option>
				  <option value="3/4" <? if($datos_articulos['bencina']=="3/4"){ echo("selected");}?>> 1/2 </option>
				  <option value="7/8" <? if($datos_articulos['bencina']=="7/8"){ echo("selected");}?>> 7/8 </option>
				  <option value="1"   <? if($datos_articulos['bencina']=="1"){ echo("selected");}?>> 1 </option>
				  
				  </select></td>
				<td>tapa Bencina</td>
				<td><select name="select_6" id="select_6" class="form-control">
				  <option value="si" <? if($datos_articulos['tapa_bencina']=="si"){ echo("selected");}?>> si </option>
				  <option value="no" <? if($datos_articulos['tapa_bencina']=="no"){ echo("selected");}?>> no </option>
				  </select></td>
				<td>Tapa Ruedas</td>
				<td><select name="select_9" id="select_9" class="form-control">
					<option value="0" <? if($datos_articulos['tapa_rueda']=="0"){ echo("selected");}?> > 0 </option>
				   <option value="1" <? if($datos_articulos['tapa_rueda']=="1"){ echo("selected");}?> > 1 </option>
				  <option value="2" <? if($datos_articulos['tapa_rueda']=="2"){ echo("selected");}?>> 2 </option>
				  <option value="3" <? if($datos_articulos['tapa_rueda']=="3"){ echo("selected");}?>> 3 </option>
				  <option value="4" <? if($datos_articulos['tapa_rueda']=="4"){ echo("selected");}?>> 4 </option>
				  </select></td>
				<td>Gata</td>
				<td><select name="select_12" id="select_12" class="form-control">
				  <option value="si" <? if($datos_articulos['gata']=="si"){ echo("selected");}?>> si </option>
				  <option value="no" <? if($datos_articulos['gata']=="no"){ echo("selected");}?>> no </option>
				  </select></td>
				<td>Botiquin </td>
				<td><select name="select_15" id="select_15" class="form-control">
				  <option value="si" <? if($datos_articulos['botiquin']=="si"){ echo("selected");}?>> si </option>
				  <option value="no" <? if($datos_articulos['botiquin']=="no"){ echo("selected");}?>> no </option>
				  </select></td>
				  
			
				
		  </table>

		</div>
		  
		
		</div>
	
	</div><!--finalpanel articulos vehiculo-->
	
		
	</div><!--final panel boddy proncilañ-->

</div><!--final panel boddy proncilañ-->

	
<div class="row">
<div class="col-md-6">
	<div class="panel panel-default"> 
		<div class="panel-body">
			 		
	 		<fieldset style="margin-top: 15px"><legend> Trabajos a realizar</legend> </fieldset>
	 		<div id="div_trabajos"> 
	
	   			  </div> 
			
		</div>
	
	
	</div>
	</div>
	
	
	<div class="col-md-6">
	<div class="panel panel-default"> 
		<div class="panel-body">
			 		
	 		<fieldset style="margin-top: 15px">
		  <legend> Productos o Repuestos usados</legend> </fieldset>
	 				
		<div id="div_repuestos"> 
	
	     </div> 
			
		</div>
	
	
	</div>
	</div>
	</div>



<div class="panel panel-default">
<div class="panel-body">

<div class="row">




	
	<div id="totales" class="col-md-6" >
		
	
   </div>

 <div class="col-md-6">
	 <div class="form-group">
	 <label>Operario</label>  
	 <input type="text" class="form-control" name="txt_operario" id="txt_operario" value="<? echo($datos_orden['operario_orden']); ?>">
		     
	 </div>
	  </div>
		<div class="col-md-6">
			<div class="form-group">
				 <label>Observaciones</label> 
		<textarea  rows="3" style="resize: none" class="form-control" id="txt_observacion" name="txt_observacion" ><? echo($datos_orden['observacion_orden']); ?> </textarea>
	  </div>
	</div>
	  
	  
	  <div class="col-md-6" style="margin-top: 15px;">
	  	<button type="submit" class="btn btn-primary btn-block" id="edita"> Guardar Orden </button>
	</div>
	
	<div class="col-md-6" style="margin-top: 15px;">
	  	<button type="button" class="btn btn-warning btn-block" onClick="cancelar_orden()">Volver</button>
	</div>

</div>
	
	
	
<div class="row">	


	<div class="col-md-6">
	
	<div id="forma_pagos">
	
		
		</div>
		
	
	
	</div>
	
	
	
	
		
		
		
	
	</div>

	</div>
	</div>

	</form>

	


	
 



</body>
<script>

 $("#div_trabajos").load("trabajos_realizar.php?orden="+orden);
$("#div_repuestos").load("repuestos.php?orden="+orden);
$("#totales").load("total_orden.php?orden="+orden+"&var=1");
				   

						 

</script>
</html>