<?php 

spl_autoload_register(function ($class) {
    include '../classes/'.$class .'.php';
});

#$checklistDao = new Checklist();
#$checklists = $checklistDao->listar();


#$vars = serialize($checklists);

echo json_decode($_REQUEST,true);


?>