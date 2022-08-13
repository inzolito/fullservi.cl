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
       <script type="text/javascript" src="../../js/sweetalert-dev.js"></script>
       <script type="text/javascript" src="../../js/sweetalert-dev.js"></script>
       
  		<script src="../../libraries/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../js/sysscripts/validator.js"></script>	
     
	
   <script>
	valida_pass=0
	datos_validados=0
	vvalida_rut=0
	estado_empleado=0
	
	 $(window).load(function() {

		$(".loader").fadeOut("slow");
	});
	
	
	   $(document).ready(function(){
		  
		 
		   //Cargar tabla
		   $("#carga_load").load("tabla_empleados.php");
 		   
		   
		   // validar rut
		  $("#pass2_empleado").keyup(function(){
			  
			 
			 if($("#pass_empleado").val() == $("#pass2_empleado").val())
			 {
				   
				validar_estilo_campo("pass2_empleado",1);
				 valida_pass=1;
				 
			 }else{
				 validar_estilo_campo("pass2_empleado",0);
				 valida_pass=0;
				 
			 }
			  
		  
		  });
		   
		   
		   
		  // ------- Validar Form-----//
		   $("#form_empleado").submit(function(event){
			   
			   event.preventDefault();
			   datos_validados=1;  
			
		   });   
			   
			//---  Guardar Datos ----//
		    $("#btn_guardar_datos").click(function(){
			   
		 		$("#form_empleado").submit();
				
			 	if(datos_validados==1)
				{
					guardar_datos(2);		
					 
				}else{
					
					 
				}
			});  
		   
		   //---- Editar Datos  ----//
		  	$("#btn_editar_datos").click(function(){
				$("#form_empleado").submit();
				if(datos_validados==1)
				{
					guardar_datos(1);		
				}
				
			})
			
			
			//---- Boton Cancelar ----//
			$("#btn_cancelar").click(function(){
				
				limpiar_empleado();
			});

		   
		   //--- Cargar Rut ----//
		   
		   $("#rut_empleado").keyup(function(){
			   
			   
			  if( Valida_Rut($("#rut_empleado")) )
			  { 
			   
				  validar_estilo_campo("rut_empleado",1)
			      formatrut($("#rut_empleado"))
			  
				   cargar_rut_empleado($("#rut_empleado").val())
			  
			  }else{
				  validar_estilo_campo("rut_empleado",0)
				  formato_formulario(1)
				  
			  }
			   
			   
			  
				   
		   
		   })
		   
		   
		   
	   });
	  
	 
	    
	function limpiar_empleado(){
		   
		  $("#carga_load").load("tabla_empleados.php");
		   datos_validados=0;
		   $("#nombre_empleado").val("");
		   $("#rut_empleado").val("");
		   $("#fono_empleado").val("");
		   $("#pass_empleado").val("");
		   $("#pass2_empleado").val("");
		   $('#permiso_empleado option:eq(0)').attr('selected', 'selected')
		   
		   $("#rut_empleado").removeAttr("disabled")
		   $("#div_rut_empleado").removeClass("has-success");
		   $("#icon_rut_empleado").removeClass("glyphicon-ok");
		   $("#div_rut_empleado").removeClass("has-error");
		   $("#icon_rut_empleado").removeClass("glyphicon-remove");
		  formato_formulario(1)
		    
	   }
	    
	   
	function guardar_datos(hacer){
		   
		   accion="guardar_empleado"
		   
		   if(hacer==1)
			{
				   accion="editar_empleado"
			}
		   
			   if(valida_pass==1){
				   
				   	var datos = $("#form_empleado").serialize()+"&accion="+accion;							
																								
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
							 		
								swal("Datos guardados satisfactoriamente.", "","success") 
								limpiar_empleado()
								
							},
																	
							});
				   
				   
			   }else{
				   
				   swal("Las contraseñas no coinciden","","warning")
				   datos_validados=0;
			   }
		   
	   }
 
	 
	function cargar_empleado(id){
		
		 
		
		swal({
			title:"Editar usuario",
			text:"Está apunto de editar los datos de un usuario del sistema, ¿Desea continuar?",
			type:"warning",
			showCancelButton:true,
			
			
		},
		function(){
			
			var datos = "id_empleado="+id+"&accion=cargar_empleado";							
																								
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
			
								 
							 
								datos_e=msj.split("-separate-");				 
				
								$("#nombre_empleado").val(datos_e[1])
								$("#rut_empleado").val(datos_e[2])
								$("#fono_empleado").val(datos_e[3])
								$("#pass_empleado").val(datos_e[4])
								$("#pass2_empleado").val(datos_e[4])
								$("#permiso_empleado").val(datos_e[5]).attr('selected', 'selected')
								
								 $("#rut_empleado").attr("disabled","disabled")
								formato_formulario(2) 
								validar_estilo_campo("pass2_empleado",1);
								valida_pass=1;
							
								$("#div_menu").focus()
							},
																	
							});
		
		}
		)
		
		 	
				   
	}
	
	function cargar_rut_empleado(rut){
			 
		 	var datos = "rut_empleado="+rut+"&accion=cargar_rut_empleado";							
																								
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
			
				  			 
								datos_e=msj.split("-separate-");				 
				
								estado_empleado=datos_e[6]
							
								 
								if(estado_empleado==1)
								{
										swal({
												title:"Editar usuario",
												text:"El rut pertenece a un empleado del sistema, ¿Desea editar sus datos?",
												type:"warning",
												showCancelButton:true,


											},
											function(r){
												if(r)
												{
													$("#nombre_empleado").val(datos_e[1])

													$("#fono_empleado").val(datos_e[3])
													$("#pass_empleado").val(datos_e[4])
													$("#pass2_empleado").val(datos_e[4])
													$("#permiso_empleado").val(datos_e[5]).attr('selected', 'selected')

													 formato_formulario(2);
													validar_estilo_campo("pass2_empleado",1);
												}else{
													
													limpiar_empleado()
												}
											} 
											)	

								}else{
									
									if(estado_empleado==0)
									{
										swal({
												title:"Editar usuario",
												text:"El rut pertenece a un empleado que se retiró del sistema, ¿Desea cargar los datos para ingresarlo nuevamente?",
												type:"warning",
												showCancelButton:true,


											},
											function(r){
												if(r)
												{
													$("#nombre_empleado").val(datos_e[1])

													$("#fono_empleado").val(datos_e[3])
													$("#pass_empleado").val(datos_e[4])
													$("#pass2_empleado").val(datos_e[4])
													$("#permiso_empleado").val(datos_e[5]).attr('selected', 'selected')

													 formato_formulario(2);
													validar_estilo_campo("pass2_empleado",1);
												}else{
													
													limpiar_empleado()
												}
											} 
											)	

									}
									
			
									
								}
								 
									
								
								
							},
																	
							});
				   
	}
	   
	function formato_formulario(f){
		   if(f==1){
			   /*  */
				$("#div_pass2_empleado").removeClass("has-success");
				$("#icon_pass2_empleado").removeClass("glyphicon-ok");
				$("#div_pass2_empleado").removeClass("has-error");
				$("#icon_pass2_empleado").removeClass("glyphicon-remove");
			   	
			   	
			   
			   
			   $("#pass_empleado").val("")
			   $("#pass2_empleado").val("")
			   $("#btn_guardar_datos").show(200);
		   	   $("#btn_editar_datos").hide(200);
		   	   $("#btn_cancelar").hide(200);
			  
			   $("#carga_load").show(200)
		   }else{
			   
			   if(f==2)
				{
					/**/
					validar_estilo_campo("rut_empleado",1)
			      formatrut($("#rut_empleado"))
					$("#carga_load").hide(200)
					$("#btn_guardar_datos").hide(200);
					$("#btn_editar_datos").show(200);
					$("#btn_cancelar").show(200)
					
				}else{
					
					
					
				}
			   
		   }
		   
		   
	}
	
	function eliminar_empleado(id){
		
		 swal({
		  title: "¿Está seguro?",
		  text: "Está apunto de eliminar un empleado del sistema.¿ Realmente desea continuar?",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Eliminar",
		  closeOnConfirm: false
		},
		function(){
		  

			var datos = "id_empleado="+id+"&accion=dar_baja_empleado";							
																								
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
								 
								limpiar_empleado()
						 		 swal("Empleado eliminado!", "", "success");
								
							},
																	
							});
 
		
		
		
		});
	}   
	   
	   
