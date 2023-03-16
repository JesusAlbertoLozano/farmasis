<?php 
include('../../session_user.php');
require_once ('../../../conexion.php');
$invnum  = (isset($_SESSION['compras']) ? $_SESSION['compras'] : "");;
$cod	 = $_REQUEST['cod'];
$ok  	 = $_REQUEST['ok'];
$text1   = $_REQUEST['text1'];	///cantidad ingresada
$text2   = $_REQUEST['text2'];	///precio sin descuentos y sin igv
$text3   = $_REQUEST['text3'];	///descuento1
$text4   = $_REQUEST['text4'];	///descuento2
$text5   = $_REQUEST['text5'];	///descuento3
$text6   = $_REQUEST['text6'];	///nuevo precio	
$text7   = $_REQUEST['text7'];	///total por item
$costpr  = $_REQUEST['costpr']; ///costo promedio antiguo
$stopro  = $_REQUEST['stockpro']; ///stock antiguo
$factor  = $_REQUEST['factor']; ///factor
$bonifi	 = $_REQUEST['bonifi'];
$number	 = $_REQUEST['number'];
$ckigv	 = $_REQUEST['ckigv'];



$price  		= $_REQUEST['price'];		///precio de costo
$price1  		= $_REQUEST['price1'];		///margen
$price2    		= $_REQUEST['price2'];		///precio venta
$price3    		= $_REQUEST['price3'];		///precio venta unit
$xfactor        = $_REQUEST['factor'];

$numero  = $_REQUEST['countryL'];
$codpro  = $_REQUEST['codpro'];
$mes     = $_REQUEST['mesL'];
$years   = $_REQUEST['yearsL'];
$vencimiento = $mes."/".$years;

/////////////BLISTER

$p3       = $_REQUEST['p3'];
$blister  = $_REQUEST['blister'];


///////////stock mini
$codloc	 = $_REQUEST['codloc'];
$minim	 = $_REQUEST['minim'];
$marca	 = $_REQUEST['marca'];
$cr  	 = $_REQUEST['cr'];
$ccr  	 = $_REQUEST['ccr'];
if ( $xfactor >= 2)
    {}
else
    {
     $price3=$price2;
//    echo $price2;
//    echo $price3;
//    sleep(1); // Se detiene 2 segundos en continuar la ejecuci�0�1�0�6n
    }




$busca_prov	 = (isset($_REQUEST['busca_prov']) ? $_REQUEST['busca_prov'] : "");;
$busca_empre = $_REQUEST['busca_empre'];
if ($ckigv == 1)
{
    $ConIgv = 1;
}
else
{
    $ConIgv = 0;
}
/////CONTEO DE CODIGO DE LA TABLA TEMPORAL
$sql="SELECT codtemp FROM tempmovmov order by codtemp desc limit 1";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result))
{
	$codtemp       = $row[0];	
}	
$codtemp = $codtemp + 1;
}
else
{
	$codtemp = 1;
}

if ($number == 0)
{
/////HALLAR NUEVO COSTO PROMEDIO
	$promedio = ((($stopro/$factor) * $costpr)+($text1*$text6))/(($stopro/$factor)+$text1);
}
else
{
	function convertir_a_numero($str)
	{
	  $legalChars = "%[^0-9\-\. ]%";
	
	  $str=preg_replace($legalChars,"",$str);
	  return $str;
	}
$text_char =  convertir_a_numero($text1);
$promedio = ((($stopro/$factor) * $costpr)+(($text_char/$factor)*$text6))/(($stopro/$factor)+($text_char/$factor));
}

