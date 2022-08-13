<?
	include("../../functions/funciones.php");
	conecta_bd();
	

$accion=$_REQUEST["accion"];

if($accion=="cargar_modelo_dependiente")
{
	 $retornar_opcion=cargar_modelo($_REQUEST["marca"]);
	 echo $retornar_opcion;
} 


if($accion=="cargar_select_modelo")
{
	
} 



