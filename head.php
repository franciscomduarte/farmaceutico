<!DOCTYPE html>
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

	<script type="text/javascript">

	$(document).ready(function() {

        $('.summernote').summernote();

        $(".datepicker").datepicker( {
      	  format: "mm-yyyy",
      	  viewMode: "months",
      	  minViewMode: "months"
       });

        $('.dual_select').bootstrapDualListbox({
            selectorMinimalHeight: 160
        });


        var d1 = [[1262304000000, 6], [1264982400000, 3057], [1267401600000, 20434], [1270080000000, 31982], [1272672000000, 26602], [1275350400000, 27826], [1277942400000, 24302], [1280620800000, 24237], [1283299200000, 21004], [1285891200000, 12144], [1288569600000, 10577], [1291161600000, 10295]];
        var d2 = [[1262304000000, 5], [1264982400000, 200], [1267401600000, 1605], [1270080000000, 6129], [1272672000000, 11643], [1275350400000, 19055], [1277942400000, 30062], [1280620800000, 39197], [1283299200000, 37000], [1285891200000, 27000], [1288569600000, 21000], [1291161600000, 17000]];

        var data1 = [
            { label: "Data 1", data: d1, color: '#17a084'},
            { label: "Data 2", data: d2, color: '#127e68' }
        ];
        $.plot($("#flot-chart1"), data1, {
            xaxis: {
                tickDecimals: 0
            },
            series: {
                lines: {
                    show: true,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 1
                        }, {
                            opacity: 1
                        }]
                    },
                },
                points: {
                    width: 0.1,
                    show: false
                },
            },
            grid: {
                show: false,
                borderWidth: 0
            },
            legend: {
                show: false,
            }
        });

        var lineData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "Example dataset",
                    backgroundColor: "rgba(26,179,148,0.5)",
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [48, 48, 60, 39, 56, 37, 30]
                },
                {
                    label: "Example dataset",
                    backgroundColor: "rgba(220,220,220,0.5)",
                    borderColor: "rgba(220,220,220,1)",
                    pointBackgroundColor: "rgba(220,220,220,1)",
                    pointBorderColor: "#fff",
                    data: [65, 59, 40, 51, 36, 25, 40]
                }
            ]
        };

        var lineOptions = {
            responsive: true
        };

        var ctx = document.getElementById("lineChart").getContext("2d");
        new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});

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

	</script>	
	