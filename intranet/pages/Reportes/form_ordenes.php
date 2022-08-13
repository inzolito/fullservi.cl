<?
include("../../functions/funciones.php");
conecta_bd();	
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>

<script>
 var idp=0;

$(document).ready(function(){
	
	$("#btn_reporte").click(function(){
  		$("#btn_mano_de_obra").click()
		
	})
	 
	$("#sel_filtro_reporte_inout").change(function(){
		

				for(x=1;x<=4; x++)
				{
					$("#div_opcion_"+x).hide(100);	
				}
		
				$("#div_opcion_"+$("#sel_filtro_reporte_inout").val() ).show(100);	

		
	})
	 
	 
	 $("#btn_imprimir_inout").click(function(){
		 

		 
		 reporte_lista_mano( $("#sel_filtro_reporte_inout").val(), $("#date_inicio").val() ,$("#date_fin").val(), $("#date_dia").val() , $("#date_mes").val(), $("#sel_filtro_ano").val() )
		
		  

	 })
	 
		  //-----------------------------------// 
});
		   	 
 

 
</script>
</head>

<body>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Lista ordenes</h4>
</div>
<div class="modal-body">
  
  <div class="panel panel-default">
	  <div class="panel-body"> 
	  
	  	<br>
        
        <div class="row">
	  	<div class="col-md-12">
        <label for="date_mes">Seleccione el periodo</label>
	  	<select id="sel_filtro_reporte_inout" name="sel_filtro_reporte_inout" class="form-control" >
                                
                                	<option value="1"> Mes  </option>
                                	<option value="2"> Día </option>
                                    <option value="3"> Año </option>
                                    <option value="4"> Rango de fechas </option>
                                </select>
			</div>
	  
	  	
		  </div>
          
	  		<div class="row">
	  	  <div class="col-md-12">
                            <br>
                            	<div id="div_opcion_1">
									<label for="date_mes">Mes</label>
                                	<input type="month" id="date_mes" name="date_mes"  class="form-control" value="<? echo date("Y-m") ?>">
                                    
                                </div>
                          
                            	<div id="div_opcion_2"  hidden="hidden">
									<label for="date_dia"> Dia </label>
                                	<input type="date" id="date_dia" name="date_dia"  class="form-control" value="<? echo date("Y-m-d") ?>">
                                </div>
                            
                            	<div id="div_opcion_3" hidden="hidden">
                                

                                 	<?
									$consulta_anos=mysql_query("select substr(fecha_hp,1,4) ano
																from historial_productos
																group by substr(fecha_hp,1,4)");

								
								
								
										if(mysql_num_rows($consulta_anos)>0)
										{
										?>
                                        	<label for="date_inicio"> Año</label>
											<select name="sel_filtro_ano" id="sel_filtro_ano" class="form-control"	 >							
										<?
											
											while($anos_datos=mysql_fetch_array($consulta_anos))
											{
												?> <option value="<? echo $anos_datos["ano"]  ?>"  > <? echo $anos_datos["ano"]  ?> </option><?
													
											}
										?>
											</select>
                                        <?
                                        }else{
											
											echo "No hay datos ingresados aún";
										}
									
									
									
									?>
                                
                                </div>
                                
                                <div id="div_opcion_4" hidden="hidden" >
                                
									<label for="date_inicio"> Inicio</label>
                                	 <input type="date" id="date_inicio" name="date_inicio"  class="form-control" value="<? echo date("Y-m-d") ?>">
									<label for="date_fin">Final </label>
                                	<input type="date" id="date_fin" name="date_fin"  class="form-control" value="<? echo date("Y-m-d") ?>">

                                </div>
                            <br><br><br>
                            </div>
		  </div>
	   
	  </div>
  
	</div>
   
<small>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <button type="button"  id="btn_imprimir_inout" name="btn_imprimir_inout" class="btn btn-primary">Imprimir</button>
</div></small>
   <script>
					  
					 
					 </script>

</body>
</html>