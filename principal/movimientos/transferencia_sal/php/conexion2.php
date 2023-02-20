<?php 
function getConn(){
  $mysqli = mysqli_connect('localhost', 'oct30fno_mariarosa', 'mariarosa123456789', 'oct30fno_novafarma');
  if (mysqli_connect_errno($mysqli))
    echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
  $mysqli->set_charset('utf8');
  return $mysqli;
}