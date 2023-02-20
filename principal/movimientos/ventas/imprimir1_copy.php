<?php require_once('../../session_user.php');
require_once('../../../conexion.php');	//CONEXION A BASE DE DATOS
require_once('../../../titulo_sist.php');	//CONEXION A BASE DE DATOS
//require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS
require_once('../montos_text.php');
require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUME
$venta   = $_SESSION['venta'];
$hour  = date('G');
$min   = date('i');
$hora  = $hour . ":" . $min;
$sql = "SELECT * FROM venta where invnum = '$venta'";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result)) {
	while ($row = mysqli_fetch_array($result)) {
		$invnum       = $row['invnum'];		//codgio
		$nrovent      = $row['nrovent'];
		$invfec       = $row['invfec'];
		$cuscod       = $row['cuscod'];
		$usecod       = $row['usecod'];
		$codven       = $row['codven'];
		$forpag       = $row['forpag'];
		$fecven       = $row['fecven'];
		$sucursal     = $row['sucursal'];
		if ($forpag == 'E') {
			$forma_pago = 'EFECTIVO';
		}
		if ($forpag == 'T') {
			$forma_pago = 'TARJETA';
		}
		if ($forpag == 'C') {
			$forma_pago = 'CREDITO';
		}
		$var['nrovent'] = $nrovent;
		$var['invfec']  = $invfec;
		$var['cuscod']  = $cuscod;
		$var['usecod']  = $usecod;
		$var['forpag']  = $forma_pago;
	}
}
$sql = "SELECT nomusu FROM usuario where usecod = '$usecod'";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result)) {
	while ($row = mysqli_fetch_array($result)) {
		$nomusu       = $row['nomusu'];
		$var['nomusu']  = $nomusu;
	}
}
$sql = "SELECT descli,dircli,ruccli FROM cliente where codcli = '$cuscod'";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result)) {
	while ($row = mysqli_fetch_array($result)) {
		$descli       = $row['descli'];
		$dircli       = $row['dircli'];
		$ruccli       = $row['ruccli'];
		$var['descli']  = $descli;
		$var['dircli']  = $dircli;
		$var['ruccli']  = $ruccli;
	}
}
//ENCABEZADO
$i = 1;
$rd = $_REQUEST['rd'];
$sql = "SELECT linea,columna,descbrev,campo,cuanto FROM formato inner join titultabladet on formato.descripcion = titultabladet.codtab where sucursal = '$sucursal' and tipodoc = '$rd' and titulo = 'CB' and state = '1' order by linea, columna";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result)) {
	while ($row = mysqli_fetch_array($result)) {
		$lin           = $row['linea'];
		$col   		   = $row['columna'];
		$desc   	   = $row['descbrev'];
		$cam	       = $row['campo'];
		$long	       = $row['cuanto'];
		if ($lin == 1) {
			$i = $col;
		}
		if ($lin == 2) {
			if ($col == 1) {
				$i = 4;
			}
			if ($col == 2) {
				$i = 5;
			}
			if ($col == 3) {
				$i = 6;
			}
		}
		if ($lin == 3) {
			if ($col == 1) {
				$i = 7;
			}
			if ($col == 2) {
				$i = 8;
			}
			if ($col == 3) {
				$i = 9;
			}
		}
		$columna[$i]     = $col;
		$descbrev[$i]    = $desc;
		$campo[$i]       = $cam;
		$linea[$i]		 = $lin;
		$longs[$i]		 = $long;
		//$i++;
	}
}
//PIE DE PAGINA
$i = 1;
$sql = "SELECT linea,columna,descbrev,campo,cuanto FROM formato inner join titultabladet on formato.descripcion = titultabladet.codtab where sucursal = '$sucursal' and tipodoc = '$rd' and titulo = 'PIE' and state = '1' order by linea, columna";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result)) {
	while ($row = mysqli_fetch_array($result)) {
		$lin1          = $row['linea'];
		$col1   	   = $row['columna'];
		$desc1   	   = $row['descbrev'];
		$cam1	       = $row['campo'];
		$long1	       = $row['cuanto'];
		if ($lin1 == 1) {
			$i = $col1;
		}
		if ($lin1 == 2) {
			if ($col1 == 1) {
				$i = 4;
			}
			if ($col1 == 2) {
				$i = 5;
			}
			if ($col1 == 3) {
				$i = 6;
			}
		}
		if ($lin1 == 3) {
			if ($col1 == 1) {
				$i = 7;
			}
			if ($col1 == 2) {
				$i = 8;
			}
			if ($col1 == 3) {
				$i = 9;
			}
		}
		$columna1[$i]     = $col1;
		$descbrev1[$i]    = $desc1;
		$campo1[$i]       = $cam1;
		$linea1[$i]		  = $lin1;
		$longs1[$i]		  = $long1;
		//$i++;
	}
}
//echo $campo[9];
$sql = "SELECT fdisp,flinpag,fini,fcanti,fcodpro,fmarca,fpreuni,fmonto,fdescuento,fnom,fref FROM xcompa where codloc = '$sucursal'";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result)) {
	while ($row = mysqli_fetch_array($result)) {
		$fdisp         = $row['fdisp'];
		$flinpag       = $row['flinpag'];
		$fini          = $row['fini'];
		$fcanti        = $row['fcanti'];
		$fmarca        = $row['fmarca'];
		$fcodpro       = $row['fcodpro'];
		$fpreuni       = $row['fpreuni'];
		$fmonto        = $row['fmonto'];
		$fdescuento    = $row['fdescuento'];
		$fnom          = $row['fnom'];
		$fref          = $row['fref'];
	}
}
function formato($c)
{
	printf("%08d",  $c);
}
function formato1($c)
{
	printf("%06d",  $c);
}
function orden($g)
{
	global $fcanti;
	global $fmarca;
	global $fcodpro;
	global $fpreuni;
	global $fmonto;
	global $fdescuento;
	global $fnom;
	global $fref;
	if ($fcanti == $g) {
		echo "CANTIDAD";
	}
	if ($fmarca == $g) {
		echo "MARCA";
	}
	if ($fcodpro == $g) {
		echo "CODIGO";
	}
	if ($fpreuni == $g) {
		echo "PRECIO";
	}
	if ($fmonto == $g) {
		echo "SUB TOTAL";
	}
	if ($fdescuento == $g) {
		echo "DCTOS";
	}
	if ($fnom == $g) {
		echo "DESCRIPCION";
	}
	if ($fref == $g) {
		echo "PRECIO REF";
	}
}
function ancho($u)
{
	global $fcanti;
	global $fmarca;
	global $fcodpro;
	global $fpreuni;
	global $fmonto;
	global $fdescuento;
	global $fnom;
	global $fref;
	if ($fcanti == $u) {
		echo 74;
	}
	if ($fmarca == $u) {
		echo 157;
	}
	if ($fcodpro == $u) {
		echo 40;
	}
	if ($fpreuni == $u) {
		echo 67;
	}
	if ($fmonto == $u) {
		echo 68;
	}
	if ($fdescuento == $u) {
		echo 68;
	}
	if ($fnom == $u) {
		echo 264;
	}
	if ($fref == $u) {
		echo 87;
	}
}
function muestra($y)
{
	global $codpro;
	global $desprod;
	global $marca;
	global $precio_ref;
	global $descuento;
	global $fraccion;
	global $canpro;
	global $prisal;
	global $pripro;
	global $fcanti;
	global $fmarca;
	global $fcodpro;
	global $fpreuni;
	global $fmonto;
	global $fdescuento;
	global $fnom;
	global $fref;
	if ($fcanti == $y) {
		echo '<div align="right"><font size="-1">';
		if ($fraccion == "T") {
			echo $canpro;
		}
		if ($fraccion == "F") {
			$canpro = "c" . $canpro;
			echo $canpro;
		}
		echo '</font></div>';
	}
	if ($fmarca == $y) {
		echo '<font size="-1">';
		echo $marca;
		echo '</font>';
	}
	if ($fcodpro == $y) {
		echo '<font size="-1">';
		echo $codpro;
		echo '</font>';
	}
	if ($fpreuni == $y) {
		echo '<div align="right"><font size="-1">';
		echo $prisal;
		echo '</font></div>';
	}
	if ($fmonto == $y) {
		echo '<div align="right"><font size="-1">';
		echo $pripro;
		echo '</font></div>';
	}
	if ($fdescuento == $y) {
		echo '<div align="right"><font size="-1">';
		echo $numero_formato_frances = number_format($descuento, 0, '.', ' ');
		echo '</font> %</div>';
	}
	if ($fnom == $y) {
		echo '<font size="-1">';
		echo $desprod;
		echo '</font>';
	}
	if ($fref == $y) {
		echo '<div align="right"><font size="-1">';
		echo $numero_formato_frances = number_format($precio_ref, 2, '.', ' ');
		echo '</font></div>';
	}
}
if ($rd == 1) {
	$descm = "FACTURA";
}
if ($rd == 2) {
	$descm = "BOLETA DE VENTA";
}
if ($rd == 3) {
	$descm = "TICKET INTERNO";
}
require_once('calcula_monto.php');	//CONEXION A BASE DE DATOS
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>IMPRESION DE VENTA</title>
	<link href="../../../css/print.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		a:link {
			color: #666666;
		}

		a:visited {
			color: #666666;
		}

		a:hover {
			color: #666666;
		}

		a:active {
			color: #666666;
		}
	</style>
	<SCRIPT LANGUAGE="JavaScript">
		/* function imprimir() {
			if (window.print)
				window.print()
			else
				alert("Disculpe, su navegador no soporta esta opci�n.");
		} */
	</SCRIPT>
	<?php ?>
	<script>
		function escapes(e) {
			tecla = e.keyCode
			if (tecla == 27) {
				document.form1.action = "imprimir.php";
				document.form1.submit();
				//window.close();
			}
		}
	</script>
