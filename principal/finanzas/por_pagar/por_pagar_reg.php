<?php require_once('../../../conexion.php');	//CONEXION A BASE DE DATOS
include('../../session_user.php');
$invnum		= $_REQUEST['invnum'];
$numplan    = $_REQUEST['numplan'];
//$hour		= date("H:i");
$hour  = date('G');  
//$hour  = CalculaHora($hour);
$min   = date('i');
$hour  = $hour.":".$min;
$sql1="SELECT invnum,invfec,nrocomp,provee,invtot,pendiente FROM ordmae where invnum = '$invnum'";	
$result1 = mysqli_query($conexion,$sql1);
if (mysqli_num_rows($result1)){
while ($row1 = mysqli_fetch_array($result1)){
    $invnum    = $row1['invnum'];
	$nrocomp   = $row1['nrocomp'];
	$provee    = $row1['provee'];
	$invtot    = $row1['invtot'];
}
}
if ($forpag == "L")
{
$date1     = $_REQUEST['date1'];
$tipdoc    = $_REQUEST['tipdoc'];
$forpag    = $_REQUEST['forpag'];
$doccancel = $_REQUEST['doccancel'];
$paga      = $_REQUEST['paga'];
$sald      = $_REQUEST['sald'];
$letra     = $_REQUEST['letra'];
$plazo     = $_REQUEST['plazo'];
$date2     = $_REQUEST['date2'];
$date3     = $_REQUEST['date3'];
$banco     = $_REQUEST['banco'];
$moneda    = $_REQUEST['moneda'];
mysqli_query($conexion,"INSERT INTO planilla (invnum,fecpla,tipdoc,numdoc,forpag,docref,monpag,codusu,hora,borrada,codprov) values ('$numplan','$date1','$tipdoc','$invnum','$forpag','$doccancel','$paga','$usuario','$hour','0','$provee')");
$sql1="SELECT invnum FROM planilla where numdoc = '$invnum' order by invnum desc limit 1";	
$result1 = mysqli_query($conexion,$sql1);
if (mysqli_num_rows($result1)){
while ($row1 = mysqli_fetch_array($result1)){
    $planilla    = $row1['invnum'];
}
}
mysqli_query($conexion,"INSERT INTO letras (invnum,codprov,fecha,monto,codusu,borrada,saldo,plazo,banco,fecven,fecpro,planilla,moneda) values ('$letra','$provee','$date1','$invtot','$usuario','0','$sald','$plazo','$banco','$date2','$date3','$planilla','$moneda')");
}
else
{
$date1     = $_REQUEST['date1'];
$tipdoc    = $_REQUEST['tipdoc'];
$forpag    = $_REQUEST['forpag'];
$doccancel = $_REQUEST['doccancel'];
$paga      = $_REQUEST['paga'];
$sald      = $_REQUEST['sald'];
mysqli_query($conexion,"INSERT INTO planilla (invnum,fecpla,tipdoc,numdoc,forpag,docref,monpag,codusu,hora,borrada,codprov) values ('$numplan','$date1','$tipdoc','$invnum','$forpag','$doccancel','$paga','$usuario','$hour','0','$provee')");
}
header("Location: por_pagar1.php?valid=1&val=1&numdoc=$nrocomp"); 
?>