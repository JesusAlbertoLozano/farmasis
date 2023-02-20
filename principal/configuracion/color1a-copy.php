<form method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table class="tabla2" width="651" border="0" align="center">
    <tr>
      <td width="645" valign="top"><strong>COLORES</strong><br><br>
          <table width="595" border="0" align="center" class="tabla2">
          <tr>
            <td width="589"><em>TITULO DE LOS BOTONES
              </em>
              <table width="466" border="0">
                <tr>
                  <td width="156" valign="top"><table width="146" border="0" align="center">
                    <tr>
                      <td width="70"><div align="center">
                        <input type="button"  class="primero" name="Submit3" value="Primero"/>
                      </div></td>
                      <td width="66">
					  <input name="text" type="text" id="bau" onclick="startColorPicker(this)" size="6" value="<?php echo $primero?>" onkeyup="maskedHex(this)"/></td>
                    </tr>
                    <tr>
                      <td><div align="center">
                        <input type="button" class="anterior" name="Submit32" value="Anterior"/>
                      </div></td>
                      <td><input name="text1" type="text" id="text" onclick="startColorPicker(this)" size="6" value="<?php echo $anterior?>" onkeyup="maskedHex(this)"/></td>
                    </tr>
                    <tr>
                      <td><div align="center">
                        <input type="button" class="siguiente" name="Submit322" value="Siguiente"/>
                      </div></td>
                      <td><input name="text2" type="text" id="text2"  onclick="startColorPicker(this)" size="6" value="<?php echo $siguiente ?>" onkeyup="maskedHex(this)"/></td>
                    </tr>
                    <tr>
                      <td><div align="center">
                        <input type="button" class="ultimo" name="Submit3222" value="Ultimo"/>
                      </div></td>
                      <td><input name="text3" type="text" id="text22"  onclick="startColorPicker(this)" size="6" value="<?php echo $ultimo ?>" onkeyup="maskedHex(this)"/></td>
                    </tr>
                  </table></td>
                  <td width="157"><table width="144" border="0" align="center">
                    <tr>
                      <td width="70"><div align="center">
                          <input type="button" class="ver" name="Submit33" value="Visualizar" />
                      </div></td>
                      <td width="64"><input name="text4" type="text" id="text4"  onclick="startColorPicker(this)" size="6" value="<?php echo $ver ?>" onkeyup="maskedHex(this)"/></td>
                    </tr>
                    <tr>
                      <td><div align="center">
                          <input type="button" name="Submit323" value="Nuevo" class="nuevo"/>
                      </div></td>
                      <td><input name="text5" type="text" id="text5"  onclick="startColorPicker(this)" size="6" value="<?php echo $nuevo ?>" onkeyup="maskedHex(this)"/></td>
                    </tr>
                    <tr>
                      <td><div align="center">
                          <input type="button" name="Submit3223" value="Modificar" class="modificar"/>
                      </div></td>
                      <td><input name="text6" type="text" id="text222" onclick="startColorPicker(this)" size="6" value="<?php echo $modificar ?>" onkeyup="maskedHex(this)"/></td>
                    </tr>
                    <tr>
                      <td><div align="center">
                          <input type="button" name="Submit32222" value="Eliminar" class="eliminar"/>
                      </div></td>
                      <td><input name="text7" type="text" id="text7"  onclick="startColorPicker(this)" size="6" value="<?php echo $eliminar ?>" onkeyup="maskedHex(this)"/></td>
                    </tr>
                    <tr>
                      <td><div align="center">
                          <input type="button" name="Submit32222" value="Grabar" class="grabar"/>
                      </div></td>
                      <td><input name="text8" type="text" id="text8"  onclick="startColorPicker(this)" size="6" value="<?php echo $grabar ?>" onkeyup="maskedHex(this)"/></td>
                    </tr>
                    <tr>
                      <td><div align="center">
                          <input type="button" name="Submit32222" value="Cancelar" class="cancelar"/>
                      </div></td>
                      <td><input name="text17" type="text" id="text17"  onclick="startColorPicker(this)" size="6" value="<?php echo $grabar ?>" onkeyup="maskedHex(this)"/></td>
                    </tr>
                  </table></td>
                  <td width="249" valign="top"><table width="142" border="0" align="center">
                    <tr>
                      <td width="70"><div align="center">
                          <input type="button" name="Submit34" value="Buscar" class="buscar"/>
                      </div></td>
                      <td width="62"><input name="text9" type="text" id="text9"  onclick="startColorPicker(this)" size="6" value="<?php echo $buscar ?>" onkeyup="maskedHex(this)"/></td>
                    </tr>
                    <tr>
                      <td><div align="center">
                          <input type="button" name="Submit324" value="Preliminar" class="preliminar"/>
                      </div></td>
                      <td><input name="text10" type="text" id="text10" onclick="startColorPicker(this)" size="6" value="<?php echo $preliminar ?>" onkeyup="maskedHex(this)"/></td>
                    </tr>
                    <tr>
                      <td><div align="center">
                          <input type="button" name="Submit3224" value="Imprimir" class="imprimir"/>
                      </div></td>
                      <td><input name="text11" type="text" id="text223" onclick="startColorPicker(this)" size="6" value="<?php echo $imprimir ?>" onkeyup="maskedHex(this)"/></td>
                    </tr>
                    <tr>
                      <td><div align="center">
                          <input type="button" name="Submit32223" value="Consultar" class="consultar">
                      </div></td>
                      <td><input name="text12" type="text" id="text12" onclick="startColorPicker(this)" size="6" value="<?php echo $consulta ?>" onkeyup="maskedHex(this)"/></td>
                    </tr>
                    <tr>
                      <td><div align="center">
                          <input type="button" name="Submit32223" value="Salir" class="salir"/>
                      </div></td>
                      <td><input name="text13" type="text" id="text13" onclick="startColorPicker(this)" size="6" value="<?php echo $salir?>" onkeyup="maskedHex(this)"/></td>
                    </tr>
                    <tr>
                      <td><div align="center">
                          <input type="button" name="Submit32223" value="TODOS" class="salir"/>
                      </div></td>
                      <td><input name="text18" type="text" id="text18" onclick="startColorPicker(this)" size="6" onkeyup="maskedHex(this)"/></td>
                    </tr>
                  </table></td>
                </tr>
              </table>            </td>
          </tr>
        </table>
		<br>
          <table width="595" border="0" align="center" class="tabla2">
            <tr>
              <td width="589"><em>COLOR DE TEXTO              
                </em>
                <table width="534" border="0">
                  <tr>
                    <td width="162">Productos con Stock Cero </td>
                    <td width="362"><input type="button" name="Submit4" value="..." class="prodstock"/>
                      <input name="text14" type="text" id="text14" onfocus="blur()" onclick="startColorPicker(this)" size="6" value="<?php echo $prodstock ?>"/>
                    <label></label></td>
                  </tr>
                  <tr>
                    <td>Productos Incentivados </td>
                    <td><input type="button" name="Submit42" value="..." class="prodincent"/>
                    <input name="text15" type="text" id="text15" onfocus="blur()" onclick="startColorPicker(this)" size="6" value="<?php echo $prodincent ?>"/></td>
                  </tr>
                  <tr>
                    <td>Productos Normales </td>
                    <td><input type="button" name="Submit43" value="..." class="prodnormal"/>
                    <input name="text16" type="text" id="text16" onfocus="blur()" onclick="startColorPicker(this)" size="6" value="<?php echo $prodnormal  ?>"/></td>
                  </tr>
                </table></td>
            </tr>
          </table>
		  <br>    
          <table class="tabla2" width="595" border="0" align="center">
            <tr>
              <td><label>
                  <div align="right">
                    <input name="btn" type="hidden" id="btn" />
                    <input type="button" name="Submit2" value="Grabar" onclick="save_color()" />
                    <input type="button" name="Submit" value="Salir" onclick="salir1()" />
                  </div>
                </label></td>
            </tr>
          </table>
      <br></td>
    </tr>
  </table>
  </form>
