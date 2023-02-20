<?php include('../../session_user.php');
require_once ('../../../conexion.php');
$cod    	 = $_POST['cod'];			///invnum
$referencia  = $_POST['referencia'];	///referencia
$mont2  	 = $_POST['mont2'];			///monto total
$hoy = date('Y-m-d H:i:s');
/*function callLotes($Conexion, $CodPro, $Tipo) 
{
    $sqlLote = "SELECT idlote,stock FROM movlote where codpro = '$CodPro' and stock <> 0 and date_format(str_to_date(concat('01/',vencim),'%d/%m/%Y'),'%Y-%m-%d') >= NOW()
    ORDER BY date_format(str_to_date(concat('01/',vencim),'%d/%m/%Y'),'%Y-%m-%d') limit 1";
    $resultLote = mysqli_query($Conexion, $sqlLote);
    if (mysqli_num_rows($resultLote)) {
        while ($rowLote = mysqli_fetch_array($resultLote)) {
            $CLote = $rowLote['idlote'];
            $Stock = $rowLote['stock'];
        }
        if ($Tipo == 1) 
        {
            return $CLote;
        }
        if ($Tipo == 2) 
        {
            return $Stock;
        }
    } 
    else 
    {
        return 0;
    }
}

function callUpdateLote($Conexion, $Clote, $StockActualLote) 
{
    $sql1 = "UPDATE movlote set stock = '$StockActualLote' where idlote = '$Clote'";
    $result2 = mysqli_query($Conexion, $sql1);
    if (mysqli_errno($Conexion))
    {
        error_log("Actualiza producto SQL(" . $sql1 . ")\nError(" . mysqli_error($Conexion) . ")");
    }
}
*/

function convertir_a_numero($str)
{
	  $legalChars = "%[^0-9\-\. ]%";
	  $str=preg_replace($legalChars,"",$str);
	  return $str;
}
////VERIFICO LOS DATOS DEL DOCUMENTO Y ESCOGO EL USUARIO Y SU LOCAL
$sql="SELECT numdoc,invfec,tipmov,tipdoc,usecod FROM movmae where invnum = '$cod'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
    	$numdoc    = $row['numdoc'];
		$invfec    = $row['invfec'];
		$tipmov    = $row['tipmov'];
		$tipdoc    = $row['tipdoc'];
		$usecod    = $row['usecod'];
}
}
$sql="SELECT codloc FROM usuario where usecod = '$usecod'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
			$codloc    = $row['codloc'];
}
}
$sql="SELECT nomloc FROM xcompa where codloc = '$codloc'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
    		$nomloc    = $row['nomloc'];
}
}
require_once('../tabla_local.php');
$sql="SELECT codpro,qtypro,qtyprf,pripro,costre,costpr,numlote FROM tempmovmov where invnum = '$cod'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
    	$codpro    = $row['codpro'];
		$qtypro    = $row['qtypro'];
		$qtyprf    = $row['qtyprf'];
		$pripro    = $row['pripro'];
		$costre    = $row['costre'];
		$costpr    = $row['costpr'];
		$numlote   = $row['numlote'];
		$sql1="SELECT factor,stopro,$tabla FROM producto where codpro = '$codpro'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
				$factor    = $row1['factor'];
				$stopro    = $row1['stopro'];
				$cant_loc  = $row1[2];
//				$sactual   = $stopro;
                                $sactual   = $cant_loc;
		}
		}
		if ($qtyprf <> "")
		{
			$text_char =  convertir_a_numero($qtyprf);
			$cant_unid = $text_char;
		}
		else
		{
			$cant_unid = $qtypro * $factor;
		}
		//echo "existe este producto";
		$cant_local = $cant_loc - $cant_unid ;
		$stopro = $stopro - $cant_unid;
		$stocklote = 0;
		/////////////////////////////////////////////////////////////////////

		/////////////////////////////////////////////////////////////
		mysqli_query($conexion,"UPDATE producto set stopro = '$stopro',$tabla = '$cant_local' where codpro = '$codpro'");
		mysqli_query($conexion,"INSERT INTO kardex (nrodoc,codpro,fecha,tipmov,tipdoc,qtypro,fraccion,factor,invnum,usecod,sactual,sucursal) values ('$numdoc','$codpro','$invfec','$tipmov','$tipdoc','$qtypro','$qtyprf','$factor','$cod','$usuario','$sactual','$codloc')")	;
		$last_idKardex = mysqli_insert_id($conexion);
		
		/////////////////////////////////////////////////
		mysqli_query($conexion,"INSERT INTO movmov (invnum,invfec,codpro,qtypro,qtyprf,pripro,costre,costpr,numlote) values ('$cod','$invfec','$codpro','$qtypro','$qtyprf','$pripro','$costre','$costpr','$numlote')")	;
/*
		//VERIFICO SI HAY LOTES
        $Clote = 0;
        $sqlLote = "SELECT idlote from movlote where codpro = '$codpro' AND stock <> 0";
        $resultLote = mysqli_query($conexion, $sqlLote);
        if (mysqli_num_rows($resultLote)) 
        {
            //ACTUALIZO LOS LOTE
            //********************************************
            $CantDetalle = 0;
            $StockDescontar = $cant_unid;
            while ($StockDescontar <> 0) {
                
                $Clote     = callLotes($conexion, $codpro, 1);
                $stocklote = callLotes($conexion, $codpro, 2);
                if ($StockDescontar <= $stocklote) 
                { 
                    $StockActualLote = $stocklote - $StockDescontar;
                    $CantDetalle     = $StockDescontar;
                    $CantDetalleColm = $CantDetalle;
                    //ACTUALIZO EL STOCK DE LOTES
                    callUpdateLote($conexion, $Clote, $StockActualLote);
                    $StockDescontar = 0;
                } 
                else 
                {
                    //ACTUALIZO EL STOCK DEL ANTERIOR Y SIGO BUSCANDO DE OTRO LOTE CON EL STOCK POR DESCONTAR
                    $StockDescontar = $StockDescontar - $stocklote;
                    $CantDetalle    = $stocklote;
                    //ACTUALIZO EL STOCK DE LOTES
                    callUpdateLote($conexion, $Clote, 0);
                }
                

                //INSERTO EN KARDEX DETALLE
                $sql1 = "INSERT INTO kardexLote(codkard,IdLote,Cantidad) values ('$last_idKardex','$Clote','$CantDetalle')";
                $result2 = mysqli_query($conexion, $sql1);
                if (mysqli_errno($conexion)) {
                    error_log("Agrega detalle SQL(" . $sql1 . "),\nerror(" . mysqli_error($conexion) . ")");
                }
            }
        }*/
}
}
mysqli_query($conexion,"DELETE from tempmovmov where invnum = '$cod'")	;
mysqli_query($conexion,"UPDATE movmae set invtot  = '$mont2', monto = '$mont2',refere = '$referencia', estado = '0', proceso = '0',hora='$hoy'  where invnum = '$cod'");
header("Location: ../ing_salid.php"); 
?>