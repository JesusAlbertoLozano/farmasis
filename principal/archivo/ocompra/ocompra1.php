<?php include('../../session_user.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="css/style1.css" rel="stylesheet" type="text/css" />
<link href="css/tabla2.css" rel="stylesheet" type="text/css" />
<?php require_once('../../../conexion.php');	//CONEXION A BASE DE DATOS
require_once("../../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
//require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../../funciones/botones.php");	//COLORES DE LOS BOTONES
require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUME
require_once("funciones/compra.php");	//IMPRIMIR-NUME
require_once("../../local.php");	//LOCAL DEL USUARIO
$rd     = $_REQUEST['rd'];
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
<script>
function validar()
{
	 var f = document.form1;
	 var i;
	 var c;
	 for (i=0;i<document.form1.rd.length;i++){
     if (document.form1.rd[i].checked)
	 {
	   f.method = "post";
	   f.action ="ocompra1.php";
	   f.submit();
	 }
	 }
}
</script>
</head>
<body>
<form name="form1" id="form1" onClick="highlight(event)" onKeyUp="highlight(event)">
  <table width="954" border="0">
    <tr>
      <td width="948"><table width="927" border="0">
          <tr>
            <td width="130" class="Estilo4"><u>ORDENES DE COMPRA</u></td>
            <td width="639"><table width="636" border="0">
              <tr>
                <td width="37">&nbsp;</td>
                <td width="420">
                  <div align="right">
                    <input name="rd" type="radio" value="4" checked="checked" onclick="validar()"/>
                    <span class="Estilo3">TODAS</span>
					<input name="rd" type="radio" value="1" <?php if ($rd == 1){?>checked="checked"<?php }?> onclick="validar()"/>
                    <span class="Estilo1">Borradas</span>
                    <input name="rd" type="radio" value="2" <?php if ($rd == 2){?>checked="checked"<?php }?> onclick="validar()"/>
                    <span class="Estilo2">Pendientes</span>
                    <input name="rd" type="radio" value="3" <?php if ($rd == 3){?>checked="checked"<?php }?> onclick="validar()"/>
                    <span class="Estilo3">Atendidas</span>
				  </div>
                  </td>
                <td width="165">
				<div align="right">
				  <input name="exit" type="button" id="exit" value="Salir"  onclick="salir()" class="salir"/>
                </div></td>
              </tr>
            </table>
            </td>
            <td width="144"><div align="right"><span class="blues"><strong>LOCAL:</strong> <?php echo $nombre_local?></span></div></td>
          </tr>
        </table>
          <table width="927" border="0">
            <tr>
              <td width="773"></td>
              <td width="144"><div align="right"><span class="blues"><b>USUARIO:</b> <?php echo $user?></span></div></td>
            </tr>
          </table>
          <table width="961" border="0" align="center" class="tabla2">
          <tr>
            <td>
			  <table width="955" border="0" align="center">
                <tr>
                  <td width="55"><span class="Estilo5">NUMERO</span></td>
                  <td width="58"><span class="Estilo5">FECHA</span></td>
                  <td width="95"><span class="Estilo5">PROVEEDOR</span></td>
                  <td width="120"><span class="Estilo5">REFERENCIA</span></td>
                  <td width="59"><div align="center"><span class="Estilo5">MONTO</span></div></td>
                  <td width="133"><span class="Estilo5">CONDICION</span></td>
                  <td width="95"><span class="Estilo5">USUARIO</span></td>
                  <td width="64"><span class="Estilo5">IMPRESION</span></td>
                  <td width="108"><span class="Estilo5">ESTADO</span></td>
                  <td width="57"><span class="Estilo5">BORRADO</span></td>
				  <td width="19"></td>
				  <td width="19"></td>
				  <td width="19"></td>
                </tr>
              </table>
			  <div align="center"><img src="../../../images/j_border.png" width="940" height="1" /> </div>
			  <iframe src="ocompra2.php?rd=<?php echo $rd?>" name="ocompra2" width="954" height="240" scrolling="Automatic" frameborder="0" id="ocompra2" allowtransparency="0"> 
			  </iframe>
			</td>
          </tr>
        </table>
        <img src="../../../images/line2.png" width="950" height="4" /><br />
          <?php $invnum = $_REQUEST['invnum'];
		  ?>
          <table width="961" border="0" align="center" class="tabla2">
            <tr>
              <td>
			    <table width="945" border="0" align="center">
                  <tr>
                    <td width="62"><span class="Estilo5">NUMERO</span></td>
                    <td width="68"><span class="Estilo5">CODIGO</span></td>
                    <td width="66"><div align="right"><span class="Estilo5">CANTIDAD</span></div></td>
					<td width="59"><div align="right"><span class="Estilo5">BONIF</span></div></td>
                    <td width="61"><div align="right"><span class="Estilo5">ATENDIDO</span></div></td>
                    <td width="49"><div align="right"><span class="Estilo5">SALDO</span></div></td>
                    <td width="219"><span class="Estilo5">PRODUCTO </span></td>
                    <td width="64"><div align="right"><span class="Estilo5">PRECIO</span></div></td>
                    <td width="55"><div align="right"><span class="Estilo5">DCTO 1 </span></div></td>
                    <td width="60"><div align="right"><span class="Estilo5">DCTO 2 </span></div></td>
                    <td width="58"><div align="right"><span class="Estilo5">DCTO 3 </span></div></td>
					<td width="74"><div align="right"><span class="Estilo5">SUBTOTAL</span></div></td>
                  </tr>
                </table>
			    <div align="center"><img src="../../../images/j_border.png" width="940" height="1" /> </div>
			    <iframe src="ocompra3.php?invnum=<?php echo $invnum?>" name="ocompra3" width="954" height="195" scrolling="Automatic" frameborder="0" id="ocompra3" allowtransparency="0"> </iframe>
			  </td>
            </tr>
          </table>
		<img src="../../../images/line2.png" width="950" height="4" /><br />
		<table width="961" border="0" align="center" class="tabla2">
            <tr>
              <td><table width="938" border="0" align="center">
                <tr>
                  <td width="271">&nbsp;</td>
                  <td width="657"><div align="right">
                    <input name="printer" type="button" id="printer" value="Imprimir" class="imprimir" onclick="imprimir()"/>
                    <input name="nuevo" type="button" id="nuevo" value="Nuevo" class="nuevo" onclick="news()"/>
                    <input name="modif" type="button" id="modif" value="Modificar" class="modificar" disabled="disabled"/>
                    <input name="exit2" type="button" id="exit2" value="Salir" onclick="salir()" class="salir"/>
                  </div></td>
                </tr>
              </table>			 
			  </td>
            </tr>
          </table>
          </td>
    </tr>
  </table>
</form>
</body>
</html>
