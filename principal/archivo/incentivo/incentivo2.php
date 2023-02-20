<?php include('../../session_user.php');
require_once('../../../conexion.php');
require_once('../../../titulo_sist.php');
require_once('../../../convertfecha.php');	//CONEXION A BASE DE DATOS
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $desemp?></title>
<link href="../css/css/style1.css" rel="stylesheet" type="text/css" />
<link href="../css/css/tablas.css" rel="stylesheet" type="text/css" />
<link href="../../../css/calendar/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../../funciones/js/mootools.js"></script>
<script type="text/javascript" src="../../../funciones/js/calendar.js"></script>
<script type="text/javascript">
    window.addEvent('domready', function() { myCal = new Calendar({ date1: 'Y-m-d' }); myCal = new Calendar({ date2: 'Y-m-d' }); });
</script>
<?php require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUME
require_once("ajax_incentivo.php");	//FUNCIONES DE AJAX PARA COMPRAS Y SUMAR FECHAS
?>
<script>
function validar_prod()
{
var f = document.form1;
if (f.desc.value == "")
{ alert("Debe ingresar una Descripcion");f.desc.focus();return;}
if (f.date1.value == "")
{ alert("Debe ingresar una Fecha");f.date1.focus();return;}
if (f.date2.value == "")
{ alert("Debe ingresar una Fecha");f.date2.focus();return;}
if (f.estado.value == 0)
{ 
ventana=confirm("�Desea deshabilitar este Incentivo y sus registros?");
if (ventana) 
{
f.method = "post";
f.target = "principal";
f.action = "incentivo_activar.php";
f.submit();
}
else
{
return;
}
}
f.method = "post";
f.target = "principal";
f.action = "incentivo_activar.php";
f.submit();
}
function vvalida()
{
var f = document.form1;
if (f.desc.value == "")
{ alert("Debe ingresar una Descripcion");f.desc.focus();return;}
if (f.date1.value == "")
{ alert("Debe ingresar una Fecha");f.date1.focus();return;}
if (f.date2.value == "")
{ alert("Debe ingresar una Fecha");f.date2.focus();return;}
f.method = "post";
f.target = "principal";
f.action = "incentivo_activar1.php";
f.submit();
}
function eliminarIncentivo(invnum)
        {

  
            ventana = confirm("Desea eliminar este incentivo?");
            if (ventana) 
            {

                window.parent.parent.location.href="incentivoborrar.php?invnum=" + invnum;
            } else {
                return;
            }
            
        }
</script>
<script type="text/javascript" language="JavaScript1.2" src="/comercial/funciones/control.js"></script>
<style>
#boton { background:url('../../../images/save_16.png') no-repeat; border:none; width:16px; height:16px; }
#boton1 { background:url('../../../images/save_16.png') no-repeat; border:none; width:16px; height:16px; }
 a:link,
 a:visited {
 color: #0066CC;
 border: 0px solid #e7e7e7;
 }
 a:hover {
 background: #fff;
 border: 0px solid #ccc;
 }
 a:focus {
 background-color: #FFFF99;
 color: #0066CC;
 border: 0px solid #ccc;
 }
 a:active {
 background-color: #FFFF99;
 color: #0066CC;
 border: 0px solid #ccc;
 } 
