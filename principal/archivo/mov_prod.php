<?php include('../session_user.php');
require_once('../../conexion.php');	//CONEXION A BASE DE DATOS
require_once('../../titulo_sist.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $desemp?></title>
<link href="css/tablas.css" rel="stylesheet" type="text/css" />
<link href="../css/body.css" rel="stylesheet" type="text/css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="css/select_pro.css" rel="stylesheet" type="text/css">
<?php require_once("funciones/mov_prod.php");	//FUNCIONES DE ESTA PANTALLA
require_once("../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
require_once("../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../funciones/funct_principal.php");	//IMPRIMIR-NUMEROS ENTEROS-DECIMALES
require_once("../local.php");	//LOCAL DEL USUARIO
$sql="SELECT nomusu FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
		$user    = $row['nomusu'];
}
}
$pag             = isset($_REQUEST['pageno']) ? ($_REQUEST['pageno']) : "";
$ultimo          = isset($_REQUEST['ultimo']) ? ($_REQUEST['ultimo']) : "";
if (isset($_REQUEST['pageno'])) {
   $pageno = $_REQUEST['pageno'];
} else {
   $pageno = 1;
} 
$sql="SELECT count(codpro) FROM producto";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result) ){
while ($row = mysqli_fetch_array($result)){
		$numrows             = $row[0];
}
}
$busqueda = isset($_REQUEST['country_ID']) ? ($_REQUEST['country_ID']) : "";
$search	  = isset($_REQUEST['search']) ? ($_REQUEST['search']) : "";
$word	  = isset($_REQUEST['word']) ? ($_REQUEST['word']) : "";
if ($search == "")
{
$search = 0;
$busqueda = "";
}
/////SELECCIONO EL ULTIMO CODIGO
$sql="SELECT codpro FROM producto order by codpro desc limit 1";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result) ){
while ($row = mysqli_fetch_array($result)){
		$fincod        = $row[0];
}
}
else
{
		$fincod        = 0;
}
/////////////////////////////////
$rows_per_page = 1;
$lastpage      = ceil($numrows/$rows_per_page);
$pageno = (int)$pageno;
if ($ultimo==1)
{
$pageno = $lastpage;
}
if ($pageno > $lastpage) {
   $pageno = $lastpage;
} // if
if ($pageno < 1) {
   $pageno = 1;
} // if
$limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;
if ($search == 1)
{
$sql="SELECT codpro,desprod,codbar,factor,margene,stopro,moneda,prevta,imapro,detpro,cant1,cant2,cant3,desc1,desc2,desc3,activo,prelis,prevta,preuni,margene,costre,stopro,codmar,coduso,codfam,igv,incentivado,blister,lotec,codpres,activo1,costpr,utlcos FROM producto where codpro = '$busqueda' and codpro <> 0";
}
else
{
$sql="SELECT codpro,desprod,codbar,factor,margene,stopro,moneda,prevta,imapro,detpro,cant1,cant2,cant3,desc1,desc2,desc3,activo,prelis,prevta,preuni,margene,costre,stopro,codmar,coduso,codfam,igv,incentivado,blister,lotec,codpres,activo1,costpr,utlcos FROM producto where codpro <> 0 $limit";
}
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result) ){
while ($row = mysqli_fetch_array($result)){
		$codpro          = $row['codpro'];
		$desprod         = $row['desprod'];
		$codbar          = $row["codbar"];
		$factor          = $row["factor"];
		$margene         = $row["margene"];
		$stopro          = $row["stopro"];
		$moneda          = $row["moneda"];
		$prevta          = $row["prevta"];
		$imapro          = $row["imapro"];
		$detpro          = $row["detpro"];
		$cant1           = $row["cant1"];
		$cant2           = $row["cant2"];
		$cant3           = $row["cant3"];
		$desc1           = $row["desc1"];
		$desc2           = $row["desc2"];
		$desc3           = $row["desc3"];
		$activo          = $row["activo"];			///0=desactivo-----1=activo
		$prelis          = $row["prelis"];
		$preuni          = $row["preuni"];
		$costre          = $row["costre"];
		$codmar          = $row["codmar"];
		$coduso          = $row["coduso"];
		$codfam          = $row["codfam"];
		$igv	         = $row["igv"];
		$inc	         = $row["incentivado"];
		$blister         = $row["blister"];
		$lotec           = $row["lotec"];
		$codpres         = $row["codpres"];
		$activo1         = $row["activo1"];
                $costpr          = $row["costpr"];
                $utlcos          = $row["utlcos"];
                $margeneuni      = $row["margeneuni"];
		
		if ($factor == 0)
        {
        	$factor = 1;
        }
        $convert1   = $stopro/$factor;
        $div1    	= floor($convert1);
        $mult1		= $factor * $div1;
        $tot1		= $stopro - $mult1;
        $CantidadFactor = $div1."F".$tot1;
        //echo $stopro."-".$factor;
}
}
else
{
		$codpro        = 1;
		$CantidadFactor= 0;
}
?>
<?php require_once("../../funciones/botones.php");	//COLORES DE LOS BOTONES?>
<link rel="STYLESHEET" type="text/css" href="../../funciones/codebase/dhtmlxcombo.css">
<script>
window.dhx_globalImgPath="../../funciones/codebase/imgs/";
</script>
<script  src="../../funciones/codebase/dhtmlxcommon.js"></script>
<script  src="../../funciones/control.js"></script>
<script  src="../../funciones/codebase/dhtmlxcombo.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../menu_block/stmenu.js"></script>
<script>
function openPopup(url) {
myPopup = window.open(url,'popupWindow','width=460,height=28,top=300,left=550');
if (!myPopup.opener)
myPopup.opener = window;
}
function copyForm1() {
	var f = myPopup.document.popupForm.myTextField.value;
	if (f == "")
	{
		alert("DEBE INGRESAR UNA DESCRIPCION");myPopup.document.popupForm.myTextField.focus();return;
	}
	else
	{
	var i = document.forms[0].marca.length;
	var myNewOption = new
	Option(myPopup.document.forms[0].myTextField.value, myPopup.document.forms[0].myTextField.value);
	document.forms[0].marca.options[i] = myNewOption;
	document.forms[0].marca.selectedIndex = i;
	myPopup.window.close();
	return false;
	}
}
function copyForm2() {
	var f = myPopup.document.popupForm.myTextField.value;
	if (f == "")
	{
		alert("DEBE INGRESAR UNA DESCRIPCION");myPopup.document.popupForm.myTextField.focus();return;
	}
	else
	{
	var i = document.forms[0].line.length;
	var myNewOption = new
	Option(myPopup.document.forms[0].myTextField.value, myPopup.document.forms[0].myTextField.value);
	document.forms[0].line.options[i] = myNewOption;
	document.forms[0].line.selectedIndex = i;
	myPopup.window.close();
	return false;
	}
}
function copyForm3() {
	var f = myPopup.document.popupForm.myTextField.value;
	if (f == "")
	{
		alert("DEBE INGRESAR UNA DESCRIPCION");myPopup.document.popupForm.myTextField.focus();return;
	}
	else
	{
	var i = document.forms[0].clase.length;
	var myNewOption = new
	Option(myPopup.document.forms[0].myTextField.value, myPopup.document.forms[0].myTextField.value);
	document.forms[0].clase.options[i] = myNewOption;
	document.forms[0].clase.selectedIndex = i;
	myPopup.window.close();
	return false;
	}
}
function copyForm4() {
	var f = myPopup.document.popupForm.myTextField.value;
	if (f == "")
	{
		alert("DEBE INGRESAR UNA DESCRIPCION");myPopup.document.popupForm.myTextField.focus();return;
	}
	else
	{
	var i = document.forms[0].present.length;
	var myNewOption = new
	Option(myPopup.document.forms[0].myTextField.value, myPopup.document.forms[0].myTextField.value);
	document.forms[0].present.options[i] = myNewOption;
	document.forms[0].present.selectedIndex = i;
	myPopup.window.close();
	return false;
	}
}
</script>
</head>
<body onLoad="sf();" onkeydown="ctrls(event)" onkeyup="prods(event)" onkeypress="return pulsar(event)">
<?php function formato($c) {
printf("%08d",  $c);
} 
function formato1($c) {
printf("%06d",  $c);
} 
?>
<div class="tabla1">
<script type="text/javascript" language="JavaScript1.2" src="../menu_block/men.js"></script>
<div class="title" height="50">
<span class="titulos">SISTEMA DE VENTAS - Mantenimiento de Producto 
<b>
<?php 
$up		= isset($_REQUEST['up']) ? ($_REQUEST['up']) : "";
$del	= isset($_REQUEST['del']) ? ($_REQUEST['del']) : "";
$error	= isset($_REQUEST['error']) ? ($_REQUEST['error']) : "";
$ok		= isset($_REQUEST['ok']) ? ($_REQUEST['ok']) : "";
If ($error == 2)
{ 
?>
<font color="#FF0000" size="-2">ERROR!</font><font color="#FFFF66" size="-2"> - NO SE PUDO GRABAR!. LOS DATOS INGRESADOS YA SE ENCUENTRAN REGISTRADOS.</font>
<?php } 
If ($ok == 1)
{ 
?>
<font color="#FFFF66" size="-2">- SE LOGRO GRABAR EXITOSAMENTE LOS DATOS</font>
<?php } 
If ($up ==1)
{ 
?>
<font color="#FFFF66" size="-2">- SE LOGRO ACTUALIZAR EL PRODUCTO SELECCIONADO</font>
<?php } 
If ($up ==2)
{ 
?>
<font color="#FFFF66" size="-2">- NO SE LOGRO ACTUALIZAR LA INFORMACION EN EL SISTEMA </font>
<?php } 
If ($up ==3)
{ 
?>
<font color="#f80000" size="-2">- EL PRODUCTO YA REGISTRA INGRESO DE MERCADERIA OPERACION IVALIDA  </font>
<?php } 
If ($del ==1)
{ 
?>
<font color="#FFFF66" size="-2">- SE LOGRO ELIMINAR EL PRODUCTO INDICADO</font>
<?php } 
If ($del ==2)
{ 
?>
<font color="#EC2727" size="-2">- NO SE PUDO ELIMINAR EL PRODUCTO SELECCIONADO</font>
<?php } 
?>
</b>
</span>
</div>
<div class="mask1">
	<div class="mask2">
		<div class="mask3">
		<?php require ('mov_prod1.php');?>
  	  </div>
	</div>
   </div>
  </div>
</body>
</html>
