<?php
include('convertToPDF.php'); 
include('../../functions/funciones.php');
conecta_bd();
 
if ( isset($_POST['PDF_6']) ) 
{
	
	
 	//$html=utf8_encode($_POST['html_pdf']); 
	$html= $_POST['html_pdf'];
	
 	$titulo= $_POST['titulo_pdf'];
    doPDF($titulo,'',$html,true,'estilos.css',true); 

}
 
/*

if ( isset($_POST['PDF_1']) ) 
    doPDF('ejemplo',$html,false); 

if ( isset($_POST['PDF_2']) ) 
    doPDF('ejemplo',$html,true,'style.css'); 

if ( isset($_POST['PDF_3']) ) 
    doPDF('',$html,true,'style.css'); 
             
if ( isset($_POST['PDF_4']) ) 
    doPDF('ejemplo',$html,true,'style.css',false,'letter','landscape');  
     
if ( isset($_POST['PDF_5']) ) 
    doPDF('ejemplo',$html,true,'',true); //asignamos los tags <html><head>... pero no tiene css 

if ( isset($_POST['PDF_6']) ) 
    doPDF('',$html,true,'style.css',true); 
     
if ( isset($_POST['PDF_7']) ) 
    doPDF('pdfs/nuevo-ejemplo',$html,true,'style.css',true); //lo guardamos en la carpeta pdfs     
*/
?> 


 

 