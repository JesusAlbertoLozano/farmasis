<?php session_set_cookie_params(0);
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta charset="windows-1252">

<?php $resolucion = $_SESSION['resolucion'];
if ($resolucion == "")
{
?>
<script>
if (screen.width<1024) 
{
var pagina = "resolucion.php?resol=1";
}
else
{	
	if (screen.width<1280)
	{
	var pagina = "resolucion.php?resol=2";
	}
	else
	{
	var pagina = "resolucion.php?resol=3";
	}
}
location.href=pagina;
</script>
<?php }
?>
<?php if ($resolucion == 1)
{
?>
<link href="css/tablas_pek.css" rel="stylesheet" type="text/css" />
<?php }
else
{
?>
<link href="css/tablas_med.css" rel="stylesheet" type="text/css" />
<?php }
?>
<link href="css/body.css" rel="stylesheet" type="text/css" /> 
<link href="css/style.css" rel="stylesheet" type="text/css" /> 
<link href="css/button_login.css" rel="stylesheet" type="text/css" />
<?php require_once('conexion.php');?>
<?php require_once("funciones/functions.php");?>
<?php require_once('funciones/button_clave.php');?>
<?php require_once('titulo_sist.php'); ?>
<?php 
//$error = $_GET['error'];
$error = isset($_REQUEST['error'])? ($_REQUEST['error']) : "";
if ($error == 3)
{ 
$desc = "UD ha sido dado de baja en el sistema";
} 
if ($error == 2)
{ 
$desc = "Login o clave no validos";
} 
if ($error == 4)
{ 
$desc = "IP invalido para utilizar el sistema";
} 
if ($error == 5)
{ 
$desc = "Falta archivo de configuraci�n para acceder al sistema";
} 
if ($error == 6)
{ 
$desc = "Los datos de configuraci�n no corresponden";
} 
?>
<title><?php echo $desemp?></title>
</head>
<body onLoad="sf();">
<div class="mask1">
	<div class="mask2">
	    
	    <table width="100%" border="0" align="center">
                    <tr>
                        
                        <td align="center"><a href="http://www.farmasis.net/" target="_blank"><img src="http://www.farmasis.site/wp-content/uploads/2018/12/FARMASIS.png" width="300" height="45"  /> </a></td>
                    </tr>
                    <tr>
                        <td align="center"><span class="titulos" style="color: #e74b3b;font-weight: 900;font-size: 20px;"><?php echo $nmensajeuniversal; ?></span></td>
                    </tr>
                </table>
		<div class="mask3">
	  <br><br><br>
		<?php require_once('login.php');?>
	  </div>
	  </div>
</div>
</body>
</html>
