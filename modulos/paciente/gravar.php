<?php 

	#dados do formulario
    $paciente = new Paciente();
    $paciente->id = $_REQUEST['id'];
    $paciente->nome = $_REQUEST['nome'];
    $paciente->cpf = $_REQUEST['cpf'];
    $paciente->nascimento = $_REQUEST['nascimento'];
    $paciente->id_convenio = $_REQUEST['id_convenio'];
	
    if($paciente->id){
        $paciente->editar($paciente);
	} else {
	    $paciente->inserir($paciente);
	}
	redirecionar("/paciente");

?>