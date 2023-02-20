<?php require_once('../../session_user.php');
require_once('../../../conexion.php');
$sql1="SELECT priceditable FROM datagen_det";
$result1 = mysqli_query($conexion,$sql1);
if (mysqli_num_rows($result1)){
while ($row1 = mysqli_fetch_array($result1)){
$priceditable   = $row1['priceditable'];
}
}
$venta          = $_SESSION['venta'];
$date           = date("Y-m-d");
$text1	 	= $_REQUEST['text1']; //CANTIDAD
if ($priceditable == 1)
{
    $text2   	= $_REQUEST['text222'];
}
else
{
    $text2	= $_REQUEST['text2'];
}
$text3	 	= $_REQUEST['text3'];
$factor	 	= $_REQUEST['factor'];
$numero	 	= $_REQUEST['numero'];
$cant_prod	= $_REQUEST['cant_prod'];
$codpro   	= $_REQUEST['codpro'];
$pcostouni	= $_REQUEST['pcostouni'];
//SI NUMERO = 0 ES NUMERO SI NO ES LETRA O CAJA
require_once('funciones/datos_generales.php'); 

$cantventaparabonificar = "";
$codprobonif            = "";
$cantbonificable        = "";

$sql="SELECT $tabla FROM producto where codpro = '$codpro'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
    $cant_prod  = $row[0];
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
    $repetido = 0;  ////// NO ESTA EN LA BASE DE DATOS
}
function convertir_a_numero($str)
{
    $legalChars = "%[^0-9\-\. ]%";
    return preg_replace($legalChars,"",$str);
}
if ($repetido == 0)
{
    if ($numero == 1) ///// NO ES NUMERO ES UNA LETRA F 14 - precio de CAJA
    {
        //TODAS LAS CONSULTAS SERAN EN BASE A CAJAS						
        $text1 		= convertir_a_numero($text1); ////EJEMPLO: C4 = 4 CAJAS
        $caja_bonifi    = $text1;
        $creal 		= $text1; //CANTIDAD
        $text1 		= $text1 * $factor;
        $cantidades     = $text1;
        $tt 		= 1;
        /*$sql1="SELECT codprobonif,codkey,cajas,unid FROM ventas_bonif_unid where codpro = '$codpro' and unid <> 0 order by codkey asc";
        $result1 = mysqli_query($conexion,$sql1);
        if (mysqli_num_rows($result1))
        {
        while ($row1 = mysqli_fetch_array($result1))
        {
            $codprodbonif  	= $row1['codprobonif'];	 
            $codkey       	= $row1['codkey'];
            $cajas		    = $row1['cajas'];		
            $unid       	= $row1['unid'];
            $sql2="SELECT stopro,$tabla,factor,codmar,pcostouni,costpr,preuni FROM producto where codpro = '$codprodbonif'";
            $result2 = mysqli_query($conexion,$sql2);
            if (mysqli_num_rows($result2)){
            while ($row2 = mysqli_fetch_array($result2)){
                $stockbonif       = $row2['stopro'];		
                $tablabonif       = $row2[1];				
                $factorbonif      = $row2['factor'];		
                $codmarbonif      = $row2['codmar'];		
                $pcostounibonif   = $row2['pcostouni'];	
                $costprbonif      = $row2['costpr'];		
                $preunibonif      = $row2['preuni'];		
            }
            }
            //SABER SI TENGO PRODUCTOS EN EL TEMPORAL DE LA VENTA QUE ESTOY HACIENDO y COINCIDE CON LA BONIF
            $sql2="SELECT canpro FROM temp_venta where invnum = '$venta' and codpro = '$codprodbonif' and pripro = '0' and bonif = '1'";		
            $result2 = mysqli_query($conexion,$sql2);
            if (mysqli_num_rows($result2)){
            while ($row2 = mysqli_fetch_array($result2)){
                $canprobonif    = $row2['canpro'];	
                $bik		= 1;	
            }
            }
            else
            {
                $bik = 0;
            }

            if (($caja_bonifi <= $cajas) && ($tt <> 0))
            {
                $total_reducir 		= $cajas - $caja_bonifi;
                $tot_reducir_unid       = $caja_bonifi * $unid;
                $stockbonif 		= $stockbonif - $tot_reducir_unid;
                $tablabonif 		= $tablabonif - $tot_reducir_unid;
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
                    //mysqli_query($conexion,"UPDATE ventas_bonif_unid set cajas = '$total_reducir' where codkey = '$codkey'");
                    //mysqli_query($conexion,"UPDATE producto set stopro = '$stockbonif',$tabla = '$tablabonif' where codpro = '$codprodbonif'");
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
        }*/
    }
    else /////ES NUMERO Y SON UNIDADES
    {
        $cantidades = $text1;
    }

    if ($cantidades <> 0)
    {
        if ($cantidades > $cant_prod) ////NO HAY STOCK PARA ESTE PRODUCTO
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
        else /////HAY STOCK PARA ESTE PRODUCTO
        {
            $agot = 0;
        }
        
        $sql="SELECT codpro,stopro,codmar,costpr,codmar,codfam,coduso,$tabla,cantventaparabonificar,codprobonif,cantbonificable,factor FROM producto where codpro = '$codpro'";
        $result = mysqli_query($conexion,$sql);
        if (mysqli_num_rows($result)){
        while ($row = mysqli_fetch_array($result)){
            $codpro                 = $row['codpro'];
            $stopro                 = $row['stopro'];
            $codmar                 = $row['codmar'];
            $costpr                 = $row['costpr']/$factor;
            $codfam                 = $row['codfam'];
            $coduso                 = $row['coduso'];
            $factor                 = $row['factor'];
            $cant_loc               = $row[7];
            $cantventaparabonificar = $row['cantventaparabonificar'];
            $codprobonif            = $row['codprobonif'];
            $cantbonificable        = $row['cantbonificable'];
            if (($codprobonif <> 0) || ($codprobonif <> ""))
            {
                if (!is_numeric($cantventaparabonificar))
                {
                    $cantventaparabonificar = convertir_a_numero($cantventaparabonificar) * $factor;
                }
            }
            
        }
        }
        
        if ($agot == 0) /////HAY STOCK PARA ESTE PRODUCTO
        {
            $permitido       = $text1;
            $total_local     = $cant_loc - $text1;
            $total_general   = $stopro - $text1;
        }
        else
        {
            $permitido       = $cant_loc;
            $pc              = ($text3*$cant_loc)/$factor;
            if ($cant_loc <> 0)
            {
                $pcunit      = $pc/$cant_loc;
            }
            else
            {
                $pcunit      = 0;
            }
            $total_local     = $cant_loc - $cant_loc;
            $total_general   = $stopro - $cant_loc;
            $ppc             = $agotado * $pcunit;
        }
        
        if (($text1 <> "") || ($text1 <> 0))
        {
            //ES NUMERO
            if ($numero == 0)
            {
                //ES NUMERO -> T
                if ($cant_prod <> 0)
                {
                    if ($agot == 1)
                    {
                        //AGOTADOS
                        mysqli_query($conexion,"INSERT INTO temp_venta (invnum,invfec,cuscod,usecod,codpro,canpro,fraccion,factor,prisal,pripro,codmar,cospro,costpr) values ('$venta','$date','$cuscod','$usuario','$codpro','$permitido','T','$factor','$pcunit','$pc','$codmar','$pcostouni','$costpr')");
                    }
                    else
                    {
                        //HAY STOCK
                        mysqli_query($conexion,"INSERT INTO temp_venta (invnum,invfec,cuscod,usecod,codpro,canpro,fraccion,factor,prisal,pripro,codmar,cospro,costpr) values ('$venta','$date','$cuscod','$usuario','$codpro','$permitido','T','$factor','$text2','$text3','$codmar','$pcostouni','$costpr')");
                    }
                    //BONIFICADO****************************************
                    //PERMITIDO ES LA CANTIDAD
                    if (strlen($codprobonif)>0)
                    {
                    if ($permitido >= $cantventaparabonificar)
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
                                mysqli_query($conexion,"INSERT INTO temp_venta (invnum,invfec,cuscod,usecod,codpro,canpro,fraccion,factor,prisal,pripro,codmar,cospro,costpr,bonif2) values ('$venta','$date','$cuscod','$usuario','$codprobonif','$cantbonificable','T','$factorB','0','0','$codmarB','0','0','1')");
                            }
                        }
                        }
                    }
                    }
                }
                
            }
            else
            {
                //NO ES NUMERO
                //EMPIEZA CON C - F
                if ($cant_prod <> 0)
                {
                    if ($agot == 1)
                    {
                        //AGOTADOS
                        //--mysqli_query($conexion,"INSERT INTO temp_venta (invnum,invfec,cuscod,usecod,codpro,canpro,fraccion,factor,prisal,pripro,codmar,cospro,costpr) values ('$venta','$date','$cuscod','$usuario','$codpro','$permitido','T','$factor','$pcunit','$pc','$codmar','$pcostouni','$costpr')");
                        mysqli_query($conexion,"INSERT INTO temp_venta (invnum,invfec,cuscod,usecod,codpro,canpro,fraccion,factor,prisal,pripro,codmar,cospro,costpr) values ('$venta','$date','$cuscod','$usuario','$codpro','$permitido','F','$factor','$pcunit','$pc','$codmar','$pcostouni','$costpr')");
                    }
                    else
                    {
                        //HAY STOCK
                        //mysqli_query($conexion,"INSERT INTO temp_venta (invnum,invfec,cuscod,usecod,codpro,canpro,fraccion,factor,prisal,pripro,codmar,cospro,costpr) values ('$venta','$date','$cuscod','$usuario','$codpro','$creal','F','$factor','$text2','$text3','$codmar','$pcostouni','$costpr')");
                        mysqli_query($conexion,"INSERT INTO temp_venta (invnum,invfec,cuscod,usecod,codpro,canpro,fraccion,factor,prisal,pripro,codmar,cospro,costpr) values ('$venta','$date','$cuscod','$usuario','$codpro','$permitido','F','$factor','$text2','$text3','$codmar','$pcostouni','$costpr')");
                    }
                    //BONIFICADO****************************************
                    //PERMITIDO ES LA CANTIDAD
                    if (strlen($codprobonif)>0)
                    {
                    if ($permitido >= $cantventaparabonificar)
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
                                mysqli_query($conexion,"INSERT INTO temp_venta (invnum,invfec,cuscod,usecod,codpro,canpro,fraccion,factor,prisal,pripro,codmar,cospro,costpr,bonif2) values ('$venta','$date','$cuscod','$usuario','$codprobonif','$cantbonificable','T','$factorB','0','0','$codmarB','0','0','1')");
                            }
                        }
                        }
                    }
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
        }
    }
}
header("Location: venta_index2.php");
?>