<?php 
	define("NOME_MODULO", "Perfil"); 
	define("NOME_ACAO", "Listar"); 
	include_once 'breadcrumb.php';
?>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
	                <div class="ibox float-e-margins">
	                    <div class="ibox-title col-lg-8">
	                        <h5>Lista de Perfil</h5>
	                    </div>
	                   <div class="ibox-title-right col-lg-4">
	                        <button type="button" class="btn btn-info" onclick="location.href='/perfil/novo/'">Novo</button>
	                    </div>
	                    <div class="ibox-content">
	                        <div class="table-responsive">
	                    		<table class="table table-striped table-bordered table-hover dataTables-example" >
	                    			<thead>
					                    <tr>
					                        <th>ID</th>
					                        <th>Descrição</th>
					                        <th>Permissões</th>
					                        <th></th>
					                    </tr>
	                    			</thead>
	                   			 	<tbody>
										<?php 
											
											$perfil = new Perfil();
											$array = $perfil->listar();
											
											foreach ($array as $linha) {
												$permissoes = new PermissaoPerfil();
												$arrayPermissoes = $permissoes->listarPorPerfil($linha['id']);
								        ?>
										<tr>
											<td><?php echo $linha['id'] ?></td>
											<td><?php echo $linha['descricao'] ?></td>
											<td>
											<?php 
												foreach ($arrayPermissoes as $permissao){
													echo "+ ".$permissao['descricao']."<br>";
												}
											?>
											</td>
											<td class="table-column-center">
												<button onclick="editar(<?php echo $linha['id']?>)">
													<span class="glyphicon glyphicon-edit" title="Editar Permissões"></span>
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
					                        <th>Descrição</th>
					                        <th>Permissões</th>
					                        <th></th>
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
				var pag = "/perfil/novo/"+id;
				location.href = pag;
			}
		
		</script>

