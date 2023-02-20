<section>


    <div class="bodyy" style="width: 100%">
        <div class="title2">
            <?php if ($logo <> "") { ?>
                <img src="data:image/jpg;base64,<?php echo base64_encode($logo); ?> " />
            <?php } ?>
        </div>

        <div class="title" style="text-align: left">
            <p style="text-align: left" style="font-size: small; "><?php echo pintaDatos($linea1); ?></p>
            <p style="text-align: left"><?php echo pintaDatos($linea2); ?></p>
            <p style="text-align: left"><?php echo pintaDatos($linea3); ?></p>
            <?php if ($tipdoc <> 4) { ?>
                <p style="text-align: left"> <?php echo pintaDatos($linea5); ?> </p>
            <?php } ?>
            <p style="text-align: left"><?php echo pintaDatos($linea6); ?></p>
            <p style="text-align: left"><?php echo pintaDatos($linea7); ?></p>
            <p style="text-align: left"><?php echo pintaDatos($linea8); ?></p>
            <p style="text-align: left"><?php echo pintaDatos($linea9); ?></p>

        </div>

        <div class="div_ruc">

            <?php if ($tipdoc <> 4) { ?>
                <p> <?php echo $linea5; ?> </p>
            <?php } ?>
            <p class="boleta" style="font-weight: 1990; ">
                <font color="#0a6fc2" style="font-weight: 1990; "><?php echo $TextDoc; ?></font>
            </p>
            <!-- <p ><?php echo $serie . '-' . zero_fill($correlativo, 8) . " " . $anulado; ?></p>-->
            <p> <?php echo $nrofactura . " " . $anulado; ?> </p>
        </div>
    </div>



    <?php if ($drogueria == 0) { ?>
        <div class="title_div" style="width: 100%">
            <div class="data_cliente">
                <table class="table_cabe">
                    <tr>
                        <th align="left" class="thra1cabe">
                            <p class="letracabe">Nombre:</p>
                        </th>
                        <th align="left" class="thra1cabe">
                            <p class="letracabe">
                                <font><?php echo $descli; ?></font>
                            </p>
                        </th>
                        <th align="left" class="thra1cabe">
                            <p class="letracabe">Fecha emision:</p>
                        </th>
                        <th align="left" class="thra1cabe">
                            <p class="letracabe">
                                <font><?php echo $invfec; ?></font>
                            </p>
                        </th>

                    </tr>
                    <tr>
                        <th align="left" class="thra1cabe">
                            <p class="letracabe">Direcci&oacute;n:</p>
                        </th>
                        <th align="left" class="thra1cabe">
                            <p class="letracabe">
                                <font><?php echo $dircli; ?></font>
                            </p>
                        </th>
                        <th align="left" class="thra1cabe">
                            <p class="letracabe">Moneda:</p>
                        </th>
                        <th align="left" class="thra1cabe">
                            <p class="letracabe">
                                <font><?php echo "soles"; ?></font>
                            </p>
                        </th>

                    </tr>
                    <tr>
                        <th align="left" class="thra1cabe">
                            <p class="letracabe">RUC:</p>
                        </th>
                        <th align="left" class="thra1cabe">
                            <p class="letracabe">
                                <font><?php echo $ruccli; ?></font>
                            </p>
                        </th>
                        <th align="left" class="thra1cabe">
                            <p class="letracabe"><?php if ($doc == 4) { ?>Doc Afectado :<?php } ?></p>
                        </th>
                        <th align="left" class="thra1cabe">
                            <p class="letracabe">
                                <font><?php
                                        if ($doc == 4) {
                                            echo $docafectado;
                                        }
                                        ?></font>
                            </p>
                        </th>

                    </tr>
                    <tr>
                        <th align="left" class="thra1cabe">
                            <p class="letracabe"><?php if ($doc <> 4) { ?> Forma de pago:<?php } ?></p>
                        </th>
                        <th align="left" class="thra1cabe">
                            <p class="letracabe">
                                <font><?php
                                        if ($doc <> 4) {
                                            echo $forma;
                                        }
                                        ?></font>
                            </p>
                        </th>
                        <th align="left" class="thra1cabe">
                            <p class="letracabe">Usuario:</p>
                        </th>
                        <th align="left" class="thra1cabe">
                            <p class="letracabe">
                                <font><?php echo $nomusu2; ?></font>
                            </p>
                        </th>
                    </tr>
                </table>
            </div>



        </div>
    <?php } else { ?>


        <table class="table_1">
            <tr>
                <th class="thra">VENDEDOR</th>
                <th class="thra">COND. PAGO</th>
                <th class="thra">FECHA DE VENCIMIENTO</th>
                <th class="thra">GUIA DE REMISION</th>
                <th class="thra">NRO ORDEN DE VENTA</th>
            </tr>
            <tr>
                <td class="tdra"><?php echo $nomusu; ?></td>
                <td class="tdra" align="center"><?php echo $forma; ?></td>
                <td class="tdra">&nbsp;</td>
                <td class="tdra">&nbsp;</td>
                <td class="tdra" align="center"><?php echo zero_fill($correlativo, 8); ?></td>
            </tr>
        </table>

    <?php } ?>
    <table class="table_2" style="width: 100%;" frame="hsides" rules="groups">

        <COLGROUP align="center" height="455px" style="color: #0a6fc2;"></COLGROUP>
        <COLGROUP align="left" height="455px" style="color: #0a6fc2;"></COLGROUP>
        <COLGROUP align="center" height="455px" style="color: #0a6fc2;"></COLGROUP>
        <COLGROUP align="center" height="455px" style="color: #0a6fc2;"></COLGROUP>
        <COLGROUP align="center" height="455px" style="color: #0a6fc2;"></COLGROUP>
        <COLGROUP align="center" height="455px" style="color: #0a6fc2;"></COLGROUP>
        <COLGROUP align="center" height="455px" style="color: #0a6fc2;"></COLGROUP>
        <COLGROUP align="center" height="455px" style="color: #0a6fc2;"></COLGROUP>
        <?php
        $i = 1;
        if ($doc == 4) {
            $sqlDet = "SELECT * FROM detalle_nota where invnum = '$venta' and canpro <> '0'";
        } else {
            $sqlDet = "SELECT * FROM detalle_venta where invnum = '$venta' and canpro <> '0'";
        }
        $resultDet = mysqli_query($conexion, $sqlDet);
        if (mysqli_num_rows($resultDet)) {
        ?>
            <tr>
                <th class="thra" style="width: 43px;">ITEM</th>
                <th class="thra" style="width: 43px;">CODIGO</th>
                <th class="thra" style="width: 48px;">CANT.</th>
                <th class="thra" style="width: 340px;">DESCRIPCION</th>
                <th class="thra" style="width: 74px;">U.M.</th>
                <th class="thra" style="width: 67px;">V. UNITA</th>
                <th class="thra" style="width: 64px;">P. UNITA</th>
                <th class="thra" style="width: 64px;">VALOR VENTA</th>
            </tr>
            <!-- </table>
                            
                            <TABLE class="table_2x"  style="border: 1px solid #00FF00; width: 100%;"  frame="hsides" rules="groups">-->


            <?php
            while ($row = mysqli_fetch_array($resultDet)) {
                $codpro = $row['codpro'];
                $canpro = $row['canpro'];
                $factor = $row['factor'];
                $prisal = $row['prisal'];
                $pripro = $row['pripro'];
                $fraccion = $row['fraccion'];
                $idlote = $row['idlote'];
                $factorP = 1;
                $sqlProd = "SELECT desprod,codmar,factor FROM producto where codpro = '$codpro'";
                $resultProd = mysqli_query($conexion, $sqlProd);
                if (mysqli_num_rows($resultProd)) {
                    while ($row1 = mysqli_fetch_array($resultProd)) {
                        $desprod = $row1['desprod'];
                        $codmar = $row1['codmar'];
                        $factorP = $row1['factor'];
                    }
                }
                if ($fraccion == "F") {
                    $cantemp = "C" . $canpro;
                } else {
                    if ($factorP == 1) {
                        $cantemp = $canpro;
                    } else {
                        $cantemp = "F" . $canpro;
                    }
                }
                $Cantidad = $canpro;
                $numlote = "......";
                $vencim = "";
                $sqlLote = "SELECT numlote,vencim FROM movlote where idlote = '$idlote'";
                $resulLote = mysqli_query($conexion, $sqlLote);
                // if (mysqli_num_rows($resulLote))
                //{
                //    while ($row1 = mysqli_fetch_array($resulLote))
                //    {
                //        $numlote    = $row1['numlote'];
                //       $vencim     = $row1['vencim'];
                //    }
                // }
                $sqlMarca = "SELECT ltdgen FROM titultabla where dsgen = 'MARCA'";
                $resultMarca = mysqli_query($conexion, $sqlMarca);
                if (mysqli_num_rows($resultMarca)) {
                    while ($row1 = mysqli_fetch_array($resultMarca)) {
                        $ltdgen = $row1['ltdgen'];
                    }
                }
                $marca = "";
                $sqlMarcaDet = "SELECT destab,abrev FROM titultabladet where codtab = '$codmar' and tiptab = '$ltdgen'";
                $resultMarcaDet = mysqli_query($conexion, $sqlMarcaDet);
                if (mysqli_num_rows($resultMarcaDet)) {
                    while ($row1 = mysqli_fetch_array($resultMarcaDet)) {
                        $marca = $row1['destab'];
                        $abrev = $row1['abrev'];
                        if ($abrev == '') {
                            $marca = substr($marca, 0, 4);
                        } else {
                            $marca = substr($abrev, 0, 4);
                        }
                    }
                }
                $producto = $desprod;
            ?>



                <tr>
                    <td width="40px" align="center">
                        <p><?php echo $i; ?></p>
                    </td>
                    <td width="40px" align="center">
                        <p><?php echo $codpro; ?></p>
                    </td>
                    <td width="50" align="center">
                        <p><?php echo $cantemp; ?></p>
                    </td>
                    <td width="350">
                        <p><?php echo $producto; ?></p>
                    </td>
                    <td width="60" align="center">
                        <p><?php echo 'UND'; ?></p>
                    </td>
                    <td width="60" align="center">
                        <p><?php echo number_format($pripro, 2, '.', ''); ?></p>
                    </td>
                    <td width="60" align="center">
                        <p><?php echo number_format($prisal, 2, '.', ''); ?></p>
                    </td>
                    <td width="60">
                        <p><?php echo number_format($prisal * $Cantidad, 2, '.', ''); ?></p>
                    </td>

                </tr>

            <?php
                $i++;
            }
            ?>
            <tr>
                <td width="40px" color="#fffff" align="center">&nbsp;</td>
                <td width="40px" align="center">&nbsp;</td>
                <td width="50" align="center">&nbsp;</td>
                <td width="350">&nbsp;</td>
                <td width="60" align="center">&nbsp;</td>
                <td width="60" align="center">&nbsp;</td>
                <td width="60" align="center">&nbsp;</td>
                <td width="60">&nbsp;</td>
            </tr>
            <tr>
                <td width="40px" color="#fffff" align="center">&nbsp;</td>
                <td width="40px" align="center">&nbsp;</td>
                <td width="50" align="center">&nbsp;</td>
                <td width="350">&nbsp;</td>
                <td width="60" align="center">&nbsp;</td>
                <td width="60" align="center">&nbsp;</td>
                <td width="60" align="center">&nbsp;</td>
                <td width="60">&nbsp;</td>
            </tr>
            <tr>
                <td width="40px" color="#fffff" align="center">&nbsp;</td>
                <td width="40px" align="center">&nbsp;</td>
                <td width="50" align="center">&nbsp;</td>
                <td width="350">&nbsp;</td>
                <td width="60" align="center">&nbsp;</td>
                <td width="60" align="center">&nbsp;</td>
                <td width="60" align="center">&nbsp;</td>
                <td width="60">&nbsp;</td>
            </tr>
            <tr>
                <td width="40px" color="#fffff" align="center">&nbsp;</td>
                <td width="40px" align="center">&nbsp;</td>
                <td width="50" align="center">&nbsp;</td>
                <td width="350">&nbsp;</td>
                <td width="60" align="center">&nbsp;</td>
                <td width="60" align="center">&nbsp;</td>
                <td width="60" align="center">&nbsp;</td>
                <td width="60">&nbsp;</td>
            </tr>
        <?php
        }
        //  mysqli_query($conexion, "UPDATE venta set gravado = '$SumGrabado',inafecto = '$SumInafectos' where invnum = '$venta'");
        ?>

    </table>
    <table class="table_1">
        <tr>
            <th class="thra1">OP. GRAVADA</th>
            <th class="thra1">OP. INAFECTA</th>
            <th class="thra1">OP. EXONERADA</th>
            <th class="thra1">IGV</th>
            <th class="thra1">IMPORTE TOTAL(S/)</th>
        </tr>
        <tr>
            <td class="tdra" align="right">
                <?php echo 'S/' . number_format($SumGrabado, 2, '.', ''); ?>
            </td>
            <td class="tdra" align="right"><?php echo 'S/' . number_format($SumInafectos, 2, '.', ''); ?></td>
            <td class="tdra" align="right"><?php echo 'S/ 0.00' ?></td>
            <td class="tdra" align="right"><?php echo 'S/' . $igv; ?></td>
            <td class="tdra" align="right"><?php echo $invtot; ?></td>
        </tr>
    </table>


    <table>
        <div class="div_end">
            <div class="f1x">
                <p class="letra">Son: <?php echo valorEnLetras($invtot); ?></p>
            </div>

        </div>
    </table>
    <?php
    echo pintaDatos($pie1);
    echo pintaDatos($pie2);
    echo pintaDatos($pie3);
    echo pintaDatos($pie4);
    echo pintaDatos($pie5);
    echo pintaDatos($pie6);
    echo pintaDatos($pie7);
    echo pintaDatos($pie8);
    echo pintaDatos($pie9);
    echo pintaDatos('N. I. -' . $venta);
    ?>
    <table>
        <div align="center">
            <?php
            if (($tipdoc == 1) || ($tipdoc == 2)) {
                QRcode::png($linea5 . '|' . $SerieQR . '|' . zero_fill($correlativo, 8) . '|' . $igv . '|' . $invtot . '|' . $invfec, $filename, $errorCorrectionLevel, $matrixPointSize, $framSize);
                echo '<img src="' . $PNG_WEB_DIR . basename($filename) . '" /><hr/>';
            }
            ?>
        </div>
    </table>

</section>