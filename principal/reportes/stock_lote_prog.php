<?php include('../session_user.php');
require_once('../../conexion.php');
require_once('../../titulo_sist.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $desemp?></title>
</head>
<?php require_once("../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../funciones/funct_principal.php");	//IMPRIMIR-NUME
$sql="SELECT * FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$user    = $row['nomusu'];
}
}
$hour   = date('G');
//$date	= CalculaFechaHora($hour); 
$date = date("Y-m-d");
//$hour   = CalculaHora($hour);
$min	= date('i');
if ($hour <= 12)
{
    $hor    = "am";
}
else
{
    $hor    = "pm";
}
$val    = $_REQUEST['val'];
$desc   = $_REQUEST['desc'];
$tipo   = $_REQUEST['tipo'];
$local  = $_REQUEST['local'];
if ($local <> 'all')
{
	$sql="SELECT nomloc FROM xcompa where codloc = '$local'";
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	while ($row = mysqli_fetch_array($result)){
		$nomloc    = $row['nomloc'];
	}
	}
}
if ($tipo == 1)
{
$desc_tipo = "PRODUCTO";
}
else
{
$desc_tipo = "MARCA";
}
?>
<body>
<table width="930" border="0" align="center">
  <tr>
    <td><table width="914" border="0">
      <tr>
        <td width="260"><strong><?php echo $desemp?></strong></td>
        <td width="380"><div align="center"><strong>REPORTE DE STOCK POR LOTES </strong></div></td>
        <td width="260"><div align="right"><strong>FECHA: <?php echo date('d/m/Y');?> - HORA : <?php echo $hour;?>:<?php echo $min;?> <?php echo $hor?></strong></div></td>
      </tr>

    </table>
      <table width="914" border="0">
        <tr>
          <td width="134"><strong>PAGINA # </strong></td>
          <td width="633"><div align="center"><b>REPORTE POR <?php echo $desc_tipo?> - <?php echo $desc?></b></div></td>
          <td width="133"><div align="right">USUARIO:<span class="text_combo_select"><?php echo $user?></span></div></td>
        </tr>
      </table>
      <div align="center"><img src="../../images/line2.png" width="910" height="4" /></div></td>
  </tr>
</table>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="926" border="0" align="center">
      <tr>
        <td width="33"><strong>N&ordm;</strong></td>
        <td width="428"><div align="left"><strong>PRODUCTO </strong></div></td>
		<td width="286"><div align="left"><strong>MARCA </strong></div></td>
		<td width="77"><div align="right"><strong>STOCK </strong></div></td>
		<td width="80"><div align="center"><strong>VER DETALLE </strong></div></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
	<?php $c = 0;
	if ($tipo == 1)
	{
	$sql="SELECT codpro,desprod,destab,s000 FROM producto inner join titultabladet on producto.codmar = titultabladet.codtab where desprod like '$desc%'";
	}
	else
	{
	$sql="SELECT codpro,desprod,destab,s000 FROM producto inner join titultabladet on producto.codmar = titultabladet.codtab where tiptab = 'M' and destab like '$desc%' order by codpro";
	}
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	?>
	<table width="926" border="0" align="center">
      <?php while ($row = mysqli_fetch_array($result)){
		$codpro      = $row['codpro'];
		$producto    = $row['desprod'];
		$marca       = $row['destab'];
		$s000        = (isset($row['s000']) ? $row['s000'] : 0);
		$c++;
	  ?>
	  <tr>
        <td width="33"><?php echo $c;?></td>
        <td width="428"><?php echo $producto;?></td>
		<td width="286"><?php echo $marca;?></td>
		<td width="77"><div align="right"><?php echo $s000;?></div></td>
		<td width="80"><center><a href="javascript:popUpWindow('ver_stock_lote.php?codpro=<?php echo $codpro?>', 20, 90, 985, 500)">VER MAS</a></center></td>
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
