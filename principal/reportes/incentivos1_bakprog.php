<?php include('../session_user.php');
require_once('../../conexion.php');
require_once('../../titulo_sist.php');
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=SIST_EXPORT_DATA.xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $desemp?></title>
</head>
<?php require_once("../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../funciones/funct_principal.php");	//IMPRIMIR-NUME
$sql="SELECT nomusu FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$user    = $row['nomusu'];
}
}
$hour   = date('G');
//$date	= CalculaFechaHora($hour);
$date = date("Y-m-d");
//$hour   = CalculaHora($hour);
$min	= date('i');
if ($hour <= 12)
{
    $hor    = "am";
}
else
{
    $hor    = "pm";
}
$nro    = $_REQUEST['nro'];
$val    = $_REQUEST['val'];
$tipo   = $_REQUEST['tipo'];
$local  = $_REQUEST['local'];
$ccc    = explode(",",$nro);
$contador = count($ccc);
$rr = 0;
////////////////////////////////////////////////////////
?>
 <body>
        <table width="930" border="0" align="center">
            <tr>
                <td><table width="914" border="0">
                        <tr>
                            <td width="271"><strong><?php echo $desemp ?></strong></td>
                            <td width="358"><div align="center"><strong>REPORTE DE PRODUCTOS INCENTIVADOS </strong></div></td>
                            <td width="271"><div align="right"><strong>FECHA: <?php echo date('d/m/Y'); ?> - HORA : <?php echo $hour; ?>:<?php echo $min; ?> <?php echo $hor ?></strong></div></td>
                        </tr>

                    </table>
                    <table width="914" border="0">
                        <tr>
                            <td width="271"><strong>PAGINA <?php echo $pagina; ?> de <?php echo $tot_pag ?></strong></td>
                            <td width="358"><div align="center">NRO DE INCENTIVO CONSULTADO: <?php echo $nro ?></div></td>
                            <td width="271"><div align="right">USUARIO: <span class="text_combo_select"><?php echo $user ?></span></div></td>
                        </tr>
                    </table>
                    <div align="center"><img src="../../images/line2.png" width="910" height="4" /></div></td>
            </tr>
        </table>
<?php
if ($val == 1) {
    //DETALLADO POR VENTAS
    if ($tipo == 1) {
        ?>
                <table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><table width="926" border="0" align="center">
                                <tr>
                                    <td width="87"><strong>SUCURSAL</strong></td>
                                    <td width="80"><div align="left"><strong>N� VENTA</strong></div></td>
                                    <td width="497"><div align="left"><strong>PRODUCTO</strong></div></td>
                                    <td width="76"><div align="right"><strong>CANT VEND</strong></div></td>
                                    <td width="76"><div align="right"><strong>PRECIO VTA</strong></div></td>
                                    <td width="84"><div align="right"><strong>MONTO INCENT</strong></div></td>
                                </tr>
                            </table></td>
                    </tr>
                </table>
                <table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
        <?php
        $i = 0;
        while ($rr < $contador) {
            $nro = $ccc[$rr];
            if ($nro <> '') {
                if ($local == "all") {
                    $sqls = "SELECT codpro FROM incentivadodet where incentivadodet.invnum = '$nro' group by codpro order by codpro";
                } else {
                    $sqls = "SELECT codpro FROM incentivadodet where incentivadodet.invnum = '$nro' and codloc = '$local' group by codpro order by codpro";
                }
                $results = mysqli_query($conexion,$sqls);
                $zz = 0;
                if (mysqli_num_rows($results)) {
                    ?>
                                        <table width="926" border="0" align="center">
                                        <?php
                                        while ($rows = mysqli_fetch_array($results)) {
                                            $codpro = $rows[0];
                                            //echo $codpro."<br><br>";
                                            $sql1 = "SELECT desprod FROM producto where codpro = '$codpro'";
                                            $result1 = mysqli_query($conexion,$sql1);
                                            if (mysqli_num_rows($result1)) {
                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                    $desprod = $row1['desprod'];
                                                }
                                            }
                                            //echo $codpro;
                                            if ($local == "all") {
                                                $sql = "SELECT sucursal,nrovent,fraccion,detalle_venta.factor,detalle_venta.canpro,detalle_venta.pripro,incentivadodet.pripro,incentivadodet.codpro,canprocaj,canprounid,incentivadodet.factor FROM incentivadodet inner join detalle_venta on incentivadodet.codpro = detalle_venta.codpro inner join venta on detalle_venta.invnum = venta.invnum where detalle_venta.incentivo = '$nro' and incentivadodet.invnum = '$nro' and incentivadodet.codpro = '$codpro' and venta.val_habil = '0' group by detalle_venta.invnum,sucursal order by sucursal,nrovent";
                                            } else {
                                                $sql = "SELECT sucursal,nrovent,fraccion,detalle_venta.factor,detalle_venta.canpro,detalle_venta.pripro,incentivadodet.pripro,incentivadodet.codpro,canprocaj,canprounid,incentivadodet.factor,venta.invfec FROM incentivadodet inner join detalle_venta on incentivadodet.codpro = detalle_venta.codpro inner join venta on detalle_venta.invnum = venta.invnum where detalle_venta.incentivo = '$nro' and incentivadodet.invnum = '$nro' and incentivadodet.codpro = '$codpro' and sucursal = '$local' and venta.val_habil = '0' group by detalle_venta.invnum,sucursal order by sucursal,nrovent";
                                            }
                                            //echo $sql."<br><br>";
                                            $result = mysqli_query($conexion,$sql);
                                            if (mysqli_num_rows($result)) {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $sucursal  = $row['sucursal'];
                                                    $nrovent   = $row['nrovent'];
                                                    $fraccion  = $row['fraccion'];
                                                    $factor    = $row['factor'];
                                                    $vcanpro   = $row[4];
                                                    $vpripro   = $row[5];
                                                    $ipripro   = $row[6];
                                                    $codpro    = $row[7];
                                                    $canprocaj = $row['canprocaj'];
                                                    $canprounid= $row['canprounid'];
                                                    $factorinc = $row[10];
                                                    //echo $codpro." - ".$canprocaj." - ".$canprounid."<br><br>";
                                                    if (($factor == 0) or ($factor == '')) {
                                                        $factor = 1;
                                                    }
                                                    if (($factorinc == 0) or ($factorinc == '')) {
                                                        $factorinc = 1;
                                                    }
                                                    /////CANTIDAD VENDIDA/////////////////////
                                                    if ($fraccion == "T") {
                                                        $desc_f = "UNID";
                                                        $cantunid = $vcanpro;
                                                    } else {
                                                        $desc_f = "CAJA";
                                                        $cantunid = $factor * $vcanpro;
                                                    }
                                                    ///////////////////////////////////
                                                    //su zz = 1 quiere decir que solo hay una sucursal
                                                    if ($sucursal <> $suc[$zz]) {
                                                        $zz++;
                                                        $suc[$zz] = $sucursal;
                                                    }
                                                    ///////////////////////////////////
                                                    $sql3 = "SELECT nomloc FROM xcompa where codloc = '$sucursal'";
                                                    $result3 = mysqli_query($conexion,$sql3);
                                                    if (mysqli_num_rows($result3)) {
                                                        while ($row3 = mysqli_fetch_array($result3)) {
                                                            $sucur = $row3['nomloc'];
                                                        }
                                                    }
                                                    /////CANTIDAD POR EL INCENTIVO/////////////////////
                                                    $totcunid1 = $canprocaj * $factorinc;
                                                    $totcunid2 = $canprounid;
                                                    $totcunid  = $totcunid1 + $totcunid2;
                                                    ///////////////////////////////////
                                                    $sql1 = "SELECT nomloc FROM xcompa where codloc = '$sucursal'";
                                                    $result1 = mysqli_query($conexion,$sql1);
                                                    if (mysqli_num_rows($result1)) {
                                                        while ($row1 = mysqli_fetch_array($result1)) {
                                                            $nomloc = $row1['nomloc'];
                                                        }
                                                    }
                                                    //echo $codpro." - ".$cantunid." - ".$totcunid."<br><br>";
                                                    //if ($cantunid >= $totcunid) {
                                                        $tot = ($cantunid * $ipripro) / $totcunid;
                                                        $sumincentivo[$zz] = $sumincentivo[$zz] + $tot;
                                                        if (($suc[$zz - 1] <> "") and ($suc[$zz - 1] <> $suc[$zz])) {  //////////LINEA 1
                                                            ?>
                                                                <tr bgcolor="#CCCCCC">
                                                                    <td colspan="4"><div align="right"></div></td>
                                                                    <td width="76"><div align="right"><strong>TOTAL</strong></div></td>
                                                                    <td width="84"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz - 1], 2, '.', ' '); ?></div></td>
                                                                </tr>
                                                                <?php
                                                            } //////////LINEA 1
                                                            ?>
                                                            <tr>
                                                                <td width="87"><?php echo $nomloc ?></td>
                                                                <td width="80"><?php echo $nrovent ?></td>
                                                                <td width="497"><?php echo $desprod ?></td>
                                                                <td width="76"><div align="right"><?php echo $vcanpro;
                                    echo " ";
                                    echo $desc_f; ?></div></td>
                                                                <td width="76"><div align="right"><?php echo $vpripro ?></div></td>
                                                                <td width="84"><div align="right"><?php echo $numero_formato_frances = number_format($tot, 2, '.', ' '); ?></div></td>
                                                            </tr>
                                                            <?php
                                                        //}   /////////if ($cantunid >= $totcunid)
                                                    }
                                                } /*else {
                                                    ?>
                                                    <tr>
                                                        <td width="87"></td>
                                                        <td width="80"></td>
                                                        <td width="497"><?php echo $desprod ?></td>
                                                        <td width="76"><div align="right">0</div></td>
                                                        <td width="76"><div align="right">0</div></td>
                                                        <td width="84"><div align="right"><?php echo $numero_formato_frances = number_format(0, 2, '.', ' '); ?></div></td>
                                                    </tr>
                            <?php
                        }*/
                    }  /////////while ($row = mysqli_fetch_array($result)){
                    ?>
                                        </table>
                                            <?php
                                            if ($zz == 1) {
                                                if (($sumincentivo[$zz] <> 0) or ($sumincentivo[$zz] <> '')) {
                                                    ?>
                                                <table width="926" border="0" align="center">
                                                    <tr bgcolor="#CCCCCC">
                                                        <td><div align="right"></div></td>
                                                        <td width="76"><div align="right"><strong>TOTAL</strong></div></td>
                                                        <td width="84"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz], 2, '.', ' '); ?></div></td>
                                                    </tr>
                                                </table>
                            <?php
                        }
                    }  /////($zz == 1)
                    else {
                        if (($sumincentivo[$zz] <> 0) or ($sumincentivo[$zz] <> '')) {
                            ?>
                                                <table width="926" border="0" align="center">
                                                    <tr bgcolor="#CCCCCC">
                                                        <td><div align="right"></div></td>
                                                        <td width="76"><div align="right"><strong>TOTAL</strong></div></td>
                                                        <td width="84"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz], 2, '.', ' '); ?></div></td>
                                                    </tr>
                                                </table>
                                                <?php
                                            }
                                        } ////CIERRO EL ELSE
                                        ?>
                <?php
                }  ////if (mysqli_num_rows($result)){
                else {
                    ?>
                                        <center>No se logro encontrar informacion con los datos ingresados</center>
                                    <?php
                                    }
                                }
                                ++$rr;
                            } ///cierro while
                            ?>
                        </td>
                    </tr>
                </table>
    <?php
    }   //////cierrto el tipo =1
