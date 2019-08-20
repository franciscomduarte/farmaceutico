<?php 

$params = retornaParametrosUrl($_SERVER['QUERY_STRING']);
$id = $params[2];

$obj = null;
if($id) {
	$funcionario = new Funcionario();
	$obj = $funcionario->listarPorId($id);
}

?>

<div class="col-lg-12">
	<div class="ibox float-e-margins">
    	<div class="ibox-title">
        	<h5>Cadastro de Gerentes</h5>
        </div>
        <div class="ibox-content">
        	<div class="row">
            	<div class="col-sm-12">
                	<form role="form" action="/funcionario/gravar" method="post">
                		<input type="hidden" name="id" value="<?php echo $obj->id ? $obj->id : null ?>">
                    	<div class="form-group col-sm-6" >
                    		<label>Tipo de Gerente:</label> 
                    		<select class="form-control">
                    			<option>GERENTE DE ACESSO</option>
                    			<option>GERENTE DE CONTAS</option>
                    		</select>
                    	</div>
                    	
                    	<div class="form-group col-sm-6">
                    		<label>Nome</label> 
                    		<input type="text" class="form-control">
                    	</div>
                    	
                    	<div class="form-group col-sm-6">
                    		<label>Matrícula</label> 
                    		<input type="text" class="form-control">
                    	</div>
                    	
                    	<div class="form-group col-sm-6">
                    		<label>Setor de Atuação</label> 
                    		<select multiple="multiple" class="form-control">
                    			<option>NORTE</option>
                    			<option>NORDESTE</option>
                    			<option>SUL</option>
                    			<option>SUDESTE</option>
                    			<option>CENTRO-OESTE</option>
                    			<option>SÃO PAULO - CENTRO</option>
                    			<option>SÃO PAULO - INTERIOR</option>
                    		</select>
                    		
                    	</div>
                    	
                        <div class="col-sm-12">	
                            <div class="col-sm-4">
                            	<label>OPS</label>
                            </div> 
                            <div class="ibox-tools col-sm-8">
                            	<a href="" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal1">Adicionar</a>
                            </div>
                        </div>
                        <div class="ibox">
                            <div class="ibox-content">
    
                                <div class="project-list">
    
                                    <table class="table table-hover">
                                    	<thead>
           					                <tr>
    					                        <th>NOME</th>
    					                        <th>CIDADE/UF</th>
    					                        <th>CATEGORIA</th>
    					                        <th>NÚMERO DE VIDAS</th>
    					                        <th>CONTATO</th>
    					                        <th>PRODUTOS</th>
    					                        <th>AÇÕES</th>
    					                    </tr>
                                    	</thead>
                                        <tbody>
                                        <tr>
                                            <td class="project-title">
                                                <a href="project_detail.html">Amil</a>
                                                <br/>
                                                <small>Cadastrado em 14.08.2014</small>
                                            </td>
                                            <td>
                                                    <small>CAMPINAS - SP</small>
                                            </td>
                                            <td>
                                                MED GRUPO
                                            </td>
                                            <td>
    											100.000
                                            </td>
                                            <td>
    											Francisco Molina / Médico
                                            </td>
                                            <td>
    											<ul>
    												<li>
    													Projeto 1
    												</li>
    												<li>
    													Projeto 2
    												</li>
    											</ul>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
                    
                       	<div class="col-sm-12">	
                            <div class="col-sm-4">
                            	<label>SUS</label>
                            </div> 
                            <div class="ibox-tools col-sm-8">
                            	<a href="" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Adicionar</a>
                            </div>
                        </div>
                        <div class="ibox">
                            <div class="ibox-content">
    
                                <div class="project-list">
    
                                    <table class="table table-hover">
                                    	<thead>
           					                <tr>
    					                        <th>NOME</th>
    					                        <th>CIDADE/UF</th>
    					                        <th>CONTATO</th>
    					                        <th>PRODUTOS</th>
    					                        <th>AÇÕES</th>
    					                    </tr>
                                    	</thead>
                                        <tbody>
                                        <tr>
                                            <td class="project-title">
                                                <a href="project_detail.html">Amil</a>
                                                <br/>
                                                <small>Cadastrado em 14.08.2014</small>
                                            </td>
                                            <td>
                                                    <small>CAMPINAS - SP</small>
                                            </td>
                                            <td>
    											Francisco Molina / Médico
                                            </td>
                                            <td>
    											<ul>
    												<li>
    													Projeto 1
    												</li>
    												<li>
    													Projeto 2
    												</li>
    											</ul>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>	
                    	
                        
						<div>
                        	<button class="btn btn-white" type="button" onclick="history.go(-1);">Cancelar</button>
                            <button class="btn btn-primary" type="submit">Salvar</button>
                        </div>
                        
                        
                        <div class="modal inmodal" id="myModal1" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content animated bounceInRight">
                                    <div class="modal-body">
                                    	<div class="form-group"><label>Nome</label> <input type="text" class="form-control"></div>
                                    	<div class="form-group">
                                    		<label>Cidade</label> 
                                    		<input type="text" class="form-control">
                                    	</div>
                                    	<div class="form-group"><label>Categoria</label> <input type="text" class="form-control"></div>
                                    	<div class="form-group"><label>Número de Vidas</label> <input type="number" class="form-control"></div>
                                    	<div class="form-group"><label>Contato</label> <input type="text" class="form-control"></div>
                                    	<div class="form-group"><label>Cargo</label> <input type="text" class="form-control"></div>
                                    	
                                    	
                                    	
                                    	<div class="col-sm-12">	
                                            <div class="col-sm-4">
                                            	<label>PRODUTOS</label>
                                            </div> 
                                            <div class="ibox-tools col-sm-8">
                                            	<a href="" class="btn btn-primary btn-xs">Adicionar</a>
                                            </div>
                                        </div>
                                        <div class="ibox">
                                            <div class="ibox-content">
                    
                                                <div class="project-list">
                    
                                                    <table class="table table-hover">
                                                    	<thead>
                           					                <tr>
                    					                        <th>PRODUTO</th>
                    					                        <th>SITUAÇÃO</th>
                    					                        <th>AÇÕES</th>
                    					                    </tr>
                                                    	</thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>
                                                                <small>Teste</small>
                                                            </td>
                                                            <td>
                    											Incorporado
                                                            </td>
                                                            <td>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>	
                                    	
                                    	
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Fechar</button>
                                        <button type="button" class="btn btn-primary">Adicionar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content animated bounceInRight">
                                    <div class="modal-body">
                                    	<div class="form-group"><label>Nome</label> <input type="text" class="form-control"></div>
                                    	<div class="form-group">
                                    		<label>Cidade</label> 
                                    		<input type="text" class="form-control">
                                    	</div>
                                    	<div class="form-group"><label>Contato</label> <input type="text" class="form-control"></div>
                                    	<div class="form-group"><label>Cargo</label> <input type="text" class="form-control"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Fechar</button>
                                        <button type="button" class="btn btn-primary">Adicionar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
					</form>
               	</div>
           	</div>
       	</div>
    </div>
</div>