<?php include('../../session_user.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="css/style1.css" rel="stylesheet" type="text/css" />
<link href="css/style2.css" rel="stylesheet" type="text/css" /><?php require_once('../../../conexion.php');	//CONEXION A BASE DE DATOS
require_once('../../../titulo_sist.php');
require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUME
$invnum    = $_REQUEST['invnum'];
function formato($c) {
printf("%08d",  $c);
} 
function formato1($c) {
printf("%06d",  $c);
} 
mysqli_query($conexion,"UPDATE ordmae set impreso = '1' where invnum = '$invnum'");
$sql="SELECT invfec,invnum,nrocomp,refere,invtot,codusu,provee,nrocomp FROM ordmae where invnum = '$invnum'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$invfec    = $row['invfec'];
	$invnum    = $row['invnum'];
	$tipmov    = $row['tipmov'];
	$numdoc    = $row['nrocomp'];
	$cuscod    = $row['cuscod'];
	$refere    = $row['refere'];
	$monto     = $row['invtot'];
	$codusu    = $row['codusu'];
	$provee    = $row['provee'];
}
}
$scanpro = 0;
$scanbon = 0;
$sql="SELECT canpro,factor FROM ordmov where invnum = '$invnum' and canpro <> '0'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$canpro    = $row['canpro'];
	$factor    = $row['factor'];
	$canpro	   = $canpro * $factor;
	$scanpro   = $scanpro + $canpro;
}
}
$sql="SELECT canbon,factor,tipbon FROM ordmov where invnum = '$invnum' and canpro = '0'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$canbon    = $row['canbon'];
	$factor    = $row['factor'];
	$tipbon    = $row['tipbon'];
	if ($tipbon == 'U')
	{
	$scanbon   = $scanbon + $canbon;
	}
	else
	{
	$canbon	   = $canbon * $factor;
	$scanbon   = $scanbon + $canbon;
	}
}
}
$dcto_bon = ($scanbon/($scanbon + $scanpro))*100;
$vn1 = $monto * 1.19;
$vn2 = $vn1 - $monto;
$vn  = ($monto - $vn2)+$dcto_bon;
$pn  = $monto +$dcto_bon;
$sql="SELECT nomusu FROM usuario where usecod = '$codusu'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$users    = $row['nomusu'];
}
}
$sql="SELECT despro,dirpro,telpro FROM proveedor where codpro = '$provee'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$proveedor   = $row['despro'];
	$dirpro      = $row['dirpro'];
	$telpro      = $row['telpro'];
}
}
?><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $desemp?></title>
</head>

<body>
<table width="930" border="0" align="center">
  <tr>
    <td><table width="914" border="0">
      <tr>
        <td width="260"><strong><?php echo $desemp?> </strong></td>
        <td width="380"><div align="center"><strong>
		<a href="javascript:imprimir()"><strong>ORDEN DE COMPRA</strong></div></td>
        <td width="260"><div align="right"><strong>FECHA: <?php echo $invfec;?></strong></div></td>
      </tr>
    </table>
        <table width="914" border="0">
          <tr>
            <td width="267"><strong></strong></td>
            <td width="366"><div align="center"><b></b></div></td>
            <td width="267"><div align="right">USUARIO:<span class="text_combo_select"><?php echo $users?></span></div></td>
          </tr>
        </table>
      <div align="center"><img src="../../../images/line2.png" width="910" height="4" /></div></td>
  </tr>
</table>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="926" border="0" align="center">
      <tr>
        <td width="92"><strong>RAZON SOCIAL </strong></td>
        <td width="824"><?php echo $proveedor?></td>
      </tr>
      <tr>
        <td><strong>DIRECCION</strong></td>
        <td><?php echo $dirpro?></td>
      </tr>
      <tr>
        <td><strong>TELEFONO</strong></td>
        <td><?php echo $telpro?></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="926" border="0" align="center">
      <tr>
        <td width="60"><strong>FECHA</strong>          <div align="left"></div></td>
        <td width="89"><div align="left"><strong>N&ordm; DOCUMENTO </strong></div>          <div align="left"></div></td>
        <td width="399"><div align="left"><strong>REFERENCIA</strong></div></td>
		<td width="93"><div align="right"><strong>DCTO BONIF</strong></div></td>
		<td width="92"><div align="right"><strong>VALOR NETO</strong></div></td>
		<td width="94"><div align="right"><strong>PRECIO NETO</strong></div></td>
        <td width="69"><div align="right"><strong>MONTO</strong></div></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="926" border="0" align="center">
          <tr>
            <td width="60"><?php echo $invfec?></td>
            <td width="89"><div align="left"><?php echo formato($numdoc);?></div></td>
			<td width="399"><div align="left">
			  <?php if ($refere <> "")
			{
			?>
              <?php echo substr($refere,0,20); echo "...";?>
              <?php }
			?>
			</div></td>
			<td width="93"><div align="right"><?php echo $numero_formato_frances = number_format($dcto_bon, 2, '.', ' ');?></div></td>
			<td width="92"><div align="right"><?php echo $numero_formato_frances = number_format($vn, 2, '.', ' ');?></div></td>
            <td width="94"><div align="right"><?php echo $numero_formato_frances = number_format($pn, 2, '.', ' ');?></div></td>
            <td width="69"><div align="right"><?php echo $numero_formato_frances = number_format($monto, 2, '.', ' ');?></div></td>
          </tr>
        </table>
    </td>
  </tr>
