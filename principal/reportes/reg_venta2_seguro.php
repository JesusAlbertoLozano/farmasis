<link href="css/style1.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.Estilo1 {
	color: #FF0000;
	font-weight: bold;
}
</style>
<?php
if($doc2 == 1){
    $va = "STANDARD";
}
if($doc2 == 2){
    $va = "WCONT";
}
if($doc2 == 3){
    $va = "SISCONT";
}
if($doc2 == 4){
    $va = "CONCART";
}
?>
<?php
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
if ($local <> 'all'){
	$sql="SELECT nomloc,nombre FROM xcompa where codloc = '$local'";
	$result = mysqli_query($conexion,$sql); 
	while ($row = mysqli_fetch_array($result)){ 
	$nloc	= $row['nomloc'];
	$nombre	= $row['nombre'];
		if ($nombre == ''){
		$locals = $nloc;}
		else{
		$locals = $nombre;}
	}}
$dat1 = $date1;
$dat2 = $date2;
$date1 = fecha1($dat1);
$date2 = fecha1($dat2);
?>
<table width="930" border="0" align="center">
  <tr>
    <td>
     <table width="914" border="0">
      <tr>
        <td width="260"><strong><?php echo $desemp?> </strong></td>
        <td width="380">
            <div align="center">
                <strong>REPORTE DE REGISTRO DE VENTA - 
                    <?php if ($local == 'all'){ echo 'TODAS LAS SUCURSALES';} else { echo $locals;}?>
                </strong>
            </div>
        </td>
        <td width="260"><div align="right"><strong>FECHA: <?php echo date('d/m/Y');?> - HORA : <?php echo $hour;?>:<?php echo $min;?> <?php echo $hor?></strong></div></td>
      </tr>

    </table>
      <table width="914" border="0">
        <tr>
          <td width="134"><strong>PAGINA <?php echo $pagina;?> de <?php echo $tot_pag?></strong></td>
          <td width="633"><div align="center"><b><?php if ($val == 1){?>NRO DE VENTA ENTRE EL <?php echo $desc; ?> Y EL <?php echo $desc1; } if ($vals == 2){?> FECHAS ENTRE EL <?php echo $dat1; ?> Y EL <?php echo $dat2; }?></b></div></td>
          <td width="133"><div align="right">USUARIO:<span class="text_combo_select"><?php echo $user?></span></div></td>
        </tr>
      </table>
      <div align="center"><img src="../../images/line2.png" width="910" height="4" /></div></td>
  </tr>
