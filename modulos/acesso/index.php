<?php 

	define("NOME_MODULO", "Teste"); 
	define("NOME_ACAO", "Listar"); 
	include_once 'breadcrumb.php';

?>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
	                <div class="ibox float-e-margins">
	                    <div class="ibox-title col-lg-8">
	                        <h5>Lista de Gerentes</h5>
	                    </div>
	                   <div class="ibox-title-right col-lg-4">
	                        <button type="button" class="btn btn-info" onclick="location.href='/teste/novo/'">Novo Gerente</button>
	                    </div>
	                    <div class="ibox-content">
	                        <div class="table-responsive">
	                    		<table class="table table-striped table-bordered table-hover dataTables-example" >
	                    			<thead>
					                    <tr>
					                        <th>ID</th>
					                        <th>Gerente</th>
					                        <th>Matricula</th>
					                        <th>Ações</th>
					                    </tr>
	                    			</thead>
	                   			 	<tbody>

										<tr>
											<td>1</td>
											<td>Francisco Carlos Molina</td>
											<td>123456</td>
											<td>
												<a href="acesso/detalhe">
													<span class="fa fa-search" title="Editar"></span>
												</a>
											</td>
										</tr>
										
										<tr>
											<td>2</td>
											<td>Flaviano Oliveira Silva</td>
											<td>123456</td>
											<td>
												<a href="acesso/detalhe">
													<span class="fa fa-search" title="Editar"></span>
												</a>
											</td>
										</tr>
										
										<tr>
											<td>3</td>
											<td>Eric Dias</td>
											<td>123456</td>
											<td>
												<a href="acesso/detalhe">
													<span class="fa fa-search" title="Editar"></span>
												</a>
											</td>
										</tr>
					
	                    			</tbody>
	                    			<tfoot>
					                    <tr>
					                        <th>ID</th>
					                        <th>Gerente</th>
					                        <th>Matricula</th>
					                        <th>Ações</th>
					                    </tr>
	                    			</tfoot>
	                    		</table>
	                        </div>
	                    </div>
	                </div>
	            </div>
            </div>
        </div>
        
		<script>

			function editar(id){
				var pag = "/teste/novo/"+id;
				location.href = pag;
			}
		
			function excluir(id){
				var pag = "/teste/excluir/"+id;
				if (confirm("Tem certeza que deseja excluir este teste?")){
					location.href = pag;
				}
			}
		</script>

