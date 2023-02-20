<?php 
$maxlifetime = ini_get("session.gc_maxlifetime");
error_log("Caducidad: ".$maxlifetime);

// Verificar si ya hay una sesión activa
if (session_status() !== PHP_SESSION_ACTIVE) {

    define('SEG_RAIZ',   "/novafarma");
    session_set_cookie_params(86400);
    ini_set('session.cookie_lifetime',86400);
    ini_set('session.gc_maxlifetime', 86400);
    session_start();
}

$maxlifetime = ini_get("session.gc_maxlifetime");
error_log("Caducidad despues: ".$maxlifetime);

$usuario    =(isset($_SESSION['codigo_user']) ? $_SESSION['codigo_user'] : "");
$resolucion  =(isset($_SESSION['resolucion']) ? $_SESSION['resolucion'] : "");



if ($usuario == "") 
{
    error_log("Termino la sesi��n ");
    $url = SEG_RAIZ."/index.php";
    header('Location: '.$url);
    exit;
} 

?>