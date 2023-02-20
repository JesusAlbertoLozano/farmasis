<?php 
require_once 'conexion2.php';
require_once '../../../session_user.php';

function getVideos(){
  $mysqli = getConn();
  
  $usuario = $_SESSION['codigo_user'];
  $id = $_POST['id'];
  
  
  $query = "SELECT * FROM usuario where estado = '1' and usecod <> '$usuario' and codloc='$id' order by nomusu";
  $result = $mysqli->query($query);
  $videos = '<option value="0">Elija un Vendedor</option>';
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $videos .= "<option value='$row[usecod]'>$row[nomusu]</option>";
  }
  return $videos;
}

echo getVideos();
