<?php 

    // dados da url
    $params = retornaParametrosUrl($_SERVER['QUERY_STRING']);
    $id = $params[2];
    
    $internacao = new Internacao();
    $internacao = $internacao->listarPorId($id);
    $telegram = new Telegram();
    $telegram->enviaAlerta("Bundle não preenchido do paciente " . $internacao->paciente->nome . ". Necessário verificação!");
    redirecionar("/checklist-resposta");

?>