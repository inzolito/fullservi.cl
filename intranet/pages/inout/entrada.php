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
        
        	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
  
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.colVis.min.js"></script>
		<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
		
 <script>
 var idp=0;
 var minimo=0;
 var maximo=0;
 var limite_quitar=0;
 var accion_actual=0;
 id_producto=0;
	 
	  $(window).load(function() {

		$(".loader").fadeOut("slow");
	});
	
	 
$(document).ready(function(){
	
	
	 $("#frm_modificar_stock").submit(function(event){
			   	
			   		event.preventDefault()
					agregar_stock()
			
					
		   })
	
	
	
		 //Cargar tabla
		  $("#carga_load").load("tabla_entrada.php");
 		   
		  
		 $("#btn_cancelar").click(function(){
			 
			 	formato_formulario(1);	
		 });
		
		 
		 
		 
		 
		 $("#form_producto").submit(function(event){
			event.preventDefault() 
			
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
		 $("#costo_producto").keyup(function(){
			 
			formato_moneda(this)
 		 })
		 
		 $("#valor_venta_producto").keyup(function(){
			
			calcular_total() 
			formato_moneda(this)
			
			 
		 })
		 
		 
		 $("#cantidad_quitar_stock").keyup(function(){
			 
			validador_rango()
			calcular_venta() 
		 })
		
		$("#cantidad_quitar_stock").blur(function(){
			
			//$("#cantidad_quitar_stock").val(1)
 			calcular_venta() 
			
		})
			
		$("#btn_dlt").click(function(){
			
			quitar_stock()
		}) 
		
		
		  // ------ funciones numero --------
		  
		   
		  
		  //-----------------------------------// 
});
		   	 
		 
		 
function agregar_stock()
{
	
	
		swal({
			title:"Importante!",
			text:"Está apunto de  Agregar productos al stock , ¿Desea continuar?",
			type:"warning",
			showCancelButton:true,
			
			
		},
		function(){
			
			
						var datos = $("#frm_modificar_stock").serialize()+"&id_producto="+id_producto+"&accion=agregar_stock";							
																							
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
 							  		
								if(msj==1){
									
									swal("Datos guardados satisfactoriamente.", "","success");
									
									formato_formulario(3)
								}else if(msj==0){
									
									swal("El producto no está registrado en el sistema, cargue la pagina nuevamente.", "","warning") 
									
								}else if(msj==2){
									
									swal("Ya existe un producto con ese nombre " , "","warning") 
									
								}else{
									swal("Hubo un error en el proceso, revise que los datos sean los correctos "+msj , "","warning") 
									
								}
								
								
								
								
							},
																	
							});
		});
	
}	 
		 
function quitar_stock()
{
	
	
		swal({
			title:"Importante!",
			text:"Está apunto de  reducir el stock , ¿Desea continuar?",
			type:"warning",
			showCancelButton:true,
			
			
		},
		function(){
			
			
						var datos = $("#frm_modificar_stock").serialize()+"&id_producto="+id_producto+"&accion=quitar_stock";							
																						
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
 							  
								if(msj==1){
									
									swal("Datos guardados satisfactoriamente.", "","success") 
									formato_formulario(3)
								}else if(msj==0){
									
									swal("El producto no está registrado en el sistema, cargue la pagina nuevamente.", "","warning") 
									
								}else if(msj==2){
									
									swal("Ya existe un producto con ese nombre " , "","warning") 
									
								}else{
									swal("Hubo un error en el proceso, revise que los datos sean los correctos "+msj , "","warning") 
									
								}
								
								
								
								
							},
																	
							});
		});
	
}
		   
function cargar_producto(accion,id){
		ideditar=0;
		 
		
		swal({
			title:"Importante!",
			text:"Está apunto de modificar el stock, ¿Desea continuar?",
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
								
								if(datos_e[4]==""){
									datos_e[4]=0
								}
								stock=datos_e[6]+" ["+datos_e[3]+" - "+datos_e[4]+" ]";
								parseInt(limite_quitar=datos_e[9])
								id_producto=datos_e[0]
								
								$("#nombre_producto").val(datos_e[1])
								$("#marca_producto").val(datos_e[2])								
								$("#costo_producto").val(datos_e[5])
								$("#stock_producto").val(stock)
								
								
								$("#costo_producto").keyup() 
								$("#valor_venta_producto").val(datos_e[7])
								
								
								$("#valor_venta_producto").keyup()
								$("#stock_real_producto").keyup()
								
								
								$("#min_producto").keyup()
								$("#max_producto").keyup()
								
								$("#cantidad_quitar_stock").val(1)
 								idp=datos_e[0]
								formato_formulario(accion);
							    calcular_venta()
								calcular_total()
							},
																	
							});
		
		}
		)
		
		 	
				   
	} 	
		
		
