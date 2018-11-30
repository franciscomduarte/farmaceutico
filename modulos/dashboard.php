<?php 
    $dashboard = new Dashboard();
    $dashboard->getDashboardRespostasCheckListPorDia();
    $setor_atual = $_REQUEST['setor'];
?>       
       
      
        <div class="wrapper wrapper-content">
            <div class="container">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Checklists</h5>
                                <div class="pull-right">
                                	 <div class="btn-group">
                                	 		<button type="button" onclick="location.href='/'" class="btn btn-xs btn-white <?php echo !isset($setor_atual) ? "active" : ""?>">Todos</button>
                                        <?php 
                                            $setor = new Setor();
                                            foreach ($setor->listar() as $setor) {
                                                $setor_ativo = $setor->id == $setor_atual ? "active" : "";
                                         ?>   
                                            <button type="button" onclick="location.href='/?setor=<?php echo $setor->id?>'" class="btn btn-xs btn-white <?php echo $setor_ativo?>"><?php echo $setor->nome?></button>    
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                <div class="col-lg-9">
                                    <div>
                               			 <canvas id="barChartChecklist" height="100"></canvas>
                            		</div>
                                </div>
                                <div class="col-lg-3">
                                    <ul class="stat-list">
                                        <li>
                                            <h2 class="no-margins"><?php  printf("%02d",$dashboard->total["resposta_checklist"]) ?></h2>
                                            <small>Total de respostas no período</small>
                                            <div class="stat-percent"><?php echo $dashboard->grafico_barras_inicial["porcetagem_resposta"];?>%</i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: <?php echo $dashboard->grafico_barras_inicial["porcetagem_resposta"];?>%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="ibox float-e-margins">
                                                <div id="gauge"></div>
                                            </div>
                                        </li>
                                        </ul>
                                    </div>
                                </div>
                                </div>

                            </div>
                        </div>
                    </div>
            <div class="row">
            
			 <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-warning pull-right">Qtd</span>
                            <h5>Dados do Sistema</h5>
                        </div>
                        
                        <div class="ibox-content">
                        		<div class="row">

	    					       	<div class="col-xs-4">
	                                    <h4><a href="#">Pacientes: </a></h4>
	                                     <small class="stats-label"><?php printf("%02d",$dashboard->total["paciente"])?></small>
	                                </div>
	    
	                                <div class="col-xs-4">
	                                    <small class="stats-label">Cadastrados</small>
	                                    <h4><a href="#"><?php printf("%02d",$dashboard->total["paciente"])?></a></h4>
	                                </div>
	                                <div class="col-xs-4">
	                                    <small class="stats-label">Internados</small>
	                                    <h4><a href="#"><?php printf("%02d",$dashboard->total["internacao"])?></a></h4>
	                                </div>

									<?php $dashboard->getDashboardInternados();?>
									
	    					       	<div class="col-xs-4">
	                                    <h4><a href="#">Internações: </a></h4>
	                                    <small class="stats-label"><?php printf("%02d",$dashboard->total_internados["total"])?></small>
	                                </div>
	    
	                                <div class="col-xs-4">
	                                    <small class="stats-label">Internados</small>
	                                    <h4><a href="#"><?php printf("%02d",$dashboard->total_internados["internado"])?></a></h4>
	                                </div>
	                                <div class="col-xs-4">
	                                    <small class="stats-label">Dispensados</small>
	                                    <h4><a href="#"><?php printf("%02d",$dashboard->total_internados["dispensado"])?></a></h4>
	                                </div>
    							</div>
                        </div>
                        
                    </div>
                </div>
                
                                <div class="col-md-2">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">Total</span>
                            <h5>Cheklists</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><a href="/checklist"><?php printf("%02d",$dashboard->total["checklist"]) ?></a><small> Cadastrado(s) </small></h1>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">Total</span>
                            <h5>Pacientes</h5>
                        </div>
                        <div class="ibox-content">
                        	<h1 class="no-margins"><a href="/paciente"><?php printf("%02d",$dashboard->total["paciente"]) ?></a><small> Cadastrado(s)</small></h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">Total</span>
                            <h5>Internações</h5>
                        </div>
                        <div class="ibox-content">
                        	<h1 class="no-margins"><a href="/internacao"><?php printf("%02d",$dashboard->total["internacao"]) ?></a><small> Cadastrado(s)</small></h1>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">Total</span>
                            <h5>Respostas</h5>
                        </div>
                        <div class="ibox-content">
                        	<h1 class="no-margins"><a href="#"><?php  printf("%02d",$dashboard->total["resposta_checklist"]) ?></a><small> Cadastrado(s)</small></h1>
                        </div>
                    </div>
                </div>
            </div>

            </div>

        </div>
        
<script>
$(document).ready(function() {
	
	var barData = {
        labels: [<?php echo $dashboard->grafico_barras_inicial["dias"];?>],
        datasets: [
            {
                label: "Previstos",
                backgroundColor: 'rgba(220, 220, 220, 0.5)',
                pointBorderColor: "#fff",
                data: [<?php echo $dashboard->grafico_barras_inicial["previstos"];?>]
            },
            {
                label: "Respondidos",
                backgroundColor: 'rgba(26,179,148,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [<?php echo $dashboard->grafico_barras_inicial["respondidos"];?>]
            }
        ]
    };

    var barOptions = {
        responsive: true
    };

    var ctx2 = document.getElementById("barChartChecklist").getContext("2d");
    new Chart(ctx2, {type: 'bar', data: barData, options:barOptions});

    var radar = c3.generate({
    	bindto: '#gauge',
        data: {
            columns: [
                ['respostas', <?php echo $dashboard->grafico_barras_inicial["porcetagem_resposta"];?>]
            ],
            type: 'gauge'
        },
        gauge: {
//            label: {
//                format: function(value, ratio) {
//                    return value;
//                },
//                show: false // to turn off the min/max labels.
//            },
//        min: 0, // 0 is default, //can handle negative min e.g. vacuum / voltage / current flow / rate of change
//        max: 100, // 100 is default
//        units: ' %',
//        width: 39 // for adjusting arc thickness
        },
        color: {
            pattern: ['#FF0000', '#f4ae70', '#F6C600', '#8CD9C9'], // the three color levels for the percentage values.
            threshold: {
//                unit: 'value', // percentage is default
//                max: 200, // 100 is default
                values: [30, 60, 90, 100]
            }
        },
        size: {
            height: 180
        }
    });

    setTimeout(function () {
    	radar.load({
            columns: [['meta', <?php echo $dashboard->grafico_barras_inicial["meta_calculada"];?>]]
        });
    }, 2000);
});
</script>