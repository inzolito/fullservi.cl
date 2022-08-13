<?
include("../../functions/funciones.php");
	conecta_bd();
valida_sesion();
 $datos_vehiculo=datos_global($_REQUEST['identificador'],"id_vehiculo","vehiculos","*");//si cambiamos esta linea resulta bien igual
  $id_orden=$_REQUEST['id_orden'];



	$query_orden=mysql_query("select max(id_orden) from ordenes_trabajo");

	$dato_orden=mysql_fetch_array($query_orden);   
	$id_orden=$dato_orden[0];	

 
?>


<!doctype html>
<html>
<head>
 
<meta charset="utf-8">
<title>Documento sin título</title>


<script>

	orden=<? echo($id_orden) ?>
	
	 $(document).ready(function(){
		   
		   
		   
		    $("#frm_orden").submit(function(event){
			   	
			   		event.preventDefault()
					ingresar_orden()
					
					
					
		   
		   })
		   
		 
		  
		   
	   });
	
	</script>
</head>

<body>

<form id="frm_orden" name="frm_orden">

<div class="panel">

<div class="panel-body">
	
	<div class="row"> 
	
	<div  style="float: right"class="col-xs-2">
		<h4><strong>Numero De Orden:</strong> <? echo(" ".$id_orden ) ?> <input id="txt_orden" name="txt_orden" type="hidden" value="<? echo($id_orden) ?>">  </h4>
	
	   </div>
	   
	  </div>
	   
	   <div class="row"> 
	   <div  style="float: right"class="col-xs-2">
		<h4><strong>Fecha:</strong> <? echo (date("d-m-Y"))?> </h4>
		   </div>
	   </div>
	   
	<div class="row">
	
	<div class="col-xs-12"> 
	<fieldset><legend> Datos Cliente</legend> </fieldset>
	</div>
	
   
    <div class="col-md-2">

     <label for="icon_rut_cliente"> Run  Cliente(*)</label>

     <div id="div_txt_rut" class="has-feedback"  >
      <input type="text" class="form-control" id="txt_rut" name="txt_rut" aria-describedby="inputSuccess4Status" onKeyUp="validar_rut_cliente()"  required  >
      <span class="glyphicon  form-control-feedback" id="icon_txt_rut" name="icon_txt_rut" aria-hidden="true"></span>

     </div>
      </div>




     <div class="col-md-4">
     <label for="txt_nombre">  Nombre Cliente (*)</label>
     
     <input type="text" class="form-control" id="txt_nombre" name="txt_nombre" required >
     </div>

     <div class="col-md-2">
      <label for="txt_fono"> Fono </label>
     <input type="text" class="form-control" id="txt_fono" name="txt_fono"   >
     </div>
      <div class="col-md-2">
      <label for="txt_fono2"> Fono 2 </label>
     <input type="text" class="form-control" id="txt_fono2" name="txt_fono2" >
     </div>
      <div class="col-md-2">
      <label for="cmb_tipo_cliente"> Tipo Cliente(*) </label>
     <select class="form-control" id="cmb_tipo_cliente" name="cmb_tipo_cliente" required>
      <option value="seleccione" >Seleccione </option>
      <option value="Particular">Particular</option>
      <option value="Empresa">Empresa </option>
       </select>
     </div>

      <div class="col-md-4">
      <label for="txt_nombre">  Correo Cliente</label>
     <input type="text" class="form-control" id="txt_correo" name="txt_correo" >
     </div>
     <div class="col-md-8">
      <label for="txt_direccion">Direccion</label>
      (*)
      <input type="text" class="form-control" id="txt_direccion" name="txt_direccion"  required>
     </div>

	
	</div>
	  <input type="submit" value="enviar" id="btn_validar_cliente"  hidden>
	
	 
		
   
	
	



