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
	$limit = 50;
	}
	$t = is_numeric($letters);
	if($t == 0)
	{
		$caracter = ".";
		if (strpos($letters, $caracter) !== false) 
		{
		$res = mysqli_query($conexion,"select codpro,desprod from producto where codpro like '".$letters."%' order by desprod limit $limit") or die(mysqli_error());
		}
		else
		{
		$res = mysqli_query($conexion,"select codpro,desprod,codmar from producto where desprod like '".$letters."%' order by desprod limit $limit") or die(mysqli_error());
		}
	}
	else
	{
	$res = mysqli_query($conexion,"select codpro,desprod,codmar from producto where codpro like '".$letters."%' order by desprod limit $limit") or die(mysqli_error());
	}
	#echo "1###select ID,countryName from ajax_countries where countryName like '".$letters."%'|";
	while($inf = mysqli_fetch_array($res)){
		$codpro  = $inf['codpro'];
		$desprod = $inf['desprod'];
		$marca   = $inf['codmar'];
		$sql1="SELECT destab FROM titultabladet where codtab = '$marca'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
				$destab = $row1['destab'];
				$destab = substr($destab,0,35);
		}
		}
		$cad = $codpro." - <b>PROD = </b>".$desprod."..."."<b>LAB = </b>".$destab."|";
		echo $inf["codpro"]."###".$cad;
	}	
}
?>