</script>
    </head>

<body  >

<div class="loader"><div class="preloader"><i class="fa fa-spinner fa-spin fa-4x fa-fw"></i>
	</div></div>
<div class="cont"  >
 
  <!--  -->
    <div id="div_menu"></div>
    <script>$("#div_menu").load("../global/menulateral.php");  </script>

  
  
     
   <div id="contenedor">
    <div class="div_contenedor"> 
     
     
     
    
 	<h2>Empleados</h2>
    <span class="carpeta" style="padding:0; font-size:13px; margin-top:0px; color:#337ab7;"> Inicio /Menu /Empleados </span>
    <hr>
				  
		<div class="container-fluid">
		 		
			
      			<div id="id_contenedor_gestion_u" class="panel panel-default">
                  	
                    <div class="panel-body">
                    <fieldset>
                    <legend>
                    		Ingresar Empleado
						</legend>
						</fieldset>
						<form id="form_empleado" name="form_empleado"  >



							<div class="row" style="margin-bottom: 10px">
							    
							 
							 <div class="col-md-4">
 								  <label for="icon_rut_empleado"> Run </label>
								  <div id="div_rut_empleado" class="form-group has-feedback">
									<input type="text" class="form-control" id="rut_empleado" name="rut_empleado" aria-describedby="inputSuccess4Status" required>
									<span class="glyphicon  form-control-feedback" id="icon_rut_empleado" name="icon_rut_empleado" aria-hidden="true"></span>
								  
 								  </div>
								  
 							  </div>
						     
							 
							  <div class="col-md-4">
							  	<label for="nombre_empleado"> Nombre </label> 
							  	<input type="text" id="nombre_empleado"   name="nombre_empleado"  class="form-control" required>
							  </div>
							  
 							
							 
							 
							 
							
 							  <div class="col-md-4">
 							    <label for="fono_empleado"> Teléfono </label>
							  	<input type="number" id="fono_empleado"  name="fono_empleado"  class="form-control"  maxlength="10" required>
							  	
							  </div>
						   </div>
						   
						   <div class="row">
							   <!--  -->
 							  <div class="col-md-4">
 							    <label for="pass_empleado"> Contraseña </label>
							  	<input type="password" id="pass_empleado" name="pass_empleado"  class="form-control" required>
							  	
							  </div>
						     
 							  <div class="col-md-4">
 								  <label for="icon_pass2_empleado"> Repetir contraseña </label>
								  <div id="div_pass2_empleado" class="form-group has-feedback">
									<input type="password" class="form-control" id="pass2_empleado" name="pass2_empleado" aria-describedby="inputSuccess4Status" required>
									<span class="glyphicon  form-control-feedback" id="icon_pass2_empleado" aria-hidden="true"></span>
								  
 								  </div>
								  
 							  </div>
						     
						     
						       
							 	 <div class="col-md-3">
							 	 	<label for="icon_pass2_empleado"> Permisos De sistema empleado </label>
									<select id="permiso_empleado" name="permiso_empleado" class="form-control" required>

										<option value >Seleccione Permiso</option>
										<option value="Administrador" >Administrador</option>
										<option value="Secretaria">Secretaria</option>
									</select>
								</div>
								
								
								
								
								
								
								
							</div>
							
							<!-- End Row -->
							
							<button  type="button" class="btn btn-primary btn-sm" id="btn_guardar_datos"  >
								<i class="fa fa-plus" aria-hidden="true"></i> Ingresar Empleado
							</button>
							
							<button  type="button" class="btn btn-success btn-sm" id="btn_editar_datos"  >
								Editar Empleado
							</button>
							<button  type="button" class="btn btn-default btn-sm" id="btn_cancelar"  >
								Cancelar
							</button>
							<a href="../menu/Menu.php" class="btn btn-warning btn-sm " title="Volver al menu"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Volver </a>
							
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