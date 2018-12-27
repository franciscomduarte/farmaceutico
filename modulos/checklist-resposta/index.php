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
					<?php 
                    $objChecklist = new Checklist();
                    $bundles = $objChecklist->listarAtivosCount();
                    foreach ($bundles as $bundle) {
                    ?>
                    	<a class="btn btn-info btn-xs" style="color: white; background: <?php echo $bundle->cor ?>; border-color: <?php echo $bundle->cor ?>" href="/checklist-resposta/<?php echo $bundle->id?>"><?php echo $bundle->sigla ?></a>
                    <?php 
                    }
                    ?>
					<button type="button" class="btn btn-info" onclick="location.href='/paciente/novo/<?php echo $cl->id ?>'">Novo Paciente</button>
					<button type="button" class="btn btn-info" onclick="location.href='/internacao/novo/<?php echo $cl->id ?>'">Incluir no CkeckList</button>
				</div>
			</div>
			<div class="ibox-content">
				<table class="table table-hover no-margins">
					<thead>
						<tr>
							<th>Paciente</th>
							<th>Quest.</th>
							<th>Adicionar</th>
							<th>Alta?</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$respostaChecklist = new RespostaChecklist();
						foreach ($interenacoes as $internacao) {
						    $status = $respostaChecklist->verificarPreenchimento($internacao->id, $cl->id);
						?>
						<tr>
							<td><small><?php echo $internacao->paciente->nome ?></small></td>
							<!-- <td class="text-navy"> <small class="label label-primary"><i class="fa fa-clock-o"></i> <?php echo diffDate(date('Y-m-d H:i'), $internacao->data_internacao)?></small></td> -->
							<td>
    							<div class="form-group">
                                        <div class="col-sm-10">
                                            <?php 
                                            	$objChecklist = new Checklist();
                                            	$bundles = $objChecklist->listarAtivasPorInternacao($internacao->id);
                                            	foreach ($bundles as $bundle) {
                                            	    $statusPreenchimento = $respostaChecklist->verificarPreenchimento($internacao->id, $bundle->id);
                                            	    if($cl->id == $bundle->id){
                                        	?>
                                            			<button <?php echo $statusPreenchimento != null ? "disabled" : "" ?> class="btn btn-info btn-xs" style="color: white; background: <?php echo $bundle->cor ?>; border-color: <?php echo $bundle->cor ?>" onclick="responder(<?php echo $bundle->id ?>,<?php echo $internacao->id?>)">Responder</button>
                                            <?php 
                                            	    }
                                        		}
                                            ?>
                                    </div>
                                </div>
							</td>
							<td>
								<div class="form-group">
    								<div class="col-sm-10">
                                                <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button"><span class="caret"></span></button>
                                                
                                                <ul class="dropdown-menu">
    								        	<?php 
    								        	   $objChecklist = new Checklist();
    								        	   $bundles = $objChecklist->listarPendentesPorInternacao($internacao->paciente->id);
    								        	   if($bundles) {
    								        	   foreach ($bundles as $bundle) { ?>
                										<li><a onclick="adicionar(<?php echo $internacao->id?>,<?php echo $bundle->id ?>)" href="#"><?php echo $bundle->sigla ?></a></li>
                        							<?php
                        							} 
    								        	   }else {?>
                										<li>Não há itens a adicionar</li>
    								        	   <?php }
                        							?>	
                        						</ul>
                                    </div>
                                </div>
							</td>
							<td>
								<?php if ($status == null) {?>
								<button class="btn btn-info btn-xs" onclick="dar_alta(<?php echo $internacao->id?>, <?php echo $cl->id ?>)">
									<span title="Remover">Dar Alta</span>
								</button>
								<?php } else { ?>
									<span>-</span>
								<?php }?>
							</td>
							<!--  <td align="center">
								<?php echo $status != null ? "<i class='fa fa-check text-navy'></i>" : "<i class='fa fa-warning'></i>" ?></small>
							</td>-->
						</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

		<script>
    		function dar_alta(id_internacao, id_checklist){
    			apresentaConfirmacao();
    			swal({
                    title: "Tem certeza que deseja remover o paciente do checklist?",
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
        				var pag = "/internacao/liberar/"+id_internacao+"/"+id_checklist;
        				location.href = pag;
                    } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                });
    		}

    		function adicionar(id_internacao, id_checklist){
    			apresentaConfirmacao();
    			swal({
    				title: "Tem certeza que deseja incluir este paciente no checklist?",
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
        				var pag = "/checklist-resposta/adicionar/"+id_internacao+"/"+id_checklist;
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