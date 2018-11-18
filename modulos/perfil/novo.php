<?php 

$params = retornaParametrosUrl($_GET['r']);
$id = $params[2];

$obj = null;
if($id) {
	$perfil = new Perfil();
	$obj = $perfil->listarPorId($id);
	$permissoes = new PermissaoPerfil();
	$objPermissoes = $permissoes->listarPorPerfil($obj['id']);
}

?>

<div class="col-lg-12">
	<div class="ibox float-e-margins">
    	<div class="ibox-title">
        	<h5>Cadastro de Perfil - <small>Perfil do usuários com suas permissões.</small></h5>
        </div>
        <div class="ibox-content">
        	<div class="row">
            	<div class="col-sm-8 b-r">
                	<form role="form" action="/perfil/gravar" method="post">
                		<input type="hidden" name="id" value="<?php echo $obj['id'] ? $obj['id'] : null ?>">
                    	<div class="form-group"><label>Descrição</label> <input type="text" value="<?php echo $obj['descricao'] ? $obj['descricao'] : null ?>" placeholder="Entre com a descricao" class="form-control" name="descricao"></div>
                        
						<?php 
							$permissoes = new PermissaoPerfil();
							$arrayPermissoes = $permissoes->listar();
						?>
						<div class="form-group">
						<label>Permissões</label> 
						<div class="form-check">
						<label class="form-check-label">
							<?php foreach ($arrayPermissoes as $permissao) { 
								$checked = NULL;
								if (in_array($permissao, $objPermissoes)){
									$checked = "checked";
								}
							?>
							<input class="form-check-input" name="check_<?php echo $permissao['id']?>" <?php echo $checked?> type="checkbox" value="<?php echo $permissao['id']?>" id="check_<?php echo $permissao['id'] ?>">
							<?php 
								echo $permissao['descricao']."<br/>"; 
							} ?>							
						</label>
						</div>
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