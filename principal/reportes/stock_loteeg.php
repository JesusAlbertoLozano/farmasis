<?php 
//ini_set('max_execution_time', 900);
include('../session_user.php');
require_once('../../conexion.php');
require_once('../../titulo_sist.php');
require_once('../../convertfecha.php');	//CONEXION A BASE DE DATOS
?>
<?php 
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=SIST_EXPORT_DATA.xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $desemp?></title>
</head>
<?php require_once("../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../funciones/funct_principal.php");	//IMPRIMIR-NUME
$sql="SELECT * FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$user    = $row['nomusu'];
}
}
$date   = date('d/m/Y');
$hour  = date('G');  
//$hour   = CalculaHora($hour);
$min	= date('i');
if ($hour <= 12)
{
    $hor    = "am";
}
else
{
    $hor    = "pm";
}
$val    = $_REQUEST['val'];
$vals   = $_REQUEST['vals'];
$desc   = $_REQUEST['desc'];
$desc1  = $_REQUEST['desc1'];
$date1  = $_REQUEST['date1'];
$date2  = $_REQUEST['date2'];
$doc  = $_REQUEST['doc'];
$ck     = $_REQUEST['ck'];
$ck1    = $_REQUEST['ck1'];
$ckloc  = $_REQUEST['ckloc'];
$ckprod = $_REQUEST['ckprod'];
$local  = $_REQUEST['local'];
$inicio = $_REQUEST['inicio'];
$pagina = $_REQUEST['pagina'];
$tot_pag = $_REQUEST['tot_pag'];

$dat1	 = $date1;
$dat2	 = $date2;
$date1	 = fecha1($dat1);
$date2   = fecha1($dat2);
$registros  = $_REQUEST['registros'];
$registros = 40;
$pagina = $_REQUEST["pagina"];
if (!$pagina) {
$inicio = 0;
$pagina = 1;
}
else 
{
$inicio = ($pagina - 1) * $registros;
} 
if ($local <> 'all')
{
	$sql="SELECT nomloc,nombre FROM xcompa where codloc = '$local'";
	$result = mysqli_query($conexion,$sql); 
	while ($row = mysqli_fetch_array($result)){ 
	$nloc	= $row['nomloc'];
	$nombre	= $row['nombre'];
		if ($nombre == '')
		{
		$locals = $nloc;
		}
		else
		{
		$locals = $nombre;
		}
	}
}
?>
<body>
<table width="930" border="0" align="center">
  <tr>
    <td><table width="914" border="0">
      <tr>
        <td width="260"><strong><?php echo $desemp?></strong></td>
        <td width="380"><div align="center"><strong>REPORTE DE STOCK POR LOTES </strong></div></td>
        <td width="260"><div align="right"><strong>FECHA: <?php echo date('d/m/Y');?> - HORA : <?php echo $hour;?>:<?php echo $min;?> <?php echo $hor?></strong></div></td>
      </tr>

    </table>
      <table width="914" border="0">
        <tr>
          <td width="134"><strong> </strong></td>
          <td width="633"><div align="center"><b>REPORTE POR <?php echo $desc_tipo?> - <?php echo $desc?></b></div></td>
          <td width="133"><div align="right">USUARIO:<span class="text_combo_select"><?php echo $user?></span></div></td>
        </tr>
      </table>
      <div align="center"><img src="../../images/line2.png" width="910" height="4" /></div></td>
  </tr>
</table>
      
  </tr>
