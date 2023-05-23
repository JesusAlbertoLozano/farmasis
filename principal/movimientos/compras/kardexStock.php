<?php

function getLastKardexStockByLocal($conexion, $productCode, $localCode)
{
	$logger = new FileLogger('logger.txt');
	$logger->log("OBTENER SACTUAL DEL KARDEX-------------------------");
	$logger->log("Fecha: " . date("Y-m-d H:i:s"));
	$sactual = 0;
	$kardexLastStockQuery = "SELECT tipmov,tipdoc,qtypro,factor,fraccion,sactual FROM kardex WHERE codpro = '$productCode' AND sucursal = '$localCode' ORDER BY codkard DESC LIMIT 1";
	$logger->log("QUERY DE STOCK EN KARDEX" . $kardexLastStockQuery);
	$kardexLastStockRows = mysqli_query($conexion, $kardexLastStockQuery);
	if (mysqli_num_rows($kardexLastStockRows)) {
		while ($kardexLastStock = mysqli_fetch_array($kardexLastStockRows)) {
			//Obteniendo datos del resultado
			$sactual = (int) $kardexLastStock['sactual'];
			if ($sactual < 0) {
				$logger->log("ERROR EN EL KARDEX: El stock del producto $productCode en la sucursal $localCode es negativo");
				throw new Exception("El stock del producto $productCode en la sucursal $localCode es negativo");
			}
			$factor = (int) $kardexLastStock['factor'];
			$fraccion = $kardexLastStock['fraccion'];
			$qtypro = (int) $kardexLastStock['qtypro'];
			$tipmov = (int) $kardexLastStock['tipmov'];
			$tipdoc = (int) $kardexLastStock['tipdoc'];

			$variacion = kardexVariacion($tipmov, $tipdoc); // Define si es positivo o negativo para el movimiento del kardex
			if ($qtypro != 0) {
				$sactual = $sactual + $qtypro * $factor * $variacion;
			} else {
				// Definir si la fracción es negativa o positiva
				$fraccion = (int) str_replace("f", "", $fraccion);
				$sactual = $sactual + $fraccion * $variacion;
			}
		}
	}
	$logger->log("SACTUAL DEL PRODUCTO $productCode y del $localCode: $sactual");
	return $sactual;
}

function kardexVariacion($tipmov, $tipdoc)
{
	if (($tipmov == 9) && ($tipdoc == 9)) {
		return -1;
	}
	if (($tipmov == 10) && ($tipdoc == 9)) {
		return 1;
	}
	if (($tipmov == 10) && ($tipdoc == 10)) {
		return -1;
	}
	if (($tipmov == 11) && ($tipdoc == 11)) {
		return 1;
	}
	if (($tipmov == 9) && ($tipdoc == 11)) {
		return -1;
	}

	if (($tipmov == 1) && ($tipdoc == 1)) {
		return 1;
	}


	if (($tipmov == 1) && ($tipdoc == 2)) {
		return 1;
	}
	if (($tipmov == 1) && ($tipdoc == 2)) {
		return 1;
	}
	if (($tipmov == 1) && ($tipdoc == 3)) {
		return 1;
	}
	if (($tipmov == 1) && ($tipdoc == 4)) {
		return 1;
	}
	if (($tipmov == 1) && ($tipdoc == 5)) {
		return 1;
	}
	if (($tipmov == 2) && ($tipdoc == 1)) {
		return -1;
	}
	if (($tipmov == 1) && ($tipdoc == 1)) {
		return -1;
	}
	if (($tipmov == 2) && ($tipdoc == 2)) {
		return -1;
	}
	if (($tipmov == 2) && ($tipdoc == 3)) {
		return -1;
	}
	if (($tipmov == 2) && ($tipdoc == 4)) {
		return -1;
	}
	if (($tipmov == 2) && ($tipdoc == 5)) {
		return -1;
	}
	if (($tipmov == 1) && ($tipdoc == 1)) {
		return -1;
	}
	if (($tipmov == 1) && ($tipdoc == 5)) {
		return -1;
	}
	if (($tipmov == 1) && ($tipdoc == 1)) {
		return 1;
	}
	if (($tipmov == 1) && ($tipdoc == 5)) {
		return 1;
	}
	if (($tipmov == 2) && ($tipdoc == 1)) {
		return 1;
	}
	if (($tipmov == 2) && ($tipdoc == 3)) {
		return 1;
	}
}
