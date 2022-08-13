<?
	include("../../functions/funciones.php");
	conecta_bd2();
valida_sesion();
	
	//$query_orden=mysql_query("select max(id_orden+1) from ordenes_trabajo");

	//$dato_orden=mysql_fetch_array($query_orden);

	
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
	   var orden=0
	   
	   var id_orden=0;
	   
	   $(window).load(function() {

		$(".loader").fadeOut("slow");
	});
	   
	 function carga_venta(){
		 
		$("#carga_load").load('publicar_venta.php'); 
		 
	 }
	    function carga_editar_venta(){
		 swal.close()
		$("#carga_load").load('editar_venta.php?'); 
		 
	 }
	
	    function cargar_vehiculos(){
		 //swal.close()
		$("#carga_load").load('tabla_vehiculos.php');
		 
	 }
	   
function publicar_vehiculo(){
 


	$("#accion").val("publicar_vehiculo")	
	
			
		swal({
		  title: "Desea Subir al sitio web el auto publicado",
		  text: "Revise los datos del vehiculo, estos serán publicados en el sitio web",
		  type: "info",
		  showCancelButton: true,
		  confirmButtonColor: "#337ab7",
		  confirmButtonText: "Si, Publicar",
		  cancelButtonText: "No, cancelar",
		  closeOnConfirm: false,
		  closeOnCancel: false
  	 

		},
		function(isConfirm){
		  if (isConfirm) {
		 
				 
			  // datos=$("#frm_publicar").serialize()+"&accion=publicar_vehiculo"
			 
			  
				/*  	*/	
				
				var data = new FormData();
				
 				for(x=1;x<=5;x++)
				{
					jQuery.each(jQuery('#file_'+x)[0].files, function(i, file) {
						data.append('file_'+x, file);
					}); 
					
					
				}	
				
				form_array=$("#frm_publicar").serializeArray()
				var dataArray = $("#frm_publicar").serializeArray(),
					dataObj = {};
				
				$(dataArray).each(function(i, field){
				  //dataObj[field.name] = field.value;
				  
				  //alert(field.name+" "+field.value)
				  data.append(field.name, field.value);
				});
				
			
				
				  $.ajax({
				  
				  type:"post",
				  url:"ajax/procesos.php",
				  data: data,
				  cache: false,
				  contentType: false,
				  processData: false,
				  success:function(msj){
						  
						   
						  swal(msj)
						 /* if(msj==1){ 
							  
							   swal("Publicado!", "El vehiculo ha sudo publicado Correctamente", "success");
								cargar_vehiculos();
						  }else{
							 
								swal("Error", "Ha ocurrido un error en el ingreso de los datos", "warning");
			 
						  }*/			  
					  }
				  })
				
				/*
				 $(form_array).each(function( index, element ) {
			 
						//alert(form_array[index])
				 });
			*/	
				 //data.append('username', form_array);
				 //data.append('username', 'Chris');
				//data.push($("#frm_publicar").serialize());
			  
				 //---------------------------------------------------------------------
				/*
				jQuery.ajax({
						url: "ajax/procesos.php",
						data: data,
						cache: false,
						contentType: false,
						processData: false,
						type: 'POST',
						success: function(msj){
							 
							 //alert(msj)
						}
				});
				*/
			//-----------------------------------------
						
				
		   
		  } else {
			
		  }
		});
		
}

function editar_publicacion(id){
	
	     id_array=id.split("_")
	
			swal({
			  title: "Desea Editar La Publicación Seleccionada",
			  text: "",
			  type: "info",
			  showCancelButton: true,
			  confirmButtonColor: "#337ab7",
			  confirmButtonText: "Si, Editar",
			  cancelButtonText: "No, cancelar",
			  closeOnConfirm: false,
			  closeOnCancel: false
				},
				function(isConfirm){
				  if (isConfirm) {
					//swal("Deleted!", "Your imaginary file has been deleted.", "success");
					   swal.close()
					  $("#carga_load").load('editar_venta.php?vehiculo='+id_array[0]);
				  } else {
					swal("Cancelado", "", "error");
				  }
		});
		
}
	   
	   
function guardar_editar_publicacion(){

	 
 	$("#accion2").val("guardar_editar")
	
	
	swal({
			  title: "Desea Guardar Los Cambios de la publicación?",
			  text: "Los cambios se verán reflejados en el sitio web",
			  type: "info",
			  showCancelButton: true,
			  confirmButtonColor: "#337ab7",
			  confirmButtonText: "Si, Guardar",
			  cancelButtonText: "No, cancelar",
			  closeOnConfirm: false,
			  showLoaderOnConfirm: true,
			  closeOnCancel: false
				},
				function(isConfirm){
				  if (isConfirm) {
						var data = new FormData();
				
						for(x=1;x<=5;x++)
						{
							jQuery.each(jQuery('#file_'+x)[0].files, function(i, file) {
								data.append('file_'+x, file);
							}); 
							
							
						}	
						
						//form_array=$("#frm_editar_publicar").serializeArray()
						var dataArray = $("#frm_editar_publicar").serializeArray(),
							dataObj = {};
						
						$(dataArray).each(function(i, field){
							  data.append(field.name, field.value);
						});

					
						  $.ajax({
							  
							  type:"post",
							  url:"ajax/procesos.php",
							  data:data,
							  cache: false,
							  contentType: false,
							  processData: false,
							  success:function(msj){
								  
 								if(msj==1){
									swal("Datos Modificados Correctamente","","success")
									cargar_vehiculos()
								}else{
									swal("Hubo un problema al guardar los datos","Intente nuevamente","error")
									
								}
								  
							  }
							  
							  
						  })
						  
				  } else {
					swal("Cancelado", "", "error");
				  }
		});
	
	
}
	   
