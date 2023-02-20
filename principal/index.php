<?php include('session_user.php');
require_once('../conexion.php');
require_once('../titulo_sist.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="cache-control" content="no-store" />
<title><?php echo $desemp?></title>
<link href="css/body.css" rel="stylesheet" type="text/css" />
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
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<?php require_once("../funciones/functions.php");?>
		<?php error_log("Menu ing salida"); ?>
<script type="text/javascript" language="JavaScript1.2" src="menu_ok/stmenu.js?temp=<?php echo rand(); ?>"></script>
</head>
<body>
<?php $n = '0';
?>
<div class="tabla1">
<?php 

$files = glob('movimientos/ventas/temp/*'); // obtiene todos los archivos
foreach($files as $file){
  if(is_file($file)) // si se trata de un archivo
    unlink($file); // lo elimina
}
require_once('reporte.php');
include('acceso.php');
include('men.php');
?>
</div>
</body>
</html>
