<?php
require_once('../session_user.php');
require_once('../../conexion.php');
require_once('../../titulo_sist.php');
require_once('../../convertfecha.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $desemp?></title>
<link href="css/style1.css" rel="stylesheet" type="text/css" /></head>
<?php require_once("../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../funciones/funct_principal.php");	//IMPRIMIR-NUME
$sql="SELECT nomusu FROM usuario where usecod = '$usuario'";
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
?>
<body>
<table width="930" border="0" align="center">
  <tr>
    <td>
	<table width="914" border="0">
      <tr>
        <td width="377"><strong><?php echo $desemp?></strong></td>
        <td width="235"><strong>REPORTE DE PRODUCTOS SIN MARCAS</strong></td>
        <td width="284"><div align="right"><strong>FECHA: <?php echo date('Y-m-d');?> - HORA : <?php echo $hour;?>:<?php echo $min;?> <?php echo $hor?></strong></div></td>
      </tr>
    </table>
    <table width="914" border="0">
        <tr>
          <td width="134"></td>
          <td width="633"</td>
          <td width="133"><div align="right">USUARIO:<span class="text_combo_select"><?php echo $user?></span></div></td>
        </tr>
    </table>
      
	</td>
  </tr>
</table>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="926" border="0" align="center">
      <tr>
        <td width="6%"><strong>N&ordm;</strong></td>
        <td width="88%"><div align="left"><strong>PRODUCTO</strong></div></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
	<?php
	$sql="SELECT desprod FROM producto where NOT EXISTS (SELECT * FROM titultabladet where tiptab = 'M' and titultabladet.codtab = producto.codmar) order by codpro";
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	?>
	<table width="926" border="0" align="center">
      <?php while ($row = mysqli_fetch_array($result)){
		$producto    = $row['desprod'];
		$marca       = $row['codmar'];
		$stopro      = $row['stopro'];
		$prevta      = $row['prevta'];
		$factor      = $row['factor'];
		$stopro      = $row[4];
		$i++;
	  ?>
	  <tr>
        <td width="6%"><?php echo $i?>-</td>
		<td width="88%"><?php echo $producto?></td>
      </tr>
	  <?php }
	  ?>
    </table>
	<?php }
	else
	{
	?>
	<center>No se logro encontrar informacion</center>
	<?php }
	?>
	</td>
  </tr>
</table>
</body>
</html>
