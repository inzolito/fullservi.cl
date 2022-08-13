<?
include("../../functions/funciones.php");
conecta_bd();	
	
	
//echo "---".hora_actual();
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
 var idp=0;
 $(window).load(function() {

		$(".loader").fadeOut("slow");
	});
	
$(document).ready(function(){
	
	
	 
	
	
	
		 //Cargar tabla
		  $("#carga_load").load("tabla_inventario.php");
 		   
		  
		 $("#btn_cancelar").click(function(){
			 
			 	formato_formulario(1);	
		 });
		
		$("#btn_editar_datos").click(function(){
			
			editar_datos()
		});
		  
		 $("#form_producto").submit(function(event){
			event.preventDefault() 
			
			var datos = $("#form_producto").serialize()+"&accion=guardar_producto";							
																								
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
							 
								swal(msj)
								if(msj==1){
									
									swal("Datos guardados satisfactoriamente.", "","success") 
									formato_formulario(1)
								}else if(msj==0){
									
									swal("El producto no está registrado en el sistema, cargue la pagina nuevamente.", "","warning") 
									
								}else if(msj==2){
									
									swal("Ya existe un producto con ese nombre " , "","warning") 
									
								}else{
									swal("Hubo un error en el proceso, revise que los datos sean los correctos "+msj , "","warning") 
									
								}
								
								
								
								
							},
																	
							});
		 })
		 
		 
		 
		 
		 //-----------  precio ----------------//
		 $("#precio_producto").keyup(function(){
			 
			formato_moneda(this)
			calcular_venta() 
		 })
		 
		 $("#valor_venta").keyup(function(){
			 
			formato_moneda(this)
			 
		 })
			 
		  // ------ funciones numero --------
		  
		  $("#min_producto").keyup(function(){
			 
			  
			formato_numero(this)
			  
		  });
		  $("#max_producto").keyup(function(){
			  
			  
			formato_numero(this)
			  
		  });
		  $("#stock_real_producto").keyup(function(){
			 
			  
			formato_numero(this)
			  
		  });
		  
		  //-----------------------------------// 
});
		   	 
		 
			
	 function editar_datos()
	 {
		 
		 swal({
			title: "¿Está seguro?",
		  	text: "Está apunto de guardar los cambios del producto.¿ Realmente desea continuar?",
		  	type: "warning",
		  	showCancelButton: true,
		  	confirmButtonText: "Editar",
		  	closeOnConfirm: false
			
			
		},
		function(){
				  
				   var datos = $("#form_producto").serialize()+"&id_producto="+idp+"&accion=editar_producto";							

								$.ajax({
									type: "POST",
									url: "ajax/procesos.php",
									data: datos,
									success: function(msj) {
										
											if(msj==1)
											{
												swal("Datos Guardados satisfactoriamente", "", "success");
												formato_formulario(1)
											}else{
												if(msj==2)
												{
													swal("El producto no existe. Actualice la página e intentelo de nuevo.", "", "warning");

													
												}else{
													if(msj==0)
													{
														swal("Ya existe otro producto con el nombre Y marca que intenta guardar"+msj, "", "warning");
													}else{
														swal("Hay un error  en los datos, reviselos e intentelo de nuevo"+msj, "", "warning");
															
													}
												}
												
											}
											 
											

									},

									});
					
				 
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
								$("#marca_producto").val(datos_e[2])
								$("#min_producto").val(datos_e[3])
								$("#max_producto").val(datos_e[4])
								
								$("#precio_producto").val(datos_e[5])
								$("#precio_producto").keyup() 
								
								$("#stock_real_producto").val(datos_e[6])
								
								 
								$("#valor_venta").val(datos_e[7])
								$("#txt_descripcion").val(datos_e[8])	
								$("#valor_venta").keyup()
								$("#stock_real_producto").keyup()
								$("#min_producto").keyup()
								$("#max_producto").keyup()
								
 								idp=datos_e[0]
								formato_formulario(2);
								 
							},
																	
							});
		
		}
		)
		
		 	
				   
	} 	
		
		
function calcular_venta()
	{
		num=$("#precio_producto").val();
		num=num.replace(/\$/g, '');
 		num=num.replace(/\./g, '');
  		num=num.replace(/\,/g, '');
		
	
		$("#valor_venta").val(Math.round(((num/1.19) )*1.60));	
	    $("#valor_venta").keyup()
		
	}
   
