<?php include('../../session_user.php');
$transferencia_ing 	 = $_SESSION['transferencia_ing'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
<?php require_once ('../../../conexion.php');	//CONEXION A BASE DE DATOS
require_once("../../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUMEROS ENTEROS-DECIMALES
require_once("../funciones/transferencia_ing.php");	//FUNCIONES DE ESTA PANTALLA
?>
</head>
<body>
<?php function formato($c) {
printf("%08d",  $c);
} 
$val       = $_REQUEST['val'];
if ($val == 1)
{
	$documento = $_REQUEST['doc'];				////DOCUMENTO
	$local     = $_REQUEST['local'];			////LOCAL  DE PROCEDENCIA

	$sql="SELECT usecod FROM movmae where numdoc = '$documento' and tipmov = '2' and tipdoc = '3' and estado = '0' and proceso = '0' and val_habil = '0'";
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){					/////CODIGO DEL USUARIO QUE HIZO LA TRANSFERENCIA
	while ($row = mysqli_fetch_array($result)){
		$usecod        = $row['usecod'];
	}
	}
	$sql="SELECT codloc FROM usuario where usecod = '$usecod' and codloc = '$local'";
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	while ($row = mysqli_fetch_array($result)){
		$codloc        = $row['codloc'];			//////OBTENGO EL CODIGO DEL LOCAL DE ORIGEN
	}
	}
	////////////////////////////////////////////////////////////////////
	$sql="SELECT * FROM movmae where numdoc = '$documento' and usecod = '$codloc' and tipmov = '2' and tipdoc = '3' and estado = '0' and proceso = '0' and val_habil = '0'";					/////OBTENGO EL DOCUMENTO
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	while ($row = mysqli_fetch_array($result)){
		$codmov        = $row['invnum'];			///codigo del documento que esta procesando
		$numdoc        = $row['numdoc'];
		$invfec        = $row['invfec'];
		$usecod        = $row['usecod'];
		$sucursal      = $row['sucursal'];			/////OBTENGO EL CODIGO DEL LOCAL DESTINO
		$sql1="SELECT nomloc,nomusu FROM usuario inner join local on usuario.codloc = local.codloc where usecod = '$usecod'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
			$nomloc        = $row1['nomloc'];		/////NOMBRE DEL LOCAL DE ORIGEN Y DEL USUARIO
			$nomusu        = $row1['nomusu'];
		}
		}
		$sql1="SELECT nomloc FROM local where codloc = '$sucursal'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
			$destino        = $row1['nomloc'];		/////NOMBRE DL LOCAL DE DESTINO
		}
		}
	}
	}
	$sql1="SELECT sum(costre) FROM tempmovmov where invnum = '$transferencia_ing'";
	$result1 = mysqli_query($conexion,$sql1);
	if (mysqli_num_rows($result1)){
	while ($row1 = mysqli_fetch_array($result1)){
		$count_subtot         = $row1[0];		//codigo
	}
	}	
	//////////////////////////////////////////////////////////
	$sql1="SELECT * FROM movmov where invnum = '$codmov'";
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
          <td width="213"><?php echo $nomloc?> <strong>A</strong> <?php echo $destino?></td>
          <td width="169"><strong>MOVIMIENTO REALIZADO POR </strong></td>
          <td width="446"><?php echo $nomusu?></td>
        </tr>
      </table>
      <table width="930" border="0">
        <tr>
          <td width="247">
		  <input name="movmae" type="hidden" id="movmae" value="<?php echo $codmov?>" />
          <input type="button" name="Submit" value="&iquest;CONFIRMAR E INGRESAR MERCADERIA?" onclick="grabar_dato()" <?php if ($count_subtot==0){?>disabled="disabled"<?php }?>/></td>
          <td width="682"><label></label></td>
        </tr>
      </table></td>
  </tr>
</table>
<table class="celda2" width="939">
    <tr>
      <td width="402" bgcolor="#50ADEA" class="titulos_movimientos">DESCRIPCION</td>
	  <td width="79" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">CANT</div></td>
	  <td width="249" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">MARCA</div></td>
	  <td width="74" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">P. PROM </div></td>
	  <td width="69" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">SUB TOT</div></td>
	  <td width="38" bgcolor="#50ADEA" class="titulos_movimientos">&nbsp;</td>
    </tr>
  </table>
  <table class="celda2" width="939">
    <?php $i = 0;
	while ($row1 = mysqli_fetch_array($result1)){			/////DATOS DEL DOCUMENTO
			$qtypro         = $row1["qtypro"];		//codigo
			$qtyprf         = $row1["qtyprf"];		
			$pripro         = $row1["pripro"];		
			$costre         = $row1["costre"];
			$codpro         = $row1["codprod"];	
			$sql2="SELECT codpro FROM local_producto where locprod = '$codpro'";
			$result2 = mysqli_query($conexion,$sql2);
			if (mysqli_num_rows($result2)){
			while ($row2 = mysqli_fetch_array($result2)){
				$codpro     = $row2['codpro'];
			}
			}	
			$sql2="SELECT desprod,codmar,factor FROM producto where codprod = '$codpro'";
			$result2 = mysqli_query($conexion,$sql2);
			if (mysqli_num_rows($result2)){
			while ($row2 = mysqli_fetch_array($result2)){
				$desprod     = $row2['desprod'];
				$codmar      = $row2['codmar'];
				$factor      = $row2['factor'];	
			}
			}	
			$sql2="SELECT * FROM titultabladet where codtab = '$codmar'";
			$result2 = mysqli_query($conexion,$sql2);
			if (mysqli_num_rows($result2)){
			while ($row2 = mysqli_fetch_array($result2)){
				$marca    = $row2['destab'];
			}
			}	
			$sql2="SELECT qtypro,qtyprf,costre FROM tempmovmov where invnum = '$transferencia_ing' and codpro = '$codpro'";
			$result2 = mysqli_query($conexion,$sql2);
			if (mysqli_num_rows($result2)){
			while ($row2 = mysqli_fetch_array($result2)){
				$qtypro1         = $row2["qtypro"];		//codigo
				$qtyprf1         = $row2["qtyprf"];
				$costre1         = $row2["costre"];
			}
			}	
			$valform = $_REQUEST['valform'];
			$cod     = $_REQUEST['cod'];
	?>
	
	 <tr onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#ffffff';">
	 
      <td width="401" valign="bottom"><?php echo $desprod?></td>
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
	  <td width="249" valign="bottom"><?php echo $marca?></td>
	  <td width="73" valign="bottom"><div align="right">
        <?php if (($valform == 1) && ($cod == $codpro)) { ?> 
        <input name="text2" type="text" id="text2" size="4" class="pvta" value="<?php echo $pripro?>" onclick="blur()"/>
        <?php } else { echo $pripro;}?>
       </div></td>
      <td width="71" valign="bottom"><div align="right">
         <?php if (($valform == 1) && ($cod == $codpro)) { ?> 
        <input name="text3" type="text" id="text3" size="4" class="pvta" value="<?php echo $costre1?>" onclick="blur()"/>
         <?php } else { echo $costre1;}?>
      </div></td>
	  <td width="38" valign="bottom">
	    <div align="center">
	      <?php if (($valform == 1) && ($cod == $codpro)) { ?> 
	      <input name="number" type="hidden" id="number" />
		  <input name="val" type="hidden" id="val" value="1" />
		  <input name="local" type="hidden" id="local" value="<?php echo $local?>" />
		  <input name="doc" type="hidden" id="codtemp" value="<?php echo $documento?>" />
		  <input name="produc" type="hidden" id="codtemp" value="<?php echo $codpro?>" />
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