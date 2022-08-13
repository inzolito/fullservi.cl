<?
include("../../functions/funciones.php");
conecta_bd();

valida_sesion()
	
	
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

	datos_validados=0
	vvalida_rut=0
	estado_cliente=0
	valida_mail=0
	
	   $(window).load(function() {

		$(".loader").fadeOut("slow");
	});
	   $(document).ready(function(){
		  
		 
		   //Cargar tabla
		   $("#carga_load").load("tabla_proveedores.php");
 		    
		   
		  // ------- Validar Form-----//
		   $("#form_proveedor").submit(function(event){
			   
			   event.preventDefault();
			   datos_validados=1;  
			
		   });   
			   
			//---  Guardar Datos ----//
		    $("#btn_guardar_datos").click(function(){
			   
		 		$("#form_proveedor").submit();
				
			 	if(datos_validados==1)
				{
					guardar_datos(2);		
					 
				}else{
					
					 
				}
			});  
		   
		   //---- Editar Datos  ----//
		  	$("#btn_editar_datos").click(function(){
				$("#form_proveedor").submit();
				if(datos_validados==1)
				{
					guardar_datos(1);		
				}
				
			})
			
			
			//---- Boton Cancelar ----//
			$("#btn_cancelar").click(function(){
				
				limpiar_proveedor();
			});

		   
		   //--- Cargar Rut ----//
		   
		   $("#rut_proveedor").keyup(function(){
			   
			   
			  if( Valida_Rut($("#rut_proveedor")) )
			  { 
			   
				  validar_estilo_campo("rut_proveedor",1)
			      formatrut($("#rut_proveedor"))
			  
				   cargar_rut_proveedor($("#rut_proveedor").val())
			  
			  }else{
				  validar_estilo_campo("rut_proveedor",0)
				  formato_formulario(1)
				  
			  }
			   
			   
			  
				   
		   
		   })
		   
		   
		   $("#mail_proveedor").keyup(function(){
			   
			   
				// validateMail("mail_cliente")
		   
		   })
	   });
	  
 
	   
	    
	function limpiar_proveedor(){
		   
		  $("#carga_load").load("tabla_proveedores.php");
		   datos_validados=0;
		   $("#nombre_proveedor").val("");
		   $("#rut_proveedor").val("");
		   $("#fono_proveedor").val("");
			$("#fono2_proveedor").val("");
		   
		   $("#mail_proveedor").val("");
		   $("#direccion_proveedor").val("");
			$("#contacto").val("");
 		  
		   $("#rut_proveedor").removeAttr("disabled")
		   $("#div_rut_proveedor").removeClass("has-success");
		   $("#icon_rut_proveedor").removeClass("glyphicon-ok");
		   $("#div_rut_proveedor").removeClass("has-error");
		   $("#icon_rut_proveedor").removeClass("glyphicon-remove");
		  formato_formulario(1)
		    
	   }
	    
	   
	function guardar_datos(hacer){
		   
		   accion="guardar_proveedor"
		   
		   if(hacer==1)
			{
				   accion="editar_proveedor"
			}
		   
				// debe ser ==1
			   if(valida_mail==0){
				   
				   	var datos = $("#form_proveedor").serialize()+"&rut_proveedor="+$("#rut_proveedor").val()+"&accion="+accion;							
																									
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
							
								if(msj==1){
									
									swal("Datos guardados satisfactoriamente.", "","success") 
									limpiar_proveedor()
								}else if(msj==0){
									
									swal("El Proveedor no está registrado en el sistema, revise.", "","warning") 
								}else if(msj==4){
									
									swal("Rellene todo los campos obligatorios, marcados con (*).", "","warning") 
									
								
									
								}else{
									
									swal("Hubo un error en el proceso, revise que los datos sean los correctos "+msj , "","warning") 
									
								}
								
								
								
								
							},
							
																	
							});
				   
				   
			   }else{
				   
				   swal("Las contraseñas no coinciden","","warning")
				   datos_validados=0;
			   }
		   
	   }
 
	 
	function cargar_proveedor(id){
		
		 
		
		swal({
			title:"Editar Provedor?",
			text:"Está apunto de editar los datos de un Proveedor del sistema, ¿Desea continuar?",
			type:"warning",
			showCancelButton:true,
			
			
		},
		function(){
			
			var datos = "id_proveedor="+id+"&accion=cargar_proveedor";							
																								
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
			
								 
							 
								datos_e=msj.split("-separate-");				 
				
								$("#nombre_proveedor").val(datos_e[1])
								$("#rut_proveedor").val(datos_e[2])
								$("#mail_proveedor").val(datos_e[3])
								$("#fono_proveedor").val(datos_e[4])
								$("#fono2_proveedor").val(datos_e[5])
								$("#direccion_proveedor").val(datos_e[6])
								$("#contacto").val(datos_e[7])

								 formato_formulario(2);
								$("#rut_proveedor").attr("disabled","disabled")
								$("#div_menu").focus()
							},
																	
							});
		
		}
		)
		
		 	
				   
	}
	
	function cargar_rut_proveedor(rut){
			 
		 	var datos = "rut_proveedor="+rut+"&accion=cargar_rut_proveedor";							
																								
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
			
				  			 
								
								if(msj!=0)
								{
									datos_e=msj.split("-separate-");				 
				 
										swal({
												title:"Editar proveedor",
												text:"El rut pertenece a un proveedor del sistema, ¿Desea editar sus datos?",
												type:"warning",
												showCancelButton:true,


											},
											function(r){
												if(r)
												{
										//d_proveedor,nombre_proveedor,mail_proveedor,direccion_proveedor,contacto_proveedor,fono_proveedor,fono2_proveedor
													$("#nombre_proveedor").val(datos_e[1])

													$("#mail_proveedor").val(datos_e[2])
													$("#direccion_proveedor").val(datos_e[3])
													$("#contacto").val(datos_e[4])
													$("#fono_proveedor").val(datos_e[5])
													$("#fono2_proveedor").val(datos_e[6])

													 formato_formulario(2);
 												}else{
													
													limpiar_proveedor()
												}
											} 
											)	

								}else{
									
									 
			
									
								}
								 
									
								
								
							},
																	
							});
				   
	}
	   
	function formato_formulario(f){
		   if(f==1){
			   
			    	
			   $("#btn_guardar_datos").show(200);
		   	   $("#btn_editar_datos").hide(200);
		   	   $("#btn_cancelar").hide(200);
			  
			   $("#carga_load").show(200)
		   }else{
			   
			   if(f==2)
				{
					/**/
					$("#carga_load").hide(200)
					$("#btn_guardar_datos").hide(200);
					$("#btn_editar_datos").show(200);
					$("#btn_cancelar").show(200)
					
					$("#rut_cliente").keyup()
					
				}else{
					
					
					
				}
			   
		   }
		   
		   
	}
	
    
	   
