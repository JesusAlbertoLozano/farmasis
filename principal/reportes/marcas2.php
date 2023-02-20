

<link href="css/style1.css" rel="stylesheet" type="text/css" />
<link href="css/tablas.css" rel="stylesheet" type="text/css" />

<style type="text/css">
    .Estilo1 {
        color: #FF0000;
        font-weight: bold;
    }
    

</style>
<style>

    #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;

    }

    #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 3px;

    }

    #customers tr:nth-child(even){background-color: #f0ecec;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {

        text-align: center;
        background-color: #50ADEA;
        color: white;
        font-size:12px;
        font-weight: 900;
    }
</style>
<?php
$sql = "SELECT nomusu FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_array($result)) {
        $user = $row['nomusu'];
    }
}
$hour = date('G');
//$date	= CalculaFechaHora($hour);
$date = date("Y-m-d");
//$hour   = CalculaHora($hour);
$min = date('i');
if ($hour <= 12) {
    $hor = "am";
} else {
    $hor = "pm";
}
//$val    = $_REQUEST['val'];
//$tipo   = $_REQUEST['tipo'];
//$tipo1  = $_REQUEST['tipo1'];
$ltdgen = $_REQUEST['ltdgen'];
//$local  = $_REQUEST['local'];
//$inicio = $_REQUEST['inicio'];
//$pagina = $_REQUEST['pagina'];
//$tot_pag = $_REQUEST['tot_pag'];
$tot_pag = $_REQUEST['total_paginas'];
$orden = $_REQUEST['orden'];
//$registros  = $_REQUEST['registros'];
//$marca1     = $_REQUEST['marca1'];
//$marca2     = $_REQUEST['marca2'];
if ($pagina == 1) {
    $i = 0;
} else {
    $t = $pagina - 1;
    $i = $t * $registros;
}
//if ($local <> 'all')
//{
//require_once("datos_generales.php");	//COGE LA TABLA DE UN LOCAL
//}
if($orden == 1){
    $dato=  "desprod";
}else{
    $dato= "destab" ;
}

if ($tipo == 1) {
    $t = "PRECIO X CAJA";
    $t2 = "PRECIO UNITARIO";
}
if ($tipo == 2) {
    $t = "LISTA DE STOCKS";
}
if ($tipo == 3) {
    $t = "FORMATO DE INVENTARIOS";
}


