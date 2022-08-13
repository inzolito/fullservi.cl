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
   $(window).load(function() {

		$(".loader").fadeOut("slow");
	});
	datos_validados=0
 	estado_trabajo=0
  	ideditar=0
	
	   $(document).ready(function(){
		 // formato_moneda()
		  
		   //Cargar tabla
		   $("#carga_load").load("tabla_trabajos.php");
 		    
		   
		  // ------- Validar Form-----//
		  $("#form_trabajo").submit(function(event){
			   //alert(datos_validados)
			   event.preventDefault()
			   datos_validados=1;  
			   //alert(datos_validados)
		   });   
			   
			//---  Guardar Datos ----//
		    $("#btn_guardar_datos").click(function(){
			   
		 		$("#form_trabajo").submit();
				
			 	if(datos_validados==1)
				{
					guardar_datos();		
					 
				}else{
					
					 
				}
			});  
		   
		   //---- Editar Datos  ----//
		  	$("#btn_editar_datos").click(function(){
				$("#form_trabajo").submit();
				if(datos_validados==1)
				{
					editar_datos(ideditar);		
				}
				
			})
			
			
			//---- Boton Cancelar ----// 
			$("#btn_cancelar").click(function(){
				
				formato_formulario(1)
			});

		   
		   
		   
	   });
	  
 
 
	    
	   
	function guardar_datos(){
		   
	 
		   
		
		
				// debe ser ==1
			    if($("#nombre_trabajo").val()!="" && $("#precio_trabajo").val()!="" )
					{
				   	var datos = $("#form_trabajo").serialize()+"&accion=guardar_trabajo";							
																								
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
							 
							  
								if(msj==1){
									
									swal("Datos guardados satisfactoriamente.", "","success") 
									formato_formulario(1)
								}else if(msj==0){
									
									swal("El trabajo no está registrado en el sistema, revise.", "","warning") 
									
								}else{
									
									swal("Hubo un error en el proceso, revise que los datos sean los correctos "+msj , "","warning") 
									
								}
								
								
								
								
							},
																	
							});
				   
				   
			   }else{
				   
				   swal("Complete los datos faltantes","","warning")
				   	
				   datos_validados=0;
			   }
		   
	   }
 
	
	 function editar_datos(id)
	 {
		 
		 swal({
			title: "¿Está seguro?",
		  	text: "Está apunto de guardar los cambios del trabajo.¿ Realmente desea continuar?",
		  	type: "warning",
		  	showCancelButton: true,
		  	confirmButtonColor: "#337ab7",
		  	confirmButtonText: "Guardar",
		  	closeOnConfirm: false
			
			
		},
		function(){
				if(datos_validados==1){  
				   var datos = $("#form_trabajo").serialize()+"&id_trabajo="+id+"&accion=editar_trabajo";	
					

								$.ajax({
									type: "POST",
									url: "ajax/procesos.php",
									data: datos,
									success: function(msj) {
										swal(msj)
											if(msj==1)
											{
												swal("Datos Guardados satisfactoriamente", "", "success");
												
													formato_formulario(1)
											}

									},

									});
					
				}else{
					swal("Complete los datos faltantes","","warning")
				   datos_validados=0;
					
				}
		 });
			  
	   }
	   
	   
	   
	function cargar_trabajo(id){
		ideditar=0;
		 
		
		swal({
			title:"Importante!",
			text:"Si cambia el nombre del trabajo debe ser solo para correcciones, si desea ingresar otro trabajo hagalo en 'Agregar Trabajo', ¿Desea continuar?",
			type:"warning",
			showCancelButton:true,
			
			
		},
		function(){
			
			var datos = "id_trabajo="+id+"&accion=cargar_trabajo";							
																								
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
			 
								datos_e=msj.split("-separate-");				 
				
								$("#nombre_trabajo").val(datos_e[1])
								$("#precio_trabajo").val(datos_e[3])
								$("#div_fecha_ultima_modificacion").html(datos_e[2])
								 formato_formulario(2);
 								 ideditar=datos_e[0]
							},
																	
							});
		
		}
		)
		
		 	
				   
	}
	

	   
	function formato_formulario(f){
		   if(f==1){
			   
			   $("#carga_load").load("tabla_trabajos.php");
		   	   datos_validados=0;
		   	   $("#nombre_trabajo").val("");
		   	   $("#precio_trabajo").val("");
			   $("#btn_guardar_datos").show(200);
		   	   $("#btn_editar_datos").hide(200);
		   	   $("#btn_cancelar").hide(200);
			   $("#div_contenedor_fecha_ultima_modificacion").hide(200)
			   $("#carga_load").show(200)
			   $("#div_subtitulo").html("Agregar trabajo")
		   }else{
			   
			   if(f==2)
				{
					/**/
					$("#precio_trabajo").keyup();
					$("#carga_load").hide(200)
					$("#btn_guardar_datos").hide(200);
					$("#btn_editar_datos").show(200);
					$("#btn_cancelar").show(200)
					$("#div_contenedor_fecha_ultima_modificacion").show(200)
					$("#div_subtitulo").html("Editar trabajo")
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
     
		<h2>Trabajos</h2>
		<span class="carpeta" style="padding:0; font-size:13px; margin-top:0px; color:#337ab7;"> Inicio /Menu /Trabajos </span>
		<hr>

			


					<div id="id_contenedor_gestion_u" class="panel panel-default">


						 

						  <div class="panel-body">
						  
						  <fieldset><legend id="div_subtitulo">Agregar Trabajo</legend> </fieldset>
							<form id="form_trabajo" name="form_trabajo"  >



								<div class="row" style="margin-bottom: 10px">

									  <div class="col-md-3">
										<label for="nombre_trabajo"> Trabajo </label> 
										<input type="text" id="nombre_trabajo"   name="nombre_trabajo"  class="form-control"  rerequired>
									  </div>

									  <div class="col-md-3">
										<label for="precio_trabajo"> Valor </label>
										<input type="text" id="precio_trabajo" onKeyUp="formato_moneda(this)" name="precio_trabajo"  class="form-control"  required>

									  </div>


									 <div class="col-md-3" id="div_contenedor_fecha_ultima_modificacion">
										<label for="div_fecha_ultima_modificacion"> Ultima modificacion </label>
											<div id="div_fecha_ultima_modificacion">

											</div> 

									 </div>
								 
								</div>
						</form>
								<!-- End Row --> 
										<button  type="button" class="btn btn-primary btn-sm" id="btn_guardar_datos"  >
											<i class="fa fa-plus" aria-hidden="true"></i> Agregar trabajo
										</button>

										<button type="button" class="btn btn-success btn-sm" id="btn_editar_datos"  >
											Editar trabajo
										</button>

										<button  type="button" class="btn btn-default btn-sm" id="btn_cancelar"  >
											Cancelar
										</button>

										
										<a href="../menu/Menu.php"  class="btn btn-warning btn-sm "  title="Volver al menu"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Volver </a>
											





								<script>
									$("#div_contenedor_fecha_ultima_modificacion").hide();
									$("#btn_editar_datos").hide()
									$("#btn_cancelar").hide();
								</script>





							
						</div>

					</div>


        			

					<div id="carga_load"  style="margin-bottom: 100px">



					</div>


		   


	</div>
	</div>
	</div>
	<footer id="footer"> </footer> <!-- <-->
</body>
</html>