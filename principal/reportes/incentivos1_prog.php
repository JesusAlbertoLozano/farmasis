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
        <title><?php echo $desemp ?></title>
    
    <style type="text/css">
.Estilo1 {
	color: #ffffff;
	font-weight: bold;
}
.Estilo2 {
	color: #ff0000;
	font-weight: bold;
}
.Estilo3 {
	font-style:italic;
  font-weight:bold;
  font-size:2em;
  font-color:#ffffff;
  font-family:'Helvetica','Verdana','Monaco',sans-serif;
}
</style>
        </head>
    <?php
//    require_once("../../funciones/functions.php"); //DESHABILITA TECLAS
    require_once("../../funciones/funct_principal.php"); //IMPRIMIR-NUME
    $sql = "SELECT nomusu FROM usuario where usecod = '$usuario'";
    $result = mysqli_query($conexion,$sql);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_array($result)) {
            $user = $row['nomusu'];
        }
    }
    $hour = date('G') - 5;
    $date = CalculaFechaHora($hour);
    $hour = CalculaHora($hour);
    $min = date('i');
    if ($hour <= 12) {
        $hor = "am";
    } else {
        $hor = "pm";
    }
    $nro = $_REQUEST['nro'];
    $val = $_REQUEST['val'];
    $tipo = $_REQUEST['tipo'];
    $local = $_REQUEST['local'];
    $ccc = explode(",", $nro);
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
                            <td width="358"><div align="center"><strong><H3>REPORTE DE PRODUCTOS INCENTIVADOS</H3> </strong></div></td>
                            <td width="271"><div align="right"><strong>FECHA: <?php echo date('d/m/Y'); ?> - HORA : <?php echo $hour; ?>:<?php echo $min; ?> <?php echo $hor ?></strong></div></td>
                        </tr>

                    </table>
                    <table width="914" border="0">
                        <tr>
                            <td width="271"><strong></strong></td>
                            <?php  if ($val == 1) {?>
                            
                            <td width="358"><div align="center">NRO DE INCENTIVO CONSULTADO: <?php echo $nro ?></div></td>
                            <?php }else{?>
                            <td width="500" > <div align="center" class="Estilo3">LISTA DE PRODUCTOS INCENTIVADOS</div></td>
                            <?php }?>
                            
                            
                            <td width="271"><div align="right">USUARIO: <span class="text_combo_select"><?php echo $user ?></span></div></td>
                        </tr>
                    </table>
                    <div align="center"><img src="../../images/line2.png" width="910" height="4" /></div></td>
            </tr>
        </table>
