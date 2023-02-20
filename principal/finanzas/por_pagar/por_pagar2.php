<?php require_once('../../../conexion.php');	//CONEXION A BASE DE DATOS
$val    = $_REQUEST['val'];
$numdoc = $_REQUEST['numdoc'];
$sql1="SELECT invnum FROM ordmae where nrocomp = '$numdoc'";
$result1 = mysqli_query($conexion,$sql1);
if (mysqli_num_rows($result1)){
while ($row1 = mysqli_fetch_array($result1)){
    $invnum    = $row1['invnum'];
}
header("Location: por_pagar1.php?valid=1&numdoc=$numdoc&invnum=$invnum&val=1");
}
else
{
header("Location: por_pagar1.php?valid=0&val=1&numdoc=$numdoc");
}
?>