<?
include("../../functions/funciones.php");
	conecta_bd();
valida_sesion();
	
   $id_orden=$_REQUEST['orden'];
   
	
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
		 descuento=$("#txt_descuento").val()
	
	
	 				
						abono=abono.replace(/\$/g, '');
						abono=abono.replace(/\./g, '');
						abono=abono.replace(/\,/g, '');
						
						descuento=descuento.replace(/\$/g, '');
						descuento=descuento.replace(/\./g, '');
						descuento=descuento.replace(/\,/g, '');
		
						
			/*if($("#txt_total_bruto").val()==0){
						
					sweetAlert("Atencion...", "Antes De Ingresar El abono debe registrar un trabajo ", "warning");
					$("#txt_abono").val(0)
				}else{
					
					if( (parseInt(abono)<=(total_bruto))==0){
					
						$("#txt_abono").val(0)
						sweetAlert("Atencion...","Asi desea Pagar El total de la orden marque la opcion total", "warning");
					
					
					}else{*/
						
							total=parseInt(abono)+parseInt(descuento)
					
							resultado=parseInt(total_bruto)-parseInt(total)
							
					
					
						$("#txt_total_pagar").val(resultado)
				//	}
					
					
	}
	

	</script>
</head>

<body>

<div class="panel panel-default">
	<div class="panel-body">
		
		<fieldset> <legend> <h4> </h4>Generar Pago</legend></fieldset>
			
<table class="table-bordered table-condensed" width="100%" style="background-color:white">
		<tr> 
		<td> Total Mano De Obra</td>
			<td width="24%"> <? echo formato_numero(1,$total_trabajo['sum(precio_trabajo)']) ?>
		    <input type="hidden" id="txt_mano_obra" name="txt_mano_obra"  value="<? echo $total_trabajo['sum(precio_trabajo)'] ?>"></td>
		</tr>
		<tr> 
		<td>Total Repuestos</td>
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
		  <td><? echo(  formato_numero(1,($total_repuesto['sum(total_detalle_orden_producto)']+$total_trabajo['sum(precio_trabajo)'])*1.19))     ?><input type="hidden" id="txt_total_bruto" name="txt_total_bruto" value="<? echo(round(($total_repuesto[0]+$total_trabajo['sum(precio_trabajo)'])*1.19)) ?>"></td>
		  </tr>
		  
			  		<tr>
		  	  <td colspan="2">
		  	  	
		  
		  <select id="txt_tipo_pago" name="txt_tipo_pago" onChange="fechas_pagos()" class="form-control">
			
			  <option value="efectivo" >Efectivo </option>
			  <option value="cheque_dia"> Cheque al dia </option>
		      <option value="cheque_fecha"> Cheque a fecha </option>
			
		     </select>		  	  	

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
		  <td width="10%"><input type="text" id="txt_abono" name="txt_abono" class="form-control" onKeyUp="formato_moneda(this)" value="0" onBlur="total(this.id)" readonly></td>
		  </tr>
		<tr>
		  <td>Descuento</td>
		  <td><input type="text"class="form-control" id="txt_descuento" name="txt_descuento" value="0"> <input type="hidden" id="txt_saldo" name="txt_saldo"  value="0"></td>
		  </tr>
		<tr>
		
		  </tr>
		<tr>
		  <td>Total Pagar</td>
			<td><input class="form-control" readonly id="txt_total_pagar" name="txt_total_pagar" value="<? echo(formato_numero(1,round(($total_repuesto[0]+$total_trabajo['sum(precio_trabajo)'])*1.19)))?>" ></td>
		  </tr>
		  	
		  
		  
		
		</table>
		
	<div class="row">
	<div class="col-md-3" style="margin-top: 15px; float: right">
	  	<button type="submit" class="btn btn-primary btn-block"> Generar Pago </button>
	  	<button type="button" class="btn btn-warning btn-block" id="vovler" onClick="estado_formulario(2)"> Vover </button>
	  	
	  </div>
		</div>
	
	 
	   
	</div>

	</div>
</body>
	
</html>