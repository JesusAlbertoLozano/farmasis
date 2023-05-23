<?php
include('../../session_user.php');
require_once('../../../conexion.php');
include('./logger.php');


    $logger = new FileLogger('logger.txt');
    $logger->log("ArreglaFactorKardex.php-------------------------");
    $logger->log("Fecha: " . date("Y-m-d H:i:s"));
    $kardex_sql = "SELECT invnum, codpro, factor FROM kardex where tipmov = 11 and tipdoc = 11";
    //SELECCIÓN DE TODOS LOS KARDEX BONIFICADOS
    $kardex_result = mysqli_query($conexion, $kardex_sql);
    if (mysqli_num_rows($kardex_result)) {
        $kardex_loop = 0;
        while ($kardex_row = mysqli_fetch_array($kardex_result)) {
            $producto_sql = "SELECT codpro, factor FROM producto WHERE codpro = '" . $kardex_row['codpro'] . "'";
            $producto_result = mysqli_query($conexion, $producto_sql);
            if (mysqli_num_rows($producto_result)) {
                while ($producto_row = mysqli_fetch_array($producto_result)) {
                    if ($kardex_row['factor'] !== $producto_row['factor']) {
                        //SI EL FACTOR DEL PRODUCTO EN LA TABLA "kardex" ES DIFERENTE AL DE LA TABLA "producto"
                        $kardex_update = "UPDATE kardex SET factor = " . $producto_row['factor'] . " WHERE invnum = " . $kardex_row['invnum'] . " AND codpro = '" . $kardex_row['codpro'] . "'";
                        $kardex_update_result = mysqli_query($conexion, $kardex_update);
                        if ($kardex_update_result) {
                            $logger->log("Se ha actualizado el factor del producto " . $kardex_row['codpro'] . " en el registro " . $kardex_row['invnum'] . " a " . $producto_row['factor']);
                            $kardex_loop++;
                        } else {
                            $logger->log("No se ha podido actualizar el factor del producto " . $kardex_row['codpro'] . " en el registro " . $kardex_row['invnum']);
                        }
                    }
                }
            } else {
                $logger->log("No se ha encontrado el producto " . $kardex_row['codpro'] . " en la tabla producto");
            }
        }
        $logger->log("Se han actualizado " . $kardex_loop . " registros en kardex");
        $logger->log("Se han encontrado " . mysqli_num_rows($kardex_result) . " registros en kardex");
    } else {
        $logger->log("No hay registros en kardex de bonificados");
    }
    $logger->log("--------------------------------------------------");