<?php
if ($val == 1) {
    
     $sql1 = "SELECT I.invnum,I.dateini,I.datefin,ID.codpro FROM `incentivado` as I INNER JOIN incentivadodet as ID ON ID.invnum=I.invnum WHERE I.invnum='$nro' ";
        $result1 = mysqli_query($conexion,$sql1);
        if (mysqli_num_rows($result1)) {
            while ($row1 = mysqli_fetch_array($result1)) {
                $invnum = $row1['invnum'];
                $dateini = $row1['dateini'];
                $datefin = $row1['datefin'];
                $codproince = $row1['codpro'];
            }
     }
    
     
     
     
    //DETALLADO POR VENTAS
    if ($tipo == 1) {
        ?>
                <table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><table width="926" border="0" align="center">
                                <tr>
                                    <td width="80"><strong>LOCAL</strong></td>
                                    <td width="80"><div align="center"><strong>N&ordm; VENTA</strong></div></td>
                                    <td width="80"><div align="center"><strong>N&ordm; DOCUMENTO</strong></div></td>
                                    <td width="80"><div align="center"><strong>FECHA</strong></div></td>
                                    <td width="497"><div align="left"><strong>VENDEDOR</strong></div></td>
                                    <td width="50"><div align="center"><strong>COD. PROD</strong></div></td>
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
                    $sqls = "SELECT DV.invnum,DV.codpro FROM venta AS V INNER JOIN detalle_venta as DV ON DV.invnum=V.invnum INNER JOIN incentivadodet AS I ON I.codpro=DV.codpro WHERE DV.invfec between '$dateini' and '$datefin'  and V.val_habil = '0' AND I.invnum='$nro'  group by DV.codpro order by DV.codpro ";
                } else {

                    $sqls = "SELECT DV.invnum,DV.codpro FROM venta AS V INNER JOIN detalle_venta as DV ON DV.invnum=V.invnum INNER JOIN incentivadodet AS I ON I.codpro=DV.codpro WHERE DV.invfec between '$dateini' and '$datefin'  and V.val_habil = '0' AND I.invnum='$nro' and V.sucursal = '$local' group by DV.codpro order by DV.codpro ";
                }
                $results = mysqli_query($conexion,$sqls);
                $zz = 0;
                if (mysqli_num_rows($results)) {
                    ?>
                                        <table width="926" border="0" align="center">
                                        <?php
                                        while ($rows = mysqli_fetch_array($results)) {
                                            $invnum = $rows['invnum'];
                                            $codpro = $rows['codpro'];
                                            $sql1 = "SELECT desprod,codpro FROM producto where codpro = '$codpro' ";
                                            $result1 = mysqli_query($conexion,$sql1);
                                            if (mysqli_num_rows($result1)) {
                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                    $codpro2 = $row1['codpro'];
                                                    $desprod = $row1['desprod'];
                                                }
                                            }
                                            //echo $codpro;
                                            if ($local == "all") {
                                                $sql = "SELECT sucursal,nrovent,fraccion,detalle_venta.factor,detalle_venta.canpro,detalle_venta.pripro AS PRI,incentivadodet.pripro,incentivadodet.codpro,incentivadodet.canprocaj,incentivadodet.canprounid,detalle_venta.factor,detalle_venta.invfec,venta.nrofactura,detalle_venta.usecod FROM incentivadodet inner join detalle_venta on incentivadodet.codpro = detalle_venta.codpro inner join venta on detalle_venta.invnum = venta.invnum where detalle_venta.invfec between '$dateini' and '$datefin' and detalle_venta.codpro = '$codpro' and incentivadodet.invnum='$nro'  and venta.val_habil = '0' group by detalle_venta.invnum,venta.sucursal order by venta.sucursal,nrovent";
                                            } else {
                                                $sql = "SELECT sucursal,nrovent,fraccion,detalle_venta.factor,detalle_venta.canpro,detalle_venta.pripro AS PRI ,incentivadodet.pripro,incentivadodet.codpro,incentivadodet.canprocaj,incentivadodet.canprounid,detalle_venta.factor,detalle_venta.invfec,venta.nrofactura,detalle_venta.usecod FROM incentivadodet inner join detalle_venta on incentivadodet.codpro = detalle_venta.codpro inner join venta on detalle_venta.invnum = venta.invnum where detalle_venta.invfec between '$dateini' and '$datefin' and detalle_venta.codpro = '$codpro' and incentivadodet.invnum='$nro' and venta.sucursal = '$local' and venta.val_habil = '0' group by detalle_venta.invnum,venta.sucursal order by venta.sucursal,nrovent";
                                            }
                                            //echo $sql."<br><br>";
                                            $result = mysqli_query($conexion,$sql);
                                            if (mysqli_num_rows($result)) {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $sucursalL  = $row['sucursal'];
                                                    $nrovent   = $row['nrovent'];
                                                    $fraccion  = $row['fraccion'];
                                                    $factor    = $row['factor'];
                                                    $vcanpro   = $row['canpro'];
                                                    $vpripro   = $row['PRI'];
                                                    $ipripro   = $row['pripro'];
                                                    $codpro    = $row['codpro'];
                                                    $canprocaj = $row['canprocaj'];
                                                    $canprounid= $row['canprounid'];
                                                    $factorinc = $row['factor'];
                                                    $invfec    = $row['invfec'];
                                                    $nrofactura= $row['nrofactura'];
                                                    $usecod    = $row['usecod'];
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
                                                        $cantunid = $vcanpro *$factor;
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
                                                    $sql1 = "SELECT nomloc FROM xcompa where codloc = '$sucursalL'";
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
                                                    //echo $codpro." - ".$cantunid." - ".$totcunid."<br><br>";
                                                    //if ($cantunid >= $totcunid) {
                                                        $tot = ($cantunid * $ipripro) / $totcunid;
                                                        $sumincentivo[$zz] = $sumincentivo[$zz] + $tot;
                                                        
                                                        if (($suc[$zz - 1] <> "") and ($suc[$zz - 1] <> $suc[$zz])) {  //////////LINEA 1
                                                            ?>
                                                                <tr bgcolor="#9cc4e1">
                                                                    <!--<td colspan="4"><div align="right"></div></td>-->
                                                                    <td height="25" colspan="2" width="76"><div align="center"><strong>TOTAL3</strong></div></td>
                                                                    <td width="84"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz], 2, '.', ' '); ?></div></td>
                                                                </tr>
                                                                <?php
                                                            } //////////LINEA 1
                                                            ?>
                                                            <tr height="35"  <?php if($date2){?> bgcolor="#ff0000"<?php } else {?>onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#ffffff';"<?php }?>>
                                                                <!--<td width="87"><?php echo $sucursal ?></td>-->
                                                                <td width="60"><?php echo $nomloc ?></td>
                                                                <td width="75" align="center"><?php echo $nrovent ?></td>
                                                                <td width="80" align="center"><?php echo $nrofactura ?></td>
                                                                <td width="65" align="center"><?php  echo $invfec; ?></td>
                                                                <td width="350"><?php echo $nomusu ?></td>
                                                                <td width="350" align="center"><?php echo $codpro2 ?></td>
                                                                <td width="350"><?php echo $desprod ?></td>
                                                                <td width="76"><div align="right"><?php echo $vcanpro;
                                                                echo "  ";
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
                                                    <tr bgcolor="#9cc4e1">
                                                        <!--<td><div align="right"></div></td>-->
                                                        <td height="25"  colspan="2" width="76"><div align="center"><strong>TOTAL</strong></div></td>
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
                                                    <tr bgcolor="#9cc4e1">
                                                        <!--<td><div align="right"></div></td>-->
                                                        <td height="25"  colspan="2"width="76"><div align="center"><strong>TOTALLL</strong></div></td>
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
<center><p class='Estilo2'>No se logro encontrar informacion con los datos ingresados</p></center>                                    <?php
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
                    $sqls = "SELECT D.codpro FROM detalle_venta AS D INNER JOIN venta AS V ON V.invnum=D.invnum inner join incentivadodet as I on I.codpro=D.codpro WHERE D.invfec between '$dateini' and '$datefin' and I.invnum='$nro'  group by D.codpro order by D.codpro ";
                } else {
                    $sqls = "SELECT D.codpro FROM detalle_venta AS D INNER JOIN venta AS V ON V.invnum=D.invnum inner join incentivadodet as I on I.codpro=D.codpro WHERE D.invfec between '$dateini' and '$datefin' and I.invnum='$nro' and V.sucursal = '$local' group by D.codpro order by D.codpro ";
                }
                $results = mysqli_query($conexion,$sqls);
                $zz = 0;
                if (mysqli_num_rows($results)) {
                    ?>
                                        <table width="926" border="0" align="center">
                    <?php
                    while ($rows = mysqli_fetch_array($results)) {
                        $codpro = $rows['codpro'];
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
                            
                            $sql = "SELECT DV.codpro,sucursal FROM incentivadodet AS I inner join detalle_venta AS DV on I.codpro = DV.codpro inner join venta AS V on DV.invnum = V.invnum where DV.codpro = '$codpro'  and DV.incentivo<>''and V.val_habil = '0' group by DV.codpro,sucursal order by sucursal,nrovent";
                        } else {
                            $sql = "SELECT detalle_venta.codpro,sucursal 
							FROM incentivadodet inner join detalle_venta on incentivadodet.codpro = detalle_venta.codpro
							inner join venta on detalle_venta.invnum = venta.invnum 
							where sucursal = '$local' and detalle_venta.incentivo<>''  and detalle_venta.codpro = '$codpro' and venta.val_habil = '0' 
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
                                $sql1 = "SELECT sum(pripro) FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum where sucursal = '$sucursal'   and detalle_venta.invfec between '$dateini' and '$datefin' AND detalle_venta.incentivo<>'' and codpro = '$codpro'  and venta.val_habil = '0'";
                                //echo $sql1."<br><br>";
                                $result1 = mysqli_query($conexion,$sql1);
                                if (mysqli_num_rows($result1)) {
                                    while ($row1 = mysqli_fetch_array($result1)) {
                                        $vpripro = $row1[0];
                                    }
                                }
                                $sql1 = "SELECT sum(canpro) FROM detalle_venta AS D inner join venta AS V on D.invnum = V.invnum where V.sucursal = '$sucursal' and D.codpro = '$codpro' and D.invfec between '$dateini' and '$datefin' and D.fraccion = 'T' and V.val_habil = '0'AND D.incentivo<>'' ";
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
                                $sql1 = "SELECT sum(canpro),factor FROM detalle_venta AS D inner join venta AS V on D.invnum = V.invnum where V.sucursal = '$sucursal' and D.codpro = '$codpro' and D.invfec between '$dateini' and '$datefin' and D.fraccion = 'F' and V.val_habil = '0'AND D.incentivo<>'' ";
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
                                $sql1 = "SELECT canprocaj,canprounid,factor,pripro,codloc FROM incentivadodet where codpro = '$codpro' and invnum='$nro' ";
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
                                                                <tr bgcolor="#9cc4e1">
                                                                    <!--<td width="87"></td>-->
                                                                    <td width="375" height="25" align="center" colspan="5"><strong>TOTAL</strong></td>
<!--                                                                    <td width="177"><div align="right"></div></td>
                                                                    <td width="87"><div align="right"></div></td>
                                                                    <td width="87"><div align="right"></div></td>-->
                                                                    <td width="87"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz - 1], 2, '.', ' '); ?></div></td>
                                                                </tr>
                                                            <?php }
                                                            ?>
                                                            <tr height="35" <?php  if($date2){?> bgcolor="#ff0000"<?php } else {?>onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#ffffff';"<?php }?>>
                                                                <td width="87"><?php echo $codpro ?></td>
                                                                <td width="375"><?php echo $desprod ?></td>
                                                                <td width="177"><?php echo substr($destab, 0, 35); ?></td>
                                                                <td width="87"><div align="center"><?php echo $cantunid ?></div></td>
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
                                                    <tr bgcolor="#9cc4e1">
<!--                                                        <td width="87"></td>-->
                                                        <td width="375" height="25" align="center" colspan="5"><strong>TOTAL</strong></td>
<!--                                                        <td width="177"><div align="right"></div></td>
                                                        <td width="87"><div align="right"></div></td>
                                                        <td colspan="5" width="87"><div align="right"></div></td>-->
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
                                                    <tr bgcolor="#9cc4e1">
                                                        <!--<td width="87"></td>-->
                                                        <td width="375" height="25" align="center" colspan="5"><strong>TOTAL</strong></td>
<!--                                                        <td width="177"><div align="right"></div></td>
                                                        <td width="87"><div align="right"></div></td>
                                                        <td width="87"><div align="right"></div></td>-->
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
                                        <center><p class='Estilo2'>No se logro encontrar informacion con los datos ingresados</p></center>
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
                                $sql = "SELECT DV.usecod,V.sucursal FROM venta AS V INNER JOIN detalle_venta as DV ON DV.invnum=V.invnum INNER JOIN incentivadodet AS I ON I.codpro=DV.codpro WHERE DV.invfec between '$dateini' and '$datefin' AND I.invnum='$nro' and V.val_habil = '0'  group by usecod order by sucursal,nrovent";
                            } else {
                                $sql = "SELECT DV.usecod,V.sucursal FROM venta AS V INNER JOIN detalle_venta as DV ON DV.invnum=V.invnum INNER JOIN incentivadodet AS I ON I.codpro=DV.codpro WHERE DV.invfec between '$dateini' and '$datefin' AND I.invnum='$nro' and V.sucursal = '$local'  and V.val_habil = '0' group by usecod order by sucursal,nrovent";
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
                                $sqlx = "SELECT DV.codpro FROM detalle_venta AS DV inner join venta AS V on DV.invnum = V.invnum  INNER JOIN incentivadodet AS I ON I.codpro=DV.codpro where V.usecod= '$usecod'  and V.val_habil = '0' and DV.invfec between '$dateini' and '$datefin' AND I.invnum='$nro'  group by DV.codpro";
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
                                             detalle_venta.invfec between '$dateini' and '$datefin' and
                                            detalle_venta.codpro = '$codpro' and detalle_venta.usecod = '$usecod' and incentivadodet.invnum='$nro' ";
//                                        echo $sql1."<br><br>";
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
                                             detalle_venta.invfec between '$dateini' and '$datefin' and
                                            detalle_venta.codpro = '$codpro' and incentivadodet.invnum='$nro' and venta.sucursal = '$local' and fraccion = 'T'  and venta.val_habil = '0' and venta.usecod = '$usecod' ";
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
                                         detalle_venta.invfec between '$dateini' and '$datefin' and
                                        detalle_venta.codpro = '$codpro' and incentivadodet.invnum='$nro' and fraccion = 'F'  and venta.sucursal = '$local' and venta.val_habil = '0' and venta.usecod = '$usecod'  group by factor";
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
                                        $sql1 = "SELECT canprocaj,canprounid,factor,pripro FROM incentivadodet where codpro = '$codpro' and invnum='$nro' ";
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
                                                            <tr bgcolor="#9cc4e1">
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
                                                        <tr height="35" <?php  if($date2){?> bgcolor="#ff0000"<?php } else {?>onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#ffffff';"<?php }?>>
                                                            <!--<td width="84"><?php echo $nomloc ?></td>-->
                                                            <td width="520"><?php echo $usecod." - ".$nomusu ?></td>
                                                            <!--<td width="260"><?php echo $codpro." - ".$nombreprod ?></td>-->
                                                            <!--<td width="69"><?php echo number_format($sumcosto, 2, '.', ' '); ?></td>-->
                                                            <!--<td width="59"><?php echo number_format($rentabi, 2, '.', ' '); ?></td>-->
                                                            <td width="85" align="center" ><?php echo $SumGenVentas ?></td>
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
                                                    <tr bgcolor="#9cc4e1">
                                                        <!--<td width="84"></td>-->
                                                        <!--<td width="520"></td>-->
<!--                                                        <td width="260"></td>
                                                        <td width="69"></td>
                                                        <td width="59"></td>-->
                                                        <td colspan="5" height="25" align="center" width="85"><strong>TOTAL</strong></td>
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
                                                    <tr bgcolor="#9cc4e1">
                                                        <!--<td width="84"></td>-->
                                                        <!--<td width="520"></td>-->
<!--                                                        <td width="260"></td>
                                                        <td width="69"></td>
                                                        <td width="59"></td>-->
                                                        <td colspan="5" height="25" align="center"  width="85"><strong>TOTAL</strong></td>
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
                                        <center><p class='Estilo2'>No se logro encontrar informacion con los datos ingresados</p></center>
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
                    $sql = "SELECT V.sucursal  FROM venta AS V inner join detalle_venta AS DV on DV.invnum = V.invnum INNER JOIN incentivadodet AS I ON I.codpro=DV.codpro where DV.invfec between '$dateini' and '$datefin' and DV.incentivo <>''  AND I.invnum='$nro' and V.val_habil = '0' group by V.sucursal order by V.sucursal,V.nrovent";
                } else {
                    $sql = "SELECT V.sucursal  FROM venta AS V inner join detalle_venta AS DV on DV.invnum = V.invnum INNER JOIN incentivadodet AS I ON I.codpro=DV.codpro where DV.invfec between '$dateini' and '$datefin' and DV.incentivo <>'' and V.sucursal = '$local' AND I.invnum='$nro' and V.val_habil = '0' group by V.sucursal order by V.sucursal,V.nrovent";
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
                        $sqlx = "SELECT detalle_venta.codpro FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum INNER JOIN incentivadodet AS I ON I.codpro=detalle_venta.codpro where detalle_venta.invfec between '$dateini' and '$datefin' AND I.invnum='$nro'  and sucursal ='$sucursal' and venta.val_habil = '0' group by codpro";
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
                                    detalle_venta.invfec between '$dateini' and '$datefin' and detalle_venta.incentivo <>'' and
                                    sucursal = '$sucursal' and detalle_venta.codpro = '$codpro' and incentivadodet.invnum = '$nro' and detalle_venta.fraccion = 'T' and venta.val_habil = '0'";
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
                                    detalle_venta.invfec between '$dateini' and '$datefin' and detalle_venta.incentivo <>'' and
                                    sucursal = '$sucursal' and detalle_venta.codpro = '$codpro' and incentivadodet.invnum = '$nro' and detalle_venta.fraccion = 'F' and venta.val_habil = '0' group by detalle_venta.factor";
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
                                $sql1 = "SELECT canprocaj,canprounid,factor,pripro FROM incentivadodet where codpro = '$codpro' and invnum = '$nro' ";
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
                                                            <tr bgcolor="#9cc4e1">
                                                                <td height="25" width="157"><strong>TOTAL</strong></td>
                                                                <td width="117"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz - 1], 2, '.', ' '); ?></div></td>
                                                            </tr>
                                                        <?php } /////if (($suc[$zz-1] <> "") and ($suc[$zz-1] <> $suc[$zz]))
                                                        ?>
                                                        <tr height="35" <?php  if($date2){?> bgcolor="#ff0000"<?php } else {?>onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#ffffff';"<?php }?>>
                                                            <td width="557"><?php echo $nomloc ?></td>
                                                            <td width="80"><div align="right"><?php echo $numero_formato_frances = number_format($sumtot, 2, '.', ' '); ?></div></td>
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
                                                    <tr bgcolor="#9cc4e1">
                                                        <td height="25" align="center" width="557"><strong>TOTAL</strong></td>
                                                        <td width="80"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz], 2, '.', ' '); ?></div></td>
                                                    </tr>
                                                </table>
                                                <?php
                                                }
                                            } /////($zz == 1)
                                            else {
                                                if (($sumincentivo[$zz] <> 0) or ($sumincentivo[$zz] <> '')) {
                                                    ?>
                                                <table width="926" border="0" align="center">
                                                    <tr bgcolor="#9cc4e1">
                                                        <td height="25" align="center" width="557"><strong>TOTAL</strong></td>
                                                        <td width="80"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz], 2, '.', ' '); ?></div></td>
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
                                        <center><p class='Estilo2'>No se logro encontrar informacion con los datos ingresados</p></center>
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
                                        $sql = "SELECT DV.codpro,DV.usecod,DV.codmar FROM venta AS V INNER JOIN detalle_venta AS DV ON DV.invnum=V.invnum INNER JOIN incentivadodet AS I ON I.codpro=DV.codpro where DV.invfec between '$dateini' and '$datefin' and I.invnum='$nro' and DV.incentivo <>'' and V.val_habil = '0' group by DV.codpro,DV.usecod order by DV.usecod ";
                                    } else {
                                        $sql = "SELECT DV.codpro,DV.usecod,DV.codmar FROM venta AS V INNER JOIN detalle_venta AS DV ON DV.invnum=V.invnum INNER JOIN incentivadodet AS I ON I.codpro=DV.codpro where DV.invfec between '$dateini' and '$datefin' and I.invnum='$nro' and DV.incentivo <>'' and V.sucursal = '$local' and V.val_habil = '0' group by DV.codpro,DV.usecod order by DV.usecod ";
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
                                                detalle_venta.invfec between '$dateini' and '$datefin' and detalle_venta.incentivo <>'' and
                                                detalle_venta.usecod = '$sucursal' and detalle_venta.codpro = '$codpro' and incentivadodet.invnum='$nro' and venta.val_habil = '0'";
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
                                                detalle_venta.invfec between '$dateini' and '$datefin' and detalle_venta.incentivo <>'' and
                                                detalle_venta.usecod = '$sucursal' and detalle_venta.codpro = '$codpro'  and incentivadodet.invnum='$nro' and detalle_venta.fraccion = 'T' and venta.val_habil = '0'";
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
                                                detalle_venta.invfec between '$dateini' and '$datefin' and detalle_venta.incentivo <>'' and
                                                detalle_venta.usecod = '$sucursal' and detalle_venta.codpro = '$codpro' and incentivadodet.invnum='$nro' and detalle_venta.fraccion = 'F' and venta.val_habil = '0' group by detalle_venta.factor";
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
                                                        <tr bgcolor="#9cc4e1">
<!--                                                            <td width="95"></td>
                                                            <td width="438"><strong></strong></td>
                                                            <td width="105"></td>-->
                                                            <td  colspan="4" height="25" align="center" width="95"><div align=""><strong>TOTAL</strong></div></td>
                                                            <td width="88"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz - 1], 2, '.', ' '); ?></div></td>
                                                        </tr>
                                                    <?php }
                                                    $contReg++;
                                                    ?>
                                                   <tr height="35" <?php  if($date2){?> bgcolor="#ff0000"<?php } else {?>onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#ffffff';"<?php }?>>
                                                        <td width="95"><?php echo $nomusu ?></td>
                                                        <td width="438"><?php echo $desprod ?></td>
                                                        <td width="105"><?php echo $destab ?></td>
                                                        <td width="95"><div align="center"><?php echo $cantunid ?></div></td>
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
                                                    <tr bgcolor="#9cc4e1">
<!--                                                        <td width="95"></td>
                                                        <td width="438"><strong></strong></td>
                                                        <td width="105"></td>-->
                                                        <td olspan="4" align="center" height="25" width="95"><div align=""><strong>TOTAL</strong></div></td>
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
                                                    <tr bgcolor="#9cc4e1">
<!--                                                        <td width="95"></td>
                                                        <td width="438"><strong></strong></td>
                                                        <td width="105"></td>-->
                                                        <td colspan="4" align="center"  height="25" width="95"><div align=""><strong>TOTAL</strong></div></td>
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
                                        <center><p class='Estilo2'>No se logro encontrar informacion con los datos ingresados</p></center>
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
											detalle_venta.invfec between '$dateini' and '$datefin' and
											venta.val_habil = '0' and incentivadodet.invnum='$nro'
											group by detalle_venta.codpro,sucursal,detalle_venta.usecod 
											order by sucursal,detalle_venta.usecod,nrovent";
                                        } else {
                                            $sql = "SELECT detalle_venta.codpro,sucursal,detalle_venta.usecod 
											FROM 
											incentivadodet inner join detalle_venta on incentivadodet.codpro = detalle_venta.codpro
											inner join venta on detalle_venta.invnum = venta.invnum 
											where 
											detalle_venta.invfec between '$dateini' and '$datefin' and
											sucursal = '$local' and venta.val_habil = '0' and incentivadodet.invnum='$nro' 
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
                                                detalle_venta.invfec between '$dateini' and '$datefin' and
                                                sucursal = '$sucursal' and incentivadodet.invnum='$nro' and detalle_venta.codpro = '$codpro'  and venta.usecod = '$usecod' and venta.val_habil = '0'";
                                            
                                            $result1 = mysqli_query($conexion,$sql1);
                                            if (mysqli_num_rows($result1)) {
                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                    $vpripro = $row1[0];
                                                }
                                            }
                                            
                                            $sql1 = "SELECT SUM(D.canpro),D.factor FROM `detalle_venta` as D inner join venta AS V on D.invnum = V.invnum where D.invfec between '$dateini' and '$datefin' and D.fraccion = 'T' and V.sucursal = '$sucursal' and D.usecod='$usecod' and D.codpro='$codpro' and V.val_habil = '0' group by D.factor";
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
                                            $sql1 = "SELECT SUM(D.canpro),D.factor FROM `detalle_venta` as D inner join venta AS V on D.invnum = V.invnum where D.invfec between '$dateini' and '$datefin' and D.fraccion = 'F' and V.sucursal = '$sucursal' and D.usecod='$usecod' and D.codpro='$codpro' and V.val_habil = '0' group by D.factor";
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
                                            $sql1 = "SELECT canprocaj,canprounid,factor,pripro FROM incentivadodet where codpro = '$codpro' and invnum='$nro'";
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
                                                        <tr bgcolor="#9cc4e1">
