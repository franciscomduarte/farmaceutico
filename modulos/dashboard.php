<?php 

	$curso_selecionado = isset($_REQUEST['curso']) ? $_REQUEST['curso'] : 0;

	$dashboard = new Dashboard();
	$quantidadeInscritosPorCurso = $dashboard->quantidadeInscritosPorCurso($curso_selecionado);
	$quantidadeInscritosPorStatus = $dashboard->quantidadeInscritosPorStatus($curso_selecionado);
	$numeroInscritos = $dashboard->numeroInscritos($curso_selecionado);
	$numeroEgressos = $dashboard->numeroEgressos($curso_selecionado);
	$porcentagemConcluintes = ceil(($numeroEgressos/$numeroInscritos)*100);
	$inscricoesDia = $dashboard->inscricoesPorDia($curso_selecionado);
	$ofertasDisponiveis = $dashboard->countOfertasDisponiveis($curso_selecionado);
	$inscricoesMesStatus = $dashboard->inscricoesPorMesStatus($curso_selecionado);
	$cursos = $dashboard->consultaCursos();
?> 
 
       	<a href="<?php echo URL_SISTEMA?>/alunos">Consulta Aluno</a>&nbsp; |
       	<a href="<?php echo URL_SISTEMA?>/relatorios">Extrações</a> |
       	<a href="<?php echo URL_SISTEMA?>/certificacao">Certificação Ouvidoria</a> |
        <div class="wrapper wrapper-content">
            <div class="container">
            <h3>SELECIONE O CURSO</h3>
            
            <input class="form-control" type="text" name="curso" list="cursos" placeholder="Digite o curso.." id="curso" onchange="reload()">
            <datalist id="cursos">
				<?php  
				while ($row = pg_fetch_assoc($cursos)) { 
		        ?>
		        	<option id="<?php echo $row['tx_nome_curso']?>"  data-value="<?php echo $row['id_curso']?>"  ><?php echo $row['tx_nome_curso']?></option>
				<?php 
            	}
			?>
			</datalist>
            
            <div class="row">
                <div class="col-md-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">Total</span>
                            <h5>Ofertas</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><a href="/pesquisa/resultado/<?php echo $curso_selecionado?>"> <?php echo $ofertasDisponiveis ?> </a><small> realizada(s) </small></h1>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">Total</span>
                            <h5>Inscrições</h5>
                        </div>
                        <div class="ibox-content">
                        	<h1 class="no-margins"><a href="/dashboard/inscritos/<?php echo $curso_selecionado?>"><?php echo $numeroInscritos ?></a><small> Inscritos(s)</small></h1>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">Total</span>
                            <h5>Egressos</h5>
                        </div>
                        <div class="ibox-content">
                        	<h1 class="no-margins"><a href="/dashboard/egressos/<?php echo $curso_selecionado?>"><?php echo $numeroEgressos ?></a><small> Egresso(s)</small></h1>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">Total</span>
                            <h5>Concluintes</h5>
                        </div>
                        <div class="ibox-content">
                        	<h1 class="no-margins"><a href="#"><?php echo $porcentagemConcluintes ?> %</a><small> das inscrições</small></h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">Total</span>
                            <h5>Inscrições/Dia</h5>
                        </div>
                        <div class="ibox-content">
                        	<?php while ($row = pg_fetch_assoc($inscricoesDia)) { ?>
                        		<h1 class="no-margins"><a href="/dashboard/inscritos_dia/<?php echo $curso_selecionado?>/<?php echo $row['dt_inscricao']?>"><?php echo $row['qtd']?></a><small> - <?php echo formatarData($row['dt_inscricao'])?></small></h1>
                        	<?php } ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">Total</span>
                            <h5>Inscrições/Mês - CONCLUINTES</h5>
                        </div>
                        <div class="ibox-content">
                        	<table class="table table-striped table-bordered table-hover">
	                        	<?php while ($row = pg_fetch_assoc($inscricoesMesStatus)) { ?>
	                        		<tr>
	                        			<td colspan="2"><b><?php echo retornaMesPorExtenso($row['mes'])?> - <?php echo $row['qtd']?></b></td>
	                        		</tr>
	                        	<?php } ?>
                        	</table>
                        </div>
                    </div>
                </div>
               </div>
                
			<div class="row">
                <div class="col-md-6">
		            <div class="ibox-content">
		            	<div class="table-responsive">
		            		<fieldset>Quantidade de Inscritos por Curso</fieldset>
		                	<table class="table table-striped table-bordered table-hover dataTables-example" >
	                            <thead>
	                            <tr>
	                                <th>Curso</th>
	                                <th>Quantidade</th>
	                            </tr>
	                            </thead>
	                            <tbody>
	                            <?php  
	                            while ($row = pg_fetch_assoc($quantidadeInscritosPorCurso)) { ?>
		                            <tr>
		                             	<td><?php echo $row['tx_nome_curso']?></td>
		                                <td><?php echo $row['qtd']?></td>
		                            </tr>
	                            <?php } ?>
	                            </tbody>
	                        </table>
	                    </div>
	            	</div>
				</div>
				
				<div class="col-md-6">
		            <div class="ibox-content">
		            	<div class="table-responsive">
		            		<fieldset>Status dos Inscritos</fieldset>
		                	<table class="table table-striped table-bordered table-hover dataTables-example" >
	                            <thead>
	                            <tr>
	                                <th>Status</th>
	                                <th>Quantidade</th>
	                            </tr>
	                            </thead>
	                            <tbody>
	                            <?php  
	                            while ($row = pg_fetch_assoc($quantidadeInscritosPorStatus)) { ?>
		                            <tr>
		                             	<td><?php echo $row['tp_situacao_inscricao']?></td>
		                                <td><?php echo $row['qtd']?></td>
		                            </tr>
	                            <?php } ?>
	                            </tbody>
	                        </table>
	                    </div>
	            	</div>
				</div>
            </div>

            </div>

        </div>
        
        <script type="text/javascript">
			function reload() {
				var curso_selecionado = document.getElementById('curso').value;
				var id_curso_selecionado = document.getElementById("cursos").options.namedItem(curso_selecionado).getAttribute('data-value');
				window.location = "<?php echo ENDERECO ?>?curso="+id_curso_selecionado;
			}
        
		</script>
