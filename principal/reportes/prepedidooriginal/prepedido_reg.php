<?php
    include('../../session_user.php');
    require_once ('../../../conexion.php');
    require_once ('../../../convertfecha.php');

    $date1 = fecha1($_REQUEST['date1']); 
    $date2 = fecha1($_REQUEST['date2']);
    $codloc = $_REQUEST['local'];

    $date = date('Y-m-d H:i:s');
    $sqlInsert = "INSERT INTO `prepedido`
    (`idusuario`, `codloc`, `fecha`, `estado`, `fechaini`, `fechafin`) 
    VALUES ('$usuario', '$codloc', '$date', '1', '$date1', '$date2')";
error_log($sqlInsert);
    $result = mysqli_query($conexion, $sqlInsert);
    $last_id = mysqli_insert_id($conexion);
    $numPagina = 0;

    $numpagpreped = 60;
    $sql1="SELECT numpagpreped FROM datagen";
    $result1 = mysqli_query($conexion,$sql1);
    if (mysqli_num_rows($result1))
    {
        while ($row1 = mysqli_fetch_array($result1)){
            $numpagpreped    = $row1['numpagpreped'];
        }
    }

    if (isset($_SESSION['datosPrepedido'])) {
        $datosPrepedido = $_SESSION['datosPrepedido'];
        usort($datosPrepedido, function($a, $b) {
            return strcmp($a["destab"], $b["destab"]);;
        });
        $codigos = array();
        $primCodigo = 0;
        foreach ($datosPrepedido as $datos) {
            $codpro = $datos['codprod'];
            $sumcantidadAux = $datos['unidades'];
            $StockActualAux = $datos['stock'];
            $stockCentral = $datos['stockCentral'];
            
            
            $contador = floor($numPagina/$numpagpreped);
            $solicitado = $sumcantidadAux;
            if ($stockCentral<$sumcantidadAux) {
                $solicitado = $stockCentral;
            }
            if ($solicitado > 0){
                $codigoNuevo = ($last_id*100) + $contador;
                if ($primCodigo == 0) {
                    $primCodigo = $codigoNuevo;
                }
                $sqlInsertDetalle = "INSERT INTO `detalle_prepedido`(`idprepedido`, `idprod`, 
                `idcantidad`, `solicitado`, `stockprod`,  `numpagina`) 
                    VALUES ('$last_id', '$codpro', '$sumcantidadAux', '$solicitado', '$StockActualAux', '$codigoNuevo')";
                error_log($sqlInsertDetalle);
                mysqli_query($conexion, $sqlInsertDetalle);
                $numPagina++;
                if (!in_array($codigoNuevo,$codigos)) {
                    $codigos[] = $codigoNuevo;
                }
            }

        }
        $textoCodigos = implode(",",$codigos);
        unset($_SESSION['datosPrepedido']);
        echo'<script type="text/javascript">
            alert("Prepedidos generados: '.$textoCodigos.'");
            window.location.href="prepedido.php?idpreped='.$last_id.'&numpagina='.$primCodigo.'";
            </script>';
    }

?>