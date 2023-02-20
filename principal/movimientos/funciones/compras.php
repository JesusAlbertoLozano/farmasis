<script language="JavaScript">
function grabar1()
{
	var f = document.form1;
	if (f.combo_zone1.value == 0)
                {
                    alert("Seleccione un Proveedor");
                    f.combo_zone1.focus();
                    return;
                }
                if (f.combo_zone2.value == 0)
                {
                    alert("Seleccione una Empresa");
                    f.combo_zone2.focus();
                    return;
                }
	if (f.date1.value == "")
		{ alert("Ingrese la Fecha del Documento"); f.date1.focus(); return; }
	if (f.n1.value == "")
		{ alert("Ingrese el Nro del Documento"); f.n1.focus(); return; }
	if (f.n2.value == "")
		{ alert("Ingrese el Nro del Documento"); f.n2.focus(); return; }
	if (f.fpago.value == "")
		{ alert("Ingrese el tipo de Pago"); f.fpago.focus(); return; }
	if (f.plazo.value == "")
		{ alert("Ingrese el plazo"); f.plazo.focus(); return; }
	if (f.date2.value == "")
		{ alert("Ingrese la Fecha de Vencimiento"); f.date2.focus(); return; }
	if ((f.mont5.value == "") || (f.mont5.value == "0.00"))
		{ alert("El sistema arroja un TOTAL = a 0. Revise por Favor!"); f.mont5.focus(); return; }
	ventana=confirm("Desea Grabar estos datos");
	if (ventana) {
		f.method = "POST";
		f.target = "_top";
		f.action ="compras1_reg.php";
		f.submit();
	}
}
function cancelar()
{
	 var f = document.form1;
	 f.method = "POST";
	 f.target = "_top";
	 f.action ="compras1_del.php";
	 f.submit();
}
function producto()
{
	
//	 f.action ="../../archivo/mov_prod.php";
         window.open("mov_prod.php",  "PRODUCTOS", "width=820, height=600")
}
function proveedor()
{
	
//	 f.action ="../../archivo/mov_prod.php";
         window.open("mov_proveedor.php",   "PROVEEDOR", "width=820, height=470")
	
}
function validar_prod(){
	var f = document.form1;
	var v1 = parseFloat(document.form1.text1.value);		//CANTIDAD
	var valor = isNaN(v1);
	if (valor == true)
	{
		document.form1.number.value=1;		////avisa que no es numero
	}
	else
	{
		document.form1.number.value=0;		////avisa que es numero
	}
	if ((f.text1.value == "") || (f.text1.value == "0"))
		{ alert("Ingrese una Cantidad"); f.text1.focus(); return; }
	if ((f.text2.value == "") || (f.text2.value == "0.00"))
		{ alert("Ingrese el Precio"); f.text2.focus(); return; }
	//VENTANA QUE CONFIRMA SI GRABO O NO?
	f.method = "POST";
	f.target = "comp_principal";
	f.action ="compras4.php";
	f.submit();
}
function validar_grid(){
	var f = document.form1;
	f.method = "POST";
	f.action ="compras3.php";
	f.submit();
}
function buscar(){
	var f = document.form1;
	if (f.textos.value == "")
		{ alert("Ingrese un Numero de Documento"); f.textos.focus(); return; }
	f.method = "POST";
	f.target = "_top";
	f.action ="compras1_session.php";
	f.submit();
}
function precio(){
	var ckigv = "<?php echo $ckigv;?>";
	//console.log(document.form1.porcentaje.value);
	//console.log(ckigv);
	if (document.form1.text3.value == "")
	{
		document.form1.text3.value = 0;
	}
	if (document.form1.text4.value == "")
{
		document.form1.text4.value = 0;
	}
	if (document.form1.text5.value == "")
	{
		document.form1.text5.value = 0;
	}
	var v1 = parseFloat(document.form1.text1.value);		//CANTIDAD
	var v2 = parseFloat(document.form1.text2.value);		//PRECIO
	var v3 = parseFloat(document.form1.text3.value);		//DESCUENTO1
	var v4 = parseFloat(document.form1.text4.value);		//DESCUENTO2
	var v5 = parseFloat(document.form1.text5.value);		//DESCUENTO3
	var factor = parseFloat(document.form1.factor.value);	//FACTOR
	var stock  = parseFloat(document.form1.stockpro.value);	//STOCK ACTUAL
	var p      = parseFloat(document.form1.porcentaje.value);	//PORCENTAJE
	var a;
	var b;
	var c;
	var pventa;
	var total;
	var porcent;
	var promedio;
	a = parseFloat(1 - (v3/100));
	b = parseFloat(1 - (v4/100));
	c = parseFloat(1 - (v5/100));
	if (ckigv!=="1" && document.form1.porcentaje.value !== "")
	{   
	    porcent = parseFloat(1 + (p/100));
		pventa = parseFloat(v2 * (a * b * c) * porcent);
			pventa = parseFloat(v2 * (a) * porcent);
		
	}
	else
	{
		porcent = 1;
		pventa = parseFloat(v2 * (a * b * c) * porcent);
		pventa = parseFloat(v2 * (a) * porcent);
	}
	pventa = Math.round(pventa*Math.pow(10,2))/Math.pow(10,2); 
        
	var valor = isNaN(v1);
	if (valor == true)
	{
		//var porcion = v1.substring(1); // porcion = "ndo"
		var porcion = document.form1.text1.value.substring(1);
		var fact	= parseFloat(porcion/factor);
		total   = parseFloat(fact * pventa);
		document.form1.number.value=1;		////avisa que no es numero
	}
	else
	{
		total  = parseFloat(v1 * pventa);
		document.form1.number.value=0;		////avisa que es numero
	}
	total = Math.round(total*Math.pow(10,2))/Math.pow(10,2); 
	if(document.form1.text1.value!='' && document.form1.text2.value!=''){
		document.form1.text6.value=pventa;
//		document.form1.price.value=pventa;
		document.form1.text7.value=total;
	}
	else
	{
		document.form1.text6.value='';
		document.form1.text7.value='';
//                document.form1.price.value='';
	}

}

