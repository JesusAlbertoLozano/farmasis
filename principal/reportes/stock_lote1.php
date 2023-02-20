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
<?php require_once('../../conexion.php');	//CONEXION A BASE DE DATOS?>
<?php require_once("../../funciones/calendar.php");?>
<?php require_once("../../funciones/functions.php");	//DESHABILITA TECLAS?>
<?php require_once("../../funciones/funct_principal.php");	//IMPRIMIR-NUMEROS ENTEROS-DECIMALES?>
<?php require_once("../../funciones/botones.php");	//COLORES DE LOS BOTONES?>
<?php require_once("local.php");	//OBTENGO EL NOMBRE Y CODIGO DEL LOCAL?>
<script language="JavaScript">
function validar()
{
	  var f = document.form1;
	  if (f.desc.value == "")
	  { alert("Ingrese una Descripcion"); f.desc.focus(); return; }
	  var tip = document.form1.report.value;
	  f.action = "stock_lote1.php";
	  f.submit();
}
function validar2()
{
	  var f = document.form1;
          
//	  var tip = document.form1.report.value;
	  f.action = "stock_lote1.php";
	  f.submit();
}
function sf(){
  var f = document.form1;
  document.form1.desc.focus();
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
$val   = $_REQUEST['val'];
$desc  = $_REQUEST['desc'];
$tipo  = $_REQUEST['tipo'];
$report= $_REQUEST['report'];
$local = $_REQUEST['local'];
$sql="SELECT export FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
  while ($row = mysqli_fetch_array($result)){
    $export    = $row['export'];
  }
}
?>
<body onload="sf();">
<table width="954" border="0">
    <tr>
      <td><b><u>REPORTE DE STOCKS POR LOTES </u></b>
	    <form id="form1" name="form1" method = "post" action="">
        <table width="927" border="0">
          <tr>
            <td width="119">SALIDA</td>
            <td width="172">
              <select name="report" id="report">
                <option value="1">POR PANTALLA</option>
                <?php if ($export == 1){?>
                <option value="2">EN ARCHIVO XLS</option>
				<?php }?>
              </select>            </td>
			<td width="58"><div align="right">LOCAL</div></td>
			<td width="404">
			<select name="local" id="local" <?php if ($nombre_local <> 'LOCAL0'){?> disabled="disabled"<?php }?>>
              <?php 
                if ($nombre_local == 'LOCAL0') {
                  echo '<option value="all">TODOS</option>';
                }
                $sql = "SELECT * FROM xcompa"; 
                $result = mysqli_query($conexion,$sql); 
                while ($row = mysqli_fetch_array($result)){ 
                  $loc	= $row['codloc'];
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
                  ?>
              <option value="<?php echo $row['codloc'];?>" <?php if ($local == $row['codloc']) echo 'selected' ?>><?php echo $locals ?></option>
              <?php } ?>
            </select>
			</td>
                        <td width="24"><input type="button" name="Submit2" value="TODOS LOS PRODUCTOS" onclick="validar2()" class="buscar" /></td>
			<td width="24">&nbsp;</td>
			<td width="24">&nbsp;</td>
			<td width="24">&nbsp;</td>
                        
          </tr>
        </table>
        <div align="left"><img src="../../images/line2.png" width="940" height="4" /></div>
        <div align="left"><img src="../../images/line2.png" width="940" height="4" /></div>
	    <table width="928" border="0">
          <tr>
            <td width="119">TIPO DE BUSQUEDA </td>
            <td width="122">
		<select name="tipo" id="tipo">
                    <option value="0" <?php if ($tipo == 0){?> selected="selected"<?php }?>>SELECCIONE TODOS</option>
                    <option value="1" <?php if ($tipo == 1){?> selected="selected"<?php }?>>POR PRODUCTO</option>
                    <option value="2" <?php if ($tipo == 2){?> selected="selected"<?php }?>>POR MARCA</option>
                </select>
			</td>
            <td width="107"><div align="right">DESCRIPCION</div></td>
            <td width="340"><label>
              <input name="desc" type="text" value="<?php echo $desc?>" id="desc" size="60" onKeyUp="this.value = this.value.toUpperCase();" <?php if ($nombre_local <> 'LOCAL0'){?> disabled="disabled"<?php }?>/>
            </label></td>
            <td width="218">
              <input type="button" name="Submit2" value="Buscar" onclick="validar()" class="buscar" <?php if ($nombre_local <> 'LOCAL0'){?> disabled="disabled"<?php }if ($nombre_local <> 'LOCAL0'){?> disabled="disabled"<?php }?>/>
              <input type="button" name="Submit222" value="Imprimir" onclick="printer()" class="imprimir" <?php if ($nombre_local <> 'LOCAL0'){?> disabled="disabled"<?php }?>/>
            <input type="button" name="Submit3" value="Salir" onclick="salir()" class="salir"/></td>
          </tr>
        </table>
	  </form>
      <div align="left"><img src="../../images/line2.png" width="940" height="4" /></div></td>
    </tr>
  </table>
  <br>
  <?php if ($report == 2)
  {
  ?>
  <iframe src="stock_lote2.php?val=<?php echo $report?>&desc=<?php echo $desc?>&local=<?php echo $local?>&tipo=<?php echo $tipo?>" name="marco" id="marco" width="954" height="430" scrolling="Automatic" frameborder="0" allowtransparency="0">
  </iframe>
  <?php } elseif ($report == 1) {
  ?>
  <iframe src="stock_lote_prog.php?val=<?php echo $report?>&desc=<?php echo $desc?>&local=<?php echo $local?>&tipo=<?php echo $tipo?>" name="marco" id="marco" width="954" height="430" scrolling="Automatic" frameborder="0" allowtransparency="0">
  </iframe>
  <?php
  }
  ?>
</body>
</html>
