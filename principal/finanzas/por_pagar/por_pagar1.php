<?php include('../../session_user.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="css/letras.css" rel="stylesheet" type="text/css" />
<link href="css/tabla2.css" rel="stylesheet" type="text/css" />
<link href="css/select.css" rel="stylesheet" type="text/css" />
<?php require_once('../../../conexion.php');	//CONEXION A BASE DE DATOS
require_once('../../../convertfecha.php');	//CONEXION A BASE DE DATOS
require_once("../../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../../funciones/botones.php");	//COLORES DE LOS BOTONES
?>
<link rel="STYLESHEET" type="text/css" href="../../../funciones/codebase/dhtmlxcalendar.css">
<script>
window.dhx_globalImgPath="../../../funciones/codebase/imgs/";
</script>
<script src="../../../funciones/codebase/dhtmlxcommon.js"></script>
<script src="../../../funciones/codebase/dhtmlxcalendar.js"></script>
<?php require_once("../../../funciones/calendar.php");?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////
$sql="SELECT descli FROM cliente where codcli = '$cuscod'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$descli    = $row['descli'];
}
}
$sql="SELECT invnum FROM planilla order by invnum desc limit 1";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$numplan    = $row['invnum'];
}
$numplan++;
}
else
{
$numplan = 1;
}
function formato($c) {
printf("%06d",$c);
} 
function formato1($c) {
printf("%04d",$c);
} 
?>
<script>
function sf()
{
document.form1.numdoc.focus();
} 
function validar()
{
	var f = document.form1;
	if (f.numdoc.value == "")
	{
	alert("Ingrese el Numero de Documento"); f.numdoc.focus(); return;
	}
	f.action = "por_pagar2.php";
	f.method = "post";
	f.submit();
} 
function valida_combo()
{
	var f = document.form2;
	if (f.forpag.value == "L")
	{
	f.letra.disabled = false;
	f.plazo.disabled = false;
	f.banco.disabled = false;
	f.moneda.disabled = false;
	f.date2.disabled = false;
	f.date3.disabled = false;
	}
	else
	{
	f.letra.disabled = true;
	f.plazo.disabled = true;
	f.banco.disabled = true;
	f.moneda.disabled = true;
	f.date2.disabled = true;
	f.date3.disabled = true;
	}
	f.doccancel.focus();
} 
function saldos()
{
	var l = document.form2;
	var v1 		= parseFloat(document.form2.s.value);		//saldo
	var v2 		= parseFloat(document.form2.paga.value);	//pago
	if (document.form2.paga.value == "")
	{
	v2 = 0;
	}
	l.ttt.value = v1 - v2;
}
function grabar()
{
	var f       = document.form2;
	var v1 		= parseFloat(document.form2.s.value);		//saldo
	var v2 		= parseFloat(document.form2.paga.value);	//pago
	var l       = v1 - v2;
	if (f.forpag.value == "L")
	{
		if(f.date1.value == "")
		{alert("Ingrese una Fecha"); f.date1.focus(); return;}
		if(f.doccancel.value == "")
		{alert("Ingrese el Numero de Documento"); f.doccancel.focus(); return;}
		if(f.paga.value == "")
		{alert("Ingrese un Monto"); f.paga.focus(); return;}
		if ((l < 0) || (document.form2.paga.value == ""))
		{alert("Ingrese un Monto Correcto"); f.paga.focus(); return;}
		if(f.letra.value == "")
		{alert("Ingrese el Numero del Documento"); f.letra.focus(); return;}
		if(f.plazo.value == "")
		{alert("Ingrese un Plazo"); f.plazo.focus(); return;}
		if(f.date2.value == "")
		{alert("Ingrese una Fecha"); f.date2.focus(); return;}
		if(f.date3.value == "")
		{alert("Ingrese una Fecha"); f.date3.focus(); return;}
		document.form2.sald.value = l;
		f.method = "post";
		f.action = "por_pagar_reg.php";
		f.submit();
	}
	else
	{
		if(f.date1.value == "")
		{alert("Ingrese una Fecha"); f.date1.focus(); return;}
		if(f.doccancel.value == "")
		{alert("Ingrese el Numero de Documento"); f.doccancel.focus(); return;}
		if(f.paga.value == "")
		{alert("Ingrese un Monto"); f.paga.focus(); return;}
		if ((l < 0) || (document.form2.paga.value == ""))
		{alert("Ingrese un Monto Correcto"); f.paga.focus(); return;}
		document.form2.sald.value = l;
		f.method = "post";
		f.action = "por_pagar_reg.php";
		f.submit();
	}
}
function salir()
{
	var l = document.form1;
	l.target = "_top";
	l.action = "../../index.php";
	l.submit();
} 
var nav4 = window.Event ? true : false;
function acceptNum(evt){
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57
var key = nav4 ? evt.which : evt.keyCode;
return (key <= 13 || (key >= 48 && key <= 57));

}
</script>
<?php 
//$hour   = date('G');
$dater	= date('Y-m-d');
//$dater	= CalculaFechaHora($hour);
$valid  = $_REQUEST['valid'];
$val    = $_REQUEST['val'];
$numdoc = $_REQUEST['numdoc'];
$invnum = $_REQUEST['invnum'];
?>
</head>
<body>
<link rel='STYLESHEET' type='text/css' href='../../../css/calendar.css'>
<form name="form1" id="form1" onClick="highlight(event)" onKeyUp="highlight(event)">
  <table width="947" border="0">
    <tr>
      <td width="42">FECHA</td>
      <td width="113">
        <input name="textfield" type="text" disabled="disabled" value="<?php echo date('d/m/Y');?>" size="15"/>
     </td>
      <td width="105">NUMERO PLANILLA </td>
	  <td width="257">
	    <input name="textfield2" type="text" size="30" disabled="disabled" value="<?php echo formato($numplan)?>"/>
	  </td>
	  <td width="125">NUMERO DOCUMENTO </td>
	  <td width="279">
	    <input name="numdoc" type="text" id="numdoc" size="30" onkeypress="return acceptNum(event);" value="<?php echo $numdoc?>"/>
	    <input name="val" type="hidden" id="val" value="1" />
	    <input type="button" name="Submit" value="Buscar" onclick="validar();"/>
	    <input type="button" name="Submit2" value="Salir" onclick="salir();"/>
      </td>
    </tr>
  </table>
  <div align="center"><img src="../../../images/line2.png" width="950" height="4" /></div>
