<?
	include("../../functions/funciones.php");
	conecta_bd();
	 
valida_sesion();
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<title>Documento sin título</title>
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
      

  
       
       
   
   <script type="text/javascript">
  
	
	
	$(document).ready(function()
	{
		
			
				$("#frm_cambiar").submit(function(event)
				{
					event.preventDefault()
					guardar()
			
				});
	
			
			
		
			
		
	})
	

	
	
	
 function guardar()
{				
				var datos = $("#frm_cambiar").serialize()+'&accion=guardar_contrasena';
				
	
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
							
								if(msj==1)
								{
										swal("Su Nueva Contraseña ha sido Modificada correctamente")
										
								}
								
								
								if(msj==2)
								{
										swal("Estimado Uduario, Las contraseñas Ingresadas no coinciden")
								}
								
								if(msj==3)
								{
										swal("Estimado Uduario, Informamos que la contraseña Ingresada como 'ACTUAL' <BR><strong>NO EXISTE</strong></BR>")
								}
								
								if(msj==4)
								{
										swal("Estimado Uduario,La contraseña Nueva Deber ser <strong> DISTINTA</strong> a la anterior")
								}
								
								if(msj==5)
								{
										swal("Estimado Uduario, Informamos que la contraseña Nueva deber tener un <strong> mínimo de 6 carácteres</strong>")
								}
								
								 
									 
									
							
											
							}	
											
						});
				
}
   
   
   </script>
   
    
</head>

<body style="background:#f1f4f5">
<div id="div_menu"></div>
    <script>$("#div_menu").load("../global/menulateral.php");  </script>

<div style="width:500px; margin:140px auto 140px; height:">
<div class="panel panel-primary">
	<div class="panel-heading">  <p> </p> <h4 align="center">CAMBIAR CONTRASEÑA</h4>  <p> </p> </div>
    <div class="panel-body" style="padding-top:50px">

    
       <form  id="frm_cambiar" name="frm_login" class="form-horizontal m-t-40">
                                           
                                              
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control input-lg	" type="text" placeholder="Contraseña actual" id="txt_contrasena_actual" name="txt_contrasena_actual" required>
                        </div>
                    </div>
                    <div class="form-group ">
                        
                        <div class="col-xs-12">
                            <input class="form-control input-lg" type="password" placeholder="Contraseña nueva" id="txt_contrasena_nueva"  name="txt_contrasena_nueva"required>
                        </div>
                    </div>
                    <div class="form-group ">
                        
                        <div class="col-xs-12">
                            <input class="form-control input-lg" type="password" placeholder="Confirmar Contraseña" id="txt_contrasena_nueva2"  name="txt_contrasena_nueva2"required>
                        </div>
                    </div>

                    <div class="form-group "></div>
                    
                    <div class="form-group text-right">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block" type="submit" id="btn_guardar"  name="btn_iniciar_sesion">Guardar </button>
                      </div>
         </div>
         
         
         <div class="form-group m-t-30">
                        <div class="col-sm-7">
                            <a href="login.php"><i class="fa fa-user m-r-5"></i> Volver A inicio de Sesión </a>
                        </div>
                       
                    </div>
                    
                    
      </form>
       
        	
           
            
            </div>
        
        </div>
        
             
            
        
        </div>
    



<footer style="width:100%;
	height: 60px;
	background: #2f353f;
	position: absolute;
	bottom: 0;
    color:#FFFFFF; text-align:center; padding:10px;"> Empresas Finis </footer> 


</body>

</html>