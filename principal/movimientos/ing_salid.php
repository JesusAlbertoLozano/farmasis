<?php
	include('../session_user.php');
	require_once ('../../conexion.php');	//CONEXION A BASE DE DATOS
	require_once('../../titulo_sist.php');
	require_once('../../convertfecha.php');
	require_once('../local.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title><?php echo $desemp?></title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<link href="css/tablas.css" rel="stylesheet" type="text/css" />
		<link href="../css/body.css" rel="stylesheet" type="text/css" />
		<link href="../../css/style.css" rel="stylesheet" type="text/css" />
		<?php 
			require_once("funciones/mov_ing_salid.php");	//FUNCIONES DE ESTA PANTALLA
			require_once("../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
			require_once("../../funciones/functions.php");	//DESHABILITA TECLAS
			require_once("../../funciones/funct_principal.php");	//IMPRIMIR-NUMEROS ENTEROS-DECIMALES
			/////////////////////////////////
			$sql="SELECT nomusu FROM usuario where usecod = '$usuario'";
			$result = mysqli_query($conexion,$sql);
			if (mysqli_num_rows($result)){
				while ($row = mysqli_fetch_array($result)){
						$user    = $row['nomusu'];
				}
			}
			/////////////////////////////////////////////////
		?>
		<?php
			require_once("../../funciones/botones.php");	//COLORES DE LOS BOTONES
		?>
		<script type="text/javascript" language="JavaScript1.2" src="../menu_block/stmenu.js"></script>
	</head>
	<body onLoad="sf();">
		<?php
			function formato($c) {
				printf("%08d",  $c);
			} 
			function formato1($c) {
				printf("%06d",  $c);
			} 
			$date = date("Y-m-d");
			//$hour   = date('G');
			//$date	= CalculaFechaHora($hour);
			$regis = isset($_REQUEST['regis']) ? ($_REQUEST['regis']) : "";	
			if ($regis == 1)
			{
				$regis_desc = "POR REGISTRO";
			}
			if ($regis == 2)
			{
				$regis_desc = "POR CONSULTA";
			}
		?>
		<div class="tabla1">
		<script type="text/javascript" language="JavaScript1.2" src="../menu_block/men.js"></script>
		<div class="title">
		<span class="titulos">SISTEMA DE VENTAS - Movimiento de Mercaderias
		</span></div>
		<div class="mask11">
			<div class="mask22">
				<div class="mask33">
					<?php require ('ing_salid1.php');?>
				</div>
			</div>
			</div>
		</div>
	</body>
</html>
