<?
include("../../functions/funciones.php");
	conecta_bd();
valida_sesion();

   $id_cotizacion=$_REQUEST['cotizacion'];
   
	$variable=$_REQUEST['var'];   
	   
$query_total_repuesto=mysql_query("select sum(total_detalle_cotizacion_producto) from detalle_cotizacion_producto where id_cotizacion='".$id_cotizacion."'");

		

if(mysql_num_rows($query_total_repuesto)==1){
				
			$total_repuesto=mysql_fetch_array($query_total_repuesto);
	
	
}else{
	
	$total_repuesto[0]=0;
	
}
		$query_total_trabajo=mysql_query("select sum(precio_trabajo) from trabajos join precios_trabajos using(id_trabajo) join detalles_cotizacion_trabajo using(id_trabajo) where id_cotizacion='".$id_cotizacion."' and estado_precio_trabajo='activo' group by id_cotizacion");


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
<table class="table-bordered table-condensed" width="100%">
		<tr> 
		<td> Total Mano De Obra</td>
			<td width="30%"> <? echo formato_numero(1,$total_trabajo['sum(precio_trabajo)']) ?>
		    <input type="hidden" id="txt_mano_obra" name="txt_mano_obra"  value="<? echo $total_trabajo['sum(precio_trabajo)'] ?>"></td>
		</tr>
		<tr> 
		<td>Total Repuestos</td>
		<td><?  echo formato_numero(1,$total_repuesto['sum(total_detalle_cotizacion_producto)']) ?>
		  <input type="hidden" id="txt_repuestos" name="txt_repuestos"  value="<?  echo $total_repuesto['sum(total_detalle_cotizacion_producto)'] ?>"></td>
		</tr>
		<tr>
		  <td>Neto</td>
		  <td><? echo(formato_numero(1,$total_repuesto['sum(total_detalle_cotizacion_producto)']+$total_trabajo['sum(precio_trabajo)']))?>
	      <input type="hidden" id="txt_neto" name="txt_neto"  value="<?   echo($total_repuesto['sum(total_detalle_cotizacion_producto)']+$total_trabajo['sum(precio_trabajo)']) ?>"></td>
  </tr>
		<tr>
		  <td>IVA 19%</td>
		  <td><? echo(formato_numero(1,round(($total_repuesto['sum(total_detalle_cotizacion_producto)']+$total_trabajo['sum(precio_trabajo)'])*0.19))) ?>
	      <input type="hidden" id="txt_iva" name="txt_iva"  value="<?   echo(round(($total_repuesto['sum(total_detalle_cotizacion_producto)']+$total_trabajo['sum(precio_trabajo)'])*0.19)) ?>"></td>
		  </tr>
		<tr>
		  <td>Total</td>
		  <td><? echo(  formato_numero(1,($total_repuesto['sum(total_detalle_cotizacion_producto)']+$total_trabajo['sum(precio_trabajo)'])*1.19))     ?><input type="hidden" id="txt_total_bruto" name="txt_total_bruto" value="<? echo(round(($total_repuesto[0]+$total_trabajo['sum(precio_trabajo)'])*1.19)) ?>"></td>
		  </tr>
		  
		  
		  
		
		</table>
</body>
	
</html>