if ($number == 0)
{
	$sql="SELECT codtemp FROM tempmovmov where invnum = '$invnum' AND codpro = '$cod'";
	$result = mysqli_query($conexion,$sql);
	
		if ($bonifi == 1)
		{
			//mysqli_query($conexion,"INSERT INTO tempmovmov (codtemp,invnum,codpro,qtypro,qtyprf,prisal,canbon,tipbon,desc1,desc2,desc3,pripro,costre,costpr,conigv) values ('$codtemp','$invnum','$cod','$text1','','$text2','1','U','$text3','$text4','$text5','$text6','$text7','$promedio','$ConIgv')");
			mysqli_query($conexion,"INSERT INTO tempmovmov (invnum,codpro,qtypro,qtyprf,prisal,canbon,tipbon,desc1,desc2,desc3,pripro,costre,costpr,conigv) values ('$invnum','$cod','$text1','','$text2','1','U','$text3','$text4','$text5','$text6','$text7','$promedio','$ConIgv')");
		}
		else
		{
		//mysqli_query($conexion,"INSERT INTO tempmovmov (codtemp,invnum,codpro,qtypro,qtyprf,prisal,desc1,desc2,desc3,pripro,costre,costpr,conigv) values ('$codtemp','$invnum','$cod','$text1','','$text2','$text3','$text4','$text5','$text6','$text7','$promedio','$ConIgv')");
			mysqli_query($conexion,"INSERT INTO tempmovmov (invnum,codpro,qtypro,qtyprf,prisal,desc1,desc2,desc3,pripro,costre,costpr,conigv) values ('$invnum','$cod','$text1','','$text2','$text3','$text4','$text5','$text6','$text7','$promedio','$ConIgv')");
		}
	
}
else
{
	$sql="SELECT codtemp FROM tempmovmov where invnum = '$invnum' AND codpro = '$cod'";
	$result = mysqli_query($conexion,$sql);
	
		if ($bonifi == 1)
		{
		//mysqli_query($conexion,"INSERT INTO tempmovmov (codtemp,invnum,codpro,qtypro,qtyprf,prisal,canbon,tipbon,desc1,desc2,desc3,pripro,costre,costpr,conigv) values ('$codtemp','$invnum','$cod','','$text1','$text2','1','U','$text3','$text4','$text5','$text6','$text7','$promedio','$ConIgv')");
		mysqli_query($conexion,"INSERT INTO tempmovmov (invnum,codpro,qtypro,qtyprf,prisal,canbon,tipbon,desc1,desc2,desc3,pripro,costre,costpr,conigv) values ('$invnum','$cod','','$text1','$text2','1','U','$text3','$text4','$text5','$text6','$text7','$promedio','$ConIgv')");
		}
		else
		{
		//mysqli_query($conexion,"INSERT INTO tempmovmov (codtemp,invnum,codpro,qtypro,qtyprf,prisal,desc1,desc2,desc3,pripro,costre,costpr,conigv) values ('$codtemp','$invnum','$cod','','$text1','$text2','$text3','$text4','$text5','$text6','$text7','$promedio','$ConIgv')");
		mysqli_query($conexion,"INSERT INTO tempmovmov (invnum,codpro,qtypro,qtyprf,prisal,desc1,desc2,desc3,pripro,costre,costpr,conigv) values ('$invnum','$cod','','$text1','$text2','$text3','$text4','$text5','$text6','$text7','$promedio','$ConIgv')");
		}
	
}

$sql1="SELECT numlote,vencim FROM movlote where numlote = '$numero'";
$result1 = mysqli_query($conexion,$sql1);
if (mysqli_num_rows($result1)){
while ($row1 = mysqli_fetch_array($result1))
{
	$numlote        = $row1['numlote'];
	$vencimi        = $row1['vencim'];
}
/////////SI EXISTE EN LA BASE DE DATOS EL NUMERO VERIFICO SI YA LO TENGO EN MI TEMPORAL//////////////////////
	$sql2="SELECT numerolote FROM templote where invnum = '$invnum' and codpro = '$cod'";
	$result2 = mysqli_query($conexion,$sql2);
	if (mysqli_num_rows($result2))
	{
	mysqli_query($conexion, "UPDATE templote set numerolote = '$numlote',vencim = '$vencimi' where invnum = '$invnum' and codpro = '$cod'");
	}
	else
	{
	mysqli_query($conexion, "INSERT INTO templote (invnum,numerolote,codpro,vencim,codloc) values ('$invnum','$numlote','$cod','$vencimi','$codloc')");
	}
////////////////////////////////////////////////////////////////////////////////////////////////////
}
else
{
/////////SI EXISTE EN LA BASE DE DATOS EL NUMERO VERIFICO SI YA LO TENGO EN MI TEMPORAL//////////////////////
	$sql2="SELECT numerolote FROM templote where invnum = '$invnum' and codpro = '$cod'";
	$result2 = mysqli_query($conexion,$sql2);
	if (mysqli_num_rows($result2))
	{
	mysqli_query($conexion, "UPDATE templote set numerolote = '$numero',vencim = '$vencimiento' where invnum = '$invnum' and codpro = '$cod'");
	}
	else
	{
	mysqli_query($conexion, "INSERT INTO templote (invnum,numerolote,vencim,codpro,codloc) values ('$invnum','$numero','$vencimiento','$cod','$codloc')");
	}
////////////////////////////////////////////////////////////////////////////////////////////////////
}	



