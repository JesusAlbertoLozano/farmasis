<?php include('../../session_user.php');
$invnum  = $_SESSION['transferencia_sal'];
$qtyprf1 = "";
$qtypro1 = "";
$prisal1 = "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Documento sin t&iacute;tulo</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
<link href="../../../css/autocomplete.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../../funciones/ajax.js"></script>
<script type="text/javascript" src="../../../funciones/ajax-dynamic-list.js"></script>
<?php require_once ('../../../conexion.php');	//CONEXION A BASE DE DATOS
  require_once('../../../convertfecha.php');    //CONEXION A BASE DE DATOS
require_once("../funciones/transferencia.php");	//FUNCIONES DE ESTA PANTALLA
require_once("../../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
require_once("../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUMEROS ENTEROS-DECIMALES
require_once("../../../funciones/botones.php");	//COLORES DE LOS BOTONES
?>
<script>
function texto(){
			var v1 = parseFloat(document.form1.text1.value);		//CANTIDAD
		var factor = parseFloat(document.form1.factor.value);	//FACTOR
		
		            var valor = isNaN(v1);
                    if (valor == true)
                    {
                        
                         var fracion = document.form1.text1.value.substring(1);
                         //document.getElementById("campotexto").innerHTML = fracion + 'factor =' +factor;
                         if(factor > 1){
                		         convert1 = fracion / factor;
                		         caja = parseInt((convert1));
                                 unidad = (fracion - (caja * factor));
                                 stocknuevo = ' C '+ caja  + '+ F' + unidad;
                                 document.getElementById("campotexto").innerHTML = stocknuevo;
                		}else{
                		         convert1 = fracion / factor;
                                 caja = parseInt((convert1));
                                 stocknuevo = 'C' + caja  ;
                                 document.getElementById("campotexto").innerHTML = stocknuevo;
                	    }
                         
                    }else{
                        
                       if(factor > 1){
                		         
                                 stocknuevo = ' C '+ v1  + '+ F' + ' 0 ';
                                 document.getElementById("campotexto").innerHTML = stocknuevo;
                		}else{
                		         convert1 = v1 / factor;
                                 caja = parseInt((convert1));
                                  stocknuevo = 'C' + caja  ;
                                 document.getElementById("campotexto").innerHTML = stocknuevo;
                	    }
                	    
                    }
	
	}
function cerrar(e){
tecla=e.keyCode
	if (tecla == 27)
	{
	document.form1.method = "post";
	document.form1.submit();
	}
}
var statSend = false;
var nav4 = window.Event ? true : false;
function entero(evt){
var key = nav4 ? evt.which : evt.keyCode;
	if (key == 13)
	{
	    if (!statSend) {
		var f  = document.form1;
		var v1 = parseFloat(document.form1.text1.value);		//CANTIDAD
		
		
		
		var v2 = parseFloat(document.form1.text2.value);		//PRECIO PROMEDIO
		var v3 = parseFloat(document.form1.stock.value);		//CANTIDAD ACTUAL POR LOCAL
		var factor = parseFloat(document.form1.factor.value);	//FACTOR
		if (v1 == "")
		{
			alert('Debe ingresar un valor diferente a 0 o vacio');return;
		}
		else
		{
			//alert("V1="+v1+",v2="+v2+",v3="+v3+",factor="+factor);
			//v1 = v1 * factor;
			
			
			    var valor = isNaN(v1);
                    if (valor == true)
                    {
                        if(factor == 1){
                                alert("El Producto tiene factor 1 solo cantidad entera");
                                document.form1.text1.focus();
                                return;
                        }
                        var porcion = document.form1.text1.value.substring(1);
                       if ((porcion)>v3)
                			{ alert("La cantidad Ingresada excede al Stock Actual del Producto"); f.text1.focus(); return;
                			}
                			
                		if ((porcion == 0) || (porcion == ""))
                    		{ 
                    		alert('Debe ingresar un valor diferente a 0 o vacio');document.form1.text1.focus();
                    		return;
                    		}	
                    } else
                    {
                        if ((v1*factor)>v3)
                			{ alert("La cantidad Ingresada excede al Stock Actual del Producto"); f.text1.focus(); return;
                			}
                			
                        if ((v1 == 0) || (v1 == ""))
                    		{ 
                    		alert('Debe ingresar un valor diferente a 0 o vacio');document.form1.text1.focus();
                    		return;
                    		}
                        
                    }
			
		}
	var total;
	var valor = isNaN(v1);
	if (valor == true)
	{
	var porcion = document.form1.text1.value.substring(1);
	var fact	= parseFloat(porcion/factor);
	total       = parseFloat(fact * v2);
	document.form1.number.value=1;		////avisa que no es numero
	}
	else
	{
		
	total  = parseFloat(v1 * v2);
	document.form1.number.value=0;		////avisa que es numero
	}
	total = Math.round(total*Math.pow(10,2))/Math.pow(10,2); 
	
	document.form1.text3.value=total;
	f.method = "post";
	f.action = "transferencia2_sal_reg.php";
	f.target = "tranf_principal";
	f.submit();
	
	                       
 statSend = true;
        return true;
    } else {
        alert("El proceso esta siendo cargado espere un momento...");
        return false;
    }
	}
 return (key <= 13 || key <= 46 || (key >= 48 && key <= 57));
}

/////////////////////////////////////////////////
var statSend = false;
var nav4 = window.Event ? true : false;
function ent(evt){
var key = nav4 ? evt.which : evt.keyCode;
	if (key == 13)
	{
	    if (!statSend) {
		var f  = document.form1;
		var v1 = parseFloat(document.form1.text1.value);		//CANTIDAD
		if ((v1 == 0) || (v1 == ''))
		{ 
		alert('Debe ingresar un valor diferente a 0 o vacio');document.form1.text1.focus();
		return;
		}
		var v2 = parseFloat(document.form1.text2.value);		//PRECIO PROMEDIO
		var v3 = parseFloat(document.form1.stock.value);		//CANTIDAD ACTUAL POR LOCAL
		var factor = parseFloat(document.form1.factor.value);	//FACTOR
		
		
		if (v1 == "")
		{
			alert('Debe ingresar un valor diferente a 0 o vacio ');return;
		}
		else
		{
			//alert("V1="+v1+",v2="+v2+",v3="+v3+",factor="+factor);
			//v1 = v1 * factor;
			
			
			    var valor = isNaN(v1);
                    if (valor == true)
                    {
                        if(factor == 1){
                                alert("El Producto tiene factor 1 solo cantidad entera");
                                document.form1.text1.focus();
                                return;
                        }
                        var porcion = document.form1.text1.value.substring(1);
                       if ((porcion)>v3)
                			{ alert("La cantidad Ingresada excede al Stock Actual del Producto"); f.text1.focus(); return;
                			}
                			
                			if ((porcion == 0) || (porcion == ""))
                    		{ 
                    		alert('Debe ingresar un valor diferente a 0 o vacio');document.form1.text1.focus();
                    		return;
                    		}
                    } else
                    {
                        if ((v1*factor)>v3)
                			{ alert("La cantidad Ingresada excede al Stock Actual del Producto"); f.text1.focus(); return;
                			}
                        if ((v1 == 0) || (v1 == ""))
                    		{ 
                    		alert('Debe ingresar un valor diferente a 0 o vacio');document.form1.text1.focus();
                    		return;
                    		}
                        
                    }
			
		}
	var total;
	var valor = isNaN(v1);
	if (valor == true)
	{
	var porcion = document.form1.text1.value.substring(1);
	var fact	= parseFloat(porcion/factor);
	total       = parseFloat(fact * v2);
	document.form1.number.value=1;		////avisa que no es numero
	}
	else
	{
		
	total  = parseFloat(v1 * v2);
	document.form1.number.value=0;		////avisa que es numero
	}
	total = Math.round(total*Math.pow(10,2))/Math.pow(10,2); 
	
	document.form1.text3.value=total;
	f.method = "post";
	f.action = "transferencia2_sal_reg.php";
	f.target = "tranf_principal";
	f.submit();
	
	                       
 statSend = true;
        return true;
    } else {
        alert("El proceso esta siendo cargado espere un momento...");
        return false;
    }
	}
return (key == 70 || key == 102 || (key <= 13 || (key >= 48 && key <= 57)));
}
var statSend = false;
var nav4 = window.Event ? true : false;
function ent1(evt){
var key = nav4 ? evt.which : evt.keyCode;
	if (key == 13)
	{
	    if (!statSend) {
	var f  = document.form1;
	var v1 = parseFloat(document.form1.text1.value);		//CANTIDAD
	var v2 = parseFloat(document.form1.text2.value);		//PRECIO PROMEDIO
	var v3 = parseFloat(document.form1.stock.value);		//CANTIDAD ACTUAL POR LOCAL
	var factor = parseFloat(document.form1.factor.value);	//FACTOR
	if (v1 == "")
	{
	}
	else
	{
		
		
		
		var valor = isNaN(v1);
                    if (valor == true)
                    {
                        
                        if(factor == 1){
                                alert("El Producto tiene factor 1 solo cantidad entera");
                                document.form1.text1.focus();
                                return;
                        }
                        var porcion = document.form1.text1.value.substring(1);
                       if ((porcion)>v3)
                			{ alert("La cantidad Ingresada excede al Stock Actual del Producto"); f.text1.focus(); return;
                			}
                    } else
                    {
                        v1 = v1 * factor;
                		if (v1>v3)
                		{ alert("La cantidad Ingresada excede al Stock Actual del Producto"); f.text1.focus(); return;
                		}
                        
                        
                    }
	}
	var total;
	var valor = isNaN(v1);
	if (valor == true)
	{
	var porcion = document.form1.text1.value.substring(1);
	var fact	= parseFloat(porcion/factor);
	total       = parseFloat(fact * v2);
	document.form1.number.value=1;		////avisa que no es numero
	}
	else
	{
	total  = parseFloat(v1 * v2);
	document.form1.number.value=0;		////avisa que es numero
	}
	total = Math.round(total*Math.pow(10,2))/Math.pow(10,2); 
	f.method = "post";
	f.action = "transferencia2_sal_reg.php";
	f.target = "tranf_principal";
	f.submit();
	                    statSend = true;
        return true;
    } else {
        alert("El proceso esta siendo cargado espere un momento...");
        return false;
    }
	}
return (key <= 13 || key == 46 || (key >= 48 && key <= 57));
}
function caj1(){
	document.form1.text1.focus();
}
function compras1(e)
{
	/*tecla=e.keyCode;
	var f = document.form1;
	var a = f.carcount.value;
	var b = f.carcount1.value;
	 if(tecla==119)
  	 {
		  if ((a == 0)||(b>0))
		  {
		  alert('No se puede grabar este Documento');
		  }
		  else
		  {
		  	  var f = document.form1;
			  if (f.date1.value == "")
			  { alert("Ingrese la Fecha del Documento"); f.date1.focus(); return; }
			  if (f.n1.value == "")
			  { alert("Ingrese el Nro del Documento"); f.n1.focus(); return; }
			  if (f.n2.value == "")
			  { alert("Ingrese el Nro del Documento"); f.n2.focus(); return; }
			  if (f.fpago.value == "")
			  { alert("Ingrese el tipo de Pago"); f.fpago.focus(); return; }
			  if (f.plazo.value == "")
			  { alert("Ingrese el plazo"); f.plazo.focus(); return; }
			  if (f.date2.value == "")
			  { alert("Ingrese la Fecha de Vencimiento"); f.date2.focus(); return; }
			  if ((f.mont5.value == "") || (f.mont5.value == "0.00"))
			  { alert("El sistema arroja un TOTAL = a 0. Revise por Favor!"); f.mont5.focus(); return; }
			  ventana=confirm("Desea Grabar estos datos");
			  if (ventana) {
			  f.method = "POST";
			  f.target = "_top";
			  f.action ="compras1_reg.php";
			  f.submit();
			  }
		  }
	 }
	 if(tecla==120)
  	 {
		 if ((a == 0)||(b>0))
		 {
		 alert('No se puede realizar la impresi�n de este Documento');
		 }
		 else
		 {
		 	if (window.print)
  			  window.print()
  			else
   			 alert("Disculpe, su navegador no soporta esta opci�n.");
		 }
	 }*/
}
</script>

  <style>

            #country {
                width: 75%;
                box-sizing: border-box;
                border: 2px solid #ccc;
                border-radius: 5px;
                font-size: 14px;
                background-color: white;
                background-image: url('../compras/buscador.png');
                background-position: 3px 3px; 
                background-repeat: no-repeat;
                padding: 5px 15px 3px 35px;
            }
            input {
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 12px;
      background-color: white;
      background-position: 3px 3px;
      background-repeat: no-repeat;
      padding: 2px 1px 2px 5px;

    }

    .LETRA2 {
      background: #d7d7d7
    }
        </style>
</head>
<?php $sql="SELECT codloc FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
		$codloc  = $row['codloc'];
}
}
$sql="SELECT nomloc FROM xcompa where codloc = '$codloc'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
    	$nomloc    = $row['nomloc'];
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
	///////CUENTA CUANTOS REGISTROS NO SE HAN LLENADO
	$sql="SELECT count(*) FROM tempmovmov where invnum = '$invnum' and qtypro = '0' and qtyprf = ''";
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
	while ($row = mysqli_fetch_array($result)){
			$count1        = $row[0];	////CUANDO HAY UN GRID PERO CON DATOS VACIOS
	}	
	}
	else
	{
	$count1 = 0;	////CUANDO TODOS LOS DATOS ESTAN CARGADOS EN EL GRID
	}
