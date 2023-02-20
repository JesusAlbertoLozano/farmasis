<?php include('../../session_user.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<?php require_once ('../../../conexion.php');
require_once("../../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../../funciones/botones.php");	//COLORES DE LOS BOTONES
$codgrup = $_REQUEST['codgrup'];
$usecod  = $_REQUEST['usecod'];
$sql="SELECT nomusu,logusu,pasusu,codgrup,export,codloc,claveventa FROM usuario where usecod = '$usecod'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	   $nomusu       = $row['nomusu'];
	   $logusu       = $row['logusu'];
	   $pasusu       = $row['pasusu'];
	   $grupo        = $row['codgrup'];
	   $export       = $row['export'];
	   $codloc       = $row['codloc'];
           $claveventa   = $row['claveventa'];
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
<script language="JavaScript">
function grabar()
{
	  var f = document.form1;
	  if (f.clave.value === "")
	  { alert("Ingrese la Clave del Usuario"); f.clave.focus(); return; }
          if (f.claveventa.value === "")
          {
              alert("Ingrese la Clave de Venta del Usuario"); f.claveventa.focus(); return;
          }
	  f.action = "acceso_user_listado2.php";
	  f.method = "post";
	  f.submit();
}
</script>
</head>
<body>
<br><br>
<form id="form1" name="form1" onClick="highlight(event)" onKeyUp="highlight(event)">
  <table width="533" border="0" align="center">
    <tr>
      <td width="80">NOMBRE</td>
      <td width="443"><label>
        <input name="nom" type="text" id="nom" size="60"  onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $nomusu?>" disabled="disabled"/>
      </label></td>
    </tr>
    <tr>
      <td>LOGIN</td>
      <td><label>
        <input name="login" type="text" id="login" size="50" value="<?php echo $logusu?>" disabled="disabled"/>
      </label></td>
    </tr>
    <tr>
      <td>CONTRASE�A</td>
      <td><label>
        <input name="clave" type="password" onkeypress="return acceptNum(event)" id="clave" size="50" value="<?php echo $pasusu?>"/>
      </label></td>
    </tr>
    <tr>
      <td>CONTRASE�A DE VENTA</td>
      <td><label>
      c<input name="claveventa" type="password" onkeypress="return acceptNum(event)" id="claveventa" maxlength="10" size="20" value="<?php echo $claveventa?>"/>
      </label></td>
    </tr>
    <tr>
      <td>GRUPO</td>
      <td><select name="grupo" id="grupo">
          <?php 
				$sql = "SELECT codgrup,nomgrup FROM grupo_user order by nomgrup"; 
				$result = mysqli_query($conexion,$sql); 
				while ($row = mysqli_fetch_array($result)){ 
				$codgrup1	= $row["codgrup"];
				$nomgrup	= $row["nomgrup"];
				?>
          <option value="<?php echo $row["codgrup"];?>" <?php if ($grupo == $codgrup1){?> selected="selected"<?php }?>><?php echo $row["nomgrup"]; ?></option>
          <?php } ?>
      </select></td>
    </tr>
    <tr>
      <td>LOCAL</td>
      <td><label>
      <select name="local" id="local">
        <?php $sql = "SELECT codloc, nomloc from xcompa order by codloc ASC LIMIT $nlicencia"; 
				$result = mysqli_query($conexion,$sql); 
				if (mysqli_num_rows($result)){
				while ($row = mysqli_fetch_array($result)){ 
				?>
        <option <?php if ($codloc == $row[0]){?>selected="selected"<?php }?> value="<?php echo $row[0];?>"><?php echo $row[1]; ?></option>
        <?php }
				}
				else
				{
				?>
        <option value="0">NO EXISTEN LOCALES REGISTRADAS</option>
        <?php }
			  ?>
      </select>
      </label></td>
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
  </table>
  <table width="533" border="0" align="center">
    <tr>
      <td width="80">&nbsp;</td>
      <td width="443"><label>
        <input name="usecod" type="hidden" id="usecod" value="<?php echo $usecod?>" />
        <input name="codgrup" type="hidden" id="codgrup" value="<?php echo $codgrup?>" />
        <input type="button" name="Submit" value="Grabar Informacion" onclick="grabar()"/>
      </label></td>
    </tr>
  </table>
</form>
</body>
</html>
