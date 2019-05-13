<div class="col-lg-12">
	<div class="ibox float-e-margins">
    	<div class="ibox-title">
        	<h5>Cadastro de Teste - <small>Teste são...</small></h5>
        </div>
        <div class="ibox-content">
        	<div class="row">
            	<div class="col-sm-8 b-r">
                	<form role="form" action="/teste/gravar" method="post">
                		<input type="hidden" name="id" value="<?php echo $obj['id'] ? $obj['id'] : null ?>">
                    	<div class="form-group"><label>Descrição</label> <input type="text" value="<?php echo $obj['descricao'] ? $obj['descricao'] : null ?>" placeholder="Enter descricao" class="form-control" name="descricao"></div>
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