$val = isset($_REQUEST['val']) ? ($_REQUEST['val']) : "";
$ok = isset($_REQUEST['ok']) ? ($_REQUEST['ok']) : "";
if ($val == 1)
{
	$producto =	isset($_REQUEST['country_ID']) ? ($_REQUEST['country_ID']) : "";
	if ($producto <> "")
	{
		$sql1="SELECT codtemp FROM tempmovmov where codpro = '$producto' and invnum = '$invnum'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
			$search = 0;
		}
		else
		{
			$search = 1;
		}
	}
	else
	{
	$search = 0;
	}
}
else
{
$search = 0;
}
require_once('../tabla_local.php');
$valform = isset($_REQUEST['valform']) ? ($_REQUEST['valform']) : "";
$cprod   = isset($_REQUEST['cprod']) ? ($_REQUEST['cprod']) : "";
?>
<body onload="<?php if ($valform == 1){ ?> caj1();<?php } else { if ($search==1){?>links()<?php } else{?>sf()<?php }}?>" onkeyup="compras1(event)">
<form id="form1" name="form1" onKeyUp="highlight(event)" onClick="highlight(event)" method = "post">
  <table width="910" border="0">
    <tr>
      
      <td width="614">
         <input name="country" type="text" id="country" onkeyup="ajax_showOptions(this, 'getCountriesByLetters', event)" placeholder="Buscar producto ..." value="" size="160"/>
        <input type="hidden" id="country_hidden" name="country_ID" />
        <input name="carcount" type="hidden" id="carcount" value="<?php echo $count;?>" />
        <input name="carcount1" type="hidden" id="carcount1" value="<?php echo $count1;?>" /></td>
      <td width="192">
        <input name="val" type="hidden" id="val" value="1" />
       
      </td>
    </tr>
  </table>
  <?php 
  $val = isset($_REQUEST['val']) ? ($_REQUEST['val']) : "";
  if ($val ==1)
  {
  $i= 0;
  $producto =	isset($_REQUEST['country_ID']) ? ($_REQUEST['country_ID']) : "";
    $sql="SELECT codpro,desprod,codmar,$tabla FROM producto where codpro = '$producto' order by desprod";
	//$sql="SELECT codpro,desprod,codmar,$tabla FROM producto where codmar = '$producto' order by desprod";
	$result = mysqli_query($conexion,$sql);
	if (mysqli_num_rows($result)){
  ?>
  
  <table class="celda2" width="910" border='0'>
       <tr>
      <th width="3" bgcolor="#50ADEA" class="titulos_movimientos">N&ordm;</th>
        <th width="5" bgcolor="#50ADEA" class="titulos_movimientos">CODIGO</th>
      <th width="200" bgcolor="#50ADEA" class="titulos_movimientos">DESCRIPCION</th>
      <th width="111" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">MARCA</div></th>
      <th width="10" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">FACTOR</div></th>
	  <th width="10" bgcolor="#50ADEA" class="titulos_movimientos"><div align="center">LOCAL</div></th>
	  <th width="55" bgcolor="#50ADEA" class="titulos_movimientos"><div align="right">STOCK ACTUAL </div></th>
	  <th <?php if (($valform == 1)){?>colspan='3' <?php }else{ ?> colspan='1' width="50" <?php } ?> bgcolor="#50ADEA" class="titulos_movimientos"><div align="CENTER">CANT - SALIDA</div></th>
	  <th width="68" bgcolor="#50ADEA" class="titulos_movimientos"><div align="right">P. PROM</div></th>
      
      <th width="17" bgcolor="#50ADEA" class="titulos_movimientos">&nbsp;</th>
    </tr>
    <?php while ($row = mysqli_fetch_array($result)){
			$i++;
			$codpro         = $row['codpro'];		//codgio
			$desprod        = $row['desprod'];
			$codmar         = $row['codmar'];
			$cant_loc       = $row[3];
			$sql1="SELECT ltdgen FROM titultabla where dsgen = 'MARCA'";
			$result1 = mysqli_query($conexion,$sql1);
			if (mysqli_num_rows($result1)){
			while ($row1 = mysqli_fetch_array($result1)){
				$ltdgen     = $row1['ltdgen'];	
			}
			}
			$sql1="SELECT desprod,codmar,factor,costpr,stopro,$tabla FROM producto where codpro = '$codpro'";
			$result1 = mysqli_query($conexion,$sql1);
			if (mysqli_num_rows($result1)){
			while ($row1 = mysqli_fetch_array($result1)){
				$desprod    = $row1['desprod'];
				$codmar     = $row1['codmar'];
				$factor     = $row1['factor'];	
				$costpr     = $row1['costpr'];  ///COSTO PROMEDIO
				$stopro     = $row1['stopro'];	///STOCK EN UNIDADES DEL PRODUCTO GENERAL
				$cant_loc   = $row1[5];
			}
			}
			$sql1="SELECT destab FROM titultabladet where codtab = '$codmar' and tiptab = '$ltdgen'";
			$result1 = mysqli_query($conexion,$sql1);
			if (mysqli_num_rows($result1)){
			while ($row1 = mysqli_fetch_array($result1)){
				$marca     = $row1['destab'];	
			}
			}
			$sql1="SELECT qtypro,qtyprf,prisal FROM tempmovmov where invnum = '$invnum' and codpro = '$codpro'";
			$result1 = mysqli_query($conexion,$sql1);
			if (mysqli_num_rows($result1)){
			while ($row1 = mysqli_fetch_array($result1)){
				$qtypro1         = $row1['qtypro'];	
				$qtyprf1         = $row1['qtyprf'];
				$prisal1         = $row1['prisal'];	
			}
			}
			$sql1="SELECT codtemp FROM tempmovmov where codpro = '$codpro' and invnum = '$invnum'";
			$result1 = mysqli_query($conexion,$sql1);
			if (mysqli_num_rows($result1)){
				$control = 1;
			}
			else
			{
				$control = 0;
			}
	?>
	 <tr onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#ffffff';">
      <td  align="CENTER"><?php echo $i;?></td>
      <td  align="CENTER"><?php echo $codpro;?></td>
      <td>
	  <?php if ($control == 0){ 
	  	 if ($cant_loc > 0) 
		 {
	   ?>
	  		<a id="l1" href="transferencia2_sal.php?country_ID=<?php echo $producto?>&valform=1&val=<?php echo $val?>&cprod=<?php echo $codpro?>"><?php echo $desprod?>
			</a>
	  		<?php }
	      else
	      {
	      echo $desprod;
	      }
	   }
	   else
	   {
	   echo $desprod;
	   }
	  ?>	  </td>
      <td ><?php echo $marca;?></td>
       <td  align="CENTER"><?php echo $factor;?></td>
      
	  <td align="CENTER"><?php echo $nomloc;?></td>
      <td ><div align="right"><?php echo stockcaja($cant_loc, $factor); ?></div></td>
	  <?php if (($valform == 1) && ($cprod == $codpro)) { ?>
	  <td width="50"  >
	  <div align="center">
	  <input name="text1" type="text" id="text1" size="4" <?php if($factor == 1){ ?> onkeypress="return entero(event);" <?php }else{ ?> onkeypress="return ent(event)" <?php } ?> onkeyup="texto();" value="<?php if ($qtyprf1 <> ""){echo $qtyprf1; } else { echo $qtypro1 ;}?>"/>
	  <input name="number" type="hidden" id="number" />
	  <input name="factor" type="hidden" id="factor" value="<?php echo $factor;?>" />
	  <input name="text3" type="hidden" id="text3" />
	  <input name="cod" type="hidden" id="cod" value="<?php echo $codpro;?>" />
	  <input name="stock" type="hidden" id="stock" value="<?php echo $cant_loc;?>" />
	  <input name="ok" type="hidden" id="ok" value="<?php echo $ok;?>" />
	   </div>
	  </td>
	  <td width="2">
	       
	       <div  style='color:red' align="center" > = </div>
	  </td>
	   <td width="50" bgcolor='#e3e3e3';>
	       
	       <div id="campotexto"style='color:#003237'align="right" ></div>
	  </td>
	  <?php }else{
	  
	  ?>
	  <td> </td>
	 <?php } ?>
	  <td >
	  <div align="right">
	  <?php if (($valform == 1) && ($cprod == $codpro)) { ?> 
	  <input name="text2" type="text" id="text2" value="<?php if ($prisal1 == ""){echo $costpr;} else { echo $prisal1;}?>" size="4" onKeyPress="return ent1(event)" />
	  <?php }
	  else 
	  {
	  if ($prisal1 == ""){echo $costpr;} else { echo $prisal1;}
	  }
	  ?>
	  </div>
	  </td>
	  
      <td ><div align="center"><?php if ($control == 0){ if ($cant_loc > 0) {?> <a href="transferencia2_sal_reg.php?cod=<?php echo $codpro?>" target="tranf_principal"><?php /*?><img src="../../../images/add.gif" width="14" height="15" border="0"/><?php */?></a><?php }}else{?><img src="../../../images/icon-16-checkin.png" width="16" height="16" border="0"/><?php }?></div></td>
    </tr>
	<?php }
	?>
  </table>
  <?php }
  else
  {
  ?> 
  <center><u><br><br>
    <span class="text_combo_select">NO SE LOGRO ENCONTRAR NINGUN PRODUCTO CON LA DESCRIPCION INGRESADA</span></u>
  </center>
  <?php }
  }
  ?>
</form>
</body>
</html>
