<?php 
$params = retornaParametrosUrl($_GET['r']);
$id = $params[2];#id do checkout

if ($id) {
    $checklist = new Checklist();
    $obj = $checklist->listarPorId($id);
    $_SESSION['checklist_session'] = $obj;
}else{
   echo "<script>alert('É necessário escolher um Checklist');history.go(-1);</script>";
}
$item   = new Item();

if (isset($_REQUEST['id_item'])){
    $item = $item->listarPorId($_REQUEST['id_item']);
}else{  
    $item->checklist = $obj; 
}

?>
		<div class="ibox-title">
			<h5>
				Cadastro de Itens | <strong><?php echo strtoupper($item->checklist->nome." #".$item->checklist->id) ?></strong>
			</h5>
		</div>
		<div class="ibox-content">
			<div class="row">

				<form role="form" action="/checklist/gravar-item" method="post">
					<input type="hidden" name="id_checklist"
						value="<?php echo $item->checklist->id?>">
					<input type="hidden" name="id"
						value="<?php echo $item->id ? $item->id : null ?>">
					<div class="form-group col-xs-12 m-sm">

						<div class="form-group col-xs-6">
							<div class="form-group">
								<label>Enunciado</label> <input type="text"
									value="<?php echo $item->enunciado ? $item->enunciado : null ?>"
									placeholder="Insira o enunciado" class="form-control" name="enunciado"
									required="required">
							</div>
						</div>

						<div class="form-group col-xs-6">
							<div class="form-group">
								<label>Tipo de Questão</label>
								
								<select name="tipo"
								class="select2_demo_2 form-control select2-hidden-accessible">
								<option value="">-- Selecione --</option>
								<?php
								    foreach (EnumTipoItem::TIPOS_QUESTOES as $key => $tipo) { ?>
										<option value="<?php echo $key ?>" <?php echo ($key == $item->tipo ? 'selected="selected"' : '')?>> <?php echo $key." - ".$tipo?> </option>
								<?php } ?>
	                    		</select>
							</div>
						</div>

						<div class="form-group col-xs-6">
							<div>
								<button class="btn btn-white" type="button"
									onclick="history.go(-1);">Voltar</button>
								<?php #if (!$view) {?>
								<button class="btn btn-primary" type="submit">Adicionar</button>
								<?php #}?>
							</div>
						</div>
						
						</form>
						
<?php 
    $alternativa = new Alternativa();
    $alternativa->item->__set($item, $item);

?>				
				
				
				
					<div class="form-group col-xs-6 m-sm">

						<div class="form-group col-xs-6">
							<div class="form-group">
								<label>Alternativa</label> <input type="text"
									value="<?php echo $alternativa->descricao ? $alternativa->descricao : null ?>"
									placeholder="Insira o enunciado" class="form-control" name="alternativa"
									required="required">
							</div>
						</div>

						<div class="form-group col-xs-6">
							<div>
								<?php #if (!$view) {?>
								<button class="btn btn-primary" type="submit">Adicionar</button>
								<?php #}?>
							</div>
						</div>
						
					</div>
				</div>

				
			</div>
		</div>