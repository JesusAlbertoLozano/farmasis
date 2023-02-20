<?php include('../session_user.php');
require_once ('../../conexion.php');	//CONEXION A BASE DE DATOS
$btn = $_REQUEST['btn'];
if ($btn == 1)
{
    $desc                   = $_REQUEST['desc'];
    $igv                    = $_REQUEST['igv'];
    $dolar                  = $_REQUEST['dolar'];
    $direccionemp           = $_REQUEST['dir'];
    $rucemp                 = $_REQUEST['ruc'];
    $telefonoemp            = $_REQUEST['tel'];
    $montoboleta            = $_REQUEST['montoboleta'];
    $FacturacionEletronica  = $_REQUEST['FacturacionEletronica'];
    $MarcaImpresion         = $_REQUEST['MarcaImpresion'];
    $TicketDefecto          = $_REQUEST['TicketDefecto'];
    $Preciovtacostopro      = $_REQUEST['Preciovtacostopro'];
    $formadeimpresion       = $_REQUEST['formadeimpresion'];
     $venf8                 = $_REQUEST['venf8'];
    $puntosdiv              = $_REQUEST['puntosdiv'];
    mysqli_query($conexion,"update datagen set desemp  = '$desc', porcent = '$igv', dolar = '$dolar', "
            . "telefonoemp = '$telefonoemp', rucemp = '$rucemp', direccionemp = '$direccionemp',"
            . "montoboleta = '$montoboleta', facturacionElect = $FacturacionEletronica, MarcaImpresion = $MarcaImpresion,"
            . "TicketDefecto = $TicketDefecto, Preciovtacostopro = $Preciovtacostopro , formadeimpresion = $formadeimpresion, venf8 = $venf8, puntosdiv = $puntosdiv ");
    header("Location: datos_gen.php");
}
if ($btn == 2)
{
    $pas1           = $_REQUEST['pas1'];
    $pas2           = $_REQUEST['pas2'];
    $pas3           = $_REQUEST['pas3'];
    mysqli_query($conexion,"update datagen set adminuser  = '$pas1', paramsist = '$pas2', colorbut = '$pas3'");
    header("Location: password1.php");
}
if ($btn == 3)
{
    $text	= $_REQUEST['text'];
    $text1	= $_REQUEST['text1'];
    $text2	= $_REQUEST['text2'];
    $text3	= $_REQUEST['text3'];
    $text4	= $_REQUEST['text4'];
    $text5	= $_REQUEST['text5'];
    $text6	= $_REQUEST['text6'];
    $text7	= $_REQUEST['text7'];
    $text8	= $_REQUEST['text8'];
    $text9	= $_REQUEST['text9'];
    $text10	= $_REQUEST['text10'];
    $text11	= $_REQUEST['text11'];
    $text12	= $_REQUEST['text12'];
    $text13	= $_REQUEST['text13'];
    $text14	= $_REQUEST['text14'];
    $text15	= $_REQUEST['text15'];
    $text16	= $_REQUEST['text16'];
    $text17     = $_REQUEST['text17'];
    $text18     = $_REQUEST['text18'];
    $text19     = $_REQUEST['text19'];
    $text20     = $_REQUEST['text20'];
    if ($text18 == "")
    {
        mysqli_query($conexion,"update color_modulo set primero  = '$text', anterior = '$text1', siguiente = '$text2', ultimo = '$text3',ver='$text4', nuevo='$text5',modificar='$text6',eliminar='$text7',grabar='$text8',buscar='$text9',preliminar='$text10',imprimir='$text11',consulta='$text12',salir='$text13',prodstock='$text14',prodincent= '$text15',prodnormal ='$text16', cancelar = '$text17', regresar = '$text19', limpiar = '$text20'");
    }
    else
    {
        mysqli_query($conexion,"update color_modulo set primero  = '$text18', anterior = '$text18', siguiente = '$text18', ultimo = '$text18',ver='$text18', nuevo='$text18',modificar='$text18',eliminar='$text18',grabar='$text18',buscar='$text18',preliminar='$text18',imprimir='$text18',consulta='$text18',salir='$text18',prodstock='$text18',prodincent= '$text18',prodnormal ='$text18', cancelar = '$text18', regresar = '$text18', limpiar = '$text18'");
    }
    header("Location: color1.php");
}
if ($btn == 4)
{
    $ckvendedorventa= isset($_REQUEST['ckvendedorventa'])?$_REQUEST['ckvendedorventa'] : 0;
    $cliente	= $_REQUEST['cliente'];
    $ventas	= $_REQUEST['ventas'];
    $vendedor	= $_REQUEST['vendedor'];
    $limit    	= $_REQUEST['limit'];
    $limit2    	= $_REQUEST['limit2'];
    $msg    	= $_REQUEST['msjventa'];
    $minunid	= $_REQUEST['minunid'];
    $utldmin	= $_REQUEST['utldmin'];
    $p1		= $_REQUEST['p1'];
    $p2		= $_REQUEST['p2'];
    $p3		= $_REQUEST['p3'];
    $p4		= $_REQUEST['p4'];
    $p5		= $_REQUEST['p5'];
    $p6		= $_REQUEST['p6'];
    $p7		= $_REQUEST['p7'];
    $p8		= $_REQUEST['p8'];
    $p9		= $_REQUEST['p9'];
    $p10	= $_REQUEST['p10'];
    $auditor	= $_REQUEST['auditor'];
    $p11	= $_REQUEST['p11'];
    $rd1	= $_REQUEST['rd1'];		///COMPRA POR 1 0 POR 2
    $rd2	= $_REQUEST['rd2'];		///VENTA POR 1 O POR 2
    if ($rd1 == 1)
    {
    $c2 = "";
    $c1 = 1;
    }
    else
    {
    $c1 = "";
    $c2 = 1;
    }
    if ($rd2 == 1)
    {
    $v2 = "";
    $v1 = 1;
    }
    else
    {
    $v1 = "";
    $v2 = 1;
    }
    mysqli_query($conexion,"update datagen_det set vendedorventa='$ckvendedorventa',codcli  = '$cliente', condv = '$ventas', prodact = '$p1', incigv = '$p2', cosigv = '$p3', nomarc = '$p4', codaut = '$p5', afeigv = '$p6', unalm = '$p7', ventalm = '$p8', ingalm = '$p9', comcod = '$c1', comnom = '$c2', ventcod = '$v1', ventnom = '$v2', limite = '$limit', limite_compra = '$limit2', mensaje = '$msg',unidminrepo = '$minunid',utldmin = '$utldmin', priceditable = '$p10', focuscotiz = '$p11', auditor = '$auditor'");
    header("Location: val_predeterm1.php");
}

?>