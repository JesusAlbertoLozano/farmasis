<?php
include('../session_user.php');
require_once ('../../conexion.php'); //CONEXION A BASE DE DATOS
require_once('../../titulo_sist.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?php echo $desemp ?></title>
        <link href="../reportes/css/tablas.css" rel="stylesheet" type="text/css" />
        <link href="../css/body.css" rel="stylesheet" type="text/css" />
        <link href="../../css/style.css" rel="stylesheet" type="text/css" />
        <?php require_once("../../funciones/functions.php"); //DESHABILITA TECLAS ?>
        <script type="text/javascript" language="JavaScript1.2" src="../menu_block/stmenu.js"></script>
    </head>
    <body>
        <div class="tabla1" style="height: 1600px; width: 1600px;">
            <script type="text/javascript" language="JavaScript1.2" src="../menu_block/men.js"></script>
            <div class="title1" style="width: 1600px;">
                <span class="titulos">SUNAT - ENVIO DE COMPROBANTES
                </span></div>
            <div class="mask1111" style="height: 1600px; width: 1600px;">
                <div class="mask2222" style="height: 1600px; width: 1600px;">
                    <div class="mask3333" style="height: 1600px; width: 1600px;">
                        <iframe src="envio1.php" name="principal" style="height: 1600px; width: 1600px;" scrolling="Automatic" frameborder="0" id="principal" allowtransparency="0">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
