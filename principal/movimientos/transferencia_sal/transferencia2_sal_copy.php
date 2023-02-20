<?php include('../../session_user.php');
$invnum  = $_SESSION['transferencia_sal'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
<link href="../../../css/autocomplete.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../../funciones/ajax.js"></script>
<script type="text/javascript" src="../../../funciones/ajax-dynamic-list.js"></script>
<?php require_once ('../../../conexion.php');	//CONEXION A BASE DE DATOS
require_once("../funciones/transferencia.php");	//FUNCIONES DE ESTA PANTALLA
require_once("../../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
require_once("../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUMEROS ENTEROS-DECIMALES
require_once("../../../funciones/botones.php");	//COLORES DE LOS BOTONES
?>
<script>
function cerrar(e){
tecla=e.keyCode
	if (tecla == 27)
	{
	document.form1.submit();
	}
}
</script>
</head>
<?php $sql="SELECT codloc FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
		$codloc  = $row['codloc'];
}
}
$sql="SELECT nomloc FROM xcompa where codloc = '$codloc'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
    	$nomloc    = $row['nomloc'];
}
}
$val = $_POST['val'];
if ($val == 1)
{
	$producto =	$_POST['country_ID'];
	if ($producto <> "")
	{
		$sql1="SELECT codtemp FROM tempmovmov where codpro = '$producto' and invnum = '$invnum'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
			$search = 0;
		}
		else
		{
			$search = 1;
		}
	}
	else
	{
	$search = 0;
	}
}
else
{
$search = 0;
}
require_once('../tabla_local.php');
?>
<body onload="<?php if ($search==1){?>links()<?php } else{?>sf()<?php }?>" onkeyup="cerrar(event)">
<form id="form1" name="form1" onKeyUp="highlight(event)" onClick="highlight(event)" method="post">
  <table width="910" border="0">
    <tr>
      <td width="90">DESCRIPCION</td>
      <td width="614"><label>
         <input name="country" type="text" id="country" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)" value="" size="120"/>
        <input type="hidden" id="country_hidden" name="country_ID" />
      </label></td>
      <td width="192"><label>
        <input name="val" type="hidden" id="val" value="1" />
      </label></td>
    </tr>
  </table>
  <?php $val = $_POST['val'];
  if ($val ==1)
  {
  $i= 0;
  $producto =	$_POST['country_ID'];
    //$sql="SELECT codpro,desprod,codmar,$tabla FROM producto where desprod like '%$producto%' order by desprod";
	$sql="SELECT codpro,desprod,codmar,$tabla FROM producto where codpro = '$producto' order by desprod";
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
  ?>
  <table class="celda2" width="910">
    <tr>
      <td width="32" bgcolor="#50ADEA" class="titulos_movimientos">N&ordm;</td>
      <td width="379" bgcolor="#50ADEA" class="titulos_movimientos">DESCRIPCION</td>
      <td width="111" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">MARCA</div></td>
	  <td width="119" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">LOCAL</div></td>
	  <td width="72" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">CANT</div></td>
	  <td width="68" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">P. PROM</div></td>
      <td width="76" bgcolor="#50ADEA" class="titulos_movimientos"><div align="right">STOCK UNID </div></td>
      <td width="17" bgcolor="#50ADEA" class="titulos_movimientos">&nbsp;</td>
    </tr>
  </table>
  <table class="celda2" width="910">
    <?php while ($row = mysqli_fetch_array($result)){
			$i++;
			$codpro         = $row['codpro'];		//codgio
			$desprod        = $row['desprod'];
			$codmar         = $row['codmar'];
			$cant_loc       = $row[3];
			$sql1="SELECT ltdgen FROM titultabla where dsgen = 'MARCA'";
			$result1 = mysqli_query($conexion,$sql1);
			if (mysqli_num_rows($result1)){
			while ($row1 = mysqli_fetch_array($result1)){
				$ltdgen     = $row1['ltdgen'];	
			}
			}
			$sql1="SELECT destab FROM titultabladet where codtab = '$codmar' and tiptab = '$ltdgen'";
			$result1 = mysqli_query($conexion,$sql1);
			if (mysqli_num_rows($result1)){
			while ($row1 = mysqli_fetch_array($result1)){
				$marca     = $row1['destab'];	
			}
			}
			$sql1="SELECT codtemp FROM tempmovmov where codpro = '$codpro' and invnum = '$invnum'";
			$result1 = mysqli_query($conexion,$sql1);
			if (mysqli_num_rows($result1)){
				$control = 1;
			}
			else
			{
				$control = 0;
			}
	?>
	 <tr onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#ffffff';">
      <td width="32"><?php echo $i?></td>
      <td width="379">
	  <?php if ($control == 0){ 
	  	 if ($cant_loc > 0) 
		 {
	   ?>
	  		<a id="l1" href="transferencia2_sal_reg.php?cod=<?php echo $codpro?>" target="tranf_principal"><?php echo $desprod?></a>
	  		<?php }
	      else
	      {
	      echo $desprod;
	      }
	   }
	   else
	   {
	   echo $desprod;
	   }
	  ?>	  </td>
      <td width="111"><?php echo $marca?></td>
	  <td width="119"><?php echo $nomloc?></td>
      <td width="72"><div align="right"></div></td>
	  <td width="68"><div align="right"></div></td>
	  <td width="76"><div align="right"><?php echo $cant_loc?></div></td>
      <td width="17"><div align="center"><?php if ($control == 0){ if ($cant_loc > 0) {?> <a href="transferencia2_sal_reg.php?cod=<?php echo $codpro?>" target="_top"><img src="../../../images/add.gif" width="14" height="15" border="0"/></a><?php }}else{?><img src="../../../images/icon-16-checkin.png" width="16" height="16" border="0"/><?php }?></div></td>
    </tr>
	<?php }
	?>
  </table>
  <?php }
  else
  {
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
