<?php
require_once('../../session_user.php');
require_once('../../../conexion.php');
require_once('../../../convertfecha.php');	//CONEXION A BASE DE DATOS
?>
<html>

<head>
	<?php
	function cambiarFormatoFecha($fecha)
	{
		list($anio, $mes, $dia) = explode("-", $fecha);
		return $dia . "-" . $mes . "-" . $anio;
	}
	$venta = $_REQUEST['vt'];
	$sql = "SELECT invnum,nrovent,invfec,cuscod,invtot,pagacon,vuelto,nomcliente,tipdoc,hora,correlativo,usecod FROM venta where invnum = '$venta'";
	$result = mysqli_query($conexion, $sql);
	if (mysqli_num_rows($result)) {
		while ($row = mysqli_fetch_array($result)) {
			$invnum       = $row['invnum'];		//codgio
			$nrovent      = $row['nrovent'];
			$invfec       = $row['invfec'];
			$cuscod       = $row['cuscod'];
			$invtot       = $row['invtot'];
			$pagacon      = $row['pagacon'];
			$vuelto       = $row['vuelto'];
			$nomcliente   = $row['nomcliente'];
			$tipdoc       = $row['tipdoc'];
			$hora         = $row['hora'];
			$correlativo  = $row['correlativo'];
			$usecod       = $row['usecod'];
		}
	}
	$invfec = cambiarFormatoFecha($invfec);
	$sql = "SELECT abrev FROM usuario where usecod = '$usecod'";
	$result = mysqli_query($conexion, $sql);
	if (mysqli_num_rows($result)) {
		while ($row = mysqli_fetch_array($result)) {
			$abrev       = $row['abrev'];		//codgio
		}
	}
	if ($tipdoc == 1) {
		$documento = "TICKET DE CAJA";
	}
	if ($tipdoc == 2) {
		$documento = "TICKET DE CAJA";
	}
	if ($tipdoc == 4) {
		$documento = "TICKET DE CAJA";
	}
	function formato($c)
	{
		printf("%08d",  $c);
	}
	?>
	<script>
		function imprimir() {
			var f = document.form1;
			window.print();
			f.action = "venta_index.php";
			f.method = "post";
			f.submit();
		}
	</script>
	<style type="text/css">
		<!--
		.Estilo1 {
			font-size: 12px;
			font-family: Tahoma
		}

		.Estilo2 {
			font-size: 13px;
			font-family: Tahoma;
			font-weight: bold;
		}
		-->
	</style>
</head>

<body onLoad="imprimir();">
	<form name="form1" id="form1">
		<?php
		if ($negrita == '1') {
		?>
			<strong>
			<?php
		}
			?>

			<table width="100%">
				<tr>
					<td>
						<center>
							<strong><span class="Estilo2"><?php echo $documento; ?></span></strong>
							<br>
							<span class="Estilo2"><?php echo $correlativo; ?></span>
							<br>
							************************
						</center>
					</td>
				</tr>
			</table>
			<table width="100%">
				<tr>
					<td><span class="Estilo2"><?php echo strtoupper($nomcliente); ?></span></td>
				</tr>
			</table>
			<table width="100%">
				<tr>
					<td width="20%"><span class="Estilo1">FECHA</span></td>
					<td width="30%"><span class="Estilo1"><?php echo fecha($invfec); ?></span></td>
					<td width="15%"><span class="Estilo1">HORA</span></td>
					<td width="20%"><span class="Estilo1"><?php echo $hora; ?></span></td>
					<td width="15%"><span class="Estilo1"><?php echo $abrev; ?></span></td>
				</tr>
			</table>
			<table width="100%">
				<tr>
					<td>
						<center>
							************************
						</center>
					</td>
				</tr>
			</table>
			<table width="100%">
				<?php
				$sql = "SELECT codpro,canpro,fraccion FROM detalle_venta where invnum = '$venta'";
				$result = mysqli_query($conexion, $sql);
				if (mysqli_num_rows($result)) {
					while ($row = mysqli_fetch_array($result)) {
						$codpro       = $row['codpro'];		//codgio
						$canpro       = $row['canpro'];
						$fraccion     = $row['fraccion'];
						if ($fraccion == "T") {
							$vea = "F" . $canpro;
						}
						if ($fraccion == "F") {
							$canpro = "C" . $canpro;
							$vea = $canpro;
						}
						$sql1 = "SELECT desprod FROM producto where codpro = '$codpro'";
						$result1 = mysqli_query($conexion, $sql1);
						if (mysqli_num_rows($result1)) {
							while ($row1 = mysqli_fetch_array($result1)) {
								$desprod       = $row1['desprod'];		//codgio
							}
						}

				?>
						<tr>
							<td width="85%"><span class="Estilo1"><?php echo substr($desprod, 0, 30); ?></span></td>
							<td width="15%"><span class="Estilo1">
									<div align="right"><?php echo $vea; ?></div>
								</span></td>
						</tr>
				<?php
					}
				}
				?>
			</table>
			<table width="100%">
				<tr>
					<td>
						<center>
							<strong> ************************ </strong>
						</center>
					</td>
				</tr>
			</table>
			<table width="100%">
				<tr>
					<td width="20%"><span class="Estilo1">MONTO</span></td>
					<td width="80%"><span class="Estilo2"><strong>S/. <?php echo number_format($invtot, 2, '.', ' ') ?></strong></span></td>
				</tr>
				<tr>
					<td width="20%"><span class="Estilo1">PAGADO</span></td>
					<td width="80%"><span class="Estilo1">S/. <?php echo number_format($pagacon, 2, '.', ' ') ?></span></td>
				</tr>
				<tr>
					<td width="20%"><span class="Estilo1">VUELTO</span></td>
					<td width="80%"><span class="Estilo1">S/. <?php echo number_format($vuelto, 2, '.', ' ') ?></span></td>
				</tr>
			</table>
			<?php
			if ($negrita == '1') {
			?>
			</strong>
		<?php
			}
		?>
	</form>
</body>

</html>