function calcular_venta()
	{
		num=$("#costo_producto").val();
		num=num.replace(/\$/g, '');
 		num=num.replace(/\./g, '');
  		num=num.replace(/\,/g, '');
		
		//$("#valor_venta_producto").val(Math.round((num-(num/1.19) )*1.60));	
	    $("#valor_venta_producto").keyup()
		
	}
 

function formato_formulario(a)
{
	accion_actual=a
	if(a==1)
	{
		$("#div_delete").hide(200)
		$("#div_agregar").show(200)
		$("#div_costo").show(200)
		$("#div_valor_venta").show(200)
							$("#div_contenedor_stock").show(200)

			
	}
	 
	
	if(a==3)
	{
		/*$("#div_contenedor_stock").hide(200)
		$("#div_delete").hide(200)
		$("#div_agregar").hide(200)
		$("#div_costo").hide(200)
		$("#div_valor_venta").hide(200)	*/

		$("#nombre_producto").val("")
		$("#marca_producto").val("")
		$("#stock_producto").val("")
		$("#costo_producto").val("")
		$("#valor_venta_producto").val("")
		
		//$("#cod_documento").val("")
		$("#total").val("")
		$("#cantidad_quitar_stock").val("")
		
		$("#carga_load").load("tabla_entrada.php");

		
		idp=0;
 		minimo=0;
		maximo=0;
 		limite_quitar=0;
 		accion_actual=0;
			
	}
	if(a==4){
		$( "#carga_load" ).load( "tabla_hproducto_entrada.php", { "producto": idp } );
	}
	
	
}


function modificar_stock(accion,id)
{
	 cargar_producto(accion,id)
		
		 
 

	
}

function validador_rango()
{
	if(accion_actual==0)
	{
		
  		c=parseInt($("#cantidad_quitar_stock").val())

		if(c>limite_quitar)
		{
					

			 swal("La cantidad que intenta quitar es mayor a la del stock actual", "Ingrese una cantidad correcta.")	
			$("#cantidad_quitar_stock").val("")	
		
		}else{
			
			if(c<=0 && c!="" && C!=" ")
			{
				 swal("No es posible quitar "+ c+" productos", "Ingrese una cantidad correcta.")	
				$("#cantidad_quitar_stock").val("")	
			}
		
		
		}
		
		
	}
	
}
	
	
function carga_historial(id){
		 idp=id
		 $( "#carga_load" ).load( "tabla_hproducto_entrada.php", { "producto": id } );
		 
	 }
	 
	 
function calcular_total(){
		num=$("#valor_venta_producto").val()
		num=num.replace(/\$/g, '');
 		num=num.replace(/\./g, '');
  		num=num.replace(/\,/g, '');
		
		cant=$("#cantidad_quitar_stock").val()
		if(cant>=1)
		{
		}else{
			
			cant=0	
		}
		$("#total").val(Math.round((num*cant) ));
	
	
	    $("#total").keyup()
}
	 
 function anular_entrada(id){
		 
		 	dato_array=id.split("_");
	
	swal({
  title: "Desea Anular la Entrada seleccionada",
  text: "La operacion no podrá ser revertida",
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
  title: "Motivo de anulación de a entrada del producto seleccionado",
  text: "Digite el motivo por el cual anula la entrada del producto seleccionado",
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
 

 
	  
	var datos="historial="+dato_array[0]+"&accion=anular_hp&motivo="+inputValue
	
	$.ajax({
		
		type:"post",
		url:"ajax/procesos.php",
		data: datos,
		success: function(msj){
		swal(msj)
			if(msj==1){
			 swal("Exito!", "pago anulado Correctamente","success");
				carga_historial(idp)
			}
			
			
		}
		
		
		
	})
	 
});
  } else {
    swal("Anulación Cancelada", "", "error");
  }
});
	
		 
	 }
	 
</script>

<style>

.input_invisible{
	
	background-color:transparent; 
	border-width:0px; 
	font-size:14px;    
	padding: 6px 12px;  
	 
}
function anular_entrada