//detallado por producto
    if ($tipo == 2) {
        ?>
                <table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><table width="926" border="0" align="center">
                                <tr>
                                    <td width="87"><strong>SUCURSAL</strong></td>
                                    <td width="375"><div align="left"><strong>PRODUCTO</strong></div></td>
                                    <td width="177"><div align="left"><strong>MARCA</strong></div></td>
                                    <td width="87"><div align="right"><strong>CANT TOT VEND</strong></div></td>
                                    <td width="87"><div align="right"><strong>PREC TOT VEND</strong></div></td>
                                    <td width="87"><div align="right"><strong>MONTO INCENT</strong></div></td>
                                </tr>
                            </table></td>
                    </tr>
                </table>
                <table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><?php
        $i = 0;
        while ($rr < $contador) {
            $nro = $ccc[$rr];
            if ($nro <> '') {
                if ($local == "all") {
                    $sqls = "SELECT codpro FROM incentivadodet where incentivadodet.invnum = '$nro' group by codpro order by codpro";
                } else {
                    $sqls = "SELECT codpro FROM incentivadodet where incentivadodet.invnum = '$nro' and codloc = '$local' group by codpro order by codpro";
                }
                $results = mysqli_query($conexion,$sqls);
                $zz = 0;
                if (mysqli_num_rows($results)) {
                    ?>
                                        <table width="926" border="0" align="center">
                    <?php
                    while ($rows = mysqli_fetch_array($results)) {
                        $codpro = $rows[0];
                        //echo $codpro."<br><br>";
                        $sql1 = "SELECT desprod,codmar FROM producto where codpro = '$codpro'";
                        $result1 = mysqli_query($conexion,$sql1);
                        if (mysqli_num_rows($result1)) {
                            while ($row1 = mysqli_fetch_array($result1)) {
                                $desprod = $row1['desprod'];
                                $codmar = $row1['codmar'];
                            }
                        }
                        $sql1 = "SELECT destab FROM titultabladet where codtab = '$codmar' and tiptab = 'M'";
                        $result1 = mysqli_query($conexion,$sql1);
                        if (mysqli_num_rows($result1)) {
                            while ($row1 = mysqli_fetch_array($result1)) {
                                $destab = $row1['destab'];
                            }
                        }
                        if ($local == "all") {
                            $sql = "SELECT detalle_venta.codpro,sucursal 
							FROM incentivadodet inner join detalle_venta on incentivadodet.codpro = detalle_venta.codpro
							inner join venta on detalle_venta.invnum = venta.invnum 
							where  
							detalle_venta.incentivo = '$nro' and incentivadodet.invnum = '$nro' and 
							detalle_venta.codpro = '$codpro' and venta.val_habil = '0' 
							group by detalle_venta.codpro,sucursal order by sucursal,nrovent";
                        } else {
                            $sql = "SELECT detalle_venta.codpro,sucursal 
							FROM incentivadodet inner join detalle_venta on incentivadodet.codpro = detalle_venta.codpro
							inner join venta on detalle_venta.invnum = venta.invnum 
							where 
							detalle_venta.incentivo = '$nro' and incentivadodet.invnum = '$nro' and 
							and sucursal = '$local' and detalle_venta.codpro = '$codpro' and venta.val_habil = '0' 
							group by detalle_venta.codpro,sucursal 
							order by sucursal,nrovent";
                        }
                        //echo $sql."<br><br>";
                        $result = mysqli_query($conexion,$sql);
                        if (mysqli_num_rows($result)) {
                            while ($row = mysqli_fetch_array($result)) {
                                $codpro   = $row['codpro'];
                                $sucursal = $row['sucursal'];
                                $totf1 = 0;
                                //su zz = 1 quiere decir que solo hay una sucursal
                                if ($sucursal <> $suc[$zz]) {
                                    $zz++;
                                    $suc[$zz] = $sucursal;
                                }
                                $sql1 = "SELECT sum(pripro) FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum where sucursal = '$sucursal' and codpro = '$codpro' and incentivo = '$nro' and venta.val_habil = '0'";
                                //echo $sql1."<br><br>";
                                $result1 = mysqli_query($conexion,$sql1);
                                if (mysqli_num_rows($result1)) {
                                    while ($row1 = mysqli_fetch_array($result1)) {
                                        $vpripro = $row1[0];
                                    }
                                }
                                $sql1 = "SELECT sum(canpro) FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum where sucursal = '$sucursal' and codpro = '$codpro' and incentivo = '$nro' and fraccion = 'T' and venta.val_habil = '0'";
                                //echo $sql1."<br><br>";
                                $result1 = mysqli_query($conexion,$sql1);
                                if (mysqli_num_rows($result1)) {
                                    while ($row1 = mysqli_fetch_array($result1)) {
                                        $sumcanprot = $row1[0];
                                    }
                                }
                                else
                                {
                                    $sumcanprot = 0;
                                }
                                $sql1 = "SELECT sum(canpro),factor FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum where sucursal = '$sucursal' and codpro = '$codpro' and incentivo = '$nro' and fraccion = 'F' and venta.val_habil = '0' group by factor";
                                //echo $sql1."<br><br>";
                                $result1 = mysqli_query($conexion,$sql1);
                                if (mysqli_num_rows($result1)) {
                                    while ($row1 = mysqli_fetch_array($result1)) {
                                        $sumcanprof = $row1[0];
                                        $factorf    = $row1[1];
                                        $totf       = $sumcanprof * $factorf;
                                        $totf1      = $totf1 + $totf;
                                    }
                                }
                                else
                                {
                                    $sumcanprof = 0;
                                    $totf1 = 0;
                                }
                                //echo $codpro." - ".$sumcanprot." - ".$sumcanprof."<br><br>";
                                if (($factorf == 0) or ($factorf == '')) 
                                {
                                    $factorf = 1;
                                }
                                /////CANTIDAD VENDIDA/////////////////////
                                $cantunid = $sumcanprot + $totf1;
                                //////////////////////////////////////////
                                $sql1 = "SELECT canprocaj,canprounid,factor,pripro,codloc FROM incentivadodet where codpro = '$codpro' and invnum = '$nro' and codloc = '$sucursal'";
                                //echo $sql1."<br><br>";
                                $result1 = mysqli_query($conexion,$sql1);
                                if (mysqli_num_rows($result1)) {
                                    while ($row1 = mysqli_fetch_array($result1)) {
                                        $canprocaj  = $row1['canprocaj'];
                                        $canprounid = $row1['canprounid'];
                                        $factorinc  = $row1['factor'];
                                        $ipripro    = $row1['pripro'];
                                    }
                                }
                                if (($factorinc == 0) or ($factorinc == '')) {
                                    $factorinc = 1;
                                }
                                /////CANTIDAD POR EL INCENTIVO/////////////////////
                                $totcunid1 = $canprocaj * $factorinc;
                                $totcunid2 = $canprounid;
                                $totcunid = $totcunid1 + $totcunid2;
                                ///////////////////////////////////////////////////
                                $sql1 = "SELECT nomloc FROM xcompa where codloc = '$sucursal'";
                                $result1 = mysqli_query($conexion,$sql1);
                                if (mysqli_num_rows($result1)) {
                                    while ($row1 = mysqli_fetch_array($result1)) {
                                        $nomloc = $row1['nomloc'];
                                    }
                                }
                                //echo $codpro." - ".$cantunid." - ".$ipripro." - ".$totcunid."<br><br>";
                                
                                    $tot = ($cantunid * $ipripro) / $totcunid;
									
                                    $sumincentivo[$zz] = $sumincentivo[$zz] + $tot;
                                    if (($suc[$zz - 1] <> "") and ($suc[$zz - 1] <> $suc[$zz])) {  //////////LINEA 1
                                        ?>
                                                                <tr bgcolor="#CCCCCC">
                                                                    <td width="87"></td>
                                                                    <td width="375"><strong>TOTAL</strong></td>
                                                                    <td width="177"><div align="right"></div></td>
                                                                    <td width="87"><div align="right"></div></td>
                                                                    <td width="87"><div align="right"></div></td>
                                                                    <td width="87"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz - 1], 2, '.', ' '); ?></div></td>
                                                                </tr>
                                                            <?php }
                                                            ?>
                                                            <tr>
                                                                <td width="87"><?php echo $nomloc ?></td>
                                                                <td width="375"><?php echo $desprod ?></td>
                                                                <td width="177"><?php echo substr($destab, 0, 35); ?></td>
                                                                <td width="87"><div align="right"><?php echo $cantunid ?></div></td>
                                                                <td width="87"><div align="right"><?php echo $vpripro ?></div></td>
                                                                <td width="87"><div align="right"><?php echo $numero_formato_frances = number_format($tot, 2, '.', ' '); ?></div></td>
                                                            </tr>
                                                        <?php
                                                        //} ////if ($cantunid >= $totcunid)
                                                    }
                                                } /*else {
                                                    ?>
                                                    <tr>
                                                        <td width="87"></td>
                                                        <td width="375"><?php echo $desprod ?></td>
                                                        <td width="177"><?php echo substr($destab, 0, 35); ?></td>
                                                        <td width="87"><div align="right">0</div></td>
                                                        <td width="87"><div align="right">0</div></td>
                                                        <td width="87"><div align="right"><?php echo $numero_formato_frances = number_format(0, 2, '.', ' '); ?></div></td>
                                                    </tr>
                                                <?php
                                                }*/
                                            }/////////while ($row = mysqli_fetch_array($result)){
                                            ?>
                                        </table>
                    <?php
                    if ($zz == 1) {
                        if (($sumincentivo[$zz] <> 0) or ($sumincentivo[$zz] <> '')) {
                            ?>
                                                <table width="926" border="0" align="center">
                                                    <tr bgcolor="#CCCCCC">
                                                        <td width="87"></td>
                                                        <td width="375"><strong>TOTAL</strong></td>
                                                        <td width="177"><div align="right"></div></td>
                                                        <td width="87"><div align="right"></div></td>
                                                        <td width="87"><div align="right"></div></td>
                                                        <td width="87"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz], 2, '.', ' '); ?></div></td>
                                                    </tr>
                                                </table>
                        <?php
                        }
                    } /////($zz == 1)
                    else {
                        if (($sumincentivo[$zz] <> 0) or ($sumincentivo[$zz] <> '')) {
                            ?>
                                                <table width="926" border="0" align="center">
                                                    <tr bgcolor="#CCCCCC">
                                                        <td width="87"></td>
                                                        <td width="375"><strong>TOTAL</strong></td>
                                                        <td width="177"><div align="right"></div></td>
                                                        <td width="87"><div align="right"></div></td>
                                                        <td width="87"><div align="right"></div></td>
                                                        <td width="87"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz], 2, '.', ' '); ?></div></td>
                                                    </tr>
                                                </table>
                                                <?php
                                                }
                                            } ////CIERRO EL ELSE
                                            ?>
                                    <?php
                                    }  ////if (mysqli_num_rows($result)){
                                    else {
                                        ?>
                                        <center>
                                            No se logro encontrar informacion con los datos ingresados
                                        </center>
                <?php
                }
            }
            ++$rr;
        } ///cierro while
        ?>
                        </td>
                    </tr>
                </table>
                        <?php
                        }   //////cierro el tipo = 2
