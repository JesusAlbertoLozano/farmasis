<?php include('../../session_user.php');
require_once('../../../conexion.php');
require_once('../../../titulo_sist.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $desemp?></title>
<link href="../css/css/style1.css" rel="stylesheet" type="text/css" />
<link href="../css/css/tablas.css" rel="stylesheet" type="text/css" />
<?php require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUME
?>
<script>
function sf(){
var f = document.form1;
document.form1.p1.focus();
}
function cambia(){
var f = document.form1;
f.method = "post";
f.submit();
}
var nav4 = window.Event ? true : false;
function enter(evt){
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57
var key = nav4 ? evt.which : evt.keyCode;
	if (key == 13)
	{
	document.form1.submit();
	}
}
function validar()
{
	var f = document.form1;
	if (f.p1.value == "")
	 { alert("Ingrese la descripcion para Iniciar la B�squeda"); f.p1.focus(); return; }
	 f.method = "post";
	 f.submit();
}
function validar1()
{
	var f = document.form1;
	f.val.value = 2;
	f.method = "post";
	f.submit();
}
function validarform()
{
var f = document.form1;
if ((f.cant.value == "") && (f.cant2.value == ""))
{ alert("Debe ingresar una cantidad");f.cant.focus();return;}
if (f.monto.value == "")
{ alert("Debe ingresar un Monto");f.monto.focus();return;}
f.method = "post";
f.target = "principal";
f.action = "incentivo_grabar.php";
f.submit();
}
function validarcerrar()
{
var f = document.form1;
f.valform.value=0;
f.codpro.value="";
f.incent.value="";
f.action = "incentivo3.php";
f.method = "post";
f.submit();
}
function activaate()
{
var f = document.form1;
f.ver.value=0;
f.incent.value="";
f.action = "incentivo3.php";
f.method = "post";
f.submit();
}
</script>
<style>
#boton { background:url('../../../images/save_16.png') no-repeat; border:none; width:16px; height:16px; }
#boton1 { background:url('../../../images/icon-16-checkin.png') no-repeat; border:none; width:16px; height:16px; }
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
.Estilo2 {
	color: #FFFFFF;
	font-weight: bold;
}
</style>
</head>
<?php //require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS
////////////////////////////
$registros = 40;
$pagina    = $_REQUEST["pagina"];
$val 	   = $_REQUEST['val'];
$p1	 	   = $_REQUEST['p1'];
$ord 	   = $_REQUEST['ord'];
$tip 	   = $_REQUEST['tip'];
$inicio    = $_REQUEST['inicio'];
$pagina    = $_REQUEST['pagina'];
$cod       = $_REQUEST['cod'];
$valform   = $_REQUEST['valform'];
if (!$pagina) {
$inicio = 0;
$pagina = 1;
}
else 
{
$inicio = ($pagina - 1) * $registros;
} 
////////////////////////////
if ($val == 1)
{
$sql="SELECT codpro FROM producto where desprod like '$p1%'";
}
else
{
 if ($val ==2)
 {
	$sql="SELECT codpro FROM producto where incentivado = '1'";
 }
 else
 {
    $sql="SELECT codpro FROM producto";
 }
}
$sql			 = mysqli_query($conexion,$sql);
$total_registros = mysqli_num_rows($sql);
$total_paginas   = ceil($total_registros/$registros); 
////////////////////////////
$sql="SELECT * FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$user    = $row['nomusu'];
}
}
$sql="SELECT count(*) FROM incentivado where estado = '1'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$countregx    = $row[0];
}
}
/*
if ($countregx<>0)
{
	$sql="SELECT invnum FROM incentivado where estado = '1'";
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	while ($row = mysqli_fetch_array($result)){
		$invnumss    = $row[0];
	}
	}
}
*/
function formato($c) {
printf("%08d",$c);
} 
if ($tip == 1)
{
$dtip = "ASC";
}
if ($tip == 2)
{
$dtip = "DESC";
}
?>
<body <?php if ($val <> 1){?>onload="sf();"<?php }?>>
<form id="form1" name="form1" method = "post">
  <table width="927" border="0">
    <tr>
      <td width="67">PRODUCTO</td>
      <td width="467">
	  <input name="p1" type="text" id="p1" size="90" value="<?php echo $p1?>" onkeypress="enter(event)"/></td>
      <td width="230">
	  <input name="val" type="hidden" id="val" value="1" />
      <input type="button" name="Submit" value="Buscar" onclick="validar()" class="buscar"/>
      <input type="button" name="Submit2" value="Solo Productos Incentivados" onclick="validar1()" class="buscar"/></td>
      <td width="145"><div align="right">
          <?php if(($pagina - 1) > 0) 
		  {
		  ?>
        <a href="incentivo1.php?p1=<?php echo $p1?>&&val=<?php echo $val?>&&inicio=<?php echo $inicio?>&&registros=<?php echo $registros?>&&pagina=<?php echo $pagina-1?>"><img src="../../../images/play1.gif" width="16" height="16" border="0"/> </a>
          <?php }
		  if(($pagina + 1)<=$total_paginas) 
		  {
     	  ?>
        <a href="incentivo1.php?p1=<?php echo $p1?>&&val=<?php echo $val?>&&inicio=<?php echo $inicio?>&&registros=<?php echo $registros?>&&pagina=<?php echo $pagina+1?>"> <img src="../../../images/play.gif" width="16" height="16" border="0"/> </a>
          <?php }
		  ?>
