
<?php

require_once('conexion.php');

function convertir_a_numero($str) {
    $legalChars = "%[^0-9\-\. ]%";
    return preg_replace($legalChars, "", $str);
}

$sql = "SELECT invnum,sucursal,sucursal1  FROM movmae WHERE invfec between '2020-07-06' and '2020-07-07' and tipmov='2' and tipdoc='3' and estado = '1' and proceso='0' and val_habil='0' and cargaprepedido <> '0' ";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_array($result)) {
        $invnummovmaeprincipal = $row['invnum'];




        $sql1movmae = "SELECT invnum,sucursal FROM movmae WHERE invnum='$invnummovmaeprincipal'    ";
        $result1movmae = mysqli_query($conexion, $sql1movmae);
        if (mysqli_num_rows($result1movmae)) {
            while ($row1movmae = mysqli_fetch_array($result1movmae)) {
                $invnummovmaeenvia = $row1movmae['invnum'];
                $sucursalingresoenvia = $row1movmae['sucursal']; //


               /*echo '$invnummovmaeenvia' . $invnummovmaeenvia . "<br>";
                echo '$sucursalingresoenvia' . $sucursalingresoenvia . "<br>";
                echo '*********************************' . "<br>";*/


                $sql1movmovsale = "SELECT invnum,codpro,qtyprf FROM movmov WHERE invnum = '$invnummovmaeenvia' and qtyprf not like 'F%' and qtyprf <> '' ";
                $result1movmovsale = mysqli_query($conexion, $sql1movmovsale);
                if (mysqli_num_rows($result1movmovsale)) {
                    while ($row1movmovsale = mysqli_fetch_array($result1movmovsale)) {
                        $invnummovmovsale = $row1movmovsale['invnum'];
                        $codpromovmovsale = $row1movmovsale['codpro'];
                        $qtyprfmovmovsale = $row1movmovsale['qtyprf'];

                        if ($qtyprfmovmovsale <> '') {
                          /*  echo '---------------------------' . '$invnummovmovsale' . $invnummovmovsale . "<br>";
                            echo '---------------------------' . '$codpromovmovsale' . $codpromovmovsale . "<br>";
                            echo '---------------------------' . "<br>";*/

                             mysqli_query($conexion,"UPDATE movmov set qtypro = $qtyprfmovmovsale, qtyprf = '',corrigo = 1 where invnum = '$invnummovmovsale' and codpro = '$codpromovmovsale' ");
                              mysqli_query($conexion,"UPDATE kardex set qtypro = $qtyprfmovmovsale, fraccion = '',corrigo = 1 where invnum = '$invnummovmovsale' and codpro = '$codpromovmovsale' ");
                           
                           //fin de arregla kardex

                           
                        }
                    }
                    
                    
                }
            }
        }

        ///////////////////////////////////////////////ingresooooo de trandferancia


        $sql1recibe = "SELECT invnum,sucursal  FROM movmae WHERE invnumrecib='$invnummovmaeprincipal'    ";
        $result1recibe = mysqli_query($conexion, $sql1recibe);
        if (mysqli_num_rows($result1recibe)) {
            while ($row1recibe = mysqli_fetch_array($result1recibe)) {
                $invnummovmaerecibe = $row1recibe['invnum'];
                $sucursaldetinorecibe = $row1recibe['sucursal'];


              /*  echo '$invnummovmaerecibe' . $invnummovmaerecibe . "<br>";
                echo '$sucursaldetinorecibe' . $sucursaldetinorecibe . "<br>";
                echo '///////////////////////////' . "<br>";*/

                $sql1recibe2 = "SELECT invnum,codpro,qtyprf FROM movmov WHERE invnum = '$invnummovmaerecibe' and qtyprf not like 'F%' and qtyprf <> '' ";
                $result1recibe2 = mysqli_query($conexion, $sql1recibe2);
                if (mysqli_num_rows($result1recibe2)) {
                    while ($row1recibe2 = mysqli_fetch_array($result1recibe2)) {
                        $invnummovmovrecibe = $row1recibe2['invnum'];
                        $codpromovmovrecibe = $row1recibe2['codpro'];
                        $qtyprfmovmovrecibe = $row1recibe2['qtyprf'];

                        if ($qtyprfmovmovrecibe <> '') {

/*                            echo '------******************------' . '$invnummovmovrecibe' . $invnummovmovrecibe . "<br>";
                            echo '------******************------' . '$codpromovmovrecibe' . $codpromovmovrecibe . "<br>";
                            echo '------******************------' . "<br>";*/

                             mysqli_query($conexion,"UPDATE movmov set qtypro = $qtyprfmovmovrecibe, qtyprf = '',corrigo = 1 where invnum = '$invnummovmovrecibe' and codpro = '$codpromovmovrecibe' ");
                            mysqli_query($conexion,"UPDATE kardex set qtypro = $qtyprfmovmovrecibe, fraccion = '',corrigo = 1 where invnum = '$invnummovmovrecibe' and codpro = '$codpromovmovrecibe' ");
                       }
                    }
                }
            }
        }

        /*echo '##########################################################' . "<br>";
        echo '##########################################################' . "<br>";
        echo '##########################################################' . "<br>";*/
    }
}

