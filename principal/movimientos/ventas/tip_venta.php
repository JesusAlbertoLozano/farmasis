<?php require_once('../../session_user.php');
$venta   = $_SESSION['venta'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<style>
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

	<link href="../../select2/css/select2.min.css" rel="stylesheet" />
	<script src="../../select2/jquery-3.4.1.js"></script>
	<script src="../../select2/js/select2.min.js"></script>
	<?php require_once('../../../conexion.php');	//CONEXION A BASE DE DATOS
	require_once('../../../funciones/funct_principal.php');	//DESHABILITA TECLAS
	require_once('funciones/datos_generales.php'); //////CODIGO Y NOMBRE DEL LOCAL
	require_once('../../../funciones/botones.php');	//COLORES DE LOS BOTONES
	require_once('../../local.php');	//LOCAL DEL USUARIO
	$close = isset($_REQUEST['close']) ? $_REQUEST['close'] : "";

	$close =  $_REQUEST['close'];
	?>
	<script>
		function tarjet() {
			var f = document.form1;
			f.tarjeta.disabled = true;
			f.num.disabled = true;
			f.tradio[0].focus();
		}

		function cerrar(e) {
			tecla = e.keyCode
			if (tecla == 27) {
				window.close();
			}
			if (tecla == 13) {
				document.form1.Submit.focus();
			}
		}

		function radio(e) {
			tecla = e.keyCode
			return;
		}
		var nav4 = window.Event ? true : false;

		function enters(evt) {
			// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57
			var key = nav4 ? evt.which : evt.keyCode;
			//alert(tecla);
			if (key == 13) {
				document.form1.Submit.focus();
			}
			return (key == 70 || key == 102 || (key <= 13 || (key >= 48 && key <= 57)));
		}

		function saves() {
			var f = document.form1;
			var i = 0;
			var t = "";
			for (i = 0; i < document.form1.tradio.length - 1; i++) {
				if (document.form1.tradio[i].checked == true) {
					t = document.form1.tradio[i].value;
					if (t == "T") {
						if ((f.num.value == "") || (f.num.value == 0)) {
							alert("DEBE INGRESAR LOS NUMEROS DE LA TARJETA");
							f.num.focus();
							return;
						}
					}
				}
			}
			f.action = "tip_venta1.php";
			f.method = "post";
			f.submit();
		}

		function tip() {
			var f = document.form1;
			f.tarjeta.disabled = true;
			f.num.disabled = true;
		}

		function tip1() {
			var f = document.form1;
			f.tarjeta.disabled = false;
			f.num.disabled = false;
		}

		function cerrar_popup() {

			document.form1.target = "venta_principal";
			window.opener.location.href = "salir_pago.php";
			self.close();
		}
	</script>
	<title>MODULO DE VENTAS</title>
	<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		body {
			background-color: #f4f4f4;
		}

		#customers {
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		#customers th {
			border: 1px solid #ddd;
			padding: 1px;

		}

		#customers td {
			border: 1px solid #ddd;
			padding: 5px;
		}

		#customers tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		#customers tr:hover {
			background-color: #FFFF66;
		}

		#customers th {
			padding: 2px;
			text-align: left;
			background-color: #2e91d2;
			color: white;
			font-size: 15px;
		}

		label:hover {
			font-size: 15px;
			color: #6a6565;
		}
	</style>

</head>
<?php $sql = "SELECT forpag,codtab,numtarjet FROM venta where invnum = '$venta'";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result)) {
	while ($row = mysqli_fetch_array($result)) {
		$forpag    = $row['forpag'];
		$codtab    = $row['codtab'];
		$numtarjet = $row['numtarjet'];
	}
}
?>

<body onkeyup="cerrar(event)" <?php if ($close == 1) { ?> onload="cerrar_popup();" <?php } else { ?>onload="tarjet()" <?php } ?>>
	<form name="form1" id="form1">
		<table width="100%" border="0" id="customers">
			<tr>
				<th><span class="LETRA">FORMA DE PAGO </span></th>
				<td>

					<input name="tradio" id="tradio_Efectivo" type="radio" value="E" onfocus="tip()" <?php if ($forpag == "E") { ?>checked="checked" <?php } ?> />
					<label for="tradio_Efectivo" class="LETRA"> Efectivo</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input name="tradio" id="tradio_Credito" type="radio" value="C" onfocus="tip()" <?php if ($forpag == "C") { ?>checked="checked" <?php } ?> />
					<label for="tradio_Credito" class="LETRA"> Credito</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input name="tradio" id="tradio_Tarjeta" type="radio" value="T" onfocus="tip1()" onkeypress="return radio(event);" <?php if ($forpag == "T") { ?>checked="checked" <?php } ?> />
					<label for="tradio_Tarjeta" class="LETRA"> Tarjeta</label>
				</td>
				<td rowspan="3">

					<input type="button" name="Submit" value="Grabar" onclick="saves();" class="grabar" />
				</td>
			</tr>
			<tr>
				<th><span class="LETRA">TARJETA</span></th>
				<td>
					<select name="tarjeta" id="tarjeta" style="width: 250px	;">
						<option value="0">Seleccione una Tarjeta...</option>
						<?php $sql = "SELECT * FROM tarjeta    order by nombre";
						$result = mysqli_query($conexion, $sql);
						while ($row = mysqli_fetch_array($result)) {
						?>
							<option value="<?php echo $row['id']; ?>" <?php if ($codtab == $row['id']) { ?>selected="selected" <?php } ?>><?php echo $row['nombre']; ?></option>
						<?php }
						?>
					</select>
				</td>
			</tr>
			<tr>
				<th><span class="LETRA">NUMERO</span></th>
				<td>
					<input name="num" type="text" id="num" onkeypress="return enters(event);" value="<?php echo $numtarjet ?>" />
				</td>
			</tr>
		</table>
	</form>
</body>

</html>
<script type="text/javascript">
	// $('#tarjeta').select2();

	$("#tarjeta").select2({
		placeholder: "sometext",
		allowClear: false,
		tags: true
	});
</script>