</table>
<?php 
if ($ckprod == 1)
{
?>

<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
    	<table width="926" border="0" align="center">
      		<tr>
            <td width="57"><div align="left"><strong>TIENDA   </strong></div></td>
            <td width="74"><div align="left"><strong>RESPONSABLE  </strong></div></td>
            <td width="24"><div align="left"><strong>NUMERO</strong></div></td>
            <td width="24"><div align="left"><strong>NUM FISICO</strong></div></td>
            <td width="50"><div align="left"><strong>FECHA</strong></div></td>
            <td width="54"><div align="left"><strong>CLIENTE</strong></div></td>
            <td width="308"><div align="left"><strong>PRODUCTO</strong></div></td>
            <td width="61"><div align="left"><strong>MARCA</strong></div></td>
            <td width="60"><div align="right"><strong>PRECIO VTA.</strong></div></td>
      		<td width="60"><div align="right"><strong>PRECIO LTA.</strong></div></td>
            <td width="60"><div align="right"><strong>DIFERENCIA</strong></div></td>
            <td width="60"><div align="right"><strong>PRECIO LTA.</strong></div></td>
            <td width="60"><div align="right"><strong>DIFERENCIA</strong></div></td>
            </tr>
      	</table>
        <table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
            <tr>
               <td>
               <?php 
				$zz = 0;
				if ($val == 1){ ///	PRIMER BOTON
					if ($local == 'all')////TODOS LOS LOCALES
					{ 
					$sql="SELECT detalle_venta.usecod,costpr,sucursal,nrovent,detalle_venta.invfec,detalle_venta.cuscod,codpro,codmar,prisal,factor,canpro,fraccion,costpr,nrofactura FROM venta inner join detalle_venta on venta.invnum = detalle_venta.invnum where nrovent between '$desc' and '$desc1' and estado = '0' and invtot <> '0' and estado2 <> '1'  order by nrovent group by = nrovent";
					}
					else ///UN SOLO LOCAL
					{
					$sql="SELECT detalle_venta.usecod,costpr,sucursal,nrovent,detalle_venta.invfec,detalle_venta.cuscod,codpro,codmar,prisal,factor,canpro,fraccion,costpr,nrofactura FROM venta inner join detalle_venta on venta.invnum = detalle_venta.invnum where nrovent between '$desc' and '$desc1' and estado = '0' and invtot <> '0' and estado2 <> '1'  and sucursal = '$local' order by nrovent";
					}
				}
				else///	SEGUNDO BOTON
				{
					if ($local == 'all')////TODOS LOS LOCALES
					{ 
						//echo $date1; echo "<br>";
						//echo $date2;
						$sql="SELECT detalle_venta.usecod,costpr,sucursal,nrovent,detalle_venta.invfec,detalle_venta.cuscod,codpro,codmar,prisal,factor,canpro,fraccion,costpr,nrofactura FROM venta inner join detalle_venta  on venta.invnum = detalle_venta.invnum where detalle_venta.invfec between '$date1' and '$date2' and invtot <> '0' and estado2 <> '1'  and estado = '0' order by nrovent";
					}
					else ///UN SOLO LOCAL
					{
						$sql="SELECT detalle_venta.usecod,costpr,sucursal,nrovent,detalle_venta.invfec,detalle_venta.cuscod,codpro,codmar,prisal,factor,canpro,fraccion,costpr,nrofactura FROM venta inner join detalle_venta on venta.invnum = detalle_venta.invnum where detalle_venta.invfec between '$date1' and '$date2' and sucursal = '$local' and invtot <> '0' and estado2 <> '1' and estado = '0' order by nrovent";
					}
				}
				$result = mysqli_query($conexion,$sql);
				if (mysqli_num_rows($result)){
				?>
                <table width="926" border="0" align="center">
                    <?php 
					while ($row = mysqli_fetch_array($result)){
						$usecod    = $row['usecod'];
						$sucursal  = $row['sucursal'];
						$nrovent   = $row['nrovent'];
						$nrofactura   = $row['nrofactura'];
						$invfec    = fecha($row['invfec']);
						$cuscod    = $row['cuscod'];
						$codpro    = $row['codpro'];
						$codmar    = $row['codmar'];
						$prisal    = $row['prisal'];
						$factor    = $row['factor'];////
						$canpro    = $row['canpro'];////
						$cospro    = $row['costpr'];////
						$fraccion  = $row['fraccion'];/////
                                                $costpr    = $row['costpr']; //costo del producto x unidad
                                                
                                                if ($fraccion == "T")
                                                {
                                                    $cospro = $costpr;
						}
						else
                                                {
                                                    $cospro = $costpr;
                                                }
                                                
						$plista	   = 0;
						$dif = 0;
                                                //USUARIO
                                                $sql1="SELECT nomusu FROM usuario where usecod = '$usecod'";
						$result1 = mysqli_query($conexion,$sql1);
						if (mysqli_num_rows($result1)){
						while ($row1 = mysqli_fetch_array($result1)){
						$nomusu    = $row1['nomusu'];
                                                }
                                                }
                                                //CLIENTE
                                                $sql1="SELECT descli FROM cliente where codcli = '$cuscod'";
						$result1 = mysqli_query($conexion,$sql1);
						if (mysqli_num_rows($result1)){
						while ($row1 = mysqli_fetch_array($result1)){
						$descli     = $row1['descli'];
                                                }
                                                }
						$sql1="SELECT desprod,destab,pdistribuidor,abrev FROM producto inner join titultabladet on codmar = codtab where codpro = '$codpro'";
						$result1 = mysqli_query($conexion,$sql1);
						if (mysqli_num_rows($result1)){
						while ($row1 = mysqli_fetch_array($result1)){
						$desprod    = $row1['desprod'];
						$destab     = $row1['destab'];
						$abrev      = $row1['abrev'];
						if ($abrev <> '')
						{
						$destab = $abrev;
						}
						$pdistribuidor     = $row1['pdistribuidor'];
						}}
						$sql3="SELECT nomloc,nombre FROM xcompa where codloc = '$sucursal'";
						$result3 = mysqli_query($conexion,$sql3); 
						if (mysqli_num_rows($result3)){
						while ($row3 = mysqli_fetch_array($result3)){ 
						$nloc	= $row3["nomloc"];
						$nombre	= $row3["nombre"];}}
						$plista	   = $prisal - $costpr;
						$dif 	   = $prisal - $costpr;
						if ($nombre == "")
						{
						$nombre = $nloc;
						}
						if ($prisal < $costpr){
						$color = "#ffffff";
						}
						else
						{
							if ($prisal < $costpr){ 
							$color ="#ffffff";	
							}
							else
							{
							$color ="";	
							}
						}
						
					?>
                    <tr <?php if ($prisal < $costpr){?>bgcolor="#FF0000"<?php } else { if ($prisal < $costpr){ ?> bgcolor="#006600"<?php }}?>>
                        <td width="57"><div align="left"><font color="<?php echo $color?>"><?php echo $nombre;?></font>   </div></td>
						<td width="74"><div align="left"><font color="<?php echo $color?>"><?php echo $nomusu;?></font></div></td>
						<td width="24"><div align="left"><font color="<?php echo $color?>"><?php echo $nrovent?></font></div></td>
                                                 <td width="24"><div align="left"><font color="<?php echo $color?>"><?php echo $nrofactura?></font></div></td>
						<td width="50"><div align="left"><font color="<?php echo $color?>"><?php echo $invfec;?></font></div></td>
						<td width="54"><div align="left"><font color="<?php echo $color?>"><?php echo $descli;?></font></div></td>
						<td width="308"><div align="left"><font color="<?php echo $color?>"><?php echo $desprod?></font></div></td>
						<td width="61"><div align="left"><font color="<?php echo $color?>"><?php echo $destab?></font></div></td>
						<td width="60"><div align="right"><font color="<?php echo $color?>"><?php echo $numero_formato_frances = number_format($prisal, 2, '.', ' ');?></font></div></td>
						<td width="60"><div align="right"><font color="<?php echo $color?>"><?php echo $numero_formato_frances = number_format($cospro, 2, '.', ' ');?></font></div></td>
						<td width="60"><div align="right"><font color="<?php echo $color?>"><?php echo $numero_formato_frances = number_format($plista, 2, '.', ' ');?></font></div></td>
						<td width="60"><div align="right"><font color="<?php echo $color?>"><?php echo $numero_formato_frances = number_format($pdistribuidor, 2, '.', ' ');?></font></div></td>
						<td width="60"><div align="right"><font color="<?php echo $color?>"><?php echo $numero_formato_frances = number_format($dif, 2, '.', ' ');?></font></div></td>
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
if (($ck == '') && ($ck1 == '')&& ($doc2 == 0)){
if (($val == 1) || ($vals == 2) )
{
?>
<table width="555" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
        <table width="926" border="0" align="center">
            <TR>
            <center> <h2>RESUMEN POR DIA</h2></center>
           
        
        </TR>
    </table></td>
  </tr>
</table>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
        <table width="926" border="0" align="center">
      <tr>
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
      </tr>
    </table></td>
  </tr>
</table>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
        
        
	<?php if ($val == 1){
		if ($local == 'all'){
                  if($doc==1){
                        $sql="SELECT invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invfec between '$desc' and '$desc1'    and nrofactura LIKE'B%' and estado2 <> '1' and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
         CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
         CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
 ";  
                        }
                        if($doc==2){
                            $sql="SELECT invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invfec between '$desc' and '$desc1'    and nrofactura LIKE'F%' and estado2 <> '1' and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
         CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
         CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
 ";
                        }
                        if($doc==3){
                            $sql="SELECT invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invfec between '$desc' and '$desc1'   and nrofactura LIKE'T%' and estado2 <> '1' and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
         CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
         CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
 ";
                        }
                        if($doc==0){
                            $sql="no se puede ";
                            
                            }
                        }
		else{
                         if($doc==1){
                        $sql="SELECT invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invfec between '$desc' and '$desc1'  and sucursal = '$local'  and estado2 <> '1' and nrofactura LIKE'B%' and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
         CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
         CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
 ";  
                        }
                        if($doc==2){
                            $sql="SELECT invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invfec between '$desc' and '$desc1'  and sucursal = '$local'    and estado2 <> '1' and nrofactura LIKE'F%' and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
         CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
         CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
 ";
                        }
                        if($doc==3){
                            $sql="SELECT invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invfec between '$desc' and '$desc1'  and sucursal = '$local' and estado2 <> '1' and nrofactura LIKE'T%' and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
         CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
         CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
 ";
                        }
                       
                            
                            }

                       }
                
                
                if ($vals == 2){
                   if ($local == 'all'){
                  if($doc==1){
                        $sql="SELECT invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invfec between '$date1' and '$date2'    and nrofactura LIKE'B%' and estado2 <> '1' and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
         CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
         CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
 ";  
                        }
                        if($doc==2){
                            $sql="SELECT invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invfec between '$date1' and '$date2'    and nrofactura LIKE'F%' and estado2 <> '1' and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
         CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
         CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
 ";
                        }
                        if($doc==3){
                            $sql="SELECT invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invfec between '$date1' and '$date2'   and nrofactura LIKE'T%' and estado2 <> '1' and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
         CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
         CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
 ";
                        }
                       
                        }
		else{
                         if($doc==1){
                        $sql="SELECT invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),SUM(invtot),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invfec between '$date1' and '$date2'  and sucursal = '$local'  and nrofactura LIKE'B%' and estado2 <> '1'  and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
         CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
         CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
 ";  
                        }
                        if($doc==2){
                            $sql="SELECT invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invfec between '$date1' and '$date2'  and sucursal = '$local'    and nrofactura LIKE'F%' and estado2 <> '1' and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
         CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
         CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
 ";
                        }
                        if($doc==3){
                            $sql="SELECT invfec,usecod,MIN(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED))as min,MAX(CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED)) as max,SUM(igv),SUM(gravado),SUM(igv+gravado),sucursal,SUM(inafecto),SUM(invtot) FROM venta WHERE  invfec between '$date1' and '$date2'  and sucursal = '$local' and nrofactura LIKE'T%' and estado2 <> '1' and val_habil = 0 GROUP BY invfec  ORDER BY LEFT(nrofactura,1),
         CAST((SUBSTRING_INDEX(nrofactura, '-', 1)) AS UNSIGNED),
         CAST((SUBSTRING_INDEX(nrofactura, '-', -1)) AS UNSIGNED);
 ";
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
		$invnum    = $row['invnum'];
		$usecod    = $row['usecod'];
		$nrovent   = $row['nrovent'];
		$val_habil = $row["val_habil"];
		$sucursal  = $row["sucursal"];
		$nrofactura  = $row["nrofactura"];
		$descli	   = $row['descli'];
		$ruccli	   = $row['ruccli'];
		$dnicli	   = $row['dnicli'];
		$gravado   = $row["gravado"];
		$invtot	   = $row["SUM(invtot)"];
                
		$invfec	   = $row['invfec'];
		$nrofactura1	   = $row["min"];
		$nrofactura2	   = $row["max"];
		$igv	   = $row["SUM(igv)"];
		$gravado	   = $row["SUM(gravado)"];
		$inafecto12	   = $row["SUM(inafecto)"];
		$TOT	   = $row["SUM(igv+gravado)"];
	
                $igv1	   += $row["SUM(igv)"];
		$gravado1	   += $row["SUM(gravado)"];
		$inafecto1	   += $row["SUM(inafecto)"];
		$TOT1	   += $row["SUM(invtot)"];
		
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
		$inafecto = 0;
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
                        
                        
        $sql2="SELECT nrofactura FROM venta WHERE sucursal='$local'  and nrofactura LIKE 'F%' ORDER BY nrofactura LIMIT 1";
		$result1 = mysqli_query($conexion,$sql2);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
		$F1    = $row1['nrofactura'];}}
        $F2 =  substr($F1,0,-1);
		
        $sql2="SELECT nrofactura FROM venta WHERE sucursal='$local'  and nrofactura LIKE 'B%' ORDER BY nrofactura LIMIT 1";
		$result1 = mysqli_query($conexion,$sql2);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
		$B1    = $row1['nrofactura'];}}
        $B2 =  substr($B1,0,-1);
                
                $sql3="SELECT seriebol,seriefac,serietic FROM xcompa where codloc = '$local'";
				$result3 = mysqli_query($conexion,$sql3); 
				while ($row3 = mysqli_fetch_array($result3)){ 
				$seriebol	= $row3["seriebol"];
				$seriefac	= $row3["seriefac"];
				$serietic	= $row3["serietic"];
				
				    $seriebol = 'B'.$seriebol.'-';
				    $seriefac = 'F'.$seriefac.'-';
				    $serietic = 'T'.$serietic.'-';
				}
                
        $sql2="SELECT nrofactura FROM venta WHERE sucursal='$local'  and nrofactura LIKE 'T%' ORDER BY nrofactura LIMIT 1";
		$result1 = mysqli_query($conexion,$sql2);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
			$T1    = $row1['nrofactura'];}}
                        $T2 =  substr($T1,0,-1);
                        
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
                                
			if ($igv == 1)
                                {
				$deshabil++;
				$deshabil_igv = $deshabil_igv + $igv;
				$deshabil_igv1[$zz] = $deshabil_igv1[$zz] + $igv;
                                }
				else
                                {
				$habil_igv = $habil_igv + $igv;
				$habil_igv1[$zz] = $habil_igv1[$zz] + $igv;
                                }
				$count++; 
                        
			if ($inafecto == 1)
                                {
				$deshabil++;
				$deshabil_inafecto = $deshabil_inafecto + $inafecto;
				$deshabil_inafecto1[$zz] = $deshabil_inafecto1[$zz] + $inafecto;
                                }
				else
                                {
				$habil_inafecto = $habil_inafecto + $inafecto;
				$habil_inafecto12[$zz] = $habil_inafecto12[$zz] + $inafecto;
                                }
				$count++; 
                        
                        $rentabilidad       = $Rentabilidad;
			$rentabilidad1[$zz] = $rentabilidad1[$zz] + $Rentabilidad;
                        
                        
                 
                        $inafectototal=$invtot-$gravado-$igv;
			/*if ($sumpcosto > 0){
			$rentabilidad   = $sumpripro - $sumpcosto;
			$rentabilidad1[$zz] = $rentabilidad1[$zz] + $rentabilidad;}*/
		  if (($suc[$zz-1] <> "") and ($suc[$zz-1] <> $suc[$zz])){
		  if ($sucursal <> $ssss[$i-1]){
		  ?>
			
		  <?php }}?>
                        <tr>
                             <?php if ($ckloc == 1){?><td width="30"><?php echo $sucur?></td><?php }?>
                            <td width="300"><div align="center"><?php echo fecha($invfec)?></div></td>
                            <?php if($doc==1){?> <td width="175"><div align="CENTER"><?php echo $seriebol.$nrofactura1?></div></td><?php }?>
                            <?php if($doc==2){?> <td width="175"><div align="CENTER"><?php echo $seriefac.$nrofactura1?></div></td><?php }?>
                            <?php if($doc==3){?> <td width="175"><div align="CENTER"><?php echo $serietic.$nrofactura1?></div></td><?php }?>
                            
                            <?php if($doc==1){?> <td width="175"><div align="CENTER"><?php echo $seriebol.$nrofactura2?></div></td><?php }?>
                            <?php if($doc==2){?> <td width="175"><div align="CENTER"><?php echo $seriefac.$nrofactura2?></div></td><?php }?>
                            <?php if($doc==3){?> <td width="175"><div align="CENTER"><?php echo $serietic.$nrofactura2?></div></td><?php }?>              
                            <td width="155"><div align="CENTER"><?php echo $gravado?></div></td>
                            <td width="155"><div align="CENTER"><?php echo $inafecto12?></div></td>
                            <td width="145"><div align="CENTER"><?php echo $igv?></div></td>
                            <td width="145"><div align="CENTER"><?php  echo $invtot?></div></td>
                        </tr>
                  <?php }?>
    </table>
	<?php if ($zz == 1){
		?>
		  <table width="926" border="0" align="center">
			   <tr bgcolor="#CCCCCC">
				<td width="450"><div align="right"><strong>TOTAL</strong></div></td>
				<td width="90"><div align="right"><?php echo $numero_formato_frances = number_format($gravado1, 2, '.', ' ');?></div></td>
				<td width="90"><div align="right"><?php echo $numero_formato_frances = number_format($inafecto1, 2, '.', ' ');?></div></td>
              			<td width="90"><div align="right"><?php echo $numero_formato_frances = number_format($igv1, 2, '.', ' ');?></div></td>
              			<td width="90"><div align="right"><?php echo $numero_formato_frances = number_format($TOT1, 2, '.', ' ');?></div></td>
            		</tr>
                                
			  </tr>
	  </table>
		<?php }else{?>
		  <table width="926" border="0" align="center">
            <tr bgcolor="#CCCCCC">
			 
				<td width="450"><div align="right"><strong>TOTAL</strong></div></td>
				<td width="90"><div align="right"><?php echo $numero_formato_frances = number_format($gravado1, 2, '.', ' ');?></div></td>
                                <td width="90"><div align="right"><?php echo $numero_formato_frances = number_format($habil_inafecto12[$zz], 2, '.', ' ');?></div></td>

              			<td width="90"><div align="right"><?php echo $numero_formato_frances = number_format($igv1, 2, '.', ' ');?></div></td>
              			<td width="90"><div align="right"><?php echo $numero_formato_frances = number_format($TOT1, 2, '.', ' ');?></div></td>
            		</tr>
          </table>
		  <?php }}else{?>
	<center>No se logro encontrar informacion con los datos ingresados</center>
	<?php }?>
	</td>
  </tr>
  
  
  
  
