<?
	include("../../functions/funciones.php");
	conecta_bd();
valida_sesion();
	
?>
<!doctype html>
<html>
<head>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title>Menu Sistema</title>

 
  <link rel="stylesheet" href="../../css/LateralStyle.css" title="style css" type="text/css" media="screen" charset="utf-8">
	    <link rel="stylesheet" href="../../libraries/fonts/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="../../libraries/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="../../libraries/bootstrap/css/bootstrap-theme.css">
		<link rel="stylesheet" href="../../libraries/bootstrap/css/bootstrap.css">
        
       
         <link rel="stylesheet" href="../../css/estilos.css" type="text/css">
         <link rel="stylesheet" href="../../css/bootstrap-datepicker.css"/>
 		 <link rel="stylesheet" href="../../css/sweetalert.css">
        <script type="text/javascript" src="../../js/jquery-1.10.1.min.js"></script>
       
  		<script src="../../libraries/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../js/sysscripts/validator.js"></script>	
       <script type="text/javascript" src="../../js/sweetalert-dev.js"></script>
	<script type="text/javascript" src="../../js/sweetalert-dev.js"></script>
	
   <script>
	   
	   var cliente=0;
	   var total_mobra=0
	   var total_repuesto=0
	   var orden=0;
	   var patente=0
	   
	   
	$(window).load(function() {

		$(".loader").fadeOut("slow");
	});

	   
	   $(document).ready(function(){
		   
		   $("#frm_buscar_vehiculo").submit(function(event){
			   	
			   		event.preventDefault()
					cargar_vehiculo()
					
					
					
		   
		   })
		   
	  
		    $("#frm_orden").submit(function(event){
			   	
			   		event.preventDefault()
					ingresar_orden()
					
					
					
		   
		   })
			
				  
		   
	   });
	  
	   function select_otro_trabajo(){
		   
		   
		  if($("#cmb_trabajo").val()=="otro"){
			  $("#div_select_trabajos2").show("slow")
			  
			  	$("#div_select_trabajos").hide("slow")	
			   
		  }
		   
		  
		 
	   }
	   
	   function cancelar_otro_trabajo(){
		   
		   $("#div_select_trabajos2").hide("slow")	
		    $("#cmb_trabajo").val(0).attr("selected",true);
		   $("#txt_trabajo").val("")
		   $("#txt_precio_trabajo").val("")
			$("#div_select_trabajos").show("slow")	
		   
	   }
	   
	   function crear_ingresar_trabajo(){
		   
		   var datos="trabajo="+$("#txt_trabajo").val()+"&precio="+$("#txt_precio_trabajo").val()+"&accion=crear_ingresar_trabajo";
		   
		
		  
		   $.ajax({
			   
			   type:"POST",
			   url:"ajax/procesos.php",	
			   data:datos,
			   success: function(msj){
				   
				   if(msj==1){
					   $("#div_trabajos").load("trabajos_realizar.php?orden="+orden);	
											   
							 				   
					   
				   }if(msj==2){
						   
				  
				  swal("Atencion!", "el trabajo ya existe", "warning")
				   }if(msj==3){
					   
					     swal("Atencion!", "faltan capos para rellenar del trabajo", "warning")
					  
					
					  
				  }
				   
				   
				   
			   }
			   
			   
			   
		   })
	   }
	   
	   
	   
	   
	   function ingresar_detalle_trabajo(){
		   
		   datos_array=$("#cmb_trabajo").val().split("_")
		   id_trabajo=datos_array[0]
		  
		   id_orden=datos_array[1]
		    id_precio=datos_array[2]
		   
		   var datos = "id_trabajo="+id_trabajo+"&accion=ingresar_detalle_trabajo&id_orden="+id_orden+"&id_precio="+id_precio;
			//alert(datos)
		   
		   $.ajax({
			  
			  
			type: "POST",
			url: "ajax/procesos.php",
			data: datos,
			success: function(msj) {
			//alert(msj)
			if(msj==1){
				swal("Atencion!", "Debe seleccionar un trabajo Antes de Ingresarlo En la Orden", "warning")
				
			}	
				
			if(msj==2){
				
				
			
			}else{
				
				cargar_trabajos_orden()
				
			}
					

			}
			   

			})
		   
	   }
	   
	   function eliminar_detalle_trabajo(id){
		   
		    datos_detalle=id.split("_")
		   	id_trabajo=datos_detalle[0]
			id_orden=datos_detalle[1]
		   var datos ="id_trabajo="+id_trabajo+"&accion=eliminar_detalle_trabajo&id_orden="+id_orden;
		
		   
		   $.ajax({
			  
			  
			type: "POST",
			url: "ajax/procesos.php",
			data: datos,
			success: function(msj) {
				
				//alert(msj)
					cargar_trabajos_orden()

			}
			   

			})
		   
	   }
		   
		 
		   
			  
	
	   
	   function cargar_vehiculo(){
		    $("#panel_buscar").show("slow")
		   $("#carga_load").load('tabla_vehiculo.php?patente='+$("#txt_patente").val());
		   patente=$("#txt_patente").val()
		   
	   }
	   
			   function cargar_orden(id){
				swal({
				  title: "Desea Crear la patente en el sistema?",
				  text: "se creará la patente en el sistema, deberá rellenar los campos faltantes del vehiculo ",
				 
				  showCancelButton: true,
				  confirmButtonColor: "#265a88",
				  confirmButtonText: "Si, Crear Orden",
				  cancelButtonText: "No, cancelar!",
				  closeOnConfirm: false,
				  closeOnCancel: false
				},
		function(isConfirm){
		  if (isConfirm) {
			//swal("Deleted!", "Your imaginary file has been deleted.", "success");
			  swal.close();
			  var datos="accion=crear_orden&identificador="+id+"&patente="+$("#txt_patente").val(); 	
			  
				  
				  $.ajax({
					  type:"POST",
					  url:"ajax/procesos.php",
					  data: datos,
					  success: function(msj){
						
						  mensaje=msj.split("_");
						
						
					if(mensaje[0]==1){
							 
							//  $("#contenedor_fluido").load("orden_de_trabajo.php?identificador="+id); 
							 
							  $("#panel_buscar").hide("slow")
							  $("#carga_load").load("orden_de_trabajo.php?identificador="+id); 
							 
						 } 
						  if(mensaje[0]==2){
						 
						 		//$("#panel_buscar").hide("slow")
								 
								
								$("#carga_load").load("tabla_vehiculo.php?patente="+$("#txt_patente").val()); 	
							   // $("#carga_load").load("editar_orden.php?orden="+mensaje[1]);
						 		//$("#carga_load").load("editar_orden.php?orden="+mensaje[1]);
						 		//console.log("editar_orden.php?orden="+mensaje[1]);
						 }
						  
						  
						  
						  
					  }
					 
					  
					  
					  
				 })			   
						   
		  } else {
			swal("Cancelado", "la operación ha sido cancelada");
		  }
		});
			 
			  
			  
							   
			
		  
		   
	   }
	   
	   function cargar_orden_vehiculo(id){
		 	
		  // $("#contenedor_fluido").load("orden_de_trabajo.php?identificador="+id+"&id_orden="+//; 
										// $("#totales").load("total_orden.php?abono="+$("#txt_abono").val()+"&saldo="+$("#txt_saldo").val()+"&descuento"+$("#txt_descuento").val()+"&orden="+);
		   
	   }
	   
	   function cargar_trabajos_orden(){
		   $("#div_trabajos").load("trabajos_realizar.php?orden="+orden);
								   $("#totales").load("total_orden.php?abono="+$("#txt_abono").val()+"&saldo="+$("#txt_saldo").val()+"&descuento"+$("#txt_descuento").val()+"&orden="+orden);
	   }
	   
    
    function carga_cliente(){
     
      
    var rut=$("#txt_rut").val();
     
    var datos = "rut="+rut+"&accion=buscar_cliente";  
    
      $.ajax({
       type: "POST",
       url: "ajax/procesos.php",
       data: datos,
       success: function(msj) {
        // swal(msj)
       
		 if(msj!=0){
        
        datos_array=msj.split("-separate-");
         cliente=datos_array[0]
		
		 
        $("#txt_nombre").val(datos_array[2])
        //$("#txt_nombre").attr("readonly","true")
        
        $("#txt_correo").val(datos_array[3])
         //$("#txt_correo").attr("readonly","true")
         
         $("#txt_fono").val(datos_array[4])
          //$("#txt_fono").attr("readonly","true")
          
          $("#txt_fono2").val(datos_array[5])
          //$("#txt_fono2").attr("readonly","true")
         
          $("#txt_direccion").val(datos_array[6])
        //  $("#txt_direccion").attr("readonly","true")
        	
          $("#cmb_tipo_cliente").val(datos_array[7]).attr("selected",true);
          //$("#cmb_tipo_cliente").val(datos_array[7]).attr("disabled",true); 
        
       }else{
         limpiar_cliente()
       }
         
          
       }
           
      });
     
     
    }
      
      
  function validar_rut_cliente(){
    
      if( Valida_Rut($("#txt_rut")) )
     { 
      
      validar_estilo_campo("txt_rut",1)
         formatrut($("#txt_rut"))
        carga_cliente()
      // cargar_rut_cliente($("#rut_cliente").val())
     
     }else{
      
      validar_estilo_campo("txt_rut",0)
       
      
      limpiar_cliente()
      
     }
  }
    
  function limpiar_cliente(){
   cliente=0
        $("#txt_nombre").val("")
        $("#txt_nombre").removeAttr("readonly")
        
       
         $("#txt_correo").removeAttr("readonly")
         $("#txt_correo").val("")
        
          $("#txt_fono").removeAttr("readonly")
          $("#txt_fono").val("")
          
            $("#txt_fono2").removeAttr("readonly")
         $("#txt_fono2").val("")
           
             $("#txt_direccion").removeAttr("readonly")
            $("#txt_direccion").val("")
         
         
           $("#cmb_tipo_cliente").val("seleccione").attr("selected",true);
              $("#cmb_tipo_cliente").val(datos_array[7]).removeAttr("disabled"); 
        
        
  }
			   
