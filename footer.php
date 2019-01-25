	    <div class="footer">
            <div class="pull-right">
                <strong>Versão 1.0.0</strong>
            </div>
            <div>
                <strong>e2F - Mobile Solutions - <a href="e2f.com.br" target="_blank">e2f.com.br</a></strong>
            </div>
        </div>
	</div>
	</div>
	
    <!-- Mainly scripts -->
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/plugins/metisMenu/jquery.metisMenu.min.js" defer="defer"></script>
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js" defer="defer"></script>
      
    <!-- Flot -->
    <script src="/js/plugins/flot/jquery.flot.min.js"></script>
    <script src="/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="/js/plugins/flot/jquery.flot.spline.min.js"></script>
    <script src="/js/plugins/flot/jquery.flot.resize.min.js"></script>
    <script src="/js/plugins/flot/jquery.flot.pie.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.symbol.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.time.min.js"></script>

    <!-- Peity -->
    <script src="/js/plugins/peity/jquery.peity.min.js" defer="defer"></script>
    <script src="/js/demo/peity-demo.min.js" defer="defer"></script>

    <!-- Custom and plugin javascript -->
    <script src="/js/inspinia.min.js"></script>
    <script src="/js/plugins/pace/pace.min.js" defer="defer"></script>

    <!-- GITTER -->
    <script src="/js/plugins/gritter/jquery.gritter.min.js" defer="defer"></script>

    <!-- Sparkline -->
    <script src="/js/plugins/sparkline/jquery.sparkline.min.js" defer="defer"></script>

    <!-- Sparkline demo data  -->
    <script src="/js/demo/sparkline-demo.min.js" defer="defer"></script>

    <!-- ChartJS-->
    <script src="/js/plugins/chartJs/Chart.min.js" defer="defer"></script>

    <!-- Toastr -->
    <script src="/js/plugins/toastr/toastr.min.js" defer="defer"></script>
    
    <script src="/js/plugins/iCheck/icheck.min.js" defer="defer"></script>
     
    <!-- Jasny -->
    <script src="/js/plugins/jasny/jasny-bootstrap.min.js" defer="defer"></script>

    <!-- DROPZONE -->
    <script src="/js/plugins/dropzone/dropzone.min.js"></script>

    <!-- CodeMirror -->
    <script src="/js/plugins/codemirror/codemirror.min.js" defer="defer"></script>
    <script src="/js/plugins/codemirror/mode/xml/xml.min.js" defer="defer"></script>
    
    <script src="/js/plugins/dualListbox/jquery.bootstrap-duallistbox.min.js" defer="defer"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js" defer="defer"></script>

    <!-- Jvectormap -->
    <script src="js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js" defer="defer"></script>
    <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" defer="defer"></script>

    <!-- EayPIE -->
    <script src="js/plugins/easypiechart/jquery.easypiechart.min.js" defer="defer"></script>

    <!-- d3 and c3 charts -->
    <script src="js/plugins/c3-0.6.9/d3-5.4.0.min.js" defer="defer"></script>
    <script src="js/plugins/c3-0.6.9/c3.min.js" async="async"></script>
 
    <script>

    $('.dataTables-example').DataTable({
        pageLength: 10,
        bLengthChange: false,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        sSearch:         "Pesquisa",
        language: {
            "search": "Pesquisa",
            "sLengthMenu": "resultados por página: _MENU_ ",
            "sZeroRecords": "Nenhum registro encontrado"
        },
        buttons: [
            { extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'ExampleFile'},
            {extend: 'pdf', title: 'ExampleFile'},

            {extend: 'print',
             customize: function (win){
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
            }
            }
        ]

    });


	Dropzone.options.dropzoneForm = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        maxFiles: 1,
        addRemoveLinks: true,
        uploadMultiple: false,
        acceptedFiles: "application/pdf",
        dictInvalidFileType: "Tipo de arquivo inválido",
        dictFileTooBig: "Arquivo muito grande",
        dictDefaultMessage: "<strong>Arraste o arquivo aqui ou clique para carregar. </strong></br> (O arquivo deve estar em formato .pdf)",
        accept: function(file, done) {
            console.log("uploaded");
            done();
        },
        maxfilesexceeded: function(file) {
            this.removeFile(file);
        },

        init: function() {

           	this.on("sending", function(file, xhr, formData) {
           		file.myCustomName = md5(new Date().getTime());
           	    console.log(file.myCustomName);
				formData.append("filesize", file.size);
				formData.append("fileName", file.myCustomName);
				formData.append("id_curriculo", 1);
           	});
            
           	this.on("removedfile", function(file) {
               	$.ajax({
                    url: '/modulos/arquivo/delete.php',
                    type: "POST",
                    data: { filetodelete: file.name },
      			  	success: function(data) {
      					console.log("deletado");
    			  	},
                  	error: function (request, status, error) {
              	  		console.log("Problema ocorrido: " + status + "\nDescrição: " + error);
                    	console.log("Informações da requisição: \n" + request.getAllResponseHeaders());
    		      	}
               	});
          	});
        }
    };

    $(document).ready(function() {

        var options = {
            xaxis: {
                mode: "time",
                tickSize: [3, "day"],
                tickLength: 0,
                axisLabel: "Date",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 10,
                color: "#d5d5d5"
            },
            yaxes: [{
                position: "left",
                max: 1070,
                color: "#d5d5d5",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 3
            }, {
                position: "right",
                clolor: "#d5d5d5",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: ' Arial',
                axisLabelPadding: 67
            }
            ],
            legend: {
                noColumns: 1,
                labelBoxBorderColor: "#000000",
                position: "nw"
            },
            grid: {
                hoverable: false,
                borderWidth: 0
            }
        };

        function gd(year, month, day) {
            return new Date(year, month - 1, day).getTime();
        }

        var previousPoint = null, previousLabel = null;

        var mapData = {
            "US": 298,
            "SA": 200,
            "DE": 220,
            "FR": 540,
            "CN": 120,
            "AU": 760,
            "BR": 550,
            "IN": 200,
            "GB": 120,
        };

        $('#world-map').vectorMap({
            map: 'world_mill_en',
            backgroundColor: "transparent",
            regionStyle: {
                initial: {
                    fill: '#e4e4e4',
                    "fill-opacity": 0.9,
                    stroke: 'none',
                    "stroke-width": 0,
                    "stroke-opacity": 0
                }
            },

            series: {
                regions: [{
                    values: mapData,
                    scale: ["#1ab394", "#22d6b1"],
                    normalizeFunction: 'polynomial'
                }]
            },
        });
    });
</script>

</body>
</html>