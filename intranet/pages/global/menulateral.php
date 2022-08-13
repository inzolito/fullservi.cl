<?
session_start()
?>
 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Como crear un menu despegable tipo acordeon con jQuery</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
		 <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
         <link href="https://fonts.googleapis.com/css?family=Maven+Pro" rel="stylesheet">
         <link href="https://fonts.googleapis.com/css?family=Titillium+Web:300" rel="stylesheet">
	 <link rel="stylesheet" href="../../libraries/fonts/font-awesome/css/font-awesome.css" />
	
	<link rel="stylesheet" href="../../css/style_lateral.css">
    
     <style>
      body {
       font-family: 'Open Sans', sans-serif;
       
      }
	  h2{
		font-family: 'Titillium Web', sans-serif;
		color:#337ab7;
		font-weight:200;
		margin-bottom:0px;
		color:#01c6cc;
	  }
	  

/* .navbar-default .navbar-nav>.open>a,  .navbar-default .navbar-nav>.open>a:focus,  .navbar-default .navbar-nav>.open>a:hover {
  background-color: rgba(241, 244, 245, 0.85);
}
.navbar-toggle {
  margin: 12px 20px 8px 0px;
  display: block;
  padding-left: 0px;
}*/







.dropdown .extended p {
  font-weight: 600;
  padding: 10px 15px 11px 15px;
  margin-bottom: 0px;
}
.dropdown .extended p a {
  padding: 0px !important;
  text-align: right !important;
}

.dropdown .pro-menu i{
  margin-right: 5px;
}
.dropdown .pro-menu a {
  padding: 6px 20px !important;
}

.Leftmenu-trigger {
  cursor: pointer;
  font-size: 16px;
  line-height: 64px;
  padding: 0px 15px 0px 7px;
}

.badge.up {
  position: relative;
  top: -12px;
  padding: 3px 6px;
  margin-left: -13px;
}

.top-menu li {
  padding: 0px !important;
}

.top-menu li >a {
  color: #FFFFFF;
    text-align: center;
    padding: 0px 15px;
	
    font-size: 16px;
    display: block;
}

.top-menu li >a:hover,.top-menu li >a:focus,.top-menu li >a:active {
  background-color: transparent;
}

.nav .open > a, .nav .open > a:hover, .nav .open > a:focus{
 background-color:transparent;	
}


.top-menu .dropdown-menu li {
  width: 100%;
  text-align: left !important;
}

.top-menu .dropdown-menu li a ,.top-menu .dropdown-menu .media-body{
  color: inherit;
  font-size: 14px;
  text-align: left;
  text-overflow: ellipsis;
  white-space: nowrap;
  display: block;
  width: 100%;
  overflow: hidden;
}

.top-menu .dropdown-menu .media-body {
  width: 70%;
}
.username {
  font-size: 14px;
  vertical-align: middle;
  margin-left: 3px;
}



    </style>
</head>
<body>
	<div class="main-content ">	 
   
  	<div align="left" >
		 	<a href="../menu/Menu.php"	style="font-size: 30px; float: left; color:#FFFFFF;" >FULL SERVI </a>

		 </div>  
     
     <ul class="nav navbar-nav navbar-right top-menu top-right-menu" >
	
		 
		
		 
      <li class="dropdown text-center">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="">
                                <i class="fa fa-user fa-2x"></i> 
                                 <span class="username"><? echo $_SESSION['nombre']?> </span> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu pro-menu" tabindex="5003" style="overflow: hidden; outline: none;">
                                <li><a href="../login/Cambiar_Password.php"><i class="fa fa-cog"></i> Password</a></li>
                                <li><a style="cursor: pointer"  onClick="cerrar()"><i class="fa fa-sign-out"></i> Cerrar Sesión</a></li>
                            </ul>
         </li>
       </ul>
 
	</div>
     
     
  <footer style="width: 100%;
	height: 60px;
	background: #333;
	border-top: 1px solid #000;
	position: absolute;
	bottom: 0;"> </footer>
 <script>
	 function cerrar(){
		 
		 data='accion=cerrar_sesion'
				 $.ajax({
			  type: "POST",
			  url: ( "../login/ajax/procesos.php"),
			  data: data,
			  success:function(msj){
			  	window.location=("../login/login.php")
			  }
			
			 
});
	 }
	</script>
</body>
</html>