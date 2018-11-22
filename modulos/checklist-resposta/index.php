<?php 

	define("NOME_MODULO", "Questionários"); 
	define("NOME_ACAO", "Responder"); 
	include_once 'breadcrumb.php';
	
	$checklist = new Checklist();
	$listaCkeckList = $checklist->listar();
	
	$internacao = new Internacao();
	if(isset($_REQUEST['cpf'])) {
	    $objInternacao =  $internacao->listarInternacaoPorCpf($_REQUEST['cpf']);
	}

?>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
	                    <div class="ibox-content">
						<div class="ibox ">
                        <div class="ibox-title">
                            <h5>Questionários Disponíveis</h5>
                        </div>
                        <div class="ibox-content">
                        
                        	<div class="row">
                            	<div class="col-sm-8 b-r">
                                	<form role="form" action="#" method="post">
                                	<fieldset style="border: solid 1px;">
                                		<label>Consulte o paciente</label>
                                        <div>
                                        	<div class="form-group col-sm-8"><input type="text" placeholder="Informe o cpf do paciente" class="form-control" name="cpf"></div>
                                            <button class="btn btn-primary" type="submit">Pesquisar</button>
                                        </div>
                                    </fieldset>
                                    </form>
                               	</div>
                           	</div>
                           	
                           	<?php if($objInternacao != null) { ?>
                        	<div class="row">
                            	<div class="col-sm-12 b-r">
                                	<div class="row">
                                    	<div class="col-sm-6"><label>Nome</label> <input type="text" value="<?php echo $objInternacao->paciente->nome ?>" disabled="disabled" class="form-control" name="nome"></div>
                                        <div class="col-sm-6"><label>CPF</label> <input type="text" value="<?php echo $objInternacao->paciente->cpf ?>" disabled="disabled" class="form-control" name="cpf"></div>
                                    </div>  
                                    <div class="row">
                                    	<div class="col-sm-6"><label>Nascimento</label> <input type="text" value="<?php echo formatarData($objInternacao->paciente->nascimento) ?>" disabled="disabled" class="form-control" name="nascimento"></div>
                                        <div class="col-sm-6"><label>Convênio</label> <input type="text" value="<?php echo $objInternacao->convenio->nome ?>" disabled="disabled" class="form-control" name="convenio"></div>
                                    </div> 
                                    
                                    
                                    <div class="row">
                                    	<div class="col-sm-6"><label>Número da Internação *</label> <input type="text" disabled="disabled" value="<?php echo $objInternacao->paciente->numero_internacao ?>" placeholder="Informe o número da internação" class="form-control" name="numero_internacao" required="required"></div>
                                    </div>
                               	</div>
                           	</div>
                           	<div class="hr-line-dashed"></div>
                           	<?php } ?>

							<?php 
							foreach ($listaCkeckList as $checklist) {
							         $item = new Item();
							         $itensChecklist = $item->listarPorIdChecklist($checklist->id);
						    ?>
                                <div class="dd" id="nestable2">
                                    <ol class="dd-list">
                                        <li class="dd-item" data-id="1">
                                            <div class="dd-handle">
                                            	<span class="pull-right"> <a href="/checklist-resposta/resposta/<?php echo $checklist->id?>/<?php echo $objInternacao->id ?>"><?php echo " Responder - ".count($itensChecklist) . " questões" ?> </a></span>
                                                <span class="label label-info"><i class="fa fa-users"></i></span> <?php echo $checklist->nome ?>
                                            </div>
                                        </li>
                                    </ol>
                                </div>
                                
                            <?php } ?>
                            


	                    </div>
	                </div>
	            </div>
            </div>
        </div>
     </div>