<?php include('../session_user.php');
require_once ('../../conexion.php');	//CONEXION A BASE DE DATOS
require_once('../../titulo_sist.php');
require_once('../../convertfecha.php');
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
<?php require_once("funciones/mov_cliente.php");	//FUNCIONES DE ESTA PANTALLA
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
$pag= $_REQUEST['pageno'];
if (isset($_REQUEST['pageno'])) {
   $pageno = $_REQUEST['pageno'];
} else {
   $pageno = 1;
} 
$sql="SELECT count(codcli) FROM cliente";
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
$sql="SELECT codcli FROM cliente order by codcli desc limit 1";
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
if ($pageno > $lastpage) {
   $pageno = $lastpage;
} // if
if ($pageno < 1) {
   $pageno = 1;
} // if
$limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;
if ($search == 1)
{
$sql="SELECT codcli,descli,dircli,discli,dptcli,procli,telcli,telcli1,email,contact,ruccli,dnicli,limite,usado,estatus,ultfec,ulvta,tracli,vencli,cobcli,tipcli, sucursal,delivery FROM cliente where codcli= '$busqueda'";
}
else
{
$sql="SELECT codcli,descli,dircli,discli,dptcli,procli,telcli,telcli1,email,contact,ruccli,dnicli,limite,usado,estatus,ultfec,ulvta,tracli,vencli,cobcli,tipcli , sucursal,delivery FROM cliente $limit";
}
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result) ){
while ($row = mysqli_fetch_array($result)){
		$codcli          = $row['codcli'];		//codgio
		$descli          = $row['descli'];		//nombre
		$dircli          = $row["dircli"];		//direccion
		$discli          = $row["discli"];		//distrito
		$dptcli          = $row["dptcli"];		//departamento
		$procli          = $row["procli"];		//provincia
		$telcli          = $row["telcli"];		//telefono
		$telcli1         = $row["telcli1"];		//telefono  
		$email           = $row['email'];		//email 
		$contact         = $row["contact"];		//propietario
		$ruccli          = $row['ruccli'];		//ruc
		$dnicli          = $row['dnicli'];		//ruc
		$limite          = $row['limite'];		//credito limite
		$usado           = $row["usado"];		//credito usado
		$estatus         = $row["estatus"];		//Atender preferentemente, 2=Atender normalmente
		$ultfec          = fecha($row["ultfec"]);		//ULTIMA FECHA VENTA
		$ulvta           = $row["ulvta"];		//ULTIMO MONTO
		$tracli          = $row["tracli"];		//TRANSPORTISTA
		$vencli          = $row["vencli"];		//VENDEDOR
		$cobcli          = $row["cobcli"];		//COBRADOR
		$tipcli          = $row["tipcli"];		//COBRADOR
		$sucursal        = $row["sucursal"];		//COBRADOR
		$delivery        = $row["delivery"];		//COBRADOR
		$sql1="SELECT nombre,nomloc FROM xcompa where codloc = '$sucursal'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1) ){
		while ($row1 = mysqli_fetch_array($result1)){
		$local1          = $row1["nombre"];		//COBRADOR
		$local2          = $row1["nomloc"];		//COBRADOR
		}
		}
		if ($local1 == '')
		{
		$sucursal = $local2;
		}
		else
		{
		$sucursal = $local1;
		}
}
}
else
{
		$codcli        = 1;
}
?>
<?php require_once("funciones/call_combo.php");	//LLAMA A generaSelect
require_once("../../funciones/botones.php");	//COLORES DE LOS BOTONES
?>
<script  src="../../funciones/control.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../menu_block/stmenu.js"></script>
<script type="text/javascript" src="funciones/select_3_niveles.js"></script>
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
<div class="title">
<span class="titulos">SISTEMA DE VENTAS - Mantenimiento de Clientes 
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
<font color="#FFFF66" size="-2">- SE LOGRO ACTUALIZAR EL CLIENTE SELECCIONADO</font>
<?php } 
If ($del ==1)
{ 
?>
<font color="#FFFF66" size="-2">- SE LOGRO ELIMINAR EL CLIENTE INDICADO</font>
<?php } 
?>
</b>
</span>
</div>
<div class="mask11">
	<div class="mask22">
		<div class="mask33">
		<?php require ('mov_cliente1.php');?>
  	  </div>
	</div>
   </div>
  </div>
</body>
</html>
