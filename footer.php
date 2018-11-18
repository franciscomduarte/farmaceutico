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
    <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    
    <!-- Flot -->
    <script src="/js/plugins/flot/jquery.flot.js"></script>
    <script src="/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/js/inspinia.js"></script>
    <script src="/js/plugins/pace/pace.min.js"></script>

    <!-- GITTER -->
    <script src="/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="/js/plugins/toastr/toastr.min.js"></script>
    
    <script src="/js/plugins/iCheck/icheck.min.js"></script>
    
    <!-- Jasny -->
    <script src="/js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <!-- DROPZONE -->
    <script src="/js/plugins/dropzone/dropzone.js"></script>

    <!-- CodeMirror -->
    <script src="/js/plugins/codemirror/codemirror.js"></script>
    <script src="/js/plugins/codemirror/mode/xml/xml.js"></script>
    
    <script src="/js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>
    
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
				formData.append("id_curriculo", <?php echo (isset($obj['id_curriculo']) ? $obj['id_curriculo'] : null) ?>);
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


    </script>
</body>
</html>