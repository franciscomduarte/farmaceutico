<?php 

$params = retornaParametrosUrl($_GET['r']);
$id = $params[2];

$obj = null;
if($id) {
	$convenio = new Convenio();
	$obj = $convenio->listarPorId($id);
}

?>

<div class="col-lg-12">
	<div class="ibox float-e-margins">
    	<div class="ibox-title">
        	<h5>Cadastro de Convenios - <small></small></h5>
        </div>
        <div class="ibox-content">
        	<div class="row">
            	<div class="col-sm-8 b-r">
                	<form role="form" action="/convenio/gravar" method="post">
                		<input type="hidden" name="id" value="<?php echo $obj['id'] ? $obj['id'] : null ?>">
                    	<div class="form-group"><label>Nome</label> <input type="text" value="<?php echo $obj['nome'] ? $obj['nome'] : null ?>" placeholder="Nome do Convênio" class="form-control" name="nome"></div>
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