</table>
<div align="center"><img src="../../../images/line2.png" width="910" height="4" /></div>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="926" border="0" align="center">
      <tr>
        <td width="260"><strong>PRODUCTO</strong></td>
        <td width="94"><div align="right"><strong>CANTIDAD</strong></div></td>
        <td width="71"><div align="right"><strong>BONIF</strong></div></td>
        <td width="85"><div align="right"><strong>ATENDIDO</strong></div></td>
        <td width="61"><div align="right"><strong>SALDO </strong></div></td>
        <td width="70"><div align="right"><strong>PRECIO</strong></div></td>
        <td width="55"><div align="right"><strong>DCTO1</strong></div></td>
		<td width="55"><div align="right"><strong>DCTO2. </strong></div></td>
		<td width="55"><div align="right"><strong>DCTO3</strong></div></td>
		<td width="78"><div align="right"><strong>SUBTOTAL</strong></div></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
	<?php $sql="SELECT ordmae.invnum,nrocomp,codpro,canpro,canate,mont_total,desc1,desc2,desc3,precio_ref,costod,canbon,tipbon FROM ordmov inner join ordmae on ordmov.invnum = ordmae.invnum where ordmae.invnum = '$invnum'";
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	?>
	<table width="926" border="0" align="center">
      <?php while ($row = mysqli_fetch_array($result)){
	  		$invnum     = $row['invnum'];
			$nrocomp    = $row['nrocomp'];
			$codpro     = $row['codpro'];
			$canpro     = $row["canpro"];
			$canate     = $row["canate"];
			$costod     = $row["costod"];
			$precio_ref = $row["precio_ref"];
			$mont_total = $row["mont_total"];
			$desc1      = $row["desc1"];
			$desc2      = $row["desc2"];
			$desc3      = $row["desc3"];
			$canbon     = $row["canbon"];
			$tipbon     = $row["tipbon"];
			$sql1="SELECT desprod,factor FROM producto where codpro = '$codpro'";
			$result1 = mysqli_query($conexion,$sql1);
			if (mysqli_num_rows($result1)){
			while ($row1 = mysqli_fetch_array($result1)){
	  		$desprod    = $row1['desprod'];
			$factor     = $row1['factor'];
			}
			}
			/////ATENDIDA//////////////////////////////////
			/////////////////////////////////////
			$convert1   = $canate/$factor;
			$div1    	= floor($convert1);
			$mult1		= $factor * $div1;
			$tot1		= $canate - $mult1;
			/////RESULTANTE//////////////////////////////////
			$can_fact   = $canpro * $factor;
			$tot        = $can_fact - $canate;
			/////////////////////////////////////
			$convert    = $tot/$factor;
			$div    	= floor($convert);
			$mult		= $factor * $div;
			$tot		= $tot - $mult;
	  ?>
	  <tr>
        <td width="260"><?php echo $desprod; echo " "; if ($costod == 0){?>(BONIF)<?php }?></td>
        <td width="94"><div align="right">
          <?php if ($mont_total == 0) { echo $canbon; echo " "; echo $tipbon;} else{ echo $canpro;}?>
        </div></td>
        <td width="71"><div align="right">
          <?php if ($mont_total <> 0) { echo $canbon; if ($canbon <> 0){ echo " ";echo $tipbon;}}?>
        </div></td>
        <td width="85"><div align="right">
          <?php if ($mont_total == 0) { echo $canate; } else { echo $div1?>
F <?php echo $tot1; }?></div></td>
        <td width="61"><div align="right">
          <?php if ($mont_total == 0) { echo ($canbon - $canate);} else { echo $div?>
F <?php echo $tot; }?></div></td>
        <td width="70"><div align="right"><?php echo $precio_ref?></div></td>
        <td width="55"><div align="right"><?php echo $desc1?></div></td>
        <td width="55"><div align="right"><?php echo $desc2?></div></td>
		<td width="55"><div align="right"><?php echo $desc3?></div></td>
		<td width="78"><div align="right"><?php echo $mont_total?></div></td>
      </tr>
	  <?php }
	  ?>
    </table>
	<?php }
	?>
	</td>
  </tr>
</table>
</body>
</html>