</style>
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
     
     
    
 	<h2>Entradas de Stock</h2>
    <span class="carpeta" style="padding:0; font-size:13px; margin-top:0px; color:#337ab7;"> Inicio /Menu /Entrada de stock</span>
    <hr>
				  
		
		 		
			
            	<div id="div_contenedor_stock" class="panel panel-default">
                  
                    <div class="panel-body">
						<fieldset> <legend>Entrada De Productos </legend> </fieldset>
                   	

                    	<form id="frm_modificar_stock" name="frm_modificar_stock">
                        	<div class="row"> 
								 <div class="col-md-3">
												<label for=""> producto (*)</label> 
												 <input type="text" id="nombre_producto" name="nombre_producto" class="input_invisible form-control" readonly  >
							  </div>
											 <div class="col-md-2">
												<label for=""> Marca (*)</label> 
												 <input type="text" id="marca_producto" name="marca_producto" class="input_invisible form-control"  readonly >
											</div>

											<div class="col-md-1">
												<label for=""> stock (*)</label> 
												 <input type="text" id="stock_producto" name="stock_producto" class="input_invisible form-control"  readonly >
												 <strong></strong>	
											</div>
                                            
                                            <div class="col-md-2" id="div_costo">
												<label for=""> Costo  Unitario</label> 
												(*)
												<input name="costo_producto" type="text" required="required" class="form-control"	 id="costo_producto"   >
											</div>
                                            
											<div class="col-md-2" id="div_valor_venta">
												<label for=""> valor venta (*)</label>  	 		
											  <input type="text"	 id="valor_venta_producto" name="valor_venta_producto" class=" form-control" readonly   >
											</div>
											
											
											<div class="col-md-2">
												<label for=""> Cantidad (*)</label> 
												<input name="cantidad_quitar_stock" type="text" required="required"  class="form-control" id="cantidad_quitar_stock" onKeyUp="calcular_total()">
											</div> 
									   
									   		
						</div>
                         <div class="row">
                            <div class="col-md-1" id="div_costo">
												<label for=""> Documento</label> 
												<select name="documento" required class="form-control" id="documento">
													
													<option value="Boleta">Boleta </option>
													<option value="Factura"> Factura</option>
													</select>
											</div>
											
											<div class="col-md-2">
												<label for=""> Codigo Documento (*)</label> 
												<input type="text" id="cod_documento" name="cod_documento"  class="form-control" required>
											</div> 
											
												
											<? 
							 						$sql_proveedor=mysql_query("select * from proveedores");
							 						
							 						
							 					?>
												<div class="col-md-2">
												<label for=""> Fecha (*)</label> 
												<input type="date" class="form-control" id="txt_fecha" name="txt_fecha"  value="<?php echo date('Y-m-d')?>" required> 
													</select>
											</div> 
												<div class="col-md-3">
												<label for=""> Proveedor </label> 
												<select class="form-control" name="cmb_proveedor" id="cmb_proveedor" required>
												
												
												
												<?
													if(mysql_num_rows($sql_proveedor)>0){
													
														while($datos_proveedor=mysql_fetch_array($sql_proveedor)){
															
													?>
													
													<option value="<? echo($datos_proveedor['id_proveedor']) ?>"><? echo($datos_proveedor['nombre_proveedor']) ?> </option>
													
													<?
														}
														
													}
													?>
													</select>
											</div> 
										
											
											<div class="col-md-2">
												<label for=""> Total </label> 
												<input type="text" id="total" name="total" onKeyUp="formato_moneda(this)"  class="form-control" readonly>
											</div> 
									   
									   
									   
							</div>	 
                             
                             <div class="row">
							   <div class="col-md-4" id="div_agregar ">
								   <br><button type="submit" class="btn btn-primary  btn-sm"   id="btn_add"> <i class="fa fa-plus"> </i> Agregar</button>
											  <a href="../menu/Menu.php"  class="btn btn-warning btn-sm "  title="Volver al menu"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Volver </a>
											  </div>
											  
											  		
						  </div>
										  
                              
                          <script>
								 $("#div_agregar").hide()
								 $("#div_delete").hide()
								 
								 </script>
                        </form>
                    
                    
                    </div>
                </div>
   	  <script>
					
				</script>
             
       	 
       		
        		<div id="carga_load"  style="margin-bottom: 100px">
        			
        				
        		
		     	</div>
         
  
	  </div>
	 </div>
 
	<footer id="footer"> </footer> <!-- <-->
</body>
</html>