<?php 
require_once('../../session_user.php');
require_once('../../../conexion.php');

$venta                  = $_SESSION['venta'];
$date                   = date("Y-m-d");
$t1                     = $_REQUEST['t1'];	////CANTIDAD
$t2                     = $_REQUEST['t22'];	////PRECIO
$t3                     = $_REQUEST['t33'];	////SUBTOTAL
$number                 = $_REQUEST['number'];	////SI ES NUMERO O NO
$factor                 = $_REQUEST['factor'];
$codpro                 = $_REQUEST['codpro'];	/////CODIGO DE LA RELACION ENTRE LOCAL Y PRODUCTO
$codtemp                = $_REQUEST['codtemp'];

require_once('funciones/datos_generales.php'); //////CODIGO Y NOMBRE DEL LOCAL

$cantventaparabonificar = "";
$codprobonif            = "";
$cantbonificable        = "";

/////FUNCION PARA CONVERTIR CADENA A NUMERO
function convertir_a_numero($str)
{
  $legalChars = "%[^0-9\-\. ]%";
  return preg_replace($legalChars,"",$str);
}	

///////////ACTUALIZO LA DATA HASTA ANTES DE HACER LA OPERACION
$sqlTV="SELECT canpro,fraccion FROM temp_venta where codtemp = '$codtemp'";
$resultTV = mysqli_query($conexion,$sqlTV);
if (mysqli_num_rows($resultTV)){
    while ($row = mysqli_fetch_array($resultTV))
    {
        $canpro         = $row['canpro'];		////GENERAL
        $fraccion       = $row['fraccion'];
    }
}

$sqlPROD="SELECT codpro,stopro,$tabla,cantventaparabonificar,codprobonif,cantbonificable,factor FROM producto where codpro = '$codpro'";
$resultPROD = mysqli_query($conexion,$sqlPROD);
if (mysqli_num_rows($resultPROD))
{
    while ($row = mysqli_fetch_array($resultPROD))
    {
        $codpro                 = $row['codpro'];		////CODIGO DEL PRODUCTO
        $stopro                 = $row['stopro'];		////GENERAL
        $cant_loc               = $row[2];
        $cantventaparabonificar = $row['cantventaparabonificar'];
        $codprobonif            = $row['codprobonif'];
        $cantbonificable        = $row['cantbonificable'];
        $factor                 = $row['factor'];
        if (($codprobonif <> 0) || ($codprobonif <> ""))
        {
            if (!is_numeric($cantventaparabonificar))
            {
                $cantventaparabonificar = convertir_a_numero($cantventaparabonificar) * $factor;
            }
        }
    }
}