function ingresar_repuesto(){
	
	
	datos_producto=$("#cmb_productos").val().split("_")
	producto=datos_producto[0]
	orden=datos_producto[1]
	precio=datos_producto[2]
	precio_unitario=datos_producto[3]
	
	var datos="repuesto="+producto+"&orden="+orden+"&precio="+precio+"&accion=ingresa_detalles_repuesto&cantidad="+$("#txt_cantidad").val()+"&precio_unitario="+precio_unitario;

	$.ajax({
			
		 type: "POST",
       url: "ajax/procesos.php",
       data: datos,
       success: function(msj) {
		//alert(msj)
		 
		   if(msj==1){
			  // alert(1)
			   $("#div_repuestos").load("repuestos.php?orden="+orden);
							  $("#totales").load("total_orden.php?abono="+$("#txt_abono").val()+"&saldo="+$("#txt_saldo").val()+"&descuento"+$("#txt_descuento").val()+"&orden="+orden);			
									
			   
		   }if(msj==2){
			   sweetAlert("Atencion...", "Estimado usuario faltan Campos Por rellenar antes de ingresar el producto!", "warning");
			   
		   }if(msj==3){
			   
			   sweetAlert("Atencion...", "El producto ya fue ingresado en la orden", "warning");
		   }
			    if(msj==4){
			   
			   sweetAlert("Atencion...", "la cantidad del producto ingresada es mayor al stock actual", "warning");
		   }
			   
			   
		   
	   }
		
		
		
		
		
		
	})
}
		   
		   
function eliminar_detalle_repuesto(id){
		
		datos_rep=id.split("_")
		
		var datos="repuesto="+datos_rep[0]+"&orden="+datos_rep[1]+"&cantidad="+datos_rep[2]+"&accion=eliminar_detalle_repuesto"
			
			
			$.ajax({
				
				type:"POST",
				url:"ajax/procesos.php",
				data: datos,
				success: function(msj){
					
					if(msj==1){
						
						$("#div_repuestos").load("repuestos.php?orden="+orden);
								$("#totales").load("total_orden.php?abono="+$("#txt_abono").val()+"&saldo="+$("#txt_saldo").val()+"&descuento"+$("#txt_descuento").val()+"&orden="+orden);
					}
					
				}
				
				
			})
		
	}
	

					

					
					
