<?
include("../../functions/funciones.php");
//valida_sesion()
	
?>
<!doctype html>
<html>
<head>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title>FullServi</title>

 
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
        



<style>
	
	</style>
	
	<script type="text/javascript">
	$(window).load(function() {

		$(".loader").fadeOut("slow");
	});
</script>
    
    </head>

<body  >

<div class="loader"><div class="preloader"><i class="fa fa-spinner fa-spin fa-4x fa-fw"></i>
	</div></div>
<div class="cont">
<div id="div_menu"></div>
    <script>$("#div_menu").load("../global/menulateral.php");  </script>

  
  
     
    <div id="contenedor">
    <div class="div_contenedor"> 
    	<h2>Menu Sistema</h2>
    
    	<span class="carpeta" style="padding:0; font-size:13px; margin-top:0px; color:#337ab7;"> Inicio /Menu </span>
    	<hr>
		
		<!-- Asi se ordena el codigo wn desordenao xDDD  pd: te falto cerrar la etiqueta </span> en todos los modulos-->		  
		<a href="../ordenes/ordenes.php">
			<div class="div_menu">
				<i class="fa fa-file fa-5x" aria-hidden="true"></i> 
				<span class="sub_box"><span class="titulo_sub_box"> ORDEN DE TRABAJO</span> </span>
			</div> 
		</a>
      <a href="../pagos/pagos.php">
			<div class="div_menu">
				<i class="fa fa-credit-card fa-5x" aria-hidden="true"></i>
				<span class="sub_box"><span class="titulo_sub_box"> PAGOS</span> </span>
			</div> 
		</a>
       
       
            <a href="../cotizaciones/cotizacion.php">       
         <div class="div_menu">
         	<i class="fa fa-clone fa-5x" aria-hidden="true"></i>
            <span class="sub_box">
            	<span class="titulo_sub_box">COTIZACION</span>
            </span>
         
         </div> 
         </a>   
          
           <a href="../venta/venta.php">       
         <div class="div_menu">
         	<i class="fa fa-car fa-5x" aria-hidden="true"></i>
            <span class="sub_box">
            	<span class="titulo_sub_box">VENTA DE VEHICULOS</span>
            </span>
         
         </div> 
         </a>   
         
            <a href="../ManoDeObra/Mano_de_obra.php">   	 		   		
             <div class="div_menu">
              	 	<i class="fa fa-wrench fa-5x" aria-hidden="true"></i> 
				 <span class="sub_box"><span class="titulo_sub_box">MANO DE OBRA</span></sub>
             </div> 
          </a>  
           <a href="../clientes/clientes.php">			 
			<div class="div_menu">
				<i class="fa fa-users fa-5x" aria-hidden="true"></i> 
				<span class="sub_box">
					<span class="titulo_sub_box">CLIENTES</span>
				</span>

			</div> 
	   </a>
            <a href="../empleados/empleados.php">        	
			<div class="div_menu">
			
				<i class="fa fa-address-card-o fa-5x" aria-hidden="true"></i>
				<span class="titulo_sub_box">EMPLEADOS</span>
				</div>          	
		</a>
           
           <a href="../proveedores/proveedor.php">       
         <div class="div_menu">
         	<i class="fa fa-address-book-o fa-5x" aria-hidden="true"></i> 
            <span class="sub_box">
            	<span class="titulo_sub_box">PROVEEDORES</span>
            </span>
         
         </div> 
         </a>
           
            <a href="../reportes/reportes.php" >       	 		   		
           <div class="div_menu">
           		<i class="fa fa-file-pdf-o fa-5x" aria-hidden="true"></i> 
            	<span class="sub_box"><span class="titulo_sub_box">REPORTES</span></span>
           </div>  
         </a>   
               <a href="../inventario/inventario.php">       
         <div class="div_menu">
         	<i class="fa fa-archive fa-5x" aria-hidden="true"></i> 
            <span class="sub_box">
            	<span class="titulo_sub_box">REGISTRAR<BR> PRODUCTO</span>
            </span>
         
         </div> 
         </a>      	 
            <a href="../inout/entrada.php">       
         <div class="div_menu">
         	<i class="fa fa-stack-exchange fa-5x" aria-hidden="true"></i> 
            <span class="sub_box">
            	<span class="titulo_sub_box">ENTRADA DE STOCK</span>
            </span>
         
         </div> 
         </a>     
            
         <a href="../inout/salida.php">       
         <div class="div_menu">
         	<i class="fa fa-stack-overflow fa-5x" aria-hidden="true"></i> 
            <span class="sub_box">
            	<span class="titulo_sub_box">SALIDA DE STOCK</span>
            </span>
         
         </div> 
         </a>
                                       	 		       
                                        	 		   		
        	 	  
               	 	 	
       <!-- Asi se deja el menu ordenaito -->
       
									
									
									
</div>

	<footer id="footer "> </footer>
</body>
</html>