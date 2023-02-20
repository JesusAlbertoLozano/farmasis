<link href="css/style1.css" rel="stylesheet" type="text/css" /></head>
<?php 
$date = date('Y-m-d');
$hour   = date('G');   
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
//$val    = $_REQUEST['val'];
//$local  = $_REQUEST['local'];
//$inicio = $_REQUEST['inicio'];
//$pagina = $_REQUEST['pagina'];
$tot_pag = $_REQUEST['tot_pag'];
//$registros  = $_REQUEST['registros'];
if ($local == 1)
{
$local = 'all';
}
if ($local <> 'all')
{
require_once("datos_generales.php");
}
?>
<body>
<table width="930" border="0" align="center">
  <tr>
    <td><table width="914" border="0">
      <tr>
        <td width="361"><strong><?php echo $desemp?></strong></td>
        <td width="221"><strong>REPORTE DE PRODUCTOS POR PRECIOS </strong></td>
        <td width="30">&nbsp;</td>
        <td width="284"><div align="right"><strong>FECHA: <?php echo date('d/m/Y');?> - HORA : <?php echo $hour;?>:<?php echo $min;?> <?php echo $hor?></strong></div></td>
      </tr>

    </table>
      <table width="914" border="0">
        <tr>
          <td width="134"></td>
          <td width="633"><div align="center"><b><?php if ($local == 'all'){ echo 'TODOS LOS LOCALES';} else { echo $nomloc;}?></b></div></td>
          <td width="133"><div align="right">USUARIO:<span class="text_combo_select"><?php echo $user?></span></div></td>
        </tr>
      </table>
      <div align="center"><img src="../../images/line2.png" width="910" height="4" /></div></td>
  </tr>
</table>
<?php if ($val == 1)
{
?>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="926" border="0" align="center">
      <tr>
        <td width="82"><strong>CODIGO</strong></td>
        <td width="559"><div align="left"><strong>PRODUCTO</strong></div></td>
		<td width="103"><div align="right"><strong>PRECIO DE COSTO</strong></div></td>
        <td width="80"><div align="right"><strong>MARGEN</strong></div></td>
		<td width="80"><div align="right"><strong>PRECIO VTA</strong></div></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
	<?php $i=0;
	if ($local == 'all')
	{
	$sql="SELECT codpro,desprod,pcostouni,preuni,margene FROM producto order by desprod LIMIT $inicio,$registros";
	}
	else
	{
	$sql="SELECT codpro,desprod,pcostouni,preuni,margene FROM producto where $tabla > 0 order by desprod LIMIT $inicio, $registros";
	}
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	?>
	<table width="926" border="0" align="center">
      <?php while ($row = mysqli_fetch_array($result)){
		$producto    = $row['desprod'];
		$codpro      = $row['codpro'];
		$pcostouni   = $row['pcostouni'];
		$preuni      = $row['preuni'];
		$margene     = $row['margene'];
		$i++;
	  ?>
	  <tr>
        <td width="82"><?php echo $codpro?></td>
		<td width="559"><?php echo $producto?></td>
        <td width="103"><div align="right"><?php echo $pcostouni?></div></td>
        <td width="80"><div align="right"><?php echo $margene;?></div></td>
		<td width="80"><div align="right"><?php echo $preuni;?></div></td>
        </tr>
	  <?php }
	  ?>
    </table>
	<?php }
	else
	{
	?>
	<center>No se logro encontrar informacion con los datos ingresados</center>
	<?php }
	?>
	</td>
  </tr>
</table>
<?php }			//////cierro el if (val)
?>

