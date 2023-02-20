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
<link href="css/style1.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>
<?php 
require_once("../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../funciones/funct_principal.php");	//IMPRIMIR-NUME
$sql="SELECT nomusu FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$user    = $row['nomusu'];
}
}
$date   = date('Y/m/d');
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
$val    = $_REQUEST['val'];
$date1  = $_REQUEST['date1'];
$date2  = $_REQUEST['date2'];
$local  = $_REQUEST['local'];
$inicio = $_REQUEST['inicio'];
$pagina = $_REQUEST['pagina'];
$tot_pag = $_REQUEST['tot_pag'];
$resumen = $_REQUEST['resumen'];
$registros  = $_REQUEST['registros'];
$dat1	= $date1;
$dat2   = $date2;


$D1=  substr($date1,0,-2);
$D2=  substr($date2,0,-2);

$D1=$D1."00";
$D2=$D2."00";
//$date1  = fecha1($date1);
//$date2  = fecha1($date2);
if ($resumen == 1)
{
$desc_resumen = "RESUMEN POR SUCURSAL";
}
if ($resumen == 2)
{
$desc_resumen = "RESUMEN POR VENDEDOR";
}
if ($resumen == 3)
{
$desc_resumen = "RESUMEN POR MARCA";
}
if ($resumen == 4)
{
$desc_resumen = "RESUMEN POR PRODUCTO";
}
if ($resumen == 5)
{
$desc_resumen = "RESUMEN POR LINEA Y USO DEL PRODUCTO";
}
if ($local <> 'all')
{
	$sql="SELECT nomloc,nombre FROM xcompa where codloc = '$local'";
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	while ($row = mysqli_fetch_array($result)){
		$nomloc    = $row['nomloc'];
		$nombre    = $row['nombre'];
		if ($nombre <> "")
		{
		$nomloc = $nombre;
		}
	}
	}
}
?>
<body>
<table width="930" border="0" align="center">
  <tr>
    <td><table width="914" border="0">
      <tr>
        <td width="260"><strong><?php echo $desemp?> </strong></td>
        <td width="380"><div align="center"><strong>REPORTE DE PRODUCTOS POR VENCER - 
          <?php if ($local == 'all'){ echo 'TODAS LAS SUCURSALES';} else { echo $nomloc;}?>
        </strong></div></td>
        <td width="260"><div align="right"><strong>FECHA: <?php echo date('d/m/Y');?> - HORA : <?php echo $hour;?>:<?php echo $min;?> <?php echo $hor?></strong></div></td>
      </tr>

    </table>
      <table width="914" border="0">
        <tr>
          <td width="134"><strong>PAGINA <?php echo $pagina;?> de <?php echo $tot_pag?></strong></td>
          <td width="633"><div align="center"><b><?php if ($val == 1){?>FECHAS ENTRE EL <?php echo $dat1; ?> Y EL <?php echo $dat2; }?></b></div></td>
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
        <td width="80"><strong>SUCURSAL</strong></td>
		<td width="120"><div align="left"><strong>PRODUCTO </strong></div></td>
        <td width="73"><div align="LEFT"><strong>MARCA</strong></div></td>
        <td width="73"><div align="right" class="Estilo1"><strong>VENCIMIENTO</strong></div></td>
        <td width="30"><div align="right"><strong>STOCK</strong></div></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php if ($local == 'all')
	{
	$sql="SELECT codpro,vencim,codloc,stock,STR_TO_DATE(vencim, '%m/%Y') as FE from movlote where STR_TO_DATE(vencim, '%m/%Y') between '$D1' and '$D2'  AND  stock > 0  ORDER BY FE";
	}
	else
	{
	$sql="SELECT codpro,vencim,codloc,stock,STR_TO_DATE(vencim, '%m/%Y') as FE from movlote where STR_TO_DATE(vencim, '%m/%Y') between '$D1' and '$D2'  and codloc = '$local' AND  stock > 0  ORDER BY FE";
	}
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	?>
        <table width="926" border="0" align="center">
          <?php 
          while ($row = mysqli_fetch_array($result)){
		$codpro  = $row['codpro'];
		$vencim  = $row['vencim'];
		$codloc  = $row['codloc'];
		$stock  = $row['stock'];
		
                
		$sql1="SELECT desprod,codmar FROM producto WHERE codpro='$codpro'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
			$codmar    = $row1['codmar'];
			$desprod      = $row1['desprod'];
			}
		}
                $sql1="SELECT destab,abrev FROM titultabladet where codtab = '$codmar'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
			$destab    = $row1['destab'];
			
		}
		}
		$sql1="SELECT nomloc,nombre FROM xcompa where codloc = '$codloc'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
			$sucursal    = $row1['nomloc'];
			$nombre      = $row1['nombre'];
			if ($nombre <> "")
			{
			$sucursal = $nombre;
			}
		}
		}
	  ?>
          <tr>
            <td width="70"><?php echo $sucursal?></td>
            <td width="130"><div align="left"><?php echo $desprod?></div></td>
            <td width="60"><div align="left"><?php echo $destab?></div></td>
            <td width="40"><div align="right" class="Estilo1"><?php echo $vencim?></div></td>
            <td width="45"><div align="right"><?php echo $stock?></div></td>
          </tr>
          <?php }
	  ?>
        </table>
      <?php }
	else
	{
	?>
        <center>
          No se logro encontrar informacion con los datos ingresados <?$dat1;?>
        </center>
      <?php }
	?>
    </td>
  </tr>
</table>
<?php }	///CIERRE DE VAL = 1
?>
</body>
</html>