function sf()
{
    document.form1.price1.focus();
    var f = document.form1;
    var v1 = parseFloat(document.form1.text6.value);		//precio
    var v2 = parseFloat(document.form1.price1.value);		//margen
    var v3 = parseFloat(document.form1.factor.value);		//factor
    if (document.form1.price1.value === "")
    {
        document.form1.price1.value = 0;
        v2=0;
    }
    a               = parseFloat(1 + (v2/100));
    pventa          = parseFloat(v1 * a);
    pventa          = Math.round(pventa*Math.pow(10,2))/Math.pow(10,2); 
    //pventaunit      = parseFloat(pventa / v3);
    //pventaunit      = Math.round(pventaunit*Math.pow(10,2))/Math.pow(10,2); 
    f.price2.value  = pventa;
    f.price3.value  = pventaunit;
}
function precioo()
{
    var f = document.form1;
    var v1 = parseFloat(document.form1.text6.value);		//precio
    var v2 = parseFloat(document.form1.price1.value);		//margen caja
    var v3 = parseFloat(document.form1.factor.value);		//factor
    if (document.form1.price1.value === "")
    {
        document.form1.price1.value = 0;
        v2=0;
    }
    a = parseFloat(1 + (v2/100));
    pventa = parseFloat(v1 * a);
    pventa = Math.round(pventa*Math.pow(10,2))/Math.pow(10,2); 
    //pventaunit = parseFloat(pventa / v3);
    //pventaunit = Math.round(pventaunit*Math.pow(10,2))/Math.pow(10,2); 
    
    f.price2.value = pventa;                        //precio de venta uni caja
    /////
    //f.price3.value = pventaunit;                  //precio de venta uni
}
function precio1()
{
    var f = document.form1;
    var v1 = parseFloat(document.form1.text6.value);		//precio costo
    var v2 = parseFloat(document.form1.price2.value);		//precio caja
    var v3 = parseFloat(document.form1.factor.value);		//factor
    if (v3 === 0)
    {
        v3  = 1;
    }
    var rpc = 0;
    rpc = ((v2 - v1)/v1)*100;
    rpc = Math.round(rpc*Math.pow(10,2))/Math.pow(10,2);
    f.price1.value = rpc;   
}

function precioUni()
{
    var f = document.form1;
    var v1 = parseFloat(document.form1.text6.value);		//precio
    var v2 = parseFloat(document.form1.priceU.value);		//margen unidad
    var v3 = parseFloat(document.form1.factor.value);		//factor
    if (document.form1.price1.value === "")
    {
        document.form1.price1.value = 0;
        v2=0;
    }
    a = parseFloat(1 + (v2/100));
    pventa = parseFloat(v1 * a);
    pventa = Math.round(pventa*Math.pow(10,2))/Math.pow(10,2); 
    pventaunit = parseFloat(pventa / v3);
    pventaunit = Math.round(pventaunit*Math.pow(10,2))/Math.pow(10,2); 
    //f.price2.value = pventa;
    // if $factor=1
    // {
    //             pventaunit=$tprevta ;
    // }
  f.price3.value = pventaunit;                                //precio de venta uni
}

