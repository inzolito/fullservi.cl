function validar_estilo_campo(id_input,valid){
	if(valid==1){
			
		$("#div_"+id_input).removeClass("has-success");
		$("#icon_"+id_input).removeClass("glyphicon-ok");
		$("#div_"+id_input).removeClass("has-error");
		$("#icon_"+id_input).removeClass("glyphicon-remove");
		$("#div_"+id_input).addClass("has-success");
		$("#icon_"+id_input).addClass("glyphicon-ok");
		 
		
	}else{
		
		$("#div_"+id_input).removeClass("has-success");
		$("#icon_"+id_input).removeClass("glyphicon-ok");
		$("#div_"+id_input).removeClass("has-error");
		$("#icon_"+id_input).removeClass("glyphicon-remove");
		$("#div_"+id_input).addClass("has-error");
		$("#icon_"+id_input).addClass("glyphicon-remove");
		 
		
		
	}
	
	
	
}


//**********
function formatrut(objeto)
{
	
 
		  id=objeto.attr("id")
		  
		  valor=objeto.val()
		  valor=valor.split(".").join("")
		  valor=valor.split(".").join("")
		  valor=valor.split("-").join("")
		  valor_nuevo="";
 		  largo_valor=valor.length
		   
		 
 		  if(largo_valor>0  )
		  {
			puntos=0;
			if(largo_valor>4 )
			{
 				largo_puntos=largo_valor-1
				final=largo_valor-1;
 				 
  				 if(largo_puntos>=4 && largo_puntos<7  )
    			 {	 
					valor_nuevo=valor.slice(0,final-3)+"."+valor.slice(final-3,final)
						
				 }
				 if( largo_puntos>=7 )
    			 {	 
					valor_nuevo=valor.slice(0,final-6)+"."+valor.slice(final-6,final-3)+"."+valor.slice(final-3,final)
					 	
				 }
				 
				 
 				 valor_nuevo=valor_nuevo+"-"+valor.slice(largo_valor-1,largo_valor)
				 
				$("#"+id).val("")
				$("#"+id).val(valor_nuevo)
				
 			}else{
			     
 				 valor_nuevo=valor.slice(0,largo_valor-1)+"-"+valor.slice(largo_valor-1,largo_valor)
				 
				 $("#"+id).val("")
				 $("#"+id).val(valor_nuevo)
				 
				//valor_nuevo=valor.slice(0,largo_valor-1)+"-"+valor.slice(largo_valor-1,largo_valor)
				 
				
			}
			if(largo_valor>13 )
			{
 			
				valor_nuevo=valor.slice(9,final-6)+"."+valor.slice(final-6,final-3)+"."+valor.slice(final-3,final)
				valor_nuevo=valor_nuevo+"-"+valor.slice(largo_valor-1,largo_valor)
				$("#"+id).val("")
				 $("#"+id).val(valor_nuevo)
			}
		  }
	}

function Valida_Rut(Objeto)
{
	 
	var tmpstr = "";
	var intlargo = Objeto.val()
	
	 
	
	if (intlargo.length> 0)
	{
		crut = Objeto.val()
		largo = crut.length;
		if ( largo <2 )
		{
			//alert('rut inválido')
			Objeto.focus()
 			return false;
		}
		for ( i=0; i <crut.length ; i++ )
		if ( crut.charAt(i) != ' ' && crut.charAt(i) != '.' && crut.charAt(i) != '-' )
		{
			tmpstr = tmpstr + crut.charAt(i);
		}
		rut = tmpstr;
		crut=tmpstr;
		largo = crut.length;
 
		if ( largo> 2 )
			rut = crut.substring(0, largo - 1);
		else
			rut = crut.charAt(0);
 
		dv = crut.charAt(largo-1);
 
		if ( rut == null || dv == null )
		return 0;
 
		var dvr = '0';
		suma = 0;
		mul  = 2;
 
		for (i= rut.length-1 ; i>= 0; i--)
		{
			suma = suma + rut.charAt(i) * mul;
			if (mul == 7)
				mul = 2;
			else
				mul++;
		}
 
		res = suma % 11;
		if (res==1)
			dvr = 'k';
		else if (res==0)
			dvr = '0';
		else
		{
			dvi = 11-res;
			dvr = dvi + "";
		}
 
		if ( dvr != dv.toLowerCase() )
		{
		//	alert('rut inválido')
			Objeto.focus()

 			return false;
		}
 		 
		return true;
	}
}
//*******
/* 
function validateMail(idMail)
{
	//Creamos un objeto  
	object=document.getElementById(idMail);
	valueForm=object.value;
 
	// Patron para el correo
	var patron=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
	if(valueForm.search(patron)==0)
	{
		//Mail correcto
		object.style.color="#000";
		//validar_estilo_campo(idMail,1)
		return;
	}
	//Mail incorrecto
	object.style.color="#f00";
	//validar_estilo_campo(idMail,1)
}  
*/