</table>
<?php }}


if (($ck == '') && ($ck1 == '') && ($doc2 == 2)){
if (($val == 1) || ($vals == 2) )
{
?>


<table width="555" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
        <table width="926" border="0" align="center">
            <TR>
            <center> <h2>RESUMEN POR <?php echo $va?></h2></center>
           
        
        </TR>
    </table></td>
  </tr>
</table>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
        <table width="926" border="0" align="center">
      <tr>
        <?php if ($ckloc == 1){?>
		<td width="120"><strong>LOCAL</strong></td>
		<?php }?>
        <td align="center"width="80"><strong>FECHA</strong></td>
        <td align="center"width="50"><strong> TD</strong></td>
        <td align="center"width="50"><strong>SERIE</strong></td>
        <td align="center" width="60"><strong>CORRE</strong></td>
        <td align="center" width="40"><strong>ACT</strong></td>
        <td align="center"width="120"><strong>RUC O DNI </strong></td>
        <td align="center"width="160"><strong>NOM. CLIENTE</strong></td>
        <td align="LEFT"width="70"><strong>COD. PRO</strong></td>
        <td align="center"width="160"><strong>PRODUCTO</strong></td>
        <td align="left"width="70"><strong>IMPUESTO</strong></td>
        <td align="left"width="75"><strong>VALOR DE VENTA </strong></td>
        <td align="right"width="46"><strong>SIN IGV </strong></td>
        <td align="right"width="46"><strong>TOTAL </strong></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="930" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
        
        
	<?php if ($val == 1){
		    if ($local == 'all'){
                       $sql="SELECT V.invtot,V.sucursal,V.invfec,V.igv, V.tipdoc,V.nrofactura,V.correlativo,V.cuscod,D.codpro,D.costpr,D.canpro,D.fraccion,D.factor,D.prisal FROM venta as V INNER JOIN detalle_venta AS D ON D.invnum = V.invnum WHERE D.invfec between '$date1' and '$date2' and V.estado2 <> '1' ";  
                        }
		else{
                       $sql="SELECT V.invtot,V.sucursal,V.invfec, V.igv,V.tipdoc,V.nrofactura,V.correlativo,V.cuscod,D.costpr,D.codpro,D.canpro,D.fraccion,D.factor,D.prisal FROM venta as V INNER JOIN detalle_venta AS D ON D.invnum = V.invnum WHERE D.invfec between '$date1' and '$date2' and V.sucursal = '$local' and V.estado2 <> '1' ";                      
                            }
                       }
                if ($vals == 2){
                   if ($local == 'all'){
                       $sql="SELECT V.invtot,V.sucursal,V.invfec, V.igv,V.tipdoc,V.nrofactura,V.correlativo,V.cuscod,D.costpr,D.codpro,D.canpro,D.fraccion,D.factor,D.prisal FROM venta as V INNER JOIN detalle_venta AS D ON D.invnum = V.invnum WHERE D.invfec between '$date1' and '$date2' and V.estado2 <> '1' ";  
                        }
		else{
                       $sql="SELECT V.invtot,V.sucursal,V.invfec,V.igv, V.tipdoc,V.nrofactura,V.correlativo,V.cuscod,D.costpr,D.codpro,D.canpro,D.fraccion,D.factor,D.prisal FROM venta as V INNER JOIN detalle_venta AS D ON D.invnum = V.invnum WHERE D.invfec between '$date1' and '$date2' and V.sucursal = '$local' and V.estado2 <> '1'";
                            }
                        }
               
                                       
	$zz = 0;
	$i  = 0;
        $sumpripro = 0;
        $SumInafectos = 0;
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	?>
	<table width="926" border="0" align="center">
      <?php while ($row = mysqli_fetch_array($result)){
		$invfec       = $row['invfec'];
		$invnum       = $row['invnum'];
		$tipdoc       = $row['tipdoc'];
		$nrofactura   = $row['nrofactura'];
		$correlativo  = $row["correlativo"];
		$cuscod       = $row["cuscod"];
		$codpro       = $row['codpro'];
		$sucursal     = $row["sucursal"];
        $igv          = $row["igv"];
        $canpro       = $row["canpro"];
        $fraccion     = $row["fraccion"];
        $factor       = $row["factor"];
        $prisal       = $row["prisal"];
        $costpr       = $row["costpr"];
        $invtot       = $row["invtot"];
                
		
                
           
                 $nrofactura2 =  substr($nrofactura,0,4);  
                 
            
             
              
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
		    $sql2="SELECT activo,desprod,igv FROM producto WHERE codpro='$codpro' ";
		$result1 = mysqli_query($conexion,$sql2);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
			$activo    = $row1['activo'];
			$desprod    = $row1['desprod'];
            $igvp    = $row1['igv'];
            
            
                }}
                        
		    $sql2="SELECT descli,dnicli,ruccli FROM cliente WHERE codcli='$cuscod' ";
		$result1 = mysqli_query($conexion,$sql2);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
			$descli    = $row1['descli'];
			$dnicli    = $row1['dnicli'];
			$ruccli   = $row1['ruccli'];
                        
                }}
           
		$sql1="SELECT nomusu FROM usuario where usecod = '$usecod'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
			$user    = $row1['nomusu'];}}
                        
                        
      if ($igvp == 0)
            {
                $MontoDetalle = $prisal * $canpro;
                $SumInafectos = $SumInafectos + $MontoDetalle;
            }
		
		$SumGrabado = $invtot - ($igv + $SumInafectos);
		
		
			/*if ($sumpcosto > 0){
			$rentabilidad   = $sumpripro - $sumpcosto;
			$rentabilidad1[$zz] = $rentabilidad1[$zz] + $rentabilidad;}*/
		  if (($suc[$zz-1] <> "") and ($suc[$zz-1] <> $suc[$zz])){
		  if ($sucursal <> $ssss[$i-1]){
		  ?>
			
		  <?php }}?>
                        <tr>
                             <?php if ($ckloc == 1){?><td width="30"><?php echo $sucur?></td><?php }?>
                            <td width="80"><div align="center"><?php echo fecha($invfec)?></div></td>
                                       
                            <td width="50"><div align="CENTER"><?php echo $tipdoc?></div></td>
                            <td width="50"><div align="CENTER"><?php echo $nrofactura2?></div></td>
                            <td width="60"><div align="CENTER"><?php echo $correlativo?></div></td>
                            <td width="40"><div align="CENTER"><?php  echo $activo?></div></td>
                            <td width="100"><div align="CENTER"><?php  if($dnicli <> ""){ echo "DNI"."--".$dnicli;}else{ echo "RUC"."--".$ruccli;}?></div></td>
                            <td width="150"><div align="CENTER"><?php  echo $descli?></div></td>
                            <td width="70"><div align="center"><?php  echo $codpro?></div></td>
                            <td width="150"><div align="left"><?php  echo $desprod?></div></td>
                            
                            <td width="80"><div align="center"><?php  echo $igv;?></div></td>       <!--impuesto-->
                            <td width="80"><div align="left"><?php  echo $SumGrabado?></div></td>   <!--valor de venta-->
                            <td width="50"><div align="right"><?php  echo $SumInafectos?></div></td> <!--sin igv-->
                            <td width="50"><div align="right"><?php  echo $invtot?></div></td>       <!--total-->
                            
                            
                            
                        </tr>
                  <?php }?>
    </table>
	<?php if ($zz == 1){
		?>
		  <!--<table width="926" border="0" align="center">
			   <tr bgcolor="#CCCCCC">
				<td width="450"><div align="right"><strong>TOTAL</strong></div></td>
				<td width="90"><div align="right"><?php echo $numero_formato_frances = number_format($gravado1, 2, '.', ' ');?></div></td>
				<td width="90"><div align="right"><?php echo $numero_formato_frances = number_format($inafecto1, 2, '.', ' ');?></div></td>
              			<td width="90"><div align="right"><?php echo $numero_formato_frances = number_format($igv1, 2, '.', ' ');?></div></td>
              			<td width="90"><div align="right"><?php echo $numero_formato_frances = number_format($TOT1, 2, '.', ' ');?></div></td>
            		</tr>
                                
			  </tr>
	  </table>-->
		<?php }else{?>
		  <!--<table width="926" border="0" align="center">
            <tr bgcolor="#CCCCCC">
			 
				<td width="450"><div align="right"><strong>TOTAL</strong></div></td>
				<td width="90"><div align="right"><?php echo $numero_formato_frances = number_format($gravado1, 2, '.', ' ');?></div></td>
                                <td width="90"><div align="right"><?php echo $numero_formato_frances = number_format($habil_inafecto12[$zz], 2, '.', ' ');?></div></td>

              			<td width="90"><div align="right"><?php echo $numero_formato_frances = number_format($igv1, 2, '.', ' ');?></div></td>
              			<td width="90"><div align="right"><?php echo $numero_formato_frances = number_format($TOT1, 2, '.', ' ');?></div></td>
            		</tr>
          </table>-->
		  <?php }}else{?>
	<center>No se logro encontrar informacion con los datos ingresados</center>
	<?php }?>
	</td>
  </tr>
  
  
  
  
