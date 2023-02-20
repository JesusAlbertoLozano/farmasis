<?php include('../../session_user.php');
require_once ('../../../conexion.php');
$venta      = $_SESSION['venta'];
$date = date("Y-m-d");
//$hour   = date('G');
//$date	= CalculaFechaHora($hour);
$t1	 		= $_REQUEST['t1'];		////CANTIDAD
$t2	 		= $_REQUEST['t2'];		////PRECIO
$t3	 		= $_REQUEST['t3'];		////SUBTOTAL
$number	 	= $_REQUEST['number'];	////SI ES NUMERO O NO
$factor	 	= $_REQUEST['factor'];
$codpro   	= $_REQUEST['codpro'];	/////CODIGO DE LA RELACION ENTRE LOCAL Y PRODUCTO
$codtemp	= $_REQUEST['codtemp'];
require_once ('funciones/datos_generales.php'); //////CODIGO Y NOMBRE DEL LOCAL
function convertir_a_numero($str)
	{
	  $legalChars = "%[^0-9\-\. ]%";
	
	  $str=preg_replace($legalChars,"",$str);
	  return $str;
	}						/////FUNCION PARA CONVERTIR CADENA A NUMERO
///////////ACTUALIZO LA DATA HASTA ANTES DE HACER LA OPERACION
$sql="SELECT canpro,fraccion FROM temp_venta where codtemp = '$codtemp'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$canpro         = $row['canpro'];		////GENERAL
	$fraccion       = $row['fraccion'];
}
}
$sql="SELECT codpro,stopro,$tabla FROM producto where codpro = '$codpro'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$codpro         = $row['codpro'];		////CODIGO DEL PRODUCTO
	$stopro         = $row['stopro'];		////GENERAL
	$cant_loc  		= $row[2];
}
}
if ($fraccion == "F")						////INGRESO DE CAJAS
{
$canpro  	    = convertir_a_numero($canpro);	
$canpro1 	    = $canpro * $factor;			////CANTIDAD A SUMAR EN UNIDADES
$total_general 	= $stopro + $canpro1;
$total_local    = $cant_loc + $canpro1;
}
else
{
$total_general 	= $stopro + $canpro;
$total_local    = $cant_loc + $canpro;
}
mysqli_query($conexion,"UPDATE producto set stopro = '$total_general', $tabla = '$total_local' where codpro = '$codpro'");
////////////////////NUEVA ACTUALIZACION CON LOS DATOS INGRESADOS///////////////////
$sql="SELECT codpro,stopro,$tabla FROM producto where codpro = '$codpro'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$codpro         = $row['codpro'];		////CODIGO DEL PRODUCTO
	$stopro         = $row['stopro'];		////GENERAL
	$cant_loc  		= $row[2];
}
}
if ($number == 1)					////ESTOY INGRESANDO CAJAS --- LETRA C
{
$t1 	= convertir_a_numero($t1);
$creal 	= $t1;
$t1 	= $t1 * $factor;
$desc 	= "F";
}
else
{
$desc   = "T";
$creal  = $t1;
}
$stock_general = $stopro - $t1;
$stock_local   = $cant_loc - $t1;
mysqli_query($conexion,"UPDATE producto set stopro = '$stock_general', $tabla = '$stock_local' where codpro = '$codpro'");
mysqli_query($conexion,"UPDATE temp_venta set canpro = '$creal',fraccion = '$desc',prisal = '$t2',pripro = '$t3' where codtemp = '$codtemp'");
header("Location: venta_index1.php");
?>