</table>
<?php 
if ($ckprod == 1)
{
?>

<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
        <table width="555" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
        <table width="926" border="0" align="center">
            <TR>
            <center> <h2>PRODUCTOS POR REVISAR </h2></center>
        </TR>
    </table>
    
    </td>
  </tr>
</table>
    	<table width="926" border="0" align="center">
      		<tr>
            <td width="40"><div align="left"><strong>SUCURSAL   </strong></div></td>
            <td width="50"><div align="left"><strong>COD. PRODUCTO  </strong></div></td>
            <td width="50"><div align="left"><strong>PRODUCTO</strong></div></td>
            <td width="24"><div align="left"><strong>MARCA</strong></div></td>
            <td width="50"><div align="left"><strong>FECHA</strong></div></td>
            <td width="54"><div align="left"><strong>STOCK</strong></div></td>
            <td width="54"><div align="left"><strong>N. LOTE</strong></div></td>
            <td width="54"><div align="left"><strong>FEVen</strong></div></td>
          
            </tr>
      	</table>
        <table width="926" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
               <td>
               <?php 
				$zz = 0;
				 if ($vals == 2){
                   if ($local == 'all'){
//                  if($doc==1){
//                     $sql = "SELECT ML.vencim,P.factor,P.stopro,P.codpro,SUM(P.stopro) AS STOCKPRO,P.desprod,t.destab AS MARCA,ML.vencim,ML.codloc,SUM(ML.stock) as stocklote,ML.numlote, ML.codloc, SUM(P.s000 + P.s001 + P.s002 + P.s003 + P.s004 + P.s005 +	P.s006 + P.s007 + P.s008 + P.s009 + P.s010 + P.s011 +	P.s012 + P.s013 + P.s014 + P.s015 + P.s016 + P.s017 + P.s018 + P.s019 + P.s020) AS sttotal from movlote AS ML  INNER JOIN producto AS  P  ON ML.codpro=P.codpro INNER JOIN titultabladet t on P.codmar = t.codtab  where  desprod like '$desc%'  and  P.stopro<>ML.stock   and  P.stopro>0   and  ML.stock>0     GROUP BY P.codpro order by codpro ";
//                     }
//                        if($doc==2){
//                     $sql="SELECT ML.vencim,P.factor,P.stopro,P.codpro,SUM(P.stopro) AS STOCKPRO,P.desprod,t.destab AS MARCA,ML.vencim,ML.codloc,SUM(ML.stock) as stocklote,ML.numlote, ML.codloc, SUM(P.s000 + P.s001 + P.s002 + P.s003 + P.s004 + P.s005 +	P.s006 + P.s007 + P.s008 + P.s009 + P.s010 + P.s011 +	P.s012 + P.s013 + P.s014 + P.s015 + P.s016 + P.s017 + P.s018 + P.s019 + P.s020) AS sttotal from movlote AS ML  INNER JOIN producto AS  P  ON ML.codpro=P.codpro INNER JOIN titultabladet t on P.codmar = t.codtab  where  tiptab = 'M' and destab like '$desc%'  and  P.stopro<>ML.stock   and  P.stopro>0   and  ML.stock>0     GROUP BY P.codpro order by codpro"; 
//    
//                        }
                       
                     $sql="SELECT ML.vencim,P.factor,P.stopro,P.codpro,SUM(P.stopro) AS STOCKPRO,P.desprod,t.destab AS MARCA,ML.vencim,ML.codloc,SUM(ML.stock) as stocklote,ML.numlote, ML.codloc, SUM(P.s000 + P.s001 + P.s002 + P.s003 + P.s004 + P.s005 +	P.s006 + P.s007 + P.s008 + P.s009 + P.s010 + P.s011 +	P.s012 + P.s013 + P.s014 + P.s015 + P.s016 + P.s017 + P.s018 + P.s019 + P.s020) AS sttotal from movlote AS ML  INNER JOIN producto AS  P  ON ML.codpro=P.codpro INNER JOIN titultabladet t on P.codmar = t.codtab  where  P.stopro<>ML.stock   and  P.stopro>0   and  ML.stock>0     GROUP BY P.codpro order by codpro "; 
                        
                       
                        }
		else{
//                     if($doc==1){
//                     $sql = "SELECT ML.vencim,P.factor,P.stopro,P.codpro,SUM(P.stopro) AS STOCKPRO,P.desprod,t.destab AS MARCA,ML.vencim,ML.codloc,SUM(ML.stock) as stocklote,ML.numlote, ML.codloc, SUM(P.s000 + P.s001 + P.s002 + P.s003 + P.s004 + P.s005 +	P.s006 + P.s007 + P.s008 + P.s009 + P.s010 + P.s011 +	P.s012 + P.s013 + P.s014 + P.s015 + P.s016 + P.s017 + P.s018 + P.s019 + P.s020) AS sttotal from movlote AS ML  INNER JOIN producto AS  P  ON ML.codpro=P.codpro INNER JOIN titultabladet t on P.codmar = t.codtab  where  desprod like '$desc%'  and  P.stopro<>ML.stock   and  P.stopro>0   and  ML.stock>0    AND ML.codloc='$local' GROUP BY P.codpro order by codpro ";
//                     }
//                        if($doc==2){
//                     $sql="SELECT ML.vencim,P.factor,P.stopro,P.codpro,SUM(P.stopro) AS STOCKPRO,P.desprod,t.destab AS MARCA,ML.vencim,ML.codloc,SUM(ML.stock) as stocklote,ML.numlote, ML.codloc, SUM(P.s000 + P.s001 + P.s002 + P.s003 + P.s004 + P.s005 +	P.s006 + P.s007 + P.s008 + P.s009 + P.s010 + P.s011 +	P.s012 + P.s013 + P.s014 + P.s015 + P.s016 + P.s017 + P.s018 + P.s019 + P.s020) AS sttotal from movlote AS ML  INNER JOIN producto AS  P  ON ML.codpro=P.codpro INNER JOIN titultabladet t on P.codmar = t.codtab  where  tiptab = 'M' and destab like '$desc%'  and  P.stopro<>ML.stock   and  P.stopro>0   and  ML.stock>0    AND ML.codloc='$local'  GROUP BY P.codpro order by codpro"; 
//    
//                        }
                  
                     $sql="SELECT ML.vencim,P.factor,P.stopro,P.codpro,SUM(P.stopro) AS STOCKPRO,P.desprod,t.destab AS MARCA,ML.vencim,ML.codloc,SUM(ML.stock) as stocklote,ML.numlote, ML.codloc, SUM(P.s000 + P.s001 + P.s002 + P.s003 + P.s004 + P.s005 +	P.s006 + P.s007 + P.s008 + P.s009 + P.s010 + P.s011 +	P.s012 + P.s013 + P.s014 + P.s015 + P.s016 + P.s017 + P.s018 + P.s019 + P.s020) AS sttotal from movlote AS ML  INNER JOIN producto AS  P  ON ML.codpro=P.codpro INNER JOIN titultabladet t on P.codmar = t.codtab  where  P.stopro<>ML.stock   and  P.stopro>0   and  ML.stock>0   AND ML.codloc='$local'  GROUP BY P.codpro order by codpro "; 
                 
                                               
                        
                            }

                        }
				$result = mysqli_query($conexion,$sql);
				if (mysqli_num_rows($result)){
				?>
                <table width="926" border="0" align="center">
                    <?php 
					while ($row = mysqli_fetch_array($result)){
		$codpro    = $row['codpro'];
		$STOCKPRO    = $row['STOCKPRO'];
		$producto    = $row['desprod'];
		$marca    = $row['MARCA'];
		$venc    = $row['vencim'];
		$codloc    = $row['codloc'];
		$stocklote   = $row['stocklote']; //$stocklote
		$numlote   = $row['numlote'];
		$factor   = $row['factor'];
		$sttotal   = $row['sttotal'];
		$stopro  = $row['stopro'];
                
                $convert1       = $stocklote/$factor; //PRODUCTO
		$convert2       = $stopro/$factor; //MVLOTE
		$div1    	= floor($convert1); //PRODUCTO
		$div2    	= floor($convert2); //MVLOTE
		
		$UNI1 = ($stocklote-($div1*$factor));
		$UNI2 = ($stopro-($div2*$factor));
                
                $sql3="SELECT nomloc,nombre FROM xcompa where codloc = '$codloc'";
				$result3 = mysqli_query($conexion,$sql3); 
				while ($row3 = mysqli_fetch_array($result3)){ 
				$nloc	= $row3["nomloc"];
				$nombre	= $row3["nombre"];
					if ($nombre == ''){
					$sucur = $nloc;}
					else{
					$sucur = $nombre;}}
						
					?>
                               	  <tr>
                <td width="130"><?php echo $sucur;?></td>
                <td width="120"><?php echo $codpro;?></td>
                <td   width="120"><div align="center"><?php echo $producto;?></div></td>
                <td  width="120"><div align="center"><?php echo $marca;?></div></td>
                <td  width="120"><div align="center"><?php echo $venc;?></div></td>
                <td width="134" align="left"><?php echo $div2."C" ." ". $UNI2." "."unid";?></td>
                <td width="134"><?php echo $numlote ;?></td>
                <td width="134"><?php echo $venc;?></td>
		
      </tr>
                    <?php 
					}
					?>
                </table>
                <?php 
				}
				?>
               </td>
            </tr>
        </table>
    </td>
  </tr>
</table>


<!--nooo-->
<?php	
}
else
{
if (($ck == '') && ($ck1 == '')){
if (($val == 1) || ($vals == 2) )
{

$doc  = $_REQUEST['doc'];
if ($doc == 3)
{
$desc_tipo = "TODOS LOS PRODUCTOS";
}
   if ($doc == 2)
{
$desc_tipo = "MARCA";
}
   if ($doc == 1)
{
$desc_tipo = "PRODUCTO";
}
?>
<table width="555" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
        <table width="926" border="0" align="center">
            <TR>
            <center> <h2>BUSQUEDAD POR <?php echo $desc_tipo?> </h2></center>
           
        
        </TR>
    </table>
    
    </td>
  </tr>
</table>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
        <table width="926" border="0" align="center">
<!--      <tr>
        <?php if ($ckloc == 1){?>
		<td width="120"><strong>LOCAL</strong></td>
		<?php }?>
          <td align="center"width="240"><strong>FECHA</strong></td>
        <td align="center"width="180"><strong> INICIAL</strong></td>
        <td align="center"width="180"><strong>FINAL</strong></td>
        <td align="center" width="160"><strong>AFECTO</strong></td>
        <td align="center" width="160"><strong>INAFECTO</strong></td>
        <td align="center"width="150"><strong>IGV</strong></td>
        <td align="center"width="150"><strong>TOTAL</strong></td>
      </tr>-->
       <tr>
        <td  width="<?php if ($doc == 1){?>160<?php }elseif ($doc == 2){?>160<?php }elseif ($doc == 3){?>10000<?php }else{?>0<?php }?>"><div align="left"><strong>SUCURSAL </strong></div></td>
        <td  width="<?php if ($doc == 1){?>160<?php }elseif ($doc == 2){?>160<?php }elseif ($doc == 3){?>10000<?php }else{?>0<?php }?>"><div align="left"><strong>CODIGO PRO</strong></div></td>
        <td  width="<?php if ($doc == 1){?>160<?php }elseif ($doc == 3){?>21000<?php }else{?>0<?php }?>"><div align="center"><?php if ($doc == 1){echo "<strong>PRODUCTO</strong>";}elseif ($doc == 3){echo "<strong>PRODUCTO</strong>";}?></div></td>
        <td  width="<?php if ($doc == 2){?>160<?php }elseif ($doc == 3){?>21000<?php }else{?>0<?php }?>"><div align="center"><?php if ($doc == 2){echo "<strong>MARCA</strong>";}elseif ($doc == 3){echo "<strong>MARCA</strong>";}?></div></td>
        <td  width="<?php if ($doc == 2){?>160<?php }elseif ($doc == 1){?>134<?php }elseif ($doc == 3){?>21000<?php }else{?>0<?php }?>"><div align="center"><?php if ($doc == 2){echo "<strong>STOCK (POR LOTE)</strong>";}elseif ($doc == 1){echo "<strong>STOCK (POR LOTE)</strong>";}elseif ($doc == 3){echo "<strong> STOCK (POR LOTEWW) </strong>";}?></div></td>
        <td  width="<?php if ($doc == 2){?>160<?php }elseif ($doc == 1){?>134<?php }elseif ($doc == 3){?>-1<?php }else{?>0<?php }?>"><div align="center"><?php if ($doc == 2){echo "<strong>STOCK (ARCH. PRODUCTO)</strong>";}elseif ($doc == 1){echo "<strong>STOCK (ARCH. PRODUCTO)</strong>";}?></div></td>
        <td  width="<?php if ($doc == 2){?>160<?php }elseif ($doc == 1){?>134<?php }elseif ($doc == 3){?>-1<?php }else{?>0<?php }?>"><div align="center"><?php if ($doc == 2){echo "<strong>N&ordm;  LOTE</strong>";}elseif ($doc == 1){echo "<strong>N&ordm;  LOTE</strong>";}?></div></td>
        <td  width="<?php if ($doc == 2){?>160<?php }elseif ($doc == 1){?>134<?php }elseif ($doc == 3){?>-1<?php }else{?>0<?php }?>"><div align="center"><?php if ($doc == 2){echo "<strong>VENCIMIENTO</strong>";}elseif ($doc == 1){echo "<strong>VENCIMIENTO</strong>";}?></div></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
        
        
	<?php 
                if ($vals == 2){
                   if ($local == 'all'){
                  if($doc==1){
                     $sql = "SELECT ML.vencim,P.factor,P.stopro,P.codpro,SUM(P.stopro) AS STOCKPRO,P.desprod,t.destab AS MARCA,ML.vencim,ML.codloc,SUM(ML.stock) as stocklote,ML.numlote, ML.codloc, SUM(P.s000 + P.s001 + P.s002 + P.s003 + P.s004 + P.s005 +	P.s006 + P.s007 + P.s008 + P.s009 + P.s010 + P.s011 +	P.s012 + P.s013 + P.s014 + P.s015 + P.s016 + P.s017 + P.s018 + P.s019 + P.s020) AS sttotal from movlote AS ML  INNER JOIN producto AS  P  ON ML.codpro=P.codpro INNER JOIN titultabladet t on P.codmar = t.codtab  where  desprod like '$desc%'  and  P.stopro>0    GROUP BY P.codpro order by codpro ";
                     }
                        if($doc==2){
                     $sql="SELECT ML.vencim,P.factor,P.stopro,P.codpro,SUM(P.stopro) AS STOCKPRO,P.desprod,t.destab AS MARCA,ML.vencim,ML.codloc,SUM(ML.stock) as stocklote,ML.numlote, ML.codloc, SUM(P.s000 + P.s001 + P.s002 + P.s003 + P.s004 + P.s005 +	P.s006 + P.s007 + P.s008 + P.s009 + P.s010 + P.s011 +	P.s012 + P.s013 + P.s014 + P.s015 + P.s016 + P.s017 + P.s018 + P.s019 + P.s020) AS sttotal from movlote AS ML  INNER JOIN producto AS  P  ON ML.codpro=P.codpro INNER JOIN titultabladet t on P.codmar = t.codtab  where  tiptab = 'M' and destab like '$desc%'  and  P.stopro>0    GROUP BY P.codpro order by codpro"; 
    
                        }
                        if($doc==3){
                     $sql="SELECT ML.vencim,P.factor,P.stopro,P.codpro,SUM(P.stopro) AS STOCKPRO,P.desprod,t.destab AS MARCA,ML.vencim,ML.codloc,SUM(ML.stock) as stocklote,ML.numlote, ML.codloc, SUM(P.s000 + P.s001 + P.s002 + P.s003 + P.s004 + P.s005 +	P.s006 + P.s007 + P.s008 + P.s009 + P.s010 + P.s011 +	P.s012 + P.s013 + P.s014 + P.s015 + P.s016 + P.s017 + P.s018 + P.s019 + P.s020) AS sttotal from movlote AS ML  INNER JOIN producto AS  P  ON ML.codpro=P.codpro INNER JOIN titultabladet t on P.codmar = t.codtab  where  P.stopro>0    GROUP BY P.codpro order by codpro "; 
                        }
                       
                        }
		else{
                     if($doc==1){
                     $sql = "SELECT ML.vencim,P.factor,P.stopro,P.codpro,SUM(P.stopro) AS STOCKPRO,P.desprod,t.destab AS MARCA,ML.vencim,ML.codloc,SUM(ML.stock) as stocklote,ML.numlote, ML.codloc, SUM(P.s000 + P.s001 + P.s002 + P.s003 + P.s004 + P.s005 +	P.s006 + P.s007 + P.s008 + P.s009 + P.s010 + P.s011 +	P.s012 + P.s013 + P.s014 + P.s015 + P.s016 + P.s017 + P.s018 + P.s019 + P.s020) AS sttotal from movlote AS ML  INNER JOIN producto AS  P  ON ML.codpro=P.codpro INNER JOIN titultabladet t on P.codmar = t.codtab  where  desprod like '$desc%'  and  P.stopro>0   AND ML.codloc='$local' GROUP BY P.codpro order by codpro ";
                     }
                        if($doc==2){
                     $sql="SELECT ML.vencim,P.factor,P.stopro,P.codpro,SUM(P.stopro) AS STOCKPRO,P.desprod,t.destab AS MARCA,ML.vencim,ML.codloc,SUM(ML.stock) as stocklote,ML.numlote, ML.codloc, SUM(P.s000 + P.s001 + P.s002 + P.s003 + P.s004 + P.s005 +	P.s006 + P.s007 + P.s008 + P.s009 + P.s010 + P.s011 +	P.s012 + P.s013 + P.s014 + P.s015 + P.s016 + P.s017 + P.s018 + P.s019 + P.s020) AS sttotal from movlote AS ML  INNER JOIN producto AS  P  ON ML.codpro=P.codpro INNER JOIN titultabladet t on P.codmar = t.codtab  where  tiptab = 'M' and destab like '$desc%'  and  P.stopro>0   AND ML.codloc='$local'  GROUP BY P.codpro order by codpro"; 
    
                        }
                        if($doc==3){
                     $sql="SELECT ML.vencim,P.factor,P.stopro,P.codpro,SUM(P.stopro) AS STOCKPRO,P.desprod,t.destab AS MARCA,ML.vencim,ML.codloc,SUM(ML.stock) as stocklote,ML.numlote, ML.codloc, SUM(P.s000 + P.s001 + P.s002 + P.s003 + P.s004 + P.s005 +	P.s006 + P.s007 + P.s008 + P.s009 + P.s010 + P.s011 +	P.s012 + P.s013 + P.s014 + P.s015 + P.s016 + P.s017 + P.s018 + P.s019 + P.s020) AS sttotal from movlote AS ML  INNER JOIN producto AS  P  ON ML.codpro=P.codpro INNER JOIN titultabladet t on P.codmar = t.codtab  where  P.stopro>0  AND ML.codloc='$local'  GROUP BY P.codpro order by codpro "; 
                        }
                                               
                        
                            }

                        }
               
                                       
	$zz = 0;
	$i  = 0;
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	?>
	<table width="926" border="0" align="center">
      <?php while ($row = mysqli_fetch_array($result)){
		$codpro    = $row['codpro'];
		$STOCKPRO    = $row['STOCKPRO'];
		$producto    = $row['desprod'];
		$marca    = $row['MARCA'];
		$venc    = $row['vencim'];
		$codloc    = $row['codloc'];
		$stocklote   = $row['stocklote']; //$stocklote
		$numlote   = $row['numlote'];
		$factor   = $row['factor'];
		$sttotal   = $row['sttotal'];
		$stopro  = $row['stopro'];
                
                $convert1       = $stocklote/$factor; //PRODUCTO
		$convert2       = $stopro/$factor; //MVLOTE
		$div1    	= floor($convert1); //PRODUCTO
		$div2    	= floor($convert2); //MVLOTE
		
		$UNI1 = ($stocklote-($div1*$factor));
		$UNI2 = ($stopro-($div2*$factor));
                
                $sql3="SELECT nomloc,nombre FROM xcompa where codloc = '$codloc'";
				$result3 = mysqli_query($conexion,$sql3); 
				while ($row3 = mysqli_fetch_array($result3)){ 
				$nloc	= $row3["nomloc"];
				$nombre	= $row3["nombre"];
					if ($nombre == ''){
					$sucur = $nloc;}
					else{
					$sucur = $nombre;}}
                
                
			/*if ($sumpcosto > 0){
			$rentabilidad   = $sumpripro - $sumpcosto;
			$rentabilidad1[$zz] = $rentabilidad1[$zz] + $rentabilidad;}*/
		  if (($suc[$zz-1] <> "") and ($suc[$zz-1] <> $suc[$zz])){
		  if ($sucursal <> $ssss[$i-1]){
		  ?>
			
		  <?php }}?>
               	<tr>
                <td width="<?php if ($doc == 1){?>134<?php }elseif ($doc == 2){?>134<?php }elseif ($doc == 3){?>150<?php }else{?>0<?php }?>"><?php if ($doc == 2){echo $sucur;}elseif ($doc == 1){echo $sucur;}elseif ( $doc == 3){echo $sucur;}?></td>
                <td width="134"><?php if ($doc == 2){echo $codpro;}elseif ($doc == 1){echo $codpro;}elseif ( $doc == 3){echo $codpro;}?></td>
                <td  width="<?php if ($doc == 1){?>134<?php }elseif ( $doc == 3){?>220<?php }else{?>0<?php }?>"><div align="LEFT"><?php if ($doc == 1){echo $producto;}elseif ( $doc == 3){echo $producto;}?></div></td>
                <td  width="<?php if ($doc == 2){?>134<?php }elseif ( $doc == 3){?>220<?php }else{?>0<?php }?>"><div align="LEFT"><?php if ($doc == 2){echo $marca;}elseif ( $doc == 3){echo $marca;}?></div></td>
                <td width="134" align="CENTER"> <?php if ($doc == 2){echo $div2."C" ." ". $UNI2." "."unid";}elseif ($doc == 1){echo $div2."C" ." ". $UNI2." "."unid";}elseif ( $doc == 3){echo $div2."C" ." ". $UNI2." "."unid";} ?></td>
                <td width="134" align="CENTER"> <?php if ($doc == 2){echo $div1."C" ." ". $UNI1." "."unid";}elseif ($doc == 1){echo $div1."C" ." ". $UNI1." "."unid";}?></td>
                <td width="<?php if ($doc == 1){?>134<?php }elseif ( $doc == 2){?>134<?php }else{?>0<?php }?>" align="left"><?php if ($doc == 2){echo $numlote;}elseif ($doc == 1){echo $numlote;}?></td>
                <td width="<?php if ($doc == 1){?>134<?php }elseif ( $doc == 2){?>134<?php }else{?>0<?php }?>" align="left"><?php if ($doc == 2){echo $venc;}elseif ($doc == 1){echo $venc;}?></td>
<!--                <td width="134"><?php // echo $factor ;?></td>-->
<!--                <td width="134"><?php // echo $convert2 ;?></td>-->
<!--                <td width="134"><?php // echo $convert1 ;?></td>-->
                <!--<td width="134"><?php // echo $venc;?></td>-->
                
                
                
		
      </tr>
                        
                        
                        
                  <?php }?>
    </table>
			  <?php }else{?>
	<center>No se logro encontrar informacion con los datos ingresados</center>
	<?php }?>
	</td>
  </tr>
  
  
  
  
</table>
<?php }}?>

