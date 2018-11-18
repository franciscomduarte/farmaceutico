<?php 

	define("NOME_MODULO", "Usuário"); 
	define("NOME_ACAO", "Listar"); 
	include_once 'breadcrumb.php';

?>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
	                <div class="ibox float-e-margins">
	                    <div class="ibox-title col-lg-8">
	                        <h5>Lista de Usuários</h5>
	                    </div>
	                   <div class="ibox-title-right col-lg-4">
	                        <button type="button" class="btn btn-info" onclick="location.href='/usuario/novo/'">Novo</button>
	                    </div>
	                    <div class="ibox-content">
	                        <div class="table-responsive">
	                    		<table class="table table-striped table-bordered table-hover dataTables-example" >
	                    			<thead>
					                    <tr>
					                        <th>Foto</th>
											<th>Nome</th>
					                        <th>CPF</th>
					                        <th>E-mail</th>
					                        <th>Lotação</th>
					                        <th>Telefone</th>
					                        <th>Status</th>
					                        <th><center>Ações</center></th>
					                    </tr>
	                    			</thead>
	                   			 	<tbody>
										<?php 
											
											$usuario = new Usuario();
											$array = $usuario->listar();
											
											foreach ($array as $linha) {
								        ?>
										<tr>
											<td width='25px'><img title="<?php echo $linha['id'] ?>" class="img-circle m-t-xs img-responsive" src="<?php echo $linha['foto'] != null ? $linha['foto'] : '/img/user.jpg' ?>"></td>
											<td><?php echo $linha['nome'] ?></td>
											<td><?php echo $linha['cpf'] ?></td>
											<td><?php echo $linha['email'] ?></td>
											<td><?php echo $linha['lotacao_id'] ?></td>
											<td><?php echo $linha['telefone'] ?></td>
											<td><?php echo $linha['ativo'] ? "Ativo" : "Inativo" ?></td>
											<td>
												<button onclick="editar(<?php echo $linha['id']?>)">
													<span class="glyphicon glyphicon-edit" title="Editar"></span>
												</button>
												<button onclick="excluir(<?php echo $linha['id']?>)">
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
											<th>Foto</th>
					                        <th>Nome</th>
					                        <th>CPF</th>
					                        <th>E-mail</th>
					                        <th>Lotação</th>
					                        <th>Telefone</th>
					                        <th>Status</th>
					                        <th><center>Ações</center></th>
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
				var pag = "/usuario/novo/"+id;
				location.href = pag;
			}
		
			function excluir(id){
				var pag = "/usuario/excluir/"+id;
				if (confirm("Tem certeza que deseja excluir este usuário?")){
					location.href = pag;
				}
			}
		</script>

