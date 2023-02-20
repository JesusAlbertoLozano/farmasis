<?php 
include('../../session_user.php');
require_once('../../../conexion.php');
//--------------------------------------------------------------------//
$val        = $_REQUEST['val'];
$p1         = $_REQUEST['p1'];
$ord        = $_REQUEST['ord'];
$codpro     = $_REQUEST['codpro'];
$inicio     = $_REQUEST['inicio'];
$pagina     = $_REQUEST['pagina'];
$tot_pag    = $_REQUEST['tot_pag'];
$registros  = $_REQUEST['registros'];
$invnum	    = $_REQUEST['invnum'];
$date1	    = $_REQUEST['date1'];
$date2	    = $_REQUEST['date2'];
$estado	    = $_REQUEST['estado'];
$desc	    = $_REQUEST['desc'];

//--------------------------------------------------------------------//
$sql="SELECT codpro FROM incentivadodet where invnum = '$invnum' group by codpro";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$codpro    = $row['codpro'];
	mysqli_query($conexion,"UPDATE producto set incentivado = '$estado' where codpro = '$codpro'");
}
}
//--------------------------------------------------------------------//
mysqli_query($conexion,"UPDATE incentivado set descripcion ='$desc',dateini = '$date1',datefin = '$date2',estado = '$estado' where invnum = '$invnum'");
mysqli_query($conexion,"UPDATE incentivadodet set estado = '$estado' where invnum = '$invnum'");
//--------------------------------------------------------------------//
if ($estado <> 0)
{
    $sql = "SELECT incentivado.invnum,dateini,datefin,codpro 
            FROM incentivado 
            inner join incentivadodet on incentivado.invnum = incentivadodet.invnum 
            where incentivado.estado = '1' and incentivado.invnum = '$invnum' and incentivadodet.estado = '1'
            order by incentivado.invnum";
    $result = mysqli_query($conexion,$sql);
    if (mysqli_num_rows($result)) 
    {
        while ($row = mysqli_fetch_array($result)) 
        {
            $invnumIncentivo    = $row['invnum'];
            $codpro             = $row['codpro'];
            //BUSCO EN LAS VENTAS QUE EST�N ENTRE LAS FECHAS SELECCIONADAS PARA APLICAR EL INCENTIVO
            $sqlX               = "SELECT invnum FROM detalle_venta where codpro = $codpro and invfec between '$date1' and '$date2'";
            $resultX            = mysqli_query($conexion,$sqlX);
            if (mysqli_num_rows($resultX)) 
            {
                while ($rowX = mysqli_fetch_array($resultX)) 
                {
                    $invnumVent     = $rowX['invnum'];
                    mysqli_query($conexion,"UPDATE detalle_venta set incentivo = '$invnumIncentivo' where invnum = '$invnumVent' and codpro = $codpro");
                }
            }
            //LOS QUE NO ESTEN EN ESTE RANGO SIMPLEMENTE EL INCENTIVO DE LA VENTA SERA IGUAL A CERO
            $sqlY               = "SELECT invnum FROM detalle_venta where codpro = $codpro and incentivo = '$invnumIncentivo' and invfec not between '$date1' and '$date2'";
            $resultY            = mysqli_query($conexion,$sqlY);
            if (mysqli_num_rows($resultY)) 
            {
                while ($rowY = mysqli_fetch_array($resultY)) 
                {
                    $invnumVent2     = $rowY['invnum'];
                    mysqli_query($conexion,"UPDATE detalle_venta set incentivo = '0' where invnum = '$invnumVent2' and codpro = $codpro");
                }
            }
        }
    }
}

header("Location: incentivo1.php?p1=$p1&val=$val&inicio=$inicio&pagina=$pagina&tot_pag=$tot_pag&registros=$registros");
?>