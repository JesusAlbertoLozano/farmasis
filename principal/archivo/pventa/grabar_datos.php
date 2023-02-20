<?php include('../../session_user.php');
require_once('../../../conexion.php');
$p1       = $_REQUEST['p1'];
$p2       = $_REQUEST['p2'];
$codpro   = $_REQUEST['codpro'];
$val      = $_REQUEST['val'];
$search   = $_REQUEST['search'];
$factor   = $_REQUEST['factor'];
$margene1 = $_REQUEST['margene1'];
$TablaD   = $_REQUEST['TablaD'];
$p3       = $_REQUEST['p3'];

if ($TablaD == "s001")
{
    $TablaPrevta = "prevta1";
    $TablaPreuni = "preuni1";
}
else
{
    if ($TablaD == "s002")
    {
        $TablaPrevta = "prevta2";
        $TablaPreuni = "preuni2";
    }
    else
    {
        $TablaPrevta = "prevta";
        $TablaPreuni = "preuni";
    }
}
//echo $factor;

//if ($factor<=1);
//    {
// $p3=$p2;
//    }
 
mysqli_query($conexion,"UPDATE producto set  prevta2 = '$p2',preuni2 = '$p3' where codpro = '$codpro'");
header("Location: precios2.php?search=$search&val=$val");
?>