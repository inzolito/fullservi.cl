<?
include("../../functions/funciones.php");
	conecta_bd();

valida_sesion();
   $id_orden=$_REQUEST['orden'];
	$datos_orden=datos_global($id_orden,"id_orden","ordenes_trabajo","*");
   
	$variable=$_REQUEST['var'];   
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
		
		/*if($("#txt_descuento").val()==""){
			$("#txt_descuento").val(0)
			formato_moneda(this)
		}else{*/
			
			 total_bruto=$("#txt_total_bruto").val()
		  
		  descuento=$("#txt_descuento").val()
	
	
	 				
						
						
						descuento=descuento.replace(/\$/g, '');
						descuento=descuento.replace(/\./g, '');
						descuento=descuento.replace(/\,/g, '');
		
						
			
						
					
							resultado=parseInt(total_bruto)-parseInt(descuento)
							
					
					
						$("#txt_total_pagar").val(resultado)
				//	}
					
	//	}
	     
					
	}
	

	</script>
</head>

<body>
<table class="table-bordered table-condensed" width="100%">
		<tr> 
		<td> Total Mano De Obra</td>
			<td width="30%"> <? echo formato_numero(1,$total_trabajo['sum(precio_trabajo)']) ?>
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
		  <td>Descuento</td>
		  <td><input type="text"class="form-control" id="txt_descuento" name="txt_descuento" value="<? echo(formato_numero(1,$datos_orden['descuento_orden'])) ?>"></td>
  </tr>
		<tr>
		  <td>Total A pagar</td>
		  <td><input class="form-control" readonly id="txt_total_pagar" name="txt_total_pagar" value="<? echo(formato_numero(1,round(($total_repuesto[0]+$total_trabajo['sum(precio_trabajo)'])*1.19)))?>" ></td>
  </tr>
		  
		  
		  
				
		
		</table>
</body>
	
</html>