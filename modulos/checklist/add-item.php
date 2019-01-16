<?php 
$params = retornaParametrosUrl($_SERVER['QUERY_STRING']);
$id = $params[2];#id do checkout

if ($id) {
    $checklist = new Checklist();
    $obj = $checklist->listarPorId($id);
    $_SESSION['checklist'] = serialize($obj);
}else{
   echo "<script>alert('É necessário escolher um Checklist');history.go(-1);</script>";
}

if (isset($_SESSION['item'])){
    $item = unserialize($_SESSION['item']);
}else{  
    $item = new Item();
    $item->checklist = $obj; 
}

?>
		<div class="ibox-title">
			<h5>
				Cadastro de Itens | <strong style="color: #1ab394;"><?php echo strtoupper($item->checklist->nome." #".$item->checklist->id) ?></strong>
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
								
								<select name="tipo" class="form-control">
								<option value="">-- Selecione --</option>
								<?php
								    foreach (EnumTipoItem::TIPOS_QUESTOES as $key => $tipo) { ?>
										<option value="<?php echo $key ?>" <?php echo ($key == $item->tipo ? 'selected="selected"' : '')?>> <?php echo $key." - ".$tipo?> </option>
								<?php } ?>
	                    		</select>
							</div>
						</div>
					    <div class="form-group col-xs-6">
    					    <div class="form-group">
    							<button class="btn btn-xs btn-primary" type="submit" <?php disableInput(isset($_SESSION['item']))?>>Adicionar</button>
							</div>	
						</div>
					  </div>	
				</form>
			</div>
						
<?php 
    #$alternativa = new Alternativa();
    #$alternativa->item->__set($item, $item);
    
    
?>				
				

		</div>