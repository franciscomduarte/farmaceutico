<?php 

	define("NOME_MODULO", "Paciente"); 
	define("NOME_ACAO", "Listar"); 
	include_once 'breadcrumb.php';

?>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
	                <div class="ibox float-e-margins">
	                    <div class="ibox-title col-lg-8">
	                        <h5>Lista de Pacientes</h5>
	                    </div>
	                   <div class="ibox-title-right col-lg-4">
	                        <button type="button" class="btn btn-info" onclick="location.href='/paciente/novo/'">Novo</button>
	                    </div>
	                    <div class="ibox-content">
	                        <div class="table-responsive">
	                    		<table class="table table-striped table-bordered table-hover dataTables-example" >
	                    			<thead>
					                    <tr>
					                        <th>ID</th>
					                        <th>Nome</th>
					                        <th>CPF</th>
					                        <th>Nascimento</th>
					                        <th>Convênio</th>
					                        <th>Ações</th>
					                    </tr>
	                    			</thead>
	                   			 	<tbody>
										<?php 
											
										    $paciente = new Paciente();
										    $convenio = new Convenio();
										    $array = $paciente->listar();
											
											foreach ($array as $linha) {
											    $covenioPaciente = $convenio->listarPorId($linha['id_convenio']);
								        ?>
										<tr>
											<td><?php echo $linha['id']?></td>
											<td><?php echo $linha['nome']?></td>
											<td><?php echo $linha['cpf']?></td>
											<td><?php echo formatarData($linha['nascimento'])?></td>
											<td><?php echo $covenioPaciente['nome'] ?></td>
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
					                        <th>CPF</th>
					                        <th>Nascimento</th>
					                        <th>Convênio</th>
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
				var pag = "/paciente/novo/"+id;
				location.href = pag;
			}
		
			function excluir(id){
				var pag = "/paciente/excluir/"+id;
				if (confirm("Tem certeza que deseja excluir este paciente?")){
					location.href = pag;
				}
			}
		</script>

