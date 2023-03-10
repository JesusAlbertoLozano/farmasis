<?php
//require_once('fpdf/fpdf.php');
include('../session_user.php');
require_once('../../conexion.php'); //CONEXION A BASE DE DATOS
require_once('../../titulo_sist.php');
require_once('../../convertfecha.php'); //CONEXION A BASE DE DATOS

require_once('../phpqrcode/qrlib.php');
require_once('../movimientos/ventas/calcula_monto2.php');
require_once('MontosText.php');
$venta = $_REQUEST['venta'];
$doc = $_REQUEST['doc'];

function pintaDatos($Valor)
{
    if ($Valor <> "") {
        return "<tr><td style:'text-align:center' ><center>" . $Valor . "</center></td></tr>";
    }
}

function zero_fill($valor, $long = 0)
{
    return str_pad($valor, $long, '0', STR_PAD_LEFT);
}
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script>
        function imprimir() {
            //alert("consult_compras1.php?pageno=<?php echo $pag ?>&numero=<?php echo $numerox ?>");
            var f = document.form1;
            window.print();
            self.close();
            <?php
            // echo "parent.opener.location='reg_venta1.php';";
            ?>
            //f.action = "ingresos_varios.php";
            //f.method = "post";
            //f.submit();
        }
    </script>

    <style>
        body {
            font-family: "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
        }

        section {
            padding: 5px;
            border: 2px solid #0a6fc2;
            width: 99%;
            border-radius: 15px;
        }

        .bodyy {

            /*    border: 2px solid #0a6fc2;*/
            overflow: hidden;
            width: 75%;
            height: 10%;
            margin-bottom: 10px;
            height: 165px;
        }

        .title22 {
            text-align: center;
            font-size: 75%;

        }

        .title {
            text-align: left;
            float: left;
            width: 265px;
            font-size: 75%;
            height: 95%;
            margin-left: -5px;
            /*    border: 1px solid #0a6fc2;*/
        }

        .title2 {

            float: left;
            width: 30%;
            height: 95%;
            /*   border: 1px solid #0a6fc2;*/
            margin-left: -1px;

        }

        .div_ruc {
            float: right;
            width: 30%;
            height: 75px;
            border: 2px solid #0a6fc2;
            border-radius: 10px;
            margin-top: 25px;
            margin-right: 5px;
            text-align: center;

        }

        .title_div {
            display: flex;

            /*background: #930;*/
            padding: 15px;
            overflow: hidden;
            margin-bottom: -70px;
            width: 100%;
            height: 150px;

        }

        .data_cliente {
            /* float: left;*/
            width: 99%;
            border: 1px solid#0a6fc2;
            /* border-radius: 5px;
                 padding: 5px 12px;*/
            margin-left: -13px;
            /*border-radius: 15px;*/
        }

        .data_cliente2 {
            width: 90%;
            padding: 6px 20px;

        }

        .div_ruc p {
            font-size: 16px;
        }

        .boleta22 {

            border: solid 1px #000000;
        }

        .letracabe {
            font-size: 13px;
        }

        .letra {
            font-size: 18px;
        }

        .letra2 {
            font-size: 22px;
        }

        .table_1,
        p {
            margin: 1px;
            font-size: 87.5%;
        }

        .table_cabe,
        p {
            margin: 1px;
            font-size: 87.5%;
        }

        .table_2,
        p {
            margin: 1px;
            font-size: 87.5%;

        }

        .table_cabe {

            width: 100%;

            border-collapse: collapse;
            border: none;
        }

        .table_1 {

            width: 100%;

            border-collapse: collapse;
            border: none;
        }

        /*
            .table_1 th, td{
                
                border: 1px solid #000;
               padding: 5px;
               border: 1.5px solid #0a6fc2;
            }
            .table_2 th, td{
                
                border: 1px solid #000;
               padding: 5px;
               border: 1.5px solid #0a6fc2;
            }
            .table_2X th, td{
                
               border: 1px solid #000;
               padding: 5px;
               border: 1.5px solid #0a6fc2;
            }
            */

        .tdra {

            border: 1px solid #000;
            /* padding: 5px;*/
            font-size: 9px;
            border: 1.5px solid #0a6fc2;
        }

        .thra1 {

            border: 1px solid #000;
            padding: 3px;
            font-weight: 900;
            border: 1.5px solid #0a6fc2;
        }

        .thra1cabe {

            font-weight: 900;
            /*border: 1.5px solid #0a6fc2;*/
        }

        .tdracabe {

            border: 1px solid #000;
            /* padding: 5px;*/
            font-size: 9px;
            border: 1.5px solid #ffffff;
        }

        .thra {

            border: 1px solid #000;
            padding: 5px;
            border: 1.5px solid #0a6fc2;
        }

        .table_cabe th:first-child {
            font-size: 9px;
            width: 10%;
        }

        .table_cabe th:nth-child(2) {
            font-size: 9px;
            width: 20%;
        }

        .table_cabe th:nth-child(3) {
            font-size: 9px;
            width: 10%;
        }

        .table_cabe th:nth-child(4) {
            font-size: 9px;
            width: 20%;
        }

        .table_cabe td:first-child {
            width: 20%;
            font-size: 9px;
        }

        .table_cabe td:nth-child(2) {
            width: 20%;
            font-size: 9px;
        }

        .table_cabe td:nth-child(3) {
            width: 20%;
            font-size: 9px;
        }

        .table_cabe td:last-child(4) {
            width: 20%;
            font-size: 9px;
        }


        .table_1 th:first-child {
            font-size: 9px;
            width: 20%;
        }

        .table_1 th:nth-child(2) {
            font-size: 9px;
            width: 20%;
        }

        .table_1 th:nth-child(3) {
            font-size: 9px;
            width: 20%;
        }

        .table_1 th:nth-child(4) {
            font-size: 9px;
            width: 20%;
        }

        .table_1 th:nth-child(5) {
            font-size: 9px;
            width: 20%;
        }

        .table_1 td:first-child {
            width: 20%;
            font-size: 9px;
        }

        .table_1 td:nth-child(2) {
            width: 20%;
            font-size: 9px;
        }

        .table_1 td:nth-child(3) {
            width: 20%;
            font-size: 9px;
        }

        .table_1 td:last-child(4) {
            width: 20%;
            font-size: 9px;
        }

        .table_1 td:last-child(5) {
            width: 20%;
            font-size: 9px;
        }

        .table_2 {
            width: 100%;
            border-collapse: collapse;
            border: none;

        }

        .table_2 th {
            font-size: 14px;
            background: black;
            color: white;
        }

        .table_2x {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }

        .table_2x td:first-child {
            width: 50px;
            height: 55px;
            font-size: 11px;

        }

        .table_2x td:nth-child(2) {
            width: 50px;

            font-size: 11px;
        }

        .table_2x td:nth-child(3) {

            width: 200px;

            font-size: 11px;
        }

        .table_2x td:nth-child(4) {
            width: 80px;

            font-size: 11px;
        }

        .table_2x td:nth-child(5) {
            width: 80px;

            font-size: 11px;
        }

        .table_2x td:nth-child(6) {
            width: 70px;

            font-size: 11px;
        }

        .table_2x td:nth-child(7) {
            width: 70px;

            font-size: 11px;
        }

        .table_2x td:nth-child(8) {
            width: 70px;

            font-size: 11px;
        }

        .table_2 th:first-child {
            background: black;
            color: white;
            font-size: 1em;
        }

        .table_2 th:nth-child(2) {
            background: black;
            color: white;
            font-size: 1em;
        }

        .table_2 th:nth-child(3) {
            background: black;
            color: white;
            font-size: 1em;
        }

        .table_2 th:nth-child(4) {
            background: black;
            color: white;
            font-size: 1em;
        }

        .table_2 th:nth-child(5) {
            background: black;
            color: white;
            font-size: 1em;
        }

        .table_2 th:nth-child(6) {
            background: black;
            color: white;
            font-size: 1em;
        }

        .table_2 th:nth-child(7) {
            background: black;
            color: white;
            font-size: 1em;
        }

        .table_2 th:nth-child(8) {
            background: black;
            color: white;
            font-size: 1em;
        }

        /*
            .div_end{
                display: grid;
                grid-template-columns: 34% 22% 22% 22%;
                width: 90%;: 800px;
                color:#e03232;
                font-size: 14px;
            }
            .div_end p{
                font-weight: 700;
            }*/


        .div_end {

            padding: 10px;
            overflow: hidden;
            margin-bottom: 10px;
            width: 100%;
            height: 50px;
        }

        .f1 {
            float: left;


        }

        .f3 {
            float: left;
            width: 15%;

            margin-right: 5px;
        }

        .f4 {

            float: left;
            width: 20%;



        }

        .money {
            font-weight: 800;
            padding-left: 65%;
        }

        .money2 {
            border: 1px solid #0a6fc2;
            font-weight: 800;
            /*    padding-left: 65%;*/
            margin-left: 6px;
            margin-bottom: 6px;
        }



        .table_T {
            line-height: 100%;
            font-family: times;
            font-size: 11px;
            font-weight: normal;
        }

        .table_T2 {
            line-height: 100%;
            font-family: times;
            font-size: 11px;
            font-weight: normal;
        }
    </style>