function eliminar_venta(id){
	id_array=id.split("_")
	swal({
  title: "Desea Eliminar La publicación Seleccionada?",
  text: "esta a punto de borrar una publicación, esta no podrá ser recuperada",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si, Borrar",
  cancelButtonText: "No, cancelar",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if(isConfirm) {
  	 var datos="accion=delete_venta&vehiculo="+id_array[0]
					  $.ajax({
						  
						  type:"post",
						  url:"ajax/procesos.php",
						  data:datos,
						  success:function(msj){
							if(msj==1){
								swal("Publicación Borrada Correctamente","","success")
								cargar_vehiculos()
							}
							  
						  }
						  
						  
					  })
  } else {
    swal("Cancelado", "", "error");
  }
});
}
	</script>

    
    
 
  <style>
  .div_agregar_foto{
	      width: 100px;
    height: 100px;
    font-size: 30px;
    border: 2px solid;
    border-color: rgba(255, 0, 0, 0.45);
    border-radius: 5px;
    padding-top: 28px;
    color: #c75c5c;
    -moz-box-shadow: -2px 2px 5px #000000;
    -webkit-box-shadow: -2px 2px 5px #000000;
    box-shadow: -2px 2px 5px #000000;
	    display: inline-block;
    margin: 5px;
	
	-webkit-transition: all 0.2s linear;
-moz-transition: all 0.2s linear;
-ms-transition: all 0.2s linear;
-o-transition: all 0.2s linear;
transition: all 0.2s linear;
  }
  
   .div_agregar_foto:hover{
	   cursor:pointer;
  }
  
  .div_marco_foto{
	      /* width: 100px; */
    /* height: 100px; */
    font-size: 30px;
    border: 2px solid;
    border-color: rgba(255, 0, 0, 0.45);
    border-radius: 5px;
    /* padding-top: 28px; */
    color: #c75c5c;
    -moz-box-shadow: -2px 2px 5px #000000;
    -webkit-box-shadow: -2px 2px 5px #000000;
    box-shadow: -2px 2px 5px #000000;
    display: inline-block;
    margin: 5px;
    padding: 2px;
	
	-webkit-transition: all 0.2s linear;
-moz-transition: all 0.2s linear;
-ms-transition: all 0.2s linear;
-o-transition: all 0.2s linear;
transition: all 0.2s linear;
  }
  
  </style>   
    
    
    
    
    
    
    
    
    
    
    
    </head>

<body  >
<div class="loader"><div class="preloader"><i class="fa fa-spinner fa-spin fa-4x fa-fw"></i>
	</div></div>
<div class="cont">
<div id="div_menu"></div>
    <script>$("#div_menu").load("../global/menulateral.php");  </script>

  
    <div id="contenedor">
    <div class="div_contenedor"> 
     
     
    
 		  <h2>Venta De Vehiculos</h2>
    <span class="carpeta" style="padding:0; font-size:13px; margin-top:0px; color:#337ab7;"> Inicio /Menu / Venta De Vehiculos </span>
    <hr>
				  
		<div id="contenedor_fluido" class="container-fluid">
		
			 
			
        		<div id="carga_load" style="margin-bottom: 100px;">
					
        			
        		
        		
		     	</div>
         
  	
					<script> $("#carga_load").load('tabla_vehiculos.php'); </script>
       </div>
		</div>
	</div>
	<footer id="footer"> </footer>
	</div>
</body>
</html>
	<script> //$("#carga_load").load("pagar.php") </script>