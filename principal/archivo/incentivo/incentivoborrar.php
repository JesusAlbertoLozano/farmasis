<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../../session_user.php');
require_once('../../../conexion.php');

if(!empty($_GET))
{
    $invnum = $_GET["invnum"];


   
    $sql = "SELECT codpro FROM incentivadodet where invnum = '$invnum' ";
    $result = mysqli_query($conexion, $sql);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_array($result)) {
            $codpro = $row['codpro'];


            $sqldet = "SELECT COUNT(*) FROM incentivadodet where codpro = '$codpro'";
            $resultdet = mysqli_query($conexion, $sqldet);
            if (mysqli_num_rows($resultdet)) {
                while ($rowdet = mysqli_fetch_array($resultdet)) {
                    $sum = $rowdet[0];
                }
            }
            if ($sum == 1) {
                mysqli_query($conexion, "UPDATE producto set incentivado  = '0' where codpro = '$codpro'");
            }


         

         

        }
    }

    

    
     $sql1 = "UPDATE incentivado SET esta_desa = '1', estado = 0 WHERE invnum = '$invnum'";
     mysqli_query($conexion, $sql1);

     $sql2 = "UPDATE incentivadodet SET estado = '0' WHERE invnum = '$invnum'";
     mysqli_query($conexion, $sql2);

     
}



header("Location: incentivo.php");
 exit;
