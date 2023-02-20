<?php require_once('../../session_user.php');
require_once('../../../conexion.php');
$venta      = $_SESSION['venta'];
$date = date("Y-m-d");
//$hour   = date('G');
//$date	= CalculaFechaHora($hour);
$text1	 	= $_REQUEST['text1'];		////CANTIDAD PUEDE SER POR FACTOR O INDIVIDUAL
$text2	 	= $_REQUEST['text2'];		////PRECIO
$text3	 	= $_REQUEST['text3'];		////SUBTOTAL
$factor	 	= $_REQUEST['factor'];
$numero	 	= $_REQUEST['numero'];
$cant_prod	= $_REQUEST['cant_prod'];	///STOCK ATUAL
$codpro   	= $_REQUEST['codpro'];	
$pcostouni	= $_REQUEST['pcostouni'];
require_once('funciones/datos_generales.php'); //////CODIGO Y NOMBRE DEL LOCAL	
$sql="SELECT $tabla FROM producto where codpro = '$codpro'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$cant_prod  		= $row[0];
}
}
$sql="SELECT invnum,codpro FROM temp_venta where invnum = '$venta' and codpro = '$codpro'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result))
{
$repetido = 1;
}
else
{
$repetido = 0;
}
//////EVITAR REPITICIONES
if ($repetido == 0)
{
//////////////////////////////////////////////////////////////////////////////
if ($numero == 1)					////ESTOY INGRESANDO CAJAS CON LA LETRA C
{
	function convertir_a_numero($str)
	{
	  $legalChars = "%[^0-9\-\. ]%";
	
	  $str=preg_replace($legalChars,"",$str);
	  return $str;
	}							/////FUNCION PARA CONVERTIR NUMERO
	$text1 		= convertir_a_numero($text1);
	$caja_bonifi= $text1;		/////CAJAS QUE DESEO VENDER
	$creal 		= $text1;
	$text1 		= $text1 * $factor;
	$cantidades = $text1;
	$tt 		= 1;
	$sql1="SELECT codprobonif,codkey,cajas,unid FROM ventas_bonif_unid where codpro = '$codpro' and unid <> 0 order by codkey asc";
	$result1 = mysqli_query($conexion,$sql1);
	if (mysqli_num_rows($result1)){
	while ($row1 = mysqli_fetch_array($result1)){
		$codprodbonif  	= $row1['codprobonif'];	 /////PRODUCTO A BONIFICAR
		$codkey       	= $row1['codkey'];
		$cajas		 	= $row1['cajas'];		 /////CAJAS E BONIFICACION QUE TENGO EN STOCK
		$unid       	= $row1['unid'];
		$sql2="SELECT stopro,$tabla,factor,codmar,pcostouni,costpr,preuni FROM producto where codpro = '$codprodbonif'";
		$result2 = mysqli_query($conexion,$sql2);
		if (mysqli_num_rows($result2)){
		while ($row2 = mysqli_fetch_array($result2)){
			$stockbonif       	= $row2['stopro'];		
			$tablabonif       	= $row2[1];				
			$factorbonif        = $row2['factor'];		
			$codmarbonif        = $row2['codmar'];		
			$pcostounibonif     = $row2['pcostouni'];	
			$costprbonif        = $row2['costpr'];		
			$preunibonif        = $row2['preuni'];		
		}
		}
		$sql2="SELECT canpro FROM temp_venta where invnum = '$venta' and codpro = '$codprodbonif' and pripro = '0' and bonif = '1'";		
		$result2 = mysqli_query($conexion,$sql2);
		if (mysqli_num_rows($result2)){
		while ($row2 = mysqli_fetch_array($result2)){
			$canprobonif       	= $row2['canpro'];	
			$bik				= 1;	
		}
		}
		else
		{
		$bik = 0;
		}
		if (($caja_bonifi <= $cajas) && ($tt <> 0))
		{
		$total_reducir 		= $cajas - $caja_bonifi;
		$tot_reducir_unid   = $caja_bonifi * $unid;
		$stockbonif 		= $stockbonif - $tot_reducir_unid;
		$tablabonif 		= $tablabonif - $tot_reducir_unid;
		mysqli_query($conexion,"UPDATE ventas_bonif_unid set cajas = '$total_reducir' where codkey = '$codkey'");
		mysqli_query($conexion,"UPDATE producto set stopro = '$stockbonif',$tabla = '$tablabonif' where codpro = '$codprodbonif'");
			if ($bik == 1)
			{
			$canprobonif = $canprobonif + $tot_reducir_unid;
			mysqli_query($conexion,"UPDATE temp_venta set canpro = '$canprobonif' where codpro = '$codprodbonif'");
			}
			else
			{
			mysqli_query($conexion,"INSERT INTO temp_venta (invnum,invfec,cuscod,usecod,codpro,canpro,fraccion,factor,prisal,pripro,codmar,cospro,costpr,bonif) values ('$venta','$date','$cuscod','$usuario','$codprodbonif','$tot_reducir_unid','T','$factorbonif','$preunibonif','0','$codmarbonif','$pcostounibonif','$costprbonif','1')");
			}
			mysqli_query($conexion,"INSERT INTO temp_vent_bonif (invnum,codpro,codprobonif,codkey,cajas) values ('$venta','$codprodbonif','$codpro','$codkey','$caja_bonifi')");
			$tt = 0;
		}
		else
		{
			if (($caja_bonifi > $cajas) && ($tt <> 0))
			{
			$total_reducir 		= $cajas - $cajas;
			$tot_reducir_unid   = $cajas * $unid;
			$stockbonif 		= $stockbonif - $tot_reducir_unid;
			$tablabonif 		= $tablabonif - $tot_reducir_unid;
			$caja_bonifi		= $caja_bonifi - $cajas;
			mysqli_query($conexion,"UPDATE ventas_bonif_unid set cajas = '$total_reducir' where codkey = '$codkey'");
			mysqli_query($conexion,"UPDATE producto set stopro = '$stockbonif',$tabla = '$tablabonif' where codpro = '$codprodbonif'");
				if ($bik == 1)
				{
				$canprobonif = $canprobonif + $tot_reducir_unid;
				mysqli_query($conexion,"UPDATE temp_venta set canpro = '$canprobonif' where codpro = '$codprodbonif'");
				}
				else
				{
				mysqli_query($conexion,"INSERT INTO temp_venta (invnum,invfec,cuscod,usecod,codpro,canpro,fraccion,factor,prisal,pripro,codmar,cospro,costpr,bonif) values ('$venta','$date','$cuscod','$usuario','$codprodbonif','$tot_reducir_unid','T','$factorbonif','$preunibonif','0','$codmarbonif','$pcostounibonif','$costprbonif','1')");
				}
				mysqli_query($conexion,"INSERT INTO temp_vent_bonif (invnum,codpro,codprobonif,codkey,cajas) values ('$venta','$codprodbonif','$codpro','$codkey','$caja_bonifi')");
			$tt = 1;
			}
		}
	}
	}
}
else
{
	$cantidades = $text1;  //////CANTIDAD INDIVIDUAL
}
/////////////////////////////////////////////////////////////////////////////
if ($cantidades <> 0)
{
	if ($cantidades > $cant_prod)
	{
	$agotado = $cantidades - $cant_prod;
	$agot    = 1;
		$sql1="SELECT cuscod,invfec,sucursal FROM venta where invnum = '$venta'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
			$cuscod    = $row1['cuscod'];
			$invfec    = $row1['invfec'];
			$sucursal  = $row1['sucursal'];
		}
		}
	}
	else
	{
	$agot = 0;
	}
	$sql="SELECT codpro,stopro,codmar,costpr,codmar,codfam,coduso,$tabla FROM producto where codpro = '$codpro'";
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	while ($row = mysqli_fetch_array($result)){
		$codpro         = $row['codpro'];		////CODIGO DEL PRODUCTO
		$stopro         = $row['stopro'];		////GENERAL
		$codmar         = $row['codmar'];
		$costpr         = $row['costpr'];
		$codmar         = $row['codmar'];
		$codfam         = $row['codfam'];
		$coduso         = $row['coduso'];		
		$costpr			= $costpr/$factor;
		$cant_loc  		= $row[7];
	}
	}
	if ($agot == 0)
	{
	$permitido       = $text1;
	$total_local     = $cant_loc - $text1;
	$total_general   = $stopro - $text1;
	}
	else
	{
	$permitido       = $cant_loc;
	$pc 			 = ($text3*$cant_loc)/$factor;  ////PRECIO TOTAL EN VENTAS
	if ($cant_loc <> 0)
	{
	$pcunit			 = $pc/$cant_loc;				////PRECIO UNITARIO EN VENTAS
	}
	else
	{
	$pcunit = 0;
	}
	$total_local     = $cant_loc - $cant_loc;
	$total_general   = $stopro - $cant_loc;
	$ppc			 = $agotado * $pcunit;
	}
	if ($cant_prod <> 0)
	{
	mysqli_query($conexion,"UPDATE producto set stopro = '$total_general', $tabla = '$total_local' where codpro = '$codpro'");
	}
	if (($text1<> "") || ($text1<>0))
	{
		if ($numero == 0)   ////UNIDADES
		{
			if ($cant_prod <> 0)
			{
			//mysqli_query($conexion,"INSERT INTO temp_venta (invnum,invfec,cuscod,usecod,codpro,canpro,fraccion,factor,prisal,pripro,codmar,cospro,costpr) values ('$venta','$date','$cuscod','$usuario','$codpro','$text1','T','$factor','$text2','$text3','$codmar','$pcostouni','$costpr')");
				if ($agot == 1)
				{
				mysqli_query($conexion,"INSERT INTO temp_venta (invnum,invfec,cuscod,usecod,codpro,canpro,fraccion,factor,prisal,pripro,codmar,cospro,costpr) values ('$venta','$date','$cuscod','$usuario','$codpro','$permitido','T','$factor','$pcunit','$pc','$codmar','$pcostouni','$costpr')");
				}
				else
				{
				mysqli_query($conexion,"INSERT INTO temp_venta (invnum,invfec,cuscod,usecod,codpro,canpro,fraccion,factor,prisal,pripro,codmar,cospro,costpr) values ('$venta','$date','$cuscod','$usuario','$codpro','$permitido','T','$factor','$text2','$text3','$codmar','$pcostouni','$costpr')");
				}
			}
		}
		else				/////CAJAS
		{
			if ($cant_prod <> 0)
			{
				if ($agot == 1) ///AGOTADOS PERO VENDO POR UNIDAD
				{
				mysqli_query($conexion,"INSERT INTO temp_venta (invnum,invfec,cuscod,usecod,codpro,canpro,fraccion,factor,prisal,pripro,codmar,cospro,costpr) values ('$venta','$date','$cuscod','$usuario','$codpro','$permitido','T','$factor','$pcunit','$pc','$codmar','$pcostouni','$costpr')");
				}
				else			////VENTA NORMAL POR CAJA
				{
				mysqli_query($conexion,"INSERT INTO temp_venta (invnum,invfec,cuscod,usecod,codpro,canpro,fraccion,factor,prisal,pripro,codmar,cospro,costpr) values ('$venta','$date','$cuscod','$usuario','$codpro','$creal','F','$factor','$text2','$text3','$codmar','$pcostouni','$costpr')");
				}
			}
		}
		if ($numero == 0)
		{
			if ($agot == 1)
			{
			mysqli_query($conexion,"INSERT INTO agotados (cliente,codpro,canpro,fraccion,invfec,pripro,factor,sucursal,usecod,codmar,codfam,coduso,invtot) values ('$cuscod','$codpro','$agotado','T','$invfec','$pcunit','$factor','$sucursal','$usuario','$codmar','$codfam','$coduso','$ppc')");
			}
		}
		else
		{
			if ($agot == 1)
			{
			mysqli_query($conexion,"INSERT INTO agotados (cliente,codpro,canpro,fraccion,invfec,pripro,factor,sucursal,usecod,codmar,codfam,coduso,invtot) values ('$cuscod','$codpro','$agotado','F','$invfec','$pcunit','$factor','$sucursal','$usuario','$codmar','$codfam','$coduso','$ppc')");
			}
		}
	}	///CIERRO IF DE TEXT1 <> ""
} ////CIERRO IF DE CANTIDADES <> 0
}
header("Location: venta_index1.php");
?>