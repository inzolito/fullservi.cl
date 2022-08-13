<?
	include("../../functions/funciones.php");
	conecta_bd();
valida_sesion();
	
   $id_orden=$_REQUEST['orden'];

$query_ordenes=mysql_query("select * from ordenes_trabajo join estados_cuenta using(id_orden) where id_orden='".$_REQUEST['orden']."' order by id_orden ");


	$query_total_repuesto=mysql_query("select sum(total_detalle_orden_producto) from detalles_orden_producto where id_orden='".$id_orden."'");

		

if(mysql_num_rows($query_total_repuesto)==1){
				
			$total_repuesto=mysql_fetch_array($query_total_repuesto);
	
	
}else{
	
	$total_repuesto[0]=0;
	
}
		$query_total_trabajo=mysql_query("select sum(precio_trabajo) from precios_trabajos join detalles_ordenes_trabajos using(id_precio_trabajo) 
where id_orden=$id_orden");

		

if(mysql_num_rows($query_total_trabajo)==1){
				
				$total_trabajo=mysql_fetch_array($query_total_trabajo);
	
	
}else{
	
	$total_trabajo[0]=0;
}






?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>


<script> 
	 $(document).ready(function(){
		   
		$("#frm_pagar").submit(function(event){
			   	
			   		event.preventDefault()
					generar_pago()
					
					
					
		   
					
					
					
		   })
		$('[data-toggle="popover"]').popover(); 
			$("#txt_pago_total").keyup(function(){
			   	
			   					formato_moneda(this)
					
					
					
		   
			})
			
			
			$("#txt_total_pagar").keyup(function(){
			   	
			   					formato_moneda(this)
					
					
					
		   
			})
			
			 $("#txt_abono").keyup(function(){
			   	
			   		formato_moneda(this)
					
					calcular_total()
					$("#txt_total_pagar").keyup()
					
					
					
			 });
					
			
		 
		  $("#txt_descuento").keyup(function(){
			   	
			   		formato_moneda(this)
					
					calcular_total()
					$("#txt_total_pagar").keyup()
					
					
					
			 });
					
		
		
		 
		 
		   
})
			
			
			
		   
		   
		 
		  
		   
	
	
	
function calcular_total(){
  
  
       total_bruto=$("#txt_total_bruto").val()
    abono=$("#txt_abono").val()
   
     
      abono=abono.replace(/\$/g, '');
      abono=abono.replace(/\./g, '');
      abono=abono.replace(/\,/g, '');
      
       
      
      if(abono==""){
       abono=0
        
      
      }
      
       
       resultado=parseInt(total_bruto)-parseInt(abono)
       
       if(isNaN(resultado) )
       {
        resultado=0 
       }
       
       $("#txt_total_pagar").val(resultado)
       
       
    
     
     
 }
	

	</script>
</head>

<body>




<table style=background-color:white; class="table table-bordered table-condensed">
	<tbody>
	
	<tr>
		<td align="center" colspan="12"  style="background-color: #f9f9f9"><h4> Orden De Trabajo:<? echo (" ".$_REQUEST['orden'])  ?></h4></td>
		</tr>
		<tr>
			<th>Codigo </th>
			<th>fecha </th>
			<th>Hora </th>
			
			<th>Total Mano De Obra</th>
			<th>Total Repuestos</th>
			<th>Total Orden</th>
			<th>Descuento</th>
			<th>Total A pagar</th>
			<th>Estado Orden</th>
			
			<th>Estado Pago</th>
			<th>&nbsp;</th>
		</tr>

		
		
	<?
		while($datos_orden=mysql_fetch_array($query_ordenes)){
			
		
	?>
			<tr>
			<th><? echo $datos_orden['id_orden']  ?></th>
			
			<td><? echo $datos_orden['fecha_orden']  ?> </td>
			<td><? echo $datos_orden['hora_orden']  ?></td>
		
			<td ><? echo formato_numero(1,$datos_orden['total_mano_obra_orden']) ?></td>
			<td><? echo formato_numero(1,$datos_orden['total_repuestos_orden']) ?></td>
			<td><? echo formato_numero(1,$datos_orden['total_orden']); ?></td>
			<td><? echo formato_numero(1,$datos_orden['descuento_orden']); ?></td>
			<td><? echo formato_numero(1,$datos_orden['total_pagar_orden']); $total_orden=$datos_orden['total_pagar_orden'] ?></td>
			
			<td <? if($datos_orden['estado_orden']=="completa"){?>style="color:blue" <?}else{ ?>style="color:red"<? }?>><? echo $datos_orden['estado_orden'] ?></td>
			<td <? if($datos_orden['estado_cuenta']=="pagada"){?>style="color:green" <?}else{ ?>style="color:red"<? }?>><? echo $datos_orden['estado_cuenta'] ?></td>
			<td>
			
			<button class="btn btn-default btn-xs" onClick="cargar_pago()" title="Generar Pago" id="<? echo $datos_orden['id_orden']  ?>" <? if($datos_orden['estado_orden']=="anulada" || $datos_orden['estado_cuenta']=="pagada" || $datos_orden['estado_orden']=="incompleta"  ){ echo("disabled");} ?> > <i class="fa fa-credit-card-alt" aria-hidden="true"></i></button> 
								
			  </button> <button class="btn btn-info btn-xs" title="imprimir" onClick="reporte_orden(<? echo $datos_orden['id_orden'] ?>)" > <i class="fa fa-print"></i></button> </td>
		</tr>
	<?
		}
			
		
	?>
		</tbody>


</table>

<?
			$id_estado_cuenta=datos_global($id_orden,"id_orden","estados_cuenta","id_estado_cuenta");

	        $query_pagos=mysql_query("select * from pagos_cuenta where id_estado_cuenta='".$id_estado_cuenta."' order by id_pago");
		
?>

<table style=background-color:white; class="table table-bordered table-condensed">
<tr>
		<td align="center" colspan="9" style="background-color: #f9f9f9"><h4> Detalles de pagos realizados</h4></td>
		</tr>
	<tr> 
		<th >Codigo Pago</th>
		<th> Fecha Pago</th>
		<th> Fecha De Pago Programado</th>
		<th> Hora Pago</th>
		<th> Monto</th>
		<th> Medio Pago</th>
		<th> Tipo Pago</th>
		<th> Estado Pago</th>
		<th> opciones</th>
	
	</tr>
	<tr>
<? 
	if(mysql_num_rows($query_pagos)==0){
		
		echo("<td align='center' colspan=7 ><strong> No hay pagos Asociados a la orden Numero: ".$_REQUEST['orden']." </strong></td>");
	}else{
		
		
	while($datos_pago=mysql_fetch_array($query_pagos)){
	
?>
    <tr>
	    <td><? echo $datos_pago['id_pago'] ?></td>
		<td><? echo formato_fecha("normal",$datos_pago['fecha_pago']) ?></td>
		<td> <?  if($datos_pago['fecha_programacion_pago']){ echo formato_fecha("normal",$datos_pago['fecha_programacion_pago']); }else{ echo "-";}?></td>
		<td> <? echo $datos_pago['hora_pago'] ?></td>
		<td><? echo formato_numero(1,$datos_pago['monto_pago']); ?></td>
		<td> <?  if($datos_pago['tipo_pago']=="cheque_fecha"){
		echo("cheque a fecha");
		}else{ 
		echo($datos_pago['tipo_pago']);
		}  ?></td>
		<td><? if($datos_pago['tipo_pago_2']=="pago_programado"){ 
		echo("pago programado");
	}else{ 
		echo($datos_pago['tipo_pago_2']);
	}  ?></td>
		<td> <? if($datos_pago['estado_pago']==1){echo("activo");}if($datos_pago['estado_pago']==0){echo("anulado");?>
																						  
																						   <a tabindex="0" style="float:right;" role="button" data-toggle="popover" data-trigger="focus" title="Detalle De Anulacion" data-content="<? echo($datos_pago['motivo_anulacion_pago']) ?>"><i title="haga clic para ver detalles" class="fa fa-info-circle  fa-lg" aria-hidden="true"></i></a>
																							   
																							   <?
																								   
																								   
																								   
																								   
																								   
																								   
																								   
																								   }if($datos_pago['estado_pago']==2){echo("Pendiente");} ?> </td>
		<td><button class="btn btn-default btn-xs" onClick="validar_pago(this.id)"  title="Pagar" id="<? echo $datos_pago['id_pago']."_edit"  ?>" <? if($datos_pago['fecha_programacion_pago']=="0000-00-00" || $datos_pago['estado_pago']==0 || $datos_pago['estado_pago']==1  ){ 
		echo("disabled");
	
	    } ?> > <i class="fa fa-usd" aria-hidden="true"></i></button> 
								
			  </button> <button onClick="anular_pago(this.id)" id="<? echo($datos_pago['id_pago']) ?>" class="btn btn-danger btn-xs" title="anular_pago" <? if($datos_pago['estado_pago']==0 ){ echo("disabled");} ?>  > <i class="fa fa-minus"></i></button></td>
			  
	
</tr>	
	
<?
	} //final while
		
 $query_suma_pago=mysql_query("select sum(monto_pago) from pagos_cuenta where id_estado_cuenta='".$id_estado_cuenta."' and estado_pago=1");
		
?>
  <tr  style="background-color: #f9f9f9">
	    <th>SALDO DE LA CUENTA</th>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <th
	    "><? if(mysql_num_rows($query_suma_pago)==0){ echo("$0"); $total_pagos=0;}else{ $dato_suma=mysql_fetch_array($query_suma_pago); echo(formato_numero(1,$total_orden-$dato_suma[0])); $total_pagos=$dato_suma[0];}?></th>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
		
</tr>	
	

<?
	}//fin eslse
?>

	</tr>
</table>

<div class="row" id="volver">
					<div class="col-md-4" style="margin-top: 15px;">
						<a href="pagos.php" class="btn btn-warning btn-sm "  title="Volver al Menu De Pagos"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Volver </a>
					</div>
</div>
<form id="frm_pagar" name="frm_pagar">
<div class="panel panel-default" id="panel_pagar">
	<div class="panel-body">
		
		<fieldset> <legend> <h4> </h4>Generar Pago</legend></fieldset>
			
<table class="table-bordered table-condensed" width="100%" style="background-color:white">
		<tr > 
		<td > Total Mano De Obra</td>
			<td  width="24%"> <? echo formato_numero(1,$total_trabajo['sum(precio_trabajo)']) ?>
		    <input type="hidden" id="txt_mano_obra" name="txt_mano_obra"  value="<? echo $total_trabajo['sum(precio_trabajo)'] ?>"></td>
		</tr>
		<tr> 
		<td >Total Repuestos</td>
		<td><?  echo formato_numero(1,$total_repuesto['sum(total_detalle_orden_producto)']) ?>
		  <input type="hidden" id="txt_repuestos" name="txt_repuestos"  value="<?  echo $total_repuesto['sum(total_detalle_orden_producto)'] ?>"></td>
		</tr>
		<tr>
		  <td>Neto</td>
		  <td><? echo(formato_numero(1,$total_repuesto['sum(total_detalle_orden_producto)']+$total_trabajo['sum(precio_trabajo)']))?>
	      <input type="hidden" id="txt_neto" name="txt_neto"  value="<?   echo($total_repuesto['sum(total_detalle_orden_producto)']+$total_trabajo['sum(precio_trabajo)']) ?>"></td>
  </tr>
		<tr>
		  <td>IVA 19%</td>
		  <td><? echo(formato_numero(1,round(($total_repuesto['sum(total_detalle_orden_producto)']+$total_trabajo['sum(precio_trabajo)'])*0.19))) ?>
	      <input type="hidden" id="txt_iva" name="txt_iva"  value="<?   echo(round(($total_repuesto['sum(total_detalle_orden_producto)']+$total_trabajo['sum(precio_trabajo)'])*0.19)) ?>"></td>
		  </tr>
		<tr>
		  <td>Total</td>
			<td><strong><? echo(  formato_numero(1,($total_repuesto['sum(total_detalle_orden_producto)']+$total_trabajo['sum(precio_trabajo)'])*1.19)) ;   ?></strong><input type="hidden" id="txt_total_bruto" name="txt_total_bruto" value="<? if($total_pagos==0){echo ($total_orden);}else{echo($total_orden-$total_pagos);}  ?>"></td>
		  </tr>
		  
			  		<tr>
		  	  <td colspan="2" style="background-color: #e0e0e0">
		  	  	
		  
		  <select id="txt_tipo_pago" name="txt_tipo_pago" onChange="fechas_pagos()" class="form-control">
			
			  <option value="efectivo" >Efectivo </option>
			  <option value="cheque_dia"> Cheque al dia </option>
		      <option value="cheque_fecha"> Cheque a fecha </option>
			
		     </select>		  	  	

		  	  </td>
  </tr>
  	        <tr>
		  	          <td colspan="2" id="fechas_pagos">
		  	          	
		  	          	  <div id="fecha_pago" class="row" >
		  	<div class="col-md-4">
				<label for="txt_fecha_1"> Primer Pago</label>
		  		<input class="form-control" id="txt_fecha_1" name="txt_fecha_1" type="date">
		  		
			  </div>
			  
			  	<div class="col-md-2">
				<label for="txt_monto1">  Monto Primer Pago</label>
		  		<input class="form-control" id="txt_monto1" name="txt_monto1"  onKeyUp="formato_moneda(this)" type="text">
		  		
			  </div>
		  	
		  		<div class="col-md-4">
					<label  id="txt_fecha_2">Segundo Pago  </label>
		  		<input class="form-control" id="txt_fecha_2" name="txt_fecha_2" type="date">
			  </div>
			  
			    	<div class="col-md-2">
				<label for="txt_monto2">  Monto Segundo Pago</label>
		  		<input class="form-control" id="txt_monto2" name="txt_monto2"  onKeyUp="formato_moneda(this)" type="text">
		  		
			  </div>
		  </div>
		  	          	
		  	          </td>
		  	          
        </tr>
  	        <tr>
		  	  <td><input type="radio" name="radio" id="radio_total" value="radio" onClick="cambio_pago(this.id)">
                <label for="radio">Pagar Total</label>
              </td>
		  	  <td><input type="text" id="txt_pago_total" name="txt_pago_total" class="form-control" value="0" readonly> </td>
  </tr>
		  	<tr>
		  <td height="32"><input type="radio" name="radio" id="radio_abono" value="radio" onClick="cambio_pago(this.id)">
                <label for="radio">Abonar</label></td>
		  <td width="24%"><input type="text" id="txt_abono" name="txt_abono" class="form-control" onKeyUp="formato_moneda(this)" value="0" onBlur="total(this.id)" readonly></td>
		  </tr>
		<tr>
		  <td>Total Pagar</td>
		  <input id="txt_orden" name="txt_orden" type="hidden" value="<? echo($id_orden); ?>">
			<td><strong><input class="form-control" readonly id="txt_total_pagar" name="txt_total_pagar" value="<? if($total_pagos==0){echo(formato_numero(1,$total_orden));}else{echo(formato_numero(1,$total_orden-$total_pagos));}// echo(formato_numero(1,round(($total_repuesto[0]+$total_trabajo['sum(precio_trabajo)'])*1.19)))?>" ></strong></td>
		  </tr>
		  	
		  
		  
		
		</table>
	<div class="row">
	<div class="col-md-3" style="margin-top: 15px; float: right">
	  	<button type="submit" class="btn btn-primary btn-block" id="<? echo($id_orden) ?>"> Generar Pago </button>
	  	<button type="button" class="btn btn-warning btn-block" id="vovler" onClick="estado_formulario(2)"> Vover </button>
	  </div>
	  </div>
	


<!-- Modal -->

	   
	</div>

	</div>
	
</form>

</body>
<script>
	$("#panel_pagar").hide()
	$("#fechas_pagos").hide()
</script>
</html>
