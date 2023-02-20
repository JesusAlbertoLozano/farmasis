<?php require_once('../../../conexion.php');	//CONEXION A BASE DE DATOS
include('../../session_user.php');
include('../../local.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="css/style1.css" rel="stylesheet" type="text/css" />
<link href="css/tabla2.css" rel="stylesheet" type="text/css" />
<?php require_once("../../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
require_once("../../../funciones/botones.php");	//COLORES DE LOS BOTONES
require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUME
?>
<script>
function sf()
{
var f = document.form1;
f.text.focus();
}
function salir()
{
	 var f = document.form1;
	 f.method = "POST";
	 f.target = "_top";
	 f.action ="../../index.php";
	 f.submit();
}
function buscar()
{
	 var f = document.form1;
	 f.method = "post";
	 f.action ="index1.php";
	 f.submit();
}
function save()
{
	 var f = document.form1;
	 f.method = "post";
	 f.action ="index2.php";
	 f.submit();
}
</script>
<style>
select { width:210px; }
</style>
<?php $srch  = $_REQUEST['srch'];
$local = $_REQUEST['local'];
if ($srch == 1)
{
$sql1="SELECT nombre,imprapida,habil FROM xcompa where codloc = '$local'";
$result1 = mysqli_query($conexion,$sql1);
if (mysqli_num_rows($result1)){	
while ($row1 = mysqli_fetch_array($result1)){
	$nombre  = $row1['nombre'];	
	$imprapida  = $row1['imprapida'];
	$habil      = $row1['habil'];	
}
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
</head>
<body <?php if ($srch == 1){?>onload="sf();"<?php }?>>
<div align="left"><img src="../../../images/line2.png" width="500" height="4" /></div>
<?php if ($desc  <> ''){?>
<font color="<?php echo $color?>"><?php echo $desc;?></font>
<br />
<?php }?>
<form name="form1" id="form1" onClick="highlight(event)" onKeyUp="highlight(event)">
  <table width="507" border="0">
    <tr>
      <td width="501"><table width="478" border="0">
        <tr>
          <td width="69"><strong>Local </strong></td>
          <td width="216">
		  <select name="local" id="local" >
              <?php $sql = "SELECT codloc,nomloc,nombre FROM xcompa order by codloc ASC LIMIT $nlicencia"; 
				$result = mysqli_query($conexion,$sql); 
				if (mysqli_num_rows($result)){
				while ($row = mysqli_fetch_array($result)){ 
			?>
              <option value="<?php echo $row[0];?>" <?php if ($local == $row[0]){?>selected="selected"<?php }?>>
			  <?php if($row[2]<>''){ echo $row[2];}else{echo $row[1];} ?></option>
              <?php }
				}
				else
				{
			?>
              <option value="0">NO EXISTEN LOCALES REGISTRADOS</option>
              <?php }
			?>
            </select>          </td>
          <td width="179">
		  <div align="right">
              <input name="srch" type="hidden" id="srch" value="1" />
              <input name="exit" type="button" id="exit" value="Buscar" onclick="buscar()" class="salir"/>
              <input name="exit" type="button" id="exit" value="Salir" onclick="salir()" class="salir"/>
          </div></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <table width="507" border="0">
  <tr>
    <td width="501"><table width="478" border="0">
      <tr>
        <td width="69"><strong>Nombre </strong></td>
        <td width="216">
          <input name="text" type="text" id="text" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $nombre?>" size="40" maxlength="10" <?php if ($srch == ''){?>disabled="disabled"<?php }?>/>
        </td>
        <td width="179">
		<div align="right">
          <input name="codloc" type="hidden" id="codloc" value="<?php echo $local?>" />
          <input name="grab" type="button" value="Grabar" onclick="save()" class="salir" <?php if ($srch == ''){?>disabled="disabled"<?php }?>/>
        </div></td>
      </tr>
    </table>
      <table width="478" border="0">
        <tr>
          <td><strong>Habilitado</strong></td>
          <td><input name="habil" type="checkbox" id="habil" value="1" <?php if ($habil == 1){?>checked="checked"<?php }?>/>
            Si</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="111"><strong>Impresi&oacute;n R&aacute;pida </strong></td>
          <td width="174"><input name="imprapida" type="checkbox" id="imprapida" value="1" <?php if ($imprapida == 1){?>checked="checked"<?php }?>/>
Si</td>
          <td width="179">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
  <div align="left"><img src="../../../images/line2.png" width="500" height="4" /></div>
</form>
</body>
</html>
