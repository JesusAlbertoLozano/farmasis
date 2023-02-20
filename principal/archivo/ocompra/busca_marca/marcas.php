<?php include('../../../session_user.php');
$ord_compra   = $_SESSION['ord_compra'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../css/style1.css" rel="stylesheet" type="text/css" />
<link href="../css/tabla2.css" rel="stylesheet" type="text/css" />
<link href="../../../../css/autocomplete.css" rel="stylesheet" type="text/css" />
<?php require_once('../../../../conexion.php');	//CONEXION A BASE DE DATOS
require_once("../../../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
//require_once("../../../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../../../funciones/botones.php");	//COLORES DE LOS BOTONES
require_once("../../../../funciones/funct_principal.php");	//IMPRIMIR-NUME
require_once("../funciones/compra.php");	//IMPRIMIR-NUME
require_once("../../../local.php");	//LOCAL DEL USUARIO
$sql="SELECT nomusu FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
		$user    = $row['nomusu'];
}
}
$val = $_REQUEST['val'];
?>
<style type="text/css">
<!--
.Estilo1 {color: #FF0000}
.Estilo2 {color: #0066CC}
.Estilo3 {color: #009900}
.Estilo4 {color: #0066CC; font-weight: bold; }
.Estilo5 {	color: #666666;
	font-weight: bold;
}
-->
</style>
<script type="text/javascript" src="../../../../funciones/ajax.js"></script>
<script type="text/javascript" src="../../../../funciones/ajax-dynamic-list.js"></script>
<script>
function agregar()
{
	var f = document.form1;
	if (document.form1.country.value == "")
	{
	alert("Ingrese el nombre de la Marca"); f.country.focus(); return;
	}
	f.action = 'add_marca1.php';
	f.target = 'compra_index';
	f.val.value = 1;
	f.submit();
}
function problab()
{
	var f = document.form1;
	f.action = 'marcas.php';
	f.val.value = 2;
	f.submit();
}
function alllab()
{
	var f = document.form1;
	f.action = 'marcas.php';
	f.val.value = 3;
	f.submit();
}
</script>
</head>
<body onload="barra()">
<form name="form1" id="form1" onClick="highlight(event)" onKeyUp="highlight(event)" method = "post">
  <table width="913" border="0" align="center">
    <tr>
      <td width="940"><table width="887" border="0" align="center">
        <tr>
          <td width="69"><span class="Estilo5">MARCA</span></td>
          <td width="436">
		  <input name="country" type="text" id="country" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)" size="80" onclick="this.value=''"/>
          <input name="val" type="hidden" id="val" value="" />
          <input type="hidden" id="country_hidden" name="country_ID" />
		  </td>
          <td width="368" valign="top">
		  <input name="search" type="button" id="search" value="Agregar" onclick="agregar()"/> 
		  <input name="search" type="button" id="search" value="Proveedor - Laboratorio" onclick="problab()"/>	          
		  <input name="search" type="button" id="search" value="Todos los Laboratorio" onclick="alllab()"/>
		  </td>
        </tr>
      </table>
      <table width="887" border="0" align="center">
          <tr>
            <td width="64"><span class="Estilo5">NUMERO</span></td>
            <td width="743"><span class="Estilo5">MARCA</span></td>
            <td width="66"><div align="left"><span class="Estilo5">AGREGAR </span></div></td>
          </tr>
        </table>
        <div align="center"><img src="../../../../images/j_border.png" width="900" height="1" /> </div>
        <center>
		<iframe src="marcas1.php?val=<?php echo $val?>" name="marcas" width="915" height="450" scrolling="Automatic" frameborder="0" id="marcas" allowtransparency="0">
		</iframe>
		</center>
	  </td>
    </tr>
  </table>
</form>
</body>
</html>
