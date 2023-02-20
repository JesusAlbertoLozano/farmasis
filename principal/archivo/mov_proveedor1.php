<br>
<form id="form1" name="form1" onKeyUp="highlight(event)" onClick="highlight(event)">
            <tr>
              <td width="714"><table width="815" border="0">
                <tr>
                  <td><table width="800" border="0">
                    <tr>
                      <td width="594"><div align="right"><span class="text_combo_select"><strong>LOCAL:</strong><img src="../../images/controlpanel.png" width="16" height="16" /> <?php echo $nombre_local?></span></div></td>
                      <td width="196"><div align="right"><span class="text_combo_select"><strong>USUARIO :</strong> <img src="../../images/user.gif" width="15" height="16" /> <?php echo $user?></span></div></td>
                    </tr>
                  </table>
                  <table width="800" border="0">
                    <tr>
                      <td width="106">CODIGO</td>
                      <td width="105"><label>
                        <input name="codigo" type="text" class="Estilodany" id="codigo" value="<?php echo formato($codpro)?>" size="10"/>
                      </label></td>
                      <td width="66">NOMBRES</td>
                      <td width="485"><label>
                        <input name="nom" type="text" class="Estilodany" id="nom" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $despro?>" size="70"/>
                      </label></td>
                    </tr>
                  </table>
                    <table width="800" border="0">
                      <tr>
                        <td>REPRESENTANTE</td>
                        <td><label>
                          <input name="representante" type="text" class="Estilodany" id="representante" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $representante?>" size="60"/>
                        </label></td>
                      </tr>
                      <tr>
                        <td width="108">RUC</td>
                        <td width="682"><label>
                        <input name="ruc" type="text" class="Estilodany" id="ruc" onKeyPress="return acceptNum(event)" value="<?php echo $rucpro?>" size="15" maxlength="11"/>
                        </label></td>
                      </tr>
                      <tr>
                        <td>DIRECCION</td>
                        <td><label>
                          <input name="direccion" type="text" id="direccion" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $dirpro?>" size="80">
                        </label></td>
                      </tr>
                    </table>
                    <table width="800" border="0">
                      <tr>
                        <td width="406" valign="top"><table width="398" border="0">
                          <tr>
                            <td width="106">DEPARTAMENTO</td>
                            <td width="282"><label>
                            <?php generaSelect($conexion); ?>
                            </label></td>
                          </tr>
                          <tr>
                            <td>PROVINCIA</td>
                            <td><select disabled="disabled" name="provincia" id="provincia">
                              <option value="0">Seleccione una Provincia</option>
                            </select></td>
                          </tr>
                          <tr>
                            <td>DISTRITO</td>
                            <td><select disabled="disabled" name="distrito" id="distrito">
                              <option value="0">Seleccione un Distrito</option>
                            </select></td>
                          </tr>
                          <tr>
                            <td>T. EMP </td>
                            <td><select name="tipo" class="Estilodany" id="tipo">
                                <?php 
								$sql = "SELECT codtab,destab FROM titultabladet where tiptab = 'T' order by destab"; 
								$result = mysqli_query($conexion,$sql); 
								while ($row = mysqli_fetch_array($result)){ 
								$tipcli1 = $row['codtab'] ;
								?>
                                <option value="<?php echo $row['codtab']; ?>"  <?php if ($tipcli == $tipcli1){?>selected = "selected"<?php }?> class="Estilodany"><?php echo strtoupper($row["destab"]) ?></option>
                                <?php } ?>
                            </select></td>
                          </tr>
                          <tr>
                            <td>TELEFONO</td>
                            <td><input name="fono" type="text" class="Estilodany" id="fono" onkeypress="return acceptNum(event)" value="<?php echo $telpro?>" size="15" maxlength="10"/></td>
                          </tr>
                          <tr>
                            <td>NEXTEL</td>
                            <td><input name="nextel" type="text" class="Estilodany" id="nextel" value="<?php echo $nextel?>" size="20" maxlength="10"/></td>
                          </tr>
                          <tr>
                            <td>E-MAIL</td>
                            <td><input name="mail" type="text" class="Estilodany" id="mail" value="<?php echo $mail?>" size="40"/></td>
                          </tr>
                          <tr>
                            <td>LINEA CREDITO </td>
                            <td><input name="lcredito" type="text" class="Estilodany" id="lcredito" onkeypress="return decimal(event)" value="<?php echo $lcredito?>" size="15"/></td>
                          </tr>
                          <tr>
                            <td>OBS</td>
                            <td><input name="obs" type="text" class="Estilodany" id="obs" size="30"/></td>
                          </tr>
                        </table></td>
                        <td width="384" valign="top"><table width="384" border="0">
                          <tr>
                            <td width="392"><!-- <div id="input_text"> -->
                                <?php //include ('../../conexion.php');
							$sql = "SELECT destab FROM titultabladet where tiptab = 'D' and codtab = '$dptpro' order by destab"; 
						    $result = mysqli_query($conexion,$sql); 
							while ($row = mysqli_fetch_array($result)){ 
							$depart = $row["destab"] ;
							}
							?>
                                <input class="input_text" name="textt1" type="text" disabled="disabled" id="textt1" onfocus="blur()" value="<?php echo $depart;?>" size="35"/>
                            <!--</div>--></td>
                            <td width="51"></td>
                          </tr>
                          <tr>
                            <td>
                            <?php $sql = "SELECT destab FROM titultabladet where tiptab = 'P' and codtab = '$propro' order by destab"; 
						    $result = mysqli_query($conexion,$sql); 
							while ($row = mysqli_fetch_array($result)){ 
							$provinc = $row["destab"] ;
							}
							?>
                                <input class="input_text" name="textt2" type="text" disabled="disabled" id="textt2" onfocus="blur()" value="<?php echo $provinc;?>" size="35" />
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>
                                <?php $sql = "SELECT destab FROM titultabladet where tiptab = 'DIST' and codtab = '$dispro' order by destab"; 
						    $result = mysqli_query($conexion,$sql); 
							while ($row = mysqli_fetch_array($result)){ 
							$distrit = $row["destab"] ;
							}
							?>
                                <input class="input_text" name="textt3" type="text" disabled="disabled" id="textt3" onfocus="blur()" value="<?php echo $distrit;?>" size="35"/>
                            </td>
                            <td></td>
                          </tr>
                        </table>
						<iframe src="busca_prov/busca_proveedor.php" name="iFrame1" width="400" height="130" scrolling="Automatic" frameborder="0" id="iFrame1" allowtransparency="0"> </iframe>
					    </td>
                      </tr>
                    </table></td>
                </tr>
              </table>
                <center><br>
			      <div class="botones">
				  <table width="803" border="0">
                    <tr>
                      <td width="292">
					  
				        <div align="left">
				          <?php if ($ver != 1){
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
				$prevpage = $pageno-1;
				$nextpage = $pageno+1;
				$lastpage = $lastpage;
			 }
				?>				
				          
				          <input name="firstpage" type="hidden" id="firstpage" value="<?php echo $firstpage?>"/>
				          <input name="nextpage" type="hidden" id="nextpage" value="<?php echo $nextpage?>"/>			        
				          <input name="prevpage" type="hidden" id="prevpage" value="<?php echo $prevpage?>"/>
				          <input name="lastpage" type="hidden" id="lastpage" value="<?php echo $lastpage?>"/>
				          <input name="pageno" type="hidden" id="pageno"/>	 
				          
				          <input name="first" type="button" id="first" value="Primero" <?php if (($pageno == 1)||($search == 1)){  ?> disabled="disabled" <?php } ?> class="primero" onClick="primero()" />
				          <input name="prev" type="button" id="prev" value="Anterior" <?php if (($pageno == 1)||($search == 1) ||($numrows == 0)){  ?> disabled="disabled" <?php } ?> class="anterior" onClick="anterior()"/>
						  <input name="next" type="button" id="next" value="Siguiente"<?php if (($pageno == $lastpage) ||($search == 1) ||($numrows == 0)){ ?> disabled="disabled" <?php } ?> class="siguiente" onClick="siguiente()"/>
				          <input name="fin" type="button" id="fin" value="Ultimo" <?php if (($pageno == $lastpage) ||($search == 1) ||($numrows == 0)){ ?> disabled="disabled" <?php } ?> class="ultimo" onClick="ultimo()"/>
		                </div></td>
                      <td width="10">&nbsp;</td>
                      <td width="487"><label>
                        
                        <div align="left">
                          <input name="dpto" type="hidden" id="dpto" value="<?php echo $dptpro?>"/>
                          <input name="prov" type="hidden" id="prov" value="<?php echo $propro?>"/>
                          <input name="dist" type="hidden" id="dist" value="<?php echo $dispro?>"/>
                          <input name="cod_nuevo" type="hidden" id="cod_nuevo" />
                          <input name="fincod" type="hidden" id="fincod" value="<?php echo $fincod?>"/>
                          <input name="cod_modif_del" type="hidden" id="cod_modif_del" value="<?php echo $codpro?>"/>
                          <input name="val" type="hidden" id="val" />
                          <input name="btn" type="hidden" id="btn" />
                          <input name="paginas" type="hidden" id="paginas" value="<?php echo $pageno?>" />
                          <input name="printer" type="button" id="printer" value="Imprimir" onClick="imprimir()" class="imprimir"/>
                          <input name="nuevo" type="button" id="nuevo" value="Nuevo" onClick="buton2()" class="nuevo"/>
                          <input name="modif" type="button" id="modif" value="Modificar" onClick="buton3()" class="modificar" <?php if ($numrows == 0){?>disabled="disabled"<?php }?>/>
                          <input name="save" type="button" id="save" value="Grabar" onClick="validar()" class="grabar"/>
                          <input name="del" type="button" id="del" value="Eliminar" onClick="eliminar()" class="eliminar" <?php if ($numrows == 0){?>disabled="disabled"<?php }?>/>
                          <input name="ext" type="submit" id="ext" value="Cancelar" class="cancelar"/>
                          <input name="exit" type="button" id="exit" value="Salir"  onclick="salir()" class="salir"/>
                          </label>
                      </div></td>
                    </tr>
                  </table>
				  </div>
		        </center>
			  </td>
            </tr>
			
</form>