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
            	<div class="col-sm-8 b-r">
                	<form role="form" action="/paciente/gravar" method="post">
                		<input type="hidden" name="id" value="<?php echo $obj->id ? $obj->id : null ?>">
                    	<div class="form-group"><label>Nome</label> <input type="text" value="<?php echo $obj->nome ? $obj->nome : null ?>" placeholder="Nome do paciente" class="form-control" name="nome"></div>
                        <div class="form-group"><label>CPF</label> <input data-mask="999.999.999-99" type="text" value="<?php echo $obj->cpf ? $obj->cpf : null ?>" placeholder="CPF do paciente" class="form-control" name="cpf"></div>
                        <div class="form-group"><label>Nascimento</label> <input type="date" value="<?php echo $obj->nascimento ? $obj->nascimento : null ?>" placeholder="Data de nascimento do paciente" class="form-control" name="nascimento"></div>
                       	
						<div class="form-group">
							<label>Gênero</label>
							
							<select name="genero" class="select2_demo_2 form-control select2-hidden-accessible">
							<option value="">-- Selecione --</option>
							<?php
							    foreach (EnumGenero::GENERO as $key => $genero) { ?>
									<option value="<?php echo $key ?>" <?php echo ($key == $obj->genero ? 'selected="selected"' : '')?>> <?php echo $key." - ".$genero?> </option>
							<?php } ?>
                    		</select>
						</div>
                       	<div class="form-group"><label>Registro de Internação</label> 
                       		<textarea value="<?php echo $obj->registro ? $obj->registro : null ?>" placeholder="Registro de internação" class="form-control" name="registro"></textarea>
                       	</div>
                  
                       	<div class="form-group">
						<label>Convênio</label> 
                       	<div class="form-check">
						<label class="form-check-label">
							<select class="form-control" name="id_convenio">
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