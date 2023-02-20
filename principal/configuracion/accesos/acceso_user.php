<?php include('../../session_user.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
<?php require_once ('../../../conexion.php');
require_once("../../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../../funciones/funct_principal.php");	//DESHABILITA TECLAS
require_once("../../../funciones/botones.php");	//COLORES DE LOS BOTONES
require_once("ajax_user.php");
?>
<script language="JavaScript">
function graba()
{
    var f  = document.form1;
    if (f.nombre.value == "")
    { alert("Ingrese el Nombre del Usuario"); f.nombre.focus(); return; }
    if (f.login.value == "")
    { alert("Ingrese el Login del Usuario"); f.login.focus(); return; }
    if (f.codigo.value == "")
    { alert("Ingrese el Codigo de acceso"); f.codigo.focus(); return; }
    if (f.claveventa.value == "")
    { alert("Ingrese el Codigo de Venta del Usuario"); f.claveventa.focus(); return; }
    f.method = "post";
    f.action ="acceso_user1.php";
    f.submit();
}
function sf(){
document.form1.nombre.focus();
}
</script>
<style type="text/css">
<!--
.Estilo1 {color: #0066CC}
-->
</style>
</head>
<?php 
$codgrup = $_REQUEST['codgrup'];
$error = $_REQUEST['error'];
$ok = $_REQUEST['ok'];
$val = $_REQUEST['val'];
$sql="SELECT nomgrup FROM grupo_user where codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	   $nomgrup       = $row['nomgrup'];
}
}

$sql="SELECT nlicencia FROM datagen ";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	   $nlicencia       = $row['nlicencia'];
}
}
?>
<body onload="sf();">
<table width="584" border="0" align="center">
  <tr>
    <td width="578">
	<span class="text_combo_select"><strong> REGISTRO DE USUARIOS DEL SISTEMA - <?php echo $nomgrup?></strong></span>
	<img src="../../../images/line2.jpg" width="570" height="4" />
	</td>
  </tr>
</table>
<?php if ($val == 1)
{
?>
<table width="584" border="0" align="center" class="tabla2">
  <tr>
    <td><span class="Estilo1">
      <?php if ($ok == 1)
	{
	echo "SE LOGRO REGISTRAR SATISFACTORIAMENTE UN USUARIO";
	}
	if ($error == 1)
	{
	echo "NO SE PUDO REGISTRAR EL USUARIO, ESTE YA SE ENCUENTRA REGISTRADO EN EL SISTEMA";
	}
	?>
    </span> </td>
  </tr>
</table>
<?php }
?>
<table width="584" border="0" align="center" class="tabla2">
  <tr>
    <td>
	<form id="form1" name="form1" onClick="highlight(event)" onKeyUp="highlight(event)">
      <table width="552" border="0" align="center">
        <tr>
          <td width="148">GRUPO DE USUARIO </td>
          <td width="394"><b><?php echo $nomgrup?></b></td>
        </tr>
        <tr>
          <td>NOMBRE</td>
          <td>
            <input name="nombre" type="text" id="nombre" size="70" onkeyup="cargarContenido()"/>          </td>
        </tr>
        <tr>
          <td>ABREVIATURA</td>
          <td><div id="contenedor"></div></td>
        </tr>
        <tr>
          <td>USUARIO</td>
          <td>
            <input name="login" type="text" id="login" size="60" />          </td>
        </tr>
        <tr>
          <td>CONTRASE�A </td>
          <td><input name="codigo" type="password" id="codigo" size="40" onkeypress="return acceptNum(event)"/></td>
        </tr>
        <tr>
          <td>CONTRASE�A DE VENTA </td>
          <td>c<input name="claveventa" type="password" id="claveventa" maxlength="10" size="20" onkeypress="return acceptNum(event)"/></td>
        </tr>
        <tr>
      <td>REPORTES A EXCEL </td>
      <td><label>
        <select name="excel" id="excel">
          <option value="1" <?php if ($export == 1){?>selected="selected"<?php }?>>SI</option>
          <option value="0" <?php if ($export == 0){?>selected="selected"<?php }?>>NO</option>
        </select>
      </label></td>
    </tr>
        <tr>
          <td>LOCAL</td>
          <td>
		  <select name="local" id="local">
            <?php $sql = "SELECT codloc, nomloc, nomloc from xcompa where habil = '1' order by codloc ASC LIMIT $nlicencia"; 
				$result = mysqli_query($conexion,$sql); 
				if (mysqli_num_rows($result)){
				while ($row = mysqli_fetch_array($result)){ 
				?>
            <option value="<?php echo $row[0];?>"><?php if ($row[2]<>""){ echo $row[2];} else{echo $row[1];} ?></option>
            	<?php }
				}
				else
				{
				?>
            <option value="0">NO EXISTEN LOCALES REGISTRADAS</option>
            	<?php }
			  ?>
          </select>
		  <input name="grup" type="hidden" id="grup" value="<?php echo $codgrup?>" />
          <input type="button" name="Submit" value="Grabar" class="grabar" onclick="graba()"/></td>
        </tr>
        
        
      </table>
      </form>
    </td>
  </tr>
</table>
<table width="584" border="0" align="center">
  <tr>
    <td width="578"><span class="text_combo_select"><strong> LISTADO DE USUARIOS - <?php echo $nomgrup?></strong></span><img src="../../../images/line2.jpg" width="570" height="4" />
	</td>
  </tr>
</table>
<table width="584" border="0" align="center" class="tabla2">
  <tr>
    <td>
	<center>
	<iframe src="acceso_user_listado.php?codgrup=<?php echo $codgrup?>" name="iFrame1" width="566" height="340" scrolling="Automatic" frameborder="No" id="iFrame1" allowtransparency="True">
	</iframe>
	</center>
	</td>
  </tr>
</table>
</body>
</html>
