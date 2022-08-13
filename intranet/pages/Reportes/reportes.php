<?
include("../../functions/funciones.php");
conecta_bd();	
$ficha_dos=reporte_orden_trabajo(219);

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

$(document).ready(function(){
	
	   
	$(window).load(function() {

		$(".loader").fadeOut("slow");
	});

});
		
function carga_modal(){
	if($("#cmb_reporte").val()==0){
		alert("hola")
	}

	if($("#cmb_reporte").val()==1){
		 
		$("#modal_rep").addClass("modal-lg");
			$("#contenido").load("../reportes/listado_orden.php") 
	}
	if($("#cmb_reporte").val()==2){
		$("#modal_rep").addClass("modal-lg");
		$("#contenido").load("../reportes/listado_cotizacion.php") 
	}
	if($("#cmb_reporte").val()==3){
		$("#modal_rep").removeClass("modal-lg");
		$("#contenido").load("../reportes/form_entradas.php") 
		
		
		
	}
	
	if($("#cmb_reporte").val()==4){
		reporte_mano_obra();
		
	}
	if($("#cmb_reporte").val()==5){
		$("#modal_rep").removeClass("modal-lg");
		$("#contenido").load("../reportes/form_ordenes.php") 
		
		
		
	}
		
	 
}




 

 
</script>
 
 
 
    </head>

<body>
                    

<div class="loader"><div class="preloader"><i class="fa fa-spinner fa-spin fa-4x fa-fw"></i>
	</div></div>
<div class="cont">
<div id="div_menu"></div>
    <script>$("#div_menu").load("../global/menulateral.php");  </script>

  
    <div id="contenedor">
    <div class="div_contenedor"> 
     
      
 		  <h2>Reportes</h2>
    <span class="carpeta" style="padding:0; font-size:13px; margin-top:0px; color:#337ab7;"> Inicio /Menu /Reportes </span>
    <hr>
				  
		<div id="contenedor_fluido" class="container-fluid">
		
			    <div  class="panel panel-default" id="panel_buscar"> 
        			
        			<div class="panel-body">
        				
							
								
									
									 <div class="form-group form-group-lg">
									
									<div class="col-sm-10">
										<select id="cmb_reporte" name="cmb_reporte" class="form-control" required>
											<option value="0"> ----Seleccione----</option>
											<option value="1"> Ordenes</option>
											<option value="5">Lista de ordenes </option>
                                            <option value="2">Cotizaciones </option>
											<option value="3"> Entradas y salidas De Productos</option>
																					
											<option value="4">Mano De Obra </option>
										 
										   </select>
									</div>
									 <a style="width: 240px"  class="btn btn-primary btn-lg" data-toggle="modal" data-target="#reportes" onClick="carga_modal()"  >Cargar</a>
								  </div>
								
								
							
        			
					</div>
            				
			    </div> 
			
        		<div id="carga_load" style="margin-bottom: 100px;">
        			<div class="row">
					<div class="col-md-4" style="margin-top: 15px;">
						<a href="../menu/Menu.php"  class="btn btn-warning btn-sm "  title="Volver al menu"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Volver </a>
					</div>
				</div>
        				
        		
		     	</div>
      
      
  		
       </div>
		</div>
	</div>
	</div>
    
    
	
	<footer id="footer"> </footer>
	
	    <div id="reportes" class="modal fade" >
        <div class="modal-dialog " id="modal_rep">
            <div class="modal-content" id="contenido">
                <!-- Content will be loaded here from "remote.php" file -->
            </div>
        </div>
    </div>
</body>
</html>