//resumido por vendedor
                        if ($tipo == 3) {
                            ?>
                <table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><table width="926" border="0" align="center">
                                <tr>
                                    <!--<td width="84"><strong>SUCURSAL</strong></td>-->
                                    <td width="520"><div align="left"><strong>VENDEDOR</strong></div></td>
                                    <!--<td width="260"><div align="left"><strong>PRODUCTO</strong></div></td>-->
                                    <!--<td width="69"><div align="right"><strong>P. COSTO</strong></div></td>-->
                                    <td width="59"><div align="left"><strong>P. VENTA</strong></div></td>
                                    <!--<td width="85"><div align="right"><strong>RENTABILIDAD</strong></div></td>-->
                                    <td width="84"><div align="right"><strong>MONTO INCENT</strong></div></td>
                                </tr>
                            </table></td>
                    </tr>
                </table>
                <table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><?php
                    $i = 0;
                    while ($rr < $contador) {
                        $nro = $ccc[$rr];
                        if ($nro <> '') {
                            if ($local == "all") {
                                $sql = "SELECT detalle_venta.usecod,sucursal FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum where incentivo = '$nro' and venta.val_habil = '0' group by usecod order by sucursal,nrovent";
                            } else {
                                $sql = "SELECT detalle_venta.usecod,sucursal FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum where incentivo = '$nro' and sucursal = '$local' and venta.val_habil = '0' group by usecod order by sucursal,nrovent";
                            }
                            $result = mysqli_query($conexion,$sql);
                            if (mysqli_num_rows($result)) {
                                        ?>
                                        <table width="926" border="0" align="center">
                            <?php
                            $zz = 0;
                            $contReg = 0;
                            $SumGenTot = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                $usecod     = $row['usecod'];
                                //$sucursal   = $row['sucursal'];
                                if ($usecod <> $suc[$zz]) {
                                    $zz++;
                                    $contReg = 0;
                                    $suc[$zz] = $usecod;
                                }
                                /*$sql1 = "SELECT nomloc FROM xcompa where codloc = '$sucursal'";
                                $result1 = mysqli_query($conexion,$sql1);
                                if (mysqli_num_rows($result1)) {
                                    while ($row1 = mysqli_fetch_array($result1)) {
                                        $nomloc = $row1['nomloc'];
                                    }
                                }*/
                                $sql1 = "SELECT nomusu FROM usuario where usecod = '$usecod'";
                                $result1 = mysqli_query($conexion,$sql1);
                                if (mysqli_num_rows($result1)) {
                                    while ($row1 = mysqli_fetch_array($result1)) {
                                        $nomusu = $row1['nomusu'];
                                    }
                                }
                                $sumcanprot = 0;
                                $sumcanprof = 0;
                                $factorf = 0;
                                $totf = 0;
                                $totcunid1 = 0;
                                $totcunid2 = 0;
                                $sumcosto = 0;
                                $sumventas = 0;
                                $rentabi = 0;
                                $sumtot = 0;
                                $SumGenVentas = 0;
                                $sqlx = "SELECT codpro FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum where venta.usecod= '$usecod' and incentivo = '$nro' and venta.val_habil = '0' group by codpro";
                                //echo $sqlx."<br><br>";
                                $resultx = mysqli_query($conexion,$sqlx);
                                if (mysqli_num_rows($resultx)) {
                                    while ($rowx = mysqli_fetch_array($resultx)) 
                                    {
                                         $totf1 = 0;
                                        $codpro = $rowx['codpro'];
                                        /*$sql1 = "SELECT desprod FROM producto where codpro = '$codpro'";
                                        $result1 = mysqli_query($conexion,$sql1);
                                        if (mysqli_num_rows($result1)) {
                                            while ($row1 = mysqli_fetch_array($result1)) {
                                                $nombreprod = $row1[0];
                                            }
                                        }*/
                                        $sql1 = "SELECT sum(detalle_venta.pripro) 
                                            FROM incentivadodet
                                            INNER JOIN detalle_venta ON incentivadodet.codpro = detalle_venta.codpro 
                                            inner join venta on detalle_venta.invnum = venta.invnum 
                                            where 
                                            detalle_venta.incentivo =  '$nro' AND incentivadodet.invnum =  '$nro' and
                                            detalle_venta.codpro = '$codpro' and venta.usecod = '$usecod' and venta.val_habil = '0'";
                                        //echo $sql1."<br><br>";
                                        $result1 = mysqli_query($conexion,$sql1);
                                        if (mysqli_num_rows($result1)) {
                                            while ($row1 = mysqli_fetch_array($result1)) {
                                                $sumventas  = $row1[0];
                                            }
                                        }
                                        $sql1 = "SELECT sum(detalle_venta.canpro),sum(detalle_venta.cospro/detalle_venta.factor) 
                                            FROM incentivadodet
                                            INNER JOIN detalle_venta ON incentivadodet.codpro = detalle_venta.codpro 
                                            INNER JOIN venta on detalle_venta.invnum = venta.invnum 
                                            where 
                                            detalle_venta.incentivo =  '$nro' AND incentivadodet.invnum =  '$nro' and
                                            detalle_venta.codpro = '$codpro' and detalle_venta.incentivo = '$nro' and fraccion = 'T' and venta.usecod = '$usecod' and venta.val_habil = '0'";
                                        //echo $codpro." - ".$sql1."<br><br>";
                                        $result1 = mysqli_query($conexion,$sql1);
                                        if (mysqli_num_rows($result1)) {
                                            while ($row1 = mysqli_fetch_array($result1)) {
                                                $sumcanprot = $row1[0];
                                                $sumcosto   = $row1[1];
                                            }
                                        }
                                        else
                                        {
                                            $sumcanprot = 0;
                                        }
                                        $SumGenVentas = $SumGenVentas + $sumventas;
                                        $rentabi = $sumventas - $sumcosto;
                                        $sql1 = "SELECT sum(detalle_venta.canpro),detalle_venta.factor 
                                        FROM incentivadodet
                                        INNER JOIN detalle_venta ON incentivadodet.codpro = detalle_venta.codpro 
                                        INNER JOIN venta on detalle_venta.invnum = venta.invnum 
                                        where 
                                        detalle_venta.incentivo =  '$nro' AND incentivadodet.invnum =  '$nro' and
                                        detalle_venta.codpro = '$codpro' and detalle_venta.incentivo = '$nro' and fraccion = 'F' and venta.usecod = '$usecod' and venta.val_habil = '0' group by factor";
                                        //echo $codpro." - ".$sql1."<br><br>";
                                        $result1 = mysqli_query($conexion,$sql1);
                                        if (mysqli_num_rows($result1)) {
                                            while ($row1 = mysqli_fetch_array($result1)) {
                                                $sumcanprof = $row1[0];
                                                $factorf    = $row1[1];
                                                $totf       = $sumcanprof * $factorf;
                                                $totf1      = $totf1 + $totf;
                                                //echo $codpro." - ".$sumcanprof." - ".$factorf."<br><br>";
                                            }
                                        }
                                        else
                                        {
                                            $sumcanprof = 0;
                                            $totf1 = 0;
                                        }
                                        if (($factorf == 0) or ($factorf == '')) {
                                            $factorf = 1;
                                        }
                                        /////CANTIDAD VENDIDA/////////////////////
                                        
                                        $cantunid = $sumcanprot + $totf1;
                                        //////////////////////////////////////////
                                        $sql1 = "SELECT canprocaj,canprounid,factor,pripro FROM incentivadodet where codpro = '$codpro' and invnum = '$nro'";
                                        $result1 = mysqli_query($conexion,$sql1);
                                        if (mysqli_num_rows($result1)) {
                                            while ($row1 = mysqli_fetch_array($result1)) {
                                                $canprocaj  = $row1['canprocaj'];
                                                $canprounid = $row1['canprounid'];
                                                $factorinc  = $row1['factor'];
                                                $ipripro    = $row1['pripro'];
                                            }
                                        }
                                        //echo $codpro." - ".$canprocaj." - ".$canprounid."<br><br>";
                                        if (($factorinc == 0) or ($factorinc == '')) {
                                            $factorinc = 1;
                                        }
                                        /////CANTIDAD POR EL INCENTIVO/////////////////////
                                        $totcunid1  = $canprocaj * $factorinc;
                                        $totcunid2  = $canprounid;
                                        $totcunid   = $totcunid1 + $totcunid2;
                                        ///////////////////////////////////////////////////
                                        //echo $codpro.' - '.$totcunid."<br>";
                                        if ($totcunid <> 0)
                                        {
                                            $tot = ($cantunid * $ipripro) / $totcunid;
                                        }
                                        else
                                        {
                                            $tot = 0;
                                        }
                                        
                                        $sumtot = $sumtot + $tot;
                                        //echo $codpro." - ".$sql1."<br><br>";
                                    }
                                    //echo $usecod.' - '.$sumtot."<br>";
                                    //if ($cantunid >= $totcunid) {
                                        //echo $codpro." - ".$cantunid." - ".$ipripro." - ".$totcunid."<br><br>";
                                        $SumGenTot = $SumGenTot + $sumtot;
                                        $sumincentivo[$zz] = $sumincentivo[$zz] + $sumtot;
                                        /*if (($suc[$zz - 1] <> "") and ($contReg == 0) and ($suc[$zz - 1] <> $suc[$zz])) {  //////////LINEA 1
                                            ?>
                                                            <tr bgcolor="#CCCCCC">
                                                                <!--<td width="84"></td>-->
                                                                <td width="520"></td>
<!--                                                                <td width="260"></td>
                                                                <td width="69"></td>
                                                                <td width="59"></td>-->
                                                                <td width="85"><strong>TOTAL</strong></td>
                                                                <td width="84"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz - 1], 2, '.', ' '); ?></div></td>
                                                            </tr>
                                                        <?php }
                                                        $contReg++;*/
                                                        ?>
                                                        <tr>
                                                            <!--<td width="84"><?php echo $nomloc ?></td>-->
                                                            <td width="520"><?php echo $usecod." - ".$nomusu ?></td>
                                                            <!--<td width="260"><?php echo $codpro." - ".$nombreprod ?></td>-->
                                                            <!--<td width="69"><?php echo number_format($sumcosto, 2, '.', ' '); ?></td>-->
                                                            <!--<td width="59"><?php echo number_format($rentabi, 2, '.', ' '); ?></td>-->
                                                            <td width="85"><?php echo $SumGenVentas ?></td>
                                                            <td width="84"><div align="right"><?php echo $numero_formato_frances = number_format($sumtot, 2, '.', ' '); ?></div></td>
                                                        </tr>
                                                    <?php
                                                    //} ////if ($cantunid >= $totcunid)
                                                    //}
                                                } ////if (mysqli_num_rows($resultx)){
                                            }
                                            ?>
                                        </table>
                                            <?php
                                            if ($zz == 1) {
                                                if (($sumincentivo[$zz] <> 0) or ($sumincentivo[$zz] <> '')) {
                                                    ?>
                                                <table width="926" border="0" align="center">
                                                    <tr bgcolor="#CCCCCC">
                                                        <!--<td width="84"></td>-->
                                                        <td width="520"></td>
<!--                                                        <td width="260"></td>
                                                        <td width="69"></td>
                                                        <td width="59"></td>-->
                                                        <td width="85"><strong>TOTAL</strong></td>
                                                        <td width="84"><div align="right"><?php echo $numero_formato_frances = number_format($SumGenTot, 2, '.', ' '); ?></div></td>
                                                    </tr>
                                                </table>
                                                <?php
                                                }
                                            } /////($zz == 1)
                                            else {
                                                if (($sumincentivo[$zz] <> 0) or ($sumincentivo[$zz] <> '')) {
                                                    ?>
                                                <table width="926" border="0" align="center">
                                                    <tr bgcolor="#CCCCCC">
                                                        <!--<td width="84"></td>-->
                                                        <td width="520"></td>
<!--                                                        <td width="260"></td>
                                                        <td width="69"></td>
                                                        <td width="59"></td>-->
                                                        <td width="85"><strong>TOTAL</strong></td>
                                                        <td width="84"><div align="right"><?php echo $numero_formato_frances = number_format($SumGenTot, 2, '.', ' '); ?></div></td>
                                                    </tr>
                                                </table>
                        <?php
                        }
                    } ////CIERRO EL ELSE
                    ?>
                                        <?php
                                        }  ////if (mysqli_num_rows($result)){
                                        else {
                                            ?>
                                        <center>
                                            No se logro encontrar informacion con los datos ingresados
                                        </center>
                                    <?php
                                    }
                                }
                                ++$rr;
                            }
                            ?>
                        </td>
                    </tr>
                </table>
    <?php
    }   //////cierro el tipo = 3
