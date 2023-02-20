<?php include('../../session_user.php');
require_once('../../../conexion.php');
//--------------------------------------------------------------------//
$val        = $_REQUEST['val'];
$p1         = $_REQUEST['p1'];
$ord        = $_REQUEST['ord'];
$codpro     = $_REQUEST['codpro'];
$cant       = $_REQUEST['cant'];
$cant2      = $_REQUEST['cant2'];
$monto      = $_REQUEST['monto'];
$price      = $_REQUEST['price'];
$cuota      = $_REQUEST['cuota'];
$inicio     = $_REQUEST['inicio'];
$pagina     = $_REQUEST['pagina'];
$tot_pag    = $_REQUEST['tot_pag'];
$factor     = $_REQUEST['factor'];
$codloc     = $_REQUEST['local'];
//$state      = $_REQUEST['state'];
$invnum     = $_REQUEST['incent'];
//$hour   = date('G');
$date	= date('Y-m-d');
//$date	= CalculaFechaHora($hour);
$registros  = $_REQUEST['registros'];
//--------------------------------------------------------------------//
$sql="SELECT codpro FROM incentivadodet where codpro = '$codpro' and invnum = '$invnum' and codloc = '$codloc'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$sihay = 1;
}
else
{
	$sihay = 0;
}
//--------------------------------------------------------------------//
if ($sihay == 1)
{
mysqli_query($conexion,"UPDATE incentivadodet set canprocaj = '$cant',canprounid = '$cant2',pripro = '$monto',pripromin = '$price', cuota = '$cuota',factor = '$factor' where codpro = '$codpro' and invnum = '$invnum' and codloc = '$codloc'");
}
else
{
$sql="SELECT estado FROM incentivado where invnum = '$invnum'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$state    = $row[0];
}
}
mysqli_query($conexion,"INSERT INTO incentivadodet (invnum,codpro,canprocaj,canprounid,pripro,pripromin,cuota,estado,factor,codloc) values ('$invnum','$codpro','$cant','$cant2','$monto','$price','$cuota','$state','$factor','$codloc')");
}
//--------------------------------------------------------------------//
$sql="SELECT sum(codpro) FROM incentivadodet where codpro = '$codpro' and invnum = '$invnum' and estado = '1'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$sumcodes    = $row[0];
}
}
//--------------------------------------------------------------------//
if ($sumcodes == 0)
{
mysqli_query($conexion,"UPDATE producto set incentivado = '0' where codpro = '$codpro'");
}
else
{
mysqli_query($conexion,"UPDATE producto set incentivado = '1' where codpro = '$codpro'");
}
header("Location: incentivo1.php?cod=$codpro&p1=$p1&val=$val&inicio=$inicio&pagina=$pagina&tot_pag=$tot_pag&registros=$registros&incent=$invnum&local=$codloc&valform=1");
?>