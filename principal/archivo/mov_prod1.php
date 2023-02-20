<form id="form1" name="form1" onKeyUp="highlight(event)" onClick="highlight(event)" enctype="multipart/form-data">

    <center>
        <div class="botones">
            <table width="100%" border="0">
                <tr>
                    <td width="279">

                        <div align="left">
                            <?php if ($ver != 1) {
                                /*
                                      if ($pageno == 1) {
                                              $firstpage = 1;	//// no se hace nada - se deshabilita el boton primero
                                      } 
                                      else 
                                      {
                                        $firstpage 	= 1;
                                        $prevpage = $pageno-1;
                                      } 
                                      if ($pageno == $lastpage) {
                                              $lastpage = $lastpage; /// no se hace nada - se deshabilita boton ultimo
                                      } 
                                      else 
                                      {
                                         $nextpage = $pageno+1;
                                      }
                                      */
                                $firstpage = 1;
                                $prevpage = $pageno - 1;
                                $nextpage = $pageno + 1;
                                $lastpage = $lastpage;
                            }
                            ?>

                            <input name="firstpage" type="hidden" id="firstpage" value="<?php echo $firstpage ?>" />
                            <input name="prevpage" type="hidden" id="prevpage" value="<?php echo $prevpage ?>" />
                            <input name="nextpage" type="hidden" id="nextpage" value="<?php echo $nextpage ?>" />
                            <input name="lastpage" type="hidden" id="lastpage" value="<?php echo $lastpage ?>" />
                            <input name="ppg" type="hidden" id="ppg" value="<?php echo $pageno ?>" />
                            <input name="pageno" type="hidden" id="pageno" />

                            <input name="first" type="button" id="first" value="Primero" <?php if (($pageno == 1) || ($search == 1)) { ?> disabled="disabled" <?php } ?> class="primero" onClick="primero()" />
                            <input name="prev" type="button" id="prev" value="Anterior" <?php if (($pageno == 1) || ($search == 1)) { ?> disabled="disabled" <?php } ?> class="anterior" onClick="anterior()" />
                            <input name="next" type="button" id="next" value="Siguiente" <?php if (($pageno == $lastpage) || ($search == 1) || ($numrows == 0)) { ?> disabled="disabled" <?php } ?> class="siguiente" onClick="siguiente()" />
                            <input name="fin" type="button" id="fin" value="Ultimo" <?php if (($pageno == $lastpage) || ($search == 1) || ($numrows == 0)) { ?> disabled="disabled" <?php } ?> class="ultimo" onClick="ultimo()" />
                        </div>

                    </td>
                    <td width="9">&nbsp;</td>
                    <td width="478">

                        <div align="left">
                            <input name="cod_nuevo" type="hidden" id="cod_nuevo" />
                            <input name="price33" type="hidden" id="price33" />
                            <input name="price44" type="hidden" id="price44" />
                            <input name="fincod" type="hidden" id="fincod" value="<?php echo $fincod ?>" />
                            <input name="cod_modif_del" type="hidden" id="cod_modif_del" value="<?php echo $codpro ?>" />
                            <input name="val" type="hidden" id="val" />
                            <input name="btn" type="hidden" id="btn" />
                            <input name="paginas" type="hidden" id="paginas" value="<?php echo $pageno ?>" />
                            <input name="printer" type="button" id="printer" value="infor" onClick="producto()" class="imprimir" />
                            <input name="nuevo" type="button" id="nuevo" value="Nuevo" onClick="buton2()" class="nuevo" />
                            <input name="modif" type="button" id="modif" value="Modificar" onClick="buton3()" class="modificar" <?php if ($numrows == 0) { ?>disabled="disabled" <?php } ?> />
                            <input name="save" type="button" id="save" value="Grabar" onClick="validar()" class="grabar" />
                            <input name="del" type="button" id="del" value="Eliminar" onClick="eliminar()" class="eliminar" <?php if ($numrows == 0) { ?>disabled="disabled" <?php } ?> />
                            <input name="" type="submit" id="ext" value="Cancelar" class="cancelar" />
                            <input name="exit" type="button" id="exit" value="Salir" onclick="salir()" class="salir" />

                        </div>
                    </td>


                </tr>
            </table>
        </div>
    </center>

    <table width="100%" border="0">
        <tr>
            <td width="314">
                <div align="left"><span class="text_combo_select"><strong>LOCAL:</strong><img src="../../images/controlpanel.png" width="16" height="16" /> <?php echo $nombre_local ?></span></div>
            </td>
            <td width="634">
                <div align="right"><span class="text_combo_select"><strong>USUARIO :</strong> <img src="../../images/user.gif" width="15" height="16" /> <?php echo $user ?></span></div>
            </td>
        </tr>
    </table>
    <img src="../../images/line2.jpg" width="900" height="4" />



    <table width="100%" border="0">

        <?php

        $sql1 = "SELECT codloc,codgrup FROM usuario where usecod = '$usuario'"; ////CODIGO DEL LOCAL DEL USUARIO
        $result1 = mysqli_query($conexion, $sql1);
        if (mysqli_num_rows($result1)) {
            while ($row1 = mysqli_fetch_array($result1)) {
                $codloc = $row1['codloc'];
                $codgrupve = $row1['codgrup'];
            }
        }


        $sql1_codgrup = "SELECT * FROM `grupo_user` WHERE codgrup = '$codgrupve' and (nomgrup LIKE '%ADMINISTRADOR%')"; ////CODIGO DEL LOCAL DEL USUARIO
        $result1_codgrup = mysqli_query($conexion, $sql1_codgrup);
        if (mysqli_num_rows($result1_codgrup)) {
            $controleditable = 1;
        } else {
            $controleditable = 0;
        }
        ?>


        <tr>
            <td width="584">
                <table width="100%" border="0">
                    <tr>
                        <td width="125">CODIGO</td>
                        <td width="449"><label>
                                <input name="codigo" type="text" class="Estilodany" id="codigo" value="<?php echo formato($codpro) ?>" />
                                <input name="controleditable" type="hidden" id="controleditable" value="<?php echo $controleditable; ?>" /> 
                                
                            </label></td>
                    </tr>
                    <tr>
                        <td>NOMBRE</td>
                        <td><label>
                                <input name="des" type="text" class="Estilodany" id="des" value="<?php echo $desprod ?>" size="60" onKeyUp="this.value=this.value.toUpperCase();" onChange="conmayus(this)" />
                            </label></td>
                    </tr>
                    <tr>
                        <td>FACTOR</td>
                        <td>
                            <input name="factor" type="text" class="Estilodany" id="factor" onkeypress="return acceptNum(event)" value="<?php echo $factor ?>" size="12" maxlength="4" onKeyUp="precio();" />
                            <input name="fact" type="hidden" id="fact" value="<?php echo $factor ?>" />
                            <input name="inc" type="checkbox" id="inc" value="1" <?php if ($inc == 1) { ?>checked="checked" <?php } ?> disabled="disabled" />
                            Incentivo para Producto
                        </td>
                    </tr>
                    <tr>
                        <td>BLISTER</td>
                        <td><label>
                                <input name="blister" type="text" class="Estilodany" id="blister" onKeyPress="return acceptNum(event)" value="<?php echo $blister ?>" size="12" maxlength="4" />
                                <input name="lotec" type="checkbox" id="lotec" value="1" <?php if ($lotec == 1) { ?>checked="checked" <?php } ?> />
                                Lotec de Productos
                            </label></td>
                    </tr>
                    <tr>
                        <td>LABORATORIO</td>
                        <td><label>
                                <select style='width:350px;' id="marca" name="marca">
                                    <?php
                                    $sql = "SELECT codtab,destab FROM titultabladet where tiptab = 'M' order by destab";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                        $marca = $row['codtab'];
                                        if ($codmar == $marca) {
                                            $activa1 = 1;
                                        }
                                    ?>
                                        <option value="<?php echo $row['codtab']; ?>" <?php if ($codmar == $marca) { ?>selected="selected" <?php } ?> class="Estilodany"><?php echo strtoupper($row["destab"]) ?></option>
                                    <?php } ?>
                                </select>
                                <a href="javascript:openPopup('regmarca.php?val=1')"><img src="../../images/add.gif" border="0" /></a></label></td>
                    </tr>
                    <tr>
                        <td>PRINCIPIO ACTIVO </td>
                        <td><label>
                                <select style='width:350px;' id="line" name="line">
                                    <?php
                                    $sql = "SELECT codtab,destab FROM titultabladet where tiptab = 'F' order by destab";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                        $familia = $row['codtab'];
                                        if ($codfam == $familia) {
                                            $activa2 = 1;
                                        }
                                    ?>
                                        <option value="<?php echo $row['codtab']; ?>" <?php if ($codfam == $familia) { ?>selected="selected" <?php } ?> class="Estilodany"><?php echo strtoupper($row["destab"]) ?></option>
                                    <?php } ?>
                                </select>
                                <a href="javascript:openPopup('reglinea.php?val=2')"><img src="../../images/add.gif" border="0" /></a></label></td>
                    </tr>
                    <tr>
                        <td>ACCION TERAPEUTICA</td>
                        <td><label>
                                <select style='width:350px;' id="clase" name="clase">
                                    <?php
                                    $sql = "SELECT codtab,destab FROM titultabladet where tiptab = 'U' order by destab";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                        $uso = $row['codtab'];
                                        if ($coduso == $uso) {
                                            $activa3 = 1;
                                        }
                                    ?>
                                        <option value="<?php echo $row['codtab']; ?>" <?php if ($coduso == $uso) { ?>selected="selected" <?php } ?> class="Estilodany"><?php echo strtoupper($row["destab"]) ?></option>
                                    <?php } ?>
                                </select>
                                <a href="javascript:openPopup('regclase.php')"><img src="../../images/add.gif" border="0" /></a></label></td>
                    </tr>
                    <tr>
                        <td>PRESENTACION</td>
                        <td><label>
                                <select style='width:350px;' id="present" name="present">
                                    <?php
                                    $sql = "SELECT codtab,destab FROM titultabladet where tiptab = 'PRES' order by destab";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                        $pres = $row['codtab'];
                                        if ($coduso == $uso) {
                                            $activa3 = 1;
                                        }
                                    ?>
                                        <option value="<?php echo $row['codtab']; ?>" <?php if ($codpres == $pres) { ?>selected="selected" <?php } ?> class="Estilodany"><?php echo strtoupper($row["destab"]) ?></option>
                                    <?php } ?>
                                </select>
                                <a href="javascript:openPopup('regad.php')"><img src="../../images/add.gif" border="0" /></a>
                            </label></td>
                    </tr>
                </table>
            </td>
            <!--primer td-->
            <td width="364" valign="top">
                INFORMACION DEL PRODUCTO
                <textarea name="textdesc" cols="50" rows="6" class="Estilodany" onChange="conmayus(this)"><?php echo $detpro ?>
                    </textarea>
                <br />
                <table width="364" border="0">

                    <tr>

                        <td>PROD. ACTIVO PARA VENTAS </td>
                    </tr>
                    <tr>

                        
                            <td>
                                <select name="rd" class="Estilodany" id="rd">

                                    <option <?php if ($activo == 1) { ?> selected="selected" <?php } ?> value="1"  >SI</option>
                                    <option <?php if ($activo == 0) { ?> selected="selected" <?php } ?> value="0"  >NO</option>

                                </select>
                            </td>
                    

                    </tr>



                    <tr>
                        <td>PROD. ACTIVO PARA COMPRAS </td>
                    </tr>
                    <tr>
                       
                            <td>
                                <select name="rd1" class="Estilodany" id="rd1">

                                   
                                     <option <?php if ($activo1 == 1) { ?> selected="selected" <?php } ?> value="1"  >SI</option>
                                    <option <?php if ($activo1 == 0) { ?> selected="selected" <?php } ?> value="0"  >NO</option>
                                   

                                </select>
                            </td>
                        

                    </tr>


                    <tr>
                        <td>MONEDA</td>
                    </tr>
                    <tr>
                        <td><select name="moneda" class="Estilodany" id="moneda">
                                <option value="S" <?php if ($moneda == "S") { ?>selected="selected" <?php } ?>>SOLES</option>
                                <option value="D" <?php if ($moneda == "D") { ?>selected="selected" <?php } ?>>DOLARES</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </td>

        </tr>
        <!--primer tr-->
        <tr>
            <td width="463" valign="top">
                <table width="100%" border="0">
                    <tr>
                        <td width="104">STOCK GENERAL</td>
                        <td width="281"><label>
                                <!--<input name="sstock" disabled="disabled" type="text" class="Estilodany" id="sstock" value="<?php echo $stopro; ?>"/>-->
                                <input name="sstock" disabled="disabled" type="text" class="Estilodany" id="sstock" value="<?php echo $CantidadFactor; ?>" />
                            </label></td>
                    </tr>
                    <tr>
                        <td width="104">PRECIO REFERENCIAL</td>
                        <td width="281"><label>
                                <input name="price" type="text" class="Estilodany" id="price" onkeypress="return decimal(event)" value="<?php echo $prelis; ?>" />
                            </label></td>
                    </tr>
                    <tr>
                        <td>Afecto a IGV</td>
                        <td><input name="igv" type="checkbox" id="igv" value="1" <?php if ($igv == 1) { ?>checked="checked" <?php } ?> /></td>
                    </tr>
                    
                   
                    
                    
                    
                    
                    <tr>
                        
                        
                        <td>MARGEN </td>
                        <td><label>
                                <input name="price2" type="text" class="Estilodany" id="price2" onkeypress="return decimal(event)" value="<?php echo $margene; ?>" size="10" onKeyUp="precio();" />
                                %</label></td>
                    </tr>
                    <tr>
                        <td>PRECIO VENTA </td>
                        <td><label>
                                <input name="price3" type="text" class="Estilodany" id="price3" onkeypress="return decimal(event)" value="<?php echo $prevta; ?>" size="10" disabled="disabled" />
                                <input name="pv1" type="hidden" id="pv1" value="<?php echo $prevta; ?>" />
                                
                            </label></td>
                    </tr>
                    <tr>
                        <td>PRECIO UNIDAD </td>
                        <td><label>
                                <input name="price4" type="text" class="Estilodany" id="price4" onkeypress="return decimal(event)" value="<?php echo $preuni; ?>" size="10" />
                                <input name="pv2" type="hidden" id="pv2" value="<?php echo $preuni; ?>" />
                            </label></td>
                    </tr>
                </table>

                <table width="350" border="0">
                    <tr>
                        <td width="104">CODIGO DE BARRAS </td>
                        <td width="236"><label>
                                <input name="cod_bar" type="text" class="Estilodany" id="cod_bar" onkeypress="return acceptNum(event)" value="<?php echo $codbar ?>" />
                            </label></td>
                    </tr>
                    <tr>
                        <td>CODIGO DE CUENTA </td>
                        <td>
                            <label>
                                <input name="cod_cuenta" type="text" class="Estilodany" id="cod_cuenta" />
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td width="104">ARCHIVO </td>
                        <td width="259"><input name="img" type="file" class="Estilodany" id="img" size="20" /></td>
                    </tr>
                    <!--  <tr>
                      <td colspan="2">COSTOS PROMEDIOS: <b><?php echo $costpr; ?></b> - ULTIMO: <b><?php echo $utlcos; ?></b> - REAL: <b><?php echo $costre; ?></b></td>
                  </tr>
                  <tr>
                      <td colspan="2">MARGENES (COSTO REAL): <b><?php echo $margene; ?></b> - UNITARIO: <b><?php echo $margeneuni; ?></b></td>
                  </tr>
                  <tr>
                      <td colspan="2">PRECIO DE VENTA: <b><?php echo $prevta; ?></b> - UNITARIO: <b><?php echo $preuni; ?></b></td>
                  </tr>-->
                </table>
                <!-- <table width="373" border="0">
                  <tr>
                    <td width="104">ARCHIVO </td>
                    <td width="259"><input name="img" type="file" class="Estilodany" id="img" size="20" /></td>
                  </tr>
              </table>-->
            </td>



            <td width="" rowspan="4" valign="top">
                <iframe src="busca_prod/busca_prod.php" name="iFrame1" width="370" height="300" scrolling="Automatic" frameborder="0" id="iFrame1" allowtransparency="0"> </iframe>
            </td>



        </tr>
        <!--segundo tr-->

        <tr>

            <td width="463" valign="top">


                <table border="0">
                    <thead>
                        <tr>
                            <th>COSTOS PROMEDIOS:</th>
                            <td>
                                <div id="1">
                                    <?php echo $costpr; ?>
                                </div>
                            </td>
                            <th>ULTIMO:</th>
                            <td>
                                <div id="2">
                                    <?php echo $utlcos; ?>
                                </div>
                            </td>
                            <th>REAL:</th>
                            <td>
                                <div id="3">
                                    <?php echo $costre; ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>MARGENES (COSTO REAL):</th>
                            <td>
                                <div id="4">
                                    <?php echo $margene; ?>
                                </div>
                            </td>
                            <th>UNITARIO:</th>
                            <td>
                                <div id="5">
                                    <?php echo $margeneuni; ?>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <th>PRECIO DE VENTA:</th>
                            <td>
                                <div id="6">
                                    <?php echo $prevta; ?>
                                </div>
                            </td>
                            <th>UNITARIO:</th>
                            <td>
                                <div id="7">
                                    <?php echo $preuni; ?>
                                </div>
                            </td>

                        </tr>
                    </thead>

                </table>
            </td>
        </tr>
        <!--ultimo tr-->


    </table>


    <!------------------------------aqui temrina el table ------------------------------------------------------------------------------------------>


    <!--                <table width="100%" border="0">
            <tr>
              <td width="463">
                <table width="100%" border="0">
                  <tr>
                    <td width="104">PRECIO REFERENCIAL</td>
                    <td width="281"><label>
                      <input name="price" type="text" class="Estilodany" id="price" onkeypress="return decimal(event)" value="<?php echo $prelis; ?>"/>
                    </label></td>
                  </tr>
                  <tr>
                    <td>Inc. IGV</td>
                    <td><input name="igv" type="checkbox" id="igv" value="1" <?php if ($igv == 1) { ?>checked="checked" <?php } ?>/></td>
                  </tr>
                  <tr>
                    <td>MARGEN </td>
                    <td><label>
                      <input name="price2" type="text" class="Estilodany" id="price2"  onkeypress="return decimal(event)" value="<?php echo $margene; ?>" size="10" onKeyUp ="precio();"/>
                    %</label></td>
                  </tr>
                  <tr>
                    <td>PRECIO VENTA </td>
                    <td><label>
                      <input name="price3" type="text" class="Estilodany" id="price3" onkeypress="return decimal(event)" value="<?php echo $prevta; ?>" size="10" disabled="disabled"/>
                      <input name="pv1" type="hidden" id="pv1" value="<?php echo $prevta; ?>"/>
                    </label></td>
                  </tr>
                  <tr>
                    <td>PRECIO UNIDAD </td>
                    <td><label>
                      <input name="price4" type="text" class="Estilodany" id="price4" onkeypress="return decimal(event)" value="<?php echo $preuni; ?>" size="10"/>
                      <input name="pv2" type="hidden" id="pv2" value="<?php echo $preuni; ?>"/>
                    </label></td>
                  </tr>
                </table>
                <table width="350" border="0">
                  <tr>
                    <td width="104">CODIGO DE BARRAS </td>
                    <td width="236"><label>
                      <input name="cod_bar" type="text" class="Estilodany" id="cod_bar" onkeypress="return acceptNum(event)" value="<?php echo $codbar ?>"/>
                    </label></td>
                  </tr>
                  <tr>
                    <td>CODIGO DE CUENTA </td>
                    <td><label>
                      <input name="cod_cuenta" type="text" class="Estilodany" id="cod_cuenta" />
                    </label></td>
                  </tr>
                </table>
                <table width="373" border="0">
                  <tr>
                    <td width="104">CARGAR ARCHIVO </td>
                    <td width="259"><input name="img" type="file" class="Estilodany" id="img" size="20" /></td>
                  </tr>
              </table>
              </td>
              <td width="485" valign="top">
              <iframe src="busca_prod/busca_prod.php" name="iFrame1" width="380" height="290" scrolling="Automatic" frameborder="0" id="iFrame1" allowtransparency="0"> </iframe>
              </td>
            </tr>
          </table>-->



</form>