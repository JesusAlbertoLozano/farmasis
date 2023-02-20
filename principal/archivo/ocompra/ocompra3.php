<?php include('../../session_user.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="css/style1.css" rel="stylesheet" type="text/css" />
<?php require_once('../../../conexion.php');	//CONEXION A BASE DE DATOS
require_once("../../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
//require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../../funciones/botones.php");	//COLORES DE LOS BOTONES
require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUME
require_once("../../local.php");	//LOCAL DEL USUARIO
function formato($c) {
printf("%06d",$c);
} 
$invnum = $_REQUEST['invnum'];
?>
<style type="text/css">
<!--
.Estilo1 {
	color: #666666;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<form name="form1" id="form1" onClick="highlight(event)" onKeyUp="highlight(event)">
  <table width="938" border="0">
    <tr>
      <td width="932">
	    <?php if ($invnum <> "")
		{
		$sql="SELECT ordmae.invnum,nrocomp,codpro,canpro,canate,mont_total,desc1,desc2,desc3,precio_ref,costod,canbon,tipbon FROM ordmov inner join ordmae on ordmov.invnum = ordmae.invnum where ordmae.invnum = '$invnum'";
		}
		else
		{
		$sql="SELECT ordmae.invnum,nrocomp,codpro,canpro,canate,mont_total,desc1,desc2,desc3,precio_ref,costod,canbon,tipbon FROM ordmov inner join ordmae on ordmov.invnum = ordmae.invnum where estado = '0' order by invfec desc,invnum desc";
		}
		$result = mysqli_query($conexion,$sql);
		if (mysqli_num_rows($result)){
		?>
<table width="932" border="0">
		<?php while ($row = mysqli_fetch_array($result)){
		$invnum = $row['invnum'];
		$nrocomp = $row['nrocomp'];
		$codpro = $row['codpro'];
		$canpro = $row["canpro"];
		$canate = $row["canate"];
		$costod = $row["costod"];
		$precio_ref = $row["precio_ref"];
		$mont_total = $row["mont_total"];
		$desc1  = $row["desc1"];
		$desc2  = $row["desc2"];
		$desc3  = $row["desc3"];
		$canbon = $row["canbon"];
		$tipbon = $row["tipbon"];
		$sql1="SELECT desprod,factor FROM producto where codpro = '$codpro'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
		$producto = $row1['desprod'];
		$factor   = $row1["factor"];
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
          <tr <?php if ($costod == 0){?> bgcolor="#FFCC66"<?php } else{?>onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#FFFFFF';"<?php }?>>
            <td width="59"><?php echo formato($nrocomp)?></td>
            <td width="70"><?php echo $codpro?></td>
            <td width="59">
			<div align="right"><?php if ($mont_total == 0) { echo $canbon; echo " "; echo $tipbon;} else{ echo $canpro;}?></div>
			</td>
			<td width="63"><div align="right"><?php if ($mont_total <> 0) { echo $canbon; if ($canbon <> 0){ echo " ";echo $tipbon;}}?></div></td>
            <td width="57"><div align="right"><?php if ($mont_total == 0) { echo $canate; } else { echo $div1?> F <?php echo $tot1; }?></div></td>
            <td width="51" bgcolor="#FFFF99"><div align="right"><?php if ($mont_total == 0) { echo ($canbon - $canate);} else { echo $div?> F <?php echo $tot; }?></div></td>
			<td width="230"><?php echo substr($producto,0,65); echo "...";?></td>
            <td width="58"><div align="right"><?php echo $precio_ref?></div></td>
            <td width="57"><div align="right"><?php echo $desc1?></div></td>
            <td width="57"><div align="right"><?php echo $desc2?></div></td>
            <td width="55"><div align="right"><?php echo $desc3?></div></td>
			<td width="66"><div align="right"><?php echo $mont_total?></div></td>
          </tr>
		  <?php }
		  ?>
        </table>
		<?php }
		?>
	  </td>
    </tr>
  </table>
</form>
</body>
</html>
