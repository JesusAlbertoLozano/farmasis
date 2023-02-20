<?php include('../../session_user.php');
$total_paginas = 0;
$pagina        = 0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href=".style.css" rel="stylesheet" type="text/css" />
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../../css/calendar/calendar.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="../../../funciones/js/mootools.js"></script>
<script type="text/javascript" src="../../../funciones/js/calendar.js"></script>





<script type="text/javascript">
    window.addEvent('domready', function() { myCal = new Calendar({ date1: 'd/m/Y' }); myCal = new Calendar({ date2: 'd/m/Y' }); });
</script>
<?php require_once('../../../conexion.php');	//CONEXION A BASE DE DATOS?>
<?php require_once('../../../convertfecha.php');	//CONEXION A BASE DE DATOS?>
<?php require_once("../../../funciones/calendar.php");?>
<?php require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS?>
<?php require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUMEROS ENTEROS-DECIMALES?>
<?php require_once("../../../funciones/botones.php");	//COLORES DE LOS BOTONES?>
<?php require_once("../../local.php");	//OBTENGO EL NOMBRE Y CODIGO DEL LOCAL?>
<script language="JavaScript">
function buscar()
{
	  var f = document.form1;
	  var tip = document.form1.report.value;
	  if (tip ==1)
	  {
	  f.action = "cli1.php";
	  }
	  else
	  {
	  f.action = "cli_prog.php";
	  }
	  f.submit();
}
function salir()
{
	 var f = document.form1;
	
	 window.close();
    
}
function selected()
{
	 var f = document.form1;
	 var l = document.form1.local.value;
	 if (l == "LOCAL0")
	 {
	 document.form1.local1.disabled = false;
	 }
	 else
	 {
	 document.form1.local1.disabled = true;
	 }
}
function sf()
{
	 var f = document.form1;
	 document.form1.local1.disabled = true;
}
function printer()
{
window.marco.print();
}
</script>
</head>
<?php $date  = date('d/m/Y');
$val   = isset($_REQUEST['val'])? ($_REQUEST['val']) : "";
$date1 = isset($_REQUEST['date1'])? ($_REQUEST['date1']) : "";
$date2 = isset($_REQUEST['date2'])? ($_REQUEST['date2']) : "";
$local = isset($_REQUEST['local'])? ($_REQUEST['local']) : "";
$marca = isset($_REQUEST['marca'])? ($_REQUEST['marca']) : "";
$det   = isset($_REQUEST['det'])? ($_REQUEST['det']) : "";
$doc   = isset($_REQUEST['doc']) ? ($_REQUEST['doc']) : "";
$ven   = isset($_REQUEST['ven']) ? ($_REQUEST['ven']) : "";
$doc  = $_REQUEST['doc'];

$sql="SELECT export FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$export    = $row['export'];
}
}
/////////////////////////////////
$registros = 3;
$pagina = isset($_REQUEST['pagina'])? ($_REQUEST['pagina']) : "";
if (!$pagina) {
$inicio = 0;
$pagina = 1;
}
else 
{
$inicio = ($pagina - 1) * $registros;
} 

?>
<body>
<link rel='STYLESHEET' type='text/css' href='../../css/calendar.css'>
 <table width="954" border="0">
    <tr>
      <td><b><u>LISTA DE CLIENTE </u></b>
        <form id="form1" name="form1" method = "post" action="">
          <table width="927" border="0">
            <tr>
              <td width="3">SALIDA</td>
              <td width="80"><label>
                <select name="report" id="report">
                  <option value="1">POR PANTALLA</option>
                  <?php if ($export == 1){?>
                  <option value="2">EN ARCHIVO XLS</option>
				  <?php }?>
                </select>
              </label></td>
              
             
          <td width="217">
                  <input name="val" type="hidden" id="val" value="1" />
              <input type="button" name="Submit" value="Buscar" class="buscar" onclick="buscar()"/>
             
             <!-- <input type="button" name="Submit2" value="Salir" onclick="window.close();" class="salir"/>			-->
              </td>

            <td width="50"><div align="right"></div></td>
         
            </tr>
          </table>
            
           

          <table width="929" border="0">
            <tr>

            
              
             
              
			  <td width="18"><?php if(($pagina - 1) > 0) 
			  {
			  ?>
                <a href="../marcas1.php?val=<?php echo $val?>&amp;&amp;tipo=<?php echo $tipo?>&amp;&amp;tipo1=<?php echo $tipo1?>&amp;&amp;ltdgen=<?php echo $ltdgen?>&amp;&amp;local=<?php echo $local?>&amp;&amp;inicio=<?php echo $inicio?>&amp;&amp;registros=<?php echo $registros?>&amp;&amp;pagina=<?php echo $pagina-1?>&amp;&amp;marca=<?php echo $marca?>"> <img src="../../images/play1.gif" width="16" height="16" border="0"/> </a>
                <?php }
			  ?></td>
			  <td width="23"><?php if(($pagina + 1)<=$total_paginas) 
			  {
			  ?>
                <a href="../marcas1.php?val=<?php echo $val?>&amp;&amp;tipo=<?php echo $tipo?>&amp;&amp;tipo1=<?php echo $tipo1?>&amp;&amp;ltdgen=<?php echo $ltdgen?>&amp;&amp;local=<?php echo $local?>&amp;&amp;inicio=<?php echo $inicio?>&amp;&amp;registros=<?php echo $registros?>&amp;&amp;pagina=<?php echo $pagina+1?>&amp;&amp;marca=<?php echo $marca?>"> <img src="../../images/play.gif" width="16" height="16" border="0"/> </a>
                <?php }
			  ?></td>
            </tr>
          </table>
        </form>
      <div align="center"><img src="../../../images/line2.png" width="1000" height="4" /></div></td>
    </tr>
  </table>
  <br>
  <?php if ($val == 1)
  {
  ?>
      <iframe src="cli2.php?val=<?php echo $val?>&date1=<?php echo $date1?>&date2=<?php echo $date2?>&local=<?php echo $local?>&det=<?php echo $det?>&ltdgen=<?php echo $ltdgen?>&amp;&amp;marca=<?php echo $marca?>&doc=<?php echo $doc?>&ven=<?php echo $ven?>" name="marco" id="marco" width="1200" height="730" scrolling="Automatic" frameborder="0" allowtransparency="0">
  </iframe>
  <?php }
  ?>
</body>
</html>