</div></td>
    </tr>
  </table>
  <img src="../../../images/line2.png" width="930" height="4" />
  <table width="927" border="0">
    <tr>
      <td><div align="left"><strong>INCENTIVOS : <?php echo $p1?></strong></div></td>
    </tr>
  </table>
  <div align="center"><img src="../../../images/line2.png" width="931" height="4" /></div>
  <?php $incent = $_REQUEST["incent"];
	   $ver    = $_REQUEST['ver'];
	   if ($incent <> "")
	   {
		$activ    = $_REQUEST["activ"];
		$cod      = $_REQUEST['codpro'];
		if (activ == 1)
		{
		
		}
		else
		{
		$invnumss = $incent;
		}
		$valform  = 1;
	   }
	   if (($valform==1) and ($cod <> ""))
	   {
	    $localx  = $_REQUEST['local'];
	    $sql="SELECT codpro,desprod,factor FROM producto where codpro = '$cod'";
		$result = mysqli_query($conexion,$sql);
		if (mysqli_num_rows($result)){
		while ($row = mysqli_fetch_array($result)){
			$desprod1    = $row['desprod'];
			$codpro1     = $row['codpro'];
			$factor      = $row['factor'];
		}
		}
		if($localx<>"")
		{
		$sql="SELECT * FROM incentivadodet where codpro = '$cod' and invnum = '$invnumss' and codloc = '$localx'";
		}
		else
		{
		$sql="SELECT * FROM incentivadodet where codpro = '$cod' and invnum = '$invnumss'";
		}
		$result = mysqli_query($conexion,$sql);
		if (mysqli_num_rows($result)){
		while ($row = mysqli_fetch_array($result)){
			$invnum    = $row['invnum'];
			$canprocaj = $row['canprocaj'];
			$canprounid= $row['canprounid'];
			$pripro    = $row['pripro'];
			$pripromin = $row['pripromin'];
			$cuota     = $row['cuota'];
			$estado    = $row['estado'];
			$codloc    = $row['codloc'];
		}
		}
		else
		{
		$estado = 1;
		}
	  ?>
  <table width="927" border="0" bgcolor="#FFFF99">
    <tr>
      <td><table width="910" border="0" align="center">
        <tr>
          <td width="720"><table width="715" border="0" bgcolor="#50ADEA">
            <tr>
              <td width="108"><span class="Estilo2">BUSQUEDA</span></td>
              <td width="597">
              <select name="incent" id="incent" onchange="cambia()">
               <?php $sqlx = "SELECT invnum FROM incentivado where estado = '1' order by invnum desc"; 
				$resultx = mysqli_query($conexion,$sqlx); 
				if(mysqli_num_rows($resultx))
				{
				$nnohay = 1;
				while ($rowx = mysqli_fetch_array($resultx)){ 
				$inv	= $rowx["invnum"];
               ?>
                  <option value="<?php echo $rowx["invnum"];?>" <?php if ($invnumss == $inv){?>selected="selected"<?php }?>><?php echo formato($rowx["invnum"]); ?> </option>
               <?php }
				}
				else
				{

			  ?>
                  <option value="0">NO SE LOGRO ENCONTRAR INCENTIVOS HABILITADOS</option>
		      <?php $nnohay = 0;
				} 	
			  ?>
              </select>
            <input name="ver" type="hidden" id="ver" value="1"/>
            <input type="button" name="Submit3" value="Buscar" onclick="cambia();" <?php if ($nnohay == 0){?> disabled="disabled"<?php }?>/></td>
            </tr>
          </table>
		  <img src="../../../images/line2.png" width="710" height="4" />
          <table width="715" border="0">
            <tr>
              <td width="108"><strong>PRODUCTO</strong></td>
              <td width="597">
			  <input name="textfield" type="text" size="100" value="<?php echo $desprod1?>" disabled="disabled"/>
              <a href="incentivo3.php?val=<?php echo $val?>&amp;&amp;p1=<?php echo $p1?>&amp;&amp;ord=<?php echo $ord?>&amp;&amp;tip=<?php echo $tip?>&amp;&amp;inicio=<?php echo $inicio?>&amp;&amp;pagina=<?php echo $pagina?>&amp;&amp;tot_pag=<?php echo $tot_pag?>&amp;&amp;registros=<?php echo $registros?>"><img src="../../../images/icon-16-checkin.png" width="16" height="16" border="0"/></a> </td>
            </tr>
            <tr>
              <td><strong>SUCURSAL</strong></td>
              <td>
			  <select name="local" id="local" <?php if ($estado == 0){?>disabled="disabled"<?php }?>>
                  <?php $sqlx = "SELECT * FROM xcompa where habil = '1' order by codloc"; 
				$resultx = mysqli_query($conexion,$sqlx); 
				while ($rowx = mysqli_fetch_array($resultx)){ 
				$loc	= $rowx["codloc"];
				$nloc	= $rowx["nomloc"];
             ?>
                  <option value="<?php echo $rowx["codloc"];?>" <?php if ($loc == $codloc){?> selected="selected"<?php }?>><?php echo $rowx["nomloc"]; ?></option>
                  <?php } ?>
              </select>			  </td>
            </tr>
            <tr>
              <td><strong>ESTADO</strong></td>
              <td>
			  <select name="state" id="state" <?php if ($estado == 0){?>disabled="disabled"<?php }?>>
                <option value="1" <?php if ($estado == 1){?>selected="selected"<?php }?>>ACTIVADO</option>
                <option value="0" <?php if ($estado == 0){?>selected="selected"<?php }?>>DESACTIVADO</option>
              </select>
			  <?php if ($estado == 0){?>
			  <a href="incentivo_grabar1.php?codpro=<?php echo $cod;?>&&local=<?php echo $codloc?>&&invnum=<?php echo $invnum?>&&val=<?php echo $val?>&&valform=1&&p1=<?php echo $p1?>&&&ord=<?php echo $ord?>&&tip=<?php echo $tip?>&&inicio=<?php echo $inicio?>&&pagina=<?php echo $pagina?>&&tot_pag=<?php echo $tot_pag?>&&registros=<?php echo $registros?>">ACTIVAR</a>
			  <?php }?>			  </td>
            </tr>
            <tr>
              <td><strong>CANTIDAD</strong></td>
              <td><input name="cant" type="text" id="cant" onkeypress="return acceptNum(event);" value="<?php echo $canprocaj?>" size="12" <?php if ($estado == 0){?>disabled="disabled"<?php }?>/>
                CAJAS
                <input name="cant2" type="text" id="cant2" onkeypress="return acceptNum(event);" value="<?php echo $canprounid?>" size="12" <?php if ($estado == 0){?>disabled="disabled"<?php }?>/>
                UNIDADES <b>(FACTOR = <?php echo $factor?>)</b> </td>
            </tr>
            <tr>
              <td><strong>MONTO A PAGAR </strong></td>
              <td><input name="monto" type="text" id="monto" onkeypress="return decimal(event);" value="<?php echo $pripro?>" size="12" <?php if ($estado == 0){?>disabled="disabled"<?php }?>/>              </td>
            </tr>
            <tr>
              <td><strong>PRECIO MINIMO </strong></td>
              <td><input name="price" type="text" id="price" onkeypress="return decimal(event);" value="<?php echo $pripromin?>" size="12" <?php if ($estado == 0){?>disabled="disabled"<?php }?>/>              </td>
            </tr>
            <tr>
              <td><strong>CUOTA</strong></td>
              <td><input name="cuota" type="text" id="cuota" onkeypress="return decimal(event);" value="<?php echo $cuota?>" size="12" <?php if ($estado == 0){?>disabled="disabled"<?php }?>/>
                  <input name="codpro" type="hidden" id="codpro" value="<?php echo $codpro1?>" />
                  <input name="factor" type="hidden" id="factor" value="<?php echo $factor?>" />
                  <input name="val" type="hidden" id="val" value="<?php echo $val?>" />
                  <input name="p1" type="hidden" id="p1" value="<?php echo $p1?>" />
                  <input name="ord" type="hidden" id="ord" value="<?php echo $ord?>" />
                  <input name="inicio" type="hidden" id="inicio" value="<?php echo $inicio?>" />
                  <input name="pagina" type="hidden" id="pagina" value="<?php echo $pagina?>" />
                  <input name="tot_pag" type="hidden" id="tot_pag" value="<?php echo $tot_pag?>" />
                  <input name="registros" type="hidden" id="registros" value="<?php echo $registros?>" />
                  <input name="valform" type="hidden" id="valform" />
                  <input type="button" name="Submit22" value="Actualizar Informacion" onclick="validarform();" <?php if ($estado == 0){?>disabled="disabled"<?php }?>/>
				  <input type="button" name="Submit22" value="Cerrar" onclick="validarcerrar();"/>
                  <?php if ($estado == 0){?>
                (UD DEBE CAMBIAR EL ESTADO DEL PRODUCTO A INCENTIVADO)
                <?php }?>              </td>
            </tr>
          </table></td>
          <td width="180" valign="top" bgcolor="#FFFFFF">
		    <iframe src="incentivo3_3.php?codpro=<?php echo $cod;?>&&invnum=<?php echo $invnum?>&&val=<?php echo $val?>&&valform=1&&p1=<?php echo $p1?>&&&ord=<?php echo $ord?>&&tip=<?php echo $tip?>&&inicio=<?php echo $inicio?>&&pagina=<?php echo $pagina?>&&tot_pag=<?php echo $tot_pag?>&&registros=<?php echo $registros?>" name="marco3" id="marco3" width="180" height="180" scrolling="Automatic" frameborder="0" allowtransparency="0"> </iframe>
		  </td>
        </tr>
      </table>
      </td>
    </tr>
  </table>
  <div align="center"><img src="../../../images/line2.png" width="931" height="4" /></div>
  <?php }
	  ?>
