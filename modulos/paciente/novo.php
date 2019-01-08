<?php 

// dados da url
$params = retornaParametrosUrl($_SERVER['QUERY_STRING']);
$id_checklist = $params[2];

$objPaciente = new Paciente();
$objInternacao = new Internacao();
$paciente = new Paciente();

$setor   = new Setor();
$setores = $setor->listar();

$convenio = new Convenio();
$objConvenio = $convenio->listar();

if(isset($_REQUEST['cpf']) && $_REQUEST['cpf'] != "") {
    $cpf = $_REQUEST['cpf'];
    if(validaCPF($cpf)){
        $paciente->cpf = removeCaracteresCPF($cpf);
        $objPaciente =  $paciente->listarPorCpf($paciente);
        if ($objPaciente != null) {
            $objChecklist = new Checklist();
            $bundles = $objChecklist->listarPendentesPorInternacao($objPaciente->id);
            $objInternacao = $objInternacao->listarInternacaoPorCpf($objPaciente->cpf);
        } else {
            aprensentaMensagem(ERROR, "Paciente não encontrado! Preencha os campos para criar uma nova internação");
        }
    } else {
        echo $cpf;
        //aprensentaMensagem(ERROR, "CPF inválido!");
    }
}

?>

<div class="col-lg-12">
	<div class="ibox float-e-margins">
    	<div class="ibox-title">
        	<h5>Cadastro de Paciente<small></small></h5>
        </div>
        <div class="ibox-content">
        	<div class="row">
            	<div class="col-sm-12">
            	   	<div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1">Paciente / Internação </a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                
                                <form role="form" action="" method="post">
                                        <div>
                                        	<div class="form-group col-sm-8"><input required="required" type="text" placeholder="Informe o cpf do paciente" class="form-control" name="cpf" id="input_cpf" data-mask="999.999.999-99"/><span id="cpf"></span></div>
                                            <button class="btn btn-primary" type="submit">Pesquisar</button>
                                        </div>
                                    </form>
                                    
                                    <form role="form" action="/paciente/gravar" method="post">
                                		<input type="hidden" name="id_paciente" value="<?php echo $objPaciente->id ? $objPaciente->id : null ?>">
                                		<input type="hidden" name="id_convenio" value="<?php echo $objPaciente->convenio->id ? $objPaciente->convenio->id : null ?>">
                                		<input type="hidden" name="id_checklist" value="<?php echo $id_checklist ? $id_checklist : 1 // TODO ajustar, pois se não tiver ele pegará sempre o primeiro checklist ?>">
                                		<input type="hidden" name="id_internacao" value="<?php echo $objInternacao->id ? $objInternacao->id : null ?>">
 
                                    	<div class="form-group col-sm-6"><label>Nome</label><span style="color: red;"> *</span> <input <?php echo $objPaciente != null ? "readonly" : "" ?> required="required" type="text" value="<?php echo $objPaciente->nome ? $objPaciente->nome : null ?>" placeholder="Nome do paciente" class="form-control" name="nome"></div>
                                        <div class="form-group col-sm-6"><label>CPF</label><span style="color: red;"> *</span> <input  <?php echo $objPaciente != null ? "readonly" : "" ?> required="required" data-mask="999.999.999-99" type="text" value="<?php echo $objPaciente->cpf ? mask($objPaciente->cpf,'###.###.###-##') : mask($paciente->cpf,'###.###.###-##') ?>" placeholder="CPF do paciente" class="form-control" name="cpf"></div>
                                       	
                						<div class="form-group col-sm-6">
                							<label>Gênero</label><span style="color: red;"> *</span>
                							<select <?php echo $objPaciente != null ? "readonly" : "" ?> name="genero" required="required" class="select2_demo_2 form-control select2-hidden-accessible">
                							<option value="">-- Selecione --</option>
                							<option value="MASCULINO" <?php echo ("MASCULINO" == $objPaciente->genero ? 'selected="selected"' : '')?>>Masculino</option>
                							<option value="FEMININO" <?php echo ("FEMININO" == $objPaciente->genero ? 'selected="selected"' : '')?>>Feminino</option>
                							<option value="OUTRO" <?php echo ("OUTRO" == $objPaciente->genero ? 'selected="selected"' : '')?>>Outro</option>
                                    		</select>
                						</div>
                						
                						<div class="form-group col-sm-6">
                							<label for="db">Nascimento</label><span style="color: red;"> *</span>
                							<div class="input-group">
                								<input <?php echo $objPaciente != null ? "readonly" : "" ?> class="form-control" id="db" type="text" required="required"
                									data-role="datebox"
                									data-options='{"mode":"datebox","useInline":false,"useInlineAlign":"center", "useLang":"pt-br", "afterToday":false,"beforeToday":true}' 
                									readonly="readonly"
                									name="nascimento"
                									value="<?php echo formatarData($objPaciente->nascimento)  ?>">
                							</div>
                						</div>
                						
                                       	<div class="form-group col-sm-6">
                							<label>Convênio</label><span style="color: red;"> *</span> 
                									<select <?php echo $objPaciente != null ? "readonly" : "" ?> class="select2_demo_2 form-control select2-hidden-accessible" name="id_convenio" required="required">
                										<option value="">-- Selecione --</option>
                										<?php foreach ($objConvenio as $c) { 
                							             ?>
                    										<option value="<?php echo $c->id?>" id="s<?php echo $c->id ?>" <?php echo $objPaciente->convenio->id == $c->id ? 'selected' : ''?>>
                    									<?php 
                    							             echo $c->nome; 
                    							         ?>
                    									</option>
                										<?php
                							             } 
                							             ?>	
                							
                									</select>						
                						</div>
                						
                						<div class="form-group col-sm-6">
                                        	<label>Número da Internação</label><span style="color: red;"> *</span> 
                                        	<input <?php echo $objInternacao != null ? "readonly" : "" ?> type="text" value="<?php echo $objInternacao->numero_internacao ? $objInternacao->numero_internacao : null ?>" placeholder="Informe o número da internação" class="form-control" name="numero_internacao" required="required">
                                        </div>
                                        
                    					<div class="form-group col-sm-6">
                    						<label for="db">Data da Internação</label><span style="color: red;"> *</span> 
                    						<div class="input-group">
                    						<input <?php echo $objPaciente != null ? "readonly" : "" ?> class="form-control" id="db" type="text"
                    									data-role="datebox"
                    									data-options='{"mode":"datebox","useInline":false,"useInlineAlign":"center", "useLang":"pt-br", "afterToday":true,"beforeToday":false}' 
                    									readonly="readonly"
                    									name="data_internacao"
                    									value="<?php echo formatarData($objInternacao->data_internacao)  ?>"
                    									required="required">
                    						</div>
                                        </div>
                                        
                                        <div class="form-group col-sm-6">
                                        	<label>Registro de Internação</label> <span style="color: red;"> *</span>
                                           	<textarea required="required" placeholder="Registro de internação" class="form-control" name="registro"><?php echo $objPaciente->registro ? $objPaciente->registro : "" ?></textarea>
                                        </div>
                                        
                                        <div class="form-group col-sm-6">
                    						<label>Setor</label><span style="color: red;"> *</span>  
                        							<select class="form-control" name="id_setor" required="required">
                        							<?php foreach ($setores as $setor) { ?>
                            							<option value="<?php echo $setor->id?>" id="<?php echo $setor->id ?>" <?php echo $objInternacao->id_setor == $setor->id ? 'selected' : ''?>>
                            							<?php echo $setor->nome; ?>
                            							</option>
                        							<?php
                        							} 
                        							?>	
                        							</select>						
                						</div>
                						
                						<div class="form-group col-sm-6">
                    						<label>Bundles</label><span style="color: red;"> *</span>  
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
                
       
                                        <div class="row">&nbsp;</div>  
                                        <div>
                                        	<button class="btn btn-white" type="button" onclick="history.go(-1);">Cancelar</button>
                                            <button class="btn btn-primary" type="submit">Salvar</button>
                                        </div>
                                    </form>
                         		</div>
                            </div>
                        </div>


                    </div>
                </div>
            	
               	</div>
           	</div>
       	</div>
    </div>
</div>