</style>
</head>
<?php //require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUME
$sql="SELECT * FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$user    = $row['nomusu'];
}
}
$sql="SELECT count(*) FROM incentivado where estado = '1'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$countregx    = $row[0];
}
}
if ($countregx<>0)
{
	$sql="SELECT invnum FROM incentivado where estado = '1'";
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	while ($row = mysqli_fetch_array($result)){
		$invnumss    = $row[0];
	}
	}
}
function formato($c) {
printf("%08d",$c);
} 
$valform = $_REQUEST['valform'];
$invnums = $_REQUEST['invnum'];
$nn      = $_REQUEST['nn'];
?>
<body>
<form id="form1" name="form1" method = "post">
  <table width="930" border="0">
    <tr>
      <td width="123"><strong>INCENTIVO</strong></td>
	  <td width="295"><strong>DESCRIPCION</strong></td>
      <td width="160"><strong>FECHA DE INICIO </strong> </td>
	  <td width="190"><strong>FECHA DE FIN </strong> </td>
	  <td width="160"><strong>ESTADO </strong></td>
	  <td width="83"><div align="center"></div></td>
      <td width="15">&nbsp;</td>
	  <td width="17">&nbsp;</td>
	  <td width="17">&nbsp;</td>
    </tr>
  </table>
  <img src="../../../images/line2.png" width="930" height="4" />
  <?php if ($nn == 1)
  {
  ?>
  <table width="930" border="0">
    <tr onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#ffffff';">
      <td width="123"><label></label></td>
      <td width="295"><textarea name="desc" cols="50" rows="1" id="desc"></textarea>
      <input name="invnum2" type="hidden" id="invnum2" value="<?php echo $invnum?>" /></td>
      <td width="106"><input type="text" name="date1" id="date1" size="12" value="<?php echo date('Y-m-d')?>"/></td>
      <td width="106"><input type="text" name="date2" id="date2" size="12" value="<?php echo date('Y-m-d')?>"/></td>
      <td width="156"><div align="center">
        <select name="estado">
            <option value="1">HABILITADO</option>
            <option value="0">DESHABILITADO</option>
          </select>
      </div></td>
      <td width="97"><input id="vvv" type="button" value="Grabar" onclick="vvalida()"/>
      <a href="incentivo2.php"><img src="../../../images/icon-16-checkin.png" width="16" height="16" border="0"/></a></td>
      <td width="17"><a href="incentivo2.php"></a></td>
    </tr>
  </table> 
  <?php }
  ?>
  <?php 
  $sql="SELECT * FROM incentivado where esta_desa = 0 order by invnum desc";
  
  $result = mysqli_query($conexion,$sql);
  if (mysqli_num_rows($result)){
  ?>
  <table width="930" border="0">
    <?php while ($row = mysqli_fetch_array($result)){
	$invnum    = $row['invnum'];
	$dateini   = $row['dateini'];
	$datefin   = $row['datefin'];
	$estado    = $row['estado'];
	$descripcion    = $row['descripcion'];
	if ($estado == 1)
	{
	$desc = "HABILITADO";
	}
	else
	{
	$desc = "DESHABILITADO";
	}
	$sql1="SELECT count(*) FROM incentivadodet where invnum = '$invnum'";
	$result1 = mysqli_query($conexion,$sql1);
	if (mysqli_num_rows($result1)){
	while ($row1 = mysqli_fetch_array($result1)){
	$countt    = $row1[0];
	}
	}
	?>
    <tr onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#ffffff';">
      <td width="122">
	  <?php echo formato($invnum);?>      </td>
	  <td width="294">
	  <?php if ($invnum == $invnums){ ?>
        <textarea name="desc" cols="50" rows="1" id="desc"><?php echo $descripcion?></textarea>
		<input name="invnum" type="hidden" id="invnum" value="<?php echo $invnum?>" />
	  <?php }else{ echo $descripcion;}?>
	  </td>
      <td width="105">
      <?php if ($invnum == $invnums){ ?>
      <input type="text" name="date1" id="date1" size="12" value="<?php echo $dateini;?>"/><?php }else{ echo fecha($dateini);}?>
	  </td>
      <td width="105">
      <?php if ($invnum == $invnums){ ?>
      <input type="text" name="date2" id="date2" size="12" value="<?php echo $datefin;?>"/><?php }else{ echo fecha($datefin);}?></td>
      <td width="130">
	  <div align="center">
	  <?php if ($invnum == $invnums){ ?>
        <select name="estado">
          <option value="1" <?php if ($estado == 1){?>selected="selected"<?php }?>>HABILITADO</option>
          <option value="0" <?php if ($estado == 0){?>selected="selected"<?php }?>>DESHABILITADO</option>
        </select>
	  <?php }
	  else{ echo $desc;}
	  ?>
      </div></td>
      <td width="42"><div align="center"><?php echo $countt?> Reg.</div></td>
	  <td width="15"><a href="javascript:popUpWindow('incentivohist2.php?invnum=<?php echo $invnum?>', 400, 50, 680, 350)"><img src="../../../images/lens.gif" width="15" height="16" border="0" title="VER RELACION"/></a></td>
	  <td width="16"><a href="javascript:popUpWindow('incentivohist3.php?invnum=<?php echo $invnum?>', 400, 50, 780, 350)"><img src="../../../images/search.gif" width="16" height="16" border="0" title="RELACION DE INCENTIVO"/></a></td>
	  <td width="16">
	  <a href="incentivo2_copy.php?invnum=<?php echo $invnum?>">
	  <img src="../../../images/copy_16.png" width="16" height="16" title="COPIAR INCENTIVO" border="0"/>	  </a>	  </td>
      <td width="17">
	  <?php if ($valform <> 1){?>
	  <a href="incentivo2.php?invnum=<?php echo $invnum?>&valform=1"><img src="../../../images/edit_16.png" width="15" height="16" border="0" title="EDITAR"/>	  </a>
	  <?php }
	  else
	  {
	  if ($invnums == $invnum)
	  {
	  ?>
	  <input type="button" id="boton" onClick="validar_prod()" alt="GUARDAR"/>
	  <?php }
	  }
	  ?>
	  </td>
      <td width="22">
	   <?php if (($valform == 1) and ($invnums == $invnum))
	   {
	   ?>
	    <a href="incentivo2.php">
	  <img src="../../../images/icon-16-checkin.png" width="16" height="16" border="0"/></a>
	   <?php }
	   ?>	  </td>
	   <td width="22"><div align="center">
        <input type="button"  value=" " border="0" style="background-image: url(../../../images/del_16.png); background-color:rgba(255,255,255,0.0); border:none;" onclick="eliminarIncentivo(<?=$invnum?>)">
        </td>  
    </tr>
	<?php }
	?>
  </table>
  <?php }
  ?>
</form>
</body>
</html>

