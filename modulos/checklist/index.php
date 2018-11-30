<?php 

	define("NOME_MODULO", "Checklist"); 
	define("NOME_ACAO", "Listar"); 
	include_once 'breadcrumb.php';
	
	$_SESSION['item']      = NULL;
	$_SESSION['checklist'] = NULL;

?>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
	                <div class="ibox float-e-margins">
	                    <div class="ibox-title col-lg-8">
	                        <h5>Lista de Usuários</h5>
	                    </div>
	                   <div class="ibox-title-right col-lg-4">
	                        <button type="button" class="btn btn-info" disabled="disabled" onclick="location.href='/checklist/novo/'">Novo</button>
	                    </div>
	                    <div class="ibox-content">
	                        <div class="table-responsive">
	                    		<table class="table table-striped table-bordered table-hover dataTables-example" >
	                    			<thead>
					                    <tr>
					                        <th>ID</th>
											<th>Nome</th>
											<th width="12%">Data Cadastro</th>
					                        <th width="15%">Usuário Responsável</th>
					                        <th width="5%">Meta</th>
					                        <th width="5%">Status</th>
					                        <th width="12%">Ações</th>
					                    </tr>
	                    			</thead>
	                   			 	<tbody>
    									<?php 
    										$checklist = new Checklist();
    										foreach ($checklist->listar() as $obj) {    										    
    							        ?>
        									<tr>
        										<td width='25px'><?php echo $obj->id ?></td>
        										<td><?php echo $obj->nome?></td>
        										<td><?php echo formatarDataHora($obj->data_cadastro)?></td>
        										<td><?php echo $obj->usuario->nome?></td>
        										<td align="center"><span class="pie" title="<?php echo "  ".$obj->meta."%" ?>"><?php echo $obj->meta."/100" ?></span></td>
        										<td class="project-status" align="center"><?php mostrarAtivoInativo($obj->ativo)?></td>
        										<td align="center">
        										    <button onclick="visualizar(<?php echo $obj->id?>)">
        												<span class="glyphicon glyphicon-eye-open" title="Visualizar"></span>
        											</button>
        											<button onclick="editar(<?php echo $obj->id?>)">
        												<span class="glyphicon glyphicon-edit" title="Editar"></span>
        											</button>
         											<button onclick="addItens(<?php echo $obj->id?>)">
        												<span class="glyphicon glyphicon-list" title="Adcionar Itens"></span>
        											</button>
        											<button onclick="excluir(<?php echo $obj->id?>)">
        												<span class="glyphicon glyphicon-trash remove" title="Excluir"></span>
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
											<th>Data Cadastro</th>
					                        <th>Usuário Responsável</th>
					                        <th>Meta</th>
					                        <th>Status</th>
					                        <th align="center">Ações</th>
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
    		function visualizar(id){
    			var pag = "/checklist/novo/"+id+"?view";
    			location.href = pag;
    		}
    		
    		function addItens(id){
    			var pag = "/checklist/add-item/"+id+"?add";
    			location.href = pag;
    		}			

			function editar(id){
				var pag = "/checklist/novo/"+id;
				location.href = pag;
			}
		
			function excluir(id){
				var pag = "/checklist/excluir/"+id;
				if (confirm("Tem certeza que deseja excluir este usuário?")){
					location.href = pag;
				}
			}
		</script>

