<?
include("../../functions/funciones.php");
conecta_bd();	
$titulo="Mano_de_obra";
$nombre_pdf=$titulo."_".fecha_actual("normal")."_".hora_actual("hms");
$reporte=reporte_mano_obra();

?>

<input type="hidden"
	   name="btn_reporte" 
       id="btn_reporte"  
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
		
		 $("#btn_reporte").click()
 		swal("PDF descargado", "", "success");
 });
	 //$("#btn_reporte").click()
	 
</script>