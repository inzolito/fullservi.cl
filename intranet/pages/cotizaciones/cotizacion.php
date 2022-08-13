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
	   var cotizacion=0;
	   var patente=""
	      $(window).load(function() {

		$(".loader").fadeOut("slow");
	});
	   $(document).ready(function(){
		   
		   $("#frm_buscar_vehiculo").submit(function(event){
			   	
			   		event.preventDefault()
					cargar_vehiculo()
					
					
					
		   
					
					
					
		   })
		   
		   
		   
	  
		  })
	   
	  function cargar_vehiculo(){
		   
		   $("#carga_load").load('tabla_vehiculo.php?patente='+$("#txt_patente").val());
		   patente=$("#txt_patente").val()
		   
	   }
	   
	   
	   
	   function crear_cotizacion(id){
		   	
					swal({
			  title: "Desea Crear Una Cotizacion'",
			  text: "",
			  type: "info",
			  showCancelButton: true,
			  confirmButtonColor: "#265a88",
			  confirmButtonText: "Si, Crear!",
			  cancelButtonText: "No, Cancelar!",
			  closeOnConfirm: false,
			  closeOnCancel: false
			},
			function(isConfirm){
			  if (isConfirm) {
				   //swal("Deleted!", "Your imaginary file has been deleted.", "success");
				
				  swal.close()
				   var datos="accion=crear_cotizacion&identificador="+id+"&patente="+patente; 	
				 
				  $.ajax({
					  type:"POST",
					  url:"ajax/procesos.php",
					  data: datos,
					  success: function(msj){
						 
						
						  mensaje=msj.split("_")
						
						
					if(mensaje[0]==1){
							
						
							  $("#panel_buscar").hide("slow")
							  $("#carga_load").load("cotizacion_trabajo.php?identificador="+id); 
							 
					 }
						  if(mensaje[0]==2){
							  
							  
							
						
							  $("#contenedor_fluido").load("editar_cotizacion_trabajo.php?cotizacion="+mensaje[1]);
							 
					 }
						  
						  
					  }
					 
					  
					  
					  
				 })
				
				 
				  
			  } else {
				swal("Cancelada", "La creación de la cotizacion ha sido cancelada", "error");
			  }
			});


	   }
	   
	   
	function carga_cliente(){
     
      
    var rut=$("#txt_rut").val();
     
    var datos = "rut="+rut+"&accion=buscar_cliente";  
    
      $.ajax({
       type: "POST",
       url: "ajax/procesos.php",
       data: datos,
       success: function(msj) {
    	
		 if(msj!=0){
        
        datos_array=msj.split("-separate-");
		
         cliente=datos_array[0]
		 
		 
        $("#txt_nombre").val(datos_array[1])
        //$("#txt_nombre").attr("readonly","true")
        
        $("#txt_correo").val(datos_array[3])
         //$("#txt_correo").attr("readonly","true")
         
         $("#txt_fono").val(datos_array[4])
          //$("#txt_fono").attr("readonly","true")
          
          $("#txt_fono2").val(datos_array[5])
          //$("#txt_fono2").attr("readonly","true")
         
          $("#txt_direccion").val(datos_array[6])
        //  $("#txt_direccion").attr("readonly","true")
        	
		 
        //  $("#cmb_tipo_cliente").val(datos_array[7]).attr("selected",true);
			$("#cmb_tipo_cliente").val(datos_array[7]).attr('selected', 'true')
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
					  
					   $("#div_trabajos").load("detalle_trabajos_cotizacion.php?cotizacion="+cotizacion);	
											   
							 				   
					   
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
		  
		   id_cotizacion=datos_array[1]
		   id_precio=datos_array[2]
		   
		   var datos = "id_trabajo="+id_trabajo+"&accion=ingresar_detalle_trabajo&id_cotizacion="+id_cotizacion+"&id_precio="+id_precio;
				   
		   $.ajax({
			  
			  
			type: "POST",
			url: "ajax/procesos.php",
			data: datos,
			success: function(msj) {
			
			if(msj==1){
				swal("Atencion!", "Debe seleccionar un trabajo Antes de Ingresarlo En la Orden", "warning")
				
			}	
				
			if(msj==2){
				
				swal("Atencion!", "Debe seleccionar un trabajo Antes de Ingresarlo En la Orden", "warning")
				
			}
				if(msj==3){
				cargar_trabajos_cotizacion()
				
			}	
				
							

			}
			   

			})
		   
	   }
	   
	   
	    function cargar_trabajos_cotizacion(){
		   $("#div_trabajos").load("detalle_trabajos_cotizacion.php?cotizacion="+cotizacion);
								   $("#totales").load("total_cotizacion.php?cotizacion="+cotizacion);
	   }
	   
	   function eliminar_detalle_trabajo(id){
		   
		    datos_detalle=id.split("_")
		   	id_trabajo=datos_detalle[0]
			id_cotizacion=datos_detalle[1]
		   var datos ="id_trabajo="+id_trabajo+"&accion=eliminar_detalle_trabajo&id_cotizacion="+id_cotizacion;
		
		   
		   $.ajax({
			  
			  
			type: "POST",
			url: "ajax/procesos.php",
			data: datos,
			success: function(msj) {
				
					cargar_trabajos_cotizacion()

			}
			   

			})
		   
	   }
	   
function ingresar_repuesto(){
	
	
	datos_producto=$("#cmb_productos").val().split("_")
	producto=datos_producto[0]
	cotizacion=datos_producto[1]
	precio=datos_producto[2]
	precio_unitario=datos_producto[3]
	
	var datos="repuesto="+producto+"&cotizacion="+cotizacion+"&precio="+precio+"&accion=ingresa_detalles_repuesto&cantidad="+$("#txt_cantidad").val()+"&precio_unitario="+precio_unitario;
	
	$.ajax({
			
		 type: "POST",
       url: "ajax/procesos.php",
       data: datos,
       success: function(msj) {
		
		 
		   if(msj==1){
			  // alert(1)
			   $("#div_repuestos").load("detalle_repuestos_cotizacion.php?cotizacion="+cotizacion);
							    $("#totales").load("total_cotizacion.php?cotizacion="+cotizacion);		
									
			   
		   }if(msj==2){
			   sweetAlert("Atencion...", "Estimado usuario faltan Campos Por rellenar antes de ingresar el producto!", "warning");
			   
		   }if(msj==3){
			   
			   sweetAlert("Atencion...", "El producto ya fue ingresado en la Cotizacion", "warning");
		   }
			    if(msj==4){
			   
			   sweetAlert("Atencion...", "la cantidad del producto ingresada es mayor al stock actual", "warning");
		   }
			   
			   
		   
	   }
		
		
		
		
		
		
	})
}
		   
		   
function eliminar_detalle_repuesto(id){
		
		datos_rep=id.split("_")
		
		var datos="repuesto="+datos_rep[0]+"&cotizacion="+datos_rep[1]+"&cantidad="+datos_rep[2]+"&accion=eliminar_detalle_repuesto"
			
			
			$.ajax({
				
				type:"POST",
				url:"ajax/procesos.php",
				data: datos,
				success: function(msj){
					
					if(msj==1){
						
						$("#div_repuestos").load("detalle_repuestos_cotizacion.php?cotizacion="+cotizacion);
								  $("#totales").load("total_cotizacion.php?cotizacion="+cotizacion);
					}
					
				}
				
				
			})
		
	}
		   
	function guardar_cotizacion(){
		
		
		//$("#contenedor_fluido").load('tabla_vehiculo.php?patente=ch-5825');
		 //estado_formulario(1);
		
		swal({
		  title: "Guardar Cotizacion?",
		  text: "la cotizacion será Guardada en el sistema y tendra un tiempo valido de 30 días",
		  type: "info",
		  showCancelButton: true,
		  confirmButtonColor: "#8CD4F5",
		  confirmButtonText: "Si,Guardar!",
		 cancelButtonText: "No, Cancelar!",
		  closeOnConfirm: false
		},
			 
			 function(isConfirm){
			  if (isConfirm) {
				   //swal("Deleted!", "Your imaginary file has been deleted.", "success");
				
				  swal.close()
						  var datos=$("#frm_cotizacion").serialize()+"&accion=guardar_cotizacion&cliente="+cliente
						 
				  $.ajax({

					  type:"post",
					  url:"ajax/procesos.php",
					  data: datos,

					  success:function(msj){
					
						  if(msj==1)
							  {
								  estado_formulario(1);


							  }



					  }



				  })

				  
			  } else {
				swal("Cancelada", "la cotizacion fue cancelada", "error");
			  }
			});
			 
		
		
		
		
	}
	   

function editar_orden(id){

   dato=id.split("_")

    $("#panel_buscar").hide("slow")
							  $("#carga_load").load("editar_cotizacion_trabajo.php?cotizacion="+dato[0]); 
//  $("#contenedor_fluido").load("editar_cotizacion_trabajo.php?cotizacion="+dato[0]);
 //  alert("orden_de_trabajo.php?orden="+dato[0]+"&accion=editar_orden");



}
			   
function estado_formulario(num){
	
	
	if(num==1)
		
		{
			//swal.close()
			$("#carga_load").load('tabla_vehiculo.php?patente='+patente);
			$("#panel_buscar").show('slow')
		
	
		
		}
			if(num==2)
		{
					  
					 
					$("#carga_load").load('tabla_vehiculo.php?patente='+patente);
						$("#panel_buscar").show('slow')
				  } else {
					swal.close()				
				  }
			
	
	
		
		}
	
	
	
	
	
	
	
	

	   
	   	
	
	   
	function guardar_editar_cotizacion(){
	//alert(2);
	swal({
  title: "Desea Guardar Los cambios de la cotizacion seleccionada?",
  text: "Los Datos De La Cotizacion serán actualizados",
  type: "info",
  showCancelButton: true,
  confirmButtonColor: "#337ab7",
  confirmButtonText: "Si, Deseo guardar los cambios!",
  cancelButtonText: "No, Cancelar!",
  closeOnConfirm: false
},
function(isConfirm){
	
		if (isConfirm) {
		var datos="accion=guardar_editar_cotizacion&"+$("#frm_editar_cotizacion").serialize()+"&cliente="+cliente+"&vehiculo="+$("#txt_codigo").val();
		
		$.ajax({
			
			type:"post",
			url:"ajax/procesos.php",
			data: datos,
			success:function(msj){
				
				if(msj==1){
					
					swal("Datos Guardados!", "Orden Modificada Correctamente", "success")
					
						
					    estado_formulario(1)
				
				   // $("#carga_load").load('tabla_vehiculo.php?patente=1')
					
				}
				
				
			}
			
			
			
			
		})
		
		}
		
 // swal("Deleted!", "Your imaginary file has been deleted.", "success");
 });
}
	  
function anular_cotizacion(id){
	
	var datos="accion=anular_cotizacion&cotizacion="+id;

	
	swal({
      title: "Anular Cotizacion?", 
      text: "Estas Seguro Que deseas anular la Cotizacion seleccionada?", 
      type: "warning",
      showCancelButton: true,
      closeOnConfirm: false,
      confirmButtonText: "Si, Anular!",
      confirmButtonColor: "#ec6c62"
	  
    }, function() {
        $.ajax(
			
			
			
			
			
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
	   
	   
function cancela(id){
	
	var datos="accion=cancelar_cotizacion&cotizacion="+id;
		
	swal({
      title: "Cancelar Cotizacion?", 
      text: "", 
      type: "warning",
      showCancelButton: true,
      closeOnConfirm: false,
      confirmButtonText: "Si, Cancelar!",
      confirmButtonColor: "#ec6c62"
	  
    }, function() {
        $.ajax(
			          {
                    type: "post",
                    url: "ajax/procesos.php",
                    data:datos,
			
                    success: function(msj){
						
						if(msj==1){
							
							 swal.close()
							$("#carga_load").load('tabla_vehiculo.php?patente='+patente);
						$("#panel_buscar").show('slow')
						}
						
                    }
                }
        )
     
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
     
     
    
 		  <h2>Cotización</h2>
    <span class="carpeta" style="padding:0; font-size:13px; margin-top:0px; color:#337ab7;"> Inicio /Menu / Cotizaciones </span>
    <hr>
				  
		<div id="contenedor_fluido" class="container-fluid">
		
			    <div  class="panel panel-default" id="panel_buscar"> 
        			
        			<div class="panel-body">
        				
							<form id="frm_buscar_vehiculo">
								
									
									 <div class="form-group form-group-lg">
									
									<div class="col-sm-10">
									  <input id="txt_patente" class="form-control" type="text" placeholder="PATENTE" required onKeyUp="javascript:this.value=this.value.toLowerCase();">
									</div>
								  </div>
								
								 <button style="width: 240px" type="submit" class="btn btn-primary btn-lg"  >Buscar Patente</button>
							</form>
        			
					</div>
            				
			    </div> 
			
        		<div id="carga_load" style="margin-bottom: 100px;">
        			
        				<div class="row">
					<div class="col-md-4" style="margin-top: 15px;">
						<a href="../menu/Menu.php"  class="btn btn-warning btn-sm "  title="Volver al menu"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
					</div>
				</div>
        		
		     	</div>
         
  
       </div>
		</div>
	</div>
	<footer id="footer"> </footer>
</body>
</html>