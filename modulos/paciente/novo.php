<?php 
$params = retornaParametrosUrl($_SERVER['QUERY_STRING']);
$id = $params[2];

$convenio = new Convenio();
$objConvenio = $convenio->listar();
$obj = null;
if($id) {
	$paciente = new Paciente();
	$obj = $paciente->listarPorId($id);
}

?>

<div class="col-lg-12">
	<div class="ibox float-e-margins">
    	<div class="ibox-title">
        	<h5>Cadastro de Paciente<small></small></h5>
        </div>
        <div class="ibox-content">
        	<div class="row">
            	<div class="col-sm-12">
                	<form role="form" action="/paciente/gravar" method="post">
                		<input type="hidden" name="id" value="<?php echo $obj->id ? $obj->id : null ?>">
                    	<div class="form-group"><label>Nome</label><span style="color: red;"> *</span> <input required="required" type="text" value="<?php echo $obj->nome ? $obj->nome : null ?>" placeholder="Nome do paciente" class="form-control" name="nome"></div>
                        <div class="form-group"><label>CPF</label><span style="color: red;"> *</span> <input required="required" data-mask="999.999.999-99" type="text" value="<?php echo $obj->cpf ? $obj->cpf : null ?>" placeholder="CPF do paciente" class="form-control" name="cpf"></div>
                       	
						<div class="form-group">
							<label>Gênero</label><span style="color: red;"> *</span>
							
							<select name="genero" required="required" class="select2_demo_2 form-control select2-hidden-accessible">
							<option value="">-- Selecione --</option>
							<option value="MASCULINO" <?php echo ("MASCULINO" == $obj->genero ? 'selected="selected"' : '')?>>Masculino</option>
							<option value="FEMININO" <?php echo ("FEMININO" == $obj->genero ? 'selected="selected"' : '')?>>Feminino</option>
							<option value="OUTRO" <?php echo ("OUTRO" == $obj->genero ? 'selected="selected"' : '')?>>Outro</option>
                    		</select>
						</div>
						
						<div class="form-group">
							<label for="db">Nascimento</label><span style="color: red;"> *</span>
							<div class="input-group">
								<input class="form-control" id="db" type="text" required="required"
									data-role="datebox"
									data-options='{"mode":"datebox","useInline":false,"useInlineAlign":"center", "useLang":"pt-br"}' 
									readonly="readonly"
									name="nascimento"
									value="<?php echo formatarData($obj->nascimento)  ?>">
							</div>
						</div>
						
                       	<div class="form-group"><label>Registro de Internação</label> <span style="color: red;"> *</span>
                       		<textarea required="required" placeholder="Registro de internação" class="form-control" name="registro"><?php echo $obj->registro ? $obj->registro : "" ?></textarea>
                       	</div>
                  
                       	<div class="form-group">
						<label>Convênio</label><span style="color: red;"> *</span> 
                       	<div class="form-check">
						<label class="form-check-label">
							<select class="form-control" name="id_convenio" required="required">
							<option value="">-- Selecione --</option>
							<?php foreach ($objConvenio as $c) { 
							?>
    							<option value="<?php echo $c->id?>" id="s<?php echo $c->id ?>" <?php echo $obj->convenio->id == $c->id ? 'selected' : ''?>>
    							<?php 
    							     echo $c->nome; 
    							?>
    							</option>
							<?php
							} 
							?>	
							
							</select>						
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