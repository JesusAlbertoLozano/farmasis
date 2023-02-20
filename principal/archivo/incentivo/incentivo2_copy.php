<?php include('../../session_user.php');
require_once('../../../conexion.php');
$invnum     = $_REQUEST['invnum'];
$date       = date('Y-m-d');
$sql="SELECT invnum FROM incentivado order by invnum desc limit 1";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$invnums    = $row['invnum'];
	$invnums++;
}
}
$sql="SELECT descripcion FROM incentivado where invnum = '$invnum'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$descripcion    = $row["descripcion"];
}
}
//mysqli_query($conexion,"UPDATE incentivadodet set estado = '0'");
//mysqli_query($conexion,"UPDATE incentivado set estado = '0'");
mysqli_query($conexion,"INSERT INTO incentivado (invnum,dateini,datefin,estado,descripcion) values ('$invnums','$date','$date','1','$descripcion')");
$sql="SELECT codpro,canprocaj,canprounid,factor,pripro,pripromin,cuota,estado,codloc FROM incentivadodet where invnum = '$invnum'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$codpro    = $row['codpro'];
	$canprocaj = $row["canprocaj"];
	$canprounid= $row["canprounid"];
	$factor    = $row["factor"];
	$pripro    = $row["pripro"];
	$pripromin = $row["pripromin"];
	$cuota     = $row["cuota"];
	$estado    = $row["estado"];
	$codloc    = $row['codloc'];
	mysqli_query($conexion,"INSERT INTO incentivadodet (invnum,codpro,canprocaj,canprounid,factor,pripro,pripromin,cuota,estado,codloc) values ('$invnums','$codpro','$canprocaj','$canprounid','$factor','$pripro','$pripromin','$cuota','1','$codloc')");
}
}
header("Location: incentivo2.php");
?>