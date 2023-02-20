<?php include('../../session_user.php');
$invnum  = $_SESSION['transferencia_sal'];

function convertir_a_numero($str)
{
    $legalChars = "%[^0-9\-\. ]%";
    $str = preg_replace($legalChars, "", $str);
    return $str;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Documento sin t&iacute;tulo</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <link href="../../../css/style.css" rel="stylesheet" type="text/css" />
    <link href="../css/tablas.css" rel="stylesheet" type="text/css" />
    <?php require_once('../../../conexion.php');    //CONEXION A BASE DE DATOS
     require_once('../../../convertfecha.php');    //CONEXION A BASE DE DATOS
    require_once("../funciones/transferencia.php");    //FUNCIONES DE ESTA PANTALLA
    require_once("../../../funciones/highlight.php");    //ILUMINA CAJAS DE TEXTOS
    require_once("../../../funciones/functions.php");    //DESHABILITA TECLAS
    require_once("../../../funciones/funct_principal.php");    //IMPRIMIR-NUMEROS ENTEROS-DECIMALES
    $sql = "SELECT codloc FROM usuario where usecod = '$usuario'";
    $result = mysqli_query($conexion, $sql);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_array($result)) {
            $codloc    = $row['codloc'];
        }
    }
    $sql = "SELECT nomloc FROM xcompa where codloc = '$codloc'";
    $result = mysqli_query($conexion, $sql);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_array($result)) {
            $nomloc    = $row['nomloc'];
        }
    }
    require_once('../tabla_local.php');
    ?>
    

</head>

