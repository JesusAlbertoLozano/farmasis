<?php 
$total_paginas = "";
include('../session_user.php');
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
<?php require_once("../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../funciones/funct_principal.php");	//IMPRIMIR-NUME
$sql="SELECT nomusu FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$user    = $row['nomusu'];
}
}
$date   = date('d/m/Y');
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
$val    	= isset($_REQUEST['val'])? ($_REQUEST['val']) : "";
$date1  	= isset($_REQUEST['date1'])? ($_REQUEST['date1']) : "";
$date2  	= isset($_REQUEST['date2'])? ($_REQUEST['date2']) : "";
$local  	= isset($_REQUEST['local'])? ($_REQUEST['local']) : "";
$inicio 	= isset($_REQUEST['inicio'])? ($_REQUEST['inicio']) : "";
$pagina 	= isset($_REQUEST['pagina'])? ($_REQUEST['pagina']) : "";
$ord    	= isset($_REQUEST['ord'])? ($_REQUEST['ord']) : "";
$tip    	= isset($_REQUEST['tip'])? ($_REQUEST['tip']) : "";
$tot_pag 	= isset($_REQUEST['tot_pag'])? ($_REQUEST['tot_pag']) : "";
$TipBusk 	= isset($_REQUEST['TipBusk'])? ($_REQUEST['TipBusk']) : "";
$registros  = isset($_REQUEST['registros'])? ($_REQUEST['registros']) : "";
$dat1		= $date1;
$dat2       = $date2;

if (strlen($date1)>0)
{
	$date1  	= fecha1($date1);
}
else
{
	$date1  	= $date;
}


if (strlen($date2)>0)
{
	$date2  	= fecha1($date2);
}
else
{
	$date2  	= $date;
}

