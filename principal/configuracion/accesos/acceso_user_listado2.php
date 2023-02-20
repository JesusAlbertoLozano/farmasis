<?php
require_once("../../../conexion.php");
include('../../session_user.php');
$clave  = $_REQUEST['clave'];
$grupo  = $_REQUEST['grupo'];
$usecod = $_REQUEST['usecod'];
$codgrup= $_REQUEST['codgrup'];
$excel  = $_REQUEST['excel'];
$local  = $_REQUEST['local'];
$claveventa  = "c".$_REQUEST['claveventa'];
$sql = "SELECT logusu,nomusu FROM usuario WHERE (claveventa = '$claveventa')";
$result = mysqli_query($conexion,$sql);
if(mysqli_fetch_array($result))
{
	header("Location: acceso_user_listado.php?error=1&val=1&codgrup=$codgrup");
}
else
{
mysqli_query($conexion,"UPDATE usuario set claveventa = '$claveventa',pasusu = '$clave', codgrup = '$grupo', export = '$excel',codloc = '$local' where usecod = '$usecod'");
header("Location: acceso_user_listado.php?codgrup=$codgrup");
}
?>