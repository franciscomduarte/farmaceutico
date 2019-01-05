<?php 

    $id_checklist = $_REQUEST['id_checklist'];
	#dados do formulario
    echo $cpf = 	$_REQUEST['cpf'];
    if(validaCPF($cpf)) {
        $paciente               = new Paciente();
        $paciente->id           = $_REQUEST['id_paciente'];
        $paciente->nome         = strtoupper($_REQUEST['nome']);
        $paciente->cpf          = removeCaracteresCPF($cpf);
        $paciente->nascimento   = dateEmMysql($_REQUEST['nascimento'] );
        $paciente->genero       = $_REQUEST['genero'];
        $paciente->registro     = $_REQUEST['registro'];
        $convenio = new Convenio();
        $paciente->convenio     = $convenio->listarPorId($_REQUEST['id_convenio']);

        if($paciente->id){
            $paciente->editar($paciente);
    	} else {
    	    $paciente->inserir($paciente);
    	    $paciente->id = $paciente->retornaIdInserido();
    	}
    	
    	#dados do formulario de internacao
    	$internacao = new Internacao();
    	echo $internacao->id = $_REQUEST['id_internacao'];
    	$internacao->numero_internacao = $_REQUEST['numero_internacao'];
    	$internacao->data_internacao = dateEmMysql($_REQUEST['data_internacao']);
    	$internacao->setor->id = $_REQUEST['id_setor'];
    	$internacao->paciente->id = $paciente->id;
    	$internacao->convenio->id = $_REQUEST['id_convenio'];
    	$internacao->checklists = $_REQUEST['id_checklists'];
    	if($internacao->id){
    	   $internacao->editar($internacao);
    	} else {
    	    $internacao->inserir($internacao);
    	}
    	
    	redirecionar("/checklist-resposta/" . $id_checklist);
    } else {
        echo $cpf;
        echo "aaa";
       // aprensentaMensagem(ERROR, "CPF inválido.");
    }

?>