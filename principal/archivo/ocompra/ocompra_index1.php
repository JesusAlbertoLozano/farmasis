<?php include('../../session_user.php');
$ord_compra   = $_SESSION['ord_compra'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="css/style1.css" rel="stylesheet" type="text/css" />
<link href="css/style2.css" rel="stylesheet" type="text/css" />
<link href="css/tabla2.css" rel="stylesheet" type="text/css" />
<?php require_once('../../../conexion.php');	//CONEXION A BASE DE DATOS
require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS
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
<?php $tip = $_REQUEST['tip'];
if ($tip == 1)
{
$dir = 'busca_prov/proveedor.php';
}
else
{
	if ($tip == 2)
	{
		$dir = 'busca_marca/marcas.php';
	}
	else
	{
		if ($tip == 3)
		{
			$codpro = $_REQUEST['codpro'];
			$val    = $_REQUEST['val'];
			$dir = 'productos.php?codpro=$codpro';
		}
		else
		{
			$dir = 'busca_prov/proveedor.php';
		}
	}
}
$sql="SELECT invnum,provee FROM ordmae where codusu = '$usuario' and estado ='1'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$invnum    = $row['invnum'];
	$provee    = $row['provee'];
}
}
$_SESSION['ord_compra']			= $invnum; 
$sql="SELECT invnum FROM temp_marca where invnum = '$ord_compra'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$marca_act = 1;
}
else
{
	$marca_act = 0;
}
?>
</head>
<body>
<form name="form1" id="form1" onClick="highlight(event)" onKeyUp="highlight(event)">
  <table width="954" border="0">
    <tr>
      <td width="948"><table width="927" border="0">
          <tr>
            <td width="130" class="Estilo4"><u>ORDENES DE COMPRA</u></td>
            <td width="639"><div align="right">
              <input name="exit" type="button" id="exit" value="Salir"  onclick="salir1()" class="salir"/>
            </div></td>
            <td width="144">
			<div align="right"><span class="blues"><strong>LOCAL:</strong> <?php echo $nombre_local?></span></div>
			</td>
          </tr>
        </table>
          <table width="927" border="0">
            <tr>
              <td width="773">
			  <table width="774" border="0" class="tabla2">
                <tr>
                  <td width="253">
				  <a href="ocompra_index1.php?tip=1"><?php if (($tip== 1) || ($tip == "")){?><b>DATOS DEL PROVEEDOR</b><?php } else {?>DATOS DEL PROVEEDOR<?php }?></a>
				  </td>
                  <td width="252">
				  <?php if ($provee<>0){?><a href="ocompra_index1.php?tip=2"><?php if ($tip== 2){?><b>MARCA DE PRODUCTOS</b><?php } else {?>MARCA DE PRODUCTOS<?php }?></a><?php }else{?><font color="#CCCCCC">MARCA DE PRODUCTOS</font><?php }?>
				  </td>
				  <td width="253">
				  <?php if (($provee<>0) and ($marca_act == 1)){?><a href="ocompra_index1.php?tip=3"><?php if ($tip== 3){?><b>DATOS DEL PRODUCTO</b><?php } else {?>DATOS DEL PRODUCTO<?php }?></a><?php }else{?><font color="#CCCCCC">DATOS DEL PRODUCTO</font><?php }?>
				  </td>
                </tr>
              </table></td>
              <td width="144"><div align="right"><span class="blues"><b>USUARIO:</b> <?php echo $user?></span></div></td>
            </tr>
          </table>
      <img src="../../../images/line2.png" width="930" height="4" /></td>
    </tr>
  </table>
  <table width="978" border="0" align="center" class="tabla2">
    <tr>
      <td width="964">
	  <iframe src="<?php echo $dir?>" name="compra_index1" width="984" height="520" scrolling="Automatic" frameborder="0" id="compra_index1" allowtransparency="0"> 
	  </iframe>
	  </td>
    </tr>
  </table>
</form>
</body>
</html>
