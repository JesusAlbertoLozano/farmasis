<?php include('../../session_user.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
<?php require_once ('../../../conexion.php');	//CONEXION A BASE DE DATOS
require_once("../funciones/devolucion.php");	//FUNCIONES DE ESTA PANTALLA
require_once("../../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUMEROS ENTEROS-DECIMALES
?>
</head>
<body onload="fc()">
<?php $invnum = $_REQUEST['invnum'];
	$sql="SELECT * FROM detalle_venta where invnum = '$invnum'";
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
?>
<form id="form1" name="form1" onKeyUp="highlight(event)" onClick="highlight(event)">
<table class="celda2" width="939">
    <tr>
      <td width="362" bgcolor="#50ADEA" class="titulos_movimientos">DESCRIPCION</td>
	  <td width="53" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">CAJA</div></td>
	  <td width="53" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">UNID</div></td>
	  <td width="239" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">MARCA</div></td>
	  <td width="76" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">P.PROMEDIO</div></td>
	  <td width="80" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">SUB TOT</div></td>
	  <td width="44" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center"></div></td>
    </tr>
  </table>
  <table class="celda2" width="939">
    <?php $i = 0;
	while ($row = mysqli_fetch_array($result)){
			$i++;
			$codpro         = $row['codpro'];
			$canpro         = $row['canpro'];	
			$fraccion       = $row['fraccion'];
			$prisal         = $row['prisal'];	
			$pripro         = $row['pripro'];	
			$sql1="SELECT porcent FROM datagen";
			$result1 = mysqli_query($conexion,$sql1);
			if (mysqli_num_rows($result1)){
			while ($row1 = mysqli_fetch_array($result1)){
				$porcent    = $row1['porcent'];
			}
			}
			$sql1="SELECT desprod,codmar,factor FROM producto where codpro = '$codpro'";
			$result1 = mysqli_query($conexion,$sql1);
			if (mysqli_num_rows($result1)){
			while ($row1 = mysqli_fetch_array($result1)){
				$desprod    = $row1['desprod'];
				$codmar     = $row1['codmar'];
				$factor     = $row1['factor'];	
			}
			}
			$sql1="SELECT * FROM titultabla where dsgen = 'MARCA'";
			$result1 = mysqli_query($conexion,$sql1);
			if (mysqli_num_rows($result1)){
			while ($row1 = mysqli_fetch_array($result1)){
				$ltdgen     = $row1['ltdgen'];	
			}
			}
			$sql1="SELECT * FROM titultabladet where codtab = '$codmar' and tiptab = '$ltdgen'";
			$result1 = mysqli_query($conexion,$sql1);
			if (mysqli_num_rows($result1)){
			while ($row1 = mysqli_fetch_array($result1)){
				$marca     = $row1['destab'];	
			}
			}
			$valform = $_REQUEST['valform'];
			$cod     = $_REQUEST['cod'];
	?>
	 <tr onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#ffffff';">
      <td width="364" valign="bottom">
		<a title="EL FACTOR ES <?php echo $factor?>"><?php echo $desprod?></a>	  </td>
      <td width="52" valign="bottom"><div align="right">
        <?php if (($valform == 1) && ($cod == $codpro)) { ?>
        <input type="hidden" name="stockpro" value="<?php echo $cant_loc;?>"/>
        <input type="hidden" name="factor" value="<?php echo $factor;?>"/>
        <input type="hidden" name="codpro" value="<?php echo $codpro;?>"/>
        <input name="t1" type="text" class="input_text1" id="t1" value="<?php if ($fraccion == "T"){echo $canpro; } if ($fraccion == "F") { $canpro = "c".$canpro; echo $canpro;}?>" size="4" onkeyup ="precio1();" onkeypress="return c(event)" />
		<?php }
		?>
       <?php if ($fraccion == "F"){echo $canpro;}else{ echo "0";}?></div></td>
	  <td width="52" valign="bottom"><div align="right"><?php if ($fraccion == "T"){echo $canpro;}else{ echo "0";}?></div></td>
	  <td width="239" valign="bottom"><?php echo $marca?></td>
	  <td width="76" valign="bottom"><div align="right"><?php echo $prisal;?></div></td>
      <td width="80" valign="bottom"><div align="right"><?php echo $pripro;?></div></td>
	  <td width="44" valign="bottom"><div align="right">
	    <?php if (($valform == 1) && ($cod == $codpro)) { ?>
        <input name="number" type="hidden" id="number" />
        <input name="invnum" type="hidden" id="invnum" value="<?php echo $invnum?>" />
        <input name="button" type="button" id="boton" onclick="validar_prod()" alt="GUARDAR"/>
        <input name="button" type="button" id="boton1" onclick="validar_grid()" alt="ACEPTAR"/>
        <?php } else { ?>
        <a href="devolucion2.php?cod=<?php echo $codpro?>&invnum=<?php echo $invnum?>&valform=1"><img src="../../../images/edit_16.png" width="16" height="16" border="0"/></a>
        <?php }?>
	  </div></td>
     </tr>
	<?php }
	?>
  </table>
  <?php }
  else
  {
  ?>
  <br><br><br><br><br><br><br><br><center>NO EXISTEN PRODUCTOS PARA ESTE DOCUMENTO</center>
  <?php }
  ?> 
</form>
</body>
</html>
