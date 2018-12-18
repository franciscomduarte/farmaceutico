<?php 

// dados da url
$params = retornaParametrosUrl($_SERVER['QUERY_STRING']);
$id_checklist = $params[2];

$obj = null;
$objPaciente = null;
$paciente = new Paciente();

$setor   = new Setor();
$setores = $setor->listar();

if(isset($_REQUEST['cpf']) && $_REQUEST['cpf'] != "") {
    $cpf = $_REQUEST['cpf'];
    if(validaCPF($cpf)){
        $paciente->cpf = removeCaracteresCPF($cpf);
        $objPaciente =  $paciente->listarPorCpf($paciente);
        if ($objPaciente != null) {
            $objChecklist = new Checklist();
            $bundles = $objChecklist->listarPendentesPorInternacao($objPaciente->id);
        
        // Verifica se o paciente já está em um checklist com internação ativa
            $pacienteEmChecklist = count($objChecklist->listarAtivos()) - count($bundles);
            if($pacienteEmChecklist > 0) {
                aprensentaMensagem(ERROR, "Consta internção ativa para este paciente!");
            }
        } else {
            aprensentaMensagem(ERROR, "Paciente não encontrado!");
        }
    } else {
        aprensentaMensagem(ERROR, "CPF inválido!");
    }
}

?>

<div class="col-lg-12">
	<div class="ibox float-e-margins">
    	<div class="ibox-title">
        	<h5>Cadastro de Internação<small></small></h5>
        </div>
        <div class="ibox-content">
        	<div class="row">
            	<div class="col-sm-12">
                	<form role="form" action="" method="post">
                	<fieldset style="border: solid 1px;">
                		<label>Consulte o paciente</label>
                        <div>
                        	<div class="form-group col-sm-8"><input type="text" placeholder="Informe o cpf do paciente" class="form-control" name="cpf" id="input_cpf" data-mask="999.999.999-99"/><span id="cpf"></span></div>
                            <button class="btn btn-primary" type="submit">Pesquisar</button>
                        </div>
                    </fieldset>
                    </form>
               	</div>
           	</div>
           	<div class="hr-line-dashed"></div>
           	
           	<?php if($objPaciente != null && !$pacienteEmChecklist) {?>
        	<div class="row">
            	<div class="col-sm-12">
                	<form role="form" action="/internacao/gravar" method="post">
                		<input type="hidden" name="id" value="<?php echo $obj->id ? $obj->id : null ?>">
                		<input type="hidden" name="id_paciente" value="<?php echo $objPaciente->id ? $objPaciente->id : null ?>">
                		<input type="hidden" name="id_convenio" value="<?php echo $objPaciente->convenio->id ? $objPaciente->convenio->id : null ?>">
                		<input type="hidden" name="id_checklist" value="<?php echo $id_checklist ? $id_checklist : 1 // TODO ajustar, pois se não tiver ele pegará sempre o primeiro checklist ?>">
                    	<div class="row">
                        	<div class="col-sm-6"><label>Nome</label> <input type="text" value="<?php echo $objPaciente->nome ? $objPaciente->nome : null ?>" disabled="disabled" class="form-control" name="nome"></div>
                            <div class="col-sm-6"><label>CPF</label> <input type="text" value="<?php echo $objPaciente->cpf ? $objPaciente->cpf : null ?>" disabled="disabled" class="form-control" name="nome"></div>
                        </div>  
                        <div class="row">
                        	<div class="col-sm-6"><label>Nascimento</label> <input type="text" value="<?php echo $objPaciente->nascimento ? formatarData($objPaciente->nascimento) : null ?>" disabled="disabled" class="form-control" name="nome"></div>
                            <div class="col-sm-6"><label>Convênio</label> <input type="text" value="<?php echo $objPaciente->convenio->id ? $objPaciente->convenio->nome : null ?>" disabled="disabled" class="form-control" name="nome"></div>
                        </div> 
                        
                        
                        <div class="row">
                        	<div class="col-sm-6"><label>Número da Internação *</label> <input type="text" value="<?php echo $obj->numero_internacao ? $obj->numero_internacao : null ?>" placeholder="Informe o número da internação" class="form-control" name="numero_internacao" required="required"></div>
                       		<div class="col-sm-6"><label>Data da Internação *</label> <input type="date" value="<?php echo $obj->data_internacao ? formataDataMysql($obj->data_internacao) : null ?>" class="form-control" name="data_internacao" required="required"></div>
                        </div>
                        <div class="row">
                        	<div class="col-sm-6">
        						<label>Setor *</label> 
                               	<div class="form-check">
        						<label class="form-check-label">
        							<select class="form-control" name="id_setor" required="required">
        							<?php foreach ($setores as $setor) { ?>
            							<option value="<?php echo $setor->id?>" id="<?php echo $setor->id ?>" <?php echo $obj->id_setor == $setor->id ? 'selected' : ''?>>
            							<?php echo $setor->nome; ?>
            							</option>
        							<?php
        							} 
        							?>	
        							
        							</select>						
        						</label>
        						</div>
        					</div>
                            <div class="col-sm-6">
        						<label>Bundles *</label> 
                               	<div class="form-check">
        						<label class="form-check-label">
        							<select class="form-control" name="id_checklists[]" required="required" multiple="multiple">
        							<?php foreach ($bundles as $bundle) { ?>
            							<option value="<?php echo $bundle->id?>" id="<?php echo $bundle->id ?>">
            							<?php echo $bundle->sigla; ?>
            							</option>
        							<?php
        							} 
        							?>	
        							
        							</select>						
        						</label>
        						</div>
        					</div>
        				</div>
        				
                        <div class="row">&nbsp;</div>  
                        <div>
                        	<button class="btn btn-white" type="button" onclick="history.go(-1);">Cancelar</button>
                            <button class="btn btn-primary" type="submit">Salvar</button>
                        </div>
                    </form>
               	</div>
           	</div>
           	<?php } else { ?>
               	<div class="row">
               		<div class="col-sm-12">
               			<div class="alert alert-success" id="mensagemSucesso">Caso deseje cadastrar um novo paciente, <a href="/paciente/novo">clique aqui</a></div>
               		</div>
               	</div>
           	<?php } ?>
           	
       	</div>
    </div>
</div>

<script>

</script>