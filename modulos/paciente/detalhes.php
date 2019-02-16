<?php

define("NOME_MODULO", "Paciente");
define("NOME_ACAO", "Dashboard Individual");
include_once 'breadcrumb.php';

$params = retornaParametrosUrl($_SERVER['QUERY_STRING']);
$cpf = $params[2];
$id_internacao = $_REQUEST['id_internacao'];

$pacienteDao   = new Paciente();
$internacaoDao = new Internacao();
$checklistDao  = new Checklist();

$pacienteDao->cpf = $cpf;
$paciente = $pacienteDao->listarPorCpf($pacienteDao);

if (isset($id_internacao)){
    $internacao = $internacaoDao->listarPorId($id_internacao);
}



?>

<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="m-b-md">
                                <h2><?php 
                                        printf("%s | %s  ",$paciente->nome,$paciente->cpf); 
                                        echo $paciente->genero == "FEMININO" ? "<i class='fa fa-female'></i>" : "<i class='fa fa-male'></i>";
                                    ?>
                                </h2>
                                
                                <?php 
                                if (isset($id_internacao)){ 
                                    $data_saida = $internacaoDao->getInternacaoChecklist($internacao->id);
                                ?>
                                <b>Data Internação:</b> <?php echo formatarDataHora($internacao->data_internacao)?> 
                                <?php 
                                    if (strlen($data_saida) < 10){
                                        echo "<b>Paciente internado à: </b>".diffDate($internacao->data_internacao, $data_saida)." <b>SEM ALTA</b>";
                                    }else{
                                        echo "<b>Data Saída: </b>".$data_saida." - ".diffDate($internacao->data_internacao, $data_saida)." <b>Internada.</b>";
                                    }
                                }
                               ?>
							    
                            </div>
                        </div>
                        
                    </div>
                    <form role="form" action="/paciente/detalhes/<?php echo $cpf?>" method="post">
                        <div class="row">
                        	<div class="col-lg-8">
                        		INTERNAÇÃO: 
                        		<select name="id_internacao" id="carrega_internacao" class="form-control" required="required">
    								<option value="">-- Selecione --</option>
    								<?php
    								$listaInterncoes = $internacaoDao->listarTodasPorCpf($cpf,"desc");
    								foreach ($listaInterncoes as $obj) {
    									?>
    									<option value="<?php echo $obj->id ?>" <?php echo ($id_internacao == $obj->id ? 'selected="selected"' : '')?>> <?php echo $obj->numero_internacao." - ".formatarDataHora($obj->data_internacao)?> </option>
    								<?php
    								}
    								?>
    	                    	</select>
                          </div>
                      </div>
                 </form>  
                 <?php 
                    $checklistvos = $checklistDao->getChecklistIndividualSumarizado($id_internacao);
                 ?>
                 
                 <div class="row">
                        <div class="col-lg-12">
                            <div class="forum-title">
                                <div class="pull-right forum-desc">
                                    <samll>Total: <?php echo sizeof($checklistvos)?></samll>
                                </div>
                                <h3>Checklists do Paciente</h3>
                            </div>

							<!-- Linha repetida -->
							<?php foreach ($checklistvos as $checklistvo) {?>
							
                            <div class="forum-item active">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="forum-icon">
                                            <i class="fa fa-shield"></i>
                                        </div>
                                        <a href="#" class="forum-item-title"><?php echo $checklistvo->sigla_cheklist." - ".$checklistvo->nome_checklist?></a>
                                        <div class="forum-sub-title">                                
                                        	<?php 
                                        	   $porcentagem = $checklistvo->getPorcentagem();
                                        	                                           	      
                                        	?>
                                        	
                                        	<div class="progress progress-mini">
                                    			<div style="width: <?php echo $porcentagem?>%;" class="progress-bar <?php echo $porcentagem <= 80 ? "progress-bar-danger":""?>"></div>
                                			</div>
                                		</div>
                                    </div>
									<div class="col-md-1 forum-info">
                                        <span class="views-number">
                                            <?php echo $checklistvo->getPorcentagem()."%"?>
                                        </span>
                                        <div>
                                            <small>Percentual</small>
                                        </div>
                                    </div>
									
                                    <div class="col-md-1 forum-info">
                                        <span class="views-number">
                                            <?php echo $checklistvo->total_previsto?>
                                        </span>
                                        <div>
                                            <small>Previsto</small>
                                        </div>
                                    </div>
                                    <div class="col-md-1 forum-info">
                                        <span class="views-number">
                                            <?php echo $checklistvo->total_resposta?>
                                        </span>
                                        <div>
                                            <small>Respondido</small>
                                        </div>
                                    </div>
                                    <div class="col-md-1 forum-info">
                                        <span class="views-number">
                                            <?php echo ($checklistvo->getDiferenca())?>
                                        </span>
                                        <div>
                                            <small>Diferença</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                            
                            
                            
                            
                       	</div>                        
                    </div>
               </div>
            </div>
        </div>
  </div>
</div>
<script type="text/javascript">
$('#carrega_internacao').change(function(){
	if ($(this).val() != ""){
    	location.href="/paciente/detalhes/<?php echo $cpf."?id_internacao="?>"+($(this).val());
	}else{
		//location.href="/paciente/detalhes/<?php echo $cpf?>;
	}
});
</script>