if ($pagina == 1)
{
$i=0;
}
else
{
$t = $pagina - 1;
$i = $t * $registros;
}
function tablaslocal($nomloc)
{
	if ($nomloc == "LOCAL0")
	{
		$tabla = 's000';
	}
	if ($nomloc == "LOCAL1")
	{
		$tabla = 's001';
	}
	if ($nomloc == "LOCAL2")
	{
		$tabla = 's002';
	}
	if ($nomloc == "LOCAL3")
	{
		$tabla = 's003';
	}
	if ($nomloc == "LOCAL4")
	{
		$tabla = 's004';
	}
	if ($nomloc == "LOCAL5")
	{
		$tabla = 's005';
	}
	if ($nomloc == "LOCAL6")
	{
		$tabla = 's006';
	}
	if ($nomloc == "LOCAL7")
	{
		$tabla = 's007';
	}
	if ($nomloc == "LOCAL8")
	{
		$tabla = 's008';
	}
	if ($nomloc == "LOCAL9")
	{
		$tabla = 's009';
	}
	if ($nomloc == "LOCAL10")
	{
		$tabla = 's010';
	}
	if ($nomloc == "LOCAL11")
	{
		$tabla = 's011';
	}
	if ($nomloc == "LOCAL12")
	{
		$tabla = 's012';
	}
	if ($nomloc == "LOCAL13")
	{
		$tabla = 's013';
	}
	if ($nomloc == "LOCAL14")
	{
		$tabla = 's014';
	}
	if ($nomloc == "LOCAL15")
	{
		$tabla = 's015';
	}
	if ($nomloc == "LOCAL16")
	{
		$tabla = 's016';
	}
	return $tabla;
}
if ($local <> 'all')
{
	$sql="SELECT nomloc FROM xcompa where codloc = '$local'";
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	while ($row = mysqli_fetch_array($result)){
		$nomloc    = $row['nomloc'];
	}
	}
        $Tabla = tablaslocal($nomloc);
}
else
{
   $Tabla = "0"; 
}
?>
<body>
<table width="930" border="0" align="center">
  <tr>
    <td><table width="914" border="0">
      <tr>
        <td width="260"><strong><?php echo $desemp?> </strong></td>
        <td width="380">
		<div align="center"><strong>REPORTE CURVA ABC - 
          <?php if ($local == 'all'){ echo 'TODAS LAS SUCURSALES';} else { echo $nomloc;}?>
        </strong></div>
		</td>
        <td width="260">
		<div align="right"><strong>FECHA: <?php echo date('d/m/Y');?> - HORA : <?php echo $hour;?>:<?php echo $min;?> <?php echo $hor?></strong></div></td>
      </tr>

    </table>
      <table width="914" border="0">
        <tr>
          <td width="134"><strong>PAGINA <?php echo $pagina;?> de <?php echo $tot_pag?></strong></td>
          <td width="633">
		  <div align="center">
		  <b>
		  <?php if ($val == 1){?>
            FECHAS ENTRE EL <?php echo $dat1; ?> Y EL <?php echo $dat2; }?>
		  </b>
		  </div>
		  </td>
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
        <td width="38"><strong>N�</strong></td>
        <td width="321"><div align="left"><strong>PRODUCTO </strong></div></td>
        <td width="169"><div align="left"><strong>MARCA</strong></div></td>
        <td width="68">
            <div align="right"><strong> 
		<a href="curvaa2.php?val=<?php echo $val?>&date1=<?php echo $date1?>&date2=<?php echo $date2?>&local=<?php echo $local?>&inicio=<?php echo $inicio?>&registros=<?php echo $registros?>&pagina=<?php echo $pagina?>&tot_pag=<?php echo $total_paginas?>&ord=1&tip=1"><img src="down_enabled.gif" width="7" height="9" border="0" /></a>
		MONTO
		<a href="curvaa2.php?val=<?php echo $val?>&date1=<?php echo $date1?>&date2=<?php echo $date2?>&local=<?php echo $local?>&inicio=<?php echo $inicio?>&registros=<?php echo $registros?>&pagina=<?php echo $pagina?>&tot_pag=<?php echo $total_paginas?>&ord=0&tip=1"><img src="up_enabled.gif" width="7" height="9" border="0"/></a>
		</strong>
            </div>
        </td>
        <td width="87">
            <div align="right"><strong> 
		<?php /*?><a href="curva2.php?val=<?php echo $val?>&date1=<?php echo $date1?>&date2=<?php echo $date2?>&local=<?php echo $local?>&inicio=<?php echo $inicio?>&registros=<?php echo $registros?>&pagina=<?php echo $pagina?>&tot_pag=<?php echo $total_paginas?>&ord=1&tip=2"><img src="down_enabled.gif" width="7" height="9" border="0" /></a> <?php */?>
		UNIDADES
		<?php /*?>
		<a href="curva2.php?val=<?php echo $val?>&date1=<?php echo $date1?>&date2=<?php echo $date2?>&local=<?php echo $local?>&inicio=<?php echo $inicio?>&registros=<?php echo $registros?>&pagina=<?php echo $pagina?>&tot_pag=<?php echo $total_paginas?>&ord=0&tip=2"><img src="up_enabled.gif" width="7" height="9" border="0"/></a><?php */?>
		</strong>
            </div>
        </td>
        <td width="58"><div align="right"><strong>STOCK</strong></div></td>
        <td width="77"><div align="right"><strong>% DEL TOTAL</strong></div></td>
        <td width="78"><div align="right"><strong>TOTAL DEL % </strong></div></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
	<table width="920" border="0" align="center">
