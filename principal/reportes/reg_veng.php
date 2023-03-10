<?php
//ini_set('max_execution_time', 900);
include('../session_user.php');
require_once('../../conexion.php');
require_once('../../titulo_sist.php');
require_once('../../convertfecha.php'); //CONEXION A BASE DE DATOS
?>
<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=SIST_EXPORT_DATA.xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

            <title><?php echo $desemp ?></title>
            <style type="text/css">
                .Estilo1 {
                    color: #FF0000;
                    font-weight: bold;
                }
            </style>
            <style>
                #customers {
                    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                    border-collapse: collapse;
                    width: 100%;

                }

                #customers td,
                #customers th {
                    border: 1px solid #ddd;
                    padding: 3px;

                }

                #customers tr:nth-child(even) {
                    background-color: #f0ecec;
                }

                #customers tr:hover {
                    background-color: #ddd;
                }

                #customers thead th {

                    text-align: center;
                    background-color: #50ADEA;
                    color: white;
                    font-size: 12px;
                    font-weight: 900;
                }
                #customers th {

                    text-align: center;
                    background-color: #50ADEA;
                    color: white;
                    font-size: 12px;
                    font-weight: 900;
                }
            </style>
    </head>
    <?php
    require_once("../../funciones/functions.php"); //DESHABILITA TECLAS
    require_once("../../funciones/funct_principal.php"); //IMPRIMIR-NUME
    $sql = "SELECT * FROM usuario where usecod = '$usuario'";
    $result = mysqli_query($conexion, $sql);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_array($result)) {
            $user = $row['nomusu'];
        }
    }
    $date = date('d/m/Y');
    $hour = date('G');
