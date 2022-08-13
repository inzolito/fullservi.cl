<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

      <script type="text/javascript" src="../../js/jquery-1.10.1.min.js"></script>

 
  <link rel="stylesheet" href="../../css/LateralStyle.css" title="style css" type="text/css" media="screen" charset="utf-8">
	    <link rel="stylesheet" href="../../libraries/fonts/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="../../libraries/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="../../libraries/bootstrap/css/bootstrap-theme.css">
		<link rel="stylesheet" href="../../libraries/bootstrap/css/bootstrap.css">
        
       
         <link rel="stylesheet" href="../../css/estilos.css" type="text/css">
        
 		 <link rel="stylesheet" href="../../css/sweetalert.css">
       
        
       <script type="text/javascript" src="../../js/sweetalert-dev.js"></script>
       <script type="text/javascript" src="../../js/sweetalert-dev.js"></script>
       
  		<script src="../../libraries/bootstrap/js/bootstrap.min.js"></script>

     
	
<script>
	
	function mostrar(id) {/**/
  
		
		$("#editar_resul").load("../laboratorio/remote.php?id=" + id) 
		
    }
	
	function guardar(){
		
			var datos = "rut_cliente="+1					
																								
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
							
								//alert(datos)
							$('#myModal').modal('hide')
								swal("El cliente no está registrado en el sistema, revise.", "","success") 
							
							}
																	
							});
	}

	</script>
<body>

<?print '<td class="ancho borde"> <center><a class="boton" href="#" data-toggle="modal" data-target="#myModal" onclick="mostrar(' . 3 . ')"> &nbsp;&nbsp;+ EDITAR&nbsp;&nbsp;</a></center></td>'; ?>

<a href="remote.php" data-toggle="modal"  data-target="#myModal">Cargar Ingreso</a>


<!-- Modal -->
 <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" id="editar_resul">
                <!-- Content will be loaded here from "remote.php" file -->
            </div>
        </div>
    </div>
    
    
</body>
</html>