<?php require_once ('../../../conexion.php');	//CONEXION A BASE DE DATOS
$text	= $_REQUEST['text'];
$codloc = $_REQUEST['codloc'];
$imprapida	= $_REQUEST['imprapida'];
$habil   	= $_REQUEST['habil'];
mysqli_query($conexion,"update xcompa set nombre = '$text',imprapida = '$imprapida',habil = '$habil' where codloc = '$codloc'");
header("Location: index1.php?val=1&local=$codloc");
?>