<div class="row">
<div class="col-xs-12" style="margin-top:15px"> 
	<fieldet><legend> Datos Vehiculo</legend> </fieldet> 
	</div>
	<div class="col-xs-1">
			 <label for="txt_codigo"> Codigo </label>
			<input type="text" class="form-control" id="txt_codigo" name="txt_codigo" value="<? echo $datos_vehiculo['id_vehiculo'] ?>" readonly  >
	
	   </div>
	   
	<div class="col-xs-1">
			 <label for="txt_patente"> Patente (*) </label>
			<input type="text" class="form-control" id="txt_patente" name="txt_patente" value="<? echo $datos_vehiculo['patente_vehiculo'] ?>"  >
	
	   </div>
	  <div class="col-xs-2">
		  <label for="cmb_marca"> Marca (*)</label>
		  <input type="text" class="form-control" id="cmb_marca" name="cmb_marca" value="<? echo $datos_vehiculo['marca_vehiculo'] ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();">
		
			 
		 </div>
		   <script>
									
				//cargar_select_modelo($("#cmb_marca").val())									
													
			</script>
	
	 	 <div class="col-xs-2">
	 	  <label for="cmb_modelo"> Modelo (*) </label>
	 	 <input id="cmb_modelo" name="cmb_modelo" class="form-control" value="<? echo $datos_vehiculo['modelo_vehiculo'] ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();">
	 	  		
	 	  
	 	  
	 	  
	 	 </div>
		  <div class="col-xs-2">
	 	  <label for="txt_color"> Color</label>
	 	  (*)
			<input type="text" class="form-control" id="txt_color"  name="txt_color"  value="<? echo $datos_vehiculo['color_vehiculo'] ?>" >
		 </div>
		  <div class="col-xs-1">
		  <label for="cmb_motor" > Motor (*) </label>
	 		
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
		  <label for="txt_ano"   > Año (*) </label>
	 		 <input type="text" class="form-control" id="txt_ano" name="txt_ano" value="<? echo $datos_vehiculo['ano_vehiculo'] ?>"  >
		 </div>
		  <div class="col-xs-2">
		  <label for="cmb_tipo_motor"> Tipo De Motor (*) </label>
			 
			  <select class="form-control" id="cmb_tipo_motor" name="cmb_tipo_motor">
				  <option value="seleccione"><----selecccione----></----selecccione----> </option>
				  <option value="bencinero" <? if($datos_vehiculo['tipo_motor_vehiculo']=="bencinero"){ echo("selected");} ?>> Bencinero </option>
			  		<option value="petrolero"> Petrolero </option>
			  		<option value="electrico"> Electrico </option>
			  		<option value="gas"> Gas </option>
			  </select>
		 </div>
		 
		 
		  <div class="col-xs-4">
		  <label for="txt_nmotor"> Numero De Motor (*)</label>
			<input type="text" class="form-control" id="txt_nmotor" name="txt_nmotor"  value="<? echo $datos_vehiculo['numero_motor_vehiculo'] ?>" >
		 </div>
		 <div class="col-xs-4">
		  <label for="txt_nchasis">Numero De chasis (*)</label>
			<input type="text" class="form-control" id="txt_nchasis" name="txt_nchasis" value="<? echo $datos_vehiculo['numero_chasis_vehiculo'] ?>"  >
		 </div>
		 
			  
		  <div class="col-xs-2">
		  <label for="txt_kilometraje">Kilometraje Actual (*)</label>
			<input type="text" class="form-control" id="txt_kilometraje" name="txt_kilometraje" required >
		 </div>
	
	 <div class="col-xs-2">
		  <label for="txt_entrega">Fecha de entrega</label>
			<input type="date" class="form-control" id="txt_entrega" name="txt_entrega"  >
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
					  <option value="si"> si </option>
               			<option value="no"> no </option>
                </select></td>
				<td>espejo interior</td>
				<td><select name="select_4" id="select_4" class="form-control">
				  <option value="si"> si </option>
				  <option value="no"> no </option>
			    </select></td>
				<td>plumillas</td>
				<td><select name="select_7" id="select_7" class="form-control">
				  <option value="si"> si </option>
				  <option value="no"> no </option>
			    </select></td>
				<td>Llantas</td>
				<td><select name="select_10" id="select_10" class="form-control">
					  <option value="1"> 0 </option>
				  <option value="1"> 1 </option>
				  <option value="2"> 2 </option>
				  <option value="3"> 3 </option>
				  <option value="4"> 4 </option>
			    </select></td>
				<td>Llave Rueda</td>
				<td><select name="select_13" id="select_13" class="form-control">
				  <option value="si"> si </option>
				  <option value="no"> no </option>
			    </select></td>
		        <td> Triangulos</td>
			       <td><select name="select_16" id="select_16" class="form-control">
			         <option value="si"> si </option>
			         <option value="no"> no </option>
		           </select></td>
				
				
				
			
				</tr>
				<tr>
				<td> Encendedor</td>
				<td><select name="select_2" id="select_2" class="form-control">
				  <option value="si"> si </option>
               			<option value="no"> no </option>
				  </select></td>
				<td>espejo exterior</td>
				<td><select name="select_5" id="select_5" class="form-control">
				  <option value="si"> si </option>
				  <option value="no"> no </option>
				  </select></td>
				<td>pisos</td>
				<td><select name="select_8" id="select_8" class="form-control">
					 <option value="0"> 0 </option>
				  <option value="1"> 1 </option>
				  <option value="2"> 2 </option>
				  <option value="3"> 3 </option>
				  <option value="4"> 4 </option>
				  </select></td>
				<td>Rueda Repuesto.</td>
				<td><select name="select_11" id="select_11" class="form-control">
				  <option value="si"> si </option>
				  <option value="no"> no </option>
				  </select></td>
				<td>Exitntor</td>
				<td><select name="select_14" id="select_14" class="form-control">
				  <option value="si"> si </option>
				  <option value="no"> no </option>
				  </select></td>
				  
			
				
				
			
				</tr>
				<tr>
				<td>bencina</td>
				<td><select name="select_3" id="select_3" class="form-control">
				  <option value="0"> 0 </option>
				  <option value="1/8"> 1/8 </option>
				  <option value="1/4"> 1/4 </option>
				  <option value="3/4"> 3/4 </option>
				  <option value="3/8"> 3/8 </option>
				  <option value="1/2"> 1/2</option>
				  <option value="5/8"> 5/8 </option>
				  <option value="3/4"> 1/2 </option>
				  <option value="7/8"> 7/8 </option>
				  <option value="1"> 1 </option>
				  
				  </select></td>
				<td>tapa Bencina</td>
				<td><select name="select_6" id="select_6" class="form-control">
				  <option value="si"> si </option>
				  <option value="no"> no </option>
				  </select></td>
				<td>Tapa Ruedas</td>
				<td><select name="select_9" id="select_9" class="form-control">
				  <option value="0"> 0 </option>
					 <option value="1"> 1 </option>
					 <option value="2"> 2 </option>
				  <option value="3"> 3 </option>
					<option value="4"> 4 </option>
				  </select></td>
				<td>Gata</td>
				<td><select name="select_12" id="select_12" class="form-control">
				  <option value="si"> si </option>
				  <option value="no"> no </option>
				  </select></td>
				<td>Botiquin </td>
				<td><select name="select_15" id="select_15" class="form-control">
				  <option value="si"> si </option>
				  <option value="no"> no </option>
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
	 <input type="text" class="form-control" name="txt_operario" id="txt_operario">
		     
	 </div>
	  </div>
	
		<div class="col-md-6">
			 <div class="form-group">
				  <label>Observaciones</label>
		<textarea rows="3" style="resize: none" class="form-control" id="txt_observacion" name="txt_observacion"> </textarea>
			</div>
	  </div>
	  
	 
	  <div class="col-md-6" style="margin-top: 15px;">
	  	<button type="submit" class="btn btn-primary btn-block"> Guardar Orden </button>
	</div>
	  <div class="col-md-6" style="margin-top: 15px;">
	  	<button type="button" class="btn btn-warning btn-block" onClick="cancelar_orden()"> Volver </button>
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
	
 $("#div_trabajos").load("trabajos_realizar.php?orden="+<?echo($id_orden)?>);
$("#div_repuestos").load("repuestos.php?orden="+<?echo($id_orden)?>);
$("#totales").load("total_orden.php?orden="+<?echo($id_orden)?>);
				   
$("#fecha_pago").hide()
						 

</script>
</html>