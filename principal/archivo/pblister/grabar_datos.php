<?php include('../../session_user.php');
require_once('../../../conexion.php');
$p3       = $_REQUEST['p3'];
$blister  = $_REQUEST['blister'];
$codpro   = $_REQUEST['codpro'];
$val      = $_REQUEST['val'];
$search   = $_REQUEST['search'];
mysqli_query($conexion,"UPDATE producto set preblister = '$p3',blister = '$blister' where codpro = '$codpro'");
header("Location: pventa2.php?search=$search&&val=1");
?>