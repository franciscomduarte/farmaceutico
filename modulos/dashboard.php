<?php 
    $dashboard = new Dashboard();
    
?>       
       

       
        <div class="wrapper wrapper-content">
            <div class="container">
            <div class="row">
            
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Bar Chart Example</h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="barChart" height="140"></canvas>
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


                <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Monthly income</h5>
                            <div class="ibox-tools">
                                <span class="label label-primary">Updated 12.2015</span>
                            </div>
                        </div>
                        <div class="ibox-content no-padding">
                            <div class="flot-chart m-t-lg" style="height: 55px;">
                                <div class="flot-chart-content" id="flot-chart1"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <div>
                                        <span class="pull-right text-right">
                                        <small>Average value of sales in the past month in: <strong>United states</strong></small>
                                            <br/>
                                            All sales: 162,862
                                        </span>
                                    <h3 class="font-bold no-margins">
                                        Half-year revenue margin
                                    </h3>
                                    <small>Sales marketing.</small>
                                </div>

                                <div class="m-t-sm">

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div>
                                            <canvas id="lineChart" height="114"></canvas>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="stat-list m-t-lg">
                                                <li>
                                                    <h2 class="no-margins">2,346</h2>
                                                    <small>Total orders in period</small>
                                                    <div class="progress progress-mini">
                                                        <div class="progress-bar" style="width: 48%;"></div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <h2 class="no-margins ">4,422</h2>
                                                    <small>Orders in last month</small>
                                                    <div class="progress progress-mini">
                                                        <div class="progress-bar" style="width: 60%;"></div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                                <div class="m-t-md">
                                    <small class="pull-right">
                                        <i class="fa fa-clock-o"> </i>
                                        Update on 16.07.2015
                                    </small>
                                    <small>
                                        <strong>Analysis of sales:</strong> The value has been changed over time, and last month reached a level over $50,000.
                                    </small>
                                </div>

                            </div>
                        </div>
                    </div>
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

                </div>

            </div>

        </div>