function ingresar_orden(){
	
	
	swal({
  title: "Desea Guardar La orden?",
  text: "",
  type: "info",
  showCancelButton: true,
  confirmButtonColor: "#337ab7",
  confirmButtonText: "Si, Guardar !",
  cancelButtonText: "No, cancelar!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
   
	  var datos = $("#frm_orden").serialize()+"&accion=guardar_orden&cliente="+cliente+"&vehiculo="+$("#txt_codigo").val();	
						
												$.ajax({

							type:"POST",
							url:("ajax/procesos.php"),
							data: datos,
							success:function(msj){
									
								//swal(msj)
									
								if(msj==1){
									
									 swal("Orden Creada!", "La Orden a sido emitida .", "success");
									cargar_vehiculo()
									
								}
								if(msj==3){
									 swal("Atencion!", "Ha Elegido la opcion de cheque a fecha, Debe Ingresar Las Fechas De pago .", "warning");
								}
								
								if(msj==4){
									 swal("Atencion!", "debe rellenar los campos total o abono", "warning");
								}
								
								if(msj==5){
									 $("#txt_abono").val(0)
									sweetAlert("Atencion...","si desea Pagar El total de la orden marque la opcion total", "warning");
									
								}
								
								
								
							}





						})
	  
	  
  } else {
    swal("Cancelada", "La orden ha sido cancelada", "error");
  }
});
						
			
	
}
	   
