<?php include('../../session_user.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/select.css" rel="stylesheet" type="text/css" />
<?php require_once('../../../conexion.php');	//CONEXION A BASE DE DATOS
require_once("../../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../../funciones/botones.php");	//COLORES DE LOS BOTONES
require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUMEROS ENTEROS-DECIMALES
require_once("../funciones/transferencia.php");	//FUNCIONES DE ESTA PANTALLA
require_once("ajax_transferencia.php");	//FUNCIONES DE AJAX PARA COMPRAS Y SUMAR FECHAS
require_once("../../local.php");	//LOCAL DEL USUARIO
////////////////////////////////////////////////////////////////////////////////////////////////
$sql="SELECT invnum FROM movmae where usecod = '$usuario' and proceso = '1'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result) ){
while ($row = mysqli_fetch_array($result)){
		$invnum          = $row['invnum'];		//codigo
}
}
$_SESSION[transferencia_sal]	= $invnum; 
////////////////////////////////////////////////////////////////////////////////////////////////
$sql="SELECT invnum,invfec,numdoc,refere FROM movmae where invnum = '$invnum'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
		$cod          = $row['invnum'];		//codgio
		$fecha        = $row['invfec'];
		$numdoc       = $row['numdoc'];
		$refere       = $row['refere'];
}
}
function formato($c) {
printf("%08d",  $c);
} 
function formato1($c) {
printf("%06d",  $c);
} 
?>
<?php $sql="SELECT count(*) FROM tempmovmov where invnum = '$invnum'";
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	while ($row = mysqli_fetch_array($result)){
			$count        = $row[0];	////CANTIDAD DE REGISTROS EN EL GRID
	}	
	}
	else
	{
	$count = 0;	////CUANDO NO HAY NADA EN EL GRID
	}
	///////CUENTA CUANTOS REGISTROS NO SE HAN LLENADO
	$sql="SELECT count(*) FROM tempmovmov where invnum = '$invnum' and qtypro = '0' and qtyprf = ''";
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	while ($row = mysqli_fetch_array($result)){
			$count1        = $row[0];	////CUANDO HAY UN GRID PERO CON DATOS VACIOS
	}	
	}
	else
	{
	$count1 = 0;	////CUANDO TODOS LOS DATOS ESTAN CARGADOS EN EL GRID
	}
	///////CONTADOR PARA CONTROLAR LOS TOTALES
	$sql="SELECT count(*) FROM tempmovmov where invnum = '$invnum' and qtypro <> '0' or qtyprf <> ''";
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	while ($row = mysqli_fetch_array($result)){
			$count2        = $row[0];	
	}	
	}
	else
	{
	$count2 = 0;
	}
	$sql1="SELECT nomusu FROM usuario where usecod = '$usuario'";
			$result1 = mysqli_query($conexion,$sql1);
			if (mysqli_num_rows($result1)){
			while ($row1 = mysqli_fetch_array($result1)){
				$user    = $row1['nomusu'];
	}
	}
	$sql1="SELECT codpro,pripro,costre FROM tempmovmov where invnum = '$invnum'";
	$result1 = mysqli_query($conexion,$sql1);
	if (mysqli_num_rows($result1)){
	while ($row1 = mysqli_fetch_array($result1)){
	    $codpro    = $row1['codpro'];
		$pripro    = $row1['pripro'];
		$costre    = $row1['costre'];
		$sum1	   = $sum1 + $pripro;
		$sum2	   = $sum2 + $costre;
	}	
		$sum1 			=  $numero_formato_frances = number_format($sum1, 2, '.', ',');
		$sum2 			=  $numero_formato_frances = number_format($sum2, 2, '.', ',');
	}
	else
	{

	}
require_once("../funciones/call_combo.php");	//LLAMA A generaSelect
?>
<script type="text/javascript" src="../funciones/select_2_niveles.js"></script>
</head>