<body onload="fc()">
    <?php $sql = "SELECT count(*) FROM tempmovmov where invnum = '$invnum'";
    $result = mysqli_query($conexion, $sql);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_array($result)) {
            $count        = $row[0];
        }
    } else {
        $count = 0;
    }
    $sql = "SELECT * FROM tempmovmov where invnum = '$invnum' order by codtemp";
    $result = mysqli_query($conexion, $sql);
    if (mysqli_num_rows($result)) {
    ?>
        <form id="form1" name="form1" onKeyUp="highlight(event)" onClick="highlight(event)">
            
            <table class="celda2" width="939" border='0'>
                <tr>
                    <th width="5" bgcolor="#50ADEA" class="titulos_movimientos"> N</th>
                    <th width="35" bgcolor="#50ADEA" class="titulos_movimientos"> BONIF</th>
                    <th width="35" bgcolor="#50ADEA" class="titulos_movimientos"> CODIGO</th>
                    <th width="304" bgcolor="#50ADEA" class="titulos_movimientos">DESCRIPCION</th>
                     <th width="115" bgcolor="#50ADEA" class="titulos_movimientos">
                        <div align="center">MARCA</div>
                    </th>
                     <th width="30" bgcolor="#50ADEA" class="titulos_movimientos">FACTOR</th>
                    <th width="91" bgcolor="#50ADEA" class="titulos_movimientos">
                        <div align="center">LOCAL</div>
                    </th>
                    <th width="78" bgcolor="#50ADEA" class="titulos_movimientos">
                        <div align="center">STOCK ACTUAL</div>
                    </th>
                    <th colspan='3' width="81" bgcolor="#50ADEA" class="titulos_movimientos">
                        <div align="center">CANT - SALIDA</div>
                    </th>
                   
                    <th width="73" bgcolor="#50ADEA" class="titulos_movimientos">
                        <div align="center">P. PROM </div>
                    </th>
                    <th width="58" bgcolor="#50ADEA" class="titulos_movimientos">
                        <div align="center">SUB TOT</div>
                    </th>
                    <th width="64" bgcolor="#50ADEA" class="titulos_movimientos">&nbsp;</th>
                </tr>
                <?php $i = 0;
                while ($row = mysqli_fetch_array($result)) {
                    $i++;
                    $codtemp        = $row['codtemp'];
                    $codpro         = $row['codpro'];        //codgio
                    $qtypro         = $row['qtypro'];
                    $qtyprf         = $row['qtyprf'];
                    $desc1          = $row['desc1'];
                    $desc2          = $row['desc2'];
                    $desc3          = $row['desc3'];
                    $prisal         = $row['prisal'];
                    $pripro         = $row['pripro'];
                    $costre         = $row['costre'];
                    $sql1 = "SELECT porcent FROM datagen";
                    $result1 = mysqli_query($conexion, $sql1);
                    if (mysqli_num_rows($result1)) {
                        while ($row1 = mysqli_fetch_array($result1)) {
                            $porcent    = $row1['porcent'];
                        }
                    }
                    $sql1 = "SELECT desprod,codmar,factor,costpr,stopro,$tabla FROM producto where codpro = '$codpro'";
                    $result1 = mysqli_query($conexion, $sql1);
                    if (mysqli_num_rows($result1)) {
                        while ($row1 = mysqli_fetch_array($result1)) {
                            $desprod    = $row1['desprod'];
                            $codmar     = $row1['codmar'];
                            $factor     = $row1['factor'];
                            $costpr     = $row1['costpr'];  ///COSTO PROMEDIO
                            $stopro     = $row1['stopro'];    ///STOCK EN UNIDADES DEL PRODUCTO GENERAL
                            $cant_loc   = $row1[5];
                        }
                    }
                    $sql1 = "SELECT codpro FROM ventas_bonif_unid where codpro = '$codpro' and unid <> 0";
                    $result1 = mysqli_query($conexion, $sql1);
                    if (mysqli_num_rows($result1)) {
                        $bonif = 1;
                    } else {
                        $bonif = 0;
                    }
                    $sql1 = "SELECT ltdgen FROM titultabla where dsgen = 'MARCA'";
                    $result1 = mysqli_query($conexion, $sql1);
                    if (mysqli_num_rows($result1)) {
                        while ($row1 = mysqli_fetch_array($result1)) {
                            $ltdgen     = $row1['ltdgen'];
                        }
                    }
                    $sql1 = "SELECT destab FROM titultabladet where codtab = '$codmar' and tiptab = '$ltdgen'";

                    $result1 = mysqli_query($conexion, $sql1);
                    if (mysqli_num_rows($result1)) {
                        while ($row1 = mysqli_fetch_array($result1)) {
                            $marca     = $row1['destab'];
                        }
                    }
                    $valform = isset($_REQUEST['valform']) ? ($_REQUEST['valform']) : "";
                    $cod     = isset($_REQUEST['cod']) ? ($_REQUEST['cod']) : "";

                    if ($qtyprf <> "") {
                        $cantidad_solicitada =  convertir_a_numero($qtyprf);
                    } else {
                        $cantidad_solicitada = $qtypro * $factor;
                    }
                    if ($qtyprf <> "") {
                       $cantidad_solicitada =  convertir_a_numero($qtyprf);
                            $texto= stockcaja($cantidad_solicitada, $factor);
                } else {
                    
                    
                    $texto=stockcaja($qtypro, $factor);
            } 
                ?>

                    <tr <?php if (($cant_loc == '0') || ($cantidad_solicitada > $cant_loc)) {  ?> bgcolor='#f07878' <?php } ?>>
                        <td  valign="bottom"><?php echo $i; ?></td>
                        <td  valign="bottom">
                            <?php if ($bonif == 1) {
                            ?>
                                <div align="center"><img src="../../../images/tickg.gif" width="19" height="18" /></div>
                            <?php }
                            ?>
                        </td>
                        <td valign="bottom"><?php echo $codpro; ?></td>
                        <td  valign="bottom">
                            <a href="javascript:popUpWindow('ver_prod.php?cod=<?php echo $codpro ?>&invnum=<?php echo $invnum ?>', 435, 110, 560, 200)" title="EL FACTOR ES <?php echo $factor ?>"><?php echo $desprod ?> </a> </td>
                         <td width="115" valign="bottom"><?php echo substr($marca, 0, 10) ?></td>
                        <td  valign="bottom">
                            <div align="center"><?php echo $factor;  ?></div>
                        </td>
                        <td  valign="bottom"><?php echo $nomloc ?></td>
                        
                        <td  valign="bottom">
                            <div align="left"><?php echo stockcaja($cant_loc, $factor);  ?></div>
                        </td>
                       
                        <td width="81" valign="bottom">
                            <div align="right">
                                <?php if (($valform == 1) && ($cod == $codpro)) { ?>
                                    <input name="stock" type="hidden" id="stock" value="<?php echo $cant_loc ?>" />
                                    <input type="hidden" name="costpr" value="<?php echo $costpr; ?>" />
                                    <input type="hidden" name="stockpro" value="<?php echo $stopro; ?>" />
                                    <input type="hidden" name="factor" value="<?php echo $factor; ?>" />
                                    <input type="hidden" name="porcentaje" value="<?php if ($igv == 1) {
                                                                                        echo $porcent;
                                                                                    } ?>" />
                                    <input name="text1" type="text" class="input_text1" id="text1" value="<?php if ($qtyprf <> "") {
                                                                                                                echo $qtyprf;
                                                                                                            } else {
                                                                                                                echo $qtypro;
                                                                                                            } ?>" size="6" maxlength="6" onKeyPress="return f(event)" onkeyup="precio();" onkeyup="texto()"/>
                                <?php } else {
                                    if ($qtyprf <> "") {
                                        echo $qtyprf;
                                    } else {
                                        echo $qtypro;
                                    }
                                } ?></div>
                        </td>
                        <td width="8" valign="bottom">
                            <div align="center">
                             <a style='color:red;'> = </a>  
                                </div>
                        </td>
                        <td width="81" valign="bottom" bgcolor='#e3e3e3';>
                            <div align="left">
                               <?php echo $texto;  ?>
                                </div>
                        </td>
                        <td width="74" valign="bottom">
                            <div align="right">
                                <?php if (($valform == 1) && ($cod == $codpro)) { ?>
                                    <input name="text2" type="text" id="text2" size="6" class="pvta" value="<?php echo $costpr ?>" onclick="blur()" />
                                <?php } else {
                                    echo $costpr;
                                } ?></div>
                        </td>
                        <td width="59" valign="bottom">
                            <div align="right">
                                <?php if (($valform == 1) && ($cod == $codpro)) { ?>
                                    <input name="text3" type="text" id="text3" size="6" class="pvta" value="<?php echo $costre ?>" onclick="blur()" />
                                <?php } else {
                                    echo $costre;
                                } ?></div>
                        </td>
                        <td width="61" valign="bottom">
                            <div align="center">
                                <!--a href="javascript:popUpWindow('lote/lote.php?cod=<?php echo $codpro ?>', 435, 110, 560, 200)" title="LOTE DE PRODUCTOS"><img src="../../../images/add.gif" width="14" height="15" border="0" title="LOTE DE PRODUCTOS"/></a-->
                                <?php if (($valform == 1) && ($cod == $codpro)) { ?>
                                    <input name="number" type="hidden" id="number" />
                                    <input name="codtemp" type="hidden" id="codtemp" value="<?php echo $codtemp ?>" />
                                    <input type="button" id="boton" onClick="validar_prod()" alt="GUARDAR" />
                                    <input type="button" id="boton1" onClick="validar_grid()" alt="ACEPTAR" />
                                <?php } else { ?>
                                    <a href="transferencia3_sal.php?cod=<?php echo $codpro ?>&valform=1"><img src="../../../images/edit_16.png" width="16" height="16" border="0" /></a>
                                    <a href="transferencia4_sal.php?cod=<?php echo $codtemp ?>" target="tranf_principal"><img src="../../../images/del_16.png" width="16" height="16" border="0" /></a>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>

                <?php }
                ?>
            </table>
        <?php } else {
        ?>
            <br><br><br><br><br><br><br><br>
            <center>NO SE HAN AGREGADO PRODUCTOS A ESTE DOCUMENTO</center>
        <?php }
        ?>
        </form>
</body>

</html>