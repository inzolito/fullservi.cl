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
        
        	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
  
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.colVis.min.js"></script>
		<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
		
	
   <script>

	datos_validados=0
	vvalida_rut=0
	estado_cliente=0
	valida_mail=0
	estado_edicion=0
	
	 $(window).load(function() {

		$(".loader").fadeOut("slow");
	});
	
	   $(document).ready(function(){
		  
		 
		   //Cargar tabla
		   $("#carga_load").load("tabla_clientes.php");
 		    
		   
		  // ------- Validar Form-----//
		   $("#form_cliente").submit(function(event){
			   
			   event.preventDefault();
			   datos_validados=1;  
			
		   });   
			   
			//---  Guardar Datos ----//
		    $("#btn_guardar_datos").click(function(){
			   
		 		$("#form_cliente").submit();
				
			 	if(datos_validados==1)
				{
					guardar_datos(2);		
					 
				}else{
					
					 
				}
			});  
		   
		   //---- Editar Datos  ----//
		  	$("#btn_editar_datos").click(function(){
				$("#form_cliente").submit();
				if(datos_validados==1)
				{
					guardar_datos(1);		
				}
				
			})
			
			
			//---- Boton Cancelar ----//
			$("#btn_cancelar").click(function(){
				
				limpiar_cliente();
			});

		   
		   //--- Cargar Rut ----//
		   
		   $("#rut_cliente").keyup(function(){
			   
			   
				  if( Valida_Rut($("#rut_cliente")) )
				  { 
				   
					  validar_estilo_campo("rut_cliente",1)
					  formatrut($("#rut_cliente"))
				  
					   cargar_rut_cliente($("#rut_cliente").val())
				  
				  }else{
					  validar_estilo_campo("rut_cliente",0)
					 // formato_formulario(1)
					  
				  }
				   
				   
			  
				   
		   
		   })
		   
		   
		   $("#mail_cliente").keyup(function(){
			   
			   
				// validateMail("mail_cliente")
		   
		   })
	   });
	  
 
	   
	    
	function limpiar_cliente(){
		   
		  
		   datos_validados=0;
		   $("#nombre_cliente").val("");
		   $("#rut_cliente").val("");
		   $("#fono_cliente").val("");
		   $("#fono2_cliente").val("");
		   $("#mail_cliente").val("");
		   $("#direccion_cliente").val("");
 		   $('#tipo_cliente option:eq(0)').attr('selected', 'selected')
		   $("#rut_cliente").removeAttr("disabled")
		   $("#div_rut_cliente").removeClass("has-success");
		   $("#icon_rut_cliente").removeClass("glyphicon-ok");
		   $("#div_rut_cliente").removeClass("has-error");
		   $("#icon_rut_cliente").removeClass("glyphicon-remove");
		   formato_formulario(1)
		 
		   $("#carga_load").load("tabla_clientes.php");    
	   }
	    
	   
	function guardar_datos(hacer){
		   
		   accion="guardar_cliente"
		   
		   if(hacer==1)
			{
				   accion="editar_cliente"
			}
		   
				// debe ser ==1
			   if(valida_mail==0){
				   
				   	var datos = $("#form_cliente").serialize()+"&rut_cliente="+$("#rut_cliente").val()+"&accion="+accion;							
																								
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
							 
							 
							  /*swal(msj)*/
							
								if(msj==1){
									
								 
					
									swal({
										  title: 'Datos modificados correctamente',
										  text: "",
										  type: 'success',
										  showCancelButton: true,
										  confirmButtonColor: '#3085d6',
										  cancelButtonColor: '#d33',
										  confirmButtonText: 'Cerrar'
										}).then(function () {
  
											location.reload()	
													
									})
												

									//
								}else if(msj==0){
									
									swal("El rut ingresado ya pertenece a un cliente en  el sistema", "","warning") 
								}else if(msj==2){
										
									swal("Complete los datos Faltantes.", "","warning") 
								}else{
									
									swal("Hubo un error en el proceso, revise que los datos sean los correctos " , "","warning") 
									
								}
								
								
								
								
							},
																	
							});
				   
				   
			   }else{
				   
				   swal("Las contraseñas no coinciden","","warning")
				   datos_validados=0;
			   }
		   
	   }
 
	 
	function cargar_cliente(id){
		
		 
		
		swal({
			title:"Editar Cliente?",
			text:"Está apunto de editar los datos de un cliente del sistema, ¿Desea continuar?",
			type:"warning",
			showCancelButton:true,
			
			
		},
		function(){
			
			var datos = "id_cliente="+id+"&accion=cargar_cliente";							
																								
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
			
								 
							 
								datos_e=msj.split("-separate-");				 
				
								$("#nombre_cliente").val(datos_e[1])
								$("#rut_cliente").val(datos_e[2])
								$("#mail_cliente").val(datos_e[3])
								$("#fono_cliente").val(datos_e[4])
								$("#fono2_cliente").val(datos_e[5])
								$("#direccion_cliente").val(datos_e[6])
								$("#tipo_cliente").val(datos_e[7]).attr('selected', 'selected')
													$("#id_cliente").val(datos_e[0])
								 formato_formulario(2);
								// $("#rut_cliente").attr("disabled","disabled")
								$("#div_menu").focus()
							},
																	
							});
		
		}
		)
		
		 	
				   
	}
	
	function cargar_rut_cliente(rut){
			
		 
		 	var datos = "rut_cliente="+rut+"&accion=cargar_rut_cliente";							
																								
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
			
				  			 
				  
								if(msj!=0)
								{
									
									$("#nombre_cliente").focus();
									datos_e=msj.split("-separate-");
												 
								//"id_cliente,nombre_cliente,rut_cliente,correo_cliente,fono_cliente,fono2_cliente,direccion_cliente,tipo_cliente");
									
										swal({
												title:"Editar cliente",
												text:"El rut pertenece a un cliente del sistema, ¿Desea editar sus datos?",
												type:"warning",
												showCancelButton:true,


											},
											function(r){
												if(r)
												{
													$("#nombre_cliente").focus();
													
													$("#nombre_cliente").val(datos_e[1])
													$("#mail_cliente").val(datos_e[3])
													$("#fono_cliente").val(datos_e[4])
													$("#fono2_cliente").val(datos_e[5])
													$("#direccion_cliente").val(datos_e[6])
													$("#tipo_cliente").val(datos_e[7]).attr('selected', 'selected')
													
													$("#id_cliente").val(datos_e[0])
													 formato_formulario(2);
 												}else{
													
													limpiar_cliente()
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
					
					//$("#rut_cliente").keyup()
					//$("#carga_load").load("tabla_clientes.php");

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

  
  
     
    <div id="contenedor">
    <div class="div_contenedor"> 
     
     
    
 	<h2>Clientes</h2>
    <span class="carpeta" style="padding:0; font-size:13px; margin-top:0px; color:#337ab7;"> Inicio /Menu /Clientes </span>
    <hr>
				  
		<div class="container-fluid">
		 		
			
      			<div id="id_contenedor_gestion_u" class="panel panel-default">
                  
                    <div class="panel-body">
                    <div class="col-xs-12"> 
	<fieldset>
	  <legend>Administración De Clientes</legend> 
	  </fieldset>
	</div>
						<form id="form_cliente" name="form_cliente"  >



							<div class="row" style="margin-bottom: 10px">
							    
							 
							 <div class="col-md-3">
 								  <label for="icon_rut_cliente"> Run </label>
								  <div id="div_rut_cliente" class="form-group has-feedback">
									<input type="text" class="form-control" id="rut_cliente" name="rut_cliente" aria-describedby="inputSuccess4Status" required>
									<span class="glyphicon  form-control-feedback" id="icon_rut_cliente" name="icon_rut_cliente" aria-hidden="true"></span>
								  
 								  </div>
								  
 							  </div>
						     
							 
							  <div class="col-md-3">
							  	<label for="nombre_cliente"> Nombre </label> 
							  	<input type="text" id="nombre_cliente"   name="nombre_cliente"  class="form-control" required>
							  </div>
							  
 							
							 
							 
							  <div class="col-md-3">
 								  <label for="icon_mail_cliente"> Mail </label>
								  <div id="div_mail_cliente" class="form-group has-feedback">
									<input type="email" class="form-control" id="mail_cliente" name="mail_cliente" aria-describedby="inputSuccess4Status" required>
									<span class="glyphicon  form-control-feedback" id="icon_mail_cliente" name="icon_mail_cliente" aria-hidden="true"></span>
								  
 								  </div>
								  
 							  </div>
							
 							  <div class="col-md-3">
 							    <label for="fono_cliente"> Teléfono </label>
							  	<input type="number" id="fono_cliente"  name="fono_cliente"  class="form-control"  maxlength="10" required>
							  	
							  </div>
						   </div>
						   
						   
						   
						   
						   <div class="row" style="margin-bottom: 10px">
							   <!--  -->
 							  <div class="col-md-3">
 							    <label for="pass_cliente"> Telefono 2 (opcional) </label>
							  	<input type="number" id="fono2_cliente" name="fono2_cliente"  class="form-control" >
							  	
							  </div>
						      
						      <div class="col-md-3">
 							    <label for="pass_cliente"> Dirección </label>
							  	<input type="text" id="direccion_cliente" name="direccion_cliente"  class="form-control" >
							  	
							  </div>
						      
						     
						     
						       
							 	 <div class="col-md-3">
							 	 	<label for="icon_permiso_cliente"> Tipo cliente </label>
									<select id="tipo_cliente" name="tipo_cliente" class="form-control" required>

										<option value=0 >----Seleccione----</option>
										<option value="Particular" >Particular</option>
										<option value="Empresa">Empresa</option>
									</select>
								</div>
								
							</div>	
							
							<!-- End Row -->
							
							<button  type="button" class="btn btn-primary btn-sm " id="btn_guardar_datos"  >
								<i class="fa fa-plus" aria-hidden="true"></i> Ingresar cliente
							</button>
							
							<button  type="button" class="btn btn-success btn-sm " id="btn_editar_datos"  >
								Editar cliente
							</button>
							<button  type="button" class="btn btn-default btn-sm" id="btn_cancelar"  >
								Cancelar
							</button>
							
							
						<a href="../menu/Menu.php"  class="btn btn-warning btn-sm "  title="Volver al menu"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Volver </a>
							
							<script>
								$("#btn_editar_datos").hide()
								$("#btn_cancelar").hide();
							</script>
						 
							   <input type="hidden" id="id_cliente" name="id_cliente" >
							  
					
					
						</form>
					</div>
      				
      			</div>
       		
       	 
       		
        		<div id="carga_load"  style="margin-bottom: 100px">
        			
        				
        		
		     	</div>
         
  
       </div>
	 </div>
	<footer id="footer"> </footer> <!-- <-->
</body>
</html>