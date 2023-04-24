<?php 
include('session_user.php');
require_once('../conexion.php');
require_once('../titulo_sist.php');
require_once('../convertfecha.php');

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

$caomparacion_incentivado = date('Y-m-d');
$sqlince = "SELECT invnum,datefin FROM incentivado where estado = '1'";
$resultincen = mysqli_query($conexion, $sqlince);
if (mysqli_num_rows($resultincen)) {
    while ($rowincen = mysqli_fetch_array($resultincen)) {
        $invnumincen = $rowincen['invnum'];
        $datefin = $rowincen['datefin'];
        if ($datefin < $caomparacion_incentivado) {
            mysqli_query($conexion, "UPDATE incentivado set estado  = '0' where invnum = '$invnumincen'");
            $sqlince2 = "SELECT invnum,datefin FROM incentivado where estado = '1'";
            $resultincen2 = mysqli_query($conexion, $sqlince2);
            if (mysqli_num_rows($resultincen2)) {
                while ($rowincen2 = mysqli_fetch_array($resultincen2)) {
                    $invnumincen2 = $rowincen2['invnum'];
                    $datefin2 = $rowincen2['datefin'];
                    if ($datefin2 < $caomparacion_incentivado) {
                        mysqli_query($conexion, "UPDATE incentivado set estado  = '0' where invnum = '$invnumincen2'");
                        $sql = "SELECT codpro FROM incentivadodet where invnum = '$invnumincen2'";
                        $result = mysqli_query($conexion, $sql);
                        if (mysqli_num_rows($result)) {
                            while ($row = mysqli_fetch_array($result)) {
                                $codpro = $row['codpro'];
                                $sqldet = "SELECT COUNT(*) FROM incentivadodet where codpro = '$codpro'";
                                $resultdet = mysqli_query($conexion, $sqldet);
                                if (mysqli_num_rows($resultdet)) {
                                    while ($rowdet = mysqli_fetch_array($resultdet)) {
                                        $sum = $rowdet[0];
                                    }
                                }
                                if ($sum == 1) {
                                    mysqli_query($conexion, "UPDATE producto set incentivado  = '0' where codpro = '$codpro'");
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
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
