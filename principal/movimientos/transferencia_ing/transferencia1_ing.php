<?php include('../../session_user.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/select.css" rel="stylesheet" type="text/css" />
<?php require_once ('../../../conexion.php');	//CONEXION A BASE DE DATOS
require_once ('../../../convertfecha.php');	//CONEXION A BASE DE DATOS
require_once("../../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../../funciones/botones.php");	//COLORES DE LOS BOTONES
require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUMEROS ENTEROS-DECIMALES
require_once("../funciones/transferencia_ing.php");	//FUNCIONES DE ESTA PANTALLA
////////////////////////////////////////////////////////////////////////////////////////////////
?>
<?php $sql="SELECT invnum FROM movmae where usecod = '$usuario' and proceso = '1'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result) ){
while ($row = mysqli_fetch_array($result)){
		$invnum          = $row['invnum'];		//codigo
}
}
$_SESSION['transferencia_ing']	= $invnum; 	////GRABO UNA SESION CON EL MOVIMIENTO QUE ESTOY REALIZANDO
$sql="SELECT codloc,nomusu FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$codloc       = $row['codloc'];			//////OBTENGO EL CODIGO DEL LOCAL ACTUAL O DESTINO
	$user    	  = $row['nomusu'];
}
}
////////////////////////////////////////////////////////////////////////////////////////////////
$sql="SELECT invnum,invfec,numdoc FROM movmae where invnum = '$invnum'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
		$cod          = $row['invnum'];		//codgio
		$fecha        = $row['invfec'];
		$numdoc       = $row['numdoc'];
}
}
///////CUENTA CUANTOS REGISTROS LLEVA LA COMPRA

function formato($c) {
printf("%08d",  $c);
} 
function formato1($c) {
printf("%06d",  $c);
} 
$srch = isset($_REQUEST['srch']) ? ($_REQUEST['srch']) : "";	
$val = isset($_REQUEST['val']) ? ($_REQUEST['val']) : "";

///////////////////////////////////////////////////////////////////
if ($val == 1)
{
	 $documento = isset($_REQUEST['documento']) ? ($_REQUEST['documento']) : "";	
	 $local	    = isset($_REQUEST['local']) ? ($_REQUEST['local']) : "";
	 $sql="SELECT invnum FROM movmae where numdoc = '$documento' and sucursal = '$local' and sucursal1 = '$codloc' and tipmov = '2' and tipdoc = '3' and estado = '0' and proceso = '0' and val_habil = '0'";					/////OBTENGO EL DOCUMENTO
	 $result = mysqli_query($conexion,$sql);
	 if (mysqli_num_rows($result)){
	 while ($row = mysqli_fetch_array($result)){
		 $srch=1;
		 $codorigen       = $row['invnum'];
		 mysqli_query($conexion,"UPDATE movmae set invnumrecib = '$codorigen' where invnum = '$invnum'");
	 }
	 }
	 else
	 {
	 $srch=0;
	 }
}
$sql1="SELECT invnumrecib FROM movmae where invnum = '$invnum'";
$result1 = mysqli_query($conexion,$sql1);
if (mysqli_num_rows($result1)){
while ($row1 = mysqli_fetch_array($result1)){
	$invnumrecib        = $row1['invnumrecib'];		////NOMBRE DE QUIEN REALIZO LA TRANSFERENCIA
}
}
if (($invnumrecib <> "")&&($invnumrecib <> 0)) {
		require_once("grabamov.php");
	}
