<?
include("../../functions/funciones.php");
	conecta_bd();
valida_sesion();
	
$datos_cotizacion=datos_global($_REQUEST['cotizacion'],"id_cotizacion","cotizaciones","*");

$datos_cliente=datos_global($datos_cotizacion['id_cliente'],"id_cliente","clientes","*");
$datos_vehiculo=datos_global($datos_cotizacion['id_vehiculo'],"id_vehiculo","vehiculos","*");

	
 
?>


<!doctype html>
<html>
<head>
 
<meta charset="utf-8">
<title>Documento sin título</title>


<script>

	cotizacion=<? echo($_REQUEST['cotizacion']); ?>
	

		
	 $(document).ready(function(){
		 
		   $("#frm_editar_cotizacion").submit(function(event){
			   	
			   		event.preventDefault()
					
					//alert(1)
					guardar_editar_cotizacion()
					
					
					
		   
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
<form id="frm_editar_cotizacion" name="frm_editar_cotizacion">

<div class="panel">

<div class="panel-body">
	
	<div class="row"> 
	
	<div  style="float: right"class="col-xs-3">
		<h4><strong>Numero De Cotizacion:</strong> <? echo(" ".$datos_cotizacion['id_cotizacion'] ) ?> 
		  <input id="txt_cotizacion" name="txt_cotizacion" type="hidden" value="<? echo($datos_cotizacion['id_cotizacion']) ?>">  </h4>
	
	   </div>
	   
	  </div>
	   
	   <div class="row"> 
	   <div  style="float: right"class="col-xs-3">
		<h4><strong>Fec. Emisión:</strong> <? echo formato_fecha("normal",$datos_cotizacion['fecha_cotizacion'])?> </h4>
		   </div>
	   </div>
	   
	<div class="row">
	
	<div class="col-xs-12"> 
	<fieldset><legend> Datos Cliente</legend> </fieldset>
	</div>
	
   
    <div class="col-md-2">

     <label for="icon_rut_cliente"> Run  Cliente</label>

     <div id="div_txt_rut" class="has-feedback"  >
      <input type="text" class="form-control" id="txt_rut" name="txt_rut" aria-describedby="inputSuccess4Status" onKeyUp="validar_rut_cliente()" value="<? echo(formato_rut($datos_cliente['rut_cliente'],1)) ?>"  required  >
      <span class="glyphicon  form-control-feedback" id="icon_txt_rut" name="icon_txt_rut" aria-hidden="true"></span>

     </div>
      </div>




     <div class="col-md-4">
     <label for="txt_nombre">  Nombre Cliente</label>
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
      <label for="cmb_tipo_cliente"> Tipo Cliente </label>
    
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
      <label for="txt_direccion">Direccion</label>
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
			 <label for="txt_patente"> Patente </label>
			<input type="text" class="form-control" id="txt_patente" name="txt_patente" value="<? echo $datos_vehiculo['patente_vehiculo'] ?>"  >
	
	   </div>
	  <div class="col-xs-2">
		  <label for="cmb_marca"> Marca</label>
		    <input type="text" class="form-control" id="cmb_marca" name="cmb_marca" value="<? echo $datos_vehiculo['marca_vehiculo'] ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();">
		 </div>
	
	 	 <div class="col-xs-2">
	 	  <label for="cmb_modelo"> Modelo </label>
	 	  
	 	  	 <input id="cmb_modelo" name="cmb_modelo" class="form-control" value="<? echo $datos_vehiculo['modelo_vehiculo'] ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();">
	 	 </div>
		  <div class="col-xs-2">
	 	  <label for="txt_color"> Color</label>
			<input type="text" class="form-control" id="txt_color"  name="txt_color"  value="<? echo $datos_vehiculo['color_vehiculo'] ?>" >
		 </div>
		  <div class="col-xs-1">
		  <label for="cmb_motor" > Motor </label>
	 		
			  <select class="form-control" id="cmb_motor" name="cmb_motor"> 
			  
				  <option value="seleccion">----seleccione---- </option>
				  
				  <? for($x=1 ;$x<=9; $x++){
	   					for($i=1 ;$i<=9; $i++){
	   						
				  ?>
				  			
				  <option value="<? echo($x.".".$i); ?>" <? if($datos_vehiculo['motor_vehiculo']==($x.".".$i)){ echo("selected"); } ?>><? echo($x.".".$i); ?> </option>
	   
	  				 <?
	   
   						}	
				  	
	   
	   
   						}	 
				  
				  ?>
			  
			  
			  </select>
		 </div>
		   <div class="col-xs-1">
		  <label for="txt_ano"   > Año </label>
	 		 <input type="text" class="form-control" id="txt_ano" name="txt_ano" value="<? echo $datos_vehiculo['ano_vehiculo'] ?>"  >
		 </div>
		  <div class="col-xs-2">
		  <label for="cmb_tipo_motor"> Tipo De Motor </label>
			 
			  <select class="form-control" id="cmb_tipo_motor" name="cmb_tipo_motor">
				  <option value="seleccione">----selecccione----> </option>
				  <option value="bencinero" <? if($datos_vehiculo['tipo_motor_vehiculo']=="bencinero"){ echo("selected");} ?>> Bencinero </option>
			  		<option value="petrolero"> Petrolero </option>
			  		<option value="electrico"> Electrico </option>
			  		<option value="gas"> Gas </option>
			  </select>
		 </div>
		 
		 
		  <div class="col-xs-4">
		  <label for="txt_nmotor"> Numero De Motor</label>
			<input type="text" class="form-control" id="txt_nmotor" name="txt_nmotor"  value="<? echo $datos_vehiculo['numero_motor_vehiculo'] ?>" >
		 </div>
		 <div class="col-xs-4">
		  <label for="txt_nchasis">Numero De chasis</label>
			<input type="text" class="form-control" id="txt_nchasis" name="txt_nchasis" value="<? echo $datos_vehiculo['numero_chasis_vehiculo'] ?>"  >
		 </div>
		 
			
		
	</div>
		<p>
		<!--finalpanel articulos vehiculo-->
	
		
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
		<textarea style="height: 154px" class="form-control" id="txt_observacion" name="txt_observacion" ><? echo($datos_cotizacion['observacion_cotizacion']); ?> </textarea>
	  </div>
	  
	  <div class="col-md-6">
	   		
		     
		 
	  </div>
	  <div class="col-md-6" style="margin-top: 15px;">
	  	<button type="submit" class="btn btn-primary btn-block" id="edita"> Guardar Cotizacion </button>
	  	<button type="button"  class="btn btn-danger btn-block" id="<? echo ($datos_cotizacion['id_cotizacion']); ?>" onClick="cancela(this.id)"> volver</button>
	  	
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
		   
$("#div_trabajos").load("detalle_trabajos_cotizacion.php?cotizacion="+cotizacion);
$("#div_repuestos").load("detalle_repuestos_cotizacion.php?cotizacion="+cotizacion);
$("#totales").load("total_cotizacion.php?cotizacion="+cotizacion+"&var=1");
cliente=<? echo($datos_cotizacion['id_cliente']); ?>						 

</script>
</html>