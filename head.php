<html>

	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	    <title><?php echo NOME_SISTEMA?></title>
	    
	    <link href="/css/bootstrap.min.css" rel="stylesheet">
	    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
	    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
	    <link href="/css/plugins/dropzone/basic.css" rel="stylesheet">
    	<link href="/css/plugins/dropzone/dropzone.css" rel="stylesheet">
    	<link href="/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    	<link href="/css/plugins/codemirror/codemirror.css" rel="stylesheet">
	    <!-- Toastr style -->
	    <link href="/css/plugins/toastr/toastr.min.css" rel="stylesheet">
	    <!-- Gritter -->
	    <link href="/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
	    <link href="/css/animate.css" rel="stylesheet">
	    <link href="/css/style.css" rel="stylesheet">
	    <link href="/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	    <link rel="stylesheet" type="text/css" href="/css/editor/editor.dataTables.min.css">
	    <link href="/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
	    <link href="/css/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">
   	 	<link href="/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
   	 	<link href="/css/plugins/toastr/toastr.min.css" rel="stylesheet">
   	 	<link href="/css/plugins/steps/jquery.steps.css" rel="stylesheet">
   	 	<link href="/css/plugins/summernote/summernote.css" rel="stylesheet">
   		<link href="/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
   		<link href="/css/plugins/c3-0.6.9/c3.css" rel="stylesheet">
   		<link href="/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
   		
   		<link rel="stylesheet" href="/css/datebox/jtsage-datebox-4.4.1.bootstrap.min.css">
    	<link rel="stylesheet" href="/css/datebox/syntax.css">
    	
    	
   		
	</head>
	
	<script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/js/plugins/validate/jquery.validate.min.js"></script> 
    <script src="/js/plugins/dataTables/datatables.min.js"></script>
    <script src="/js/md5/md5.min.js"></script>
    <script src="/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="/js/plugins/toastr/toastr.min.js"></script>
    <!-- ChartJS-->
    <script src="/js/plugins/chartJs/Chart.min.js"></script>
    <script src="/js/plugins/steps/jquery.steps.min.js"></script>
    <script src="/js/plugins/summernote/summernote.min.js"></script>
    <script src="/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

<!-- ChartJS-->
    <script src="/js/plugins/chartJs/Chart.min.js"></script>
    <script src="/js/sistema.js"></script>
    

    <script src="/js/datebox/jtsage-datebox-4.4.1.bootstrap.min.js"></script>
	<script src="/js/datebox/initial.js"></script>

	<script type="text/javascript">

	$(document).ready(function() {

        $('.summernote').summernote();

        $('.colorpicker').colorpicker();

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
	