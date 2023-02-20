<?php include('../../../session_user.php');
$ord_compra   = $_SESSION['ord_compra'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../css/style1.css" rel="stylesheet" type="text/css" />
<link href="../css/style2.css" rel="stylesheet" type="text/css" />
<?php require_once('../../../../conexion.php');	//CONEXION A BASE DE DATOS
require_once("../../../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
//require_once("../../../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../../../funciones/botones.php");	//COLORES DE LOS BOTONES
require_once("../../../../funciones/funct_principal.php");	//IMPRIMIR-NUME
require_once("../../../local.php");	//LOCAL DEL USUARIO
function formato($c) {
printf("%04d",$c);
} 
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
<?php $sql="SELECT provee FROM ordmae where invnum = '$ord_compra'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$provee    = $row['provee'];
}
}
?>
<body onload="getfocus();" id="body">
<form name="form1" id="form1" onClick="highlight(event)" onKeyUp="highlight(event)">
  <table width="880" border="0">
    <tr>
      <td width="890"><?php $sql="SELECT codpro,despro,dirpro,telpro,rucpro FROM proveedor order by despro";
		$result = mysqli_query($conexion,$sql);
		if (mysqli_num_rows($result)){
		?>
<table width="874" border="0" id="myTab">
		<?php while ($row = mysqli_fetch_array($result)){
		    $codpro     = $row['codpro'];
			$despro     = $row['despro'];
			$dirpro     = $row['dirpro'];
			$telpro     = $row['telpro'];
			$rucpro     = $row['rucpro'];
		?>
          <tr bgcolor="<?php if ($provee == $codpro){?>#FFFF99<?php } else {?>#ffffff<?php }?>" onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='<?php if ($provee == $codpro){?>#FFFF99<?php } else {?>#ffffff<?php }?>';">
            <td width="66"><?php echo formato($codpro)?></td>
            <td width="522"><a href="add_proveedor.php?proveedor=<?php echo $codpro?>" target="compra_index"><?php echo $despro?></a></td>
            <td width="109"><?php echo $rucpro?></td>
            <td width="100"><?php echo $telpro?></td>
            <td width="71">
			<div align="right">
			<a href="add_proveedor.php?proveedor=<?php echo $codpro?>" target="compra_index">
			<?php if ($provee == $codpro){?>
			<img src="../../../../images/icon-16-checkin.png" width="16" height="16" border="0"/>
			<?php } else {?>
			<img src="../../../../images/add.gif" width="16" height="16" border="0"/>
			<?php }?>
			</a>
			</div>
			</td>
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