//////////////////////////////////7/BLISTER////////////////////////////////////////777
mysqli_query($conexion,"UPDATE producto set preblister = '$p3',blister = '$blister' where codpro = '$cod'");



//stockmini


$sql1="SELECT nomloc FROM xcompa where codloc = '$codloc'";
$result1 = mysqli_query($conexion,$sql1);
if (mysqli_num_rows($result1)){
while ($row1 = mysqli_fetch_array($result1)){
$nomloc     = $row1['nomloc'];
}
}
		if ($nomloc == 'LOCAL0')
		{
		$campo = 'm00';
		}
		if ($nomloc == 'LOCAL1')
		{
		$campo = 'm01';
		}
		if ($nomloc == 'LOCAL2')
		{
		$campo = 'm02';
		}
		if ($nomloc == 'LOCAL3')
		{
		$campo = 'm03';
		}
		if ($nomloc == 'LOCAL4')
		{
		$campo = 'm04';
		}
		if ($nomloc == 'LOCAL5')
		{
		$campo = 'm05';
		}
		if ($nomloc == 'LOCAL6')
		{
		$campo = 'm06';
		}
		if ($nomloc == 'LOCAL7')
		{
		$campo = 'm07';
		}
		if ($nomloc == 'LOCAL8')
		{
		$campo = 'm08';
		}
		if ($nomloc == 'LOCAL9')
		{
		$campo = 'm09';
		}
		if ($nomloc == 'LOCAL10')
		{
		$campo = 'm10';
		}
		if ($nomloc == 'LOCAL11')
		{
		$campo = 'm11';
		}
		if ($nomloc == 'LOCAL12')
		{
		$campo = 'm12';
		}
		if ($nomloc == 'LOCAL13')
		{
		$campo = 'm13';
		}
		if ($nomloc == 'LOCAL14')
		{
		$campo = 'm14';
		}
		if ($nomloc == 'LOCAL15')
		{
		$campo = 'm15';
		}
		if ($nomloc == 'LOCAL16')
		{
		$campo = 'm16';
		}
		if ($cr <> 17)
		{
		$cr++;
		}
		else
		{
		$cr = 1;
		}
		mysqli_query($conexion,"UPDATE producto set $campo = '$minim' where codpro = '$codpro'");
                

                
$sqlx = "SELECT factor,costpr,s000+s001+s002+s003+s004+s005+s006+s007+s008+s009+s010+s011+s012+s013+s014+s015+s016+s017+s018+s019+s020 as stoctal FROM producto where codpro = '$codpro'";
        $resultx = mysqli_query($conexion, $sqlx);
        if (mysqli_num_rows($resultx)) {
            while ($rowx = mysqli_fetch_array($resultx)) {
                $stoctal1        = $rowx['stoctal'];
                $costpr1        = $rowx['costpr'];
                $factor1       = $rowx['factor'];
            }
        }


        $stoctal = $stoctal1/$factor1;

if ($number == 0)
{
/////HALLAR NUEVO COSTO PROMEDIO
	$fin = (($stoctal * $costpr1)+($text1*$text6))/($stoctal+$text1);
}
else
{
$text_char = preg_replace("[^0-9]","",$text1);
$fin = (($stoctal * $costpr1)+(($text_char/$factor1)*$text6))/($stoctal+($text_char/$factor1));
}

//stockmini
mysqli_query($conexion, "UPDATE producto "
        . "set tcosto = '$fin',"
        . "tmargene = '$price1',"
        . "tprevta= '$price2', "
        . "tpreuni = '$price3', "
        . "tcostpr = '$fin' "
        . "where codpro = '$cod'");
                
header("Location: compras1.php?ok=4&ckigv=$ckigv&busca_prov=$busca_prov&busca_empre=$busca_empre"); 
?>