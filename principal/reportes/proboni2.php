<?php include('../session_user.php');
require_once('../../conexion.php');
require_once('../../titulo_sist.php');
require_once('../../convertfecha.php');	//CONEXION A BASE DE DATOS
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $desemp?></title>
<link href="css/style1.css" rel="stylesheet" type="text/css" /></head>

<style type="text/css">
   
    
    .letras{
        font-size:12px;
    }
    .letras1{
        font-size:12px;
       
        
    }
    .letras12{
        font-size:10px;
        
        font-weight: 700px;
       
    }
</style>

<?php require_once("../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../funciones/funct_principal.php");	//IMPRIMIR-NUME
$sql="SELECT nomusu FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$user    = $row['nomusu'];
}
}
$hour   = date('G');
//$date	= CalculaFechaHora($hour); 
$date = date("Y-m-d");
//$hour   = CalculaHora($hour);
$min			= date('i');
if ($hour <= 12)
{
    $hor    = "am";
}
else
{
    $hor    = "pm";
}
$val   			= $_REQUEST['val'];
$country		= $_REQUEST['country'];
$report			= $_REQUEST['report'];
$inicio 		= $_REQUEST['inicio'];
$pagina 		= $_REQUEST['pagina'];
$tot_pag 		= $_REQUEST['tot_pag'];
$registros  	= $_REQUEST['registros'];
function formato($c) {
printf("%06d",$c);
} 
function convertir_a_numero($str)
{
	  $legalChars = "%[^0-9\-\. ]%";
	  $str=preg_replace($legalChars,"",$str);
	  return $str;
}
?>
<body>
<table width="98%" border="0">
  <tr>
    <td width="100%">
      <table width="100%" border="0">
        <tr class="letras1" >
          <td width="278"><strong><?php echo $desemp?> </strong></td>
            <td width="563"><div align="center"><strong>REPORTE DE PRODUCTOS BONIFICADOS</strong></div></td>
            <td width="278"><div align="right"><strong>FECHA: <?php echo date('d/m/Y');?> - HORA : <?php echo $hour;?>:<?php echo $min;?> <?php echo $hor?></strong></div></td>
        </tr>
      </table>
      <table width="100%" border="0">
        <tr>
          <td width="278">&nbsp;</td>
            <td width="565"><div align="center"><b><?php if ($val == 1){ echo $country; }?></b></div></td>
            <td width="276"><div align="right">USUARIO:<span class="text_combo_select"><?php echo $user?></span></div></td>
        </tr>
      </table>
      <div align="left"><img src="../../images/line2.png" width="940" height="4" /></div></td>
  </tr>
</table>
<?php if ($val == 1)
{
 ?>
  
<table width="98%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>
        <table width="100%" border="0">
      <tr>
        <td width="220"><strong>PRODUCTO</strong></td>
        <td width="100"><div align="center"><strong>MARCA</strong></div></td>
        <td width="100"><div align="center"><strong>CAN. BONIFICADA</strong></div></td>
        <td width="100"><div align="center"><strong>CAN. DE VENTA PARA BONIFICAR</strong></div></td>
       
        </tr>
    </table>
    </td>
  </tr>
</table>
    
<table width="98%" border="1" cellpadding="0" cellspacing="0">
	  <?php 
	  //echo $country;
	  $sql="SELECT  codpro,desprod,codmar ,codprobonif,cantbonificable,cantventaparabonificar FROM producto WHERE codprobonif <>'0' and cantventaparabonificar <>'0' and cantbonificable <>'0' ";
	  $result = mysqli_query($conexion,$sql);
	  if (mysqli_num_rows($result)){
	  while ($row = mysqli_fetch_array($result)){
		
		$codpro                     = $row['codpro'];
		$desprod                    = $row['desprod'];
		$codmar                     = $row['codmar'];
		$cantbonificable            = $row['cantbonificable'];
		$cantventaparabonificar     = $row['cantventaparabonificar'];
		if ($codmar <> 0)
		{
                    
		  $sql1="SELECT abrev,destab FROM titultabladet where codtab = '$codmar'";
		  $result1 = mysqli_query($conexion,$sql1);
		  if (mysqli_num_rows($result1)){
		  while ($row1 = mysqli_fetch_array($result1)){
		  $abrev     = $row1['abrev'];
		  $destab    = $row1['destab'];
		  }
		  }
		  else
		  {
		  $abrev == "";
		  }
		  if ($abrev == "")
		  {
		  $abrev = $destab;
		  }
		}
		else
		{
		$abrev = "";
		}
	  ?>
	  <tr>
                <td width="180"><?php echo $desprod?></td>
		<td width="120"><?php echo $destab;?></td>
		<td width="100"  align="center"><?php echo $cantbonificable;?></td>
		<td width="100"  align="center"><?php echo $cantventaparabonificar;?></td>
                
      </tr>
	  <?php }
	  }
	  else
	  {
	  ?>
	  <center><br /><br /><br /><br />NO SE PUDO ENCONTRAR INFORMACI�N CON LOS DATOS INGRESADOS</center>
	  <?php }
	  ?>
</table>
<?php }
?>
</body>
</html>