</head>

<?php

function cambiarFormatoFecha($fecha)
{
    list($anio, $mes, $dia) = explode("-", $fecha);
    return $dia . "/" . $mes . "/" . $anio;
}

$PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . '../movimientos/ventas/temp' . DIRECTORY_SEPARATOR;

$PNG_WEB_DIR = '../movimientos/ventas/temp/';

$filename = $PNG_TEMP_DIR . 'ventas.png';
$matrixPointSize = 3;
$errorCorrectionLevel = 'L';
$framSize = 3; //Tama?????o en blanco
$seriebol = "B001";
$seriefac = "F001";
$serietic = "T001";
$filename = $PNG_TEMP_DIR . 'test' . $venta . md5($_REQUEST['data'] . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';



if ($doc == 4) {
    $sqlV = "SELECT invnum,nrovent,invfec,invfec,cuscod,usecod,codven,forpag,fecven,sucursal,correlativo,nomcliente,pagacon,vuelto,bruto,hora,invtot,igv,valven,tipdoc,tipteclaimpresa,anotacion,nrofactura,val_habil,serie_doc,fecha_old FROM nota where invnum = '$venta'";
} else {
    $sqlV = "SELECT invnum,nrovent,invfec,invfec,cuscod,usecod,codven,forpag,fecven,sucursal,correlativo,nomcliente,pagacon,vuelto,bruto,hora,invtot,igv,valven,tipdoc,tipteclaimpresa,anotacion,nrofactura,val_habil FROM venta where invnum = '$venta'";
}
$resultV = mysqli_query($conexion, $sqlV);
if (mysqli_num_rows($resultV)) {
    while ($row = mysqli_fetch_array($resultV)) {
        $invnum = $row['invnum'];
        $nrovent = $row['nrovent'];
        $invfec = cambiarFormatoFecha($row['invfec']);
        $cuscod = $row['cuscod'];
        $usecod = $row['usecod'];
        $codven = $row['codven'];
        $forpag = $row['forpag'];
        $fecven = $row['fecven'];
        $sucursal = $row['sucursal'];
        $correlativo = $row['correlativo'];
        $nomcliente = $row['nomcliente'];
        $pagacon = $row['pagacon'];
        $vuelto = $row['vuelto'];
        $valven = $row['valven'];
        $igv = $row['igv'];
        $invtot = $row['invtot'];
        $hora = $row['hora'];
        $tipdoc = $row['tipdoc'];
        $tipteclaimpresa = $row['tipteclaimpresa'];
        $anotacion = $row['anotacion'];
        $nrofactura = $row['nrofactura'];
        $val_habil = $row['val_habil'];
        $serie_doc = $row['serie_doc'];
        $fecha_old = cambiarFormatoFecha($row['fecha_old']);


        $docafectado = $serie_doc . " FECHA :" . $fecha_old;

        $sqlXCOM = "SELECT seriebol,seriefac,serietic FROM xcompa where codloc = '$sucursal'";
        $resultXCOM = mysqli_query($conexion, $sqlXCOM);
        if (mysqli_num_rows($resultXCOM)) {
            while ($row = mysqli_fetch_array($resultXCOM)) {
                $seriebol = $row['seriebol'];
                $seriefac = $row['seriefac'];
                $serietic = $row['serietic'];
            }
        }
    }
}


$sqlUsu = "SELECT logo FROM xcompa where codloc = '$sucursal'";
$resultUsu = mysqli_query($conexion, $sqlUsu);
if (mysqli_num_rows($resultUsu)) {
    while ($row = mysqli_fetch_array($resultUsu)) {
        $logo = $row['logo'];
    }
}
if ($forpag == "E") {
    $forma = "EFECTIVO";
}
if ($forpag == "C") {
    $forma = "CREDITO";
}
if ($forpag == "T") {
    $forma = "TARJETA";
}
if ($tipdoc == 6) {
    $serie = "C" . $serienot;
}
//F9
if ($tipteclaimpresa == "2") {
    if ($tipdoc == 1) {
        $serie = "F" . $seriefac;
    }
    if ($tipdoc == 2) {
        $serie = "B" . $seriebol;
    }
    if ($tipdoc == 4) {
        $serie = "T" . $serietic;
    }
} else { //F8
    $serie = $correlativo;
}

if ($tipdoc == 1) {
    $TextDoc = "Factura electronica";
}
if ($tipdoc == 2) {
    $TextDoc = "Boleta de Venta electronica";
}
if ($tipdoc == 4) {
    $TextDoc = "";
}
if ($tipdoc == 6) {
    $TextDoc = "Nota de credito";
}
$SerieQR = $serie;
//TOMO LOS PATRAMETROS DEL TICKET
$sqlTicket = "SELECT linea1,linea2,linea3,linea4,linea5,linea6,linea7,linea8,linea9,pie1,pie2,pie3,pie4,pie5,pie6,pie7,pie8,pie9 "
    . "FROM ticket where sucursal = '$sucursal'";
$resultTicket = mysqli_query($conexion, $sqlTicket);
if (mysqli_num_rows($resultTicket)) {
    while ($row = mysqli_fetch_array($resultTicket)) {
        $linea1 = $row['linea1'];
        $linea2 = $row['linea2'];
        $linea3 = $row['linea3'];
        $linea4 = $row['linea4'];
        $linea5 = $row['linea5'];
        $linea6 = $row['linea6'];
        $linea7 = $row['linea7'];
        $linea8 = $row['linea8'];
        $linea9 = $row['linea9'];
        $pie1 = $row['pie1'];
        $pie2 = $row['pie2'];
        $pie3 = $row['pie3'];
        $pie4 = $row['pie4'];
        $pie5 = $row['pie5'];
        $pie6 = $row['pie6'];
        $pie7 = $row['pie7'];
        $pie8 = $row['pie8'];
        $pie9 = $row['pie9'];
    }
} else {
    $sqlTicket = "SELECT linea1,linea2,linea3,linea4,linea5,linea6,linea7,linea8,linea9,pie1,pie2,pie3,pie4,pie5,pie6,pie7,pie8,pie9 "
        . "FROM ticket where sucursal = '1'";
    $resultTicket = mysqli_query($conexion, $sqlTicket);
    if (mysqli_num_rows($resultTicket)) {
        while ($row = mysqli_fetch_array($resultTicket)) {
            $linea1 = $row['linea1'];
            $linea2 = $row['linea2'];
            $linea3 = $row['linea3'];
            $linea4 = $row['linea4'];
            $linea5 = $row['linea5'];
            $linea6 = $row['linea6'];
            $linea7 = $row['linea7'];
            $linea8 = $row['linea8'];
            $linea9 = $row['linea9'];
            $pie1 = $row['pie1'];
            $pie2 = $row['pie2'];
            $pie3 = $row['pie3'];
            $pie4 = $row['pie4'];
            $pie5 = $row['pie5'];
            $pie6 = $row['pie6'];
            $pie7 = $row['pie7'];
            $pie8 = $row['pie8'];
            $pie9 = $row['pie9'];
        }
    }
}
$sqlUsu = "SELECT nomusu,abrev FROM usuario where usecod = '$usecod'";
$resultUsu = mysqli_query($conexion, $sqlUsu);
if (mysqli_num_rows($resultUsu)) {
    while ($row = mysqli_fetch_array($resultUsu)) {
        $nomusu2 = $row['abrev'];
        $nomusu = $row['nomusu'];
    }
}

$MarcaImpresion = 0;
$sqlDataGen = "SELECT desemp,rucemp,telefonoemp,MarcaImpresion FROM datagen";
$resultDataGen = mysqli_query($conexion, $sqlDataGen);
if (mysqli_num_rows($resultDataGen)) {
    while ($row = mysqli_fetch_array($resultDataGen)) {
        $desemp = $row['desemp'];
        $rucemp = $row['rucemp'];
        $telefonoemp = $row['telefonoemp'];
        $MarcaImpresion = $row["MarcaImpresion"];
    }
}
$departamento = "";
$provincia = "";
$distrito = "";
$pstcli = 0;
$sqlCli = "SELECT descli,dircli,ruccli,dptcli,procli,discli,puntos,dnicli FROM cliente where codcli = '$cuscod'";
$resultCli = mysqli_query($conexion, $sqlCli);
if (mysqli_num_rows($resultCli)) {
    while ($row = mysqli_fetch_array($resultCli)) {
        $descli = $row['descli'];
        $dnicli = $row['dnicli'];
        $dircli = $row['dircli'];
        $ruccli = $row['ruccli'];
        $dptcli = $row['dptcli'];
        $procli = $row['procli'];
        $discli = $row['discli'];
        $pstcli = $row['puntos'];
    }
    if (strlen($dircli) > 0) {
        //VERIFICO LOS DPTO, PROV Y DIST
        if (strlen($dptcli) > 0) {
            //                $sqlDPTO = "SELECT destab FROM titultabladet where codtab = '$dptcli'";
            $sqlDPTO = "SELECT name FROM departamento where id = '$dptcli'";
            $resultDPTO = mysqli_query($conexion, $sqlDPTO);
            if (mysqli_num_rows($resultDPTO)) {
                while ($row = mysqli_fetch_array($resultDPTO)) {
                    $departamento = $row['name'];
                }
            }
        }
        if (strlen($procli) > 0) {
            $sqlDPTO = "SELECT name FROM provincia where id = '$procli'";
            $resultDPTO = mysqli_query($conexion, $sqlDPTO);
            if (mysqli_num_rows($resultDPTO)) {
                while ($row = mysqli_fetch_array($resultDPTO)) {
                    $provincia = " | " . $row['name'];
                }
            }
        }

        if (strlen($discli) > 0) {
            $sqlDPTO = "SELECT name FROM distrito where id = '$discli'";
            $resultDPTO = mysqli_query($conexion, $sqlDPTO);
            if (mysqli_num_rows($resultDPTO)) {
                while ($row = mysqli_fetch_array($resultDPTO)) {
                    $distrito = " | " . $row['name'];
                }
            }
        }
        $Ubigeo = $departamento . $provincia . $distrito;
        if (strlen($Ubigeo) > 0) {
            $dircli = $dircli . "  - " . $Ubigeo;
        }
    }
}
$SumInafectos = 0;
if ($doc == 4) {
    $sqlDetTot = "SELECT * FROM detalle_nota where invnum = '$venta'";
} else {
    $sqlDetTot = "SELECT * FROM detalle_venta where invnum = '$venta' and canpro <> '0'";
}
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
        }
    }
}
$SumGrabado = $invtot - ($igv + $SumInafectos);


if ($val_habil == 1) {
    $anulado = "ANULADO";
}
?>

<body onload="imprimir()">



    <form name="form1" id="form1" style="width: 100%">


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

                    <p style="text-align: left"><?php echo pintaDatos($pie6); ?></p>

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
            
            <?php if($tipdoc ==1){ ?>
    <br><br>
    <?php }?>

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
                        $sqlProd = "SELECT desprod,codmar,factor FROM producto where codpro = '$codpro' and eliminado='0'";
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
                        <p class="letra">Son: <?php echo numtoletras($invtot); ?></p>
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
                      $ven_cifrado = password_hash($linea5 . '|' . $SerieQR . '|' . zero_fill($correlativo, 8) . '|' . $igv . '|' . $invtot . '|' . $invfec, PASSWORD_DEFAULT);
                    ?>
                        <pre> Codigo Hash</pre>

            <div style="width:80%;height:380px;border: 1px; ">
                <DIV style="width:100%; word-wrap: break-word;font-size: 70%;">
                    <?php echo  $ven_cifrado;   ?>
                </DIV>
            </div>
                <?php    }
                    ?>
                </div>
            </table>

        </section>

    </form>



</body>

</html>