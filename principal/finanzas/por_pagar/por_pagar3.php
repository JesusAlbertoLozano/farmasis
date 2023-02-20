<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/letras.css" rel="stylesheet" type="text/css" />
<title>Documento sin t&iacute;tulo</title>
<?php require_once('../../../conexion.php');	//CONEXION A BASE DE DATOS
?>
<script type="text/javascript">
var fila = null;
function pulsar(obj) {
  obj.style.background = '#FFFF99';
  if (fila != null && fila != obj)
    fila.style.background = '@ffffff';
  fila = obj;
}
</script>
<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<?php function formato($c) {
printf("%06d",$c);
} 
$sql1="SELECT invnum,invfec,nrocomp,provee,invtot,pendiente FROM ordmae where invnum = '$invnum'";	
$result1 = mysqli_query($conexion,$sql1);
if (mysqli_num_rows($result1)){
while ($row1 = mysqli_fetch_array($result1)){
    $invnum    = $row1['invnum'];
	$nrocomp   = $row1['nrocomp'];
	$provee    = $row1['provee'];
	$invtot    = $row1['invtot'];
}
}
$saldo_gen     = $invtot;
$sql1="SELECT invnum,fecpla,monpag,forpag,tipdoc FROM planilla where numdoc = '$invnum' order by fecpla asc";	
$result1 = mysqli_query($conexion,$sql1);
if (mysqli_num_rows($result1)){
?>
<table width="914" border="1" cellpadding="0" cellspacing="0" bgcolor="#993300">
  <tr>
    <td width="98"><span class="Estilo1">NUM PLANILLA </span></td>
    <td width="208"><span class="Estilo1">FECHA</span></td>
	<td width="229"><span class="Estilo1">TIPO DOCUMENTO</span></td>
	<td width="213"><span class="Estilo1">FORMA PAGO</span></td>
    <td width="74"><div align="right" class="Estilo1">MONTO</div></td>
    <td width="78"><div align="right" class="Estilo1">SALDO</div></td>
  </tr>
</table>
<table width="914" border="0">
  <?php while ($row1 = mysqli_fetch_array($result1)){
    $planilla    = $row1['invnum'];
	$fecpla      = $row1['fecpla'];
	$monpag      = $row1['monpag'];
	$forpag      = $row1['forpag'];
	$tipdoc      = $row1['tipdoc'];
	if ($tipdoc == "1")
	{
	$tipdoc_desc = "COMPRAS";
	}
	if ($tipdoc == "2")
	{
	$tipdoc_desc = "LETRAS";
	}
	if ($tipdoc == "3")
	{
	$tipdoc_desc = "DEVOLUCIONES O CANJES";
	}
	if ($forpag == "E")
	{
	$forpag_desc = "EFECTIVO";
	}
	if ($forpag == "L")
	{
	$forpag_desc = "LETRA";
	}
	if ($forpag == "D")
	{
	$forpag_desc = "DEPOSITO";
	}
	if ($forpag == "N")
	{
	$forpag_desc = "NOTA DE CREDITO";
	}
	$saldo_gen   = $saldo_gen - $monpag;
  ?>
  <tr onClick="pulsar(this)">
    <td width="96"><?php echo formato($planilla);?></td>
    <td width="208"><?php echo $fecpla?></td>
	<td width="222"><?php echo $tipdoc_desc?></td>
	<td width="210"><?php echo $forpag_desc?></td>
    <td width="74"><div align="right"><?php echo $monpag?></div></td>
    <td width="78"><div align="right"><strong><?php echo $numero_formato_frances = number_format($saldo_gen, 2, '.', ' ');?></strong></div></td>
  </tr>
  <?php }
  ?>
</table>
<?php }
?>
</body>
</html>
