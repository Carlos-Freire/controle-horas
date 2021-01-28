<?php if (!defined('CONTROLE')) return; ?>
</div>
</div>
<!-- /container -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_pt_BR.min.js" integrity="sha512-+FCfxJrlkCXOsuGOQ48Dc2at83izZqTjDgLjUWD5VhRZe6AHkIWy4EvmcVEir4xNGTZ0g8Au3fyV3NbkbVJvIA==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="../controle-horas/assets/js/form.js"></script>
<script>
$(document).ready(function() {
    var table = $('#example').DataTable({
        dom: 'Bfrtip',
        "processing": true,
        "serverSide": true,
        "stateSave": true,
        "searching": false,
        "lengthChange": false,
        "select": {
            style: 'multi'
        },
        "language": {
            url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
        },
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'dev', name: 'dev'},
            {data: 'cliente', name: 'cliente'},
            {data: 'dia', name: 'dia'},
            {data: 'hora_ini', name: 'hora_ini'},
            {data: 'hora_fim', name: 'hora_fim'}
        ],
        "ajax": {
            url: "?action=datatables",
            data: function (d) {
                d.dev = $('#dev2').val(),
                d.cliente = $('#cliente2').val(),
                d.dia = $('#dia2').val(),
                d.hora_ini = $('#hora_ini2').val(),
                d.hora_fim = $('#hora_fim2').val()
            }
        },
        buttons: [
            {
                text: 'Selecionar Todos',
                className: 'btn btn-default',
                action: function () {
                    table.rows().select();
                }
            },
            {
                text: 'Remover Seleção',
                className: 'btn btn-default',
                action: function () {
                    table.rows().deselect();
                }
            },
            {
                text: '<i class="fa fa-plus" aria-hidden="true" title="Adicionar"></i>',
                className: 'btn btn-default',
                action: function ( e, dt, node, config ) {
                    $('#modal-form').modal('show');
                }
            },
            {
                text: '<i class="fa fa-pencil" aria-hidden="true" title="Editar Selecionado"></i>',
                className: 'btn btn-default',
                action: function ( e, dt, node, config ) {
                    alert( this.text() );
                }
            },
            {
                text: '<i class="fa fa-trash" aria-hidden="true" title="Deletar selecionados"></i>',
                className: 'btn btn-danger',
                action: function ( e, dt, node, config ) {
                    alert( this.text() );
                }
            },
            {
                extend: 'pdfHtml5',
                messageTop: 'Controle de Horas',
                text: '<i class="fa fa-file-pdf-o" aria-hidden="true" title="Gerar PDF"></i>',
                className: 'btn btn-default',
                /*action: function ( e, dt, node, config ) {
                    alert( this.text() );
                }*/
            },
            {
                text: '<i class="fa fa-pie-chart" aria-hidden="true" title="Gerar Gráfico"></i>',
                className: 'btn btn-default',
                action: function ( e, dt, node, config ) {
                    alert( this.text() );
                }
            },
        ]
    });
} );
</script>
</body>
</html>