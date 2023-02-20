<?php 
include('../../session_user.php');
require_once ('../../../conexion.php');
$CCompra = $_REQUEST['Compra'];
?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252"> 
<script>
function imprimir()
{
    var f = document.form1;
    window.print();
    f.action = "../ing_salid.php";
    f.method = "post";
    f.submit();
}
</script>
<style>
    body, table
    {
        font-size:12px;
        /*font-weight: bold;*/
    }
</style>
</head>
<body onload="imprimir()">
    <form name="form1" id="form1">
    <?php 
    function cambiarFormatoFecha($fecha)
    {
        list($anio,$mes,$dia) = explode("-",$fecha);
        return $dia."-".$mes."-".$anio;
    }
    $HoraActual = DATE("H:i");
    $Usuario    = "";
    $Sucursal   = "";
    $Proveedor  = "";
    $sqlCompras = "SELECT numdoc,invfec,usecod,sucursal,cuscod,forpag,numero_documento,numero_documento1,incluidoIGV,plazo,fecven,invtot,igv,valven,destot,costo,empresa FROM movmae where invnum = '$CCompra'";
    $resultCompras = mysqli_query($conexion, $sqlCompras);
    if (mysqli_num_rows($resultCompras)) 
    {
        while ($row = mysqli_fetch_array($resultCompras))
        {
            $numdoc     = $row['numdoc'];
            $invfec     = $row['invfec'];
            $usecod     = $row['usecod'];
            $sucursal   = $row['sucursal'];
            $cuscod     = $row['cuscod'];
            $forpag     = $row['forpag'];
            $numdocD1     = $row['numero_documento'];
            $numdocD2    = $row['numero_documento1'];
            $incluidoIGV= $row['incluidoIGV'];
            $plazo      = $row['plazo'];
            $fecven     = $row['fecven'];
            $invtot     = $row['invtot'];
            $igv        = $row['igv'];
            $valven     = $row['valven'];
            $destot     = $row['destot'];
            $costo      = $row['costo'];
            $empresa      = $row['empresa'];
            if ($incluidoIGV == 1)
            {
                $incluidoIGV = "SI";
            }
            else
            {
                $incluidoIGV = "NO";
            }
            $sqlUsu     = "SELECT nomusu FROM usuario where usecod = '$usecod'";
            $resultUsu = mysqli_query($conexion, $sqlUsu);
            if (mysqli_num_rows($resultUsu)) 
            {
                while ($row = mysqli_fetch_array($resultUsu))
                {
                    $Usuario     = $row['nomusu'];
                }
            }
            $sqlProv     = "SELECT despro FROM proveedor where codpro = '$cuscod'";
            $resultProv  = mysqli_query($conexion, $sqlProv);
            if (mysqli_num_rows($resultProv)) 
            {
                while ($row = mysqli_fetch_array($resultProv))
                {
                    $Proveedor     = $row['despro'];
                }
            }
            $sqlProv     = "SELECT destab FROM titultabladet where tiptab = 'EMP'  and codtab = '$empresa'";
            $resultProv  = mysqli_query($conexion, $sqlProv);
            if (mysqli_num_rows($resultProv)) 
            {
                while ($row = mysqli_fetch_array($resultProv))
                {
                    $destab_empresa     = $row['destab'];
                }
            }
            $sqlSuc     = "SELECT nomloc FROM xcompa where codloc = '$sucursal'";
            $resultSuc = mysqli_query($conexion, $sqlSuc);
            if (mysqli_num_rows($resultSuc)) 
            {
                while ($row = mysqli_fetch_array($resultSuc))
                {
                    $Sucursal     = $row['nomloc'];
                }
            }
        }
    ?>
        <table style="width: 100%">
            <tr>
                <th style="text-align:left">Tipo de Movimiento</th>
                <td colspan="9">COMPRAS</td>
            </tr>
            <tr>
                <th style="text-align:left">N°</th>
                <td><?php echo $numdoc;?></td>  <!--numdoc-->
                <th style="text-align:left">Fecha</th>
                <td><?php echo $invfec;?></td>
                <th style="text-align:left">Hora</th>
                <td><?php echo $HoraActual;?></td>
                <th style="text-align:left">Res</th>
                <td><?php echo $Usuario;?></td>
                <th style="text-align:left">Local</th>
                <td><?php echo $Sucursal;?></td>
            </tr>
            <tr>
                <th style="text-align:left">Proveedor</th>
                <td colspan="3"><?php echo $Proveedor;?></td>
                <th style="text-align:left">Forma de Pago</th>
                <td><?php echo $forpag;?></td>
                <th style="text-align:left">Días</th>
                <td><?php echo $plazo;?></td>
                <th style="text-align:left">Fecha de Pago</th>
                <td><?php echo $fecven;?></td>
            </tr>
            <tr>
                <th style="text-align:left">Empresa</th>
                <td><?php echo $destab_empresa;?></td>
                <th style="text-align:left">Tipo y Número de Documento</th>
                <td><?php echo $numdocD1.'-'.$numdocD2;?></td>
                <th style="text-align:left">Precio Incluído (o no incluído)</th>
                <td colspan="5"><?php echo $incluidoIGV;?></td>
            </tr>
        </table>
        <br>
        <?php 
        //Agregado Adrian
        $sqlComprasMov = "SELECT qtypro,qtyprf,codpro,prisal,desc1,desc2,desc3,pripro,costre FROM movmov where invnum = '$CCompra'";
        $resultComprasMov = mysqli_query($conexion, $sqlComprasMov);
        if (mysqli_num_rows($resultComprasMov)) 
        {
        ?>
        <hr>
        <hr>
        <table style="width: 100%">
            <tr>
                <th style="text-align:left">Cantidad</th>
                <th style="text-align:left">Codigo</th>
                <th style="text-align:right">Producto</th>
                <th style="text-align:left">Marca</th>
                <th style="text-align:right">Pre Compra</th>
                <th style="text-align:right">Dcto 1</th>
                <th style="text-align:right">Dcto 2</th>
                <th style="text-align:right">Dcto 3</th>
                <th style="text-align:right">Precio Neto</th>
                <th style="text-align:right">Sub Total</th>
            </tr>
        <?php
            $arraymovmov =array();
            while ($row = mysqli_fetch_array($resultComprasMov))
            {
                array_push($arraymovmov, $row);
            }
            array_reverse($arraymovmov);
            $i = count($arraymovmov)-1;
            while ($i >= 0)
            {
                $row = $arraymovmov[$i];
                //Agregado Adrian
                $qtypro     = ($row['qtypro'] <= 0) ? $row['qtyprf'] : $row['qtypro'];
                $codpro     = $row['codpro'];
                $prisal     = $row['prisal'];
                $desc1      = $row['desc1'];
                $desc2      = $row['desc2'];
                $desc3      = $row['desc3'];
                $pripro     = $row['pripro'];
                $costre     = $row['costre'];
                $Producto   = "";
                $Marca      = "";
                $sqlProd    = "SELECT P.desprod,M.destab,M.abrev FROM producto P LEFT JOIN titultabladet M ON M.codtab = P.codmar WHERE  P.codpro = '$codpro'";
                $resultProd = mysqli_query($conexion, $sqlProd);
                if (mysqli_num_rows($resultProd)) 
                {
                    while ($row = mysqli_fetch_array($resultProd))
                    {
                        $Producto     = $row['desprod'];
                        $Marca        = $row['destab'];
                        $abrev        = $row['abrev'];
                    }
                }
            ?>
            <tr>
                <td><?php echo $qtypro;?></td>
                <td><?php echo $codpro;?></td>
                <td style="text-align: right;"><?php echo $Producto;?></td>
                <td><?php echo $abrev;?></td>
                <td style="text-align: right;"><?php echo $prisal;?></td>
                <td style="text-align: right;"><?php echo $desc1;?></td>
                <td style="text-align: right;"><?php echo $desc2;?></td>
                <td style="text-align: right;"><?php echo $desc3;?></td>
                <td style="text-align: right;"><?php echo $pripro;?></td>
                <td style="text-align: right;"><?php echo $costre;?></td>
            </tr>
            <?php
            $i--;
            }
        ?>
        </table>
        <?php
        }
        ?>
        <br>
        <table style="width: 100%">
            <tr>
                <td>Valor Afecto</td>
                <td></td>
                <td>Inafecto</td>
                <td></td>
                <td>IGV</td>
                <td style="text-align: right;"><?php echo $igv;?></td>
                <td>Neto a Pagar</td>
                <td style="text-align: right;"><?php echo $invtot;?></td>
            </tr>
        </table>
    <?php 
    }
    ?>
    </form>
</body>
</html>