</form>
<?php if ($val == 1)
{
if ($valid == 1)
{
?>
<form name="form2" id="form2" onClick="highlight(event)" onKeyUp="highlight(event)">
<?php $sql1="SELECT invnum,invfec,nrocomp,provee,invtot,pendiente FROM ordmae where nrocomp = '$numdoc'";	
$result1 = mysqli_query($conexion,$sql1);
if (mysqli_num_rows($result1)){
while ($row1 = mysqli_fetch_array($result1)){
    $invnum    = $row1['invnum'];
	$invfec    = $row1['invfec'];
	$nrocomp   = $row1['nrocomp'];
	$provee    = $row1['provee'];
	$invtot    = $row1['invtot'];
	$pendiente = $row1['pendiente'];
}
}
$sql1="SELECT sum(monpag) FROM planilla where numdoc = '$nrocomp' and borrada = '0'";	
$result1 = mysqli_query($conexion,$sql1);
if (mysqli_num_rows($result1)){
while ($row1 = mysqli_fetch_array($result1)){
    $monpagsum = $row1[0];
	$saldo     = $invtot - $monpagsum;
}
}
$sql1="SELECT despro FROM proveedor where codpro = '$provee'";	
$result1 = mysqli_query($conexion,$sql1);
if (mysqli_num_rows($result1)){
while ($row1 = mysqli_fetch_array($result1)){
    $despro    = $row1['despro'];
}
}
$sql1="SELECT invfec FROM movmae where nro_compra = '$invnum'";	
$result1 = mysqli_query($conexion,$sql1);
if (mysqli_num_rows($result1)){
while ($row1 = mysqli_fetch_array($result1)){
    $invfec1   = $row1['invfec'];
}
}
if ($pendiente == 1)
{
$desc_pendiente = "POR RECIBIR";
}
else
{
$desc_pendiente = "RECIBIDA";
}
?>
<table width="947" border="0">
  <tr>
    <td>
	<br/>
	<table width="937" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="101"><div align="center"><strong>NUM DOCUMENTO </strong></div></td>
        <td width="366"><strong>PROVEEDOR</strong></td>
		<td width="126"><div align="center"><strong>FECHA COMPRA</strong></div></td>
		<td width="126"><div align="center"><strong>FECHA INGRESO</strong></div></td>
		<td width="104"><div align="center"><strong>ESTADO</strong></div></td>
        <td width="100"><div align="right"><strong>MONTO TOTAL </strong></div></td>
      </tr>
    </table>
      <table width="937" border="1" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFCC">
        <tr>
          <td width="101"><div align="center"><?php echo formato($nrocomp);?></div></td>
          <td width="366"><?php echo $despro;?></td>
          <td width="126"><div align="center"><?php echo fecha($invfec)?></div></td>
		  <td width="126"><div align="center"><?php echo fecha($invfec1)?></div></td>
          <td width="104"><div align="center"><?php echo $desc_pendiente;?></div></td>
          <td width="100"><div align="center"><?php echo $numero_formato_frances = number_format($invtot, 2, '.', ' ');?></div></td>
        </tr>
      </table>
	  <table width="937" border="1" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFF99">
        <tr>
          <td width="101"><div align="center"><strong><?php if ($saldo == 0){?>ESTADO<?php }else{?>SALDO<?php }?></strong></div></td>
          <td width="830" <?php if ($invtot == $monpagsum){?>bgcolor="#993300"<?php }?>> &nbsp;&nbsp;<strong><?php if ($invtot == $monpagsum){?> <font color="#ffffff">CANCELADO</font><?php }else{ echo "  ".$saldo; }?></strong></td>
        </tr>
      </table>
      <img src="../../../images/line2.png" width="950" height="4" />
	  <br>
      <table width="937" border="0" align="center">
        <tr>
          <td><strong><u>REALIZAR PAGO</u> </strong></td>
        </tr>
      </table>
      <table width="937" height="111" border="0" align="center" class="tabla2">
        <tr>
          <td valign="top"><table width="895" border="0" align="center">
            <tr>
              <td width="173">FECHA</td>
              <td width="712"><div style="position:relative; border:1px solid navy; width: 94px">
                <input name="date1" type="text" id="calInput1" style="border-width:0px; width: 74px; font-size:12px;"
			 readonly="true" value="<?php echo $dater;?>" <?php if ($saldo == 0){?> disabled="disabled"<?php }?>/><img style="cursor:pointer;" onclick="showCalendar(1)" src="../../../funciones/codebase/imgs/calendar.gif" align="absmiddle" />
                <div id="calendar1" style="position:absolute; left:94px; top:0px; display:none"></div>
              </div></td>
            </tr>
            <tr>
              <td>TIPO DOCUMENTO </td>
              <td>
                <select name="tipdoc" id="tipdoc" <?php if ($saldo == 0){?> disabled="disabled"<?php }?>>
                  <option value="1" selected="selected">COMPRAS</option>
                  <option value="2">LETRAS</option>
                  <option value="3">DEVOLUCIONES O CANJES</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>FORMA DE PAGO </td>
              <td>
                <select name="forpag" id="forpag" onchange="valida_combo()" <?php if ($saldo == 0){?> disabled="disabled"<?php }?>>
                  <option value="E" selected="selected">EFECTIVO</option>
                  <option value="L">LETRA</option>
                  <option value="D">DEPOSITO</option>
                  <option value="N">NOTA DE CREDITO</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>DOCUMENTO DE CANCELACION </td>
              <td>
                <input name="doccancel" type="text" id="doccancel" size="60" <?php if ($saldo == 0){?> disabled="disabled"<?php }?>/>
              </td>
            </tr>
            <tr>
              <td>MONTO A PAGAR </td>
              <td>
                <input name="s" type="hidden" id="s" value="<?php echo $saldo?>" />
                <input name="paga" type="text" id="paga" <?php if ($saldo == 0){?> disabled="disabled"<?php }?> onkeyup="saldos()"/>
              </td>
            </tr>
            <tr>
              <td>SALDO PENDIENTE </td>
              <td>
                <input name="sald" type="hidden" id="sald" />
                <input name="ttt" type="text" id="ttt" disabled="disabled"/>
              </td>
            </tr>
          </table></td>
        </tr>
      </table>
      <table width="937" border="0" align="center">
        <tr>
          <td><strong><u>PAGOS POR LETRAS </u> </strong></td>
        </tr>
      </table>
      <table width="937" height="111" border="0" align="center" class="tabla2">
        <tr>
          <td valign="top"><table width="895" border="0" align="center">
              <tr>
                <td width="173">NUMERO DE LETRA </td>
                <td width="712"><input name="letra" type="text" id="letra" size="60" disabled="disabled"/></td>
              </tr>
              <tr>
                <td>PLAZO</td>
                <td>
                  <input name="plazo" type="text" id="plazo" disabled="disabled"/>
                </td>
              </tr>
          </table>
            <table width="895" border="0" align="center">
              <tr>
                <td width="173">BANCO</td>
                <td width="220">
				<select name="banco" id="banco" disabled="disabled">
              <?php 
				$sql = "SELECT * FROM titultabladet where tiptab = 'B' order by destab"; 
				$result = mysqli_query($conexion,$sql); 
				while ($row = mysqli_fetch_array($result))
				{ 
			  ?>
              <option value="<?php echo $row['codtab'];?>"><?php echo $row["destab"]; ?></option>
              <?php } 
			  ?>
            </select>
			</td>
                <td width="123">MONEDA</td>
                <td width="361"><select name="moneda" id="moneda" disabled="disabled">
                  <option value="1" selected="selected">SOLES</option>
                  <option value="2">DOLARES</option>
                                                </select></td>
              </tr>
            </table>
            <table width="895" border="0" align="center">
              <tr>
                <td width="173">FECHA PARA CANCELAR </td>
                <td width="220"><div style="position:relative; border:1px solid navy; width: 94px">
                  <input name="date2" type="text" id="calInput2" style="border-width:0px; width: 74px; font-size:12px;" readonly="true" value="<?php echo $dater;?>" disabled="disabled"/><img style="cursor:pointer;" onclick="showCalendar(2)" src="../../../funciones/codebase/imgs/calendar.gif" align="absmiddle" />
                  <div id="calendar2" style="position:absolute; left:94px; top:0px; display:none"></div>
                </div></td>
                <td width="123">FECHA PROGRAMADA </td>
                <td width="361"><div style="position:relative; border:1px solid navy; width: 94px">
                  <input name="date3" type="text" id="calInput3" style="border-width:0px; width: 74px; font-size:12px;" readonly="true" value="<?php echo $dater;?>" disabled="disabled"/><img style="cursor:pointer;" onclick="showCalendar(3)" src="../../../funciones/codebase/imgs/calendar.gif" align="absmiddle" />
                  <div id="calendar3" style="position:absolute; left:94px; top:0px; display:none"></div>
                </div></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <table width="937" height="25" border="0" align="center" class="tabla2">
        <tr>
          <td valign="top"><table width="907" border="0" align="center">
            <tr>
              <td>
                <div align="right">
                  <input name="numplan" type="hidden" id="numplan" value="<?php echo $numplan?>" />
                  <input name="invnum" type="hidden" id="invnum" value="<?php echo $invnum?>" />
                  <input type="button" name="Submit3" value="Grabar" <?php if ($saldo == 0){?> disabled="disabled"<?php }?> onclick="grabar()"/>
                  </div>
              </td>
            </tr>
          </table></td>
        </tr>
      </table>
      <table width="937" border="0" align="center">
        <tr>
          <td><strong><u>DETALLE DE PAGOS POR LETRAS  </u> </strong></td>
        </tr>
      </table>
      <table width="937" height="141" border="0" align="center" class="tabla2">
        <tr>
          <td valign="top">
		  <center>
		  <iframe src="por_pagar3.php?invnum=<?php echo $invnum?>" name="iFrame1" width="924" height="120" scrolling="Automatic" frameborder="0" id="iFrame1" allowtransparency="0">
		  </iframe>
		  </center>
		  </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>
<?php }
else
{
?>
<br>
<br><br><br><br><br>
<center><u>NO SE LOGRO ENCONTRAR INFORMACION CON LOS DATOS INGRESADOS</u></center>
<?php } //CIERRO EL VALID
} //CIERRO EL VAL
?>
</body>
</html>
