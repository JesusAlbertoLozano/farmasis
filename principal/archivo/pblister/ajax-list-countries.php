<?php require_once ('../../../conexion.php');	//CONEXION A BASE DE DATOS
if(isset($_REQUEST['getCountriesByLetters']) && isset($_REQUEST['letters'])){
	$letters = $_REQUEST['letters'];
	//$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$sql="SELECT limite FROM datagen_det";
    $result = mysqli_query($conexion,$sql);
    if (mysqli_num_rows($result) ){
	while ($row = mysqli_fetch_array($result)){
		 $limit             = $row['limite'];
    }
	}
	if ($limit == 0)
	{
	$limit = 15;
	}
	$t = $letters/1;
	if($t == 0)
	{
		$caracter = ".";
		if (strpos($letters, $caracter) !== false) 
		{
		$res = mysqli_query($conexion,"select codpro,desprod,codmar,preuni,factor,preblister from producto where codpro like '".$letters."%' limit $limit") or die(mysqli_error());
		}
		else
		{
		$res = mysqli_query($conexion,"select codpro,desprod,codmar,preuni,factor,preblister from producto where desprod like '".$letters."%' limit $limit") or die(mysqli_error());
		}
	}
	else
	{
	$res = mysqli_query($conexion,"select codpro,desprod,codmar,preuni,factor,preblister from producto where codpro like '".$letters."%' limit $limit") or die(mysqli_error());
	}
	#echo "1###select ID,countryName from ajax_countries where countryName like '".$letters."%'|";
	while($inf = mysqli_fetch_array($res)){
                $desprod = $inf['desprod'];
		$marca   = $inf['codmar'];
		$preuni  = $inf['preuni'];
		$factor  = $inf['factor'];
                $preblister  = $inf['preblister'];
		$desprod = substr($desprod,0,55);
		$pcaja   = $preuni * $factor;
                $sql1="SELECT destab FROM titultabladet where codtab = '$marca'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
				$destab = $row1['destab'];
				$destab = substr($destab,0,35);
		}
		}
                $cad = $desprod."<u><b> MARCA = </b>".$destab."..."."<b>  PRECIO CAJA = </b>".$pcaja."<b>  PRECIO UNITARIO = </b>".$preuni." <b>  PRECIO BLISTER = </b>".$preblister."</u>"."|";
		echo $inf["codpro"]."###".$cad;
	}	
}
?>
