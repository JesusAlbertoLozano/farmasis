<?php

require_once('conexion.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de stock de productos</title>

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
   $sqlDetalleVenta = "SELECT codpro,desprod,factor,stopro,s000,s001,s002,s003,s004,s005,s006,s007,s008,s009,s010,s011,s012,s013,s014,s015,s016,s017,s018,eliminado FROM `producto` WHERE stopro <= 5 and eliminado='0' ";
    $resultDetalleVenta = mysqli_query($conexion, $sqlDetalleVenta);
    
    
			
    if (mysqli_num_rows($resultDetalleVenta)) {
    ?>

        <table border='1' width="100%" align="center" id="customers">

            <thead>
                 <tr>
                    <th colspan='30'>
                        <h1>
                         REPORTE DE PRODUCTOS
                        </h1>
                    </th>
                </tr>
                <tr>
                    <th> # </th>
                    <th> Codigo Producto </th>
                    <th> Descripcion </th>
                     <th> FACTOR </th>
                      <th> STOCK TOTAL </th>
                    <th> ALM </th>
                    <th> D001 </th>
                    <th> D002 </th>
                    <th> D003 </th>
                    <th> D004 </th>
                    <th> D005 </th>
                    <th> D006 </th>
                    <th> D007 </th>
                    <th> D008 </th>
                    <th> D009 </th>
                    <th> D010 </th>
                    <th> D011 </th>
                    <th> D012 </th>
                    <th> D013 </th>
                    <th> D014 </th>
                    <th> D015 </th>
                    <th> D016 </th>
                    <th> D017 </th>
                    <th> D018 </th>
                    
                
                </tr>
            </thead>
            <tbody>
                <?php
               $codbar='';
                
                while ($rowDetalleVenta = mysqli_fetch_array($resultDetalleVenta)) {

                    $codpro       = $rowDetalleVenta['codpro'];
                    $desprod       = $rowDetalleVenta['desprod'];
                    $factor      = $rowDetalleVenta['factor'];
                    $stopro         = $rowDetalleVenta['stopro'];
                    $s000    = $rowDetalleVenta['s000'];
                    $s001    = $rowDetalleVenta['s001'];
                    $s002    = $rowDetalleVenta['s002'];
                    $s003    = $rowDetalleVenta['s003'];
                    $s004    = $rowDetalleVenta['s004'];
                    $s005    = $rowDetalleVenta['s005'];
                    $s006    = $rowDetalleVenta['s006'];
                    $s007    = $rowDetalleVenta['s007'];
                    $s008    = $rowDetalleVenta['s008'];
                    $s009    = $rowDetalleVenta['s009'];
                    $s010    = $rowDetalleVenta['s010'];
                    $s011    = $rowDetalleVenta['s011'];
                    $s012    = $rowDetalleVenta['s012'];
                    $s013    = $rowDetalleVenta['s013'];
                    $s014    = $rowDetalleVenta['s014'];
                    $s015    = $rowDetalleVenta['s015'];
                    $s016    = $rowDetalleVenta['s016'];
                     $s017    = $rowDetalleVenta['s017'];
                      $s018    = $rowDetalleVenta['s018'];
                 
                

  
	$sql1="SELECT ltdgen FROM titultabla where dsgen = 'MARCA'";
			$result1 = mysqli_query($conexion,$sql1);
			if (mysqli_num_rows($result1)){
			while ($row1 = mysqli_fetch_array($result1)){
				$ltdgen     = $row1['ltdgen'];	
			}
			}
			$sql1="SELECT destab FROM titultabladet where codtab = '$codmar' and tiptab = '$ltdgen'";
			$result1 = mysqli_query($conexion,$sql1);
			if (mysqli_num_rows($result1)){
			while ($row1 = mysqli_fetch_array($result1)){
				$marca     = $row1['destab'];	
			}
			}
			
			 $sql1 = "SELECT destab FROM titultabladet where tiptab = 'F' and codtab = '$codfam'";
            $result1 = mysqli_query($conexion, $sql1);
            if (mysqli_num_rows($result1)) {
                while ($row1 = mysqli_fetch_array($result1)) {
                    $familia = $row1['destab'];
                }
            }
            
            
          
              
                    
                        $i++;
                        echo '<tr>
                    <td>' . $i . ' </td>
                    <td>' . $codpro . ' </td>
                    <td>' . $desprod . ' </td>
                    <td>' . $factor . ' </td>
                    <td>' . $stopro . ' </td>
                     <td>' . stockcaja($s000,$factor) . ' </td>
                    <td>' . stockcaja($s001,$factor) . ' </td>
                    <td>' . stockcaja($s002,$factor) . ' </td>
                    <td>' . stockcaja($s003,$factor) . ' </td>
                    <td>' . stockcaja($s004,$factor) . ' </td>
                    <td>' . stockcaja($s005,$factor) . ' </td>
                    <td>' . stockcaja($s006,$factor) . ' </td>
                    <td>' . stockcaja($s007,$factor) . ' </td>
                    <td>' . stockcaja($s008,$factor) . ' </td>
                    <td>' . stockcaja($s009,$factor) . ' </td>
                    <td>' . stockcaja($s010,$factor) . ' </td>
                    <td>' . stockcaja($s011,$factor) . ' </td>
                    <td>' . stockcaja($s012,$factor) . ' </td>
                    <td>' . stockcaja($s013,$factor) . ' </td>
                    <td>' . stockcaja($s014,$factor) . ' </td>
                    <td>' . stockcaja($s015,$factor) . ' </td>
                    <td>' . stockcaja($s016,$factor) . ' </td>
                    <td>' . stockcaja($s017,$factor) . ' </td>
                    <td>' . stockcaja($s018,$factor) . ' </td>
                    
                 
                
                </tr>';
 
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