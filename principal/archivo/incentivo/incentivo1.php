<?php include('../../session_user.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../css/css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/css/tablas.css" rel="stylesheet" type="text/css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {color: #0B55C4}
-->
</style>
<?php require_once('../../../conexion.php');	//CONEXION A BASE DE DATOS?>
<?php require_once("../../../funciones/calendar.php");?>
<?php require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS?>
<?php require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUMEROS ENTEROS-DECIMALES?>
<?php require_once("../../../funciones/botones.php");	//COLORES DE LOS BOTONES?>
<?php require_once("../../local.php");	//LOCAL DEL USUARIO
$sql="SELECT nomusu FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
		$user    = $row['nomusu'];
}
}
$sql="SELECT utldmin FROM datagen_det";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$utldmin    = $row['utldmin'];
}
}
?>
<script language="JavaScript">
function news()
{
	 var f = document.form1;
	 f.method = "post";
	 f.nn.value = 1;
	 f.submit();
}
function salir()
{
	 var f = document.form1;
	 f.method = "POST";
	 f.target = "_top";
	 f.action ="../../index.php";
	 f.submit();
}
</script>
<script type="text/javascript" language="JavaScript1.2" src="/comercial/funciones/control.js"></script>
</head>
<?php $nn        = $_REQUEST['nn'];
$pagina    = $_REQUEST["pagina"];
$val 	   = $_REQUEST['val'];
$p1	 	   = $_REQUEST['p1'];
$ord 	   = $_REQUEST['ord'];
$tip 	   = $_REQUEST['tip'];
$incent    = $_REQUEST['incent'];
$valform   = $_REQUEST['valform'];
$cod       = $_REQUEST['cod'];
$local     = $_REQUEST['local'];
$inicio    = $_REQUEST['inicio'];
$pagina    = $_REQUEST['pagina'];
?>
<body>
<form id="form1" name="form1" method = "post">
 <table width="965" border="0">
    <tr>
      <td>
	  <b><u>INCENTIVOS</u></b>
        <table width="955" border="0">
          <tr>
            <td width="644">
              <div align="left">
                <input type="button" name="Submit2" value="Nuevo" onclick="news()" class="buscar"/>
                <input type="submit" name="Submit" value="Actualizar" class="buscar"/>
                <input name="nn" type="hidden" id="nn" />
                <input type="button" name="Submit322" value="Salir" onclick="salir()" class="salir"/>
              </div>
	        </td>
            <td width="301">
			<div align="right"> <span class="blues Estilo1"><strong>LOCAL:</strong> <?php echo $nombre_local?></span></div>
			</td>
          </tr>
        </table>
        <table width="955" border="0">
          <tr>
            <td width="644"><div align="left"></div></td>
			<td width="301"><div align="right"><span class="blues Estilo1"><b>USUARIO:</b> <?php echo $user?></span></div></td>
          </tr>
        </table>
      </td>
    </tr>
</table>
  <table width="965" border="0" class="tabla2">
    <tr>
      <td>
	  <iframe src="incentivo2.php?nn=<?php echo $nn?>" name="marco1" id="marco1" width="960" height="190" scrolling="Automatic" frameborder="0" allowtransparency="0">
  </iframe>
	  </td>
    </tr>
  </table>
  <table width="965" border="0" class="tabla2">
    <tr>
      <td>
      <iframe src="incentivo3.php?codpro=<?php echo $cod?>&p1=<?php echo $p1?>&val=<?php echo $val?>&inicio=<?php echo $inicio?>&pagina=<?php echo $pagina?>&tot_pag=<?php echo $tot_pag?>&registros=<?php echo $registros?>&valform=<?php echo $valform?>&incent=<?php echo $incent?>&local=<?php echo $local?>" name="marco2" id="marco2" width="960" height="315" scrolling="Automatic" frameborder="0" allowtransparency="0"> </iframe>
      </td>
    </tr>
  </table>
</form>
</body>
</html>