function precioUni1()
{
    var f = document.form1;
    var v1 = parseFloat(document.form1.text6.value);		//precio costo
    var v2 = parseFloat(document.form1.price3.value);		//precio unidad
    var v3 = parseFloat(document.form1.factor.value);		//factor
    if (v3 === 0)
    {
        v3  = 1;
    }
    var rpu1        = (v1/v3);
    var rpu         = ((v2 - rpu1)/rpu1)*100;
    rpu = Math.round(rpu*Math.pow(10,2))/Math.pow(10,2); 
    f.priceU.value = rpu;      
}

function consult_validar()
{
	  var f = document.form1;
	  if (f.numero.value == "")
		  { alert("Ingrese el Nro del Documento"); f.numero.focus(); return; }
	  f.method = "POST";
	  f.action ="consult_compras1.php";
	  f.submit();
}
function cancelar_consult()
{
	 var f = document.form1;
	 ventana=confirm("Desea cancelar y salir de esta Aplicacion");
	 if (ventana) {
		f.method = "POST";
		f.target = "_top";
		f.action ="../ing_salid.php";
		f.submit();
	 }
}
function fc(){
	document.form1.text1.focus();
}
function ValidarIGV()
{
	var f = document.form1;
	f.method = "post";
	f.action = "compras1.php";
	f.submit();
}
function searchs(){
	var f = document.form1;
	if (f.alfa1.value == "")
		{ alert("Seleccione un Proveedor"); f.alfa1.focus(); return; }
	if (f.alfa1.value == 0)
		{ alert("Seleccione un Proveedor"); f.alfa1.focus(); return; }
	if (f.nrocompra.value == "")
		{ alert("Ingrese el Numero de la Orden de Compra"); f.nrocompra.focus(); return; }
	f.method = "post";
	f.action = "compras_busca.php";
	f.submit();
}
function searchs2(){
	var f = document.form1;
	if (f.alfa1.value == "")
		{ alert("Seleccione un Proveedor"); f.alfa1.focus(); return; }
	if (f.alfa1.value == 0)
		{ alert("Seleccione un Proveedor"); f.alfa1.focus(); return; }
	var prov = f.alfa1.value;
	f.DatosProveedor.value = prov;
	f.method = "post";
	f.action = "compras1.php";
	f.submit();
}
function searchs3(){
	var f = document.form1;
	if (f.alfa2.value == "")
		{ alert("Seleccione una Empresa"); f.alfa2.focus(); return; }
	if (f.alfa2.value == 0)
		{ alert("Seleccione una Empresa"); f.alfa2.focus(); return; }
	var empre = f.alfa2.value;
	f.DatosEmpresa.value = empre;
	f.method = "post";
	f.action = "compras1.php";
	f.submit();
}
function carga(){
	document.form1.date1.disabled = false;
	document.form1.date2.disabled = false;
	document.form1.moneda.disabled = false;
	document.form1.n1.disabled = false;
	document.form1.n2.disabled = false;
	document.form1.textfield3.disabled = false;
	document.form1.plazo.disabled = false;
	document.form1.fpago.disabled = false;
	document.form1.ckigv.disabled = false;
    document.form1.fpago.focus();
}
function carga1(){
	document.form1.nrocompra.focus();
	document.form1.date1.disabled = true;
	document.form1.date2.disabled = true;
	document.form1.moneda.disabled = true;
	document.form1.n1.disabled = true;
	document.form1.n2.disabled = true;
	document.form1.textfield3.disabled = true;
	document.form1.plazo.disabled = true;
	document.form1.fpago.disabled = true;
	document.form1.ckigv.disabled = true;
        document.form1.fpago.focus();
}
function sf(){
	document.form1.first.disabled = true;
	document.form1.next.disabled = true;
	document.form1.prev.disabled = true;
	document.form1.fin.disabled = true;
	document.form1.nuevo.disabled = true;
	document.form1.modif.disabled = true;
}
function sssf(){
	document.form1.country.focus();
}
function ss(){
	document.form1.first.disabled = true;
	document.form1.next.disabled = true;
	document.form1.prev.disabled = true;
	document.form1.fin.disabled = true;
	document.form1.nuevo.disabled = true;
	document.form1.modif.disabled = true;
	alert("Falta ingresar lotes en la compra seleccionada");
}
function links(){
	document.getElementById('l1').focus()
}
</script>