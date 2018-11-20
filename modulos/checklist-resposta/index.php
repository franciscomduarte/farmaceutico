<?php 

	define("NOME_MODULO", "Questionários"); 
	define("NOME_ACAO", "Responder"); 
	include_once 'breadcrumb.php';
	
	$checklist = new Checklist();
	$listaQuestionarios = $checklist->listar();

?>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
	                    <div class="ibox-content">
						<div class="ibox ">
                        <div class="ibox-title">
                            <h5>Questionários Disponíveis</h5>
                        </div>
                        <div class="ibox-content">

                            <p class="m-b-lg">
                                Escolha o questionário que deseja responder
                            </p>
							
							<?php 
							     foreach ($listaQuestionarios as $questionario) {
							         $item = new Item();
							         $itensChecklist = $item->listarPorIdCkelist($questionario->id);
						    ?>
                                <div class="dd" id="nestable2">
                                    <ol class="dd-list">
                                        <li class="dd-item" data-id="1">
                                            <div class="dd-handle">
                                            	<span class="pull-right"> <a href="#"><?php echo count($itensChecklist) . " questões" ?> </a></span>
                                                <span class="label label-info"><i class="fa fa-users"></i></span> <?php echo $questionario->nome ?>
                                            </div>
                                        </li>
                                    </ol>
                                </div>
                                
                                <?php foreach ($itensChecklist as $i) { ?>
                                	<div class="form-group">
                                		<label class="control-label"><?php echo $i->enunciado ?><br/><small class="text-navy">Custom elements</small></label>
                                	
                                	<?php if ($i->tipo == 'ME')  { ?>
                                    		<div class="i-checks"><label> <input type="checkbox" value=""> <i></i> Option one </label></div>
                                            <div class="i-checks"><label> <input type="checkbox" value=""> <i></i> Option two checked </label></div>
                                            <div class="i-checks"><label> <input type="checkbox" value=""> <i></i> Option three checked and disabled </label></div>
                                            <div class="i-checks"><label> <input type="checkbox" value=""> <i></i> Option four disabled </label></div>
                                	<?php } ?>
                                	
                                	<?php if ($i->tipo == 'TX')  { ?>
                                		<input type="text" value="" class="form-control">
                                	<?php } ?>
                                	
                                	<?php if ($i->tipo == 'VF')  { ?>
										<div class="i-checks"><label> <input type="radio" value="option1" name="a"> <i></i> SIM </label></div>
                                        <div class="i-checks"><label> <input type="radio" value="option2" name="a"> <i></i> NÃO </label></div>
                                	<?php } ?>
                                	
                                	<?php if ($i->tipo == 'MV')  { ?>
                                		<select multiple="multiple" class="form-control">
                                			<option>Opção 1</option>
                                			<option>Opção 2</option>
                                			<option>Opção 3</option>
                                		</select>
                                	<?php } ?>
                                	
                                	<div class="hr-line-dashed"></div>
                                <?php } ?>
                                
                            <?php } ?>
                            


	                    </div>
	                </div>
	            </div>
            </div>
        </div>
     </div>
  </div>
        
		<script>
    		function visualizar(id){
    			var pag = "/usuario/novo/"+id+"?view";
    			location.href = pag;
    		}
			
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

