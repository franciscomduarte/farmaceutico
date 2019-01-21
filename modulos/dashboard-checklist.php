<?php
$filtro_atual    = $_REQUEST['filtro'];

$filtro_cheklist = array("id_checklist" => $_REQUEST['id_checklist'],
                         "id_setor"     => $_REQUEST['id_setor']);

$setor = new Setor();
$setor = $setor->listarPorId($filtro_cheklist['id_setor']);

$dashboard = new Dashboard();
    
    ?>
        <div class="wrapper wrapper-content">
            <div class="container">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Checklists | <span style="color: #1ab394;">UNIDADE: <?php echo $setor->nome?></span></h5>
                                <span class="pull-right label label-info" style="padding: 10px; font-size: small;" onclick="location.href='/relatorio'">Novo filtro</span>
                                <!-- button type="button" class="btn-sl btn-info" onclick="location.href='/relatorio'">Filtro</button> -->
                                <div class="pull-right">
                                	 <div class="btn-group">
                                	 	<div class="col-lg-12">
                                	 	<select name="filtro" id="filtro_dashboard" class="form-control">
            								<?php
            								
            								foreach ( $dashboard->getDashboarFiltroPorChecklist($filtro_cheklist["id_checklist"],$filtro_cheklist["id_setor"]) as $filtro) {
            								    if (!isset($filtro_atual))
            								        $filtro_atual = $filtro['id_checklist']."|".$filtro['data_resposta'];
            								    
            								    $filtro_ativo = $filtro['id_checklist']."|".$filtro['data_resposta'] == $filtro_atual ? "selected" : "";
            								    
            									?>
            									<option value="<?php echo $filtro['id_checklist']."|".$filtro['data_resposta'] ?>" <?php echo $filtro_ativo?>> <?php echo $filtro['label']?> </option>
            								<?php
            								}
            								?>
            	                    		</select>
            	                   		</div>
                                    </div>
                                </div>
                                
                            </div>
<?php     
#Atualizando os dados do dashboard
$dashboard->getDashboarPorChecklist($filtro_atual); 
?>                            
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div>
                                   			 <canvas id="barChartChecklist" height="140"></canvas>
                                		</div>
                                    </div>
                                    <div class="col-md-3">
                                         	<div class="ibox">
                           					 	<span class="label label-warning pull-right">Qtd</span>
                            				 	<h5>Resumo</h5>
                       						 </div>
                                            <div>
                                                <div>
                                                    <span>Adesão Respostas</span>
                                                    <small class="pull-right"><?php echo $dashboard->grafico_barras_inicial["total_respondido"]."/".$dashboard->grafico_barras_inicial["total_previsto"]?> pacientes</small>
                                                </div>
                                                <div class="progress progress-small">
                                                    <div style="width: <?php echo $total_porcentagem = calculaPorcentagemTotal($dashboard->grafico_barras_inicial["total_previsto"], $dashboard->grafico_barras_inicial["total_respondido"])?>%;" class="progress-bar <?php echo $total_porcentagem <= 50 ? "progress-bar-danger" : "a"?>"></div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            
                            <div class="pull">
                                <h5>Legenda</h5>
                                 <div class="btn-group" style="padding-top: 5px;">
                                    <span class="pull-right label label-danger"> < 90%</span>
                                    <span class="pull-right label label-warning" style="background-color: #F6C600; color: black;"> < 99%</span>
                                    <span class="pull-right label label-primary"> 100%</span>
                                </div>
                            </div>
                        </div>
                   </div>
           		</div>
		 	</div>
            
             <?php 
                $questoes = explode(",", $dashboard->grafico_barras_inicial["labels"]);
                echo '<div class="row">';
                for ($i=0; $i < sizeof($questoes); $i++){ ?>
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?php echo str_replace('"', '', $questoes[$i])?></h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <div id="gauge_<?php echo $i?>"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    if ((($i+1) % 3)==0){
                        echo '</div><div class="row">';
                    }
                }
                ?>
            
            <?php echo '</div>'?>
            </div>

        </div>
        
<script>
$('#filtro_dashboard').change(function(){
    location.href="dashboard-checklist?filtro="+($(this).val())+"&id_checklist=<?php echo $filtro_cheklist['id_checklist']?>&id_setor=<?php echo $filtro_cheklist['id_setor']?>";
});

$(document).ready(function() {
	
  var barData = {
	        labels: [<?php echo $dashboard->grafico_barras_inicial["labels"]?>],
	        datasets: [
	            {
	            	label: "SIM",
	                backgroundColor: 'rgba(26,179,148,0.5)',
	                borderColor: "rgba(26,179,148,0.7)",
	                pointBackgroundColor: "rgba(26,179,148,1)",
	                pointBorderColor: "#fff",
	                data: [<?php echo $dashboard->grafico_barras_inicial["resposta_tipo_1"]?>]
	            },
// 	            {
// 	                label: "NÃO",
// 	                backgroundColor: 'rgba(248, 172, 89, 0.5)',
// 	                pointBorderColor: "#fff",
//	                data: [<?php echo $dashboard->grafico_barras_inicial["resposta_tipo_2"]?>]
// 	            }
	        ]
	    };

    var barOptions = {
        responsive: true,
        events: false,
        legend: false,
        animation: {
        	duration: 0,
        	onComplete: function () {
        	    // render the value of the chart above the bar
        	    var ctx = this.chart.ctx;
        	    ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, 'normal', Chart.defaults.global.defaultFontFamily);
        	    ctx.fillStyle = this.chart.config.options.defaultFontColor;
        	    ctx.textAlign = 'center';
        	    ctx.textBaseline = 'bottom';
        	    this.data.datasets.forEach(function (dataset) {
        	        for (var i = 0; i < dataset.data.length; i++) {
        	            var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model;
        	            ctx.fillText(dataset.data[i]+'%', model.x, model.y - 5);
        	        }
        	    });
        	}},
        scales: {
			yAxes: [{ticks: {min: 0, max: <?php echo $dashboard->grafico_barras_inicial["maior_valor"]?>}}]
		}
    };

    var ctx2 = document.getElementById("barChartChecklist").getContext("2d");
    new Chart(ctx2, {type: 'bar', data: barData, options:barOptions});

// Graficos Questões	
	<?php 
	$respostas_sim = explode(",",$dashboard->grafico_barras_inicial["resposta_tipo_1"]);
	#$respostas_nao = explode(",",$dashboard->grafico_barras_inicial["resposta_tipo_2"]);
	for ($i=0; $i < sizeof($questoes); $i++){ 
	?>
	
    var radar_<?php echo $i?> = c3.generate({
    	bindto: '#gauge_<?php echo $i?>',
        data: {
            columns: [['SIM','<?php echo $respostas_sim[$i]?>']],
            type: 'gauge'
        },
        gauge: {},
        color: {
            pattern: ['#FF0000', '#F6C600', '#1ab394'], // the three color levels for the percentage values.
            threshold: {
                values: [89, 99, 100]
            }
        },
        size: {
            height: 165
        }
    });

    setTimeout(function () {
    	radar_<?php echo $i?>.load({
            columns: [['META', "100"]]
        });
    }, 0);


	<?php } ?>
    
});
</script>

