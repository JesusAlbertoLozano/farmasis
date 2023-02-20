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
<body>
<?php $val = $_REQUEST['val'];
$sql="SELECT provee FROM ordmae where invnum = '$ord_compra'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$provee    = $row['provee'];
}
}
?>
<form name="form1" id="form1" onClick="highlight(event)" onKeyUp="highlight(event)">
  <table width="880" border="0">
    <tr>
      <td width="880">
	    <?php $i = 0;
		if (($val == 1) || ($val==3) || ($val == ''))
		{
		$sql="SELECT codtab,destab FROM titultabladet where tiptab= 'M' order by destab";
		}
		else
		{
		$sql="SELECT titultabladet.codtab,destab FROM titultabladet inner join provlab on titultabladet.codtab = provlab.codtab where tiptab = 'M' and codpro = '$provee' order by destab";
		}
		$result = mysqli_query($conexion,$sql);
		if (mysqli_num_rows($result)){
		?>
<table width="874" border="0">
		<?php while ($row = mysqli_fetch_array($result)){
		    $codtab     = $row['codtab'];
			$destab     = $row['destab'];
			$sql1="SELECT * FROM temp_marca where codtab= '$codtab'";
			$result1 = mysqli_query($conexion,$sql1);
			if (mysqli_num_rows($result1))
			{
				$marca_act = 1;
			}
			else
			{
				$marca_act = 0;
			}
			$i++;
		?>
          <tr bgcolor="<?php if ($marca_act==1){?>#FFFF99<?php } else {?>#ffffff<?php }?>" onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='<?php if ($marca_act==1){?>#FFFF99<?php } else {?>#ffffff<?php }?>';">
            <td width="66"><?php echo $i?></td>
            <td width="741">
			<?php if ($marca_act == 1){?> 
			<a href="del_marca.php?codtab=<?php echo $codtab?>" target="compra_index">
			<font color="#009933"><?php echo $destab;?></font>
			</a>
			<?php }
			else
			{ 
			?>
			<a href="add_marca.php?codtab=<?php echo $codtab?>" target="compra_index">
			<?php echo $destab;
			?>
			</a>
			<?php }
			?>
			</td>
            <td width="69">
              <div align="right">
			  <?php if ($marca_act == 1){?>
			  <a href="del_marca.php?codtab=<?php echo $codtab?>" target="compra_index">
			  <img src="../../../../images/del_16.png" width="16" height="16" border="0"/ title="QUITAR">
			  </a>
			  <?php }
			  else
			  {
			  ?>
			  <a href="add_marca.php?codtab=<?php echo $codtab?>" target="compra_index">
			  <img src="../../../../images/add.gif" width="14" height="15" border="0" title="AGREGAR"/>
			  </a>
			  <?php }
			  ?>
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