//$hour   = CalculaHora($hour);
    $min = date('i');
    if ($hour <= 12) {
        $hor = "am";
    } else {
        $hor = "pm";
    }
    $val = $_REQUEST['val'];
    $vals = $_REQUEST['vals'];
    $desc = $_REQUEST['desc'];
    $desc1 = $_REQUEST['desc1'];
    $date1 = $_REQUEST['date1'];
    $date2 = $_REQUEST['date2'];
    $doc = $_REQUEST['doc'];
    $ck = $_REQUEST['ck'];
    $ck1 = $_REQUEST['ck1'];
    $ckloc = $_REQUEST['ckloc'];
    $ckprod = $_REQUEST['ckprod'];
    $local = $_REQUEST['local'];
    $inicio = $_REQUEST['inicio'];
    $pagina = $_REQUEST['pagina'];
    $tot_pag = $_REQUEST['tot_pag'];

    $dat1 = $date1;
    $dat2 = $date2;
    $date1 = fecha1($dat1);
    $date2 = fecha1($dat2);
    $registros = $_REQUEST['registros'];
    $registros = 40;
    $pagina = $_REQUEST["pagina"];
    if (!$pagina) {
        $inicio = 0;
        $pagina = 1;
    } else {
        $inicio = ($pagina - 1) * $registros;
    }
    if ($local <> 'all') {
        $sql = "SELECT nomloc,nombre FROM xcompa where codloc = '$local'";
        $result = mysqli_query($conexion, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $nloc = $row['nomloc'];
            $nombre = $row['nombre'];
            if ($nombre == '') {
                $locals = $nloc;
            } else {
                $locals = $nombre;
            }
        }
    }
    ?>
    <body>

        <table width="100%" border="0" align="center">
            <tr>
                <td>
                    <table width="100%" border="0">
                        <tr>
                            <td width="260"><strong><?php echo $desemp ?> </strong></td>
                            <td width="380">
                                <div align="center">
                                    <strong>REPORTE DE REGISTRO DEL VENTA -
                                        <?php
                                        if ($local == 'all') {
                                            echo 'TODAS LAS SUCURSALES';
                                        } else {
                                            echo $locals;
                                        }
                                        ?>
                                    </strong>
                                </div>
                            </td>
                            <td width="260">
                                <div align="center"><strong>FECHA: <?php echo date('d/m/Y'); ?> - HORA : <?php echo $hour; ?>:<?php echo $min; ?> <?php echo $hor ?></strong></div>
                            </td>
                        </tr>

                    </table>
                    <table width="100%" border="0">
                        <tr>
                            <td width="134"><strong>PAGINA <?php echo $pagina; ?> de <?php echo $tot_pag ?></strong></td>
                            <td width="633">
                                <div align="center"><b><?php if ($val == 1) { ?>NRO DE VENTA ENTRE EL <?php echo $desc; ?> Y EL <?php
                                            echo $desc1;
                                        }
                                        if ($vals == 2) {
                                            ?> FECHAS ENTRE EL <?php echo $dat1; ?> Y EL <?php
                                            echo $dat2;
                                        }
                                        ?></b></div>
                            </td>
                            <td width="133">
                                <div align="center">USUARIO:<span class="text_combo_select"><?php echo $user ?></span></div>
                            </td>
                        </tr>
                    </table>
                    <div align="center"><img src="../../images/line2.png" width="100%" height="4" /></div>
                </td>
            </tr>
        </table>
        <?php
        if ($ckprod == 1) {
            ?>

            <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td>

                        <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <?php
                                    $zz = 0;
                                    if ($val == 1) { ///	PRIMER BOTON
                                        if ($local == 'all') { ////TODOS LOS LOCALES
//                                    $sql = "SELECT detalle_venta.usecod,costpr,sucursal,nrovent,detalle_venta.invfec,detalle_venta.cuscod,codpro,codmar,prisal,factor,canpro,fraccion,costpr,nrofactura FROM venta inner join detalle_venta on venta.invnum = detalle_venta.invnum where nrovent between '$desc' and '$desc1' and estado = '0'  and invtot <> '0' order by nrovent group by = nrovent";
                                            $sql = "(SELECT DV.usecod,DV.costpr,V.sucursal,V.nrovent,V.invfec,DV.cuscod,DV.codpro,DV.codmar,DV.prisal,DV.factor,DV.canpro,DV.fraccion,DV.costpr,V.nrofactura FROM venta AS V inner join detalle_venta AS DV on V.invnum = DV.invnum where V.invnum between '$desc' and '$desc1' and V.estado = '0'  and V.invtot <> '0'   order by V.nrovent)UNION ALL (SELECT DN.usecod,DN.costpr,N.sucursal,N.nrovent,N.invfec,DN.cuscod,DN.codpro,DN.codmar,DN.prisal,DN.factor,DN.canpro,DN.fraccion,DN.costpr,N.nrofactura FROM nota AS N inner join detalle_nota AS DN on N.invnum = DN.invnum where N.invnum between '1' and '10' and N.estado = '0'  and N.invtot <> '0'   order by N.nrovent )";
                                        } else { ///UN SOLO LOCAL
                                            $sql = "SELECT detalle_venta.usecod,costpr,sucursal,nrovent,detalle_venta.invfec,detalle_venta.cuscod,codpro,codmar,prisal,factor,canpro,fraccion,costpr,nrofactura FROM venta inner join detalle_venta on venta.invnum = detalle_venta.invnum where nrovent between '$desc' and '$desc1' and estado = '0'  and invtot <> '0' and sucursal = '$local' order by nrovent";
                                        }
                                    } else { ///	SEGUNDO BOTON
                                        if ($local == 'all') { ////TODOS LOS LOCALES
                                            //echo $date1; echo "<br>";
                                            //echo $date2;
                                            $sql = "(SELECT detalle_venta.usecod,costpr,sucursal,nrovent,detalle_venta.invfec,detalle_venta.cuscod,codpro,codmar,prisal,factor,canpro,fraccion,costpr,nrofactura FROM venta inner join detalle_venta  on venta.invnum = detalle_venta.invnum where detalle_venta.invfec between '$date1' and '$date2' and invtot <> '0' and estado = '0' order by nrovent)UNION ALL (SELECT DN.usecod,costpr,sucursal,nrovent,DN.invfec,DN.cuscod,codpro,codmar,prisal,factor,canpro,fraccion,costpr,nrofactura FROM nota as N inner join detalle_nota AS DN  on N.invnum = DN.invnum where DN.invfec between '$date1' and '$date2' and invtot <> '0' and estado = '0' order by nrovent ) ";
                                        } else { ///UN SOLO LOCAL
                                            $sql = "(SELECT detalle_venta.usecod,costpr,sucursal,nrovent,detalle_venta.invfec,detalle_venta.cuscod,codpro,codmar,prisal,factor,canpro,fraccion,costpr,nrofactura FROM venta inner join detalle_venta on venta.invnum = detalle_venta.invnum where detalle_venta.invfec between  '$date1' and '$date2' and sucursal = '$local' and invtot <> '0'  and estado = '0' order by nrovent)UNION ALL(SELECT DN.usecod,costpr,sucursal,nrovent,DN.invfec,DN.cuscod,codpro,codmar,prisal,factor,canpro,fraccion,costpr,nrofactura FROM nota AS N inner join detalle_nota AS DN on N.invnum = DN.invnum where DN.invfec between '$date1' and '$date2' and sucursal = '$local' and invtot <> '0'  and estado = '0' order by nrovent)";
                                        }
                                    }
                                    $result = mysqli_query($conexion, $sql);
                                    if (mysqli_num_rows($result)) {
                                        ?>


                                        <table id="customers" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <div align="center"><strong>TIENDA </strong></div>
                                                    </th>
                                                    <th>
                                                        <div align="center"><strong>RESPONSABLE </strong></div>
                                                    </th>
                                                    <th>
                                                        <div align="center"><strong>NUMERO</strong></div>
                                                    </th>
                                                    <th>
                                                        <div align="center"><strong>NUM FISICO</strong></div>
                                                    </th>
                                                    <th>
                                                        <div align="center"><strong>FECHA</strong></div>
                                                    </th>
                                                    <th>
                                                        <div align="center"><strong>CLIENTE</strong></div>
                                                    </th>
                                                    <th>
                                                        <div align="center"><strong>PRODUCTO</strong></div>
                                                    </th>
                                                    <th>
                                                        <div align="center"><strong>MARCA</strong></div>
                                                    </th>
                                                    <th>
                                                        <div align="center"><strong>PRECIO VTA.</strong></div>
                                                    </th>
                                                    <th>
                                                        <div align="center"><strong>PRECIO LTA.</strong></div>
                                                    </th>
                                                    <th>
                                                        <div align="center"><strong>DIFERENCIA</strong></div>
                                                    </th>
                                                    <th>
                                                        <div align="center"><strong>PRECIO LTA.</strong></div>
                                                    </th>
                                                    <th>
                                                        <div align="center"><strong>DIFERENCIA</strong></div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <?php
                                            while ($row = mysqli_fetch_array($result)) {
                                                $usecod = $row['usecod'];
                                                $sucursal = $row['sucursal'];
                                                $nrovent = $row['nrovent'];
                                                $nrofactura = $row['nrofactura'];
                                                $invfecv = fecha($row['invfec']);
                                                $cuscod = $row['cuscod'];
                                                $codpro = $row['codpro'];
                                                $codmar = $row['codmar'];
                                                $prisal = $row['prisal'];
                                                $factor = $row['factor']; ////
                                                $canpro = $row['canpro']; ////
                                                $cospro = $row['costpr']; ////
                                                $fraccion = $row['fraccion']; /////
                                                $costpr = $row['costpr']; //costo del producto x unidad

                                                if ($fraccion == "T") {
                                                    $cospro = $costpr;
                                                } else {
                                                    $cospro = $costpr;
                                                }

                                                $plista = 0;
                                                $dif = 0;
                                                //USUARIO
                                                $sql1 = "SELECT nomusu FROM usuario where usecod = '$usecod'";
                                                $result1 = mysqli_query($conexion, $sql1);
                                                if (mysqli_num_rows($result1)) {
                                                    while ($row1 = mysqli_fetch_array($result1)) {
                                                        $nomusu = $row1['nomusu'];
                                                    }
                                                }
                                                //CLIENTE
                                                $sql1 = "SELECT descli FROM cliente where codcli = '$cuscod'";
                                                $result1 = mysqli_query($conexion, $sql1);
                                                if (mysqli_num_rows($result1)) {
                                                    while ($row1 = mysqli_fetch_array($result1)) {
                                                        $descli = $row1['descli'];
                                                    }
                                                }
                                                $sql1 = "SELECT desprod,destab,pdistribuidor,abrev FROM producto inner join titultabladet on codmar = codtab where codpro = '$codpro' and eliminado='0'";
                                                $result1 = mysqli_query($conexion, $sql1);
                                                if (mysqli_num_rows($result1)) {
                                                    while ($row1 = mysqli_fetch_array($result1)) {
                                                        $desprod = $row1['desprod'];
                                                        $destab = $row1['destab'];
                                                        $abrev = $row1['abrev'];
                                                        if ($abrev <> '') {
                                                            $destab = $abrev;
                                                        }
                                                        $pdistribuidor = $row1['pdistribuidor'];
                                                    }
                                                }
                                                $sql3 = "SELECT nomloc,nombre FROM xcompa where codloc = '$sucursal'";
                                                $result3 = mysqli_query($conexion, $sql3);
                                                if (mysqli_num_rows($result3)) {
                                                    while ($row3 = mysqli_fetch_array($result3)) {
                                                        $nloc = $row3["nomloc"];
                                                        $nombre = $row3["nombre"];
                                                    }
                                                }
                                                $plista = $prisal - $costpr;
                                                $dif = $prisal - $costpr;
                                                if ($nombre == "") {
                                                    $nombre = $nloc;
                                                }
                                                if ($prisal < $costpr) {
                                                    $color = "#ffffff";
                                                } else {
                                                    if ($prisal < $costpr) {
                                                        $color = "#ffffff";
                                                    } else {
                                                        $color = "";
                                                    }
                                                }
                                                ?>
                                                <tbody>
                                                    <tr <?php if ($prisal < $costpr) { ?>bgcolor="#FF0000" <?php
                                                    } else {
                                                        if ($prisal < $costpr) {
                                                            ?> bgcolor="#006600" <?php
                                                                                             }
                                                                                         }
                                                                                         ?> >
                                                        <td width="57">
                                                            <div align="center">
                                                                <font color="<?php echo $color ?>"><?php echo $nombre; ?></font>
                                                            </div>
                                                        </td>
                                                        <td width="174">
                                                            <div align="center">
                                                                <font color="<?php echo $color ?>"><?php echo $nomusu; ?></font>
                                                            </div>
                                                        </td>
                                                        <td width="24">
                                                            <div align="center">
                                                                <font color="<?php echo $color ?>"><?php echo $nrovent ?></font>
                                                            </div>
                                                        </td>
                                                        <td width="24">
                                                            <div align="center">
                                                                <font color="<?php echo $color ?>"><?php echo $nrofactura ?></font>
                                                            </div>
                                                        </td>
                                                        <td width="50">
                                                            <div align="center">
                                                                <font color="<?php echo $color ?>"><?php echo $invfecv; ?></font>
                                                            </div>
                                                        </td>
                                                        <td width="54">
                                                            <div align="center">
                                                                <font color="<?php echo $color ?>"><?php echo $descli; ?></font>
                                                            </div>
                                                        </td>
                                                        <td width="308">
                                                            <div align="center">
                                                                <font color="<?php echo $color ?>"><?php echo $desprod ?></font>
                                                            </div>
                                                        </td>
                                                        <td width="61">
                                                            <div align="center">
                                                                <font color="<?php echo $color ?>"><?php echo $destab ?></font>
                                                            </div>
                                                        </td>
                                                        <td width="60">
                                                            <div align="center">
                                                                <font color="<?php echo $color ?>"><?php echo $numero_formato_frances = number_format($prisal, 2, '.', ' '); ?></font>
                                                            </div>
                                                        </td>
                                                        <td width="60">
                                                            <div align="center">
                                                                <font color="<?php echo $color ?>"><?php echo $numero_formato_frances = number_format($cospro, 2, '.', ' '); ?></font>
                                                            </div>
                                                        </td>
                                                        <td width="60">
                                                            <div align="center">
                                                                <font color="<?php echo $color ?>"><?php echo $numero_formato_frances = number_format($plista, 2, '.', ' '); ?></font>
                                                            </div>
                                                        </td>
                                                        <td width="60">
                                                            <div align="center">
                                                                <font color="<?php echo $color ?>"><?php echo $numero_formato_frances = number_format($pdistribuidor, 2, '.', ' '); ?></font>
                                                            </div>
                                                        </td>
                                                        <td width="60">
                                                            <div align="center">
                                                                <font color="<?php echo $color ?>"><?php echo $numero_formato_frances = number_format($dif, 2, '.', ' '); ?></font>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tbody>

                                                        <?php
                                                    }
                                                    ?>
                                                    </table>
                                                    <?php
                                                }
                                                ?>
                                                </td>
                                                </tr>
                                                </table>
                                                </td>
                                                </tr>
                                                </table>


                                                <!--nooo-->
                                                <?php
                                            } else {
                                                if (($ck == '') && ($ck1 == '') && ($doc2 == 0)) {
                                                    if (($val == 1) || ($vals == 2)) {
                                                        ?>


                                                        <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td>


                                                                    <?php
                                                                    if ($val == 1) {

//                            todos los locales
                                                                        if ($local == 'all') {
                                                                            if ($doc == 1) {
                                                                                $sql = "SELECT invnum,invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invnum between '$desc' and '$desc1'    and nrofactura LIKE'B%' and val_habil = 0  GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
                                    ";
                                                                            }
                                                                            if ($doc == 2) {
                                                                                $sql = "SELECT invnum,invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invnum between '$desc' and '$desc1'    and nrofactura LIKE'F%' and val_habil = 0  GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
                                    ";
                                                                            }
                                                                            if ($doc == 3) {
                                                                                $sql = "SELECT invnum,invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invnum between '$desc' and '$desc1'   and nrofactura LIKE'T%' and val_habil = 0  GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
                                    ";
                                                                            }
                                                                            if ($doc == 4) {
                                                                                $sql = "SELECT invnum,invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM nota WHERE  invnum between '$desc' and '$desc1'    and val_habil = 0  GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
                                    ";
                                                                            }
                                                                        }
//                            local por local
                                                                        else {
                                                                            if ($doc == 1) {
                                                                                $sql = "SELECT invnum,invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invnum between '$desc' and '$desc1'  and sucursal = '$local'  and nrofactura LIKE'B%'  and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
                                    ";
                                                                            }
                                                                            if ($doc == 2) {
                                                                                $sql = "SELECT invnum,invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invnum between '$desc' and '$desc1'  and sucursal = '$local'    and nrofactura LIKE'F%'  and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
                                    ";
                                                                            }
                                                                            if ($doc == 3) {
                                                                                $sql = "SELECT invnum,invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invnum between '$desc' and '$desc1'  and sucursal = '$local' and nrofactura LIKE'T%'  and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
                                    ";
                                                                            }

                                                                            if ($doc == 4) {
                                                                                $sql = "SELECT invnum,invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM nota WHERE  invnum between '$desc' and '$desc1'  and sucursal = '$local'   and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
                                    ";
                                                                            }
                                                                        }
                                                                    }
//fechaaaaaaaaaaaa

                                                                    if ($vals == 2) {
                                                                        if ($local == 'all') {
                                                                            if ($doc == 1) {
                                                                                $sql = "SELECT invnum,invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invfec between '$date1' and '$date2'    and nrofactura LIKE'B%' and val_habil = 0  GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
                                    ";
                                                                            }
                                                                            if ($doc == 2) {
                                                                                $sql = "SELECT invnum,invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invfec between '$date1' and '$date2'    and nrofactura LIKE'F%' and val_habil = 0  GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
                                    ";
                                                                            }
                                                                            if ($doc == 3) {
                                                                                $sql = "SELECT invnum,invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invfec between '$date1' and '$date2'   and nrofactura LIKE'T%' and val_habil = 0  GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
                                    ";
                                                                            }
                                                                            if ($doc == 4) {
                                                                                $sql = "SELECT invnum,invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM nota WHERE  invfec between '$date1' and '$date2'    and val_habil = 0  GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
                                    ";
                                                                            }
                                                                        } else {
                                                                            if ($doc == 1) {
                                                                                $sql = "SELECT invnum,invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),SUM(invtot),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invfec between '$date1' and '$date2'  and sucursal = '$local'  and nrofactura LIKE'B%'  and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
                                    ";
                                                                            }
                                                                            if ($doc == 2) {
                                                                                $sql = "SELECT invnum,invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invfec between '$date1' and '$date2'  and sucursal = '$local'    and nrofactura LIKE'F%'  and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
                                    ";
                                                                            }
                                                                            if ($doc == 3) {
                                                                                $sql = "SELECT invnum,invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invfec between '$date1' and '$date2'  and sucursal = '$local' and nrofactura LIKE'T%'  and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
                                    ";
                                                                            }
                                                                            if ($doc == 4) {
                                                                                $sql = "SELECT invnum,invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM nota WHERE  invfec between '$date1' and '$date2'  and sucursal = '$local'   and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
                                            CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
                                    ";
                                                                            }
                                                                        }
                                                                    }


                                                                    $zz = 0;
                                                                    $i = 0;
                                                                    $result = mysqli_query($conexion, $sql);
                                                                    if (mysqli_num_rows($result)) {
                                                                        ?>
                                                                        <table width="100%" border="0" align="center" id="customers">
                                                                            <TR width="100%">
                                                                                <center>
                                                                                    <h2>RESUMEN DE DIA <?php echo $tipodocumento; ?></h2>
                                                                                </center>


                                                                            </TR>
                                                                            <thead>
                                                                                <tr>
                                                                                    <?php if ($ckloc == 1) { ?>
                                                                                        <th width="120"><strong>LOCAL</strong></th>
                                                                                    <?php } ?>
                                                                                    <th align="center" width="240"><strong>FECHA</strong></th>
                                                                                    <th align="center" width="180"><strong> INICIAL</strong></th>
                                                                                    <th align="center" width="180"><strong>FINAL</strong></th>
                                                                                    <th align="center" width="160"><strong>AFECTO</strong></th>
                                                                                    <th align="center" width="160"><strong>INAFECTO</strong></th>
                                                                                    <th align="center" width="150"><strong>IGV</strong></th>
                                                                                    <th align="center" width="150"><strong>TOTAL</strong></th>

                                                                                </tr>
                                                                            </thead>
                                                                            <?php
                                                                            while ($row = mysqli_fetch_array($result)) {
                                                                                $invnum = $row['invnum'];
                                                                                $usecod = $row['usecod'];
                                                                                $nrovent = $row['nrovent'];
                                                                                $val_habil = $row["val_habil"];
                                                                                $sucursal = $row["sucursal"];
                                                                                $nrofactura = $row["nrofactura"];
                                                                                $descli = $row['descli'];
                                                                                $ruccli = $row['ruccli'];
                                                                                $dnicli = $row['dnicli'];
                                                                                $gravado = $row["gravado"];
                                                                                $invtot = $row["SUM(invtot)"];
                                                                                $invfecv = $row['invfec'];
                                                                                $nrofactura1 = $row["min"];
                                                                                $nrofactura2 = $row["max"];
                                                                                $igv = $row["SUM(igv)"];
                                                                                $gravado = $row["SUM(gravado)"];
                                                                                $inafecto12 = $row["SUM(inafecto)"];
                                                                                $TOT = $row["SUM(igv+gravado)"];

                           
 $SumGrabado = $invtot - ($igv + $inafecto12);
 
                                                          $igv1 += $igv;
                        $gravado1 += $SumGrabado;
                        $inafecto1 += $inafecto12;
                        $TOT1 += $invtot;
                                                                                $i++;
                                                                                $ssss[$i] = $sucursal;
                                                                                if ($sucursal <> $suc[$zz]) {
                                                                                    $zz++;
                                                                                    $suc[$zz] = $sucursal;
                                                                                }
                                                                                $sql3 = "SELECT nomloc,nombre FROM xcompa where codloc = '$sucursal'";
                                                                                $result3 = mysqli_query($conexion, $sql3);
                                                                                while ($row3 = mysqli_fetch_array($result3)) {
                                                                                    $nloc = $row3["nomloc"];
                                                                                    $nombre = $row3["nombre"];
                                                                                    if ($nombre == '') {
                                                                                        $sucur = $nloc;
                                                                                    } else {
                                                                                        $sucur = $nombre;
                                                                                    }
                                                                                }
                                                                                $e_tot = 0;
                                                                                $t_tot = 0;
                                                                                $c_tot = 0;
                                                                                $inafecto = 0;
                                                                                $deshabil_tot = 0;
                                                                                $deshabil_gravado = 0;
                                                                                $habil_inafecto11 = 0;
                                                                                $habil_tot = 0;
                                                                                $count = 0;
                                                                                $tot = 0;
                                                                                $Rentabilidad = 0;
                                                                                $sumpripro = 0;
                                                                                $sumpcosto = 0;
                                                                                $porcentaje = 0;

                                                                                $sql1 = "SELECT nomusu FROM usuario where usecod = '$usecod'";
                                                                                $result1 = mysqli_query($conexion, $sql1);
                                                                                if (mysqli_num_rows($result1)) {
                                                                                    while ($row1 = mysqli_fetch_array($result1)) {
                                                                                        $user = $row1['nomusu'];
                                                                                    }
                                                                                }


                                                                                //  $sql2 = "SELECT nrofactura FROM venta WHERE sucursal='$local' and nrofactura LIKE 'F%' ORDER BY nrofactura LIMIT 1";
                                    $sql2 = "SELECT `seriebol`,`seriefac`,`serietic` FROM `xcompa` WHERE `codloc`='$local'";
                                    $result1 = mysqli_query($conexion, $sql2);
                                    if (mysqli_num_rows($result1)) {
                                        while ($row1 = mysqli_fetch_array($result1)) {
                                            $F2 = 'F'.$row1['seriebol'].'-';
                                        }
                                    }
                                    //$F2 = substr($F1, 0, -1);

                                       $sql2 = "SELECT `seriebol`,`seriefac`,`serietic` FROM `xcompa` WHERE `codloc`='$local'"; 
                                    $result1 = mysqli_query($conexion, $sql2);
                                    if (mysqli_num_rows($result1)) {
                                        while ($row1 = mysqli_fetch_array($result1)) {
                                            $B2 = 'B'.$row1['seriefac'].'-';
                                        }
                                    }
                                //    $B2 = substr($B1, 0, -1);

                                     $sql2 = "SELECT `seriebol`,`seriefac`,`serietic` FROM `xcompa` WHERE `codloc`='$local'"; 
                                    $result1 = mysqli_query($conexion, $sql2);
                                    if (mysqli_num_rows($result1)) {
                                        while ($row1 = mysqli_fetch_array($result1)) {
                                            $T2 = 'T'.$row1['serietic'].'-';
                                        }
                                    }
                                   // $T2 = substr($T1, 0, -1);



                                    $sql2 = "SELECT `serienotboleta` FROM `xcompa` WHERE `codloc`='$local'"; 
                                    $result1 = mysqli_query($conexion, $sql2);
                                    if (mysqli_num_rows($result1)) {
                                        while ($row1 = mysqli_fetch_array($result1)) {
                                            $C2 = 'N'.$row1['serienotboleta'].'-';
                                        }
                                    }
                                   // $C2 = substr($C1, 0, -1);


                                                                                if ($val_habil == 0) {
                                                                                    if ($forpag == "E") {
                                                                                        $e_tot = $total;
                                                                                        $e_tot1[$zz] = $e_tot1[$zz] + $total;
                                                                                    }
                                                                                    if ($forpag == "T") {
                                                                                        $t_tot = $total;
                                                                                        $t_tot1[$zz] = $t_tot1[$zz] + $total;
                                                                                    }
                                                                                    if ($forpag == "C") {
                                                                                        $c_tot = $total;
                                                                                        $c_tot1[$zz] = $c_tot1[$zz] + $total;
                                                                                    }

                                                                                    if ($doc == 4) {
                                                                                        $sql2 = "SELECT costpr,pripro,canpro,fraccion,factor,invfec,prisal,costpr FROM detalle_nota where invnum = '$invnum'";
                                                                                    } else {
                                                                                        $sql2 = "SELECT costpr,pripro,canpro,fraccion,factor,invfec,prisal,costpr FROM detalle_venta where invnum = '$invnum'";
                                                                                    }
                                                                                    $result2 = mysqli_query($conexion, $sql2);
                                                                                    if (mysqli_num_rows($result2)) {
                                                                                        while ($row2 = mysqli_fetch_array($result2)) {
                                                                                            $pcostouni = $row2["cospro"]; //costo del producto x caja
                                                                                            $pripro = $row2['pripro']; //subtotal de venta precio unitario x cantidad vendida
                                                                                            $canpro = $row2['canpro'];
                                                                                            $fraccion = $row2['fraccion'];
                                                                                            $factor = $row2['factor'];
                                                                                            $prisal = $row2['prisal']; //precio de venta x unidad
                                                                                            $costpr = $row2['costpr']; //costo del producto x unidad
                                                                                            // $invfec       = $row2['invfec'];
                                                                                            //FRACCIONADO
                                                                                            if ($fraccion == "T") {
                                                                                                $RentPorcent = (($prisal - $costpr) * $canpro);
                                                                                                $Rentabilidad = $Rentabilidad + $RentPorcent;
                                                                                                //$precio_costo = $pcostouni;
                                                                                            } else {
                                                                                                //NO FRACCIONADO
                                                                                                //$precio_costo = $pcostouni/$factor;
                                                                                                //$canpros   = $canpro * $factor;
                                                                                                //$tot	   = $tot + $canpros;
                                                                                                $RentPorcent = (($prisal - $pcostouni) * $canpro);
                                                                                                $Rentabilidad = $Rentabilidad + $RentPorcent;
                                                                                            }


                                                                                            /* $pcostouni    = $row2["cospro"];
                                                                                              $pripro       = $row2['pripro'];
                                                                                              $canpro    	  = $row2['canpro'];
                                                                                              $fraccion     = $row2['fraccion'];
                                                                                              $factor       = $row2['factor'];
                                                                                              $invfec       = $row2['invfec'];
                                                                                              $tot   	      = 0;
                                                                                              $precio_costo = $costpr;
                                                                                              if ($fraccion == "T"){
                                                                                              $tot	   = $tot + $canpro;}
                                                                                              else{
                                                                                              //$precio_costo = $pcostouni/$factor;
                                                                                              $canpros   = $canpro * $factor;
                                                                                              $tot	   = $tot + $canpros;}
                                                                                              $sumpripro = $sumpripro + $pripro;
                                                                                              $pcosto    = $tot * $precio_costo;
                                                                                              $sumpcosto = $sumpcosto + $pcosto; */
                                                                                        }
                                                                                    }
                                                                                }
                                                                                if ($val_habil == 1) {
                                                                                    $deshabil++;
                                                                                    $deshabil_tot = $deshabil_tot + $total;
                                                                                    $deshabil_tot1[$zz] = $deshabil_tot1[$zz] + $total;
                                                                                } else {
                                                                                    $habil_tot = $habil_tot + $total;
                                                                                    $habil_tot1[$zz] = $habil_tot1[$zz] + $total;
                                                                                }
                                                                                $count++;
                                                                                if ($total == 1) {
                                                                                    $deshabil++;
                                                                                    $deshabil_total = $deshabil_total + $total;
                                                                                    $deshabil_total1[$zz] = $deshabil_total1[$zz] + $total;
                                                                                } else {
                                                                                    $habil_total = $habil_total + $total;
                                                                                    $habil_total1[$zz] = $habil_total1[$zz] + $total;
                                                                                }
                                                                                $count++;
                                                                                if ($gravado == 1) {
                                                                                    $deshabil++;
                                                                                    $deshabil_gravado = $deshabil_gravado + $gravado;
                                                                                    $deshabil_gravado1[$zz] = $deshabil_gravado1[$zz] + $gravado;
                                                                                } else {
                                                                                    $habil_gravado = $habil_gravado + $gravado;
                                                                                    $habil_gravado1[$zz] = $habil_gravado1[$zz] + $gravado;
                                                                                }
                                                                                $count++;

                                                                                if ($igv == 1) {
                                                                                    $deshabil++;
                                                                                    $deshabil_igv = $deshabil_igv + $igv;
                                                                                    $deshabil_igv1[$zz] = $deshabil_igv1[$zz] + $igv;
                                                                                } else {
                                                                                    $habil_igv = $habil_igv + $igv;
                                                                                    $habil_igv1[$zz] = $habil_igv1[$zz] + $igv;
                                                                                }
                                                                                $count++;

                                                                                if ($inafecto == 1) {
                                                                                    $deshabil++;
                                                                                    $deshabil_inafecto = $deshabil_inafecto + $inafecto;
                                                                                    $deshabil_inafecto1[$zz] = $deshabil_inafecto1[$zz] + $inafecto;
                                                                                } else {
                                                                                    $habil_inafecto = $habil_inafecto + $inafecto;
                                                                                    $habil_inafecto12[$zz] = $habil_inafecto12[$zz] + $inafecto;
                                                                                }
                                                                                $count++;

                                                                                $rentabilidad = $Rentabilidad;
                                                                                $rentabilidad1[$zz] = $rentabilidad1[$zz] + $Rentabilidad;



                                                                                $inafectototal = $invtot - $gravado - $igv;
                                                                                /* if ($sumpcosto > 0){
                                                                                  $rentabilidad   = $sumpripro - $sumpcosto;
                                                                                  $rentabilidad1[$zz] = $rentabilidad1[$zz] + $rentabilidad;} */
                                                                                if (($suc[$zz - 1] <> "") and ( $suc[$zz - 1] <> $suc[$zz])) {
                                                                                    if ($sucursal <> $ssss[$i - 1]) {
                                                                                        ?>

                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <tbody>
                                                                                    <tr onmouseover="this.style.backgroundColor = '#FFFF99';this.style.cursor = 'hand';" onmouseout="this.style.backgroundColor = '#ffffff';">
                                                                                        <?php if ($ckloc == 1) { ?><td width="30"><?php echo $sucur ?></td><?php } ?>
                                                                                        <td width="300">
                                                                                            <div align="center"><?php echo fecha($invfecv) ?></div>
                                                                                        </td>
                                                                                        <?php if ($doc == 1) { ?> <td width="175">
                                                                                                <div align="CENTER"><?php echo $B2 . $nrofactura1 ?></div>
                                                                                            </td><?php } ?>
                                                                                        <?php if ($doc == 2) { ?> <td width="175">
                                                                                                <div align="CENTER"><?php echo $F2 . $nrofactura1 ?></div>
                                                                                            </td><?php } ?>
                                                                                        <?php if ($doc == 3) { ?> <td width="175">
                                                                                                <div align="CENTER"><?php echo $T2 . $nrofactura1 ?></div>
                                                                                            </td><?php } ?>
                                                                                        <?php if ($doc == 4) { ?> <td width="175">
                                                                                                <div align="CENTER"><?php echo $C2 . $nrofactura1 ?></div>
                                                                                            </td><?php } ?>

                                                                                        <?php if ($doc == 1) { ?> <td width="175">
                                                                                                <div align="CENTER"><?php echo $B2 . $nrofactura2 ?></div>
                                                                                            </td><?php } ?>
                                                                                        <?php if ($doc == 2) { ?> <td width="175">
                                                                                                <div align="CENTER"><?php echo $F2 . $nrofactura2 ?></div>
                                                                                            </td><?php } ?>
                                                                                        <?php if ($doc == 3) { ?> <td width="175">
                                                                                                <div align="CENTER"><?php echo $T2 . $nrofactura2 ?></div>
                                                                                            </td><?php } ?>
                                                                                        <?php if ($doc == 4) { ?> <td width="175">
                                                                                                <div align="CENTER"><?php echo $C2 . $nrofactura2 ?></div>
                                                                                            </td><?php } ?>
                                                                                        <td width="155">
                                                                                            <div align="CENTER"><?php echo $SumGrabado ?></div>
                                                                                        </td>
                                                                                        <td width="155">
                                                                                            <div align="CENTER"><?php echo $inafecto12 ?></div>
                                                                                        </td>
                                                                                        <td width="145">
                                                                                            <div align="CENTER"><?php echo $igv ?></div>
                                                                                        </td>
                                                                                        <td width="145">
                                                                                            <div align="CENTER"><?php echo $invtot ?></div>
                                                                                        </td>

                                                                                    </tr>
                                                                                </tbody>
                                                                            <?php } ?>
                                                                            <?php if ($zz == 1) {
                                                                                ?>
                                                                                <tfoot>
                                                                                    <tr bgcolor="#CCCCCC">
                                                                                        <th <?php if ($ckloc == 1) { ?>COLSPAN="4" <?php } else { ?> COLSPAN="3" <?php } ?>width="450">
                                                                                            <div align="center"><strong>TOTAL</strong></div>
                                                                                        </th>
                                                                                        <th width="90">
                                                                                            <div align="center"><?php echo $numero_formato_frances = number_format($gravado1, 2, '.', ' '); ?></div>
                                                                                        </th>
                                                                                        <th width="90">
                                                                                            <div align="center"><?php echo $numero_formato_frances = number_format($inafecto1, 2, '.', ' '); ?></div>
                                                                                        </th>
                                                                                        <th width="90">
                                                                                            <div align="center"><?php echo $numero_formato_frances = number_format($igv1, 2, '.', ' '); ?></div>
                                                                                        </th>
                                                                                        <th width="90">
                                                                                            <div align="center"><?php echo $numero_formato_frances = number_format($TOT1, 2, '.', ' '); ?></div>
                                                                                        </th>
                                                                                    </tr>
                                                                                </tfoot>
                                                                            <?php } else { ?>
                                                                            </table>
                                                                            <?php //if ($zz == 1) {
                                                                            ?>
                                                                            <!--  <table width="100%" border="0" align="center">
                                                                                    <tr bgcolor="#CCCCCC">
                                                                                        <td width="450">
                                                                                            <div align="center"><strong>TOTAL</strong></div>
                                                                                        </td>
                                                                                        <td width="90">
                                                                                            <div align="center"><?php echo $numero_formato_frances = number_format($gravado1, 2, '.', ' '); ?></div>
                                                                                        </td>
                                                                                        <td width="90">
                                                                                            <div align="center"><?php echo $numero_formato_frances = number_format($inafecto1, 2, '.', ' '); ?></div>
                                                                                        </td>
                                                                                        <td width="90">
                                                                                            <div align="center"><?php echo $numero_formato_frances = number_format($igv1, 2, '.', ' '); ?></div>
                                                                                        </td>
                                                                                        <td width="90">
                                                                                            <div align="center"><?php echo $numero_formato_frances = number_format($TOT1, 2, '.', ' '); ?></div>
                                                                                        </td>
                                                                                    </tr>
                                                        
                                                                            </tr>
                                                                            </table>-->

                                                                            <table width="100%" border="0" align="center">
                                                                                <tr bgcolor="#CCCCCC">

                                                                                    <td width="450">
                                                                                        <div align="center"><strong>TOTAL</strong></div>
                                                                                    </td>
                                                                                    <td width="90">
                                                                                        <div align="center"><?php echo $numero_formato_frances = number_format($gravado1, 2, '.', ' '); ?></div>
                                                                                    </td>
                                                                                    <td width="90">
                                                                                        <div align="center"><?php echo $numero_formato_frances = number_format($habil_inafecto12[$zz], 2, '.', ' '); ?></div>
                                                                                    </td>

                                                                                    <td width="90">
                                                                                        <div align="center"><?php echo $numero_formato_frances = number_format($igv1, 2, '.', ' '); ?></div>
                                                                                    </td>
                                                                                    <td width="90">
                                                                                        <div align="center"><?php echo $numero_formato_frances = number_format($TOT1, 2, '.', ' '); ?></div>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                            <?php
                                                                        }
                                                                    } else {
                                                                        ?>
                                                                        <div class="siniformacion">
                                                                            <center>
                                                                                No se logro encontrar informacion con los datos ingresados
                                                                            </center>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>




                                                        </table>
                                                        <?php
                                                    }
                                                }


                                                if (($ck == '') && ($ck1 == '') && ($doc2 == 2)) {
                                                    if (($val == 1) || ($vals == 2)) {
                                                        ?>



                                                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                            <tr height="40">
                                                                <td width="95%">
                                                                    <center>
                                                                        <h2>RESUMEN POR <?php echo $va ?></h2>
                                                                    </center>
                                                                </td>

                                                            </tr>

                                                            <tr>
                                                                <td colspan="2">


                                                                    <?php
                                                                    if ($val == 1) {
                                                                        if ($local == 'all') {
                                                                            $sql = "SELECT V.invtot,V.sucursal,V.invfec,V.igv, V.tipdoc,V.nrofactura,V.correlativo,V.cuscod,D.codpro,D.costpr,D.canpro,D.fraccion,D.factor,D.prisal FROM venta as V INNER JOIN detalle_venta AS D ON D.invnum = V.invnum WHERE D.invfec between '$date1' and '$date2' ";
                                                                        } else {
                                                                            $sql = "SELECT V.invtot,V.sucursal,V.invfec, V.igv,V.tipdoc,V.nrofactura,V.correlativo,V.cuscod,D.costpr,D.codpro,D.canpro,D.fraccion,D.factor,D.prisal FROM venta as V INNER JOIN detalle_venta AS D ON D.invnum = V.invnum WHERE D.invfec between '$date1' and '$date2' and V.sucursal = '$local' ";
                                                                        }
                                                                    }
                                                                    if ($vals == 2) {
                                                                        if ($local == 'all') {
                                                                            $sql = "SELECT V.invtot,V.sucursal,V.invfec, V.igv,V.tipdoc,V.nrofactura,V.correlativo,V.cuscod,D.costpr,D.codpro,D.canpro,D.fraccion,D.factor,D.prisal FROM venta as V INNER JOIN detalle_venta AS D ON D.invnum = V.invnum WHERE D.invfec between '$date1' and '$date2' ";
                                                                        } else {
                                                                            $sql = "SELECT V.invtot,V.sucursal,V.invfec,V.igv, V.tipdoc,V.nrofactura,V.correlativo,V.cuscod,D.costpr,D.codpro,D.canpro,D.fraccion,D.factor,D.prisal FROM venta as V INNER JOIN detalle_venta AS D ON D.invnum = V.invnum WHERE D.invfec between '$date1' and '$date2' and V.sucursal = '$local' ";
                                                                        }
                                                                    }


                                                                    $zz = 0;
                                                                    $i = 0;
                                                                    $sumpripro = 0;
                                                                    $SumInafectos = 0;
                                                                    $result = mysqli_query($conexion, $sql);
                                                                    if (mysqli_num_rows($result)) {
                                                                        ?>
                                                                        <table width="100%" border="0" align="center" id="customers">
                                                                            <thead>
                                                                                <tr align="center">
                                                                                    <?php if ($ckloc == 1) { ?>
                                                                                        <th width="120"><strong>LOCAL</strong></th>
                                                                                    <?php } ?>
                                                                                    <th><strong>FECHA</strong></th>
                                                                                    <th><strong>TH</strong></th>
                                                                                    <th><strong>SERIE</strong></th>
                                                                                    <th><strong>CORRELAT.</strong></th>
                                                                                    <th><strong>ACT</strong></th>
                                                                                    <th><strong>RUC O DNI</strong></th>
                                                                                    <th><strong>NOMBRE DE CLIENTE</strong></th>
                                                                                    <th><strong>COD. PRO</strong></th>
                                                                                    <th><strong>NOMBRE DE PRODUCTO</strong></th>
                                                                                    <th><strong>IMPUESTO</strong></th>
                                                                                    <th><strong>VALOR VENTA</strong></th>
                                                                                    <th><strong>SIN IGV</strong></th>
                                                                                    <th><strong>TOTAL</strong></th>
                                                                                </tr>
                                                                            </thead>
                                                                            <?php
                                                                            while ($row = mysqli_fetch_array($result)) {
                                                                                $invfec = $row['invfec'];
                                                                                $invnum = $row['invnum'];
                                                                                $tipdoc = $row['tipdoc'];
                                                                                $nrofactura = $row['nrofactura'];
                                                                                $correlativo = $row["correlativo"];
                                                                                $cuscod = $row["cuscod"];
                                                                                $codpro = $row['codpro'];
                                                                                $sucursal = $row["sucursal"];
                                                                                $igv = $row["igv"];
                                                                                $canpro = $row["canpro"];
                                                                                $fraccion = $row["fraccion"];
                                                                                $factor = $row["factor"];
                                                                                $prisal = $row["prisal"];
                                                                                $costpr = $row["costpr"];
                                                                                $invtot = $row["invtot"];
                                                                                $nrofactura2 = substr($nrofactura, 0, 4);
                                                                                $i++;
                                                                                $ssss[$i] = $sucursal;
                                                                                if ($sucursal <> $suc[$zz]) {
                                                                                    $zz++;
                                                                                    $suc[$zz] = $sucursal;
                                                                                }
                                                                                $sql3 = "SELECT nomloc,nombre FROM xcompa where codloc = '$sucursal'";
                                                                                $result3 = mysqli_query($conexion, $sql3);
                                                                                while ($row3 = mysqli_fetch_array($result3)) {
                                                                                    $nloc = $row3["nomloc"];
                                                                                    $nombre = $row3["nombre"];
                                                                                    if ($nombre == '') {
                                                                                        $sucur = $nloc;
                                                                                    } else {
                                                                                        $sucur = $nombre;
                                                                                    }
                                                                                }
                                                                                $sql2 = "SELECT activo,desprod,igv FROM producto WHERE codpro='$codpro' and eliminado='0' ";
                                                                                $result1 = mysqli_query($conexion, $sql2);
                                                                                if (mysqli_num_rows($result1)) {
                                                                                    while ($row1 = mysqli_fetch_array($result1)) {
                                                                                        $activo = $row1['activo'];
                                                                                        $desprod = $row1['desprod'];
                                                                                        $igvp = $row1['igv'];
                                                                                    }
                                                                                }

                                                                                $sql2 = "SELECT descli,dnicli,ruccli FROM cliente WHERE codcli='$cuscod' ";
                                                                                $result1 = mysqli_query($conexion, $sql2);
                                                                                if (mysqli_num_rows($result1)) {
                                                                                    while ($row1 = mysqli_fetch_array($result1)) {
                                                                                        $descli = $row1['descli'];
                                                                                        $dnicli = $row1['dnicli'];
                                                                                        $ruccli = $row1['ruccli'];
                                                                                    }
                                                                                }

                                                                                $sql1 = "SELECT nomusu FROM usuario where usecod = '$usecod'";
                                                                                $result1 = mysqli_query($conexion, $sql1);
                                                                                if (mysqli_num_rows($result1)) {
                                                                                    while ($row1 = mysqli_fetch_array($result1)) {
                                                                                        $user = $row1['nomusu'];
                                                                                    }
                                                                                }


                                                                                if ($igvp == 0) {
                                                                                    $MontoDetalle = $prisal * $canpro;
                                                                                    $SumInafectos = $SumInafectos + $MontoDetalle;
                                                                                    $SumInafectos= number_format($SumInafectos, 2, '.', '');
                                                                                }

                                                                                $SumGrabado = $invtot - ($igv + $SumInafectos);


                                                                                /* if ($sumpcosto > 0){
                                                                                  $rentabilidad   = $sumpripro - $sumpcosto;
                                                                                  $rentabilidad1[$zz] = $rentabilidad1[$zz] + $rentabilidad;} */
                                                                                if (($suc[$zz - 1] <> "") and ( $suc[$zz - 1] <> $suc[$zz])) {
                                                                                    if ($sucursal <> $ssss[$i - 1]) {
                                                                                        ?>

                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <tr onmouseover="this.style.backgroundColor = '#FFFF99';this.style.cursor = 'hand';" onmouseout="this.style.backgroundColor = '#ffffff';">
                                                                                    <?php if ($ckloc == 1) { ?><td width="30"><?php echo $sucur ?></td><?php } ?>
                                                                                    <td>
                                                                                        <div align="center"><?php echo fecha($invfec) ?></div>
                                                                                    </td>

                                                                                    <td>
                                                                                        <div align="CENTER"><?php echo $tipdoc ?></div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div align="CENTER"><?php echo $nrofactura2 ?></div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div align="CENTER"><?php echo $correlativo ?></div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div align="CENTER"><?php echo $activo ?></div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div align="CENTER"><?php
                                                                                            if ($dnicli <> "") {
                                                                                                echo "DNI" . "--" . $dnicli;
                                                                                            } else {
                                                                                                echo "RUC" . "--" . $ruccli;
                                                                                            }
                                                                                            ?></div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div align="left"><?php echo $descli ?></div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div align="center"><?php echo $codpro ?></div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div align="left"><?php echo $desprod ?></div>
                                                                                    </td>

                                                                                    <td>
                                                                                        <div align="center"><?php echo $igv; ?></div>
                                                                                    </td>
                                                                                    <!--impuesto-->
                                                                                    <td>
                                                                                        <div align="center"><?php echo $SumGrabado ?></div>
                                                                                    </td>
                                                                                    <!--valor de venta-->
                                                                                    <td>
                                                                                        <div align="center"><?php echo $SumInafectos ?></div>
                                                                                    </td>
                                                                                    <!--sin igv-->
                                                                                    <td>
                                                                                        <div align="center"><?php echo $invtot ?></div>
                                                                                    </td>
                                                                                    <!--total-->



                                                                                </tr>
                                                                            <?php } ?>
                                                                        </table>
                                                                        <?php if ($zz == 1) {
                                                                            ?>
                                                                                                                                        <!--<table width="926" border="0" align="center">
                                                                                                                                   <tr bgcolor="#CCCCCC">
                                                                                                                                        <td width="450"><div align="center"><strong>TOTAL</strong></div></td>
                                                                                                                                        <td width="90"><div align="center"><?php echo $numero_formato_frances = number_format($gravado1, 2, '.', ' '); ?></div></td>
                                                                                                                                        <td width="90"><div align="center"><?php echo $numero_formato_frances = number_format($inafecto1, 2, '.', ' '); ?></div></td>
                                                                                                                                        <td width="90"><div align="center"><?php echo $numero_formato_frances = number_format($igv1, 2, '.', ' '); ?></div></td>
                                                                                                                                        <td width="90"><div align="center"><?php echo $numero_formato_frances = number_format($TOT1, 2, '.', ' '); ?></div></td>
                                                                                                                                </tr>
                                                                                                                                        
                                                                                                                                  </tr>
                                                                                                                            </table>-->
                                                                        <?php } else { ?>
                                                                                                                                        <!--<table width="926" border="0" align="center">
                                                                                                                            <tr bgcolor="#CCCCCC">
                                                                                                                                 
                                                                                                                                        <td width="450"><div align="center"><strong>TOTAL</strong></div></td>
                                                                                                                                        <td width="90"><div align="center"><?php echo $numero_formato_frances = number_format($gravado1, 2, '.', ' '); ?></div></td>
                                                                                                                                        <td width="90"><div align="center"><?php echo $numero_formato_frances = number_format($habil_inafecto12[$zz], 2, '.', ' '); ?></div></td>
                                                                                        
                                                                                                                                        <td width="90"><div align="center"><?php echo $numero_formato_frances = number_format($igv1, 2, '.', ' '); ?></div></td>
                                                                                                                                        <td width="90"><div align="center"><?php echo $numero_formato_frances = number_format($TOT1, 2, '.', ' '); ?></div></td>
                                                                                                                                </tr>
                                                                                                                            </table>-->
                                                                            <?php
                                                                        }
                                                                    } else {
                                                                        ?>
                                                                        <div class="siniformacion">
                                                                            <center>
                                                                                No se logro encontrar informacion con los datos ingresados
                                                                            </center>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>




                                                        </table>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <?php
                                                if (($ck == 1) || ($ck1 == 1)) {

                                                    if (($val == 1) || ($vals == 2)) {
                                                        ?>

                                                        <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td>


                                                                    <?php
                                                                    if ($val == 1) {
                                                                        if ($local == 'all') {
                                                                            if ($doc == 1) {

                                                                                $sql = "SELECT V.invfec,V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invnum between '$desc' and '$desc1'   and estado = '0' AND  V.nrofactura like'B%' and invtot <> 0  order by V.nrovent ";
                                                                            }
                                                                            if ($doc == 2) { //factura
                                                                                $sql = "SELECT V.invfec,V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invnum between '$desc' and '$desc1'   and estado = '0' AND  V.nrofactura like'F%' and invtot <> 0 order by V.nrovent ";
                                                                            }
                                                                            if ($doc == 3) {
                                                                                $sql = "SELECT V.invfec,V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invnum between '$desc' and '$desc1'  and estado = '0' AND  V.nrofactura like'T%' and invtot <> 0 order by V.nrovent ";
                                                                            }
                                                                            if ($doc == 4) {
                                                                                $sql = "SELECT V.invfec,V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto,V.serie_doc,V.fecha_old,V.correlativo_doc  FROM  nota  AS V inner join cliente as C on C.codcli = V.cuscod where invnum between '$desc' and '$desc1'  and estado = '0' AND  V.nrofactura like'C%' and invtot <> 0 order by V.nrovent ";
                                                                            }
                                                                        } else {
                                                                            if ($doc == 1) {
                                                                                $sql = "SELECT V.invfec,V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invnum between '$desc' and '$desc1' and 	V.sucursal = '$local' and estado = '0' AND  V.nrofactura like'B%' and invtot <> 0 order by V.nrovent";
                                                                            }
                                                                            if ($doc == 2) {
                                                                                $sql = "SELECT V.invfec,V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invnum between '$desc' and '$desc1' and 	V.sucursal = '$local' and estado = '0' AND  V.nrofactura like'F%' and invtot <> 0 order by V.nrovent";
                                                                            }
                                                                            if ($doc == 3) {
                                                                                $sql = "SELECT V.invfec,V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invnum between '$desc' and '$desc1' and 	V.sucursal = '$local' and V.invtot <> '0' and V.gravado<>'0' and estado = '0' and invtot <> 0 AND  V.nrofactura like'T%'  order by V.nrovent ";
                                                                            }

                                                                            if ($doc == 4) {
                                                                                $sql = "SELECT V.invfec,V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto,V.serie_doc,V.fecha_old,V.correlativo_doc  FROM nota AS V inner join cliente as C on C.codcli = V.cuscod where invnum between '$desc' and '$desc1' and 	V.sucursal = '$local' and V.invtot <> '0' and V.gravado<>'0' and estado = '0' and invtot <> 0 AND  V.nrofactura like'C%'  order by V.nrovent ";
                                                                            }
                                                                        }
                                                                    }


                                                                    if ($vals == 2) {
                                                                        if ($local == 'all') {
                                                                            if ($doc == 1) {
                                                                                $sql = "SELECT cuscod,invnum,usecod,nrovent,invtot,sucursal,nrofactura,gravado,igv,val_habil,inafecto,nrofactura,invfec,inafecto FROM venta  WHERE invfec between '$date1' and '$date2'  AND nrofactura like'B%' and invtot <> 0 order by nrovent";
                                                                            }
                                                                            if ($doc == 2) { //factura
                                                                                $sql = "	SELECT cuscod,invnum,usecod,nrovent,invtot,sucursal,nrofactura,gravado,igv,val_habil,inafecto,nrofactura,invfec,inafecto FROM venta  WHERE invfec between '$date1' and '$date2'  AND nrofactura like'F%' and invtot <> 0 order by nrovent";
                                                                            }
                                                                            if ($doc == 3) {
                                                                                $sql = "SELECT cuscod,invnum,usecod,nrovent,invtot,sucursal,nrofactura,gravado,igv,val_habil,inafecto,nrofactura,invfec,inafecto FROM venta  WHERE invfec between '$date1' and '$date2'  AND nrofactura like'T%' and invtot <> 0 order by nrovent";
                                                                            }
                                                                            if ($doc == 4) {
                                                                                $sql = "SELECT cuscod,invnum,usecod,nrovent,invtot,sucursal,nrofactura,gravado,igv,val_habil,inafecto,nrofactura,invfec,inafecto,serie_doc,fecha_old,correlativo_doc FROM nota  WHERE invfec between '$date1' and '$date2'   and invtot <> 0 order by nrovent";
                                                                            }
                                                                            if ($doc == 0) {
                                                                                $sql = "SELECT V.invfec,V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$date1' and '$date2' and invtot <> 0 and estado = '0' order by V.nrovent ";
                                                                            }
                                                                        } else {
                                                                            if ($doc == 1) {
                                                                                $sql = "SELECT cuscod,invnum,usecod,nrovent,invtot,sucursal,nrofactura,gravado,igv,val_habil,inafecto,nrofactura,invfec,inafecto FROM venta  WHERE invfec between '$date1' and '$date2'  and sucursal = '$local' AND nrofactura like'B%' and invtot <> 0 order by nrovent";
                                                                            }
                                                                            if ($doc == 2) {
                                                                                $sql = "SELECT cuscod,invnum,usecod,nrovent,invtot,sucursal,nrofactura,gravado,igv,val_habil,inafecto,nrofactura,invfec,inafecto FROM venta  WHERE invfec between '$date1' and '$date2'  and sucursal = '$local' AND nrofactura like'F%' order by nrovent";
                                                                            }
                                                                            if ($doc == 3) {
                                                                                $sql = "SELECT cuscod,invnum,usecod,nrovent,invtot,sucursal,nrofactura,gravado,igv,val_habil,inafecto,nrofactura,invfec,inafecto FROM venta  WHERE invfec between '$date1' and '$date2'  and sucursal = '$local' AND nrofactura like'T%' order by nrovent";
                                                                            }
                                                                            if ($doc == 5) {
                                                                                    $sql = "SELECT cuscod,invnum,usecod,nrovent,invtot,sucursal,nrofactura,gravado,igv,val_habil,inafecto,nrofactura,invfec,inafecto FROM venta  WHERE invfec between '$date1' and '$date2'  and sucursal = '$local' and tipdoc<>4 and estado='0' order by nrovent";
                                                                                }
                                                                            if ($doc == 4) {
                                                                                $sql = "SELECT cuscod,invnum,usecod,nrovent,invtot,sucursal,nrofactura,gravado,igv,val_habil,inafecto,nrofactura,invfec,inafecto,serie_doc,fecha_old,correlativo_doc FROM nota  WHERE invfec between '$date1' and '$date2'  and sucursal = '$local'  order by nrovent";
                                                                            }
                                                                            if ($doc == 0) {
                                                                                $sql = "SELECT V.invfec,V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between  '$date1' and '$date2' and V.sucursal = '$local'  and estado = '0' order by V.nrovent";
                                                                            }
                                                                        }
                                                                    }


                                                                    $zz = 0;
                                                                    $i = 0;
                                                                    $result = mysqli_query($conexion, $sql);
                                                                    if (mysqli_num_rows($result)) {
                                                                        ?>
                                                                        <table width="100%" border="1" align="center" id="customers">
                                                                            <thead>
                                                                                <tr>
                                                                                    <?php if ($ckloc == 1) { ?><th width="30"><strong>LOCAL</strong></th><?php } ?>
                                                                                    <th width="50">
                                                                                        <div align=""><strong>FECHA </strong></div>
                                                                                    </th>
                                                                                    <th width="40">
                                                                                        <div align=""><strong>N&ordm; C. INTER </strong></div>
                                                                                    </th>
                                                                                    <th width="55">
                                                                                        <div align=""><strong>N&ordm; FISICO </strong></div>
                                                                                    </th>
                                                                                    <th width="90">
                                                                                        <div align=""><strong>CLIENTE </strong></div>
                                                                                    </th>

                                                                                    <?php if ($doc == 4) { ?>
                                                                                        <th width="40">
                                                                                            <div align=""><strong>SERIE</strong></div>
                                                                                        </th>
                                                                                    <?php } ?>

                                                                                    <?php if ($doc == 4) { ?>
                                                                                        <th width="40">
                                                                                            <div align=""><strong>FEC.DOC </strong></div>
                                                                                        </th>
                                                                                    <?php } ?>

                                                                                    <?php if ($doc == 4) { ?>
                                                                                        <th width="40">
                                                                                            <div align=""><strong>CORREL. </strong></div>
                                                                                        </th>
                                                                                    <?php } ?>

                                                                                    <?php if ($doc == 1) { ?>
                                                                                        <th width="40">
                                                                                            <div align=""><strong>DNI </strong></div>
                                                                                        </th>
                                                                                    <?php } ?>
                                                                                    <?php if ($doc == 2) { ?><th width="54" align="center" ><strong>RUC</strong></th><?php } ?>
                                                                                    <th width="54">&nbsp;</th>



                                                                                    <th width="25">
                                                                                        <div align=""><strong>AFECTO</strong></div>
                                                                                    </th>
                                                                                    <th width="25">
                                                                                        <div align=""><strong>INAFECTO</strong></div>
                                                                                    </th>
                                                                                    <th width="25">
                                                                                        <div align=""><strong>IGV</strong></div>
                                                                                    </th>
                                                                                    <th width="30">
                                                                                        <div align=""><strong>TOTAL</strong></div>
                                                                                    </th>

                                                                                </tr>
                                                                                <thead>
                                                                                    <?php
                                                                                    while ($row = mysqli_fetch_array($result)) {
                                                                                        $cuscod1 = $row['cuscod'];
                                                                                        $invnum = $row['invnum'];
                                                                                        $usecod = $row['usecod'];
                                                                                        $nrovent = $row['nrovent'];
                                                                                        //		$forpag    = $row["forpag"];
                                                                                        $val_habil = $row["val_habil"];
                                                                                        $total = $row["invtot"];
                                                                                        $sucursal = $row["sucursal"];
                                                                                        $nrofactura = $row["nrofactura"];
                                                                                        $invfecv = $row['invfec'];
                                                                                       if ($doc == 4) {
                                            $serie_doc = $row["serie_doc"];
                                            $fecha_old = $row["fecha_old"];
                                            $correlativo_doc = $row["correlativo_doc"];
                                        }

                                        //		$descli	   = $row['descli'];
                                        //		$ruccli	   = $row['ruccli'];
                                        //		$dnicli	   = $row['dnicli'];

                                        $afecto = $row["gravado"];
                                        $inafecto = $row["inafecto"];
                                        $igv = $row["igv"];
                                        $invtot = $row["invtot"];
                                        
                                        

                                       
                                        
        $SumGrabado=0          ;                      
$SumInafectos = 0;
$sqlDetTot = "SELECT * FROM detalle_venta where invnum = '$invnum' and canpro <> '0'";
$resultDetTot = mysqli_query($conexion, $sqlDetTot);
if (mysqli_num_rows($resultDetTot)) {
    while ($row = mysqli_fetch_array($resultDetTot)) {
        $igvVTADet = 0;
        $codproDet = $row['codpro'];
        $canproDet = $row['canpro'];
        $factorDet = $row['factor'];
        $prisalDet = $row['prisal'];
        $priproDet = $row['pripro'];
        $fraccionDet = $row['fraccion'];
        $sqlProdDet = "SELECT igv FROM producto where codpro = '$codproDet' and eliminado='0'";
        $resultProdDet = mysqli_query($conexion, $sqlProdDet);
        if (mysqli_num_rows($resultProdDet)) {
            while ($row1 = mysqli_fetch_array($resultProdDet)) {
                $igvVTADet = $row1['igv'];
            }
        }
        if ($igvVTADet == 0) {
            $MontoDetalle = $prisalDet * $canproDet;
            $SumInafectos = $SumInafectos + $MontoDetalle;
            $SumInafectos= number_format($SumInafectos, 2, '.', '');
        }
    }
}
$SumGrabado = $invtot - ($igv + $SumInafectos);

                                if ($val_habil <> 1) {
                                            $afecto_suma += $SumGrabado;
                                            $inafecto_suma += $SumInafectos;
                                            $igv_suma += $igv;
                                            $invtot_suma += $invtot;
                                        }


                                                                                        //CLIENTE
                                                                                        $sql1 = "SELECT descli,dnicli,ruccli FROM cliente where codcli = '$cuscod1'";
                                                                                        $result1 = mysqli_query($conexion, $sql1);
                                                                                        if (mysqli_num_rows($result1)) {
                                                                                            while ($row1 = mysqli_fetch_array($result1)) {
                                                                                                $descli = $row1['descli'];
                                                                                                $dnicli = $row1['dnicli'];
                                                                                                $ruccli = $row1['ruccli'];
                                                                                            }
                                                                                        }
                                                                                        $i++;
                                                                                        $ssss[$i] = $sucursal;
                                                                                        if ($sucursal <> $suc[$zz]) {
                                                                                            $zz++;
                                                                                            $suc[$zz] = $sucursal;
                                                                                        }
                                                                                        $sql3 = "SELECT nomloc,nombre FROM xcompa where codloc = '$sucursal'";
                                                                                        $result3 = mysqli_query($conexion, $sql3);
                                                                                        while ($row3 = mysqli_fetch_array($result3)) {
                                                                                            $nloc = $row3["nomloc"];
                                                                                            $nombre = $row3["nombre"];
                                                                                            if ($nombre == '') {
                                                                                                $sucur = $nloc;
                                                                                            } else {
                                                                                                $sucur = $nombre;
                                                                                            }
                                                                                        }
                                                                                        $e_tot = 0;
                                                                                        $t_tot = 0;
                                                                                        $c_tot = 0;
                                                                                        //		$inafecto = 0;
                                                                                        $deshabil_tot = 0;
                                                                                        $deshabil_gravado = 0;
                                                                                        $habil_inafecto11 = 0;
                                                                                        $habil_tot = 0;
                                                                                        $count = 0;
                                                                                        $tot = 0;
                                                                                        $Rentabilidad = 0;
                                                                                        $sumpripro = 0;
                                                                                        $sumpcosto = 0;
                                                                                        $porcentaje = 0;
                                                                                        $sql1 = "SELECT nomusu FROM usuario where usecod = '$usecod'";
                                                                                        $result1 = mysqli_query($conexion, $sql1);
                                                                                        if (mysqli_num_rows($result1)) {
                                                                                            while ($row1 = mysqli_fetch_array($result1)) {
                                                                                                $user = $row1['nomusu'];
                                                                                            }
                                                                                        }

                                                                                        if ($val_habil == 0) {
                                                                                            if ($forpag == "E") {
                                                                                                $e_tot = $total;
                                                                                                $e_tot1[$zz] = $e_tot1[$zz] + $total;
                                                                                            }
                                                                                            if ($forpag == "T") {
                                                                                                $t_tot = $total;
                                                                                                $t_tot1[$zz] = $t_tot1[$zz] + $total;
                                                                                            }
                                                                                            if ($forpag == "C") {
                                                                                                $c_tot = $total;
                                                                                                $c_tot1[$zz] = $c_tot1[$zz] + $total;
                                                                                            }

                                                                                            if ($doc == 4) {
                                                                                                $sql2 = "SELECT costpr,pripro,canpro,fraccion,factor,prisal,costpr FROM detalle_nota where invnum = '$invnum'";
                                                                                            } else {
                                                                                                $sql2 = "SELECT costpr,pripro,canpro,fraccion,factor,prisal,costpr FROM detalle_venta where invnum = '$invnum'";
                                                                                            }

                                                                                            $result2 = mysqli_query($conexion, $sql2);
                                                                                            if (mysqli_num_rows($result2)) {
                                                                                                while ($row2 = mysqli_fetch_array($result2)) {
                                                                                                    $pcostouni = $row2["cospro"]; //costo del producto x caja
                                                                                                    $pripro = $row2['pripro']; //subtotal de venta precio unitario x cantidad vendida
                                                                                                    $canpro = $row2['canpro'];
                                                                                                    $fraccion = $row2['fraccion'];
                                                                                                    $factor = $row2['factor'];
                                                                                                    $prisal = $row2['prisal']; //precio de venta x unidad
                                                                                                    $costpr = $row2['costpr']; //costo del producto x unidad
                                                                                                    //FRACCIONADO
                                                                                                    if ($fraccion == "T") {
                                                                                                        $RentPorcent = (($prisal - $costpr) * $canpro);
                                                                                                        $Rentabilidad = $Rentabilidad + $RentPorcent;
                                                                                                        //$precio_costo = $pcostouni;
                                                                                                    } else {
                                                                                                        //NO FRACCIONADO
                                                                                                        //$precio_costo = $pcostouni/$factor;
                                                                                                        //$canpros   = $canpro * $factor;
                                                                                                        //$tot	   = $tot + $canpros;
                                                                                                        $RentPorcent = (($prisal - $pcostouni) * $canpro);
                                                                                                        $Rentabilidad = $Rentabilidad + $RentPorcent;
                                                                                                    }


                                                                                                    /* $pcostouni    = $row2["cospro"];
                                                                                                      $pripro       = $row2['pripro'];
                                                                                                      $canpro    	  = $row2['canpro'];
                                                                                                      $fraccion     = $row2['fraccion'];
                                                                                                      $factor       = $row2['factor'];
                                                                                                      $invfec       = $row2['invfec'];
                                                                                                      $tot   	      = 0;
                                                                                                      $precio_costo = $costpr;
                                                                                                      if ($fraccion == "T"){
                                                                                                      $tot	   = $tot + $canpro;}
                                                                                                      else{
                                                                                                      //$precio_costo = $pcostouni/$factor;
                                                                                                      $canpros   = $canpro * $factor;
                                                                                                      $tot	   = $tot + $canpros;}
                                                                                                      $sumpripro = $sumpripro + $pripro;
                                                                                                      $pcosto    = $tot * $precio_costo;
                                                                                                      $sumpcosto = $sumpcosto + $pcosto; */
                                                                                                }
                                                                                            }
                                                                                        }

                                                                                        $deshabil++;
                                                                                        $deshabil_tot = $deshabil_tot + $total;
                                                                                        $deshabil_tot1[$zz] = $deshabil_tot1[$zz] + $total;

                                                                                        $habil_tot = $habil_tot + $total;
                                                                                        $habil_tot1[$zz] = $habil_tot1[$zz] + $total;

                                                                                        $count++;
                                                                                        if ($total == 1) {
                                                                                            $deshabil++;
                                                                                            $deshabil_total = $deshabil_total + $total;
                                                                                            $deshabil_total1[$zz] = $deshabil_total1[$zz] + $total;
                                                                                        } else {
                                                                                            $habil_total = $habil_total + $total;
                                                                                            $habil_total1[$zz] = $habil_total1[$zz] + $total;
                                                                                        }
                                                                                        $count++;
                                                                                        if ($gravado == 1) {
                                                                                            $deshabil++;
                                                                                            $deshabil_gravado = $deshabil_gravado + $gravado;
                                                                                            $deshabil_gravado1[$zz] = $deshabil_gravado1[$zz] + $gravado;
                                                                                        } else {
                                                                                            $habil_gravado = $habil_gravado + $gravado;
                                                                                            $habil_gravado1[$zz] = $habil_gravado1[$zz] + $gravado;
                                                                                        }
                                                                                        $count++;

                                                                                        //			if ($igv == 1)
                                                                                        //                                {
                                                                                        //				$deshabil++;
                                                                                        //				$deshabil_igv = $deshabil_igv + $igv;
                                                                                        //				$deshabil_igv1[$zz] = $deshabil_igv1[$zz] + $igv;
                                                                                        //                                }
                                                                                        //				else
                                                                                        //                                {
                                                                                        //				$habil_igv = $habil_igv + $igv;
                                                                                        //				$habil_igv1[$zz] = $habil_igv1[$zz] + $igv;
                                                                                        //                                }
                                                                                        //				$count++; 

                                                                                        if ($inafecto5 == 1) {
                                                                                            $deshabil++;
                                                                                            $deshabil_inafecto = $deshabil_inafecto + $inafecto5;
                                                                                            $deshabil_inafecto1[$zz] = $deshabil_inafecto1[$zz] + $inafecto5;
                                                                                        } else {
                                                                                            $habil_inafecto = $habil_inafecto + $inafecto5;
                                                                                            $habil_inafecto12[$zz] = $habil_inafecto12[$zz] + $inafecto5;
                                                                                        }
                                                                                        $count++;
                                                                                        if ($invtot == 1) {
                                                                                            $deshabil++;
                                                                                            $deshabil_invtot = $deshabil_invtot + $invtot;
                                                                                            $deshabil_invtot1[$zz] = $deshabil_invtot1[$zz] + $invtot;
                                                                                        } else {
                                                                                            $habil_invtot = $habil_invtot + $invtot;
                                                                                            $habil_invtot12[$zz] = $habil_invtot12[$zz] + $invtot;
                                                                                        }
                                                                                        $count++;

                                                                                        $rentabilidad = $Rentabilidad;
                                                                                        $rentabilidad1[$zz] = $rentabilidad1[$zz] + $Rentabilidad;



                                                                                        /* if ($sumpcosto > 0){
                                                                                          $rentabilidad   = $sumpripro - $sumpcosto;
                                                                                          $rentabilidad1[$zz] = $rentabilidad1[$zz] + $rentabilidad;} */
                                                                                        if (($suc[$zz - 1] <> "") and ( $suc[$zz - 1] <> $suc[$zz])) {
                                                                                            if ($sucursal <> $ssss[$i - 1]) {
                                                                                                ?>
                                                                                                <tr bgcolor="#CCCCCC">

                                                                                                    <td <?php if ($ckloc == 1) { ?>
                                                                                                            <?php if ($doc == 1) { ?> COLSPAN="6" <?php } ?>                        
                                                                                                            <?php if ($doc == 2) { ?> COLSPAN="7" <?php } ?>                        
                                                                                                            <?php if ($doc == 3) { ?> COLSPAN="6" <?php } ?>                        
                                                                                                            <?php if ($doc == 4) { ?> COLSPAN="9" <?php } ?>                        



                                                                                                        <?php } else { ?>

                                                                                                            <?php if ($doc == 1) { ?> COLSPAN="5" <?php } ?> 
                                                                                                            <?php if ($doc == 2) { ?> COLSPAN="6" <?php } ?> 
                                                                                                            <?php if ($doc == 3) { ?> COLSPAN="5" <?php } ?> 
                                                                                                            <?php if ($doc == 4) { ?> COLSPAN="8" <?php } ?> 

                                                                                                        <?php } ?>>
                                                                                                        <div align="center"><strong>TOTAL</strong></div>
                                                                                                    </td>
                                                                                                    <td width="64">
                                                                                                        <div align="center"><?php echo $numero_formato_frances = number_format($e_tot1[$zz - 1], 2, '.', ' '); ?></div>
                                                                                                    </td>
                                                                                                    <td width="68">
                                                                                                        <div align="center"><?php echo $numero_formato_frances = number_format($c_tot1[$zz - 1], 2, '.', ' '); ?></div>
                                                                                                    </td>
                                                                                                    <td width="80">
                                                                                                        <div align="center"><?php echo $numero_formato_frances = number_format($t_tot1[$zz - 1], 2, '.', ' '); ?></div>
                                                                                                    </td>
                                                                                                    <td width="68">
                                                                                                        <div align="center"><?php echo $numero_formato_frances = number_format($deshabil_tot1[$zz - 1], 2, '.', ' '); ?></div>
                                                                                                    </td>

                                                                                                </tr>
                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                        <tbody>
                                                                                            <tr onmouseover="this.style.backgroundColor = '#FFFF99';this.style.cursor = 'hand';" onmouseout="this.style.backgroundColor = '#ffffff';">
                                                                                                <?php if ($ckloc == 1) { ?><td width="15"><?php echo $sucur ?></td><?php } ?>
                                                                                                <td width="40">
                                                                                                    <div align="center"><?php echo fecha($invfecv) ?></div>
                                                                                                </td>
                                                                                                <td width="40">
                                                                                                    <div align="center"><?php echo $invnum ?></div>
                                                                                                </td>
                                                                                                <td width="40">
                                                                                                    <div align="center"><?php echo $nrofactura ?></div>
                                                                                                </td>
                                                                                                <td width="90">
                                                                                                    <div><?php echo $descli ?></div>
                                                                                                </td>
                                                                                                <?php if ($doc == 4) { ?>
                                                                                                    <td width="35">
                                                                                                        <div align="CENTER"><?php echo $serie_doc ?></div>
                                                                                                    </td>
                                                                                                <?php } ?>

                                                                                                <?php if ($doc == 4) { ?>
                                                                                                    <td width="35">
                                                                                                        <div align="CENTER"><?php echo fecha($fecha_old) ?></div>
                                                                                                    </td>
                                                                                                <?php } ?>
                                                                                                <?php if ($doc == 4) { ?>
                                                                                                    <td width="35">
                                                                                                        <div align="CENTER"><?php echo $correlativo_doc ?></div>
                                                                                                    </td>
                                                                                                <?php } ?>

                                                                                                <?php if ($doc == 1) { ?>
                                                                                                    <td width="35">
                                                                                                        <div align="CENTER"><?php echo $dnicli ?></div>
                                                                                                    </td>
                                                                                                <?php } ?>
                                                                                                <?php if ($doc == 2) { ?><td align="CENTER"><?php echo $ruccli ?></td><?php } ?>
                                                                                                <td width="45">
                                                                                                    <div align="center"><?php
                                                                                                        if ($val_habil == 1) {
                                                                                                            $reso = "ANULADO";
                                                                                                            echo "<p class='Estilo1'>$reso</p>";
                                                                                                        } else {
                                                                                                            $reso = " ";
                                                                                                            echo "<strong>$reso</strong>";
                                                                                                        }
                                                                                                        ?></div>
                                                                                                </td>
                                                                                                <td width="35">
                                                                                                    <div align="CENTER"><?php
                                                                                                        if ($val_habil == 1) {
                                                                                                            echo "<p class='Estilo1'>-----</p>";
                                                                                                            ;
                                                                                                        } else {
                                                                                                            echo $SumGrabado;
                                                                                                        }
                                                                                                        ?></div>
                                                                                                </td>
                                                                                                <td width="50">
                                                                                                    <div align="center"><?php
                                                                                                        if ($val_habil == 1) {
                                                                                                            echo "<p class='Estilo1'>-----</p>";
                                                                                                            ;
                                                                                                        } else {
                                                                                                            echo $SumInafectos;
                                                                                                        }
                                                                                                        ?></div>
                                                                                                </td>
                                                                                                <td width="35">
                                                                                                    <div align="center"><?php
                                                                                                        if ($val_habil == 1) {
                                                                                                            echo "<p class='Estilo1'>-----</p>";
                                                                                                            ;
                                                                                                        } else {
                                                                                                            echo $igv;
                                                                                                        }
                                                                                                        ?></div>
                                                                                                </td>
                                                                                                <td width="35">
                                                                                                    <div align="center"><?php
                                                                                                        if ($val_habil == 1) {
                                                                                                            echo "<p class='Estilo1'>-----</p>";
                                                                                                            ;
                                                                                                        } else {
                                                                                                            echo $invtot;
                                                                                                        }
                                                                                                        ?></div>
                                                                                                </td>




                                                                                            </tr>
                                                                                        </tbody>
                                                                                    <?php } ?>

                                                                                    <?php if ($zz == 1) {
                                                                                        ?>
                                                                                        <tfoot>
                                                                                            <tr bgcolor="#CCCCCC">


                                                                                                <td <?php if ($ckloc == 1) { ?>
                                                                                                        <?php if ($doc == 1) { ?> COLSPAN="6" <?php } ?>                        
                                                                                                        <?php if ($doc == 2) { ?> COLSPAN="7" <?php } ?>                        
                                                                                                        <?php if ($doc == 3) { ?> COLSPAN="6" <?php } ?>                        
                                                                                                        <?php if ($doc == 4) { ?> COLSPAN="9" <?php } ?>                        



                                                                                                    <?php } else { ?>

                                                                                                        <?php if ($doc == 1) { ?> COLSPAN="5" <?php } ?> 
                                                                                                        <?php if ($doc == 2) { ?> COLSPAN="6" <?php } ?> 
                                                                                                        <?php if ($doc == 3) { ?> COLSPAN="5" <?php } ?> 
                                                                                                        <?php if ($doc == 4) { ?> COLSPAN="8" <?php } ?> 

                                                                                                    <?php } ?>>
                                                                                                    <div align="center"><strong>TOTAL</strong></div>
                                                                                                </td>
                                                                                                <?php if ($doc == 1) { ?>
                                                                                                    <td></td>
                                                                                                <?php } ?>
                                                                                                <td width="64">
                                                                                                    <div align="center"><?php echo $numero_formato_frances = number_format($afecto_suma, 2, '.', ' '); ?></div>
                                                                                                </td>
                                                                                                <td width="66">
                                                                                                    <div align="center"><?php echo $numero_formato_frances = number_format($inafecto_suma, 2, '.', ' '); ?></div>
                                                                                                </td>
                                                                                                <td width="60">
                                                                                                    <div align="center"><?php echo $numero_formato_frances = number_format($igv_suma, 2, '.', ' '); ?></div>
                                                                                                </td>
                                                                                                <td width="58">
                                                                                                    <div align="center"><?php echo $numero_formato_frances = number_format($invtot_suma, 2, '.', ' '); ?></div>
                                                                                                </td>
                                                                                                <!--<td colspan="2"></td>-->

                                                                                            </tr>
                                                                                        </tfoot>
                                                                                        </table>
                                                                                    <?php } else { ?>
                                                                                        <table width="100%" border="0" align="center">
                                                                                            <tr bgcolor="#CCCCCC">
                                                                                                <td <?php if ($ckloc == 1) { ?>
                                                                                                        <?php if ($doc == 1) { ?> COLSPAN="6" <?php } ?>                        
                                                                                                        <?php if ($doc == 2) { ?> COLSPAN="7" <?php } ?>                        
                                                                                                        <?php if ($doc == 3) { ?> COLSPAN="6" <?php } ?>                        
                                                                                                        <?php if ($doc == 4) { ?> COLSPAN="9" <?php } ?>                        



                                                                                                    <?php } else { ?>

                                                                                                        <?php if ($doc == 1) { ?> COLSPAN="5" <?php } ?> 
                                                                                                        <?php if ($doc == 2) { ?> COLSPAN="6" <?php } ?> 
                                                                                                        <?php if ($doc == 3) { ?> COLSPAN="5" <?php } ?> 
                                                                                                        <?php if ($doc == 4) { ?> COLSPAN="8" <?php } ?> 

                                                                                                    <?php } ?>>
                                                                                                    <div align="center"><strong>TOTAL</strong></div>
                                                                                                </td>
                                                                                                <td width="64">
                                                                                                    <div align="center"><?php echo $numero_formato_frances = number_format($e_tot1[$zz], 2, '.', ' '); ?></div>
                                                                                                </td>
                                                                                                <td width="68">
                                                                                                    <div align="center"><?php echo $numero_formato_frances = number_format($c_tot1[$zz], 2, '.', ' '); ?></div>
                                                                                                </td>
                                                                                                <td width="80">
                                                                                                    <div align="center"><?php echo $numero_formato_frances = number_format($t_tot1[$zz], 2, '.', ' '); ?></div>
                                                                                                </td>

                                                                                                <td width="68">
                                                                                                    <div align="center"><?php echo $numero_formato_frances = number_format($deshabil_tot1[$zz], 2, '.', ' '); ?></div>
                                                                                                </td>
                                                                                                <td width="61">
                                                                                                    <div align="center"><?php echo $numero_formato_frances = number_format($habil_tot1[$zz], 2, '.', ' '); ?></div>
                                                                                                </td>
                                                                                                <td width="70">
                                                                                                    <div align="center"><?php echo $numero_formato_frances = number_format($rentabilidad1[$zz], 2, '.', ' '); ?></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                        <?php
                                                                                    }
                                                                                } else {
                                                                                    ?>
                                                                                    <div class="siniformacion">
                                                                                        <center>
                                                                                            No se logro encontrar informacion con los datos ingresados
                                                                                        </center>
                                                                                    </div>
                                                                                <?php } ?>
                                                                                </td>
                                                                                </tr>

                                                                                <!--A-->


                                                                                </table>
                                                                                <?php
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                    </body>
                                                                    </html>