function formato_formulario(f){
		   if(f==1){
			   
  			  $("#carga_load").load("tabla_inventario.php");
		   	   datos_validados=0;
		   	   $("#nombre_producto").val(""); 
		   	   $("#precio_producto").val("");
			   $("#marca_producto").val("");
			   $("#min_producto").val("");
			   $("#max_producto").val("");
			   
			   $("#stock_real_producto").val("")
			   
			   
			   $("#btn_guardar_datos").show(200);
		   	   $("#btn_editar_datos").hide(200);
		   	   $("#btn_cancelar").hide(200);
 			   $("#carga_load").show(200)
			   $("#div_subtitulo").html("Agregar producto")
		   }else{
			   
			   if(f==2)
				{  
					$("#carga_load").hide(200)
					$("#btn_guardar_datos").hide(200);
					$("#btn_editar_datos").show(200);
					$("#btn_cancelar").show(200)
 					$("#div_subtitulo").html("Editar producto")
				}else{
					
					
					
				}
			   
		   }
		   
		   
	}

function agregar_stock()
{
	swal({
	  title: "Agregar stock",
	  text: "cuanta cantidad desea agregar?",
	  type: "input",
	  showCancelButton: true,
	  closeOnConfirm: false,
	  animation: "slide-from-top",
	  inputPlaceholder: "Write something"
	},
	function(inputValue){
	  if (inputValue === false) return false;
	  
	  if (inputValue === "") {
		swal.showInputError("You need to write something!");
		return false
	  }
	  
	  swal("Nice!", "You wrote: " + inputValue, "success");
	});	
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
    
    <h2>Productos</h2>
    <span class="carpeta" style="padding:0; font-size:13px; margin-top:0px; color:#337ab7;"> Inicio /Menu /Registrar producto </span>
    <hr>
     <div id="id_contenedor_gestion_u" class="panel panel-default">
                
                
                
                
          
                    <div class="panel-body">
						<fieldset><legend><h4> Crear Producto</h4> </legend> </fieldset>
						<form id="form_producto" name="form_producto"  >
							
                            <div class="row">
 						 
 									 <div class="col-md-3">
										<label for="nombre_producto"> producto (*)</label> 
										<input type="text" id="nombre_producto"   name="nombre_producto"  class="form-control" required>
									  </div>

									  
									 <div class="col-md-3">
										<label for="marca_producto"> Marca  (*)</label>
										<input type="text" id="marca_producto"  name="marca_producto" list="data_marcas_producto"  class="form-control"  required>
                                        <datalist id="data_marcas_producto" >
                                        	<?php
                                        		
												$marca_productos=mysql_query("select * from productos order by marca_producto asc");
												while($marca_productos_datos=mysql_fetch_array($marca_productos) )
                                        		{
													
													?> <option value="<? echo $marca_productos_datos["marca_producto"] ?>" > <?	
													
												}
                                        	?>
                                        </datalist>
									  </div>
                                      
                                      
                                      <div class="col-md-2">
										<label for="precio_producto"> Costo (*) </label>
										<input type="text" id="precio_producto"   name="precio_producto"  class="form-control"  required>

									  </div>
                                      <div class="col-md-2">
										<label for="valor_venta"> Valor de venta (*) </label><br>
                                        <input type="text"  id="valor_venta" name="valor_venta"  class="form-control"  required >
									  </div>
                                     
                                      <div class="col-md-1">
										<label for="marca_producto"> Stock Mín.(*) </label>
										<input type="num" id="min_producto"  name="min_producto"  class="form-control"  required>

									  </div>
                                      
                                      <div class="col-md-1">
										<label for="marca_producto"> Stock máx.(*) </label>
										<input type="num" id="max_producto"	  name="max_producto"  class="form-control"  required>

									  </div>
								 
                       		  <div class="col-md-6">
                                      		<label for="txt_descripcion">Descripcion del producto </label>
								  <textarea name="txt_descripcion" class="form-control" id="txt_descripcion" style="resize: none" maxlength="250"> </textarea>
										  </div>
									
										
							</div>
                            
                            
							<br>                         
						
							<!-- End Row -->
							
							<button  type="submit"  class="btn btn-primary btn-sm" id="btn_guardar_datos"  >
								<i class="fa fa-plus" aria-hidden="true"></i> <Crear></Crear> producto
							</button>
							<a href="../menu/Menu.php" class="btn btn-warning btn-sm " title="Volver al menu"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Volver </a>
							
							<button type="button" class="btn btn-success btn-sm"  id="btn_editar_datos"  >
								Editar producto
							</button>
							<button  type="button" class="btn btn-default btn-sm" id="btn_cancelar"  >
								Cancelar
							</button>
					
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
    
	</div>
	</div>    
     
    
 	
				  
			
			
            	 
            
      			
       		
       	 
       		
        		
         
  
   
 
	<footer id="footer"> </footer> <!-- <-->
</body>
</html>