</head>

<body onkeyup="escapes(event)">
	<form name="form1" id="form1">
		<table width="869" border="0" bordercolor="#666666">
			<tr>
				<td>
					<div align="center"><a href="javascript:imprimir()"><b><?php echo $descm ?></b></a></div>
					<table width="857" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">
						<tr>
							<td>
								<table width="847" border="0" align="center">
									<tr>
										<td width="126">
											<?php if (($linea[1] == 1) and ($columna[1] == 1)) {
												echo '<b>';
												echo $descbrev[1];
												echo '</b>';
												$c1 = $campo[1];
											}
											?>
										</td>
										<td width="409"><?php if ($c1 == 'hora') {
															echo $hora;
														} else {
															echo substr($var[$c1], 0, $longs[1]);
														} ?></td>
										<td width="119">
											<?php if (($linea[2] == 1) and ($columna[2] == 2)) {
												echo '<b>';
												echo $descbrev[2];
												echo '</b>';
												$c2 = $campo[2];
											}
											?>
										</td>
										<td width="175"><?php if ($c2 == 'hora') {
															echo $hora;
														} else {
															echo substr($var[$c2], 0, $longs[2]);
														} ?></td>
										<td width="119">
											<?php if (($linea[3] == 1) and ($columna[3] == 3)) {
												echo '<b>';
												echo $descbrev[3];
												echo '</b>';
												$c3 = $campo[3];
											}
											?>
										</td>
										<td width="175"><?php if ($c3 == 'hora') {
															echo $hora;
														} else {
															echo substr($var[$c3], 0, $longs[3]);
														} ?></td>
									</tr>
									<tr>
										<td>
											<?php if (($linea[4] == 2) and ($columna[4] == 1)) {
												echo '<b>';
												echo $descbrev[4];
												echo '</b>';
												$c4 = $campo[4];
											}
											?>
										</td>
										<td><?php if ($c4 == 'hora') {
												echo $hora;
											} else {
												echo substr($var[$c4], 0, $longs[4]);
											} ?></td>
										<td>
											<?php if (($linea[5] == 2) and ($columna[5] == 2)) {
												echo '<b>';
												echo $descbrev[5];
												echo '</b>';
												$c5 = $campo[5];
											}
											?>
										</td>
										<td><?php if ($c5 == 'hora') {
												echo $hora;
											} else {
												echo substr($var[$c5], 0, $longs[5]);
											} ?></td>
										<td>
											<?php if (($linea[6] == 2) and ($columna[6] == 3)) {
												echo '<b>';
												echo $descbrev[6];
												echo '</b>';
												$c6 = $campo[6];
											}
											?>
										</td>
										<td><?php if ($c6 == 'hora') {
												echo $hora;
											} else {
												echo substr($var[$c6], 0, $longs[6]);
											} ?></td>
									</tr>
									<tr>
										<td>
											<?php if (($linea[7] == 3) and ($columna[7] == 1)) {
												echo '<b>';
												echo $descbrev[7];
												echo '</b>';
												$c7 = $campo[7];
											}
											?>
										</td>
										<td><?php if ($c7 == 'hora') {
												echo $hora;
											} else {
												echo substr($var[$c7], 0, $longs[7]);
											} ?></td>
										<td>
											<?php if (($linea[8] == 3) and ($columna[8] == 2)) {
												echo '<b>';
												echo $descbrev[8];
												echo '</b>';
												$c8 = $campo[8];
											}
											?>
										</td>
										<td><?php if ($c8 == 'hora') {
												echo $hora;
											} else {
												echo substr($var[$c8], 0, $longs[8]);
											} ?></td>
										<td>
											<?php if (($linea[9] == 3) and ($columna[9] == 3)) {
												echo '<b>';
												echo $descbrev[9];
												echo '</b>';
												$c9 = $campo[9];
											}
											?>
										</td>
										<td><?php if ($c9 == 'hora') {
												echo $hora;
											} else {
												echo substr($var[$c9], 0, $longs[9]);
											} ?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<br>
					<table width="857" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">
						<tr>
							<td width="<?php ancho(1); ?>"><strong><?php orden(1) ?></strong></td>
							<td width="<?php ancho(2); ?>"><strong><?php orden(2); ?></strong></td>
							<td width="<?php ancho(3); ?>"><strong><?php orden(3); ?></strong></td>
							<td width="<?php ancho(4); ?>"><strong><?php orden(4); ?></strong></td>
							<td width="<?php ancho(5); ?>"><strong><?php orden(5); ?></strong></td>
							<td width="<?php ancho(6); ?>"><strong><?php orden(6); ?></strong></td>
							<td width="<?php ancho(7); ?>"><strong><?php orden(7); ?></strong></td>
							<td width="<?php ancho(8); ?>"><strong><?php orden(8); ?> </strong></td>
						</tr>
					</table>
					<table width="857" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">
						<tr>
							<td>
								<table width="851" border="0" align="center">
									<?php $i = 1;
									$sql = "SELECT * FROM temp_venta where invnum = '$venta'";
									$result = mysqli_query($conexion, $sql);
									if (mysqli_num_rows($result)) {
										while ($row = mysqli_fetch_array($result)) {
											$codtemp      = $row['codtemp'];
											$codpro       = $row['codpro'];		//codgio
											$canpro       = $row['canpro'];
											$fraccion     = $row['fraccion'];
											$factor       = $row['factor'];
											$prisal       = $row['prisal'];
											$pripro       = $row['pripro'];
											$fraccion     = $row['fraccion'];
											if ($fraccion == "F") {
												$cantemp = $canpro * $factor;
											} else {
												$cantemp = $canpro;
											}
											$sql1 = "SELECT codpro,desprod,codmar,factor,costpr,stopro,incentivado,prelis,prevta,preuni FROM producto where codpro = '$codpro'";
											$result1 = mysqli_query($conexion, $sql1);
											if (mysqli_num_rows($result1)) {
												while ($row1 = mysqli_fetch_array($result1)) {
													$codpro     = $row1['codpro'];
													$desprod    = $row1['desprod'];
													$codmar     = $row1['codmar'];
													$factor     = $row1['factor'];
													$costpr     = $row1['costpr'];  ///COSTO PROMEDIO
													$stopro     = $row1['stopro'];	///STOCK EN UNIDADES DEL PRODUCTO GENERAL
													$cant       = $row1['cant'];	///STOCK EN UNIDADES DEL PRODUCTO POR LOCAL
													$idlocal    = $row1['idlocal'];	///CODIGO DEL LOCAL
													$inc	    = $row1['incentivado'];
													$referencial = $row1['prelis'];
													$prevta		= $row1['prevta'];
													$preuni     = $row1['preuni'];
												}
											}
											if (($referencial <> 0) and ($referencial <> $prevta)) {
												$margenes       = ($margene / 100) + 1;
												$precio_ref     = $referencial / $factor;
												$precio_ref		= $precio_ref * $margenes;
												$precio_ref		= number_format($precio_ref, 2, '.', ',');
												$desc1	        = $precio_ref - $preuni;
												if ($desc1 < 0) {
													$descuento = 0;
												} else {
													$descuento      = (($precio_ref - $preuni) / $precio_ref) * 100;
												}
											} else {
												$precio_ref		= $preuni;
												$descuento		= 0;
											}
											$sql1 = "SELECT ltdgen FROM titultabla where dsgen = 'MARCA'";
											$result1 = mysqli_query($conexion, $sql1);
											if (mysqli_num_rows($result1)) {
												while ($row1 = mysqli_fetch_array($result1)) {
													$ltdgen     = $row1['ltdgen'];
												}
											}
											$sql1 = "SELECT destab FROM titultabladet where codtab = '$codmar' and tiptab = '$ltdgen'";
											$result1 = mysqli_query($conexion, $sql1);
											if (mysqli_num_rows($result1)) {
												while ($row1 = mysqli_fetch_array($result1)) {
													$marca     = $row1['destab'];
												}
											}
									?>
											<tr>
												<td width="<?php ancho(1); ?>" class="main_text"><?php muestra(1); ?></td>
												<td width="<?php ancho(2); ?>" class="main_text"><?php muestra(2); ?></td>
												<td width="<?php ancho(3); ?>" class="main_text"><?php muestra(3); ?></td>
												<td width="<?php ancho(4); ?>" class="main_text"><?php muestra(4); ?></td>
												<td width="<?php ancho(5); ?>" class="main_text"><?php muestra(5); ?></td>
												<td width="<?php ancho(6); ?>" class="main_text"><?php muestra(6); ?></td>
												<td width="<?php ancho(7); ?>" class="main_text"><?php muestra(7); ?></td>
												<td width="<?php ancho(8); ?>" class="main_text"><?php muestra(8); ?></td>
											</tr>
										<?php $i++;
										}
									}
									if ($i < 38) {
										while ($i <= 22) {
										?>
											<tr>
												<td width="<?php ancho(1); ?>" class="main_text">&nbsp;</td>
												<td width="<?php ancho(2); ?>" class="main_text">&nbsp;</td>
												<td width="<?php ancho(3); ?>" class="main_text">&nbsp;</td>
												<td width="<?php ancho(4); ?>" class="main_text">&nbsp;</td>
												<td width="<?php ancho(5); ?>" class="main_text">&nbsp;</td>
												<td width="<?php ancho(6); ?>" class="main_text">&nbsp;</td>
												<td width="<?php ancho(7); ?>" class="main_text">&nbsp;</td>
												<td width="<?php ancho(8); ?>" class="main_text">&nbsp;</td>
											</tr>
									<?php $i++;
										}
									}
									?>
								</table>

							</td>
						</tr>
					</table>
					<br>
					<table width="857" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">
						<tr>
							<td width="168">
								<div align="center"><strong>MONTO BRUTO&nbsp;&nbsp;&nbsp;&nbsp;
										<?php echo $numero_formato_frances = number_format($mont_bruto, 2, '.', ' '); ?></strong></div>
							</td>
							<td width="170">
								<div align="center"><strong>DCTO&nbsp&nbsp;&nbsp;&nbsp;
										<?php echo $numero_formato_frances = number_format($total_des, 2, '.', ' '); ?></strong></div>
							</td>
							<td width="169">
								<div align="center"><strong>V.VENTA&nbsp;&nbsp;&nbsp;&nbsp;
										<?php echo $numero_formato_frances = number_format($valor_vent1, 2, '.', ' '); ?></strong></div>
							</td>
							<td width="169">
								<div align="center"><strong>IGV&nbsp;&nbsp;&nbsp;&nbsp;
										<?php echo $numero_formato_frances = number_format($sum_igv, 2, '.', ' '); ?></strong></div>
							</td>
							<td width="169">
								<div align="center"><strong>NETO&nbsp;&nbsp;&nbsp;&nbsp;
										<?php echo $numero_formato_frances = number_format($monto_total, 2, '.', ' '); ?></strong></div>
							</td>
						</tr>
					</table>
					<br />
					<table width="857" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">
						<tr>
							<td>
								<table width="847" border="0" align="center">
									<tr>
										<td width="126">
											<?php if (($linea1[1] == 1) and ($columna1[1] == 1)) {
												echo '<b>';
												echo $descbrev1[1];
												echo '</b>';
												$cc1 = $campo1[1];
											}
											?>
										</td>
										<td width="409"><?php if ($cc1 == 'montext') {
															echo $text_letra = strtoupper(letras2($monto_total));
														} else {
															echo substr($var[$cc1], 0, $longs1[1]);
														} ?></td>
										<td width="119">
											<?php if (($linea1[2] == 1) and ($columna1[2] == 2)) {
												echo '<b>';
												echo $descbrev1[2];
												echo '</b>';
												$cc2 = $campo1[2];
											}
											?>
										</td>
										<td width="175"><?php if ($cc2 == 'montext') {
															echo $text_letra = strtoupper(letras2($monto_total));
														} else {
															echo substr($var[$cc2], 0, $longs1[2]);
														} ?></td>
										<td width="119">
											<?php if (($linea1[3] == 1) and ($columna1[3] == 3)) {
												echo '<b>';
												echo $descbrev1[3];
												echo '</b>';
												$cc3 = $campo1[3];
											}
											?>
										</td>
										<td width="175"><?php if ($cc3 == 'montext') {
															echo $text_letra = strtoupper(letras2($monto_total));
														} else {
															echo substr($var[$cc3], 0, $longs1[3]);
														} ?></td>
									</tr>
									<tr>
										<td><?php if (($linea1[4] == 2) and ($columna1[4] == 1)) {
												echo '<b>';
												echo $descbrev1[4];
												echo '</b>';
												$cc4 = $campo1[4];
											}
											?>
										</td>
										<td><?php if ($cc4 == 'montext') {
												echo $text_letra = strtoupper(letras2($monto_total));
											} else {
												echo substr($var[$cc4], 0, $longs1[4]);
											} ?></td>
										<td><?php if (($linea1[5] == 2) and ($columna1[5] == 2)) {
												echo '<b>';
												echo $descbrev1[5];
												echo '</b>';
												$cc5 = $campo1[5];
											}
											?>
										</td>
										<td><?php if ($cc5 == 'montext') {
												echo $text_letra = strtoupper(letras2($monto_total));
											} else {
												echo substr($var[$cc5], 0, $longs1[5]);
											} ?></td>
										<td><?php if (($linea1[6] == 2) and ($columna1[6] == 3)) {
												echo '<b>';
												echo $descbrev1[6];
												echo '</b>';
												$cc6 = $campo1[6];
											}
											?>
										</td>
										<td><?php if ($cc6 == 'montext') {
												echo $text_letra = strtoupper(letras2($monto_total));
											} else {
												echo substr($var[$cc6], 0, $longs1[6]);
											} ?></td>
									</tr>
									<tr>
										<td><?php if (($linea1[7] == 3) and ($columna1[7] == 1)) {
												echo '<b>';
												echo $descbrev1[7];
												echo '</b>';
												$cc7 = $campo1[7];
											}
											?>
										</td>
										<td><?php if ($cc7 == 'montext') {
												echo $text_letra = strtoupper(letras2($monto_total));
											} else {
												echo substr($var[$cc7], 0, $longs1[7]);
											} ?></td>
										<td><?php if (($linea1[8] == 3) and ($columna1[8] == 2)) {
												echo '<b>';
												echo $descbrev1[8];
												echo '</b>';
												$cc8 = $campo1[8];
											}
											?>
										</td>
										<td><?php if ($cc8 == 'montext') {
												echo $text_letra = strtoupper(letras2($monto_total));
											} else {
												echo substr($var[$cc8], 0, $longs1[8]);
											} ?></td>
										<td><?php if (($linea1[9] == 3) and ($columna1[9] == 3)) {
												echo '<b>';
												echo $descbrev1[9];
												echo '</b>';
												$cc9 = $campo1[9];
											}
											?>
										</td>
										<td><?php if ($cc9 == 'montext') {
												echo $text_letra = strtoupper(letras2($monto_total));
											} else {
												echo substr($var[$cc9], 0, $longs1[9]);
											} ?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>
</body>

</html>