<?php

    $resposta_chelist = new RespostaChecklist();
    $lista = $resposta_chelist->listar();

?>

<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Questionários respondidos</h5>
				<div class="ibox-tools">
					<a class="collapse-link"> <i class="fa fa-chevron-up"></i>
					</a> <a class="close-link"> <i class="fa fa-times"></i>
					</a>
				</div>
			</div>
			<div class="ibox-content">
				<table class="table table-hover no-margins">
					<thead>
						<tr>
							<th>Paciente</th>
							<th>Ckecklist</th>
							<th>Usuário</th>
							<th>Data de Preenchimento</th>
							<th>Há..</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$internacao = new Internacao();  
						foreach ($lista as $resposta) {
						      $inter = $internacao->listarPorId($resposta->internacao->id);
						?>
						<tr>
							<td><small><?php echo $inter->paciente->nome?></small></td>
							<td><?php echo $resposta->checklist->nome ?></td>
							<td class="text-navy"><i class="fa fa-level-up"></i> <?php echo $resposta->checklist->usuario->nome ?></td>
							<td><i class="fa fa-clock-o"></i> <?php echo formatarDataHora($resposta->data_resposta) ?></td>
							<td class="text-navy"> <small class="label label-primary"><i class="fa fa-clock-o"></i> <?php echo diffDate(date('Y-m-d H:i'), $resposta->data_resposta)?></small></td>
						</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>