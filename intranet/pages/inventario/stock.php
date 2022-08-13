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
 var idp=0;
 var minimo=0;
 var maximo=0;
 var limite_quitar=0;
 var accion_actual=0;
 id_producto=0;
$(document).ready(function(){
	
	
	 
	
	
	
		 //Cargar tabla
		  $("#carga_load").load("tabla_stock.php");
 		   
		  
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
			 
			formato_moneda(this)
			 
		 })
		 $("#cantidad_quitar_stock").keyup(function(){
			 
			validador_rango() 
		 })
			
		$("#btn_dlt").click(function(){
			
			quitar_stock()
		}) 
		
		$("#btn_add").click(function(){
			
			agregar_stock()
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
			text:"Está apunto de modificar el stockx, ¿Desea continuar?",
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
								stock=datos_e[6]+" ["+datos_e[3]+" - "+datos_e[4]+" ]";
								parseInt(limite_quitar=datos_e[6])
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
								
 								idp=datos_e[0]
								formato_formulario(accion);
								 
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
		
		$("#valor_venta").val(Math.round((num-(num*0.19) )*1.60));	
	    $("#valor_venta").keyup()
		
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
		
			
	}
	if(a==0)
	{
		$("#div_costo").hide(200)
		$("#div_delete").show(200)
		$("#div_agregar").hide(200)
		$("#div_valor_venta").hide(200)	
			
	}
	
	if(a==3)
	{
		$("#div_delete").hide(200)
		$("#div_agregar").hide(200)
		$("#div_costo").hide(200)
		$("#div_valor_venta").hide(200)	

		$("#nombre_producto").val("")
		$("#marca_producto").val("")
		$("#stock_producto").val("")
		$("#costo_producto").val("")
		$("#valor_venta_producto").val("")
		
		idp=0;
 		minimo=0;
		maximo=0;
 		limite_quitar=0;
 		accion_actual=0;
			
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
</script>

<style>

.input_invisible{
	
	background-color:transparent; 
	border-width:0px; 
	font-size:14px;    
	padding: 6px 12px;  
	 
}

</style>
    </head>

<body  >
<div  >
 
  <!--  -->
    <div id="div_menu"></div>
    <script>$("#div_menu").load("../global/menulateral.php");  </script>

  
  
     
    <div class="div_contenedor"> 
     
     
    
 	<h2>Stock</h2>
    <span class="carpeta" style="padding:0; font-size:13px; margin-top:0px; color:#337ab7;"> Inicio /producto/stock </span>
    <hr>
				  
		<div class="container-fluid">
		 		
			
            	<div id="div_contenedor_stock" class="panel panel-primary">
                  	<div class="panel-heading"> Agregar stock producto</div>
                    <div class="panel-body">
                    	<form id="frm_modificar_stock" name="frm_modificar_stock">
                        			 
                               <div class="col-md-2">
									<label for=""> producto </label> 
									 <input type="text" id="nombre_producto" name="nombre_producto" class="input_invisible" readonly  >
                                </div>
                       			 <div class="col-md-2">
									<label for=""> Marca </label> 
									 <input type="text" id="marca_producto" name="marca_producto" class="input_invisible"  readonly >
                                </div>
                        		
                                <div class="col-md-2">
									<label for=""> Stock </label> 
									 <input type="text" id="stock_producto" name="stock_producto" class="input_invisible"  readonly >
									 <strong></strong>	
                                </div>
                                <div class="col-md-2" id="div_costo">
									<label for=""> Costo </label> 
									<input type="text"	 id="costo_producto" name="costo_producto" class="form-control"  >
                                </div>
                                <div class="col-md-2" id="div_valor_venta">
									<label for=""> valor venta </label> 
									<input type="text"	 id="valor_venta_producto" name="valor_venta_producto" class="input_invisible"  >
                                </div>
                                <div class="col-md-1">
									<label for=""> Cantidad </label> 
									<input type="text" id="cantidad_quitar_stock" name="cantidad_quitar_stock"  class="form-control">
                                </div>
                               <div class="col-md-1" id="div_agregar">
                                  <br><button type="button" class="btn btn-success"   id="btn_add">Agregar</button>
                                  </div>
				  				<div class="col-md-1" id="div_delete">
                                  <br><button type="button" class="btn btn-success"   id="btn_dlt">Quitar</button>
                                  </div>
                                 <script>
								 $("#div_agregar").hide()
								 $("#div_delete").hide()
								 
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