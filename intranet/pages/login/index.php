<?
session_start();
if(isset($_SESSION["id"]))
{
	header("location:../menu");
}else{
	session_destroy();
}
?>
<!doctype html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<title>FullServi - Inicie sesión</title>

		<link rel="stylesheet" href="../../css/LateralStyle.css" title="style css" type="text/css" media="screen" charset="utf-8">
	    <link rel="stylesheet" href="../../libraries/fonts/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="../../libraries/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="../../libraries/bootstrap/css/bootstrap-theme.css">
		<link rel="stylesheet" href="../../libraries/bootstrap/css/bootstrap.css">
        <link href="../../css/estilos.css" rel="stylesheet" type="text/css">
    
        <link rel="stylesheet" href="../../css/bootstrap-datepicker.css"/>
       	<script type="text/javascript" src="../../js/jquery-1.10.1.min.js"></script>
		<script src="../../libraries/bootstrap/js/bootstrap.min.js"></script>	
  		
        
 		 <link rel="stylesheet" href="../../css/sweetalert.css">
       
        
       <script type="text/javascript" src="../../js/sweetalert-dev.js"></script>
        <script src="../../js/sysscripts/lgn.js" type="text/javascript"></script>  

       
<link href="https://fonts.googleapis.com/css?family=Love+Ya+Like+A+Sister" rel="stylesheet">
   
   <script type="text/javascript">
  	var validar_formulario=0
	
	
	$(document).ready(function()
	{	
		$("#frm_login").submit(function(event)
		{
			 
			event.preventDefault();				   
			ingresar();			   
		}); 
	})
	

	
	
	
   
   
   </script>
   
    
</head>

<body style="background:#f1f4f5">

 


<div style="width:500px; margin:140px auto 140px; height:">
<center>
	
	<span style="font-family: 'Love Ya Like A Sister', cursive; font-size:400%	" ><i class="fa fa-wrench" aria-hidden="true"></i>	Full Servi</span>
	 
</center><div class="panel panel-default	">

 
	<div class="panel-heading">  <p> </p> <h4 align="center">  INCIAR SESION </h4>  <p> </p> </div>
    <div class="panel-body" style="padding-top:50px">

    
       <form  id="frm_login" name="frm_login"  class="form-horizontal m-t-40">
                                           
                                              
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control  input-lg" type="text" placeholder="Usuario" id="txt_usuario" name="txt_usuario" required>
                        </div>
                    </div>
                    <div class="form-group ">
                        
                        <div class="col-xs-12">
                            <input class="form-control  input-lg" type="password" placeholder="Contraseña" id="txt_password"  name="txt_password"required>
                        </div>
                    </div>

                    
                    
                    <div class="form-group text-right">
                        <div class="col-xs-12">
                            <button class="btn btn-default btn-lg  btn-block" type="submit" id="btn_iniciar_sesion"  name="btn_iniciar_sesion">Iniciar Sesión </button>
                        </div>
                    </div>
                    <div class="form-group m-t-30">
                        <div class="col-sm-7">
                         </div>
                        <div class="col-sm-5 text-right">
                           
                        </div>
                    </div>
       </form>
       
        	
           
            
            </div>
        
        </div>
        
             
            
        
        </div>
    



<footer style="width:100%;
	height: 60px;
	background: #333;
	position: absolute;
	bottom: 0;
    color:#FFFFFF; text-align:center; padding:10px;"> Empresas Finis </footer> 


</body>

</html>