<?php
if ($tip == "")
{
$tip = 1;
}
if ($tip == 1)
{
	if ($local == 'all')
	{
	//$sql="SELECT sum(invtot) FROM venta where invfec between '$date1' and '$date2' and val_habil = '0'";
	$sql="SELECT sum(invtot) FROM venta where invfec between '$date1' and '$date2' and val_habil = '0' and estado = '0'";
	}
	else
	{
	//$sql="SELECT sum(invtot) FROM venta where invfec between '$date1' and '$date2' and sucursal = '$local' and val_habil = '0'";
	$sql="SELECT sum(invtot) FROM venta where invfec between '$date1' and '$date2' and val_habil = '0' and estado = '0'";
	}
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	while ($row = mysqli_fetch_array($result)){
	$tot       = $row[0];
	}
	}
	$sumporc = 0;
	//----------------------//
	if ($ord == 1)
	{
		if ($local == 'all')
		{
		//$sql="SELECT sum(pripro),codpro FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum where detalle_venta.invfec between '$date1' and '$date2' and val_habil = '0' group by codpro order by sum(pripro) asc";
		$sql="SELECT sum(DV.pripro),DV.codpro 
		FROM detalle_venta DV
		inner join venta V on DV.invnum = V.invnum 
		where DV.invfec between '$date1' and '$date2' and V.val_habil = '0' and V.estado = '0' 
        group by DV.codpro 
        order by sum(DV.pripro) asc";
		}
		else
		{
		//$sql="SELECT sum(pripro),codpro FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum where detalle_venta.invfec between '$date1' and '$date2' and sucursal = '$local' and val_habil = '0' group by codpro order by sum(pripro) asc";
		$sql="SELECT sum(DV.pripro),DV.codpro 
		FROM detalle_venta DV
		inner join venta V on DV.invnum = V.invnum
		where DV.invfec between '$date1' and '$date2' and V.val_habil = '0' and V.sucursal = '$local' and V.estado = '0' 
		group by DV.codpro 
		order by sum(DV.pripro) asc";
		}
	}
	else
	{
		if ($local == 'all')
		{
		//$sql="SELECT sum(pripro),codpro FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum where detalle_venta.invfec between '$date1' and '$date2' and val_habil = '0' group by codpro order by sum(pripro) desc";
		$sql="SELECT sum(DV.pripro),DV.codpro 
		FROM detalle_venta DV
		inner join venta V on DV.invnum = V.invnum 
		where DV.invfec between '$date1' and '$date2' and V.val_habil = '0' and V.estado = '0' 
		group by DV.codpro 
		order by sum(DV.pripro) desc";
		}
		else
		{
		//$sql="SELECT sum(pripro),codpro FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum where detalle_venta.invfec between '$date1' and '$date2' and sucursal = '$local' and val_habil = '0' group by codpro order by sum(pripro) desc";
		$sql="SELECT sum(DV.pripro),DV.codpro 
		FROM detalle_venta DV
		inner join venta V on DV.invnum = V.invnum 
		where DV.invfec between '$date1' and '$date2' and V.val_habil = '0' and V.sucursal = '$local' and V.estado = '0' 
		group by DV.codpro 
		order by sum(DV.pripro) desc";
		}
	}
	//echo $sql."<br>";
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	while ($row = mysqli_fetch_array($result)){
	    
		$cantidad     = 0;
		$sumcantidad  = 0;
		$sum       = $row[0];
		$codpro    = $row['codpro'];
		if ($local == 'all')
		{
		//$sql1="SELECT venta.invnum,canpro,fraccion,factor FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum where detalle_venta.invfec between '$date1' and '$date2' and codpro = '$codpro' and val_habil = '0'";
		$sql1="SELECT V.invnum,DV.canpro,DV.fraccion,DV.factor 
		FROM detalle_venta DV
		inner join venta V on DV.invnum = V.invnum 
        inner join producto P on P.codpro = DV.codpro
		where DV.invfec between '$date1' and '$date2' and DV.codpro = '$codpro' and V.val_habil = '0' and V.estado = '0'";
		}
		else
		{
		//$sql1="SELECT venta.invnum,canpro,fraccion,factor FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum where detalle_venta.invfec between '$date1' and '$date2' and codpro = '$codpro' and sucursal = '$local' and val_habil = '0'";
		$sql1="SELECT V.invnum,DV.canpro,DV.fraccion,DV.factor 
		FROM detalle_venta DV
		inner join venta V on DV.invnum = V.invnum 
        inner join producto P on P.codpro = DV.codpro
		where DV.invfec between '$date1' and '$date2' and DV.codpro = '$codpro' and V.sucursal = '$local' and V.val_habil = '0' and V.estado = '0'";
		}
		//echo $sql1;exit;
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
		$invnum        = $row1['invnum'];
		$canpro        = $row1['canpro'];
		$fraccion      = $row1['fraccion'];
		$factor        = $row1['factor'];
			if ($fraccion == 'T')
			{
			$cantidad = $canpro;
			}
			else
			{
			$cantidad = $canpro * $factor;
			}
			$sumcantidad = $sumcantidad + $cantidad;
		}
		}
                if ($factor > 1)
                {
                    $convert1       = $sumcantidad/$factor;
                    $div1           = floor($convert1);
                    $mult1          = $factor * $div1;
                    $tot1           = $sumcantidad - $mult1;
                    $sumcantidad    = $div1.' F '.$tot1;
                }
                if ($Tabla <> "0")
                {
                    $sql1="SELECT desprod,codmar,$Tabla,factor FROM producto where codpro = '$codpro'";
                }
                else
                {
                    $sql1="SELECT desprod,codmar,stopro,factor FROM producto where codpro = '$codpro'";
                }
                //echo $Tabla.' - '.$sql1."<br><br>";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
		$desprod       = $row1['desprod'];
		$codmar        = $row1['codmar'];
                $StockActual   = $row1[2];
                $factorX       = $row1['factor'];
                $StockP        = $StockActual;
		}
		}
                
                if ($factorX > 1)
                {
                    $convert1X       = $StockActual/$factorX;
                    $div1X           = floor($convert1X);
                    $mult1X          = $factorX * $div1X;
                    $tot1X           = $StockActual - $mult1X;
                    $StockActual     = $div1X.' F '.$tot1X;
                }
                //echo $codpro." - ".$desprod.' - '.$StockP." - ".$factorX."<br>";
		$sql1="SELECT destab,abrev FROM titultabladet where codtab = '$codmar'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
		$destab        = $row1['destab'];
		$abrev        = $row1['abrev'];
						if ($abrev <> '')
						{
						$destab = $abrev;
						}
		}
		}
		$porcentaje = ($sum/$tot)*100;
		$sumporc    = $sumporc + $porcentaje;
                if ($TipBusk == 1)
                {
                    $Mostrar = 1;
                }
                if ($TipBusk == 2)
                {
                    if ($StockP == 0)
                    {
                        $Mostrar = 1;
                    }
                    else
                    {
                        $Mostrar = 0;
                    }
                    
                }
                if ($TipBusk == 3)
                {
                    if ($StockP < $sumcantidad)
                    {
                        $Mostrar = 1;
                    }
                    else
                    {
                        $Mostrar = 0;
                    }
                    
                }
                if ($Mostrar == 1)
                {
                   $i++;
	?>
	  <tr>
            <td width="38"><?php echo $i;?></td>
            <td width="321"><?php echo $desprod?></td>
            <td width="169"><?php echo $destab?></td>
            <td width="68"><div align="right"><?php echo $sum?></div></td>
            <td width="87"><div align="right"><?php echo $sumcantidad?></div></td>
            <td width="58"><div align="right"><?php echo $StockActual;?></div></td>
            <td width="77"><div align="right"><?php echo number_format($porcentaje, 2, '.', ' ');?> %</div></td>
            <td width="78"><div align="right"><?php echo number_format($sumporc, 2, '.', ' ');?> %</div></td>
          </tr>
	<?php 
                }
        }
	}
	else
	{
	?>
	<center><u>NO SE LOGRO ENCONTRAR INFORMACION CON LOS DATOS INDICADOS</u></center>
	<?php }
}
	?>
    </table></td>
  </tr>
</table>
</body>
</html>