//rsumido por sucursal
    if ($tipo == 4) {
        ?>
                <table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><table width="926" border="0" align="center">
                                <tr>
                                    <td width="157"><strong>SUCURSAL</strong></td>
                                    <td width="117"><div align="right"><strong>MONTO INCENT</strong></div></td>
                                </tr>
                            </table></td>
                    </tr>
                </table>
                <table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><?php
        $i = 0;
        while ($rr < $contador) {
            $nro = $ccc[$rr];
            if ($nro <> '') {
                if ($local == "all") {
                    $sql = "SELECT sucursal FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum where incentivo = '$nro' and venta.val_habil = '0' group by sucursal order by sucursal,nrovent";
                } else {
                    $sql = "SELECT sucursal FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum where incentivo = '$nro' and sucursal = '$local' and venta.val_habil = '0' group by sucursal order by sucursal,nrovent";
                }
                $result = mysqli_query($conexion,$sql);
                if (mysqli_num_rows($result)) {
                    ?>
                                        <table width="926" border="0" align="center">
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        $sucursal = $row['sucursal'];
                        if ($sucursal <> $suc[$zz]) {
                            $zz++;
                            $suc[$zz] = $sucursal;
                        }
                        $sumcanprot = 0;
                        $sumcanprof = 0;
                        $factorf = 0;
                        $totf = 0;
                        $totcunid1 = 0;
                        $totcunid2 = 0;
                        $sumtot = 0;
                        $sql1 = "SELECT nomloc FROM xcompa where codloc = '$sucursal'";
                        $result1 = mysqli_query($conexion,$sql1);
                        if (mysqli_num_rows($result1)) {
                            while ($row1 = mysqli_fetch_array($result1)) {
                                $nomloc = $row1['nomloc'];
                            }
                        }
                        $sqlx = "SELECT codpro FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum where incentivo = '$nro' and sucursal ='$sucursal' and venta.val_habil = '0' group by codpro";
                        //echo $sqlx."<br><br>";
                        $resultx = mysqli_query($conexion,$sqlx);
                        if (mysqli_num_rows($resultx)) {
                            while ($rowx = mysqli_fetch_array($resultx)) {
                                $totf1 = 0;
                                
                                $codpro = $rowx['codpro'];
                                //echo $codpro;
                                $sql1 = "SELECT sum(detalle_venta.canpro) 
                                    FROM incentivadodet
                                            INNER JOIN detalle_venta ON incentivadodet.codpro = detalle_venta.codpro 
                                            INNER JOIN venta on detalle_venta.invnum = venta.invnum 
                                    where
                                    detalle_venta.incentivo =  '$nro' AND incentivadodet.invnum =  '$nro' and
                                    sucursal = '$sucursal' and detalle_venta.codpro = '$codpro' and detalle_venta.incentivo = '$nro' and detalle_venta.fraccion = 'T' and venta.val_habil = '0'";
                                $result1 = mysqli_query($conexion,$sql1);
                                if (mysqli_num_rows($result1)) {
                                    while ($row1 = mysqli_fetch_array($result1)) {
                                        $sumcanprot = $row1[0];
                                    }
                                }
                                else
                                {
                                    $sumcanprot = 0;
                                }
                                $sql1 = "SELECT sum(detalle_venta.canpro),detalle_venta.factor 
                                    FROM incentivadodet
                                        INNER JOIN detalle_venta ON incentivadodet.codpro = detalle_venta.codpro 
                                        INNER JOIN venta on detalle_venta.invnum = venta.invnum 
                                    where
                                    detalle_venta.incentivo =  '$nro' AND incentivadodet.invnum =  '$nro' and
                                    sucursal = '$sucursal' and detalle_venta.codpro = '$codpro' and detalle_venta.incentivo = '$nro' and detalle_venta.fraccion = 'F' and venta.val_habil = '0' group by detalle_venta.factor";
                                //echo $sql1."<br><br>";
                                $result1 = mysqli_query($conexion,$sql1);
                                if (mysqli_num_rows($result1)) {
                                    while ($row1 = mysqli_fetch_array($result1)) {
                                        $sumcanprof = $row1[0];
                                        $factorf    = $row1[1];
                                        $totf   = $sumcanprof * $factorf;
                                        $totf1  = $totf1 + $totf;
                                        //echo $codpro." - ".$sumcanprof." - ".$factorf."<br><br>";
                                    }
                                }
                                else
                                {
                                    $sumcanprof = 0;
                                    $totf1 = 0;
                                }
                                //echo $codpro." - ".$sumcanprot." - ".$sumcanprof."<br><br>";
                                if (($factorf == 0) or ($factorf == '')) {
                                    $factorf = 1;
                                }
                                /////CANTIDAD VENDIDA/////////////////////
                                $cantunid       = $sumcanprot + $totf1;
                                $sumcantunid    = $sumcantunid + $cantunid;
                                //////////////////////////////////////////
                                $sql1 = "SELECT canprocaj,canprounid,factor,pripro FROM incentivadodet where codpro = '$codpro' and invnum = '$nro' and codloc = '$sucursal'";
                                $result1 = mysqli_query($conexion,$sql1);
                                if (mysqli_num_rows($result1)) {
                                    while ($row1 = mysqli_fetch_array($result1)) {
                                        $canprocaj  = $row1['canprocaj'];
                                        $canprounid = $row1['canprounid'];
                                        $factorinc  = $row1['factor'];
                                        $ipripro    = $row1['pripro'];
                                    }
                                }
                                $sumipripro = $sumipripro + $ipripro;
                                if (($factorinc == 0) or ($factorinc == '')) {
                                    $factorinc = 1;
                                }
                                /////CANTIDAD POR EL INCENTIVO/////////////////////
                                $totcunid1 = $canprocaj * $factorinc;
                                $totcunid2 = $canprounid;
                                $totcunid = $totcunid1 + $totcunid2;
                                $sumtotcunid = $sumtotcunid + $totcunid;
                                ///////////////////////////////////////////////////
                                if($totcunid <> 0)
                                {
                                $tot = ($cantunid * $ipripro) / $totcunid;
                                }
                                else
                                {
                                    $tot = 0;
                                }
                                $sumtot = $sumtot + $tot;
                                //echo $codpro." - ".$cantunid." - ".$ipripro." - ".$totcunid." = ".$tot."<br><br>";
                            }
                            //if ($cantunid >= $totcunid) {
                                //$tot = ($sumcantunid * $sumipripro) / $sumtotcunid;
                                $sumincentivo[$zz] = $sumincentivo[$zz] + $sumtot;
                                if (($suc[$zz - 1] <> "") and ($suc[$zz - 1] <> $suc[$zz])) {  //////////LINEA 1
                                    ?>
                                                            <tr bgcolor="#CCCCCC">
                                                                <td width="157"><strong>TOTAL</strong></td>
                                                                <td width="117"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz - 1], 2, '.', ' '); ?></div></td>
                                                            </tr>
                                                        <?php } /////if (($suc[$zz-1] <> "") and ($suc[$zz-1] <> $suc[$zz]))
                                                        ?>
                                                        <tr>
                                                            <td width="157"><?php echo $nomloc ?></td>
                                                            <td width="117"><div align="right"><?php echo $numero_formato_frances = number_format($sumtot, 2, '.', ' '); ?></div></td>
                                                        </tr>
                                                    <?php
                                                    //} ////if ($cantunid >= $totcunid)
                                                } ////if (mysqli_num_rows($resultx)){
                                            } ////while ($row = mysqli_fetch_array($result)){
                                            ?>
                                        </table>
                                            <?php
                                            if ($zz == 1) {
                                                if (($sumincentivo[$zz] <> 0) or ($sumincentivo[$zz] <> '')) {
                                                    ?>
                                                <table width="926" border="0" align="center">
                                                    <tr bgcolor="#CCCCCC">
                                                        <td width="157"><strong>TOTAL</strong></td>
                                                        <td width="117"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz], 2, '.', ' '); ?></div></td>
                                                    </tr>
                                                </table>
                                                <?php
                                                }
                                            } /////($zz == 1)
                                            else {
                                                if (($sumincentivo[$zz] <> 0) or ($sumincentivo[$zz] <> '')) {
                                                    ?>
                                                <table width="926" border="0" align="center">
                                                    <tr bgcolor="#CCCCCC">
                                                        <td width="157"><strong>TOTAL</strong></td>
                                                        <td width="117"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz], 2, '.', ' '); ?></div></td>
                                                    </tr>
                                                </table>
                                                <?php
                                                }
                                            } ////CIERRO EL ELSE
                                            ?>
                                        <?php
                                        }  ////if (mysqli_num_rows($result)){
                                        else {
                                            ?>
                                        <center>
                                            No se logro encontrar informacion con los datos ingresados
                                        </center>
                <?php
                }
            }
            ++$rr;
        }
        ?>
                        </td>
                    </tr>
                </table>
                            <?php
                            }   //////cierro el tipo = 4
