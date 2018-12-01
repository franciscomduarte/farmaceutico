<?php

$params = retornaParametrosUrl($_SERVER['QUERY_STRING']);
$id_checklist = $params[1];

$objChecklist = new Checklist();
$cl = $objChecklist->listarPorId($id_checklist);

$obj = new Internacao();
$interenacoes = $obj->listarAtivas($id_checklist);

?>

<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Pacientes na UTI - <?php echo $cl->sigla ?></h5>
				<div class="ibox-tools">
					<button type="button" class="btn btn-info" onclick="location.href='/paciente/novo/'">Novo Paciente</button>
					<button type="button" class="btn btn-info" onclick="location.href='/internacao/novo/'">Incluir no CkeckList</button>
				</div>
			</div>
			<div class="ibox-content">
				<table class="table table-hover no-margins">
					<thead>
						<tr>
							<th>Paciente</th>
							<th>Nr. Internação</th>
							<th>Data Entrada</th>
							<th>Dias Internado</th>
							<th>Responder</th>
							<th>Responder</th>
							<th>Dar alta?</th>
							<th>Respondido Hoje?</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$respostaChecklist = new RespostaChecklist();
						foreach ($interenacoes as $internacao) {
						    $status = $respostaChecklist->verificarPreenchimento($internacao->id);
						?>
						<tr>
							<td><small><?php echo $internacao->paciente->nome ?></small></td>
							<td><small><?php echo $internacao->numero_internacao ?></small></td>
							<td><small><?php echo formatarData($internacao->data_internacao) ?></small></td>
							<td class="text-navy"> <small class="label label-primary"><i class="fa fa-clock-o"></i> <?php echo diffDate(date('Y-m-d H:i'), $internacao->data_internacao)?></small></td>
							<td>
								<button onclick="responder(<?php echo $cl->id ?>,<?php echo $internacao->id?>)" <?php echo $status != null ? "disabled" : "" ?>>
									<span title="<?php echo $cl->sigla ?>"><?php echo $cl->sigla ?></span>
								</button>
							</td>
							<td>
							
    							<div class="form-group">
                                        <div class="col-sm-10">
                                            <div class="input-group m-b">
                                                <div class="input-group-btn">
                                                    <button onclick="responder(<?php echo $cl->id ?>,<?php echo $internacao->id?>)" tabindex="-1" class="btn btn-white" type="button"><?php echo $cl->sigla ?></button>
                                                    <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button"><span class="caret"></span></button>
                                                    
                                                    <ul class="dropdown-menu">
                                                        <?php 
                                                        	$objChecklist = new Checklist();
                                                        	$bundles = $objChecklist->listarAtivasPorInternacao($internacao->id);
                                                        	foreach ($bundles as $bundle) {
                                                    	?>
                                                        	<li><a onclick="responder(<?php echo $bundle->id ?>,<?php echo $internacao->id?>)" href="#"><?php echo $bundle->sigla ?></a></li>
                                                        <?php 
                                                    		}
                                                        ?>
                                                    </ul>
                                                </div>
                                        </div>
                                    </div>
                                </div>
							</td>
							<td>
								<button onclick="dar_alta(<?php echo $internacao->id?>)">
									<span title="Dar alta">Alta</span>
								</button>
							</td>
							<td>
								<?php echo $status != null ? "<i class='fa fa-check text-navy'></i>" : "<i class='fa fa-warning'></i>" ?> - <small><?php echo formatarData($status->data_internacao) ?></small>
							</td>
						</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

		<script>
    		function dar_alta(id){
    			apresentaConfirmacao();
    			swal({
                    title: "Tem certeza que deseja dar alta ao paciente do checklist?",
                    text: "Você não poderá desfazer essa operação.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Confirmar",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: true },
                function (isConfirm) {
                    if (isConfirm) {
        				var pag = "/internacao/liberar/"+id;
        				location.href = pag;
                    } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                });
        		
    			
    		}
    		
    		function lista_checklist(id){
    			var pag = "/checklist-resposta/lista-checklist/"+id;
    			location.href = pag;
    		}	

    		function responder(id_checklist, id_internacao){
    			var pag = "/checklist-resposta/resposta/"+id_checklist+"/"+id_internacao;
    			location.href = pag;
    		}			

		</script>