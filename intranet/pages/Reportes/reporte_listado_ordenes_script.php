<?
include("../../functions/funciones.php");
conecta_bd();	

?>
<script>

 
</script>

<?
//	$("#div_genera_reporte").load("../reportes/reporte_salida_script.php?ac="+ac+"&fi="+fi+"&ff="+ff+"&fu="+fu+"&fm="+fm+"&fa="+fa+"");

$filtro=$_REQUEST["ac"];
//$id_producto=14;
$fecha_inicio_producto=$_REQUEST["fi"];
$fecha_fin_producto=$_REQUEST["ff"];
$fecha_unica=$_REQUEST["fu"]; //--
$fecha_mes=$_REQUEST["fm"]; //--
$fecha_ano=$_REQUEST["fa"]; 
$reporte=reporte_lista_orden($filtro,$fecha_inicio_producto,$fecha_fin_producto,$fecha_unica,$fecha_mes,$fecha_ano);

$titulo="Reporte_lista_ordenes_trabajo";
$nombre_pdf=$titulo."_".fecha_actual("normal")."_".hora_actual("hms");
 

?>

<input type="hidden"
	   name="btn_reporte_salida" 
       id="btn_reporte_salida"  
       onClick="cargar_pdf('<? echo $titulo ?>','<? echo $nombre_pdf ?>',this.id)" 
       class="btn btn-danger"  
       value="<? echo $reporte ?>" >
       
       
       

<script>
 
  swal({
  title: "Pdf generado",
  text: "¿Lo desea descargar?",
  type: "success",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Descargar",
  cancelButtonText: "Cancelar",
  closeOnConfirm: false
},
function(){
		
		 $("#btn_reporte_salida").click()
 		swal("PDF descargado", "", "success");
 });
	 //$("#btn_reporte").click()
	 
</script>