<body>
<form name="form1" id="form1" onClick="highlight(event)" onKeyUp="highlight(event)">
  <table width="968" border="0">
    <tr>
      <td width="958"><table width="954" border="0">
          <tr>
            <td width="76">NUMERO</td>
            <td width="201"><input name="textfield" type="text" size="15" disabled="disabled" value="<?php echo formato($numdoc)?>"/></td>
            <td width="61"><div align="right">FECHA</div></td>
            <td width="129"><input name="textfield2" type="text" size="22" disabled="disabled" value="<?php echo $fecha?>"/></td>
            <td width="10">&nbsp;</td>
            <td width="11">&nbsp;</td>
            <td width="436"><div align="right" class="text_combo_select"><strong>USUARIO :</strong> <img src="../../../images/user.gif" width="15" height="16" /> <?php echo $user?></div></td>
          </tr>
        </table>
          
          <table width="954" border="0">
            <tr>
              <td width="75">LOCAL</td>
              <td width="201"><?php generaSelect(); ?></td>
              <td width="61"><div align="right">VENDEDOR</div></td>
              <td width="449"><select disabled="disabled" name="vendedor" id="vendedor" onchange="cargarContenido()">
                  <option value="0">Seleccione un Vendedor</option>
                </select>              </td>
			  <td width="146"><div align="right"><span class="text_combo_select"><strong>LOCAL:</strong> <?php echo $nombre_local?></span> </div></td>
            </tr>
          </table>
          <table width="954" border="0">
            <tr>
              <td width="76">REFERENCIA</td>
              <td width="868"><input name="referencia" type="text" id="referencia" size="140" onkeyup="cargarContenido()" value="<?php echo $refere;?>"/></td>
            </tr>
          </table>
          <div align="center"><img src="../../../images/line2.png" width="950" height="4" /></div>
          <table width="954" border="0">
            <tr>
              <td width="948">
			  <iframe src="transferencia2_sal.php" name="iFrame1" width="954" height="98" scrolling="Automatic" frameborder="0" id="iFrame1" allowtransparency="0">
			</iframe>
			  </td>
            </tr>
        </table>
		  <div align="center"><img src="../../../images/line2.png" width="950" height="4" /></div>
          <table width="962" border="0">
            <tr>
              <td width="955">
			  <iframe src="transferencia3_sal.php" name="iFrame2" width="954" height="308" scrolling="Automatic" frameborder="0" id="iFrame2" allowtransparency="0"> </iframe></td>
            </tr>
        </table>
		  <div align="center"><img src="../../../images/line2.png" width="950" height="4" />          </div>
		  <table width="955" border="0" align="center">
            <tr>
              <td width="72"><div align="right"></div></td>
              <td width="130">&nbsp;</td>
              <td width="49"><div align="right"></div></td>
              <td width="130">&nbsp;</td>
              <td width="49"><div align="right"></div></td>
              <td width="80">&nbsp;</td>
              <td width="125"><div align="right">PRECIO PROMEDIO </div></td>
              <td width="113">
			    <div align="right">
			      <input name="mont1" class="sub_totales" type="text" id="mont1" onclick="blur()" size="10" value="<?php if ($count > 0){?> <?php echo $sum1?> <?php }else{?>0.00<?php }?>"/>
	          </div></td>
              <td width="57"><div align="right">TOTAL</div></td>
              <td width="108">
			    <div align="right">
			      <input name="mont2" class="sub_totales" type="text" id="mont2" onclick="blur()" size="10" value="<?php if ($count > 0){?> <?php echo $sum2?> <?php }else{?>0.00<?php }?>"/>
	          </div></td>
            </tr>
        </table>
		  <div align="center"><img src="../../../images/line2.png" width="950" height="4" /> </div>
		  <br>
		  <div class="botones">
            <table width="932" border="0">
              <tr>
                <td width="302"><div align="center">
                  <input name="first" type="button" id="first" value="Primero" class="primero" disabled="disabled"/>
				  <input name="prev" type="button" id="prev" value="Anterior" class="anterior" disabled="disabled"/>
                  <input name="next" type="button" id="next" value="Siguiente" class="siguiente" disabled="disabled"/>
                  <input name="fin" type="button" id="fin" value="Ultimo" class="ultimo" disabled="disabled"/>
                </div></td>
                <td width="10">&nbsp;</td>
                <td width="606"><label>
                    <div align="right">
                      <input name="printer" type="button" id="printer" value="Imprimir" class="imprimir" onclick="imprimir()"/>
                      <input name="nuevo" type="button" id="nuevo" value="Nuevo" class="nuevo" disabled="disabled"/>
                      <input name="modif" type="button" id="modif" value="Modificar" class="modificar" disabled="disabled"/>
                      <input name="cod" type="hidden" id="cod" value="<?php echo $invnum?>" />
                      <input name="sum33" type="hidden" id="sum33" value="<?php echo $sum33?>" />
                      <input name="save" type="button" id="save" value="Grabar" onclick="grabar1()" class="grabar" <?php if (($count == 0)||($count1>0)){?>disabled="disabled" <?php }?>/>
                      <input name="ext" type="button" id="ext" value="Cancelar" onclick="cancelar()" class="cancelar"/>
                    </div>
                </label></td>
              </tr>
            </table>
      </div></td>
    </tr>
  </table>
</form>
</body>
</html>