</table>
<?php }}

?>
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

                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$desc' and '$desc1'   and estado = '0' AND  V.nrofactura like'B%' and V.estado2 <> '1' order by V.nrovent ";
                            }
                        if($doc==2)//factura
                            { 
                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$desc' and '$desc1'   and estado = '0' AND  V.nrofactura like'F%' and V.estado2 <> '1' order by V.nrovent ";
                            }
                        if($doc==3)
                            {
                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$desc' and '$desc1'  and estado = '0' AND  V.nrofactura like'T%' and V.estado2 <> '1' order by V.nrovent ";
                            }
                        if($doc==0)
                            {
                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$desc' and '$desc1'  and estado = '0' and V.estado2 <> '1' order by V.nrovent";
                            }
                        }
		else{
                        if($doc==1){
                        $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$desc' and '$desc1' and 	V.sucursal = '$local' and estado = '0' AND  V.nrofactura like'B%'  and V.estado2 <> '1' order by V.nrovent";  
                        }
                        if($doc==2){
                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$desc' and '$desc1' and 	V.sucursal = '$local' and estado = '0' AND  V.nrofactura like'F%' and V.estado2 <> '1' order by V.nrovent";
                        }
                        if($doc==3){
                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$desc' and '$desc1' and 	V.sucursal = '$local' and V.invtot <> '0' and V.gravado<>'0' and estado = '0' AND  V.nrofactura like'T%' and V.estado2 <> '1' order by V.nrovent ";
                        }
                        if($doc==0){
                            $sql=" SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$desc' and '$desc1' and 	V.sucursal = '$local' and V.invtot <> '0' and V.gravado<>'0' and estado = '0' and V.estado2 <> '1' order by V.nrovent";}}
                       }
                
                
                if ($vals == 2){
                   if ($local == 'all'){
                        if($doc==1)
                            {
                            $sql="SELECT cuscod,invnum,usecod,nrovent,invtot,sucursal,nrofactura,gravado,igv,val_habil,inafecto,nrofactura,invfec,inafecto FROM venta  WHERE invfec between '$date1' and '$date2'  AND nrofactura like'B%' order by nrovent";
                            }
                        if($doc==2)//factura
                            { 
                            $sql="	SELECT cuscod,invnum,usecod,nrovent,invtot,sucursal,nrofactura,gravado,igv,val_habil,inafecto,nrofactura,invfec,inafecto FROM venta  WHERE invfec between '$date1' and '$date2'  AND nrofactura like'F%' order by nrovent";
                            }
                        if($doc==3)
                            {
                            $sql="SELECT cuscod,invnum,usecod,nrovent,invtot,sucursal,nrofactura,gravado,igv,val_habil,inafecto,nrofactura,invfec,inafecto FROM venta  WHERE invfec between '$date1' and '$date2'  AND nrofactura like'T%' order by nrovent";
                            }
                        if($doc==0)
                            {
                            $sql="SELECT V.invnum,V.usecod,V.nrovent,invtot,V.sucursal,V.nrofactura,V.gravado,V.igv,V.val_habil,V.inafecto,C.descli,C.dnicli,C.ruccli,V.inafecto  FROM venta AS V inner join cliente as C on C.codcli = V.cuscod where invfec between '$date1' and '$date2' and estado = '0' order by V.nrovent ";
                            }
                        }
		else{
                        if($doc==1){
                        $sql="
	SELECT cuscod,invnum,usecod,nrovent,invtot,sucursal,nrofactura,gravado,igv,val_habil,inafecto,nrofactura,invfec,inafecto FROM venta  WHERE invfec between '$date1' and '$date2'  and sucursal = '$local' AND nrofactura like'B%' order by nrovent";  
                        }
                        if($doc==2){
                            $sql="
	SELECT cuscod,invnum,usecod,nrovent,invtot,sucursal,nrofactura,gravado,igv,val_habil,inafecto,nrofactura,invfec,inafecto FROM venta  WHERE invfec between '$date1' and '$date2'  and sucursal = '$local' AND nrofactura like'F%' order by nrovent";
                        }
                        if($doc==3){
                            $sql="
	SELECT cuscod,invnum,usecod,nrovent,invtot,sucursal,nrofactura,gravado,igv,val_habil,inafecto,nrofactura,invfec,inafecto FROM venta  WHERE invfec between '$date1' and '$date2'  and sucursal = '$local' AND nrofactura like'T%' order by nrovent

";
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
		$cuscod1    = $row['cuscod'];
		$invnum    = $row['invnum'];
		$usecod    = $row['usecod'];
		$nrovent   = $row['nrovent'];
//		$forpag    = $row["forpag"];
		$val_habil = $row["val_habil"];
		$total     = $row["invtot"];
		$sucursal  = $row["sucursal"];
		$nrofactura  = $row["nrofactura"];
//		$hora	   = $row["hora"];
//		$descli	   = $row['descli'];
//		$ruccli	   = $row['ruccli'];
//		$dnicli	   = $row['dnicli'];

		$gravado   = $row["gravado"];
		if($val_habil <>1){
		$gravado2   += $row["gravado"];
		}
		$invtot	   = $row["invtot"];
		
		$igv22	   = $row["igv"];
		$inafecto5	   = $row["inafecto"];
		
			if($val_habil <>1){
			$inafecto51	   += $row["inafecto"];
		}
		
          		if($val_habil <>1){
		 $igv21	   += $row["igv"];
		}
				if($val_habil <>1){
		$invtotA	   += $row["invtot"];
		}
                
                 
                  //CLIENTE
                                                $sql1="SELECT descli,dnicli,ruccli FROM cliente where codcli = '$cuscod1'";
						$result1 = mysqli_query($conexion,$sql1);
						if (mysqli_num_rows($result1)){
						while ($row1 = mysqli_fetch_array($result1)){
						$descli     = $row1['descli'];
						$dnicli     = $row1['dnicli'];
						$ruccli     = $row1['ruccli'];
                                                }
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
                            <?php if ($doc == 2){?><td align="CENTER" width="<?php if ($doc == 2){?>40<?php } else {?>350<?php }?>"><?php echo $ruccli?></td><?php }?>
                            <td width="45"><div align="center"><?php   if($val_habil==1){
                             $reso="ANULADO";
                             echo "<p class='Estilo1'>$reso</p>";
                            }else{
                             $reso=" ";
                             echo "<strong>$reso</strong>";
                             
                            }?></div>
                            </td>
                            <td width="35"><div align="CENTER"><?php if($val_habil==1){ echo "<p class='Estilo1'>-----</p>";; }else{echo $gravado;}?></div></td>
                            <td width="50"><div align="center"><?php if($val_habil==1){ echo "<p class='Estilo1'>-----</p>";; }else{echo $inafecto5;} ?></div></td>
                            <td width="35"><div align="right"><?php  if($val_habil==1){ echo "<p class='Estilo1'>-----</p>";; }else{echo $igv22;} ?></div></td>
                            <td width="35"><div align="right"><?php if($val_habil==1){ echo "<p class='Estilo1'>-----</p>";; }else{echo $invtot;} ?></div></td>
                        </tr>
                  <?php }?>
    </table>
	<?php if ($zz == 1){
		?>
		  <table width="926" border="0" align="center">
			  <tr bgcolor="#CCCCCC">
				<td width="450"><div align="right"><strong>TOTAL</strong></div></td>
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

