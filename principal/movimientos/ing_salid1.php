<?php
// Al ingresar por segunda vez, se activan las opciones de "tipo"
//$val = $_POST['val'];
$val = isset($_REQUEST['val']) ? ($_REQUEST['val']) : "";
$tipo = "";
if ($val == 1) {
    //$tipo = $_POST['tipo'];
    $tipo = isset($_REQUEST['tipo']) ? ($_REQUEST['tipo']) : "";
}
$cod_delete = "";
// Si existen registros en "movmae" con "proceso" igual a "1" y del usuario conectado, capturar codigo
$sql = "SELECT invnum FROM movmae where usecod = '$usuario' and proceso = '1'";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_array($result)) {
        $cod_delete = $row['invnum'];  //codigo
    }
    // Eliminar registros cuyo "invnum" esté en "proceso" igual a "1"
    mysqli_query($conexion, "DELETE FROM tempmovmov where invnum = '$cod_delete'");
    mysqli_query($conexion, "DELETE FROM movmov where invnum = '$cod_delete'");
    mysqli_query($conexion, "DELETE FROM movmae where invnum = '$cod_delete'");
}
?>

<form id="form1" name="form1" onKeyUp="highlight(event)" onClick="highlight(event)">
    <tr>
        <td width="714">
            <table width="815" border="0">
                <tr>
                    <td>
                        <table width="810" border="0">
                            <tr>
                                <td width="51"><div align="left">FECHA</div></td>
                                <td width="94">
                                    <label>
                                        <div align="left">
                                            <input name="textfield2" type="text" size="10" disabled="disabled" value="<?php echo fecha($date); ?>"/>
                                        </div>
                                    </label>
                                </td>
                                <td width="240">
                                    <div align="right">
                                        <input name="val" type="hidden" id="val" value="1" />
                                        TIPO DE MOVIMIENTO
                                    </div>
                                </td>
                                <td width="264">
                                    <div align="right">
                                        <select name="tipo" id="tipo" onchange="grabar()">
                                            <option value="1" <?php if ($tipo == 1) { ?>selected="selected"<?php } ?>>INGRESO DE MERCADERIA</option>
                                            <option value="2" <?php if ($tipo == 2) { ?>selected="selected"<?php } ?>>SALIDA DE MERCADERIA</option>
                                        </select>
                                        <select name="regis" id="regis" onchange="grabar()">
                                            <option value="1" <?php if ($regis == 1) { ?>selected="selected"<?php } ?>>REGISTRO</option>
<?php ?><option value="2" <?php if ($regis == 2) { ?>selected="selected"<?php } ?>>CONSULTA</option><?php ?>
                                        </select>
                                    </div>
                                </td>
                                <td width="139">
                                    <div align="right">
                                        <input type="button" name="Submit" value="ACEPTAR" class="grabar" onclick="grabar()"/>
                                        <input type="button" class="salir" name="Submit3" value="SALIR" onclick="salir()"/>                     
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <hr />
                        <table width="801" border="0">
                            <tr>
                                <td width="530"><div align="left"><span class="text_combo_select"><strong>LOCAL:</strong><img src="../../images/controlpanel.png" width="16" height="16" /> <?php echo $nombre_local ?></span></div></td>
                                <td width="261"><div align="right"><span class="text_combo_select"><strong>USUARIO :</strong> <img src="../../images/user.gif" width="15" height="16" /> <?php echo $user ?></span></div></td>
                            </tr>
                        </table>
                        <hr />
