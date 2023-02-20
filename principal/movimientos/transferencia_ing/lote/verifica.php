<?php include('../../../session_user.php');
$invnum  = $_SESSION['transferencia_ing'];
require_once ('../../../../conexion.php');
$numero  = $_REQUEST['country'];
$codpro  = $_REQUEST['codpro'];
if ($numero <> "")
{
	$sql1 = "UPDATE tempmovmov set numlote = '$numero' where invnum = '$invnum' and codpro = '$codpro'";
	mysqli_query($conexion, $sql1);
	if (mysqli_errno($conexion))
		error_log("Actualiza Linea Temp SQL(".$sql1.")\nError(".mysqli_error($conexion).")");
}
header("Location: lote.php?cod=$codpro");
?>