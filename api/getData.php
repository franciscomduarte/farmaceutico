<?php 

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    

    $array = array(["id" => 1, "title" => "Teste", "description" => "asdada"]);
    $data['data'] = $array;
    $data['total'] = 1;
    
    echo json_encode($data);
    

?>