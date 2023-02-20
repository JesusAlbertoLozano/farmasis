<?php $sql1="SELECT utldmin FROM datagen_det";	////CODIGO DEL LOCAL DEL USUARIO
$result1 = mysqli_query($conexion,$sql1);
if (mysqli_num_rows($result1)){
while ($row1 = mysqli_fetch_array($result1)){
		$utldmin    = $row1['utldmin'];
}
}
?>
<script>
<!--
function conmayus(field) {
  field.value = field.value.toUpperCase()
}
/*var isCtrl = false;
function ctrls(e)
{
	if(e.which == 17) isCtrl=true;
	if(e.which == 121 && isCtrl == true) {
	alert("HOLAAAAA")
	}
}*/
function prods(e) 
{
tecla=e.keyCode;
	  /////F3
	  //if(e.which  == 17) isCtrl=false;
	 /* var isCtrl = false;
	  //alert(tecla);
	  if(tecla == 17)
	  { 
	  	isCtrl=true;
	  }
	  if(tecla == 121 && isCtrl == true)
	  {
	  alert("holaaaaaaaaa");
	  }*/
	  if(tecla==114)
	  {
		    document.form1.des.disabled = false;
			document.form1.des.focus();
			document.form1.factor.disabled = false;
			document.form1.blister.disabled = false;
			document.form1.marca.disabled = false;
			document.form1.moneda.disabled = false;
			document.form1.line.disabled = false;
			document.form1.clase.disabled = false;
			document.form1.present.disabled = false;
			document.form1.catp.disabled = false; //aquiiiiiiii
			//--document.form1.price1.disabled = false;
			document.form1.price2.disabled = false;
			document.form1.price3.disabled = true;
			document.form1.cod_bar.disabled = false;
			document.form1.cod_cuenta.disabled = false;
			document.form1.img.disabled = true;
			document.form1.igv.disabled = false;
			//document.form1.inc.disabled = false;
			document.form1.lotec.disabled = false;
			document.form1.textdesc.disabled = false;
			document.form1.rd.disabled = false;
			document.form1.rd1.disabled = false;
			///	botones
			document.form1.printer.disabled = true;
			document.form1.modif.disabled = true;
			document.form1.nuevo.disabled = true;
			document.form1.save.disabled = false;
			document.form1.del.disabled = true;
			document.form1.first.disabled = true;
			document.form1.prev.disabled = true;
			document.form1.next.disabled = true;
			document.form1.fin.disabled = true;
			document.form1.ext.disabled = false;
			document.form1.val.value=2;
			var z=dhtmlXComboFromSelect("marca");
			z.enableFilteringMode(true);
			var z=dhtmlXComboFromSelect("line");
			z.enableFilteringMode(true);
			var z=dhtmlXComboFromSelect("clase");
			z.enableFilteringMode(true);
			var z=dhtmlXComboFromSelect("present");
			z.enableFilteringMode(true);
			var z=dhtmlXComboFromSelect("catp");
			z.enableFilteringMode(true);
			document.form1.codigo.focus();
	  }
	  ///F4
	  if(tecla==115)
	  {
	  document.form1.submit();
	  }
	  if(tecla==119)
	  {
		  var f = document.form1;
		  if (f.save.disabled == false)
		  {
			  if (f.des.value == "")
			  { alert("Ingrese el nombre del Producto"); f.des.focus(); return; }
			  if (f.factor.value == "")
			  { alert("Ingrese el Factor"); f.factor.focus(); return; }
			  //--if ((f.price1.value == "0.00") || (f.price1.value == ""))
			  //--{ alert("Ingrese el Precio de Costo"); f.price1.focus(); return; }
			  var utdmin= <?php echo $utldmin;?>;
			  if (f.price2.value < utdmin)
			  {
			  alert("La utilidad ingresada no corresponde segun la configuracion del Sistema"); document.form1.price2.focus();return;
			  }
			  else
			  {
				  if ((f.price2.value == "0.00") || (f.price2.value == ""))
				  { alert("Ingrese el Margen de Utilidad"); f.price2.focus(); return; }
			  }
			  if ((f.price3.value == "0.00") || (f.price3.value == ""))
			  { alert("Ingrese el Precio de Venta"); f.price3.focus(); return; }
			  if (f.marca.value == "")
			  { alert("Seleccione una Marca"); f.marca.focus(); return; }
			  if (f.line.value == "")
			  { alert("Seleccione una Linea"); f.line.focus(); return; }
			  if (f.clase.value == "")
			  { alert("Seleccione una Clase"); f.clase.focus(); return; }
			  if (f.present.value == "")
			  { alert("Seleccione una Presentacion"); f.present.focus(); return; }
			  if (f.catp.value == "")
			  { alert("Seleccione una Categoria"); f.catp.focus(); return; }
			  //VENTANA QUE CONFIRMA SI GRABO O NO?
			  ventana=confirm("Desea Grabar estos datos");
			  if (ventana) {
			  document.form1.btn.value=4;
			  f.method = "POST";
			  f.action ="graba_producto.php";
			  f.submit();
			  }
			  ///////////////////////////////////
		}
	  }
}
function pulsar(e) 
{
    tecla=(document.all) ? e.keyCode : e.which;
  if(tecla==13) return false;
}

