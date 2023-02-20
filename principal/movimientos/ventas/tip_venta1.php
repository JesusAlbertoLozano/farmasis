<?php require_once('../../../conexion.php');
require_once('../../session_user.php');
$venta   = $_SESSION['venta'];
$tradio  = $_REQUEST['tradio'];
$num     = $_REQUEST['num'];
$tarjeta = $_REQUEST['tarjeta'];

if($tarjeta <> ''){
    
    if (!is_numeric($tarjeta)) {
        $tarjeta = strtoupper($tarjeta);
        mysqli_query($conexion, "INSERT INTO tarjeta (nombre ) values ('$tarjeta')");
        $id_tarjeta = mysqli_insert_id($conexion);
        $tarjeta = $id_tarjeta;
    }
    
}


mysqli_query($conexion, "UPDATE venta set forpag = '$tradio',codtab = '$tarjeta',numtarjet = '$num' where invnum = '$venta'");
header("Location: tip_venta.php?close=1");



