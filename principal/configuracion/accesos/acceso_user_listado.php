<?php include('../../session_user.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<?php require_once ('../../../conexion.php');
require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../../funciones/botones.php");	//COLORES DE LOS BOTONES
?>
</head>

<body>
<?php 
$codgrup = $_REQUEST['codgrup'];
$error = $_REQUEST['error'];
$ok = $_REQUEST['ok'];
$val = $_REQUEST['val'];
if ($val == 1)
{
?>
<table width="584" border="0" align="center" class="tabla2">
  <tr>
    <td><span class="Estilo1">
      <?php if ($ok == 1)
	{
	echo "<b>SE LOGRO REGISTRAR SATISFACTORIAMENTE UN USUARIO</b><br>";
	}
	if ($error == 1)
	{
	echo "<b>NO SE PUDO REGISTRAR EL USUARIO, LA CLAVE DEL VENDEDOR YA EXISTE EN EL SISTEMA</b><br>";
	}
	?>
    </span> </td>
  </tr>
</table>
<?php }
?>

<img src="../../../images/line.jpg" width="508" height="1" />

<?php
$sql="SELECT U.usecod,U.nomusu,U.logusu,U.abrev,U.fecha_reg,U.estado,X.nomloc, X.nombre FROM usuario U INNER JOIN xcompa X ON U.codloc = X.codloc where U.codgrup = '$codgrup' and eliminado ='0'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
?>
<table width="100%" border="0">
    <tr>
    <th width="15%" class="text_combo_select">USUARIO</th>
	<th width="15%" class="text_combo_select">LOCAL</th>
    <th width="20%" class="text_combo_select">ABREV</th>
    <th width="30%" class="text_combo_select">NOMBRE</th>
    <th width="10%" class="text_combo_select">FECHA</th>
	<th width="9%" class="text_combo_select"></th>
	<th width="5%" class="text_combo_select">ESTADO</th>
  </tr>
  <?php while ($row = mysqli_fetch_array($result)){
	   $usecod       = $row['usecod'];
	   $nomusu       = $row['nomusu'];
	   $logusu       = $row['logusu'];
	   $abrev        = $row['abrev'];
	   $fecha_reg    = $row['fecha_reg'];
	   $estado       = $row['estado'];
	   $nomLoc       = $row['nomloc'];
	  
  ?>
  <tr onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#ffffff';">
    <td width="15%"><?php echo $logusu?></td>
	<td width="15%"><?php echo $nomLoc?></td>
    <td width="20%"><?php echo $abrev?></td>
    <td width="30%"><?php echo $nomusu?></td>
    <td width="10%"><?php echo $fecha_reg?></td>
	<td width="5%">
	<div align="right">
	<a href="acceso_user_listado1.php?codgrup=<?php echo $codgrup?>&usecod=<?php echo $usecod?>"><img src="../../../images/edit_16.png" width="16" height="16" title="EDITAR USUARIO" border="0"/></a>
	</div>
	</td>
	<td width="5%">
	<div align="right">
	<?php if ($estado == 0){?>
	<a href="dar_alta.php?user=<?php echo $usecod?>&codgrup=<?php echo $codgrup?>">
	<img src="../../../images/del_16.png" width="16" height="16" title="HACER CLIC PARA ACTIVAR USUARIO" border="0"/>
		</a>
	<?php } else {?>
	<a href="dar_baja.php?user=<?php echo $usecod?>&codgrup=<?php echo $codgrup?>">
	<img src="../../../images/icon-16-checkin.png" width="16" height="16" title="HACER CLIC PARA DESACTIVAR USUARIO" border="0"/>
	</a>
	<?php }?>
	</div>
	</td>
   <?php }
   ?>
  </tr>
<?php }
else
{
?>
<center>NO EXISTEN USUARIOS PARA ESTE GRUPO</center>
<?php }
?>
</table>
</body>
</html>
