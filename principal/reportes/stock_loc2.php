<?php include('../session_user.php');
require_once('../../conexion.php');
require_once('../../titulo_sist.php');
require_once('../../convertfecha.php');	//CONEXION A BASE DE DATOS
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
$min			= date('i');
if ($hour <= 12)
{
    $hor    = "am";
}
else
{
    $hor    = "pm";
}
$val   			= $_REQUEST['val'];
$country		= $_REQUEST['country'];
$report			= $_REQUEST['report'];
$inicio 		= $_REQUEST['inicio'];
$pagina 		= $_REQUEST['pagina'];
$tot_pag 		= $_REQUEST['tot_pag'];
$registros  	= $_REQUEST['registros'];
function formato($c) {
printf("%06d",$c);
} 
function convertir_a_numero($str)
{
	  $legalChars = "%[^0-9\-\. ]%";
	  $str=preg_replace($legalChars,"",$str);
	  return $str;
}
?>
<body>
<table width="98%" border="0">
  <tr>
    <td width="100%">
      <table width="100%" border="0">
        <tr>
          <td width="278"><strong><?php echo $desemp?> </strong></td>
            <td width="563"><div align="center"><strong>REPORTE DE STOCK DE PRODUCTOS</strong></div></td>
            <td width="278"><div align="right"><strong>FECHA: <?php echo date('d/m/Y');?> - HORA : <?php echo $hour;?>:<?php echo $min;?> <?php echo $hor?></strong></div></td>
        </tr>
      </table>
      <table width="100%" border="0">
        <tr>
          <td width="278">&nbsp;</td>
            <td width="565"><div align="center"><b><?php if ($val == 1){ echo $country; }?></b></div></td>
            <td width="276"><div align="right">USUARIO:<span class="text_combo_select"><?php echo $user?></span></div></td>
        </tr>
      </table>
      <div align="left"><img src="../../images/line2.png" width="940" height="4" /></div></td>
  </tr>
</table>
<?php if ($val == 1)
{
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL0'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[0] = 'LC0';
	}
	else
	{
	$des[0] = substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL1'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[1] = 'LC1';
	}
	else
	{
	$des[1] =  substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL2'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[2] = 'LC2';
	}
	else
	{
	$des[2] =  substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL3'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[3] = 'LC3';
	}
	else
	{
	$des[3] =  substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL4'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[4] = 'LC4';
	}
	else
	{
	$des[4] = substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL5'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[5] = 'LC5';
	}
	else
	{
	$des[5] =  substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL6'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[6] = 'LC6';
	}
	else
	{
	$des[6] =  substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL7'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[7] = 'LC7';
	}
	else
	{
	$des[7] =  substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL8'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[8] = 'LC8';
	}
	else
	{
	$des[8] =  substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL9'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[9] = 'LC9';
	}
	else
	{
	$des[9] =  substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL10'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[10] = 'LC10';
	}
	else
	{
	$des[10] =  substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL11'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[11] = 'LC11';
	}
	else
	{
	$des[11] =  substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL12'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[12] = 'LC12';
	}
	else
	{
	$des[12] =  substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL13'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[13] = 'LC13';
	}
	else
	{
	$des[13] =  substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL14'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[14] = 'LC14';
	}
	else
	{
	$des[14] =  substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL15'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[15] = 'LC15';
	}
	else
	{
	$des[15] =  substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL16'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[16] = 'LC16';
	}
	else
	{
	$des[16] =  substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL17'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[17] = 'LC17';
	}
	else
	{
	$des[17] =  substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL18'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[18] = 'LC18';
	}
	else
	{
	$des[18] =  substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL19'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[19] = 'LC19';
	}
	else
	{
	$des[19] =  substr($nomlocs,0,3);
	}
  }
  }
  $sql="SELECT codloc,nombre FROM xcompa where nomloc = 'LOCAL20'";
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result))
  {
  	$nomlocs     = $row['nombre'];
	if ($nomlocs == '')
	{
	$des[20] = 'LC20';
	}
	else
	{
	$des[20] =  substr($nomlocs,0,3);
	}
  }
  }
