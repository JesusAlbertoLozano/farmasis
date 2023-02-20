<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

include('../../session_user.php');

$invnum     = $_SESSION['compras'];
$ckigv      = $_REQUEST['ckigv'];
$busca_prov = $_REQUEST['busca_prov'];
$busca_empre = $_REQUEST['busca_empre'];

//$costo	  = $_REQUEST['costo'];//text2
//$pigv	  = $_REQUEST['pigv'];//pigv
//$desc1	  = $_REQUEST['desc1'];//text3
//$desc2	  = $_REQUEST['desc2'];//text4
//$desc3	  = $_REQUEST['desc3'];//text5
//$text1	  = $_REQUEST['text1'];//text1

$text1     = isset($_REQUEST['text1']) ? ($_REQUEST['text1']) : "";
$costo     = isset($_REQUEST['text2']) ? ($_REQUEST['text2']) : "";
$desc1     = isset($_REQUEST['text3']) ? ($_REQUEST['text3']) : "";
$desc2     = isset($_REQUEST['text4']) ? ($_REQUEST['text4']) : "";
$desc3     = isset($_REQUEST['text5']) ? ($_REQUEST['text5']) : "";
$pigv     = isset($_REQUEST['pigv']) ? ($_REQUEST['pigv']) : "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Documento sin t&iacute;tulo</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <link href="../../../css/style.css" rel="stylesheet" type="text/css" />
    <link href="../css2/tablas.css" rel="stylesheet" type="text/css" />
    <link href="../../../css/autocomplete.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../../../funciones/ajax.js"></script>
    <script type="text/javascript" src="../../../funciones/ajax-dynamic-list.js"></script>
    <?php
    //require_once("../funciones/compras.php");	//FUNCIONES DE ESTA PANTALLA
    //require_once("ajax_compras.php");	//FUNCIONES DE AJAX PARA COMPRAS Y SUMAR FECHAS
    //require_once("../../local.php");	//LOCAL DEL USUARIO
    ?>
    <script>
        function cerrar(e) {
            tecla = e.keyCode
            if (tecla == 27) {
                document.form1.submit();
            }
        }

        var nav4 = window.Event ? true : false;

        function ent(evt) {
            var key = nav4 ? evt.which : evt.keyCode;
            if (key == 13) {
                var f = document.form1;
                var v1 = parseFloat(document.form1.text1.value); //CANTIDAD
                var valor = isNaN(v1);
                if (valor == true) {
                    document.form1.number.value = 1; ////avisa que no es numero
                } else {
                    document.form1.number.value = 0; ////avisa que es numero
                }
                var fa = parseFloat(document.form1.factor.value); //CANTIDAD
                if ((f.text1.value == "") || (f.text1.value == "0")) {
                    alert("Ingrese una Cantidad");
                    f.text1.focus();
                    return;
                }
                if ((f.text2.value == "") || (f.text2.value == "0.00")) {
                    alert("Ingrese el Precio");
                    f.text2.focus();
                    return;
                }


                if (document.form1.lotee.value == 1) {
                    if (f.countryL.value == "") {
                        alert("Ingrese el Numero de Lote");
                        f.countryL.focus();
                        return;
                    }
                    if (f.mesL.value == "") {
                        alert("Ingrese el Mes");
                        f.mesL.focus();
                        return;
                    }
                    if (f.yearsL.value == "") {
                        alert("Ingrese el A�o");
                        f.yearsL.focus();
                        return;
                    }
                    var cadena = f.yearsL.value;
                    var cadena_mes = f.mesL.value;
                    var longitud = cadena.length;
                    if (f.mesL.value > 12) {
                        alert("Ingrese un Mes valido");
                        f.mesL.focus();
                        return;
                    }
                    if (longitud < 3) {
                        alert("Ingrese un A�o valido1");
                        f.yearsL.focus();
                        return;
                    }
                    var fecha = new Date();
                    var ano = fecha.getFullYear();
                    var mess = fecha.getMonth() + 1;
                    cadena = parseInt(cadena);
                    cadena_mes = parseInt(cadena_mes);
                    ano = parseInt(ano);
                    mess = parseInt(mess);
                    if (ano > cadena) {
                        alert("Ingrese un A�o posterior al A�o Actual");
                        f.years.focus();
                        return;
                    } else {
                        if (ano == cadena) {
                            if (mess > cadena_mes) {
                                alert("Ingrese un Mes posterior o igual al Mes Actual");
                                f.mes.focus();
                                return;
                            }
                        }
                    }
                }

                if (document.form1.blis.value > 1) {
                    if ((f.p3.value == "") || (f.p3.value == "0")) {
                        alert("Ingrese una Precio de Blister");
                        f.p3.focus();
                        return;
                    }

                    if ((f.blister.value == "") || (f.blister.value == "0")) {
                        alert("Ingrese una Cantidad de Blister");
                        f.blister.focus();
                        return;
                    }



                }


                f.method = "post";
                f.action = "compras2_reg.php";
                f.target = "comp_principal";
                f.submit();
            }
            return (key == 70 || key == 102 || (key <= 13 || (key >= 48 && key <= 57)));
        }


        var nav4 = window.Event ? true : false;

        function ent1(evt) {
            var key = nav4 ? evt.which : evt.keyCode;
            if (key == 13) {
                var f = document.form1;
                var v1 = parseFloat(document.form1.text1.value); //CANTIDAD
                var valor = isNaN(v1);
                if (valor == true) {
                    document.form1.number.value = 1; ////avisa que no es numero
                } else {
                    document.form1.number.value = 0; ////avisa que es numero
                }
                if ((f.text1.value == "") || (f.text1.value == "0")) {
                    alert("Ingrese una Cantidad");
                    f.text1.focus();
                    return;
                }
                if ((f.text2.value == "") || (f.text2.value == "0.00")) {
                    alert("Ingrese el Precio");
                    f.text2.focus();
                    return;
                }

                if (document.form1.lotee.value == 1) {
                    if (f.countryL.value == "") {
                        alert("Ingrese el Numero de Lote");
                        f.countryL.focus();
                        return;
                    }
                    if (f.mesL.value == "") {
                        alert("Ingrese el Mes");
                        f.mesL.focus();
                        return;
                    }
                    if (f.yearsL.value == "") {
                        alert("Ingrese el A�o");
                        f.yearsL.focus();
                        return;
                    }
                    var cadena = f.yearsL.value;
                    var cadena_mes = f.mesL.value;
                    var longitud = cadena.length;
                    if (f.mesL.value > 12) {
                        alert("Ingrese un Mes valido");
                        f.mesL.focus();
                        return;
                    }
                    if (longitud < 3) {
                        alert("Ingrese un A�o valido1");
                        f.yearsL.focus();
                        return;
                    }
                    var fecha = new Date();
                    var ano = fecha.getFullYear();
                    var mess = fecha.getMonth() + 1;
                    cadena = parseInt(cadena);
                    cadena_mes = parseInt(cadena_mes);
                    ano = parseInt(ano);
                    mess = parseInt(mess);
                    if (ano > cadena) {
                        alert("Ingrese un A�o posterior al A�o Actual");
                        f.years.focus();
                        return;
                    } else {
                        if (ano == cadena) {
                            if (mess > cadena_mes) {
                                alert("Ingrese un Mes posterior o igual al Mes Actual");
                                f.mes.focus();
                                return;
                            }
                        }
                    }
                }
                if (document.form1.blis.value > 1) {
                    if ((f.p3.value == "") || (f.p3.value == "0")) {
                        alert("Ingrese una Precio de Blister");
                        f.p3.focus();
                        return;
                    }

                    if ((f.blister.value == "") || (f.blister.value == "0")) {
                        alert("Ingrese una Cantidad de Blister");
                        f.blister.focus();
                        return;
                    }



                }

                f.method = "post";
                f.action = "compras2_reg.php";
                f.target = "comp_principal";
                f.submit();
            }
            return (key <= 13 || key == 46 || (key >= 48 && key <= 57));
        }

        function caj1() {
            //document.form1.text1.focus();
        }
        var popUpWin = 0;

        function popUpWindows(URLStr, left, top, width, height) {
            pcosto = document.form1.text2.value;
            pdesc1 = document.form1.text3.value;
            pdesc2 = document.form1.text4.value;
            pdesc3 = document.form1.text5.value;
            ptext1 = document.form1.text1.value;
            pigv = "<?php echo $ckigv; ?>";
            if (popUpWin) {
                if (!popUpWin.closed) popUpWin.close();
            }
            URLStr = URLStr + '&costo=' + pcosto + '&desc1=' + pdesc1 + '&desc2=' + pdesc2 + '&desc3=' + pdesc3 + '&text1=' + ptext1 + '&pigv=' + pigv;
            popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,minimizable = no, resizable=no,copyhistory=yes,width=' + width + ',height=' + height + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
        }

        function compras2(e) {
            tecla = e.keyCode;
            var f = document.form1;
            var a = f.carcount.value;
            var b = f.carcount1.value;
            if (tecla == 120) {
                if ((a == 0) || (b > 0)) {
                    alert('No se puede realizar la impresiÃÂ¯ÃÂ¿ÃÂ½n de este Documento');
                } else {
                    //alert("hola");	 
                    //f.method = "POST";
                    //f.target = "_top";
                    //f.action ="comprasop_reg.php";
                    //f.submit();
                    //if (window.print)
                    //window.print()
                    //else
                    //alert("Disculpe, su navegador no soporta esta opciÃÂ¯ÃÂ¿ÃÂ½n.");
                }
            }
            if (tecla == 27) {
                document.form1.submit();
            }
        }
    </script>

    <!--------------price----------------------------->
    <script>
        function sf() {
            document.form1.price1.focus();
            var f = document.form1;
            var v1 = parseFloat(document.form1.price.value); //precio
            var v2 = parseFloat(document.form1.price1.value); //margen
            var v3 = parseFloat(document.form1.factor.value); //factor
            if (document.form1.price1.value === "") {
                document.form1.price1.value = 0;
                v2 = 0;
            }
            a = parseFloat(1 + (v2 / 100));
            pventa = parseFloat(v1 * a);
            pventa = Math.round(pventa * Math.pow(10, 2)) / Math.pow(10, 2);
            //pventaunit      = parseFloat(pventa / v3);
            //pventaunit      = Math.round(pventaunit*Math.pow(10,2))/Math.pow(10,2); 
            f.price2.value = pventa;
            f.price3.value = pventaunit;
        }

        function cerrar(e) {
            tecla = e.keyCode
            if (tecla == 27) {
                window.close();
            }
        }

        function validar() {
            var f = document.form1;
            f.method = "post";
            f.action = "price1.php";
            f.submit();
            /*var f = document.form1;
            if (f.price.value == "")
            { alert("DEBE INGRESAR UN PRECIO");f.price.focus(); return;}
            var p = f.price.value;
            var q = f.price1.value;
            var r = f.price2.value;
            var s = f.price3.value;
            var t = f.cod.value;
            //window.close();
            */
        }

        function precio() {
            var f = document.form1;
            var v1 = parseFloat(document.form1.price.value); //precio
            var v2 = parseFloat(document.form1.price1.value); //margen caja
            var v3 = parseFloat(document.form1.factor.value); //factor
            if (document.form1.price1.value === "") {
                document.form1.price1.value = 0;
                v2 = 0;
            }
            a = parseFloat(1 + (v2 / 100));
            pventa = parseFloat(v1 * a);
            pventa = Math.round(pventa * Math.pow(10, 2)) / Math.pow(10, 2);
            //pventaunit = parseFloat(pventa / v3);
            //pventaunit = Math.round(pventaunit*Math.pow(10,2))/Math.pow(10,2); 

            f.price2.value = pventa; //precio de venta uni caja    /////
            //f.price3.value = pventaunit;                  //precio de venta uni
        }

        function precio1() {
            var f = document.form1;
            var v1 = parseFloat(document.form1.price.value); //precio costo
            var v2 = parseFloat(document.form1.price2.value); //precio caja
            var v3 = parseFloat(document.form1.factor.value); //factor
            if (v3 === 0) {
                v3 = 1;
            }
            var rpc = 0;
            rpc = ((v2 - v1) / v1) * 100;
            rpc = Math.round(rpc * Math.pow(10, 2)) / Math.pow(10, 2);
            f.price1.value = rpc;
        }

        function precioUni() {
            var f = document.form1;
            var v1 = parseFloat(document.form1.price.value); //precio
            var v2 = parseFloat(document.form1.priceU.value); //margen unidad
            var v3 = parseFloat(document.form1.factor.value); //factor
            if (document.form1.price1.value === "") {
                document.form1.price1.value = 0;
                v2 = 0;
            }
            a = parseFloat(1 + (v2 / 100));
            pventa = parseFloat(v1 * a);
            pventa = Math.round(pventa * Math.pow(10, 2)) / Math.pow(10, 2);
            pventaunit = parseFloat(pventa / v3);
            pventaunit = Math.round(pventaunit * Math.pow(10, 2)) / Math.pow(10, 2);
            //f.price2.value = pventa;
            // if $factor=1
            // {
            //             pventaunit=$tprevta ;
            // }
            f.price3.value = pventaunit; //precio de venta uni
        }

        function precioUni1() {
            var f = document.form1;
            var v1 = parseFloat(document.form1.price.value); //precio costo
            var v2 = parseFloat(document.form1.price3.value); //precio unidad
            var v3 = parseFloat(document.form1.factor.value); //factor
            if (v3 === 0) {
                v3 = 1;
            }
            var rpu1 = (v1 / v3);
            var rpu = ((v2 - rpu1) / rpu1) * 100;
            rpu = Math.round(rpu * Math.pow(10, 2)) / Math.pow(10, 2);
            f.priceU.value = rpu;
        }
    </script>

    <?php require_once('../../../conexion.php');    //CONEXION A BASE DE DATOS
    require_once("../funciones/compras.php");    //FUNCIONES DE ESTA PANTALLA
    require_once("../../../funciones/highlight.php");    //ILUMINA CAJAS DE TEXTOS
    require_once("../funciones/functions.php");    //DESHABILITA TECLAS
    require_once("../../../funciones/funct_principal.php");    //IMPRIMIR-NUMEROS ENTEROS-DECIMALES
    require_once("../../../funciones/botones.php");    //COLORES DE LOS BOTONES
    $sql = "SELECT codloc FROM usuario where usecod = '$usuario'";
    $result = mysqli_query($conexion, $sql);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_array($result)) {
            $codloc    = $row['codloc'];
        }
    }
    //echo $sql;
    $sql1 = "SELECT porcent FROM datagen";
    $result1 = mysqli_query($conexion, $sql1);
    if (mysqli_num_rows($result1)) {
        while ($row1 = mysqli_fetch_array($result1)) {
            $porcent    = $row1['porcent'];
        }
    }
    $sql = "SELECT nomloc FROM xcompa where codloc = '$codloc'";
    $result = mysqli_query($conexion, $sql);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_array($result)) {
            $nomloc    = $row['nomloc'];
        }
    }

    
    $val = (isset($_REQUEST['val']) ? $_REQUEST['val'] : 0) ;
    // $val = $_REQUEST['val'];
    $ok  = $_REQUEST['ok'];
    ///////CUENTA CUANTOS REGISTROS LLEVA LA COMPRA
    $sql = "SELECT count(*) FROM tempmovmov where invnum = '$invnum'";
    $result = mysqli_query($conexion, $sql);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_array($result)) {
            $count        = $row[0];    ////CANTIDAD DE REGISTROS EN EL GRID
        }
    } else {
        $count = 0;    ////CUANDO NO HAY NADA EN EL GRID
    }
    ///////CUENTA CUANTOS REGISTROS NO SE HAN LLENADO
    $sql = "SELECT count(*) FROM tempmovmov where invnum = '$invnum' and qtypro = '0' and qtyprf = ''";
    $result = mysqli_query($conexion, $sql);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_array($result)) {
            $count1        = $row[0];    ////CUANDO HAY UN GRID PERO CON DATOS VACIOS
        }
    } else {
        $count1 = 0;    ////CUANDO TODOS LOS DATOS ESTAN CARGADOS EN EL GRID
    }
    if ($val == 1) {
        $producto =    $_REQUEST['country_ID'];
        if ($producto <> "") {
            $sql1 = "SELECT codtemp FROM tempmovmov where codpro = '$producto' and invnum = '$invnum'";
            $result1 = mysqli_query($conexion, $sql1);
            if (mysqli_num_rows($result1)) {
                $search = 0;
            } else {
                $search = 1;
            }
        } else {
            $search = 0;
        }
    } else {
        $search = 0;
    }
    require_once('../tabla_local.php');

    // $valform   = isset($_REQUEST['valform']) ? ($_REQUEST['valform']) : "";
     $valform = $_REQUEST['valform'];

    function getCantidadStr($cantidad, $fraccion)
    {
        $caja = $cantidad / $fraccion;
        $unidad = $cantidad % $fraccion;

        return 'C' . (int)$caja . '+F' . $unidad;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $sqlP = "SELECT porcent,Preciovtacostopro FROM datagen";
    $resultP = mysqli_query($conexion, $sqlP);
    if (mysqli_num_rows($resultP)) {
        while ($row = mysqli_fetch_array($resultP)) {
            $porcent    = $row['porcent'];
            $tipocosto = $row['Preciovtacostopro'];
        }
    }

    $sql1 = "SELECT desprod,codmar,factor,igv,pcostouni,stopro,lotec FROM producto where codpro = '$producto'";
    $result1 = mysqli_query($conexion, $sql1);
    if (mysqli_num_rows($result1)) {
        while ($row1 = mysqli_fetch_array($result1)) {
            $lote       = $row1['lotec'];    ///STOCK EN UNIDADES 

        }
    }
    $sql = "SELECT desprod,factor,margene,prevta,preuni,tcosto,tmargene,tprevta,tpreuni,igv,costpr,tcostpr,costre, s000+s001+s002+s003+s004+s005+s006+s007+s008+s009+s010+s011+s012+s013+s014+s015 as stoctal FROM producto where codpro = '$producto'";
    $result = mysqli_query($conexion, $sql);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_array($result)) {
            $desprod        = $row['desprod'];
            $factor         = $row['factor'];
        }
    }
    ?>
    <style>
        #country {
            width: 70%;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            background-color: white;
            background-image: url('buscador.png');
            background-position: 3px 3px;
            background-repeat: no-repeat;
            padding: 5px 15px 3px 35px;
        }
    </style>
