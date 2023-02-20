<?php 
require_once '../../../session_user.php';
require_once 'conexion2.php';

function getListasRep(){
    
    $usuario = $_SESSION['codigo_user'];
    
  $mysqli = getConn();
  $query = "SELECT nlicencia FROM datagen"; 
  $result = $mysqli->query($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
     $nlicencia       = $row['nlicencia'];
  }
  $nlicencia =$nlicencia-1;
  
  $query = "SELECT xcompa.codloc as codlo,nomloc FROM xcompa inner join usuario on xcompa.codloc = usuario.codloc where usecod = '$usuario'"; 
  $result = $mysqli->query($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
     $codigo_local    = $row['codlo'];
    $nombre_local    = $row['nomloc'];
  }
  
  
  $query = "SELECT codloc,nombre FROM xcompa where codloc <> '$codigo_local' and habil = '1' order by codloc ASC LIMIT $nlicencia"; 
  $result = $mysqli->query($query);
  $listas = '<option value="0">Elija un Local</option>';
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $listas .= "<option value='$row[codloc]'>$row[nombre]</option>";
  }
  return $listas;
}

echo getListasRep();