<?
	include("../../functions/funciones.php");
	conecta_bd();
valida_sesion();
	//$query_orden=mysql_query("select max(id_orden+1) from ordenes_trabajo");

	//$dato_orden=mysql_fetch_array($query_orden);

	
?>
<!doctype html>
<html>
<head>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title>Menu Sistema</title>

   <script type="text/javascript" src="../../js/jquery-1.10.1.min.js"></script>

 
  <link rel="stylesheet" href="../../css/LateralStyle.css" title="style css" type="text/css" media="screen" charset="utf-8">
	    <link rel="stylesheet" href="../../libraries/fonts/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="../../libraries/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="../../libraries/bootstrap/css/bootstrap-theme.css">
		<link rel="stylesheet" href="../../libraries/bootstrap/css/bootstrap.css">
         <link rel="stylesheet" href="../../css/datatables.min.css" type="text/css">
         <link rel="stylesheet" href="../../css/estilos.css" type="text/css">
         <link rel="stylesheet" href="../../css/bootstrap-datepicker.css"/>
 		 <link rel="stylesheet" href="../../css/sweetalert.css">
       
        
       <script type="text/javascript" src="../../js/sweetalert-dev.js"></script>
        
  		<script src="../../libraries/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../js/sysscripts/validator.js"></script>	
     
	  <script src="../../js/datatables.min.js"></script>
        <script src="../../js/dataTables.bootstrap.js"></script>
	
   <script>
	   var cliente=0;
	   var total_mobra=0
	   var total_repuesto=0
	   var cotizacion=0;
	   var patente=""
	   var orden=0
	   $(window).load(function() {

		$(".loader").fadeOut("slow");
	});
	   $(document).ready(function(){
		   
		   $("#frm_buscar_orden").submit(function(event){
			   	
			   		event.preventDefault()
					cargar_orden()
					
					
					
		   
					
					
					
		   })
		   


	  
		  })
	   
	   
	   function cargar_orden(){
		   
		   		   
		   $("#carga_load").load('tabla_orden.php?orden='+$("#txt_orden").val());
		   orden=$("#txt_orden").val()
		   
	   }
	   
	    function cargar_orden2(id){
		   
		   		   
		   $("#carga_load").load('tabla_orden.php?orden='+id);
		   orden=id
		   
		   
	   }
	   
	   function cargar_pago(id){
		   $("#panel_buscar").hide("slow")
		   
		   $("#panel_pagar").show("slow")
		   $("#volver").hide("slow")
		  	
		   
		   
	   }
	   
				
function cambio_pago(id){
	
	
	if(id=="radio_total"){
		
		
			
		
		 total_bruto=$("#txt_total_bruto").val()
	 
			 if($("#txt_total_bruto").val()==0){
				
				 swal("ATENCION", "debe ingresar los trabajos realizados en la orden .", "warning");
				  $("#txt_pago_total").val(0)
				  
				  //$("#txt_pago_total").keyup()
				  	$("#radio_total").removeAttr("checked");
				  
			 }else{
				 
				
				 $("#txt_pago_total").val($("#txt_total_bruto").val())
				$("#txt_pago_total").keyup()
				
				
				 $("#txt_abono").attr('readonly', true);		
				 $("#txt_abono").val(0);
				 $("#txt_saldo").val(0);
				 $("#txt_descuento").val(0);
				  $("#txt_total_pagar").val($("#txt_pago_total").val())
				 
				 
				// $("#txt_total_pagar").keyup()
				 
				 $("#fecha_pago").hide("slow")
				 $("#txt_fecha_1").val("")
				 $("#txt_fecha_2").val("")
				 $("#txt_tipo_pago").val("efectivo").attr("selected",true);
				 
			 }
	
		
	}if(id=="radio_abono"){
			
		var total_bruto=$("#txt_total_bruto").val()
		$("#txt_abono").removeAttr("readonly");
        // Eliminamos la clase que hace que cambie el color
        $("#txt_abono").removeClass("readOnly");
		$("#txt_pago_total").val(0)
		$("#txt_descuento").val(0);
		 //$("#txt_total_pagar").val(total_bruto);
		
		
	}
	
	
	
	 
}
	   
