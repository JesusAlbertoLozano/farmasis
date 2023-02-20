<?php include('../session_user.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<?php require_once ('../../conexion.php');	//CONEXION A BASE DE DATOS
?>
<script type="text/javascript" language="JavaScript1.2" src="menu/stmenu.js"></script>
<script type="text/javascript" language="javascript" src="js/colorPicker.js"></script>
<link rel="STYLESHEET" type="text/css" href="codebase/dhtmlxcolorpicker.css">
<script  src="codebase/dhtmlxcolorpicker.js"></script>
<link href="css/tablas.css" rel="stylesheet" type="text/css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<?php //<link href="../../css/botones.css" rel="stylesheet" type="text/css" /> 
require_once("../../funciones/botones.php");	//FUNCIONES DE ESTA VENTANA
?>
<link rel="stylesheet" href="css/colorPicker.css" type="text/css"></link>
<?php require_once("funciones/color.php");	//FUNCIONES DE ESTA VENTANA
require_once("../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
require_once("../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../funciones/funct_principal.php");	//IMPRIMIR-NUMEROS ENTEROS-DECIMALES
?>
</head>
<body>
<div class="mask1">
	<div class="mask2">
	<script type="text/javascript" language="JavaScript1.2" src="menu/men.js"></script>
		<div class="mask3">
		<br>
		
		<br>
		<?php require_once('color1a.php');?>	
        </div>
	</div>
</div>
</body>
</html>
