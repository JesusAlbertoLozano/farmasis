<?php include('../../session_user.php');
$ord_compra   = $_SESSION['ord_compra'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="css/style1.css" rel="stylesheet" type="text/css" />
<link href="css/tabla2.css" rel="stylesheet" type="text/css" />
<?php require_once('../../../conexion.php');	//CONEXION A BASE DE DATOS
require_once("../../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
//require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../../funciones/botones.php");	//COLORES DE LOS BOTONES
require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUME
require_once("funciones/compra.php");	//IMPRIMIR-NUME
require_once("../../local.php");	//LOCAL DEL USUARIO
$sql="SELECT nomusu FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
		$user    = $row['nomusu'];
}
}
$codpro = $_REQUEST['codpro'];
$val    = $_REQUEST['val'];
$cr     = $_REQUEST['cr'];
?>
<style type="text/css">
<!--
.Estilo8 {color: #666666; font-weight: bold; }
-->
</style>
</head>
<body>
<form name="form1" id="form1" onClick="highlight(event)" onKeyUp="highlight(event)">
  <table width="911" border="0">
    <tr>
      <td width="236"><span class="Estilo8">PRODUCTO</span></td>
      <td width="54"><span class="Estilo8">CODPROD</span></td>
      <td width="81"><div align="right" class="Estilo8">PRECIO</div></td>
      <td width="53"><div align="right" class="Estilo8">DTO1</div></td>
      <td width="58"><div align="right" class="Estilo8">DTO2</div></td>
      <td width="59"><div align="right" class="Estilo8">DTO3</div></td>
      <td width="63"><div align="right" class="Estilo8">TOT DTO </div></td>
      <td width="63"><div align="right" class="Estilo8">PEDIDO</div></td>
	  <td width="52"><div align="right" class="Estilo8">BONIF</div></td>
	  <td width="52"><div align="right" class="Estilo8">P. FINAL</div></td>
      <td width="82"><div align="right" class="Estilo8">MONTO NETO </div></td>
      <td width="12">&nbsp;</td>
    </tr>
  </table>

    <table width="946" border="0" class="tabla2">
      <tr>
        <td><center>
            <iframe src="productos1.php?codpro=<?php echo $codpro?>&val=<?php echo $val?>&cr=<?php echo $cr?>" name="productos" width="945" height="245" scrolling="Automatic" frameborder="0" id="productos" allowtransparency="0"> </iframe>
        </center></td>
      </tr>
    </table>
    <table width="947" border="0" class="tabla2">
      <tr>
        <td><center>
            <iframe src="montos.php" name="productos" width="945" height="45" scrolling="No" frameborder="0" id="productos" allowtransparency="0"> </iframe>
        </center></td>
      </tr>
    </table>
  <table width="947" border="0">
    <tr>
      <td width="705">
	  <table width="695" border="0" class="tabla2">
        <tr>
          <td>
		  <b>ESTADISTICAS DE VENTAS</b>
		  <iframe src="sucursal.php?codpro=<?php echo $codpro?>" name="sucursal" width="690" height="80" scrolling="Automatic" frameborder="0" id="sucursal" allowtransparency="0"> </iframe></td>
        </tr>
      </table>
	  <table width="695" border="0" class="tabla2">
        <tr>
          <td>
		  <b>VENTAS FALLIDAS POR FALTA DE STOCK</b>
		  <iframe src="ventas_fallidas.php?codpro=<?php echo $codpro?>" name="sucursal1" width="690" height="70" scrolling="Automatic" frameborder="0" id="sucursal1" allowtransparency="0"> </iframe></td>
        </tr>
      </table>
	  </td>
      <td width="224">
	  <table width="222" border="0" class="tabla2">
        <tr>
          <td><iframe src="ult_compra.php?codpro=<?php echo $codpro?>" name="ultimas" width="215" height="180" scrolling="Automatic" frameborder="0" id="ultimas" allowtransparency="0"> </iframe></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>