?>
<table width="98%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>
        <table width="100%" border="0">
      <tr>
		<td width="220"><strong>PRODUCTO</strong></td>
		<td width="100"><div align="center"><strong>MARCA</strong></div></td>
                <td width="33"><div align="right"><?php echo $des[0];?></div></td>
		<td width="33"><div align="right"><?php echo $des[1];?></div></td>
		<td width="33"><div align="right"><?php echo $des[2];?></div></td>
		<td width="33"><div align="right"><?php echo $des[3];?></div></td>
		<td width="33"><div align="right"><?php echo $des[4];?></div></td>
		<td width="33"><div align="right"><?php echo $des[5];?></div></td>
		<td width="33"><div align="right"><?php echo $des[6];?></div></td>
		<td width="33"><div align="right"><?php echo $des[7];?></div></td>
		<td width="33"><div align="right"><?php echo $des[8];?></div></td>
		<td width="33"><div align="right"><?php echo $des[9];?></div></td>
		<td width="33"><div align="right"><?php echo $des[10];?></div></td>
		<td width="33"><div align="right"><?php echo $des[11];?></div></td>
		<td width="33"><div align="right"><?php echo $des[12];?></div></td>
		<td width="30"><div align="right"><?php echo $des[13];?></div></td>
		<td width="33"><div align="right"><?php echo $des[14];?></div></td>
		<td width="33"><div align="right"><?php echo $des[15];?></div></td>
		<td width="33"><div align="right"><?php echo $des[16];?></div></td>
		<td width="33"><div align="right"><?php echo $des[17];?></div></td>
		<td width="33"><div align="right"><?php echo $des[18];?></div></td>
		<td width="33"><div align="right"><?php echo $des[19];?></div></td>
		<td width="33"><div align="right"><?php echo $des[20];?></div></td>
        <td width="43"><div align="right"><strong>TOTAL</strong></div></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="98%" border="1" cellpadding="0" cellspacing="0">
	  <?php 
	  //echo $country;
	  $sql="SELECT codpro,desprod,codmar,stopro,s000,s001,s002,s003,s004,s005,s006,s007,s008,s009,s010,s011,s012,s013,s014,s015,s016,s017,s018,s019,s020 FROM producto inner join titultabladet on codtab = codmar where destab like '$country%' and tiptab = 'M' order by desprod";
	  $result = mysqli_query($conexion,$sql);
	  if (mysqli_num_rows($result)){
	  while ($row = mysqli_fetch_array($result)){
		$abrev		= "";
		$destab		= "";
		$stopro1    = 0;
		$s000		= 0;
		$s001		= 0;
		$s002		= 0;
		$s003		= 0;
		$s004		= 0;
		$s005		= 0;
		$s006		= 0;
		$s007		= 0;
		$s008		= 0;
		$s009		= 0;
		$s010		= 0;
		$s011		= 0;
		$s012		= 0;
		$s013		= 0;
		$s014		= 0;
		$s015		= 0;
		$s016		= 0;
		$s017		= 0;
		$s018		= 0;
		$s019   	= 0;
		$s020		= 0;
		$codpro     = $row['codpro'];
		$desprod    = $row['desprod'];
		$codmar     = $row['codmar'];
		$s000       = (isset($row['s000']) ? $row['s000'] : 0);
		$s001       = $row['s001'];
		$s002       = $row['s002'];
		$s003       = $row['s003'];
		$s004       = $row['s004'];
		$s005       = $row['s005'];
		$s006       = $row['s006'];
		$s007       = $row['s007'];
		$s008       = $row['s008'];
		$s009       = $row['s009'];
		$s010       = $row['s010'];
		$s011       = $row['s011'];
		$s012       = $row['s012'];
		$s013       = $row['s013'];
		$s014       = $row['s014'];
		$s015       = $row['s015'];
		$s016       = $row['s016'];
		$s017       = $row['s017'];
		$s018       = $row['s018'];
		$s019       = $row['s019'];
		$s020       = $row['s020'];
		$stopro     = $row['stopro'];
		$stopro1    =  $s000 + $s001 + $s002 + $s003 + $s004 + $s005 + $s006 + $s007 + $s008 + $s009 + $s010 + $s011 + $s012 + $s013 + $s014 + $s015 + $s016 + $s017 + $s018 + $s019 + $s020;
		if ($codmar <> 0)
		{
                    
		  $sql1="SELECT abrev,destab FROM titultabladet where codtab = '$codmar'";
		  $result1 = mysqli_query($conexion,$sql1);
		  if (mysqli_num_rows($result1)){
		  while ($row1 = mysqli_fetch_array($result1)){
		  $abrev     = $row1['abrev'];
		  $destab    = $row1['destab'];
		  }
		  }
		  else
		  {
		  $abrev == "";
		  }
		  if ($abrev == "")
		  {
		  $abrev = $destab;
		  }
		}
		else
		{
		$abrev = "";
		}
	  ?>
	  <tr>
                <td width="180"><?php echo $desprod?></td>
		<td width="70"><?php echo $abrev;?></td>
                <td width="33"><div align="right"><?php echo $s000?></div></td>
		<td width="33"><div align="right"><?php echo $s001?></div></td>
		<td width="33"><div align="right"><?php echo $s002?></div></td>
		<td width="33"><div align="right"><?php echo $s003?></div></td>
		<td width="33"><div align="right"><?php echo $s004?></div></td>
		<td width="33"><div align="right"><?php echo $s005?></div></td>
		<td width="33"><div align="right"><?php echo $s006?></div></td>
		<td width="33"><div align="right"><?php echo $s007?></div></td>
		<td width="33"><div align="right"><?php echo $s008?></div></td>
		<td width="33"><div align="right"><?php echo $s009?></div></td>
		<td width="33"><div align="right"><?php echo $s010?></div></td>
		<td width="33"><div align="right"><?php echo $s011?></div></td>
		<td width="33"><div align="right"><?php echo $s012?></div></td>
		<td width="33"><div align="right"><?php echo $s013?></div></td>
		<td width="33"><div align="right"><?php echo $s014?></div></td>
		<td width="33"><div align="right"><?php echo $s015?></div></td>
		<td width="33"><div align="right"><?php echo $s016?></div></td>
		<td width="33"><div align="right"><?php echo $s017?></div></td>
		<td width="33"><div align="right"><?php echo $s018?></div></td>
		<td width="33"><div align="right"><?php echo $s019?></div></td>
		<td width="33"><div align="right"><?php echo $s020?></div></td>
        <td width="45"><div align="right"><?php echo $stopro1;?></div></td>
      </tr>
	  <?php }
	  }
	  else
	  {
	  ?>
	  <center><br /><br /><br /><br />NO SE PUDO ENCONTRAR INFORMACI�N CON LOS DATOS INGRESADOS</center>
	  <?php }
	  ?>
</table>
<?php }
?>
</body>
</html>
