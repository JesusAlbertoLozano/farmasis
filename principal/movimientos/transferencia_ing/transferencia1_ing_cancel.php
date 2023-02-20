<?php include('../../session_user.php');
require_once ('../../../conexion.php');
$transferencia_ing 	 = $_SESSION['transferencia_ing'];
$sql1 = "DELETE from tempmovmov where invnum = '$transferencia_ing'";
mysqli_query($conexion,$sql1);
if (mysqli_errno($conexion))
    error_log("Elimina Linea Temp SQL(".$sql1.")\nError(".mysqli_error($conexion).")");
$sql1 = "DELETE from movmov where invnum = '$transferencia_ing'";
mysqli_query($conexion,$sql1);
if (mysqli_errno($conexion))
    error_log("Elimina Linea Mov SQL(".$sql1.")\nError(".mysqli_error($conexion).")");
header("Location: transferencia_ing.php"); 
?>