</head>

<body onkeyup="compras2(event)" onload="<?php if ($valform == 1) { ?> caj1();<?php } else {
                                                                            if ($search == 1) { ?>links()<?php } else { ?>sssf()<?php }
                                                                                                                                    } ?>">
    <form id="form1" name="form1" onKeyUp="highlight(event)" onClick="highlight(event)" method="post">
        <input type="hidden" id="busca_prov" name="busca_prov" value="<?php echo $busca_prov; ?>" />
        <input type="hidden" id="busca_empre" name="busca_empre" value="<?php echo $busca_empre; ?>" />
        <table width="100%" border="0">
            <tr>
                <!-- <td width="90">DESCRIPCION</td>-->
                <td width="614">
                    <!--<input name="country" type="text" id="country" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)" value="" size="120"/>-->
                    <input tabindex="11" name="country" type="text" id="country" onkeyup="ajax_showOptions(this, 'getCountriesByLetters', event), this.value = this.value.toUpperCase();" value="" size="120" placeholder="Buscar Producto....." />
                    <input type="hidden" id="country_hidden" name="country_ID" />
                    <input type="hidden" id="ckigv" name="ckigv" value="<?php echo $ckigv; ?>" />
                    <input type="hidden" id="ok" name="ok" value="<?php echo $ok ?>" />
                    <input name="carcount" type="hidden" id="carcount" value="<?php echo $count ?>" />
                    <input name="carcount1" type="hidden" id="carcount1" value="<?php echo $count1 ?>" />
                </td>
                <td width="192">
                    <input name="val" type="hidden" id="val" value="1" />
                </td>
            </tr>
        </table>
        <?php $val = $_REQUEST['val'];
        if ($val == 1) {
            $producto =    $_REQUEST['country_ID'];


            if ($producto <> "") {
                $sql = "SELECT codpro,desprod,codmar,stopro,factor,$tabla,igv,pcostouni,costod FROM producto where activo1 = '1' and codpro = '$producto'  order by desprod";
                //echo $sql;
                $result = mysqli_query($conexion, $sql);
                if (mysqli_num_rows($result)) {
        ?>

                    <table class="celda2" border="0" width="100%">

                        <tr>
                            <th width="1%" bgcolor="#0069ad" class="titulos_movimientos">COD. PRO</th>
                            <th width="11%" bgcolor="#0069ad" class="titulos_movimientos">DESCRIPCION</th>
                            <th width="4%" bgcolor="#0069ad" class="titulos_movimientos">
                                <div align="center">LAB</div>
                            </th>
                            <th bgcolor="#0069ad" class="titulos_movimientos">
                                <div align="center">FACT</div>
                            </th>
                            <th width="4%" bgcolor="#0069ad" class="titulos_movimientos">
                                <div align="right">STOCK ALM</div>
                            </th>
                            <th width="3%" bgcolor="#0069ad" class="titulos_movimientos">
                                <div align="right">STOCK GENERAL </div>
                            </th>
                            <th width="3%" bgcolor="#0069ad" class="titulos_movimientos">
                                <div align="right">ULTIMO COSTO </div>
                            </th>
                            <th width="3%" bgcolor="#50ADEA" class="titulos_movimientos">
                                <div align="center">CANT</div>
                            </th>
                            <!--<th width="33" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">BONIF</div></th>-->
                            <th width="3%" bgcolor="#50ADEA" class="titulos_movimientos">
                                <div align="right">COSTO CAJA <!--<?php if ($ckigv !== "1") { ?> (-IGV)<?php } ?>--></div>
                            </th>
                            <th width="3%" bgcolor="#50ADEA" class="titulos_movimientos">
                                <div align="right">DESC1</div>
                            </th>
                            <th width="3%" bgcolor="#50ADEA" class="titulos_movimientos">
                                <div align="right">DESC2</div>
                            </th>
                            <th width="3%" bgcolor="#50ADEA" class="titulos_movimientos">
                                <div align="right">DESC3</div>
                            </th>
                            <th width="3%" bgcolor="#50ADEA" class="titulos_movimientos">
                                <div align="right">COSTO CAJA (+IGV)</div>
                            </th>
                            <th width="4%" bgcolor="#50ADEA" class="titulos_movimientos">
                                <div align="right">SUB TOT</div>
                            </th>
                            <!--		  <th width="30" bgcolor="#50ADEA" class="titulos_movimientos"><div align="right">MI LOCAL</div></th>
		  <th width="27" bgcolor="#50ADEA" class="titulos_movimientos"><div align="right">S. UNID </div></th>-->
                            <!--		  <th width="32" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">MOD PREC.V</div></th>-->
                            <!--                   <th width="17" bgcolor="#50ADEA" class="titulos_movimientos">&nbsp;</th>-->


                            <th width="4%" bgcolor="#0069ad" class="titulos_movimientos">P.V.ACT &nbsp;&nbsp;X CAJA</th>
                            <th width="3%" bgcolor="#0069ad" class="titulos_movimientos">&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; X UND </th>
                            <?php
                            if ($tipocosto >= 1) {
                            ?>
                                <!--		  <th width="17" bgcolor="#50ADEA" class="titulos_movimientos">COSTO PROMEDIO X CAJA</th>-->
                            <?php

                            }
                            //        else
                            //        {
                            //            
                            ?>
                            <!--		  <th width="17" bgcolor="#50ADEA" class="titulos_movimientos">COSTO X CAJA</th>-->
                            <?php
                            //        }
                            ?>
                            <th width="3%" bgcolor="#50ADEA" class="titulos_movimientos">% &nbsp;X CAJA</th>

                            <?php
                            if ($factor > 1) {
                            ?>
                                <th width="4%" bgcolor="#50ADEA" class="titulos_movimientos">% &nbsp;X UND</th>
                            <?php
                            }

                            ?>
                            <th width="4%" bgcolor="#50ADEA" class="titulos_movimientos">P.VENTA &nbsp;&nbsp;X CAJA</th>

                            <?php
                            if ($factor > 1) {
                            ?>
                                <th width="3%" bgcolor="#50ADEA" class="titulos_movimientos">: &nbsp;X UND</th>
                            <?php
                            }
                            ?>
                            <?php if ($lote == 1) { ?>
                                <th width="7%" bgcolor="#1c9aee" class="titulos_movimientos">N LOTE</th>
                            <?php } ?>
                            <?php if ($lote == 1) { ?>
                                <th width="" bgcolor="#1c9aee" class="titulos_movimientos">
                                    <center>VENC.</center>
                                </th>
                            <?php } ?>
                            <th width="3%" bgcolor="#0069ad" class="titulos_movimientos">
                                <center>UND x Blis.</center>
                            </th>
                            <?php if ($factor > 1) { ?><th width="3%" bgcolor="#0069ad" class="titulos_movimientos">
                                    <center>P.UND X Blis.</center>
                                </th>
                                <?php } ?>
                            <th width="3%" bgcolor="#50ADEA" class="titulos_movimientos">
                                <center>STOCK MIN</center>
                            </th>
                            <th width="3%" bgcolor="#0069ad" class="titulos_movimientos">
                                <div align="center">BONIF</div>
                            </th>
                        </tr>


                        <?php while ($row = mysqli_fetch_array($result)) {
                            $codpro         = $row['codpro'];        //codgio
                            $desprod        = $row['desprod'];
                            $codmar         = $row['codmar'];
                            $stopro         = $row['stopro'];
                            $factor         = $row['factor'];
                            $igv            = $row['igv'];
                            $costpr         = $row['pcostouni'];  ///COSTO PROMEDIO
                            $cant_loc       = $row[5];
                            $costod         = $row['costod'];
                            $convert        = $cant_loc / $factor;
                            $div            = floor($convert);
                            $mult            = $factor * $div;
                            $tot            = $stopro - $mult;
                            /*if ($igv == 1)
			{
			    $ckigv = 1;
			}*/
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
                            $sql1 = "SELECT qtypro,qtyprf,prisal FROM tempmovmov where invnum = '$invnum' and codpro = '$codpro'";
                            $result1 = mysqli_query($conexion, $sql1);
                            if (mysqli_num_rows($result1)) {
                                while ($row1 = mysqli_fetch_array($result1)) {
                                    $qtypro1         = $row1['qtypro'];
                                    $qtyprf1         = $row1['qtyprf'];
                                    $prisal1         = $row1['prisal'];
                                }
                            }
                            $sql1 = "SELECT codtemp FROM tempmovmov where codpro = '$codpro' and invnum = '$invnum'";
                            $result1 = mysqli_query($conexion, $sql1);
                            if (mysqli_num_rows($result1)) {
                                $control = 1;
                            } else {
                                $control = 0;
                            }

                            ////////////////////////////  pcosto = document.form1.text2.value;

                            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                        
                            $sqlP = "SELECT porcent,Preciovtacostopro FROM datagen";
                            $resultP = mysqli_query($conexion, $sqlP);
                            if (mysqli_num_rows($resultP)) {
                                while ($row = mysqli_fetch_array($resultP)) {
                                    $porcent    = $row['porcent'];
                                    $tipocosto = $row['Preciovtacostopro'];
                                }
                            }
                            // echo $tipocosto;
                            // echo $porcent;
                            // sleep(3);

                            //modificado por adrian
                            $sql = "SELECT utlcos,desprod,factor,margene,prevta,preuni,tcosto,tmargene,tprevta,tpreuni,igv,costpr,tcostpr,costre, s000+s001+s002+s003+s004+s005+s006+s007+s008+s009+s010+s011+s012+s013+s014+s015+s016+s017 as stoctal FROM producto where codpro = '$codpro'";
                            $result = mysqli_query($conexion, $sql);
                            if (mysqli_num_rows($result)) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $desprod        = $row['desprod'];
                                    $factor         = $row['factor'];
                                    $prevta         = $row['prevta'];
                                    $preuni         = $row['preuni'];
                                    $tcosto         = $row['tcosto'];
                                    $tmargene       = $row['tmargene'];
                                    $amargene       = $row['margene'];
                                    $tprevta        = $row['tprevta'];
                                    $tpreuni        = $row['tpreuni'];
                                    $igv            = $row['igv'];
                                    $costpr         = $row['utlcos']; //cambiado por adrian
                                    $tcostpr        = $row['tcostpr'];
                                    $costre        = $row['costre'];
                                    $stoctal        = $row['stoctal'];
                                    $s000        = (isset($row['s000']) ? $row['s000'] : 0);
                                }

                                $tmargene2 = 0;

                                // Si es en base a costo promedio
                                if ($tipocosto == 1) {
                                    if ($costpr > 0) {
                                        $margene = round($prevta / $costpr * 100, 2) - 100;
                                        $margene2 = round($preuni / $costpr / $factor * 100, 2) - 100;
                                    } else {
                                        $margene = 5;
                                        $margene2 = 5;
                                    }
                                }
                                // Si es en base a costre, costo de reposicion
                                else        
        if ($costre > 0) {
                                    $margene = round($prevta / $costre * 100, 2) - 100;
                                    $margene2 = round($preuni / ($costre / $factor) * 100, 2) - 100;
                                } else {
                                    $margene = 5;
                                    $margene2 = 5;
                                }

                                // Aqui se hace los precios unitarios?????
                                if ($preuni == "" and $factor <> 1) {
                                    $preuni         = $prevta / $factor;
                                }
                                // $tpreuni=0 si es la primera vez que se abre esta ventana
                                if ($tpreuni <= 0) {
                                    //Calculo Si tmargene2=0 es base a costo promedio
                                    if ($tipocosto >= 1) {
                                        if ($costpr > 0) {
                                            $tmargene2 = (($preuni / ($costpr / $factor)) - 1) * 100;
                                        }
                                    } else
                                    // si es en base al costo de compra real
                                    {
                                        if ($costre > 0) {
                                            $tmargene2 = (($preuni / ($costre / $factor)) - 1) * 100;
                                        } else {
                                            $costre = 1;
                                            $tmargene2 = (($preuni / ($costre / $factor)) - 1) * 100;
                                            //                     $tmargene2=0;

                                        }
                                    }
                                }
                            }
                            $stoctal = $stoctal / $factor;

                            if ($costo <> 0) {
                                if ($pigv !== "1" && $igv == 1) {
                                    $costo    = (int)$costo * (1 - ((int)$desc1 / 100)) * (1 - ((int)$desc2 / 100)) * (1 - ((int)$desc3 / 100)) * (1 + ($porcent / 100));
                                } else {
                                    $costo    = $costo * (1 - ($desc1 / 100)) * (1 - ($desc2 / 100)) * (1 - ($desc3 / 100));
                                }
                            }

                            //nuevo costo promedio
                            //    echo $costo . " <-cos| " . $text1 . " <-tex| " . $costpr . " <-copr| " . $stoctal;

                            if ($costo == 0) {
                                $tcostpr  = $costod;
                            } else {
                                $tcostpr  = (($costo * $text1)  + ($costpr * $stoctal)) / ($text1 + $stoctal);
                            }

                            //    echo $tcostpr;
                            //******** Para cuando calculo es en base a costo promedio **********
                            // echo  'costo '.$costo.'cantidad '.$text1.'Costpr'.$costpr.'Stocal '.$stoctal.'Factor '.$factor.'Tcostpr'.$tcostpr;

                            if ($tipocosto >= 1) {
                                // echo "Costo promedio";
                                // sleep(1);
                                $tprevta = round($tcostpr * (1 + $tmargene / 100), 2);
                                //Productos fraccionados
                                if ($factor > 1) {
                                    if ($tpreuni <= 0) //Para cuando calculo es en base a costo promedio 
                                    {
                                        $tpreuni   = round($tcostpr / $factor * (1 + $tmargene2 / 100), 2);
                                        $tmargene2 = (($tpreuni / ($tcostpr / $factor)) - 1) * 100;
                                    } else {
                                        $tmargene2 = (($tpreuni / ($tcostpr / $factor)) - 1) * 100;
                                    }
                                } else
                                // Productos no fraccionados
                                {
                                    $tmargene2  = $tmargene;
                                }

                                ///echo $tcostpr2;

                            }
                            /// **** Cuando el calculo es sobre el costo de compra ****
                            else {
                                if ($factor >= 1 & $costre >= 1) {
                                    $tmargene2  = ((($tpreuni / ($costre / $factor)) - 1)) * 100;
                                    $tpreuni   = round($costo * (1 + $tmargene2 / 100) / $factor, 2);
                                    //echo $tpreuni2;
                                    // sleep(1); // Se detiene 2 segundos en continuar la ejecuci�0�10�0�71�0�10�0�56n
                                } else {
                                    $tmargene2  = $tmargene;
                                    $tpreuni = $tprevta;
                                }
                            }
                            //$costo     = number_format($costo, 2, '.', ' ');
                            $tcostpr  = number_format($tcostpr, 2, '.', ' ');
                            $tprevta   = number_format($prevta, 2, '.', ' ');
                            $tpreuni   = number_format($tpreuni, 3, '.', ' ');
                            $tmargene2 = number_format($tmargene2, 2, '.', ' ');



                            $sql = "SELECT desprod,codmar,factor FROM producto where codpro = '$codpro'";
                            $result = mysqli_query($conexion, $sql);
                            if (mysqli_num_rows($result)) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $desprod        = $row['desprod'];
                                    $codmar         = $row['codmar'];
                                    $factor         = $row['factor'];
                                    $sql1 = "SELECT destab FROM titultabladet where tiptab = 'M' and codtab = '$codmar'";
                                    $result1 = mysqli_query($conexion, $sql1);
                                    if (mysqli_num_rows($result1)) {
                                        while ($row1 = mysqli_fetch_array($result1)) {
                                            $marca        = $row1['destab'];
                                        }
                                    }
                                }
                            }



                            $sql1 = "SELECT desprod FROM producto where codpro = '$codpro'";
                            $result1 = mysqli_query($conexion, $sql1);
                            if (mysqli_num_rows($result1)) {
                                while ($row1 = mysqli_fetch_array($result1)) {
                                    $desproducto = $row1["desprod"];
                                }
                            }
                            $sql1 = "SELECT lotec FROM producto where codpro = '$producto'";
                            $result1 = mysqli_query($conexion, $sql1);
                            if (mysqli_num_rows($result1)) {
                                while ($row1 = mysqli_fetch_array($result1)) {
                                    $lote2       = $row1['lotec'];    ///STOCK EN UNIDADES 

                                }
                            }


                            //////////////////////////////////////////////7stock minimo/////////////////////////////

                            $sqlP = "SELECT codpro,desprod,stopro,factor,m00,m01,m02,m03,m04,m05,m06,m07,m08,m09,m10,m11,m12,m13,m14,m15,m16,blister,s000 FROM producto where codpro = '$codpro'";
                            $resultP = mysqli_query($conexion, $sqlP);
                            if (mysqli_num_rows($resultP)) {
                                while ($row = mysqli_fetch_array($resultP)) {
                                    $codpro     = $row['codpro'];
                                    //			$desprod    = $row['desprod'];
                                    $stopro     = $row['stopro'];
                                    $factor     = $row['factor'];
                                    $m00         = $row['m00'];
                                    $m01         = $row['m01'];
                                    $m02        = $row['m02'];
                                    $m03         = $row['m03'];
                                    $m04         = $row['m04'];
                                    $m05         = $row['m05'];
                                    $m06         = $row['m06'];
                                    $m07         = $row['m07'];
                                    $m08         = $row['m08'];
                                    $m09         = $row['m09'];
                                    $m10        = $row['m10'];
                                    $m11         = $row['m11'];
                                    $m12         = $row['m12'];
                                    $m13         = $row['m13'];
                                    $m14         = $row['m14'];
                                    $m15         = $row['m15'];
                                    $m16         = $row['m16'];
                                    $blisters      = $row['blister'];
                                    $s000         = $row['s000'];
                                    $min        = $m00 + $m01 + $m02 + $m03 + $m04 + $m05 + $m06 + $m07 + $m08 + $m09 + $m10 + $m11 + $m12 + $m13 + $m14 + $m15 + $m16;            ////COMO STOCK GENERAL - MINIMOS
                                    if ($factor == 0) {
                                        $factor     = 1;
                                        $convert    = $stopro / $factor;
                                    } else {
                                        $convert    = $stopro / $factor;
                                    }
                                    $convertmin = $min / $factor;
                                    $div        = floor($convert);            ////PARTE ENTERA DEL STOCK GENERAL
                                    $div1        = floor($convertmin);        ////PARTE ENTERA DEL STOCK MINIMOS
                                    $mult        = $factor * $div;
                                    $mult1      = $factor * $div1;
                                    $tot        = $stopro - $mult;            /////OBTENGO EL RESIDUO DEL STOCK GENERAL
                                    $tot1       = $min - $mult1;            /////OBTENGO EL RESIDUO DEL STOCK MINIMO
                                    //$r			= $stopro - $min;
                                    $r            = $min - $stopro;
                                    if ($r < 0) {
                                        $c    = 0;
                                        $r    = $r * (-1);
                                        $desc = "SOBRAN";
                                    } else {
                                        $c    = 1;
                                        $desc = "FALTAN";
                                    }
                                    $div2       = $r / $factor;
                                    $div2        = floor($div2);
                                    $mult2      = $factor * $div2;
                                    $tot2       = $r - $mult2;
                                }
                            }

                            $sql1 = "SELECT codloc FROM xcompa WHERE nomloc='$nombre_local'";
                            $result1 = mysqli_query($conexion, $sql1);
                            if (mysqli_num_rows($result1)) {
                                while ($row1 = mysqli_fetch_array($result1)) {
                                    $codloc2 = $row1["codloc"];
                                }
                            }
                            $sqlP = "SELECT codloc,nomloc,nombre FROM xcompa where habil = '1' and codloc = '$codloc2' ";
                            $resultP = mysqli_query($conexion, $sqlP);
                            if (mysqli_num_rows($resultP)) {
                                while ($row = mysqli_fetch_array($resultP)) {
                                    $codloc     = $row1['codloc'];
                                    $nomloc        = $row1['nomloc'];
                                    $nom2       = $row1['nombre'];
                                }
                            }
                            if ($nom2 <> "") {
                                $nombre_local = $nom2;
                            } else {
                                $nombre_local = $nomloc;
                            }
                            if ($nomloc == 'LOCAL0') {
                                $stock_min = $m00;
                            }
                            if ($nomloc == 'LOCAL1') {
                                $stock_min = $m01;
                            }
                            if ($nomloc == 'LOCAL2') {
                                $stock_min = $m02;
                            }
                            if ($nomloc == 'LOCAL3') {
                                $stock_min = $m03;
                            }
                            if ($nomloc == 'LOCAL4') {
                                $stock_min = $m04;
                            }
                            if ($nomloc == 'LOCAL5') {
                                $stock_min = $m05;
                            }
                            if ($nomloc == 'LOCAL6') {
                                $stock_min = $m06;
                            }
                            if ($nomloc == 'LOCAL7') {
                                $stock_min = $m07;
                            }
                            if ($nomloc == 'LOCAL8') {
                                $stock_min = $m08;
                            }
                            if ($nomloc == 'LOCAL9') {
                                $stock_min = $m09;
                            }
                            if ($nomloc == 'LOCAL10') {
                                $stock_min = $m10;
                            }
                            if ($nomloc == 'LOCAL11') {
                                $stock_min = $m11;
                            }
                            if ($nomloc == 'LOCAL12') {
                                $stock_min = $m12;
                            }
                            if ($nomloc == 'LOCAL13') {
                                $stock_min = $m13;
                            }
                            if ($nomloc == 'LOCAL14') {
                                $stock_min = $m14;
                            }
                            if ($nomloc == 'LOCAL15') {
                                $stock_min = $m15;
                            }
                            if ($nomloc == 'LOCAL16') {
                                $stock_min = $m16;
                            }
                            $sum0 = 0;
                            $sum1 = 0;
                            $sum2 = 0;
                            $sum3 = 0;
                            $sum4 = 0;
                            $sum5 = 0;
                        ?>
                            <tr onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#ffffff';">
                                <!--N�-->
                                <td width="1%" bgcolor="#fce60f "><?php echo $codpro ?></td>
                                <!--            <td width="15"><?php // echo $codpro
                                                                ?></td>
            <td width="15"><?php // echo $codloc
                            ?></td>-->

                                <!--DESCRIPCION-->
                                <td width="11%" bgcolor="#fce60f ">

                                    <a id="l1" href="compras2.php?country_ID=<?php echo $producto ?>&ok=<?php echo $ok ?>&val=1&valform=1&cprod=<?php echo $codpro ?>&ckigv=<?php echo $ckigv; ?>&busca_prov=<?php echo $busca_prov; ?>&busca_empre=<?php echo $busca_empre; ?>"><?php echo substr($desprod, 0, 45); ?></a>

                                </td>
                                <?php
                                $cprod   = $_REQUEST['cprod'];
                                ?>
                                <!--MARCA-->
                                <td width="10%" bgcolor="#fce60f "><?php echo substr($marca, 0, 25) ?></td>
                                <td width="4%" align="center" bgcolor="#fce60f "><?php echo $factor; ?></td>

                                <!--MI LOCAL-->
                                <td width="3%" bgcolor="#fce60f ">
                                    <div align="right" bgcolor="#fce60f"><?= getCantidadStr($s000, $factor) ?></div>
                                </td>

                                <td width="3%" bgcolor="#fce60f ">
                                    <div align="right"> <?= getCantidadStr($stopro, $factor) ?></div>
                                </td>

                                <td width="3%" bgcolor="#fce60f ">
                                    <div align="right"><?php echo $costpr ?></div>
                                </td>


                                <!--CANT-->
                                <td width="3%" bgcolor="#FFFFCC ">
                                    <!--AQUI-->
                                    <div align="left">
                                        <?php if (($valform == 1) && ($cprod == $codpro)) { ?>
                                            <input name="text1" type="text" id="text1" size="2" onKeyPress="return ent(event)" value="<?php if ($qtyprf1 <> "") {
                                                                                                                                            echo $qtyprf1;
                                                                                                                                        } else {
                                                                                                                                            echo $qtypro1;
                                                                                                                                        } ?>" onKeyUp="precio();" />
                                            <input name="number" type="hidden" id="number" value="" />
                                            <input type="hidden" name="factor" id="factor" value="<?php echo $factor; ?>" />
                                            <input type="hidden" name="costpr" value="<?php echo $costpr; ?>" />
                                            <input type="hidden" name="stockpro" value="<?php echo $stopro; ?>" />
                                            <input type="hidden" name="lotee" id="lotee" value="<?php echo $lote; ?>" />
                                            <input type="hidden" name="years" id="years" value="<?php echo $ycar; ?>" />
                                            <input type="hidden" name="mes" id="mes" value="<?php echo $m; ?>" />
                                            <input name="codloc" type="hidden" id="codloc" value="<?php echo $codloc ?>" />
                                            <input name="cr" type="hidden" id="cr" value="<?php echo $i ?>" />
                                            <input name="minim" type="hidden" id="minim" size="4" value="<?php echo $stock_min ?>" />
                                            <input type="hidden" name="porcentaje" value="<?php if ($igv == 1) {
                                                                                                echo $porcent;
                                                                                            } ?>" />

                                            <input name="cod" type="hidden" id="cod" value="<?php echo $codpro; ?>" />
                                            <input name="ok" type="hidden" id="ok" value="<?php echo $ok; ?>" />
                                        <?php } else {

                                            if ($qtyprf1 <> "") {
                                                echo $qtyprf1;
                                            } else {
                                                echo $qtypro1;
                                            }
                                        }
                                        ?>
                                    </div>
                                </td>



                                <!--COSTO CAJA-->
                                <td width="2%" bgcolor="#FFFFCC ">
                                    <!--AQUI-->
                                    <div align="left">
                                        <?php
                                        /*if (($prisal1 == 0) || ($prisal1 == ""))
                {
                    $PrecioPrint = $costpr;
                }
                else
                {
                    $PrecioPrint = $prisal1;
                }*/
                                        $PrecioPrint = $costod;
                                        if (($valform == 1) && ($cprod == $codpro)) {
                                        ?>
                                            <input size="3" name="text2" type="text" id="text2" value="<?php echo $PrecioPrint ?>" size="4" onKeyPress="return ent1(event)" onKeyUp="precio();" />
                                        <?php } else {
                                            echo $PrecioPrint;
                                        }
                                        ?>
                                    </div>
                                </td>
                                <!---DESC1-->
                                <td width="2%" bgcolor="#FFFFCC ">
                                    <!--AQUI-->
                                    <div align="left">
                                        <?php if (($valform == 1) && ($cprod == $codpro)) { ?>
                                            <input size="3" name="text3" type="text" class="input_text1" id="text3" value="<?php echo $desc1 ?>" size="4" maxlength="5" onkeypress="return ent1(event);" onkeyup="precio();" />
                                        <?php } else {
                                            echo $desc1;
                                        } ?>
                                    </div>
                                </td>
                                <!---DESC2-->
                                <td width="2%" bgcolor="#FFFFCC ">
                                    <!--AQUI-->
                                    <div align="left">
                                        <?php if (($valform == 1) && ($cprod == $codpro)) { ?>
                                            <input size="3" disabled="disabled " name="text4" type="text" class="input_text1" id="text4" value="<?php echo $desc2 ?>" size="4" maxlength="5" onkeypress="return ent1(event);" onkeyup="precio();" />
                                        <?php } else {
                                            echo $desc2;
                                        } ?>
                                    </div>
                                </td>
                                <!---DESC3-->
                                <td width="2%" bgcolor="#FFFFCC ">
                                    <!--AQUI-->
                                    <div align="left">
                                        <?php if (($valform == 1) && ($cprod == $codpro)) { ?>
                                            <input size="3" disabled="disabled " name="text5" type="text" class="input_text1" id="text5" value="<?php echo $desc3 ?>" size="4" maxlength="5" onkeypress="return ent1(event);" onkeyup="precio();" />
                                        <?php } else {
                                            echo $desc3;
                                        } ?>
                                    </div>
                                </td>
                                <!--COSTO DE CAJA+IGV-->
                                <td width="3%" align="left" bgcolor="#FFFFCC ">
                                    <div align="left">
                                        <?php if (($valform == 1) && ($cprod == $codpro)) { ?>
                                            <input align="left" size="2" name="text6" type="text" id="text6" size="4" class="pvta" value="<?php echo $pripro ?>" onclick="blur()" />
                                        <?php } else {
                                            echo $pripro;
                                        } ?>
                                    </div>
                                </td>
                                <!--SUB TOTAL-->
                                <td width="3%" align="left" bgcolor="#FFFFCC ">
                                    <div align="left">
                                        <?php if (($valform == 1) && ($cprod == $codpro)) { ?>
                                            <input size="2" name="text7" type="text" id="text7" size="6" class="pvta" value="<?php echo $costre ?>" onclick="blur()" />
                                        <?php } else {
                                            echo $costre;
                                        } ?>
                                    </div>
                                </td>

                                <!--                <td width="32"><div align="center"> <a href="javascript:popUpWindows('price/price.php?cod=<?php echo $codpro ?>&invnum=<?php echo $invnum ?>&ncompra=<?php echo $ncompra ?>&ok=<?php echo $ok ?>', 205, 40, 498, 270)" title="PRECIO DE PRODUCTOS"> <img src="../../../images/tickg.gif" width="19" height="18" border="0"/> </a> </div></td>
            <td width="17"><div align="center"><?php if ($control == 0) { ?><a href="compras2_reg.php?cod=<?php echo $codpro ?>&search=<?php echo $producto ?>&val=1&ok=<?php echo $ok ?>" target="comp_principal"></a><?php } else { ?><img src="../../../images/icon-16-checkin.png" width="16" height="16" border="0"/><?php } ?></div></td>-->
                                <!---empizaaaaa---->
                                <!--venta actual por caja-->
                                <td width="3%" bgcolor="#fce60f ">
                                    <div align="LEFT"><?php echo $prevta; ?></div>
                                </td>
                                <td width="3%" bgcolor="#fce60f ">
                                    <div align="LEFT"><?php echo $preuni; ?></div>
                                </td>
                                <?php
                                if ($tipocosto >= 1) {
                                ?>
                                    <!--             <td width="17" bgcolor="#FFFFCC">
              <input name="price" type="text" size="8" id="price" onkeypress="return decimal(event)" onkeyup="precioo();" readonly value="<?php if ($tcostpr <> 0) {
                                                                                                                                                echo $tcostpr;
                                                                                                                                            } else {
                                                                                                                                                echo $tcostpr;
                                                                                                                                            } ?>"/> 
            (Incluido IGV1) </td>-->

                                <?php
                                }
                                //        else
                                //        {
                                //            
                                ?>

                                <!--            <td width="17" bgcolor="#FFFFCC">
              <input name="price" type="text" size="6" id="price" onkeypress="return decimal(event)" onkeyup="precioo();" readonly value="//<?php if ($costo <> 0) {
                                                                                                                                                echo $costo;
                                                                                                                                            } else {
                                                                                                                                                echo $costo;
                                                                                                                                            } ?>"/> 
            (Incluido IGV2) </td>-->
                                <?php
                                //        }
                                ?>
                                <td width="3%" bgcolor="#FFFFCC ">

                                    <?php
                                    if (($valform == 1) && ($cprod == $codpro)) {
                                    ?>
                                        <input size="2" name="price1" type="text" id="price1" value="<?php if ($tmargene <> 0) {
                                                                                                            echo $tmargene;
                                                                                                        } else {
                                                                                                            echo $margene;
                                                                                                        } ?>" size="1" onKeyPress="return ent1(event)" onKeyUp="precioo();" />
                                    <?php } else {
                                        if ($tmargene <> 0) {
                                            echo $tmargene;
                                        } else {
                                            echo $margene;
                                        }
                                    } ?>


                                </td>
                                <?php
                                if ($factor > 1) {
                                ?>
                                    <td width="3%" bgcolor="#FFFFCC ">


                                        <?php
                                        if (($valform == 1) && ($cprod == $codpro)) {
                                        ?>
                                            <input size="2" name="priceU" type="text" id="priceU" <?php if ($factor == 1) { ?>readonly<?php } ?> value="<?php if ($tmargene2 <> 0) {
                                                                                                                                                            echo $tmargene2;
                                                                                                                                                        } else {
                                                                                                                                                            echo $tmargene2;
                                                                                                                                                        } ?>" size="1" onKeyPress="return ent1(event)" onKeyUp="precioUni();" />
                                        <?php } else {
                                            if ($tmargene2 <> 0) {
                                                echo $tmargene2;
                                            } else {
                                                echo $tmargene2;
                                            }
                                        } ?>
                                    </td>
                                <?php
                                } else {
                                ?>
                                    <input type="hidden" name="priceU" size="4" id="priceU" value="0" />

                                <?php
                                }
                                ?>
                                <td width="4%" bgcolor="#FFFFCC ">


                                    <?php
                                    if (($valform == 1) && ($cprod == $codpro)) {
                                    ?>
                                        <input size="3" name="price2" type="text" id="price2" value="<?php if ($tprevta <> 0) {
                                                                                                            echo $tprevta;
                                                                                                        } ?>" size="4" onKeyPress="return ent1(event)" onKeyUp="precio1();" />
                                    <?php } else {
                                        if ($tprevta <> 0) {
                                            echo $tprevta;
                                        }
                                    } ?>
                                </td>
                                <?php

                                if ($factor > 1) {
                                ?>
                                    <td width="4%" bgcolor="#FFFFCC ">


                                        <?php if (($valform == 1) && ($cprod == $codpro)) {  ?>
                                            <input size="1" name="price3" type="text" id="price3" value="<?php if ($tpreuni <> 0) {
                                                                                                                echo $tpreuni;
                                                                                                            } ?>" onKeyPress="return ent1(event)" onKeyUp="precioUni1();" />
                                        <?php } else {
                                            if ($tpreuni <> 0) {
                                                echo $tpreuni;
                                            }
                                        } ?>
                                        <?php // echo "esto" . $lote2;
                                        ?>
                                    </td>
                                <?php
                                } else {
                                ?>
                                    <input size="4%" type="hidden" name="price3" id="price3" value="<?php echo $tprevta; ?>" />
                                <?php
                                }
                                ?>


                                <?php if ($lote2 == 1) { ?>
                                    <td width="<?php if ($lote2 == 1) { ?> 6% <?php } else { ?>0<?php } ?>" bgcolor="#FFFFCC ">
                                        <div align="left">
                                            <?php if ($lote2 == 1) { ?>
                                                <?php if (($valform == 1) && ($cprod == $codpro)) {  ?>
                                                    <input name="countryL" type="text" id="countryL" size="5" value="<?php echo $numlote ?>" />
                                                    <input name="codpro" type="hidden" id="codpro" value="<?php echo $cod ?>" />
                                                    <input name="lote" type="hidden" id="lote" value="<?php echo $lote ?>" />
                                                    <input type="hidden" id="country_hidden" name="country_ID" value="" />
                                                <?php } else {
                                                    echo $numlote;
                                                } ?>
                                            <?php } ?>
                                        </div>
                                    </td>
                                <?php } ?>





                                <?php if ($lote2 == 1) { ?>
                                    <td width="<?php if ($lote2 == 1) { ?> 8% <?php } else { ?>0<?php } ?>" bgcolor="#FFFFCC ">
                                        <div align="center">
                                            <?php if ($lote2 == 1) { ?>
                                                <?php if (($valform == 1) && ($cprod == $codpro)) {  ?>
                                                    <input name="mesL" type="text" id="mesL" size="1" maxlength="2" value="<?php echo $m ?>" onKeyPress="return ent(event)" />

                                                    /
                                                    <input name="yearsL" type="text" id="yearsL" size="2" maxlength="4" value="<?php echo $ycar ?>" onKeyPress="return ent(event)" />
                                                    <!--            <input name="save" type="button" id="save" value="Grabar" onclick="grabar()" class="grabar" <?php if ($search == 0) { ?> disabled="disabled"<?php } ?>/>-->
                                                <?php } else {
                                                    echo $m . "<center>/</center>" . $ycar;
                                                } ?>
                                            <?php } ?>
                                        </div>
                                    </td>
                                <?php } ?>

                                <td width="2%" bgcolor="#FFFFCC ">
                                    <div align="right">
                                        <?php if (($valform == 1) && ($cprod == $codpro)) {  ?>
                                            <input name="blister" type="text" id="blister" size="1" value="<?php echo $blisters ?>" onKeyUp="return acceptNum()(event);" onKeyPress="return ent(event)" />
                                            <input name="blis" type="hidden" id="blis" value="<?php echo $blisters ?>" />
                                        <?php } else {
                                            echo $blisters;
                                        } ?>
                                    </div>
                                </td>
                                <?php if ($factor > 1) { ?>
                                    <td width="2%" bgcolor="#FFFFCC ">
                                        <div align="right">
                                            <?php if (($valform == 1) && ($cprod == $codpro)) {  ?>
                                                <input name="p3" type="text" id="p3" size="1" value="<?php echo $preblister ?>" onkeypress="return decimal(event);" onKeyUp="return ent(event)" />
                                            <?php } else {
                                                echo $preblister;
                                            }    ?>
                                        </div>
                                    </td>
                                <?php } ?>
                                <td width="3%" bgcolor="#FFFFCC ">
                                    <div align="right">

                                        <?php if (($valform == 1) && ($cprod == $codpro)) {  ?>
                                            <?php ?>
                                            <input name="minim" type="text" id="minim" size="1" value="<?php echo $stock_min ?>" onKeyPress="return ent(event)" />
                                            <input name="codloc" type="hidden" id="codloc" value="<?php echo $codloc ?>" />
                                            <input name="codpro" type="hidden" id="codpro" value="<?php echo $codpro ?>" />
                                            <input name="country_ID" type="hidden" id="country_ID" value="<?php echo $marca ?>" />
                                            <input name="cr" type="hidden" id="cr" value="<?php echo $cr ?>" />
                                            <!--<input type="button" id="boton" onClick="validar_prod()" alt="GUARDAR"/>-->
                                            <!--<input type="button" id="boton1" onClick="validar_grid()" alt="ACEPTAR"/>-->

                                        <?php } else { ?>
                                            <div align="CENTER">
                                                <?php if (($blister <> "") || ($factor == 0)) { ?>
                                                    <?php echo $div1 ?> F <?php echo $tot1 ?> U
                                                <?php } else { ?>
                                                    <?php echo $div1 ?> F
                                                <?php } ?>
                                            </div>

                                            <!--echo $stock_min;-->
                                        <?php }
                                        ?>
                                    </div>
                                </td>
                                <!--BONIF-->
                                <td width="3%" bgcolor="#fce60f ">
                                    <div align="center">
                                        <?php if (($valform == 1) && ($cprod == $codpro)) { ?>
                                            <input name="bonifi" type="checkbox" id="bonifi" value="1" />
                                        <?php } ?>
                                    </div>
                                </td>

                            </tr>
                        <?php $i++;
                        }
                        ?>
                    </table>
                <?php }
            } else {
                ?>
                <center><u><br><br>
                        <span class="text_combo_select">NO SE LOGRO ENCONTRAR NINGUN PRODUCTO CON LA DESCRIPCION INGRESADA</span></u>
                </center>
        <?php }
        }

        ?>
    </form>
</body>

</html>