function solonumero(numero){
	 
	numero=numero.replace(/\$/g, '');
	numero=numero.replace(/\./g, '');
	numero=numero.replace(/\,/g, '');    
	
	
	var numero_array=numero.split("");
		
 		
		
		for(x=0; x<= numero_array.length -1 ;x++)
		{
			
			
			  
			if (!/^([0-9])*$/.test(numero[x]))
			{
				 
				numero=numero.replace(numero[x], "");
			}
		}
		
 		return numero;
}
  
  
var formatNumber = {
 separador: ".", // separador para los miles
 sepDecimal: '.', // separador para los decimales
 formatear:function (num){

  num=num.replace(/\$/g, '');
  num=num.replace(/\./g, '');
  num=num.replace(/\,/g, '');
  num=solonumero(num) 
  if(num==""){return "";}
  num +='';
  var splitStr = num.split('.');
  var splitLeft = splitStr[0];
  var splitRight = splitStr.length > 1 ? this.separador + splitStr[1] : '';
  var regx = /(\d+)(\d{3})/;
  while (regx.test(splitLeft)) {
  splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
  }
  return this.simbol + splitLeft  +splitRight;
 },
 new:function(num, simbol){
  this.simbol = simbol ||'';
  return this.formatear(num);
 }
}

function formato_moneda(objeto)
{
	objeto.value=formatNumber.new(objeto.value,"$") 	
}

function formato_numero(objeto)
{
	objeto.value=formatNumber.new(objeto.value,"") 	
}





//-------//

function reporte_salidas(tr,ac,fi,ff,fu,fm,fa)
{

 //($accion_r, $fecha_inicio, $fecha_salida, $fecha_unica,$fecha_mes,$fecha_año )
 	
	/**/
	 
	$("#div_genera_reporte").remove()
	$("body").append("<div id='div_genera_reporte' name='div_genera_reporte' > </div>  ");
	$("#div_genera_reporte").load("../reportes/reporte_salida_script.php?tr="+tr+"&ac="+ac+"&fi="+fi+"&ff="+ff+"&fu="+fu+"&fm="+fm+"&fa="+fa+"");
	  
//266763-8	
	
}
	


function reporte_lista_mano(ac,fi,ff,fu,fm,fa)
{

 //($accion_r, $fecha_inicio, $fecha_salida, $fecha_unica,$fecha_mes,$fecha_año )
 	
	/**/
	
	 
	$("#div_genera_reporte").remove()
	$("body").append("<div id='div_genera_reporte' name='div_genera_reporte' > </div>  ");
	$("#div_genera_reporte").load("../reportes/reporte_listado_ordenes_script.php?ac="+ac+"&fi="+fi+"&ff="+ff+"&fu="+fu+"&fm="+fm+"&fa="+fa+"");
	  
//266763-8	
	
}
	
function reporte_orden(ido)
{
 
 	$("#div_genera_reporte").remove()
	$("body").append("<div id='div_genera_reporte' name='div_genera_reporte' > </div>  ");
	$("#div_genera_reporte").load("../reportes/reporte_script.php?ido="+ido+"&tr=orden");
	 
//266763-8	
	
}

function reporte_cotizacion(ido)
{
 
 	$("#div_genera_reporte").remove()
	$("body").append("<div id='div_genera_reporte' name='div_genera_reporte' > </div>  ");
	$("#div_genera_reporte").load("../reportes/reporte_script.php?ido="+ido+"&tr=cotizacion");
	 
//266763-8	
	
}

function reporte_mano_obra()
{
 
 	$("#div_genera_reporte").remove()
	$("body").append("<div id='div_genera_reporte' name='div_genera_reporte' > </div>  ");
	$("#div_genera_reporte").load("../reportes/reporte_mano_obra_script.php");
	 
//266763-8	
	
}


function cargar_pdf(titulo,nombre_pdf,id_boton)
{	
  	
	formulario_pdf()
	
	$("#html_pdf").val($("#"+id_boton).val())
	
	$("#titulo_pdf").val(titulo) 
	$("#nombre_pdf").val(nombre_pdf)
	$("#html_pdf").click()
	
 
}

function formulario_pdf()
{
	
	if( !$('#form_defecto').is(":visible") ){}
			
			
			$("body").append("<form  action='../../libraries/dompdf/index.php' target='_blank' id='form_defecto' method='POST'>"+
								"<button   style='visibility: hidden;'  name='PDF_6' class='btn btn-danger' > <i class='fa fa-file-pdf-o'></i>  Generar nomina "+
									  "<input type='hidden' id='html_pdf' name='html_pdf'  >"+
									  "<input type='hidden' id='titulo_pdf' name='titulo_pdf' >"+                               
									  "<input type='hidden' id='nombre_pdf' name='nombre_pdf' >"+         
								"</button>"+
					 		 "</form>")
			
}

function modelo_dependiente(valor){
	if(valor==0){
		
		swal("seleccione un modelo")
	}else{
		
		var datos = "accion=cargar_modelo_dependiente"+"&marca="+valor;
							
						$.ajax({
							type: "POST",
							url: "../global/procesos.php",
							data: datos,
							success: function(msj) {
								
								//$("#cmb_modelo").removeAttr("disabled");
								$("#cmb_modelo").html(msj)
				
								 // $("#cmb_modelo").attr("disabled",true);
							},
											
						});
						 
		
	}

	
}

function cargar_select_modelo(id){
	
	var datos = "accion=cargar_select_modelo"+"&marca="+valor;
							
						$.ajax({
							type: "POST",
							url: "../global/procesos.php",
							data: datos,
							success: function(msj) {
								
								datos_array=msj.split("-separate-");												   		
								$("#cmb_modelo").val(datos_array[0]).attr("selected",true);
								

							},
											
						});
	
	
}