/////////////CUENTA SI AY OTROS INGRESOS PENDIENTES A ESTE MISMO LOCAL
$sql="SELECT count(invnum) FROM movmae where sucursal1 = '$codloc' and tipmov = '2' and tipdoc = '3' and estado = '0' and proceso = '0' and val_habil = '0'";					/////OBTENGO EL DOCUMENTO
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
		$cuenta          = $row[0];	
}
}
$sql="SELECT count(*) FROM tempmovmov where invnum = '$invnum'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
		$count        = $row[0];	////CANTIDAD DE REGISTROS EN EL GRID
}	
}
else
{
$count = 0;	////CUANDO NO HAY NADA EN EL GRID
}
?>
<script>
function compras3(e)
{
	tecla=e.keyCode;
	var f = document.form1;
	var a = f.count.value;
	alert(a);
}
function compras2(e)
{
	tecla=e.keyCode;
	var f = document.form1;
	var a = f.count.value;
	
	 if(tecla==119)
  	 {
		  if (a == 0)
		  {
		  alert('No se puede grabar este Documento');
		  }
		  else
		  {
			 
			  ventana=confirm("Desea Grabar estos datos");
			  if (ventana) {
			  f.method = "POST";
			  f.target = "_top";
			  f.action ="transferencia1_ing_reg.php";
			  f.submit();
			  }
		  }
	 }
	 if(tecla==120)
  	 {
		 if ((a == 0))
		 {
		 alert('No se puede realizar la impresi�n de este Documento');
		 }
		 else
		 {
			  f.method = "POST";
			  f.target = "_top";
			  f.action ="transferencia1_ing_op_reg.php";
			  f.submit();
		 }
	 }
}
function grabardoc()
{
	var f = document.form1;
	var a = f.count.value;
	if (a == 0)
	  {
	  alert('No se puede grabar este Documento');
	  }
	  else
	  {
		 
		  ventana=confirm("Desea Grabar estos datos");
		  if (ventana) {
		  f.method = "POST";
		  f.target = "_top";
		  f.action ="transferencia1_ing_reg.php";
		  f.submit();
		  }
	  }
}
function imprimirdoc()
{
	var f = document.form1;
	var a = f.count.value;
	if ((a == 0))
		 {
		 alert('No se puede realizar la impresi�n de este Documento');
		 }
		 else
		 {
			  f.method = "POST";
			  f.target = "_top";
			  f.action ="transferencia1_ing_op_reg.php";
			  f.submit();
		 }
}
</script>
</head>
<body onkeyup="compras2(event)" onload="<?php if ($cuenta > 0){ ?> popup();<?php } else { if ($srch==1){?>sb()<?php } else {?>sf()<?php }}?>">
<form name="form1" id="form1" onClick="highlight(event)" onKeyUp="highlight(event)">
  <table width="968" border="0">
    <tr>
      <td width="958"><table width="932" border="0">
        <tr>
          <td width="302"><div align="center">
              <input name="first" type="button" id="first" value="Primero" class="primero" disabled="disabled"/>
              <input name="prev" type="button" id="prev" value="Anterior" class="anterior" disabled="disabled"/>
              <input name="next" type="button" id="next" value="Siguiente" class="siguiente" disabled="disabled"/>
              <input name="fin" type="button" id="fin" value="Ultimo" class="ultimo" disabled="disabled"/>
          </div></td>
          <td width="10">&nbsp;</td>
          <td width="606"><label>
              <div align="right">
                
                <input name="nuevo" type="button" id="nuevo" value="Nuevo" class="nuevo" disabled="disabled"/>
                <input name="modif" type="button" id="modif" value="Modificar" class="modificar" disabled="disabled"/>
                <input name="count" type="hidden" id="count" value="<?php echo $count?>" />
                <input name="cod" type="hidden" id="cod" value="<?php echo $invnum?>" />
                <input name="sum33" type="hidden" id="sum33" value="<?php echo $sum33?>" />
				
                <input name="ext" type="button" id="ext" value="Cancelar" onclick="cancelar()" class="cancelar"/>
                <input name="sal" type="button" id="sal" value="Salir" onclick="salir()" class="cancelar"/>
			<!--	<input name="save" type="button" id="save" value="Grabar" onclick="grabardoc()" class="grabar" <?php if (($count == 0)||($count1>0)){?>disabled="disabled" <?php }?>/>
				<input name="printer" type="button" id="printer" value="Grabar e Imprimir" class="imprimir" onclick="imprimirdoc()" <?php if (($count == 0)||($count1>0)){?>disabled="disabled" <?php }?>/>-->
              </div>
            </label></td>
        </tr>
      </table>
        <div align="center"><img src="../../../images/line2.png" width="950" height="4" /> </div>
        <table width="954" border="0">
          <tr>
            <td width="76">NUMERO</td>
            <td width="103"><input name="textfield" type="text" size="15" disabled="disabled" value="<?php echo formato($numdoc)?>"/></td>
            <td width="289"><div align="right">FECHA</div></td>
            <td width="148"><input name="textfield2" type="text" size="22" disabled="disabled" value="<?php echo fecha($fecha)?>"/></td>
            <td width="10">&nbsp;</td>
            <td width="10">&nbsp;</td>
            <td width="288"><div align="right" class="text_combo_select">USUARIO : <img src="../../../images/user.gif" width="15" height="16" /> <?php echo $user?></div></td>
          </tr>
        </table>
          
          <table width="954" border="0">
            <tr>
              <td width="75">DOCUMENTO</td>
              <td width="224">
			  <input name="documento" type="text" id="documento" size="20" value="<?php echo $documento?>" onkeyup="this.value = this.value.toUpperCase();"/></td>
              <td width="169"><div align="right">LOCAL DE PROCEDENCIA </div></td>
              <td width="468">
			  <select name="local" id="local" onchange="cargarContenido()">
                <?php 
				//$sql = "SELECT * FROM xcompa where codloc <> '$codigo_local' and codloc <> '1' and habil = '1'"; 
				$sql = "SELECT * FROM xcompa where habil = '1' order by nombre, nomloc"; 
				$result = mysqli_query($conexion,$sql); 
				while ($row = mysqli_fetch_array($result)){ 
				?>
                <option value="<?php echo $row['codloc'];?>" <?php if ($local == $row['codloc']){?> selected="selected"<?php }?>>
                  <?php if ($row["nombre"]<>""){ echo $row['nombre'];} else { echo $row['nomloc'];} ?>
                </option>
                <?php } ?>
              </select>
              <label>
                <input name="srch" type="hidden" id="srch" value="1" />
                <input name="val" type="hidden" id="val" value="1" />
                <input type="button" name="busk" value="BUSCAR" class="buscar" onclick="validar()"/>
              </label></td>
            </tr>
          </table>
          <table width="954" border="0">
            <tr>
              <td width="67">&nbsp;</td>
              <td width="109"><label></label></td>
              <td width="39">&nbsp;</td>
              <td width="100"><label></label></td>
              <td width="74">&nbsp;</td>
              <td width="445" class="login"><div align="right">F8 = GRABAR </div></td>
              <td width="90" class="login"><div align="right">F9 = IMPRIMIR </div></td>
            </tr>
          </table>
          <div align="center"><img src="../../../images/line2.png" width="950" height="4" /></div>
          <table width="962" border="0">
            <tr>
              <td width="955">
			  <?php 
			  $val = isset($_REQUEST['val']) ? ($_REQUEST['val']) : "";	
			  if ($val == 1)
			  {
			  $documento = isset($_REQUEST['documento']) ? ($_REQUEST['documento']) : "";
			  $local	 = isset($_REQUEST['local']) ? ($_REQUEST['local']) : "";
			  ?>
			  <iframe src="transferencia2_ing.php?doc=<?php echo $documento?>&local=<?php echo $local?>&val=1" name="iFrame2" width="954" height="448" scrolling="Automatic" frameborder="0" id="iFrame2" allowtransparency="0"> </iframe>
			  <?php }
			  else
			  {
			  ?>
			  <iframe src="transferencia2_ing.php" name="iFrame2" width="954" height="448" scrolling="Automatic" frameborder="0" id="iFrame2" allowtransparency="0"> </iframe>
			  <?php }
			  ?>			  </td>
            </tr>
        </table>
		  <div align="center"><img src="../../../images/line2.png" width="950" height="4" /> </div>
		  <br></td>
    </tr>
  </table>
</form>
</body>
</html>
