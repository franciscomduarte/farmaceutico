<html>

	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	    <title><?php echo NOME_SISTEMA?></title>
	    
	    <link href="/css/bootstrap.min.css" rel="stylesheet">
	    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
	    <link href="/css/plugins/iCheck/custom.min.css" rel="stylesheet">
	    <link href="/css/plugins/dropzone/basic.min.css" rel="stylesheet">
    	<link href="/css/plugins/dropzone/dropzone.min.css" rel="stylesheet">
    	<link href="/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    	<link href="/css/plugins/codemirror/codemirror.min.css" rel="stylesheet">
	    <!-- Toastr style -->
	    <link href="/css/plugins/toastr/toastr.min.css" rel="stylesheet">
	    <!-- Gritter -->
	    <link href="/js/plugins/gritter/jquery.gritter.min.css" rel="stylesheet">
	    <link href="/css/animate.min.css" rel="stylesheet">
	    <link href="/css/style.min.css" rel="stylesheet">
	    <link href="/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.min.css" rel="stylesheet">
	    <link rel="stylesheet" type="text/css" href="/css/editor/editor.dataTables.min.css">
	    <link href="/css/plugins/datapicker/datepicker3.min.css" rel="stylesheet">
	    <link href="/css/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">
   	 	<link href="/css/plugins/sweetalert/sweetalert.min.css" rel="stylesheet">
   	 	<link href="/css/plugins/toastr/toastr.min.css" rel="stylesheet">
   	 	<link href="/css/plugins/steps/jquery.steps.min.css" rel="stylesheet">
   	 	<link href="/css/plugins/summernote/summernote.min.css" rel="stylesheet">
   		<link href="/css/plugins/summernote/summernote-bs3.min.css" rel="stylesheet">
   		<link href="/css/plugins/c3-0.6.9/c3.min.css" rel="stylesheet">
   		<link href="/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
   		
   		<link href="/css/plugins/select2/select2.min.css" rel="stylesheet">
   		
   		
   		<link rel="stylesheet" href="/css/datebox/jtsage-datebox-4.4.1.bootstrap.min.css">
    	<link rel="stylesheet" href="/css/datebox/syntax.min.css">
    	
    	
   		
	
	
	<script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/js/plugins/validate/jquery.validate.min.js" defer="defer"></script> 
<!--     <script src="/js/plugins/dataTables/datatables.min.js" async="async"></script> -->
    <script src="/js/md5/md5.min.js" defer="defer"></script>
    <script src="/js/plugins/sweetalert/sweetalert.min.js" defer="defer"></script>
    <script src="/js/plugins/toastr/toastr.min.js" defer="defer"></script>
    <!-- ChartJS-->
    <script src="/js/plugins/chartJs/Chart.min.js" defer="defer"></script>
    <script src="/js/plugins/steps/jquery.steps.min.js" defer="defer"></script>
    <script src="/js/plugins/summernote/summernote.min.js" defer="defer"></script>
    <script src="/js/plugins/colorpicker/bootstrap-colorpicker.min.js" defer="defer"></script>
    
    <!-- Steps -->
    <script src="/js/plugins/steps/jquery.steps.min.js" defer="defer"></script>

<!-- ChartJS-->
    <script src="/js/sistema.js"></script>
    
    <script src="/js/plugins/select2/select2.full.min.js" defer="defer"></script>
    

    <script src="/js/datebox/jtsage-datebox-4.4.1.bootstrap.min.js" defer="defer"></script>
	<script src="/js/datebox/initial.min.js" defer="defer"></script>
	</head>
	<script type="text/javascript">

	$(document).ready(function() {

        $('.summernote').summernote();

        $('.colorpicker').colorpicker();

        $(".select2_demo_2_checklist").select2();
        
        $("#wizard").steps();

        $(".datepicker").datepicker( {
      	  format: "mm-yyyy",
      	  viewMode: "months",
      	  minViewMode: "months"
       });

        $('.dual_select').bootstrapDualListbox({
            selectorMinimalHeight: 160
        });

    	$("#input_cpf").keypress(function(){
    		 $("#cpf").html(CPF.valida($(this).val()));
    	});

    	$("#input_cpf").blur(function(){
    		  $("#cpf").html(CPF.valida($(this).val()));
    	});

	});

	function apresentaMensagemErro(mensagem) {
		$("#mensagemErroVoltar").html("<a href='#' onclick='history.back()'>Voltar</a>");
		$("#mensagemErro").html(mensagem);
		$("#mensagemErro").removeAttr("style").show();
		$("#mensagemErroVoltar").removeAttr("style").show();
	}

	function apresentaMensagemSucesso(mensagem) {
		$("#mensagemSucesso").html(mensagem);
		$("#mensagemSucesso").removeAttr("style").show();
	}

	function apresentaConfirmacao() {
		$("#alerta").removeAttr("style").show();
	}

	</script>	
	