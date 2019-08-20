<?php


ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL & ~E_NOTICE);

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

session_start();

// Faz o carregamento das classes
// Função nova para autoload PHP 7
spl_autoload_register(function ($class) {
    include 'classes/'.$class .'.php';
});
    
    include_once 'config.php';
    include_once 'util/functions.php';
    
    $modulos_sem_login = array(
        "alerta" => "bundles-nao-preenchidos.php",
    );
    
    $params = retornaParametrosUrl($_SERVER['QUERY_STRING']);
    $modulo = (explode("=",$params[0]))[1];
    if($modulos_sem_login[$modulo] != null) {
        redirecionar("/modulos/".$modulo."/".$modulos_sem_login[$modulo]);
    } else   
    if (!isset($_SESSION["usuario"])) {
            redirecionar("/login.php");
    } else {
        include_once 'head.php';
        include_once 'menu.php';
        include_once "modulos/index.php";
    }
    
    include_once 'footer.php';
    ?>
