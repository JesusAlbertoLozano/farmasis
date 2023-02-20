<?php

require_once('conexion.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <style>
        #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;

        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 3px;

        }

        #customers tr:nth-child(even) {
            background-color: #f0ecec;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {

            text-align: center;
            background-color: #50ADEA;
            color: white;
            font-size: 12px;
            font-weight: 900;
        }
    </style>
</head>

<body>

    <?php

    require_once('conexion.php');
    require_once 'convertfecha.php';
    $i = 0;
    $sqlDetalleVenta = "SELECT DV.invfec,DV.invnum,DV.usecod,DV.codpro,DV.canpro,DV.fraccion,DV.factor,DV.prisal,DV.pripro,V.nrofactura,V.cuscod FROM detalle_venta as DV INNER JOIN venta as V ON V.invnum=DV.invnum WHERE DV.invfec >= '2020-07-01'  and DV.prisal>0 and DV.pripro>0 and DV.costpr>0  ";
    $resultDetalleVenta = mysqli_query($conexion, $sqlDetalleVenta);
    if (mysqli_num_rows($resultDetalleVenta)) {
    ?>

        <table border='1' width="100%" align="center" id="customers">

            <thead>
                 <tr>
                    <th colspan='30'>
                        <h1>
                        REPORTE DESDE <?php echo fecha('2020-07-01').' al '. fecha(date('Y-m-d')).' con el 50%'; ?>
                        </h1>
                    </th>
                </tr>
                <tr>
                    <th> # </th>
                    <th> Invnum </th>
                    <th> Fecha </th>
                    <th> N. documento </th>
                    <th> Cliente </th>
                    <th> DNI/FACTURA </th>
                    <th> Codigo </th>
                    <th> Descripcion </th>
                   
                    <th> Factor actual</th>
                    <th> Factor de venta</th>
                     <th> Cantidad </th>
                    <th> Precio de Venta </th>
                    <th> Precio Producto Actual </th>
                    <th> Sub Total </th>
                    <th> Porcentaje </th>
                    <th> Usuario </th>
                    <th> Local </th>
                    <th> Estado Factor </th>
                </tr>
            </thead>
            <tbody>
                <?php
               $comparativaFactor='';
                
                while ($rowDetalleVenta = mysqli_fetch_array($resultDetalleVenta)) {

                    $invnum         = $rowDetalleVenta['invnum'];
                    $invfec         = $rowDetalleVenta['invfec'];
                    $usecod         = $rowDetalleVenta['usecod'];
                    $codpro         = $rowDetalleVenta['codpro'];
                    $canpro         = $rowDetalleVenta['canpro'];
                    $fraccion       = $rowDetalleVenta['fraccion'];
                    $factorVenta    = $rowDetalleVenta['factor'];
                    $prisal         = $rowDetalleVenta['prisal'];
                    $nrofactura     = $rowDetalleVenta['nrofactura'];
                    $cuscod         = $rowDetalleVenta['cuscod'];
                    $pripro         = $rowDetalleVenta['pripro'];

 
                            
                    $sql = "SELECT codpro,prevta,preuni FROM `producto` WHERE codpro='$codpro' ";
                    $result = mysqli_query($conexion, $sql);
                    if (mysqli_num_rows($result)) {
                        while ($row = mysqli_fetch_array($result)) {
                            $prevta     = $row['prevta'];
                            $preuni     = $row['preuni'];

                          if ($fraccion == 'T') {  // precio unitario
                                $precio = $preuni;
                            } else {  // precio caja 
                                $precio = $prevta;
                            }

                            $montoActual = $prisal - $precio;

                            $nuevoMonto = $montoActual / $precio;
                            
                        }
                    }
                    $nombreCliente      ='------CLIENTE ELIMINADO ------';
                    $sqlCliente = "SELECT descli,dnicli,ruccli FROM cliente where codcli ='$cuscod'";
                    $resultCliente = mysqli_query($conexion, $sqlCliente);
                    if (mysqli_num_rows($resultCliente)) {
                        while ($rowCliente = mysqli_fetch_array($resultCliente)) {
                            $nombreCliente  = $rowCliente['descli'];
                            $dnicli         = $rowCliente['dnicli'];
                            $ruccli         = $rowCliente['ruccli'];
                            
                            if($dnicli >0 ){
                                $Doc=$dnicli;
                            }else{
                                 $Doc=$ruccli;
                            }
                        }
                    }
                    $nombreUsuario      ='------USUARIO ELIMINADO ------';
                    $sqlUsuario = "SELECT nomusu,codloc FROM usuario where usecod ='$usecod'";
                    $resultUsuario = mysqli_query($conexion, $sqlUsuario);
                    if (mysqli_num_rows($resultUsuario)) {
                        while ($rowUsuario = mysqli_fetch_array($resultUsuario)) {
                            $nombreUsuario = $rowUsuario['nomusu'];
                            $codloc = $rowUsuario['codloc'];
                        }
                    }
                    
                       $sql1_LOCAL0 = "SELECT nombre FROM xcompa where codloc = '$codloc'";
                        $result1_LOCAL0 = mysqli_query($conexion, $sql1_LOCAL0);
                        if (mysqli_num_rows($result1_LOCAL0)) {
                            while ($row1_LOCAL0 = mysqli_fetch_array($result1_LOCAL0)) {
                                $nombre = $row1_LOCAL0['nombre'];
                            }
                        }
                    $desprod            ='------PRODUCTO ELIMINADO ------';
                    $sql1 = "SELECT desprod,factor FROM producto where codpro = '$codpro'";
                    $result1 = mysqli_query($conexion, $sql1);
                    if (mysqli_num_rows($result1)) {
                        while ($row1 = mysqli_fetch_array($result1)) {
                            $desprod = $row1['desprod'];
                            $factor = $row1['factor'];
                        }
                    }
                    if($factor<>$factorVenta){
                        $comparativaFactor='<div bgcolor="red" color="#ffffff">FACTOR DIFERENTE</div>';
                    }else{
                        $comparativaFactor='';
                    }

                    $respuesta = ($nuevoMonto * 100);
                    if ($respuesta < -50) {
                        $i++;
                        echo '<tr>
                    <td>' . $i . ' </td>
                    <td>' . $invnum . ' </td>
                    <td>' . fecha($invfec) . ' </td>
                    <td>' . $nrofactura . ' </td>
                    <td>' . $nombreCliente . ' </td>
                    <td>' . $Doc . ' </td>
                    <td>' . $codpro . ' </td>
                    <td>' . $desprod . ' </td>
                    
                    <td>' . $factor . ' </td>
                    <td>' . $factorVenta . ' </td>
                     <td>' . $canpro . ' </td>
                    <td>' . $prisal . ' </td>
                    <td>' . $precio . ' </td>
                    <td>' . $pripro . ' </td>
                    <td>' . round($respuesta,2) . '</td>
                    <td>' . $nombreUsuario . '</td>
                    <td>' . $nombre . '</td>
                    <td>' . $comparativaFactor . '</td>
                </tr>';
                    }
                }

                ?>
            </tbody>
        </table>
    <?php

    }
    ?>


</body>

</html>


<script>
    $(document).ready(function() {
            $('#customers').DataTable({
                 "pageLength": 100,
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
                },
                dom: 'Bfrtip',
                buttons: [
                    //'copy', 'csv', 'excel', 'pdf', 'print'
                    'excel'
                ]
                
            });
        }

    );
    
    
     
</script>