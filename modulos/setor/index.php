<?php 

	define("NOME_MODULO", "Setor"); 
	define("NOME_ACAO", "Listar"); 
	include_once 'breadcrumb.php';

?>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
	                <div class="ibox float-e-margins">
	                    <div class="ibox-title col-lg-8">
	                        <h5>Lista de Setores</h5>
	                    </div>
	                   <div class="ibox-title-right col-lg-4">
	                        <button type="button" class="btn btn-info" onclick="location.href='/setor/novo/'">Novo</button>
	                    </div>
	                    <div class="ibox-content">
	                        <div class="table-responsive">
	                    		<table class="table table-striped table-bordered table-hover dataTables-example" >
	                    			<thead>
					                    <tr>
					                        <th>ID</th>
					                        <th>Nome</th>
					                        <th>Ações</th>
					                    </tr>
	                    			</thead>
	                   			 	<tbody>
										<?php 
											
										    $setor = new Setor();
										    $array = $setor->listar();
											
											foreach ($array as $linha) {
								        ?>
										<tr>
											<td><?php echo $linha['id']?></td>
											<td><?php echo $linha['nome']?></td>
											<td>
												<button onclick="editar(<?php echo $linha['id']?>)">
													<span class="glyphicon glyphicon-edit" title="Editar"></span>
												</button>
												<button onclick="excluir(<?php echo $linha['id']?>)">
													<span class="glyphicon glyphicon-trash" title="Excluir"></span>
												</button>
												
											</td>
										</tr>
					
										<?php 
								          	}
								        ?>
	                    			</tbody>
	                    			<tfoot>
					                    <tr>
					                        <th>ID</th>
					                        <th>Nome</th>
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
				var pag = "/setor/novo/"+id;
				location.href = pag;
			}
		
			function excluir(id){
				var pag = "/setor/excluir/"+id;
				if (confirm("Tem certeza que deseja excluir este setor?")){
					location.href = pag;
				}
			}
		</script>

