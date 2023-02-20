<?php include('../session_user.php');
require_once ('../../conexion.php');	//CONEXION A BASE DE DATOS
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
<link href="css/select_cli.css" rel="stylesheet" type="text/css">
<?php require_once("funciones/mov_proveedor.php");	//FUNCIONES DE ESTA PANTALLA
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
$pag       = $_REQUEST['pageno'];
$ultimo    = $_REQUEST['ultimo'];
if (isset($_REQUEST['pageno'])) {
   $pageno = $_REQUEST['pageno'];
} else {
   $pageno = 1;
} 
$sql="SELECT count(*) FROM proveedor";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result) ){
while ($row = mysqli_fetch_array($result)){
		$numrows             = $row[0];
}
}
$busqueda = $_REQUEST['country_ID'];
$search	  = $_REQUEST['search'];		////1 ACTIVO
$word	  = $_REQUEST['word'];			////PALABRA BUSCADA
if ($search == "")
{
$search = 0;
$busqueda = "";
}
/////SELECCIONO EL ULTIMO CODIGO
$sql="SELECT codpro FROM proveedor order by codpro desc limit 1";
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
$sql="SELECT codpro,despro,dirpro,dispro,dptpro,propro,telpro,contac,rucpro,email,pagweb,tipcli,lcredito,representante,nextel,mail FROM proveedor where codpro = '$busqueda'";
}
else
{
$sql="SELECT codpro,despro,dirpro,dispro,dptpro,propro,telpro,contac,rucpro,email,pagweb,tipcli,lcredito,representante,nextel,mail FROM proveedor $limit";
}
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result) ){
while ($row = mysqli_fetch_array($result)){
		$codpro           = $row['codpro'];	//codgio
		$despro           = $row['despro'];		//nombre
		$dirpro           = $row["dirpro"];		//direccion
		$dispro           = $row["dispro"];		//distrito
		$dptpro           = $row["dptpro"];		//departamento
		$propro           = $row["propro"];		//provincia
		$telpro           = $row["telpro"];		//telefono
		$contac           = $row["contac"];		//propietario
		$rucpro           = $row["rucpro"];		//ruc
		$email            = $row['email'];		//email
		$pagweb           = $row["pagweb"];		//pagina web
		$tipcli           = $row["tipcli"];		//tipo de empresa, proveedor
		$lcredito         = $row["lcredito"];		//tipo de empresa, proveedor
		$representante    = $row["representante"];		//tipo de empresa, proveedor
		$nextel           = $row["nextel"];		//tipo de empresa, proveedor
		$mail             = $row["mail"];		//tipo de empresa, proveedor
}
}
else
{
		$codpro        = 1;
}
?>
<?php require_once("funciones/call_combo.php");	//LLAMA A generaSelect
require_once("../../funciones/botones.php");	//COLORES DE LOS BOTONES
?>
<script type="text/javascript" language="JavaScript1.2" src="/comercial/funciones/control.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../menu_block/stmenu.js"></script>
</head>
<body onLoad="sf();">
<?php function formato($c) {
printf("%08d",  $c);
} 
function formato1($c) {
printf("%06d",  $c);
} 
?>
<div class="tabla1">
<script type="text/javascript" language="JavaScript1.2" src="../menu_block/men.js"></script>
<script type="text/javascript" src="funciones/select_3_niveles.js"></script>
<div class="title">
<span class="titulos">SISTEMA DE VENTAS - Mantenimiento de Proveedores 
<b>
<?php $up		= $_REQUEST['up'];
$del	= $_REQUEST['del'];
$error	= $_REQUEST['error'];
$ok		= $_REQUEST['ok'];
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
<font color="#FFFF66" size="-2">- SE LOGRO ACTUALIZAR EL PROVEEDOR SELECCIONADO</font>
<?php } 
If ($del ==1)
{ 
?>
<font color="#FFFF66" size="-2">- SE LOGRO ELIMINAR EL PROVEEDOR INDICADO</font>
<?php } 
?>
</b>
</span>
</div>
<div class="mask111">
	<div class="mask222">
		<div class="mask333">
		<?php require ('mov_proveedor1.php');?>
  	  </div>
	</div>
   </div>
  </div>
</body>
</html>
