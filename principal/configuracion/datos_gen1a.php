<?php 
$facturacionElect   = 0;
$MarcaImpresion     = 0;
$TicketDefecto      = 0;
$formadeimpresion   = 0;
$sql="SELECT desemp,porcent,dolar,direccionemp,rucemp,telefonoemp,montoboleta,facturacionElect,MarcaImpresion,TicketDefecto,Preciovtacostopro,formadeimpresion,venf8,puntosdiv FROM datagen";
      $result = mysqli_query($conexion,$sql);
      if (mysqli_num_rows($result) ){
	  while ($row = mysqli_fetch_array($result)){
	  		 $i++;
             $desemp                 = $row["desemp"];
			 $porcent                = $row["porcent"];
			 $dolar                  = $row["dolar"];
			 $direccionemp           = $row["direccionemp"];
			 $rucemp                 = $row["rucemp"];
			 $telefonoemp            = $row["telefonoemp"];
			 $montoboleta            = $row["montoboleta"];
             $facturacionElect       = $row["facturacionElect"];
             $MarcaImpresion         = $row["MarcaImpresion"];
             $TicketDefecto          = $row["TicketDefecto"];
             $Preciovtacostopro      = $row["Preciovtacostopro"];
             $formadeimpresion       = $row["formadeimpresion"];
             $venf8                  = $row["venf8"];
             $puntosdiv              = $row["puntosdiv"];
			 }
			 }
?>
<form id="form1" name="form1" method="post" onKeyUp="highlight(event)" onClick="highlight(event)">
  <table class="tabla2" width="586" border="0" align="center">
    <tr>
      <td width="586">
	  <strong>DATOS GENERALES</strong><br><br>
	  <table width="492" border="0">
        <tr>
          <td width="130">Nombre de la Empresa </td>
          <td width="352"><label>
            <input name="desc" type="text" id="desc" size="60" value="<?php echo $desemp?>" onKeyUp="this.value = this.value.toUpperCase();"/>
          </label></td>
        </tr>
		<tr>
          <td width="130">Direcci&oacute;n de la Empresa </td>
          <td width="352"><label>
            <input name="dir" type="text" id="dir" size="60" value="<?php echo $direccionemp?>" onKeyUp="this.value = this.value.toUpperCase();"/>
          </label></td>
        </tr>
		<tr>
          <td width="130">RUC de la Empresa </td>
          <td width="352"><label>
            <input name="ruc" type="text" id="ruc" size="60" value="<?php echo $rucemp?>" onKeyUp="this.value = this.value.toUpperCase();"/>
          </label></td>
        </tr>
		<tr>
          <td width="130">Tel&eacute;fono de la Empresa </td>
          <td width="352"><label>
            <input name="tel" type="text" id="tel" size="60" value="<?php echo $telefonoemp?>" onKeyUp="this.value = this.value.toUpperCase();"/>
          </label></td>
        </tr>
        <tr>
          <td>Porcentaje IGV </td>
          <td><label>
            <input name="igv" type="text" id="igv" onkeypress="return decimal(event)" size="10" value="<?php echo $porcent?>"/>
          </label></td>
        </tr>
        <tr>
          <td>Cambio de Dolar </td>
          <td><label>
            <input name="dolar" type="text" id="dolar" onkeypress="return decimal(event)" size="10" value="<?php echo $dolar?>"/>
          </label></td>
        </tr>
        <tr>
          <td>Monto Boleta </td>
          <td><label>
            <input name="montoboleta" type="text" id="montoboleta" onkeypress="return decimal(event)" size="10" value="<?php echo $montoboleta?>"/>
          </label></td>
        </tr>
        <tr>
            <td>Permite Facturaci&oacute;n Electr&oacute;nica </td>
            <td>
                <label>
                    <input type="radio" name="FacturacionEletronica" id="FacturacionEletronica" <?php if ($facturacionElect == 1){?> checked=""<?php }?> value="1"> SI
                    <input type="radio" name="FacturacionEletronica" id="FacturacionEletronica" <?php if ($facturacionElect == 0){?> checked=""<?php }?> value="0"> NO
                </label>
            </td>
        </tr>
        <tr>
            <td>Muestra Marca del Prod en Impresi&oacute;n de Venta </td>
            <td>
                <label>
                    <input type="radio" name="MarcaImpresion" id="MarcaImpresion" <?php if ($MarcaImpresion == 1){?> checked=""<?php }?> value="1"> SI
                    <input type="radio" name="MarcaImpresion" id="MarcaImpresion" <?php if ($MarcaImpresion == 0){?> checked=""<?php }?> value="0"> NO
                </label>
            </td>
        </tr>
        <tr>
            <td>Graba por defecto Ticket </td>
            <td>
                <label>
                    <input type="radio" name="TicketDefecto" id="TicketDefecto" <?php if ($TicketDefecto == 1){?> checked=""<?php }?> value="1"> SI
                    <input type="radio" name="TicketDefecto" id="TicketDefecto" <?php if ($TicketDefecto == 0){?> checked=""<?php }?> value="0"> NO
                </label>
            </td>
        </tr>
        <tr>
            <td>Imprimir boleta en tama&ntilde;o A4 </td>
            <td>
                <label>
                    <input type="radio" name="formadeimpresion" id="TicketDefecto" <?php if ($formadeimpresion == 1){?> checked=""<?php }?> value="1"> SI
                    <input type="radio" name="formadeimpresion" id="TicketDefecto" <?php if ($formadeimpresion == 0){?> checked=""<?php }?> value="0"> NO
                </label>
            </td>
        </tr>
        
        <tr>
            <td>Precio de venta en base a costo promedio </td>
            <td>
                <label>
                    <input type="radio" name="Preciovtacostopro" id="Preciovtacostopro" <?php if ($Preciovtacostopro == 1){?> checked=""<?php }?> value="1"> SI
                    <input type="radio" name="Preciovtacostopro" id="Preciovtacostopro" <?php if ($Preciovtacostopro == 0){?> checked=""<?php }?> value="0"> NO
                </label>
            </td>
        </tr>
         <tr>
            <td>Activar F8 para grabar sin imprimir</td>
            <td>
                <label>
                    <input type="radio" name="venf8" id="venf8" <?php if ($venf8 == 1){?> checked=""<?php }?> value="1"> SI
                    <input type="radio" name="venf8" id="venf8" <?php if ($venf8 == 0){?> checked=""<?php }?> value="0"> NO
                </label>
            </td>
        </tr>
         <tr title="Esta cantidad va a dividir al total de la venta para otener el puntaje de dicho cliente" >
          <td>dividir para obtener puntos</td>
          <td><label>
            <input name="puntosdiv" type="text" id="puntosdiv" onkeypress="return decimal(event)" size="6" value="<?php echo $puntosdiv?>"/>
          </label></td>
        </tr>
      </table>
	  <br><br></td>
    </tr>
  </table>
  <table class="tabla2" width="586" border="0" align="center">
    <tr>
      <td><label>
          <div align="right">
            <input name="btn" type="hidden" id="btn" />
            <input type="button" name="Submit2" value="Grabar" onclick="save_datosgen1()" class="grabar"/>
            <input type="button" name="Submit" value="Salir" onclick="salir1()" class="salir"/>
          </div>
        </label></td>
    </tr>
  </table>
</form>
