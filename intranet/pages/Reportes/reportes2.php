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
	 
	 
	 $("#imprimir_salida").click(function(){
		 

		reporte_salidas(0,0,0,0,0,0);
		// reporte_salidas( $("#sel_filtro_reporte_inout").val(), $("#date_inicio").val() ,$("#date_fin").val(), $("#date_dia").val() , $("#date_mes").val(), $("#sel_filtro_ano").val() )
		  

	 })
	 
		  //-----------------------------------// 
t});
		   	 
 

 
</script>
 
 
 
    </head>

<body  >
<div  >
 
  <!--  -->
    <div id="div_menu"></div>
    <script>$("#div_menu").load("../global/menulateral.php");  </script>

  
   
    <div class="div_contenedor"  > 
     
     
    
 	<h2>productos</h2>
    <span class="carpeta" style="padding:0; font-size:13px; margin-top:0px; color:#337ab7;"> Inicio /producto </span>
    <hr>
				  
		<div class="container-fluid">
		 		
			
            	 
            
      			<div id="id_contenedor_gestion_u" class="panel panel-primary">
                
                
              		
                            
                            <!--   function reporte_salidas(ac,fi,ff,fu,fm,fa)
  ----------------------------   -------------------------------   -->
                            	
                <button class="btn btn-info btn-xs" title="imprimir" id="imprimir_salida"  name="imprimir_salida"  > <i class="fa fa-print"></i></button> </td>

                            <b<br><br><br><br>r><br><br><br>
                            
                            
                            
                            <?
							
							
							
							
							
							
							
							
								$tipo_reporte=2;
							
								//$id_producto=14;
								$fecha_inicio_producto="2017-01-01";
								$fecha_fin_producto="2017-04-18";
								$fecha_unica="2017-04-17"; //--
								$fecha_mes="2017-04"; //--
								$fecha_mes_array=explode("-",$fecha_mes); //--
								$mes=$fecha_mes_array[1];
								$año=$fecha_mes_array[0];
								
								$fecha_registro=$fecha_unica;
								//--- variables de cabecera --
								$titulo_tiempo_cantidad="Cantidad de ventas en el mes";
								$titulo_fecha_datos="Fecha de datos";
								
								$valor_fecha_datos="2017-04-26";
								
								//---
								$total_egresos=0;
								$total_ingresos=0;
								
								
								$historial_consulta=mysql_query("
																select * 
															  	from historial_productos left join productos using (id_producto)
															  	where 
															  	fecha_hp='".$fecha_unica."' and estado_hp=1 and tipo_operacion_hp='salida'
																");
							
							// Mes										
 							 if($tipo_reporte==1)
							 {
								 
								 $historial_consulta=mysql_query("
																select * 
															  	from historial_productos left join productos using (id_producto)
															  	where 
															  	month(fecha_hp)=$mes and year(fecha_hp)=$año  and estado_hp=1 and tipo_operacion_hp='salida'
																");
								 
								 $historial_consulta2=mysql_query("
																select * 
															  	from historial_productos left join productos using (id_producto)
															  	where 
															  	month(fecha_hp)=$mes and year(fecha_hp)=$año and estado_hp=1 and tipo_operacion_hp='salida'
																");
								 
							 }
							 
							 // Dia
							 if($tipo_reporte==2)
							 {
								 $historial_consulta=mysql_query("
																select * 
															  	from historial_productos left join productos using (id_producto)
															  	where 
															  	fecha_hp='".$fecha_unica."' and estado_hp=1 and tipo_operacion_hp='salida'
																");
								 
								 $historial_consulta2=mysql_query("
																select * 
															  	from historial_productos left join productos using (id_producto)
															  	where 
															  	fecha_hp='".$fecha_unica."' and estado_hp=1 and tipo_operacion_hp='salida'
																");
								 
								 
							 }
							 //año
							 if($tipo_reporte==3)
							 {
								  
								 $historial_consulta=mysql_query("
																select * 
															  	from historial_productos left join productos using (id_producto)
															  	where 
															  	year(fecha_hp)=$año  and estado_hp=1 and tipo_operacion_hp='salida'
																");
								 
								 $historial_consulta2=mysql_query("
																select * 
															  	from historial_productos left join productos using (id_producto)
															  	where 
															  	year(fecha_hp)=$año and estado_hp=1 and tipo_operacion_hp='salida'
																");
								 
								 
							 }
							 //rango
							 if($tipo_reporte==4)
							 {
								 
								 $historial_consulta=mysql_query("
																select * 
															  	from historial_productos left join productos using (id_producto)
															  	where 
															  	fecha_hp between '".$fecha_inicio_producto."' and '".$fecha_fin_producto."'  and estado_hp=1 and tipo_operacion_hp='salida'
																");
								 
								 $historial_consulta2=mysql_query("
																select * 
															  	from historial_productos left join productos using (id_producto)
															  	where 
															  	fecha_hp between '".$fecha_inicio_producto."' and '".$fecha_fin_producto."'  and estado_hp=1 and tipo_operacion_hp='salida'
																");
							 }
		  
							 
							 /*	*/
							 	
								
								echo "<br><br><br>".cabecera_reporte("Reporte de salidas",2332);
					
                            	if(mysql_num_rows($historial_consulta)>0)
								{
									
 									$c=0;
									while($historial_aux_datos=mysql_fetch_array($historial_consulta))
									{
										 
										$c++;
 										$total_ingresos=$total_ingresos+ $historial_aux_datos["salida_hp"]*$historial_aux_datos["valor_venta_hp"];
							
									}
									
								?>
                                
                               
                                <fieldset>
                                  <legend>Salidas</legend>
                                  <table border="1">
                                    <tbody>
                                    	                                      
                                    	<tr>
                                           <td ><b><? echo $titulo_fecha_datos  ?></b><br><? echo $c; ?></td>
                                           <td><? echo "<b>".$titulo_tiempo_cantidad."</b><br>". $c ?></td>
                                           <td class=contenido><? echo formato_numero(1,$total_ingresos) ?> </td>
                                        </tr>
                                    </tbody>
                                  
                                  </table>
                           		</fieldset>
                                
                                <?
						 		
								}else{
									
								}
							
							
							 
								if(mysql_num_rows($historial_consulta2)>0)
								{
									
									?>
                         <br><br><br>
                               
                        	
						 	 <table class="table">		
								<tr>
                                	<th>Producto </th>
                                    <th>Cantidad </th>
                                    <th>Fecha </th>
                                    <th>Documento </th>
                                    <th>Salida </th>
                                </tr>
                                
                                
								<?	
									
									while($historial_datos=mysql_fetch_array($historial_consulta2))
									{
										
										?>
                                        
                                        	<tr>
                                        		<td><? echo $historial_datos["nombre_producto"] ?> </td>
                                        		<td><? echo $historial_datos["salida_hp"] ?> </td>
                                        		<td><? echo $historial_datos["fecha_hp"] ?> </td>
                                        		<td><? echo $historial_datos["documento_hp"]." n° ".$historial_datos["num_documento_hp"] ?> </td>
                                        		<td><? echo formato_numero(1,$historial_datos["salida_hp"]*$historial_datos["valor_venta_hp"]) ?> </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        <?
 										
										
										
 										$total_ingresos= $total_ingresos+$historial_datos["valor_venta_hp"]."<br>";
										
									
									
									
									}
									
								?>
                               
                            </table>

                                <?
						 		
								}else{
									
								}
								
							?>
                            
                            
                        <br><br><br><br>    
                            
                    <!--  Titulos -->        
                     <ul class="nav nav-tabs">
                      <li class="active"><a data-toggle="tab" href="#home">Mano de obra</a></li>
                      <li><a data-toggle="tab" href="#menu1">Entradas y salidas </a></li>
                     </ul>
                    
                    
                    <!--   Contenido   -->
                    <div class="tab-content">
                      <div id="home" class="tab-pane fade in active">
                       <!--  <h3>Mano de obra</h3>   -->
                        <p>
                        <br><br>
                           <input type="hidden" name="btn_mano_de_obra" 
                					id="btn_mano_de_obra"  
                                    onClick="cargar_pdf('Informe de notas','Informe de notas',this.id)" 
                                    class="btn btn-danger"  
                                    value="<? echo $ficha_dos ?>" >
                                     
                 
							<button style="width: 240px" type="button" class="btn btn-default btn-lg" id="btn_reporte"  >
								<i class="fa fa-file-pdf-o" aria-hidden="true"></i>Mano de obra
							</button>
					 
                        
                        </p>
                      </div>
                      <div id="menu1" class="tab-pane fade">
                        <!--<h3>Menu 1</h3> -->
                        <p>
                            <div class="col-lg-2">
                            	<select id="sel_filtro_reporte_inout" name="sel_filtro_reporte_inout" class="form-control" >
                                
                                	<option value="1"> Mes  </option>
                                	<option value="2"> Día </option>
                                    <option value="3"> Año </option>
                                    <option value="4"> Rango de fechas </option>
                                </select>
                              
                            </div>
                            
                            
                            <div class="col-lg-2">
                            
                            	<div id="div_opcion_1">
                                	<input type="month" id="date_mes" name="date_mes"  class="form-control" value="<? echo date("Y-m") ?>">
                                </div>
                            
                            	<div id="div_opcion_2">
                                	<input type="date" id="date_dia" name="date_dia"  class="form-control" value="<? echo date("Y-m-d") ?>">
                                </div>
                            
                            	<div id="div_opcion_3">
                                

                                 	<?
									$consulta_anos=mysql_query("select substr(fecha_hp,1,4) ano
																from historial_productos
																group by substr(fecha_hp,1,4)");

								
								
								
										if(mysql_num_rows($consulta_anos)>0)
										{
										?>
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
                                
                                <div id="div_opcion_4" >
                                	Entre <input type="date" id="date_inicio" name="date_inicio"  class="form-control" value="<? echo date("Y-m-d") ?>">
                                	y<input type="date" id="date_fin" name="date_fin"  class="form-control" value="<? echo date("Y-m-d") ?>">

                                </div>
                            
                            </div>
                        </p>
                      </div>
                       
                    </div>
                     <script>
					 
					 	$("#div_opcion_1").hide();
						$("#div_opcion_2").hide();
						$("#div_opcion_3").hide();
						$("#div_opcion_4").hide();
					 
					 </script>
                    

                          
       		
       	 		
       		
        		<div id="carga_load"  style="margin-bottom: 100px">
        			
        				
        		
		     	</div>
         
  
       </div>
 
	<footer id="footer"> </footer> <!-- <-->
</body>
</html>