<table width="927" border="0">
    <tr>
      <td><strong>PRODUCTO</strong>
	  <a href="incentivo3.php?val=<?php echo $val?>&&p1=<?php echo $p1?>&&ord=1&&tip=1&&inicio=<?php echo $inicio?>&&pagina=<?php echo $pagina?>&&tot_pag=<?php echo $tot_pag?>&&registros=<?php echo $registros?>"><img src="../css/down_enabled.gif" width="7" height="9" border="0" /></a> 
	  <a href="incentivo3.php?val=<?php echo $val?>&&p1=<?php echo $p1?>&&ord=1&&tip=2&&inicio=<?php echo $inicio?>&&pagina=<?php echo $pagina?>&&tot_pag=<?php echo $tot_pag?>&&registros=<?php echo $registros?>"><img src="../css/up_enabled.gif" width="7" height="9" border="0"/></a>      </td>
      <td width="17">&nbsp;</td>
    </tr>
  </table>
  <table width="927" border="0">
	<?php $z = 0;
	///////////////////////////////////////////////////////SOLO SE INGRESA EL TEXT0
	if ($ord == "")
	{
		if ($val == 1)
		{
	$sql="SELECT codpro,desprod,incentivado FROM producto where desprod like '%$p1%' LIMIT $inicio, $registros";
		}
		else
		{
		 if ($val == 2)
		 {
		 $sql="SELECT producto.codpro,desprod,incentivado FROM producto inner join incentivadodet on producto.codpro = incentivadodet.codpro group by producto.codpro order by desprod LIMIT $inicio, $registros";	
		 }
		 else
		 {
	     $sql="SELECT codpro,desprod,incentivado FROM producto order by desprod LIMIT $inicio, $registros";	
		 }
		}
	}
	///////////////////////////////////////////////////////SE SELECCIONO PARA ORDENAR POR PRODUCTO
	if ($ord == 1)
	{
		if ($val == 1)
		{
	    $sql="SELECT codpro,desprod,incentivado FROM producto where desprod like '%$p1%' order by desprod $dtip LIMIT $inicio, $registros";
		}
		else
		{
		 if ($val == 2)
		 {
		 $sql="SELECT producto.codpro,desprod,incentivado FROM producto inner join incentivadodet on producto.codpro = incentivadodet.codpro group by producto.codpro order by desprod $dtip LIMIT $inicio, $registros";	
		 }
		 else
		 {
	     $sql="SELECT codpro,desprod,incentivado FROM producto order by desprod $dtip LIMIT $inicio, $registros";
		 }
		}
	}
	///////////////////////////////////////////////////////SE SELECCIONO PARA ORDENAR POR INCENTIVOS
	if ($ord == 2)
	{
		if ($val == 1)
		{
	$sql="SELECT codpro,desprod,incentivado FROM producto where desprod like '$p1%' order by incentivado $dtip LIMIT $inicio, $registros";
		}
		else
		{
		 if ($val == 2)
		 {
		 $sql="SELECT producto.codpro,desprod,incentivado FROM producto inner join incentivadodet on producto.codpro = incentivadodet.codpro group by producto.codpro order by incentivado $dtip LIMIT $inicio, $registros";	
		 }
		 else
		 {
	     $sql="SELECT codpro,desprod,incentivado FROM producto order by incentivado $dtip LIMIT $inicio, $registros";
		 }
		}
	}
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	while ($row = mysqli_fetch_array($result)){
		$codpro         = $row['codpro'];
		$desprod        = $row['desprod'];
		$incentivado    = $row['incentivado'];
		$sql1="SELECT codpro FROM incentivadodet where codpro = '$codpro' and invnum = '$invnumss'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
			$sihay = 1;
		}
		else
		{
			$sihay = 0;
		}
		if ($incentivado == 1)
		{
			$des_incent = "INCENTIVADO";
		}
		else
		{
			$des_incent = "NO INCENTIVADO";
		}
		$z++;
	?>
      <tr <?php if (($valform == 1) && ($cod == $codpro)){?> bgcolor="#FFFF33"<?php } else {?>onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#ffffff';"<?php }?>>
        <td width="894">
		<?php if (($countregx >= 1) || ($sihay == 1)){?>
		<a id="l<?php echo $z;?>" href="incentivo3.php?cod=<?php echo $codpro;?>&&val=<?php echo $val?>&&valform=1&&p1=<?php echo $p1?>&&ord=<?php echo $ord?>&&tip=<?php echo $tip?>&&inicio=<?php echo $inicio?>&&pagina=<?php echo $pagina?>&&tot_pag=<?php echo $tot_pag?>&&registros=<?php echo $registros?>"><?php echo $desprod;?></a>		
		<?php }
		else
		{
		?>
		<font color="#0066CC"><?php echo $desprod;?></font>
		<?php }
		?>		</td>
		<td width="6" bgcolor="#00CC33" <?php if ($incentivado == 1){?>bgcolor="#FFFF33"<?php }?>></td>
        <td width="22">
		<div align="right">
		<?php //if ((($incentivado == 1) and ($countregx == 1)) || ($sihay == 1)){?>
		<?php if (($countregx >= 1) || ($sihay == 1)){?>
		<a href="incentivo3.php?cod=<?php echo $codpro;?>&&val=<?php echo $val?>&&valform=1&&p1=<?php echo $p1?>&&ord=<?php echo $ord?>&&tip=<?php echo $tip?>&&inicio=<?php echo $inicio?>&&pagina=<?php echo $pagina?>&&tot_pag=<?php echo $tot_pag?>&&registros=<?php echo $registros?>">
		<img src="../../../images/edit_16.png" width="16" height="16" border="0"/>		
		</a>
		<?php }?>
		</div>		</td>
      </tr>
    <?php }
	}
    ?>
  </table>
</form>
</body>
</html>
