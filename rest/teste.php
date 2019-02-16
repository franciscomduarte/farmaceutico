<?php 
require_once '../config.php';
require_once '../util/functions.php';

spl_autoload_register(function ($class) {
    include '../classes/'.$class .'.php';
});

$checklistDao = new Checklist();
$checklists = $checklistDao->listar();

echo json_encode($checklists);


?>