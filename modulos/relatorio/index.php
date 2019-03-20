<?php

define("NOME_MODULO", "Relatórios");
define("NOME_ACAO", "Bundles");
include_once 'breadcrumb.php';

$filtro = array(
    "id_checklist" => $_REQUEST['id_checklist'],
    "id_setor"     => $_REQUEST['id_setor']
);

?>

<div class="col-lg-12">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>
				Relatório de Bundles por Unidade
			</h5>
		</div>
		<div class="ibox-content">
			<div class="row">

				<form role="form" action="../dashboard-checklist" method="post">
					<div class="form-group col-xs-12 m-sm">

					<div class="form-group col-xs-6">
							<div class="form-group">
								<label>Tipos Bundles</label>
								
								<select name="id_checklist" id="carrega_checklist" class="form-control" required="required">
								<option value="">-- Selecione --</option>
								<?php
								$checklist = new Checklist();
								$listaCheckList = $checklist->listar();
								foreach ($listaCheckList as $obj) {
								    ?>
									<option value="<?php echo $obj->id ?>" <?php echo ($filtro["id_checklist"] == $obj->id ? 'selected="selected"' : '')?>> <?php echo $obj->sigla?> </option>
								<?php
								}
								?>
	                    		</select>
								
							</div>
						</div>


						<div class="form-group col-xs-6">
							<div class="form-group">
								<label>Setor</label>
								
								<select name="id_setor" class="form-control" required="required">
								<option value="">-- Selecione --</option>
								<?php
								if (isset($filtro["id_checklist"])){
    								$setor = new Setor();
    								$listaSetor = $setor->listarComChecklist($filtro["id_checklist"]);
    								
    								foreach ($listaSetor as $obj) {
    									?>
    									<option value="<?php echo $obj->id ?>" <?php echo ($filtro["id_setor"] == $obj->id ? 'selected="selected"' : '')?>> <?php echo $obj->nome?> </option>
    								<?php
    								}
								}
								?>
	                    		</select>
								
							</div>
						</div>

						<div class="form-group col-xs-12 ">
							<div>
								<button class="btn btn-white" type="button" onclick="history.go(-1);">Voltar</button>
								<button class="btn btn-primary" type="submit" >Pesquisar</button>
							</div>
						</div>
						
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$('#carrega_checklist').change(function(){
    location.href="/relatorio/?id_checklist="+($(this).val());
});
</script>