//detallado por vendedor
                            if ($tipo == 5) {
                                ?>
                <table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><table width="926" border="0" align="center">
                                <tr>
                                    <td width="95"><strong>VENDEDOR</strong></td>
                                    <td width="438"><div align="left"><strong>PRODUCTO</strong></div></td>
                                    <td width="108"><div align="left"><strong>MARCA</strong></div></td>
                                    <td width="95"><div align="right"><strong>CANT TOT VEND</strong></div></td>
                                    <td width="88"><div align="right"><strong>MONTO INCENT</strong></div></td>
                                </tr>
                            </table></td>
                    </tr>
                </table>
                <table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><?php
                            $i = 0;
                            while ($rr < $contador) {
                                $nro = $ccc[$rr];
                                if ($nro <> '') {
                                    if ($local == "all") {
                                        $sql = "SELECT detalle_venta.codpro,detalle_venta.usecod,codmar 
										FROM 
										incentivadodet inner join detalle_venta on incentivadodet.codpro = detalle_venta.codpro
										inner join venta on detalle_venta.invnum = venta.invnum 
										where 
										detalle_venta.incentivo = '$nro' and incentivadodet.invnum = '$nro' and
										venta.val_habil = '0' 
										group by detalle_venta.codpro,detalle_venta.usecod order by detalle_venta.usecod ";
                                    } else {
                                        $sql = "SELECT detalle_venta.codpro,detalle_venta.usecod,codmar 
										FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum 
										where 
										detalle_venta.incentivo = '$nro' and incentivadodet.invnum = '$nro' and
										sucursal = '$local' and venta.val_habil = '0' 
										group by detalle_venta.codpro,detalle_venta.usecod 
										order by detalle_venta.usecod ";
                                    }
                                    $result = mysqli_query($conexion,$sql);
                                    if (mysqli_num_rows($result)) {
                                        ?>
                                        <table width="926" border="0" align="center">
                                        <?php
                                        $zz = 0;
                                        $contReg = 0;
                                        while ($row = mysqli_fetch_array($result)) {
                                            $codpro = $row['codpro'];
                                            $sucursal = $row[1];
                                            $codmar = $row['codmar'];
                                            //su zz = 1 quiere decir que solo hay una sucursal
                                            if ($sucursal <> $suc[$zz]) {
                                                $zz++;
                                                $contReg = 0;
                                                $suc[$zz] = $sucursal;
                                            }
                                            $sql1 = "SELECT destab FROM titultabladet where codtab = '$codmar' and tiptab = 'M'";
                                            $result1 = mysqli_query($conexion,$sql1);
                                            if (mysqli_num_rows($result1)) {
                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                    $destab = $row1['destab'];
                                                }
                                            }
                                            $sql1 = "SELECT sum(detalle_venta.pripro) 
                                                FROM incentivadodet
                                                INNER JOIN detalle_venta ON incentivadodet.codpro = detalle_venta.codpro 
                                                inner join venta on detalle_venta.invnum = venta.invnum 
                                                where 
                                                detalle_venta.incentivo =  '$nro' AND incentivadodet.invnum =  '$nro' and
                                                detalle_venta.usecod = '$sucursal' and detalle_venta.codpro = '$codpro' and detalle_venta.incentivo = '$nro' and venta.val_habil = '0'";
                                            $result1 = mysqli_query($conexion,$sql1);
                                            if (mysqli_num_rows($result1)) {
                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                    $vpripro = $row1[0];
                                                }
                                            }
                                            if ($vpripro == '') {
                                                $vpripro = 0;
                                            }
                                            $sql1 = "SELECT sum(detalle_venta.canpro) 
                                                FROM incentivadodet
                                                INNER JOIN detalle_venta ON incentivadodet.codpro = detalle_venta.codpro 
                                                inner join venta on detalle_venta.invnum = venta.invnum 
                                                where
                                                detalle_venta.incentivo =  '$nro' AND incentivadodet.invnum =  '$nro' and
                                                detalle_venta.usecod = '$sucursal' and detalle_venta.codpro = '$codpro' and detalle_venta.incentivo = '$nro' and detalle_venta.fraccion = 'T' and venta.val_habil = '0'";
                                            $result1 = mysqli_query($conexion,$sql1);
                                            if (mysqli_num_rows($result1)) {
                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                    $sumcanprot = $row1[0];
                                                }
                                            }
                                            else
                                            {
                                                $sumcanprot = 0;
                                            }
                                            $sumcanprof = 0;
                                            $factorf = 0;
                                            $sql1 = "SELECT sum(detalle_venta.canpro),detalle_venta.factor 
                                                FROM incentivadodet
                                                INNER JOIN detalle_venta ON incentivadodet.codpro = detalle_venta.codpro 
                                                inner join venta on detalle_venta.invnum = venta.invnum 
                                                where 
                                                detalle_venta.incentivo =  '$nro' AND incentivadodet.invnum =  '$nro' and
                                                detalle_venta.usecod = '$sucursal' and detalle_venta.codpro = '$codpro' and detalle_venta.incentivo = '$nro' and detalle_venta.fraccion = 'F' and venta.val_habil = '0' group by detalle_venta.factor";
                                            $result1 = mysqli_query($conexion,$sql1);
                                            if (mysqli_num_rows($result1)) {
                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                    $sumcanprof = $row1[0];
                                                    $factorf = $row1[1];
                                                    $totf = $sumcanprof * $factorf;
                                                    $totf1 = $totf1 + $totf;
                                                }
                                            }
                                            else
                                            {
                                                $sumcanprof = 0;
                                                $totf1 = 0;
                                            }
                                            if (($factorf == 0) or ($factorf == '')) {
                                                $factorf = 1;
                                            }
                                            /////CANTIDAD VENDIDA/////////////////////
                                            $cantunid = $sumcanprot + $totf1;
                                            //////////////////////////////////////////
                                            //$sql1="SELECT canprocaj,canprounid,factor,pripro FROM incentivadodet where codpro = '$codpro' and invnum = '$nro' and codloc = '$sucursal'";
                                            $sql1 = "SELECT canprocaj,canprounid,factor,pripro FROM incentivadodet where codpro = '$codpro' and invnum = '$nro'";
                                            $result1 = mysqli_query($conexion,$sql1);
                                            if (mysqli_num_rows($result1)) {
                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                    $canprocaj  = $row1['canprocaj'];
                                                    $canprounid = $row1['canprounid'];
                                                    $factorinc  = $row1['factor'];
                                                    $ipripro    = $row1['pripro'];
                                                }
                                            }
                                            if (($factorinc == 0) or ($factorinc == '')) {
                                                $factorinc = 1;
                                            }
                                            /////CANTIDAD POR EL INCENTIVO/////////////////////
                                            $totcunid1 = $canprocaj * $factorinc;
                                            $totcunid2 = $canprounid;
                                            $totcunid = $totcunid1 + $totcunid2;
                                            //echo '*'; echo $codpro; echo '*'; echo $totcunid1; echo '*'; echo $totcunid2;echo '*'; echo $totcunid;echo '<br>';
                                            ///////////////////////////////////////////////////
                                            $sql1 = "SELECT nomusu FROM usuario where usecod = '$sucursal'";
                                            $result1 = mysqli_query($conexion,$sql1);
                                            if (mysqli_num_rows($result1)) {
                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                    $nomusu = $row1['nomusu'];
                                                }
                                            }
                                            $sql1 = "SELECT desprod FROM producto where codpro = '$codpro'";
                                            $result1 = mysqli_query($conexion,$sql1);
                                            if (mysqli_num_rows($result1)) {
                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                    $desprod = $row1['desprod'];
                                                }
                                            }
                                            
                                            //echo $codpro; echo ' - '; echo $desprod; echo ' - ';echo $totcunid; echo ' - ';echo $totcunid1; echo ' - ';echo $totcunid2; echo '<br>';
                                            //if ($cantunid >= $totcunid) {
                                                if ($totcunid <> 0) {
                                                    $tot = ($cantunid * $ipripro) / $totcunid;
                                                } else {
                                                    $tot = 0;
                                                }
                                                $sumincentivo[$zz] = $sumincentivo[$zz] + $tot;
                                                //echo $zz;
                                                //echo $sumincentivo[$zz];
                                                //echo $zz." - ".$suc[$zz - 1]." - ".$suc[$zz]." = ".$sumincentivo[$zz]."<br><br>";
                                                if (($suc[$zz - 1] <> "") and ($contReg == 0) and ($suc[$zz - 1] <> $suc[$zz])) {  //////////LINEA 1
                                                    ?>
                                                        <tr bgcolor="#CCCCCC">
                                                            <td width="95"></td>
                                                            <td width="438"><strong></strong></td>
                                                            <td width="105"></td>
                                                            <td width="95"><div align="right"><strong>TOTAL</strong></div></td>
                                                            <td width="88"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz - 1], 2, '.', ' '); ?></div></td>
                                                        </tr>
                                                    <?php }
                                                    $contReg++;
                                                    ?>
                                                    <tr>
                                                        <td width="95"><?php echo $nomusu ?></td>
                                                        <td width="438"><?php echo $desprod ?></td>
                                                        <td width="105"><?php echo $destab ?></td>
                                                        <td width="95"><div align="right"><?php echo $cantunid ?></div></td>
                                                        <td width="88"><div align="right"><?php echo $numero_formato_frances = number_format($tot, 2, '.', ' '); ?></div></td>
                                                    </tr>
                                                <?php
                                                //} ////if ($cantunid >= $totcunid)
                                            }
                                            ?>
                                        </table>
                                            <?php
                                            if ($zz == 1) {
                                                //echo $sumincentivo[$zz];
                                                if (($sumincentivo[$zz] <> 0) or ($sumincentivo[$zz] <> '')) {
                                                    ?>
                                                <table width="926" border="0" align="center">
                                                    <tr bgcolor="#CCCCCC">
                                                        <td width="95"></td>
                                                        <td width="438"><strong></strong></td>
                                                        <td width="105"></td>
                                                        <td width="95"><div align="right"><strong>TOTAL</strong></div></td>
                                                        <td width="88"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz], 2, '.', ' '); ?></div></td>
                                                    </tr>
                                                </table>
                                                <?php
                                                }
                                            } /////($zz == 1)
                                            else {
                                                //echo "hola2 - ";
                                                //echo $sumincentivo[$zz];
                                                //echo '<br>';
                                                if (($sumincentivo[$zz] <> 0) or ($sumincentivo[$zz] <> '')) {
                                                    ?>
                                                <table width="926" border="0" align="center">
                                                    <tr bgcolor="#CCCCCC">
                                                        <td width="95"></td>
                                                        <td width="438"><strong></strong></td>
                                                        <td width="105"></td>
                                                        <td width="95"><div align="right"><strong>TOTAL</strong></div></td>
                                                        <td width="88"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz], 2, '.', ' '); ?></div></td>
                                                    </tr>
                                                </table>
                                                <?php
                                                }
                                            } ////CIERRO EL ELSE
                                            ?>
                                        <?php
                                        }  ////if (mysqli_num_rows($result)){
                                        else {
                                            ?>
                                        <center>
                                            No se logro encontrar informacion con los datos ingresados
                                        </center>
                                        <?php
                                        }
                                    }
                                    ++$rr;
                                }
                                ?>
                        </td>
                    </tr>
                </table>
                            <?php
                            }   //////cierro el tipo = 5
