 function ingresar()
{				 

 				var datos = $("#frm_login").serialize()+'&accion=ingresar_sistema';
						$.ajax({
							type: "POST",
							url: "ajax/procesos.php",
							data: datos,
							success: function(msj) {
								   
 								if(msj==1)
								{
										   
										window.location="../menu"

								}
								
								if(msj==0)
									{
											swal("Usuario o contraseña incorrectos.");
									}else{
										 
											//swal("Hay un problema al intentar ingresar. Si el problema persiste contacte al servicio de soporte.");
									}
								
								
								 
			
							}	
											
						});
				
}