function guardar_editar_orden(){
	//alert(2);
	swal({
  title: "Desea Guardar Los cambios de la orden seleccionada?",
  text: "Tome en en cuenta que al pagar la orden completa esta no podrá ser editada",
  type: "info",
  showCancelButton: true,
  confirmButtonColor: "#337ab7",
  confirmButtonText: "Si, Deseo guardar los cambios!",
  closeOnConfirm: false
},
function(isConfirm){
	
		if (isConfirm) {
		var datos="accion=guardar_editar_orden&"+$("#frm_editar_orden").serialize()+"&cliente="+cliente+"&vehiculo="+$("#txt_codigo").val();
		//alert(datos)
		$.ajax({
			
			type:"post",
			url:"ajax/procesos.php",
			data: datos,
			success:function(msj){
				
				if(msj==1){
					
					 swal("Orden Modificada Correctamente!", "Los Datos De la orden han sido modificados .", "success");
					cargar_vehiculo()
					
				}
				
								if(msj==3){
									 swal("Atencion!", "Ha Elegido la opcion de cheque a fecha, Debe Ingresar Las Fechas De pago .", "warning");
								}
								
								if(msj==4){
									 swal("Atencion!", "debe rellenar los campos total o abono", "warning");
								}
								
								if(msj==5){
									 $("#txt_abono").val(0)
									sweetAlert("Atencion...","si desea Pagar El total de la orden marque la opcion total", "warning");
									
								}
				
			}
			
			
			
			
		})
		
		}
		
 // swal("Deleted!", "Your imaginary file has been deleted.", "success");
 });
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
	  
	   function editar_orden(id){
		   
		   dato=id.split("_")
		   $("#panel_buscar").hide("slow")
		  $("#carga_load").load("editar_orden.php?orden="+dato[0]);
		 //  alert("orden_de_trabajo.php?orden="+dato[0]+"&accion=editar_orden");
			   
	
		   
		   
	   }
	   
	   
function anular_orden(id){
	
	var datos="accion=anular_orden&orden="+id;

	
	swal({
      title: "Anular Orden?", 
      text: "Estas Seguro Que deseas anular la orden seleccionada?", 
      type: "warning",
      showCancelButton: true,
      closeOnConfirm: false,
      confirmButtonText: "Si, Anular!",
      confirmButtonColor: "#ec6c62"
	  
    }, function() {
        $.ajax(
			
			
			
			//var datos="orden="+id+"&accion=anular_orden";
			
                {
                    type: "post",
                    url: "ajax/procesos.php",
                    data:datos,
			
                    success: function(msj){
						
						if(msj==1){
							
							swal(" Numero de orden: '"+id+"'Orden Anulada ", "", "success");
						 	 estado_formulario(1);
						}
						
                    }
                }
        )
     
    });
}
	   
function estado_formulario(num){
	
	
	if(num==1){
		 $("#carga_load").load('tabla_vehiculo.php?patente='+patente)	
		
	}
	
	
}
	   
function cancelar_orden(){
	
	
	swal({
  title: "Desea Cancelar la Orden?",
  text: "",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si, Cancelar",
  cancelButtonText: "No, Salir!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
	 swal.close()
   cargar_vehiculo()
  } else {
  	swal.close()
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
     
     
    
 		  <h2>Ordenes De Trabajo</h2>
    <span class="carpeta" style="padding:0; font-size:13px; margin-top:0px; color:#337ab7;"> Inicio /Menu </span>
    <hr>
				  
		<div id="contenedor_fluido" class="container-fluid">
		
			    <div  class="panel panel-default" id="panel_buscar"> 
        			
        			<div class="panel-body">
        				
							<form id="frm_buscar_vehiculo">
								
									
									 <div class="form-group form-group-lg">
									
									<div class="col-sm-10">
									  <input id="txt_patente" name="txt_patente" class="form-control" type="text" placeholder="PATENTE" required>
									</div>
								  </div>
								
								 <button style="width: 240px" type="submit" class="btn btn-primary btn-lg"  >Buscar Patente</button>
							</form>
        			
					</div>
            				
			    </div> 
			
        		<div id="carga_load" style="margin-bottom: 100px;">
        			<div class="row">
					<div class="col-md-4" style="margin-top: 15px;">
						<a href="../menu/Menu.php"  class="btn btn-warning btn-sm "  title="Volver al menu"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Volver </a>
					</div>
				</div>
        				
        		
		     	</div>
         
  		
       </div>
		</div>
	</div>
	<footer id="footer"> </footer>
</body>
</html>