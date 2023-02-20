<?php include('../../session_user.php');
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=SIST_digemid_DATA.xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../css/css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/css/tablas.css" rel="stylesheet" type="text/css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />












<?php require_once('../../../conexion.php');	//CONEXION A BASE DE DATOS?>
<?php require_once('../../../convertfecha.php');	//CONEXION A BASE DE DATOS?>
<?php //require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS?>
<?php require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUMEROS ENTEROS-DECIMALES?>
<?php require_once("../../../funciones/botones.php");	//COLORES DE LOS BOTONES?>
<?php // require_once("tabla_local.php");	//LOCAL DEL USUARIO?>
<?php require_once("../../local.php");	//LOCAL DEL USUARIO

//	$sql="SELECT P.codpro,P.desprod,P.stopro,P.digemid,P.s000, V.sucursal  from producto AS P INNER JOIN  detalle_venta AS DV on P.codpro =  DV.codpro INNER JOIN venta AS V on DV.Invnum = V.Invnum WHERE sucursal = 1 AND P.s000 >=1 AND P.s002>=1 ORDER BY codpro asc";
//	$sql="SELECT P.codpro,P.desprod,P.stopro,P.preuni,P.prevta ,P.digemid,P.s000, V.sucursal  from producto AS P INNER JOIN  detalle_venta AS DV on P.codpro =  DV.codpro INNER JOIN venta AS V on DV.Invnum = V.Invnum WHERE sucursal = 1 AND P.s000 >=1  ORDER BY codpro asc";
?>

</head>
    
    <?php
    function tablaslocal($nomloc)
{
	if ($nomloc == "LOCAL0")
	{
		$tabla = 's000';
	}
	if ($nomloc == "LOCAL1")
	{
		$tabla = 's001';
	}
	if ($nomloc == "LOCAL2")
	{
		$tabla = 's002';
	}
	if ($nomloc == "LOCAL3")
	{
		$tabla = 's003';
	}
	if ($nomloc == "LOCAL4")
	{
		$tabla = 's004';
	}
	if ($nomloc == "LOCAL5")
	{
		$tabla = 's005';
	}
	if ($nomloc == "LOCAL6")
	{
		$tabla = 's006';
	}
	if ($nomloc == "LOCAL7")
	{
		$tabla = 's007';
	}
	if ($nomloc == "LOCAL8")
	{
		$tabla = 's008';
	}
	if ($nomloc == "LOCAL9")
	{
		$tabla = 's009';
	}
	if ($nomloc == "LOCAL10")
	{
		$tabla = 's010';
	}
	if ($nomloc == "LOCAL11")
	{
		$tabla = 's011';
	}
	if ($nomloc == "LOCAL12")
	{
		$tabla = 's012';
	}
	if ($nomloc == "LOCAL13")
	{
		$tabla = 's013';
	}
	if ($nomloc == "LOCAL14")
	{
		$tabla = 's014';
	}
	if ($nomloc == "LOCAL15")
	{
		$tabla = 's015';
	}
	if ($nomloc == "LOCAL16")
	{
		$tabla = 's016';
	}
	return $tabla;
}
$sql1="SELECT nomusu FROM usuario where usecod = '$usuario'";
$result1 = mysqli_query($conexion,$sql1);
if (mysqli_num_rows($result1)){
while ($row = mysqli_fetch_array($result1)){
	$user    = $row['nomusu'];
}
}
$sql2="SELECT nomloc FROM xcompa where codloc = '$codloc'";
$result2 = mysqli_query($conexion,$sql2);
if (mysqli_num_rows($result2)){
while ($row = mysqli_fetch_array($result2)){
    $nomloc    = $row['nomloc'];
}
}
$Tabla = tablaslocal($nomloc);
$date   = date('d/m/Y');
$hour  = date('G');  

$min	= date('i');
if ($hour <= 12)
{
    $hor    = "am";
}
else
{
    $hor    = "pm";
}


require_once("tabla_local.php");	//LOCAL DEL USUARIO
require_once("../../local.php");	//LOCAL DEL USUARIO
    ?>
    
    
    
    
<body <?php ?>onload="sf();"<?php ?>>

  <table width="930" border="0" align="center">
  <tr>
    <td>
       <table width="900" border="0">
      <tr>
        <td width="260"><strong><?php echo $desemp?> </strong></td>
        <td width="380">
		<div align="center"><strong> REPORTES DE DIGEMID - 
          <?php echo $nomloc;?>
        </strong></div>
		</td>
        <td width="260">
		<div align="right"><strong>FECHA: <?php echo date('d/m/Y');?> - HORA : <?php echo $hour;?>:<?php echo $min;?> <?php echo $hor?></strong></div></td>
      </tr>

    </table>
      <table width="914" border="0">
        <tr>

            <td width="133"><div align="right"><strong>USUARIO:</strong><span class="text_combo_select"><?php echo $user?></span></div></td>
        </tr>
      </table>
      <div align="center"><img src="../../images/line2.png" width="850" height="4" /></div></td>
  </tr>
</table>
    
    
    
   
    <table width="200" border="1" align="center" >
 
          <tr>
<!--            <td width="38"><strong>N�</strong></td>-->
            <td width="20"><div align="center"><strong>C. Producto </strong></div></td>
            <td width="20"><div align="center"><strong>Digemid </strong></div></td>
            <td width="49"><div align="center"><strong>Pre. Producto</strong></div></td>
            <td width="77"><div align="center"><strong>Pre. unid. Producto</strong></div></td>
            <td width="130"><div align="center"><strong>PRODUCTO</strong></div></td>
            <td width="130"><div align="center"><strong>MARCA</strong></div></td>
          </tr>
        
           <tr>
              <?php
             $i = 0;
              $sql3="SELECT codpro,desprod,preuni,prevta ,digemid,codmar,factor,$tabla  from producto WHERE $tabla >=1 AND digemid <> 0 and stopro>0 ORDER BY codpro ASC ";
	$result3 = mysqli_query($conexion,$sql3);
     
	if (mysqli_num_rows($result3)){
            
           
	while ($row = mysqli_fetch_array($result3)){
           
		$codpro          = $row['codpro'];
		$desprod         = $row['desprod'];
		$codmar         = $row['codmar'];
		$factor         = $row['factor'];
        $digemid         = $row['digemid'];
        $prevta          = $row['prevta'];
        $preuni          = $row['preuni'];
        $s000	         = $row['s000'];  
        
        
        $sql1="SELECT destab FROM titultabladet where tiptab = 'M' and codtab = '$codmar'";
				$result1 = mysqli_query($conexion,$sql1);
				if (mysqli_num_rows($result1)){
				while ($row1 = mysqli_fetch_array($result1)){
					$destab    = $row1['destab'];
				}
				}
          $i++; 
        
              ?>
<!--               <td width="38"><?php echo  $tabla ?> </td>-->
              <td width="20" align="center" ><?php echo $codpro?></td>
              <td width="20" align="center" ><?php echo $digemid?></td>
              <td width="49" align="center" ><?php echo $prevta?></td>
              
              <td width="77"align="center" ><?php if ($factor ==1){ echo $prevta;}else{ echo $preuni;}?></td>
              
              <td width="77"align="center" ><?php echo $desprod?></td>
              <td width="77"align="center" ><?php echo $destab?></td>
           
          </tr>
     

    
       
    
    
    <?php
    
//    $i=0;
//    while ($i<=10){
//        echo $i . '<br>';
//        $i++;
//    }
//    
             
        }
        }
    ?>
       </table>

</body>
</html>
