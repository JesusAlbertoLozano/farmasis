<?php include('../../session_user.php');
$transferencia_ing 	 = $_SESSION['transferencia_ing'];
require_once ('../../../conexion.php');	//CONEXION A BASE DE DATOS
 require_once('../../../convertfecha.php');    //CONEXION A BASE DE DATOS
$sql="SELECT * FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$codloc       = $row['codloc'];			//////OBTENGO EL CODIGO DEL LOCAL ACTUAL O DESTINO
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
<?php require_once("../../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUMEROS ENTEROS-DECIMALES
require_once("../funciones/transferencia_ing.php");	//FUNCIONES DE ESTA PANTALLA
?>
</head>
<body onload="fc()">
<?php function formato($c) {
printf("%08d",  $c);
} 

function convertir_a_numero($str)
{
    $legalChars = "%[^0-9\-\. ]%";
    $str = preg_replace($legalChars, "", $str);
    return $str;
}
$nomusu = "";
$val       = isset($_REQUEST['val']) ? ($_REQUEST['val']) : "";
if ($val == 1)
{
	$documento = isset($_REQUEST['doc']) ? ($_REQUEST['doc']) : "";				////DOCUMENTO
	$local     = isset($_REQUEST['local']) ? ($_REQUEST['local']) : "";			////LOCAL  DE PROCEDENCIA O ORIGEN
	$sql1="SELECT invnumrecib FROM movmae where invnum = '$transferencia_ing'";
	$result1 = mysqli_query($conexion,$sql1);
	if (mysqli_num_rows($result1)){
	while ($row1 = mysqli_fetch_array($result1)){
		$invnumrecib        = $row1['invnumrecib'];		////NOMBRE DE QUIEN REALIZO LA TRANSFERENCIA
	}
	}
	///////////////////////////////////////////////////////////////////
	$sql="SELECT * FROM movmae where numdoc = '$documento' and sucursal = '$local' and sucursal1 = '$codloc' and tipmov = '2' and tipdoc = '3' and estado = '0' and proceso = '0' and val_habil = '0'";					/////OBTENGO EL DOCUMENTO
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	while ($row = mysqli_fetch_array($result)){
		$codmov        = $row['invnum'];			/////codigo del documento que esta procesando
		$numdoc        = $row['numdoc'];
		$invfec        = $row['invfec'];
		$usecod        = $row['usecod'];			/////CODIGO DEL USUARIO QUIEN REALIZO LA SALIDA
		$codusu        = $row['codusu'];			/////CODIGO DEL USUARIO A QUIEN SE LE DIO LA SALIDA
		$sucursal      = $row['sucursal'];			/////OBTENGO EL CODIGO DEL LOCAL DE ORIGEN$sql1="SELECT nomusu FROM usuario where usecod = '$usecod'";
		$sucursal1     = $row['sucursal1'];			/////OBTENGO EL CODIGO DEL LOCAL DE DESTINO
		
		$sql1="SELECT nomusu FROM usuario where usecod = '$usecod'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
			$nomusu        = $row1['nomusu'];		////NOMBRE DE QUIEN REALIZO LA TRANSFERENCIA
		}
		}
		
		
		$sql1="SELECT nomloc FROM xcompa where codloc = '$sucursal'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
					$local_orig    = $row1['nomloc']; ////NOMBRE DEL LOCAL DE ORIGEN
		}
		}
		$sql1="SELECT nomloc FROM xcompa where codloc = '$sucursal1'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
					$destino       = $row1['nomloc']; /////NOMBRE DEL LOCAL DE DESTINO
		}
		}
	}
		
	}
	
	$sql1="SELECT count(*) FROM tempmovmov where invnum = '$transferencia_ing' and costre = '0' and invnumrecib = '$invnumrecib'";	///SI EXISTEN CANTIDADES INGRADAS EN TEMP 
	$result1 = mysqli_query($conexion,$sql1);
	if (mysqli_num_rows($result1)){
	while ($row1 = mysqli_fetch_array($result1)){
		$count_subtot         = $row1[0];		//codigo
	}
	}
	//echo $count_subtot;
	$sql1="SELECT count(*) FROM movmov where invnum = '$codmov'";	///CANTIDAD DE REGISTROS DEL DOCUMENTO DE ORIGEN
	$result1 = mysqli_query($conexion,$sql1);
	if (mysqli_num_rows($result1)){
	while ($row1 = mysqli_fetch_array($result1)){
		$count_regis        = $row1[0];		//codigo
	}
	}
	//echo $count_regis;
	$sql1="SELECT count(*) FROM tempmovmov where invnum = '$transferencia_ing' and invnumrecib = '$invnumrecib'";	///CANTIDAD DE REGISTROS DEL DOCUMENTO DE ORIGEN
	$result1 = mysqli_query($conexion,$sql1);
	if (mysqli_num_rows($result1)){
	while ($row1 = mysqli_fetch_array($result1)){
		$count_temp_regis        = $row1[0];		//codigo
	}
	}	
	//echo $count_temp_regis;
	//////////////////////////////////////////////////////////
	$sql1="SELECT * FROM tempmovmov where invnum = '$transferencia_ing' and invnumrecib = '$invnumrecib' order by codtemp";
	$result1 = mysqli_query($conexion,$sql1);
	if (mysqli_num_rows($result1)){
?>
<form id="form1" name="form1" onKeyUp="highlight(event)" onClick="highlight(event)">
<table class="celda2" width="939" border="0" bgcolor="#FFFFCC">
  <tr>
    <td><table width="930" border="0">
      <tr>
        <td width="98"><strong>NRO DOCUMENTO </strong></td>
        <td width="198"><?php echo formato($numdoc)?></td>
        <td width="131"><strong>FECHA DE DOCUMENTO </strong></td>
        <td width="485"><?php echo $invfec?></td>
      </tr>
    </table>
      <table width="930" border="0">
        <tr>
          <td width="84"><strong>PROVIENE DE </strong></td>
          <td width="213"><?php echo $local_orig?> <strong>A</strong> <?php echo $destino?></td>
          <td width="169"><strong>MOVIMIENTO REALIZADO POR </strong></td>
          <td width="446"><?php echo $nomusu?></td>
        </tr>
      </table>
      <table width="930" border="0">
        <tr>
          <td width="347">
		  <input name="movmae" type="hidden" id="movmae" value="<?php echo $codmov?>" />
          <input size="160" class="login"  type="button" name="Submit" style="font-weight:bold;width: 30em;font-size: 14pt; " value="&iquest;CONFIRMAR E INGRESAR MERCADERIA?" onclick="grabar_dato()" <?php if (($count_regis==$count_temp_regis)){ } else {?>disabled="disabled"<?php }?>/></td>
          <td width="582"><label></label></td>
        </tr>
      </table></td>
  </tr>
</table>

  <table class="celda2" width="939">
      <tr>
          <th width="3" bgcolor="#50ADEA" class="titulos_movimientos">N</th>
          <th width="6" bgcolor="#50ADEA" class="titulos_movimientos">CODIGO</th>
      <th width="363" bgcolor="#50ADEA" class="titulos_movimientos">DESCRIPCION</th>
      <th width="249" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">MARCA</div></th>
	  <th width="79" colspan='3' bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">CANT</div></th>
	  
	  <th width="74" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">P. PROM </div></th>
	  <th width="79" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">SUB TOT</div></th>
	  <th width="67" bgcolor="#50ADEA" class="titulos_movimientos">&nbsp;</th>
    </tr>
    <?php $i = 0;
	while ($row1 = mysqli_fetch_array($result1)){			/////DATOS DEL DOCUMENTO
	 $i++;
			$qtypro         = $row1["qtypro"];		//codigo
			$qtyprf         = $row1["qtyprf"];		
			$pripro         = $row1["pripro"];		
			$costre         = $row1["costre"];
			$codpro         = $row1['codpro'];	
			$sql2="SELECT qtypro,qtyprf,costre FROM tempmovmov where invnum = '$transferencia_ing' and codpro = '$codpro' and invnumrecib = '$invnumrecib'";
			$result2 = mysqli_query($conexion,$sql2);
			if (mysqli_num_rows($result2)){
			while ($row2 = mysqli_fetch_array($result2)){
				$qtypro1         = $row2["qtypro"];		//codigo
				$qtyprf1         = $row2["qtyprf"];
				$costre1         = $row2["costre"];
				$encontrado = 1;
			}
			}	
			else
			{
			$qtypro1		="";
			$qtyprf1		="";
			$costre1		="";
			}
			$sql2="SELECT desprod,codmar,factor FROM producto where codpro = '$codpro'";
			$result2 = mysqli_query($conexion,$sql2);
			if (mysqli_num_rows($result2)){
			while ($row2 = mysqli_fetch_array($result2)){
				$desprod     = $row2['desprod'];
				$codmar      = $row2['codmar'];
				$factor      = $row2['factor'];	
			}
			}	
			$sql2="SELECT destab FROM titultabladet where codtab = '$codmar'";
			$result2 = mysqli_query($conexion,$sql2);
			if (mysqli_num_rows($result2)){
			while ($row2 = mysqli_fetch_array($result2)){
				$marca    = $row2['destab'];
			}
			}	
			$valform = $_REQUEST['valform'];
			$cod     = $_REQUEST['cod'];
			
			   if ($qtyprf <> "") {
                       $cantidad_solicitada =  convertir_a_numero($qtyprf);
                            $texto= stockcaja($cantidad_solicitada, $factor);
                } else {
                    
                    
                    $texto=stockcaja($qtypro, $factor);
            }
	?>
	
	 <tr onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#ffffff';">
	 
      <td  valign="bottom"><?php echo $i?></td>
      <td  valign="bottom"><?php echo $codpro?></td>
      <td  valign="bottom"><?php echo $desprod?></td>
    <td  valign="bottom"><?php echo $marca?></td>
      <td width="79" valign="bottom"><div align="right">
        <?php if (($valform == 1) && ($cod == $codpro)) { ?>
        <input name="stock" type="hidden" id="stock" value="<?php echo $cant?>" />
        <input type="hidden" name="costpr" value="<?php echo $costpr;?>"/>
        <input type="hidden" name="stockpro" value="<?php echo $stopro;?>"/>
        <input type="hidden" name="factor" value="<?php echo $factor;?>"/>
        <input type="hidden" name="porcentaje" value="<?php if ($igv == 1){echo $porcent;}?>"/>
        <input name="text1" type="text" class="input_text1" id="text1" value="<?php if ($qtyprf1 <> ""){echo $qtyprf1; } else { echo $qtypro1;}?>" size="4" maxlength="6" onkeypress="return f(event)" onkeyup ="precio();"/>
        <?php } else { if ($qtyprf1 <> ""){ echo $qtyprf1; } else {echo $qtypro1;}}?>
      </div></td>
	 <td width="8" valign="bottom">
                            <div align="center">
                             <a style='color:red;'> = </a>  
                                </div>
                        </td>
                        <td width="81" valign="bottom" bgcolor='#e3e3e3';>
                            <div align="left">
                               <?php echo $texto;  ?>
                                </div>
                        </td>
	
	  <td  valign="bottom"><div align="right">
        <?php if (($valform == 1) && ($cod == $codpro)) { ?> 
        <input name="text2" type="text" id="text2" size="4" class="pvta" value="<?php echo $pripro?>" onclick="blur()"/>
        <?php } else { echo $pripro;}?>
       </div></td>
      <td  valign="bottom"><div align="right">
         <?php if (($valform == 1) && ($cod == $codpro)) { ?> 
        <input name="text3" type="text" id="text3" size="4" class="pvta" value="<?php echo $costre1?>" onclick="blur()"/>
         <?php } else { echo $costre1;}?>
      </div></td>
	  <td  valign="bottom">
	    <div align="center">
		<?php if ($encontrado == 1){
		?>
		<a href="javascript:popUpWindow('lote/lote.php?cod=<?php echo $codpro?>', 435, 110, 560, 200)" title="LOTE DE PRODUCTOS"><img src="../../../images/add.gif" width="14" height="15" border="0" title="LOTE DE PRODUCTOS"/></a>
		<?php }
		?>
	      <?php if (($valform == 1) && ($cod == $codpro)) { ?> 
	      <input name="number" type="hidden" id="number" />
		  <input name="val" type="hidden" id="val" value="1" />
		  <input name="local" type="hidden" id="local" value="<?php echo $local?>" />
		  <input name="doc" type="hidden" id="codtemp" value="<?php echo $documento?>" />
		  <input name="produc" type="hidden" id="codtemp" value="<?php echo $codpro?>" />
		  <input name="invnumrecib" type="hidden" id="invnumrecib" value="<?php echo $invnumrecib?>" />
	      <input type="button" id="boton" onClick="validar_prod()" alt="GUARDAR"/>
		  <input type="button" id="boton1" onClick="validar_grid()" alt="ACEPTAR"/>
          <?php } else { ?>
	      <a href="transferencia2_ing.php?cod=<?php echo $codpro?>&valform=1&val=1&doc=<?php echo $documento?>&local=<?php echo $local?>"><img src="../../../images/edit_16.png" width="16" height="16" border="0"/></a>
		  <?php }?>
       </div>	 
	   </td>
     </tr>
	 
	<?php }
	?>
  </table>
  <?php }
  else
  {
  ?>
  <br><br><br><br><br><br><br><br><center>LOS DATOS INGRESADOS NO ARROJAN RESULTADOS EN EL SISTEMA</center>
  <?php }
  ?> 
</form>
<?php }
else
{
?>
<br><br><br><br><br><br><br><br><center>INDIQUE EL NUMERO DEL DOCUMENTO Y EL LOCAL, LUEGO SELECCIONE BUSCAR</center>
<?php }
?>
</body>
</html>