//detallado por vendedor y sucursal
                            if ($tipo == 6) {
                                ?>
                <table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><table width="926" border="0" align="center">
                                <tr>
                                    <td width="95"><strong>SUCURSAL</strong></td>
                                    <td width="95"><strong>VENDEDOR</strong></td>
                                    <td width="538"><div align="left"><strong>PRODUCTO</strong></div></td>
                                    <td width="95"><div align="right"><strong>CANT TOT VEND</strong></div></td>
                                    <td width="88"><div align="right"><strong>MONTO INCENT</strong></div></td>
                                </tr>
                            </table></td>
                    </tr>
                </table>
                <table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><?php
                                $i = 0;
                                while ($rr < $contador) {
                                    $nro = $ccc[$rr];
                                    if ($nro <> '') {
                                        if ($local == "all") {
                                            $sql = "SELECT detalle_venta.codpro,sucursal,detalle_venta.usecod 
											FROM 
											incentivadodet inner join detalle_venta on incentivadodet.codpro = detalle_venta.codpro
											inner join venta on detalle_venta.invnum = venta.invnum 
											where 
											detalle_venta.incentivo = '$nro' and incentivadodet.invnum = '$nro' and
											venta.val_habil = '0' 
											group by detalle_venta.codpro,sucursal,detalle_venta.usecod 
											order by sucursal,detalle_venta.usecod,nrovent";
                                        } else {
                                            $sql = "SELECT detalle_venta.codpro,sucursal,detalle_venta.usecod 
											FROM 
											incentivadodet inner join detalle_venta on incentivadodet.codpro = detalle_venta.codpro
											inner join venta on detalle_venta.invnum = venta.invnum 
											where 
											detalle_venta.incentivo = '$nro' and incentivadodet.invnum = '$nro' and
											sucursal = '$local' and venta.val_habil = '0' 
											group by detalle_venta.codpro,sucursal,detalle_venta.usecod 
											order by sucursal,detalle_venta.usecod,nrovent";
                                        }
                                        $result = mysqli_query($conexion,$sql);
                                        if (mysqli_num_rows($result)) {
                                            ?>
                                        <table width="926" border="0" align="center">
                                        <?php
                                        $zz = 0;
                                        while ($row = mysqli_fetch_array($result)) {
                                            $totf1 = 0;
                                            $codpro   = $row['codpro'];
                                            $sucursal = $row['sucursal'];
                                            $usecod   = $row[2];
                                            //su zz = 1 quiere decir que solo hay una sucursal
                                            if ($sucursal <> $suc[$zz]) {
                                                $zz++;
                                                $suc[$zz] = $sucursal;
                                            }
                                            $sql1 = "SELECT sum(detalle_venta.pripro) 
                                                FROM incentivadodet
                                            INNER JOIN detalle_venta ON incentivadodet.codpro = detalle_venta.codpro 
                                            inner join venta on detalle_venta.invnum = venta.invnum
                                                where 
                                                detalle_venta.incentivo =  '$nro' AND incentivadodet.invnum =  '$nro' and
                                                sucursal = '$sucursal' and detalle_venta.codpro = '$codpro' and detalle_venta.incentivo = '$nro' and venta.usecod = '$usecod' and venta.val_habil = '0'";
                                            $result1 = mysqli_query($conexion,$sql1);
                                            if (mysqli_num_rows($result1)) {
                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                    $vpripro = $row1[0];
                                                }
                                            }
                                            $sql1 = "SELECT sum(detalle_venta.canpro) 
                                                FROM incentivadodet
                                            INNER JOIN detalle_venta ON incentivadodet.codpro = detalle_venta.codpro 
                                            inner join venta on detalle_venta.invnum = venta.invnum
                                                where 
                                                detalle_venta.incentivo =  '$nro' AND incentivadodet.invnum =  '$nro' and
                                                sucursal = '$sucursal' and detalle_venta.codpro = '$codpro' and detalle_venta.incentivo = '$nro' and venta.usecod = '$usecod' and detalle_venta.fraccion = 'T' and venta.val_habil = '0'";
                                            //echo $sql1."<br><br>";
                                            $result1 = mysqli_query($conexion,$sql1);
                                            if (mysqli_num_rows($result1)) {
                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                    $sumcanprot = $row1[0];
                                                }
                                            }
                                            else
                                            {
                                                $sumcanprot = 0;
                                            }
                                            $sql1 = "SELECT sum(detalle_venta.canpro),detalle_venta.factor 
                                                FROM incentivadodet
                                            INNER JOIN detalle_venta ON incentivadodet.codpro = detalle_venta.codpro 
                                            inner join venta on detalle_venta.invnum = venta.invnum
                                                where 
                                                detalle_venta.incentivo =  '$nro' AND incentivadodet.invnum =  '$nro' and
                                                sucursal = '$sucursal' and detalle_venta.codpro = '$codpro' and detalle_venta.incentivo = '$nro' and venta.usecod = '$usecod' and detalle_venta.fraccion = 'F' and venta.val_habil = '0' group by detalle_venta.factor";
                                            //echo $sql1."<br><br>";
                                            $result1 = mysqli_query($conexion,$sql1);
                                            if (mysqli_num_rows($result1)) {
                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                    $sumcanprof = $row1[0];
                                                    $factorf = $row1[1];
                                                    $totf = $sumcanprof * $factorf;
                                                    $totf1 = $totf1 + $totf;
                                                }
                                            }
                                            else
                                            {
                                                $sumcanprof = 0;
                                                $totf1 = 0;
                                            }
                                            if (($factorf == 0) or ($factorf == '')) {
                                                $factorf = 1;
                                            }
                                            /////CANTIDAD VENDIDA/////////////////////
                                            $cantunid = $sumcanprot + $totf1;
                                            //////////////////////////////////////////
                                            $sql1 = "SELECT canprocaj,canprounid,factor,pripro FROM incentivadodet where codpro = '$codpro' and invnum = '$nro' and codloc = '$sucursal'";
                                            $result1 = mysqli_query($conexion,$sql1);
                                            if (mysqli_num_rows($result1)) {
                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                    $canprocaj  = $row1['canprocaj'];
                                                    $canprounid = $row1['canprounid'];
                                                    $factorinc  = $row1['factor'];
                                                    $ipripro    = $row1['pripro'];
                                                }
                                            }
                                            if (($factorinc == 0) or ($factorinc == '')) {
                                                $factorinc = 1;
                                            }
                                            /////CANTIDAD POR EL INCENTIVO/////////////////////
                                            $totcunid1 = $canprocaj * $factorinc;
                                            $totcunid2 = $canprounid;
                                            $totcunid = $totcunid1 + $totcunid2;
                                            ///////////////////////////////////////////////////
                                            $sql1 = "SELECT nomloc FROM xcompa where codloc = '$sucursal'";
                                            $result1 = mysqli_query($conexion,$sql1);
                                            if (mysqli_num_rows($result1)) {
                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                    $nomloc = $row1['nomloc'];
                                                }
                                            }
                                            $sql1 = "SELECT nomusu FROM usuario where usecod = '$usecod'";
                                            $result1 = mysqli_query($conexion,$sql1);
                                            if (mysqli_num_rows($result1)) {
                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                    $nomusu = $row1['nomusu'];
                                                }
                                            }
                                            $sql1 = "SELECT desprod FROM producto where codpro = '$codpro'";
                                            $result1 = mysqli_query($conexion,$sql1);
                                            if (mysqli_num_rows($result1)) {
                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                    $desprod = $row1['desprod'];
                                                }
                                            }
                                            //if ($cantunid >= $totcunid) {
                                            if ($totcunid > 0)
											{
                                                $tot = ($cantunid * $ipripro) / $totcunid;
											}
											else
											{
												$tot = 0;
												}
                                                $sumincentivo[$zz] = $sumincentivo[$zz] + $tot;
                                                if (($suc[$zz - 1] <> "") and ($suc[$zz - 1] <> $suc[$zz])) {  //////////LINEA 1
                                                    ?>
                                                        <tr bgcolor="#CCCCCC">
                                                            <td width="95"></td>
                                                            <td width="95"></td>
                                                            <td width="538"><strong>TOTAL</strong></td>
                                                            <td width="95"><div align="right"></div></td>
                                                            <td width="88"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz - 1], 2, '.', ' '); ?></div></td>
                                                        </tr>
                                                    <?php }
                                                    ?>
                                                    <tr>
                                                        <td width="95"><?php echo $nomloc ?></td>
                                                        <td width="95"><?php echo $nomusu ?></td>
                                                        <td width="538"><?php echo $desprod ?></td>
                                                        <td width="95"><div align="right"><?php echo $cantunid ?></div></td>
                                                        <td width="88"><div align="right"><?php echo $numero_formato_frances = number_format($tot, 2, '.', ' '); ?></div></td>
                                                    </tr>
                                                <?php
                                                //} ////if ($cantunid >= $totcunid)
                                            }
                                            ?>
                                        </table>
                                            <?php
                                            if ($zz == 1) {
                                                if (($sumincentivo[$zz] <> 0) or ($sumincentivo[$zz] <> '')) {
                                                    ?>
                                                <table width="926" border="0" align="center">
                                                    <tr bgcolor="#CCCCCC">
                                                        <td width="95"></td>
                                                        <td width="95"></td>
                                                        <td width="538"><strong>TOTAL</strong></td>
                                                        <td width="95"><div align="right"></div></td>
                                                        <td width="88"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz], 2, '.', ' '); ?></div></td>
                                                    </tr>
                                                </table>
                                                <?php
                                                }
                                            } /////($zz == 1)
                                            else {
                                                if (($sumincentivo[$zz] <> 0) or ($sumincentivo[$zz] <> '')) {
                                                    ?>
                                                <table width="926" border="0" align="center">
                                                    <tr bgcolor="#CCCCCC">
                                                        <td width="95"></td>
                                                        <td width="95"></td>
                                                        <td width="538"><strong>TOTAL</strong></td>
                                                        <td width="95"><div align="right"></div></td>
                                                        <td width="88"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz], 2, '.', ' '); ?></div></td>
                                                    </tr>
                                                </table>
                                                <?php
                                                }
                                            } ////CIERRO EL ELSE
                                            ?>
                                        <?php
                                        }  ////if (mysqli_num_rows($result)){
                                        else {
                                            ?>
                                        <center>
                                            No se logro encontrar informacion con los datos ingresados
                                        </center>
                                        <?php
                                        }
                                    }
                                    ++$rr;
                                }
                                ?>
                        </td>
                    </tr>
                </table>
    <?php
    }   //////cierro el tipo = 6
