<?php 

	define("NOME_MODULO", "Gerentes"); 
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
	                        <button type="button" class="btn btn-info" onclick="location.href='/funcionario/novo/'">Novo Gerente</button>
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
										<?php 
											
											$funcionario = new Funcionario();
											$array = $funcionario->listar();
											
											foreach ($array as $linha) {
								        ?>
    										<tr>
    											<td><?php echo $linha->id ?></td>
    											<td><?php echo $linha->nome ?></td>
    											<td><?php echo $linha->matricula ?></td>
    											<td>
    												<a href="/acesso/detalhe/<?php echo $linha->id?>">
    													<span class="fa fa-search" title="Visualizar Acessos"></span>
    												</a>
    												
    												<a onclick="editar(<?php echo $linha->id?>)">
    													<span class="fa fa-edit" title="Editar Gerente"></span>
    												</a>
    												
    												<a onclick="excluir(<?php echo $linha->id?>)">
    													<span class="fa fa-trash" title="Excluir Gerente"></span>
    												</a>
    											</td>
    										</tr>
										<?php 
								          	}
								        ?>
	                    			</tbody>
	                    		</table>
	                        </div>
	                    </div>
	                </div>
	            </div>
            </div>
        </div>
        
		<script>
			function editar(id){
				var pag = "/funcionario/novo/"+id;
				location.href = pag;
			}
		
			function excluir(id){
				var pag = "/funcionario/excluir/"+id;
				if (confirm("Tem certeza que deseja excluir este funcionário?")){
					location.href = pag;
				}
			}
		</script>

		

