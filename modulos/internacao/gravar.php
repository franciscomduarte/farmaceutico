<?php 

	#dados do formulario
    
    $internacao = new Internacao();
    $internacao->id = $_REQUEST['id'];
    $internacao->numero_internacao = $_REQUEST['numero_internacao'];
    $internacao->data_internacao = $_REQUEST['data_internacao'];
    $internacao->setor->id = $_REQUEST['id_setor'];
    $internacao->paciente->id = $_REQUEST['id_paciente'];
    $internacao->convenio->id = $_REQUEST['id_convenio'];
    $internacao->checklists = $_REQUEST['id_checklists'];
	$internacao->inserir($internacao);
	redirecionar("/checklist-resposta/".$internacao->id);

?>