<?
include("../../functions/funciones.php");
conecta_bd();	
	
?>
<!doctype html>
<html>
<head>
 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title>Menu Sistema</title>
        <script type="text/javascript" src="../../js/jquery-1.10.1.min.js"></script>

 
  <link rel="stylesheet" href="../../css/LateralStyle.css" title="style css" type="text/css" media="screen" charset="utf-8">
	    <link rel="stylesheet" href="../../libraries/fonts/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="../../libraries/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="../../libraries/bootstrap/css/bootstrap-theme.css">
		<link rel="stylesheet" href="../../libraries/bootstrap/css/bootstrap.css">
        
       
         <link rel="stylesheet" href="../../css/estilos.css" type="text/css">
         <link rel="stylesheet" href="../../css/bootstrap-datepicker.css"/>
 		 <link rel="stylesheet" href="../../css/sweetalert.css"> 
       
        
       <script type="text/javascript" src="../../js/sweetalert-dev.js"></script>
        
  		<script src="../../libraries/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../js/sysscripts/validator.js"></script>	
     
	
   <script>

	datos_validados=0
 	estado_producto=0
  	ideditar=0
	   $(document).ready(function(){
		 // formato_moneda()
		 
		   //Cargar tabla
		   $("#carga_load").load("tabla_productos.php");
 		    
		   
		  // ------- Validar Form-----//
		  $("#form_producto").submit(function(event){
			   //alert(datos_validados)
			   event.preventDefault()
			   datos_validados=1;  
			   //alert(datos_validados)
		   });   
			   
			//---  Guardar Datos ----//
		    $("#btn_guardar_datos").click(function(){
			   
		 		$("#form_producto").submit();
				
			 	if(datos_validados==1)
				{
					guardar_datos();		
					 
				}else{
					
					 
				}
			});  
		   
		   //---- Editar Datos  ----//
		  	$("#btn_editar_datos").click(function(){
				$("#form_producto").submit();
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
			    if($("#nombre_producto").val()!="" && $("#precio_producto").val()!="" )
					{
				   	var datos = $("#form_producto").serialize()+"&accion=guardar_producto";							
																								
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
							 
							  
								if(msj==1){
									
									swal("Datos guardados satisfactoriamente.", "","success") 
									formato_formulario(1)
								}else if(msj==0){
									
									swal("El producto no está registrado en el sistema, revise.", "","warning") 
									
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
		  	text: "Está apunto de guardar los cambios del producto.¿ Realmente desea continuar?",
		  	type: "warning",
		  	showCancelButton: true,
		  	confirmButtonColor: "#DD6B55",
		  	confirmButtonText: "Eliminar",
		  	closeOnConfirm: false
			
			
		},
		function(){
				if(datos_validados==0){  
				   var datos = $("#form_producto").serialize()+"&id_producto="+id+"&accion=editar_producto";							

								$.ajax({
									type: "POST",
									url: "ajax/procesos.php",
									data: datos,
									success: function(msj) {
											if(msj==0)
											{
												swal("Datos Guardados satisfactoriamente", "", "success");

											}

									},

									});
					
				}else{
					swal("Complete los datos faltantes","","warning")
				   datos_validados=0;
					
				}
		 });
			  
	   }
	   
	   
	   
	function cargar_producto(id){
		ideditar=0;
		 
		
		swal({
			title:"Importante!",
			text:"Si cambia el nombre del producto debe ser solo para correcciones, si desea ingresar otro producto hagalo en 'Agregar producto', ¿Desea continuar?",
			type:"warning",
			showCancelButton:true,
			
			
		},
		function(){
			
			var datos = "id_producto="+id+"&accion=cargar_producto";							
																								
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
			 
								datos_e=msj.split("-separate-");				 
				
								$("#nombre_producto").val(datos_e[1])
								$("#precio_producto").val(datos_e[3])
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
			   
			   $("#carga_load").load("tabla_productos.php");
		   	   datos_validados=0;
		   	   $("#nombre_producto").val("");
		   	   $("#precio_producto").val("");
			   $("#btn_guardar_datos").show(200);
		   	   $("#btn_editar_datos").hide(200);
		   	   $("#btn_cancelar").hide(200);
			   $("#div_contenedor_fecha_ultima_modificacion").hide(200)
			   $("#carga_load").show(200)
			   $("#div_subtitulo").html("Agregar producto")
		   }else{
			   
			   if(f==2)
				{
					/**/
					$("#precio_producto").keyup();
					$("#carga_load").hide(200)
					$("#btn_guardar_datos").hide(200);
					$("#btn_editar_datos").show(200);
					$("#btn_cancelar").show(200)
					$("#div_contenedor_fecha_ultima_modificacion").show(200)
					$("#div_subtitulo").html("Editar producto")
				}else{
					
					
					
				}
			   
		   }
		   
		   
	}
	
    
	   
</script> 
    </head>

<body  >

 
  <!--  -->
    <div id="div_menu"></div>
    <script>$("#div_menu").load("../global/menulateral.php");  </script>

  
  
     
    <div class="div_contenedor"> 
     
		<h2>productos</h2>
		<span class="carpeta" style="padding:0; font-size:13px; margin-top:0px; color:#337ab7;"> Inicio /producto </span>
		<hr>

			<div class="container-fluid">


					<div id="id_contenedor_gestion_u" class="panel panel-primary">


						 <div class="col-md-12"> 
							<fieldset><legend id="div_subtitulo">Agregar producto</legend> </fieldset>
							</div> 

						  <div class="panel-body">
							<form id="form_producto" name="form_producto"  >



								<div class="row" style="margin-bottom: 10px">

									  <div class="col-md-3">
										<label for="nombre_producto"> producto </label> 
										<input type="text" id="nombre_producto"   name="nombre_producto"  class="form-control"  rerequired>
									  </div>

									  
									 <div class="col-md-3">
										<label for="marca_producto"> Marca </label>
										<input type="text" id="marca_producto"  name="marca_producto"  class="form-control"  required>

									  </div>
                                      
                                      <div class="col-md-1">
										<label for="marca_producto"> Stock máximo </label>
										<input type="num" id="max_producto"  name="max_producto"  class="form-control"  required>

									  </div>
                                      
                                      <div class="col-md-1">
										<label for="marca_producto"> Stock Mínimo </label>
										<input type="num" id="min_producto"  name="min_producto"  class="form-control"  required>

									  </div>
                                      
                                      <div class="col-md-3">
										<label for="precio_producto"> Valor </label>
										<input type="text" id="precio_producto" onKeyUp="formato_moneda(this)" name="precio_producto"  class="form-control"  required>

									  </div>

                                      
                                      
                                      
									 <div class="col-md-3" id="div_contenedor_fecha_ultima_modificacion">
										<label for="div_fecha_ultima_modificacion"> Ultima modificacion </label>
											<div id="div_fecha_ultima_modificacion">

											</div> 

									 </div>
								 
								</div>
						</form>
								<!-- End Row --> 
										<button style="width: 230px" type="button" class="btn btn-primary btn-lg" id="btn_guardar_datos"  >
											<i class="fa fa-plus" aria-hidden="true"></i> Agregar producto
										</button>

										<button style="width: 230px" type="button" class="btn btn-success btn-lg" id="btn_editar_datos"  >
											Editar producto
										</button>

										<button style="width: 230px" type="button" class="btn btn-default btn-lg" id="btn_cancelar"  >
											Cancelar
										</button>







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
 
	<footer id="footer"> </footer> <!-- <-->
</body>
</html>