</script> 
    </head>

<body  >
<div class="loader"><div class="preloader"><i class="fa fa-spinner fa-spin fa-4x fa-fw"></i>
	</div></div>
 <div class="cont">
  <!--  -->
    <div id="div_menu"></div>
    <script>$("#div_menu").load("../global/menulateral.php");  </script>

  
  
     
    <div class="div_contenedor"> 
     
     
    
 	<h2>Proveedor</h2>
    <span class="carpeta" style="padding:0; font-size:13px; margin-top:0px; color:#337ab7;"> Inicio /Menu /Proveedores </span>
    <hr>
				  
		<div class="container-fluid">
		 		
			
      			<div id="id_contenedor_gestion_u" class="panel panel-default">
                  
                    <div class="panel-body">
                    <div class="col-xs-12"> 
	<fieldset>
	  <legend>Administración De Proveedores</legend> 
	  </fieldset>
	</div>
						<form id="form_proveedor" name="form_proveedor"  >



							<div class="row" style="margin-bottom: 10px">
							    
							 
							 <div class="col-md-3">
 								  <label for="icon_rut_proveedor"> R.U.T (*) </label>
								  <div id="div_rut_proveedor" name="div_rut_proveedor" class="form-group has-feedback">
									<input type="text" class="form-control" id="rut_proveedor" name="rut_proveedor" aria-describedby="inputSuccess4Status" required>
									<span class="glyphicon  form-control-feedback" id="icon_rut_proveedor" name="icon_rut_proveedor" aria-hidden="true"></span>
								  
 								  </div>
								  
 							  </div>
						     
							 
							  <div class="col-md-3">
							  	<label for="nombre_proveedor"> Nombre Proveedor (*) </label> 
							  	<input type="text" id="nombre_proveedor"   name="nombre_proveedor"  class="form-control" required>
							  </div>
							  
 							
							 
							 
							  <div class="col-md-3">
 								  <label for="icon_mail_proveedor"> Mail </label>
								  <div id="div_mail_proveedor" class="form-group has-feedback">
									<input type="email" class="form-control" id="mail_proveedor" name="mail_proveedor" aria-describedby="inputSuccess4Status" required>
									<span class="glyphicon  form-control-feedback" id="icon_mail_proveedor" name="icon_mail_proveedor" aria-hidden="true"></span>
								  
 								  </div>
								  
 							  </div>
							
 							  <div class="col-md-3">
 							    <label for="fono_proveedor"> Teléfono </label>
							  	<input type="number" id="fono_proveedor"  name="fono_proveedor"  class="form-control"  maxlength="10" required>
							  	
							  </div>
							 
						   </div>
						   
						   
						   
						   
						   <div class="row" style="margin-bottom: 10px">
							   <!--  -->
 							  <div class="col-md-3">
 							    <label for="contacto"> Persona de contacto(*)</label>
 							    <input type="text" id="contacto" name="contacto"  class="form-control" >
							  	
							  </div>
						      
						      <div class="col-md-6">
 							    <label for="direccion_proveedor"> Dirección (*)</label>
							  	<input type="text" id="direccion_proveedor" name="direccion_proveedor"  class="form-control" >
							  	
							  </div>
						       <div class="col-md-3">
 							    <label for="fono2_proveedor"> Teléfono 2 </label>
							  	<input type="number" id="fono2_proveedor"  name="fono2_proveedor"  class="form-control"  maxlength="10" required>
							  	
							  </div>
						     						
								
								
								
							</div>
							
							<!-- End Row -->
							
							<button  type="button" class="btn btn-primary btn-sm  " id="btn_guardar_datos"  >
								<i class="fa fa-plus" aria-hidden="true"></i> Guardar Proveedor
							</button>
							
							<button  type="button" class="btn btn-success btn-sm " id="btn_editar_datos"  >
								Editar Proveedor
							</button>
							<button  type="button" class="btn btn-default btn-sm" id="btn_cancelar"  >
								Cancelar
							</button>
							
							
						<a href="../menu/Menu.php"  class="btn btn-warning btn-sm "  title="Volver al menu"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Volver </a>
							
							<script>
								$("#btn_editar_datos").hide()
								$("#btn_cancelar").hide();
							</script>
						 
							   
							  
					
					
						</form>
					</div>
      				
      			</div>
       		
       	 
       		
        		<div id="carga_load"  style="margin-bottom: 100px">
        			
        				
        		
		     	</div>
         
  
       </div>
 
	<footer id="footer"> </footer> <!-- <-->
</body>
</html>