<!--                                                            <td width="95"></td>
                                                            <td width="95"></td>-->
                                                            <td width="538" align="CENTER" height="25" colspan="4"><strong>TOTAL</strong></td>
                                                            <!--<td width="95"><div align="right"></div></td>-->
                                                            <td width="88"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz - 1], 2, '.', ' '); ?></div></td>
                                                        </tr>
                                                    <?php }
                                                    ?>
                                                   <tr height="35" <?php  if($date2){?> bgcolor="#ff0000"<?php } else {?>onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#ffffff';"<?php }?>>
                                                        <td width="95"><?php echo $nomloc ?></td>
                                                        <td width="160"><?php echo $nomusu ?></td>
                                                        <td width="508"><?php echo $desprod ?></td>
                                                        <td width="95"><div align="CENTER"><?php echo $cantunid ?></div></td>
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
                                                    <tr bgcolor="#9cc4e1">
                                                     
                                                        <td width="538" align="CENTER" height="25" colspan="4"><strong>TOTAL</strong></td>
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
                                                    <tr bgcolor="#9cc4e1">
<!--                                                        <td width="95"></td>
                                                        <td width="95"></td>-->
                                                        <td width="538" align="CENTER" height="25" colspan="4" ><strong>TOTAL</strong></td>
                                                        <!--<td width="95"><div align="right"></div></td>-->
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
                                        <center><p class='Estilo2'>No se logro encontrar informacion con los datos ingresados</p></center>
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
                                    
                                    
//                                    if ($local == "all") {
//                                        $sql = "SELECT sucursal,detalle_venta.usecod,fraccion,detalle_venta.factor,detalle_venta.canpro,detalle_venta.pripro,incentivadodet.pripro,incentivadodet.codpro,canprocaj,canprounid,incentivadodet.factor,nrovent FROM incentivadodet inner join detalle_venta on incentivadodet.codpro = detalle_venta.codpro inner join venta on detalle_venta.invnum = venta.invnum where detalle_venta.incentivo = '$nro' and incentivadodet.invnum = '$nro' and venta.val_habil = '0' group by detalle_venta.invnum,detalle_venta.codpro,detalle_venta.usecod,sucursal order by sucursal,detalle_venta.usecod,nrovent";
//                                    } else {
//                                        $sql = "SELECT sucursal,detalle_venta.usecod,fraccion,detalle_venta.factor,detalle_venta.canpro,detalle_venta.pripro,incentivadodet.pripro,incentivadodet.codpro,canprocaj,canprounid,incentivadodet.factor,nrovent FROM incentivadodet inner join detalle_venta on incentivadodet.codpro = detalle_venta.codpro inner join venta on detalle_venta.invnum = venta.invnum where detalle_venta.incentivo = '$nro' and incentivadodet.invnum = '$nro' and sucursal = '$local' and venta.val_habil = '0' group by detalle_venta.invnum,detalle_venta.codpro,detalle_venta.usecod,sucursal order by sucursal,detalle_venta.usecod,nrovent";
//                                    }
                                    if ($local == "all") {
                                        $sql = "SELECT sucursal,detalle_venta.usecod,fraccion,detalle_venta.factor,detalle_venta.canpro,detalle_venta.pripro,incentivadodet.pripro,incentivadodet.codpro,canprocaj,canprounid,incentivadodet.factor,nrovent FROM incentivadodet inner join detalle_venta on incentivadodet.codpro = detalle_venta.codpro inner join venta on detalle_venta.invnum = venta.invnum where detalle_venta.invfec between '$dateini' and '$datefin' and  venta.val_habil = '0' and incentivadodet.invnum='$nro'  group by detalle_venta.invnum,detalle_venta.codpro,detalle_venta.usecod,sucursal order by sucursal,detalle_venta.usecod,nrovent";
                                    } else {
                                        $sql = "SELECT sucursal,detalle_venta.usecod,fraccion,detalle_venta.factor,detalle_venta.canpro,detalle_venta.pripro,incentivadodet.pripro,incentivadodet.codpro,canprocaj,canprounid,incentivadodet.factor,nrovent FROM incentivadodet inner join detalle_venta on incentivadodet.codpro = detalle_venta.codpro inner join venta on detalle_venta.invnum = venta.invnum where detalle_venta.invfec between '$dateini' and '$datefin' and sucursal = '$local' and venta.val_habil = '0' and incentivadodet.invnum='$nro'  group by detalle_venta.invnum,detalle_venta.codpro,detalle_venta.usecod,sucursal order by sucursal,detalle_venta.usecod,nrovent";
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
                                            $usecod     = $row['usecod'];
                                            $fraccion   = $row['fraccion'];
                                            $factor     = $row['factor'];
                                            $vcanpro    = $row['canpro'];
                                            $vpripro    = $row['pripro'];
                                            $ipripro    = $row['pripro'];
                                            $codpro     = $row['codpro'];
                                            $canprocaj  = $row['canprocaj'];
                                            $canprounid = $row['canprounid'];
                                            $factorinc  = $row['factor'];
                                            $nrovent    = $row['nrovent']; // venta lo tomo luego
          
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
                                                        <tr bgcolor="#9cc4e1">
                                                          
                                                            <td width="72" height="25" colspan="5"><div align="CENTER"><strong>TOTAL</strong></div></td>
                                                            <td width="87"><div align="right"><?php echo $numero_formato_frances = number_format($sumincentivo[$zz - 1], 2, '.', ' '); ?></div></td>
                                                        </tr>
                                                    <?php } //////////LINEA 1
                                                    ?>
                                                    <tr height="35"<?php  if($date2){?> bgcolor="#ff0000"<?php } else {?>onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#ffffff';"<?php }?>>
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
                                                    <tr bgcolor="#9cc4e1">
                                                        
                                                        <td width="72" height="25" colspan="5"><div align="CENTER"><strong>TOTAL</strong></div></td>
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
                                                    <tr bgcolor="#9cc4e1">
                                                        
                                                        <td width="72" height="25" colspan="5"><div align="CENTER"><strong>TOTAL</strong></div></td>
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
                                        <center><p class='Estilo2'>No se logro encontrar informacion con los datos ingresados</p></center>
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
                        }ELSE{   //////cierro el if (val)
                        ?>
        
        <table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td>
                <table width="926" border="0" align="center">
                  <tr>
                    <td width="5"><strong>N&ordm; DE INCEN </strong></td>
                    <td width="10"><div align="left"><strong>COD. PRO</strong></div></td>
                    <td width="150"><div align="left"><strong>PRODUCTO</strong></div></td>
                    <td width="40"><div align="center"><strong>FECHA INCIO</strong></div></td>
                    <td width="40"><div align="center"><strong>FECHA FIN</strong></div></td>
                    <td width="40"><div align="CENTER"><strong>CANT INCENTI</strong></div></td>
                    <td width="10"><div align="right"><strong>M. A PAGAR</strong></div></td>
                    </tr>
                </table>
              </td>
            </tr>
        </table>
        <table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>
                <?php
                $sql="SELECT invnum,codpro,canprocaj,canprounid,pripro FROM `incentivadodet` WHERE estado ='1' ORDER BY codpro ";
                $result = mysqli_query($conexion,$sql);
                if (mysqli_num_rows($result)){
                ?>
                <table width="926" border="0" align="center">
              <?php while ($row = mysqli_fetch_array($result)){
                        $invnum     = $row['invnum'];
                        $codpro     = $row['codpro'];
                        $canprocaj  = $row['canprocaj'];
                        $canprounid = $row['canprounid'];
                        $pripro     = $row['pripro'];

                        $sql1 = "SELECT dateini,datefin FROM `incentivado` WHERE invnum='$invnum' ";
                        $result1 = mysqli_query($conexion,$sql1);
                        if (mysqli_num_rows($result1)) {
                            while ($row1 = mysqli_fetch_array($result1)) {
                                $dateini = $row1['dateini'];
                                $datefin = $row1['datefin'];
                                $date1 = fecha($dateini);
                                $date2 = fecha($datefin);
                            }
                        }


                        $sql1 = "SELECT desprod,codpro FROM producto WHERE codpro='$codpro' ";
                        $result1 = mysqli_query($conexion,$sql1);
                        if (mysqli_num_rows($result1)) {
                            while ($row1 = mysqli_fetch_array($result1)) {
                                $producto = $row1['desprod'];
                                $codpro = $row1['codpro'];
                            }
                        }

                        $i++;
                  ?>
                  <tr  <?php if($date2< date('d/m/Y')){?>  title="FECHA DE INCENTIVO A CONCLUIDO..!"<?php }  if($date2< date('d/m/Y')){?> bgcolor="#ff0000"<?php } else {?>onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#ffffff';"<?php }?>>
                    <td width="35"align="center"><strong><?php echo $invnum?></strong></td>
                    <td width="12" align="center"><?php echo $codpro?></td>
                    <td width="160"><?php echo $producto?></td>
                    <td width="30" align="center"><?php if($date2< date('d/m/Y')){ echo "<p class='Estilo1'>$date1</p>";}else{echo "<p>$date1</p>";}?></td>
                    <td width="30" align="center"><?php if($date2< date('d/m/Y')){echo "<p class='Estilo1'>$date2</p>";}else{echo "<p>$date2</p>";}?></td>
                    <td width="40" align="center"><?php echo $canprocaj?></td>
                    <td width="50" align="right"><?php echo $pripro?></td>

              </tr>
                  <?php }
                  ?>
            </table>
                <?php }
                else
                {
                ?>
                <center><p class='Estilo2'>No se logro encontrar informacion con los datos ingresados</p></center>
                <?php }
                ?>
                </td>
          </tr>
        </table>
 <?php }?>
    </body>
</html>
