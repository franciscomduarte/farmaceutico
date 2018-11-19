<?php 

	#dados do formulario
    $internacao = new Internacao();
    $internacao->id = $_REQUEST['id'];
    $internacao->numero_internacao = $_REQUEST['numero_internacao'];
    $internacao->data_internacao = $_REQUEST['data_internacao'];
    $internacao->id_setor = $_REQUEST['id_setor'];
    $internacao->id_paciente = $_REQUEST['id_paciente'];
    $internacao->id_convenio = $_REQUEST['id_convenio'];
	
    if($internacao->id){
        $internacao->editar($internacao);
	} else {
	    $internacao->inserir($internacao);
	}
	redirecionar("/internacao");

?>