<?php if (($ck == 1) || ($ck1 == 1))
    {
    
if (($val == 1) || ($vals == 2)){?>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
        <table width="926" border="0" align="center">
            <tr>
                <?php if ($ckloc == 1){?><td width="30"><strong>LOCAL</strong></td><?php }?>
                 <td width="50"><div align="center"><strong>FECHA </strong></div></td>
                <td width="40"><div align="center"><strong>N&ordm; C. INTER </strong></div></td>
                <td width="55"><div align="right"><strong>N&ordm; FISICO </strong></div></td>
                <td width="90"><div align="center"><strong>CLIENTE </strong></div></td>
                <td width="40"><div align="center"><strong>DNI </strong></div></td>
                <?php if ($doc == 2){?><td align="center" width="<?php if ($doc == 2){?>40<?php } else {?>282<?php }?>"><strong>RUC</strong></td><?php }?>
            
 <td width="35">&nbsp;</td>
                <td width="25"><div align="center"><strong>AFECTO</strong></div></td>
                <td width="25"><div align="center"><strong>INAFECTO</strong></div></td>
                <td width="25"><div align="right"><strong>IGV</strong></div></td>
                <td width="30"><div align="right"><strong>TOTAL</strong></div></td>
            </tr>
        </table>
    </td>
  </tr>
</table>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
        
        
	<?php if ($val == 1){
		if ($local == 'all'){
                   if($doc==1)
                            {

                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$desc' and '$desc1'   and estado = '0' AND  V.nrofactura like'B%' order by V.nrovent ";
                            }
                        if($doc==2)//factura
                            { 
                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$desc' and '$desc1'   and estado = '0' AND  V.nrofactura like'F%' order by V.nrovent ";
                            }
                        if($doc==3)
                            {
                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$desc' and '$desc1'  and estado = '0' AND  V.nrofactura like'T%' order by V.nrovent ";
                            }
                        if($doc==0)
                            {
                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$desc' and '$desc1'  and estado = '0' order by V.nrovent";
                            }
                        }
		else{
                        if($doc==1){
                        $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$desc' and '$desc1' and 	V.sucursal = '$local' and estado = '0' AND  V.nrofactura like'B%' order by V.nrovent";  
                        }
                        if($doc==2){
                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$desc' and '$desc1' and 	V.sucursal = '$local' and estado = '0' AND  V.nrofactura like'F%' order by V.nrovent";
                        }
                        if($doc==3){
                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$desc' and '$desc1' and 	V.sucursal = '$local' and V.invtot <> '0' and V.gravado<>'0' and estado = '0' AND  V.nrofactura like'T%' order by V.nrovent ";
                        }
                        if($doc==0){
                            $sql=" SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$desc' and '$desc1' and 	V.sucursal = '$local' and V.invtot <> '0' and V.gravado<>'0' and estado = '0' order by V.nrovent";}}
                       }
                
                
                if ($vals == 2){
                   if ($local == 'all'){
                        if($doc==1)
                            {
                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$date1' and '$date2'  and estado = '0' AND  V.nrofactura like'B%' order by V.nrovent";
                            }
                        if($doc==2)//factura
                            { 
                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$date1' and '$date2'  and estado = '0' AND  V.nrofactura like'F%' order by V.nrovent";
                            }
                        if($doc==3)
                            {
                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$date1' and '$date2'  and estado = '0' AND  V.nrofactura like'T%' order by V.nrovent";
                            }
                        if($doc==0)
                            {
                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$date1' and '$date2' and estado = '0' order by V.nrovent ";
                            }
                        }
		else{
                        if($doc==1){
                        $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto ,C.descli,C.dnicli,C.ruccli FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between  '$date1' and '$date2' and V.sucursal = '$local' and estado = '0' AND  V.nrofactura like'B%' order by V.nrovent ";  
                        }
                        if($doc==2){
                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between  '$date1' and '$date2' and V.sucursal = '$local'  and estado = '0' AND  V.nrofactura like'F%' order by V.nrovent";
                        }
                        if($doc==3){
                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between  '$date1' and '$date2' and V.sucursal = '$local' and estado = '0' AND  V.nrofactura like'T%' order by V.nrovent";
                        }
                        if($doc==0){
                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between  '$date1' and '$date2' and V.sucursal = '$local'  and estado = '0' order by V.nrovent";}}

                        }
               
                                       
	$zz = 0;
	$i  = 0;
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	?>
	<table width="926" border="0" align="center">
      <?php while ($row = mysqli_fetch_array($result)){
		$invnum    = $row['invnum'];
		$usecod    = $row['usecod'];
		$nrovent   = $row['nrovent'];
//		$forpag    = $row["forpag"];
		$val_habil = $row["val_habil"];
		$total     = $row["invtot"];
		$sucursal  = $row["sucursal"];
		$nrofactura  = $row["nrofactura"];
//		$hora	   = $row["hora"];
		$descli	   = $row['descli'];
		$ruccli	   = $row['ruccli'];
		$dnicli	   = $row['dnicli'];
		$gravado   = $row["gravado"];
                if($val_habil=='0'){
		$gravado2   += $row["gravado"];
                }
		$invtot	   = $row["invtot"];
                 if($val_habil=='0'){
		$invtotA	   += $row["invtot"];
                 }
		$igv22	   = $row["igv"];
		$inafecto5	   = $row["inafecto"];
                
                if($val_habil=='0'){
		$inafecto51	   += $row["inafecto"];
                }
		
                
                 if($val_habil=='0'){
                  $igv21	   += $row["igv"];
                 }
		$i++;
		$ssss[$i]  = $sucursal;
		if ($sucursal <> $suc[$zz]){
		$zz++;
		$suc[$zz] = $sucursal;}
		$sql3="SELECT nomloc,nombre FROM xcompa where codloc = '$sucursal'";
				$result3 = mysqli_query($conexion,$sql3); 
				while ($row3 = mysqli_fetch_array($result3)){ 
				$nloc	= $row3["nomloc"];
				$nombre	= $row3["nombre"];
					if ($nombre == ''){
					$sucur = $nloc;}
					else{
					$sucur = $nombre;}}
		$e_tot = 0;
		$t_tot = 0;
		$c_tot = 0;
//		$inafecto = 0;
		$deshabil_tot = 0;
                $deshabil_gravado=0;
                $habil_inafecto11=0;
		$habil_tot = 0;
		$count = 0;
		$tot	   = 0;
                $Rentabilidad = 0;
		$sumpripro = 0;
		$sumpcosto = 0;
		$porcentaje= 0;
		$sql1="SELECT nomusu FROM usuario where usecod = '$usecod'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
			$user    = $row1['nomusu'];}}
                        
			if ($val_habil == 0){
				if ($forpag == "E"){
				$e_tot = $total;
				$e_tot1[$zz] = $e_tot1[$zz] + $total;}
				if ($forpag == "T"){
				$t_tot = $total;
				$t_tot1[$zz] = $t_tot1[$zz] + $total;}
				if ($forpag == "C"){
				$c_tot = $total;
				$c_tot1[$zz] = $c_tot1[$zz] + $total;}
				$sql2="SELECT costpr,pripro,canpro,fraccion,factor,invfec,prisal,costpr FROM detalle_venta where invnum = '$invnum'";
				$result2 = mysqli_query($conexion,$sql2);
				if (mysqli_num_rows($result2)){
				while ($row2 = mysqli_fetch_array($result2)){
					$pcostouni    = $row2["cospro"]; //costo del producto x caja
                                        $pripro       = $row2['pripro']; //subtotal de venta precio unitario x cantidad vendida
                                        $canpro       = $row2['canpro'];
                                        $fraccion     = $row2['fraccion'];
                                        $factor       = $row2['factor'];
                                        $prisal       = $row2['prisal']; //precio de venta x unidad
                                        $costpr       = $row2['costpr']; //costo del producto x unidad
                                        $invfec       = $row2['invfec'];
                                        
                                        //FRACCIONADO
                                        if ($fraccion == "T")
                                        {
                                            $RentPorcent  = (($prisal-$costpr) * $canpro);
                                            $Rentabilidad = $Rentabilidad                               +$RentPorcent;
                                            //$precio_costo = $pcostouni;
                                        }
                                        else
                                        {
                                            //NO FRACCIONADO
                                            //$precio_costo = $pcostouni/$factor;
                                            //$canpros   = $canpro * $factor;
                                            //$tot	   = $tot + $canpros;
                                            $RentPorcent  = (($prisal-$pcostouni) * $canpro);
                                            $Rentabilidad = $Rentabilidad 
                                            + $RentPorcent;
                                        }
                                    
                                    
                                        /*$pcostouni    = $row2["cospro"];
					$pripro       = $row2['pripro'];
					$canpro    	  = $row2['canpro'];
					$fraccion     = $row2['fraccion'];
					$factor       = $row2['factor'];
					$invfec       = $row2['invfec'];
					$tot   	      = 0;
					$precio_costo = $costpr;
					if ($fraccion == "T"){
					$tot	   = $tot + $canpro;}
					else{
					//$precio_costo = $pcostouni/$factor;
					$canpros   = $canpro * $factor;
					$tot	   = $tot + $canpros;}
					$sumpripro = $sumpripro + $pripro;
					$pcosto    = $tot * $precio_costo;
					$sumpcosto = $sumpcosto + $pcosto;*/
                                        
                                        }}}
			if ($val_habil == 1)
                                {
				$deshabil++;
				$deshabil_tot = $deshabil_tot + $total;
				$deshabil_tot1[$zz] = $deshabil_tot1[$zz] + $total;
                                }
				else
                                {
				$habil_tot = $habil_tot + $total;
				$habil_tot1[$zz] = $habil_tot1[$zz] + $total;
                                }
				$count++;    
			if ($total == 1)
                                {
				$deshabil++;
				$deshabil_total = $deshabil_total + $total;
				$deshabil_total1[$zz] = $deshabil_total1[$zz] + $total;
                                }
				else
                                {
				$habil_total = $habil_total + $total;
				$habil_total1[$zz] = $habil_total1[$zz] + $total;
                                }
				$count++; 
			if ($gravado == 1)
                                {
				$deshabil++;
				$deshabil_gravado = $deshabil_gravado + $gravado;
				$deshabil_gravado1[$zz] = $deshabil_gravado1[$zz] + $gravado;
                                }
				else
                                {
				$habil_gravado = $habil_gravado + $gravado;
				$habil_gravado1[$zz] = $habil_gravado1[$zz] + $gravado;
                                }
				$count++; 
                                
//			if ($igv == 1)
//                                {
//				$deshabil++;
//				$deshabil_igv = $deshabil_igv + $igv;
//				$deshabil_igv1[$zz] = $deshabil_igv1[$zz] + $igv;
//                                }
//				else
//                                {
//				$habil_igv = $habil_igv + $igv;
//				$habil_igv1[$zz] = $habil_igv1[$zz] + $igv;
//                                }
//				$count++; 
                        
			if ($inafecto5 == 1)
                                {
				$deshabil++;
				$deshabil_inafecto = $deshabil_inafecto + $inafecto5;
				$deshabil_inafecto1[$zz] = $deshabil_inafecto1[$zz] + $inafecto5;
                                }
				else
                                {
				$habil_inafecto = $habil_inafecto + $inafecto5;
				$habil_inafecto12[$zz] = $habil_inafecto12[$zz] + $inafecto5;
                                }
				$count++; 
			if ($invtot == 1)
                                {
				$deshabil++;
				$deshabil_invtot = $deshabil_invtot + $invtot;
				$deshabil_invtot1[$zz] = $deshabil_invtot1[$zz] + $invtot;
                                }
				else
                                {
				$habil_invtot = $habil_invtot + $invtot;
				$habil_invtot12[$zz] = $habil_invtot12[$zz] + $invtot;
                                }
				$count++; 
                        
                        $rentabilidad       = $Rentabilidad;
			$rentabilidad1[$zz] = $rentabilidad1[$zz] + $Rentabilidad;
                        
                        
                 
			/*if ($sumpcosto > 0){
			$rentabilidad   = $sumpripro - $sumpcosto;
			$rentabilidad1[$zz] = $rentabilidad1[$zz] + $rentabilidad;}*/
		  if (($suc[$zz-1] <> "") and ($suc[$zz-1] <> $suc[$zz])){
		  if ($sucursal <> $ssss[$i-1]){
		  ?>
			<tr bgcolor="#CCCCCC">
			    <?php if ($ckloc == 1){?><td width="80"><?php ?></td><?php }?>
				<td width="<?php if ($ckloc == 1){?>35<?php } else {?>282<?php }?>" bgcolor="#CCCCCC"></td>
				<td width="90"><div align="right"></div></td>
				<td width="50"><div align="right"></div></td>
				<td width="30"><div align="right"></div></td>
				
                             <td width="54">&nbsp;</td>
                                <td width="54">&nbsp;</td>
				<td width="20"><div align="right"><strong>TOTAL</strong></div></td>
				<td width="64"><div align="right"><?php echo $numero_formato_frances = number_format($e_tot1[$zz-1], 2, '.', ' ');?></div></td>
				<td width="68"><div align="right"><?php echo $numero_formato_frances = number_format($c_tot1[$zz-1], 2, '.', ' ');?></div></td>
				<td width="80"><div align="right"><?php echo $numero_formato_frances = number_format($t_tot1[$zz-1], 2, '.', ' ');?></div></td>
				<td width="68"><div align="right"><?php echo $numero_formato_frances = number_format($deshabil_tot1[$zz-1], 2, '.', ' ');?></div></td>
                               
                        </tr>
		  <?php }}?>
                        <tr>
                            <?php if ($ckloc == 1){?><td width="15"><?php echo $sucur?></td><?php }?>
                            <td width="40"><div align="LEFT"><?php echo fecha($invfec)?></div></td>
                            <td width="40"><div align="LEFT"><?php echo $invnum?></div></td>
                            <td width="40"><div align="right"><?php echo $nrofactura?></div></td>                      
                            <td width="90"><div align="CENTER"><?php echo $descli?></div></td>
                            <td width="35"><div align="CENTER"><?php echo $dnicli?></div></td>
                            <?php if ($doc == 2){?>
                            <td align="CENTER" width="<?php if ($doc == 2){?>40<?php } else {?>350<?php }?>">
                                <?php echo $ruccli?>
                            </td>
                                <?php }?>
                          
                            <td width="45">
                            <div align="center">
                                <?php   if($val_habil==1){
                             $reso="ANULADO";
                             echo "<p class='Estilo1'>$reso</p>";
                            }else{
                             $reso=" ";
                             echo "<strong>$reso</strong>";
                            }?>
                            </div>
                            </td>
                            
                            <td width="35">
                            <div align="center">
                                <?php   if($val_habil==1){
                             $reso="";
                             echo $reso;
                            }else{
                              echo $gravado;
                            }?>
                            </div>
                            </td>
                            
                            <td width="50">
                            <div align="center">
                                <?php   if($val_habil==1){
                             $reso="";
                             echo $reso;
                            }else{
                              echo $inafecto5;
                            }?>
                            </div>
                            </td>
                            
                            <td width="35">
                            <div align="right">
                                <?php   if($val_habil==1){
                             $reso="";
                             echo $reso;
                            }else{
                              echo $igv22;
                            }?>
                            </div>
                            </td>
                            
                            <td width="35">
                            <div align="right">
                                <?php   if($val_habil==1){
                             $reso="";
                             echo $reso;
                            }else{
                              echo $invtot;
                            }?>
                            </div>
                            </td>
                            
                            
                            
                        </tr>
                  <?php }?>
    </table>
	<?php if ($zz == 1){
		?>
		  <table width="926" border="0" align="center">
			  <tr bgcolor="#CCCCCC">
				<td width="350"><div align="right"><strong>TOTAL</strong></div></td>
                                <td width="75"><div align="center">&nbsp;</div></td>
				<td width="64"><div align="center"><?php echo $numero_formato_frances = number_format($gravado2, 2, '.', ' ');?></div></td>
				<td width="64"><div align="center"><?php echo $numero_formato_frances = number_format($inafecto51, 2, '.', ' ');?></div></td>
                                <td width="64"><div align="right"><?php echo $numero_formato_frances = number_format($igv21, 2, '.', ' ');?></div></td>			
                                <td width="58"><div align="right"><?php echo $numero_formato_frances = number_format($invtotA, 2, '.', ' ');?></div></td>
                                
			  </tr>
	  </table>
		<?php }else{?>
		  <table width="926" border="0" align="center">
            <tr bgcolor="#CCCCCC">
              <td width="497"><div align="right"><strong>TOTAL</strong></div></td>
              <td width="64"><div align="right"><?php echo $numero_formato_frances = number_format($e_tot1[$zz], 2, '.', ' ');?></div></td>
              <td width="68"><div align="right"><?php echo $numero_formato_frances = number_format($c_tot1[$zz], 2, '.', ' ');?></div></td>
              <td width="80"><div align="right"><?php echo $numero_formato_frances = number_format($t_tot1[$zz], 2, '.', ' ');?></div></td>
              <td width="54">&nbsp;</td>
              <td width="68"><div align="right"><?php echo $numero_formato_frances = number_format($deshabil_tot1[$zz], 2, '.', ' ');?></div></td>
              <td width="61"><div align="right"><?php echo $numero_formato_frances = number_format($habil_tot1[$zz], 2, '.', ' ');?></div></td>
              <td width="70"><div align="right"><?php echo $numero_formato_frances = number_format($rentabilidad1[$zz], 2, '.', ' '); ?></div></td>
            </tr>
          </table>
		  <?php }}else{?>
	<center>No se logro encontrar informacion con los datos ingresados</center>
	<?php }?>
	</td>
  </tr>
  
  <!--A-->
  
  
</table>
<?php }                 }       }   ?>



</body>
</html>
