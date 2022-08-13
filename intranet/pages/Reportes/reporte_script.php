<?
include("../../functions/funciones.php");
conecta_bd();	

$tipo_reporte=$_REQUEST["tr"];
	$id_orden=$_REQUEST["ido"];



if($tipo_reporte=="orden")
{
	$reporte=reporte_orden_trabajo($id_orden);
	$titulo="Orden De Trabajo";
 	$nombre_pdf="Orden_De_Trabajo".fecha_actual("normal")."_".hora_actual("hms");
	
}else{
	$reporte=reporte_cotizacion($id_orden);
	$titulo="Cotizacion";
 	$nombre_pdf="Cotizacion".fecha_actual("normal")."_".hora_actual("hms");
}


 	$nombre_pdf="Orden_De_Trabajo".fecha_actual("normal")."_".hora_actual("hms");
 

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