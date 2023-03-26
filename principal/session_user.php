<?php 
// Verificar si ya hay una sesión activa
if (session_status() !== PHP_SESSION_ACTIVE) {
    print("la sesion no estaba activa");
    define('SEG_RAIZ', '..');
    //session_set_cookie_params(86400);
    //ini_set('session.cookie_lifetime',86400);
    //ini_set('session.gc_maxlifetime', 86400);
    session_start();
    print_r($_SESSION);
} else {
    define('SEG_RAIZ', '/principal');
}

$maxlifetime = ini_get("session.gc_maxlifetime");
print("Caducidad: ".$maxlifetime);

$usuario    =(!isset($_SESSION['codigo_user']) ? $_SESSION['codigo_user'] : "");
$resolucion  =(!isset($_SESSION['resolucion']) ? $_SESSION['resolucion'] : "");



if ($usuario == "") 
{
    error_log("Termino la sesi��n ");
    //$url = SEG_RAIZ."/index.php";
    //header('Location: '.$url);
    //exit;
} 

?>