if ($tipo1 == 1) {
    $t1 = "TODOS LOS PRODUCTOS";
}
if ($tipo1 == 2) {
    $t1 = "SOLO PRODUCTOS CON STOCK";
}
if ($tipo1 == 3) {
    $t1 = "PRODUCTOS CON STOCK MINIMO";
}
if ($tipo1 == 4) {
    $t1 = "PRODUCTOS SIN STOCK MINIMO";
}
if ($tipo1 == 5) {
    $t1 = "PRODUCTOS CON STOCK Y CON STOCK MINIMO";
}
if ($tipo1 == 6) {
    $t1 = "PRODUCTOS CON STOCK Y SIN STOCK MINIMO";
}
if ($tipo1 == 7) {
    $t1 = "SOLO PRODUCTOS SIN STOCK";
}
//$fecha = time (); 
//echo date ( "h:i:s" , $fecha ); 
?>
<body>
    <table width="100%" border="0" align="center">
        <tr>
            <td><table width="100%" border="0">
                    <tr>
                        <td width="377"><strong><?php echo $desemp ?></strong></td>
                        <td width="205"><strong>REPORTE DE MARCAS</strong></td>
                        <td width="30">&nbsp;</td>
                        <td width="284"><div align="center"><strong>FECHA: <?php echo date('d/m/Y'); ?> - HORA : <?php echo $hour; ?>:<?php echo $min; ?> <?php echo $hor ?></strong></div></td>
                    </tr>

                </table>
                <table width="100%" border="0">
                    <tr>
                        <td width="134"><strong>PAGINA <?php echo $pagina; ?> de <?php echo $tot_pag ?></strong></td>
                        <td width="633"><div align="center"><b><?php echo $t ?> - <?php echo $t1 ?> - <?php
                                    if ($local == 'all') {
                                        echo 'TODOS LOS LOCALES';
                                    } else {
                                        echo $nomloc;
                                    }
                                    ?></b></div></td>
                        <td width="133"><div align="center">USUARIO:<span class="text_combo_select"><?php echo $user ?></span></div></td>
                    </tr>
                </table>
                <div align="center"><img src="../../images/line2.png" width="100%" height="4" /></div></td>
        </tr>
    </table>
    <?php
    if ($val == 1) {
        if ($local <> 'all') {
            ?>

            <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <?php
                        if ($tipo1 == 1) {
                            //$sql="SELECT desprod,codmar,stopro,prevta,$tabla,factor FROM producto inner join titultabladet on producto.codmar = titultabladet.codtab where destab between '$marca1' and '$marca2' order by codpro LIMIT $inicio, $registros";
                            $sql = "SELECT codpro,desprod,codmar,stopro,prevta,$tabla stoprotab,factor,preuni FROM producto inner join titultabladet on producto.codmar = titultabladet.codtab where destab between '$marca1' and '$marca2' order by $dato";
                        }
                        if ($tipo1 == 2) {
                            //$sql="SELECT desprod,codmar,stopro,prevta,$tabla,factor FROM producto inner join titultabladet on producto.codmar = titultabladet.codtab where $tabla > 0 and destab between '$marca1' and '$marca2' order by codpro LIMIT $inicio, $registros";
                            $sql = "SELECT codpro,desprod,codmar,stopro,prevta,$tabla stoprotab,factor,preuni FROM producto inner join titultabladet on producto.codmar = titultabladet.codtab where $tabla > 0 and destab between '$marca1' and '$marca2' order by $dato";
                        }
                        if ($tipo1 == 3) {
                            //$sql="SELECT desprod,codmar,stopro,prevta,$tabla,factor FROM producto inner join titultabladet on producto.codmar = titultabladet.codtab where $tabla1 > 0 and destab between '$marca1' and '$marca2' order by desprod LIMIT $inicio, $registros";
                            $sql = "SELECT codpro,desprod,codmar,stopro,prevta,$tabla stoprotab,factor,preuni FROM producto inner join titultabladet on producto.codmar = titultabladet.codtab where $tabla1 > 0 and destab between '$marca1' and '$marca2' order by $dato";
                        }
                        if ($tipo1 == 4) {
                            //$sql="SELECT desprod,codmar,stopro,prevta,$tabla,factor FROM producto inner join titultabladet on producto.codmar = titultabladet.codtab where $tabla1 = 0 and destab between '$marca1' and '$marca2' order by desprod LIMIT $inicio, $registros";
                            $sql = "SELECT codpro,desprod,codmar,stopro,prevta,$tabla stoprotab,factor,preuni FROM producto inner join titultabladet on producto.codmar = titultabladet.codtab where $tabla1 = 0 and destab between '$marca1' and '$marca2' order by $dato";
                        }
                        if ($tipo1 == 5) {
                            //$sql="SELECT desprod,codmar,stopro,prevta,$tabla,factor FROM producto inner join titultabladet on producto.codmar = titultabladet.codtab where $tabla > 0 and $tabla1 > 0 and destab between '$marca1' and '$marca2' order by codpro LIMIT $inicio, $registros";
                            $sql = "SELECT codpro,desprod,codmar,stopro,prevta,$tabla stoprotab,factor,preuni FROM producto inner join titultabladet on producto.codmar = titultabladet.codtab where $tabla > 0 and $tabla1 > 0 and destab between '$marca1' and '$marca2' order by $dato";
                        }
                        if ($tipo1 == 6) {
                            //$sql="SELECT desprod,codmar,stopro,prevta,$tabla,factor FROM producto inner join titultabladet on producto.codmar = titultabladet.codtab where $tabla > 0 and $tabla1 = 0 and destab between '$marca1' and '$marca2' order by codpro LIMIT $inicio, $registros";
                            $sql = "SELECT codpro,desprod,codmar,stopro,prevta,$tabla stoprotab,factor,preuni FROM producto inner join titultabladet on producto.codmar = titultabladet.codtab where $tabla > 0 and $tabla1 = 0 and destab between '$marca1' and '$marca2' order by $dato";
                        }
                        if ($tipo1 == 7) {
                            //$sql="SELECT desprod,codmar,stopro,prevta,$tabla,factor FROM producto inner join titultabladet on producto.codmar = titultabladet.codtab where $tabla > 0 and destab between '$marca1' and '$marca2' order by codpro LIMIT $inicio, $registros";
                            $sql = "SELECT codpro,desprod,codmar,prevta,$tabla stoprotab,factor,preuni FROM producto inner join titultabladet on producto.codmar = titultabladet.codtab where $tabla > 0 and stopro<=0 and destab between '$marca1' and '$marca2' order by destab,desprod,codpro";
                        }
                        //echo $tipo1.$sql;
                        $result = mysqli_query($conexion, $sql);
                        if (mysqli_num_rows($result)) {
                            ?>
                            <table width="100%" border="1" align="center" id="customers">
                                <thead>
                                    <tr>
                                        <th width="10" align="left"><strong>N&ordm;</strong></th>
                                        <th width="55"><strong>COD. PRO</strong></th>
                                        <th width="350"><div align="center"><strong>PRODUCTO</strong></div></th>
                                        <th width="300"><div align="center"><strong>MARCA</strong></div></th>
                                        <th width="100"><div align="center"><strong>FACTOR</strong></div></th>
                                          <?php 
                                        if ($tipo == 1) {
                                            ?>
                                            <th width="130"><div align="center"><strong>STOCK</strong></div></th>
                                            <?php // }    ?>
                                        <?php } ?>
                                        <?php
                                        if ($tipo == 3) {
                                            ?>

                                            <th width="65"><div align="center"><strong>CAJAS</strong></div></th>
                                            <th width="65"><div align="center"><strong>SUELTAS</strong></div></th>
                                        <?php } ?>


                                        <?php
                                        if ($tipo == 2) {
                                            ?>
                                            <th width="130"><div align="center"><strong><?php echo $t ?></strong></div></th>


                                        <?php } ?>


                                       
                                        <?php
                                        if ($tipo == 1) {
                                            ?>
                                            <th width="130"><div align="center"><strong><?php echo $t ?></strong></div></th>
                                            <?php // }    ?>
                                        <?php } ?>

                                        <?php
                                        if ($tipo == 1) {
                                            ?>
                                            <th width="130"><div align="center"><strong><?php echo $t2 ?></strong></div></th>
                                            <?php // }    ?>
                                        <?php } ?>


                                  

                                    </tr>

                                </thead>
                                <tbody >
                                    <?php
                                    while ($row = mysqli_fetch_array($result)) {
                                        $codpro = $row['codpro'];
                                        $producto = $row['desprod'];
                                        $marca = $row['codmar'];
                                        $stopro = $row['stopro'];
                                        $prevta = $row['prevta'];
                                        $factor = $row['factor'];
//		$codcatp     = $row['codcatp'];
                                        $stopro = $row['stoprotab'];
                                        $preuni = $row['preuni'];
                                        if ($tipo == 3) {
                                            $calc1 = $stopro / $factor;
                                            $calc2 = $stopro % $factor;
                                            $calc1 = explode(".", $calc1);
                                            $calc1 = $calc1[0];
                                        }
                                        if ($tipo == 2) {
                                            if ($factor > 1) {
                                                $convert1 = $stopro / $factor;
                                                $div1 = floor($convert1);
                                                $mult1 = $factor * $div1;
                                                $tot1 = $stopro - $mult1;
                                                $stopro = $div1 . ' C ' . $tot1;
                                            }
                                        }
                                        ///////MARCA
                                        $sql1 = "SELECT destab,abrev FROM titultabladet where codtab = '$marca'";
                                        $result1 = mysqli_query($conexion, $sql1);
                                        if (mysqli_num_rows($result1)) {
                                            while ($row1 = mysqli_fetch_array($result1)) {
                                                $destab = $row1['destab'];
                                                $abrev = $row1['abrev'];
                                                /*if ($abrev <> '') {
                                                    $destab = $abrev;
                                                }*/
                                            }
                                        }
                                        $i++;
                                        ?>
                                        <tr height="35"  <?php if ($date2) { ?> bgcolor="#ff0000"<?php } else { ?>onmouseover="this.style.backgroundColor = '#FFFF99';this.style.cursor = 'hand';" onmouseout="this.style.backgroundColor = '#ffffff';"<?php } ?>>
                                          <td width="32"><?php echo $i ?></td>
                                            <td width="90" align="center"><?php echo $codpro ?></td>
                                            <td width="394"><?php echo $producto ?></td>
                                            <td width="354"><div align="center"><?php echo $destab; ?></div></td>
                                            <td width="100"><div align="center"><?php echo $factor ?></div></td>
                                            
                                             <?php
                                                if ($tipo == 1) {
                                                    ?>
                                                    <td width="128">
                                                        <div align="center">
                                                            <?php
                                                            if ($tipo == 1) {

                                                                echo stockcaja($stopro,$factor);
                                                            }
                                                            ?>                                                
                                                    </td>
                                                <?php }
                                                ?>
                                            <?php
                                            if ($tipo == 3) {
                                                ?>


                                                <td width="65"><div align="center"><?php echo $calc1 . " ______"; ?></div></td>
                                                <td width="65"><div align="center"><?php echo $calc2 . " ______"; ?></div></td>



                                                <?php
                                            } else {
                                                ?>

                                                

                                                <td width="128">
                                                    <div align="center">
                                                        <?php
                                                        if ($tipo == 1) {

                                                            echo $prevta;
                                                        }
                                                        ?>


                                                        <?php
                                                        if ($tipo == 2) {
//                    if($tipo1<>7){
                                                            echo $stopro;
//                    }
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                                <?php
                                                if ($tipo == 1) {
                                                    ?>
                                                    <td width="128">
                                                        <div align="center">
                                                            <?php
                                                            if ($tipo == 1) {

                                                                echo $preuni;
                                                            }
                                                            ?>                                                
                                                    </td>
                                                <?php }
                                                ?>
                                               



                                                <?php
                                            }
                                            ?>
                                        </tr>

                                    <?php }
                                    ?>
                                <tbody >
                                    
                                    
                            </table>
                            <?php
                        } else {
                            ?>
                            <div class="siniformacion">
                                <center>
                                    No se logro encontrar informacion con los datos ingresados
                                </center>
                            </div>
                        <?php }
                        ?>
                    </td>
                </tr>
            </table>
            <?php
        }   //////cierro si el reporte es de un determinado local
    }   //////cierro el if (val)
    ?>
</body>
</html>

<script>
  /*  $(document).ready(function () {
        $('#customers').DataTable({
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "NingÃºn dato disponible en esta tabla =(",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Ãltimo",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad"
                }
            }
        });
    }

    );*/
</script>