//detallado por venta y por vendedor
    if ($tipo == 7) {
        ?>
                <table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><table width="926" border="0" align="center">
                                <tr>
                                    <td width="96"><strong>SUCURSAL</strong></td>
                                    <td width="151"><div align="left"><strong>VENDEDOR</strong></div></td>
                                    <td width="76"><div align="left"><strong>NRO VENTA</strong></div></td>
                                    <td width="418"><div align="left"><strong>PRODUCTO</strong></div></td>
                                    <td width="72"><div align="right"><strong>CANT VEND</strong></div></td>
                                    <td width="87"><div align="right"><strong>MONTO INCENT</strong></div></td>
                                </tr>
                            </table></td>
                    </tr>
                </table>
                <table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <?php
                            $i = 0;
                            while ($rr < $contador) {
                                $nro = $ccc[$rr];
                                if ($nro <> '') {
                                    if ($local == "all") {
                                        $sql = "SELECT sucursal,detalle_venta.usecod,fraccion,detalle_venta.factor,detalle_venta.canpro,detalle_venta.pripro,incentivadodet.pripro,incentivadodet.codpro,canprocaj,canprounid,incentivadodet.factor,nrovent FROM incentivadodet inner join detalle_venta on incentivadodet.codpro = detalle_venta.codpro inner join venta on detalle_venta.invnum = venta.invnum where detalle_venta.incentivo = '$nro' and incentivadodet.invnum = '$nro' and venta.val_habil = '0' group by detalle_venta.invnum,detalle_venta.codpro,detalle_venta.usecod,sucursal order by sucursal,detalle_venta.usecod,nrovent";
                                    } else {
                                        $sql = "SELECT sucursal,detalle_venta.usecod,fraccion,detalle_venta.factor,detalle_venta.canpro,detalle_venta.pripro,incentivadodet.pripro,incentivadodet.codpro,canprocaj,canprounid,incentivadodet.factor,nrovent FROM incentivadodet inner join detalle_venta on incentivadodet.codpro = detalle_venta.codpro inner join venta on detalle_venta.invnum = venta.invnum where detalle_venta.incentivo = '$nro' and incentivadodet.invnum = '$nro' and sucursal = '$local' and venta.val_habil = '0' group by detalle_venta.invnum,detalle_venta.codpro,detalle_venta.usecod,sucursal order by sucursal,detalle_venta.usecod,nrovent";
                                    }
                                    //echo $sql."<br><br>";
                                    $result = mysqli_query($conexion,$sql);
                                    $zz = 0;
                                    if (mysqli_num_rows($result)) {
                                        ?>
                                        <table width="926" border="0" align="center">
                                        <?php
                                        while ($row = mysqli_fetch_array($result)) {
                                            $sucursal   = $row['sucursal'];
                                            $usecod     = $row[1];
                                            $fraccion   = $row['fraccion'];
                                            $factor     = $row['factor'];
                                            $vcanpro    = $row[4];
                                            $vpripro    = $row[5];
                                            $ipripro    = $row[6];
                                            $codpro     = $row[7];
                                            $canprocaj  = $row['canprocaj'];
                                            $canprounid = $row['canprounid'];
                                            $factorinc  = $row[10];
                                            $nrovent    = $row['nrovent'];
                                            if (($factor == 0) or ($factor == '')) {
                                                $factor = 1;
                                            }
                                            /////CANTIDAD VENDIDA/////////////////////
                                            if ($fraccion == "T") {
                                                $desc_f = "UNID";
                                                $cantunid = $vcanpro;
                                            } else {
                                                $desc_f = "CAJA";
                                                $cantunid = $factor * $vcanpro;
                                            }
                                            ///////////////////////////////////
                                            //su zz = 1 quiere decir que solo hay una sucursal
                                            if ($sucursal <> $suc[$zz]) {
                                                $zz++;
                                                $suc[$zz] = $sucursal;
                                            }
                                            ///////////////////////////////////
                                            $sql3 = "SELECT nomusu FROM usuario where usecod = '$usecod'";
                                            $result3 = mysqli_query($conexion,$sql3);
                                            if (mysqli_num_rows($result3)) {
                                                while ($row3 = mysqli_fetch_array($result3)) {
                                                    $nomusu = $row3['nomusu'];
                                                }
                                            }
                                            $sql3 = "SELECT nomloc FROM xcompa where codloc = '$sucursal'";
                                            $result3 = mysqli_query($conexion,$sql3);
                                            if (mysqli_num_rows($result3)) {
                                                while ($row3 = mysqli_fetch_array($result3)) {
                                                    $sucur = $row3['nomloc'];
                                                }
                                            }
                                            /////CANTIDAD POR EL INCENTIVO/////////////////////
                                            $totcunid1 = $canprocaj * $factorinc;
                                            $totcunid2 = $canprounid;
                                            $totcunid = $totcunid1 + $totcunid2;
                                            ///////////////////////////////////
                                            $sql1 = "SELECT nomloc FROM xcompa where codloc = '$sucursal'";
                                            $result1 = mysqli_query($conexion,$sql1);
                                            if (mysqli_num_rows($result1)) {
                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                    $nomloc = $row1['nomloc'];
                                                }
                                            }
                                            $sql1 = "SELECT desprod FROM producto where codpro = '$codpro'";
                                            $result1 = mysqli_query($conexion,$sql1);
                                            if (mysqli_num_rows($result1)) {
                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                    $desprod = $row1['desprod'];
                                                }
                                            }
                                            //if ($cantunid >= $totcunid) {
                                            //echo $codpro."<br><br>";
                                                $tot = ($cantunid * $ipripro) / $totcunid;
                                                //echo $codpro." - ".$cantunid." - ".$ipripro." - ".$totcunid." = ".$tot."<br><br>";
                                                $sumincentivo[$zz] = $sumincentivo[$zz] + $tot;
                                                if (($suc[$zz - 1] <> "") and ($suc[$zz - 1] <> $suc[$zz])) {  //////////LINEA 1
                                                    ?>
                                                        <tr bgcolor="#CCCCCC">
                                                            <td width="96"></td>
                                                            <td width="151"></td>
                                                            <td width="76"></td>
                                                            <td width="418"></td>
                                                            <td width="72"><div align="right"><strong>TOTAL</strong></div></td>
                                                            <td width="87"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz - 1], 2, '.', ' '); ?></div></td>
                                                        </tr>
                                                    <?php } //////////LINEA 1
                                                    ?>
                                                    <tr>
                                                        <td width="96"><?php echo $nomloc ?></td>
                                                        <td width="151"><?php echo $nomusu ?></td>
                                                        <td width="76"><?php echo $nrovent ?></td>
                                                        <td width="418"><?php echo $desprod ?></td>
                                                        <td width="72"><div align="right"><?php echo $vcanpro;
                            echo " ";
                            echo $desc_f; ?></div></td>
                                                        <td width="87"><div align="right"><?php echo $numero_formato_frances = number_format($tot, 2, '.', ' '); ?></div></td>
                                                    </tr>
                                                <?php
                                                //}   /////////if ($cantunid >= $totcunid)
                                            }  /////////while ($row = mysqli_fetch_array($result)){
                                            ?>
                                        </table>
                                            <?php
                                            if ($zz == 1) {
                                                if (($sumincentivo[$zz] <> 0) or ($sumincentivo[$zz] <> '')) {
                                                    ?>
                                                <table width="926" border="0" align="center">
                                                    <tr bgcolor="#CCCCCC">
                                                        <td width="96"></td>
                                                        <td width="151"></td>
                                                        <td width="76"></td>
                                                        <td width="418"></td>
                                                        <td width="72"><div align="right"><strong>TOTAL</strong></div></td>
                                                        <td width="87"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz], 2, '.', ' '); ?></div></td>
                                                    </tr>
                                                </table>
                                                <?php
                                                }
                                            } /////($zz == 1)
                                            else {
                                                if (($sumincentivo[$zz] <> 0) or ($sumincentivo[$zz] <> '')) {
                                                    ?>
                                                <table width="926" border="0" align="center">
                                                    <tr bgcolor="#CCCCCC">
                                                        <td width="96"></td>
                                                        <td width="151"></td>
                                                        <td width="76"></td>
                                                        <td width="418"></td>
                                                        <td width="72"><div align="right"><strong>TOTAL</strong></div></td>
                                                        <td width="87"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz], 2, '.', ' '); ?></div></td>
                                                    </tr>
                                                </table>
                                                <?php
                                                }
                                            } ////CIERRO EL ELSE
                                            ?>
                                        <?php
                                        }  ////if (mysqli_num_rows($result)){
                                        else {
                                            ?>
                                        <center>No se logro encontrar informacion con los datos ingresados</center>
                                        <?php
                                        }
                                    }
                                    ++$rr;
                                }
                                ?>
                        </td>
                    </tr>
                </table>
                            <?php
                            }   //////cierrto el tipo = 7
                        }   //////cierro el if (val)
                        ?>
    </body>
</html>
