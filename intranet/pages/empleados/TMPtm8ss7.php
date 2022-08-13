<?
include("../../functions/funciones.php");
conecta_bd();	
	
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
     
	
   <script>
	valida_pass=0
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
		   
		   
		   
		  // ------- Guardar Datos -----//
		   $("#form_empleado").submit(function(event){
			   
			   event.preventDefault();
			   
			});   
			   
			
		    $("#btn_guardar_datos").onclick(function(event){
			  
			   if(valida_pass==1){
				   
				   	var datos = $("#form_empleado").serialize()+"&accion=guardar_empleado";							
																								
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
												
								alert(msj); 
								limpiar_empleado()
								
							},
																	
							});
				   
				   
			   }else{
				   
				   alert("Las contraseñas no coinciden")
				   
			   }
			 
			  });  
		   
		  
		   
		   
		   //---- Rescatar datos para editar -------//
		   
		   $("#form_empleado").submit(function(event){
			   
			   event.preventDefault();
			   if(valida_pass==1){
				   
				   	var datos = $("#form_empleado").serialize()+"&accion=guardar_empleado";							
																								
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
												
								alert(msj);
								limpiar_empleado()
								
							},
																	
							});
				   
				   
			   }else{
				   
				   alert("Las contraseñas no coinciden")
				   
			   }
			 
			   
		   })
		  
		   
		   
		   
	   });
	  
	   
	   
	   function limpiar_empleado(){
		   
		   $("#nombre_empleado").val("");
		   $("#rut_empleado").val("");
		   $("#fono_empleado").val("");
		   $("#pass_empleado").val("");
		   $("#pass2_empleado").val("");
		   $('#permiso_empleado option:eq(0)').attr('selected', 'selected')
		    
	   }
	    
	   
	  
	</script>

    
    </head>

<body  >
<div class="cont">
 <div id="div_menu"></div>
    <script>$("#div_menu").load("../global/menulateral.php");  </script>

  
  
     
    <div class="div_contenedor"> 
     
     
    
 	<h2>Empleados</h2>
    <span class="carpeta" style="padding:0; font-size:13px; margin-top:0px; color:#337ab7;"> Inicio /Empleado </span>
    <hr>
				  
		<div class="container-fluid">
		 		
			
      			<div id="id_contenedor_gestion_u" class="panel panel-primary">
                  	<div class="panel-heading">Agregar Usuario</div>
                    <div class="panel-body">
						<form id="form_empleado" name="form_empleado"  >



							<div class="row" style="margin-bottom: 10px">
							
							    <div class="col-md-1">Nombre</div>
							  <div class="col-md-3">
							  	<input type="text" id="nombre_empleado"   name="nombre_empleado"  class="form-control" required>
							  </div>
							  
							  <div class="col-md-1">Rut</div>
							  <div class="col-md-3">
							  	<input type="text" id="rut_empleado"  name="rut_empleado"  class="form-control" required>
							  </div> 
							 
							
								<div class="col-md-1">Teléfono</div>
							  <div class="col-md-3">
							  	<input type="text" id="fono_empleado"  name="fono_empleado"  class="form-control" required>
							  </div>
						   </div>
						   
						   <div class="row">
							   <!--  -->
						     <div class="col-md-1">Contraseña</div>
							  <div class="col-md-3">
							  	<input type="password" id="pass_empleado" name="pass_empleado"  class="form-control" required>
							  	
							  </div>
						     
						     <div class="col-md-1">Repetir Contraseña</div>
							  <div class="col-md-3">
 
								  <div id="div_pass2_empleado" class="form-group has-feedback">
									<input type="password" class="form-control" id="pass2_empleado" name="pass2_empleado" aria-describedby="inputSuccess4Status" required>
									<span class="glyphicon  form-control-feedback" id="icon_pass2_empleado" aria-hidden="true"></span>
								  
 								  </div>
								  
 							  </div>
						     
						     
						      <div class="col-md-1">Permisos</div>
							 	 <div class="col-md-3">
									<select id="permiso_empleado" name="permiso_empleado" class="form-control" required>

										<option value >Seleccione Permiso</option>
										<option value="Administrador" >Administrador</option>
										<option value="Secretaria">Secretaria</option>
									</select>
								</div>
								
								
								
								
								
								
								
							</div><!-- End Row -->
							
							<button style="width: 240px" type="submit" class="btn btn-primary btn-lg" id="btn_guardar_datos"  >
								<i class="fa fa-plus" aria-hidden="true"></i> Agregar Empleado
							</button>

						 
							   
							  
					
					
						</form>
					</div>
      				
      			</div>
       		
       	 
       		
        		<div id="carga_load">
        			
        				
        		
		     	</div>
         
  
       </div>

	<footer id="footer"> </footer>
</body>
</html>