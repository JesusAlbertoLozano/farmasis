<?php include('../session_user.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/tablas.css" rel="stylesheet" type="text/css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/autocomplete.css" rel="stylesheet" type="text/css" />
<link href="../../css/calendar/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../funciones/js/mootools.js"></script>
<script type="text/javascript" src="../../funciones/js/calendar.js"></script>
<script type="text/javascript">
    window.addEvent('domready', function() { myCal = new Calendar({ date1: 'Y-m-d' }); myCal = new Calendar({ date2: 'Y-m-d' }); });
</script>
<?php require_once('../../conexion.php');	//CONEXION A BASE DE DATOS?>
<?php require_once("../../funciones/calendar.php");?>
<?php require_once("../../funciones/functions.php");	//DESHABILITA TECLAS?>
<?php require_once("../../funciones/funct_principal.php");	//IMPRIMIR-NUMEROS ENTEROS-DECIMALES?>
<?php require_once("../../funciones/botones.php");	//COLORES DE LOS BOTONES?>
<script type="text/javascript" src="../../funciones/ajax.js"></script>
<script type="text/javascript" src="../../funciones/ajax-dynamic-list1.js"></script>
<script language="JavaScript">
function validar()
{
	  var f = document.form1;
	  if (f.desc.value == "")
	  { alert("Ingrese el Numero del Documento"); f.desc.focus(); return; }
	  var tip = document.form1.report.value;
	  if (tip ==1)
	  {
	  f.action = "proboni1.php";
	  }
	  else
	  {
	  f.action = "proboni_prog.php";
	  }
	  f.submit();
}
function validar1()
{
	  var f = document.form1;
	  var tip = document.form1.report.value;
	  if (tip ==1)
	  {
	  f.action = "proboni1.php";
	  }
	  else
	  {
	  f.action = "proboni_prog.php";
	  }
	  f.submit();
}
function salir()
{
	 var f = document.form1;
	 f.method = "POST";
	 f.target = "_top";
	 f.action ="../index.php";
	 f.submit();
}
function printer()
{
window.marco.print();
}
</script>
</head>
<?php 
//$hour   = date('G');
//$date	= CalculaFechaHora($hour);
$date = date("Y-m-d");
$val   			= $_REQUEST['val'];
$country		= $_REQUEST['country'];
$report			= $_REQUEST['report'];
$sql="SELECT export FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$export    = $row['export'];
}
}
////////////////////////////
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
?>
<script language="javascript" type="text/javascript">  
function st()
{
    var f = document.form1;
    f.country.focus();
}
</script>
<body onload="st();">
<link rel='STYLESHEET' type='text/css' href='../../css/calendar.css'>
 <table width="954" border="0">
    <tr>
      <td><b><u>REPORTE DE PRODUCTOS BONIFICADOS </u></b>
        <form id="form1" name="form1" method = "post"><table width="927" border="0">
          <tr>
            <td width="119">SALIDA</td>
            <td width="172">
              <select name="report" id="report">
                <option value="1">POR PANTALLA</option>
                <?php if ($export == 1){?>
                <option value="2">EN ARCHIVO XLS</option>
				<?php }?>
              </select>            </td>
			<td width="58">&nbsp;</td>
			<td width="504">&nbsp;</td>
          </tr>
        </table>
        <div align="left"><img src="../../images/line2.png" width="940" height="4" /></div>
        <table width="928" border="0">
          <tr>
<!--            <td width="119">MARCA</td>-->
            <td>
<!--			<input name="country" type="text" id="country" size="90" class="busk" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)" size="100" onclick="this.value=''"  value="<?php echo $country?>"/>-->
			<input name="val" type="hidden" id="val" value="1" />
            <input type="button" name="Submit2" value="Buscar" onclick="validar1()" class="buscar"/>
            <input type="button" name="Submit222" value="Imprimir" onclick="printer()" class="imprimir"/>
            <input type="button" name="Submit3" value="Salir" onclick="salir()" class="salir"/>
            </td>
          </tr>
        </table>
	    </form>
      <div align="left"><img src="../../images/line2.png" width="940" height="4" /></div></td>
    </tr>
  </table>
  <br>
  <?php if ($val == 1)
  {
  ?>
  <iframe src="proboni2.php?val=<?php echo $val?>&country=<?php echo $country?>&inicio=<?php echo $inicio?>&registros=<?php echo $registros?>&pagina=<?php echo $pagina?>" name="marco" id="marco" width="958" height="430" scrolling="Automatic" frameborder="0" allowtransparency="0">
  </iframe>
  <?php }
  ?>
</body>
</html>
