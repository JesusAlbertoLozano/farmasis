<?php

require_once('../../session_user.php');
require_once('../../../conexion.php');
$venta = $_SESSION['venta'];
$deliveryWeb = $_REQUEST['deliveryWeb'];
mysqli_query($conexion, "UPDATE venta set deliveryWeb='$deliveryWeb'  where invnum = '$venta'");

header("Location: venta_index1.php?deliveryWeb=$deliveryWeb");
