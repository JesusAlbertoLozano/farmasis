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
                      <td width="90">CODIGO</td>
                      <td width="123"><label>
                        <input name="codigo" type="text" class="Estilodany" id="codigo" value="<?php echo formato($codcli)?>" size="10"/>
                      </label></td>
                      <td width="77">NOMBRES(*)</td>
                      <td width="492"><label>
                        <input name="nom" type="text" class="Estilodany" id="nom" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $descli?>" size="70"/>
                      </label></td>
                    </tr>
                  </table>
                    <table width="800" border="0">
                      <tr>
                        <td width="90">PROPIETARIO(*)</td>
                        <td width="700"><label>
                          <input name="propietario" type="text" id="propietario" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $contact?>" size="80">
                        </label></td>
                      </tr>
                      <tr>
                        <td>DIRECCION(*)</td>
                        <td><label>
                          <input name="direccion" type="text" id="direccion" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $dircli?>" size="80">
                        </label></td>
                      </tr>
                    </table>
                    <table width="800" border="0">
                      <tr>
                        <td width="326" valign="top"><table width="375" border="0">
                          <tr>
                            <td width="87">DEPARTAMENTO(*)</td>
                            <td width="278"><label>
                              <div id="demoIzq"><?php generaSelect($conexion); ?></div>
                            </label></td>
                          </tr>
                          <tr>
                            <td>PROVINCIA(*)</td>
                            <td><div id="demoMed">
							<select disabled="disabled" name="provincia" id="provincia">
								<option value="0">Seleccione una Provincia</option>
							</select>
							</div>							</td>
                          </tr>
                          <tr>
                            <td>DISTRITO(*)</td>
                            <td><div id="demoDer">
							<select disabled="disabled" name="distrito" id="distrito">
								<option value="0">Seleccione un Distrito</option>
							</select>
							</div>						   </td>
                          </tr>
                          <tr>
                            <td>TIPO EMPRESA </td>
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
                            <td>RUC</td>
                            <td><input name="ruc" type="text" class="Estilodany" id="ruc" onkeypress="return acceptNum(event)" value="<?php echo $ruccli?>" size="15" maxlength="11"/></td>
                          </tr>
                          <tr>
                            <td>DNI</td>
                            <td><input name="dni" type="text" class="Estilodany" id="dni" onkeypress="return acceptNum(event)" value="<?php echo $dnicli?>" size="15" maxlength="8"/></td>
                          </tr>
                          <tr>
                            <td>LOCAL</td>
                            <td><input name="sucursal" type="text" class="Estilodany" id="sucursal" onKeyPress="return acceptNum(event)" value="<?php if ($sucursal == ''){ echo $nombre_local;}else{echo $sucursal;}?>" size="15" maxlength="8" disabled="disabled"/></td>
                          </tr>
                          <tr>
                            <td>TELEFONO 1 </td>
                            <td><input name="fono" type="text" class="Estilodany" id="fono" onkeypress="return acceptNum(event)" value="<?php echo $telcli?>" size="15" maxlength="10"/></td>
                          </tr>
                          <tr>
                            <td>TELEFONO 2 </td>
                            <td><input name="fono1" type="text" class="Estilodany" id="fono1" onkeypress="return acceptNum(event)" value="<?php echo $telcli1?>" size="15" maxlength="10"/></td>
                          </tr>
                          <tr>
                            <td>E- MAIL </td>
                            <td><input name="email" type="text" class="Estilodany" id="email" value="<?php echo $email?>" size="35"/></td>
                          </tr>
                          <tr>
                            <td>VENDEDOR</td>
                            <td><select name="vendedor" class="Estilodany" id="vendedor">
                              <?php 
								$sql = "SELECT usecod,nomusu FROM usuario inner join grupo_user on usuario.codgrup = grupo_user.codgrup where nomgrup = 'VENDEDOR' order by nomusu"; 
								$result = mysqli_query($conexion,$sql); 
								while ($row = mysqli_fetch_array($result)){ 
								$vendedor = $row["usecod"] ;
								?>
                              <option value="<?php echo $row["usecod"]; ?>"  <?php if ($vencli == $vendedor){?>selected = "selected"<?php }?> class="Estilodany"><?php echo strtoupper($row["nomusu"]) ?></option>
                              <?php } ?>
                            </select></td>
                          </tr>
                          <tr>
                            <td>COBRADOR</td>
                            <td><select name="cobrador" class="Estilodany" id="cobrador">
                              <?php 
								$sql = "SELECT usecod,nomusu FROM usuario inner join grupo_user on usuario.codgrup = grupo_user.codgrup where nomgrup = 'COBRADOR' order by nomusu"; 
								$result = mysqli_query($conexion,$sql); 
								while ($row = mysqli_fetch_array($result)){ 
								$cobrador = $row["usecod"] ;
								?>
                              <option value="<?php echo $row["usecod"]; ?>"  <?php if ($cobcli == $cobrador){?>selected = "selected"<?php }?> class="Estilodany"><?php echo strtoupper($row["nomusu"]) ?></option>
                              <?php } ?>
                            </select></td>
                          </tr>
                          <tr>
                            <td>TRANSPORTISTA</td>
                            <td><select name="transport" class="Estilodany" id="transport">
                              <?php 
								$sql = "SELECT tracli,tranom FROM transporte order by tranom"; 
								$result = mysqli_query($conexion,$sql); 
								while ($row = mysqli_fetch_array($result)){ 
								$tracli1 = $row["tracli"] ;
								?>
                              <option value="<?php echo $row["tracli"]; ?>"  <?php if ($tracli1 == $tracli){?>selected = "selected"<?php }?> class="Estilodany"><?php echo strtoupper($row["tranom"]) ?></option>
                              <?php } ?>
                            </select></td>
                          </tr>
                        </table>
                          <table width="339" border="0">
                            <tr>
                              <td width="87">CREDITO S/. (*)</td>
                              <td width="94"><label>
                                <input name="credito" type="text" id="credito" onkeypress="return decimal(event)" value="<?php echo $limite?>" size="10" maxlength="12" />
                              </label></td>
                              <td width="74"><div align="right">USADO S/. </div></td>
                              <td width="66"><input name="usado" type="text" id="usado" size="10" value="<?php echo $usado?>" /></td>
                            </tr>
                          </table>
                          <table width="375" border="0">
                            <tr>
                              <td width="87">ESTATUS(*)</td>
                              <td width="278"><label>
                                <input name="state" type="text" id="state" value="<?php echo $estatus?>" size="4" maxlength="2" onkeypress="return acceptNum(event)" />
                              </label></td>
                            </tr>
                          </table>
                          <table width="375" border="0">
                            <tr>
                              <td width="87">OBSERVACION </td>
                              <td width="278"><label>
                                <input name="obs" type="text" id="obs" size="40" onKeyUp="this.value = this.value.toUpperCase();"/>
                              </label></td>
                            </tr>
                            <tr>
                              <td>FECHA ULT. VTA </td>
                              <td><label>
                                <input name="ultventa" type="text" id="ultventa" size="10" value="<?php echo $ultfec?>" />
                              </label></td>
                            </tr>
                          </table>
                          <table width="381" border="0">
                            <tr>
                              <td width="87">MONTO. ULT. VTA </td>
                              <td width="94"><label>
                                <input name="monto" type="text" id="monto" size="10" value="<?php echo $ulvta?>" />
                              </label></td>
                              <td width="74"><div align="right">AC. VTA </div></td>
                              <td width="108"><input name="actvta" type="text" id="actvta" size="10" /></td>
                            </tr>
                          </table></td>
                        <td width="464" valign="top"><table width="453" border="0">
                          <tr>
                            <td width="392">
							<?php //include ('../../conexion.php');
							$sql = "SELECT destab FROM titultabladet where tiptab = 'D' and codtab = '$dptcli' order by destab"; 
						    $result = mysqli_query($conexion,$sql); 
							while ($row = mysqli_fetch_array($result)){ 
							$depart = $row["destab"] ;
							}
							?>
							<input class="input_text" name="textt1" type="text" disabled="disabled" id="textt1" onFocus="blur()" value="<?php echo $depart;?>" size="45" />							</td>
                            <td width="51"></td>
                          </tr>
                          <tr>
                            <td>
							
							<?php $sql = "SELECT destab FROM titultabladet where tiptab = 'P' and codtab = '$procli' order by destab"; 
						    $result = mysqli_query($conexion,$sql); 
							while ($row = mysqli_fetch_array($result)){ 
							$provinc = $row["destab"] ;
							}
							?>
							<input class="input_text" name="textt2" type="text" disabled="disabled"  id="textt2" onFocus="blur()" value="<?php echo $provinc;?>" size="45" />							</td>
                            <td>							</td>
                          </tr>
                          <tr>
                            <td><?php $sql = "SELECT destab FROM titultabladet where tiptab = 'DIST' and codtab = '$discli' order by destab"; 
						    $result = mysqli_query($conexion,$sql); 
							while ($row = mysqli_fetch_array($result)){ 
							$distrit = $row["destab"] ;
							}
							?>
                                <input class="input_text" name="textt3" type="text" disabled="disabled"  id="textt3" onfocus="blur()" value="<?php echo $distrit;?>" size="45"/>
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>DELIVERY 
                              <input name="delivery" type="checkbox" id="delivery" value="1" <?php if ($delivery==1){?>checked="checked"<?php }?>/>
                            </td>
                            <td>							</td>
                          </tr>
                        </table>
						<iframe src="busca_cliente/busca_cliente.php" name="iFrame1" width="400" height="295" scrolling="Automatic" frameborder="0" id="iFrame1" allowtransparency="0"> </iframe>
                        </td>
                      </tr>
                    </table></td>
                </tr>
              </table>
                <center>
                  
			      <div class="botones">
				  <table width="803" border="0">
                    <tr>
                      <td width="272">
					  
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
				          
				          <input name="first" type="button" id="first" value="Primero" <?php if (($pageno == 1) ||($search == 1)){ ?> disabled="disabled" <?php } ?> class="primero" onClick="primero()" />
				          <input name="prev" type="button" id="prev" value="Anterior" <?php if (($pageno == 1) ||($search == 1)){ ?> disabled="disabled" <?php } ?> class="anterior" onClick="anterior()"/>
				          <input name="next" type="button" id="next" value="Siguiente" <?php if (($pageno == $lastpage) ||($search == 1) ||($numrows == 0)){ ?> disabled="disabled" <?php } ?> class="siguiente" onClick="siguiente()"/>
				          <input name="fin" type="button" id="fin" value="Ultimo" <?php if (($pageno == $lastpage) ||($search == 1) ||($numrows == 0)){ ?> disabled="disabled" <?php } ?> class="ultimo" onClick="ultimo()"/>
		                </div></td>
                      <td width="28">&nbsp;</td>
                      <td width="489"><label>
                        
                        <div align="left">
                          <input name="dpto" type="hidden" id="dpto" value="<?php echo $dptcli?>"/>
                          <input name="prov" type="hidden" id="prov" value="<?php echo $procli?>"/>
                          <input name="dist" type="hidden" id="dist" value="<?php echo $discli?>"/>
                          <input name="cod_nuevo" type="hidden" id="cod_nuevo" />
                          <input name="fincod" type="hidden" id="fincod" value="<?php echo $fincod?>"/>
                          <input name="cod_modif_del" type="hidden" id="cod_modif_del" value="<?php echo $codcli?>"/>
                          <input name="val" type="hidden" id="val" />
                          <input name="btn" type="hidden" id="btn" />
                          <input name="printer" type="button" id="printer" value="LISTAR" onClick="listarcliente()" class="imprimir"/>
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