if ($fraccion == "F")						////INGRESO DE CAJAS
{	
    $canpro 	    = convertir_a_numero($canpro) * $factor;	////CANTIDAD A SUMAR EN UNIDADES
    $total_general  = $stopro + $canpro;
    $total_local    = $cant_loc + $canpro;
}
else
{
    $total_general  = $stopro + $canpro;
    $total_local    = $cant_loc + $canpro;
}

        
if (strlen($codprobonif)>0)
{
    if ($canpro >= $cantventaparabonificar)
    {
        //INSERTA UN DETALLE PARA BONIFICADO
        $sqlB="SELECT codpro,stopro,$tabla,factor,codmar FROM producto where codpro = '$codprobonif'";
        $resultB = mysqli_query($conexion,$sqlB);
        if (mysqli_num_rows($resultB)){
        while ($rowB = mysqli_fetch_array($resultB)){
            $codproB                = $rowB['codpro'];
            $stoproB                = $rowB['stopro'];	
            $cant_locB              = $rowB[2];
            $factorB                = $rowB['factor'];
            $codmarB                = $rowB['codmar'];
            if (!is_numeric($cantbonificable))
            {
                $cantbonificable        = convertir_a_numero($cantbonificable) * $factorB;
            }
            //SI HAY STOCK PARA LA BONIFICACION
            if ($cantbonificable <= $cant_locB)
            {
                $cantDescontar = $cant_locB - $cantbonificable;
                mysqli_query($conexion,"DELETE FROM temp_venta where invnum = '$venta' and codpro = '$codprobonif' and bonif2 = 1 ");
                mysqli_query($conexion,"INSERT INTO temp_venta (invnum,invfec,cuscod,usecod,codpro,canpro,fraccion,factor,prisal,pripro,codmar,cospro,costpr,bonif2) values ('$venta','$date','$cuscod','$usuario','$codprobonif','$cantbonificable','T','$factorB','0','0','$codmarB','0','0','1')");
            }

        }
        }
    }
}
/////---------mysqli_query($conexion,"UPDATE producto set stopro = '$total_general', $tabla = '$total_local' where codpro = '$codpro'");
///////////////////////////////////////////////////////////////////////////////////
/*$sql1="SELECT codpro,codkey,cajas FROM temp_vent_bonif where invnum = '$venta' and codprobonif = '$codpro'"; ///consulto si el producto que se esta vendiendo tiene bonificacion
$result1 = mysqli_query($conexion,$sql1);
if (mysqli_num_rows($result1))
{
	while ($row1 = mysqli_fetch_array($result1)){
		$codprox   = $row1['codpro'];		/////codigo del producto bonificable
		$codkey    = $row1['codkey'];
		$cajas     = $row1['cajas'];
		$sql2="SELECT cajas,unid FROM ventas_bonif_unid where codkey = '$codkey'";
		$result2 = mysqli_query($conexion,$sql2);
		if (mysqli_num_rows($result2)){
			while ($row2 = mysqli_fetch_array($result2)){
					$cajas1    = $row2['cajas'];
					$unid1     = $row2['unid'];	
			}
		}
		$sql2="SELECT stopro,$tabla FROM producto where codpro = '$codprox'";
		$result2 = mysqli_query($conexion,$sql2);
		if (mysqli_num_rows($result2)){
			while ($row2 = mysqli_fetch_array($result2)){
					$stockx    = $row2['stopro'];
					$locx      = $row2[1];	
			}
		}
		$totcaja = $cajas + $cajas1;
		$unidadesx = $cajas * $unid1;
		$stockxx   = $stockx + $unidadesx;
		$locxx     = $locx + $unidadesx;
		//-----------mysqli_query($conexion,"UPDATE ventas_bonif_unid set cajas = '$totcaja' where codkey = '$codkey'");
		//-----------mysqli_query($conexion,"UPDATE producto set stopro = '$stockxx',$tabla = '$locxx' where codpro = '$codprox'");
	}
}
mysqli_query($conexion,"DELETE from temp_vent_bonif where codprobonif = '$codpro' and invnum = '$venta'");*/
///////////////////////////////////////////////////////////////////////////////////
////////////////////NUEVA ACTUALIZACION CON LOS DATOS INGRESADOS///////////////////
$sql="SELECT codpro,stopro,$tabla FROM producto where codpro = '$codpro'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result))
{
    while ($row = mysqli_fetch_array($result))
    {
            $codpro         = $row['codpro'];		////CODIGO DEL PRODUCTO
            $stopro         = $row['stopro'];		////GENERAL
            $cant_loc  		= $row[2];
    }
}
if ($number == 1)					////ESTOY INGRESANDO CAJAS --- LETRA C
{
	$t1 		= convertir_a_numero($t1);
	$caja_bonifi    = $t1;		/////CAJAS QUE DESEO VENDER
	$creal 		= $t1;
	$t1 		= $t1 * $factor;
	$desc 		= "F";
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
					$stockbonif       	= $row2['stopro'];		////STOCK GENERAL DEL PRODUCTO
					$tablabonif       	= $row2[1];				////STOCK POR LOCAL
					$factorbonif        = $row2['factor'];		////FACTOR
					$codmarbonif        = $row2['codmar'];		////MARCA
					$pcostounibonif     = $row2['pcostouni'];	////PRECIO DE COSTO UNT
					$costprbonif        = $row2['costpr'];		////COSTO PROMEDIO
					$preunibonif        = $row2['preuni'];		////PRECIO UNITARIO
				}
			}
			$sql2="SELECT canpro FROM temp_venta where invnum = '$venta' and codpro = '$codprodbonif' and pripro = '0' and bonif = '1'";		///si es venta por bonificacion
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
			if (($caja_bonifi <= $cajas) && ($tt <> 0))	//VENDO UNA CAJA Y MI STOCK BONIF ES DE 4 CAJAS
			{
				$total_reducir 		= $cajas - $caja_bonifi;
				$tot_reducir_unid   = $caja_bonifi * $unid;
				$stockbonif 		= $stockbonif - $tot_reducir_unid;
				$tablabonif 		= $tablabonif - $tot_reducir_unid;
				///----mysqli_query($conexion, "UPDATE ventas_bonif_unid set cajas = '$total_reducir' where codkey = '$codkey'"); ///controla bonificaciones
				///----mysqli_query($conexion, "UPDATE producto set stopro = '$stockbonif',$tabla = '$tablabonif' where codpro = '$codprodbonif'");
				if ($bik == 1)
				{
					$canprobonif = $canprobonif + $tot_reducir_unid;
					mysqli_query($conexion, "UPDATE temp_venta set canpro = '$canprobonif' where codpro = '$codprodbonif'");
				}
				else
				{
					mysqli_query($conexion, "INSERT INTO temp_venta (invnum,invfec,cuscod,usecod,codpro,canpro,fraccion,factor,prisal,pripro,codmar,cospro,costpr,bonif) values ('$venta','$date','$cuscod','$usuario','$codprodbonif','$tot_reducir_unid','T','$factorbonif','$preunibonif','0','$codmarbonif','$pcostounibonif','$costprbonif','1')");
				}
					mysqli_query($conexion, "INSERT INTO temp_vent_bonif (invnum,codpro,codprobonif,codkey,cajas) values ('$venta','$codprodbonif','$codpro','$codkey','$caja_bonifi')");
				$tt = 0;
			}
			else	//VENDO 4 CAJAS Y MI STOCK BONIF ES DE 1 CAJA, BUSCO Y VEO SI TENGO MAS STOCKS
			{
				if (($caja_bonifi > $cajas) && ($tt <> 0))
				{
					$total_reducir 		= $cajas - $cajas;
					$tot_reducir_unid   = $cajas * $unid;
					$stockbonif 		= $stockbonif - $tot_reducir_unid;
					$tablabonif 		= $tablabonif - $tot_reducir_unid;
					$caja_bonifi		= $caja_bonifi - $cajas;
				///----mysqli_query($conexion, "UPDATE ventas_bonif_unid set cajas = '$total_reducir' where codkey = '$codkey'");
				///----mysqli_query($conexion, "UPDATE producto set stopro = '$stockbonif',$tabla = '$tablabonif' where codpro = '$codprodbonif'");
					if ($bik == 1)
					{
						$canprobonif = $canprobonif + $tot_reducir_unid;
						mysqli_query($conexion, "UPDATE temp_venta set canpro = '$canprobonif' where codpro = '$codprodbonif'");
					}
					else
					{
						mysqli_query($conexion, "INSERT INTO temp_venta (invnum,invfec,cuscod,usecod,codpro,canpro,fraccion,factor,prisal,pripro,codmar,cospro,costpr,bonif) values ('$venta','$date','$cuscod','$usuario','$codprodbonif','$tot_reducir_unid','T','$factorbonif','$preunibonif','0','$codmarbonif','$pcostounibonif','$costprbonif','1')");
					}
					mysqli_query($conexion, "INSERT INTO temp_vent_bonif (invnum,codpro,codprobonif,codkey,cajas) values ('$venta','$codprodbonif','$codpro','$codkey','$caja_bonifi')");
					$tt = 1;
				}
			}
		}
	}
}
else
{
	$desc   = "T";
	$creal  = $t1;
}
$stock_general = $stopro - $t1;
$stock_local   = $cant_loc - $t1;
////-----mysqli_query($conexion, "UPDATE producto set stopro = '$stock_general', $tabla = '$stock_local' where codpro = '$codpro'");
mysqli_query($conexion, "UPDATE temp_venta set canpro = '$creal',fraccion = '$desc',prisal = '$t2',pripro = '$t3' where codtemp = '$codtemp'");
header("Location: venta_index2.php");
?>