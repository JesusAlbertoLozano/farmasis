<?php include('../../session_user.php');
require_once('../../../conexion.php');
require_once('../../../convertfecha.php');
require_once('../../../titulo_sist.php');
require_once('../../../convertfecha.php');	//CONEXION A BASE DE DATOS
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $desemp?> - SALIDA POR TRANSFERENCIA DE SUCURSAL</title>
<script>
function imprimir()
{
var f = document.form1;
window.print();
f.action = "../ing_salid.php";
f.method = "post";
f.submit();
}
</script>
<?php 
function convertir_a_numero($str)
{
    $legalChars = "%[^0-9\-\. ]%";
    $str = preg_replace($legalChars, "", $str);
    return $str;
}
$invnum   	  = $_SESSION['transferencia_sal'];
//echo $invnum;
$sql="SELECT * FROM movmae where invnum = '$invnum'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
		$invnum       = $row['invnum'];		//codigo
		$fecha        = $row['invfec'];
		$refere       = $row['refere'];
		$fecdoc       = $row['fecdoc'];
		$fecven       = $row['fecven'];
		$numdoc       = $row['numdoc'];
		$ndoc         = $row['numero_documento'];
		$ndoc1        = $row['numero_documento1'];
		$plazo        = $row['plazo'];
		$val_habil    = $row['val_habil'];
		$invtot       = $row['invtot'];
		$destot       = $row['destot'];
		$valven       = $row['valven'];
		$costo        = $row['costo'];
		$igv          = $row['igv'];
		$sucursal  	  = $row['sucursal'];
		$sucursal1    = $row['sucursal1'];
		$usecod       = $row['usecod'];
		$codusu       = $row['codusu'];
		$sql1="SELECT nomusu FROM usuario where usecod = '$usecod'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
		$nomusuorig      = $row1['nomusu'];
		}}
		$sql1="SELECT nomusu FROM usuario where usecod = '$codusu'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
		$nomusudest      = $row1['nomusu'];
		}}
		$sql1="SELECT nomloc,nombre FROM xcompa where codloc = '$sucursal'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
		$nomloc       = $row1['nomloc'];
		$nombre       = $row1['nombre'];
		if ($nombre <> "")
		{
		$nombre = $nombre;
		}
		else
		{
		$nombre = $nomloc;
		}
		//isset($nombre)? $nombre = $nombre : $nombre = $nomloc;
		}}
		$sql1="SELECT nomloc,nombre FROM xcompa where codloc = '$sucursal1'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
		$nomloc1      = $row1['nomloc'];
		$nombre1      = $row1['nombre'];
		if ($nombre1 <> "")
		{
		$nombre1 = $nombre1;
		}
		else
		{
		$nombre1 = $nomloc1;
		}
		//isset($nombre1)? $nombre1 = $nombre1 : $nombre1 = $nomloc1;
		}}
}
}
?>
<style>
    body{
        font-size:13px;
    }
</style>
</head>
<body onLoad="imprimir();">
<form name="form1" id="form1">

<table width="98%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="11%">Fecha</td>
    <td width="20%"><?php echo fecha($fecha)?></td>
    <td width="69%"><div align="right">N Documento <?php echo $numdoc;?></div></td>
    </tr>
</table>
<table width="98%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="11%">Local de:</td>
    <td width="20%"><?php echo $nombre?></td>
    <td><div align="left">Local a: <?php echo $nombre1?></div></td>
    </tr>
</table>
<table width="98%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="11%">Doc. Referencia  </td>
    <td width="46%">TRANSFERENCIA POR SALIDAS  </td>
    <td>Usuario Orig : <?php echo $nomusuorig;?></td>
    </tr>
  <tr>
    <td>Referencia</td>
    <td>&nbsp; &nbsp; <?php echo $refere?></td>
    <td>Usuario Dest  : <?php echo $nomusudest;?></td>
    </tr>
</table>
<table width="98%" border="0">
  <tr>
    <td width="10%">Código</td>
    <td width="60%">Producto</td>
	<td width="20%">Marca</td>
	<td width="10%">Cantidad</td>
  </tr>
</table>
<?php 
$i = 0;
	$sql1="SELECT * FROM movmov where invnum = '$invnum'";
	$result1 = mysqli_query($conexion,$sql1);
	if (mysqli_num_rows($result1)){
	while ($row1 = mysqli_fetch_array($result1)){
	$i++;
	    $codpro    = $row1['codpro'];
		$qtypro    = $row1['qtypro'];	
		$qtyprf    = $row1['qtyprf'];
		$prisal    = $row1['prisal'];
		$pripro    = $row1['pripro'];
		$costre    = $row1['costre'];
		$d1        = $row1['desc1'];
		$d2        = $row1['desc2'];
		$d3        = $row1['desc3'];
		$sql11="SELECT desprod,codmar FROM producto where codpro = '$codpro'";
		$result11 = mysqli_query($conexion,$sql11);
		if (mysqli_num_rows($result11)){
		while ($row11 = mysqli_fetch_array($result11)){
				$desprod       = $row11['desprod'];		//codigo
				$codmar        = $row11['codmar'];
		}}
		$sql11="SELECT destab,abrev FROM titultabladet where codtab = '$codmar'";
		$result11 = mysqli_query($conexion,$sql11);
		if (mysqli_num_rows($result11)){
		while ($row11 = mysqli_fetch_array($result11)){
				$destab       = $row11['destab'];
				$abrev        = $row11['abrev'];	
		}}
		 if ($qtyprf <> "") {
                      // $cantidad_solicitada =  convertir_a_numero($qtyprf);
                        $texto= $qtyprf;
                } else {
                    
                    
                    $texto=$qtypro;
            } 
		
?>
<table width="98%" border="0">
  <tr>
     <td width="10%"><?php echo $codpro?></td>
	 <td width="60%"><?php echo $desprod?></td>
	 <td width="20%"><?php if ($abrev <> ""){echo $abrev; } else { echo $destab;}?></td>
	 <td width="10%"><?php  echo $texto;?></td>
  </tr>
</table>
<?php 
}}
//while ($i <= 35)
//{
//$i++;
//echo "<br>";
//}
?>
<table width="98%" border="0">
  <tr>
    <td width="15%">Almacen</td>
    <td width="35%"></td>
    <td width="15%">Transportista</td>
    <td width="35%"></td>
  </tr>
  <tr>
    <td width="15%">Digitador:</td>
    <td width="35%"></td>
    <td width="15%"> Encargado de tienda:</td>
    <td width="35%"></td>
  </tr>
</table>
</form>
</body>
</html>