<?php
if ($val == 1) { // Esta parte se muestra cuando se ingresa por segunda vez al formulario
    $tipo = $_POST['tipo'];
    ?>
                            <input name="reg" type="hidden" id="type" value="<?php echo $regis ?>" />
                            <input name="type" type="hidden" id="type" value="<?php echo $tipo ?>" />
                            <input name="date" type="hidden" id="date" value="<?php echo $date ?>" />
                            <br>
                            <br>
                            <br>
    <?php
    if ($tipo == 1) { // Ingreso de mercaderia
        ?>
                    <table width="467" border="0" align="center">
                        <tr>
                            <td><u><strong>INGRESO DE MERCADERIA <?php echo $regis_desc ?></strong></u></td>
                        </tr>
                    </table>
                    <input type="hidden" name="DatosProveedor" value="">
                    <!--<table width="467" border="0" align="center">
                        <tr>
                            <td>PROVEEDOR</td>
                            <td>
                                <select name="DatosProveedor" id="DatosProveedor">
                                    <option value="">Seleccione una Opción</option>
                                    <?php
                                        $sql = "SELECT codpro,despro FROM proveedor order by despro"; 
                                        $result = mysqli_query($conexion,$sql); 
                                        while ($row = mysqli_fetch_array($result))
                                        { 
                                            $s_prov = $row['codpro'];
                                    ?>
                                        <option value="<?php echo $row['codpro']; ?>" <?php if ($busca_prov == $s_prov){?> selected="selected"<?php }?>><?php echo substr($row['despro'],0,55);?></option>
                                    <?php 
                                        } 
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>-->
                    <table width="467" border="0" align="center" class="tabla2">
                        <tr>
                            <td bgcolor="#50ADEA"><div align="center"></div></td>
                            <td bgcolor="#50ADEA"><div align="center" class="titulos_movimientos">OPC</div></td>
                            <td bgcolor="#50ADEA"><div align="center" class="titulos_movimientos"><div align="left">MOVIMIENTOS</div></div></td>
                            <td bgcolor="#50ADEA"><div align="center"></div></td>
                        </tr>
                        <tr onmouseover="this.style.backgroundColor = '#FFFF99';
                                this.style.cursor = 'hand';" onmouseout="this.style.backgroundColor = '#ffffff';">
                            <td width="10">&nbsp;</td>
                            <td width="32"><div align="center">1-</div></td>
                            <td width="379"><div align="left">COMPRAS</div></td>
                            <td width="28">
                                <input name="rd" type="radio" value="1" onclick="validar()"/>                      </td>
                        </tr>
                        <tr onmouseover="this.style.backgroundColor = '#FFFF99';
                                this.style.cursor = 'hand';" onmouseout="this.style.backgroundColor = '#ffffff';">
                            <td>&nbsp;</td>
                            <td><div align="center">2-</div></td>
                            <td><div align="left">INGRESO POR TRANSFERENCIA DE SUCURSAL</div></td>
                            <td>
                                <input name="rd" type="radio" value="2" onclick="validar()"/>                      </td>
                        </tr>
                        <tr onmouseover="this.style.backgroundColor = '#FFFF99';
                                this.style.cursor = 'hand';" onmouseout="this.style.backgroundColor = '#ffffff';">
                            <td>&nbsp;</td>
                            <td><div align="center">3-</div></td>
                            <td><div align="left">DEVOLUCION EN BUEN ESTADO </div></td>
                            <td>
                                <input name="rd" type="radio" value="3" onclick="validar()"/>                      </td>
                        </tr>
                        <tr onmouseover="this.style.backgroundColor = '#FFFF99';
                                this.style.cursor = 'hand';" onmouseout="this.style.backgroundColor = '#ffffff';">
                            <td>&nbsp;</td>
                            <td><div align="center">4-</div></td>
                            <td><div align="left">CANJE AL LABORATORIO </div></td>
                            <td>
                                <?php /* ?><input name="rd" type="radio" value="4" onclick="validar()"/><?php */ ?>                      </td>
                        </tr>
                        <tr onmouseover="this.style.backgroundColor = '#FFFF99';
                                this.style.cursor = 'hand';" onmouseout="this.style.backgroundColor = '#ffffff';">
                            <td>&nbsp;</td>
                            <td><div align="center">5-</div></td>
                            <td><div align="left">OTROS INGRESOS </div></td>
                            <td>
                                <input name="rd" type="radio" value="5" onclick="validar()"/>                      </td>
                        </tr>
                        <tr onmouseover="this.style.backgroundColor = '#FFFF99';
                                this.style.cursor = 'hand';" onmouseout="this.style.backgroundColor = '#ffffff';">
                            <td>&nbsp;</td>
                            <td><div align="center">6-</div></td>
                            <td><div align="left">PREINGRESO </div></td>
                            <td>
                                <input name="rd" type="radio" value="6" onclick="validar()"/>                      </td>
                        </tr>
                    </table>	
                    <?php
                } else { // Salida de mercaderia
                    ?>
                    <table width="467" border="0" align="center">
                        <tr>
                            <td><u><strong>SALIDA DE MERCADERIA <?php echo $regis_desc ?></strong></u></td>
            </tr>
        </table>
        <table width="467" border="0" align="center" class="tabla2">
            <tr>
                <td bgcolor="#50ADEA"><div align="center"></div></td>
                <td bgcolor="#50ADEA"><div align="center" class="titulos_movimientos">OPC</div></td>
                <td bgcolor="#50ADEA"><div align="center" class="titulos_movimientos"><div align="left">MOVIMIENTOS</div></div></td>
                <td bgcolor="#50ADEA"><div align="center"></div></td>
            </tr>
            <tr onmouseover="this.style.backgroundColor = '#FFFF99';
                    this.style.cursor = 'hand';" onmouseout="this.style.backgroundColor = '#ffffff';">
                <td width="10">&nbsp;</td>
                <td width="32"><div align="center">1-</div></td>
                <td width="379"><div align="left">SALIDAS VARIAS </div></td>
                <td width="28">
                    <input name="rd" type="radio" value="1" onclick="validar()"/>                      </td>
            </tr>
            <tr onmouseover="this.style.backgroundColor = '#FFFF99';
                    this.style.cursor = 'hand';" onmouseout="this.style.backgroundColor = '#ffffff';">
                <td>&nbsp;</td>
                <td><div align="center">2-</div></td>
                <td><div align="left">GUIAS DE REMISION </div></td>
                <td>
        <?php /* ?> <input name="rd" type="radio" value="2" onclick="validar()"/>    <?php */ ?>                   </td>
            </tr>
            <tr onmouseover="this.style.backgroundColor = '#FFFF99';
                    this.style.cursor = 'hand';" onmouseout="this.style.backgroundColor = '#ffffff';">
                <td>&nbsp;</td>
                <td><div align="center">3-</div></td>
                <td><div align="left">SALIDA POR TRANSFERENCIA DE SUCURSAL  </div></td>
                <td>
                    <input name="rd" type="radio" value="3" onclick="validar()"/>                      </td>
            </tr>
            <tr onmouseover="this.style.backgroundColor = '#FFFF99';
                    this.style.cursor = 'hand';" onmouseout="this.style.backgroundColor = '#ffffff';">
                <td>&nbsp;</td>
                <td><div align="center">4-</div></td>
                <td><div align="left">CANJE PROVEEDOR </div></td>
                <td>
        <?php /* ?><input name="rd" type="radio" value="4" onclick="validar()"/> <?php */ ?>                     </td>
            </tr>
            <tr onmouseover="this.style.backgroundColor = '#FFFF99';
                    this.style.cursor = 'hand';" onmouseout="this.style.backgroundColor = '#ffffff';">
                <td>&nbsp;</td>
                <td><div align="center">5-</div></td>
                <td><div align="left">PRESTAMOS CLIENTE </div></td>
                <td>
        <?php /* ?> <input name="rd" type="radio" value="5" onclick="validar()"/>  <?php */ ?>                     </td>
            </tr>
        </table>	
        <?php
    }
    ?>
    <?php
}
?>
</td>
</tr>
</table>
</td>
</tr>
</form>
