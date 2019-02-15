<?php

define("NOME_MODULO", "Paciente");
define("NOME_ACAO", "Dashboard Individual");
include_once 'breadcrumb.php';

$params = retornaParametrosUrl($_SERVER['QUERY_STRING']);
$cpf = $params[2];
$id_checklist  = $params[3];
$id_internacao = $params[4];

$objInternacao = new Internacao();
$internacao    = $objInternacao->listarInternacaoPorCpf($cpf);

?>

<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-4">
                        <div class="m-b-md">
                        <dl class="dl-vertical">
                	         <dd>
                	         <select name="id_internacao" id="carrega_internacao" class="form-control" required="required">
								<option value="">-- Selecione --</option>
								<?php
								$listaInterncoes = $objInternacao->listarTodasPorCpf($cpf);
								foreach ($listaInterncoes as $obj) {
									?>
									<option value="<?php echo $obj->id ?>" <?php echo ($id_internacao == $obj->id ? 'selected="selected"' : '')?>> <?php echo $obj->numero_internacao." - ".formatarDataHora($obj->data_internacao)?> </option>
								<?php
								}
								?>
	                    	</select>
	                    	</dd>
	                    </dl>
	                    	</div>
                        </div>
                        <div class="col-lg-8">
                            <div class="m-b-md">
                                <div class="ibox-tools">
                                
                					<a class="btn btn-info btn-xs" style="color: white; background: red; border-color: red" href="/paciente/detalhes/<?php echo $cpf?>">Todos</a>
                					<?php 
                                    $objChecklist = new Checklist();
                                    $bundles = $objChecklist->listarPorInternacao($internacao->id);
                                    foreach ($bundles as $bundle) {
                                    ?>
                                    	<a class="btn btn-info btn-xs" style="color: white; background: <?php echo $bundle->cor ?>; border-color: <?php echo $bundle->cor ?>" href="/paciente/detalhes/<?php echo $cpf.'/'.$bundle->id?>"><?php echo $bundle->sigla ?></a>
                                    <?php 
                                    }
                                    ?>
                				</div>
                                <h2><?php 
                                        printf("%s | %s  ",$internacao->paciente->nome,$internacao->paciente->cpf); 
                                        echo $internacao->paciente->genero == "FEMININO" ? "<i class='fa fa-female'></i>" : "<i class='fa fa-male'></i>";
                                    ?>
                                </h2>
                                <?php 
                                if (isset($id_checklist)){
                                    $objChecklist = new Checklist();
                                    $checklist = $objChecklist->listarPorId($id_checklist);
                                    echo "<i>".$checklist->nome." - ".$checklist->sigla."</i>";
                                    $questionario = $objChecklist->listarPorId($id_checklist);
                                }
                                ?>
                            </div>
                            <dl class="dl-horizontal">
                                <dt>Número Internacão:</dt> <dd><?php echo $internacao->numero_internacao." - ".$internacao->setor->nome?></dd>
                            </dl>
                        </div>
                        
                        
                        
                        
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <dl class="dl-horizontal">
                                <dt>Data:</dt><dd><?php echo formatarDataHora($internacao->data_internacao)?></dd>
                                
                            </dl>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <dl class="dl-horizontal">
                                <dt>Completed:</dt>
                                <dd>
                                    <div class="progress progress-striped active m-b-sm">
                                        <div style="width: 60%;" class="progress-bar"></div>
                                            </div>
                                            <small>Project completed in <strong>60%</strong>. Remaining close the project, sign a contract and invoice.</small>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row m-t-sm">

                            </div>

                </div>
            </div>
            </div>
        </div>
</div>
<script type="text/javascript">
$('#carrega_internacao').change(function(){
    location.href="/paciente/detalhes/<?php echo $cpf."/".$id_checklist?>/"+($(this).val());
});
</script>