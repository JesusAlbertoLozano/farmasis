<?php
require_once('../../session_user.php');
require_once('../../../conexion.php');
require_once('../../../titulo_sist.php');
require_once('../../../convertfecha.php');	//CONEXION A BASE DE DATOS
?>
<html>

<head>
	<script>
		function imprimir() {
			var f = document.form1;
			window.print();
			f.action = "venta_index.php";
			f.method = "post";
			f.submit();
		}
	</script>
</head>

<body onLoad="imprimir();">
	<form name="form1" id="form1">
		<?php
		function cambiarFormatoFecha($fecha)
		{
			list($anio, $mes, $dia) = explode("-", $fecha);
			return $dia . "-" . $mes . "-" . $anio;
		}
		$rd			= $_REQUEST['rd'];
		$venta			= $_REQUEST['vt'];
		$formatoxsucursal	= $_REQUEST['xs'];
		require_once('calcula_monto2.php');
		$sql = "SELECT invnum,nrovent,invfec,invfec,cuscod,usecod,codven,forpag,fecven,sucursal,correlativo,nomcliente,pagacon,vuelto,bruto FROM venta where invnum = '$venta'";
		$result = mysqli_query($conexion, $sql);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_array($result)) {
				$invnum       = $row['invnum'];		//codgio
				$nrovent      = $row['nrovent'];
				$invfec       = $row['invfec'];
				$cuscod       = $row['cuscod'];
				$usecod       = $row['usecod'];
				$codven       = $row['codven'];
				$forpag       = $row['forpag'];
				$fecven       = $row['fecven'];
				$sucursal     = $row['sucursal'];
				$correlativo  = $row['correlativo'];
				$nomcliente   = $row['nomcliente'];
				$pagacon      = $row['pagacon'];
				$vuelto       = $row['vuelto'];
				$mont_bruto   = $row['bruto'];
				if ($forpag == 'E') {
					$forma_pago = 'EFECTIVO';
				}
				if ($forpag == 'T') {
					$forma_pago = 'TARJETA';
				}
				if ($forpag == 'C') {
					$forma_pago = 'correlativo';
				}
				$invfec = cambiarFormatoFecha($invfec);
				$var['nrovent'] = $correlativo;
				$var['invfec']  = fecha($invfec);
				$var['cuscod']  = $cuscod;
				$var['usecod']  = $usecod;
				$var['forpag']  = $forma_pago;
				$var['mont_bruto']   = $mont_bruto;
				$var['total_es']     = $total_es;
				$var['valor_vent1']  = $valor_vent1;
				$var['sum_igv']      = $sum_igv;
				$var['monto_total']  = $monto_total;
				$var['nomcliente']  = $nomcliente;
				$var['pagacon']      = $pagacon;
				$var['vuelto']       = $vuelto;
			}
		}
		$sql = "SELECT nomusu,abrev FROM usuario where usecod = '$usecod'";
		$result = mysqli_query($conexion, $sql);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_array($result)) {
				$nomusu       = $row['abrev'];
				$var['nomusu']  = $nomusu;
			}
		}
		$sql = "SELECT desemp,rucemp,telefonoemp FROM datagen";
		$result = mysqli_query($conexion, $sql);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_array($result)) {
				$desemp       = $row['desemp'];
				$rucemp       = $row['rucemp'];
				$telefonoemp  = $row['telefonoemp'];
				$var['desemp']  = $desemp;
				$var['rucemp']  = $rucemp;
				$var['telefonoemp']  = $telefonoemp;
			}
		}
		$sql = "SELECT descli,dircli,ruccli FROM cliente where codcli = '$cuscod'";
		$result = mysqli_query($conexion, $sql);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_array($result)) {
				$descli       = $row['descli'];
				$dircli       = $row['dircli'];
				$ruccli       = $row['ruccli'];
				$var['dircli']  = $dircli;
				$var['ruccli']  = $ruccli;
			}
		}
		$sql = "SELECT count(invnum) FROM detalle_venta where invnum = '$venta'";
		$result = mysqli_query($conexion, $sql);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_array($result)) {
				$countdetventa     = $row[0];
			}
		}
		function formato($c)
		{
			printf("%08d",  $c);
		}

		function formato1($c)
		{
			printf("%06d",  $c);
		}
		function orden($g)
		{
			global $fcanti;
			global $fmarca;
			global $fcodpro;
			global $fpreuni;
			global $fmonto;
			global $fdescuento;
			global $fnom;
			global $fref;
			if ($fcanti == $g) {
				echo "<span class='Letras'>CANTIDAD</span>";
			}
			if ($fmarca == $g) {
				echo "<span class='Letras'>MARCA</span>";
			}
			if ($fcodpro == $g) {
				echo "<span class='Letras'>CODIGO</span>";
			}
			if ($fpreuni == $g) {
				echo "<span class='Letras'>PRECIO</span>";
			}
			if ($fmonto == $g) {
				echo "<span class='Letras'>SUB TOTAL</span>";
			}
			if ($fdescuento == $g) {
				echo "<span class='Letras'>DCTOS</span>";
			}
			if ($fnom == $g) {
				echo "<span class='Letras'>DESCRIPCION</span>";
			}
			if ($fref == $g) {
				echo "<span class='Letras'>PRECIO REF</span>";
			}
		}
		function muestra($y)
		{
			global $codpro;
			global $desprod;
			global $marca;
			global $precio_ref;
			global $descuento;
			global $fraccion;
			global $canpro;
			global $prisal;
			global $pripro;
			global $fcanti;
			global $fmarca;
			global $fcodpro;
			global $fpreuni;
			global $fmonto;
			global $fdescuento;
			global $fnom;
			global $fref;
			if ($fcanti == $y) {
				if ($fraccion == "T") {
					$vea = "F" . $canpro;
				}
				if ($fraccion == "F") {
					$canpro = "C" . $canpro;
					$vea = $canpro;
				}
			}
			if ($fmarca == $y) {
				$vea = $marca;
			}
			if ($fcodpro == $y) {
				$vea = $codpro;
			}
			if ($fpreuni == $y) {
				$vea = $prisal;
			}
			if ($fmonto == $y) {
				$vea = $pripro;
			}
			if ($fdescuento == $y) {
				$vea = $numero_formato_frances = number_format($descuento, 0, '.', ' ');
			}
			if ($fnom == $y) {
				$vea = $desprod;
			}
			if ($fref == $y) {
				$vea = $numero_formato_frances = number_format($precio_ref, 2, '.', ' ');
			}
			return $vea;
		}
		function ancho($u)
		{
			global $fcanti;
			global $fmarca;
			global $fcodpro;
			global $fpreuni;
			global $fmonto;
			global $fdescuento;
			global $fnom;
			global $fref;
			global $anchocod;
			global $anchonom;
			global $anchomarca;
			global $anchoreferencial;
			global $anchodescuento;
			global $anchocantidad;
			global $anchoprecio;
			global $anchosubtotal;
			if ($fcanti == $u) {
				$vae = $anchocantidad;
			}
			if ($fmarca == $u) {
				$vae = $anchomarca;
			}
			if ($fcodpro == $u) {
				$vae = $anchocod;
			}
			if ($fpreuni == $u) {
				$vae = $anchoprecio;
			}
			if ($fmonto == $u) {
				$vae = $anchosubtotal;
			}
			if ($fdescuento == $u) {
				$vae = $anchodescuento;
			}
			if ($fnom == $u) {
				$vae = $anchonom;
			}
			if ($fref == $u) {
				$vae = $anchoreferencial;
			}
			return $vae;
		}
		$sql = "SELECT linea FROM formato where tipodoc = '$rd' and titulo = 'CB' and sucursal = '$formatoxsucursal' order by linea desc limit 1";
		$result = mysqli_query($conexion, $sql);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_array($result)) {
				$llinea1       = $row['linea']; ////numero maximo de lineas en cabecera
			}
		}
		$sql = "SELECT columna FROM formato where tipodoc = '$rd' and titulo = 'CB' and sucursal = '$formatoxsucursal' order by columna desc limit 1";
		$result = mysqli_query($conexion, $sql);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_array($result)) {
				$ccolumna1     = $row['columna']; ////numero maximo de columnas en cabecera
			}
		}
		$sql = "SELECT linea FROM formato where tipodoc = '$rd' and titulo = 'PIE' and sucursal = '$formatoxsucursal' order by linea desc limit 1";
		$result = mysqli_query($conexion, $sql);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_array($result)) {
				$llinea2       = $row['linea']; ////numero maximo de lineas en pie
			}
		}
		$sql = "SELECT columna FROM formato where tipodoc = '$rd' and titulo = 'PIE' and sucursal = '$formatoxsucursal' order by columna desc limit 1";
		$result = mysqli_query($conexion, $sql);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_array($result)) {
				$ccolumna2     = $row['columna']; ////numero maximo de columnas en pie
			}
		}
		///toma los valores por el local actual
		$sql = "SELECT fdisp,flinpag,fini,fcanti,fcodpro,fmarca,fpreuni,fmonto,fdescuento,fnom,fref,contit,anchocod,anchonom,anchomarca,anchoreferencial,anchodescuento,anchocantidad,anchoprecio,anchosubtotal,dirloc FROM xcompa inner join xcompadetalle on xcompa.codloc = xcompadetalle.codloc where xcompa.codloc = '$formatoxsucursal' and tipdoc = '$rd'";
		$result = mysqli_query($conexion, $sql);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_array($result)) {
				$fdisp         = $row['fdisp'];
				$flinpag       = $row['flinpag']; //lineas por pagina en cuerpo de contenido
				$fini          = $row['fini']; //inicio de filas
				$fcanti        = $row['fcanti']; //fila donde se imprime cantidad
				$fmarca        = $row['fmarca'];  //fila donde se imprime marca
				$fcodpro       = $row['fcodpro']; //fila donde se imprime codigo producto
				$fpreuni       = $row['fpreuni']; //fila donde se imprime precio unitario
				$fmonto        = $row['fmonto']; //fila donde se imprime monto
				$fdescuento    = $row['fdescuento']; //fila donde se imprime descuento
				$fnom          = $row['fnom']; //fila donde se imprime nombre producto
				$fref          = $row['fref']; //fila donde se imprime precio referencial
				$contit        = $row['contit']; //contitulos o sin ellos
				$anchocod		= $row['anchocod']; //ancho codigo
				$anchonom		= $row['anchonom']; //ancho nombre
				$anchomarca		= $row['anchomarca']; //ancho marca
				$anchoreferencial	= $row['anchoreferencial']; //ancho refrencial
				$anchodescuento		= $row['anchodescuento']; //ancho descuento
				$anchocantidad		= $row['anchocantidad']; //ancho cantidad
				$anchoprecio		= $row['anchoprecio']; //ancho precio
				$anchosubtotal		= $row['anchosubtotal']; //ancho subtotal
				$direccionemp		= $row['dirloc']; //direccion del local
				$var['direccionemp']  = $direccionemp;
			}
		}

		if ($rd == 1) {
			$descm = "F";
		}
		if ($rd == 2) {
			$descm = "B";
		}
		if ($rd == 3) {
			$descm = "G";
		}
		if ($rd == 4) {
			$descm = "T";
		}
		$sql1 = "SELECT anchodocumento,altodocumento,unidmedida,negrita,size,numlineas FROM impresion where codlocal = '$formatoxsucursal' and tipodocumento = '$rd'";
		$result1 = mysqli_query($conexion, $sql1);
		if (mysqli_num_rows($result1)) {
			while ($row1 = mysqli_fetch_array($result1)) {
				$anchodocumento   = $row1['anchodocumento'];
				$altodocumento    = $row1['altodocumento'];
				$unidmedida    	  = $row1['unidmedida'];
				$negrita    	  = $row1['negrita'];
				$size        	  = $row1['size'];
				$numlineas    	  = $row1['numlineas']; /////NUMERO TOTAL DE LINEAS	
			}
		}
		//echo $size;
		/////CALCULO EL NUMERO DE HOJAS
		$totallinpaginas = $llinea1 + $llinea2 + $flinpag;  ////numero de lineas por hojas
		//$totallinactual  = $llinea1 + $llinea2 + $countdetventa;  ////numero de lineas de hoja actual
		if ($numlineas > $totallinpaginas) {
			$cuerpo = $flinpag; ///ESTABLESCO EL CUERPO DEL DOCUMENTO
		} else {
			$cuerpo = $totallinpaginas - $numlineas;
			$cuerpo = $flinpag - $cuerpo; ///ESTABLESCO EL CUERPO DEL DOCUMENTO
		}
		if ($countdetventa <= $cuerpo) {
			$numpags1 = 1;
		} else {
			$numpags1 = intval($countdetventa / $cuerpo);
			$numpags2 = intval($countdetventa % $cuerpo);
		}
		if ($numpags1 == 0) {
			$numpags1 = $numpags1 + 1; ////NUMERO DE PAGINAS
		} else {
			if ($numpags2 > 0) {
				$numpags1 = $numpags1 + 1;
			}
		}
		$paginas = 1;
		$limitpaginas = 1;
		$totallineas = 0;
		//////////////////////
		///CONFIGURAR NEGRITA//// ESPACIO 32
		////////////////////////////////////////////////////////GENERO ARCHIVO TXT
		$descfile = $descm . $venta . ".txt";
		$ruta     = $descfile;
		$cadena   = "";
		//$ar=fopen($ruta,"w") or die("Problemas en la creacion");
		//fputs($ar,$cadena);
		//fputs($ar,"\n");
		//fclose($ar);
		//$handle = fopen($ruta, 'a+');
		$count 		= $flinpag; //numero de lineas por cada hoja
		$contador 	= $fini;    //linea inicial
		//if ($handle)
		//{
		//fwrite($handle , chr(15));
		//if($negrita == 1)
		//{
		//fwrite($handle , chr(27).'E'); ////ACTIVO NEGRITAS
		//}
		while ($paginas <= $numpags1) { ////IMPRIMO EL NUMERO DE PAGINAS
			//$limitpaginas = ($paginas - 1) * $cuerpo; ////limito la consulta sql
			$ii = 1;
			$ic = 1;
			while ($ii <= $llinea1) {
				/////////////////777
				$ic = 1;
				$sql = "SELECT columna,descbrev,campo,cuanto,linea,contitcampo FROM formato inner join titultabladet on formato.descripcion = titultabladet.codtab where sucursal = '$formatoxsucursal' and tipodoc = '$rd' and titulo = 'CB' and state = '1' and linea = '$ii' order by linea, columna";
				$result = mysqli_query($conexion, $sql);
				if (mysqli_num_rows($result)) {
					while ($row = mysqli_fetch_array($result)) {
						$lin           = $row['linea'];
						$col   		   = $row['columna'];
						$desc   	   = $row['descbrev'];
						$cam	       = $row['campo'];
						$long	       = $row['cuanto'];
						$contitcampo   = $row['contitcampo'];
						if ($ic == $col) {
							$sumlet = 0;
							$ddate  = 0;
							if ($contitcampo == 1) {
								$sumlet = strlen($desc) + 1;
								//fwrite($handle , $desc);
								echo $desc;
								//fwrite($handle ,chr(32)); //espacio en blanco
								echo "&nbsp;";
								//$pdf->Cell($sumlet,4,$desc,0,0);
							}
							if ($cam == 'hora') {
								$hora  = date('h:i');
								$ddate = strlen($hora) + 1;
								//fwrite($handle , $hora);
								echo $hora;
								//fwrite($handle ,chr(32));
								echo "&nbsp;";
								//$pdf->Cell($ddate,4,$hora,0,0);
							} else {
								if ($cam == '***') {
									$sumlet = strlen($desc) + 1;
									//fwrite($handle , $desc);
									echo $desc;
									//fwrite($handle ,chr(32));
									echo "&nbsp;";
									//$pdf->Cell($long,4,$desc,0,0);
								} else {
									//if(($cam == "nomcliente") || ($cam == "nrovent"))
									//{
									//fwrite($handle ,chr(27)."w"."1");
									//}
									$long++;
									//fwrite($handle , $var[$cam]);
									echo $var[$cam];
									echo "&nbsp;";
									//fwrite($handle ,chr(32));
									//if(($cam == "nomcliente") || ($cam == "nrovent"))
									//{
									//fwrite($handle ,chr(27)."w"."0");
									//}
									//$pdf->Cell($long,4,$var[$cam],0,0);
								}
							}
							$totlet = $sumlet + $long + $ddate;
							$ic     = $totlet;
						} else {
							while ($ic <= $col) {
								echo "&nbsp;";
								//fwrite($handle ,chr(32));
								//$pdf->Cell(1,4,' ',0,0);
								$ic++;
							}
							$sumlet = 0;
							$ddate  = 0;
							if ($contitcampo == 1) {
								$sumlet = strlen($desc) + 1;
								echo $desc;
								//fwrite($handle , $desc);
								echo "&nbsp;";
								//fwrite($handle ,chr(32)); //espacio en blanco
								//$pdf->Cell($sumlet,4,$desc,0,0);
							}
							if ($cam == 'hora') {
								$hora  = date('h:i');
								$ddate = strlen($hora) + 1;
								echo $hora;
								//fwrite($handle , $hora);
								echo "&nbsp;";
								//fwrite($handle ,chr(32));
								//$pdf->Cell($ddate,4,$hora,0,0);
								//chr(27)."w"."1";
							} else {
								if ($cam == '***') {
									$sumlet = strlen($desc) + 1;
									echo $desc;
									//fwrite($handle , $desc);
									//fwrite($handle ,chr(32));
									echo "&nbsp;";
									//$pdf->Cell($long,4,$desc,0,0);
								} else {
									//if(($cam == "nomcliente") || ($cam == "nrovent"))
									//{
									//fwrite($handle ,chr(27)."w"."1");
									//}
									$long++;
									//fwrite($handle , $var[$cam]);
									echo $var[$cam];
									echo "&nbsp;";
									//fwrite($handle ,chr(32));
									//if(($cam == "nomcliente") || ($cam == "nrovent"))
									//{
									//fwrite($handle ,chr(27)."w"."0");
									//}
									//$pdf->Cell($long,4,$var[$cam],0,0);
								}
							}
							//$ic++;
							$totlet = $sumlet + $long + $ddate;
							$ic     = $totlet;
						}
					}
					//$pdf->Ln();
				} else {
					while ($ic <= $ccolumna1) {
						echo "&nbsp;";
						//fwrite($handle ,chr(32));
						//$pdf->Ln();
						$ic++;
					}
				}
				/////////////////777
				$ii++;
				echo "<br>";
				//fwrite($handle , chr(13).chr(10));  ///enter
			}
			////////////////////////////////7
			$co = 0;
			while ($co < $fini) {
				echo "<br>";
				//fwrite($handle , chr(13).chr(10));  ///enter
				$co++;
			}
			if ($contit == 1) {
				$sumcad = 0;
				$anchocolum = 0;
				echo orden(1);
				//fwrite($handle ,orden(1));
				$anchocolum = ancho(1) + 1;
				$sumcad = strlen(orden(1) + 1);
				while ($sumcad <= $anchocolum) {
					echo "&nbsp;";
					//fwrite($handle ,chr(32));
					$sumcad++;
				}
				$sumcad = 0;
				$anchocolum = 0;
				echo orden(2);
				//fwrite($handle ,orden(2));
				$anchocolum = ancho(2) + 1;
				$sumcad = strlen(orden(2) + 1);
				while ($sumcad <= $anchocolum) {
					echo "&nbsp;";
					//fwrite($handle ,chr(32));
					$sumcad++;
				}
				$sumcad = 0;
				$anchocolum = 0;
				//fwrite($handle ,orden(3));
				echo orden(3);
				$anchocolum = ancho(3) + 1;
				$sumcad = strlen(orden(3) + 1);
				while ($sumcad <= $anchocolum) {
					echo "&nbsp;";
					//fwrite($handle ,chr(32));
					$sumcad++;
				}
				$sumcad = 0;
				$anchocolum = 0;
				echo orden(4);
				//fwrite($handle ,orden(4));
				$anchocolum = ancho(4) + 1;
				$sumcad = strlen(orden(4) + 1);
				while ($sumcad <= $anchocolum) {
					echo "&nbsp;";
					//fwrite($handle ,chr(32));
					$sumcad++;
				}
				$sumcad = 0;
				$anchocolum = 0;
				//fwrite($handle ,orden(5));
				echo orden(5);
				$anchocolum = ancho(5) + 1;
				$sumcad = strlen(orden(5) + 1);
				while ($sumcad <= $anchocolum) {
					echo "&nbsp;";
					//fwrite($handle ,chr(32));
					$sumcad++;
				}
				$sumcad = 0;
				$anchocolum = 0;
				//fwrite($handle ,orden(6));
				echo orden(6);
				$anchocolum = ancho(6) + 1;
				$sumcad = strlen(orden(6) + 1);
				while ($sumcad <= $anchocolum) {
					echo "&nbsp;";
					//fwrite($handle ,chr(32));
					$sumcad++;
				}
				$sumcad = 0;
				$anchocolum = 0;
				echo orden(7);
				//fwrite($handle ,orden(7));
				$anchocolum = ancho(7) + 1;
				$sumcad = strlen(orden(7) + 1);
				while ($sumcad <= $anchocolum) {
					echo "&nbsp;";
					//fwrite($handle ,chr(32));
					$sumcad++;
				}
				$sumcad = 0;
				$anchocolum = 0;
				echo orden(8);
				//fwrite($handle ,orden(8));
				$anchocolum = ancho(8) + 1;
				$sumcad = strlen(orden(8) + 1);
				while ($sumcad <= $anchocolum) {
					echo "&nbsp;";
					//fwrite($handle ,chr(32));
					$sumcad++;
				}
				echo "<br>";
				//fwrite($handle , chr(13).chr(10));  ///enter
			}
			////////////////////////////////7
			$i = 1;
			//$sql="SELECT * FROM detalle_venta where invnum = '$venta' limit $limitpaginas,$cuerpo";
			$sql = "SELECT * FROM detalle_venta where invnum = '$venta'";
			$result = mysqli_query($conexion, $sql);
			if (mysqli_num_rows($result)) {
				while ($row = mysqli_fetch_array($result)) {
					$codpro       = $row['codpro'];
					$canpro       = $row['canpro'];
					$fraccion     = $row['fraccion'];
					$factor       = $row['factor'];
					$prisal       = $row['prisal'];
					$pripro       = $row['pripro'];
					$fraccion     = $row['fraccion'];
					if ($fraccion == "F") {
						$cantemp = $canpro * $factor;
					} else {
						$cantemp = $canpro;
					}
					$sql1 = "SELECT codpro,desprod,codmar,factor,costpr,stopro,incentivado,prelis,prevta,preuni FROM producto where codpro = '$codpro'";
					$result1 = mysqli_query($conexion, $sql1);
					if (mysqli_num_rows($result1)) {
						while ($row1 = mysqli_fetch_array($result1)) {
							$codpro     = $row1['codpro'];
							$desprod    = $row1['desprod'];
							$codmar     = $row1['codmar'];
							$factor     = $row1['factor'];
							$costpr     = $row1['costpr'];  ///COSTO PROMEDIO
							$stopro     = $row1['stopro'];	///STOCK EN UNIDADES DEL PRODUCTO GENERAL
							$cant       = $row1['cant'];	///STOCK EN UNIDADES DEL PRODUCTO POR LOCAL
							$idlocal    = $row1['idlocal'];	///CODIGO DEL LOCAL
							$inc	    = $row1['incentivado'];
							$referencial = $row1['prelis'];
							$prevta		= $row1['prevta'];
							$preuni     = $row1['preuni'];
						}
					}
					if (($referencial <> 0) and ($referencial <> $prevta)) {
						$margenes       = ($margene / 100) + 1;
						$precio_ref     = $referencial / $factor;
						$precio_ref		= $precio_ref * $margenes;
						$precio_ref		= number_format($precio_ref, 2, '.', ',');
						$desc1	        = $precio_ref - $preuni;
						if ($desc1 < 0) {
							$descuento = 0;
						} else {
							$descuento      = (($precio_ref - $preuni) / $precio_ref) * 100;
						}
					} else {
						$precio_ref		= $preuni;
						$descuento		= 0;
					}
					$sql1 = "SELECT ltdgen FROM titultabla where dsgen = 'MARCA'";
					$result1 = mysqli_query($conexion, $sql1);
					if (mysqli_num_rows($result1)) {
						while ($row1 = mysqli_fetch_array($result1)) {
							$ltdgen     = $row1['ltdgen'];
						}
					}
					$sql1 = "SELECT destab,abrev FROM titultabladet where codtab = '$codmar' and tiptab = '$ltdgen'";
					$result1 = mysqli_query($conexion, $sql1);
					if (mysqli_num_rows($result1)) {
						while ($row1 = mysqli_fetch_array($result1)) {
							$marca     = $row1['destab'];
							$abrev     = $row1['abrev'];
							if ($abrev == '') {
								$marca = substr($marca, 0, 6);
							} else {
								$marca = $abrev;
							}
						}
					}
					$sumcad = 0;
					$anchocolum = 0;
					echo muestra(1);
					//fwrite($handle ,muestra(1));
					$anchocolum = ancho(1) + 1;
					$sumcad = strlen(muestra(1) + 1);
					while ($sumcad <= $anchocolum) {
						echo "&nbsp;";
						//fwrite($handle ,chr(32));
						$sumcad++;
					}
					$sumcad = 0;
					$anchocolum = 0;
					echo muestra(2);
					//fwrite($handle ,muestra(2));
					$anchocolum = ancho(2) + 1;
					$sumcad = strlen(muestra(2) + 1);
					while ($sumcad <= $anchocolum) {
						echo "&nbsp;";
						//fwrite($handle ,chr(32));
						$sumcad++;
					}
					$sumcad = 0;
					$anchocolum = 0;
					echo muestra(3);
					//fwrite($handle ,muestra(3));
					$anchocolum = ancho(3) + 1;
					$sumcad = strlen(muestra(3) + 1);
					while ($sumcad <= $anchocolum) {
						echo "&nbsp;";
						//fwrite($handle ,chr(32));
						$sumcad++;
					}
					$sumcad = 0;
					$anchocolum = 0;
					echo muestra(4);
					//fwrite($handle ,muestra(4));
					$anchocolum = ancho(4) + 1;
					$sumcad = strlen(muestra(4) + 1);
					while ($sumcad <= $anchocolum) {
						echo "&nbsp;";
						//fwrite($handle ,chr(32));
						$sumcad++;
					}
					$sumcad = 0;
					$anchocolum = 0;
					echo muestra(5);
					//fwrite($handle ,muestra(5));
					$anchocolum = ancho(5) + 1;
					$sumcad = strlen(muestra(5) + 1);
					while ($sumcad <= $anchocolum) {
						echo "&nbsp;";
						//fwrite($handle ,chr(32));
						$sumcad++;
					}
					$sumcad = 0;
					$anchocolum = 0;
					echo muestra(6);
					//fwrite($handle ,muestra(6));
					$anchocolum = ancho(6) + 1;
					$sumcad = strlen(muestra(6) + 1);
					while ($sumcad <= $anchocolum) {
						//fwrite($handle ,chr(32));
						echo "&nbsp;";
						$sumcad++;
					}
					$sumcad = 0;
					$anchocolum = 0;
					//fwrite($handle ,muestra(7));
					echo muestra(7);
					$anchocolum = ancho(7) + 1;
					$sumcad = strlen(muestra(7) + 1);
					while ($sumcad <= $anchocolum) {
						echo "&nbsp;";
						//fwrite($handle ,chr(32));
						$sumcad++;
					}
					$sumcad = 0;
					$anchocolum = 0;
					//fwrite($handle ,muestra(8));
					echo muestra(8);
					$anchocolum = ancho(8) + 1;
					$sumcad = strlen(muestra(8) + 1);
					while ($sumcad <= $anchocolum) {
						echo "&nbsp;";
						//fwrite($handle ,chr(32));
						$sumcad++;
					}
					echo "<br>";
					//fwrite($handle , chr(13).chr(10));
					$i++;
				}
			}
			if ($i < ($cuerpo)) {
				while ($i <= $cuerpo) {
					echo "<br>";
					//fwrite($handle , chr(13).chr(10)); ////DESACTIV NEGRITAS
					$i++;
				}
			}
			$ii = 1;
			$ic = 1;
			while ($ii <= $llinea2) {
				$ic = 1;
				$sql = "SELECT columna,descbrev,campo,cuanto,linea,contitcampo FROM formato inner join titultabladet on formato.descripcion = titultabladet.codtab where sucursal = '$formatoxsucursal' and tipodoc = '$rd' and titulo = 'PIE' and state = '1' and linea = '$ii' and campo <> 'montext' order by linea, columna";
				$result = mysqli_query($conexion, $sql);
				if (mysqli_num_rows($result)) {
					while ($row = mysqli_fetch_array($result)) {
						$lin           = $row['linea'];
						$col   		   = $row['columna'];
						$desc   	   = $row['descbrev'];
						$cam	       = $row['campo'];
						$long	       = $row['cuanto'];
						$contitcampo   = $row['contitcampo'];
						if ($ic == $col) {
							$sumlet = 0;
							$sumtext = 0;
							if ($contitcampo == 1) {
								$sumlet = strlen($desc) + 1;
								echo $desc;
								//fwrite($handle , $desc);
								//fwrite($handle ,chr(32)); //espacio en blanco
								echo "&nbsp;";
							}
							if ($cam == 'montext') {
								$text_letra = strtoupper(letras2($monto_total));
								$sumtext 	= strlen($text_letra) + 13;
								echo  $text_letra . '  Nuevos Soles';
								//fwrite($handle , $text_letra.'  Nuevos Soles');
								echo "&nbsp;";
								//fwrite($handle ,chr(32)); //espacio en blanc
							} else {
								if ($cam == 'gracias') {
									$sumtext 	= strlen($desc);
									//fwrite($handle , $desc);
									echo $desc;
									echo "&nbsp;";
									//fwrite($handle ,chr(32)); //espacio en blanc
								} else {
									if ($cam == 'gracias2') {
										$sumtext 	= strlen($desc);
										echo $desc;
										echo "&nbsp;";
										//fwrite($handle , $desc);
										//fwrite($handle ,chr(32)); //espacio en blanc
									} else {
										/*if ($cam == 'pagocon')
													{
													//$text_letra = '0.00'; 
													$sumtext 	= strlen($desc) + 5;
													fwrite($handle ,'S/. '.$desc);
													fwrite($handle ,chr(32)); //espacio en blanc
													}
													else
													{*/
										if (($cam == 'vuelto') || ($cam == 'pagacon')) {
											//$text_letra = $numero_formato_frances = number_format($monto_total, 2, '.', ' '); 
											$sumtext 	= strlen($desc) + 3;
											echo 'S/. ';
											echo "&nbsp;";
											//fwrite($handle ,'S/. ');
											//fwrite($handle ,chr(32)); //espacio en blanc
										}
										//if(($cam == "invtot"))
										//{
										//fwrite($handle ,chr(27)."w"."1");
										//}
										$vi = $numero_formato_frances = number_format($var[$cam], 2, '.', ' ');
										$countvi = strlen($vi) + 1;
										echo $vi;
										//fwrite($handle , $vi);
										//fwrite($handle ,chr(32)); //espacio en blanc
										echo "&nbsp;";
										//if(($cam == "invtot"))
										//{
										//fwrite($handle ,chr(27)."w"."0");
										//}
										//}
										//}
									}
								}
							}
							$totlet = $sumlet + $long + $sumtext + $countvi;
							$ic     = $totlet;
						} else {
							while ($ic <= $col) {
								echo "&nbsp;";
								//fwrite($handle ,chr(32)); //espacio en blanc
								$ic++;
							}
							$sumlet = 0;
							if ($contitcampo == 1) {
								$sumlet = strlen($desc) + 1;
								echo $desc;
								echo "&nbsp;";
								//fwrite($handle , $desc);
								//fwrite($handle ,chr(32)); //espacio en blanco
							}
							if ($cam == 'montext') {
								$text_letra = strtoupper(letras2($monto_total));
								$sumtext 	= strlen($text_letra) + 13;
								echo $text_letra . '  Nuevos Soles';
								echo "&nbsp;";
								//fwrite($handle , $text_letra.'  Nuevos Soles');
								//fwrite($handle ,chr(32)); //espacio en blanc
							} else {
								if ($cam == 'gracias') {
									$sumtext 	= strlen($desc);
									echo $desc;
									echo "&nbsp;";
									//fwrite($handle , $desc);
									//fwrite($handle ,chr(32)); //espacio en blanc
								} else {
									if ($cam == 'gracias2') {
										$sumtext 	= strlen($desc);
										echo $desc;
										echo "&nbsp;";
										//fwrite($handle , $desc);
										//fwrite($handle ,chr(32)); //espacio en blanc
									} else {
										/*if ($cam == 'pagocon')
													{
													//$text_letra = '0.00'; 
													$sumtext 	= strlen($desc) + 5;
													fwrite($handle ,'S/. '.$desc);
													fwrite($handle ,chr(32)); //espacio en blanc
													}
													else
													{*/
										if (($cam == 'vuelto') || ($cam == 'pagacon')) {
											//$text_letra = $numero_formato_frances = number_format($monto_total, 2, '.', ' '); 
											$sumtext 	= strlen($desc) + 3;
											echo 'S/. ';
											echo "&nbsp;";
											//fwrite($handle ,'S/. ');
											//fwrite($handle ,chr(32)); //espacio en blanc
										}
										//if(($cam == "invtot"))
										//{
										//fwrite($handle ,chr(27)."w"."1");
										//}
										$vi = $numero_formato_frances = number_format($var[$cam], 2, '.', ' ');
										$countvi = strlen($vi) + 1;
										echo $vi;
										echo "&nbsp;";
										//fwrite($handle , $vi);
										//fwrite($handle ,chr(32)); //espacio en blanc
										//if(($cam == "invtot"))
										//{
										//fwrite($handle ,chr(27)."w"."0");
										//}
										//}
										//}
									}
								}
							}
							$totlet = $sumlet + $long + $sumtext + $countvi;
							$ic     = $totlet;
						}
					}
					echo "<br>";
					//fwrite($handle , chr(13).chr(10)); //enter
				} else {
					while ($ic <= $ccolumna2) {
						echo "&nbsp;";
						//fwrite($handle ,chr(32)); //espacio en blanc
						$ic++;
					}
				}
				$ii++;
				echo "<br>";
				//fwrite($handle , chr(13).chr(10)); //espacio en blanc
			}
			/////////////////////////////////
			$paginas++;
		} ///cierro paginas
		//if($negrita == 1)
		//{
		//fwrite($handle , chr(27).'F'); ////DESACTIV NEGRITAS
		//}
		//if($valor_imprimir == 4)
		//{
		//fwrite($handle , chr(27).'i'); ////CORTO EL PAPEL
		//}
		//} //cierro el handle
		//fclose($handle);
		?>
	</form>
</body>

</html>