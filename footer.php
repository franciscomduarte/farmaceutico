	    <div class="footer">
            <div class="pull-right">
                <strong>Versão 1.0.0</strong>
            </div>
            <div>
                <strong>Coordenação-Geral de Educação a Distância</strong>
            </div>
        </div>
	</div>
	</div>
	

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

    </script>
</body>
</html>