function sf(){
document.form1.codigo.disabled = true;
document.form1.des.disabled = true;
document.form1.factor.disabled = true;
document.form1.blister.disabled = true;
document.form1.marca.disabled = true;
document.form1.moneda.disabled = true;
document.form1.line.disabled = true;
document.form1.clase.disabled = true;
document.form1.present.disabled = true;
document.form1.catp.disabled = true;
document.form1.price.disabled = true;
//--document.form1.price1.disabled = true;
document.form1.price2.disabled = true;
document.form1.price3.disabled = true;
document.form1.price4.disabled = true;
document.form1.cod_bar.disabled = true;
document.form1.cod_cuenta.disabled = true;
document.form1.img.disabled = true;
document.form1.igv.disabled = true;
//document.form1.inc.disabled = true;
document.form1.lotec.disabled = true;
document.form1.textdesc.disabled = true;
document.form1.printer.disabled = false;
document.form1.save.disabled = true;
document.form1.ext.disabled = true;
document.form1.rd.disabled = true;
document.form1.rd1.disabled = true;
//document.form2.buscar.focus();
}
function buton2(){
document.form1.des.disabled = false;
document.form1.factor.disabled = false;
document.form1.blister.disabled = false;
document.form1.marca.disabled = false;
document.form1.line.disabled = false;
document.form1.clase.disabled = false;
document.form1.present.disabled = false;
document.form1.catp.disabled = false;
document.form1.moneda.disabled = false;
//--document.form1.price1.disabled = false;
document.form1.price2.disabled = false;
document.form1.price3.disabled = false;
document.form1.cod_bar.disabled = false;
document.form1.cod_cuenta.disabled = false;
document.form1.img.disabled = false;
document.form1.igv.disabled = false;
document.form1.igv.checked = true;
document.form1.lotec.disabled = false;
document.form1.lotec.checked = true;
//document.form1.inc.disabled = false;
//document.form1.inc.checked = false;

document.form1.textdesc.disabled = false;
document.form1.rd.disabled = false;
document.form1.rd1.disabled = false;
///	botones
document.form1.printer.disabled = true;
document.form1.modif.disabled = true;
document.form1.nuevo.disabled = true;
document.form1.save.disabled = false;
document.form1.ext.disabled = false;
document.form1.first.disabled = true;
document.form1.prev.disabled = true;
document.form1.next.disabled = true;
document.form1.fin.disabled = true;
document.form1.del.disabled = true;
//LIMPIO CAJAS
document.form1.des.value = "";
document.form1.des.focus();
document.form1.factor.value = "";
document.form1.blister.value = "";
document.form1.price.value = "";
document.getElementById("1").innerHTML="0.00";
document.getElementById("2").innerHTML="0.00";
document.getElementById("3").innerHTML="0.00";
document.getElementById("4").innerHTML="0.00";
document.getElementById("5").innerHTML="0.00";
document.getElementById("6").innerHTML="0.00";
document.getElementById("7").innerHTML="0.00";
document.getElementById("pv2").innerHTML="0.00";
document.getElementById("pv1").innerHTML="0.00";
//--document.form1.price1.value = "";
document.form1.price2.value = "";
document.form1.price3.value = "";
document.form1.price4.value = "";
document.form1.cod_bar.value = "";
document.form1.cod_cuenta.value = "";
document.form1.img.value = "";
document.form1.pv1.value = "";
document.form1.pv2.value = "";
//document.form1.igv.value = "";
//document.form1.inc.value = "";
//document.form1.lotec.value = "";
document.form1.textdesc.value = "";
document.form1.price.value="0.00";
//--document.form1.price1.value="0.00";
document.form1.price2.value="0.00";
document.form1.price3.value="0.00";
document.form1.price4.value="0.00";
document.form1.val.value=1;
var z=dhtmlXComboFromSelect("marca");
z.enableFilteringMode(true);
var z=dhtmlXComboFromSelect("line");
z.enableFilteringMode(true);
var z=dhtmlXComboFromSelect("clase");
z.enableFilteringMode(true);
var z=dhtmlXComboFromSelect("present");
z.enableFilteringMode(true);
var z=dhtmlXComboFromSelect("catp");
z.enableFilteringMode(true);
var v1 = parseInt(document.form1.fincod.value);
v1 = v1 + 1;
document.form1.codigo.value=v1;
document.form1.cod_nuevo.value=v1;
}
function buton3(){
document.form1.des.disabled = false;
document.form1.des.focus();
document.form1.factor.disabled = false;
document.form1.blister.disabled = false;
document.form1.marca.disabled = false;
document.form1.moneda.disabled = false;
document.form1.line.disabled = false;
document.form1.clase.disabled = false;
document.form1.present.disabled = false;
document.form1.catp.disabled = false;
document.form1.price.disabled = false;
//--document.form1.price1.disabled = false;
document.form1.price2.disabled = false;
document.form1.price3.disabled = true;
document.form1.cod_bar.disabled = false;
document.form1.cod_cuenta.disabled = false;
document.form1.img.disabled = true;
document.form1.igv.disabled = false;
//document.form1.inc.disabled = false;
document.form1.lotec.disabled = false;
document.form1.textdesc.disabled = false;
document.form1.rd.disabled = false;
document.form1.rd1.disabled = false;
///	botones
document.form1.printer.disabled = true;
document.form1.modif.disabled = true;
document.form1.nuevo.disabled = true;
document.form1.save.disabled = false;
document.form1.del.disabled = true;
document.form1.first.disabled = true;
document.form1.prev.disabled = true;
document.form1.next.disabled = true;
document.form1.fin.disabled = true;
document.form1.ext.disabled = false;
document.form1.val.value=2;
var z=dhtmlXComboFromSelect("marca");
z.enableFilteringMode(true);
var z=dhtmlXComboFromSelect("line");
z.enableFilteringMode(true);
var z=dhtmlXComboFromSelect("clase");
z.enableFilteringMode(true);
var z=dhtmlXComboFromSelect("present");
z.enableFilteringMode(true);
var z=dhtmlXComboFromSelect("catp");
z.enableFilteringMode(true);
var v1 = parseInt(document.form1.ppg.value);
document.form1.pageno.value=v1;
document.form1.codigo.focus();
}
function precio(){
		var v1    = parseFloat(document.form1.price1.value);		//PRECIO DE COSTO
		var v2    = parseFloat(document.form1.price2.value);		//MARGEN
		var factr = parseFloat(document.form1.factor.value);			//FACTOR
		var valor = isNaN(factr);
	    if (valor == true)			////NO ES NUMERO
		{
		var factr = parseFloat(document.form1.factor.value);			//FACTOR
		}
		var a,b;
		a = parseFloat(v1 * ((v2/100)+1));
		a = Math.round(a*100)/100;
		if (factr > 0)
		{
		b = parseFloat(a/factr);
		b = Math.round(b*100)/100;
		}
		if(document.form1.price1.value!='' && document.form1.price2.value!=''){
			document.form1.price3.value=a;
			document.form1.price33.value=a;
			document.form1.price4.value=b;
			document.form1.price44.value=b;
		}else{
			document.form1.price3.value='';
			document.form1.price33.value='';
			document.form1.price4.value='';
			document.form1.price44.value='';
		}

}
function validar()
{
  var f = document.form1;
  if (f.des.value == "")
  { alert("Ingrese el nombre del Producto"); f.des.focus(); return; }
  if (f.factor.value == "")
  { alert("Ingrese el Factor"); f.factor.focus(); return; }
  /*if ((f.price1.value == "0.00") || (f.price1.value == ""))
  { alert("Ingrese el Precio de Costo"); f.price1.focus(); return; }
  if (f.price2.value < utdmin)
  {
  alert("La utilidad ingresada no corresponde segun la configuracion del Sistema"); document.form1.price2.focus();return;
  }
  else
  {
	  if ((f.price2.value == "0.00") || (f.price2.value == ""))
	  { alert("Ingrese el Margen de Utilidad"); f.price2.focus(); return; }
  }
  if ((f.price3.value == "0.00") || (f.price3.value == ""))
  { alert("Ingrese el Precio de Venta"); f.price3.focus(); return; }
  */
  if (f.marca.value == "")
  { alert("Seleccione una Marca"); f.marca.focus(); return; }
  if (f.line.value == "")
  { alert("Seleccione una Linea"); f.line.focus(); return; }
  if (f.clase.value == "")
  { alert("Seleccione una Clase"); f.clase.focus(); return; }
  if (f.present.value == "")
  { alert("Seleccione una Presentacion"); f.present.focus(); return; }
  if (f.catp.value == "")
  { alert("Seleccione una Categoria"); f.catp.focus(); return; }
  //VENTANA QUE CONFIRMA SI GRABO O NO?
  ventana=confirm("Desea Grabar estos datos");
  if (ventana) {
  document.form1.btn.value=4;
  f.method = "POST";
  f.action ="graba_producto.php";
  f.submit();
  }
  ///////////////////////////////////
}
</script>
<script language="JavaScript">
function primero()
{
	 var f = document.form1;
	 var v1 = parseInt(document.form1.first.value);
	 document.form1.pageno.value=v1;
	 f.method = "post";
	 f.action ="mov_prod.php";
	 f.submit();
}
function siguiente()
{
	 var f = document.form1;
	 var v1 = parseInt(document.form1.nextpage.value);
	 document.form1.pageno.value=v1;
	 f.method = "post";
	 f.action ="mov_prod.php";
	 f.submit();
}
function anterior()
{
	 var f = document.form1;
	 var v1 = parseInt(document.form1.prevpage.value);
	 document.form1.pageno.value=v1;
	 f.method = "post";
	 f.action ="mov_prod.php";
	 f.submit();
}
function ultimo()
{
	 var f = document.form1;
	 var v1 = parseInt(document.form1.lastpage.value);
	 document.form1.pageno.value=v1;
	 f.method = "post";
	 f.action ="mov_prod.php";
	 f.submit();
}
</script>
<script language="JavaScript">
function eliminar()
{
	 var f = document.form1;
	 ventana=confirm("Desea Eliminar este Producto");
	 if (ventana) {
	 document.form1.btn.value=5;
	 f.method = "POST";
	 f.action ="graba_producto.php";
	 f.submit();
	 }
}
function salir()
{
	 var f = document.form1;
	 document.form1.btn.value=6;
	 f.method = "POST";
	 f.action ="graba_producto.php";
	 f.submit();
}
</script>