function fechas_pagos(){
	
	if($("#txt_tipo_pago").val()=="cheque_fecha"){
		
		$("#fechas_pagos").show("slow")
		$("#radio_total").attr("disabled",true)
		 $("#txt_pago_total").val(0)
				  	$("#radio_total").removeAttr("checked");
		
		
		$("#radio_abono").attr("disabled",true)
		$("#radio_abono").removeAttr("checked");
	}else{
		
		$("#fechas_pagos").hide("slow")
		$("#radio_total").attr("disabled",false)
		$("#radio_abono").attr("disabled",false)
		$("#txt_fecha_1").val("")
				 $("#txt_fecha_2").val("")
	}
}
	   
	   
function generar_pago(){
	
	
	swal({
  title: "Generar Pago?",
  text: "solo podra ser cambiado si es un pago de cheque a fecha",
  type: "info",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si, Generar",
  cancelButtonText: "No, Cancelar",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
    	var datos= "accion=guardar_pago&"+$("#frm_pagar").serialize()
		
		$.ajax({
			
			type:"post",
			url:"ajax/procesos.php",
			data:datos,
			success:function(msj){
				
				if(msj==1){
					
					swal("Pago generado correctamente","","success")
					estado_formulario(1)
				}
				if(msj==2){
					
					
					swal("El Abono realizado no puede ser mayor o igual al saldo de la cuenta","","warning")
				}
				
				if(msj==3){
					
					
					swal("Debe rellenar los montos de los cheques a pagar","","warning")
				}
				
				
			}
			
			
		})
  } else {
    swal("Cancelado", "","error");
  }
});
	
}
	   
	  function estado_formulario(num){
		  
		  if(num==1){
			 
			   //$("#carga_load").load('tabla_orden.php?orden='+$("#txt_orden").val());
			  	$("#panel_buscar").show("slow")
			   $("#carga_load").load('tabla_orden.php?orden='+orden);
			//  orden=$("#txt_orden").val()
			  
		  }
		  
		  if(num==2){
			  
			  swal({
			  title: "Desea Volver Atráss y cancelar el pago?",
			  text: "",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Si,volver",
			  closeOnConfirm: false
			},
			function(){
				  swal.close()
			   $("#panel_buscar").show("slow")
			   $("#carga_load").load('tabla_orden.php?orden='+orden);
			});
			  
		  }
	  }
	   
function anular_pago(id){
	
	dato_array=id.split("_");
	
	swal({
  title: "Desea Anular el Pago seleccionado",
  text: "el pago quedará anulado, no podra ser modificado",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si,Anular",
  cancelButtonText: "No, Cancelar",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
  swal({
  title: "Motivo de anulación del pago",
  text: "Digite el motivo por el cual anula el pago seleccionado",
  type: "input",

  showCancelButton: true,
  closeOnConfirm: false,
  animation: "slide-from-top",
  inputPlaceholder: "Motivo de anulación"
},
function(inputValue){
  if (inputValue === false) return false;
  
  if (inputValue === "") {
    swal.showInputError("Para continuar necesita digitar el motivo de anulación");
    return false
  }
 

 
	  
	var datos="pago="+dato_array[0]+"&accion=anular_pago&orden="+orden+"&motivo="+inputValue
	
	$.ajax({
		
		type:"post",
		url:"ajax/procesos.php",
		data: datos,
		success: function(msj){
		
			if(msj==1){
			 swal("Exito!", "pago anulado Correctamente","success");
				estado_formulario(1)
			}
			
			
		}
		
		
		
	})
	 
});
  } else {
    swal("Anulación Cancelada", "", "error");
  }
});
	
	
}
	   
function validar_pago(id){
	
	$id_array=id.split("_")
	
	
	swal({
	  title: "Desea Hacer Válido  El pago seleccionado?",
	  text: "El pago no podrá ser editado, si hay errores deberá anular el pago",
	  type: "info",
	  showCancelButton: true,
	  confirmButtonColor: "#337ab7",
	  confirmButtonText: "Si, Validar Pago",
	  cancelButtonText: "No, cancelar",
	  closeOnConfirm: false,
	  closeOnCancel: false
	},
	function(isConfirm){
	  if (isConfirm) {
		
		  
		  var datos="pago="+$id_array[0]+"&accion=validar_pago&orden="+orden
		
		  $.ajax({
			  
				type:"post",
					url:"ajax/procesos.php",
					data: datos,
					success: function(msj){
					
					if(msj==1){
						swal("Pago Efectuado!", "El cheque ha sido validado y pagado", "success");
						estado_formulario(1)	
					}
				}
			  
			  
			  
		  })
		  
	  } else {
		swal("Cancelado", "Pago de cheque Cancelado", "error");
	  }
	});
	
	
}
	
	</script>

    
    </head>

<body  >
<div class="loader"><div class="preloader"><i class="fa fa-spinner fa-spin fa-4x fa-fw"></i>
	</div></div>
<div class="cont">
<div id="div_menu"></div>
    <script>$("#div_menu").load("../global/menulateral.php");  </script>

  
    <div id="contenedor">
    <div class="div_contenedor"> 
     
     
    
 		  <h2>Pagos De Orden</h2>
    <span class="carpeta" style="padding:0; font-size:13px; margin-top:0px; color:#337ab7;"> Inicio /Menu / Pagos </span>
    <hr>
				  
		<div id="contenedor_fluido" class="container-fluid">
		
			    <div  class="panel panel-default" id="panel_buscar"> 
        			
        			<div class="panel-body">
        				<form id="frm_buscar_orden">
								
									
									 <div class="form-group form-group-lg">
									
									<div class="col-sm-10">
									  <input id="txt_orden" name="txt_orden" class="form-control" type="text" placeholder="Numero de Orden" required>
									</div>
								  </div>
								
								 <button style="width: 240px" type="submit" class="btn btn-primary btn-lg"  >Buscar Orden</button>
							</form>
							
        			
					</div>
            				
			    </div> 
			
        		<div id="carga_load" style="margin-bottom: 100px;">
        			
        			
		     	
		     	
         
  			
       </div>
		</div>
	</div>
	
	
	<footer id="footer"> </footer>
	</div>
</body>
</html>
	<script> $("#carga_load").load("listado_orden.php") </script>